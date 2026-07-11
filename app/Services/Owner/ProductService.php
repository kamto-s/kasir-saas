<?php

namespace App\Services\Owner;

use App\Models\Product;
use App\Services\CodeGeneratorService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProductService
{
    protected CodeGeneratorService $codeGeneratorService;

    public function __construct()
    {
        $this->codeGeneratorService = new CodeGeneratorService();
    }

    public function datatable()
    {
        return DataTables::eloquent(
            Product::query()
                ->with('category')
                ->where('tenant_id', Auth::user()->tenant_id)
                ->latest()
        )
            ->addIndexColumn()
            ->addColumn('category', function ($row) {
                return $row->category->name ?? '-';
            })
            ->editColumn('is_active', function ($row) {
                return $row->is_active
                    ? '<span class="badge bg-success" style="width: 70px !important">Active</span>'
                    : '<span class="badge bg-danger" style="width: 70px !important">Inactive</span>';
            })
            ->addColumn('action', function ($row) {
                return view('owner.products.action', compact('row'));
            })
            ->rawColumns(['is_active', 'action'])
            ->make(true);
    }

    public function create(array $data): Product
    {
        return DB::transaction(function () use ($data) {

            $tenantId = Auth::user()->tenant_id;
            if (isset($data['image'])) {
                $data['image'] = $data['image']->store('products', 'public');
            }

            $product = Product::create([
                'tenant_id'     => $tenantId,
                'category_id'   => $data['category_id'],
                'code'          => $this->codeGeneratorService->generate(Product::class, 'PRD'),
                'name'          => $data['name'],
                'description'   => $data['description'],
                'image'         => $data['image'] ?? null,
                'stock'         => 0,
                'is_active'     => $data['is_active'],
            ]);

            foreach ($data['units'] as $unit) {
                $product->productUnits()->create([
                    'tenant_id'             => $tenantId,
                    'unit_id'               => $unit['unit_id'],
                    'barcode'               => !empty($unit['barcode']) ? $unit['barcode'] : null,
                    'purchase_price'        => $unit['purchase_price'],
                    'selling_price'         => $unit['selling_price'],
                    'conversion'            => $unit['conversion'],
                    'is_base'               => isset($unit['is_base']),
                    'is_default_purchase'   => isset($unit['is_default_purchase']),
                    'is_default_sale'       => isset($unit['is_default_sale']),
                    'is_active'             => isset($unit['is_active']),
                    'sort_order'            => $unit['sort_order'],
                ]);
            }

            return $product;
        });
    }

    public function update(Product $product, array $data): Product
    {
        return DB::transaction(function () use ($product, $data) {

            $data['symbol'] = strtoupper($data['symbol']);

            $product->update($data);

            return $product;
        });
    }

    public function delete(Product $product): void
    {
        // if ($unit->branches()->exists()) {
        //     throw new \Exception('Tenant cannot be deleted because it still has branches.');
        // }

        $product->delete();
    }
}
