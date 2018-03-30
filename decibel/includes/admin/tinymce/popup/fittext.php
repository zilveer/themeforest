<?php
$font_list = array( '' => __( 'Default heading font', 'wolf' ) );
global $wolf_fonts;

foreach ( $wolf_fonts as $key => $value ) {
	$font_list[$key] = $key;
}

$title = __( 'Headline', 'wolf' );
$params = array(

	array(
		'id' => 'text',
		'label' => __( 'Text', 'wolf' ),
		'placeholder' => __( 'My Cool Headline', 'wolf' ),
	),

	array(
		'id' => 'max_font_size',
		'label' => __( 'Font Size', 'wolf' ),
		'placeholder' => '48px',
	),

	array(
		'id' => 'letter_spacing',
		'label' => __( 'Letter Spacing', 'wolf' ),
		'placeholder' => '3px',
	),

	array(
		'id' => 'font_family',
		'label' => __( 'Font Family', 'wolf' ),
		'type' => 'select',
		'options' => $font_list,
	),

	array(
		'id' => 'text_transform',
		'label' => __( 'Font Transform', 'wolf' ),
		'type' => 'select',
		'options' => array(
			'uppercase' => __( 'uppercase', 'wolf' ),
			'none' => __( 'none', 'wolf' ),
		),
	),
);
echo wolf_generate_tinymce_popup( 'wolf_fittext', $params, $title );
