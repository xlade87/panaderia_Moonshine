<?php

namespace App\Policies;

use App\Models\Bill;
use MoonShine\Models\MoonshineUser;

class BillPolicy
{
    /*
    Admin puede hacer todo
    */
    public function before(MoonshineUser $user, string $ability): ?bool
    {
        if ($user->moonshine_user_role_id == 1) {
            return true;
        }
        return null;
    }

    /* Ver lista de facturas */
    public function viewAny(MoonshineUser $user): bool
    {
        return true; // Todos pueden ver
    }

    /* Ver detalle */
    public function view(MoonshineUser $user, Bill $bill): bool
    {
        return true; // Todos pueden ver
    }

    /*
    * Crear facturas
    */
    public function create(MoonshineUser $user): bool
    {
        // Admin (1) y Coordinador (2) pueden crear
        return in_array($user->moonshine_user_role_id, [1, 2]);
    }

    /**
    * Editar facturas
    */
    public function update(MoonshineUser $user, Bill $bill): bool
    {
        // Admin (1) y Coordinador (2) pueden editar
        return in_array($user->moonshine_user_role_id, [1, 2]);
    }

    /**
    * Eliminar facturas
    */
    public function delete(MoonshineUser $user, Bill $bill): bool
    {
        // Solo Admin (1) puede eliminar
        return $user->moonshine_user_role_id == 1;
    }

    /**
    * Restaurar facturas
    */
    public function restore(MoonshineUser $user, Bill $bill): bool
    {
        return $user->moonshine_user_role_id == 1;
    }

    /**
    * Eliminación permanente
    */
    public function forceDelete(MoonshineUser $user, Bill $bill): bool
    {
        return $user->moonshine_user_role_id == 1;
    }

    /**
    * Eliminación masiva
    */
    public function massDelete(MoonshineUser $user): bool
    {
        return $user->moonshine_user_role_id == 1;
    }
}