<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Nuovo Post Creato</h1>
    <p>Il nome del nuovo post è: {{$new_post->title}}</p>
    <a href="{{route('admin.posts.show', ['post' => $new_post->id])}}">Clicca qui per visuallizare il nuovo post</a>
</body>
</html>