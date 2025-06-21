@extends('layouts.app')

@section('content')
    <h2>Edit User</h2>

    {{-- Tampilkan semua error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="form-group mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
        </div>

        {{-- Role --}}
        <div class="form-group mb-3">
            <label>Role:</label>
            <select name="role" class="form-control">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        {{-- Password lama --}}
        <div class="form-group mb-3">
            <label>Password Lama:</label>
            <input type="password" name="old_password" class="form-control">
        </div>

        {{-- Password baru --}}
        <div class="form-group mb-3">
            <label>Password Baru:</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-success btn-sm shadow-sm">
            <i class="fas fa-save"></i> Update
        </button>

    </form>
@endsection
