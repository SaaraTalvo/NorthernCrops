<!-- <?php

	include 'header.php';  
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id']) ) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: kasvi.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM kasvi WHERE kasviID = ?";
		$pdo->exec("set names utf8");
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
    <div class="container">
     
        <div class="span10 offset1">
            <div class="row">
                <h3>kasvin tiedot</h3>
            </div>

            <div class="control-group row">
                <label class="col-sm-2 col-form-label">Nimi</label>
                <div class="col-sm-10">
                    <input readonly type="text" value="<?php echo $data['nimi'];?>">
                </div>
            </div>  

            <div class="control-group row">
                <label class="col-sm-2 col-form-label">Kuvaus</label>
                <div class="col-sm-10">
                    <textarea readonly cols="24" rows="5"><?php echo $data['kuvaus'];?></textarea>        
                </div>
            </div>

            <div class="control-group row">
                <label class="col-sm-2 col-form-label">Genre</label>
                <div class="col-sm-10">
                    <input readonly value="<?php echo $data['genre'];?>">
                </div>
            </div>

            <div class="control-group row">
                <label class="col-sm-2 col-form-label">Ikäraja</label>
                <div class="col-sm-10">
                    <input readonly value="<?php echo $data['ikaraja'];?>">
                </div>
            </div>

            <div class="control-group row">
                <label class="col-sm-2 col-form-label">Kesto</label>
                <div class="col-sm-10">
                    <input readonly value="<?php echo $data['kesto'];?>">
                </div>
            </div>

            <div class="control-group row">
                <label class="col-sm-2 col-form-label">Julkaisupäivä</label>
                <div class="col-sm-10">
                    <input readonly value="<?php echo $data['julkaisupaiva'];?>">
                </div>
            </div>

            <div class="control-group row">
                <label class="col-sm-2 col-form-label">Tuotantovuosi</label>
                <div class="col-sm-10">
                    <input readonly value="<?php echo $data['tuotantovuosi'];?>">
                </div>
            </div>

            <div class="control-group row">
                <label class="col-sm-2 col-form-label">Ohjaaja</label>
                <div class="col-sm-10">
                    <input readonly value="<?php echo $data['ohjaaja'];?>">
                </div>
            </div>

            <div class="control-group row">
                <label class="col-sm-2 col-form-label">Näyttelijät</label>
                <div class="col-sm-10">
                    <input readonly value="<?php echo $data['nayttelijat'];?>">
                </div>
            </div>

            <div class="control-group row">
                <label class="col-sm-2 col-form-label">Kuva</label>
                <div class="col-sm-10">
                    <input readonly value="<?php echo $data['kuva'];?>">

                </div>
            </div>   
            
            <div class="">
                <a class="btn" href="kasvi.php">Takaisin</a>
            </div>
        </div>
                 
    </div> <!-- /container -->
	
<?php 
	include 'footer.php'; 
?> -->