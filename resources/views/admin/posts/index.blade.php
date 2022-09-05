@extends('layouts.dashboard')

@section('content')

    <h1>Tutti i Posts</h1>
        <div class="row row-cols-3 ">
            @foreach ($posts as $post)
            {{-- start card  --}}
            <div class="col mt-3">
                <div class="card">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                      <h5 class="card-title">{{$post->title}}</h5>
                      <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Vedi articolo</a>
                    </div>
                </div>
            </div> 
            {{--end card  --}}
            @endforeach 
              
        </div>  
@endsection