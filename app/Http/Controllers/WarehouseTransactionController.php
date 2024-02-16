<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseTransactionRequest;
use App\Models\WarehouseTransaction;

class WarehouseTransactionController extends Controller
{
    /**
     * Display a listing of warehouse transactions.
     */
    public function index()
    {
        $transactions = WarehouseTransaction::all();

        // Fetch related store and good names for each transaction
        foreach ($transactions as $transaction) {
            $transaction->store_name = Store::findOrFail($transaction->store_id)->name;
            $transaction->good_name = Good::findOrFail($transaction->good_id)->name;
        }

        return view('WarehouseTransaction.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new warehouse transactions.
     */
    public function create()
    {
        $stores = Store::all();
        $goods = Good::all();

        return view('WarehouseTransaction.create', ['stores' => $stores, 'goods' => $goods]);
    }

    /**
     * Store a newly created warehouse transaction in storage.
     */
    public function store(WarehouseTransactionRequest $request)
    {
        $validated = $request->validated();

        $availableQuantity = Good::findOrFail($validated['good_id'])->quantity;

        // Set the status to 'Pending'
        $validated['status'] = 'Pending';

        if ($validated['quantity_requested'] > $availableQuantity) {
            return redirect()->back()->withErrors(['quantity_requested' => 'Requested quantity exceeds available quantity!'])->withInput();
        }

        // Create the warehouse transaction
        WarehouseTransaction::create($validated);

    return redirect()->route('warehouse_transactions.index')
        ->with('success', 'Warehouse transaction has been successfully initiated!');
}

    /**
     * Display the specified warehouse transaction.
     */
    public function show(string $id)
    {
        $transaction = WarehouseTransaction::findOrFail($id);

        //Fetch related store and good names
        $transaction->good_name = Good::findOrFail($transaction->good_id)->name;
        $transaction->store_name = Store::findOrFail($transaction->store_id)->name;

        return view('WarehouseTransaction.show', ['transaction' => $transaction]);
    }


    /**
     * Remove the specified warehouse transaction from storage.
     */
    public function destroy(string $id)
    {
        $transaction = WarehouseTransaction::findOrFail($id);
        $transaction::delete();
        return redirect('warehouse-transactions.destroy')
        ->with('success', 'Warehouse transaction deleted successfully!');
    }
}
