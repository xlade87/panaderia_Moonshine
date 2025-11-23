<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Product\Pages;

use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;

class ProductIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Nombre', 'name'),
            Number::make('Precio', 'price'),
            Text::make('Categoría', 'category.name'),
            Text::make('Descripción', 'description'),
        ];
    }
}