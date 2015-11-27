<?php
require_once "wB_args.php";

/*
1.3 - Record the id of the current script.
*/

function wB_script ($args) {
# Identify that a script has been included.
   $id = $args['id'];
   # if (wB_get_arg ("wB_debug_script")) { print "$id<br>"; } # 1.4 - Added, but then removed because it doesn't look right
   $version = $args['version'];   
   if ($id) {
      wB_append ("scripts", $id);
      wB_set ("script", $id);
      wB_set ("script/$id/version", $version);
   }
}

function wB_script_history ($args) {
}

wB_script (array ("id" => "wB_script", "version" => "1.2", "description" => "wB_script and wB_script_history functions."));
