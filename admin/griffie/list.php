<!-- nieuwe besluitvorming -->
<div class="row">
  <div class="col-md-12 col-xs-12 ">
    <div class="page-header">
      <div class="pull-left">
        <h3>Besluitvormingsprocessen <span class="label label-info"><i class="fa fa-list fa-fw" aria-hidden="true"></i></span></h3>
      </div>
      <div class="pull-right">
        <a class="btn btn-success pull-right" href="griffie.php?action=add"><i class="fa fa-plus small-icon fa-lg"></i> Toevoegen</a>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 col-md-offset-0 col-xs-12 ">
    <table class="table table-hover table-list">
      <thead>
      <tr>
        <th class="col-md-1">id</th>
        <th class="col-md-8">titel</th>
        <th class="col-md-3 text-right">opties</th>
      </tr>
      </thead>
      <tbody>
      <?php foreach ($db_getList_info as $db_getList_info_item) {
        echo " 
      <tr>
        <td>".$db_getList_info_item['id']."</td>
        <td>".$db_getList_info_item['title']."</td>
        <td>
          <p class='text-right'>
            <a class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Ga naar pagina' href=\"dossier.php?id=".$db_getList_info_item['id']."\"><i class=\"fa fa-long-arrow-right fa-fw\"></i></a>
            <a class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Aanpassen' href=\"griffie.php?action=delete&id=".$db_getList_info_item['id']."\"><i class=\"fa fa-pencil fa-fw\"></i></a>
            <a class=\"btn btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title='Verwijderen' href=\"griffie.php?action=delete&id=".$db_getList_info_item['id']."\"><i class=\"fa fa-trash-o fa-fw\"></i></a>
          </p>
        </td>
      </tr>"; } ?>
      </tbody>
    </table>
  </div>
</div>