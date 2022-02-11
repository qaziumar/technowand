<?php  session_start();
session_destroy();
$_SESSION['success'] = 'Logout success';
header('Location: index.php');
?>