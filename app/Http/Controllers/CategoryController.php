<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json(['categories' => $categories]);
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());

        return response()->json(['category' => $category], 201);
    }

    /**
     * Display the specified category.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified category in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);

        $category->update($request->all());

        return response()->json(['category' => $category]);
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
