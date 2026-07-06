<?php

namespace App\Services\Superadmin;

use App\Models\Tenant;
use App\Services\CodeGeneratorService;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class TenantService
{
    protected CodeGeneratorService $codeGeneratorService;

    public function __construct()
    {
        $this->codeGeneratorService = new CodeGeneratorService();
    }

    public function datatable()
    {
        return DataTables::eloquent(Tenant::query()->latest())
            ->addIndexColumn()
            ->editColumn('is_active', function ($row) {
                return $row->is_active
                    ? '<span class="badge bg-success" style="width: 70px !important">Active</span>'
                    : '<span class="badge bg-danger" style="width: 70px !important">Inactive</span>';
            })
            ->addColumn('action', function ($row) {
                return view('super-admin.tenants.action', compact('row'));
            })
            ->rawColumns(['is_active', 'action'])
            ->make(true);
    }

    public function create(array $data): Tenant
    {
        return DB::transaction(function () use ($data) {

            if (isset($data['logo'])) {
                $data['logo'] = $data['logo']->store('tenants', 'public');
            }

            $data['code'] = $this->codeGeneratorService->generate(Tenant::class, 'TNT');

            return Tenant::create($data);
        });
    }

    public function update(Tenant $tenant, array $data): Tenant
    {
        return DB::transaction(function () use ($tenant, $data) {

            if (isset($data['logo'])) {
                if ($tenant->logo && Storage::disk('public')->exists($tenant->logo)) {
                    Storage::disk('public')->delete($tenant->logo);
                }

                $data['logo'] = $data['logo']->store('tenants', 'public');
            } else {
                $data['logo'] = $tenant->logo;
            }

            $tenant->update($data);

            return $tenant;
        });
    }

    public function delete(Tenant $tenant): void
    {
        if ($tenant->branches()->exists()) {
            throw new \Exception('Tenant cannot be deleted because it still has branches.');
        }

        $tenant->delete();
    }
}
