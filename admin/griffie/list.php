<div class="row">
  <div class="col-md-12 col-md-offset-0 col-xs-12 ">
    <button data-toggle="tooltip" data-placement="top" title="Besluitvormingsproces toevoegen" class="btn btn-list btn-success pull-right"><i class="fa fa-plus small-icon" aria-hidden="true"><a href="griffie/add"></a></i></button>
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
            <button type=\"button\" class=\"btn btn-list btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Ga naar pagina'><i class=\"fa fa-long-arrow-right small-icon\" aria-hidden=\"true\"><a href='http://gemeentedossier.nl/dossier.html'></a></i></button>
            <button type=\"button\" class=\"btn btn-list btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Aanpassen'><i class=\"fa fa-pencil small-icon\" aria-hidden=\"true\"><a href='griffie/edit/'></a></i></button>
            <button type=\"button\" class=\"btn btn-list btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title='Verwijderen'><i class=\"fa fa-trash-o small-icon\" aria-hidden=\"true\" ><a href='griffie/delete/'></a></i></button>
          </p>
        </td>
      </tr>"; } ?>
      </tbody>
    </table>
  </div>
</div>