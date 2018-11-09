<?php
ini_set('display_error',1);
  require_once("./Interfaces/session.php");
  require_once("./Interfaces/database.php");
  $login = new session();
  $dbClass = new database();
  if(empty($login->getLogin()))
  {
    header("Location: login.php");
    exit;
  }
$dbClass->setUserName($login->getLogin());
if($dbClass->getUserUploadPrivelege() == '0')
  header('location: ./noprivilege.php');
$tags = $dbClass->getTags();
$tagUsed = array();
$uploadError = "";
$audioError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  if(isset($_POST['art-submit']))
  {
    $contentType = 'article';
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $article =  $_POST['article'];
    $author = $_POST['author'];

    if(empty($title))
      $titleError = "Title cannot be empty";
    else
    {
      if(!empty($_POST['customTag1']))
        $tagUsed[] = $_POST['customTag1'];
      if(!empty($_POST['customTag2']))
        $tagUsed[] = $_POST['customTag2'];

      if(!empty($_POST['customTag3']))
        $tagUsed[] = $_POST['customTag3'];

      if(isset($_POST['tag1']))
        $tagUsed[] = $_POST['tag1'];
      if(isset($_POST['tag2']))
        $tagUsed[] = $_POST['tag2'];
      if(isset($_POST['tag3']))
        $tagUsed[] = $_POST['tag3'];
      $path = '';
      if(!$dbClass->uploadContent($title, $tagUsed, $path, $contentType))
        $uploadError = "Upload failed";
      else
      {
        if(!$dbClass->addArticle($title, $subtitle, $article, $author))
          $uploadError = "Upload failed";
        else
          $uploadError = "Upload Successful!";
      }
    }
  }

  if(isset($_POST['lang-submit']))
  {
    $contentType = 'language';
    $title = $_POST['language'];
    $word1 = $_POST['word1'];
    $word1_tr = $_POST['word1_tr'];
    $word2 = $_POST['word2'];
    $word2_tr = $_POST['word2_tr'];
    $word3 = $_POST['word3'];
    $word3_tr = $_POST['word3_tr'];
    $word4 = $_POST['word4'];
    $word4_tr = $_POST['word4_tr'];
    $word5 = $_POST['word5'];
    $word5_tr = $_POST['word5_tr'];
    $author = $_POST['author'];

    $target_dir = './' .$title. '/';
    mkdir($target_dir, 0755, true);
    if (count($_FILES['audio']['name'])<5)
      $uploadError = "Missing file inputs!";
    else
    {
      $files = $_FILES['audio'];
      for($i = 0; $i <5; $i++)
      {

        $target_file = $target_dir . 'audio'.($i+1).'.mp3';
        $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
        if(file_exists($target_file))
          $uploadError = "Problem uploading file";
        elseif($fileType != 'mp3')
          $uploadError = "Invalid file type";
        else
        {
          move_uploaded_file($files['tmp_name'][$i], $target_file);
        }
      }
          if(!empty($_POST['customTag1']))
            $tagUsed[] = $_POST['customTag1'];
          if(!empty($_POST['customTag2']))
            $tagUsed[] = $_POST['customTag2'];
          if(!empty($_POST['customTag3']))
            $tagUsed[] = $_POST['customTag3'];
          if(isset($_POST['tag1']))
            $tagUsed[] = $_POST['tag1'];
          if(isset($_POST['tag2']))
            $tagUsed[] = $_POST['tag2'];
          if(isset($_POST['tag3']))
            $tagUsed[] = $_POST['tag3'];
          if(!$dbClass->uploadContent($title, $tagUsed, $target_dir, $contentType))
            $uploadError = "Failed to upload content";
          elseif(!$dbClass->addLanguage($title, $word1, $word1_tr, $word2, $word2_tr, $word3, $word3_tr, $word4, $word4_tr, $word5, $word5_tr, $target_dir, $author))
            $uploadError = "Failed to add content";
      }


  }

  if(isset($_POST['quiz-submit']))
  {
    $contentType = 'quiz';
    $title = $_POST['title'];
    $question = $_POST['question'];
    if(!empty($_POST['hint']))
      $hint = $_POST['hint'];
    else $hint = 'No hint for you :D';
    $answer1 = $_POST['choice1'];
    $answer2 = $_POST['choice2'];
    $answer3 = $_POST['choice3'];
    $answer4 = $_POST['choice4'];
    $correctAnswer = $_POST['options'];
    $author = $_POST['author'];
    if(empty($title))
      $uploadError = "Missing Title";
    elseif(empty($question))
      $uploadError = "Empty question?!";
    elseif (empty($answer1) || empty($answer2) 
      || empty($answer3) || empty($answer4))
      $uploadError = "One of the choices is empty!";
    else
    {
      if(!empty($_POST['customTag1']))
        $tagUsed[] = $_POST['customTag1'];
      if(!empty($_POST['customTag2']))
        $tagUsed[] = $_POST['customTag2'];
      if(!empty($_POST['customTag3']))
        $tagUsed[] = $_POST['customTag3'];
      if(isset($_POST['tag1']))
        $tagUsed[] = $_POST['tag1'];
      if(isset($_POST['tag2']))
        $tagUsed[] = $_POST['tag2'];
      if(isset($_POST['tag3']))
        $tagUsed[] = $_POST['tag3'];
      $path = '';
      if(!$dbClass->uploadContent($title, $tagUsed, $path, $contentType))
        $uploadError = "Failed to upload";
      elseif(!$dbClass->addQuiz($title, $question, $hint, $answer1, $answer2, $answer3, $answer4, $correctAnswer, $author))
        $uploadError = "Failed to upload";
    }
  }

  if(isset($_POST['video-submit']))
  {
    $contentType = 'video';
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $link = $_POST['videoLink'];
    $author = $_POST['author'];

    if(empty($title) || empty($subtitle) || empty($link)
      || empty($author))
      $uploadError = "Empty fields!";
    else
    {
      if(!empty($_POST['customTag1']))
        $tagUsed[] = $_POST['customTag1'];
      if(!empty($_POST['customTag2']))
        $tagUsed[] = $_POST['customTag2'];
      if(!empty($_POST['customTag3']))
        $tagUsed[] = $_POST['customTag3'];
      if(isset($_POST['tag1']))
        $tagUsed[] = $_POST['tag1'];
      if(isset($_POST['tag2']))
        $tagUsed[] = $_POST['tag2'];
      if(isset($_POST['tag3']))
        $tagUsed[] = $_POST['tag3'];
      $path = '';
      if(!$dbClass->uploadContent($title, $tagUsed, $path, $contentType))
        $uploadError = "Cannot upload";
      elseif(!$dbClass->addVideo($title, $subtitle, $link, $author))
        $uploadError = "Upload failed";
    }
  }
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
        
        <!-- Links for markdown-->
        <link rel="stylesheet" type="text/css" media="screen" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.2.1/css/bootstrap-markdown.min.css">
        <!-- End Links for markdown-->

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
        
        <!-- Dropdown Menu -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

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

<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>

<div class="page-header text-center wow fadeInUp" data-wow-delay="0.3s">
<h2>Uploads page</h2>
<div class="devider"></div>
<p class="subtitle">What kind of content do you want to upload today ?</p>
</div>

    <div class="container">
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-login">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <a href="#" class="active" id="art-form-link">Article</a>
              </div>
              <div class="col-xs-3">
                <a href="#" id="lang-form-link">Language</a>
              </div>
              <div class="col-xs-3">
                <a href="#" id="quiz-form-link">Quiz</a>
              </div>
              <div class="col-xs-3">
                <a href="#" id="video-form-link">Video</a>
              </div>
            </div>
            <hr>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
              <form id="art-form" action="" method="post" role="form" style="display: block;">
                  <div class="form-group">
                    <input type="text" name="title" id="title" tabindex="1" class="form-control" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <input type="text" name="subtitle" id="subtitle" tabindex="2" class="form-control" placeholder="Short description">
                  </div>
                  <div class="form-group">
                       <textarea name="article" id="article" placeholder="Article (in markdown)" data-provide="markdown" tabindex="3"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="text" name="author" id="author" tabindex="4" class="form-control" placeholder="Author or source">
                  </div>
                  
                  <div class="form-group">
                  	<div class="row">
                      <div class="col-sm-4">
                      	<input type="text" name="customTag1" id="customTag1" class="form-control" placeholder="Add a tag" tabindex="5">
                      </div>
                      <div class="col-sm-4">
                      	<input type="text" name="customTag2" id="customTag2" class="form-control" placeholder="Add a tag" tabindex="6">
                      </div>
                      <div class="col-sm-4">
                      	<input type="text" name="customTag3" id="customTag3" class="form-control" placeholder="Add a tag" tabindex="7">
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                  	<div class="row">
                      <div class="col-sm-4">	
						<select name="tag1" class="selectpicker" data-live-search="true" title="Choose tag" data-width="145" tabindex="8">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
                echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
						</select>
                      </div>
                      <div class="col-sm-4">
                      	<select name="tag2" class="selectpicker" data-live-search="true" title="Choose tag" data-width="145" tabindex="9">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
                echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
						</select>
                      </div>
                      <div class="col-sm-4">
                      	<select name="tag3" class="selectpicker" data-live-search="true" title="Choose tag" data-width="145" tabindex="10">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
                echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
						</select>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="art-submit" id="art-submit" tabindex="5" class="form-control btn btn-login" value="Submit" tabindex="11">
                      </div>
                    </div>
                    <?php echo $uploadError; ?>
                  </div>
                </form>
                
                
                
                
                
                
                
                
                <form id="lang-form" action="" enctype="multipart/form-data" method="post" role="form" style="display: none;">
                  <div class="form-group">
                    <input type="text" name="language" id="language" tabindex="1" class="form-control" placeholder="What language is it?" value="" tabindex="1">
                  </div>
                  <h6>Give us 5 words that you want to teach to the world!</h6>
                  <div class="devider"></div>
                  
                  <div class="form-group">
                    <input type="text" name="word1" id="word1" tabindex="2" class="form-control" placeholder="Word in foreign language" tabindex="2">
                  </div>
                  <div class="form-group">
                    <input type="text" name="word1_tr" id="word1_tr" tabindex="2" class="form-control" placeholder="Word in english" tabindex="3">
                  </div>
                  <div class="form-group">
   					<input type="file" name="audio[]" class="file" multiple>
    				<div class="input-group col-xs-12">
      					<span class="input-group-addon"><i class="glyphicon glyphicon-music"></i></span>
     					<input type="text" class="form-control input-lg" disabled placeholder="Upload audio file" tabindex="4">
      					<span class="input-group-btn">
        					<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
     					</span>
    				</div>
  				  </div>
                  <div class="extra-space-m"></div>
                  <div class="devider"></div>
                  
                  <div class="form-group">
                    <input type="text" name="word2" id="word2" tabindex="2" class="form-control" placeholder="Word in foreign language" tabindex="5">
                  </div>
                  <div class="form-group">
                    <input type="text" name="word2_tr" id="word2_tr" tabindex="2" class="form-control" placeholder="Word in english" tabindex="6">
                  </div>
                  <div class="form-group">
   					<input type="file" name="audio[]" class="file" multiple>
    				<div class="input-group col-xs-12">
      					<span class="input-group-addon"><i class="glyphicon glyphicon-music"></i></span>
     					<input type="text" class="form-control input-lg" disabled placeholder="Upload audio file" tabindex="7">
      					<span class="input-group-btn">
        					<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
     					</span>
    				</div>
  				  </div>
                  <div class="extra-space-m"></div>
                  <div class="devider"></div>
                  
                  <div class="form-group">
                    <input type="text" name="word3" id="word3" tabindex="2" class="form-control" placeholder="Word in foreign language" tabindex="8">
                  </div>
                  <div class="form-group">
                    <input type="text" name="word3_tr" id="word3_tr" tabindex="2" class="form-control" placeholder="Word in english" tabindex="9">
                  </div>
                  <div class="form-group">
   					<input type="file" name="audio[]" class="file" multiple>
    				<div class="input-group col-xs-12">
      					<span class="input-group-addon"><i class="glyphicon glyphicon-music"></i></span>
     					<input type="text" class="form-control input-lg" disabled placeholder="Upload audio file" tabindex="10">
      					<span class="input-group-btn">
        					<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
     					</span>
    				</div>
  				  </div>
                  <div class="extra-space-m"></div>
                  <div class="devider"></div>
                  
                  <div class="form-group">
                    <input type="text" name="word4" id="word4" tabindex="2" class="form-control" placeholder="Word in foreign language" tabindex="11">
                  </div>
                  <div class="form-group">
                    <input type="text" name="word4_tr" id="word4_tr" tabindex="2" class="form-control" placeholder="Word in english" tabindex="12">
                  </div>
                  <div class="form-group">
   					<input type="file" name="audio[]" class="file" multiple>
    				<div class="input-group col-xs-12">
      					<span class="input-group-addon"><i class="glyphicon glyphicon-music"></i></span>
     					<input type="text" class="form-control input-lg" disabled placeholder="Upload audio file" tabindex="13">
      					<span class="input-group-btn">
        					<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
     					</span>
    				</div>
  				  </div>
                  <div class="extra-space-m"></div>
                  <div class="devider"></div>
                  
                  <div class="form-group">
                    <input type="text" name="word5" id="word5" tabindex="2" class="form-control" placeholder="Word in foreign language" tabindex="14">
                  </div>
                  <div class="form-group">
                    <input type="text" name="word5_tr" id="word5_tr" tabindex="2" class="form-control" placeholder="Word in english" tabindex="15">
                  </div>
                  <div class="form-group">
   					<input type="file" name="audio[]" class="file" multiple>
    				<div class="input-group col-xs-12">
      					<span class="input-group-addon"><i class="glyphicon glyphicon-music"></i></span>
     					<input type="text" class="form-control input-lg" disabled placeholder="Upload audio file" tabindex="16">
      					<span class="input-group-btn">
        					<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
     					</span>
    				</div>
  				  </div>
                  <div class="extra-space-m"></div>
                  <div class="devider"></div>
                  <div class="form-group">
                    <input type="text" name="author" id="author" class="form-control" placeholder="Author or source" tabindex="17">
                  </div>
                  
                  <div class="form-group">
                  	<div class="row">
                      <div class="col-sm-4">
                      	<input type="text" name="customTag1" id="customTag1" class="form-control" placeholder="Add a tag" tabindex="18">
                      </div>
                      <div class="col-sm-4">
                      	<input type="text" name="customTag2" id="customTag2" class="form-control" placeholder="Add a tag" tabindex="19">
                      </div>
                      <div class="col-sm-4">
                      	<input type="text" name="customTag3" id="customTag3" class="form-control" placeholder="Add a tag" tabindex="20">
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                  	<div class="row">
                      <div class="col-sm-4">	
						<select name="tag1" class="selectpicker" data-live-search="true" title="Choose tag" data-width="145" tabindex="21">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
                echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
						</select>
                      </div>
                      <div class="col-sm-4">
                      	<select name="tag2" class="selectpicker" data-live-search="true" title="Choose tag" data-width="150" tabindex="22">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
                echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
						</select>
                      </div>
                      <div class="col-sm-4">
                      	<select name="tag3" class="selectpicker" data-live-search="true" title="Choose tag" data-width="145" tabindex="23">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
                echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
						</select>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="lang-submit" id="lang-submit" tabindex="3" class="form-control btn btn-login" value="Submit" tabindex="24">
                      </div>
                    </div>
                    <?php echo $uploadError; ?>
                  </div>
                </form>
                
                
                
                
                
                
                <form id="quiz-form" action="" method="post" role="form" style="display: none;">
                  <div class="form-group">
                    <input type="text" name="title" id="title" tabindex="1" class="form-control" placeholder="Give your question a unique title!" tabindex="1">
                  </div>
                  <div class="form-group">
                    <input type="text" name="question" id="question" tabindex="1" class="form-control" placeholder="Quiz question" tabindex="2">
                  </div>
                  <div class="form-group">
                    <input type="text" name="hint" id="hint" tabindex="1" class="form-control" placeholder="Leave a hint (or not)" tabindex="3">
                  </div>
                  <div class="form-group">
                    <input type="text" name="choice1" id="choice1" tabindex="1" class="form-control" placeholder="Choice of answer A" tabindex="4">
                  </div>
                  <div class="form-group">
                    <input type="text" name="choice2" id="choice2" tabindex="1" class="form-control" placeholder="Choice of answer B" tabindex="5">
                  </div>
                  <div class="form-group">
                    <input type="text" name="choice3" id="choice3" tabindex="1" class="form-control" placeholder="Choice of answer C" tabindex="6">
                  </div>
                  <div class="form-group">
                    <input type="text" name="choice4" id="choice4" tabindex="1" class="form-control" placeholder="Choice of answer D" tabindex="7">
                  </div>
                  <div class="form-group">
                    <input type="text" name="author" id="author" class="form-control" placeholder="Author or source" tabindex="8">
                  </div>
                  <h6>Which one is the correct answer?</h6>
                  <div class="devider"></div>
                  <div class="form-group">
                    <div class="btn-group" data-toggle="buttons">
			
						<label class="btn btn-primary btn-block active">
							<input type="radio" name="options" id="option2" autocomplete="off" value="A" chacked tabindex="9">Answer A
							<span class="glyphicon glyphicon-ok"></span>
						</label>

						<label class="btn btn-block btn-primary">
							<input type="radio" name="options" id="option1" value="B" autocomplete="off" tabindex="10">Answer B
							<span class="glyphicon glyphicon-ok"></span>
						</label>

						<label class="btn btn-block btn-primary">
							<input type="radio" name="options" id="option2" value="C" autocomplete="off" tabindex="11">Answer C
							<span class="glyphicon glyphicon-ok"></span>
						</label>

						<label class="btn btn-block btn-primary">
							<input type="radio" name="options" id="option2" value="D" autocomplete="off" tabindex="12">Answer D
							<span class="glyphicon glyphicon-ok"></span>
						</label>
		
					</div>
                  </div>
                  
                  <div class="form-group">
                  	<div class="row">
                      <div class="col-sm-4">
                      	<input type="text" name="customTag1" id="customTag1" class="form-control" placeholder="Add a tag" tabindex="13">
                      </div>
                      <div class="col-sm-4">
                      	<input type="text" name="customTag2" id="customTag2" class="form-control" placeholder="Add a tag" tabindex="14">
                      </div>
                      <div class="col-sm-4">
                      	<input type="text" name="customTag3" id="customTag3" class="form-control" placeholder="Add a tag" tabindex="15">
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                  	<div class="row">
                      <div class="col-sm-4">	
						<select name="tag1" class="selectpicker" data-live-search="true" title="Choose tag" data-width="145" tabindex="16">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
                echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
						</select>
                      </div>
                      <div class="col-sm-4">
                      	<select name="tag2" class="selectpicker" data-live-search="true" title="Choose tag" data-width="145" tabindex="17">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
                echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
            			</select>
                      </div>
                      <div class="col-sm-4">
                      	<select name="tag3" class="selectpicker" data-live-search="true" title="Choose tag" data-width="145" tabindex="18">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
                echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
						</select>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="quiz-submit" id="quiz-submit" tabindex="4" class="form-control btn btn-login" value="Submit" tabindex="19">
                      </div>
                    </div>
                    <?php echo $uploadError; ?>
                  </div>
                </form>
                
                
                
                
                
                <form id="video-form" action="" method="post" role="form" style="display: none;">
                  <div class="form-group">
                    <input type="text" name="title" id="title" tabindex="1" class="form-control" placeholder="Title" tabindex="1">
                  </div>
                  <div class="form-group">
                    <input type="text" name="subtitle" id="subtitle" tabindex="1" class="form-control" placeholder="Short description" tabindex="2">
                  </div>
                  <div class="form-group">
                    <input type="url" name="videoLink" id="videoLink" tabindex="1" class="form-control" placeholder="Copy/paste Youtube video link" tabindex="3">
                  </div>
                  <div class="form-group">
                    <input type="text" name="author" id="author" class="form-control" placeholder="Author or source" tabindex="4">
                  </div>
                  
                  <div class="form-group">
                  	<div class="row">
                      <div class="col-sm-4">
                      	<input type="text" name="customTag1" id="customTag1" class="form-control" placeholder="Add a tag" tabindex="5">
                      </div>
                      <div class="col-sm-4">
                      	<input type="text" name="customTag2" id="customTag2" class="form-control" placeholder="Add a tag" tabindex="6">
                      </div>
                      <div class="col-sm-4">
                      	<input type="text" name="customTag3" id="customTag3" class="form-control" placeholder="Add a tag" tabindex="7">
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                  	<div class="row">
                      <div class="col-sm-4">	
						<select name="tag1" class="selectpicker" data-live-search="true" title="Choose tag" data-width="145" tabindex="8">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
    					  echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
						</select>
                      </div>
                      <div class="col-sm-4">
                      	<select name="tag2" class="selectpicker" data-live-search="true" title="Choose tag" data-width="145" tabindex="9">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
                echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
						</select>
                      </div>
                      <div class="col-sm-4">
                      	<select name="tag3" class="selectpicker" data-live-search="true" title="Choose tag" data-width="145" tabindex="10">
            <?php
              if ($tags != null)
              {
                foreach ($tags as $tag) 
                {
                echo '<option value="'.$tag.'">'.$tag.'</option>';
                }
              }
            ?>
						</select>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="video-submit" id="video-submit" tabindex="4" class="form-control btn btn-login" value="Submit" tabindex="11">
                      </div>
                    </div>
                    <?php echo $uploadError; ?>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>











            <!-- Begin footer -->
            <footer class="text-off-white">

                <div class="footer-top">
                	<div class="container">
                    	<div class="row wow bounceInLeft" data-wow-delay="0.4s">

                            <div class="col-sm-6 col-md-4">
                            	<h4>Useful Links</h4>
                                <ul class="imp-links">
                                	<li><a href="">About</a></li>
                                	<li><a href="">Copyright</a></li>
                                	<li><a href="">Advertise</a></li>
                                	<li><a href="">Legal</a></li>
                                </ul>
                            </div>

                        	<div class="col-sm-6 col-md-4">
                                <h4>About us</h4>
                                <p>We are Z10: Siméone, Archie, Stevie, Anjaney, Ana, Valentine, Luke.</p>
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
        
        
        <!-- Links for markdown-->
		<script src="inc/smoothscroll.js"></script>
        <script src="http://toopay.github.io/bootstrap-markdown/js/markdown.js"></script>
		<script src="http://toopay.github.io/bootstrap-markdown/js/to-markdown.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.2.1/js/bootstrap-markdown.js"></script>
        <script src="https://cdn.rawgit.com/showdownjs/showdown/1.6.4/dist/showdown.min.js"></script>
        <!-- End Links for markdown-->
        
        <!-- Dropdown menu -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>


		<!-- Theme JS -->
		<script src="js/theme.js"></script>

    </body>


</html>
