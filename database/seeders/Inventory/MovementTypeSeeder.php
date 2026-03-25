<?php

namespace Database\Seeders\Inventory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Inventory\MovementType;
use Illuminate\Support\Facades\DB;

class MovementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MovementType::updateOrCreate(
            ['name' => 'Entry'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
        MovementType::updateOrCreate(
            ['name' => 'Exit'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
        MovementType::updateOrCreate(
            ['name' => 'Transfer'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
        MovementType::updateOrCreate(
            ['name' => 'Adjustment'],
            [
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
            ]
        );
    }
}
