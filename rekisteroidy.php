<?php 
  include 'header.php'; 
  include 'database.php';

 
 if ( !empty($_POST)) {
        // keep track validation errors
        $etunimiError = null;
        $sukunimiError = null;
        $sahkopostiError = null;
        $henkilotunnusError = null;
        $lahiosoiteError = null;
        $postinumeroError = null;
        $postitoimipaikkaError = null;
        $kasvuvyohykeError = null;
        $kayttajatunnusError = null;
        $salasanaError = null;
         
        // keep track post values
        $etunimi = $_POST['etunimi'];
        $sukunimi = $_POST['sukunimi'];
        $sahkoposti = $_POST['sahkoposti'];
        $henkilotunnus = $_POST['henkilotunnus'];
        $lahiosoite = $_POST['lahiosoite'];
        $postinumero = $_POST['postinumero'];
        $postitoimipaikka = $_POST['postitoimipaikka'];
        $kasvuvyohyke = $_POST['kasvuvyohyke'];
        $kayttajatunnus = $_POST['kayttajatunnus'];
        $salasana = $_POST['salasana'];
        
         
        // validate input
        $valid = true;
        if (empty($etunimi)) {
            $etunimiError = 'Syötä etunimi';
            $valid = false;
        }

        if (empty($sukunimi)) {
            $sukunimiError = 'Syötä sukunimi';
            $valid = false;
        }

        if (empty($sahkoposti)) {
            $sahkopostiError = 'Syötä sähkoposti';
            $valid = false;
        }
      /*  else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false; */

        if (empty($henkilotunnus)) {
            $henkilotunnusError = 'Syötä henkilötunnus';
            $valid = false;
    
        }

         if (empty($lahiosoite)) {
            $lahiosoiteError = 'Syötä lähiosoite';
            $valid = false;
        }

        if (empty($postinumero)) {
            $postinumeroError = 'Syötä postinumero';
            $valid = false;
        }
 

        if (empty($postitoimipaikka)) {
            $postitoimipaikkaError = 'Syötä postitoimipaikka';
            $valid = false;
        }

        if (empty($kasvuvyohyke)) {
            $kasvuvyohykeError = 'Syötä kasvuvyöhykenumero';
            $valid = false;
        }

        if (empty($kayttajatunnus)) {
            $kayttajatunnusError = 'Syötä käyttäjätunnus';
            $valid = false;
        }

        if (empty($salasana)) {
            $salasanaError = 'Syötä salasana';
            $valid = false;
        }

         
        // insert data
        if ($valid) {
            $salasana = password_hash($salasana, PASSWORD_DEFAULT);

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO kayttaja (etunimi, sukunimi, sahkoposti, henkilotunnus, lahiosoite, postinumero, postitoimipaikka, kasvuvyohyke, kayttajatunnus, salasana) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
			      $pdo->exec("set names utf8");
            $q->execute(array($etunimi, $sukunimi, $sahkoposti, $henkilotunnus, $lahiosoite, $postinumero, $postitoimipaikka, $kasvuvyohyke, $kayttajatunnus, $salasana));
            Database::disconnect();
            header("Location: welcome.php"); 
        }
    }
?>

 <div class="container">
      <div class="card bg-light">
         <div class="card-header">
            <h4>Rekisteröidy ja luo tunnukset:</h4>
        </div>

        <div class="body my-3 px-3">
                        <form class="form-horizontal" action="rekisteroidy.php" method="post" enctype="multipart/form-data">

                    <div class="form-group row <?php echo !empty($etunimiError)?'alert-info':'';?>">
                    <label class="col-sm-2 col-form-label">Etunimi</label>
                      <div class = "col-sm-10">
                      <input name="etunimi" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'etunimi'" class="form-control"  placeholder="Etunimi" value="<?php echo !empty($etunimi)?$etunimi:'';?>">
                                    <?php if (!empty($etunimiError)): ?>
                             <small class = "text-muted">
                                <?php echo $etunimiError;?>
                             </small>
                          <?php endif; ?>
                      </div>
                    </div>        
                    <div class="form-group row <?php echo !empty($sukunimiError)?'alert-info':'';?>">
                    <label class="col-sm-2 col-form-label">sukunimi</label>
                    <div class = "col-sm-10">
                    <input name="sukunimi" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'sukunimi'" class="form-control"  placeholder="Sukunimi" value="<?php echo !empty($sukunimi)?$sukunimi:'';?>">
                                    <?php if (!empty($sukunimiError)): ?>
                             <small class = "text-muted">
                                <?php echo $sukunimiError;?>
                             </small>
                          <?php endif; ?>
                      </div>
                    </div>
                    <div class="form-group row <?php echo !empty($sahkopostiError)?'alert-info':'';?>">
                    <label class="col-sm-2 col-form-label">sahkoposti</label>
                      <div class = "col-sm-10">
                      <input name="sahkoposti" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'sahkoposti'" class="form-control"  placeholder="Sahkoposti" value="<?php echo !empty($sahkoposti)?$sahkoposti:'';?>">
                          <?php if(!empty($sahkopostiError)): ?>
                             <small class = "text-muted">
                                <?php echo $sahkopostiError;?>
                             </small>
                          <?php endif; ?>
                      </div>
                    </div> 
                    <div class="form-group row <?php echo !empty($henkilotunnusError)?'alert-info':'';?>">
                    <label class="col-sm-2 col-form-label">henkilotunnus</label>
                      <div class = "col-sm-10">
                      <input name="henkilotunnus" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'henkilotunnus'" class="form-control"  placeholder="Henkilotunnus" value="<?php echo !empty($henkilotunnus)?$henkilotunnus:'';?>">
                          <?php if(!empty($henkilotunnusError)): ?>
                             <small class = "text-muted">
                                <?php echo $henkilotunnusError;?>
                             </small>
                          <?php endif; ?>
                      </div>
                    </div>  
                    <div class="form-group row <?php echo !empty($lahiosoiteError)?'alert-info':'';?>">
                    <label class="col-sm-2 col-form-label">lahiosoite</label>
                      <div class = "col-sm-10">
                      <input name="lahiosoite" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'lahiosoite'" class="form-control"  placeholder="Lähiosoite" value="<?php echo !empty($lahiosoite)?$lahiosoite:'';?>">
                          <?php if(!empty($lahiosoiteError)): ?>
                             <small class = "text-muted">
                                <?php echo $lahiosoiteError;?>
                             </small>
                          <?php endif; ?>
                      </div>
                    </div> 
                    <div class="form-group row <?php echo !empty($postinumeroError)?'alert-info':'';?>">
                    <label class="col-sm-2 col-form-label">postinumero</label>
                      <div class = "col-sm-10">
                      <input name="postinumero" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'postinumero'" class="form-control"  placeholder="Postinumero" value="<?php echo !empty($postinumero)?$postinumero:'';?>">
                          <?php if(!empty($postinumeroError)): ?>
                             <small class = "text-muted">
                                <?php echo $postinumeroError;?>
                             </small>
                          <?php endif; ?>
                      </div>
                    </div> 
                    <div class="form-group row <?php echo !empty($postitoimipaikkaError)?'alert-info':'';?>">
                    <label class="col-sm-2 col-form-label">postitoimipaikka</label>
                      <div class = "col-sm-10">
                      <input name="postitoimipaikka" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'postitoimipaikka'" class="form-control"  placeholder="Postitoimipaikka" value="<?php echo !empty($postitoimipaikka)?$postitoimipaikka:'';?>">
                          <?php if(!empty($postitoimipaikkaError)): ?>
                             <small class = "text-muted">
                                <?php echo $postitoimipaikkaError;?>
                             </small>
                          <?php endif; ?>
                      </div>
                    </div> 
                    <div class="form-group row <?php echo !empty($kasvuvyohykeError)?'alert-info':'';?>">
                    <label class="col-sm-2 col-form-label">Kasvuvyöhyke</label>
                      <div class = "col-sm-10">
                      <input name="kasvuvyohyke" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'kasvuvyohyke'" class="form-control"  placeholder="Kasvuvyöhyke" value="<?php echo !empty($kasvuvyohyke)?$kasvuvyohyke:'';?>">
                          <?php if(!empty($kasvuvyohykeError)): ?>
                             <small class = "text-muted">
                                <?php echo $kasvuvyohykeError;?>
                             </small>
                          <?php endif; ?>
                      </div>
                    </div> 

                      <div class="control-group row <?php echo !empty($kayttajatunnusError)?'alert-info':'';?>">
                        <label class="col-sm-2 col-form-label">Käyttäjätunnus</label>
                        <div class="col-sm-10">
                        <input name="kayttajatunnus" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'kayttajatunnus'" class="form-control"  placeholder="Käyttäjätunnus" value="<?php echo !empty($kayttajatunnus)?$kayttajatunnus:'';?>">
                            <?php if (!empty($kayttajatunnusError)): ?>
                                <span class="text-muted"><?php echo $kayttajatunnusError;?></span>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="control-group row <?php echo !empty($salasanaError)?'alert-info':'';?>">
                        <label class="col-sm-2 col-form-label">Salasana</label>
                        <div class="col-sm-10">
                        <input name="salasana" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'salasana'" class="form-control"  placeholder="Salasana" value="<?php echo !empty($salasana)?$salasana:'';?>">
                            <?php if (!empty($salasanaError)): ?>
                                <span class="text-muted"><?php echo $salasanaError;?></span>
                            <?php endif;?>
                        </div>
                    </div>
                    
                      <div class="form-actions">
                          <button type="submit" class="btn btn-secondary" >Lisää</button>
                          <a class="btn btn-light" href="index.php">Takaisin</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
	
<?php 
	include 'footer.php'; 
?>

