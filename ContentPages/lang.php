<?php
require_once('../Interfaces/database.php');
require_once('../Interfaces/session.php');
$dbClass = new database();
$login  = new session();

$langDetail;
$title; $word1; $word2; $word3; $word4; $word5; $word1tr; $word2tr; $word3tr; $word4tr; $word5tr; $audioPath1; $audioPath2; $audioPath3; $audioPath4; $audioPath5; $author;
if(!isset($_GET['content']))
  $contentName = $login->getContent();
else
  $contentName = $_GET['content'];
if($contentName != null)
  $langDetail = $dbClass->getLangugage($contentName);
else
  header('location:../redirect.php');

if($langDetail == null)
  header('location:../redirect.php');
else
{
  $title = $langDetail['ContentName'];
  $word1 = $langDetail['Word1'];
  $word2 = $langDetail['Word2'];
  $word3 = $langDetail['Word3'];
  $word4 = $langDetail['Word4'];
  $word5 = $langDetail['Word5'];

  $word1tr = $langDetail['Word1_TR'];
  $word2tr = $langDetail['Word2_TR'];
  $word3tr = $langDetail['Word3_TR'];
  $word4tr = $langDetail['Word4_TR'];
  $word5tr = $langDetail['Word5_TR'];

  $audioPath1 = $langDetail['Word1_AUDIO'];
  $audioPath2 = $langDetail['Word2_AUDIO'];
  $audioPath3 = $langDetail['Word3_AUDIO'];
  $audioPath4 = $langDetail['Word4_AUDIO'];
  $audioPath5 = $langDetail['Word5_AUDIO'];

  $author = $langDetail['Author'];
}

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
		<link rel="stylesheet" href="../inc/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../inc/animations/css/animate.min.css">
		<link rel="stylesheet" href="../inc/font-awesome/css/font-awesome.min.css"> <!-- Font Icons -->
		<link rel="stylesheet" href="../inc/owl-carousel/css/owl.carousel.css">
		<link rel="stylesheet" href="../inc/owl-carousel/css/owl.theme.css">
        
        <link rel="stylesheet" href="../css/bootstrap-slider.css">

		<!-- Theme CSS -->
        <link rel="stylesheet" href="../css/reset.css">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/mobile.css">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="../css/skin/cool-gray.css">

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
                            <li><a href="./../about.php">About</a></li>

                            <li><?php
                              if(empty($login->getLogin()))
                                echo '<a href="./../Registration.php">Login/Signup</a>';
                              else
                                echo '<a href="./../logout.php">Logout</a>';
                            ?></li>
                        </ul>

                        <a href="../redirect.php"> <img src="./../img/bt-ty.png" class="logo"/> </a>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                            <?php
                              if(!empty($login->getLogin()))
                                echo '<a href="./../profile.php">Profile</a>';
                              else
                                echo '<a href="./../login.php">Profile</a>';
                            ?>
                            </li>
                            <li><a href="./../uploads.php">Upload</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container -->
                </nav>
                <!-- End Navbar -->

            </header>
            <!-- ========= END HEADER =========-->
            
		<section id="content" class="page bg-style1">
            <div class="page-header-wrapper">
               <div class="container text-center">
				<h1>Learn some <?php echo $title; ?></h1>
                <div class="devider"></div>
				<div class="subtitle">This simple tutorial teaches you some words in <?php echo $title; ?>. This tutorial emphasises less on writing and much more on speaking and listening. Please make sure to repeat after the audio atleast once <i class="fa fa-smile-o" aria-hidden="true"></i></div>
				<div class="extra-space-l"></div>
				<h2><?php echo $word1; ?></h2>
				<p>'<?php echo $word1; ?>' roughly translates to '<?php echo $word1tr; ?>'. Play the audio recording below to learn the pronounciation</p>
				<audio controls>
  					<source src="<?php echo $audioPath1;?>" type="audio/mpeg">
					Your browser does not support the audio element.
				</audio>
                <div class="extra-space-l"></div>
				<h2> <?php echo $word2; ?> </h2>
				<p>'<?php echo $word2; ?>' roughly translates to '<?php echo $word2tr; ?>'. Play the audio recording below to learn the pronounciation</p>
				<audio controls>
  					<source src="<?php echo $audioPath2; ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
				</audio>
                <div class="extra-space-l"></div>
				<h2> <?php echo $word3; ?> </h2>
				<p>'<?php echo $word3; ?>' roughly translates to '<?php echo $word3tr; ?>'. Play the audio recording below to learn the pronounciation</p>
				<audio controls>
  					<source src="<?php echo $audioPath3; ?>" type="audio/mpeg">
				</audio>
                <div class="extra-space-l"></div>
				<h2> <?php echo $word4; ?> </h2>
				<p>'<?php echo $word4; ?>' roughly translates to '<?php echo $word4tr; ?>'. Play the audio recording below to learn the pronounciation</p>
				<audio controls>
  					<source src="<?php echo $audioPath4; ?>" type="audio/mpeg">
				</audio>
                <div class="extra-space-l"></div>
				<h2> <?php echo $word5; ?> </h2>
				<p>'<?php echo $word5; ?>' roughly translates to '<?php echo $word5tr; ?>'. Play the audio recording below to learn the pronounciation</p>
				<audio controls>
  					<source src="<?php echo $audioPath5; ?>" type="audio/mpeg">
				</audio>
                <div class="extra-space-l"></div>
                <p class="subtitle"><?php echo $author; ?></p>
               </div>
             </div>
		</section>
        
        <!-- START SLIDER -->
            	<div class="page-header-wrapper">
               		<div class="container">
                  		<div class="text-center">
                  			<h2>How did you enjoy this activity ?</h2>
                  			<div class="devider"></div>
                        <form id="rating_form" role="form" method="post" action="../redirect.php">
            				<input name="rating" id="rating" type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="5" data-slider-id="Rating" data-slider-handle:"custom" />
                    		<div class="extra-space-m"></div>
							<h6><span id="ratingCurrentSliderValLabel">You were: <span id="ratingSliderVal">kinda entertained</span></span></h6>
                  		</div>
               		</div>
             	</div>

             	<div class="container">
                	<div class="row">
                        <div class="cf2">
                        	<?php echo '<a href="../redirect.php?last='.$contentName.'">'; ?> <img src="./../img/bt-ty.png" id="button" class="buttonmain" onmouseover="document.getElementById('button').src='./../img/button-pressed.png'" onmouseout="document.getElementById('button').src='./../img/bt-ty.png'" onclick="document.getElementById('rating_form').submit(); return false;"/> </a>
                         </div>
                  	</div>
                </div>
            </form>
            
            
            <div class="extra-space-xl"></div>
        
        


            <!-- Begin footer -->
            <footer class="text-off-white">

                <div class="footer-top">
                	<div class="container">
                    	<div class="row wow bounceInLeft" data-wow-delay="0.4s">

                            <div class="col-sm-6 col-md-4">
                            	<h4>Useful Links</h4>
                                <ul class="imp-links">
                                	<li><a href="../about.php">About</a></li>
                                	<li><a href="../termsconditions.php">Copyright</a></li>
                                	<li><a href="../contact.php">Contact us</a></li>
                                	<li><a href="../termsconditions.php">Legal</a></li>
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
		<script src="../inc/jquery/jquery-1.11.1.min.js"></script>
		<script src="../inc/bootstrap/js/bootstrap.min.js"></script>
		<script src="../inc/owl-carousel/js/owl.carousel.min.js"></script>
		<script src="../inc/stellar/js/jquery.stellar.min.js"></script>
		<script src="../inc/animations/js/wow.min.js"></script>
    <script src="../inc/waypoints.min.js"></script>
		<script src="../inc/isotope.pkgd.min.js"></script>
		<script src="../inc/classie.js"></script>
		<script src="../inc/jquery.easing.min.js"></script>
		<script src="../inc/jquery.counterup.min.js"></script>
		<script src="../inc/smoothscroll.js"></script>
        
    <script src="../js/bootstrap-slider.js"></script>

		<!-- Theme JS -->
		<script src="../js/theme.js"></script>

    </body>


</html>
