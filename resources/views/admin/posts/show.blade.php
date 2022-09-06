@extends('layouts.dashboard')
@section('content')

    <h1>{{$post->title}}</h1>
    <div>Data creazine: {{$post->created_at->format('D d-m-Y')}}</div>
    <div>Ultimo aggiornamento: {{$post->updated_at->format('D d-m-Y / H.i' )}}</div>
    <div>Slug: {{$post->slug}}</div>
    <h2>Contenuto:</h2>
    <p>{{$post->content}}</p>

    <div class="d-flex">
        <a class="btn btn-primary mr-3" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}"> Modifica post</a>

        <form action="{{route('admin.posts.destroy', ['post' => $post->id ])}}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger mr-3" type="submit" value="Elimina" onClick="return confirm('Sicuro di cancellare il Post');">
        </form>

    </div>
    
@endsection