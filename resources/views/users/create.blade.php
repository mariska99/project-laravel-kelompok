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

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Contoh: Agus" required>
        </div>

        <div class="form-group mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="*****" required>
        </div>

        <div class="form-group mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin" selected>Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

@endsection
