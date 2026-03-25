<?php

namespace Database\Seeders\Inventory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Inventory\DevicesType;
use Illuminate\Support\Facades\DB;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DevicesType::updateOrCreate(
            ['name' => 'Laptop'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
        
        DevicesType::updateOrCreate(
            ['name' => 'Desktop'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
        
        DevicesType::updateOrCreate(
            ['name' => 'Printer'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
    }
}