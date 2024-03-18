<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pending Store Transactions</title>
</head>
<body>
    <h1>Pending Store Transactions</h1>
    @foreach ($pendingTransactions as $transaction)
        <li>Source Store Name: {{ $transaction->source_store_name }}</li>
        <li>Destination Store Name: {{ $transaction->destination_store_name }}</li>
        <li>Good Name: {{ $transaction->product_name }}</li>
        <li>Good Quantity: {{ $transaction->quantity_requested }}</li>
        <li>Status: {{ $transaction->status }}</li>
        <form action="{{ route('store_transactions.accept', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit">Accept</button>
        </form>
        <form action="{{ 'store_transactions.reject', $transaction->id }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit">Reject</button>
        </form>
    @endforeach
</body>
</html>