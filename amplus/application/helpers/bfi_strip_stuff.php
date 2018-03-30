<?php

function bfi_strip_stuff($str) {
    // do twice
    for ($i = 0; $i < 2; $i++) { 
        // remember clearfix divs
        $str = preg_replace('#<div\s*class=(\'|")clearfix(\'|")\s*>\s*</div>#', "%S%", $str);
        // remove blank column divs
        $str = preg_replace('/\<div class\=[\"\']col[0-9]{0,2}[^\>]\>[ \t\n\r\f\v]*\<div class\=[\"\']colcontents[\"\']\>[ \t\n\r\f\v]*\<\/div\>[ \t\n\r\f\v]*\<\/div\>/i', "", $str);
        $str = preg_replace('/\<div class\=[\"\']col[0-9]{0,2}[^\>]\>[ \t\n\r\f\v]*\<\/div\>/i', "", $str);
        $str = preg_replace('/\<div class\=[\"\']colcontents[\"\']\>[ \t\n\r\f\v]*\<\/div\>/i', "", $str);
        // remove blank divs
        $str = preg_replace('#<div>[ \t\n\r\f\v]*%S%</div>#', '', $str);
        $str = preg_replace('#<div></div>#', '', $str);
        $str = preg_replace('#<div\s*class=(\'|")amplus_panel[^>]+></div>#', '', $str);
        // remove floating <br>
        $str = preg_replace('/\<p\>[ \t\n\r\f\v]*\<[ \t\n\r\f\v]*br[ \t\n\r\f\v]*[\/]?>/i', "<p>", $str);
        $str = preg_replace('/\<[ \t\n\r\f\v]*br[ \t\n\r\f\v]*[\/]?>[ \t\n\r\f\v]*\<\/p>/i', "</p>", $str);
        // remove stray <p><p>
        $str = preg_replace('/\<p\>[ \t\n\r\f\v]*\<p\>/i', "<p>", $str);
        $str = preg_replace('/\<p\>\<p\>/i', "<p>", $str);
        // remove stray </p></p>
        $str = preg_replace('/\<\/p\>[ \t\n\r\f\v]*\<\/p\>/i', "</p>", $str);
        // remove blank <p></p>
        $str = preg_replace('/\<p\>[ \t\n\r\f\v]*\<\/p\>/i', "", $str);
        // remove misplaced <p> or </p>
        $str = preg_replace('/^[ \t\n\r\f\v]*\<\/p\>/i', "", $str);
        $str = preg_replace('/\<p\>[ \t\n\r\f\v]*$/i', "", $str);
        $str = preg_replace('/\<div[^>]+\>[ \t\n\r\f\v]*\<\/p\>[ \t\n\r\f\v]*\<\/div\>/i', "", $str);
        $str = preg_replace('/\<div[^>]+\>[ \t\n\r\f\v]*\<p\>[ \t\n\r\f\v]*\<\/div\>/i', "", $str);
        // put back clearfix divs
        while (preg_match('#%S%%S%#', $str)) {
            $str = preg_replace('#%S%%S%#', '%S%', $str);
        }
        $str = preg_replace('#%S%#', '<div class="clearfix"></div>', $str);
        $str = trim($str);
    }
    return $str;
}