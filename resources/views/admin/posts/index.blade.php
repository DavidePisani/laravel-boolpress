@extends('layouts.dashboard')

@section('content')

    <h1>Tutti i Posts</h1>
    @if ($deleted_message)
        <div class="alert alert-info" role="alert">
            Post eliminato correttamente
        </div>   
    @endif
    
        <div class="row row-cols-3 ">
            @foreach ($posts as $post)
            {{-- start card  --}}
            <div class="col mt-3">
                <div class="card">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                      <h5 class="card-title">{{$post->title}}</h5>
                      @if ($post->updated_days_ago > 0)
                      <div> Aggiornato: {{$post->updated_days_ago}} giorn{{$post->updated_days_ago > 1 ? 'i' : 'o' }} fa</div>
                      @endif
                      
                      <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary mt-1">Vedi articolo</a>
                    </div>
                </div>
            </div> 
            {{--end card  --}}
            @endforeach 
              
        </div>  
@endsection