<?php

namespace App\Services\Superadmin;

use App\Models\Tenant;
use App\Services\CodeGeneratorService;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TenantService
{
    private CodeGeneratorService $codeGeneratorService;

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

            return Tenant::create([
                'code'      => $this->generateCode($data['name']),
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
        if ($tenant->branches()->exists()) {
            throw new \Exception('Tenant cannot be deleted because it still has branches.');
        }

        $tenant->delete();
    }

    protected function generateCode(string $name): string
    {
        $prefix = strtoupper(
            Str::substr(
                Str::of($name)->replace(' ', ''),
                0,
                3
            )
        );

        $number = Tenant::withTrashed()
            ->where('code', 'like', $prefix . '%')->count() + 1;

        return sprintf('%s%03d', $prefix, $number);
    }
}
