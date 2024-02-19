<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('Category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('Category.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(CategoryRequest $request)
    {
        $existingCategory = Category::where('name', $request->name)->first();

        if ($existingCategory) {
            return redirect()->route('categories.create')
            ->with('categoryExists', 'Category with name' . $existingCategory->name . 'already exists');
        }

        $validatedData = $request->validated();
        Category::create($validatedData);
        return redirect()->route('categories.index')->with('success', 'Category with name created successfully!');
    }

    /**
     * Display the specified category.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('Category.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('Category.edit', ['category' => $category]);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $category = Category::findOrFail($id);
        $category->update($validatedData);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Check if there are associated goods or stores
        $associatedGoods = Good::where('categoryId', $category->id)->exists();
        $associatedStores = Store::where('category_id', $category->id)->exists();

        if ($associatedGoods || $associatedStores) {
            return redirect()->route('categories.index')->with('error', 'Cannot delete category with associated goods or stores');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
