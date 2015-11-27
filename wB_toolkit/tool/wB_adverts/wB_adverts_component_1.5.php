<?php
wB_script (array ("id" => "wB_show_adverts_component", "author" => "MIK"));
   wB_script (array ("version" => "1.1", "author" => "MIK", "change" => "Initial creation"));
   wB_script (array ("version" => "1.2", "author" => "MIK", "change" => "Disabled the Advertisements and Click here to advertise hyperlinks"));
   wB_script (array ("version" => "1.3", "author" => "MIK", "change" => "Only show the image if it's approved and public."));
                                          wB_script (array ("change" => "Only show the name if there is no image"));

function wB_show_wB_adverts_component ($args) {   
   ?>
      <center>
         <div style='border: 1px solid #cccccc; border-radius: 15px; padding: 10px; box-shadow: 10px 10px 5px #eeeeee'>
         <font size='+2'><b>Advertisements</b></font><br>
         <br>
         <?php
            $query = mysql_query ("SELECT * FROM wB_advert WHERE deleted='' AND public='y' AND approved='y'");
            if ($query) {
               while ($row = mysql_fetch_assoc ($query)) {
                  if ($row["web_address"]) { echo "<a href=\"$row[web_address]\" target=\"_blank\">"; }
                     if ($row["image"]) {
                        $image_record = wB_read_record (array ("table" => "wB_image", "id_number" => $row["image"]));
                        if ($image_record["approved"] && $image_record["public"]) {
                           echo "<img src=\"$image_record[url]\"><br>";
                        }
                     }
                     // echo "image=$row[image]<br>";
                     if ($row["label"]) { echo $row["label"]; }
                     elseif ($row["name"]) { echo $row["name"]; }
                  if ($row["web_address"]) { echo "</a>"; }
                  echo "<br><br>";
               }
            }
         ?>
         </div>
      </center>
   <?php
}
