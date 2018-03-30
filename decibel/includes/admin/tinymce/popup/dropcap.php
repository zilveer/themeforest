<?php
$font_list = array();
global $wolf_fonts;

foreach ( $wolf_fonts as $key => $value ) {
	$font_list[$key] = $key;
}

$title = __( 'Dropcap', 'wolf' );
$params = array(

	array(
		'id' => 'text',
		'label' => __( 'Letter', 'wolf' ),
	),

	array(
		'id' => 'font',
		'label' => __( 'Font Family', 'wolf' ),
		'type' => 'select',
		'options' => $font_list,
	),
);
echo wolf_generate_tinymce_popup( 'wolf_dropcap', $params, $title );