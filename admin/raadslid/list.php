<div class="row">
  <div class="col-md-12 col-md-offset-0 col-xs-12 ">
    <table class="table table-hover table-list">
      <thead>
      <tr>
        <th class="col-md-1">Nummer</th>
        <th class="col-md-6">Titel</th>
        <th class="col-md-2">
          <i class="fa fa-comment-o" aria-hidden="true"></i>
          <i class="fa fa-comments" aria-hidden="true"></i>
          <i class="fa fa-comments" aria-hidden="true"></i></th>
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
        <td>0
        2
        ja</td>
        <td>
          <a href=\"dossier.html\"><button type=\"button\" class=\"btn btn-list btn-default\"  data-toggle=\"tooltip\" data-placement=\"top\" title='Ga naar pagina'><i class=\"fa fa-long-arrow-right small-icon\" aria-hidden=\"true\"></i></button></a>
          <a href=\"raadslid.php?action=add\"><button type=\"button\" class=\"btn btn-list btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Aanpassen'><i class=\"fa fa-pencil small-icon\" aria-hidden=\"true\"></i></button></a>
          <a href=\"https://www.facebook.com/share.php?u=gemeentedossier.nl/griffie.php?action=new&title=test\" target=\"blank\"><button type=\"button\" class=\"btn btn-list btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Delen'><i class=\"fa fa-share-alt small-icon\" aria-hidden=\"true\"></i></button></a>
        </td>
      </tr>";
      } ?>
      </tbody>
    </table>
  </div>
</div>