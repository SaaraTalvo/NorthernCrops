<?php

	include 'header.php';  
    require 'database.php';
 
    if ( !empty($_POST)) {
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
        $kuva = basename($_FILES['kuva']['name']);

        // var_dump($_FILES['kuva']);
        // exit;
         
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
            $kayttoError = 'Syötä kaytto';
            $valid = false;
        }
        if (empty($kuva)){
            $kuvaError = 'Syötä kuva';
            $valid = false;
        }

        // insert data
        if ($valid) {

            $tmpName = $_FILES['kuva']['tmp_name'];
            $name = basename($_FILES['kuva']['name']);
            move_uploaded_file($tmpName,  'img/' . $name);

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO kasvi (nimi, tieteellinen_nimi, tyyppi, viljely, kasvuaika, korjuu, kaytto, kuva) values(?, ?, ?, ?, ?, ?, ?, ?)";
            
            $q = $pdo->prepare($sql);
			$pdo->exec("set names utf8");
            $q->execute(array($nimi, $tieteellinen_nimi, $tyyppi, $viljely, $kasvuaika, $korjuu, $kaytto, $kuva));
            Database::disconnect();
            header("Location: kasvi.php");
        }
    }
?>
<!--kopsuta tähän nocrop2 kasa vai onko se jotain mitä pitäis jo poistaa?ei vaan oliko se just jotain rumaa?:D-->

<!--kopsuta tähVAIHDA INPUT TYYPIT!!!!!!!!!!!!!!!!!!!!!istaa?-->

    <div class="container">
     
                <div class="card bg-light">
                    <div class="card-header">
                        <h3>Lisää uusi kasvi</h3>
                    </div>

                    <div class="body my-3 px-3">
                        <form class="form-horizontal" action="lisaa_kasvi.php" method="post" enctype="multipart/form-data">

                            <div class="form-group row <?php echo !empty($nimiError)?'alert alert-info':'';?>">
                                <label class="col-sm-4  col-form-label">Nimi</label>
                                <div class="col-sm-8 ">
                                    <input name="nimi" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nimi'" class="form-control"  placeholder="Nimi" value="<?php echo !empty($nimi)?$nimi:'';?>">
                                    <?php if (!empty($nimiError)): ?>
                                        <small class="text-muted"><?php echo $nimiError;?></small>
                                    <?php endif; ?>
                                </div>
                            </div>  

                            <div class="form-group row <?php echo !empty($tieteellinen_nimiError)?'alert alert-info':'';?>">
                                <label class="col-sm-4 col-form-label">Tieteellinen nimi</label>
                                <div class="col-sm-8">
                                    <input name="tieteellinen_nimi" type="text" class="form-control" placeholder="Tieteellinen nimi" value="<?php echo !empty($tieteellinen_nimi)?$tieteellinen_nimi:'';?>">        
                                    <?php if (!empty($tieteellinen_nimiError)): ?>
                                        <small class="text-muted"><?php echo $tieteellinen_nimiError;?></small>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row <?php echo !empty($tyyppiError)?'alert alert-info':'';?>">
                                <label class="col-sm-4 col-form-label">Tyyppi</label>
                                <div class="col-sm-8">
                                    <input name="tyyppi" type="text" class="form-control"  placeholder="Tyyppi" value="<?php echo !empty($tyyppi)?$tyyppi:'';?>">
                                    <?php if (!empty($tyyppiError)): ?>
                                        <small class="text-muted"><?php echo $tyyppiError;?></small>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row <?php echo !empty($viljelyError)?'alert alert-info':'';?>">
                                <label class="col-sm-4 col-form-label">Viljely</label>
                                <div class="col-sm-8">
                                    <input name="viljely" type="text" class="form-control"  placeholder="Viljelyvinkit" value="<?php echo !empty($viljely)?$viljely:'';?>">
                                    <?php if (!empty($viljelyError)): ?>
                                        <small class="text-muted"><?php echo $viljelyError;?></small>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row <?php echo !empty($kasvuaikaError)?'alert alert-info':'';?>">
                                <label class="col-sm-4 col-form-label">Kasvuaika, vrk</label>
                                <div class="col-sm-8">
                                    <input name="kasvuaika" type="text" class="form-control"  placeholder="Kasvuaika vuorokausina" value="<?php echo !empty($kasvuaika)?$kasvuaika:'';?>">
                                    <?php if (!empty($kasvuaikaError)): ?>
                                        <small class="text-muted"><?php echo $kasvuaikaError;?></small>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row <?php echo !empty($korjuuError)?'alert alert-info':'';?>">
                                <label class="col-sm-4 col-form-label">Sadonkorjuu</label>
                                <div class="col-sm-8">
                                    <input name="korjuu" class="form-control" type="text"  placeholder="Sadonkorjuu" value="<?php echo !empty($korjuu)?$korjuu:'';?>">
                                    <?php if (!empty($korjuuError)): ?>
                                        <small class="text-muted"><?php echo $korjuuError;?></small>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row <?php echo !empty($kayttoError)?'alert alert-info':'';?>">
                                <label class="col-sm-4 col-form-label">Käyttö</label>
                                <div class="col-sm-8">
                                    <input name="kaytto" type="text" class="form-control"  placeholder="Käyttö" value="<?php echo !empty($kaytto)?$kaytto:'';?>">
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
                        
                            <div class="form-actions">
                                <button type="submit" class="btn btn-secondary">Lisää</button>
                                
                                <a class="btn" href="video.php">Takaisin</a>
                            </div>
                        </form>
                    </div>
                </div>
                 
    </div> <!-- /container -->
	
<?php 
	include 'footer.php'; 
?>