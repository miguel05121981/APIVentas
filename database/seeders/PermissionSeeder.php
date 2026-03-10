<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $actions = ['view', 'create', 'update', 'delete'];

            // Obtener todos los menús hijos (los que realmente tienen acciones)
            $menus = Menu::whereNotNull('parent_id')->get();

            foreach ($menus as $menu) {

                foreach ($actions as $action) {

                    Permission::firstOrCreate(
                        [
                            'menu_id' => $menu->id,
                            'action' => $action,
                        ],
                        [
                            'user_create' => 1,
                            'user_update' => 1,
                        ]
                    );
                }
            }
        });
    }
}
