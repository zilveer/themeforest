<?php
/**
 *
 */
class mysiteButtons {
	
	/**
	 *
	 */
	function button( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {			
			$option = array( 
				'name' => __( 'Button', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'button',
				'options' => array(
				
					array(
						'name' => __( 'Button Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the text that will appear on your button.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Link Url', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste a URL here to use as a link for your button.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'link',
						'default' => '',
						'type' => 'text',
					),
					array(
						'name' => __( 'Size <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can choose between three sizes for your button.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'size',
						'default' => '',
						'options' => array(
							'small' => __('small', MYSITE_ADMIN_TEXTDOMAIN ),
							'medium' => __('medium', MYSITE_ADMIN_TEXTDOMAIN ),
							'large' => __('large', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your button.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select',
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your button.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your button.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color',
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your button here.<br /><br />Your button will float along the center, left or right hand sides depending on your choice.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'center' => __( 'center', MYSITE_ADMIN_TEXTDOMAIN ),
							'left' => __( 'left', MYSITE_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select',
					),
					array(
						'name' => __( 'Target <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( "Setting the target to 'Blank' will open your page in a new tab when the reader clicks on the button.", MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'target',
						'default' => '',
						'options' => array( 'blank' => __('Blank', MYSITE_ADMIN_TEXTDOMAIN )),
						'type' => 'select',
					),
				'shortcode_has_atts' => true,
				)
			);
		
			return $option;
		}
			
		extract(shortcode_atts(array(
			'size'      => '',
			'align'	    => '',
		    'link'      => '#',
			'target'    => '',
			'variation'	=> '',
			'bgcolor'	=> '',
			'textcolor'	=> ''
	    ), $atts));

		$size = ( $size == 'large' ) ? ' large_button' : $size;
		$size = ( $size == 'medium' ) ? ' medium_button' : $size;
		$size = ( $size == 'small' ) ? ' small_button' : $size;
		
		$align = ( $align ) ? ' align'.$align : '';

		$target = ( $target == 'blank' ) ? ' target_blank' : '';
		
		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' ' . $variation : '';
		
		$styles = array();
			
		if( $bgcolor )
			$styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
			
		if( $textcolor )
			$styles[] = 'color:' . $textcolor . ';';
			
		$style = join( '', array_unique( $styles ) );
		
		$style = !empty( $style ) ? ' style="' . $style . '"': '' ;

		$out = '<a href="' . esc_url( $link ) . '" class="button_link hover_fade' . $size . $target . $align . $variation . '"' . $style . '><span>' . mysite_remove_wpautop( $content ) . '</span></a>';

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
			'name' => __( 'Fancy Buttons', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'button',
			'options' => $shortcode
		);
		
		return $options;
	}
	
}

?>