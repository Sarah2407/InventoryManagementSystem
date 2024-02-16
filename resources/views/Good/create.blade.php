<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Good</title>
</head>
<body>
    <h1>Create Good</h1>
    <form action="{{ route('goods.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <label for="unit_price">Unit Price:</label>
        <input type="text" id="unit_price" name="unitPrice">
        <label for="quantity">Quantity:</label>
        <input type="text" id="quantity" name="quantity">
        <label for="category_id">Category:</label>
        <select id="category_id" name="categoryId">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit">Create</button>
</body>
</html>