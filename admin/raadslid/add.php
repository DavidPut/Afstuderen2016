<?php $_POST = $_SESSION['POST']; ?>

  <!-- nieuwe besluitvorming -->
  <div class="row">
    <div class="col-md-12 col-xs-12 ">
      <div class="page-header">
        <div class="pull-left">
          <h3>Besluitvormingsproces <span class="label label-success"><i class="fa fa-plus small-icon" aria-hidden="true"></i></span></h3>
        </div>
        <div class="pull-right">

          <a class="btn btn-default" href="raadslid.php?action=list">annuleren</a>
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

<?php
if(isset($_SESSION['Callback'])){
  unset($_SESSION['Callback']);
} ?>