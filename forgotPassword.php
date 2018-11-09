<?php
  session_start();
?>

<!doctype html>
<html lang="en-US">

<?php
ini_set('display_errors', 1);
require_once("./Interfaces/database.php");
require_once "./phpmailer/PHPMailerAutoload.php";
$dbClass = new database();
$mail = new PHPMailer;
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$length = 5; 
$charactersLength = strlen($characters);
$randomString = '';
$status='Please fill in the form below';
for ($i = 0; $i < $length; $i++) 
{
  $randomString .= $characters[rand(0, $charactersLength - 1)];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
  if(isset($_POST['button']))
  {
    $email = $_POST['email'];
    $emailDoesNotExist = $dbClass-> checkEmail($email);
    
    if(!$emailDoesNotExist)
    {
        //Enable SMTP debugging. 
        //$mail->SMTPDebug = 3;                               
        //Set PHPMailer to use SMTP.
        //$mail->isSMTP();            
        //Set SMTP host name                          
        $dbClass->updateResetKey($randomString, $email);
        $_SESSION['Email'] = $email;
        $mail->Host = "mail.actilis.org";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;                          
        //Provide username and password     
        $mail->Username = "bored@actilis.org";                 
        $mail->Password = "simeoneestgeniale";                           
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";                           
        //Set TCP port to connect to 
        $mail->Port = 587;                                   

        $mail->From = "bored@actilis.org";
        $mail->FromName = "Im Bored";

        $mail->addAddress($email, "Recepient");

        $mail->isHTML(true);

        $mail->Subject = "Password reset";
        $mail->Body = '<html>
                       <body>
                       <h3> Reset Password </h3>
                       <p> Please do not respond to this email. Click the link below to change password: </p>
                       <a href= "http://bored.actilis.org/updatePassword.php?email='.$email.'">Reset Password</a>
                       <p>You will need this code as well: '.$randomString.'</p>
                       </body></html>';
        $mail->AltBody = '';

        if(!$mail->send()) 
        {
            $status="Mailer Error: " . $mail->ErrorInfo;
        } 
        else 
        {
            $status="Message has been sent successfully";
        }
    }
  }
}      
?>

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Get UNbored !</title>
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

    <body data-spy="scroll" data-target="#main-navbar">
        <div class="page-loader"></div>  <!-- Display loading image while page loads -->
    	<div class="body">
        
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

                            <li><a href="./Registration.php">Login/Signup</a>
                            </li>
                        </ul>

                        <a href="./redirect.php"> <img src="./img/bt-ty.png" class="logo"/> </a>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="./login.php">Profile</a>
                            </li>
                            <li><a href="./uploads.php">Upload</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container -->
                </nav>
                <!-- End Navbar -->

            </header>
            <!-- ========= END HEADER =========-->








<div class="extra-space-xl"></div>

<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <div class="text-center">
      <div class="well well-lg">
<?php echo $status; ?>
      </div>
    </div>
  </div>
</div>

  <div class="page-header text-center wow fadeInUp" data-wow-delay="0.3s">
    <h2>Forgot your password ?</h2>
    <div class="devider"></div>
  </div>

  <div class="container">
      <div class="row vertical-offset-100">
      	<div class="col-md-4 col-md-offset-4">
      		<div class="panel panel-default">
  			  	<div class="panel-heading">
  			    	<h3 class="panel-title">Provide us with required information</h3>
				      <div class="extra-space-m"></div>
  			 	  </div>
            <div class="panel-body">
  			    	<form accept-charset="UTF-8" id="password-form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <fieldset>
  			    		 <div class="form-group">
  			    		   <input class="form-control" placeholder="Email Address" name="email" type="email" id="email">
  			    		 </div>
					       <div class="extra-space-m"></div>
  			    		 <input class="btn btn-lg btn-success btn-block" type="submit" value="Submit now" name="button" id="sub">
  			    	  </fieldset>
  			      </form>	
            </div>

          </div>
        </div>
      </div>
  </div>


<div class="extra-space-xl"></div>
<div class="extra-space-xl"></div>
<div class="extra-space-xl"></div>



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
                                              
        </div><!-- body ends -->
        
        
        
        
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
