@extends('layouts.no-sidebar')

@section('content')
<div class="auth">
    <h1>Register</h1>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="auth-control-con">
            <input id="name" type="text" class="auth-control @error('name') is-invalid @enderror" name="name" placeholder="Username" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="auth-control-con">
            <input id="email" type="email" class="auth-control @error('email') is-invalid @enderror" placeholder="E-mail" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="auth-control-con">
            <input id="password" type="password" class="auth-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="auth-control-con">
            <input id="password-confirm" type="password" class="auth-control" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </form>
</div>
@endsection
