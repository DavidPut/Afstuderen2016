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
  
  public function griffielist(){
    
  }

  public function griffieAdd(){

    $result = mysqli_query($this->db->connect(), "INSERT INTO `gdadmin_dossier`.`process` (`id`, `title`, `summary`, `location`, `type`, `period`, `adddate`) VALUES (NULL, 'besluitvorming test', 'Een mooie test voor een besluitvorming. Gemaakt door de griffier van de gemeenten Dromenland. Er staat een korte samenvatting hier. ', '2988 XC', 'f,s,b', '1', '')")or die( mysqli_error($this->db->connect()));
    //$result = mysqli_query($this->db->connect(), "INSERT INTO zoof_pictures(tag, uid, likes, url, created_at) VALUES('$tag', '$id', 0, '$url', NOW())") or die( mysqli_error($this->db->connect()));
    // check for successful store
    if ($result) {
      return true;
    } else {
      return false;
    }

  }
  
  public function raadslidlist(){
    
  }
  
}