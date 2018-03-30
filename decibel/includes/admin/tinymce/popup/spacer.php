<?php
$title = __( 'Height', 'wolf' );
$params = array(

	array(
		'id' => 'height',
		'label' => __( 'Height', 'wolf' ),
		'value' => '100px',
	),
);
echo wolf_generate_tinymce_popup( 'wolf_spacer', $params, $title );