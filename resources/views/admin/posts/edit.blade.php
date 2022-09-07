@extends('layouts.dashboard')

@section('content')

<h1>Modifica post</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('admin.posts.update', ['post' => $post->id ])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}">
        </div>

        <div class="mb-3">
            <label for="category_id">Categoria</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Nessuna</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}" {{ old('category_id', $post->category_id )  == $category->id   ? 'selected' : '' }}>{{$category->name}}</option>
                @endforeach                
            </select>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Contenuto</label>
            <textarea class="form-control" id="content" name="content" rows="6">{{ old('content', $post->content) }}</textarea>
        </div>

        <input class="btn btn-primary" type="submit" value="Salva">
        
    </form>
@endsection