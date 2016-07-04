<?php

session_start();

$action = urlencode($_GET['action']);
$id = urlencode($_GET['id']);

if (isset($_SESSION['mail'])) {
  if ($_SESSION['role'] != "griffier") {
    header("Location: indexerror.php");
    exit();
  }
} else {
  header("Location: login.php");
  exit();
}

// rare rrors soms

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
    <input type="hidden" name="pid" value="<?php echo $id; ?>">

    <!-- nieuwe besluitvorming -->
    <div class="row">
      <div class="col-md-12 col-xs-12 ">
        <div class="page-header">
          <div class="pull-left">
            <h3>Besluitvorming <span class="label label-success"><i class="fa fa-plus small-icon" aria-hidden="true"></i></span></h3>
          </div>
          <div class="pull-right">
            <a class="btn btn-default" href="griffie.php?action=edit&id=<?php echo $id; ?>">annuleren</a>
            <button class="btn btn-list btn-success" type="submit" name ="agendaAdd" value="toevoegen">toevoegen</button>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-10 col-md-offset-1 col-xs-12 ">

        <div class = "panel panel-default">

          <div class = "panel-heading">
            <h3 class = "panel-title">Nieuwe agendadatum</h3>
          </div>

          <div class = "panel-body">

            <div class="row">
              <div class="col-md-12 col-xs-12 ">
                <div class="form-group">
                  <label for="inputTitleProces" class="col-sm-2 control-label">Agenda</label>
                  <div class="col-sm-10">
                    <input type="text" disabled name="agendaTitle" class="form-control" placeholder="Titel agenda">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-xs-12 ">
                <div class="form-group">
                  <label for="inputDateExtra" class="col-sm-2 control-label">Datum</label>
                  <div class="col-sm-10 date">
                    <input type="text" disabled name="agendaDate" class="form-control input-group-addon-text" placeholder="dd/mm/jjjj">
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
        <a class="btn btn-lg btn-default text-left" href="griffie.php?action=edit&id=<?php echo $id; ?>">annuleren</a>
        <button class="btn btn-lg btn-success text-right" type="submit" name="agendaAdd" value="toevoegen">toevoegen</button>
      </div>
    </div>

  </form>
</div>
<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
<script>
  $(document).ready(function() {
    $('.input-group-addon-text').datepicker({
      format: "dd-mm-yyyy",
      startView: 1,
      maxViewMode: 0,
      language: "nl",
      calendarWeeks: false,
      autoclose: true,
      todayHighlight: true
    });
  });
</script>

</body>

</html>