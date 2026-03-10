<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    protected $table = 'devices_type';

    protected $fillable = [
        'name',
        'user_create',
        'user_update',
        'active'
    ];
}
