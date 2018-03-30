<?php

/*
 * BuildPress Projects Template for Visual Composer
 */

add_action( 'vc_load_default_templates_action','buildpress_projects_template_for_vc' );

function buildpress_projects_template_for_vc() {
	$data               = array();
	$data['name']       = _x( 'BuildPress: Projects', 'backend' , 'buildpress_wp' );
	$data['weight']     = 0;
	$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/assets/images/pt.svg' );
	$data['custom_class'] = 'buildpress_projects_template_for_vc_custom_template';
	$data['content']    = <<<CONTENT
		[vc_row css=".vc_custom_1459338510286{margin-bottom: 0px !important;}"][vc_column][ess_grid alias="Projects Page"][/vc_column][/vc_row]
CONTENT;

	vc_add_default_templates( $data );
}