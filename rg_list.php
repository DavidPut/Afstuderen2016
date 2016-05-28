<?php

//test 2test
$raadslid = 1;
$griffie = 0;

?>

<!DOCTYPE html>

<head>
  <title>Overzicht</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="bootstrap/style/bootstrap.min.css">
  <link href='./fonts/font-awesome.min.css' rel='stylesheet'/>
  <link rel="stylesheet" type="text/css" href="style/backend_css.css"/>
  <script src="scripts/jquery-1.12.3.min.js"></script>
  <script src="bootstrap/scripts/bootstrap.min.js"></script>

</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Gemeentedossier</a>
    </div>
    <p class="navbar-text navbar-right"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <a href="#" class="navbar-link">Mijn account</a></p>
    </uL>
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
  <div class="row">
    <div class="col-md-12 col-md-offset-0 col-xs-12 ">
      <?php
      if($raadslid == 0 && $griffie == 1) {
        echo '<a href="griffie.php?action=add"><button data-toggle="tooltip" data-placement="top" title="Besluitvormingsproces toevoegen" class="btn btn-list btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button></a>';
      }
      ?>
  <table class="table table-hover table-list">
    <thead>
      <tr>
        <?php
        if ($raadslid == 1 && $griffie == 0) {

          echo '
        <th class="col-md-1">Nummer</th>
        <th class="col-md-5">Titel</th>
        <th class="col-md-1"><i class="fa fa-comment-o" aria-hidden="true"></i></th>
        <th class="col-md-1"><i class="fa fa-comments" aria-hidden="true"></i></th>
        <th class="col-md-1"><i class="fa fa-comments" aria-hidden="true"></i></th>
        <th class="col-md-3">Opties</th>
        ';
        } elseif ($raadslid == 0 && $griffie == 1){
            echo '
        <th class="col-md-1">Nummer</th>
        <th class="col-md-7">Titel</th>
        <th class="col-md-4">Opties</th>
        ';
        }
        ?>
      </tr>
    </thead>
    <tbody>

    <?php

    if ($raadslid == 1 && $griffie == 0){
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
      }
    } elseif ($raadslid == 0 && $griffie == 1){
    for ($x = 0; $x <= 20; $x++) {
      echo "
      <tr>
        <td>" . $x . "</td>
        <td>Een titel van een besluitvorming</td>
        <td>
          <a href='http://gemeentedossier.nl/dossier.html' data-toggle=\"tooltip\" data-placement=\"top\" title='Ga naar pagina'><button type=\"button\" class=\"btn btn-list btn-default\"><i class=\"fa fa-long-arrow-right\" aria-hidden=\"true\"></i></button></a>
          <a href='http://gemeentedossier.nl/griffie.php?action=edit' data-toggle=\"tooltip\" data-placement=\"top\" title='Aanpassen'><button type=\"button\" class=\"btn btn-list btn-default\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button></a>
          <a href='http://gemeentedossier.nl/griffie.php?action=delete' data-toggle=\"tooltip\" data-placement=\"top\" title='Verwijderen'><button type=\"button\" class=\"btn btn-list btn-danger\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></a>
        </td>
      </tr>";
    }
    } else {
      //do nothing and more nothing edit - nog een kleine dit / test test test
    }

?>
    </tbody>
  </table>
      </div>
    </div>
</div>

<script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>

</html>
