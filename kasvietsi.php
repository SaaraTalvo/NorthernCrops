<?php 
  include 'header.php';
  include 'database.php';

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
                <form action="kasvietsi.php" class="form-inline ml-auto" method="post">
                  <input type="text" name="haku" id="haku" placeholder="Hae kasvia nimellä" 
                  class="form-control mr-sm-4">
                  <button type="submit" class="btn btn-outline-secondary">Hae</button>
                </form>
              </div>
            </div>
        </div>
             

    <div class="container">
            <div class="row">
                <h4>Kasvihakemisto</h4><br><br>
            </div>
            
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nimi</th>
                      <th>Tieteellinen nimi</th>
                      <th>Tyyppi</th>
                      <th>Viljely</th>
                      <th>Kasvuaika</th>
                      <th>Korjuu</th>
                      <th>Käyttö</th>
                      <th>Kuva</th>
                    </tr>
                  </thead>

                  <tbody id="kasvit">
                  <?php
                //    include 'database.php';
                   $pdo = Database::connect();
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
                           
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>

           <nav>
                <ul class="pagination">
                  <li class="page-item"><a href="#" class="page-link">Edellinen</a></li>
                  <li class="page-item"><a href="#" class="page-link">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link">Seuraava</a></li>
                </ul>
            </nav>  


        </div>
    </div> <!-- /container -->

   

   <?php include 'footer.php'?>