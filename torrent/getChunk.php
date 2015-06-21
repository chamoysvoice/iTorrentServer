<?php
require_once("../library/session.php");
require_once("../global.php");


if($_GET) {

    if ($_GET["echo"] == 1) {
        header('Content-type: application/json');
        echo json_encode(searchChunk($_GET["id"], $_GET["chunk"]));
    } else {
        $ids = array();
        try{
            $ids[] = searchChunk($_GET["id"], $_GET["chunk"]);
        } catch (Exception $e){

        }


        foreach ($GLOBALS['servers'] as $id => $server) {
            if ($server == "http://" . $_SERVER['SERVER_ADDR'] . "/") continue; // ask everyone but
            $ids[] = json_decode(file_get_contents($server . "torrent/getChunk.php?id=" . $_GET["id"] . "&chunk=" . $_GET["chunk"] . "&echo=1"));





        }
        $ip = array();
        foreach ($ids as $ip_dir) {
            foreach ($ip_dir as $i) {
                $ip[] = $i;
            }
        }
        header('Content-type: application/json');
        echo json_encode(array_unique($ip));
    }
}

?>
