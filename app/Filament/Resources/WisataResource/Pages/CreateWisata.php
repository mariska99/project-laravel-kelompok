<?php

namespace App\Filament\Resources\WisataResource\Pages;

use App\Filament\Resources\WisataResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWisata extends CreateRecord
{
    protected static string $resource = WisataResource::class;

    public static function canAccess(array $parameters = []): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
