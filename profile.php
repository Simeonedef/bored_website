<?php

  ini_set('display_errors', 1);
  session_start();
  require_once("./Interfaces/database.php");
  require_once("./Interfaces/session.php");

  $currentUser = new session();
  $dbClass = new database();

  if(empty($currentUser->getLogin()))
  {
    header("Location: login.php");
    exit;
  }
  $dbClass->setUserName($currentUser->getLogin());

  $thisRow = $dbClass->getUserDetails();
  $fullName = $thisRow['realName'];
  $email = $thisRow['Email'];
  $username = $thisRow['username'];
  $profilePic = $thisRow['profilePic'];



  $contentUploaded = $dbClass->getContentOwned();
  $contentName; $contentType;
  if ($contentUploaded != null)
  {
    $length = count($contentUploaded);
    $contentType = array();
    for ($i = 0; $i < $length; $i++)
    {
      $contentType[$i] = $dbClass->getContentType($contentUploaded[$i]);
    }
  }
  $preferredTags= $dbClass->getUserPreferences();

  $niencat="./img/profile/niencat.jpg";

  $kappa = "./img/profile/kappa.jpg";

  $dogy = "./img/profile/dogy.jpg";

  $dog = "./img/profile/dog.jpg";

  $pundog = "./img/profile/pundog.jpg";

  $grumpyPic = "./img/profile/grumpy.jpg";

  $girlPic = "./img/profile/girls.jpg";

  $boyPic = "./img/profile/boy.jpg";

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    if (isset($_POST['logout']))
    {
      $currentUser->endSession();
      header('Location: ./index.php');
    }
    if (isset($_POST['img1']))
    {
      $insert_image= $dbClass->updateProfilePicture($niencat);
      $profilePic = $niencat;
    }
    elseif (isset($_POST['img2']))
    {
      $insert_image= $dbClass-> updateProfilePicture($kappa);
      $profilePic = $kappa;
    }
    elseif (isset($_POST['img3']))
    {
      $insert_image= $dbClass-> updateProfilePicture($dogy);
      $profilePic = $dogy;
    }
    elseif (isset($_POST['img4']))
    {
      $insert_image= $dbClass-> updateProfilePicture($dog);
      $profilePic = $dog;

    }
    elseif (isset($_POST['img5']))
    {
      $insert_image= $dbClass-> updateProfilePicture($pundog);
      $profilePic = $pundog;
    }
    elseif (isset($_POST['img6']))
    {
      $insert_image= $dbClass-> updateProfilePicture($grumpyPic);
      $profilePic = $grumpyPic;
    }
    elseif (isset($_POST['img7']))
    {
      $insert_image= $dbClass-> updateProfilePicture($girlPic);
      $profilePic = $girlPic;
    }
    elseif (isset($_POST['img8']))
    {
      $insert_image= $dbClass-> updateProfilePicture($boyPic);
      $profilePic = $boyPic;
    }
    header("Location: http://bored.actilis.org/profile.php");
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
                              if(empty($currentUser->getLogin()))
                                echo '<a href="./Registration.php">Login/Signup</a>';
                              else
                                echo '<a href="./logout.php">Logout</a>';
                            ?></li>
                        </ul>

                        <a href="./redirect.php"> <img src="./img/bt-ty.png" class="logo"/> </a>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                            <?php
                              if(!empty($currentUser->getLogin()))
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


            <!-- ========= Begin Profile picture & name =========-->
              <div class="extra-space-l"></div>
                <div class="extra-space-l"></div>
                <div class="page-header-wrapper">
                    <div class="container">
                        <div class="page-header text-center wow fadeInUp" data-wow-delay="0.3s">
                            <?php echo '<img src="'.$profilePic.'" align="middle" width="128px" height="auto"> ';?>
                            <h2><?php echo $fullName ?></h2>

                        </div>
                    </div>
                </div>
            <!-- ========= End Profile picture & name =========-->

            <!-- ========= Begin Logout button =========-->

            <div class="page-header-wrapper">
              <div class="container text-center">
              <form action = "" method = "post">
                <button class="btn btn-default btn-lg" name="logout" type="submit">Logout</button>
              </form>
              </div>
            </div>

            <div class="devider"></div>

            <div class="extra-space-l"></div>
      		<div class="extra-space-l"></div>

            <!-- ========= End Logout button =========-->

          <div class="page-header-wrapper">
            <div class="container">
        <div class="tabbable-panel">
        <div class="tabbable-line">
            <ul class="nav nav-tabs">
          <li><a data-toggle="tab" href="#menu1"><h4>Information</h4></a></li>
          <li><a data-toggle="tab" href="#menu2"><h4>Uploads</h4></a></li>
      </ul>
            </div>
         </div>
       </div>
       </div>


    <div class="page-header-wrapper">
    <div class="container">
    <div class="tab-content">
    <div id="menu1" class="tab-pane fade in active">
      <div class="extra-space-m"></div>
      <div class="col-md-8 col-md-offset-2">
      <h4>Information</h4>
        <p>
         <div class="text-center">
              <form id="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" role="form">
              <p> <h4>Username : <?php echo $username ?> </h4></p>
              <p> <h4>Full Name : <?php echo $fullName ?> </h4></p>
              <p> <h4>Email : <?php echo $email ?></h4></p>
               <div class="extra-space-l"></div>
               <div class="btn-group">
                 <button type="button" class="dropdown-toggle btn btn-default btn-lg-xl" data-toggle="dropdown" href="#" aria-haspopup="true"aria-expanded="false">
                 Choose Profile Avatar <span class="caret"></span></button>
                 <style>
                 ul li{
                   display: inline;
                   padding-left: 9px
                 }
                 </style>
                 <ul class="dropdown-menu">
                 <?php
                  echo '<li><button name="img1" type="submit"><img src="'.$niencat.'"  width = "70" height = "70" /></button></li>';
                  echo '<li><button name="img2" type="submit"><img src="'.$kappa.'"  width = "70" height = "70" /></button></li>';
                  echo '<li><button name="img3" type="submit"><img src="'.$dogy.'" width = "70" height = "70" /></button></li>';
                  echo '<li><button name="img4" type="submit"><img src="'.$dog.'"  width = "70" height = "70" /></button></li>';
                  echo '<li><button name="img5" type="submit"><img src="'.$pundog.'" width = "70" height = "70" /></button></li>';
                  echo '<li><button name="img6" type="submit"><img src="'.$grumpyPic.'" width = "70" height = "70" /></button></li>';
                  echo '<li><button name="img7" type="submit"><img src="'.$girlPic.'" width = "70" height = "70" /></button></li>';
                  echo '<li><button name="img8" type="submit"><img src="'.$boyPic.'" width = "70" height = "70" /></button></li>';
                     ?>
                  </ul>
                 <div class="extra-space-l"></div>
                 </div>
                 </form>
                 </div>
               </div>
        </p>
  </div>

  <div id="menu2" class="tab-pane fade">
  <div class="extra-space-m"></div>
  <div class="col-md-8 col-md-offset-2">
    <h4>Uploads</h4>
    <p>
      <table>
      <?php
      if($dbClass->getUserUploadPrivelege() == 1)
      {
	if($length == 0)
	{
	  echo '<h2>You have not uploaded anything yet !</h2>';
	}
	else
	{
        for($i = 0; $i < $length;$i++)
        {  
          if ($contentType[$i] == 'quiz')
          {
            echo '<div class="row" id="box-search">';
            echo '<div class="thumbnail text-center">';
            echo '<a href ="./ContentPages/quiz.php?content='.$contentUploaded[$i].'"><img style="width:100px;height:auto;" src="/img/quiz_icon.png" alt="" class="img-responsive"></a>';
            echo '<h2>'.$contentUploaded[$i].'</h2>';
            echo '</div>';
            echo '</div>';
          }
          elseif ($contentType[$i] == 'language')
          {
            echo '<div class="row" id="box-search">';
            echo '<div class="thumbnail text-center">';
            echo '<a href ="./ContentPages/lang.php?content='.$contentUploaded[$i].'"><img style="width:100px;height:auto;" src="/img/lang_icon.png" alt="" class="img-responsive"></a>';
            echo '<h2>'.$contentUploaded[$i].'</h2>';
            echo '</div>';
            echo '</div>';
          }
          elseif ($contentType[$i] == 'video')
          {
            echo '<div class="row" id="box-search">';
            echo '<div class="thumbnail text-center">';
            echo '<a href ="./ContentPages/video.php?content='.$contentUploaded[$i].'"><img style="width:100px;height:auto;" src="/img/video_icon.png" alt="" class="img-responsive"></a>';
            echo '<h2>'.$contentUploaded[$i].'</h2>';
            echo '</div>';
            echo '</div>';
          }
          elseif ($contentType[$i] == 'article')
          {
            echo '<div class="row" id="box-search">';
            echo '<div class="thumbnail text-center">';
            echo '<a href ="./ContentPages/article.php?content='.$contentUploaded[$i].'"><img style="width:100px;height:auto;" src="/img/article_icon.png" alt="" class="img-responsive"></a>';
            echo '<h2>'.$contentUploaded[$i].'</h2>';
            echo '</div>';
            echo '</div>';
          }
        }
      }
      }
      else
      {
        echo '<div class="text-center"> <h5> You have no upload privilege </h5>';
        echo '<p> In order to have upload privilege <a href="contact.php">please contact us</a>. </p>';
        echo '</div>';
      }
      ?>
      </table>
    </p>
      </div>
      </div>
    </div>
      
  </div>
 </div>



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

