<?php

/*********** Shortcode: Teaser ************************************************************/

$tcvpb_elements['teaser_tc'] = array(
	'name' => __( 'Teaser', 'ABdev_aeron' ),
	'description' => __( 'Teaser', 'ABdev_aeron' ),
	'type' => 'block',
	'icon' => 'pi-callout-box',
	'category' => __('Content', 'ABdev_aeron' ),
	'attributes' => array(
		'title' => array(
			'description' => __( 'Title', 'ABdev_aeron' ),
		),
		'teaser_icon' => array(
			'description' => __('Teaser Icon', 'ABdev_aeron'),
			'info' => __('Optional icon', 'ABdev_aeron'),
			'type' => 'icon',
		),
		'url' => array(
			'type' => 'image',
			'description' => __('Select Image', 'ABdev_aeron'),
		),
		'class' => array(
			'description' => __('Class', 'ABdev_aeron'),
			'info' => __('Additional custom classes for custom styling', 'ABdev_aeron'),
		),
	),
	'content' => array(
		'description' => __( 'Content', 'ABdev_aeron' ),
	),
);

function tcvpb_teaser_tc_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( tcvpb_extract_attributes('teaser_tc'), $atts ) );

		return '<div class="tcvpb-teaser">
			<div class="container">
				<span class="tcvpb_teaser_title">' .esc_html($title). '</span>
				'.do_shortcode($content).'
				<i class="' .esc_attr($teaser_icon). '"></i>
				<img src="'.esc_url($url).'">
			</div>
		</div>';
}
