<?php
  class session
  {
    function __construct()
    {
      if(!isset($_SESSION))
        $this->init_session();
    }

    function init_session()
    {
      session_start();
    }
    function setLoggedIn($username)
    {
      $_SESSION["username"] = $username;
    }

    function getLogin()
    {
      if (isset($_SESSION['username']))
      {
        return $_SESSION["username"];
      }
        return null;
    }

    function setContent($contentName)
    {
      $_SESSION["contentName"] = $contentName;
    }

    function getContent()
    {
      if (isset( $_SESSION['contentName'] ))
      {
        return $_SESSION["contentName"];
      }
        return null;

    }

    function endSession()
    {
      session_unset();
      session_destroy();
    }
  }
?>
