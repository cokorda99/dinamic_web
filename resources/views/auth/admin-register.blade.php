@extends('layouts.admin_app')
@section('title', 'Register Admin')
@section('content')

<div class="login-box">
    <div class="login-logo">
        <img src="../customer/img/ruci_logo.jpg" alt=""
            style="width: 70px; height: 90px; margin-left: auto; margin-right: auto; display: block; border-radius: 10px;">
        <a href=""><b>Register</b>Admin</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="POST" action="{{ route('admin.register') }}">
            @csrf
            <div class="form-group has-feedback">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" name="password" required autocomplete="new-password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" placeholder="Confirmation Password"
                    name="password_confirmation" required autocomplete="new-password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <br>
        <center>
            <a href="/admin/login" class="text-center">I have a account</a>
        </center>
    </div>
    <!-- /.login-box-body -->
</div>
@endsection