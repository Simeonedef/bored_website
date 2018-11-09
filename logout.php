<?php
  session_start();
  unset($_SESSION['user']); // remove individual session var
  session_destroy();
  header('location: index.php'); // redirct to certain page now
?>