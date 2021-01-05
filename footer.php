  <!-- FOOTER -->
<br>
  <footer class="container">
    <p class="float-right"><a href="#">Takaisin ylös</a></p>
    <p>&copy; 2020 Saara Talvo &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer> 

<?php
if ( $_SERVER['PHP_SELF'] ==  APPROOT .'index.php' ){
  echo '</main>';
}
?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<?php


if ( $_SERVER['PHP_SELF'] ==  APPROOT .'kayttaja.php' || $_SERVER['PHP_SELF'] ==  APPROOT .'lisaa_kasvi.php'  ){
  echo '<script src="js/main.js"></script>';
}

?>
</body>
</html>