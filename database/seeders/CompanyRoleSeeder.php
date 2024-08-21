<?php

namespace Database\Seeders;

use App\Http\Traits\UserTrait;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CompanyRoleSeeder extends Seeder
{
    use UserTrait;
    private $guard = "web";

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Super Admin Role
        $superAdmin = Role::where('name', $this->SUPER_ADMIN)->first();
        if ($superAdmin) {
            $superAdmin->givePermissionTo([
                'company.view',
                'company.view.all',
                'company.create',
                'company.update',
                'company.delete',
            ]);
        }

        // Admin Role
        $admin = Role::where('name', $this->ADMIN)->first();
        if ($admin) {
            $admin->givePermissionTo([
                'company.view.all',
                'company.view',
                'company.update',
            ]);
        }

        // User Role
        $user = Role::where('name', $this->USER)->first();
        if ($user) {
            $user->givePermissionTo([
                'company.view',
            ]);
        }
    }
}
