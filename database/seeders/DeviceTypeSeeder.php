<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('devices_type')->insert([
            [
                'name' => 'Laptop',
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Desktop',
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Printer',
                'user_create' => 1,
                'user_update' => 1,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
            ]);
    }
}
