<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class DevicesType extends Model
{
    protected $table = 'devices_type';

    protected $fillable = [
        'name',
        'user_create',
        'user_update',
        'active'
    ];
    public function userCreate()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'user_update');
    }
}
