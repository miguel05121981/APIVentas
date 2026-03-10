<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'name',
        'segment',
        'orden',
        'parent_id',
        'user_create',
        'user_update',
    ];

    protected $hidden = [
        'parent',
        'children',
        'creator',
        'updater'
    ];

    protected $casts = [
        'orden' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // 🔹 Relación padre (self reference)
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // 🔹 Relación hijos
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')
                    ->orderBy('orden');
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
