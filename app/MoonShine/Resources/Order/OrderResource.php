<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\MoonShine\Resources\Order\Pages\OrderIndexPage;
use App\MoonShine\Resources\Order\Pages\OrderFormPage;
use App\MoonShine\Resources\Order\Pages\OrderDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<Order, OrderIndexPage, OrderFormPage, OrderDetailPage>
 */
class OrderResource extends ModelResource
{
    protected string $model = Order::class;

    protected string $title = 'Orders'; 
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            OrderIndexPage::class,
            OrderFormPage::class,
            OrderDetailPage::class,
        ];
    }

    /**
     * Rules for validation
     */
    public function rules(Model $item): array
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
     * Searchable fields
     */
    public function search(): array
    {
        return []; // Los pedidos no suelen ser buscables por texto
    }

    /**
     * Default values for new orders
     */
    public function defaults(): array
    {
        return [
            'status' => 'pending',
            'quantity' => 1,
        ];
    }
}