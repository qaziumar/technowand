<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Umar Adil for Technowand</title>
  </head>
  <body>


    <div class="container">
  <!-- Content here -->


    <h1>Welcome <?php 
    if(isset($_SESSION['login']) && ! empty($_SESSION['login'])  && $_SESSION['login'] == 'yes') 
    { 
      echo $_SESSION['full_name'];
    }
    else
    {
      echo "Guest";
    } 
    ?> </h1>


<?php 
if(isset($_SESSION['success']) && ! empty($_SESSION['success']))
{
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$_SESSION['success'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'; 

  #unset($_SESSION['success']);
}
elseif(isset($_SESSION['error']) && ! empty($_SESSION['error']))
{
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$_SESSION['error'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
  #unset($_SESSION['error']);
}
?>

    <!-- Optional JavaScript; choose one of the two! -->

<ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
  </li>
   <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="techno.sql">Database</a>
  </li>
  <?php if(isset($_SESSION['login']) && ! empty($_SESSION['login'])  && $_SESSION['login'] == 'yes') { ?>
      <li class="nav-item">
        <a class="nav-link" href="list_offers.php">List Offers</a>
      </li>

      <?php if($_SESSION['is_admin'] == 'Y') { ?>
      <li class="nav-item">
        <a class="nav-link" href="create_offer.php">Create offer</a>
      </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    <?php

  } else {
    ?>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>

    <?php } ?>


  
   
</ul>