<div class="row">
  <div class="col-md-12 col-md-offset-0 col-xs-12 ">
    <a href="griffie.php?action=add"><button data-toggle="tooltip" data-placement="top" title="Besluitvormingsproces toevoegen" class="btn btn-list btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button></a>
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
          <a href='http://gemeentedossier.nl/dossier.html' data-toggle=\"tooltip\" data-placement=\"top\" title='Ga naar pagina'><button type=\"button\" class=\"btn btn-list btn-default\"><i class=\"fa fa-long-arrow-right\" aria-hidden=\"true\"></i></button></a>
          <a href='http://gemeentedossier.nl/griffie.php?action=edit' data-toggle=\"tooltip\" data-placement=\"top\" title='Aanpassen'><button type=\"button\" class=\"btn btn-list btn-default\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button></a>
          <a href='https://www.facebook.com/share.php?u=gemeentedossier.nl/griffie.php?action=new&title=test' target=\"blank\" data-toggle=\"tooltip\" data-placement=\"top\" title='Aanpassen'><button type=\"button\" class=\"btn btn-list btn-default\"><i class=\"fa fa-share-alt\" aria-hidden=\"true\"></i></button></a>
        </td>
      </tr>";
      } ?>
      </tbody>
    </table>
  </div>
</div>