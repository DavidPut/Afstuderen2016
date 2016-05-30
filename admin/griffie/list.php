<div class="row">
  <div class="col-md-12 col-md-offset-0 col-xs-12 ">
    <a href="griffie.php?action=add"><button data-toggle="tooltip" data-placement="top" title="Besluitvormingsproces toevoegen" class="btn btn-list btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button></a>
    <table class="table table-hover table-list">
      <thead>
      <tr>

        <th class="col-md-1">Nummer</th>
        <th class="col-md-8">Titel</th>
        <th class="col-md-3">Opties</th>
      </tr>
      </thead>
      <tbody>
      <?php for ($x = 0; $x <= 20; $x++) {
      echo "
      <tr>
        <td>" . $x . "</td>
        <td>Een titel van een besluitvorming</td>
        <td>
          <p class='text-right'>
            <button type=\"button\" class=\"btn btn-list btn-default\"><i class=\"fa fa-long-arrow-right\" aria-hidden=\"true\"><a href='http://gemeentedossier.nl/dossier.html' data-toggle=\"tooltip\" data-placement=\"top\" title='Ga naar pagina'></a></i></button>
            <button type=\"button\" class=\"btn btn-list btn-default\"><a href='http://gemeentedossier.nl/griffie.php?action=edit' data-toggle=\"tooltip\" data-placement=\"top\" title='Aanpassen'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></button>
            <button type=\"button\" class=\"btn btn-list btn-danger\"><a href='http://gemeentedossier.nl/griffie.php?action=delete' data-toggle=\"tooltip\" data-placement=\"top\" title='Verwijderen'><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a></button>
          </p>
        </td>
      </tr>"; } ?>
      </tbody>
    </table>
  </div>
</div>