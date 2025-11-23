<?php

namespace App\Policies;

use App\Models\Category;
use MoonShine\Models\MoonshineUser;

class CategoryPolicy
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

    /* Ver lista de categorías */
    public function viewAny(MoonshineUser $user): bool
    {
        return true; // Todos pueden ver
    }

    /* Ver detalle */
    public function view(MoonshineUser $user, Category $category): bool
    {
        return true; // Todos pueden ver
    }

    /*
    * Crear categorías
    */
    public function create(MoonshineUser $user): bool
    {
        // Admin (1) y Coordinador (2) pueden crear
        return in_array($user->moonshine_user_role_id, [1, 2]);
    }

    /**
    * Editar categorías
    */
    public function update(MoonshineUser $user, Category $category): bool
    {
        // Admin (1) y Coordinador (2) pueden editar
        return in_array($user->moonshine_user_role_id, [1, 2]);
    }

    /**
    * Eliminar categorías
    */
    public function delete(MoonshineUser $user, Category $category): bool
    {
        // Solo Admin (1) puede eliminar
        return $user->moonshine_user_role_id == 1;
    }

    /**
    * Restaurar categorías
    */
    public function restore(MoonshineUser $user, Category $category): bool
    {
        return $user->moonshine_user_role_id == 1;
    }

    /**
    * Eliminación permanente
    */
    public function forceDelete(MoonshineUser $user, Category $category): bool
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