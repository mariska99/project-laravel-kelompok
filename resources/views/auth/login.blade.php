@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <form class="login100-form validate-form" method="POST" action="/login">
        <span class="login100-form-title">
            Login
        </span>
        @csrf
        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="name" placeholder="Nama">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
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
                Login
            </button>
        </div>

        <div class="text-center p-t-12">
            <span class="txt1">
                Belum punya akun?
            </span>
            <a class="txt2" href="/register">
                Register
            </a>
        </div>

        <div class="text-center p-t-136">
        </div>
    </form>
    </div>
@endsection
