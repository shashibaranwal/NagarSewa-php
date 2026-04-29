<?php
  session_start();

  header('Location: login.php');
  exit();

  if (!isset($_SESSION['user_id'])) {
    header('Location: /nagarsewa/features/auth/login.php');
      exit();
  }
  $userName = isset($_SESSION['user_name']) ? $userName = $_SESSION['name'] : 'User';
  $userEmail = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
?>
