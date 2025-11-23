<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Bill;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bill;
use App\MoonShine\Resources\Bill\Pages\BillIndexPage;
use App\MoonShine\Resources\Bill\Pages\BillFormPage;
use App\MoonShine\Resources\Bill\Pages\BillDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<Bill, BillIndexPage, BillFormPage, BillDetailPage>
 */
class BillResource extends ModelResource
{
    protected string $model = Bill::class;

    protected string $title = 'Bills'; 
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            BillIndexPage::class,
            BillFormPage::class,
            BillDetailPage::class,
        ];
    }

    /**
     * Rules for validation
     */
    public function rules(Model $item): array
    {
        return [
            'client_id' => 'required|exists:clients,id',
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'bill_date' => 'required|date',
            'bill_number' => 'required|unique:bills,bill_number,' . $item->id,
        ];
    }

    /**
     * Searchable fields
     */
    public function search(): array
    {
        return ['bill_number']; 
    }
}