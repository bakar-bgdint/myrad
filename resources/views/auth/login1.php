<?php
// Initialize the session
ob_start();
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"])  && $_SESSION["loggedin"] === true){
  header("location: index_updated.php");
  exit;
}

// Include config file
require_once "config.php";
require_once "config1.php";
require_once "fb/fb-config.php";

// Define variables and initialize with empty values
$email = $username = $password = "";
$username_error = $password_error = "";
$loginURL = $gClient->createAuthUrl();
$permissions = array('email'); // Optional permissions
$loginUrl_fb = $helper->getLoginUrl('https://myredd.net/fb/fb-callback.php', $permissions);
// Processing form data when form is submitted
if(isset($_POST['login_form'])){
  // Check if username is empty
  if(empty(trim($_POST["username"]))){
    $username_error = "Please enter username.";
  } else{
    $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if(empty(trim($_POST["password"]))){
    $password_error = "Please enter your password.";
  } else{
    $password = trim($_POST["password"]);
  }

  // Validate credentials
  if(empty($username_error) && empty($password_error)){
    // Prepare a select statement
    $sql = "SELECT id, username, password FROM users WHERE (username = ? or email = ?) and active=1";

    if($stmt = mysqli_prepare($link, $sql)){
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_username);

      // Set parameters
      $param_username = $username;

      // Attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)){
//        var_dump($stmt);
//        die();
        // Store result
        mysqli_stmt_store_result($stmt);

        // Check if username exists, if yes then verify password
        if(mysqli_stmt_num_rows($stmt) == 1){
          // Bind result variables
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
          if(mysqli_stmt_fetch($stmt)){
            if(password_verify($password, $hashed_password)){
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;
              // Redirect user to welcome page
              // header("location: update_prof.php");

              $query = "SELECT * FROM `profile` WHERE '$username'= agent_username ";
              $result = mysqli_query($link, $query);

              if (!empty($result)) {
                $data = mysqli_fetch_assoc($result);
                if ($data && count($data) > 0) {

                }
              }
              if (empty($data['agent_username'])) {

                header("location: index_new.php");

              } else {
                header("location: index_updated.php");
              }
            } else{
              // Display an error message if password is not valid
              $password_error= "The password you entered is not valid.";
            }
          }
        } else{
          // Display an error message if username doesn't exist
          $username_error = "User Not Found";
        }
      } else{
        echo "Oops! Something went wrong. Please try again later.";
      }
    }

    // Close statement
    mysqli_stmt_close($stmt);
  }

  // Close connection
  mysqli_close($link);
}
include_once "reg.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MyReva</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

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


<body>
<section>
  <div class="container" style="margin: auto">
    <div class="user signinBx">
      <div class="imgBx"><img src="dist/img/myredd_intro.jpg" alt="" /></div>
      <div class="formBx">
        <form action="login.php" method="post" >
          <h2>Sign In</h2>
          <div class="input-group <?php echo (!empty($username_error)) ? 'has-error' : ''; ?>">
            <input type="text" name="username" placeholder="Username / Email Address" id="username"  class="form-control" value="<?php echo $username; ?>">
          </div>
          <span class="help-block " style="color: red"><?php echo $username_error; ?></span>
          <input type="password" class="form-control" id="password-field" name="password" placeholder="Enter Password"  id="myInput">
          <span class="help-block" style="color: red"><?php echo $password_error; ?></span>
          <div class="row">
            <div class="col-6">
              <div class="icheck-primary">
                <input type="checkbox" value="lsRememberMe" id="rememberMe">
                <label for="rememberMe">
                  Remember me
                </label>
              </div>
            </div>
            <div class="col-6">
              <p class="text-center" style=""><a href="recover_password.php">Forgot your password?</a></p>
            </div>
          </div>
          <input type="submit" name="login_form" value="Login" />
          <p class="signup">
            Don't have an account ?
            <a href="#" onclick="toggleForm();">Sign Up.</a>
          </p>
          <div class="social-auth-links text-center mb-3">
            <p>- Register Using -</p>
            <a href="<?php echo htmlspecialchars($loginUrl_fb); ?>" class="btn bg-gradient-primary">
              <i class="fab fa-facebook mr-2"></i>
            </a>
            <a href="javascript:void(0)" class="btn  bg-gradient-danger" onclick="window.location = '<?php echo $loginURL ?>';">
              <i class="fab fa-google mr-2"></i>
            </a>
            <!--          <a href="register.php" class="btn btn-block btn-success" >-->
            <!--            <i class=" mr-2"></i> Register in Using Email-->
            <!--          </a>-->
          </div>
        </form>
      </div>
    </div>
    <div class="user signupBx">
      <div class="formBx">
        <form action="login.php" method="post">
          <h2>Create an account</h2>
          <div class="input-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
          <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="username" />
            <span class="help-block" style="color: red"><?php echo $username_err; ?></span>
          </div>
          <div class="input-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <span class="help-block" style="color: red"><?php echo $email_err; ?></span>
          </div>
          <div class="input-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
            <input type="text" placeholder="0300-0000000" class="form-control"  data-inputmask="'mask': '9999-9999999'" name="mobile" />
            <span class="help-block" style="color: red"><?php echo $mobile_err; ?></span>
          </div>
          <div class="input-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="password" class="form-control" id="password-fieldd" value="<?php echo $password; ?>" placeholder="Password">
            <span class="help-block" style="color: red"><?php echo $password_err; ?></span>
          </div>
          <div class="input-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Retype Password">

            <span class="help-block" style="color: red"><?php echo $confirm_password_err; ?></span>
          </div>
          <div class="input-group <?php echo (!empty($gender_err)) ? 'has-error' : ''; ?>">
            <select class="form-control select2" name="gender">
              <option value="">Choose Your Gender</option>
              <option>Male</option>
              <option>Female</option>
              <option>Other</option>
            </select>
            <span class="help-block" style="color: red"><?php echo $gender_err; ?></span>
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
      <div class="imgBx"><img src="dist/img/myredd_introduction.jpg" alt="" /></div>
    </div>
  </div>
</section>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script>
  $(":input").inputmask();

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
</script>
<script>
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
</body>
</html>


