<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a Store to Store Transaction</title>
</head>
<body>
    <h1>Store Transactions</h1>
    <div class="form">
        <form action="{{ route('store_transactions.store') }}" method="POST">
            @csrf
            <label for="source_store"> Source Store:</label>
            <select name="source_store_id" id="source_store">
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
            <label for="destination_store"> Destination Store:</label>
            <select name="destination_store_id" id="destination_store">
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
            <label for="product">Product:</label>
                <select name="product_id" id="product">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            <br>
            <label for="quantity_requested">Quantity Requested:</label>
                <input type="number" name="quantity_requested" id="quantity_requested" min="1">
            <br><br>
            <button type="submit">Create Transaction</button>
        </form>
    </div>
</body>
</html>