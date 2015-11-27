<?php
function wB_split_csv_string ($str, $delimiterChar = ',', $escapeChar = '"') {
   $len = strlen($str);
   $tokens = array();
   $i = 0;
   $inEscapeSeq = false;
   $currToken = '';
   while ($i < $len) {
       $c = substr($str, $i, 1);
       if ($inEscapeSeq) {
           if ($c == $escapeChar) {
               // lookahead to see if next character is also an escape char
               if ($i == ($len - 1)) {
                   // c is last char, so must be end of escape sequence
                   $inEscapeSeq = false;
               } else if (substr($str, $i + 1, 1) == $escapeChar) {
                   // append literal escape char
                   $currToken .= $escapeChar;
                   $i++;
               } else {
                   // end of escape sequence
                   $inEscapeSeq = false;
               }
           } else {
               $currToken .= $c;
           }
       } else {
           if ($c == $delimiterChar) {
               // end of token, flush it
               array_push($tokens, $currToken);
               $currToken = '';
           } else if ($c == $escapeChar) {
               // begin escape sequence
               $inEscapeSeq = true;
           } else {
               $currToken .= $c;
           }
       }
       $i++;
   }
   // flush the last token 
   array_push($tokens, $currToken);
   return $tokens;
}
