@extends('layouts.admin_app')
@section('title', 'Login Admin')
@section('content')

<div class="login-box">
    <div class="login-logo">
        <img src="{{ asset('admin/img/logo_test.png')}}" alt=""
            style="width: 100px; height:auto; margin-left: auto; margin-right: auto; display: block; border-radius: 10px;">
        <a href=""><b>Login</b>Admin</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" name="password" required autocomplete="current-password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <center>
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </center>
            </div>
        </form>
        <br>
        <center>
            <a href="/admin/register" class="text-center">Register Here</a>
        </center>
    </div>
    <!-- /.login-box-body -->
</div>
@endsection