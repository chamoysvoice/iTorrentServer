<?php
@session_start();
$_SESSION["remoteAddr"] = $_SERVER["REMOTE_ADDR"];
$_SESSION["lastPing"] = time();

echo session_id();

?>
