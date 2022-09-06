@extends('layouts.auth_layout')
@section('content')
<!-- BEGIN: Content-->
<div class="card-body login-card-body">
    <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
    {{-- form elements --}}
    <form action="/changepwd" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
      <div class="input-group mb-3">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password" id="cpassword" name="cpassword"class="form-control" placeholder="Confirm Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block">Change password</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <p class="mt-3 mb-1">
      <a href="login.html">Login</a>
    </p>
  </div>

{{-- End: Content --}}

@endsection
