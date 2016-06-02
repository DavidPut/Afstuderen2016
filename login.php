<?php

session_start();

//If there is already a session, go to index and do stuff test test
if (isset($_SESSION['mail'])) {
  switch ($_SESSION['role']){
    case "raadslid";
      header("Location: raadslid");
      exit();
      break;
    case "griffier";
      header("Location: griffie");
      exit();
      break;
    default:
      header("Location: index.php");
      exit();
      break;
  }
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
          <form action="formactions.php" method="POST">
            
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
               <button class="btn btn-lg btn-primary btn-block" type="submit" name="loginsubmit" value="inloggen">Inloggen</button>

              </div>
            </div>
            
          </form>
      </div>
  </body>

</html>
