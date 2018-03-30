<?php
/**
 *
 */
class mysiteDropcap {
	
	/**
	 *
	 */
	function dropcap1( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Drop Cap 1', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'dropcap1',
				'options' => array(
					array(
						'name' => __( 'Drop Cap Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the letter you wish to display as your dropcap.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your dropcap.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'variation'	=> ''
	    ), $atts));
	
		$variation = ( $variation ) ? ' ' . $variation . '_sprite' : '';
			
		return '<span class="dropcap' . $variation . '">' . mysite_remove_wpautop( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	function dropcap2( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Drop Cap 2', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'dropcap2',
				'options' => array(
					array(
						'name' => __( 'Drop Cap Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the letter you wish to display as your dropcap.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your dropcap.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your dropcap.', MYSITE_ADMIN_TEXTDOMAIN ),
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
	
		$variation = ( ( $variation ) && ( empty( $textcolor ) ) ) ? ' ' . $variation . '_text' : '';
		
		$style = ( !empty( $textcolor ) ) ? ' style="color:' . $textcolor . ';"': '' ;
		
		return '<span class="dropcap2' . $variation . '"' . $style . '>' . mysite_remove_wpautop( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	function dropcap3( $atts = null, $content = null, $code = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Drop Cap 3', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'dropcap3',
				'options' => array(
					array(
						'name' => __( 'Drop Cap Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the letter you wish to display as your dropcap.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your dropcap.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'variation'	=> ''
	    ), $atts));
		
		$variation = ( $variation ) ? ' ' . $variation . '_sprite' : '';
			
		return '<span class="dropcap3' . $variation . '">' . mysite_remove_wpautop( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	function dropcap4( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Drop Cap 4', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'dropcap4',
				'options' => array(
					array(
						'name' => __( 'Drop Cap Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the letter you wish to display as your dropcap.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your dropcap.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your dropcap.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your dropcap.', MYSITE_ADMIN_TEXTDOMAIN ),
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
	
		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' ' . $variation : '';
		
		$styles = array();
		
		if( $bgcolor )
			$styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
			
		if( $textcolor )
			$styles[] = 'color:' . $textcolor . ';';
			
		$style = join( '', array_unique( $styles ) );
		
		$style = ( !empty( $style ) ) ? ' style="' . $style . '"': '' ;
		
		return '<span class="dropcap4' . $variation . '"' . $style . '><span>' . mysite_remove_wpautop( $content ) . '</span></span>';
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
			'name' => __( 'Dropcaps', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of dropcap you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'dropcaps',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>