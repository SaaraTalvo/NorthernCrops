<?php include 'header.php'; ?>
<?php
    require 'database.php';
    $kayttajaID = null;
    if ( !empty($_GET['id'])) {
        $kayttajaID = $_REQUEST['id'];
    }
     
    if ( null==$kayttajaID ) {
        header("Location: kayttaja.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM kayttaja where kayttajaID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($kayttajaID));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //var_dump($data);
    }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Katso kayttaja</title>
  </head>


  <body>
  <div class="container">
     
     <div class="span10 offset1">
         <div class="row">
             <h3>Katso kayttajatietoja</h3>
         </div>
          
                    
            <div class="form-group row">
                <label for="etunimi" class="col-sm-2 col-form-label">Etunimi:</label>
                <div class="col-sm-10">
                <input type="text" readonly 
                class="form-control-plaintext" 
                value="<?php echo $data['etunimi']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="sukunimi" class="col-sm-2 col-form-label">Sukunimi:</label>
                <div class="col-sm-10">
                <input type="text" readonly 
                class="form-control-plaintext" 
                value="<?php echo $data['sukunimi']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="lahiosoite" class="col-sm-2 col-form-label">Lahiosoite:</label>
                <div class="col-sm-10">
                <input type="text" readonly 
                class="form-control-plaintext" 
                value="<?php echo $data['lahiosoite']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="postinumero" class="col-sm-2 col-form-label">Postinumero:</label>
                <div class="col-sm-10">
                <input type="text" readonly 
                class="form-control-plaintext" 
                value="<?php echo $data['postinumero']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="postitoimipaikka" class="col-sm-2 col-form-label">Postitoimipaikka:</label>
                <div class="col-sm-10">
                <input type="text" readonly 
                class="form-control-plaintext" 
                value="<?php echo $data['postitoimipaikka']; ?>">
                </div>
            </div>

        

            <div class="form-group row">
                <label for="sahkoposti" class="col-sm-2 col-form-label">Sähköposti:</label>
                <div class="col-sm-10">
                <input type="text" readonly 
                class="form-control-plaintext" 
                value="<?php echo $data['sahkoposti']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="henkilotunnus" class="col-sm-2 col-form-label">Henkilotunnus:</label>
                <div class="col-sm-10">
                <input type="text" readonly 
                class="form-control-plaintext" 
                value="<?php echo $data['henkilotunnus']; ?>">
                </div>
            </div>


            
         <!--<div class="form-horizontal" >
           <div class="control-group">
             <label class="control-label">Etunimi</label>
             <div class="controls">
                 <label class="checkbox">
                     <?php echo $data['etunimi'];?>
                 </label>
             </div>
           </div>
           <div class="control-group">
             <label class="control-label">Sukunimi</label>
             <div class="controls">
                 <label class="checkbox">
                     <?php echo $data['sukunimi'];?>
                 </label>
             </div>
           </div>
           <div class="control-group">
             <label class="control-label">Lahiosoite</label>
             <div class="controls">
                 <label class="checkbox">
                     <?php echo $data['lahiosoite'];?>
                 </label>
             </div>
           </div>
           <div class="form-horizontal" >
           <div class="control-group">
             <label class="control-label">postinumero</label>
             <div class="controls">
                 <label class="checkbox">
                     <?php echo $data['postinumero'];?>
                 </label>
             </div>
           </div>
           <div class="control-group">
             <label class="control-label">Postitoimipaikka</label>
             <div class="controls">
                 <label class="checkbox">
                     <?php echo $data['postitoimipaikka'];?>
                 </label>
             </div>
           </div>
           <div class="control-group">
             <label class="control-label">Puhelinnumero</label>
             <div class="controls">
                 <label class="checkbox">
                     <?php echo $data['puhelin'];?>
                 </label>
             </div>
           </div>
           </div>
           <div class="control-group">
             <label class="control-label">Sahkoposti</label>
             <div class="controls">
                 <label class="checkbox">
                     <?php echo $data['sahkoposti'];?>
                 </label>
             </div>
           </div>
           </div>
           <div class="control-group">
             <label class="control-label">Henkilotunnus</label>
             <div class="controls">
                 <label class="checkbox">
                     <?php echo $data['henkilotunnus'];?>
                 </label>
             </div>
           </div>
           -->


             <div class="form-actions">
               <a class="btn btn-success" href="kayttaja.php">Takaisin</a>
            </div>
            </div>
     </div>
</div> <!-- /container -->

<?php include 'footer.php'?>
                 