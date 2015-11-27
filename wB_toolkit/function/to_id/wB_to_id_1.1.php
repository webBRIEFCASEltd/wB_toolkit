<?php
function wB_to_id ($text) {
   $text = strtolower ($text);
   $text = preg_replace ("/'/",         "",  $text);
   $text = preg_replace ("/\./",        "",  $text);
   $text = preg_replace ("/[^a-z0-9]/", "_", $text);
   $text = preg_replace ("/_+$/",       "_", $text);
   $text = preg_replace ("/^_+/",       "",  $text);
   $text = preg_replace ("/_$/",        "",  $text);
   return $text;
}

