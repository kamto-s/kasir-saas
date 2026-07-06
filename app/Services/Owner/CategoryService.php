<?php

namespace App\Services\Owner;

use App\Models\Category;
use App\Services\CodeGeneratorService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryService
{
    protected CodeGeneratorService $codeGeneratorService;

    public function __construct()
    {
        $this->codeGeneratorService = new CodeGeneratorService();
    }

    public function datatable()
    {
        return DataTables::eloquent(Category::query()->where('tenant_id', Auth::user()->tenant_id)->latest())
            ->addIndexColumn()
            ->editColumn('is_active', function ($row) {
                return $row->is_active
                    ? '<span class="badge bg-success" style="width: 70px !important">Active</span>'
                    : '<span class="badge bg-danger" style="width: 70px !important">Inactive</span>';
            })
            ->addColumn('action', function ($row) {
                return view('owner.categories.action', compact('row'));
            })
            ->rawColumns(['is_active', 'action'])
            ->make(true);
    }

    public function create(array $data): Category
    {
        return DB::transaction(function () use ($data) {

            $data['tenant_id'] = Auth::user()->tenant_id;

            $data['code'] = $this->codeGeneratorService->generate(Category::class, 'CAT');

            return Category::create($data);
        });
    }

    public function update(Category $category, array $data): Category
    {
        return DB::transaction(function () use ($category, $data) {

            $category->update($data);

            return $category;
        });
    }

    public function delete(Category $category): void
    {
        // if ($category->branches()->exists()) {
        //     throw new \Exception('Tenant cannot be deleted because it still has branches.');
        // }

        $category->delete();
    }
}
