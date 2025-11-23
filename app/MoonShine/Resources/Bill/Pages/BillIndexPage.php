<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Bill\Pages;

use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Date;

class BillIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Número', 'bill_number'),
            Text::make('Cliente', 'client.name'),
            Text::make('Pedido', 'order.id'),
            Number::make('Monto', 'amount'),
            Date::make('Fecha', 'bill_date'),
        ];
    }
}