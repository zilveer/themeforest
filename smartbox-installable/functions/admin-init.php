<?php
/*-----------------------------------------------------------------------------------*/
/* Load the required Framework Files */
/*-----------------------------------------------------------------------------------*/

$functions_path = get_template_directory() . '/functions/';

require_once ( $functions_path . 'admin-shortcodes.php' );				// Shortcodes
require_once ( $functions_path . 'admin-shortcode-generator.php' ); 

function des_version_init() {

    $des_framework_version = '4.7.2';

    if ( get_option( 'des_framework_version' ) != $des_framework_version ) {
    	update_option( 'des_framework_version', $des_framework_version );
    }
    
}

add_action( 'init', 'des_version_init', 10 );

?>