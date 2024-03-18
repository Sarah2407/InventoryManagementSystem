<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\StoreTransaction;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreTransactionRequest;

class StoreTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = StoreTransaction::all();

        foreach ($transactions as $transaction) 
        {
            try {
                $transaction->source_store_name = Store::findOrFail($transaction->source_store_id)->name;
                $transaction->destination_store_name = Store::findOrFail($transaction->destination_store_id)->name;
                $transaction->product_name = Product::findOrFail($transaction->product_id)->name;
            } 
            catch (\Exception $e) {
                Log::error('Error fetching store or product details: ' . $e->getMessage());
            }
        }
        
        return view('StoreTransaction.index', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Store::all();
        $products = Product::all();
        
        return view('StoreTransaction.create', ['stores' => $stores, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $validated = $request->validated();

        $sourceStore = Store::findOrFail($validated['source_store_id']);
        $destinationStore = Store::findOrFail($validated['destination_store_id']);
    
        if ($sourceStore->category_id != $destinationStore->category_id) 
        {
            return redirect()->back()
            ->withErrors(['category_mismatch' => 'The source and destination stores must be of the same category!'])
            ->withInput();
        }

        //Check if the requested product belongs to the source store
        $requestedProduct = Product::where('storeId', $validated['source_store_id'])
            ->where('id', $validated['product_id'])
            ->first();

        if (!$requestedProduct) 
        {
            return redirect()->back()
                ->withErrors(['not_found' => 'The requested product does not exist in the source store.'])
                ->withInput();
        }
            
        if ($requestedProduct->quantity < $validated['quantity_requested']) 
        {
            return redirect()->back()
                ->withErrors(['quantity_insufficient' => 'The available quantity of the product in the source store is insufficient.'])
                ->withInput();
        }       

        $validated['status'] = 'Pending';
        StoreTransaction::create($validated);

        return redirect()->route('store_transactions.index')
            ->with('success', 'store transaction has been successfully created');        
    }

    /**
     * Display the specified store transaction.
     */
    public function show(string $id)
    {
        $transaction = StoreTransaction::findOrFail($id);

        $transaction->product_name = Product::findOrFail($transaction['product_id'])->name;
        $transaction->source_store_name = Store::findOrFail($transaction['source_store_id'])->name;
        $transaction->destination_store_name = Store::findOrFail($transaction['destination_store_id'])->name;

        return view('StoreTransaction.show', ['transaction' => $transaction]);
    }

    /**
     * Remove the specified store transaction from storage.
     */
    public function destroy(string $id)
    {
        $transaction = StoreTransaction::findOrFail($id);
        $transaction::delete();
        return redirect('store_transactions.destroy')
            ->with('success', 'Store transaction deleted successfully!');
    }

    /**
     * Destination store accepts a pending store transaction.
     */
    public function acceptTransaction(string $id)
    {
        $transaction = StoreTransaction::findOrFail($id);

        if ($transaction->status != 'Pending') 
        {
            return redirect()
                ->back()
                ->withErrors(['status' => 'Transaction is not in pending state']);
        }

        $transaction->update(['status' => 'Approved']);

        $product = Product::findOrFail($transaction->product_id);
        $newProduct = new Product
        ([
            'name' => $product->name,
            'unitPrice' => $product->unitPrice,
            'quantity' => $transaction->quantity_requested,
            'storeId' => $transaction->destination_store_id
        ]);
        $newProduct->save();

        $product->decrement('quantity', $transaction->quantity_requested);

        return redirect()->back()->with('success', 'Store transaction has been approved successfully!');
    }

    /**
     * Destination store rejects a pending store transaction.
     */
    public function rejectTransaction(string $id)
    {
        $transaction = StoreTransaction::findOrFail($id);

        if ($transaction->status != 'Pending') 
        {
            return redirect()
                ->back()
                ->withErrors(['status' => 'Transaction is not in pending state']);
        }

        $transaction->update(['status' => 'Rejected']);

        return redirect()
            ->back()
            ->with('success', 'Store transaction has been rejected successfully!');
    }

    /**
     * Returns a list of pending store transactions
     */
    public function getPendingTransactions()
    {
        $pendingTransactions = StoreTransaction::where('status', 'Pending')->get();

        return view('StoreTransaction.pending', ['pendingTransactions' => $pendingTransactions]);
    }

}
