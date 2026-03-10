<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {

            // =============================
            // MENÚ CONFIGURACIÓN
            // =============================
            $configuracion = Menu::firstOrCreate(
                ['segment' => 'setings', 'name' => 'Configuraciòn', 'parent_id' => null],
                [
                    'orden' => 1,
                    'user_create' => 1,
                    'user_update' => 1,
                ]
            );

            Menu::firstOrCreate(
                ['segment' => 'users', 'name' => 'Usuarios', 'parent_id' => $configuracion->id],
                [
                    'orden' => 1,
                    'user_create' => 1,
                    'user_update' => 1,
                ]
            );

            Menu::firstOrCreate(
                ['segment' => 'menus', 'name' => 'Menus', 'parent_id' => $configuracion->id],
                [
                    'orden' => 2,
                    'user_create' => 1,
                    'user_update' => 1,
                ]
            );

            // =============================
            // MENÚ INVENTARIO
            // =============================
            $inventario = Menu::firstOrCreate(
                ['segment' => 'inventories', 'name' => 'Inventario', 'parent_id' => null],
                [
                    'orden' => 2,
                    'user_create' => 1,
                    'user_update' => 1,
                ]
            );

            Menu::firstOrCreate(
                ['segment' => 'dashboard', 'name' => 'Dashboard', 'parent_id' => $inventario->id],
                [
                    'orden' => 1,
                    'user_create' => 1,
                    'user_update' => 1,
                ]
            );

            Menu::firstOrCreate(
                ['segment' => 'inform', 'name' => 'Informes', 'parent_id' => $inventario->id],
                [
                    'orden' => 1,
                    'user_create' => 1,
                    'user_update' => 1,
                ]
            );

            Menu::firstOrCreate(
                ['segment' => 'computers', 'name' => 'Gestiòn De Equipos', 'parent_id' => $inventario->id],
                [
                    'orden' => 2,
                    'user_create' => 1,
                    'user_update' => 1,
                ]
            );

        });
    }
}
