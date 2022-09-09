<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyReva</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    {{--Toaster: styles src  --}}
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="web/css/style1.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
      @import url('https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap');

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
      }

      section {
        position: relative;
        min-height: 100vh;
        background-image: url("web/images/myreva_cover.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
      }

      section .container {
        position: relative;
        width: 800px;
        height: 500px;
        background: #fff;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        overflow: hidden;
      }

      section .container .user {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
      }

      section .container .user .imgBx {
        position: relative;
        width: 50%;
        height: 100%;
        transition: 0.5s;
        background-image: url("web/images/myreva_cover.jpg");
      }

      section .container .user .imgBx img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      section .container .user .formBx {
        position: relative;
        width: 50%;
        height: 100%;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px;
        transition: 0.5s;
      }

      section .container .user .formBx form h2 {
        font-size: 18px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-align: center;
        width: 100%;
        margin-bottom: 10px;
        color: #555;
      }

      section .container .user .formBx form input {
        position: relative;
        width: 100%;
        padding: 10px;
        background: #f5f5f5;
        color: #333;
        border: none;
        outline: none;
        box-shadow: none;
        margin: 8px 0;
        font-size: 14px;
        letter-spacing: 1px;
        font-weight: 300;
      }

      section .container .user .formBx form input[type='submit'] {
        max-width: 100px;
        background: #677eff;
        color: #fff;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 1px;
        transition: 0.5s;
      }

      section .container .user .formBx form .signup {
        position: relative;
        margin-top: 20px;
        font-size: 12px;
        letter-spacing: 1px;
        color: #555;
        text-transform: uppercase;
        font-weight: 300;
      }

      section .container .user .formBx form .signup a {
        font-weight: 600;
        text-decoration: none;
        color: #677eff;
      }

      section .container .signupBx {
        pointer-events: none;
      }

      section .container.active .signupBx {
        pointer-events: initial;
      }

      section .container .signupBx .formBx {
        left: 100%;
      }

      section .container.active .signupBx .formBx {
        left: 0;
      }

      section .container .signupBx .imgBx {
        left: -100%;
      }

      section .container.active .signupBx .imgBx {
        left: 0%;
      }

      section .container .signinBx .formBx {
        left: 0%;
      }

      section .container.active .signinBx .formBx {
        left: 100%;
      }

      section .container .signinBx .imgBx {
        left: 0%;
      }

      section .container.active .signinBx .imgBx {
        left: -100%;
      }

      @media (max-width: 991px) {
        section .container {
          max-width: 400px;
        }

        section .container .imgBx {
          display: none;
        }

        section .container .user .formBx {
          width: 100%;
        }
      }

    </style>
</head>
<body class="hold-transition login-page">
<!-- BEGIN: Content-->

<section>
    <div class="container" style="margin: auto">
      <div class="user signinBx">
        <div class="imgBx"><img src="dist/img/myredd_intr.jpg" alt="" /></div>
        <div class="formBx">
            {{-- sign in form --}}
          <form action="/login" method="POST" >
            @csrf
            <h2>Sign In</h2>
            <div class="input-group">
              <input type="text" name="email" placeholder="Username / Email Address" id="username"  class="form-control" >
            </div>
            <span class="help-block " style="color: red"></span>
            <input type="password" class="form-control" id="password-field" name="password" placeholder="Enter Password"  id="myInput">
            <span class="help-block" style="color: red"></span>
            <div class="row">
              <div class="col-6">
                <div class="icheck-primary">
                    <label for="rememberMe">
                        Remember me
                      </label>
                  <input type="checkbox" value="lsRememberMe" id="rememberMe">

                </div>
              </div>
              <div class="col-6">
                <p class="text-center" style=""><a href="{{'/forgetpwd'}}">Forgot your password?</a></p>
              </div>
            </div>
            <input type="submit" name="login_form" value="Login" />
            <p class="signup">
              Don't have an account ?
              <a href="#" onclick="toggleForm();">Sign Up.</a>
            </p>
            <div class="social-auth-links text-center mb-3">
              <p>- Register Using -</p>
              <a href="" class="btn bg-gradient-primary">
                <i class="fab fa-facebook mr-2"></i>
              </a>

            </div>
          </form>
        </div>
      </div>
      <div class="user signupBx">
        <div class="formBx">
            {{-- form elements --}}
          <form  method="POST" action="/register">
                @csrf
                <h2>Create an account</h2>
                <div class="input-group ">
                <input type="text" name="name" class="form-control" value="" placeholder="username" />
                <span class="help-block" style="color: red"></span>
                </div>
                <div class="input-group ">
                <input type="email" class="form-control" name="email" placeholder="Email">
                <span class="help-block" style="color: red"></span>
                </div>
                <div class="input-group">
                <input type="text" placeholder="0300-0000000" class="form-control" id="phone" data-inputmask="'mask': '9999-9999999'" name="phone" />
                <span class="help-block" style="color: red"></span>
                </div>
                <div class="input-group ">
                <input type="password" name="password" class="form-control" id="password-fieldd" value="" placeholder="Password">
                <span class="help-block" style="color: red"></span>
                </div>
                <div class="input-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="cpassword" class="form-control" value="" placeholder="Retype Password">

                <span class="help-block" style="color: red"></span>
                </div>
                <div class="input-group ">
                <select class="form-control select2" name="gender">
                    <option value="">Choose Your Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
                <span class="help-block" style="color: red"></span>
                </div>
                <div class="row" style="margin-top: 5px">
                <div class="col-8">
                    <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                    <label for="agreeTerms">
                        I agree to the <a href="terms.php">terms</a>
                    </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <input type="submit" name="register_form" value="Register" />
                </div>
                <!-- /.col -->
                </div>
                <p class="signup">
                Already have an account ?
                <a href="#" onclick="toggleForm();">Sign in.</a>
                </p>
          </form>
        </div>
        <div class="imgBx"><img src="dist/img/myredd_intl.jpg" alt="" /></div>
      </div>
    </div>
  </section>



{{-- End: Content --}}


<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script>
  $("#phone").inputmask();
</script>
<script>
  $(".toggle-passwordd").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
</script>
<script>
  $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
  const rmCheck = document.getElementById("rememberMe"),
    usernameInput = document.getElementById("username");
  passwordInput = document.getElementById("password-field");

  if (localStorage.checkbox && localStorage.checkbox !== "") {
    rmCheck.setAttribute("checked", "checked");
    usernameInput.value = localStorage.username;
    passwordInput.value = localStorage.password;
  } else {
    rmCheck.removeAttribute("checked");
    usernameInput.value = "";
  }

  function lsRememberMe() {
    if (rmCheck.checked && usernameInput.value !== "" && passwordInput.value !== "") {
      localStorage.username = usernameInput.value;
      localStorage.password = passwordInput.value;
      localStorage.checkbox = rmCheck.value;
    } else {
      localStorage.username = "";
      localStorage.password = "";
      localStorage.checkbox = "";
    }
  }
</script>
<script>
  const toggleForm = () => {
    const container = document.querySelector('.container');
    container.classList.toggle('active');
  };
</script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
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

