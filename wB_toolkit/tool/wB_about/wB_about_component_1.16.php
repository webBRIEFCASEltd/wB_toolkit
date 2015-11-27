<?php
wB_script (array ("id" => "wB_about_component", "version" => "1.2"));
   wB_script_history (array ("version" => "1.11", "author" => "MIK", "change" => "Add wB_show_wB_about_component"));
   wB_script_history (array ("version" => "1.12", "author" => "MIK"));
      wB_script (array ("change" => "Add return_output"));
      wB_script (array ("change" => "Remove the border"));
      wB_script (array ("change" => "Make the field labels more user friendly"));
      wB_script (array ("change" => "Remove the hyperlink on the mobile number"));
      wB_script (array ("change" => "Additional cosmetic changes"));
   wB_script_history (array ("version" => "1.14", "author" => "MIK")); wB_script (array ("change" => "The map is not showing properly"));
   wB_script_history (array ("version" => "1.15", "author" => "MIK")); wB_script (array ("change" => "Remove the curved border"));

function wB_show_about_component ($args) {
# To do: 
# - This shouldn't reference $wB directly.
# - This information should be taken from the site's organisation record.
# - If the user is the administrator, show edit buttons next to each field.
   global $wB;
   $administrator = wB_get ("administrator");
   $output = "";
   $owner = wB_get ("Site owner");
   ?>
      <div style='border: 1px solid #cccccc; border-radius: 15px; padding: 10px; box-shadow: 10px 10px 5px #cccccc'>
      <h1>About / Contact</h1>
      <?php wB_show_configuration (array ("name" => "site/description")); ?><br>
      <table><tr><td style='padding: 5px'>
      <table>
         <tr><th style='width: 200px'>Owner</th><td><?php wB_show_configuration (array ("name" => "Site owner")); ?></td></tr>
         <?php if ($wB['site/contact/name']) { ?>
         <tr><th>Contact</th><td><?php print $wB['site/contact/name'] ?></a></td></tr>
         <?php } ?>
         <?php 
         # Hide the e-mail address by usinga Javascript snippet.
         if ($wB['site/contact/email']) { ?>
         <tr><th>    e-Mail</th><td><a href='mailto:<?php wB_get ("site/contact/email"); ?>'><?php wB_show_configuration (array ("name" => "site/contact/email")); ?></a>
         </td></tr>
         <?php } ?>
         <?php
         $found_skype = '';
         while (list ($name, $value) = each ($wB)) {
            if (preg_match ("/site\/contact\/telephone/i", $name)) {
               if ($value) {
                  $name = preg_replace ("/^site\/contact\/telephone/", "", $name);
                  $name = preg_replace ("/^\//", "", $name);
                  if ($name) { } else { $name = "Telephone"; }
                  ?>
                     <tr>
                        <th><?php print $name ?></th>
                        <td>
                           <?php 
                              print $value; 
                              if (preg_match ("/skype/i", $value)) {
                                 $found_skype = 'y';
                              }
                           ?>
                        </td>
                     </tr>
                  <?php
               }
            }
         }
         if ($wB['site/contact/mobile']) { ?>
            <tr><th>Mobile</th><td><?php print $wB['site/contact/mobile'] ?></td></tr>
         <?php }
         if ($found_skype) {
            ?>
               <tr><td colspan='2' style='text-align: justify; border-style: solid; border-width: 1px; border-color: black'>
                  Have you tried Skype? You can use it to make FREE calls. Click on the logo (below) for information.<br>
                  <div style='text-align: center'>
                  <span title="Click for information about Skype"><script type="text/javascript">
                     var uri = 'http://impgb.tradedoubler.com/imp?type(img)g(16303936)a(1236953)' + new String (Math.random()).substring (2, 11);
                     document.write('<a href="http://clkuk.tradedoubler.com/click?p=27320&a=1236953&g=16303936" target="_blank"><img src="'+uri+'" border=0></a>');
                  </script></span>
                  </div>
               </td></tr>
            <?php
         }
         ?>
         <?php if ($wB['site/owner/company/office_hours']) { ?>
         <tr><th>Office&nbsp;hours</th><td><?php print $wB['site/owner/company/office_hours'] ?></td></tr>
         <?php } ?>
         <?php if ($wB['site/contact/fax']) { ?>
         <tr><th>       Fax</th><td><?php print $wB['site/contact/fax'] ?></td></tr>
         <?php } ?>
         <?php if ($wB['site/contact/address']) { ?>
         <tr><th>Address</th><td><?php 
            $address = preg_replace ("/\n/si", "<br>", $wB['site/contact/address']);  
            $postcode = $wB['site/contact/postcode'];
            print $address;
            if ($postcode) {
               echo "$postcode<br>";
               ?><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4717.347192701133!2d-1.8916656!3d53.7596949!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487be85e3aa21503%3A0xda66ac2851ca648!2sHalifax!5e0!3m2!1sen!2s!4v1395615536929" width="200" height="250" frameborder="0" style="border:0"></iframe><?php
            }
         # 1.4 - Added Google map below.
         ?>
         </td></tr>
         <?php } ?>
         <?php if ($wB['site/owner/company/registration_number']) { ?>
         <tr><th>Company registration number</th><td><?php print $wB['site/owner/company/registration_number'] ?></td></tr>
         <?php } ?>
         <?php if ($wB['site/owner/company/data_protection/number']) { ?>
         <tr><th>Data Protection Number</th><td><?php print $wB['site/owner/company/data_protection/number'] ?></td></tr>
         <?php } ?>
         </td></tr>
      </table>
      </div>
      <?php if ($administrator) { 
         ?>
            <br>
            <img src='wB_toolkit/image/help_question.gif'> Note to administrator: 
               The information presented above is found in the 
               <a href='?wB_table=wB_configuration'>configuration table</a>.
            </a><br>
         <?php 
      } ?>
      </td></tr></table>
      <?php if ($wB['site/description']) { ?></table><?php } ?>
   <?php
}

function wB_show_about () {
   wB_show_about_component (array ());
}

function wB_show_wB_about_component ($args) {
   wB_show_about_component ($args);
}
