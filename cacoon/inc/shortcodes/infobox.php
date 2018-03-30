<?php

function met_su_INFOBOX_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_infobox'] = array(
		'name' => __( 'Infobox', 'su' ),
		'type' => 'wrap',
		'group' => 'met',
		'atts' => array(
			'title' => array(
				'default' => '',
				'name' => __( 'Title', 'su' ),
			),
			'title_color' => array(
				'type' => 'color',
				'default' => '#65676F',
				'name' => __( 'Title Color', 'su' ),
			),
			'title_icon' => array(
				'type' => 'icon',
				'default' => '',
				'name' => __( 'Title Icon', 'su' ),
			),
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_infobox_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_INFOBOX_shortcode_data' );


function met_su_infobox_shortcode( $atts, $content = null ) {
	extract($atts);

	$text = do_shortcode(htmlspecialchars_decode($content));
	if(!isset($title_color)) $title_color = '#65676F';

	if ( $atts['title_icon'] ) {
		if ( strpos( $atts['title_icon'], 'icon:' ) !== false ) {
			$icon = '<i class="fa fa-' . trim( str_replace( 'icon:', '', $atts['title_icon'] ) ) . '"></i>';
			su_query_asset( 'css', 'font-awesome' );
		}
		else $icon = '<img src="' . $atts['title_icon'] . '" alt="' . esc_attr( $content ) . '" />';
	}

	$output = '<div class="row-fluid">
		<div class="span12">
			<article class="met_service_box clearfix">
				<h2 class="met_bold_one" style="color: '.$title_color.'">'.$title.'</h2>
				<div>'.$icon.'</div>
				<p>'.htmlspecialchars_decode($text).'</p>
			</article>
		</div>
	</div>';

	return $output;
}