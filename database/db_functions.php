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
    $mail = mysqli_real_escape_string($this->db->connect(),$mail);
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
    $BVPtitle = mysqli_real_escape_string($this->db->connect(),$BVPtitle);
    $BVPsummary = mysqli_real_escape_string($this->db->connect(),$BVPsummary);
    $BVPlocation = mysqli_real_escape_string($this->db->connect(),$BVPlocation);
    $BVPtags = mysqli_real_escape_string($this->db->connect(),$BVPtags);
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
    $BVPtitle = mysqli_real_escape_string($this->db->connect(),$BVPtitle);
    $BVPsummary = mysqli_real_escape_string($this->db->connect(),$BVPsummary);
    $BVPlocation = mysqli_real_escape_string($this->db->connect(),$BVPlocation);
    $BVPtags = mysqli_real_escape_string($this->db->connect(),$BVPtags);
    $result = mysqli_query($this->db->connect(), "UPDATE `gdadmin_dossier`.`process` SET `title` = '$BVPtitle', `summary` = '$BVPsummary', `location` = '$BVPlocation', `period` = '$BVPperiod',`type` = '$BVPtypes', `searchtags` = '$BVPtags'  WHERE `process`.`id` = '$pid'") or die( mysqli_error($this->db->connect()));
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

  public function griffieDeleteItem($pid, $did){
    $result = mysqli_query($this->db->connect(), "DELETE FROM process_decision WHERE id = '$did'") or die(mysqli_error($this->db->connect()));
    $result2 = mysqli_query($this->db->connect(), "DELETE FROM process_opinion WHERE did = '$did'") or die(mysqli_error($this->db->connect()));
    if ($result && $result2) {
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
  public function griffieBVAdd($pid, $BVPtitle, $BVPsummary, $BVurl){
    $BVPtitle = mysqli_real_escape_string($this->db->connect(),$BVPtitle);
    $BVPsummary = mysqli_real_escape_string($this->db->connect(),$BVPsummary);
    $datenow = date("d-m-Y");
    $result = mysqli_query($this->db->connect(), "INSERT INTO `gdadmin_dossier`.`process_decision` (`id`,`pid`, `title`, `summary`,`url`, `date`) VALUES (NULL, '$pid', '$BVPtitle', '$BVPsummary','$BVurl','$datenow')")or die( mysqli_error($this->db->connect()));
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
  public function griffieBVEdit($pid, $bid, $BVtitle, $BVsummary, $BVurl){
    $BVtitle = mysqli_real_escape_string($this->db->connect(),$BVtitle);
    $BVsummary = mysqli_real_escape_string($this->db->connect(),$BVsummary);
    $result = mysqli_query($this->db->connect(), "UPDATE `gdadmin_dossier`.`process_decision` SET `title` = '$BVtitle', `summary` = '$BVsummary', `url` = '$BVurl' WHERE `process_decision`.`id` = '$bid' && `pid` = '$pid'") or die( mysqli_error($this->db->connect()));
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
  public function raadslidDelete($pid, $did, $uid){
    $result = mysqli_query($this->db->connect(), "DELETE FROM process_opinion WHERE pid = '$pid' AND did = '$did' AND uid ='$uid' ") or die(mysqli_error($this->db->connect()));
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  // pakt BV item met daarin titel en tekst
  public function BVItem($pid, $did){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process_decision WHERE pid = '$pid' AND id = '$did'") or die(mysqli_error($this->db->connect()));
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

  // besluiten opinie toevoegen
  public function raadslidOpinionAdd($pid, $did, $uid, $BVvote, $BVopinion){
    $BVopinion = mysqli_real_escape_string($this->db->connect(),$BVopinion);
    $result = mysqli_query($this->db->connect(), "INSERT INTO `gdadmin_dossier`.`process_opinion` (`id`,`pid`,`did`,`uid`, `vote`, `opinion`) VALUES (NULL, '$pid', '$did', '$uid', '$BVvote', '$BVopinion')")or die( mysqli_error($this->db->connect()));
    // check for successful store
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  // besluiten opinie updaten
  public function raadslidOpinionEdit($pid, $did, $uid, $BVvote, $BVopinion){
    $BVopinion = mysqli_real_escape_string($this->db->connect(),$BVopinion);
    $result = mysqli_query($this->db->connect(), "UPDATE `gdadmin_dossier`.`process_opinion` SET `vote` = '$BVvote', `opinion` = '$BVopinion' WHERE `process_opinion`.`pid` = '$pid' && `did` = '$did' && `uid` = '$uid' ") or die( mysqli_error($this->db->connect()));
    // check for successful store
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  // besluiten opinie updaten
  public function raadslidContactEdit($pid, $uid, $name, $email, $phone){
    $result = mysqli_query($this->db->connect(), "INSERT INTO `gdadmin_dossier`.`process_contact` (`id`,`uid`,`pid`, `name`, `email`, `phone`) VALUES (NULL, '$uid', '$pid', '$name', '$email', '$phone')")or die( mysqli_error($this->db->connect()));
    // check for successful store
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  // pakt de lijst voor raadsleden met de besluiten of ze al gereageerd hebben op het besluit
  public function raadslidContactDelete($pid, $uid){
    $result = mysqli_query($this->db->connect(), "DELETE FROM process_contact WHERE pid = '$pid' AND uid ='$uid' ") or die(mysqli_error($this->db->connect()));
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  //  raadslid comtact item
  public function raadslidContactItem($pid, $uid){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process_contact WHERE pid = '$pid' AND uid = '$uid'") or die(mysqli_error($this->db->connect()));
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

  public function selectGebruiker($uid)
  {
    $result = mysqli_query($this->db->connect(), "SELECT * FROM users WHERE id = '$uid'") or die(mysqli_error($this->db->connect()));
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

  // lijst van agenda's
  public function griffieAgendaList($pid){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process_agenda WHERE pid = '$pid'") or die(mysqli_error($this->db->connect()));
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

  // agenda toevoegen
  public function griffieAgendaAdd($pid, $title, $date){
    $title = mysqli_real_escape_string($this->db->connect(),$title);
    $result = mysqli_query($this->db->connect(), "INSERT INTO `gdadmin_dossier`.`process_agenda` (`id`,`pid`, `title`, `date`) VALUES (NULL, '$pid', '$title', '$date')")or die( mysqli_error($this->db->connect()));
    // check for successful store
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  public function griffieAgendaDelete($aid){
    $result = mysqli_query($this->db->connect(), "DELETE FROM process_agenda WHERE id = '$aid' ") or die(mysqli_error($this->db->connect()));
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  // besluiten updaten
  public function griffieAgendaEdit($aid, $title, $date){
    $title = mysqli_real_escape_string($this->db->connect(),$title);
    $result = mysqli_query($this->db->connect(), "UPDATE `gdadmin_dossier`.`process_agenda` SET `title` = '$title', `date` = '$date' WHERE `process_agenda`.`id` = '$aid'") or die( mysqli_error($this->db->connect()));
    // check for successful store
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  // agenda laten zien
  public function AgendaItem($aid){
    $result = mysqli_query($this->db->connect(), "SELECT * FROM process_agenda WHERE id = '$aid'") or die(mysqli_error($this->db->connect()));
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

  
}