<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>
{{--Toaster: styles src  --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
  alpha/css/bootstrap.css" rel="stylesheet">

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 <link rel="stylesheet" type="text/css"
  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    {{-- content begin --}}
    @yield('content')

    {{-- content end --}}
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })


        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "slideDown",
            "hideMethod": "slideUp",
            "closeMethod": "slideUp",
            "escapeHtml": true
        };

    </script>
    @if(Session::has('success'))
         @php
         $SessionType = "success";
         $SessionMessage = Session::get('success');
         $SessionTitle = Session::get('title');
         @endphp
    @elseif(Session::has('error'))
        @php
         $SessionType = "error";
         $SessionMessage = Session::get('error');
         @endphp
    @elseif(Session::has('info'))
         @php
         $SessionType = "info";
         $SessionMessage = Session::get('info');
        @endphp
    @elseif(Session::has('warning'))
         @php
         $SessionType = "warning";
         $SessionMessage = Session::get('warning');
        @endphp
    @endif

    @if(isset($SessionType) && isset($SessionMessage))
        @if(isset($SessionTitle))
             <script type="text/javascript">
             $(document).ready( function () {
                 toastr["{{ $SessionType }}"]("{{ $SessionMessage }}","{{ $SessionTitle }}");
             });
            </script>
         @else
            <script type="text/javascript">
             $(document).ready( function () {
                 toastr["{{ $SessionType }}"]("{{ $SessionMessage }}");
             });
             </script>
         @endif
     @endif

</body>
</html>
