<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\category\StoreCategoryRequest;
use App\Http\Requests\Owner\category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Owner\CategoryService;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function index()
    {
        $title = 'Delete Branch';
        $text = 'Are you sure you want to delete this branch?';

        confirmDelete($title, $text);

        return view('owner.categories.index');
    }

    public function data()
    {
        return $this->categoryService->datatable();
    }

    public function create()
    {
        return view('owner.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->create($request->validated());

        Alert::success('Success', 'Category created successfully.');

        return redirect()->route('owner.categories.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('owner.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->update($category, $request->validated());

        Alert::success('Success', 'Category updated successfully.');

        return redirect()->route('owner.categories.index');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        Alert::success('Success', 'Category deleted successfully.');

        return redirect()->route('owner.categories.index');
    }
}
