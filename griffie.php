<?php

session_start();

$action = urlencode($_GET['action']);

if (isset($_SESSION['mail'])) {
  if ($_SESSION['role'] != "griffier") {
    header("Location: indexerror.php");
    exit();
  }
} else {
  header("Location: login.php");
  exit();
}

// Nieuwe besluitvormingsproces
if(isset($_POST['BVPadd'])) {
  if(isset($_POST['BVPaddTitle'])) {
    if(isset($_POST['BVPaddSummary'])) {
      if(isset($_POST['BVPaddPeriod'])) {

        $BVPtitle = $_POST['BVPaddTitle'];
        $BVPsummary = $_POST['BVPaddSummary'];
        $BVPperiod = $_POST['BVPaddPeriod'];

        if (isset($_POST['BVPaddLocation'])) {
          $BVPlocation = $_POST['BVPaddLocation'];
        } else {
          $BVPlocation = null;
        }

        if (isset($_POST['BVPaddTags'])) {
          $BVPtags = $_POST['BVPaddTags'];
        } else {
          $BVPtags = null;
        }

        if (!empty($_POST['BVPaddType'])) {
          $BVPtypes = "";
          foreach ($_POST['BVPaddType'] as $selected) {
            $BVPtypes = $types . $selected . ",";
          }
        } else {
          $BVPtypes = null;
        }
        
        if (!empty($_POST['BVPaddContact'])) {
          $BVPcontact = "";
          foreach ($_POST['BVPaddContact'] as $selected) {
            $BVPcontact = $BVPcontact . $selected . ",";
          }
        } else {
          // is het empty.. geen probleem
          $BVPcontact = null;
        }

        require_once "database/db_functions.php";
        $db_addPush = new DB_functions();
        $db_addPush_info = $db_login->griffieAdd($BVPtitle, $BVPsummary, $BVPperiod, $BVPlocation, $BVPtags, $BVPtypes, $BVPcontact);
        
      }
    }
  }
}

if($action == null || $action == 'list') {
  require_once "database/db_functions.php"; //test
  $db_getList = new DB_functions();
  mysqli_fetch_assoc($db_getList_info) = $db_getList->griffieList();
  print_r($db_getList_info);
}



?>

<!DOCTYPE html>

<head>
  <title>Inloggen gemeentedossier</title>
  <base href="//gemeentedossier.nl" />
  <meta charset="utf-8">

<!--  <meta http-equiv="cache-control" content="max-age=0" />-->
<!--  <meta http-equiv="cache-control" content="no-cache" />-->
<!--  <meta http-equiv="expires" content="0" />-->
<!--  <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />-->
<!--  <meta http-equiv="pragma" content="no-cache" />-->

  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.css"/>
  <link rel="stylesheet" type="text/css" href="bootstrap/style/bootstrap.min.css"/>
  <link href='./fonts/font-awesome.min.css' rel='stylesheet'/>
  <link rel="stylesheet" type="text/css" href="style/backend_css.css"/>
  <script src="scripts/jquery-1.12.3.min.js"></script>
  <script src="bootstrap/scripts/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/locales/bootstrap-datepicker.nl.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.js"></script>
  <script src="scripts/backend_main.js"></script>
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
          require_once 'admin/griffie/list.php';
          break;
    case "add";
          require_once 'admin/griffie/add.php';
          break;
    case "edit";
          require_once 'admin/griffie/edit.php';
          break;
    case "delete";
          require_once 'admin/griffie/delete.php';
          break;
    default:
          require_once 'admin/griffie/list.php';
          break; }
  ?>
</div>
<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>

</html>
