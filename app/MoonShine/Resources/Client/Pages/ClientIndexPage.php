<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Client\Pages;

use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class ClientIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Nombre', 'name'),
            Text::make('Email', 'email'),
            Text::make('Teléfono', 'phone'),
            Text::make('Dirección', 'address'),
        ];
    }
}