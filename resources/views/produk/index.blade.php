@extends('layouts.app')

@section('content')
    <h2>Daftar Produk</h2>
    @if (auth()->user()->role === 'admin')
        <h2>
            <a href="{{ route('produk.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Produk
            </a>
        </h2>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="produk-table" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Deskripsi</th>
                <th>Harga Tiket</th>
                <th>Jam Buka</th>
                <th>Jam Tutup</th>
                <th>Status</th>
                <th>Gambar</th>
                @if (auth()->user()->role === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
    </table>

    @push('scripts')
        <!-- jQuery dan DataTables (pastikan sudah dipanggil di layout/app.blade.php) -->
        <script>
            $(function() {
                $('#produk-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('produk.data') }}',

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'lokasi',
                            name: 'lokasi'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'harga_tiket',
                            name: 'harga_tiket'
                        },
                        {
                            data: 'jam_buka',
                            name: 'jam_buka'
                        },
                        {
                            data: 'jam_tutup',
                            name: 'jam_tutup'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'gambar',
                            name: 'gambar',
                            orderable: false,
                            searchable: false
                        },
                        @if (auth()->user()->role === 'admin')
                            {
                                data: 'aksi',
                                name: 'aksi',
                                orderable: false,
                                searchable: false
                            },
                        @endif
                    ]

                });
            });
        </script>
    @endpush
@endsection
