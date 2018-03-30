<?php

function met_su_MSGBOX_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_msgbox'] = array(
		'name' => __( 'Message Box', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'atts' => array(
			'msg' => array(
				'default' => '',
				'name' => __( 'Message', 'su' ),
			),
			'msg_type' => array(
				'type' => 'select',
				'values' => array('info'=>'Info','success'=>'Success','warning'=>'Warning','error'=>'Error'),
				'default' => 'info',
				'name' => __( 'Type', 'su' ),
			),
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_msgbox_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_MSGBOX_shortcode_data' );


function met_su_msgbox_shortcode( $atts, $content = null ) {
	extract($atts);

	$msg = do_shortcode(htmlspecialchars_decode($msg));

	$output = '<div class="row-fluid">
		<div class="span12">
			<div class="met_message met_message_'.$msg_type.'">'.$msg.'</div>
		</div>
	</div>';

	return $output;
}