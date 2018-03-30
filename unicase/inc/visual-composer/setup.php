<?php

if( function_exists( 'vc_set_as_theme' ) ){
	vc_set_as_theme( TRUE );
}

vc_disable_frontend();

$vc_templates_dir = get_template_directory() . '/templates/vc_templates/';
vc_set_shortcodes_templates_dir( $vc_templates_dir );

if( is_admin() ) {

	function remove_vc_teaser() {
		remove_meta_box('vc_teaser', '' , 'side');
	}
}