<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Order\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Order\OrderResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Components\Layout\Box;
use Throwable;


/**
 * @extends FormPage<OrderResource>
 */
class OrderFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(), 
                
                Select::make('Producto', 'product_id')
                    ->options(\App\Models\Product::pluck('name', 'id')->toArray())
                    ->required()
                    ->searchable(),
                    
                Select::make('Cliente', 'client_id')
                    ->options(\App\Models\Client::pluck('name', 'id')->toArray())
                    ->required()
                    ->searchable(),
                    
                Number::make('Cantidad', 'quantity')
                    ->required()
                    ->min(1)
                    ->hint('Ingrese la cantidad de productos en el pedido'),
                    
                Number::make('Total', 'total')
                    ->required()
                    ->step(0.01)
                    ->hint('Ingrese el total a pagar por el pedido'),
                    
                Select::make('Estado', 'status')
                    ->options([
                        'pending' => 'Pendiente',
                        'completed' => 'Completado',
                        'cancelled' => 'Cancelado', 
                    ])
                    ->required(),
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
            'product_id' => 'required|exists:products,id',
            'client_id' => 'required|exists:clients,id',
            'quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,cancelled',
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