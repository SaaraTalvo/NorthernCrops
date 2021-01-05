<?php
    include 'header.php';
    include 'database.php';

// Check if the user is already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Include config file
// require_once "database.php";
 
// Define variables and initialize with empty values
$kayttajatunnus = $salasana = "";
$kayttajatunnusError = $salasanaError = "";
 
// Processing form data when form is submitted
if( $_SERVER["REQUEST_METHOD"] == "POST" ){
 
    // Check if username is empty
    if(empty(trim($_POST["kayttajatunnus"]))){
        $kayttajatunnusError = "Syötä käyttäjatunnus";
    } else{
        $kayttajatunnus = trim($_POST["kayttajatunnus"]);
    }
    
    // Check if salasana is empty
    if(empty(trim($_POST["salasana"]))){
        $salasanaError = "Syötä salasana";
    } else{
        $salasana = trim($_POST["salasana"]);
    }
    
    // Validate credentials
    if(empty($kayttajatunnusError) && empty($salasanaError)){
        // Prepare a select statement
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT kayttajaID, kayttajatunnus, salasana 
                FROM kayttaja 
                WHERE kayttajatunnus = :kayttajatunnus";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":kayttajatunnus", $param_kayttajatunnus, PDO::PARAM_STR);
            
            // Set parameters
            $param_kayttajatunnus = trim($_POST["kayttajatunnus"]); //$kayttajatunnus
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["kayttajaID"];
                        $kayttajatunnus = $row["kayttajatunnus"];
                        $hashed_salasana = $row["salasana"];
                        if(password_verify($salasana, $hashed_salasana)){

                            // salasana is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["kayttajaID"] = $id;
                            $_SESSION["kayttajatunnus"] = $kayttajatunnus;                            
                            
                            // Redirect user to some page
                            header("location: index.php");
                        } else{
                            // Display an error message if salasana is not valid
                            $salasanaError = "Salasana virheellinen";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $kayttajatunnusError = "Käyttäjätunnus virheellinen";
                }
            } else{
                echo "Kirjaudu uudestaan";
            }   

            // Close statement
            unset($stmt);
        }
        // Close connection
        Database::disconnect();
    }    
}

?>

<div class="container">
    <div class="card bg-light">
        <div class="card-header">
            <h4>Kirjaudu sisään</h4>
        </div>

        <div class="body my-3 px-3">
        <form class="form-horizontal"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form-group row <?php echo (!empty($kayttajatunnusError)) ? 'alert alert-info' : ''; ?>">
            <label class="col-sm-2 col-form-label">Käyttäjätunnus</label>
            <div class="col-sm-10">
                <input type="text" name="kayttajatunnus" class="col-sm-10"  value="<?php echo !empty($kayttajatunnus)?$kayttajatunnus:''; ?>">

                <?php if (!empty($kayttajatunnusError)): ?>
                    <small class="text-muted"><?php echo $kayttajatunnusError;?></small>
                <?php endif; ?>
            </div>
        </div>    

        <div class="form-group row <?php echo (!empty($salasanaError)) ? 'alert alert-info' : ''; ?>">
            <label class="col-sm-2 col-form-label">Salasana</label>
            <div class="col-sm-10">
                <input type="password" name="salasana" class="col-sm-10">
                <?php if (!empty($salasanaError)): ?>
                    <small class="text-muted"><?php echo $salasanaError;?></small>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-actions">
            <input type="submit" class="btn btn-secondary" value="Kirjaudu">
        </div>

    </form>
</div>

<?php
    include 'footer.php';
?>