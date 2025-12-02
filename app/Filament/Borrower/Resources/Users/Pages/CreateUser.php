<?php

namespace App\Filament\Borrower\Resources\Users\Pages;

use App\Filament\Borrower\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
