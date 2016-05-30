<?php

session_start();

//Config file to manage navigations and page title
//require ('navigatie/config.php');

//create variables, protecting against errors
$email 		= "";
$wachtwoord = "";

//Check the user pressed the submit button
if(isset($_POST['submit'])) {

  //If the user press 'inloggen', connect with database
  //require_once 'database/connect.php';

  //Get the information from the form
  $email 		= $_POST['email'];
  $wachtwoord = $_POST['wachtwoord'];

  $query = "SELECT * FROM inloggegevens WHERE email = '$email'";
  $loginInformation = mysqli_query($db, $query) or die('Geen verbinding: ' . mysqli_error($loginInformation));

  if ($row = mysqli_fetch_assoc($loginInformation)) {

    $loginWachtwoord = $row['wachtwoord'];
    if (md5(sha1($wachtwoord)) == $loginWachtwoord) {
      $login = 1;
    }
    else {
      $login = 0;
    }

    if ($login == 1) {
      if ($saveLogin == "on") {
        //Create longer logged in session
        $_SESSION['email']= $email;
        $_SESSION['time'] = time();
      }
      else if($saveLogin == "") {
        //Create short logged in session
        $_SESSION['email']= $email;
        $_SESSION['time'] = time();
      }
      header("Location: index.php");
      mysqli_close($db);
      exit();
    }
  }
}

//If there is already a session, go to index and do stuff test
if (isset($_SESSION['email'])) {
  header("Location: index.php");
  exit();
}


?>

<!DOCTYPE html>

  <head>
    <title>Inloggen gemeentedossier</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="bootstrap/style/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/backend_css.css"/>
    <script src="scripts/jquery-1.12.3.min.js"></script>
    <script src="bootstrap/scripts/bootstrap.min.js"></script>

  </head>

  <body>

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Gemeentedossier</a>
        </div>
      </div>
    </nav>


    <div class="container">
      
      <div class="row">
          <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            
            <div class="row">
              <div class="col-md-4 col-xs-12 col-md-offset-4">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">E-mailadres</span>
                  <input type="email" name="email" class="form-control" placeholder="uw e-mailadres" aria-describedby="basic-addon1" autofocus>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-4 col-xs-12 col-md-offset-4">
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Wachtwoord</span>
                    <input type="password" name="password" class="form-control" placeholder="uw wachtwoord" aria-describedby="basic-addon1">
                  </div>
                </div>
             
            </div>
            
            <div class="row">
              <div class="col-md-4 col-md-offset-4 col-xs-12">
               <button class="btn btn-lg btn-primary btn-block" type="submit" name=submit" value="inloggen">Inloggen</button>

              </div>
            </div>
            
          </form>
      </div>
  </body>

</html>
