<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
</head>
<body>
    <h1>Products</h1>
    <ul>
        @foreach($products as $product)
        <li>{{ $product->name }} - Unit Price: {{ $product->unitPrice }}, Quantity: {{ $product->quantity }},
            Owning Store: {{ $product->store_name }}
        </li>
        <a href="{{ route('products.edit', $product->id) }}">Edit</a>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        @endforeach
    </ul>    
</body>
</html>