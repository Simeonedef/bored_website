<!DOCTYPE html>
<html>
<head>
  <title>Redirecting</title>
</head>
<body>

<?php
  ini_set('display_errors', 1);
  require_once('./Interfaces/session.php');
  require_once('./Interfaces/database.php');
  $sessionInterface = new session();
  $databaseInterface = new database();
  $username = $sessionInterface->getLogin();
  $databaseInterface->setUserName($username);
  if(isset($_POST['rating']) && isset($_GET['last']))
  {
    $ratingStore = $_POST['rating'];
    $contentStore = $_GET['last'];
    $tagsFound = $databaseInterface->getContentTags($contentStore);
    foreach ($tagsFound as $stag)
    {
      $databaseInterface->updateUserPreference($stag, $ratingStore);
      $databaseInterface->updateTagRating($ratingStore, $stag);
      $databaseInterface->updateContentRating($contentName, $ratingStore);
    }
  }
  $contentList = $databaseInterface->getContentItems();
  $preferredTags = $databaseInterface->getUserPreferences();
  $nonPreferredTags = [];
  $preferredList = [];
  $nonPreferredList = [];

  if($preferredTags != null)
  {
    foreach($preferredTags as $tag) 
    {
      $tempList = $databaseInterface->getAssociatedContent($tag);
      foreach ($tempList as $temp) 
      {
        $preferredList[] = $temp;
      }
    }

    if($preferredList != null)
    {
      $nonPreferredTags = array_diff($databaseInterface->getTags(), $preferredTags);
      foreach ($nonPreferredTags as $tags)
      {
        $tempList = $databaseInterface->getAssociatedContent($tags);
        foreach ($tempList as $temp) 
        {
          $nonPreferredList[] = $temp;
        }
      }

      $prefRatingList = array();
      $nonPrefList = array();
      $ratingSum = $databaseInterface->getWeightingSum();
      if($nonPreferredList != null)
      {
        for($index = 0; $index < count($nonPreferredList);$index++) 
        {
          $contentName = $nonPreferredList[$index];
          $tmp_rating = $databaseInterface->getContentRating($contentName);
          $nonPrefList[] = $tmp_rating/$ratingSum;
        }
        for($index = 0; $index < count($preferredList);$index++)
        {
          $contentName = $preferredList[$index];
          $tmp_rating = $databaseInterface->getContentRating($contentName);
          $prefRatingList[] = $tmp_rating*2/$ratingSum;
        }
        $randomFloat = mt_rand()/mt_getrandmax();
        if($randomFloat < 0.5)
        {
          $anotherRandomFloat = mt_rand()/mt_getrandmax();
          $length = count($nonPrefList);
          for($index = 0; $index <$length; $index++)
            if($nonPrefList[$index] >= $anotherRandomFloat)
            {
              if ($nonPrefList[$index] == $sessionInterface->getContent())
                header('location: ./redirect.php');
              $sessionInterface->setContent($nonPreferredList[$index]);

              $type = $databaseInterface->getContentType($nonPreferredList[$index]);
              echo $nonPreferredList[$index] . $type;
              if($type == 'article')
                header('location: ./ContentPages/article.php');
              elseif ($type == 'language')
                header('location: ./ContentPages/lang.php');
              elseif ($type == 'quiz')
                header('Location: ./ContentPages/quiz.php');
              elseif ($type == 'video')
                header('Location: ./ContentPages/video.php');
              else
                echo 'Problem occurred';
            }
            $name = $contentList[rand(0, (count($contentList)-1))];
      $sessionInterface->setContent($name);
            $type = $databaseInterface->getContentType($name);
            if($type == 'article')
                header('location: ./ContentPages/article.php');
              elseif ($type == 'language')
                header('location: ./ContentPages/lang.php');
              elseif ($type == 'quiz')
                header('Location: ./ContentPages/quiz.php');
              elseif ($type == 'video')
                header('Location: ./ContentPages/video.php');
              else
                echo 'Problem occurred'; 
        }
        else
        {
          $anotherRandomFloat = mt_rand()/mt_getrandmax();
          $length = count($prefRatingList);
          for($index = 0; $index <$length; $index++)
            if($prefRatingList[$index] >= $anotherRandomFloat)
            {
               if ($prefRatingList[$index] == $sessionInterface->getContent())
                header('location: ./redirect.php');
              $sessionInterface->setContent($preferredList[$index]);
              $_SESSION['ContentName'] = $preferredList[$index];
              $type = $databaseInterface->getContentType($preferredList[$index]);
              echo $preferredList[$index] . $type;
              if($type == 'article')
                header('location: ./ContentPages/article.php');
              elseif ($type == 'language')
                header('location: ./ContentPages/lang.php');
              elseif ($type == 'quiz')
                header('Location: ./ContentPages/quiz.php');
              elseif ($type == 'video')
                header('Location: ./ContentPages/video.php');
              else
                echo 'Problem occurred';
            }
           $name = $contentList[rand(0, (count($contentList)-1))];
            if ($name == $sessionInterface->getContent())
                header('location: ./redirect.php');
            $sessionInterface->setContent($name);
            $type = $databaseInterface->getContentType($name);
            if($type == 'article')
                header('location: ./ContentPages/article.php');
              elseif ($type == 'language')
                header('location: ./ContentPages/lang.php');
              elseif ($type == 'quiz')
                header('Location: ./ContentPages/quiz.php');
              elseif ($type == 'video')
                header('Location: ./ContentPages/video.php');
              else
                echo 'Problem occurred';       
          }

        }
      
    }
  }
    elseif($contentList != null)
    {
      $ratingList = array();
      foreach ($contentList as $content) 
      {
        $ratingList[] = $databaseInterface->getContentRating($content);
      }
      $randomFloat = mt_rand() / mt_getrandmax();
      $length = count($ratingList);
      for($index =0;$index < $length; $index++) 
      {
        $weighting = $ratingList[$index]/$databaseInterface->getWeightingSum();
        if ($weighting > $randomFloat)
        {
          $sessionInterface->setContent($contentList[$index]);
          $_SESSION['ContentName'] = $contentList[$index];
          $type = $databaseInterface->getContentType($contentList[$index]);
          echo $contentList[$index] . $type;
          if($type == 'article')
            header('location: ./ContentPages/article.php');
          elseif ($type == 'language')
            header('location: ./ContentPages/lang.php');
          elseif ($type == 'quiz')
            header('Location: ./ContentPages/quiz.php');
          elseif ($type == 'video')
            header('Location: ./ContentPages/video.php');
          else
            echo 'Problem occurred';
        }
      }
      $name = $contentList[rand(0, (count($contentList)-1))];
      $sessionInterface->setContent($name);
            $type = $databaseInterface->getContentType($name);
            if($type == 'article')
                header('location: ./ContentPages/article.php');
              elseif ($type == 'language')
                header('location: ./ContentPages/lang.php');
              elseif ($type == 'quiz')
                header('Location: ./ContentPages/quiz.php');
              elseif ($type == 'video')
                header('Location: ./ContentPages/video.php');
              else
                echo 'Problem occurred'; 
    }
  else echo 'Problem occurred no content found!';

?>
</body>
</html>
