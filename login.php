<?php

session_start();

//Config file to manage navigations and page title
require ('navigatie/config.php');

//create variables, protecting against errors
$email 		= "";
$wachtwoord = "";

//Check the user pressed the submit button
if(isset($_POST['submit'])) {

  //If the user press 'inloggen', connect with database
  require_once 'database/connect.php';

  //Get the information from the form
  $email 		= $_POST['email'];
  $wachtwoord = $_POST['wachtwoord'];
  $saveLogin	= $_POST['remember'];

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

//If there is already a session, go to index
if (isset($_SESSION['email'])) {
  header("Location: index.php");
  exit();
}


?>

<!DOCTYPE html>

<head>
  <title><?php require 'title.php'; ?> | inloggen</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/style_login.css"/>
</head>

<body>
<div class="pageScreen">
  <div class="loginScreen">

    <div class="loginInformation">
      <h1>Inloggen</h1>
      <p>U moet inloggen om verder te kunnen gaan.</p>
      <p>Heeft u geen inloggegevens, bekijk voor meer informatie op <a href="http://www.dannyvandalen.nl">dannyvandalen</a>.</p>
    </div>

    <div class="loginForm">

      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
        <table>
          <tbody>
          <tr>
            <td><label class="formStyle">E-mailadres</label></td>
            <td><input class="formStyleField" type="email" name="email" placeholder="e-mailadres" autofocus /></td>
            <td></td> <!-- empty <td> for passing validator without warning -->
          </tr>
          <tr>
            <td><label class="formStyle">Wachtwoord</label></td>
            <td><input class="formStyleField" type="password" name="wachtwoord" placeholder="wachtwoord" /></td>
            <td><a href="?action=wachtwoord_vergeten">wachtwoord vergeten?</a></td>
          </tr>
          <tr>
            <td><input class="submit" type="submit" name="submit" value="Inloggen" /></td>
            <td>
              <label>
                <input type="checkbox" name="remember">
                <span class="blackMarker">Laat mij langer ingelogd blijven</span>
              </label>
            </td>
            <td></td> <!-- empty <td> for passing validator without warning -->
          </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>
</div>
</body>

</html>
