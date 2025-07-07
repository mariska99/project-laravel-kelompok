<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;

class BookingChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $data = Booking::with('wisata')
            ->selectRaw('wisata_id, COUNT(*) as total')
            ->groupBy('wisata_id')
            ->get()
            ->mapWithKeys(function ($item) {
                $namaWisata = $item->wisata?->lokasi ?? 'Tanpa Nama';
                return [$namaWisata => $item->total];
            });

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Booking',
                    'data' => $data->values(),
                ],
            ],
            'labels' => $data->keys(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
