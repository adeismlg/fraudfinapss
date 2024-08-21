<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CompanyPermissionSeeder extends Seeder
{
    private $guard = "web";

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //company
            [
                'name' => 'company.view',
                'guard_name' => $this->guard,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'company.view.all',
                'guard_name' => $this->guard,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'company.create',
                'guard_name' => $this->guard,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'company.update',
                'guard_name' => $this->guard,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'company.delete',
                'guard_name' => $this->guard,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::insert($permissions);
    }
}
