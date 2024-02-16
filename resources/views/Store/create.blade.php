<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create store</title>
</head>
<body>
    <h1>Create Store</h1>
    <form action="{{ route('stores.store') }}" method="POST">
        @csrf
        <label for="name">Store Name:</label>
        <input type="text" id="name" name="name">
        <label for="location">Location:</label>
        <input type="text" id="location" name="location">
        <label for="category">Category:</label>
        <select id="category" name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit">Create Store</button>
    </form>
</body>
</html>