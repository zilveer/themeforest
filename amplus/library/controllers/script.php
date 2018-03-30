<?php

class BFIScriptController {
    
    function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'loadFrontEndScripts'));
    }

    public function loadFrontEndScripts() {        
        // basic theme style
        bfi_wp_enqueue_style('style', BFI_TEMPLATEURL.'style.css');
        
        // include the comment form mover script for comment areas
        if (is_singular() && comments_open()) {
            bfi_wp_enqueue_script('comment-reply');
        }
    }
}
