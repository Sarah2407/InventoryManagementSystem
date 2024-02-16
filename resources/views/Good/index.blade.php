<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Goods</title>
</head>
<body>
    <h1>Goods</h1>
    <ul>
        @foreach($goods as $good)
            <li>{{ $good->name }} - Unit Price: {{ $good->unitPrice }}, Quantity: {{ $good->quantity }},
                Category: {{ $good->category_name }}
            </li>
                <a href="{{ route('goods.edit', $good->id) }}">Edit</a>
                <form action="{{ route('goods.destroy', $good->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
        @endforeach
    </ul>
    <a href="{{ route('goods.create') }}">Create New Good</a>
</body>
</html>