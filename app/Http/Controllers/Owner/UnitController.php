<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\unit\StoreUnitRequest;
use App\Http\Requests\Owner\unit\UpdateUnitRequest;
use App\Models\Unit;
use App\Services\Owner\UnitService;
use RealRashid\SweetAlert\Facades\Alert;

class UnitController extends Controller
{

    private UnitService $unitService;

    public function __construct()
    {
        $this->unitService = new UnitService();
    }

    public function index()
    {
        $title = 'Delete Unit';
        $text = 'Are you sure you want to delete this unit?';

        confirmDelete($title, $text);

        return view('owner.units.index');
    }

    public function data()
    {
        return $this->unitService->datatable();
    }

    public function create()
    {
        return view('owner.units.create');
    }

    public function store(StoreUnitRequest $request)
    {
        $this->unitService->create($request->validated());

        Alert::success('Success', 'Unit created successfully.');

        return redirect()->route('owner.units.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Unit $unit)
    {
        return view('owner.units.edit', compact('unit'));
    }

    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        $this->unitService->update($unit, $request->validated());

        Alert::success('Success', 'Unit updated successfully.');

        return redirect()->route('owner.units.index');
    }

    public function destroy(Unit $unit)
    {
        $this->unitService->delete($unit);

        Alert::success('Success', 'Unit deleted successfully.');

        return redirect()->route('owner.units.index');
    }
}
