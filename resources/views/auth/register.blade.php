@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <form class="login100-form validate-form" method="POST" action="/register">
        <span class="login100-form-title">
            Register
        </span>
        @csrf
        <div class="wrap-input100 validate-input" data-validate="Nama wajib diisi">
            <input class="input100" type="text" name="name" placeholder="Nama">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">
                Register
            </button>
        </div>

        <div class="text-center p-t-12">
            <span class="txt1">
                Sudah punya akun?
            </span>
            <a class="txt2" href="/login">
                Login
            </a>
        </div>

        <div class="text-center p-t-136">
        </div>
    </form>
    </div>
@endsection
