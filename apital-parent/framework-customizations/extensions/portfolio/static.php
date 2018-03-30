<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( !is_admin() ) {
    $ext_instance = fw()->extensions->get( 'portfolio' );
    $settings     = $ext_instance->get_settings();
    $ext_version  =  $ext_instance->manifest->get_version();

}
