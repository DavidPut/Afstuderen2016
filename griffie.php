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

    <!-- nieuwe besluitvorming -->
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
              <label for="inputTitle" class="col-sm-2 control-label">Titel</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Titel besluitvorming">
              </div>
            </div>
          </div>
        </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12 ">
          <div class="form-group">
            <label for="inputSummary" class="col-sm-2 control-label">Samenvatting</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="summary" placeholder="Samenvatting besluitvorming" rows="3"></textarea>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12 ">
          <div class="form-group">
            <label for="inputAdrescode" class="col-sm-2 control-label">Postcode/adres</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="adrescode" placeholder="Een postcode of adres"></input>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12 ">
          <div class="form-group">
            <label for="inputTags" class="col-sm-2 control-label">Zoekwoorden</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="tags" placeholder="Tags, gescheiden door komma's"></input>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12 ">
          <div class="form-group">
            <label for="inputTags" class="col-sm-2 control-label">Soort</label>
            <div class="col-sm-10">
              <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> Fysiek
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2" value="option2"> Sociaal
              </label>
              <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3" value="option3"> Bestuur en middelen
              </label>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12 ">
          <div class="form-group">
            <label for="inputTags" class="col-sm-2 control-label">Periode</label>
            <div class="col-sm-10">
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                  Korter dan een jaar
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                  Langer dan een jaar, korter dan vijf jaar
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                  Vijf jaar of langer
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12 ">
          <div class="page-header">
            <h2>Proces toevoegen</h2>
          </div>
        </div>
      </div>

        <div class="row">
          <div class="col-md-8 col-md-offset-2 col-xs-12 ">
            <div class="form-group">
              <label for="inputTitle" class="col-sm-2 control-label">Titel</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Titel besluitvorming">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8 col-md-offset-2 col-xs-12 ">
            <div class="form-group">
              <label for="inputSummary" class="col-sm-2 control-label">Samenvatting</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="summary" placeholder="Samenvatting besluitvorming" rows="3"></textarea>
              </div>
            </div>
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
