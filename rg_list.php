<?php

//test 2test
$raadslid = 1;
$griffie = 0;

?>

<!DOCTYPE html>

<head>
  <title>Overzicht</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="bootstrap/style/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style/backend_css.css"/>
  <script src="scripts/jquery-1.12.3.min.js"></script>
  <script src="bootstrap/scripts/bootstrap.min.js"></script>

</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Gemeentedossier</a>
    </div>
    <p class="navbar-text navbar-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <a href="#" class="navbar-link">Mijn account</a></p>
    </uL>
  </div><!-- /.container-fluid -->
</nav>

<div class="pagescreen">
  <table class="table table-hover table-list">
    <thead>
      <tr>
        <th class="col-md-1">Nummer</th>
        <th class="col-md-8">Titel</th>
        <th class="col-md-1">Eigen standpunten</th>
        <th class="col-md-1"><img class="icon-time" src="images/glyphicons-25-parents.png" alt="Icon physical"></span> Andere standpunten</th>
        <th class="col-md-1">contactgegevens</th>
      </tr>
    </thead>
    <tbody>

    <?php

    if ($raadslid == 1 && $griffie == 0){

      for ($x = 0; $x <= 20; $x++) {

        echo "
      <tr>
        <td>" . $x . "</td>
        <td>Besluitvorming school over een school dat gaat komen in de gmemeente dordrecht. De school moet er over 10 dagen komen en dit is een zeer lange titel. </td>
        <td>0</td>
        <td>2</td>
        <td>ja</td>
      </tr>";
      }
    } elseif ($griffie == 1 && $raadslid == 0){
// do nothing
    } else {
      //do nothing
    }

?>
    </tbody>
  </table>
</div>



</body>

</html>
