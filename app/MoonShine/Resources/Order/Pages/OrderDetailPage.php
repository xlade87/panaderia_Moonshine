<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Order\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;

class OrderDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Cliente', 'client.name'),
            Text::make('Producto', 'product.name'),
            Number::make('Cantidad', 'quantity'),
            Number::make('Total', 'total'),
            Text::make('Estado', 'status'),
        ];
    }
}