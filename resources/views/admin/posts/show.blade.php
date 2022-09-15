@extends('layouts.dashboard')
@section('content')

    <h1>{{$post->title}}</h1>
    @if ($post->cover)
        <img class="w-50" src="{{ asset('storage/' . $post->cover )}}" alt="$post->title">
    @endif
    <h3>Categoria: {{ $post->category ? $post->category->name : 'Nessuna' }}</h3>
    <div>Data creazine: {{$post->created_at->format('D d-m-Y')}}</div>
    <div>Ultimo aggiornamento: {{$post->updated_at->format('D d-m-Y / H.i' )}}</div>
    <div>Slug: {{$post->slug}}</div>
    <h2>Contenuto:</h2>
    <p>{{$post->content}}</p>
    <div class="mb-4">
        Tags: 
        <div class="badge bg-primary ml-1">
            @if ($post->tags->isNotEmpty())
            @foreach ($post->tags as $tag)
                {{ $tag->name }}{{!$loop->last ? ' - ' : ''}}
            @endforeach
        
            @else
                nessun Tag
            @endif
        </div>
    </div>

    <div class="d-flex">
        <a class="btn btn-primary mr-3" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}"> Modifica post</a>

        <form action="{{route('admin.posts.destroy', ['post' => $post->id ])}}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger mr-3" type="submit" value="Elimina" onClick="return confirm('Sicuro di cancellare il Post');">
        </form>

    </div>
    
@endsection