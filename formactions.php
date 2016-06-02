<?php

// Nieuwe besluitvormingsproces
if(isset($_POST['BVPadd'])) {
  if(isset($_POST['BVPaddTitle'])) {
    if(isset($_POST['BVPaddSummary'])) {
      if(isset($_POST['BVPaddPeriod'])) {

        $BVPtitle = $_POST['BVPaddTitle'];
        $BVPsummary = $_POST['BVPaddSummary'];
        $BVPperiod = $_POST['BVPaddPeriod'];

        if (isset($_POST['BVPaddLocation'])) {
          $BVPlocation = $_POST['BVPaddLocation'];
        } else {
          $BVPlocation = null;
        }

        if (isset($_POST['BVPaddTags'])) {
          $BVPtags = $_POST['BVPaddTags'];
        } else {
          $BVPtags = null;
        }

        if (!empty($_POST['BVPaddType'])) {
          $BVPtypes;
          foreach ($_POST['BVPaddType'] as $selected) {
            $BVPtypes = $BVPtypes . $selected . ",";
          }
        } else {
          $BVPtypes = null;
        }

        if (!empty($_POST['BVPaddContact'])) {
          $BVPcontact = "";
          foreach ($_POST['BVPaddContact'] as $selected) {
            $BVPcontact = $BVPcontact . $selected . ",";
          }
        } else {
          // is het empty.. geen probleem
          $BVPcontact = null;
        }

        require_once "database/db_functions.php";
        $db_addPush = new DB_functions();
        $db_addPush_info = $db_addPush->griffieAdd($BVPtitle, $BVPsummary, $BVPperiod, $BVPlocation, $BVPtags, $BVPtypes, $BVPcontact);

        header("location: griffie");
        exit();
      }
    }
  }
}

if(isset($_POST['login'])) {
  if (isset($_POST['mail'])) {
    if (isset($_POST['password'])) {

      $form_mail = $_POST['mail'];
      $form_pass = $_POST['password'];

      require_once "database/db_functions.php";
      $db_login = new DB_functions();
      $db_login_info = $db_login->login($form_mail);

      $database_pass = $db_login_info['password'];

      if (md5($form_pass) == $database_pass) {
        $_SESSION['mail'] = $db_login_info['mail'];
        $_SESSION['name'] = $db_login_info["name"];
        $_SESSION['role'] = $db_login_info["role"];
        $_SESSION['uid'] = $db_login_info["id"];
        
        header("location: login");
        exit();
      } else {
        // verkeerde wachtwoord
        header("Location: login");
        exit();
      }
    }
  }
}

?>