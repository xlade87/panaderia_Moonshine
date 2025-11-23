<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\MoonShine\Resources\Product\Pages\ProductIndexPage;
use App\MoonShine\Resources\Product\Pages\ProductFormPage;
use App\MoonShine\Resources\Product\Pages\ProductDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<Product, ProductIndexPage, ProductFormPage, ProductDetailPage>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Productos'; // ✅ Cambiado a español
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ProductIndexPage::class,
            ProductFormPage::class,
            ProductDetailPage::class,
        ];
    }

    /**
     * Rules for validation
     */
    public function rules(Model $item): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|max:1000',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * Searchable fields
     */
    public function search(): array
    {
        return ['name', 'description'];
    }
}