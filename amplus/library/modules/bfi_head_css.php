<?php
/**
 * Adds the additional javascript option in the head tag, just before the 
 * head tag ends
 */
 
class BFIHeadCSS {
    public static function run() {
        add_action('wp_head', array(__CLASS__, 'echoStyle'), 999);
    }
    
    public static function echoStyle() {
        $style = trim(stripslashes(bfi_get_option(BFI_OPTIONCSS)));
        
        // strip style tag
        if ($style) {
            $style = preg_replace('/<[ \t\n\r\f\v]*style[ \t\n\r\f\v]*>/', '', $style);
            $style = preg_replace('/<\/[ \t\n\r\f\v]*style[ \t\n\r\f\v]*>/', '', $style);
        }
        
        echo "<style>{$style}</style>";
    }
}

BFIHeadCSS::run();

