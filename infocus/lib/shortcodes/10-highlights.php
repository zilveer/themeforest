<?php
/**
 *
 */
class mysiteHighlights {
	
	/**
	 *
	 */
	function highlight1( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Highlight 1', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'highlight1',
				'options' => array(
					array(
						'name' => __( 'Highlight Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your highlight.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your highlight.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your highlight.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your highlight.', MYSITE_ADMIN_TEXTDOMAIN ),
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
	
		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' ' . trim( $variation ) : '';
		
		$styles = array();
		
		if( $bgcolor )
			$styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
			
		if( $textcolor )
			$styles[] = 'color:' . $textcolor . ';';
			
		$style = join( '', array_unique( $styles ) );
		$style = ( !empty( $style ) ) ? ' style="' . $style . '"': '' ;
			
		return '<span class="highlight' . $variation . '"' . $style . '>' . mysite_remove_wpautop( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	function highlight2( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Highlight 2', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'highlight2',
				'options' => array(
					array(
						'name' => __( 'Highlight Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your highlight.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your highlight.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your highlight.', MYSITE_ADMIN_TEXTDOMAIN ),
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
			
		$style = ( !empty( $textcolor ) ) ? ' style="color:' . $textcolor . ';"': '' ;
			
		return '<span class="highlight2' . $variation . '"' . $style . '>' . mysite_remove_wpautop( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	function highlight3( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Highlight 3', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'highlight3',
				'options' => array(
					array(
						'name' => __( 'Highlight Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your highlight.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true
				)
			);

			return $option;
		}

		extract(shortcode_atts(array(
			'css' 		=> '',
			'classes' 	=> '',
		), $atts));

		if ( !empty( $css ) )
			$css = ' style="' . $css . '"';
			
		if ( !empty( $classes ) )
			$classes = ' ' . $classes;

		return '<span class="highlight3' . $classes . '"' . $css . '>' . mysite_remove_wpautop( do_shortcode( $content ) ) . '</span>';
	}

	/**
	 *
	 */
	function highlight4( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Highlight 4', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'highlight4',
				'options' => array(
					array(
						'name' => __( 'Highlight Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your highlight.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
				'shortcode_has_atts' => true
				)
			);

			return $option;
		}

		extract(shortcode_atts(array(
			'css' 		=> '',
			'classes' 	=> '',
		), $atts));

		if ( !empty( $css ) )
			$css = ' style="' . $css . '"';
			
		if ( !empty( $classes ) )
			$classes = ' ' . $classes;

		return '<span class="highlight4' . $classes . '"' . $css . '>' . mysite_remove_wpautop( do_shortcode( $content ) ) . '</span>';
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
			'name' => __( 'Highlights', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of highlight you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'highlights',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>