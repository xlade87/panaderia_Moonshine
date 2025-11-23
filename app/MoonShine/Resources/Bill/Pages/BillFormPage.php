<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Bill\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Bill\BillResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Components\Layout\Box;
use Throwable;


/**
 * @extends FormPage<BillResource>
 */
class BillFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(), 
                
                Text::make('Número de Factura', 'bill_number')
                    ->required()
                    ->hint('Número de factura'),
                    
                Select::make('Cliente', 'client_id')
                    ->options(\App\Models\Client::pluck('name', 'id')->toArray())
                    ->required()
                    ->searchable()
                    ->placeholder('Seleccione un cliente'),
                    
                Select::make('Pedido', 'order_id')
                    ->options(\App\Models\Order::pluck('id', 'id')->toArray())
                    ->required()
                    ->searchable()
                    ->placeholder('Seleccione un pedido'),
                    
                Number::make('Monto', 'amount')
                    ->required()
                    ->step(0.01)
                    ->min(0)
                    ->hint('Monto total de la factura'),
                    
                Date::make('Fecha de Factura', 'bill_date')
                    ->required()
                    ->format('Y-m-d')
                    ->hint('Fecha en que se emitió la factura'),
            ]),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'bill_number' => 'required|unique:bills,bill_number,' . ($item->exists ? $item->id : 'NULL'),
            'client_id' => 'required|exists:clients,id',
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'bill_date' => 'required|date',
        ];
    }

    /**
     * @param  FormBuilder  $component
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}