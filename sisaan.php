<?php 

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "database.php";
 
// Define variables and initialize with empty values
$kayttajatunnus = $salasana = "";
$kayttajatunnusError = $salasanaError = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if kayttajatunnus is empty
    if(empty(trim($_POST["kayttajatunnus"]))){
        $kayttajatunnusError = "Syota kayttajatunnus.";
    } else{
        $kayttajatunnus = trim($_POST["kayttajatunnus"]);
    }
    
    // Check if salasana is empty
    if(empty(trim($_POST["salasana"]))){
        $salasanaError = "Syota salasana";
    } else{
        $salasana = trim($_POST["salasana"]);
    }
    
    // Validate credentials
    if(empty($kayttajatunnusError) && empty($salasanaError)){
         // Prepare a select statement
         $pdo = Database::connect();
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = "SELECT kayttajaID, kayttajatunnus, salasana FROM kayttaja WHERE kayttajatunnus = :kayttajatunnus";
        
         if($stmt = $pdo->prepare($sql)){
             // Bind variables to the prepared statement as parameters
             $stmt->bindParam(":kayttajatunnus", $param_kayttajatunnus, PDO::PARAM_STR);
             
             // Set parameters
             $param_kayttajatunnus = trim($_POST["kayttajatunnus"]);
             
             // Attempt to execute the prepared statement
             if($stmt->execute()){
                 // Check if kayttajatunnus exists, if yes then verify password
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
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if salasana is not valid
                            $salasanaError = "Salasanasi ei ole validi";
                        }
                    }
                } else{
                    // Display an error message if kayttajatunnus doesn't exist
                    $kayttajatunnusError = "Ei tilia talla kayttajatunnuksella.";
                }
            } else{
                echo "Oops! Jotain meni vaarin, yrita myohemmin uudelleen.";
            }
            //close statement
            unset($stmt);

        }
    }

    // Close connection
    Database::disconnect();
}


include 'header.php' ?>

<div class="container mt-3">
        <h2>Kirjaudu</h2>
        
        <p>Anna kayttajatunnus ja salasana</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group row<?php echo (!empty($kayttajatunnusError)) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label">Kayttajatunnus</label>
                <input type="text" name="kayttajatunnus" class="col-sm-10" value="<?php echo !empty($kayttajatunnus)?$kayttajatunnus:''; ?>">
                <?php if (!empty($kayttajatunnusError)): ?>
                    <small class = "text-muted"><?php echo $kayttajatunnusError;?></small>
                <?php endif; ?>
            </div>  

            <div class="form-group row<?php echo (!empty($salasanaError)) ? 'alert alert-info' : ''; ?>">
                <label class="col-sm-2 col-form-label">Salasana</label>
                <input type="text" name="salasana" class="col-sm-10" value="<?php echo !empty($salasana)?$salasana:''; ?>">
                <?php if (!empty($salasanaError)): ?>
                    <small class = "text-muted"><?php echo $salasanaError;?></small>
                <?php endif; ?>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-secondary" value="Kirjaudu">
            </div>

            <p>Don't have an account? <a href="rekisteroidy.php">rekisteroidy nyt</a>.</p>
        </form>
</div>    

<?php include 'footer.php' ?>