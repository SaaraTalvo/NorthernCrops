<?php 
  include 'header.php'; 
  include 'database.php';
  
  $pdo = Database::connect();
  $pdo->exec("set names utf8");

  $sql = "SELECT COUNT(*) FROM kayttaja";
  $count = $pdo->query($sql)->fetchColumn();

  $hakusana = '';

  if(!empty($_POST)){
    $hakusana = $_POST['haku'];    
  }
?>



            <div class="col-md-4 col-md-offset-4">
              <div class="input-group m-4">
                <div class="form-inline ml-auto">
                  <form action="kayttaja.php" class="form-inline ml-auto" method="post">
                    <input type="text" name="haku" id="haku" placeholder="Hae käyttäjää" 
                    class="form-control mr-sm-4">
                    <button type="submit" class="btn btn-outline-secondary">Hae</button>
                  </form>
                </div>
              </div>
            </div>


    <div class="container">
            <div class="row">
                <h4>Käyttäjätiedot</h4><br>
            </div>
            
            <div class="row"></div>

            <div>
            <a href="lisaa_kayttaja.php" class="btn btn-secondary">Lisää uusi käyttäjä</a>
            </div><br>

                <table class="table table-bordered table-responsive">
                  <thead style="background-color: #e3f2fd;">
                    <tr>
                      <th>Nimi</th>
                      <th>Sähköposti</th>
                      <th>Osoite</th>
                      <th>Postinumero</th>
                      <th>Postitoimipaikka</th>
                      <th>Kasvuvyohyke</th>
                      <th>Toiminnot</th>
                    </tr>
                  </thead>

                  <tbody id="kayttajat">
                  <?php
                   $sql = 'SELECT *
                          FROM
                          (SELECT *, CONCAT(etunimi, " ", sukunimi) nimi
                          FROM kayttaja) a
                          WHERE nimi LIKE "%' . $hakusana . '%"';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['nimi'] . '</td>';
                            echo '<td>'. $row['sahkoposti'] . '</td>';
                            echo '<td>'. $row['lahiosoite'] . '</td>';
                            echo '<td>'. $row['postinumero'] . '</td>';
                            echo '<td>'. $row['postitoimipaikka'] . '</td>';
                            echo '<td>'. $row['kasvuvyohyke'] . '</td>';
                            
                            // echo '<td><a class="btn btn-light" href="katso_kayttaja.php?id='.$row['kayttajaID'].'">Katso</a>';
                            // echo ' ';
                            echo '<td><a class="btn btn-secondary" href="paivita_kayttaja.php?id='.$row['kayttajaID'].'">Päivitä</a>';
                            echo ' ';
                            echo '<a class="btn btn-dark" href="poista_kayttaja.php?id='.$row['kayttajaID'].'">Poista</a>';
                            echo '</td>';
                            echo '</tr>';

                            //laatikkotyylin delete 
                            // echo '<a class="btn btn-dark poista" data-content="Haluatko varmasti poistaa asiakkaan ' . $row['etunimi'] . ' ' . $row['sukunimi'] . ' tiedot?" href="poista_kayttaja.php?id='.$row['kayttajaID'].'">Poista</a>';
					                  // echo '</td>';
                            // echo '</tr>';
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
	
<?php 
	include 'footer.php'; 
?>