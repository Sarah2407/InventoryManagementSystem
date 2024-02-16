<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $store->name }}</title>
</head>
<body>
    <h1>{{ $store->name }}</h1>
    <h1>{{ $store->location }}</h1>
    <p>Category: {{ $store->category_name }}</p>
    <a href="{{ route('stores.index') }}">Back to Stores</a>
</body>
</html>