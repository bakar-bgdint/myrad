@extends('layouts.auth_layout')
@section('content')
<!-- BEGIN: Content-->

<div class="card-body login-card-body">
    <p class="login-box-msg">Sign in to start your session</p>

    {{-- form elements --}}
    <form action="/login" method="POST">
        @csrf
      <div class="input-group mb-3">
        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-8">
          <div class="icheck-primary">
            <input type="checkbox" id="remember">
            <label for="remember">
              Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    {{-- form elements end --}}

    <div class="social-auth-links text-center mb-3">
      <p>- OR -</p>
      <a href="{{ url('auth/facebook') }}" class="btn btn-block btn-primary">
        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
      </a>

    </div>
    <!-- /.social-auth-links -->

    <p class="mb-1">
      <a href="{{'/forgetpwd'}}">I forgot my password</a>
    </p>
    <p class="mb-0">
      <a href="{{'/register'}}" class="text-center">Register a new membership</a>
    </p>
  </div>
{{-- End: Content --}}

@endsection
