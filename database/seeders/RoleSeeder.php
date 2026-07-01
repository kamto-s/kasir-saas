<?php

namespace Database\Seeders;

use App\Enums\RoleCode;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'code' => RoleCode::SUPER_ADMIN->value,
                'name' => 'Super Admin',
                'level' => 100,
                'description' => 'System Administrator',
                'is_active' => true,
            ],
            [
                'code' => RoleCode::OWNER->value,
                'name' => 'Owner',
                'level' => 80,
                'description' => 'Store Owner',
                'is_active' => true,
            ],
            [
                'code' => RoleCode::CASHIER->value,
                'name' => 'Cashier',
                'level' => 10,
                'description' => 'Cashier',
                'is_active' => true,
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['code' => $role['code']],
                $role
            );
        }
    }
}
