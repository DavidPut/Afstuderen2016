<?php


?>

<!DOCTYPE html>

<head>
  <title>Inloggen gemeentedossier</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="bootstrap/style/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style/backend_css.css"/>
  <script src="scripts/jquery-1.12.3.min.js"></script>
  <script src="bootstrap/scripts/bootstrap.min.js"></script>

</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Gemeentedossier</a>
    </div>
  </div>
</nav>


<div class="container-fluid">

  <div class="row">
    <div class="col-md-8 col-md-offset-2 col-xs-12 ">
      <div class="page-header">
        <h1>Nieuwe besluitvorming</h1>
      </div>
    </div>
  </div>

  <div class="row">
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12 ">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Titel</span>
            <input type="email" name="email" class="form-control" placeholder="uw e-mailadres" aria-describedby="basic-addon1" autofocus>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Samenvatting</span>
            <textarea class="form-control" name="summary" placeholder="samenvatting" rows="3" aria-describedby="basic-addon1"></textarea>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-4 col-md-offset-4 col-xs-12">
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="add" value="toevoegen">Toevoegen</button>

        </div>
      </div>

    </form>
  </div>
</body>

</html>
