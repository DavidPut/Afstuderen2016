<form class="form-horizontal" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

  <!-- nieuwe besluitvorming -->
  <div class="row">
    <div class="col-md-12 col-xs-12 ">
      <div class="page-header">
        <div class="pull-left">
        <h3>Besluitvormingsproces <span class="label label-danger"><i class="fa fa-trash-o small-icon" aria-hidden="true"></i></span></h3>
        </div>
        <div class="pull-right">
          <a class="btn btn-default" href="griffie">annuleren</a>
          <button name="BVPdelete" class="btn btn-list btn-danger">verwijderen</button>
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
          <input readonly="readonly" type="text" class="form-control" value="<?php echo $db_getItem_info['title']; ?>">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputSummary" class="col-sm-2 control-label">Samenvatting</label>
        <div class="col-sm-10">
          <textarea readonly="readonly" class="form-control" name="summary"rows="3"><?php echo $db_getItem_info['summary']; ?></textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputAdrescode" class="col-sm-2 control-label">Postcode/adres</label>
        <div class="col-sm-10">
          <input readonly="readonly" class="form-control" type="text" name="adrescode" value="<?php echo $db_getItem_info['location']; ?>"></input>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputTags" class="col-sm-2 control-label">Zoekwoorden</label>
        <div class="col-sm-10">
          <input readonly="readonly" class="form-control" type="text" name="tags" value="<?php echo $db_getItem_info['tags']; ?>"></input>
        </div>
      </div>
    </div>
  </div>

  <?php
    $db_getItem_info['type'];
    $selectedBox = explode(",", $db_getItem_info['type']);
  ?>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputTags" class="col-sm-2 control-label">Soort</label>
        <div class="col-sm-10">
          <label class="checkbox-inline">
            <input disabled type="checkbox" id="inlineCheckbox1" value="F" <?php if(in_array('F',$selectedBox)){echo 'checked';} ?>> Fysiek
          </label>
          <label class="checkbox-inline">
            <input disabled type="checkbox" id="inlineCheckbox2" value="S" <?php if(in_array('S',$selectedBox)){echo 'checked';} ?>> Sociaal
          </label>
          <label class="checkbox-inline">
            <input disabled type="checkbox" id="inlineCheckbox3" value="B" <?php if(in_array('B',$selectedBox)){echo 'checked';} ?>> Bestuur en middelen
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
              <input disabled type="radio" name="optionsRadios" id="optionsRadios1" value="1" <?php if($db_getItem_info['period'] == '1'){echo 'checked';}?>>
              Korter dan een jaar
            </label>
          </div>
          <div class="radio">
            <label>
              <input disabled type="radio" name="optionsRadios" id="optionsRadios2" value="2" <?php if($db_getItem_info['period'] == '2'){echo 'checked';}?>>
              Langer dan een jaar, korter dan vijf jaar
            </label>
          </div>
          <div class="radio">
            <label>
              <input disabled type="radio" name="optionsRadios" id="optionsRadios3" value="3" <?php if($db_getItem_info['period'] == '3'){echo 'checked';}?>>
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
                  <input readonly="readonly" type="text" name="titleProces" class="form-control" placeholder="Titel proces">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-xs-12 ">
              <div class="form-group">
                <label for="inputSummaryProces" class="col-sm-2 control-label">Samenvatting proces</label>
                <div class="col-sm-10">
                  <textarea readonly="readonly" class="form-control" name="summaryProces" placeholder="Samenvatting besluitvorming" rows="6"></textarea>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 col-xs-12 ">
              <div class="form-group">
                <label for="inputSummaryProces" class="col-sm-2 control-label">Bestanden</label>
                <div class="col-sm-10">
                  <input readonly="readonly" class="form-control" type="file" name="inputFile"></input>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- proces uitprinten als die er zijn voor edit pagina -->






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
          <input readonly="readonly" type="text" name="agendaTitle" class="form-control" placeholder="Titel agenda">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group row">
        <label for="inputDateExtra" class="col-sm-2 control-label">Datum</label>
        <div class="col-sm-10 date">
          <input readonly="readonly" type="text" class="form-control input-group-addon-text" placeholder="dd/mm/jjjj">
        </div>
      </div>
    </div>
  </div>

  <?php
  $db_getItem_info['contact'];
  $selectedBox = explode(",", $db_getItem_info['contact']);
  ?>

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
      <a class="btn btn-lg btn-default text-left" href="griffie">annuleren</a>
      <button class="btn btn-lg btn-danger text-right" type ="submit" name ="BVPdelete">verwijderen</button>
    </div>
  </div>

</form>

<script>
  $(document).ready(function() {
    $('.input-group-addon-text').datepicker({
      format: "dd/mm/yyyy",
      startView: 1,
      maxViewMode: 0,
      language: "nl",
      calendarWeeks: true,
      autoclose: true,
      todayHighlight: true,
      enableOnReadonly: false
    });
  });
</script>
