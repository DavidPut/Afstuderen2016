<?php

class DB_functions
{

  private $db;

  function __construct()
  {
    require_once 'db_connect.php';
    $this->db = new DB_connect();
    $this->db->connect();
  }

  // destructor
  function __destruct()
  {
    $this->db->close();
  }

  /**
   * Login for users
   */
  public function login($mail)
  {
    $result = mysqli_query($this->db->connect(), "SELECT * FROM users WHERE mail = '$mail'") or die(mysqli_error($this->db->connect()));
    $no_of_rows = mysqli_num_rows($result);
    if ($no_of_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row;
      $this->db->close();
    } else {
      return false;
      $this->db->close();
    }
  }

  public function griffieList(){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process") or die(mysqli_error($this->db->connect()));
    $no_of_rows = mysqli_num_rows($result);
    if ($no_of_rows > 0) {
      $rows_result = array();
      while($row = mysqli_fetch_assoc($result)) {
        $rows_result[] = $row;
      }
      return $rows_result;
    } else {
      return false;
      $this->db->close();
    }
  }

  public function griffieItem($id){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process WHERE id = '$id'") or die(mysqli_error($this->db->connect()));
    $no_of_rows = mysqli_num_rows($result);
    if ($no_of_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      $this->db->close();
      return $row;
    } else {
      $this->db->close();
      return false;
    }
  }

  //griffie process toevoegen
  public function griffieAdd($BVPtitle, $BVPsummary, $BVPperiod, $BVPlocation, $BVPtags, $BVPtypes, $BVPcontact){
    $datenow = date("d-m-Y");
    $result = mysqli_query($this->db->connect(), "INSERT INTO `gdadmin_dossier`.`process` (`id`, `title`, `summary`, `location`, `type`, `period`, `searchtags`,`date`) VALUES (NULL, '$BVPtitle', '$BVPsummary', '$BVPlocation', '$BVPtypes', '$BVPperiod', '$BVPtags','$datenow')")or die( mysqli_error($this->db->connect()));
    // check for successful store
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  //griffieEDit
  public function griffieEdit($pid, $BVPtitle, $BVPsummary, $BVPperiod, $BVPlocation, $BVPtags, $BVPtypes, $BVPcontact){
    $result = mysqli_query($this->db->connect(), "UPDATE `gdadmin_dossier`.`process` SET `title` = '$BVPtitle', `summary` = '$BVPsummary', `location` = '$BVPlocation', `period` = '$BVPperiod',`type` = '$BVPtypes'  WHERE `process`.`id` = '$pid'") or die( mysqli_error($this->db->connect()));
    // check for successful store
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  public function griffieDelete($pid){
    $result = mysqli_query($this->db->connect(), "DELETE FROM process WHERE id = '$pid'") or die(mysqli_error($this->db->connect()));
    $result2 = mysqli_query($this->db->connect(), "DELETE FROM process_decision WHERE pid = '$pid'") or die(mysqli_error($this->db->connect()));
    $result3 = mysqli_query($this->db->connect(), "DELETE FROM process_agenda WHERE pid = '$pid'") or die(mysqli_error($this->db->connect()));
    $result4 = mysqli_query($this->db->connect(), "DELETE FROM process_opinion WHERE pid = '$pid'") or die(mysqli_error($this->db->connect()));
    if ($result && $result2 && $result3 && $result4) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }



  // lijst van besluiten bij id proces
  public function griffieBVList($pid){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process_decision WHERE pid = '$pid'") or die(mysqli_error($this->db->connect()));
    $no_of_rows = mysqli_num_rows($result);
    if ($no_of_rows > 0) {
      $rows_result = array();
      while($row = mysqli_fetch_assoc($result)) {
        $rows_result[] = $row;
      }
      return $rows_result;
      $this->db->close();
    } else {
      return false;
      $this->db->close();
    }
  }


  // besluiten toevoegen
  public function griffieBVAdd($pid, $BVPtitle, $BVPsummary){
    $datenow = date("d/m/Y");
    $result = mysqli_query($this->db->connect(), "INSERT INTO `gdadmin_dossier`.`process_decision` (`id`,`pid`, `title`, `summary`, `date`) VALUES (NULL, '$pid', '$BVPtitle', '$BVPsummary','$datenow')")or die( mysqli_error($this->db->connect()));
    // check for successful store
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  // besluiten updaten
  public function griffieBVEdit($pid, $bid, $BVtitle, $BVsummary){
    $result = mysqli_query($this->db->connect(), "UPDATE `gdadmin_dossier`.`process_decision` SET `title` = '$BVtitle', `summary` = '$BVsummary' WHERE `process_decision`.`id` = '$bid' && `pid` = '$pid'") or die( mysqli_error($this->db->connect()));
    // check for successful store
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  //nogagenda

  // pakt de lijst voor raadsleden met de besluiten of ze al gereageerd hebben op het besluit
  public function raadslidList($pid, $did, $uid){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process_opinion WHERE pid = '$pid' AND did = '$did' AND uid ='$uid'") or die(mysqli_error($this->db->connect()));
    $no_of_rows = mysqli_num_rows($result);
    if ($no_of_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      $this->db->close();
      return $row;
    } else {
      $this->db->close();
      return false;
    }
  }

  // pakt de lijst voor raadsleden met de besluiten of ze al gereageerd hebben op het besluit
  public function BVItem($pid, $did){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process_opinion WHERE pid = '$pid' AND did = '$did' AND uid ='$uid'") or die(mysqli_error($this->db->connect()));
    $no_of_rows = mysqli_num_rows($result);
    if ($no_of_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      $this->db->close();
      return $row;
    } else {
      $this->db->close();
      return false;
    }
  }

  // politieke meningen per process decision
  public function decisionOpinion($did){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process_opinion WHERE did = '$did'") or die(mysqli_error($this->db->connect()));
    $no_of_rows = mysqli_num_rows($result);
    if ($no_of_rows > 0) {
      $rows_result = array();
      while($row = mysqli_fetch_assoc($result)) {
        $rows_result[] = $row;
      }
      return $rows_result;
      $this->db->close();
    } else {
      return false;
      $this->db->close();
    }
  }

  // selecteer gebruikers
  public function selectUser($id){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM users WHERE id = '$id'") or die(mysqli_error($this->db->connect()));
    $no_of_rows = mysqli_num_rows($result);
    if ($no_of_rows > 0) {
      $rows_result = array();
      while($row = mysqli_fetch_assoc($result)) {
        $rows_result[] = $row;
      }
      return $rows_result;
      $this->db->close();
    } else {
      return false;
      $this->db->close();
    }
  }

  //Selecteer agenda bij pid
  public function selectCalendar($pid)
  {
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process_agenda WHERE pid = '$pid'") or die(mysqli_error($this->db->connect()));
    $no_of_rows = mysqli_num_rows($result);
    if ($no_of_rows > 0) {
      $rows_result = array();
      while ($row = mysqli_fetch_assoc($result)) {
        $rows_result[] = $row;
      }
      return $rows_result;
      $this->db->close();
    } else {
      return false;
      $this->db->close();
    }
  }

  public function selectContact($pid){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process_contact WHERE pid = '$pid'") or die(mysqli_error($this->db->connect()));
    $no_of_rows = mysqli_num_rows($result);
    if ($no_of_rows > 0) {
      $rows_result = array();
      while ($row = mysqli_fetch_assoc($result)) {
        $rows_result[] = $row;
      }
      return $rows_result;
      $this->db->close();
    } else {
      return false;
      $this->db->close();
    }
  }
}