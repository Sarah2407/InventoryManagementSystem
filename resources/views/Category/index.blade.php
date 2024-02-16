<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
</head>
<body>
    <h1>Categories</h1>
    <ul>
        @foreach($categories as $category)
            <li>{{ $category->name }}</li>
            <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
        @endforeach
    </ul>
    <a href="{{ route('categories.create') }}">Create New Category</a>
</body>
</html>