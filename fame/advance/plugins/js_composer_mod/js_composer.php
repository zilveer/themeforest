<?php

//templates dir
vc_set_shortcodes_templates_dir(A13_TPL_DIR.'/vc_templates/');

//add file with classes for our own shortcodes(extensions to Visual Composer)
require_once (dirname(__FILE__) .'/shortcodes_classes.php');


/*
 * Adds Shortcodes to Visual Composer
 */
function a13_sc_add_to_visual_composer(){
    require_once (dirname(__FILE__) .'/config.php');
}
add_action( 'init', 'a13_sc_add_to_visual_composer', 20 );



//builder CSS
function js_composer_admin_css() {
    wp_enqueue_style( 'js_composer_admin', A13_TPL_CSS . '/js_composer_admin.css' );
}

add_action( 'admin_enqueue_scripts', 'js_composer_admin_css', 20);