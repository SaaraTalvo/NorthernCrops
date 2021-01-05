<?php include 'header.php'; 
    require 'database.php';

    $id = null;

    if ( !empty($_GET['id']) ) {
        $id = $_REQUEST['id'];
    }
        
    if ( !empty($_POST) ) {
                    
                    $etunimiError = null;
                    $sukunimiError = null;
                    $sahkopostiError = null;
                    $henkilotunnusError = null;
                    $lahiosoiteError = null;
                    $postinumeroError = null;
                    $postitoimipaikkaError = null;
                    $kasvuvyohykeError = null;

                   
                    $etunimi = $_POST['etunimi'];
                    $sukunimi = $_POST['sukunimi'];
                    $sahkoposti = $_POST['sahkoposti'];
                    $henkilotunnus = $_POST['henkilotunnus'];
                    $lahiosoite = $_POST['lahiosoite'];
                    $postinumero = $_POST['postinumero'];
                    $postitoimipaikka = $_POST['postitoimipaikka'];
                    $kasvuvyohyke = $_POST['kasvuvyohyke'];
                    

                    //validate input
                    $valid = true;
                    if (empty($etunimi)){
                        $etunimiError = 'Syota etunimi';
                        $valid = false;
                    }
                    if (empty($sukunimi)){
                        $sukunimiError = 'Syota sukunimi';
                        $valid = false;
                    }
                    if (empty($sahkoposti)){
                        $sahkopostiError = 'Syota sahkoposti';
                        $valid = false;
                    }
                    if (empty($henkilotunnus)){
                        $henkilotunnusError = 'Syota henkilotunnus';
                        $valid = false;
                    }
                    if (empty($lahiosoite)){
                        $lahiosoiteError = 'Syota lahiosoite';
                        $valid = false;
                    }
                    if (empty($postinumero)){
                        $postinumeroError = 'Syota postinumero';
                        $valid = false;
                    }
                    if (empty($postitoimipaikka)){
                        $postitoimipaikkaError = 'Syota postitoimipaikka';
                        $valid = false;
                    }
                    if (empty($kasvuvyohyke)){
                        $kasvuvyohykeError = 'Syota kasvuvyohyke';
                        $valid = false;
                    }
                    

                    //update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE kayttaja 
                    SET etunimi = ?, sukunimi = ?, sahkoposti = ?, henkilotunnus = ?, lahiosoite = ?, postinumero = ?, postitoimipaikka = ?, kasvuvyohyke = ? 
                    WHERE kayttajaID = ?";
            $q = $pdo->prepare($sql);
            $pdo->exec("set names utf8");
            $q->execute(array($etunimi, $sukunimi, $sahkoposti, $henkilotunnus, $lahiosoite, $postinumero, $postitoimipaikka, $kasvuvyohyke, $id));
            //$data = $q->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
            header("Location: kayttaja.php");
            }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM kayttaja WHERE kayttajaID = ?";
		$pdo->exec("set names utf8");
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        $etunimi = $data['etunimi'];
        $sukunimi = $data['sukunimi'];
        $sahkoposti = $data['sahkoposti'];
		$henkilotunnus = $data['henkilotunnus'];
		$lahiosoite = $data['lahiosoite'];
		$postinumero = $data['postinumero'];
        $postitoimipaikka = $data['postitoimipaikka'];
        $kasvuvyohyke = $data['kasvuvyohyke'];
    }
         
?>


        <div class="container">

            <div class="row">
                <h3>Muokkaa käyttäjätietoja</h3>
            </div>       

            <!-- <form action="paivita_kayttaja.php" method= "post">
                <input type="hidden" name="id" value= "<?php echo $data ['kayttajaID'];?>"> -->

            <form class="form-horizontal" action="paivita_kayttaja.php?id=<?php echo $id; ?>" method="post">

                    <div class="form-group row <?php echo !empty($etunimiError)?'alert alert-info':'';?>">

                            <label class="col-sm-2 col-form-label">Etunimi</label>

                            <div class="col-sm-10">

                            <input type="text" name="etunimi" class="form-control" placeholder= "Etunimi" value="<?php echo !empty($etunimi)?$etunimi:'';?>">

                            <?php if (!empty($etunimiError)): ?>
                                    <small class="text-muted"><?php echo $etunimiError;?></small>
                                <?php endif; ?>

                            </div>
                    </div>








                    <div class="form-group row <?php echo !empty($sukunimiError)?'alert alert-info':'';?>">
                            <label for="sukunimi" class="col-sm-2 col-form-label">Sukunimi:</label>
                            <div class="col-sm-10">
                            <input type="text" name="sukunimi" class="form-control" value="<?php echo $data['sukunimi']; ?>">
                            </div>
                    </div>
                    <div class="form-group row <?php echo !empty($sahkopostiError)?'alert alert-info':'';?>">
                            <label for="sahkoposti" class="col-sm-2 col-form-label">Sähkoposti:</label>
                            <div class="col-sm-10">
                            <input type="text" name="sahkoposti" class="form-control" value="<?php echo $data['sahkoposti']; ?>">
                            </div>
                    </div>
                    <div class="form-group row <?php echo !empty($henkilotunnusError)?'alert alert-info':'';?>">
                            <label for="henkilotunnus" class="col-sm-2 col-form-label">Henkilötunnus:</label>
                            <div class="col-sm-10">
                            <input type="text" name="henkilotunnus" class="form-control" value="<?php echo $data['henkilotunnus']; ?>">
                            </div>
                    </div>
                    <div class="form-group row <?php echo !empty($lahiosoiteError)?'alert alert-info':'';?>">
                            <label for="lahiosoite" class="col-sm-2 col-form-label">Lähiosoite:</label>
                            <div class="col-sm-10">
                            <input type="text" name="lahiosoite" class="form-control" value="<?php echo $data['lahiosoite']; ?>">
                            </div>
                    </div>
                    <div class="form-group row <?php echo !empty($postinumeroError)?'alert alert-info':'';?>">
                            <label for="postinumero" class="col-sm-2 col-form-label">Postinumero:</label>
                            <div class="col-sm-10">
                            <input type="text" name="postinumero" class="form-control" value="<?php echo $data['postinumero']; ?>">
                            </div>
                    </div>
                    <div class="form-group row <?php echo !empty($postitoimipaikkaError)?'alert alert-info':'';?>">
                            <label for="postitoimipaikka" class="col-sm-2 col-form-label">Postitoimipaikka:</label>
                            <div class="col-sm-10">
                            <input type="text" name="postitoimipaikka" class="form-control" value="<?php echo $data['postitoimipaikka']; ?>">
                            </div>
                    </div>

                    <div class="form-group row <?php echo !empty($kasvuvyohykeError)?'alert alert-info':'';?>">

                            <label for="kasvuvyohyke" class="col-sm-2 col-form-label">kasvuvyöhyke:</label>

                            <div class="col-sm-10">

                            <input type="text" name="kasvuvyohyke" class="form-control" value="<?php echo $data['kasvuvyohyke']; ?>">

                            </div>
                    </div>
                    

                <div class="form-actions">
                <button type = "submit" class="btn btn-light">Päivita</button>
                <a class = "btn btn-light" href = "kayttaja.php">Takaisin</a>
                </div>
                
            </form>
        </div> <!-- /container -->


        <?php include 'footer.php'?>
                 
