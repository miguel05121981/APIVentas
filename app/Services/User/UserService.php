<?php
namespace App\Services\User;

use App\Models\User;
use App\Services\Service;
use Illuminate\Support\Facades\Hash;

class UserService extends Service
{
    protected $searchColumns = ['name', 'first_name', 'last_name', 'email'];

    public function __construct() {
        parent::__construct(User::class, $this->searchColumns);
    }

    public function armarCuerpo($objeto, $array) {
        isset($array['name']) ? $objeto->name = $array['name'] : null;
        isset($array['password']) ? $objeto->password = Hash::make($array['password']) : null;
        isset($array['first_name']) ? $objeto->first_name = $array['first_name'] : null;
        isset($array['last_name']) ? $objeto->last_name = $array['last_name'] : null;
        isset($array['email']) ? $objeto->email = $array['email'] : null;
        isset($array['rol_id']) ? $objeto->rol_id = $array['rol_id'] : null;

        $objeto->email_verified_at = now();
    }

    public function obtenerXemail($email)
    {
        return User::where('email', $email)->first();
    }
}