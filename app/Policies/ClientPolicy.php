<?php

namespace App\Policies;

use App\Models\Client;
use MoonShine\Models\MoonshineUser;

class ClientPolicy
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

    /* Ver lista de clientes */
    public function viewAny(MoonshineUser $user): bool
    {
        return true; // Todos pueden ver
    }

    /* Ver detalle */
    public function view(MoonshineUser $user, Client $client): bool
    {
        return true; // Todos pueden ver
    }

    /*
    * Crear clientes
    */
    public function create(MoonshineUser $user): bool
    {
        // Admin (1) y Coordinador (2) pueden crear
        return in_array($user->moonshine_user_role_id, [1, 2]);
    }

    /**
    * Editar clientes
    */
    public function update(MoonshineUser $user, Client $client): bool
    {
        // Admin (1) y Coordinador (2) pueden editar
        return in_array($user->moonshine_user_role_id, [1, 2]);
    }

    /**
    * Eliminar clientes
    */
    public function delete(MoonshineUser $user, Client $client): bool
    {
        // Solo Admin (1) puede eliminar
        return $user->moonshine_user_role_id == 1;
    }

    /**
    * Restaurar clientes
    */
    public function restore(MoonshineUser $user, Client $client): bool
    {
        return $user->moonshine_user_role_id == 1;
    }

    /**
    * Eliminación permanente
    */
    public function forceDelete(MoonshineUser $user, Client $client): bool
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