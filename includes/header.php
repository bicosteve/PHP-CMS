<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $currentPage; ?></title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light main__nav">
    <div class="container">
      <a class="navbar-brand" href="index.php">DocLink</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <?php if(isset($_SESSION['username'])): ?>
          <li class="nav-item"><a class="nav-link" href="list.php">Patients</a></li>
          <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="book.php">Book</a></li>
          <?php endif; ?>
        </ul>
        <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['username'])): ?>
          <li class="nav-item"><a class="nav-link" href="views/logout-server.php">Logout</a></li>
          <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>