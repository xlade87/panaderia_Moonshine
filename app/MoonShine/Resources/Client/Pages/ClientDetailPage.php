<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Client\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class ClientDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Nombre', 'name'),
            Text::make('Email', 'email'),
            Text::make('Teléfono', 'phone'),
            Textarea::make('Dirección', 'address'),
        ];
    }
}