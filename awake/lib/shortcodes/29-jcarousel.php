<?php
/**
 *
 */
class mysiteJcarousel {
	
	private static $carousel_id = 1;
	
	/**
	 *
	 */
	function _carousel_id() {
	    return self::$carousel_id++;
	}
	
	/**
	 *
	 */
	function jcarousel( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			$option = array( 
				'name' => __( 'jCarousel', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'jcarousel',
				'options' => array(
					array(
						'name' => __( 'Visible Slides', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many slides you want to be visible at one time.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'visible',
						'options' => array_combine(range(1,20), array_values(range(1,20))),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Scrolling range', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many slides you wish to cycle when clicking on the arrows.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'scroll',
						'options' => array_combine(range(1,20), array_values(range(1,20))),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Animation speed', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Type out how fast you want the animation to display.  The value is defined in milliseconds so 1000 equals 1 second.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'animation',
						'type' => 'text',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Automatic sliding', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many seconds you want to pass before the carousel cycles automatically.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'auto',
						'options' => array_combine(range(1,20), array_values(range(1,20))),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Ending Wrap', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select the behaviour for when the end of the carousel is reached.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'wrap',
						'options' => array(
							'first' => __('First', MYSITE_ADMIN_TEXTDOMAIN ),
							'last' => __('Last', MYSITE_ADMIN_TEXTDOMAIN ),
							'both' => __('Both', MYSITE_ADMIN_TEXTDOMAIN ),
							'circular' => __('Circular', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Number of slides', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Select how many slides you wish to display.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'options' => range(1,20),
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Space between items in pixels', MYSITE_ADMIN_TEXTDOMAIN ),
						"desc" => __( 'Choose how much space you wish to display between the slides', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'space',
						'options' => array_combine(range(1,40), array_values(range(1,40))),
						'type' => 'select',
						'shortcode_dont_multiply' => true
					),
					array(
						'name' => __( 'Slide Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the content that will appear inside your slide.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'slide',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
		
			return $option;
		}
			
		extract(shortcode_atts(array(
			'vertical' 	=> 'false',
			'visible' 	=> '1',
			'scroll' 	=> '1',
			'animation' => 500,
			'auto' 		=> 0,
			'wrap' 		=> 'both',
			'space' 	=> '20',
	    ), $atts));
	
		global $mysite;
	
		$mobile_disable_shortcodes = mysite_get_setting( 'mobile_disable_shortcodes' );
		if( isset( $mysite->mobile ) && is_array( $mobile_disable_shortcodes ) && in_array( 'tooltips', $mobile_disable_shortcodes ) )
			return;
		
		$carousel_id = 'mysite_custom_jcarousel_' . self::_carousel_id();
		$space = trim( $space );
		
		$out = '<div class="mysite_jcarousel noscript">';
		
		# Build the jCarousel
		$out .= '<script type="text/javascript">';
		$out .= 'jQuery(document).ready(function() {';
		$out .= 'jQuery("#'.$carousel_id.'").jcarousel({';
		# Setup options
		$out .= 'vertical: '. $vertical . ',';
		$out .= 'visible: ' . $visible . ',';
		$out .= 'scroll: ' . $scroll . ',';
		$out .= 'animation: ' . $animation . ',';
		$out .= 'auto: ' . $auto . ',';
		$out .= 'wrap: "' . $wrap . '",';
		
		if( $wrap == 'both' )
			$out .= 'itemFallbackDimension: 400,';
		
		$out .= 'buttonNextHTML: null, buttonPrevHTML: null,'; 
		$out .= 'initCallback: '.$carousel_id.'_callback,';
		$out .= 'setupCallback: '.$carousel_id.'_setup,';
		$out .= 'buttonNextCallback: '.$carousel_id.'_next_event,';
		
		if( $wrap != 'first' && $wrap !='circular' && $wrap != 'both' )
			$out .= 'buttonPrevCallback: '.$carousel_id.'_prev_event,';

		$out .= '});';
		$out .= '});';
		
		# Add disabled class to next button
		$out .= 'function '.$carousel_id.'_next_event(c) {';
		$out .= 'if( c.buttonNextState === true ) { jQuery("#'.$carousel_id.'_next").addClass("jcarousel_next_disabled"); }';
		$out .= 'if( c.buttonNextState === false ){ jQuery("#'.$carousel_id.'_next").removeClass("jcarousel_next_disabled"); }';
		$out .= '}';
		
		# Add disabled class to prev button
		$out .= 'function '.$carousel_id.'_prev_event(c) {';
		$out .= 'if( c.buttonPrevState === true || c.buttonPrevState === null ) { jQuery("#'.$carousel_id.'_prev").addClass("jcarousel_prev_disabled"); }';
		$out .= 'if( c.buttonPrevState === false ){ jQuery("#'.$carousel_id.'_prev").removeClass("jcarousel_prev_disabled"); }';
		$out .= '}';
		
		# Setup our custom next prev buttons
		$out .= 'function '.$carousel_id.'_callback(c) {';
		$out .= 'jQuery("#'.$carousel_id.'_next").live("click touchstart", function(){ c.next(); Cufon.refresh(); return false; });';
		$out .= 'jQuery("#'.$carousel_id.'_prev").live("click touchstart", function(){ c.prev(); Cufon.refresh(); return false; });';
		$out .= '}';
		
		# Show after jcarousel is completely setup
		$out .= 'function '.$carousel_id.'_setup(c) {';
		$out .= "c.clip.parent().parent().parent().parent().removeClass('noscript');";
		$out .= '}';
		
		$out .= '</script>';
		
		$out .= '<div class="mysite_jcarousel_nav">';
		$out .= '<span id="' . $carousel_id . '_prev" class="mysite_jcarousel_prev"></span><span id="' . $carousel_id . '_next" class="mysite_jcarousel_next"></span>';
		$out .= '</div>';
		
		# Start displaying the jCarousel HTML
		$out .= '<div id = "'.$carousel_id.'_wrapper" class = "jcarousel_wrapper jcarousel_grid">';
		$out .= '<ul id = "'.$carousel_id.'" class = "jcarousel-skin-mysite">';
		
		# Setup margins for horizontal items
		$margin = 'margin-left: '.round(($space / 2)).'px; margin-right: '.round(($space / 2)).'px;';
		
		if ( preg_match_all( '/(.?)\[(slide)\b(.*?)(?:(\/))?\](?:(.+?)\[\/slide\])?(.?)/s', $content, $matches ) ) {
			
			foreach ( $matches[0] as $slide ) {
				
				# Fix the string so shortcode_parse_atts picks it up correctly
				$needle = strpos($slide, ']');
				$start = substr($slide, 0, $needle);
				$end = substr($slide, $needle);
				$scfix = $start . ' ' . $end;
				
				# Grab the content of the slide
				$length = strlen(substr($slide, $needle + 1)) - 9;
				$content = substr($slide, $needle + 1, $length);

				$values = shortcode_parse_atts($scfix);
				
				# Output the slide
				$out .= '<li style = "'.$margin.'">'.do_shortcode($content).'</li>';				
			}

		}
		
		# Ending jCarousel HTML
		$out .= '</ul>';
		$out .= '</div><div class = "clearboth"></div></div>';
		
		return $out;
	}
	
	function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'jCarousel', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'jcarousel',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>