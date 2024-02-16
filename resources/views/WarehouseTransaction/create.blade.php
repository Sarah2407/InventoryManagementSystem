<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a Warehoue Transaction</title>
</head>
<body>
    <div class="container">
        <h1>Create Warehouse Transaction</h1>
        <div class="form">
            <form action="{{ route('warehouse_transactions.store') }}" method="POST">
                @csrf
                <label for="store">Store:</label>
                <select name="store_id" id="store">
                    @foreach($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
                <br><br>
                <label for="good">Good:</label>
                <select name="good_id" id="good">
                    @foreach($goods as $good)
                    <option value="{{ $good->id }}">{{ $good->name }}</option>
                @endforeach
                </select>
                <br><br>
                <label for="quantity_requested">Quantity Requested:</label>
                <input type="number" name="quantity_requested" id="quantity_requested" min="1">
                <br><br>
                <button type="submit">Create Transaction</button>
            </form>
        </div>
    </div>
</body>
</html>