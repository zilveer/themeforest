<?php
$title = __( 'Alert Message', 'wolf' );
$params = array(

	array(
		'id' => 'message',
		'label' => __( 'Message', 'wolf' ),
		'placeholder' => __( 'Your notification message', 'wolf' )
	),

	array(
		'id' => 'type',
		'label' => __( 'Type', 'wolf' ),
		'type' => 'select',
		'options' => array(
			'success' => __( 'success', 'wolf' ),
			'info' => __( 'info', 'wolf' ),
			'tip' => __( 'tip', 'wolf' ),
			'error' => __( 'error', 'wolf' ),
		),
	)
);
echo wolf_generate_tinymce_popup( 'wolf_alert_message', $params, $title );