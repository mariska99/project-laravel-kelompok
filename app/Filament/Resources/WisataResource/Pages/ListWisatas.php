<?php

namespace App\Filament\Resources\WisataResource\Pages;

use App\Filament\Resources\WisataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ListWisatas extends ListRecords
{
    protected static string $resource = WisataResource::class;

    public static function canEdit(Model $record): bool
    {
        return Auth::user()?->hasRole('admin');
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()?->hasRole('admin');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
