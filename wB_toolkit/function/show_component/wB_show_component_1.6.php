<?php
/*
1.1 - Taken out of wB_toolkit_1.28.php.
1.2 - If a number is supplied - read the component record.
*/

wB_script (array ("id" => "wB_show_component", "author" => "MIK"));
   wB_script (array ("version" => "1.3", "author" => "MIK", "change" => "Add _component to the eval call"));
   wB_script (array ("version" => "1.4", "author" => "MIK", "change" => "Show error messages"));
   wB_script (array ("version" => "1.5", "author" => "MIK", "change" => "Add wB_ pefix and wB_show_tool"));
   wB_script (array ("version" => "1.6", "author" => "idris.khan@webbriefcase.com", "change" => "Not calculating filename properly"));
                                                                  wB_script (array ("change" => "Allow tool function names to end in _tool (the default)"));

function wB_show_component ($component, $args) {
# 2.17 - Made more generic.
   // $debug = "y";
   // if ($component == "wB_project_dashboard") { $debug = 'y'; }
   if ($component) { 
      if ($debug) { 
         echo "DEBUG: wB_show_component (): $component<br>";
      }
   } else { 
      if ($debug) { 
         echo "ERROR: wB_show_component (): No component specified.<br>";
      }
      return; 
   }
   if (function_exists ("wB_show_wB_${component}_tool")) { 
      $found = 'y';
   } else {
      // echo "wB_show_component (): Showing $component<br>";
      if (preg_match ("/^\d+$/", $component)) {
         # print "Getting ID<Br>";
         $component_record = wB_read_record (array ("table" => "wB_component", "id_number" => $component));
         if ($component_record["id_number"]) {
            $component_id = $component_record["id"];
            if ($component_id) { 
               $component = $component_id;
            } else {
               $component = wB_to_id ($component_record["name"]);
            }
         }
         $component .= "_component";
      }
      $component = preg_replace ("/_component$/", "", $component);
      # print "Showing $component<br>";
      $found = '';
      $fs = wB_folder_separator ();
      $files = array (
         "wB_toolkit_local${fs}tool${fs}$component${fs}${component}_tool.php",
         "wB_toolkit_local${fs}tool${fs}$component${fs}wB_${component}_tool.php",
         "wB_toolkit_local${fs}tool${fs}$component${fs}${component}_component.php",
         "wB_toolkit_local${fs}tool${fs}$component${fs}wB_${component}_component.php",
         "wB_toolkit_local${fs}component${fs}$component${fs}${component}_component.php",
         "wB_toolkit${fs}tool${fs}$component${fs}${component}_tool.php",
         "wB_toolkit${fs}tool${fs}$component${fs}wB_${component}_tool.php",
         "wB_toolkit${fs}tool${fs}wB_$component${fs}wB_${component}_tool.php",
         "wB_toolkit${fs}tool${fs}wB_$component${fs}wB_${component}_component.php",
         "wB_toolkit${fs}tool${fs}$component${fs}${component}_component.php",
         "wB_toolkit${fs}tool${fs}$component${fs}wB_${component}_component.php",
         "wB_toolkit${fs}tool${fs}wB_$component${fs}wB_${component}.php",
         "wB_toolkit${fs}component${fs}$component${fs}${component}_component.php",
         ""
      );
      foreach ($files as $file) {
         if ($debug) {
            echo "DEBUG: wB_show_component (): Checking for $file<br>";
         }
         if (!($file == "") && file_exists ($file)) {
            require_once $file;
            // echo "wB_show_component (): FOUND $file<br>";
            $found = 'y';
            break;
         }
      }
   }
   if ($found) { 
      $found = '';
      $component_less_wB = preg_replace ("/^wB_/", "", $component);
      foreach (array (
         "wB_show_${component}_tool", 
         "wB_show_wB_${component}_tool", 
         "wB_show_${component}_component", 
         "wB_show_wB_${component}_component", 
         "wB_show_${component}", 
         "wB_show_${component_less_wB}", 
         "wB_show_${component_less_wB}_tool",
         "wB_show_${component_less_wB}_component",
         "wB_${component_less_wB}"
      ) as $function) {
         // echo "wB_show_component (): Trying $function<br>";
         if ($debug) { echo "DEBUG: wB_show_component (): Checking for $function<br>"; }
         if (function_exists ($function)) {
            if ($debug) { echo "DEBUG: wB_show_component (): Using $function<br>"; }
            // echo "Using $function<br>";
            $found = 'y';
            eval ("$function (\$args);"); # 1.3 - Changed
            break;
         }
      }
      if ($found) { }
      else {
         echo "ERROR: wB_show_component (): wB_show_wB_${component}_tool wasn't found<br>";
         return;
      }
   } 
   else {
      echo "wB_show_component (): Couldn't find $component.php<br>";
      return;
   }
}

function wB_show_tool ($tool, $args) { wB_show_component ($tool, $args); }
