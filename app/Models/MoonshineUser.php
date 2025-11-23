<?php

namespace App\Models;

use MoonShine\Models\MoonshineUser as BaseMoonshineUser;

class MoonshineUser extends BaseMoonshineUser
{
    /**
     * Verificar si es Admin
     */
    public function isAdmin(): bool
    {
        return $this->moonshine_user_role_id == 1;
    }

    /**
     * Verificar si es Coordinador
     */
    public function isCoordinador(): bool
    {
        return $this->moonshine_user_role_id === 2;
    }

    /**
     * Verificar si es Vendedor
     */
    public function isVendedor(): bool
    {
        return $this->moonshine_user_role_id === 3;
    }
}