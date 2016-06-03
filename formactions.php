<?php

session_start();

if(isset($_POST['loginsubmit'])) {
  $_SESSION['POST'] = $_POST;
  if (isset($_POST['mail']) && !empty($_POST['mail'])) {
    if (isset($_POST['password']) && !empty($_POST['password'])) {

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

        unset($_SESSION['Callback']);
        unset($_SESSION['POST']);
        header("location: griffie");
        exit();
      } else {
        $_SESSION['Callback'] = true;
        header("Location: login");
        exit();
      }
    } else {
      // geen wachtwoord
      $_SESSION['Callback'] = true;
      header("Location: login");
      exit();
    }
  }
}


// Nieuwe besluitvormingsproces
if(isset($_POST['BVPadd'])) {
  $_SESSION['POST'] = $_POST;
  $_SESSION['Callback'] = true;
  session_write_close();
  if(isset($_POST['BVPaddTitle']) && !empty($_POST['BVPaddTitle'])) {
    if(isset($_POST['BVPaddSummary']) && !empty($_POST['BVPaddSummary'])) {
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
          $_POST['BVPaddType'] = $BVPtypes;
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

        session_start();
        unset($_SESSION['Callback']);
        unset($_SESSION['POST']);
        session_write_close();
        header("location: griffie");
        exit();
      }
    }
  }
  //errors
  header("location: griffie/add");
  exit();
}

// Besluitvormingsproces updaten
if(isset($_POST['BVPedit'])) {
  $_SESSION['POST'] = $_POST;
  $_SESSION['Callback'] = true;
  $pid = $_POST['pid'];
  if(isset($_POST['BVPeditTitle']) && !empty($_POST['BVPeditTitle'])) {
    if(isset($_POST['BVPeditSummary']) && !empty($_POST['BVPeditSummary'])) {
      if(isset($_POST['BVPeditPeriod'])) {

        $BVPtitle = $_POST['BVPeditTitle'];
        $BVPsummary = $_POST['BVPeditSummary'];
        $BVPperiod = $_POST['BVPeditPeriod'];

        if (isset($_POST['BVPeditLocation'])) {
          $BVPlocation = $_POST['BVPeditLocation'];
        } else {
          $BVPlocation = null;
        }

        if (isset($_POST['BVPeditTags'])) {
          $BVPtags = $_POST['BVPeditTags'];
        } else {
          $BVPtags = null;
        }

        if (!empty($_POST['BVPeditType'])) {
          $BVPtypes;
          foreach ($_POST['BVPeditType'] as $selected) {
            $BVPtypes = $BVPtypes . $selected . ",";
          }
          $_POST['BVPeditType'] = $BVPtypes;
        } else {
          $BVPtypes = null;
        }

        if (!empty($_POST['BVPeditContact'])) {
          $BVPcontact = "";
          foreach ($_POST['BVPeditContact'] as $selected) {
            $BVPcontact = $BVPcontact . $selected . ",";
          }
        } else {
          // is het empty.. geen probleem
          $BVPcontact = null;
        }

        require_once "database/db_functions.php";
        $db_addPush = new DB_functions();
        $db_addPush_info = $db_addPush->griffieEdit($pid, $BVPtitle, $BVPsummary, $BVPperiod, $BVPlocation, $BVPtags, $BVPtypes, $BVPcontact);

        unset($_SESSION['Callback']);
        unset($_SESSION['POST']);
        header("location: griffie/");
        exit();
      }
    }
  }
  //errors
  header("location: griffie/edit/".$pid."/");
  exit();
}

// Besluitvormingsproces verwijderen
if(isset($_POST['BVPdelete'])) {
  $id = $_POST['pid'];

  require_once "database/db_functions.php";
  $db_deletePush = new DB_functions();
  $db_deletePush_info = $db_deletePush->griffieDelete($id);

  header("location: griffie");
  exit();
}

// Nieuwe besluit bij besluitvormingsproces
if(isset($_POST['BVadd'])) {
  $_SESSION['POST'] = $_POST;
  $_SESSION['Callback'] = true;
  $pid = $_POST['pid'];
  if(isset($_POST['BVaddTitle']) && !empty($_POST['BVaddTitle'])) {
    if(isset($_POST['BVaddSummary']) && !empty($_POST['BVaddSummary'])) {

        $BVtitle = $_POST['BVaddTitle'];
        $BVsummary = $_POST['BVaddSummary'];

        require_once "database/db_functions.php";
        $db_addBVPush = new DB_functions();
        $db_addBVPush_info = $db_addBVPush->griffieBVAdd($pid, $BVtitle, $BVsummary);

        unset($_SESSION['Callback']);
        unset($_SESSION['POST']);
        header("location: griffie/edit/".$pid."/");
        exit();
    }
  }
  //errors
  header("location: griffie/edit/".$pid."/besluitvorming/add");
  exit();
}

// Nieuwe besluit bij besluitvormingsproces
if(isset($_POST['BVedit'])) {
  $_SESSION['POST'] = $_POST;
  $_SESSION['Callback'] = true;
  session_write_close();
  $pid = $_POST['pid'];
  $bid = $_POST['bid'];
  if(isset($_POST['BVeditTitle']) && !empty($_POST['BVeditTitle'])) {
    if(isset($_POST['BVeditSummary']) && !empty($_POST['BVeditSummary'])) {

      $BVtitle = $_POST['BVeditTitle'];
      $BVsummary = $_POST['BVeditSummary'];

      require_once "database/db_functions.php";
      $db_editBVPush = new DB_functions();
      $db_editBVPush_info = $db_editBVPush->griffieBVEdit($pid, $bid, $BVtitle, $BVsummary);

      session_start();
      unset($_SESSION['Callback']);
      unset($_SESSION['POST']);
      session_write_close();
      header("location: griffie/edit/".$pid."/");
      exit();
    }
  }
  //errors
  header("location: griffie/edit/".$pid."/besluitvorming/add");
  exit();
}


?>