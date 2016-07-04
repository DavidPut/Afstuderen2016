<div class="row">
  <div class="col-md-12 col-xs-12 ">
    <div class="page-header">
      <div class="pull-left">
        <h3>Besluitvormingsprocessen <span class="label label-info"><i class="fa fa-list fa-fw" aria-hidden="true"></i></span></h3>
      </div>
      <div class="pull-right">
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
        <th class="col-md-1">Nummer</th>
        <th class="col-md-8">Titel</th>
        <th class="col-md-3">Opties</th>
      </tr>
      </thead>
      <tbody>
      <?php
      foreach ($db_getList_info as $db_getList_info_item) {
        echo "
      <tr>
        <td>".$db_getList_info_item['id']."</td>
        <td>".$db_getList_info_item['title']."</td>
        <td>
            <a class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Ga naar pagina' href=\"dossier.php?id=".$db_getList_info_item['id']."\"><i class=\"fa fa-long-arrow-right fa-fw\"></i></a>
            <a class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Aanpassen' href=\"raadslid.php?action=add&id=".$db_getList_info_item['id']."\"><i class=\"fa fa-pencil fa-fw\"></i></a>
            <a href=\"https://www.facebook.com/share.php?u=gemeentedossier.nl/dossier.php?id=".$db_getList_info_item['id']."&action=new&title=test\" target=\"blank\"><button type=\"button\" class=\"btn btn-list btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Delen'><i class=\"fa fa-facebook-f small-icon\" aria-hidden=\"true\"></i></button></a>
            <a href=\https://twitter.com/home?status=http%3A//gemeentedossier.nl/dossier.php?id=".$db_getList_info_item['id']."%20Staat%20belangrijk%20nieuws%20in%20van%20de%20besluitvorming%20van%20de%20gemeente.%20\" target=\"_blank\"><button type=\"button\" class=\"btn btn-list btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Delen'><i class=\"fa fa-twitter small-icon\" aria-hidden=\"true\"></i></button></a>
        </td>
      </tr>";
      } ?>
      </tbody>
    </table>
  </div>
</div>