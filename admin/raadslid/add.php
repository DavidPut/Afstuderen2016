<?php $_POST = $_SESSION['POST']; ?>

  <!-- nieuwe besluitvorming -->
  <div class="row">
    <div class="col-md-12 col-xs-12 ">
      <div class="page-header">
        <div class="pull-left">
          <h3>Besluitvorming <span class="label label-primary"><i class="fa fa-pencil small-icon" aria-hidden="true"></i></span></h3>
        </div>
        <div class="pull-right">
          <a class="btn btn-default" href="raadslid.php?action=list">annuleren</a>
          <button class="btn btn-list btn-primary" type="submit" name ="RaadslidContactEdit" value="aanpassen">aanpassen</button>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>


  <form class="form-horizontal" action="formactions.php" method="POST">
    <input type="hidden" name="pid" value="<?php echo $_GET['id']; ?>">
    <input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">



    <?php

    $db_getContactItem_info = $db_getList->RaadslidContactItem($db_getItem_info['id'], $uid);


    ?>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group <?php if($_SESSION['Callback'] == true){echo "has-error";}?>">
        <label for="inputTags" class="col-sm-2 control-label">Contactgegevens</label>
        <div class="col-sm-10">
          <div class="radio">
            <label>
              <input type="radio" name="BVPaddContact" id="optionsRadios1" value="off">
              Mijn contactgegevens niet achterlaten
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="BVPaddContact" id="optionsRadios2" value="on">
              Mijn contactgegevens achterlaten
            </label>
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

  <div class="row">
    <div class="col-md-4 col-md-offset-4 col-xs-12">
      <a class="btn btn-lg btn-default text-left" href="raadslid.php">annuleren</a>
      <button class="btn btn-lg btn-primary text-right" type = "submit" name = "RaadslidContactEdit" value = "aanpassen">aanpassen</button>
    </div>
  </div>

<?php
if(isset($_SESSION['Callback'])){
  unset($_SESSION['Callback']);
} ?>