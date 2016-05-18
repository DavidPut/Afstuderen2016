<?php

$raadslid = 1;
$griffie = 0;

?>

<!DOCTYPE html>

<head>
  <title> inloggen</title>
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
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Nummer</th>
        <th>Titel</th>
        <th>Eigen standpunten</th>
        <th><span class="glyphicons glyphicons-25-parents"></span> Andere standpunten</th>
      </tr>
    </thead>
    <tbody>

    <?php

    for ($x = 0; $x <= 10; $x++) {

    echo "
      <tr>
        <td>".$x."</td>
        <td>Besluitvorming school</td>
        <td>0</td>
        <td>2</td>
      </tr>"; }

?>
    </tbody>
  </table>
</div>



</body>

</html>
