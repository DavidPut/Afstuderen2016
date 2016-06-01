<?php


?>

<form class="form-horizontal" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

  <!-- proces -->
  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="page-header">
        <h4>Besluitvorming</h4>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">

      <div class = "panel panel-default">
        
        <div class = "panel-heading">
          <h3 class = "panel-title">Nieuwe besluitvorming</h3>
        </div>

        <div class = "panel-body">

          <div class="row">
            <div class="col-md-12 col-xs-12 ">
              <div class="form-group">
                <label for="inputTitleProces" class="col-sm-2 control-label">Titel</label>
                <div class="col-sm-10">
                  <input type="text" name="titleProces" class="form-control" placeholder="Titel proces">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-xs-12 ">
              <div class="form-group">
                <label for="inputSummaryProces" class="col-sm-2 control-label">Samenvatting proces</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="summaryProces" placeholder="Samenvatting besluitvorming" rows="6"></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-xs-12 ">
              <div class="form-group">
                <label for="inputSummaryProces" class="col-sm-2 control-label">Bestanden</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" name="inputFile"></input>
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
      <button class="btn btn-lg btn-success btn-block" type = "submit" name = "add" value = "toevoegen">Toevoegen</button>
    </div>
  </div>

</form>
