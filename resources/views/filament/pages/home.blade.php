    <x-filament-panels::page>
        @role('admin')
            <div class="text-2xl font-bold mb-4">Statistik</div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <x-filament::card>
                    <div class="text-center">
                        <div class="text-lg">Jumlah Booking</div>
                        <div class="text-3xl font-bold text">{{ \App\Models\Booking::count() }}</div>
                    </div>
                </x-filament::card>

                <x-filament::card>
                    <div class="text-center">
                        <div class="text-lg">Jumlah Wisata</div>
                        <div class="text-3xl font-bold">{{ \App\Models\Wisata::count() }}</div>
                    </div>
                </x-filament::card>

                <x-filament::card>
                    <div class="flex flex-col items-center justify-center h-full text-center">
                        <div class="text-lg">Pendapatan Hari Ini</div>
                        <div class="text-3xl font-bold">
                            Rp {{ number_format($totalPendapatanHariIni, 0, ',', '.') }}
                        </div>
                    </div>
                </x-filament::card>

            </div>

            <div class="grid grid-cols-1">
                @livewire(\App\Filament\Widgets\BookingChart::class)
            </div>
        @endrole

        <div class="text-2xl font-bold mb-4">Wisata Tersedia</div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach ($wisatas as $wisata)
                <div class="rounded-lg shadow p-4 shadow-gray-300 border-2">
                    <img src="{{ asset('storage/' . $wisata->gambar) }}" alt="{{ $wisata->lokasi }}"
                        class="w-full h-40 object-cover rounded-md mb-4">

                    <h2 class="text-lg font-semibold">{{ $wisata->lokasi }}</h2>
                    <p class="text-sm text-gray-600 mt-1">
                        Harga Tiket: <span class="font-bold text-green-600">
                            Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}
                        </span>
                    </p>
                </div>
            @endforeach
        </div>
    </x-filament-panels::page>
