<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPostAdminEmail;
use Carbon\Carbon;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::all();
        $request_info= $request->all();
        $deleted_message = isset($request_info['deleted']) ? $request_info['deleted'] : null;
        
        $this->getDifferentDay($posts);
        $data = [
            'posts'=> $posts,
            'deleted_message' => $deleted_message,
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $data=[
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidation());
        $form_data = $request -> all();

        if(isset($form_data['image'])){
            $img_path = Storage::put('post-covers', $form_data['image']);
            $form_data['cover'] = $img_path;
        }

        $new_post = new Post();
        $new_post -> fill($form_data);

        $new_post->slug = $this->getSlug($new_post->title);
        $new_post->save();
    

        if(isset($form_data['tags'])){
            $new_post->tags()->sync($form_data['tags']);
        }

        Mail::to('admin@boolpress.com')->send(new NewPostAdminEmail($new_post));

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $now = Carbon::now();

        $data = [
            'post'=> $post
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        $data = [
            'post'=> $post,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->getValidation());
        $form_data = $request->all();
        $post_to_update = Post::findOrFail($id);

        if(isset($form_data['image'])) {
            if($post_to_update->cover){
                Storage::delete($post_to_update->cover);
            }
            $img_path = Storage::put('post-covers', $form_data['image']);
            $form_data['cover'] = $img_path;
        }

       if ($form_data['title'] !== $post_to_update->title) {
        $form_data['slug'] = $this->getSlug($form_data['title']);
       }else{
        $form_data['slug'] = $post_to_update->slug;
       }
       
       $post_to_update->update($form_data);

       if(isset($form_data['tags'])){
            $post_to_update->tags()->sync($form_data['tags']);
        }else{
            $post_to_update->tags()->sync([]);
        }
    
       return redirect()-> route('admin.posts.show', ['post' => $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        {
            $delete_post = Post::findOrFail($id);
            $delete_post->tags()->sync([]);

            if($delete_post->cover){
                Storage::delete($post_to_update->cover);
            }

            $delete_post->delete();
            return redirect()->route('admin.posts.index', ['deleted'=> 'yes']);    
        }
    }

    protected function getValidation() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'image' => 'nullable|file|mimes:jpeg,jpg,bmp,png'
        ];
    }

    protected function getSlug($title){

        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;

        $exsisting_slug = Post::where('slug', '=',  $slug_to_save)->first();

        $count = 1;
        while ($exsisting_slug) {
            $slug_to_save = $slug_base . '-' . $count;
            $exsisting_slug = Post::where('slug', '=',  $slug_to_save)->first();
            $count++;
        }
        return $slug_to_save; 
    }

    protected function getDifferentDay($posts){
        $today = Carbon::now();
        foreach($posts as $post){
            $post['updated_days_ago'] = $post -> updated_at-> diffInDays($today);
        }
    }
}
