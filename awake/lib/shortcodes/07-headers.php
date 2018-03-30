<?php
/**
 *
 */
class mysiteHeaders {
	
	/**
	 *
	 */
	function fancy_header1( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Fancy Header 1', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'fancy_header',
				'options' => array(
					array(
						'name' => __( 'Header Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text you wish to display as your header.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your header.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your header.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your header.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'variation'	=> '',
			'bgcolor'	=> '',
			'textcolor'	=> ''
	    ), $atts));

		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' class="' . trim( $variation ) . '"' : '';
		
		$styles = array();
		
		if( $bgcolor )
			$styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
			
		if( $textcolor )
			$styles[] = 'color:' . $textcolor . ';';
			
		$style = join( '', array_unique( $styles ) );
		$style = ( !empty( $style ) ) ? ' style="' . $style . '"': '' ;

	   	return '<h6 class="fancy_header"><span' . $variation . $style . '>' . mysite_remove_wpautop( $content ) . '</span></h6>';
	}
	
	/**
	 *
	 */
	function fancy_header2( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Fancy Header 2', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'fancy_header2',
				'options' => array(
					array(
						'name' => __( 'Header Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text you wish to display as your header.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your header.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your header.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color'
					),
				'shortcode_has_atts' => true
				)
			);

			return $option;
		}

		extract(shortcode_atts(array(
			'variation'	=> '',
			'textcolor'	=> ''
	    ), $atts));

		$variation = ( ( $variation ) && ( empty( $textcolor ) ) ) ? ' ' . trim( $variation ) . '_text' : '';
			
		$style = ( $textcolor ) ? ' style="color:' . trim( $textcolor ) . ';"' : '';

		return '<div class="fancy_header2"><span class = "' . $variation . '"' . $style . '>' . mysite_remove_wpautop( $content ) . '</span></div>';
	}
	
	/**
	 *
	 */
	function fancy_header3( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Fancy Header 3', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'fancy_header3',
				'options' => array(
					array(
						'name' => __( 'Header Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text you wish to display as your header.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your header.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your header.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'variation'	=> '',
			'textcolor'	=> ''
	    ), $atts));

		$variation = ( ( $variation ) && ( empty( $textcolor ) ) ) ? ' class="' . trim( $variation ) . '_text"' : '';
		
		$style = ( $textcolor ) ? ' style="color:' . trim( $textcolor ) . ';"' : '';

	   	return '<h6 class="fancy_header3"><span' . $variation . $style . '>' . mysite_remove_wpautop( $content ) . '</span></h6>';
	}
	
	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();
		
		$class_methods = get_class_methods( $class );
		
		foreach( $class_methods as $method ) {
			if( $method[0] != '_' )
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
		}
		
		$options = array(
			'name' => __( 'Fancy Headers', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose the type of header you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'headers',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>