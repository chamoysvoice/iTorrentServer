<?php
require_once("../global.php");

if($_POST){
  session_id($_POST["sid"]);
  session_start();
  $_SESSION["seeder"][$_POST["id"]] = 1;
}

?>
