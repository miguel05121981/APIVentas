<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'menu_id',
        'action',
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

    // 🔹 Permiso pertenece a un menú
    public function menu()
    {
        return $this->belongsTo(Menu::class);
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

    public function scopeByAction($query, string $action)
    {
        return $query->where('action', $action);
    }
}
