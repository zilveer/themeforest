<?php

/***************************************************
:: Register less dynamic file
 ***************************************************/

add_filter( 'sq_less_files', 'sq_kb_add_less_file' );
function sq_kb_add_less_file( $less_files ) {
    $less_files[THEME_DIR . "/lib/plugin/easy-kb/less/easy-kb.less"] = '';
    return $less_files;
}

/* Regenerate theme css on plugin activate/deactivate */
function kleo_detect_kb_plugin_change( $plugin, $network_activation ) {
    if ( $plugin == 'easy-kb/setup.php' ) {
        kleo_unlink_dynamic_css();
    }
}
add_action( 'activated_plugin', 'kleo_detect_kb_plugin_change', 10, 2 );
add_action( 'deactivated_plugin', 'kleo_detect_kb_plugin_change', 10, 2 );

