<?php

namespace App\Services\Superadmin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function datatable()
    {
        return DataTables::eloquent(User::query()->latest())
            ->addIndexColumn()
            ->addColumn('tenant', fn($row) => $row->tenant?->name ?? '-')
            ->addColumn('branch', fn($row) => $row->branch?->name ?? '-')
            ->addColumn('role', fn($row) => $row->role?->name ?? '-')
            ->editColumn('is_active', function ($row) {
                return $row->is_active
                    ? '<span class="badge bg-success" style="width: 70px !important">Active</span>'
                    : '<span class="badge bg-danger" style="width: 70px !important">Inactive</span>';
            })
            ->addColumn('action', function ($row) {
                return view('super-admin.users.action', compact('row'));
            })
            ->rawColumns(['is_active', 'action'])
            ->make(true);
    }

    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {

            $data['password'] = Hash::make($data['password']);

            return User::create($data);
        });
    }

    public function update(User $user, array $data): User
    {
        return DB::transaction(function () use ($user, $data) {

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            return $user;
        });
    }

    public function delete(User $user): void
    {
        if ($user->id == Auth::user()->id) {
            throw new \Exception('You cannot delete your own account.');
        }

        $user->delete();
    }
}
