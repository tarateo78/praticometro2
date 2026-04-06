<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>All Posts!</h1>
    <a href="{{ route('posts.create') }}">Create a new post</a>
    <br>
    @foreach ($posts as $post)
    <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure?')">DELETE</button>
    </form>
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->body }}</p>
    @endforeach
</body>

</html>