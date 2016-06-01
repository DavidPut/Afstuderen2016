<form class="form-horizontal" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

  <!-- nieuwe besluitvorming -->
  <div class="row">
    <div class="col-md-12 col-xs-12 ">
      <div class="page-header">
        <div class="pull-left">
          <h3>Besluitvormingsproces <span class="label label-primary"><i class="fa fa-pencil small-icon" aria-hidden="true"></i></span></h3>
        </div>
        <div class="pull-right">
          <button data-toggle="tooltip" data-placement="top" title="Aanpassen annuleren" class="btn btn-list btn-default">Annuleren <i class="fa fa-times small-icon" aria-hidden="true"><a href="griffie"></a></i></button>
          <button data-toggle="tooltip" data-placement="top" title="Besluitvormingsproces aanpassen" class="btn btn-list btn-primary">Aanpassen <i class="fa fa-pencil small-icon" aria-hidden="true"><a href="griffie"></a></i></button>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputTitle" class="col-sm-2 control-label">Titel</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" placeholder="Titel besluitvorming">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputSummary" class="col-sm-2 control-label">Samenvatting</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="summary" placeholder="Samenvatting besluitvorming" rows="3"></textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputAdrescode" class="col-sm-2 control-label">Postcode/adres</label>
        <div class="col-sm-10">
          <input class="form-control" type="text" name="adrescode" placeholder="Een postcode of adres"></input>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputTags" class="col-sm-2 control-label">Zoekwoorden</label>
        <div class="col-sm-10">
          <input class="form-control" type="text" name="tags" placeholder="Tags, gescheiden door komma's"></input>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
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
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
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

  <!-- proces uitprinten als die er zijn voor edit pagina -->
  <div class="row">
      <div class="col-md-10 col-md-offset-1 col-xs-12 ">
        <div class = "panel panel-primary">
            <div class = "panel-heading">
                <h3 class = "panel-title">Bestaande besluitvorming</h3>
            </div>
            <div class = "panel-body">

                <div class="row">
      <div class="col-md-12 col-xs-12 ">
        <div class="form-group">
          <label for="inputTitleProces" class="col-sm-2 control-label">Titel</label>
          <div class="col-sm-10">
            <input type="text" name="titleProces" class="form-control" value="Commissievergaderinng">
          </div>
        </div>
      </div>
    </div>

                <div class="row">
      <div class="col-md-12 col-xs-12 ">
        <div class="form-group">
          <label for="inputSummaryProces" class="col-sm-2 control-label">Samenvatting proces</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="summaryProces" rows="6">Samenvatting besluit van de commissievergadering</textarea>
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






  <!-- extra gegevens -->
  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="page-header">
        <h4>Extra gegevens</h4>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputTitleProces" class="col-sm-2 control-label">Agenda</label>
        <div class="col-sm-10">
          <input type="text" name="agendaTitle" class="form-control" placeholder="Titel agenda">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputDateExtra" class="col-sm-2 control-label">Datum</label>
        <div class="col-sm-10 date">
          <input type="text" class="form-control input-group-addon-text" placeholder="dd/mm/jjjj">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputContact" class="col-sm-2 control-label">Contactgegevens</label>
        <div class="col-sm-10">
          <div class="checkbox">
            <label>
              <input type="checkbox" value=""> Gemeente contactgegevens
            </label>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" value=""> Griffie contactgegevens
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-4 col-md-offset-4 col-xs-12">
      <button class="btn btn-lg btn-primary btn-block" type = "submit" name = "edit" value = "Aanpassen">Aanpassen</button>
    </div>
  </div>

</form>
