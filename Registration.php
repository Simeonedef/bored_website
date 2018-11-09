<?php
  require_once("./Interfaces/session.php");
  $login = new session();
?>
<!doctype html>
<html lang="en-US">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration page</title>
    <meta name="description" content="Team Z10 project">
    <meta name="keywords" content="bored, entertainment, website, project, university of manchester" />
    <meta name="author" content="imransdesign.com">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Google Fonts  -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet' type='text/css'> <!-- Body font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'> <!-- Navbar font -->

    <!-- Libs and Plugins CSS -->
    <link rel="stylesheet" href="inc/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/animations/css/animate.min.css">
    <link rel="stylesheet" href="inc/font-awesome/css/font-awesome.min.css"> <!-- Font Icons -->
    <link rel="stylesheet" href="inc/owl-carousel/css/owl.carousel.css">
    <link rel="stylesheet" href="inc/owl-carousel/css/owl.theme.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mobile.css">

    <!-- Skin CSS -->
    <link rel="stylesheet" href="css/skin/cool-gray.css">
</head>
<body>
<?php
  ini_set('display_errors', 1);
  $valid = TRUE;
  $loginError=$errorName =$userNameError=$passwordError=$emailError=$signUpError=$TCError = "";
  $username=$password=$email=$fullName=$repeatPass="";
  require_once("../../Interfaces/database.php");
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if(!empty($_POST['register']))
    {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $repeatPass = $_POST['passwordagain'];
      $email = $_POST['email'];
      $fullName = $_POST['fullName'];
      $dbClass = new database();

      if (!preg_match("/^[a-zA-Z ]*$/",$fullName))
      {
        $errorName = "Only letters allowed";
		    $valid = FALSE;
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
        $emailError = "Invalid email format";
		    $valid = FALSE;
      }
      if(strlen($password) < 6)
      {
        $passwordError = "Not long enough";
		    $valid = FALSE;
      }
      if($password != $repeatPass)
      {
        $passwordError = "Passwords dont match";
		    $valid = FALSE;
      }
      if(strlen($username) < 2)
      {
        $userNameError = "Your username is not long enough";
		    $valid = FALSE;
      }
	    if(!isset($_POST['agree']) || ($_POST['agree'] != 'check'))
	    {
    	  $TCError = "Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy";
		    $valid = FALSE;
	    }
      if($valid == true)
      {
        if($dbClass->addUser($fullName, $email, $username, $password) === TRUE)
        {
          header("location:./login.php");
        }
        else
        {
          $userNameError=$dbClass->userNameError;
          $passwordError=$dbClass->passwordError;
          $emailError=$dbClass->emailError;
          $signUpError=$dbClass->signUpError;
        }
      }
      unset($dbClass);
    }
    if(!empty($_POST['login-submit']))
    {
      $username = $_POST['username'];
      $password = $_POST['password'];

      $dbClass = new database();
      if(!$dbClass->checkLogin($username,$password))
      {
        $loginError=$dbClass->loginError;
      }
      else
      {
        $login->setLoggedIn($dbClass->username);
        header('location:./index.php');
      }
      unset($dbClass);
    }
  }

?>
<header id="header" class="header-main">
<!-- Begin Navbar -->
<nav id="main-navbar" class="navbar navbar-default navbar-fixed-top" role="navigation">

  <div class="container">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
                            <li><a href="./about.php">About</a></li>

                            <li><?php
                              if(empty($login->getLogin()))
                                echo '<a href="./Registration.php">Login/Signup</a>';
                              else
                                echo '<a href="./profile.php">Logged in</a>';
                            ?></li>
                        </ul>

                        <a href="./redirect.php"> <img src="./img/bt-ty.png" class="logo"/> </a>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                            <?php
                              if(!empty($login->getLogin()))
                                echo '<a href="./profile.php">Profile</a>';
                              else
                                echo '<a href="./login.php">Profile</a>';
                            ?>
                            </li>
                            <li><a href="./uploads.php">Upload</a></li>
                        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>
<!-- End Navbar -->
</header>



<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
<div class="page-header text-center wow fadeInUp" data-wow-delay="0.3s">
<h2>Registration Page and Login Page</h2>
<div class="devider"></div>
</div>

    <div class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-6">
                <a href="#" class="active" id="register-form-link">Register</a>
              </div>
              <div class="col-xs-6">
                <a href="#" id="login-form-link">Login</a>
              </div>
            </div>
            <hr>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
              <form id="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" role="form" style="display: block;">
                  <div class="form-group">
                    <input type="text" name="fullName" id="fullName" tabindex="1" class="form-control" placeholder="Full Name" value=""><font color="red"><?php echo $errorName;?></font>
                  </div>
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value=""><font color="red"><?php echo $userNameError;?></font>
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value=""><font color="red"><?php echo $emailError;?></font>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password"><font color="red"><?php echo $passwordError; ?></font>
                  </div>
                  <div class="form-group">
                    <input type="password" name="passwordagain" id="passwordagain" tabindex="2" class="form-control" placeholder="Confirm Password">
                  </div>
                  <div class="form-group">
                    <input type="checkbox" name="agree" value="check" id="agree" /> I have read and agree to the <a href="termsconditions.php" target="_blank">Terms and Conditions and Privacy Policy</a><p><font color="red"><?php echo $TCError; ?></font></p>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register" id="register" tabindex="4" class="form-control btn btn-register" value="Register Now"><?php echo $signUpError; ?>
                      </div>
                    </div>
                  </div>
                </form>
                <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" role="form" style="display: none;">
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Login"><?php echo $loginError; ?><a href="index.php"></a>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="text-center">
                          <a href="http://bored.actilis.org/forgotPassword.php" tabindex="5" class="forgot-password">Forgot Password?</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>


    <!-- Begin footer -->
    <footer class="text-off-white">

        <div class="footer-top">
          <div class="container">
              <div class="row wow bounceInLeft" data-wow-delay="0.4s">

                    <div class="col-sm-6 col-md-4">
                      <h4>Useful Links</h4>
                        <ul class="imp-links">
                          <li><a href="about.php">About</a></li>
                          <li><a href="termsconditions.php">Copyright</a></li>
                          <li><a href="contact.php">Contact us</a></li>
                          <li><a href="termsconditions.php">Legal</a></li>
                        </ul>
                    </div>

                  <div class="col-sm-6 col-md-4">
                        <h4>About us</h4>
                        <p>We are Group Z10 from the University of Manchester.</p>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <h4>Get in touch with us!</h4>
        <p>School of Computer Science, The University of Manchester, Oxford Road, Manchester, UK, M13 9PL</p>
                    </div>

                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div>

        <div class="footer">
            <div class="container text-center wow fadeIn" data-wow-delay="0.4s">
                <p class="copyright">This is a Z10 group project @The University of Manchester.</p>
            </div>
        </div>

    </footer>
    <!-- End footer -->

    <a href="#" class="scrolltotop"><i class="fa fa-arrow-up"></i></a> <!-- Scroll to top button -->

    <!-- Plugins JS -->
<script src="inc/jquery/jquery-1.11.1.min.js"></script>
<script src="inc/bootstrap/js/bootstrap.min.js"></script>
<script src="inc/owl-carousel/js/owl.carousel.min.js"></script>
<script src="inc/stellar/js/jquery.stellar.min.js"></script>
<script src="inc/animations/js/wow.min.js"></script>
<script src="inc/waypoints.min.js"></script>
<script src="inc/isotope.pkgd.min.js"></script>
<script src="inc/classie.js"></script>
<script src="inc/jquery.easing.min.js"></script>
<script src="inc/jquery.counterup.min.js"></script>
<script src="inc/smoothscroll.js"></script>

<!-- Theme JS -->
<script src="js/theme.js"></script>


</body>
</html>
