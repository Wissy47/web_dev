<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="mystyle.css">
    <title>My Webpage</title>
      <script src="https://kit.fontawesome.com/9783c69641.js" crossorigin="anonymous"></script>
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">OmaGym</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

   <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item mx-3">
        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mx-3">
        <a class="nav-link" href="plans.php">Plans | Price</a> 
      </li>
        <li class="nav-item mx-3">
        <a class="nav-link" href="classes.php">Classes</a>
      </li>
        <li class="nav-item mx-3">
        <a class="nav-link" href="about_us.php">About Us</a>
      </li>
      <li class="nav-item mx-3">
           <?php if ($_SESSION['id']) { ?>
      
        <a class="btn btn-success" href="?function=logout">Logout</a>
      
      <?php } else { ?>
      <button class="btn btn-success" type="button" data-toggle="modal" data-target="#exampleModal" type="submit">Sign up &#124; Log in</button>  
      <?php } ?>
            
      </li>
    </ul>
  </div>
</nav> 
<?php if ($_SESSION['id']) { ?>
<nav class="navbar navbar-expand" style="background-color: #e3f2fd;">
  <?php

    $tsql = "SELECT * FROM `users` WHERE `id` = '".mysqli_real_escape_string($link, $_SESSION['id'])."' LIMIT 1";
    $result = mysqli_query($link, $tsql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['firstname'];
        
    echo "Welcome, $name";
    ?>
     <ul class="navbar-nav ml-auto">
        <li class="nav-item">
           <a class="nav-link mx-3" href="#"><i class="fas fa-bell"></i></a>
        </li>
        <li class="nav-item">
           <a class="nav-link mx-3" href="#"><i class="fas fa-envelope"></i></a>
        </li>
     </ul>  
</nav>

<?php } ?>