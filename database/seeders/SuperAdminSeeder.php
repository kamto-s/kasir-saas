<?php

namespace Database\Seeders;

use App\Enums\RoleCode;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('code', RoleCode::SUPER_ADMIN->value)->firstOrFail();

        User::updateOrCreate(
            ['email' => 'kamto.076s@gmail.com'],
            [
                'tenant_id' => null,
                'branch_id' => null,
                'role_id' => $role->id,
                'name' => 'Super Admin',
                'phone' => null,
                'password' => Hash::make('Admin@123'),
                'is_active' => true,
            ]
        );
    }
}
