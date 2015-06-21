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

?>
