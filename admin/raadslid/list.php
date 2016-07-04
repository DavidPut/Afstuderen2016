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
            <a href=\"https://www.facebook.com/share.php?u=gemeentedossier.nl/dossier.php?id=".$db_getList_info_item['id']."&action=new&title=test\" target=\"blank\"><button type=\"button\" class=\"btn btn-list btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Delen'><i class=\"fa fa-share-alt small-icon\" aria-hidden=\"true\"></i></button></a>
        </td>
      </tr>";
      } ?>
      </tbody>
    </table>
  </div>
</div>