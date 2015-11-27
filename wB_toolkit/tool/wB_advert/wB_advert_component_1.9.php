<?php
wB_script (array ("id" => "wB_show_advert_component", "author" => "MIK"));
   wB_script (array ("version" => "1.5", "author" => "MIK", "change" => "Added wB_show_advert_component"));
   wB_script (array ("version" => "1.6", "author" => "MIK", "change" => "Add br after the adverts"));
   wB_script (array ("version" => "1.7", "author" => "MIK", "change" => "Call the advert server on the webBRIEFCASE website"));

function wB_show_wB_advert_component ($args) {   
   ?>
      <center>
         <div style='border: 1px solid #cccccc; border-radius: 15px; padding: 10px; box-shadow: 10px 10px 5px #cccccc'>
         <div style='background-color: #eeeeee'>
            <a href='?wB_table=wB_advert'>
               <b>Advertisements</b><br>
               Click here to advertise
            </a>
         </div>
         </div>
         <?php
            $query = mysql_query ("SELECT * FROM wB_advert WHERE deleted='' AND public='y' AND approved='y'");
            if ($query) {
               while ($row = mysql_fetch_assoc ($query)) {
                  if ($row["web_address"]) { echo "<a href=\"$row[web_address]\" target=\"_blank\">"; }
                     if ($row["image"]) {
                        $image_record = wB_read_record (array ("table" => "wB_image", "id_number" => $row["image"]));
                        echo "<img src=\"$image_record[url]\"><br>";
                     }
                     echo "$row[name]<br>";
                  if ($row["web_address"]) { echo "</a>"; }
                  echo "<br>";
               }
            }
         ?>
      </center>
   <?php
}
