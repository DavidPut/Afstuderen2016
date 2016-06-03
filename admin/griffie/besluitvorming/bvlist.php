<?php


if($action == 'edit'){
  echo '<a class="btn btn-success pull-right" href="griffie/'.$db_getItem_info_item['id'].'/besluitvorming/add"></i>toevoegen</a>';
}
?>
<table class="table table-hover table-list">
  <thead>
  <tr>
    <th class="col-md-8">Titel</th>
    <?php if($action == 'edit') {
      echo '<th class="col-md-3 text-right">opties</th>';
    } else {
      echo '<th class="col-md-3 text-right">actie</th>';
    }?>
  </tr>
  </thead>
  <tbody>
  <?php for ($x = 0; $x <= 5; $x++) {
    echo " 
      <tr>
        <td>".$db_getList_info_item['title']."</td>
        <td>
          <p class='text-right'>
            ".(($action == 'edit')?"<a class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Aanpassen\" href=\"griffie/edit/".$db_getItem_info_item['id']."\"><i class=\"fa fa-pencil fa-fw\"></i></a>":"")."
            <a class=\"btn btn-danger ".(($action == 'delete')?"disabled":'')." \" data-toggle=\"tooltip\" data-placement=\"top\" title='Verwijderen' href=\"griffie/delete/".$db_getItem_info_item['id']."\"><i class=\"fa fa-trash-o fa-fw\"></i></a>
          </p>
        </td>
      </tr>"; } ?>
  </tbody>
</table>
