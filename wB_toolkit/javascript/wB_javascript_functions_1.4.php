<?php
// History:
// 1.2 - MIK - An error on the page is causing wB_submit to break.
// 1.3 - CJH - Debug tinymce suspect this is breaking page buttons. Is thiis file being used. These fuctions appear to be coming from wB_toolkit.php?
// 1.4 - MIK - wB_init is not being outputted for some reason.


// Note - For javascript functions 
// See Also wB_head and wB_toolkit

function wB_submit_javascript () {
   if (wB_get_arg ("presentation") == "cli") { return; }
   ?>
      function wB_submit () { 
         // wB_page_form.submit()
         alert ('Submitting');
         wB_page_form.submit()
      }

      function wB_clear_all_but_search () {
         wB_page_form.wB_application.value   = "";
         wB_page_form.wB_action.value        = "";
         wB_page_form.wB_table.value         = "";
         wB_page_form.wB_table_initial.value = "";
         wB_page_form.wB_action_id.value     = "";
         wB_page_form.wB_page.value          = "";
         wB_page_form.wB_next_page.value     = "";
      }

      function wB_clear_all () {
         wB_clear_all_but_search ();
         wB_page_form.wB_search.value        = "";
      }

      function wB_apply_action (strAction) {
         wB_page_form.wB_action.value = strAction
         wB_submit ();
      }
   <?php
}

function wB_table_selected_javascript () {
   ?>
      function wB_table_selected () {
         if (wB_page_form.wB_table.value == "") {
            wB_page_form.wB_list_button.disabled = 'y';
            wB_page_form.wB_new_button.disabled = 'y';
         }
         else {
            wB_page_form.wB_list_button.disabled = '';
            wB_page_form.wB_new_button.disabled = '';
         }
      }
   <?php
}

function wB_init_javascript () {
   ?>
   function wB_init () {
      // wB_page_form.wB_user.focus();
   }
   <?php
}

function wB_head_scripts ($args) {
   if (wB_get_arg ("presentation") == "cli") { return; }
   ?>
      // javascript/wB_javascript_functions

      function hideshow (which) {
         if (!document.getElementById)
            return
         if (which.style.display == "none")
            which.style.display = ""
         else
            which.style.display = "none"
      }
   <?php
   wB_submit_javascript ();
   wB_table_selected_javascript ();
   wB_init_javascript ();
}
