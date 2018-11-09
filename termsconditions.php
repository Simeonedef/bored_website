<?php
  require_once("../../Interfaces/session.php");
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
            
            <div class="extra-space-l"></div>
                <div class="page-header-wrapper">
                    <div class="container">
                    <div class="text-center">         
<h1>TERMS AND CONDITIONS</h1>
<div class="devider"></div>
<p class="subtitle">Please read carefully</p>
<div class="extra-space-l"></div>
<div class="extra-space-l"></div>


<h3>Introduction</h3>
<div class="devider"></div>
This website's Terms and Conditions written on this webpage will give you guidance on what is permitted and what is not. By using this Website, you agreed to accept all terms and conditions written here. You mst not use this website if you do not agree with some of the terms and conditions written here.

<div class="extra-space-l"></div>
<div class="extra-space-l"></div>
<h3>Intellectual Property Rights</h3>
<div class="devider"></div>
ImBored does not own any of the content it uses. Therefore, it is understood that, you as the user of this website do not own the content here either, except for the content that you yourself upload.

<div class="extra-space-l"></div>
<div class="extra-space-l"></div>
<div class="text-center">  <h3>Restrictions</h3> </div>
<div class="devider"></div>
<p>You are specifically restricted from all of the following:</p>
</div>
<div class="extra-space-m"></div>
<ul class="fa-ul">
<li><i class="fa-li fa fa-caret-right"></i>Selling, sublicensing and/or otherwise commercializing any Website material without permssion from the original owners of the material</li>
<li><i class="fa-li fa fa-caret-right"></i>using this Website in any way that is or may be damaging to this Website;</li>
<li><i class="fa-li fa fa-caret-right"></i>Using this Website in any way that impacts user access to this Website;</li>
<li><i class="fa-li fa fa-caret-right"></i>Using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person.</li>
<li><i class="fa-li fa fa-caret-right"></i>You are strictly prohibited from uploading the following types of content:
	<ul class="fa-ul">
    <div class="extra-space-s"></div>
	<li><i class="fa-li fa fa-caret-right"></i>Graphic content: This includes violent content and/ sexual content of any kind</li>
	<li><i class="fa-li fa fa-caret-right"></i>Harmful content: This included content that could lead to injuries</li>
	<li><i class="fa-li fa fa-caret-right"></i>Hateful content: This website will not tolerate content that promotes violence or bias towards a community or a race</li>
	<li><i class="fa-li fa fa-caret-right"></i>Misleading content. Do not upload content that has misleading titles or tags.</li>
	</ul>
</li>
</ul>

<div class="text-center">
<div class="extra-space-l"></div>
<div class="extra-space-l"></div>
<h3>Your Content</h3>
<div class="devider"></div>
<p>Your Content can include audio, video, text, images or other material. By displaying Your Content, you grant ImBored an exclusive license to distribute your content.</p>

<p>Your Content must be your own and if it is not, you must make sure that the original owners of the content have permitted you to upload it. Im Bored reserves the right to remove any of Your Content from this Website at any time without notice.</p>


<div class="extra-space-l"></div>
<div class="extra-space-l"></div>
<h3>Limitation of liability</h3>
<div class="devider"></div>
<p>In no event shall ImBored be held liable for anything rising out of or in any way connected with your use of this Website whether such liability is under contract.</p>

<div class="extra-space-l"></div>
<div class="extra-space-l"></div>
<h3>Variation of Terms</h3>
<div class="devider"></div>
<p>ImBored is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.</p>

<div class="extra-space-l"></div>
<div class="extra-space-l"></div>
<h3>Entire Agreement</h3>
<div class="devider"></div>
<p>These Terms constitute the entire agreement between Im Bored and you in relation to your use of this Website.

<div class="extra-space-l"></div>
<div class="extra-space-l"></div>
<h3>Governing Law and Jurisdiction</h3>
<div class="devider"></div>
<p>These Terms will be governed by and interpreted in accordance with the laws of the United Kingdom.</p>

</div>
</div>
</div>

<div class="extra-space-l"></div>
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