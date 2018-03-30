<?php

class BFINavigationPrimaryModel extends BFINavigationModel {
    
    const SLUG = 'primary_menu';
    
    function __construct() {
        $this->slug = self::SLUG;
        $this->name = 'This is the theme\'s primary menu on the top of the site.';
    }
}
