<?php $_POST = $_SESSION['POST']; ?>

  <!-- nieuwe besluitvorming -->
  <div class="row">
    <div class="col-md-12 col-xs-12 ">
      <div class="page-header">
        <div class="pull-left">
          <h3>Besluitvorming <span class="label label-success"><i class="fa fa-plus small-icon" aria-hidden="true"></i></span></h3>
        </div>
        <div class="pull-right">

          <a class="btn btn-default" href="raadslid.php?action=edit&id=<?php echo $id; ?>">annuleren</a>
          <button class="btn btn-list btn-success" type="submit" name ="BVadd" value="toevoegen">toevoegen</button>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>


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




<?php
if(isset($_SESSION['Callback'])){
  unset($_SESSION['Callback']);
} ?>