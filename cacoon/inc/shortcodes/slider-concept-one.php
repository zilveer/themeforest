<?php

function met_su_CONCEPT_SLIDER_ONE_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_slider_c1'] = array(
		'name' => __( 'Slider C-1', 'su' ),
		'type' => 'wrap',
		'group' => 'met',
		'desc' => '',
		'atts' => array(
			'auto_play' => array(
				'type' => 'bool',
				'default' => 'yes',
				'name' => __( 'Auto Play', 'su' ),
			),
			'duration' => array(
				'type' => 'slider',
				'min' => 100,
				'max' => 10000,
				'step' => 10,
				'default' => 2000,
				'name' => __( 'Auto Play (Duration)', 'su' ),
			),
			'pauseduration' => array(
				'type' => 'slider',
				'min' => 100,
				'max' => 10000,
				'step' => 10,
				'default' => 0,
				'name' => __( 'Auto Play (Pause Duration)', 'su' ),
			),
			'circular' => array(
				'type' => 'bool',
				'default' => 'yes',
				'name' => __( 'Circular', 'su' ),
			),
			'infinite' => array(
				'type' => 'bool',
				'default' => 'yes',
				'name' => __( 'Infinite', 'su' ),
			),
			'navigation' => array(
				'type' => 'bool',
				'default' => 'yes',
				'name' => __( 'Show Navigation', 'su' ),
			),
		),
		'content' => '[su_met_slider_c1_item title="Slider Item 1" image="http://placehold.it/870x500" image_link="http://" button_link="http://"]Slider content goes here[/su_met_slider_c1_item]'."\n\n".'[su_met_slider_c1_item title="Slider Item 2" image="http://placehold.it/870x500/000000/ffffff" image_link="http://" button_link="http://"]Slider content goes here[/su_met_slider_c1_item]',
		'icon' => 'star',
		'function' => 'met_su_concept_slider_one_shortcode'
	);

	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_CONCEPT_SLIDER_ONE_shortcode_data' );


function met_su_concept_slider_one_shortcode( $atts, $content = null ) {
	extract($atts);

	wp_enqueue_script('metcreative-caroufredsel');
	wp_enqueue_style('metcreative-caroufredsel');

	$widgetID = uniqid('met_concept_slider_');

	$bool_search = array('yes','no');
	$bool_replace = array('true','false');

	$auto_play 		= str_replace($bool_search,$bool_replace,$auto_play);
	$circular 		= str_replace($bool_search,$bool_replace,$circular);
	$infinite 		= str_replace($bool_search,$bool_replace,$infinite);

	$output = '
	<div class="row-fluid">
		<div class="span12">
			<div class="met_slider_wrap">
				<div id="'.$widgetID.'" class="met_slider clearfix">' . su_do_shortcode( $content, 'r' ) . '</div>';

				if($navigation == 'yes'):
				$output .= '
				<a href="#" class="met_slider_nav_prev met_bgcolor met_bgcolor_transition2 met_color2"><i class="icon-chevron-left"></i></a>
				<a href="#" class="met_slider_nav_next met_bgcolor met_bgcolor_transition2 met_color2"><i class="icon-chevron-right"></i></a>';
				endif;

				$output .= '
				<div class="met_slider_overlay"></div>
			</div>
		</div>
	</div><!-- Slider Ends  -->

	<script>
		jQuery(window).load(function(){
			jQuery("#'.$widgetID.'").carouFredSel({
				responsive: true,
				prev: { button : function(){ return jQuery(this).parents(".met_slider_wrap").find(".met_slider_nav_prev") } },
				next:{ button : function(){ return jQuery(this).parents(".met_slider_wrap").find(".met_slider_nav_next") } },
				circular: '.$circular.',
				infinite: '.$infinite.',
				auto: { play : '.$auto_play.', pauseDuration: '.$pauseduration.', duration: '.$duration.' },
				scroll: { items: 1, duration: 400, wipe: true, pauseOnHover: true, fx: "crossfade" },
				items: { visible: { min: 1, max: 1 }, height: "variable" },
				onCreate: function(){
					jQuery(this).parents(".met_slider_wrap").find(".met_slider_overlay").fadeOut("fast",function(){
						jQuery(this).remove();
					});
				}
			});
		});
	</script>';

	return $output;
}

/* SLIDER ITEM */

function met_su_CONCEPT_SLIDER_ONE_ITEM_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_slider_c1_item'] = array(
		'name' => __( 'Slider C-1 Item', 'su' ),
		'type' => 'wrap',
		'group' => 'met',
		'atts' => array(
			'title' => array(
				'default' => 'Slider Item',
				'name' => __( 'Title', 'su' ),
			),
			'title_sub' => array(
				'default' => '',
				'name' => __( 'Title (Secondary)', 'su' ),
			),
			'image' => array(
				'type' => 'upload',
				'default' => 'http://placehold.it/870x500',
				'name' => __( 'Slider Image', 'su' ),
			),
			'image_link' => array(
				'default' => 'http://',
				'name' => __( 'Image Link', 'su' ),
			),
			'button_text' => array(
				'default' => '',
				'name' => __( 'Button Text', 'su' ),
			),
			'button_link' => array(
				'default' => 'http://',
				'name' => __( 'Button Link', 'su' ),
			),
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_concept_slider_one_item_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_CONCEPT_SLIDER_ONE_ITEM_shortcode_data' );


function met_su_concept_slider_one_item_shortcode( $atts, $content = null ) {
	extract($atts);

	$output = '';

	$output .= '
	<div class="met_slider_item clearfix">
		<div class="met_slider_item_preview"><a href="'.$image_link.'"><img src="'.$image.'" alt="'.esc_attr($title).'"></a></div>
		<article class="met_slider_item_caption met_bgcolor4 met_color2">
			<div>';
				if(!empty($title)) 			$output .= '<h2 class="met_title_stack">'.$title.'</h2>';
				if(!empty($title_sub)) 		$output .= '<h3 class="met_title_stack met_bold_one">'.$title_sub.'</h3><br>';
				if(!empty($content)) 		$output .= '<p>'.htmlspecialchars_decode($content).'</p>';
				if(!empty($button_text)) 	$output .= '<br><a href="'.$button_link.'" class="met_bgcolor met_button">'.$button_text.'</a>';
			$output .= '
			</div>
		</article>
	</div>';

	return $output;
}