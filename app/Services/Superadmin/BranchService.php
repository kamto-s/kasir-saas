<?php

namespace App\Services\Superadmin;

use App\Models\Branch;
use App\Services\CodeGeneratorService;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BranchService
{
    protected CodeGeneratorService $codeGeneratorService;

    public function __construct()
    {
        $this->codeGeneratorService = new CodeGeneratorService();
    }

    public function datatable()
    {
        return DataTables::eloquent(Branch::query()->with('tenant')->latest())
            ->addIndexColumn()
            ->addColumn('tenant', function ($row) {
                return $row->tenant ? $row->tenant->name : '-';
            })
            ->editColumn('name', function ($row) {
                $html = e($row->name);

                if ($row->is_main) {
                    $html .= '
                    <span class="border badge bg-primary-subtle text-primary ms-2">
                        Main
                    </span>';
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

            $data['is_main'] = ! Branch::where('tenant_id', $data['tenant_id'])->exists();

            $data['code'] = $this->codeGeneratorService->generate(Branch::class, 'BRC');

            return Branch::create($data);
        });
    }

    public function update(Branch $branch, array $data): Branch
    {
        return DB::transaction(function () use ($branch, $data) {

            if ($data['is_main']) {
                Branch::where('tenant_id', $branch->tenant_id)
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
}
