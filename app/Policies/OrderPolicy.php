<?php

namespace App\Policies;

use App\Models\Order;
use MoonShine\Models\MoonshineUser;

class OrderPolicy
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

    /* Ver lista de pedidos */
    public function viewAny(MoonshineUser $user): bool
    {
        return true; // Todos pueden ver
    }

    /* Ver detalle */
    public function view(MoonshineUser $user, Order $order): bool
    {
        return true; // Todos pueden ver
    }

    /*
    * Crear pedidos
    */
    public function create(MoonshineUser $user): bool
    {
        // Admin (1) y Coordinador (2) pueden crear
        return in_array($user->moonshine_user_role_id, [1, 2]);
    }

    /**
    * Editar pedidos
    */
    public function update(MoonshineUser $user, Order $order): bool
    {
        // Admin (1) y Coordinador (2) pueden editar
        return in_array($user->moonshine_user_role_id, [1, 2]);
    }

    /**
    * Eliminar pedidos
    */
    public function delete(MoonshineUser $user, Order $order): bool
    {
        // Solo Admin (1) puede eliminar
        return $user->moonshine_user_role_id == 1;
    }

    /**
    * Restaurar pedidos
    */
    public function restore(MoonshineUser $user, Order $order): bool
    {
        return $user->moonshine_user_role_id == 1;
    }

    /**
    * Eliminación permanente
    */
    public function forceDelete(MoonshineUser $user, Order $order): bool
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