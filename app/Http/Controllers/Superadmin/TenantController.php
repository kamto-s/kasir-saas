<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Superadmin\Tenant\StoreTenantRequest;
use App\Http\Requests\Superadmin\Tenant\UpdateTenantRequest;
use App\Models\Tenant;
use App\Services\Superadmin\TenantService;
use RealRashid\SweetAlert\Facades\Alert;

class TenantController extends Controller
{
    private TenantService $tenantService;

    public function __construct()
    {
        $this->tenantService = new TenantService();
    }

    public function index()
    {
        $title = 'Delete Tenant';
        $text = 'Are you sure you want to delete this tenant?';

        confirmDelete($title, $text);

        return view('super-admin.tenants.index');
    }

    public function data()
    {
        return $this->tenantService->datatable();
    }

    public function create()
    {
        return view('super-admin.tenants.create');
    }

    public function store(StoreTenantRequest $request)
    {
        $this->tenantService->create($request->validated());

        Alert::success('Success', 'Tenant created successfully.');

        return redirect()->route('super-admin.tenants.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Tenant $tenant)
    {
        return view('super-admin.tenants.edit', compact('tenant'));
    }

    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {
        $this->tenantService->update(
            $tenant,
            $request->validated()
        );

        Alert::success('Success', 'Tenant updated successfully.');

        return redirect()->route('super-admin.tenants.index');
    }

    public function destroy(Tenant $tenant)
    {
        try {
            $this->tenantService->delete($tenant);

            Alert::success('Success', 'Tenant deleted successfully.');
        } catch (\Throwable $e) {
            Alert::error('Failed', $e->getMessage());
        }

        return redirect()->route('super-admin.tenants.index');
    }
}
