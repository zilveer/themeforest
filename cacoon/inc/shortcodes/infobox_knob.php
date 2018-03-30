<?php

function met_su_INFOBOX_KNOB_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_infobox_knob'] = array(
		'name' => __( 'Infobox (Knob)', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'atts' => array(
			'title' => array(
				'default' => '',
				'name' => __( 'Title', 'su' ),
			),
			'percent' => array(
				'type' => 'slider',
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 25,
				'name' => __( 'Percent', 'su' ),
			),
			'fg_color' => array(
				'type' => 'color',
				'default' => '#18ADB5',
				'name' => __( 'Foreground Color', 'su' ),
			),
			'background' => array(
				'type' => 'color',
				'default' => '#ebebeb',
				'name' => __( 'Background Color', 'su' ),
			),
			'thickness' => array(
				'type' => 'slider',
				'min' => 05,
				'max' => 99,
				'step' => 1,
				'default' => 25,
				'name' => __( 'Thickness', 'su' ),
			),
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_infobox_knob_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_INFOBOX_KNOB_shortcode_data' );


function met_su_infobox_knob_shortcode( $atts, $content = null ) {
	extract($atts);

	$widgetID = uniqid('met_info_knob_');

	if(!isset($fg_color)){
		$fg_color = '#18ADB5';
	}

	if(!isset($background)){
		$background = '#ebebeb';
	}

	if(!isset($thickness)){
		$thickness = '25';
	}

	$output = '<div class="row-fluid">
			<div class="span12">
				<div class="dial_wrap">
					<figure class="knob">
						<input class="dial '.$widgetID.'" data-value="'.$percent.'" data-width="170" value="'.$percent.'">
						<strong>'.$title.'</strong>
					</figure>
				</div>
			</div>
		</div>

		<script>
			jQuery(document).ready(function(){
				var container = jQuery(\'.'.$widgetID.'\');
				container.each(function() {

					var that = jQuery(this),
						ao = Math.round(Math.random() * 360),
						w = container.data(\'width\'),
						v = that.data(\'value\');

					that.addClass(\'visible\').knob({
						readOnly: true,
						bgColor: \''.$background.'\',
						fgColor: \''.$fg_color.'\',
						thickness: 0.'.$thickness.',
						angleOffset: ao,
						width: w
					});

					jQuery({value: 0}).animate({value: v}, {
						duration: 2000,
						easing:\'easeOutQuad\',
						step: function() {
							that.val(Math.ceil(this.value)).trigger(\'change\');
						}
					});

				});
			})
		</script>';

	return $output;
}