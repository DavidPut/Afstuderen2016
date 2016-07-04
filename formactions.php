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
        header("location: login.php");
        exit();
      } else {
        $_SESSION['Callback'] = true;
        header("Location: login.php");
        exit();
      }
    } else {
      // geen wachtwoord
      $_SESSION['Callback'] = true;
      header("Location: login.php");
      exit();
    }
  }
}


// Nieuwe besluitvormingsproces
if(isset($_POST['BVPadd'])) {
  $_SESSION['POST'] = $_POST;
  $_SESSION['Callback'] = true;
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

        unset($_SESSION['Callback']);
        unset($_SESSION['POST']);
        header("location: griffie.php");
        exit();
      }
    }
  }
  //errors
  header("location: griffie.php?action=add");
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
        header("location: griffie.php");
        exit();
      }
    }
  }
  //errors
  header("location: griffie.php?action=edit&id=".$pid."");
  exit();
}

// Besluitvormingsproces verwijderen
if(isset($_POST['BVPdelete'])) {
  $id = $_POST['pid'];

  require_once "database/db_functions.php";
  $db_deletePush = new DB_functions();
  $db_deletePush_info = $db_deletePush->griffieDelete($id);

  header("location: griffie.php");
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
        header("location: griffie.php?action=edit&id=".$pid."");
        exit();
    }
  }
  //errors
  header("location: admin/griffie/besluitvorming/bvadd.php?id=".$pid."");
  exit();
}

// aanpassen besluit bij besluitvormingsproces
if(isset($_POST['BVedit'])) {
  $_SESSION['POST'] = $_POST;
  $_SESSION['Callback'] = true;
  $pid = $_POST['pid'];
  $bid = $_POST['bid'];
  if(isset($_POST['BVeditTitle']) && !empty($_POST['BVeditTitle'])) {
    if(isset($_POST['BVeditSummary']) && !empty($_POST['BVeditSummary'])) {

      $BVtitle = $_POST['BVeditTitle'];
      $BVsummary = $_POST['BVeditSummary'];

      require_once "database/db_functions.php";
      $db_editBVPush = new DB_functions();
      $db_editBVPush_info = $db_editBVPush->griffieBVEdit($pid, $bid, $BVtitle, $BVsummary);

      unset($_SESSION['Callback']);
      unset($_SESSION['POST']);
      header("location: griffie.php?action=edit&id=".$pid."");
      exit();
    }
  }
  //errors
  header("location: admin/griffie/besluitvorming/bvedit.php?id=".$pid."&bid=".$bid."");
  exit();
}

// Nieuwe opinie en stem bij besluitvormingsproces
if(isset($_POST['BVOpinionadd'])) {
  $_SESSION['POST'] = $_POST;
  $_SESSION['Callback'] = true;
  $pid = $_POST['pid'];
  $did = $_POST['did'];
  $uid = $_POST['uid'];
  if(isset($_POST['BVPaddVote']) && !empty($_POST['BVPaddVote'])) {
    if(isset($_POST['BVPaddOpinion']) && !empty($_POST['BVPaddOpinion'])) {

      $BVvote = $_POST['BVPaddVote'];
      $BVopinion = $_POST['BVPaddOpinion'];

      require_once "database/db_functions.php";
      $db_addBVPush = new DB_functions();
      $db_addBVPush_info = $db_addBVPush->raadslidOpinionAdd($pid, $did, $uid, $BVvote, $BVopinion);

      unset($_SESSION['Callback']);
      unset($_SESSION['POST']);
      header("location: raadslid.php?action=add&id=".$pid."");
      exit();
    }
  }
  //errors
  header("location: admin/raadslid/besluitvorming/bvadd.php?id=".$pid."&bid=".$did."");
  exit();
}

// Nieuwe opinie en stem bij besluitvormingsproces
if(isset($_POST['BVOpinionedit'])) {
  $_SESSION['POST'] = $_POST;
  $_SESSION['Callback'] = true;
  $pid = $_POST['pid'];
  $did = $_POST['did'];
  $uid = $_POST['uid'];
  if(isset($_POST['BVPaddVote']) && !empty($_POST['BVPaddVote'])) {
    if(isset($_POST['BVPaddOpinion']) && !empty($_POST['BVPaddOpinion'])) {

      $BVvote = $_POST['BVPaddVote'];
      $BVopinion = $_POST['BVPaddOpinion'];

      require_once "database/db_functions.php";
      $db_addBVPush = new DB_functions();
      $db_addBVPush_info = $db_addBVPush->raadslidOpinionEdit($pid, $did, $uid, $BVvote, $BVopinion);

      unset($_SESSION['Callback']);
      unset($_SESSION['POST']);
      header("location: raadslid.php?action=add&id=".$pid."");
      exit();
    }
  }
  //errors
  header("location: admin/raadslid/besluitvorming/bvadd.php?id=".$pid."&bid=".$did."");
  exit();
}

// Besluitvormingsproces opinie verwijderen
if(isset($_POST['BVOpiniondelete'])) {
  $pid = $_POST['pid'];
  $did = $_POST['did'];
  $uid = $_POST['uid'];

  require_once "database/db_functions.php";
  $db_deletePush = new DB_functions();
  $db_deletePush_info = $db_deletePush->raadslidDelete($pid, $did, $uid);

  header("location: raadslid.php?action=add&id=".$pid."");
  exit();
}

// Nieuwe opinie en stem bij besluitvormingsproces
if(isset($_POST['RaadslidContactEdit'])) {
  $_SESSION['POST'] = $_POST;
  $_SESSION['Callback'] = true;
  $pid = $_POST['pid'];
  $uid = $_POST['uid'];
  if(isset($_POST['BVPaddContact']) && !empty($_POST['BVPaddContact'])) {

      $BVcontact = $_POST['BVPaddContact'];
      if($BVcontact == "off"){
        require_once "database/db_functions.php";
        $db_addBVPush = new DB_functions();
        $db_addBVPush_info = $db_addBVPush->raadslidContactDelete($pid, $uid);
      } elseif ($BVcontact == "on") {
        require_once "database/db_functions.php";
        $db_addBVPush = new DB_functions();
        $db_getUser_info = $db_addBVPush->selectUser($uid);
        $db_addBVPush_info = $db_addBVPush->raadslidContactEdit($pid, $uid, $db_getUser_info['name'], $db_getUser_info['mail'], $db_getUser_info['telefoon']);
      } else {
        // deleten maar
        require_once "database/db_functions.php";
        $db_addBVPush = new DB_functions();
        $db_addBVPush_info = $db_addBVPush->raadslidContactDelete($pid, $uid);
      }

      unset($_SESSION['Callback']);
      unset($_SESSION['POST']);
      header("location: raadslid.php");
      exit();
  }
  //errors
  header("location: admin/raadslid/besluitvorming/bvadd.php?id=".$pid."&bid=".$did."");
  exit();
}


?>