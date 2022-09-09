@extends('layouts.auth_layout')
@section('content')
<!-- BEGIN: Content-->

<div class="login-box">
    <div class="login-logo">
      <a href="../../index2.html"><b>Recover </b>Password</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">

    <div class="card-body login-card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

            <form action="/forget" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" id="email" name="email"  class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                    </div>
                <!-- /.col -->
                </div>
            </form>

        
     </div>
    </div>
</div>



  {{-- End: Content --}}

@endsection
