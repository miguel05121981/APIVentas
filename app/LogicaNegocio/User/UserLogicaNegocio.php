<?php
namespace App\LogicaNegocio\User;

use App\LogicaNegocio\LogicaNegocio;

use App\Services\User\UserService;

class UserLogicaNegocio extends LogicaNegocio
{
    protected $reglaCrear = [
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'email' => 'required|string|email|max:100|unique:users,email',
        'name' => 'required|string|max:100|unique:users,name',
        'password' => 'required|string|max:20',
        'rol_id' => 'required|integer'
    ];

    protected $reglaActualizar = [
        'first_name' => 'sometimes|required|string|max:100',
        'last_name' => 'sometimes|required|string|max:100',
        'email' => 'sometimes|required|string|email|max:100|unique:users,email',
        'name' => 'sometimes|required|string|max:100|unique:users,name',
        'password' => 'sometimes|required|string|max:20',
        'rol_id' => 'sometimes|required|integer'
    ];

    public function __construct()
    {
        parent::__construct(new UserService(), $this->reglaCrear, $this->reglaActualizar);
    }
}