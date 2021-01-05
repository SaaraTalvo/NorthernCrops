<?php
  require 'config.php';
  // Initialize the session
  session_start();

  // if ( $_SERVER['PHP_SELF'] !=  APPROOT .'index.php' ){
  //   if ( $_SERVER['PHP_SELF'] !=  APPROOT .'kirjaudu.php' ){
  //     if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
  //       header("location: kirjaudu.php");
  //       exit;
  //     }
  //   }
  // }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Northern Crops</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />
    <!-- Favicons -->

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">
    <!-- <link href="open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet"> -->

  </head>
  <body>
    <header>
    
      <!-- <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"> -->
      <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background-color: #e3f2fd;">
      

        <a class="navbar-brand mb-4 h1" href="index.php"><?php echo SITENAME; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">

          <ul class="navbar-nav mr-auto">
          
          <!-- näkyvillä rekisteröityneille käyttäjille -->
          <?php if( isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true ): ?>
            <li class="nav-item">
              <a class="nav-link" href="kayttaja.php"> Käyttäjät <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="kasvi.php"> Kasvitietojen editointi <span class="sr-only"></span></a>
            </li>
            <?php endif; ?>

          <!-- näkyvillä kaikille -->
            <li class="nav-item">
              <a class="nav-link" href="veggies.php"> Kasvit ryhmittäin <span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="kasvietsi.php"> Kasvihakemisto <span class="sr-only"></span></a>
            </li>
            </ul>
            
          
          <?php if( isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true ): ?>
            <a class="nav-link" href="ulos.php">Ulos</a>
          <?php else: ?>
            <a class="nav-link"  href="kirjaudu.php">Kirjaudu</a>
            <a class="nav-link"  href="rekisteroidy.php">Rekisteröidy</a>
          <?php endif; ?>

        </div>
      </nav>
      <br><br>
    </header>