<?php

	include 'header.php';  
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id']) ) {
        $id = $_REQUEST['id'];
    }

    if ( !empty($_POST) ) {
        // keep track validation errors
        $nimiError = null;
        $tieteellinen_nimiError = null;
        $tyyppiError = null;
        $viljelyError = null;
        $kasvuaikaError = null;
        $korjuuError = null;
        $kayttoError = null;
        $kuvaError = null;;
		 
        // keep track post values
        $nimi = $_POST['nimi'];
        $tieteellinen_nimi = $_POST['tieteellinen_nimi'];
        $tyyppi = $_POST['tyyppi'];
        $viljely = $_POST['viljely'];
        $kasvuaika = $_POST['kasvuaika'];
        $korjuu = $_POST['korjuu'];
        $kaytto = $_POST['kaytto'];
        $kuva = $_POST['kuva'];
        // $kuva = basename($_FILES['kuva']['name']);
        

        

        // validate input
        $valid = true;
        if (empty($nimi)){
            $nimiError = 'Syötä nimi';
            $valid = false;
        }
        if (empty($tieteellinen_nimi)){
            $tieteellinen_nimiError = 'Syötä tieteellinen_nimi';
            $valid = false;
        }
        if (empty($tyyppi)){
            $tyyppiError = 'Syötä tyyppi';
            $valid = false;
        }
        if (empty($viljely)){
            $viljelyError = 'Syötä viljely';
            $valid = false;
        }
        if (empty($kasvuaika)){
            $kasvuaikaError = 'Syötä kasvuaika';
            $valid = false;
        }
        if (empty($korjuu)){
            $korjuuError = 'Syötä korjuu';
            $valid = false;
        }
        if (empty($kaytto)){
            $kayttoError = 'Syötä käytto';
            $valid = false;
        }
        if (empty($kuva)){
            $kuvaError = 'Syötä kuva';
            $valid = false;
        }

        // insert data
        if ($valid) {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE kasvi 
                    SET nimi = ?, tieteellinen_nimi = ?, tyyppi = ?, viljely = ?, kasvuaika = ?, korjuu = ?, kaytto = ?, kuva = ?
                    WHERE kasviID = ?";
            $q = $pdo->prepare($sql);
			$pdo->exec("set names utf8");
            $q->execute(array($nimi, $tieteellinen_nimi, $tyyppi, $viljely, $kasvuaika, $korjuu, $kaytto, $kuva, $id ));
            Database::disconnect();
            header("Location: kasvi.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM kasvi WHERE kasviID = ?";
		$pdo->exec("set names utf8");
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        $nimi = $data['nimi'];
        $tieteellinen_nimi = $data['tieteellinen_nimi'];
        $tyyppi = $data['tyyppi'];
		$viljely = $data['viljely'];
		$kasvuaika = $data['kasvuaika'];
		$korjuu = $data['korjuu'];
        $kaytto = $data['kaytto'];
        $kuva = $data['kuva'];
    }
?>

    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Muokkaa kasvin tietoja</h3>
                    </div>
             
                    <form class="form-group row" action="paivita_kasvi.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data>
                        <div class="form-group row <?php echo !empty($nimiError)?'alert alert-info':'';?>">
                            <label class="col-sm-2 col-form-label">Nimi</label>
                            <div class="col-sm-10">
                                <input name="nimi" type="text" class="form-control" placeholder="Nimi" value="<?php echo !empty($nimi)?$nimi:'';?>">
                                <?php if (!empty($nimiError)): ?>
                                    <small class="text-muted"><?php echo $nimiError;?></small>
                                <?php endif; ?>
                            </div>
                        </div>  

                        <div class="form-group row <?php echo !empty($tieteellinen_nimiError)?'alert alert-info':'';?>">
                            <label class="col-sm-2 col-form-label">Tieteellinen nimi</label>
                            <div class="col-sm-10">
                            <input name="tieteellinen_nimi" type="text" class="form-control" placeholder="Tieteellinen nimi" value="<?php echo !empty($tieteellinen_nimi)?$tieteellinen_nimi:'';?>">        
                                <?php if (!empty($tieteellinen_nimiError)): ?>
                                    <small class="text-muted"><?php echo $tieteellinen_nimiError;?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row <?php echo !empty($tyyppiError)?'alert alert-info':'';?>">
                            <label class="col-sm-2 col-form-label">Tyyppi</label>
                            <div class="col-sm-10">
                                <input name="tyyppi" type="text" class="form-control" placeholder="Tyyppi" value="<?php echo !empty($tyyppi)?$tyyppi:'';?>">
                                <?php if (!empty($tyyppiError)): ?>
                                    <small class="text-muted"><?php echo $tyyppiError;?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row <?php echo !empty($viljelyError)?'alert alert-info':'';?>">
                            <label class="col-sm-2 col-form-label">Viljely</label>
                            <div class="col-sm-10">

                                <textarea class="form-control" name="viljely" cols="48" rows="5"><?php echo !empty($viljely)?$viljely:'viljely';?></textarea> 

                                <?php if (!empty($viljelyError)): ?>
                                    <small class="text-muted"><?php echo $viljelyError;?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row <?php echo !empty($kasvuaikaError)?'alert alert-info':'';?>">
                            <label class="col-sm-2 col-form-label">kasvuaika</label>
                            <div class="col-sm-10">
                                <input name="kasvuaika" type="text" class="form-control" placeholder="kasvuaika" value="<?php echo !empty($kasvuaika)?$kasvuaika:'';?>">
                                <?php if (!empty($kasvuaikaError)): ?>
                                    <small class="text-muted"><?php echo $kasvuaikaError;?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row <?php echo !empty($korjuuError)?'alert alert-info':'';?>">
                            <label class="col-sm-2 col-form-label">Korjuu</label>
                            <div class="col-sm-10">
                                <textarea name="korjuu" class="form-control" cols="48" rows="5"><?php echo !empty($korjuu)?$korjuu:'korjuu';?></textarea>
                                <?php if (!empty($korjuuError)): ?>
                                    <small class="text-muted"><?php echo $korjuuError;?></small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row <?php echo !empty($kayttoError)?'alert alert-info':'';?>">
                            <label class="col-sm-2 col-form-label">Käyttö</label>
                            <div class="col-sm-10">
                            <textarea name="kaytto" class="form-control" cols="48" rows="5"><?php echo !empty($kaytto)?$kaytto:'kaytto';?></textarea>
                                <?php if (!empty($kayttoError)): ?>
                                    <small class="text-muted"><?php echo $kayttoError;?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                


                        <div class="form-group row <?php echo !empty($kuvaError)?'alert alert-info':'';?>">
                                <label class="col-sm-4 col-form-label">Kuva</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input name="kuva" type="file" class="custom-file-input" placeholder="Kuva" value="<?php echo !empty($kuva)?$kuva:'';?>">
                                        <label for="" class="custom-file-label" data-browse="Selaa">Kuva</label>
                                        <?php if (!empty($kuvaError)): ?>
                                            <small class="text-muted"><?php echo $kuvaError;?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>   

                <!--kun painaa päivitä placeholder teksti muuttuu oikeaksi ja kuva vaihtuu. miten kuvan voi lisätä url eikä htdocs img-->
                         <div class="form-group row <?php echo !empty($kuvaError)?'alert alert-info':'';?>">
                            <label class="col-sm-2 col-form-label">Kuva</label>
                            <div class="col-sm-10">
                             <div class="custom-file">

                                <input name="kuva" type="file"  class="custom-file-input"  
                                value="<?php echo !empty($kuva)?$kuva:'Kuva';?>">
                            
                                <label class="custom-file-label" data-browse="Selaa"><?php echo !empty($kuva)?$kuva:'';?></label>
                                <?php if (!empty($kuvaError)): ?>
                                    <small class="text-muted"><?php echo $kuvaError;?></small>
                                <?php endif; ?>
                            </div>
                        </div>   
                        

                        <div class="form-actions">
                            <button type="submit" class="btn btn-light">Päivitä</button>
                            <a class="btn btn-light" href="kasvi.php">Takaisin</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
	
<?php 
	include 'footer.php'; 
?>