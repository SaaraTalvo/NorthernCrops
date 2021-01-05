<?php
	include 'header.php'; 
    require 'database.php';

    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( !empty($_POST) ) {
         
        $id = $_POST['id'];
        
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM kasvi WHERE kasviID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
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
                        <h3>Poista kasvi tiedostosta</h3>
                    </div>
                     
                    <form class="form-horizontal" action="poista_kasvi.php" method="post">
                    <input type="hidden" name='id' value="<?php echo $id;?>">
                      <p class="alert alert-error">Haluatko varmasti poistaa kasvin, <?php echo $data['nimi']; ?>, tiedostosta?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Kyllä, poista</button>
                          <a class="btn btn-secondary" href="kasvi.php">Ei, älä poista</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
	
<?php 
	include 'footer.php'; 
?>