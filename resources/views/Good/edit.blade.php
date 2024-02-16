<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $good->name }}</title>
</head>
<body>
    <h1>Edit Good</h1>
    <form action="{{ route('goods.update', $good->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="unit_price">Unit Price:</label>
        <input type="text" id="unit_price" name="unitPrice" value="{{ $good->unitPrice }}">
        <label for="quantity">Quantity:</label>
        <input type="text" id="quantity" name="quantity" value="{{ $good->quantity }}">
        <button type="submit">Update</button>
    </form>
</body>
</html>