<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return view('owner.products.index');
    }

    public function data()
    {
        return 'data';
    }

    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();

        return view('owner.products.create', compact('categories', 'units'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
