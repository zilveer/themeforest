<?php
/**
 * Adds the favicon tag in the head tag
 */
 
class BFIHeadFavicon {
    public static function run() {
        add_action('wp_head', array(__CLASS__, 'echoFavicon'));
    }
    
    public static function echoFavicon() {
        if (bfi_get_option(BFI_OPTIONFAVICON)) {
            echo "<link rel='shortcut icon' type='image/x-icon' href='"
                 . bfi_get_option(BFI_OPTIONFAVICON)
                 . "'/>";
        }
    }
}

BFIHeadFavicon::run();