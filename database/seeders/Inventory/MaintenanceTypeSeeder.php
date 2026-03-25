<?php

namespace Database\Seeders\Inventory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Inventory\MaintenanceType;
use Illuminate\Support\Facades\DB;

class MaintenanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaintenanceType::updateOrCreate(
            ['name' => 'Preventive'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
        MaintenanceType::updateOrCreate(
            ['name' => 'Corrective'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
        MaintenanceType::updateOrCreate(
            ['name' => 'Predictive'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
        MaintenanceType::updateOrCreate(
            ['name' => 'Inspection'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
    }
}
