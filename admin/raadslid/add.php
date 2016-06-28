<?php $_POST = $_SESSION['POST']; ?>

  <form class="form-horizontal" action="formactions.php" method="POST">
    <input type="hidden" name="pid" value="<?php echo $db_getItem_info['id']; ?>">



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
              <input type="checkbox" name="BVPeditType[]" id="inlineCheckbox1" value="physical" <?php if(in_array('physical',$selectedBox)){echo 'checked';} ?>> Fysiek
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="BVPeditType[]" id="inlineCheckbox2" value="social" <?php if(in_array('social',$selectedBox)){echo 'checked';} ?>> Sociaal
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="BVPeditType[]" id="inlineCheckbox3" value="money" <?php if(in_array('money',$selectedBox)){echo 'checked';} ?>> Bestuur en middelen
            </label>
          </div>
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
                    <input type="text" name="BVaddTitle" class="form-control" placeholder="Titel besluit">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-xs-12 ">
                <div class="form-group">
                  <label for="inputSummaryProces" class="col-sm-2 control-label">Samenvatting proces</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="BVaddSummary" placeholder="Samenvatting besluit" rows="6"></textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 col-xs-12 ">
                <div class="form-group">
                  <label for="inputSummaryProces" class="col-sm-2 control-label">Bestanden</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="BVaddfile" name="inputFile"></input>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>


    <!-- bv -->
    <div class="row">
      <div class="col-md-10 col-md-offset-1 col-xs-12 ">
        <div class="page-header">
          <h4>Besluitvorming</h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-10 col-md-offset-1 col-xs-12 ">
        <?php require_once "besluitvorming/bvlist.php"; ?>
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
                <input type="checkbox" name="BVPeditContact[]" value="GEM"> Gemeente contactgegevens
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="BVPeditContact[]" value="GRIEF"> Griffie contactgegevens
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 col-md-offset-4 col-xs-12">
        <a class="btn btn-lg btn-default text-left" href="griffie.php">annuleren</a>
        <button class="btn btn-lg btn-primary text-right" type = "submit" name = "BVPedit" value = "aanpassen">aanpassen</button>
      </div>
    </div>

  </form>

<?php
if(isset($_SESSION['Callback'])){
  unset($_SESSION['Callback']);
} ?>