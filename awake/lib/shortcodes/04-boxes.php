<?php
/**
 *
 */
class mysiteBoxes {	
	
	/**
	 *
	 */
	function download_box( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Download Box', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'download_box',
				'options' => array(
					'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				)
			);
			
			return $option;
		}
		
		return '<div class="download_box">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function warning_box( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Warning Box', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'warning_box',
				'options' => array(
					'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				)
			);
			
			return $option;
		}
			
		return '<div class="warning_box">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function info_box( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Info Box', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'info_box',
				'options' => array(
					'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				)
			);
			
			return $option;
		}
		
		return '<div class="info_box">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function note_box( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Note Box', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'note_box',
				'options' => array(
					'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				)
			);
			
			return $option;
		}
		
		return '<div class="note_box">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function fancy_box( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Fancy Box', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'fancy_box',
				'options' => array(
					array(
						'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Title <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out a title to use with your fancy box.  The title will display above the content.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
	    		'title'	=> ''
	    	), $atts));
						
		$out = '<div class="fancy_box">';
		
		if( !empty( $title ) )
			$out .= '<h6 class="fancy_box_title"><span>' . $title . '</span></h6>';
		
		$out .= '<div class="fancy_box_content">' . mysite_remove_wpautop( $content ) . '</div>';
		$out .= '</div>';
			
		return $out;
	}
	
	/**
	 *
	 */
	function titled_box( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Titled Box', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'titled_box',
				'options' => array(
					array(
						'name' => __( 'Box Title', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title to use with your titled box.  The title will display above the content.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your box.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your box.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your box.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
			
		extract(shortcode_atts(array(
	        'title'		=> '',
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
	
		$out = '<div class="titled_box">';
		$out .= '<h6 class="titled_box_title' . $variation . '"' . $style . '><span>' . $title . '</span></h6>';
		$out .= '<div class="titled_box_content">' . mysite_remove_wpautop( $content ) . '</div>';
		$out .= '</div>';
		
		return $out;
	}
		
	/**
	 *
	 */
	function colored_box( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Colored Box', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'colored_box',
				'options' => array(
					array(
						'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Box Title <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the title to use with your titled box.  The title will display above the content.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'title',
						'type' => 'text'
					),
					
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your box.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your box.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your box.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
			
		extract(shortcode_atts(array(
		    'title'		=> '',
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

		$out = '<div class="colored_box' . $variation . '"' . $style . '>';
		
		if( !empty( $title ) )
			$out .= '<h6 class="colored_box_title"><span>' . $title . '</span></h6>';
		
		$out .= '<div class="colored_box_content">' . mysite_remove_wpautop( $content ) . '</div>';
		$out .= '</div>';

	   	return $out;
	}
	
	/**
	 *
	 */
	function fancy_code_box( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Code Box', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'fancy_code_box',
				'options' => array(
					'name' => 'Box Content',
					'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				)
			);
			
			return $option;
		}
		
		return '<pre class="fancy_code_box">' . mysite_remove_wpautop( $content ) . '</pre>';
	}
	
	/**
	 *
	 */
	function fancy_pre_box( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Pre Box', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'fancy_pre_box',
				'options' => array(
					'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				)
			);
			
			return $option;
		}
			
		
		return '<pre class="fancy_pre_box">' . mysite_remove_wpautop( $content ) . '</pre>';
	}
	
	/**
	 *
	 */
	function squeeze_box( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Squeeze Box 1', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'squeeze_box',
				'options' => array(
					'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'css' 		=> '',
			'classes' 	=> '',
		), $atts));
		
		if ( !empty( $css ) )
			$css = " style='" . $css . "'";
			
		if ( !empty( $classes ) )
			 $classes = ' ' . $classes;
		
		return '<div class="squeeze_box' . $classes . '"'  . $css . '>' . mysite_remove_wpautop( do_shortcode( $content ) ) . '</div>';
	}
	
	/**
	 *
	 */
	function squeeze_box2( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Squeeze Box 2', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'squeeze_box2',
				'options' => array(
					'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'css' 		=> '',
			'classes' 	=> '',
		), $atts));
		
		if ( !empty( $css ) )
			$css = " style='" . $css . "'";
			
		if ( !empty( $classes ) )
			 $classes = ' ' . $classes;
		
		return '<div class="squeeze_box2' . $classes . '"'  . $css . '>' . mysite_remove_wpautop( do_shortcode( $content ) ) . '</div>';
	}
	
	/**
	 *
	 */
	function squeeze_box3( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Squeeze Box 3', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'squeeze_box3',
				'options' => array(
					'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'css' 		=> '',
			'classes' 	=> '',
		), $atts));
		
		if ( !empty( $css ) )
			$css = " style='" . $css . "'";
			
		if ( !empty( $classes ) )
			 $classes = ' ' . $classes;
		
		return '<div class="squeeze_box3' . $classes . '"'  . $css . '>' . mysite_remove_wpautop( do_shortcode( $content ) ) . '</div>';
	}
	
	/**
	 *
	 */
	function squeeze_box4( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Squeeze Box 4', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'squeeze_box4',
				'options' => array(
					'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'css' 		=> '',
			'classes' 	=> '',
		), $atts));
		
		if ( !empty( $css ) )
			$css = " style='" . $css . "'";
			
		if ( !empty( $classes ) )
			 $classes = ' ' . $classes;
		
		return '<div class="squeeze_box4' . $classes . '"'  . $css . '>' . mysite_remove_wpautop( do_shortcode( $content ) ) . '</div>';
	}
	
	/**
	 *
	 */
	function squeeze_box5( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Squeeze Box 5', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'squeeze_box5',
				'options' => array(
					'name' => __( 'Box Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the content that you wish to display inside your box.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'css' 		=> '',
			'classes' 	=> '',
		), $atts));
		
		if ( !empty( $css ) )
			$css = " style='" . $css . "'";
			
		if ( !empty( $classes ) )
			 $classes = ' ' . $classes;
		
		return '<div class="squeeze_box5' . $classes . '"'  . $css . '>' . mysite_remove_wpautop( do_shortcode( $content ) ) . '</div>';
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
			'name' => __( 'Fancy Boxes', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Select which type of box you would like to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'boxes',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>