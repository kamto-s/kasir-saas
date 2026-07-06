<?php

namespace App\Services\Owner;

use App\Models\Unit;
use App\Services\CodeGeneratorService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UnitService
{
    protected CodeGeneratorService $codeGeneratorService;

    public function __construct()
    {
        $this->codeGeneratorService = new CodeGeneratorService();
    }

    public function datatable()
    {
        return DataTables::eloquent(Unit::query()->where('tenant_id', Auth::user()->tenant_id)->latest())
            ->addIndexColumn()
            ->editColumn('is_active', function ($row) {
                return $row->is_active
                    ? '<span class="badge bg-success" style="width: 70px !important">Active</span>'
                    : '<span class="badge bg-danger" style="width: 70px !important">Inactive</span>';
            })
            ->addColumn('action', function ($row) {
                return view('owner.units.action', compact('row'));
            })
            ->rawColumns(['is_active', 'action'])
            ->make(true);
    }

    public function create(array $data): Unit
    {
        return DB::transaction(function () use ($data) {

            $data['tenant_id'] = Auth::user()->tenant_id;

            $data['code'] = $this->codeGeneratorService->generate(Unit::class, 'UNT');

            $data['symbol'] = strtoupper($data['symbol']);

            return Unit::create($data);
        });
    }

    public function update(Unit $unit, array $data): Unit
    {
        return DB::transaction(function () use ($unit, $data) {

            $data['symbol'] = strtoupper($data['symbol']);

            $unit->update($data);

            return $unit;
        });
    }

    public function delete(Unit $unit): void
    {
        // if ($unit->branches()->exists()) {
        //     throw new \Exception('Tenant cannot be deleted because it still has branches.');
        // }

        $unit->delete();
    }
}
