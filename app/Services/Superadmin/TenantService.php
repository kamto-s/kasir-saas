<?php

namespace App\Services\Superadmin;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TenantService
{
    public function datatable()
    {
        return DataTables::eloquent(Tenant::query())
            ->addIndexColumn()
            ->editColumn('is_active', function ($row) {
                return $row->is_active
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
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

            return Tenant::create([
                'code'      => strtoupper($data['code']),
                'name'      => $data['name'],
                'email'     => $data['email'] ?? null,
                'phone'     => $data['phone'] ?? null,
                'logo'      => $data['logo'] ?? null,
                'is_active' => $data['is_active'],
            ]);
        });
    }

    public function update(Tenant $tenant, array $data): Tenant
    {
        $tenant->update([
            'code'      => strtoupper($data['code']),
            'name'      => $data['name'],
            'email'     => $data['email'] ?? null,
            'phone'     => $data['phone'] ?? null,
            'logo'      => $data['logo'] ?? null,
            'is_active' => $data['is_active'],
        ]);

        return $tenant;
    }

    public function delete(Tenant $tenant): void
    {
        $tenant->delete();
    }
}
