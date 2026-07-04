<?php

namespace App\Services\Superadmin;

use App\Models\Branch;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BranchService
{
    public function datatable()
    {
        return DataTables::eloquent(Branch::query()->latest())
            ->addIndexColumn()
            ->addColumn('tenant', function ($row) {
                return $row->tenant->name;
            })
            ->editColumn('name', function ($row) {
                $html = e($row->name);

                if ($row->is_main) {
                    if ($row->is_main) {
                        $html .= '
                                <span class="badge bg-primary-subtle text-primary border ms-2">
                                    Main
                                </span>';
                    }
                }

                return $html;
            })
            ->editColumn('is_active', function ($row) {
                return $row->is_active
                    ? '<span class="badge bg-success" style="width: 70px !important">Active</span>'
                    : '<span class="badge bg-danger" style="width: 70px !important">Inactive</span>';
            })
            ->addColumn('action', function ($row) {
                return view('super-admin.branches.action', compact('row'));
            })
            ->rawColumns(['name', 'is_active', 'action'])
            ->make(true);
    }

    public function create(array $data): Branch
    {
        return DB::transaction(function () use ($data) {

            if ($data['is_main']) {
                Branch::where('tenant_id', $data['tenant_id'])
                    ->update([
                        'is_main' => false,
                    ]);
            }

            $data['code'] = $this->generateCode($data['tenant_id']);

            return Branch::create($data);
        });
    }

    public function update(Branch $branch, array $data): Branch
    {
        return DB::transaction(function () use ($branch, $data) {

            if ($data['is_main']) {
                Branch::where('tenant_id', $data['tenant_id'])
                    ->whereKeyNot($branch->id)
                    ->update([
                        'is_main' => false,
                    ]);
            }

            $branch->update($data);

            return $branch;
        });
    }

    public function delete(Branch $branch): void
    {
        if ($branch->is_main) {
            throw new \Exception('Main branch cannot be deleted.');
        }

        $branch->delete();
    }

    protected function generateCode(string $tenantId): string
    {
        $tenant = Tenant::findOrFail($tenantId);

        $last = Branch::where('tenant_id', $tenantId)
            ->orderByDesc('code')
            ->first();

        $number = 1;

        if ($last) {
            $number = (int) substr($last->code, -3) + 1;
        }

        return sprintf(
            '%s-B%03d',
            $tenant->code,
            $number
        );
    }
}
