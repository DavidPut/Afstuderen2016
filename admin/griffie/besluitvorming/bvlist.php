<?php


if($action == 'edit'){
  echo '<a class="btn btn-success pull-right" href="griffie/besluitvorming/add"></i>toevoegen</a>';
}
?>
<table class="table table-hover table-list">
  <thead>
  <tr>

    <th class="col-md-1">Nummer</th>
    <th class="col-md-8">Titel</th>
    <?php if($action == 'edit') {
      echo '<th class="col-md-3 text-right">Opties</th>';
    } ?>
  </tr>
  </thead>
  <tbody>
  <?php for ($x = 0; $x <= 5; $x++) {
    echo "
      <tr>
        <td>" . $x . "</td>
        <td>Een titel van een besluitvorming</td>
        <td>
          <p class='text-right'>";
            if($action == 'edit'){ echo "<a class=\"btn btn-default \" data-toggle=\"tooltip\" data-placement=\"top\" title='Aanpassen' href=\"besluitvorming/edit/\"><i class=\"fa fa-pencil fa-fw\"></i></a>";}
            echo "<a class=\"btn btn-danger ". if($action =='delete'){echo "disabled"}; ." \" data-toggle=\"tooltip\" data-placement=\"top\" title='Verwijderen' href=\"besluitvorming/delete/\"><i class=\"fa fa-trash-o fa-fw\"></i></a>";
          echo "</p>
        </td>
      </tr>";} ?>
  </tbody>
</table>
