<?php 
function wB_show_wB_activity_component ($args) {
   ?><h1>Activity</h1><?php
      if ($id_number) {
         wB_show_form (array ("table" => "wB_activity", "where" => "id_number='$activity'"));
      }
}
