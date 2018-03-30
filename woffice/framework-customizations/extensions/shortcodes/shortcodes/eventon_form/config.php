<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

if(shortcode_exists('add_evo_submission_form')) {
	$cfg['page_builder'] = array(
		'title'       => __( 'EventOn Calendar Form', 'woffice' ),
		'description' => __( 'Add a form so user can create event', 'woffice' ),
		'tab'         => __( 'Content Elements', 'woffice' ),
		'icon'        => 'fa fa-plus-circle',
	);
}