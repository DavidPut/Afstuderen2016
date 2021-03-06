<?php $_POST = $_SESSION['POST']; ?>

  <form class="form-horizontal" action="formactions.php" method="POST">
  <input type="hidden" name="pid" value="<?php echo $_GET['id']; ?>">
  <input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">

  <!-- nieuwe besluitvorming -->
  <div class="row">
    <div class="col-md-12 col-xs-12 ">
      <div class="page-header">
        <div class="pull-left">
          <h3>Besluitvorming <span class="label label-primary"><i class="fa fa-pencil small-icon" aria-hidden="true"></i></span>
            <a class="btn btn-default" href="dossier.php?id=<?php echo $_GET['id']; ?>">naar pagina</a>
            <a class="btn btn-default" href="https://www.facebook.com/share.php?u=gemeentedossier.nl/dossier.php?id=<?php echo $_GET['id']; ?>" target="_blank">facebook delen</a>
            <a class="btn btn-default" href="https://www.twitter.com/home?status=http%3A//gemeentedossier.nl/dossier.php?id=<?php echo $_GET['id']; ?>%20Staat%20belangrijk%20nieuws%20in%20van%20de%20besluitvorming%20van%20de%20gemeente.%20" target="_blank">twitter delen</a>
          </h3>
        </div>
        <div class="pull-right">
          <a class="btn btn-default" href="raadslid.php?action=list">annuleren</a>
          <button class="btn btn-list btn-primary" type="submit" name ="RaadslidContactEdit" value="aanpassen">aanpassen</button>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>

    <?php
    require_once "database/db_functions.php"; //test
    $db_getList = new DB_functions();
    $db_getContactItem_info = $db_getList->raadslidContactItem($_GET['id'], $_SESSION['uid']);


    ?>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group <?php if($_SESSION['Callback'] == true){echo "has-error";}?>">
        <label for="inputTags" class="col-sm-2 control-label">Contactgegevens</label>
        <div class="col-sm-10">
          <div class="radio">
            <label>
              <input type="radio" name="BVPaddContact" id="optionsRadios1" value="off" <?php if($db_getContactItem_info == false){echo 'checked';}?>>
              Mijn contactgegevens niet achterlaten
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="BVPaddContact" id="optionsRadios2" value="on" <?php if($db_getContactItem_info == true){echo 'checked';}?>>
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