<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\superadmin\User\StoreUserRequest;
use App\Http\Requests\superadmin\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Superadmin\UserService;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        $title = 'Delete User';
        $text = 'Are you sure you want to delete this user?';

        confirmDelete($title, $text);

        return view('super-admin.users.index');
    }

    public function data()
    {
        return $this->userService->datatable();
    }

    public function create()
    {
        $tenants = Tenant::where('is_active', true)
            ->orderBy('name')->get();

        $roles = Role::orderBy('name')->get();

        return view('super-admin.users.create', compact('tenants', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->create($request->validated());

        Alert::success('Success', 'User created successfully.');

        return redirect()->route('super-admin.users.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(User $user)
    {
        $tenants = Tenant::where('is_active', true)->orderBy('name')->get();

        $roles = Role::where('is_active', true)->orderBy('name')->get();

        return view('super-admin.users.edit', compact('user', 'tenants', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->update($user, $request->validated());

        Alert::success('Success', 'User updated successfully.');

        return redirect()->route('super-admin.users.index');
    }

    public function destroy(User $user)
    {
        $this->userService->delete($user);

        Alert::success('Success', 'User deleted successfully.');

        return redirect()->route('super-admin.users.index');
    }
}
