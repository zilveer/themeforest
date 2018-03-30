<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'init', 'wptuts_buttons' );

function wptuts_buttons() {
    add_filter("mce_external_plugins", "wptuts_add_buttons");
    add_filter('mce_buttons', 'wptuts_register_buttons');
}

function wptuts_add_buttons($plugin_array) {
    $plugin_array['wptuts'] = THEMEROOT . '/lib/functions/EditorButtons/js/listbutton_plugin.js';
    return $plugin_array;
}

function wptuts_register_buttons($buttons) {
    array_push( $buttons, 'list', 'dropcap' );
    return $buttons;
}

?>