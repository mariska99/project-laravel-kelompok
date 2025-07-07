<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Booking';

    public static function canAccess(): bool
    {
        return Auth::check() && Auth::user()->hasRole('admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('customer_name')->required()->label('Nama')->prefixIcon('heroicon-o-user'),
                        TextInput::make('phone_number')->required()->label('Nomor Telepon')->numeric()->prefix('+62')->prefixIcon('heroicon-o-phone'),
                        DatePicker::make('booking_date')->required()->label('Tanggal Booking')->prefixIcon('heroicon-o-calendar-days'),
                        Select::make('wisata_id')
                            ->label('Wisata')
                            ->relationship('wisata', 'lokasi')
                            ->required()
                            ->prefixIcon('heroicon-o-map'),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer_name')->label('Nama'),
                TextColumn::make('phone_number')->label('Nomor Telepon'),
                TextColumn::make('booking_date')->label('Tanggal Booking'),
                TextColumn::make('wisata.lokasi')->label('Wisata'),
                TextColumn::make('wisata.harga_tiket')->label('Harga Tiket')->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
