<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of stores.
     */
    public function index()
    {
        $stores = Store::all();

        // Fetch category name for each store
        foreach ($stores as $store) {
            $category = Category::findOrFail($store->category_id);
            $store->category_name = $category->name;
        }

        return view('Store.index', ['stores' => $stores]);
    }

    /**
     * Show the form for creating a new store.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Store.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created store in storage.
     */
    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        Store::create($validatedData);
        return redirect()->route('stores.index')->with('success', 'Store created successfully!');
    }    

    /**
     * Display the specified store.
     */
    public function show(string $id)
    {
        $store = Store::findOrFail($id);

        // Fetch category name for the store
        $category = Category::findOrFail($store->category_id);
        $store->category_name = $category->name;

        return view('Store.show', ['store' => $store]);
    }

    /**
     * Remove the specified store from storage.
     */
    public function destroy(string $id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        return redirect()->route('Store.index')->with('success', 'Store deleted successfully!');
    }
}
