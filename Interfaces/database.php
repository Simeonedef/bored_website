<?php
  class database
  {
    public $userNameError = "";
    public $signUpError="";
    public $emailError="";
    public $loginError="";
    public $passwordError = "";
    public $getSettingError="";
    public $updateSettingError="";
    public $getFilePathError="";
    public $updateUserPrefError="";
    public $userEngDisplayError="";
    public $getContentTagError="";
    public $getContentRatingError="";
    public $checkContentNameError="";
    public $getContentTimingError="";
    public $getContentOwnedError="";


    public $username;


    private $connection;
    private $database_host = "localhost";
    private $database_user = "tmgpexum_z10";
    private $database_pass = "groupz10";
    private $database_name = "tmgpexum_BOREDSITE";

    public function __construct()
    {
      $this->connection = new mysqli($this->database_host, $this->database_user, $this->database_pass, $this->database_name);
      if($this->connection->connect_error)
      {
        die('Connect Error ('.$connection->connect_errno.') ');
      }
    }
    
    function test_input($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


    public function setUserName($usernameInput)
    {
      $this->username=$usernameInput;
    }

    public function addUser($realName, $email, $usernameInput, $password)
    {
      if(!$this->checkUserName($usernameInput))
      {
        $this->userNameError="Username existed or invalid";
        return false;
      }
      else if(!$this->checkEmail($email))
      {
        $this->emailError="Email used or invalid";
        return false;
      }
      else
      {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql_addUser = "INSERT INTO `LOGIN_DETAILS`(`username`, `Email`, `passwordHash`, `realName`) VALUES ('{$usernameInput}', '{$email}', '{$passwordHash}', '{$realName}');";
        $sql_addUser .= "INSERT INTO `USER_DETAILS`(`username`, `realName`, `Email`) VALUES ('{$usernameInput}', '{$realName}', '{$email}');";
        $sql_addUser .= "INSERT INTO `USER_TAGS_RATING`(`username`) VALUES ('{$usernameInput}')";
        $result_addUser=$this->connection->multi_query($sql_addUser);
        if($result_addUser)
          return true;
        else
        {
          $this->signUpError="Problem signing up!";
         return false;
        }
      }

    }


    public function updateResetKey($resetKey, $email)
    {
      $sql_addKey = "UPDATE `LOGIN_DETAILS`
                     SET `resetKey` = '{$resetKey}'
                     WHERE `Email` = '{$email}'";
      return $this->connection->query($sql_addKey);
    }
    public function getResetKey($email)
    {
      $sql_getResetKey = "SELECT `resetKey` FROM `LOGIN_DETAILS`
                          WHERE `Email` = '{$email}'";
      $result_getResetKey = $this->connection->query($sql_getResetKey);
      if($result_getResetKey->num_rows == 0)
        return 0;
      else
      {
        $row = $result_getResetKey->fetch_assoc();
        return $row['resetKey'];
      }
    }

    public function checkLogin($usernameInput,$password)
    {
      if(empty($usernameInput)) //Checks if username is empty
      {
        $this->loginError="Username is required";
        return false;
      }
      else
      {
        $usernameInput=$this->test_input($usernameInput);

        if(empty($password)) //Checks if password is empty
        {
          $this->loginError="Password is required";
          return false;
        }
        else
        {
          //$password=$this->test_input($password);
          $sql_checkUser="SELECT * FROM `LOGIN_DETAILS` WHERE `username`='{$usernameInput}'";
          $nameResult=$this->connection->query($sql_checkUser);
          if($nameResult->num_rows==0)
          {
            $this->loginError="Invalid username or password";
            return false;
          }
          else
          {
            $nameRow=$nameResult->fetch_assoc();
            $passwordHash=$nameRow['passwordHash'];
            if(!password_verify($password,$passwordHash))
            {
              $this->loginError="Wrong username or password";
              return false;
            }
            else
            {
              $this->username=$usernameInput;
              return true;             
            }
          }
          $nameResult->free();
        } 
      }
    }

    public function getUserUploadPrivelege()
    {
      $username = $this->username;
      $sql_getPrivelege = "SELECT `uploadPrivelege` FROM `USER_DETAILS`
                            WHERE `username` = '{$username}'";
      $result = $this->connection->query($sql_getPrivelege);
      if($result->num_rows == 0)
      {
        $getPrivelegeError = "Cannot retrieve data";
        return null;
      }
      else
      {
        $row = $result->fetch_assoc();
        return $row['uploadPrivelege'];
      }
    }
    public function checkEmail($email)
    {
      if(empty($email))
        return false;
      else
      {
        $sql_checkEmail="SELECT * FROM `LOGIN_DETAILS` WHERE `Email`='{$email}'";
        $checkResult=$this->connection->query($sql_checkEmail);
        if($checkResult->num_rows>0)
          return false;
        else
          return true;
        $checkResult->free();
      }
    }
    public function checkUserName($usernameInput)
    {
      if(empty($usernameInput))
        return false;
      else
      {
        $this->test_input($usernameInput);
        $sql_checkUserName="SELECT * FROM `LOGIN_DETAILS` WHERE `username`='{$usernameInput}'";
        $checkResult=$this->connection->query($sql_checkUserName);
        if($checkResult->num_rows>0)
          return false;
        else
          return true;
        $checkResult->free();
      }
    }

    public function updateSessionID($sessionID)
    {
      $username=$this->username;
      if(empty($username))
      {
        $this->updateSessionIDError="Cannot find username.";
        return false;
      }
      else
      {
        $sql_findSession="SELECT `sessionID` FROM `USER_DETAILS`
                          WHERE `username`='{$username}'";
        $result_sessionID=$this->connection->query($sql_findSession);
        if($result_sessionID->num_rows!=1)
        {
          $this->updateSessionIDError="Error retrieving sessionID";
          return false;
        }
        else
        {
          $sql_updateSession="UPDATE `USER_DETAILS`
                              SET `sessionID`='{$sessionID}'
                              WHERE `username`='{$username}'";
          $result_updateSession=$this->connection->query($sql_updateSession);
          if($result_updateSession)
            return true;
          else
          {
            $this->updateSessionIDError="Cannot update session ID.";
            return false;
          }
        }
        $result_sessionID->free();
      }
    }

    public function updateProfilePicture($imagepath)
    {
      $username = $this->username;
      $sql_uploadProf = "UPDATE `USER_DETAILS`
                         SET `profilePic`='{$imagepath}'
                         WHERE `username` = '{$username}'";
      $result_upload = $this->connection->query($sql_uploadProf);
      if($result_upload)
        return true;
      else
        return false;
    }

    public function updatePassword($password, $email)
    {
      $username = $this->username;
      $passwordHash = password_hash($password,PASSWORD_BCRYPT);
      $sql_updatePassword = "UPDATE `LOGIN_DETAILS`
                             SET `passwordHash`='{$passwordHash}'
                             WHERE `Email` = '{$email}'";
      $result_updatePassword = $this->connection->query($sql_updatePassword);
      if ($result_updatePassword)
        return true;
      else
        return false;
    }

    public function getContentType($contentName)
    {
      $sql = "SELECT * FROM `CONTENT_DETAILS` WHERE `ContentName` = '{$contentName}'";
      $result = $this->connection->query($sql);
      $row = $result->fetch_assoc();
      return $row['ContentType'];
    }
    public function getUserSetting($setting)
    {
      $username=$this->username;
      if(empty($username) or empty($setting))
      {
        $this->getSettingError="Error encountered. Please try again later";
        return null;
      }
      else
      {
        $sql_findSetting="SELECT `Setting_Value` FROM `USER_DETAILS`
                          WHERE `username`='{$username}' AND `Setting`='{$setting}'";
        $findSettingResult=$this->connection->query($sql_findSetting);
        if($findSettingResult->num_rows==0)
        {
          $this->getSettingError="Error encountered. Please try again later";
          return null;
        }
        else
        {
          $rowSetting=$findSettingResult->fetch_assoc();
          $setting_value=$rowSetting['Setting_Value'];
          return $setting_value;
        }
        $findSettingResult->free();
      }
    }

    public function updateUsersSettings($setting,$value)
    {
      $username=$this->username;
      if(empty($username) or empty($setting) or empty($value))
      {
        $this->updateSettingError="Error encountered. Please try again later";
        return false;
      }
      else
      {
        $sql_findSetting="SELECT * FROM `USER_DETAILS`
                          WHERE `username`='{$username}' AND `Setting`='{$setting}'";
        $findSettingResult=$this->connection->query($sql_findSetting);
        if($findSettingResult->num_rows==0)
        {
          $this->updateSettingError="Error encountered. Please try again later";
          return false;
        }
        else
        {
          $sql_uploadSetting="UPDATE `USER_DETAILS`
                              SET `Setting_Value` = '{$value}'
                              WHERE `username`='{$username}' AND `Setting`='{$setting}'";
          $uploadSetting=$this->connection->query($sql_uploadSetting);
          if($uploadSetting)
            return true;
          else
          {
            $this->updateSettingError="Error encountered. Please try again later";
            return false;
          }
        }
        $findSettingResult->free();        
      }
    }

    public function getUserPreferences()
    {
      $username=$this->username;
      if(empty($username))
      {
        $this->userPrefDisplayError="Cannot get username";
        return null;
      }
      else
      {
        $sql_findUserTags="SELECT `Tag` FROM `USER_TAGS_RATING`
                       WHERE `username`='{$username}' AND `BoolPreference`='1'";
        $result_tagsRate=$this->connection->query($sql_findUserTags);
        if($result_tagsRate->num_rows==0)
        {
          $this->userPrefDisplayErro="Error encountered. Please try again later";
          return null;
        }
        else
        {
          $tagRateArray=array();
          while($tagRateRow=$result_tagsRate->fetch_assoc())
            $tagRateArray[]=$tagRateRow['Tag'];
          return $tagRateArray;
        }
        $result_tagsRate->free();
      }
    }

    public function getUserNonPreferences()
    {
      $username=$this->username;
      if(empty($username))
      {
        $this->userPrefDisplayError="Cannot get username";
        return null;
      }
      else
      {
        $sql_findUserTags="SELECT `Tag` FROM `USER_TAGS_RATING`
                       WHERE `username`='{$username}' AND `BoolPreference`='0'";
        $result_tagsRate=$this->connection->query($sql_findUserTags);
        if($result_tagsRate->num_rows==0)
        {
          $this->userPrefDisplayError="Error encountered. Please try again later";
          return null;
        }
        else
        {
          $tagRateArray=array();
          while($tagRateRow=$result_tagsRate->fetch_assoc())
            $tagRateArray[]=$tagRateRow['Tag'];
          return $tagRateArray;
        }
        $result_tagsRate->free();
      }
    }

    public function updateUserPreference($tag,$rating)
    {
      $username=$this->username;
      if(empty($username))
      {
        $this->updateUserPrefError="Cannot find user.";
        return false;
      }
      else
      {
        $sql_findTags="SELECT `Tag` FROM `USER_TAGS_RATING`
                       WHERE `Tag`='{$tag}' and `username`='{$username}'";
        $result_findTags=$this->connection->query($sql_findTags);
        if($result_findTags->num_rows==0)
        {
          $sql_addTags = "INSERT INTO `USER_TAGS_RATING`(`username`,`Tag`, `Rating`)
                          VALUES ('{$username}','{$tag}','{$rating}')";
          $result_addTags = $this->connection->query($sql_addTags);
          if(!$result_addTags)
            return false;
        }
        else
        {
          if($rating >= 7)

            $sql_updatePref="UPDATE `USER_TAGS_RATING`
                           SET `Rating`='{$rating}', `BoolPreference`=1
                           WHERE `Tag`='{$tag}' and `username`='{$username}'";
          else
            $sql_updatePref="UPDATE `USER_TAGS_RATING`
                           SET `Rating`='{$rating}'
                           WHERE `Tag`='{$tag}' and `username`='{$username}'";
          $updatePref=$this->connection->query($sql_updatePref);
          if($updatePref)
            return true;
          else
          {
            $this->updateUserPrefError="Update error";
            return false;
          }
        }
        $result_findTags->free();
      }
    }



    public function getUserDetails()
    {
      $username=$this->username;
      if(empty($username))
      {
        return null;
      }
      else
      {
        $sql_getUserDetails = "SELECT * FROM `USER_DETAILS` WHERE `username` = '{$username}'";
        $getDetailResult = $this->connection->query($sql_getUserDetails);
        if($getDetailResult->num_rows==1)
        {
          $detailRow = $getDetailResult->fetch_assoc();
          return $detailRow;
        }
        else
        {
          return null;
        }
      }        
      
        
    }
    //This function checks for the same content name in the database
    public function checkContentName($contentName)
    {
      if(empty($contentName))
      {
        $this->checkContentNameError="No content name found.";
        return false;
      }
      else
      {
        $sql_checkContent="SELECT * FROM `CONTENT_DETAILS` WHERE `ContentName`='{$contentName}'";
        $checkContentResult=$this->connection->query($sql_checkContent);
        if($checkContentResult->num_rows>0)
        {
          $this->checkContentNameError="Content name already exists.";
          return false;
        }
        else
        {
          return true;
        }
      }
      $checkContentResult->free();
    }


    public function getContentOwned()
    {
      $username = $this->username;
      if(empty($username))
      {
        $this->getContentOwnedError = "Cannot retrieve content";
        return null;
      }
      else
      {
        $sql_getContentOwned = "SELECT `ContentName` FROM `CONTENT_DETAILS`
                                WHERE `ContentOwner` = '{$username}'";
        $getContentOwnedResult = $this->connection->query($sql_getContentOwned);
        if($getContentOwnedResult != null)
        {
          $contentName = array();
          while($thisRow = $getContentOwnedResult->fetch_assoc())
            $contentName[] = $thisRow['ContentName'];
          return $contentName;
        }
        else
        {
          return null;
        }
      }
    }

    public function getContentFilePath($contentName)
    {
      if(empty($contentName))
      {
        $this->getFilePathError="Cannot find content" .$contentName;
        return null;
      }
      else
      {
        $sql_getContentPath="SELECT * FROM `CONTENT_DETAILS`
                             WHERE `ContentName`='{$contentName}'";
        $result_getContentPath=$this->connection->query($sql_getContentPath);
        if($result_getContentPath->num_rows!=1)
        {
          $this->getFilePathError="Error fetching content";
          return null;
        }
        else
        {
          $contentRow=$result_getContentPath->fetch_assoc();
          return $contentRow['ContentPath'];
        }
        $result_contentPath->free();
      }
    }

    public function getTags()
    {
      $sql_getTag = "SELECT `Tag` FROM `OVERALL_TAGS_RATING`";
      $result = $this->connection->query($sql_getTag);
      if($result->num_rows==0)
        return null;
      else
      {
        $tags = array();
        while($row = $result->fetch_assoc())
          $tags[] = $row['Tag'];
        return $tags;
      }
      return null;
    }
    
    public function getContentTags($contentName)
    {
      if(empty($contentName))
      {
        $this->getContentTagError="No content name input";
        return null;
      }
      else
      {
        $sql_getContentTags="SELECT DISTINCT `Tags` FROM `CONTENT_TAGS`
                             WHERE `ContentName`='{$contentName}'";
        $result_getContentTags=$this->connection->query($sql_getContentTags);
        if($result_getContentTags->num_rows==0)
        {
          $this->getContentTagError="Cannot find tags";
          return null;
        }
        else
        {
          $rowTags=array();
          while($rowTag=$result_getContentTags->fetch_assoc())
            $rowTags[]=$rowTag['Tags'];
          return $rowTags;
        }
        $result_getContentTags->free();
      }
    }

    public function getContentRating($contentName)
    {
      if(empty($contentName))
      {
        $this->getContentRatingError="No content name input";
        return null;
      }
      else
      {
        $sql_getContentRate="SELECT `AverageRating` FROM `CONTENT_DETAILS`
                             WHERE `ContentName`='{$contentName}'";
        $result_getContentRate=$this->connection->query($sql_getContentRate);
        if($result_getContentRate->num_rows == 0)
        {
          $this->getContentRatingError="Error retrieving rating";
          return null;
        }
        else
        {
          $ratingRow=$result_getContentRate->fetch_assoc();
          $rating=$ratingRow['AverageRating'];
          return $rating;
        }
        $result_getContentRate->free();
      }
    }

    public function getAssociatedContent($tag)
    {
      if(empty($tag))
      {
        $this->getAssociatedContentError = "Error encountered";
        return null;
      }
      else
      {
        $sql_getAssociatedContent = "SELECT * FROM `CONTENT_TAGS`
                                     WHERE `Tags`='{$tag}'";
        $result_associatedContent = $this->connection->query($sql_getAssociatedContent);
        if($result_associatedContent->num_rows==0)
        {
          $this->getAssociatedContentError= "No content found for this tag";
          return null;
        }
        else
        {
          $contentArray=array();
          while($contentRow=$result_associatedContent->fetch_assoc())
            $contentArray[]=$contentRow;
          return $contentArray;
        }
        $result_associatedContent->free();
      }
    }

    public function getViews($contentName)
    {
      $sql_getView = "SELECT (`NoOfViews`) FROM `CONTENT_DETAILS`
                      WHERE `ContentName`='{$contentName}'";
      $result_getView = $this->connection->query($sql_getView);
      if($result_getView->num_rows == 0)
        return 0;
      else
      {
        $viewRow = $result_getView->fetch_assoc();
        return $viewRow['NoOfViews'];
      }
    }


    public function getContentItems()
    {
      $sql_listItem = "SELECT (`ContentName`) FROM `CONTENT_DETAILS`";
      $result_getContentItems=$this->connection->query($sql_listItem);
      if($result_getContentItems->num_rows == 0)
        return null;
      else
      {
        $contentList = array();
        while($contentListRow = $result_getContentItems->fetch_assoc())
          $contentList[] = $contentListRow['ContentName'];
        return $contentList;
      }
      $result_getContentItems->free();
    }

    public function getWeightingSum()
    {
      $sql = "SELECT SUM(AverageRating) FROM `CONTENT_DETAILS`";
      $result = $this->connection->query($sql);
      $sum = $result->fetch_assoc();
      return $sum['SUM(AverageRating)'];
    }

    public function getContentWeightings()
    {
      $sql_getContentWeighting = "SELECT (`ContentName`,`AverageWeighting`) FROM `CONTENT_DETAILS`";
      $result_getContentWeighting = $this->connection->query($sql_getContentWeighting);
      if($result_getContentWeighting->num_rows ==0)
        return null;
      else
      {
        $contentWeightingArray = array();
        while($weightingRow = $result_getContentWeighting->fetch_assoc())
          $contentWeightingArray[]=$weightingRow;
        return $contentWeightingArray;
      }
      $result_getContentWeighting->free();
    }

    public function updateContentRating($contentName, $rating)
    {
      if(!$this->checkContentName($contentName))
        return false;
      $noOfViews = $this->getViews($contentName);
      $oldRating = $this->getContentRating($contentName);

      $newRating = ($rating + $oldRating*$noOfViews)/($noOfViews+1);
      $noOfViews++;
      $sql_updateContentWeighting = "UPDATE `CONTENT_DETAILS`
                                     SET `AverageRating`='{$newRating}', `NoOfViews`='{$noOfViews}'
                                     WHERE `ContentName` = '{$contentName}'";
      $result_updateContentWeighting = $this->connection->query($sql_updateContentWeighting);
      if(!$result_updateContentWeighting)
        return false;
      else
        return true;
    }

    public function updateTagRating($value,$tag)
    {
      if(empty($tag) or empty($value))
      {
        $this->updateTagRatingError="Error encountered";
        return false;
      }
      else
      {
        $sql_findTagRow="SELECT * FROM `OVERALL_TAGS_RATING`
                         WHERE `Tag`='{$tag}'";
        $result_findTagRow=$this->connection->query($sql_findTagRow);
        if($result_findTagRow->num_rows==0)
        {
          $this->updateTagRatingError="No tag found.";
          return false;
        }
        else
        {
          $tagRow=$result_findTagRow->fetch_assoc();
          $noOfRatings=$tagRow['noOfRatings'];
          $oldRating = $tagRow['Rating'];
          $newNoOfRatings=$noOfRatings+1;
          $newRating = ($oldRating*$noOfRatings+$value)/$newNoOfRatings;
          $sql_updateTagRating="UPDATE `OVERALL_TAGS_RATING`
                                SET `Rating`='{$newRating}',`noOfRatings`='{$newNoOfRatings}'
                                WHERE `Tag`='{$tag}'";
          $result_updateTagRating=$this->connection->query($sql_updateTagRating);
          if(!$result_updateTagRating)
          {
            $this->updateTagRatingError="Error updating";
            return false;
          }
          else
            return true;
        }
        $result_findTagRow->free();
      }
    }

    public function uploadContent($contentName, $tags, $path, $type)
    {
      $username =$this->username;
      if($this->checkContentName($contentName))
      {
        $sql_addContent = "INSERT INTO `CONTENT_DETAILS`(`ContentName`, `ContentOwner`,
                          `ContentPath`, `ContentType`) VALUES ('{$contentName}', '{$username}', '{$path}', '{$type}')";
        if($this->connection->multi_query($sql_addContent))
        {
          foreach ($tags as $tag) 
          {
            $sql_checkTag = "SELECT * FROM `OVERALL_TAGS_RATING`
                             WHERE `Tag`='{$tag}'";
            $result_checkTag = $this->connection->query($sql_checkTag);
            if($result_checkTag->num_rows == 0)
            {
              $sql_insertTag = "INSERT INTO `OVERALL_TAGS_RATING`(`Tag`)
                                VALUES ('{$tag}')";
            $this->connection->query($sql_insertTag);
            }
            $sql_addTag = "INSERT INTO `CONTENT_TAGS`(`ContentName`, `Tags`)
                           VALUES ('{$contentName}', '{$tag}')";
            $this->connection->query($sql_addTag);
          }
          return true;
        }
      }
      else
        return false;
    }

    public function addArticle($title, $subtitle, $article, $author)
    {

        $sql_addArticle = $this->connection->prepare("INSERT INTO `CONTENT_ARTICLE`(`ContentName`,`Subtitle`,`Article`,`Author`) VALUES (?,?,?,?)");
        $sql_addArticle->bind_param("ssss", $title, $subtitle, $article, $author);
        $result = $sql_addArticle->execute();
        return $result;
    }

    public function addLanguage($title, $word1, $word1tr, $word2, $word2tr, $word3, $word3tr, $word4, $word4tr, $word5, $word5tr, $folder, $author)
    {
        $audio1 = $folder .'audio1.mp3';
        $audio2 = $folder .'audio2.mp3';
        $audio3 = $folder .'audio3.mp3';
        $audio4 = $folder .'audio4.mp3';
        $audio5 = $folder .'audio5.mp3';
        $sql_addLanguage = $this->connection->prepare("INSERT INTO `CONTENT_LANG`(`ContentName`, `Word1`, `Word1_TR`, `Word2`, `Word2_TR`, `Word3`, `Word3_TR`, `Word4`, `Word4_TR`, `Word5`, `Word5_TR`,`Word1_AUDIO`, `Word2_AUDIO`,`Word3_AUDIO`, `Word4_AUDIO`, `Word5_AUDIO`, `Author`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql_addLanguage->bind_param("sssssssssssssssss",$title, $word1, $word1tr, $word2, $word2tr, $word3, $word3tr, $word4, $word4tr, $word5, $word5tr, $audio1, $audio2, $audio3, $audio4, $audio5, $author);
        $result = $sql_addLanguage->execute();
        return $result;
    }

    public function addQuiz($title, $question, $hint, $answer1, $answer2, $answer3, $answer4, $correctAnswer, $author)
    {

        $sql_addQuiz = $this->connection->prepare("INSERT INTO `CONTENT_QUIZ`(`ContentName`, `Question`, `Answer1`, `Answer2`, `Answer3`, `Answer4`, `AnswerCorrect`, `Hint`, `Author`) VALUES (?,?,?,?,?,?,?,?,?)");
        $sql_addQuiz->bind_param("sssssssss", $title, $question, $answer1, $answer2, $answer3, $answer4, $correctAnswer, $hint, $author);
        $result = $sql_addQuiz->execute();
        return $result;

    }

    public function addVideo($title, $description, $link, $author)
    {
    
        $sql_addVideo = $this->connection->prepare("INSERT INTO `CONTENT_VIDEO`(`ContentName`, `Subtitle`, `VideoLink`, `Author`) VALUES (?,?,?,?)");
        $sql_addVideo->bind_param("ssss", $title, $description, $link, $author);
        $result = $sql_addVideo->execute();
        return $result;

    }

    public function getArticle($title)
    {
      if(empty($title))
        return null;
      else
      {
        $sql_getArticle = "SELECT * FROM `CONTENT_ARTICLE` WHERE `ContentName` = '{$title}'";
        $result = $this->connection->query($sql_getArticle);
        if($result->num_rows == 0)
          return null;
        else
          return $result->fetch_assoc();
      }
    }

    public function getLangugage($title)
    {
      if(empty($title))
        return null;
      else
      {
        $sql_getLang = "SELECT * FROM `CONTENT_LANG` WHERE `ContentName` = '{$title}'";
        $result = $this->connection->query($sql_getLang);
        if($result->num_rows == 0)
          return null;
        else return $result->fetch_assoc();
      }
    }

    public function getQuiz($title)
    {
      if(empty($title))
        return null;
      else
      {
        $sql_getQuiz = "SELECT * FROM `CONTENT_QUIZ` WHERE `ContentName` = '{$title}'";
        $result = $this->connection->query($sql_getQuiz);
        if($result->num_rows == 0)
          return null;
        else
          return $result->fetch_assoc();
      }
    }

    public function getVideo($title)
    {
      if(empty($title))
        return null;
      else
      {
        $sql_getVideo = "SELECT * FROM `CONTENT_VIDEO` WHERE `ContentName` = '{$title}'";
        $result = $this->connection->query($sql_getVideo);
        if($result->num_rows == 0)
          return null;
        else return $result->fetch_assoc();
      }
    }
    public function deleteKey($email)
    {
      $sql_deleteResetKey = "UPDATE `LOGIN_DETAILS` SET `resetKey` = 0 WHERE `Email` = '{$email}'";
      return $this->connection->query($sql_deleteResetKey);
    }

    public function __destruct()
    {
      $this->connection->close();
    }
  }
?>
