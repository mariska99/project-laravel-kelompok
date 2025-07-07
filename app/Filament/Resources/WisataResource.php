<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WisataResource\Pages;
use App\Filament\Resources\WisataResource\RelationManagers;
use App\Models\Wisata;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WisataResource extends Resource
{
    protected static ?string $model = Wisata::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationLabel = 'Wisata';

    public static function canCreate(): bool
    {
        return Auth::user()?->hasRole('admin');
    }

    // Kalau pakai Bulk delete
    public static function canDeleteAny(): bool
    {
        return Auth::user()?->hasRole('admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('lokasi')->required()->label('Lokasi'),
                        Textarea::make('description')->required()->label('Deskripsi'),
                        TextInput::make('harga_tiket')->required()->label('Harga Tiket')->numeric(),
                        TimePicker::make('jam_buka')->required()->label('Jam Buka'),
                        TimePicker::make('jam_tutup')->required()->label('Jam Tutup'),
                        FileUpload::make('gambar')->required()->label('Gambar')->image()->disk('public')->imagePreviewHeight('200')->visibility('public'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lokasi')->label('Lokasi')->searchable()->sortable(),
                TextColumn::make('description')->label('Deskripsi')->searchable()->sortable(),
                TextColumn::make('harga_tiket')->label('Harga Tiket')->searchable()->sortable()->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextColumn::make('jam_buka')->label('Jam Buka')->searchable()->sortable(),
                TextColumn::make('jam_tutup')->label('Jam Tutup')->searchable()->sortable(),
                ImageColumn::make('gambar')->disk('public')->label('Gambar')->height(100),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->visible(fn() => Auth::user()?->hasRole('admin')),
                Tables\Actions\EditAction::make()->visible(fn() => Auth::user()?->hasRole('admin')),
                Tables\Actions\DeleteAction::make()->visible(fn() => Auth::user()?->hasRole('admin')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWisatas::route('/'),
            'create' => Pages\CreateWisata::route('/create'),
            'edit' => Pages\EditWisata::route('/{record}/edit'),
        ];
    }

    protected static function booted()
    {
        static::deleting(function ($wisata) {
            if ($wisata->gambar) {
                Storage::disk('public')->delete($wisata->gambar);
            }
        });
    }
}
