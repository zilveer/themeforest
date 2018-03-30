<?php

function met_su_PAGE_HEADER_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_page_header'] = array(
		'name' => __( 'Page Header', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'atts' => array(
			'title' => array(
				'default' => 'Im Page Header',
				'name' => __( 'Title (required)', 'su' ),
			),
			'second_title' => array(
				'default' => '',
				'name' => __( 'Secondary Title (optional)', 'su' ),
			),
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_page_header_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_PAGE_HEADER_shortcode_data' );


function met_su_page_header_shortcode( $atts, $content = null ) {
	extract($atts);

	$output = '
		<div class="row-fluid">
			<div class="span12">
				<div class="met_page_header met_bgcolor5 clearfix">
					<h1 class="met_bgcolor met_color2">'.htmlspecialchars_decode($title).'</h1>
					<h2 class="met_color2">'.htmlspecialchars_decode($second_title).'&nbsp;</h2>
				</div>
			</div>
		</div>';

	return $output;
}