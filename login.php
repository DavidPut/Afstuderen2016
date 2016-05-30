<?php

session_start();

//If there is already a session, go to index and do stuff test test
if (isset($_SESSION['email'])) {
  if ($_SESSION['role'] == "raadslid") {
    header("Location: raadslid.php");
    exit();
  } elseif ($_SESSION['role'] == "griffier") {
    header("Location: griffie.php");
    exit();
  }
}

//Config file to manage navigations and page title
//require ('navigatie/config.php');

//create variables, protecting against errors
$email 		= "";
$wachtwoord = "";

//Check the user pressed the submit button
if(isset($_POST['submit'])) {
  if (isset($_POST['mail'])) {
    if (isset($_POST['password'])) {

      $form_mail = $_POST['mail'];
      $form_pass = $_POST['password'];

      require_once "database/db_functions.php";
      $db_login = new DB_functions();
      $db_login_info = $db_login->login($form_mail);

      $database_pass = $db_login_info['password'];

      if (md5($form_pass) == $database_pass) {
        $_SESSION['email'] = $email;
      } else {
        $_SESSION['email'] = $email;
      }

      if ($login == 1) {
        if ($saveLogin == "on") {
          //Create longer logged in session
          $_SESSION['email'] = $email;
        } else if ($saveLogin == "") {
          //Create short logged in session
          $_SESSION['email'] = $email;
        }
        header("Location: index.php");
        mysqli_close($db);
        exit();
      }
    }
  }


  echo $db_login_info["mail"];
  echo $db_login_info["name"];
  echo $db_login_info["id"];
  echo $db_login_info["password"];
  echo $db_login_info["role"];

}


?>

<!DOCTYPE html>

  <head>
    <title>Inloggen gemeentedossier</title>
    <base href="//gemeentedossier.nl" />
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
                  <input type="email" name="mail" class="form-control" placeholder="uw e-mailadres" aria-describedby="basic-addon1" autofocus>
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
               <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="inloggen">Inloggen</button>

              </div>
            </div>
            
          </form>
      </div>
  </body>

</html>
