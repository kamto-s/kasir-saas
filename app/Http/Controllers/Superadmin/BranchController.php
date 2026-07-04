<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\superadmin\branch\StoreBranchRequest;
use App\Http\Requests\superadmin\branch\UpdateBranchRequest;
use App\Models\Branch;
use App\Models\Tenant;
use App\Services\Superadmin\BranchService;
use RealRashid\SweetAlert\Facades\Alert;

class BranchController extends Controller
{
    private BranchService $branchService;

    public function __construct()
    {
        $this->branchService = new BranchService();
    }

    public function index()
    {
        $title = 'Delete Branch';
        $text = 'Are you sure you want to delete this branch?';

        confirmDelete($title, $text);

        return view('super-admin.branches.index');
    }

    public function data()
    {
        return $this->branchService->datatable();
    }

    public function create()
    {
        $tenants = Tenant::orderBy('name')->get();

        return view('super-admin.branches.create', compact('tenants'));
    }

    public function store(StoreBranchRequest $request)
    {
        $this->branchService->create($request->validated());

        Alert::success('Success', 'Branch created successfully.');

        return redirect()->route('super-admin.branches.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Branch $branch)
    {
        $tenants = Tenant::orderBy('name')->get();

        return view('super-admin.branches.edit', compact('branch', 'tenants'));
    }

    public function update(UpdateBranchRequest $request, branch $branch)
    {
        $this->branchService->update($branch, $request->validated());

        Alert::success('Success', 'Branch updated successfully.');

        return redirect()->route('super-admin.branches.index');
    }

    public function destroy(Branch $branch)
    {
        try {

            $this->branchService->delete($branch);

            Alert::success('Success', 'Branch deleted successfully.');
        } catch (\Exception $e) {
            Alert::error('Failed', $e->getMessage());
        }

        return redirect()->route('super-admin.branches.index');
    }
}
