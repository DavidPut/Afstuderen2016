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
      $this->db->close();
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

  public function griffieAdd($BVPtitle, $BVPsummary, $BVPperiod, $BVPlocation, $BVPtags, $BVPtypes, $BVPcontact){
    $result = mysqli_query($this->db->connect(), "INSERT INTO `gdadmin_dossier`.`process` (`id`, `title`, `summary`, `location`, `type`, `period`, `adddate`) VALUES (NULL, '$BVPtitle', '$BVPsummary', '$BVPlocation', '$BVPtypes', '$BVPperiod', '')")or die( mysqli_error($this->db->connect()));
    // check for successful store
    if ($result) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }

  public function griffieEdit($BVPtitle, $BVPsummary, $BVPperiod, $BVPlocation, $BVPtags, $BVPtypes, $BVPcontact){
    //$result = mysqli_query($this->db->connect(), "UPDATE `gdadmin_dossier`.`process` (`id`, `title`, `summary`, `location`, `type`, `period`, `adddate`) VALUES (NULL, '$BVPtitle', '$BVPsummary', '$BVPlocation', '$BVPtypes', '$BVPperiod', '')")or die( mysqli_error($this->db->connect()));
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
    if ($result && $result2 && $result3) {
      $this->db->close();
      return true;
    } else {
      $this->db->close();
      return false;
    }
  }
  
  public function raadslidList(){
    
  }
  
}