<?php

require_once "database/db_functions.php";
$db_getBVList = new DB_functions();
$db_getBVList_info = $db_getBVList->griffieBVList($id);


if($action == 'edit'){
  echo '<a class="btn btn-success pull-right" href="admin/raadslid/besluitvorming/bvadd.php?id='.$db_getItem_info['id'].'"></i>toevoegen</a>';
}
if ($db_getBVList_info){

?>


<table class="table table-hover table-list">
  <thead>
  <tr>
    <th class="col-md-8">Titel</th>
    <th class="col-md-3 text-right">opties</th>';
  </tr>
  </thead>
  <tbody>
  <?php foreach ($db_getBVList_info as $db_getBVList_info_item) {
    echo " 
      <tr>
        <td>".$db_getBVList_info_item['title']."</td>
        <td>
          <p class='text-right'>";
            $db_getBVOpinionList_info = $db_getBVList->raadslidList($id, $db_getBVList_info_item['id'], $_SESSION['uid']);
            echo $db_getBVOpinionList_info['id'];
            if ($db_getBVOpinionList_info){
              echo "<a class=\"btn btn-default\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Aanpassen\" href=\"admin/raadslid/besluitvorming/bvedit.php?id=\"><i class=\"fa fa-pencil fa-fw\"></i></a>";
              echo "<a class=\"btn btn-danger \" data-toggle=\"tooltip\" data-placement=\"top\" title='Verwijderen' href=\"admin/raadslid/besluitvorming/bvdelete.php?id=".$db_getItem_info['id']."&bid=".$db_getBVList_info_item['id']."\"><i class=\"fa fa-trash-o fa-fw\"></i></a>";
            } else {
              echo "<a class=\"btn btn-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Toevoegen\" href=\"admin/raadslid/besluitvorming/bvadd.php?id=\"><i class=\"fa fa-plus fa-fw\"></i></a>";
            }}} ?>
          </p>
        </td>
      </tr>
  </tbody>
</table>