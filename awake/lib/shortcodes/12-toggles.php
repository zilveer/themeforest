<?php
/**
 *
 */
class mysiteToggles {
	
	/**
	 *
	 */
	function toggle( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$numbers = range( 1,10 );

			$option = array( 
				'name' => __( 'Toggle', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'toggle',
				'options' => array(
					array(
						'name' => __( 'Toggle 1 Title', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title that will display with your toggle.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Toggle 1 Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your toggle.  Shortcodes are accepted.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Toggle 1 Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your toggle.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Accordion <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'When using an accordian only one toggle can be opened at a time.<br /><br />When clicking on another toggle the previous one will close before opening the next.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'accordion_group',
						'options' => array( 'true' => __('Group toggles into an accordion set', MYSITE_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox',
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => true
					),
					
					array(
						'name' => __( 'Total Number of Additional Toggles <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select more toggles to display in the group.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
		    'title'     => '',
			'variation' => '',
	    ), $atts));

		$variation = ( $variation ) ? ' ' . trim( $variation ) . '_sprite' : '';
		
		$out = '<h6 class="toggle' . $variation . '"><a href="#">' . $title . '</a></h6>';
		$out .= '<div class="toggle_content" style="display: none;">';
		$out .= '<div class="block">';
		$out .=  mysite_remove_wpautop( $content );
		$out .= '</div>';
		$out .= '</div>';

	   	return $out;
	}
	
	/**
	 *
	 */
	function toggle_framed( $atts = null, $content = null ) {
		
		if( $atts == 'generator' ) {
			$numbers = range( 1,10 );

			$option = array( 
				'name' => __( 'Toggle Framed', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'toggle_framed',
				'options' => array(
					array(
						'name' => __( 'Toggle 1 Title', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title that will display with your toggle.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Toggle 1 Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your toggle.  Shortcodes are accepted.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Toggle 1 Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your toggle.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Accordion <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'When using an accordian only one toggle can be opened at a time.<br /><br />When clicking on another toggle the previous one will close before opening the next.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'accordion_group',
						'options' => array( 'true' => __('Group toggles into an accordion set', MYSITE_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox',
						'shortcode_dont_multiply' => true,
						'shortcode_optional_wrap' => true
					),
					array(
						'name' => __( 'Total Number of Additional Toggles <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select more toggles to display in the group.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
	        'title'		=> '',
			'variation' => '',
	    ), $atts));

		$variation = ( $variation ) ? ' ' . trim( $variation ) . '_sprite' : '';

		$out = '<div class="toggle_frame">';
		$out .= '<h6 class="toggle' . $variation . '"><a href="#">' . $title . '</a></h6>';
		$out .= '<div class="toggle_content" style="display: none;">';
		$out .= '<div class="block">';
		$out .=  mysite_remove_wpautop( $content );
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';

	   	return $out;
	}
	
	/**
	 *
	 */
	function accordion_group( $atts = null, $content = null ) {
		$out = '';
		
		if (!preg_match_all("/(.?)\[(toggle_framed)\b(.*?)(?:(\/))?\](?:(.+?)\[\/toggle_framed\])?(.?)/s", $content, $matches)) {
			
			if (!preg_match_all("/(.?)\[(toggle)\b(.*?)(?:(\/))?\](?:(.+?)\[\/toggle\])?(.?)/s", $content, $matches)){
				
				return mysite_remove_wpautop( $content );
				
			} else {
				
				for($i = 0; $i < count($matches[0]); $i++) {
					$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
				}
				
				for($i = 0; $i < count($matches[0]); $i++) {
					$out .= '<h6 class="toggle_accordion"><a href="#">' . $matches[3][$i]['title'] . '</a></h6>';
					$out .= '<div class="toggle_content" style="display: none;">';
					$out .= '<div class="block">';
					$out .= mysite_remove_wpautop( $matches[5][$i] );
					$out .= '</div>';
					$out .= '</div>';
				}

				return '<div class="toggle_frame_set">' . $out . '</div>';
			}
			
			
		} else {
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<div class="toggle_frame">';
				$out .= '<h6 class="toggle_accordion"><a href="#">' . $matches[3][$i]['title'] . '</a></h6>';
				$out .= '<div class="toggle_content" style="display: none;">';
				$out .= '<div class="block">';
				$out .= mysite_remove_wpautop( $matches[5][$i] );
				$out .= '</div>';
				$out .= '</div>';
				$out .= '</div>';
			}

			return '<div class="toggle_frame_set">' . $out . '</div>';
		}
	}
	
	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' && $method != 'accordion_group' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}
		
		$options = array(
			'name' => __( 'Toggles', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of toggle you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'toggles',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>