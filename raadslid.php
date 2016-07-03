<?php

session_start();

$action = urlencode($_GET['action']);

if (isset($_SESSION['mail'])) {
  if ($_SESSION['role'] != "raadslid") {
    header("Location: indexerror.php");
    exit();
  }
} else {
  header("Location: login.php");
  exit();
}

//list griffie 
if($action == null || $action == 'list') {
  require_once "database/db_functions.php"; //test
  $db_getList = new DB_functions();
  $db_getList_info = $db_getList->griffieList();
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

<nav class="navbar navbar-inverse " role="navigation">
  <div class="container">
    <div class="navbar-header"><a class="navbar-brand" href="#">Gemeentedossier</a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse navbar-menubuilder">
      <ul class="nav navbar-nav navbar-right">
        <li><p class="navbar-text navbar-right"><i class="fa fa-user fa-fw" aria-hidden="true"></i><a href="logout.php" class="navbar-link"><?php echo $_SESSION['name']; ?></a></p>
        </li>
        <li><p class="navbar-text navbar-right"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i><a href="logout.php" class="navbar-link">Uitloggen</a></p>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container">
  <?php
  switch ($action) {
    case "list";
        require 'admin/raadslid/list.php';
        break;
   case "add";
      require 'admin/raadslid/add.php';
      break;
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

<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
</body>

</html>