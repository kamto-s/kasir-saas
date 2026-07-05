<?php

namespace App\Services\Superadmin;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoryService
{
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

            $data['code'] = $this->generateCode();

            return Category::create($data);
        });
    }

    public function update(Category $category, array $data): Category
    {
        return DB::transaction(function () use ($category, $data) {

            if ($data['is_main']) {
                Category::where('tenant_id', $category->tenant_id)
                    ->whereKeyNot($category->id)
                    ->update([
                        'is_main' => false,
                    ]);
            }

            $category->update($data);

            return $category;
        });
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }

    protected function generateCode(): string
    {
        $tenantId = Auth::user()->tenant_id;

        $last = Category::withTrashed()
            ->where('tenant_id', $tenantId)
            ->latest()
            ->first();

        $number = 1;

        if ($last) {

            $number = (int) substr($last->code, 3) + 1;
        }

        return 'CAT' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}
