<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\Product\StoreProductRequest;
use App\Http\Requests\Owner\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use App\Services\Owner\ProductService;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        return view('owner.products.index');
    }

    public function data()
    {
        return $this->productService->datatable();
    }

    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        $units = Unit::where('is_active', 1)->get();

        return view('owner.products.create', compact('categories', 'units'));
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->create($request->validated());

        Alert::success('Success', 'Product created successfully.');

        return redirect()->route('owner.products.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
