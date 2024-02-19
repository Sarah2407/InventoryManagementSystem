<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Warehouse Transactions</title>
</head>
<body>
    <h1>Warehouse Transactions</h1>
        <a href="{{ route('warehouse_transactions.create') }}" class="btn btn-primary mb-3">Create New Transaction</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Store Name</th>
                    <th>Good Name</th>
                    <th>Quantity Requested</th>
                    <th>Status</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->store_name }}</td>
                        <td>{{ $transaction->good_name }}</td>
                        <td>{{ $transaction->quantity_requested }}</td>
                        <td>{{ $transaction->status }}</td>
                        <td>
                            <a href="{{ route('warehouse_transactions.show', $transaction->id) }}" class="btn btn-primary">View</a>
                            <form action="{{ route('warehouse_transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('warehouse_transactions.pending') }}" class="btn btn-primary mb-3">Pending Transactions</a>
</body>
</html>