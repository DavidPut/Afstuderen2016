<?php
require_once "database/db_functions.php";
$db_getBVList = new DB_functions();
$db_getBVList_info = $db_getBVList->griffieAgendaList($id);

if($action == 'edit'){
  echo '<a class="btn btn-success pull-right" href="admin/griffie/agenda/aadd.php?id='.$db_getItem_info['id'].'"></i>toevoegen</a>';
}
if (is_array($db_getBVList_info)){

?>
<table class="table table-hover table-list">
  <thead>
  <tr>
    <th class="col-md-3">Datum</th>
    <th class="col-md-6">Titel</th>
    <?php if($action == 'edit') {
      echo '<th class="col-md-3 text-right">opties</th>';
    } else {
      echo '<th class="col-md-3 text-right">actie</th>';
    }?>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($db_getBVList_info as $db_getBVList_info_item) {
    echo " 
      <tr>
        <td>".$db_getBVList_info_item['date']."</td>
        <td>".$db_getBVList_info_item['title']."</td>
        <td>
          <p class='text-right'>
            ".(($action == 'edit')?"<a class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Aanpassen\" href=\"admin/griffie/agenda/aedit.php?id=".$db_getItem_info['id']."&aid=".$db_getBVList_info_item['id']."\"><i class=\"fa fa-pencil fa-fw\"></i></a>":"")."
            <a class=\"btn btn-danger ".(($action == 'delete')?"disabled":'')." \" data-toggle=\"tooltip\" data-placement=\"top\" title='Verwijderen' href=\"admin/griffie/agenda/adelete.php?id=".$db_getItem_info['id']."&aid=".$db_getBVList_info_item['id']."\"><i class=\"fa fa-trash-o fa-fw\"></i></a>
          </p>
        </td>
      </tr>"; }} ?>
  </tbody>
</table>