<?php

$action = urlencode($_GET['action']);


?>

<!DOCTYPE html>

<head>
  <title>Inloggen gemeentedossier</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="bootstrap/style/bootstrap.min.css">
  <link href='./fonts/font-awesome.min.css' rel='stylesheet'/>
  <link rel="stylesheet" type="text/css" href="style/backend_css.css"/>
  <script src="scripts/jquery-1.12.3.min.js"></script>
  <script src="bootstrap/scripts/bootstrap.min.js"></script>

</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Gemeentedossier</a>
    </div>
    <p class="navbar-text navbar-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <a href="#" class="navbar-link">Mijn account</a></p>
    </uL>
  </div><!-- /.container-fluid -->
</nav>


<div class="container">
  <?php
  switch ($action) {
    case "list";
      require 'admin/raadslid/list.php';
      break;
//    case "add";
//      require 'admin/raadslid/add.php';
//      break;
//    case "edit";
//      require 'admin/raadslid/edit.php';
//      break;
//    case "delete";
//      require 'admin/raadslid/delete.php';
//      break;
    default:
      require 'admin/raadslid/list.php';
      break; }
  ?>
</div>
</body>

</html>