@extends('layouts.app')

@section('content')
    <h2>Tambah Produk Wisata</h2>

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

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label>Nama Tempat</label>
            <input type="text" name="name" class="form-control" placeholder="Contoh: Pantai Indah" required>
        </div>

        <div class="form-group mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Bali" required>
        </div>

        <div class="form-group mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Ceritakan tentang tempat ini..." required></textarea>
        </div>

        <div class="form-group mb-3">
            <label>Harga Tiket</label>
            <input type="number" name="harga_tiket" class="form-control" placeholder="Contoh: 15000" required>
        </div>

        <div class="form-group mb-3">
            <label>Jam Buka</label>
            <input type="time" name="jam_buka" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Jam Tutup</label>
            <input type="time" name="jam_tutup" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="buka" selected>Buka</option>
                <option value="tutup">Tutup</option>
            </select>
        </div>

        <div class="form-group mb-4">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control-file" onchange="previewImage(event)">
            <br>
            <img id="preview" src="#" alt="Preview Gambar"
                style="max-width: 300px; display: none; margin-top: 10px;" />
        </div>

        <button type="submit" class="btn btn-primary">Simpan Produk</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
