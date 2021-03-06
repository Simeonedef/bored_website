<?php
  require_once("./Interfaces/session.php");
  $login = new session();
?>

<!doctype html>
<html lang="en-US">
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

            <!--========== BEGIN HEADER ==========-->
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
                                echo '<a href="./logout.php">Logout</a>';
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
            <!-- ========= END HEADER =========-->
            
            <div class="extra-space-xl">
            
			<!-- ========= Write content here ==========-->
			<!-- Begin about section -->
                <!-- Begin page header-->
                <div class="page-header-wrapper">
                    <div class="container">
                        <div class="page-header text-center wow fadeInUp" data-wow-delay="0.3s">
                        <div class="text-center">
                            <br>
                            <br>
                            <br>
                            <h2>About Project ImBored</h2>
                            <div class="devider"></div>
                            <br>
                            
                            <div class="row">
                            	<div class="col-md-8 col-md-offset-2">
                            		<h6>Welcome to the movement</h6>
                            		<p>In an era where possibilities of entertainment are practically endless, we understand that it can be quite hard to find a real "boredom" killer. We are here to offer an alternative to the traditional unstimulating entertainments. Here, we offer endless possibilities without the pain of having to make a choice.</p>
                            		<div class="extra-space-m"></div>
                            		<p>Reinvent yourself, become an entertainer or be entertained. We are the vector of your creativity and entertainment.</p>
									<p>We are you, you are (Im)Bored.</p>
                            		<p>Welcome to the movement, you have just taken your first step towards in world of relevant, engaging possibilities.</p>
                            
                            		<div class="devider"></div>
                            		<div class="extra-space-l"></div>
                            		<h6>How does it work ?</h6>
                            		<p>All of this might seem a little bit abstract right now, but the short version is, we measure your satisfaction with the content offered to you to offer you content that you will enjoy even more! Best of all this, all you have to do is press the magical button and let the magic happen.</p>
                            
                            		<div class="devider"></div>
                            		<div class="extra-space-l"></div>
                            		<h6>Who are we really ?</h6>
                            		<p>We are a group of first year students in various disciplines of Computer Science at the University of Manchester. We are always open for discussion, so feel free to use the contact form to contact us!</p>
                            
                            		<div class="extra-space-l"></div>
                            		<p class="subtitle">Finally, special thanks to Dr. Goran Nenadic for his supervision and advice.</p>
                            		<div class="extra-space-l"></div>
                            
                            
                            		<div class="page-header-wrapper">
                            			<div class="text-center"
              								<div class="container">
                                    			<div class="devider"></div>
                								<button class="btn btn-default btn-lg" onclick="window.location.href='contact.php'">Contact us</button>
              								</div>
                                		</div>
           							</div>
                                    
                       			</div>
                       		</div>
                       	</div>
                            
                        <br>
                       	<br>
                        <br>
                	</div>
           		</div>
      		</div>
 		</div>
                
                <!-- End page header-->


<div class="extra-space-xxl"></div>
<div class="extra-space-xxl"></div>
<div class="extra-space-xxl"></div>
<div class="extra-space-xxl"></div>








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
