<?php 
if( ! isset($_SESSION['login']) || $_SESSION['login'] != 'yes')
{
  $_SESSION['error'] = 'Please login first';
  header('Location: login.php');
}
?>

