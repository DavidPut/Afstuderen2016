<?php $_POST = $_SESSION['POST']; ?>

<form class="form-horizontal" action="formactions.php" method="POST">

  <!-- nieuwe besluitvorming //-->
  <div class="row">
    <div class="col-md-12 col-xs-12 ">
      <div class="page-header">
        <div class="pull-left">
        <h3>Besluitvormingsproces <span class="label label-success"><i class="fa fa-plus fa-fw" aria-hidden="true"></i></span></h3>
        </div>
        <div class="pull-right">
          <a class="btn btn-default" href="griffie.php">annuleren</a>
          <button type="submit" name ="BVPadd" class="btn btn-list btn-success">toevoegen</button>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group <?php if($_SESSION['Callback'] == true && empty($_POST['BVPaddTitle'])){echo "has-error";}?>">
        <label for="addTitle" class="col-sm-2 control-label">Titel *</label>
        <div class="col-sm-10">
          <input type="text" name="BVPaddTitle" class="form-control" placeholder="Titel besluitvorming" value="<?php if($_SESSION['Callback'] == true){echo $_POST['BVPaddTitle'];}?>">
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group <?php if($_SESSION['Callback'] == true && empty($_POST['BVPaddSummary'])){echo "has-error";}?>">
        <label for="addSummary" class="col-sm-2 control-label">Samenvatting *</label>
        <div class="col-sm-10">
          <textarea class="form-control" name="BVPaddSummary" placeholder="Samenvatting besluitvorming" rows="3"><?php if($_SESSION['Callback'] == true){echo $_POST['BVPaddSummary'];}?></textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group <?php if($_SESSION['Callback'] == true){echo "has-warning";}?>">
        <label for="addLocation" class="col-sm-2 control-label">Postcode/adres</label>
        <div class="col-sm-10">
          <input class="form-control" type="text" name="BVPaddLocation" placeholder="Een postcode of adres"></input>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group <?php if($_SESSION['Callback'] == true){echo "has-warning";}?>">
        <label for="addTags" class="col-sm-2 control-label">Zoekwoorden</label>
        <div class="col-sm-10">
          <input class="form-control" type="text" name="BVPaddTags" placeholder="Tags, gescheiden door komma's"></input>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group <?php if($_SESSION['Callback'] == true){echo "has-error";}?>">
        <label for="inputTags" class="col-sm-2 control-label">Soort *</label>
        <div class="col-sm-10">
          <label class="checkbox-inline">
            <input type="checkbox" name="BVPaddType[]" id="inlineCheckbox1" value="physical"> Fysiek
          </label>
          <label class="checkbox-inline">
            <input type="checkbox" name="BVPaddType[]" id="inlineCheckbox2" value="social"> Sociaal
          </label>
          <label class="checkbox-inline">
            <input type="checkbox" name="BVPaddType[]" id="inlineCheckbox3" value="money"> Bestuur en middelen
          </label>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-10 col-md-offset-1 col-xs-12 ">
      <div class="form-group <?php if($_SESSION['Callback'] == true){echo "has-error";}?>">
        <label for="inputTags" class="col-sm-2 control-label">Periode *</label>
        <div class="col-sm-10">
          <div class="radio">
            <label>
              <input type="radio" name="BVPaddPeriod" id="optionsRadios1" value="low">
              Korter dan een jaar
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="BVPaddPeriod" id="optionsRadios2" value="mid">
              Langer dan een jaar, korter dan vijf jaar
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="BVPaddPeriod" id="optionsRadios3" value="high">
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
      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle fa-fw fa-lg" aria-hidden="true"></i> Er kunnen nog geen besluiten worden toegevoegd.</div>
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
      <div class="alert alert-info" role="alert"><i class="fa fa-info-circle fa-fw fa-lg" aria-hidden="true"></i> Er kan nog geen agenda worden toegevoegd en contactgegevens worden achtergelaten.</div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-4 col-md-offset-5 col-xs-12">
      <a class="btn btn-lg btn-default text-left" href="griffie.php">annuleren</a>
      <button class="btn btn-lg btn-success text-right" type="submit" name="BVPadd">toevoegen</button>
    </div>
  </div>

</form>
<?php
if(isset($_SESSION['Callback'])){
  unset($_SESSION['Callback']);
} ?>
