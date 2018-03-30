<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['page_builder'] = array(
	'title'       => __( 'Frontend Creation', 'woffice' ),
	'description' => __( 'Add a form to send new posts, projects or wiki from the frontend.', 'woffice' ),
	'tab'         => __( 'Content Elements', 'woffice' ),
	'icon' 		  => 'fa fa-bolt',
);