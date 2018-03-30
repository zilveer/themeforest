<?php
/**
 *
 */
class mysiteLinks {
	
	/**
	 *
	 */
	function fancy_link( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Fancy Link', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'fancy_link',
				'options' => array(
					array(
						'name' => __( 'Link Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the text that will display as your link.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Link Url', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste the URL that you wish to use for your link here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'link',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your link.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose your own color to use with your link.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Target <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Setting the target to "Blank" will open your page in a new tab when the reader clicks on the button.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'target',
						'default' => '',
						'options' => array( 'blank' => __( 'Blank', MYSITE_ADMIN_TEXTDOMAIN )),
						'type' => 'select'
					),
				'shortcode_has_atts' => true
				)
			);		
		
			return $option;
		}
			
		extract(shortcode_atts(array(
			'link'      => '#',
	        'variation'	=> '',
			'textcolor'	=> '',
			'target'	=> ''
	    ), $atts));

		$link = trim( $link );
		$variation = ( ( $variation ) && ( empty( $textcolor ) ) ) ? " {$variation}_sprite {$variation}_text" : '';
		$color = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '' ;
		$target = ( $target == 'blank' ) ? ' target_blank' : '';
		$arrow = ' &#x2192;';
		
		$out = '<a href="' . esc_url( $link ) . '" class="fancy_link' . $target . $variation . '"' . $color .'>' . mysite_remove_wpautop( $content ) . $arrow . '</a>';
		$out = apply_filters( 'mysite_fancy_link', $out, array( 'link' => $link, 'target' => $target, 'variation' => $variation, 'color' => $color, 'content' => $content, 'arrow' => $arrow ) );

	    return $out;
	}
	
	/**
	 *
	 */
	function download_link( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Download Link', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'download_link',
				'options' => array(
					array(
						'name' => __( 'Link Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the text that will display as your link.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Link Url', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste the URL that you wish to use for your link here.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'link',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your link.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Target <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Setting the target to "Blank" will open your page in a new tab when the reader clicks on the button.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'target',
						'default' => '',
						'options' => array( 'blank' => __( 'Blank', MYSITE_ADMIN_TEXTDOMAIN )),
						'type' => 'select'
					),
				'shortcode_has_atts' => true
				)
			);		
		
			return $option;
		}
		
		extract(shortcode_atts(array(
			'link'      => '#',
		    'variation'	=> '',
			'target'	=> ''
	    ), $atts));
	
		$link = trim( $link );
		$variation = ( $variation ) ? " {$variation}_sprite {$variation}_text" : '';
		
		$target = ( $target == 'blank' ) ? ' target_blank' : '';
	
		$out = '<a href="' . esc_url( $link ) . '" class="download_link' . $variation . $target . '">' . mysite_remove_wpautop( $content ) . '</a>';
	
		return $out;
		
	}
	
	/**
	 *
	 */
	function email_link( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Email Link', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'email_link',
				'options' => array(
					array(
						'name' => __( 'Link Text', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the text that will display as your link.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Email', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Paste the email that you wish to use here.<br /><br />When the reader clicks on this link an email client will open with your email ready.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'email',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your link.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Target <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Setting the target to "Blank" will open your page in a new tab when the reader clicks on the button.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'target',
						'default' => '',
						'options' => array( 'blank' => __( 'Blank', MYSITE_ADMIN_TEXTDOMAIN )),
						'type' => 'select'
					),
				'shortcode_has_atts' => true
				)
			);		
		
			return $option;
		}
		
		extract(shortcode_atts(array(
			'email'		=> '#',
		    'variation'	=> '',
			'target'	=> ''
	    ), $atts));
	
		$email = trim( $email );
		$variation = ( $variation ) ? " {$variation}_sprite {$variation}_text" : '';
	
		$is_email = preg_match( '/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*?[a-z]+$/is', $email );
		
		if( $is_email ) {
			$nospam = ( $email ) ? ' rel="' . mysite_nospam( $email ) . '"' : '';
			
			if( $email == trim( $content ) ) {
				$content = mysite_nospam( $content );
				$class = ' email_link_replace';
			} else {
				$class = ' email_link_noreplace';
			}
			
			$out = '<a href="#"' . $nospam . ' class="email_link' . $class . $variation . '">' . mysite_remove_wpautop( $content ) . '</a>';
		} else {
			$out = '<a href="' . $email . '" class="email_link' . $variation . '">' . mysite_remove_wpautop( $content ) . '</a>';
		}
	
		return $out;
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
			'name' => __( 'Fancy Links', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of link you would like to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'links',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>