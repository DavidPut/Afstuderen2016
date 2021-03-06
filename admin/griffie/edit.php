<?php $_POST = $_SESSION['POST']; ?>

<form class="form-horizontal" action="formactions.php" method="POST">
  <input type="hidden" name="pid" value="<?php echo $db_getItem_info['id']; ?>">
  <input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">

  <!-- nieuwe besluitvorming -->
  <div class="row">
    <div class="col-md-12 col-xs-12 ">
      <div class="page-header">
        <div class="pull-left">
          <h3>Besluitvormingsproces <span class="label label-primary"><i class="fa fa-pencil small-icon" aria-hidden="true"></i></span> <a class="btn btn-default" href="dossier.php?id=<?php echo $db_getItem_info['id']; ?>">naar pagina</a></h3>
        </div>
        <div class="pull-right">
          <a class="btn btn-default" href="griffie.php">annuleren</a>
          <button class="btn btn-list btn-primary" type="submit" name ="BVPedit" value="toevoegen">aanpassen</button>
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
          <input type="text" name="BVPeditTitle"class="form-control" placeholder="Titel besluitvorming" value="<?php if($_SESSION['Callback'] == true){echo $_POST['BVPeditTitle'];} else {echo $db_getItem_info['title'];} ?>">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputSummary" class="col-sm-2 control-label">Samenvatting</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="BVPeditSummary" placeholder="Samenvatting besluitvorming" rows="3"><?php if($_SESSION['Callback'] == true){echo $_POST['BVPeditSummary'];} else {echo $db_getItem_info['summary'];} ?></textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputAdrescode" class="col-sm-2 control-label">Postcode/adres</label>
        <div class="col-sm-10">
          <input class="form-control" type="text" name="BVPeditLocation" placeholder="Een postcode of adres" value="<?php echo $db_getItem_info['location']; ?>"></input>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group">
        <label for="inputTags" class="col-sm-2 control-label">Zoekwoorden</label>
        <div class="col-sm-10">
          <input class="form-control" type="text" name="BVPeditTags" placeholder="Tags, gescheiden door komma's" value="<?php echo $db_getItem_info['searchtags']; ?>"></input>
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
      <div class="form-group">
        <label for="inputTags" class="col-sm-2 control-label">Periode</label>
        <div class="col-sm-10">
          <div class="radio">
            <label>
              <input type="radio" name="BVPeditPeriod" id="optionsRadios1" value="low" <?php if($db_getItem_info['period'] == 'low'){echo 'checked';}?>>
              Korter dan een jaar
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="BVPeditPeriod" id="optionsRadios2" value="mid" <?php if($db_getItem_info['period'] == 'mid'){echo 'checked';}?>>
              Langer dan een jaar, korter dan vijf jaar
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="BVPeditPeriod" id="optionsRadios3" value="high" <?php if($db_getItem_info['period'] == 'high'){echo 'checked';}?>>
              Vijf jaar of langer
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
      <?php require_once "agenda/alist.php"; ?>
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
              Griffier contactgegevens niet achterlaten
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="BVPaddContact" id="optionsRadios2" value="on" <?php if($db_getContactItem_info == true){echo 'checked';}?>>
              Griffier contactgegevens achterlaten
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

<script>
  $(document).ready(function() {
    $('.input-group-addon-text').datepicker({
      format: "dd-mm-yyyy",
      startView: 1,
      maxViewMode: 0,
      language: "nl",
      calendarWeeks: false,
      autoclose: true,
      todayHighlight: true
    });
  });
</script>

<?php
if(isset($_SESSION['Callback'])){
  unset($_SESSION['Callback']);
} ?>

