<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Model::unguard(); // Disable mass assignment

        //company seeder with admin & super admin
        $this->call(CompanyPermissionSeeder::class);
        $this->call(CompanyRoleSeeder::class);

        //role seeder with admin & super admin
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);

        //creating Admins
        $this->call(UserSeeder::class);

        //creating company
        $this->call(CompanySeeder::class);

        Model::reguard(); // Enable mass assignment
    }
}
