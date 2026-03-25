<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolsSeeder::class,
            CompanySeeder::class,
            AdminUserSeeder::class,
            MenuSeeder::class,
            PermissionSeeder::class,
            PermissionRolSeeder::class,
            Inventory\DeviceTypeSeeder::class,
            Inventory\LocationTypeSeeder::class,
            Inventory\MaintenanceTypeSeeder::class,
            Inventory\MovementTypeSeeder::class
        ]);
    }
}
