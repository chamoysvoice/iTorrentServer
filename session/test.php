<?php
require_once("../global.php");
require_once("../library/session.php");
@session_start();
$_SESSION["remoteAddr"] = $_SERVER["REMOTE_ADDR"];
$sessions = array();

$path = realpath(session_save_path());
$files = array_diff(scandir($path), array('.', '..'));

foreach ($files as $file)
{
    if($file != "modules"){
      $sessions[] = unserialize_session(file_get_contents($path . '/' . $file));
    }
}

echo '<pre>';
print_r($sessions);
echo '</pre>';
?>
