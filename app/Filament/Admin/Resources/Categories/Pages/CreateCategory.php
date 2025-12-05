<?php

namespace App\Filament\Admin\Resources\Categories\Pages;

use App\Filament\Admin\Resources\Categories\CategoryResource;
use App\Models\Category;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = str($data['name'])->slug();

        return $data;
    }

    // for custom creation
    protected function handleRecordCreation(array $data): Model
    {
        $category = Category::create($data);
        return $category;
    }

    // protected function getRedirectUrl(): string
    // {
    //     // return $this->getResource()::getUrl('create'); // you can use this
    //     // return CategoryResource::getUrl('create'); // or this
    //     return $this->previousUrl ?? $this->getResource()::getUrl('index');
    // }
}
