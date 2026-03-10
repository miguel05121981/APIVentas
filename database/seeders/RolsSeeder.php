<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'SuperAdmin',
            'Admin',
            'Operador',
            'Cliente',
        ];

        foreach ($roles as $role) {
            Rol::firstOrCreate(
                ['name' => $role]
            );
        }
    }
}
