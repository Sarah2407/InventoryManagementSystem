<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $good->name }}</title>
</head>
<body>
    <h1>{{ $good->name }}</h1>
    <p>Unit Price: {{ $good->unitPrice }}</p>
    <p>Quantity: {{ $good->quantity }}</p>
    <p>Category: {{ $good->category_name }}</p>
    <a href="{{ route('goods.index') }}">Back to Goods</a>
</body>
</html>