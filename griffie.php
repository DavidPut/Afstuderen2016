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
  <form class="form-horizontal" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

  <div class="row">
    <div class="col-md-8 col-md-offset-2 col-xs-12 ">
      <div class="page-header">
        <h2>Nieuwe besluitvorming</h2>
      </div>
    </div>
  </div>

  <div class="row">

    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12 ">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Titel</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputEmail3" placeholder="Titel besluitvorming">
            </div>
          </div>
        </div>
      </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-xs-12 ">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Samenvatting</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="summary" placeholder="Samenvatting besluitvorming" rows="3"></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-xs-12 ">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Postcode/adres</label>
          <div class="col-sm-10">
            <input class="form-control" type="text" name="adrescode" placeholder="Een postcode of adres" aria-describedby="basic-addon1"></input>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-xs-12 ">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Zoekwoorden</label>
          <div class="col-sm-10">
            <input class="form-control" type="text" name="tags" placeholder="Tags, gescheiden door komma's" aria-describedby="basic-addon1"></input>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-xs-12">
            <input type="checkbox" id="inlineCheckbox1" value="option1"> Fysiek
            <input type="checkbox" id="inlineCheckbox2" value="option2"> Sociaal
            <input type="checkbox" id="inlineCheckbox3" value="option3"> Bestuur en middelen
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-xs-12">
            <input type="radio" name="RadioOptions" id="Radio1" value="option1">Korter dan een jaar</input>
            <input type="radio" name="RadioOptions" id="Radio2" value="option2">1 tot 5 jaar</input>
            <input type="radio" name="RadioOptions" id="Radio3" value="option3">5 jaar of langer</input>
      </div>
    </div>

      <div class="row">
        <div class="col-md-4 col-md-offset-4 col-xs-12">
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="add" value="toevoegen">Toevoegen</button>

        </div>
      </div>

  </div>
  </form>
</body>

</html>
