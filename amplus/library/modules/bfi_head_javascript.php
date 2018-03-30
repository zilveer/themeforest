<?php
/**
 * Adds the additional javascript option in the head tag
 */
 
class BFIHeadJavascript {
    public static function run() {
        add_action('wp_head', array(__CLASS__, 'echoJavascript'), 999);
    }
    
    public static function echoJavascript() {
        $scripts = trim(stripslashes(bfi_get_option(BFI_OPTIONJAVASCRIPT)));
        
        // strip script tags
        if ($scripts) {
            $scripts = preg_replace('/<[ \t\n\r\f\v]*script[^>]+>/', '', $scripts);
            $scripts = preg_replace('/<\/[ \t\n\r\f\v]*script[ \t\n\r\f\v]*>/', '', $scripts);
        }
        
        echo "<script>$scripts</script>";
    }
}

BFIHeadJavascript::run();