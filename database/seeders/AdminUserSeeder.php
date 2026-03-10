<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'edwin.velasquez@novacodesoft.com'],
            [
                'rol_id' => 1,
                'company_id' => 1,
                'name' => '@edwin.velasquez',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
                'first_name' => 'Edwin',
                'last_name' => 'Velasquez Jimenez',
            ]
        );

        User::updateOrCreate(
            ['email' => 'miguel.castaneda@novacodesoft.com'],
            [
                'rol_id' => 1,
                'company_id' => 1,
                'name' => '@miguel.castañeda',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
                'first_name' => 'Miguel',
                'last_name' => 'Castañeda Duran',
            ]
        );
    }
}
