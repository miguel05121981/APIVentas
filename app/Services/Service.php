<?php

namespace App\Services;

use Illuminate\Support\Facades\Schema;

abstract class Service
{
    abstract protected function armarCuerpo($objeto, array $array);

    protected $searchColumns = [];
    protected $model;

    protected function __construct($modeloClase, $searchColumns) {
        $this->model = app($modeloClase);
        $this->searchColumns = $searchColumns;
    }

    public function obtenerXId($id)
    {
        return $this->model::find($id);
    }

    public function eliminar($id)
    {
        $objetoLicencia = $this->model::find($id);
        if ($objetoLicencia) {
            $objetoLicencia->delete();
        }

        return $objetoLicencia;
    }

    public function todo($usuario, $ordenar, $tamaño = 0, $buscar = null)
    {
        $model = $this->model;
        $tabla = $model::query();
        $isSuperAdmin = false;
        if (!$isSuperAdmin && $usuario) {
            $tabla->where(function ($query) use ($usuario, $model) {
                if (Schema::hasColumn((new $model)->getTable(), 'user_create')) {
                    $query->where('user_create', $usuario->id);
                }

                if (Schema::hasColumn((new $model)->getTable(), 'user_update')) {
                    $query->orWhere('user_update', $usuario->id);
                }
            });
        }

        $searchColumns = $this->searchColumns;

        if (!empty($buscar)) {
            $tabla->where(function ($q) use ($buscar, $searchColumns) {
                foreach ($searchColumns as $columna) {
                    $q->orWhere($columna, 'like', "%{$buscar}%");
                }
            });
        }

        $sorts = explode(',', $ordenar);
        foreach ($sorts as $sort) {
            [$column, $direction] = explode(':', $sort) + [null, 'asc'];
            if (in_array($column, $searchColumns) && in_array(strtolower($direction), ['asc', 'desc'])) {
                $tabla->orderBy($column, $direction);
            }
        }

        return $tabla->paginate($tamaño);
        // return $tamaño > 0
        //     ? $tabla->paginate($tamaño)
        //     : $tabla->get();
        //return tabla::all();
    }

    public function crear(array $array, $usuario = null)
    {
        $objeto = new $this->model();
        $this->armarCuerpo($objeto, $array);
        isset($usuario) ? $objeto->user_create = $usuario->id : null;
        $objeto->save();

        return $objeto;
    }

    public function actualizar($id, array $array, $usuario = null)
    {
        $objeto = $this->model::find($id);
        $this->armarCuerpo($objeto, $array);
        isset($usuario) ? $objeto->user_update = $usuario->id : null;
        $objeto->save();

        return $objeto;
    }
}