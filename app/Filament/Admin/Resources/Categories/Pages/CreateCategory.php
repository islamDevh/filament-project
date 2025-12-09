<?php

namespace App\Filament\Admin\Resources\Categories\Pages;

use App\Filament\Admin\Resources\Categories\CategoryResource;
use App\Models\Category;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;

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

    protected function getCreatedNotificationTitle(): ?string 
    {
        return 'تم التخزين بنجاح';
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->body('تم التخزين بنجاح')
            ->title($this->getCreatedNotificationTitle() . ' ' . $this->record->name)
            ->icon(Heroicon::AcademicCap);
    }
}
