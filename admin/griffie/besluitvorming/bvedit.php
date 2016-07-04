<?php

session_start();

$action = urlencode($_GET['action']);
$pid = urlencode($_GET['id']);
$bid = urlencode($_GET['bid']);

if (isset($_SESSION['mail'])) {
  if ($_SESSION['role'] != "griffier") {
    header("Location: indexerror.php");
    exit();
  }
} else {
  header("Location: login.php");
  exit();
}


//database verkrijgen data
require_once "../../../database/db_functions.php";
$db_getBVItem = new DB_functions();
$db_getBVItem_info = $db_getBVItem->BVItem($pid, $bid);

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
  <form class="form-horizontal" action="formactions.php" method="POST">
    <input type="hidden" name="pid" value="<?php echo $pid; ?>">
    <input type="hidden" name="bid" value="<?php echo $bid; ?>">

    <!-- nieuwe besluitvorming -->
    <div class="row">
      <div class="col-md-12 col-xs-12 ">
        <div class="page-header">
          <div class="pull-left">
            <h3>Besluitvorming <span class="label label-primary"><i class="fa fa-pencil small-icon" aria-hidden="true"></i></span></h3>
          </div>
          <div class="pull-right">
            <a class="btn btn-default" href="griffie.php?action=edit&id=<?php echo $pid; ?>">annuleren</a>
            <button class="btn btn-list btn-primary" type="submit" name ="BVedit" value="toevoegen">opslaan</button>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-10 col-md-offset-1 col-xs-12 ">

        <div class = "panel panel-default">

          <div class = "panel-heading">
            <h3 class = "panel-title">Bestaande besluitvorming</h3>
          </div>

          <div class = "panel-body">

            <div class="row">
              <div class="col-md-12 col-xs-12 ">
                <div class="form-group">
                  <label for="inputTitleProces" class="col-sm-2 control-label">Titel</label>
                  <div class="col-sm-10">
                    <input type="text" name="BVeditTitle" class="form-control" value="<?php echo $db_getBVItem_info['title']; ?>">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-xs-12 ">
                <div class="form-group">
                  <label for="inputSummaryProces" class="col-sm-2 control-label">Samenvatting proces</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="BVeditSummary" rows="6"><?php echo $db_getBVItem_info['summary']; ?></textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-xs-12 ">
                <div class="form-group">
                  <label for="inputSummaryProces" class="col-sm-2 control-label">Bestanden</label>
                  <div class="col-sm-10">
                    <input class="form-control" placeholder="http://www.mijngemeente.nl/locatie/bestanden" type="text" value="<?php echo $db_getBVItem_info['url']; ?>" name="inputFile"></input>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    <div class="row">
      <div class="col-md-4 col-md-offset-4 col-xs-12">
        <a class="btn btn-lg btn-default text-left" href="griffie.php?action=edit&id=<?php echo $pid; ?>">annuleren</a>
        <button class="btn btn-lg btn-primary text-right" type="submit" name="BVedit" value="opslaan">opslaan</button>
      </div>
    </div>

  </form>
</div>
<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>

</html>