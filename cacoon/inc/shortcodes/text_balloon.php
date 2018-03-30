<?php

function met_su_TEXT_BALLOON_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_text_balloon'] = array(
		'name' => __( 'Text Balloon', 'su' ),
		'type' => 'wrap',
		'group' => 'met',
		'atts' => array(
			'title' => array(
				'default' => '',
				'name' => __( 'Title', 'su' ),
			),
			'title_sub' => array(
				'default' => '',
				'name' => __( 'Title (Secondary)', 'su' ),
			),
			'font_size' => array(
				'type' => 'slider',
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 14,
				'name' => __( 'Font Size', 'su' ),
			),
			'line_height' => array(
				'type' => 'slider',
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 21,
				'name' => __( 'Line Height', 'su' ),
			),
			'text_color' => array(
				'type' => 'color',
				'default' => '#ffffff',
				'name' => __( 'Text Color', 'su' ),
			),
			'background' => array(
				'type' => 'color',
				'default' => '#656870',
				'name' => __( 'Background Color', 'su' ),
			),
			'arrow_position' => array(
				'type' => 'select',
				'values' => array('0'=>'Left','1'=>'Right'),
				'default' => '0',
				'name' => __( 'Arrow Position', 'su' ),
			),
		),
		'content' => '',
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_text_balloon_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_TEXT_BALLOON_shortcode_data' );


function met_su_text_balloon_shortcode( $atts, $content = null ) {
	extract($atts);

	$widgetID = uniqid('met_text_balloon_');

	$output = '<style>';

		if($arrow_position=='1'){
		$output .= '#'.$widgetID.':before {
			left: auto;
			right: -18px;
			border-width: 18px 18px 0 0;
			border-color : '.$background.' transparent transparent transparent !important;';
		}
		else{
		$output .= '#'.$widgetID.':before {
			border-color : transparent '.$background.' transparent transparent !important;';
		}
	$output .= '</style>';

	$output .= '
	<div class="row-fluid">
		<div class="span12">
			<div id="'.$widgetID.'" class="met_cacoon_sidebar met_color2 met_bgcolor3 clearfix" style="font-size:'.$font_size.'px;line-height:'.$line_height.'px;background-color:'.$background.'!important;color:'.$text_color.'!important;">';
				if(!empty($title)) $output .= '<h2 class="met_title_stack">'.$title.'</h2>';
				if(!empty($title_sub)) $output .= '<h3 class="met_title_stack met_bold_one">'.$title_sub.'</h3>';

				$output .= '
				<div class="met_cacoon_sidebar_wrapper">
					<div class="met_cacoon_sidebar_item clearfix">
						<p>'.do_shortcode(htmlspecialchars_decode($content)).'</p>
					</div>
				</div>
			</div>
		</div>
	</div>';

	return $output;
}