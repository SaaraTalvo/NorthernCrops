<?php 
  include 'header.php';
  include 'database.php';

  if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
    header("location: kirjaudu.php");
    exit;
  }

  $pdo = Database::connect();
  $pdo->exec("set names utf8");

  $sql = "SELECT COUNT(*) FROM kasvi";
  $count = $pdo->query($sql)->fetchColumn();

  $hakusana = '';

  if(!empty($_POST)){
    $hakusana = $_POST['haku'];    
  }
?>

        <div class="col-md-4 col-md-offset-4">
            <div class="input-group m-4">
              <div class="form-inline ml-auto">
                <form action="kasvi.php" class="form-inline ml-auto" method="post">
                  <input type="text" name="haku" id="haku" placeholder="Hae kasvia" 
                  class="form-control mr-sm-4">
                  <button type="submit" class="btn btn-outline-secondary">Hae</button><br><br>
                </form>
              </div>
            </div>  
        </div>

    <div class="container">
            <div class="row">
                <h4>Kasvitiedot</h4>
            </div>

            <div class="row"></div>
            
            <div>
              <a href="lisaa_kasvi.php" class="btn btn-secondary" >Lisää uusi kasvi</a>
            </div><br>
                
                <table class="table table-bordered table-responsive">
                  <thead style="background-color: #e3f2fd;">   

                    <tr>
                      <th>Nimi</th>
                      <th>Tieteellinen nimi</th>
                      <th>Tyyppi</th>
                      <th>Viljely</th>
                      <th>Kasvuaika</th>
                      <th>Korjuu</th>
                      <th>Käyttö</th>
                      <th>Kuva</th>
                      <th>Toiminnot</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php
                    $pdo = Database::connect();
                    //  $pdo->exec("set names utf8");
                    //  $sql = 'SELECT * FROM kasvi';
                    $sql = 'SELECT * FROM kasvi a
                    WHERE nimi LIKE "%' . $hakusana . '%"';
                    foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['nimi'] . '</td>';
                            echo '<td>'. $row['tieteellinen_nimi'] . '</td>';
                            echo '<td>'. $row['tyyppi'] . '</td>';
                            echo '<td>'. $row['viljely'] . '</td>';
                            echo '<td>'. $row['kasvuaika'] . '</td>';
                            echo '<td>'. $row['korjuu'] . '</td>';
                            echo '<td>'. $row['kaytto'] . '</td>';
                            echo '<td><img style="width:100px" src= "img/'. $row['kuva'] . '"></td>';
                            
                            echo '<td><a class="btn btn-secondary" href="paivita_kasvi.php?id='.$row['kasviID'].'">Päivitä</a>';
                            echo ' ';
                            echo '<a class="btn btn-dark poista" data-content="Haluatko varmasti poistaa kasvin, ' .$row['nimi'] . ' ' . $row['tieteellinen_nimi'] . ', tiedot?" href="poista_kasvi.php?id='.$row['kasviID'].'">Poista</a>';
					                  echo '</td>';
                            echo '</tr>';
                    }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>

            <!-- <nav>
                <ul class="pagination">
                  <li class="page-item"><a href="#" class="page-link">Edellinen</a></li>
                  <li class="page-item"><a href="#" class="page-link">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link">Seuraava</a></li>
                </ul>
              </nav> -->

        </div>
    </div> <!-- /container -->

   <?php include 'footer.php'?>