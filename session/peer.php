<?php

require_once("../global.php");

if($_POST){
  session_id($_POST["sid"]);
  session_start();
  $_SESSION["peer"][$_POST["id"]][$_POST["chunk"]] = 1;
}


 ?>
