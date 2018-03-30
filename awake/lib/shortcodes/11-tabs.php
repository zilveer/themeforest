<?php
/**
 *
 */
class mysiteTabs {
	
	/**
	 *
	 */
	function tabs( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,10);

			$option = array( 
				'name' => __( 'Tabs', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'tabs',
				'options' => array(
					array(
						'name' => __( 'Number of tabs', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of tabs you wish to display.  The tabs are the selectable areas which change the content.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Tab 1 Title', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title for your tab.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Tab 1 Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your tab.  Shortcodes are accepted.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'tab',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);

			return $option;
		}
			
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return mysite_remove_wpautop( $content );
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			$out = '<ul class="tabs">';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<li><a href="#">' . $matches[3][$i]['title'] . '</a></li>';
			}
			$out .= '</ul>';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<div class="tabs_content">' . mysite_remove_wpautop( $matches[5][$i] ) . '</div>';
			}
			
			return '<div class="tabs_container">' . $out . '</div>';
		}
	}
	
	/**
	 *
	 */
	function tabs_framed( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,10);

			$option = array( 
				'name' => __( 'Framed Tabs', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'tabs_framed',
				'options' => array(
					array(
						'name' => __( 'Number of tabs', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of tabs you wish to display.  The tabs are the selectable areas which change the content.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Tab 1 Title', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title for your tab.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Tab 1 Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your tab.  Shortcodes are accepted.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'tab',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return mysite_remove_wpautop( $content );
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			$out = '<ul class="tabs_framed">';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<li><a href="#">' . $matches[3][$i]['title'] . '</a></li>';
			}
			$out .= '</ul>';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<div class="tabs_framed_content">' . mysite_remove_wpautop( $matches[5][$i] ) . '</div>';
			}
			
			return '<div class="tabs_framed_container">' . $out . '</div>';
		}
	}
	
	/**
	 *
	 */
	function tabs_button( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,10);

			$option = array( 
				'name' => __( 'Button Tabs', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'tabs_button',
				'options' => array(
					array(
						'name' => __( 'Number of tabs', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of tabs you wish to display.  The tabs are the selectable areas which change the content.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Tab 1 Title', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title for your tab.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Tab 1 Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your tab.  Shortcodes are accepted.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'tab',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
		
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return mysite_remove_wpautop( $content );
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			$out = '<ul class="tabs_button">';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<li><a href="#">' . $matches[3][$i]['title'] . '</a></li>';
			}
			$out .= '</ul>';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<div class="tabs_button_content">' . mysite_remove_wpautop( $matches[5][$i] ) . '</div>';
			}
			
			return '<div class="tabs_button_container">' . $out . '</div>';
		}
	}
	
	/**
	 *
	 */
	function tabs_vertical( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$numbers = range(1,10);

			$option = array( 
				'name' => __( 'Vertical Tabs', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'tabs_vertical',
				'options' => array(
					array(
						'name' => __( 'Number of tabs', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Select the number of tabs you wish to display.  The tabs are the selectable areas which change the content.  Vertical tabs will display on the left hand side.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'multiply',
						'default' => '',
						'options' => $numbers,
						'type' => 'select',
						'shortcode_multiplier' => true
					),
					array(
						'name' => __( 'Tab 1 Title', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title for your tab.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text',
						'shortcode_multiply' => true
					),
					array(
						'name' => __( 'Tab 1 Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that will display with your tab.  Shortcodes are accepted.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea',
						'shortcode_multiply' => true
					),
					array(
						'value' => 'tab',
						'nested' => true
					),
				'shortcode_has_atts' => true,
				)
			);
			
			return $option;
		}
			
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return mysite_remove_wpautop( $content );
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts( $matches[3][$i] );
			}
			$out = '<div class="tabs_vertical_frame">';
			$out .= '<span class="bg_top"></span>';
			$out .= '<ul class="tabs_vertical">';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<li' . ( $i==0 ? ' class="current"' : '' ) . '><a href="#">' . $matches[3][$i]['title'] . '<span></span></a></li>';
			}
			$out .= '</ul>';
			$out .= '<span class="bg_bottom"></span>';
			$out .= '</div>';
			
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<div class="tabs_vertical_content">' . mysite_remove_wpautop( $matches[5][$i] ) . '</div>';
			}
			
			return '<div class="tabs_vertical_container">' . $out . '</div><div class="clearboth"></div>';
		}
	}
	
	/**
	 *
	 */
	function _options($class) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Tabs', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of tabs you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'tabs',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>