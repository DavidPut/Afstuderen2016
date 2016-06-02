<?php

?>

<a class="btn btn-success pull-right" data-toggle="tooltip" data-placement="top" title="Besluitvormingsproces toevoegen" href="griffie/add"><i class="fa fa-plus small-icon fa-lg"></i> Toevoegen</a>
<table class="table table-hover table-list">
  <thead>
  <tr>

    <th class="col-md-1">Nummer</th>
    <th class="col-md-8">Titel</th>
    <th class="col-md-3 text-right">Opties</th>
  </tr>
  </thead>
  <tbody>
  <?php for ($x = 0; $x <= 5; $x++) {
    echo "
      <tr>
        <td>" . $x . "</td>
        <td>Een titel van een besluitvorming</td>
        <td>
          <p class='text-right'>
            <a class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Ga naar pagina' href=\"griffie/add\"><i class=\"fa fa-long-arrow-right fa-fw\"></i></a>
            <a class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title='Aanpassen' href=\"griffie/besluitvorming/bvedit.php\"><i class=\"fa fa-pencil fa-fw\"></i></a>
            <a class=\"btn btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title='Verwijderen' href=\"griffie/besluitvorming/bvdelete.php\"><i class=\"fa fa-trash-o fa-fw\"></i></a>
          </p>
        </td>
      </tr>"; } ?>
  </tbody>
</table>
