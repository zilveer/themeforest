<?php

// increase the number of custom fields, we may surely surpass the 30 limit
// because of multi-translate
class BFIModuleIncreateCustomFields {
    public static function run() {
        add_filter('postmeta_form_limit', array(__CLASS__, 'increaseLimit'));
    }
    
    public static function increaseLimit($limit) {
        $limit = 100;
        return $limit;
    }
}

BFIModuleIncreateCustomFields::run();