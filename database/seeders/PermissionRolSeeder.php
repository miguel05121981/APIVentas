<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionRolSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $admin = Rol::where('name', 'SuperAdmin')->first();
            $supervisor = Rol::where('name', 'Admin')->first();
            $operador = Rol::where('name', 'Operador')->first();
            $cliente = Rol::where('name', 'Cliente')->first();

            $permissions = Permission::all();

            /*
            |--------------------------------------------------------------------------
            | ADMINISTRADOR → TODOS LOS PERMISOS
            |--------------------------------------------------------------------------
            */
            if ($admin) {
                foreach ($permissions as $permission) {
                    $admin->permissions()->syncWithoutDetaching([
                        $permission->id => [
                            'user_create' => 1,
                            'user_update' => 1,
                        ]
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | SUPERVISOR → view, create, update
            |--------------------------------------------------------------------------
            */
            if ($supervisor) {
                $filtered = $permissions->whereIn('action', ['view', 'create', 'update']);

                foreach ($filtered as $permission) {
                    $supervisor->permissions()->syncWithoutDetaching([
                        $permission->id => [
                            'user_create' => 1,
                            'user_update' => 1,
                        ]
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | OPERADOR → solo view
            |--------------------------------------------------------------------------
            */
            if ($operador) {
                $filtered = $permissions->where('action', 'view');

                foreach ($filtered as $permission) {
                    $operador->permissions()->syncWithoutDetaching([
                        $permission->id => [
                            'user_create' => 1,
                            'user_update' => 1,
                        ]
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | CLIENTE → solo view del Dashboard
            |--------------------------------------------------------------------------
            */
            if ($cliente) {
                $dashboardPermissions = Permission::whereHas('menu', function ($query) {
                    $query->where('name', 'Dashboard');
                })
                ->where('action', 'view')
                ->get();

                foreach ($dashboardPermissions as $permission) {
                    $cliente->permissions()->syncWithoutDetaching([
                        $permission->id => [
                            'user_create' => 1,
                            'user_update' => 1,
                        ]
                    ]);
                }
            }
        });
    }
}
