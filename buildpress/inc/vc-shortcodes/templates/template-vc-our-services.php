<?php

/*
 * BuildPress Our Services Template for Visual Composer
 */

add_action( 'vc_load_default_templates_action','buildpress_our_services_template_for_vc' );

function buildpress_our_services_template_for_vc() {
	$data               = array();
	$data['name']       = _x( 'BuildPress: Our Services', 'backend' , 'buildpress_wp' );
	$data['weight']     = 0;
	$data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/assets/images/pt.svg' );
	$data['custom_class'] = 'buildpress_our_services_template_for_vc_custom_template';
	$data['content']    = <<<CONTENT
		[vc_row][vc_column width="1/3"][pt_vc_featured_page page="69"][/vc_column][vc_column width="1/3"][pt_vc_featured_page page="73"][/vc_column][vc_column width="1/3"][pt_vc_featured_page page="52"][/vc_column][/vc_row][vc_row css=".vc_custom_1459338668091{margin-bottom: 0px !important;}"][vc_column width="1/3"][pt_vc_featured_page page="84"][/vc_column][vc_column width="1/3"][pt_vc_featured_page page="87"][/vc_column][vc_column width="1/3"][pt_vc_featured_page page="71"][/vc_column][/vc_row]
CONTENT;

	vc_add_default_templates( $data );
}