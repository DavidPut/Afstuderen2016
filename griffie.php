<?php

session_start();

$action = urlencode($_GET['action']);

if (isset($_SESSION['mail'])) {
  if ($_SESSION['role'] == "griffier") {
    header("Location: griffie");
    exit();
  } elseif ($_SESSION["role"] == "raadslid") {
    header("Location: raadslid");
    exit();
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
  <link href='./fonts/font-awesome.min.css' rel='stylesheet'/>
  <link rel="stylesheet" type="text/css" href="style/backend_css.css"/>
  <script src="scripts/jquery-1.12.3.min.js"></script>
  <script src="bootstrap/scripts/bootstrap.min.js"></script>

</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display and actions-->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Gemeentedossier</a>
    </div>
    <p class="navbar-text navbar-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <a href="logout.php" class="navbar-link"><?php echo $_SESSION['name']; ?></a></p>
    </uL>
  </div><!-- /.container-fluid -->
</nav>


<div class="container">
  <?php
  switch ($action) {
    case "list";
          require 'admin/griffie/list.php';
          break;
    case "add";
          require 'admin/griffie/add.php';
          break;
    case "edit";
          require 'admin/griffie/edit.php';
          break;
    case "delete";
          require 'admin/griffie/delete.php';
          break;
    default:
          require 'admin/griffie/list.php';
          break; }
  ?>
</div>
<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>

</html>
