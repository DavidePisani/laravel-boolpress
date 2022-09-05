@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1> Benvenuto, {{$user->name}}</h1>
        <div>la tua email: {{$user->email}}</div>
    </div>
    
@endsection
