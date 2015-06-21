<?php

define("SESSION_DELIM", "|");


function unserialize_session($session_data, $start_index=0, &$dict=null) { // taken from https://gist.github.com/phred/1201412
   isset($dict) or $dict = array();
   $name_end = strpos($session_data, SESSION_DELIM, $start_index);

   if ($name_end !== FALSE) {
       $name = substr($session_data, $start_index, $name_end - $start_index);
       $rest = substr($session_data, $name_end + 1);

       $value = unserialize($rest);      // PHP will unserialize up to "|" delimiter.
       $dict[$name] = $value;

       return unserialize_session($session_data, $name_end + 1 + strlen(serialize($value)), $dict);
   }

   return $dict;
}


function getSessions(){
  $sessions = array();

  $path = realpath(session_save_path());
  $files = array_diff(scandir($path), array('.', '..'));

  foreach ($files as $file)
  {
      if($file != "modules"){
        $sessions[] = unserialize_session(file_get_contents($path . '/' . $file));
      }
  }

  return $sessions;
}

function searchChunk($file, $chunk){
  $sessions = getSessions();

  $ip_directory = array();
  foreach ($sessions as $session) {
    if($session["seeder"][$file]){
      $ip_directory[] = $session["remoteAddr"];
      continue;
    }

    if($session["peer"][$file][$chunk]){
      $ip_directory[] = $session["remoteAddr"];
    }
  }

  return $ip_directory;
}
?>
