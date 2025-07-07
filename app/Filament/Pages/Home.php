<?php

namespace App\Filament\Pages;

use App\Models\Booking;
use Filament\Pages\Page;

class Home extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.pages.home';

    protected static ?string $title = 'Beranda';
    protected static ?string $navigationLabel = 'Beranda';

    public $wisatas;

    public static function getSlug(): string
    {
        return '/';
    }

    public function mount(): void
    {
        $this->wisatas = \App\Models\Wisata::all();
    }

    public function getViewData(): array
    {
        $totalPendapatanHariIni = Booking::with('wisata')
            ->whereDate('created_at', today())
            ->get()
            ->sum(fn($booking) => $booking->wisata->harga_tiket ?? 0);

        return [
            'totalPendapatanHariIni' => $totalPendapatanHariIni,
        ];
    }
}
