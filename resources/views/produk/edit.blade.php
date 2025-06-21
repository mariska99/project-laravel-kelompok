@extends('layouts.app')

@section('content')
    <h2>Edit Produk</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan saat input data:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $produk->name }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ $produk->lokasi }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" required>{{ $produk->description }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label>Harga Tiket</label>
            <input type="number" name="harga_tiket" class="form-control" value="{{ $produk->harga_tiket }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Jam Buka</label>
            <input type="time" name="jam_buka" class="form-control" value="{{ $produk->jam_buka }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Jam Tutup</label>
            <input type="time" name="jam_tutup" class="form-control" value="{{ $produk->jam_tutup }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="aktif" {{ $produk->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak aktif" {{ $produk->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Gambar</label><br>
            <img id="preview" src="{{ $produk->gambar ? asset('storage/' . $produk->gambar) : '#' }}"
                style="max-height: 100px; {{ $produk->gambar ? '' : 'display:none;' }}">
        </div>

        <div class="form-group mb-3">
            <label>Ganti Gambar</label>
            <input type="file" name="gambar" class="form-control-file" onchange="previewGambar(event)">
        </div>

        <button type="submit" class="btn btn-success btn-sm shadow-sm">
            <i class="fas fa-save"></i> Update
        </button>
    </form>

    <script>
        function previewGambar(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
