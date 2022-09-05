@extends('layouts.dashboard')
@section('content')
    <h1>{{$post->title}}</h1>
    <div>Data creazine: {{$post->created_at}}</div>
    <div>Ultimo aggiornamento: {{$post->updated_at}}</div>
    <div>Slug: {{$post->slug}}</div>
    <h2>Contenuto:</h2>
    <p>{{$post->content}}</p>
@endsection