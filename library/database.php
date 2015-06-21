<?php

include_once("../global.php");

class Database{
  var $con;
  function Database(){
    $this->con =
    mysql_connect(HOST, USER, PASSWORD) or die(mysql_error());

    mysql_select_db(DB_NAME, $this->con) or die(mysql_error());

  }

  function execute($query){
    $result = mysql_query($query, $this->con);
    return $result;
  }

  function close(){
    mysql_close($this->con);
  }
}




?>
