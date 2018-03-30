<?php
$title = __( 'Mailchimp signup', 'wolf' );
$params = array(

	array(
		'id' => 'list',
		'label' => __( 'List', 'wolf' ),
		'desc' => __( 'Your mailchimp list ID.', 'wolf' ),
		'placeholder' => 'mb0sd78fg8',
	),

	array(
		'id' => 'size',
		'label' => __( 'Size', 'wolf' ),
		'type' => 'select',
		'options' => array(
			'normal' => __( 'Normal', 'wolf' ),
			'large' => __( 'Large', 'wolf' ),
		),
	),

	array(
		'id' => 'submit',
		'label' => __( 'Submit', 'wolf' ),
		'placeholder' => 'Submit',
	),
);
echo wolf_generate_tinymce_popup( 'wolf_mailchimp', $params, $title );