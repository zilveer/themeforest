<?php
/**
 *
 */
class mysiteQuotes {
	
	/**
	 *
	 */
	function pullquote1( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Pullquote 1', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'pullquote1',
				'options' => array(
					array(
						'name' => __( 'Pullquote Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Quotes <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to have icons displayed with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'quotes',
						'options' => array( 'true' => __( 'Display quote icon', MYSITE_ADMIN_TEXTDOMAIN ) ),  
						'default' => '',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your quote here.<br /><br />Your quote will float along the center, left or right hand sides depending on your choice.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'left' => __( 'left', MYSITE_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MYSITE_ADMIN_TEXTDOMAIN ),
							'center' => __( 'center', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Cite Name <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the name of the author.  It will display at the end of the quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'cite',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Cite Link <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you found your quote online then paste the URL here.  It will display after the author.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'citeLink',
						'default' => '',
						'type' => 'text'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'quotes'		 => '',
			'align'			 => '',
			'variation'		 => '',
			'textcolor'		 => '',
			'cite'			 => '',
			'citelink'		 => '',
			'citename'		 => '',
			'citeimgcustom'	 => '',
			'citeimgavatar'	 => '',
			'cite_sc' 		 => 'false',
			'testimonial_sc' => 'false',
	    ), $atts));
	
		$class = array();
		
		if( trim( $quotes ) == 'true' )
			$class[] = ' quotes';
			
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
			
		if( ( $variation ) && ( empty( $textcolor ) ) )
			$class[] = ' ' . $variation . '_text';
			
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
		
		$style = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
			
		$class = join( '', array_unique( $class ) );
		
		if( $testimonial_sc == 'true' ) {
			if( !empty( $content ) )
				$content = '<span class="quotes">' . $content . '</span>';
			
			if( !empty( $citeimgcustom ) || !empty( $citeimgavatar ) || !empty( $cite_sc ) || !empty( $citelink ) ) {
				$cite = '<span class="testimonial_author">';

				if( !empty( $citeimgcustom ) ) {
					$gravatar_size = apply_filters( 'testimonial_gravatar_size', '40' );
					$cite .= '<span class="testimonial_image">'
					. mysite_display_image(array(
						'src' => $citeimgcustom,
						'title' => '',
						'alt' => '',
						'height' => $gravatar_size,
						'width' => $gravatar_size,
						'wp_resize' => ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
					))
					. '</span>';
				}

				if( !empty( $citeimgavatar ) )
					$cite .= '<span class="testimonial_image">' . get_avatar( $citeimgavatar, apply_filters( 'testimonial_gravatar_size', '40' ), THEME_IMAGES_ASSETS . '/testimonial_gravatar_default.png' ) . '</span>';
				
				if( !empty( $cite_sc ) || !empty( $citelink ) ) {
					$cite .= '<span class="testimonial_meta">';
					
					if( !empty( $cite_sc ) && $cite_sc != 'false' )
						$cite .= '<span class="testimonial_author_name">' . $cite_sc . '</span>';
					
					if( !empty( $citelink ) )
						$cite .= '<span class="testimonial_author_website"><a href="' . esc_url( $citelink ) . '" class="target_blank">' . ( !empty( $citename ) ? $citename : $citelink ) . '</a></span>';
						
					$cite .= '</span>';
				}

				$cite .= '</span>';
				
			} else {
				$cite = '';
			}
		}
		
		return '<span class="pullquote' . $class . '"' . $style . '>' . mysite_remove_wpautop( $content ) . $cite . '</span>';
	}
	
	/**
	 *
	 */
	function pullquote2( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Pullquote 2', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'pullquote2',
				'options' => array(
					array(
						'name' => __( 'Pullquote Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Quotes <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to have icons displayed with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'quotes',
						'options' => array( 'true' => 'Display quote icon' ),
						'default' => '',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your quote here.<br /><br />Your quote will float along the center, left or right hand sides depending on your choice.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'left' => __( 'left', MYSITE_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MYSITE_ADMIN_TEXTDOMAIN ),
							'center' => __( 'center', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __('Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Cite Name <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the name of the author.  It will display at the end of the quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'cite',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Cite Link <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you found your quote online then paste the URL here.  It will display after the author.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'citeLink',
						'default' => '',
						'type' => 'text'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'quotes'		 => '',
			'align'			 => '',
			'variation'		 => '',
			'textcolor'		 => '',
			'cite'			 => '',
			'citelink'		 => '',
			'citename'		 => '',
			'citeimgcustom'	 => '',
			'citeimgavatar'	 => '',
			'cite_sc' 		 => 'false',
			'testimonial_sc' => 'false',
	    ), $atts));
	
		$class = array();
		
		if( trim( $quotes ) == 'true' )
			$class[] = ' quotes';
			
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
			
		if( ( $variation ) && ( empty( $textcolor ) ) )
			$class[] = ' ' . $variation . '_text';
			
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
		
		$style = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
			
		$class = join( '', array_unique( $class ) );
		
		if( $testimonial_sc == 'true' ) {
			if( !empty( $content ) )
				$content = '<span class="quotes">' . $content . '</span>';

			if( !empty( $citeimgcustom ) || !empty( $citeimgavatar ) || !empty( $cite_sc ) || !empty( $citelink ) ) {
				$cite = '<span class="testimonial_author">';

				if( !empty( $citeimgcustom ) ) {
					$gravatar_size = apply_filters( 'testimonial_gravatar_size', '40' );
					$cite .= '<span class="testimonial_image">'
					. mysite_display_image(array(
						'src' => $citeimgcustom,
						'title' => '',
						'alt' => '',
						'height' => $gravatar_size,
						'width' => $gravatar_size,
						'wp_resize' => ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
					))
					. '</span>';
				}

				if( !empty( $citeimgavatar ) )
					$cite .= '<span class="testimonial_image">' . get_avatar( $citeimgavatar, apply_filters( 'testimonial_gravatar_size', '40' ), THEME_IMAGES_ASSETS . '/testimonial_gravatar_default.png' ) . '</span>';

				if( !empty( $cite_sc ) || !empty( $citelink ) ) {
					$cite .= '<span class="testimonial_meta">';

					if( !empty( $cite_sc ) && $cite_sc != 'false' )
						$cite .= '<span class="testimonial_author_name">' . $cite_sc . '</span>';

					if( !empty( $citelink ) )
						$cite .= '<span class="testimonial_author_website"><a href="' . esc_url( $citelink ) . '" class="target_blank">' . ( !empty( $citename ) ? $citename : $citelink ) . '</a></span>';

					$cite .= '</span>';
				}

				$cite .= '</span>';

			} else {
				$cite = '';
			}
		}
	
		return '<span class="pullquote2' . $class . '"' . $style . '>' . mysite_remove_wpautop( $content ) . $cite . '</span>';
	}
	
	/**
	 *
	 */
	function pullquote3( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Pullquote 3', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'pullquote3',
				'options' => array(
					array(
						'name' => __( 'Pullquote Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Quotes <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to have icons displayed with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'quotes',
						'options' => array( 'true' => __('Display quote icon', MYSITE_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your quote here.<br /><br />Your quote will float along the center, left or right hand sides depending on your choice.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'left' => __( 'left', MYSITE_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MYSITE_ADMIN_TEXTDOMAIN ),
							'center' => __( 'center', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Cite Name <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the name of the author.  It will display at the end of the quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'cite',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Cite Link <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you found your quote online then paste the URL here.  It will display after the author.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'citeLink',
						'default' => '',
						'type' => 'text'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'quotes'		 => '',
			'align'			 => '',
			'variation'		 => '',
			'textcolor'		 => '',
			'cite'			 => '',
			'citelink'		 => '',
			'citename'		 => '',
			'citeimgcustom'	 => '',
			'citeimgavatar'	 => '',
			'cite_sc' 		 => 'false',
			'testimonial_sc' => 'false',
	    ), $atts));
	
		$class = array();
		
		if( trim( $quotes ) == 'true' )
			$class[] = ' quotes';
			
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
			
		if( ( $variation ) && ( empty( $textcolor ) ) )
			$class[] = ' ' . $variation . '_text';
			
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
		
		if( !empty( $citeimgcustom ) ) {
			$gravatar_size = apply_filters( 'testimonial_gravatar_size', '40' );
			$cite .= '<span class="testimonial_image">'
			. mysite_display_image(array(
				'src' => $citeimgcustom,
				'title' => '',
				'alt' => '',
				'height' => $gravatar_size,
				'width' => $gravatar_size,
				'wp_resize' => ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
			))
			. '</span>';
		}
		
		if( !empty( $citeimgavatar ) )
			$cite .= '<span class="testimonial_image">' . get_avatar( $citeimgavatar, apply_filters( 'testimonial_gravatar_size', '40' ), THEME_IMAGES_ASSETS . '/testimonial_gravatar_default.png' ) . '</span>';
		
		$style = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
			
		$class = join( '', array_unique( $class ) );
		
		if( $testimonial_sc == 'true' ) {
			if( !empty( $content ) )
				$content = '<span class="quotes">' . $content . '</span>';

			if( !empty( $citeimgcustom ) || !empty( $citeimgavatar ) || !empty( $cite_sc ) || !empty( $citelink ) ) {
				$cite = '<span class="testimonial_author">';

				if( !empty( $citeimgcustom ) ) {
					$cite .= '<span class="testimonial_image">'
					. mysite_display_image(array(
						'src' => $citeimgcustom,
						'title' => '', 'alt' => '',
						'height' => 44,
						'width' => 44,
						'wp_resize' => ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
					))
					. '</span>';
				}

				if( !empty( $citeimgavatar ) )
					$cite .= '<span class="testimonial_image">' . get_avatar( $citeimgavatar, apply_filters( 'testimonial_gravatar_size', '40' ), THEME_IMAGES_ASSETS . '/testimonial_gravatar_default.png' ) . '</span>';

				if( !empty( $cite_sc ) || !empty( $citelink ) ) {
					$cite .= '<span class="testimonial_meta">';

					if( !empty( $cite_sc ) && $cite_sc != 'false' )
						$cite .= '<span class="testimonial_author_name">' . $cite_sc . '</span>';

					if( !empty( $citelink ) )
						$cite .= '<span class="testimonial_author_website"><a href="' . esc_url( $citelink ) . '" class="target_blank">' . ( !empty( $citename ) ? $citename : $citelink ) . '</a></span>';

					$cite .= '</span>';
				}

				$cite .= '</span>';

			} else {
				$cite = '';
			}
		}
	
		return '<span class="pullquote3' . $class . '"' . $style . '>' . mysite_remove_wpautop( $content ) . $cite . '</span>';
	}
	
	/**
	 *
	 */
	function pullquote4( $atts = null, $content = null ) {
		if( $atts == 'generator' ) {
			$option = array( 
				'name' => __( 'Pullquote 4', MYSITE_ADMIN_TEXTDOMAIN ),
				'value' => 'pullquote4',
				'options' => array(
					array(
						'name' => __( 'Pullquote Content', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Type out the text that you wish to display with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'content',
						'default' => '',
						'type' => 'textarea'
					),
					array(
						'name' => __( 'Quotes <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Check if you wish to have icons displayed with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'quotes',
						'options' => array( 'true' => __('Display quote icon', MYSITE_ADMIN_TEXTDOMAIN )),
						'default' => '',
						'type' => 'checkbox'
					),
					array(
						'name' => __( 'Align <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Set the alignment for your quote here.<br /><br />Your quote will float along the center, left or right hand sides depending on your choice.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'align',
						'default' => '',
						'options' => array(
							'left' => __( 'left', MYSITE_ADMIN_TEXTDOMAIN ),
							'right' => __( 'right', MYSITE_ADMIN_TEXTDOMAIN ),
							'center' => __( 'center', MYSITE_ADMIN_TEXTDOMAIN ),
						),
						'type' => 'select'
					),
					array(
						'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Choose one of our predefined color skins to use with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'variation',
						'default' => '',
						'target' => 'color_variations',
						'type' => 'select'
					),
					array(
						'name' => __( 'Custom BG Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'Or you can also choose your own color to use as the background for your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'bgColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Custom Text Color <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'You can change the color of the text that appears on your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'textColor',
						'type' => 'color'
					),
					array(
						'name' => __( 'Cite Name <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'This is the name of the author.  It will display at the end of the quote.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'cite',
						'default' => '',
						'type' => 'text'
					),
					array(
						'name' => __( 'Cite Link <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
						'desc' => __( 'If you found your quote online then paste the URL here.  It will display after the author.', MYSITE_ADMIN_TEXTDOMAIN ),
						'id' => 'citeLink',
						'default' => '',
						'type' => 'text'
					),
				'shortcode_has_atts' => true
				)
			);
			
			return $option;
		}
		
		extract(shortcode_atts(array(
			'quotes'		 => '',
			'align'			 => '',
			'variation'		 => '',
			'bgcolor'		 => '',
			'textcolor'		 => '',
			'cite'			 => '',
			'citelink'		 => '',
			'citename'		 => '',
			'citeimgcustom'	 => '',
			'citeimgavatar'	 => '',
			'cite_sc' 		 => 'false',
			'testimonial_sc' => 'false',
	    ), $atts));
	
		$class = array();
		$styles = array();
		
		$quotes = ( trim( $quotes ) == 'true' ) ? ' class="quotes"' : '';
			
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
			
		if( ( $variation ) && ( empty( $bgcolor ) ) )
			$class[] = ' ' . $variation;
			
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
		
		if( !empty( $citeimgcustom ) ) {
			$gravatar_size = apply_filters( 'testimonial_gravatar_size', '40' );
			$cite .= '<span class="testimonial_image">'
			. mysite_display_image(array(
				'src' => $citeimgcustom,
				'title' => '',
				'alt' => '',
				'height' => $gravatar_size,
				'width' => $gravatar_size,
				'wp_resize' => ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
			))
			. '</span>';
		}
		
		if( !empty( $citeimgavatar ) )
			$cite .= '<span class="testimonial_image">' . get_avatar( $citeimgavatar, apply_filters( 'testimonial_gravatar_size', '40' ), THEME_IMAGES_ASSETS . '/testimonial_gravatar_default.png' ) . '</span>';
		
		if( $bgcolor )
			$styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
			
		if( $textcolor )
			$styles[] = 'color:' . $textcolor . ';';
			
		$class = join( '', array_unique( $class ) );
		$style = join( '', array_unique( $styles ) );
		
		$style = ( !empty( $style ) ) ? ' style="' . $style . '"': '' ;
		
		if( $testimonial_sc == 'true' ) {
			if( !empty( $content ) )
				$content = '<span class="quotes">' . $content . '</span>';

			if( !empty( $citeimgcustom ) || !empty( $citeimgavatar ) || !empty( $cite_sc ) || !empty( $citelink ) ) {
				$cite = '<span class="testimonial_author">';

				if( !empty( $citeimgcustom ) ) {
					$cite .= '<span class="testimonial_image">'
					. mysite_display_image(array(
						'src' => $citeimgcustom,
						'title' => '', 'alt' => '',
						'height' => 44,
						'width' => 44,
						'wp_resize' => ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
					))
					. '</span>';
				}

				if( !empty( $citeimgavatar ) )
					$cite .= '<span class="testimonial_image">' . get_avatar( $citeimgavatar, apply_filters( 'testimonial_gravatar_size', '40' ), THEME_IMAGES_ASSETS . '/testimonial_gravatar_default.png' ) . '</span>';

				if( !empty( $cite_sc ) || !empty( $citelink ) ) {
					$cite .= '<span class="testimonial_meta">';

					if( !empty( $cite_sc ) && $cite_sc != 'false' )
						$cite .= '<span class="testimonial_author_name">' . $cite_sc . '</span>';

					if( !empty( $citelink ) )
						$cite .= '<span class="testimonial_author_website"><a href="' . esc_url( $citelink ) . '" class="target_blank">' . ( !empty( $citename ) ? $citename : $citelink ) . '</a></span>';

					$cite .= '</span>';
				}

				$cite .= '</span>';

			} else {
				$cite = '';
			}
		}
	
		return '<span class="pullquote4' . $class . '"' . $style . '><span' . $quotes . '>' . mysite_remove_wpautop( $content ) . $cite . '</span></span>';
	}
	
	/**
	 *
	 */
	function blockquote( $atts = null, $content = null ) {
		$option = array( 
			'name' => __( 'Blockquotes', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'blockquote',
			'options' => array(
				array(
					'name' => __( 'Blockquote Content', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Type out the text that you wish to display with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'content',
					'default' => '',
					'type' => 'textarea'
				),
				array(
					'name' => __( 'Align <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Set the alignment for your quote here.<br /><br />Your quote will float along the center, left or right hand sides depending on your choice.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'align',
					'default' => '',
					'options' => array(
						'left' => __( 'left', MYSITE_ADMIN_TEXTDOMAIN ),
						'right' => __( 'right', MYSITE_ADMIN_TEXTDOMAIN ),
						'center' => __( 'center', MYSITE_ADMIN_TEXTDOMAIN ),
					),
					'type' => 'select',
				),
				array(
					'name' => __( 'Color Variation <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'Choose one of our predefined color skins to use with your quote.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'variation',
					'default' => '',
					'target' => 'color_variations',
					'type' => 'select'
				),
				array(
					'name' => __( 'Cite Name <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'This is the name of the author.  It will display at the end of the quote.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'cite',
					'default' => '',
					'type' => 'text'
				),
				array(
					'name' => __( 'Cite Link <small>(optional)</small>', MYSITE_ADMIN_TEXTDOMAIN ),
					'desc' => __( 'If you found your quote online then paste the URL here.  It will display after the author.', MYSITE_ADMIN_TEXTDOMAIN ),
					'id' => 'citeLink',
					'default' => '',
					'type' => 'text'
				),
			'shortcode_has_atts' => true,
			)
		);
		
		if( $atts == 'generator' )
			return $option;
			
		extract(shortcode_atts(array(
			'variation'		 => '',
			'cite'			 => '',
			'citelink'		 => '',
			'citename'		 => '',
			'citeimgcustom'  => '',
			'citeimgavatar'  => '',
			'cite_sc' 		 => 'false',
			'testimonial_sc' => 'false',
			'raw'		     => 'true',
		), $atts));
		
		$variation = ( $variation ) ? ' class="' . trim( $variation ) . '_sprite"' : '';
		
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
		
		if( $testimonial_sc == 'true' ) {
			if( !empty( $citeimgcustom ) || !empty( $citeimgavatar ) || !empty( $cite_sc ) || !empty( $citelink ) ) {
				$cite = '<span class="testimonial_author">';

				if( !empty( $citeimgcustom ) ) {
					$gravatar_size = apply_filters( 'testimonial_gravatar_size', '40' );
					$cite .= '<span class="testimonial_image">'
					. mysite_display_image(array(
						'src' => $citeimgcustom,
						'title' => '',
						'alt' => '',
						'height' => $gravatar_size,
						'width' => $gravatar_size,
						'wp_resize' => ( mysite_get_setting( 'image_resize_type' ) == 'wordpress' ? true : false )
					))
					. '</span>';
				}

				if( !empty( $citeimgavatar ) )
					$cite .= '<span class="testimonial_image">' . get_avatar( $citeimgavatar, apply_filters( 'testimonial_gravatar_size', '40' ), THEME_IMAGES_ASSETS . '/testimonial_gravatar_default.png' ) . '</span>';

				if( !empty( $cite_sc ) || !empty( $citelink ) ) {
					$cite .= '<span class="testimonial_meta">';

					if( !empty( $cite_sc ) && $cite_sc != 'false' )
						$cite .= '<span class="testimonial_author_name">' . $cite_sc . '</span>';

					if( !empty( $citelink ) )
						$cite .= '<span class="testimonial_author_website"><a href="' . esc_url( $citelink ) . '" class="target_blank">' . ( !empty( $citename ) ? $citename : $citelink ) . '</a></span>';

					$cite .= '</span>';
				}

				$cite .= '</span>';

			} else {
				$cite = '';
			}
		}

		if( $raw == 'true' )
			return '<blockquote' . $variation . '>' . mysite_remove_wpautop( $content ) . $cite . '</blockquote>';
		else
			return '<blockquote' . $variation . '>' . mysite_remove_wpautop( $content ) . $cite . '</blockquote>';
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
			'name' => __( 'Pullquotes & Blockquote', MYSITE_ADMIN_TEXTDOMAIN ),
			'desc' => __( 'Choose which type of quote you wish to use.', MYSITE_ADMIN_TEXTDOMAIN ),
			'value' => 'quotes',
			'options' => $shortcode,
			'shortcode_has_types' => true
		);
		
		return $options;
	}
	
}

?>