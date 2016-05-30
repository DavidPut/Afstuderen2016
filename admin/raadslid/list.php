<div class="row">
  <div class="col-md-12 col-md-offset-0 col-xs-12 ">
    <table class="table table-hover table-list">
      <thead>
      <tr>
        <th class="col-md-1">Nummer</th>
        <th class="col-md-5">Titel</th>
        <th class="col-md-1"><i class="fa fa-comment-o" aria-hidden="true"></i></th>
        <th class="col-md-1"><i class="fa fa-comments" aria-hidden="true"></i></th>
        <th class="col-md-1"><i class="fa fa-comments" aria-hidden="true"></i></th>
        <th class="col-md-3">Opties</th>
      </tr>
      </thead>
      <tbody>
      <?php
      for ($x = 0; $x <= 20; $x++) {
        echo "
      <tr>
        <td>" . $x . "</td>
        <td>Een titel van een besluitvorming</td>
        <td>0</td>
        <td>2</td>
        <td>ja</td>
        <td>
          <button type=\"button\" class=\"btn btn-list btn-default\"  data-toggle=\"tooltip\" data-placement=\"top\" title='Ga naar pagina'><i class=\"fa fa-long-arrow-right small-icon\" aria-hidden=\"true\"><a href='http://gemeentedossier.nl/dossier.html'></a></i></button>
          <button type=\"button\" class=\"btn btn-list btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Aanpassen'><i class=\"fa fa-pencil small-icon\" aria-hidden=\"true\"><a href='http://gemeentedossier.nl/griffie.php?action=edit'></a></i></button>
          <button type=\"button\" class=\"btn btn-list btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Delen'><i class=\"fa fa-share-alt small-icon\" aria-hidden=\"true\"><a href='https://www.facebook.com/share.php?u=gemeentedossier.nl/griffie.php?action=new&title=test' target=\"blank\"></a></i></button>
        </td>
      </tr>";
      } ?>
      </tbody>
    </table>
  </div>
</div>