<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Warehouse Transaction  Details</title>
</head>
<body>
    <div class="container">
        <h1>Warehouse Transaction Details</h1>
        <div>
            <p><strong>Store Name:</strong> {{ $transaction->store_name }}</p>
            <p><strong>Good Name:</strong> {{ $transaction->good_name }}</p>
            <p><strong>Quantity Requested:</strong> {{ $transaction->quantity_requested }}</p>
            <p><strong>Status:</strong> {{ $transaction->status }}</p>
            <p><strong>Created At:</strong> {{ $transaction->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $transaction->updated_at }}</p>
        </div>
    </div>
</body>
</html>