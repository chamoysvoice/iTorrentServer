<?php

require_once("../library/torrentController.php");

if($_POST){

  $id = getLastId(0) + 1;
  $name = $_POST["name"];
  $size = $_POST["size"];
  $data = array(
    "id"   => $id,
    "name" => $name,
    "size" => $size
  );
  foreach ($GLOBALS['servers'] as $id => $server) {
    if($server == "http://".$_SERVER['SERVER_ADDR']."/") continue; // ask everyone but me

    file_get_contents($server."torrent/addTorrent.php?id=".$id."&name=".$name."&size=".$size);
  }
  createTorrent($data);
  echo $data["id"];
}

if($_GET){
  $data = array(
    "id"   => $_GET["id"],
    "name" => $_GET["name"],
    "size" => $_GET["size"]
  );
  createTorrent($data);
}

?>
