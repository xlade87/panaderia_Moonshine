<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Client;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\MoonShine\Resources\Client\Pages\ClientIndexPage;
use App\MoonShine\Resources\Client\Pages\ClientFormPage;
use App\MoonShine\Resources\Client\Pages\ClientDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<Client, ClientIndexPage, ClientFormPage, ClientDetailPage>
 */
class ClientResource extends ModelResource
{
    protected string $model = Client::class;

    protected string $title = 'Clients'; 
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ClientIndexPage::class,
            ClientFormPage::class,
            ClientDetailPage::class,
        ];
    }

    /**
     * Rules for validation
     */
    public function rules(Model $item): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:clients,email,' . ($item->id ?? 'NULL'),
            'phone'=> 'nullable|min:10|max:15',
            'address' => 'required|min:10|max:1000',
        ];
    }

    /**
     * Searchable fields
     */
    public function search(): array
    {
        return ['name','email','phone'];
    }
}