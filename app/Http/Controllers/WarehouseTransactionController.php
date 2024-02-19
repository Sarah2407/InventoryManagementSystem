<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseTransactionRequest;
use App\Models\Product;
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
        // Fetch all stores and goods
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

        // Retrieve the details of the requested good
        $requestedGood = Good::findOrFail($validated['good_id']);

        // Retrieve the details of the store
        $store = Store::findOrFail($validated['store_id']);

        // Check if the categories of the requested good and the store match
        if ($requestedGood->categoryId !== $store->category_id) {
            return redirect()->back()
            ->withErrors(['category_mismatch' => 'The requested good and the store must be in the same category!'])
            ->withInput();
        }

        // Check if requested quantity is less than or equal to the available good quantity
        $availableQuantity = $requestedGood->quantity;

        if ($validated['quantity_requested'] > $availableQuantity) {
            return redirect()->back()
            ->withErrors(['quantity_requested' => 'Requested quantity exceeds available quantity!'])
            ->withInput();
        }

        
        // Set the status to 'Pending'
        $validated['status'] = 'Pending';

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

    /**
     * A store accepts a pending warehouse transaction.
     */
    public function acceptTransaction($id)
    {
        $transaction = WarehouseTransaction::findOrFail($id);

        // Check if the transaction status is 'Pending'
        if ($transaction->status !== 'Pending') {
            return redirect()->back()->withErrors(['status' => 'Transaction is not in pending state']);
        }

        // Update the transaction status to 'Approved'
        $transaction->update(['status' => 'Approved']);

        // Update the Products table with the details of the accepted good
        $good = Good::findOrFail($transaction->good_id);
        $product = new Product([
            'name' => $good->name,
            'unitPrice' => $good->unitPrice,
            'quantity' => $transaction->quantity_requested,
            'storeId' => $transaction->store_id
        ]);
        $product->save();

        // Reduce the quantity of the good in the Goods table
        $good->decrement('quantity', $transaction->quantity_requested);

        return redirect()->back()->with('success', 'Transaction has been approved successfully!');
    }

    /**
     * A store rejects a pending warehouse transaction.
     */
    public function rejectTransaction($id)
    {
        $transaction = WarehouseTransaction::findOrFail($id);

        // Check if the transaction status is 'Pending'
        if ($transaction->status !== 'Pending') {
            return redirect()->back()->withErrors(['status' => 'Transaction is not in pending state']);
        }

        // Update the transaction status to 'Rejected'
        $transaction->update(['status' => 'Rejected']);

        return redirect()->back()->with('success', 'Transaction has been rejected successfully!');
    }

    /**
     * Fetch all pending warehouse transactions
     */
    public function getPendingTransactions()
    {
        $pendingTransactions = WarehouseTransaction::where('status', 'Pending')->get();

        return view('WarehouseTransaction.index', ['transactions' => $pendingTransactions]);
    }
}
