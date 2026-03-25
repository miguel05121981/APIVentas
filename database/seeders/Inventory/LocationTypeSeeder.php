<?php

namespace Database\Seeders\Inventory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Inventory\LocationType;
use Illuminate\Support\Facades\DB;

class LocationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LocationType::updateOrCreate(
            ['name' => 'Office'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );

        LocationType::updateOrCreate(
            ['name' => 'Warehouse'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );

        LocationType::updateOrCreate(
            ['name' => 'Store'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
        LocationType::updateOrCreate(
            ['name' => 'Data Center'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
    }
}
