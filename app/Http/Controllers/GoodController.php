<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;
use App\Http\Requests\GoodRequest;
use App\Http\Requests\UpdateGoodRequest;
use App\Models\Category;

class GoodController extends Controller
{
    /**
     * Display a listing of goods.
     */
    public function index()
    {
        $goods = Good::all();

        // Fetch category name for each store
        foreach ($goods as $good) {
            $category = Category::findOrFail($good->categoryId);
            $good->category_name = $category->name;
        }

        return view('Good.index', ['goods' => $goods]);
    }

    /**
     * Show the form for creating a new good.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Good.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created good in storage.
     */
    public function store(GoodRequest $request)
    {
        $validatedData = $request->validated();
        Good::create($validatedData);
        return redirect()->route('goods.index')->with('success', 'Good created successfully!');
    }

    /**
     * Display the specified good.
     */
    public function show(string $id)
    {
        $good = Good::findOrFail($id);

        // Fetch category name for the good
        $category = Category::findOrFail($good->categoryId);
        $good->category_name = $category->name;

        return view('Good.show', ['good' => $good]);
    }

    /**
     * Show the form for editing the specified good.
     */
    public function edit(string $id)
    {
        $good = Good::findOrFail($id);
        return view('Good.edit', ['good' => $good]);
    }

    /**
     * Update the specified good in storage.
     */
    public function update(UpdateGoodRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $good = Good::findOrFail($id);

        $good->update([
            'unitPrice' => $validatedData['unitPrice'],
            'quantity' => $validatedData['quantity'],
        ]);

    return redirect()->route('goods.index')->with('success', 'Good updated successfully!');
}

    /**
     * Remove the specified good from storage.
     */
    public function destroy(string $id)
    {
        $good = Good::findOrFail($id);
        $good->delete();
        return redirect()->route('Good.index')->with('success', 'Good deleted successfully!');
    }
}
