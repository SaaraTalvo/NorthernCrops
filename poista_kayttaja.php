<?php 
    include 'header.php'; 
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM kayttaja where kayttajaID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM kayttaja  WHERE kayttajaID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: kayttaja.php");
         
    }
?>
 
  <body>
    <div class="container">
        
        <div class="span10 offset1">
            <div class="row">
                <h3>Poista käyttäjä</h3>
            </div>
            
            <form class="form-horizontal" action="poista_kayttaja.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>"/>
            <p class="alert alert-error">Haluatko varmasti poistaa käyttäjän,<?php echo $data['etunimi']. ' ' . $data['sukunimi']; ?>, tiedot?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-danger">Kyllä, poista</button>
                <a class="btn btn-secondary" href="kayttaja.php">Ei, älä poista</a>
                </div>
            </form>
        </div>
    </div> 

    <?php include 'footer.php'?>