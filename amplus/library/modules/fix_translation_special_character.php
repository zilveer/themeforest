<?php

// Fix for translations which are not displaying special characters properly.
class BFIModuleFixTranslationSpecialCharacters {
    public static function run() {
        add_filter('gettext', array(__CLASS__, 'getText'), 10, 3);
    }
    
    public static function getText($translateText, $text, $domain) {
        if ($domain == BFI_I18NDOMAIN)
            return htmlspecialchars_decode($translateText, ENT_QUOTES);
        return $translateText;
    }
}

BFIModuleFixTranslationSpecialCharacters::run();