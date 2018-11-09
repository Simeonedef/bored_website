<?php

  class contentMatcher
  {
    private $databaseInterface;
    private $sessionInterface;
    private $username;
    function __construct($username)
    {
      $this->databaseInterface = new database();
      $this->sessionInterface = new session();
      $this->username = $this->sessionInterface->getLogin();
      $this->databaseInterface->setUsername($username);
    }

    function updateWeightings($contentName, $rating)
    {
      $tags = $this->databaseInterface->getContentTags($contentName);
      $affectedContent = array();
      //Update the users tag ratings
      foreach($tags as $currentTag)
      {
        $this->databaseInterface->updateTagRating($rating, $currentTag);
        $affectedContent = array_merge($affectedContent, $this->databaseInterface->getAssociatedContent($tag));
      }
      $affectedContent = array_unique($affectedContent);
      //Update the weighting for each content item
      foreach($affectedContent as $currentContentItem)
      {
        $averageRatingting = average($this->databaseInterface->getContentRating($currentItem));
        $averageTiming = average($this->databaseInterface->getContentTiming($username, $currentItem));
        $currentWeighting = pow($average, 2) * sFunction($averageTiming, $this->databaseInterface->getExpectedTime($currentContentItem));
        $this->databaseInterface->updateContentWeighting($currentContentItem, $currentWeighting);
      }
    }

    function chooseContent()
    {
      $contentWeightings = $this->databaseInterface->getContentWeightings();
      $randomFloat = mt_rand() / mt_getrandmax();
      $randomFloat *= $this->databaseInterface->getWeightingSum();
      $sum = 0;
      foreach($contentWeightings as $contentName => $currentWeighting)
      {
  			$sum += $currentWeighting;
  			if($sum > $randomFLoat)
  			{
  				return $contentName;
  			}
      }
  		return null;
    }

    function chooseRandomContent()
    {
      $content = $this->databaseInterface->getContentItems();
      return $content[array_rand($content)];
    }

    function average($values)
    {
      $sum = 0;
      foreach($values as $currentValue)
      {
        $sum += $currentValue;
      }
      return ($sum / count($values));
    }

    function sFunction($averageTime, $expectedTime)
    {
      $value = $averageTime / $expectedTime;
      if($value > 2)
      {
        $value = 2;
      }
      return $value;
    }

    function assignProbabilities($contentList)
    {
      $probabilities = array();
      $totalWeighting = 0;
      foreach($contentList as $currentItem)
      {
        $averageRating = average($this->databaseInterface->getContentRatings($username, $currentItem));
        $averageTiming = average($this->databaseInterface->getContentTiming($username, $currentItem));
        $currentWeighting = pow($average, 2) * sFunction($averageTiming);
        $totalWeighting += $currentWeighting;
        array_push($probabilities, $currentWeighting);
      }
      for($index = 0; $index < count($probabilities); $index++)
      {
        $probabilities[$index] /= $totalWeighting;
      }
      return array_combine($contentList, $probabilities);
    }

  }
?>
