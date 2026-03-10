<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionRol extends Model
{
    use HasFactory;

    protected $table = 'permission_rol';

    protected $fillable = [
        'rol_id',
        'permission_id',
        'user_create',
        'user_update',
    ];

    protected $hidden = [
        'creator',
        'updater'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // 🔹 Pertenece a un Rol
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    // 🔹 Pertenece a un Permiso
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    // 🔹 Usuario creador
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    // 🔹 Usuario actualizador
    public function updater()
    {
        return $this->belongsTo(User::class, 'user_update');
    }
}