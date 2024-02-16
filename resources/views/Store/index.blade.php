<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stores</title>
</head>
<body>
    <h1>Stores</h1>
    <ul>
        @foreach($stores as $store)
            <li>{{ $store->name }} - {{ $store->location }} - {{ $store->category_name }}</li>
            <form action="{{ route('stores.destroy', $store->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endforeach
    </ul>
    <a href="{{ route('stores.create') }}">Create New Store</a>
</body>
</html>