<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Category;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\MoonShine\Resources\Category\Pages\CategoryIndexPage;
use App\MoonShine\Resources\Category\Pages\CategoryFormPage;
use App\MoonShine\Resources\Category\Pages\CategoryDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<Category, CategoryIndexPage, CategoryFormPage, CategoryDetailPage>
 */
class CategoryResource extends ModelResource
{
    protected string $model = Category::class;

    protected string $title = 'Categorías';
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            CategoryIndexPage::class,
            CategoryFormPage::class,
            CategoryDetailPage::class,
        ];
    }

    /**
     * Rules for validation
     */
    public function rules(Model $item): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'description' => 'nullable|max:500',
        ];
    }

    /**
     * Searchable fields
     */
    public function search(): array
    {
        return ['name'];
    }
}