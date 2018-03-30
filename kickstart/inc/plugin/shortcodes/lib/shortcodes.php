<?php

	/**
	 * Shortcode: heading
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_heading_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'color' => '',
				'style' => 1
				), $atts ) );

		return '<div class="heading-wrapper"><h6><span class="heading-line-left"></span><strong>' . do_shortcode( $content ) . '</strong><span class="heading-line-right"></span></h6></div>';
	}
		
	/**
	 * Shortcode: service
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_service_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'title' => 'Your service title',
				'size' => '25',
				'color' => '',
				'url'=> '',
				'icon' => 'moon-checkmark'
				), $atts ) );
		
		$margin_left = $size + 25;	
		if ($url){ $service_title = '<a href="' . $url . '" />' . $title . '</a>'; } else { $service_title = $title; }

		return '<div class="service-box"><i style="font-size:' . $size . 'px; color:' . $color . ';" class="' . $icon . '"></i><div class="service-content" style="margin-left:' . $margin_left .'px;"><h5>' . $service_title . '</h5>' . do_shortcode( $content ) . '</div></div>';
	}
	
	/**
	 * Shortcode: clients
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_client_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'logo' => '',
				'link' => '',
				'align' => 'center'
				), $atts ) );
				
		$return = '';
		
		if ($link){ $return .= '<div class="client-wrapper" style="text-align:'. $align .'"><a href="'. $link .'">'; } else { $return .= '<div class="client-wrapper" style="text-align:'. $align .'">'; }

		$return .= '<img src="'. $logo .'" alt="" />';
		
		if ($link){ $return .= '</a></div>'; } else { $return .= '</div>'; }
		
		return $return;
	}


	/**
	 * Shortcode: Latest works
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_latest_works_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'post_type' => 'portfolio',
				'category' => null,
				'include' => null,
				'exclude' => null,
				'num' => 4,
				'orderby' => 'date',
				'order' => 'DESC',
				'offset' => 0
				), $atts ) );
		
		global $post;

		if($category) {
				$args = array(
				'post_type' => $post_type,
				'tax_query' => array(
					array(
					  'taxonomy' => 'portfolio_category',
					  'field' => 'slug',
					  'terms' => $category
					)
				),
				'numberposts' => $num,
				'orderby' => $orderby,
				'include' => $include,
				'exclude' => $exclude,
				'offset' => $offset,
				'order' => $order
			);
		} else {
			$args = array(
				'post_type' => $post_type,
				'numberposts' => $num,
				'orderby' => $orderby,
				'include' => $include,
				'exclude' => $exclude,
				'offset' => $offset,
				'order' => $order
			);
		}
		
        $works = get_posts($args);

			$return = '<div class="latest-works"><ul class="filterable-grid pf-three-columns">';

			foreach($works as $post) :
                setup_postdata($post);
				global $more;
                $more = 0;
				
				$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
				$large_image = $large_image[0]; 
				$image = aq_resize( $large_image, '460', '537', true ); 

								
				$return .= '<li>';
				
				if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
					$return .= '<img src="'. $image .'" alt="" />'; 
				}

				$return .= '<div class="mask">';
				
				if (get_post_meta($post->ID, 'portfolio_video_link', true)) {
					$return .= '<a href="'. get_post_meta($post->ID, 'portfolio_video_link', true) .'" class="pf-zoom"><i class="moon-movie"></i></a>';
				} else {
					$return .= '<a href="'. $large_image .'" class="pf-zoom"><i class="moon-camera-3"></i></a>';
				}
				
				$return .= '<a href="'. get_permalink() .'" class="pf-info"><i class="moon-link-4"></i></a></div>';
				
				$return .= '<div class="pf-title">'. get_the_title() .'</div>';
				$return .= '</li>';
			endforeach;
			wp_reset_query();

			$return .= '<div class="clear"></div></ul></div>';

		return $return;
	}
	
	/**
	 * Shortcode: background block
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_background_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'color' => '',
				'image' => '',
				'align' => 'center',
				'margin_bottom' => 40,
				'margin_top' => 0,
				'padding_top' => 40,
				'padding_bottom' => 40
				), $atts ) );
		
		$bg_image = ( $image ) ? 'background-image:url(' . $image . ');' : '';
				
		return '<div class="background-block" style="background-color:' . $color .'; '. $bg_image .' margin-top:' . $margin_top . 'px; margin-bottom:' . $margin_bottom . 'px; padding-top:' . $padding_top . 'px; padding-bottom:' . $padding_bottom . 'px; text-align:' . $align . ';"><div class="background-block-container">' . do_shortcode( $content ) . '</div></div>';
	}
	
	
	/**
	 * Shortcode: testimonials_slider
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_testimonials_slider_shortcode( $atts = null, $content = null ) {
		
		return '<div class="testimonials-slider">' . su_do_shortcode( $content, 't' ) . '</div>';
	}
	
	/**
	 * Shortcode: testimonial
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_testimonial_shortcode( $atts, $content ) {
		extract( shortcode_atts( array( 
				'author' => 'Author Name' 
				), $atts ) );

		$return = '<div class="testimonial-wrapper"><div class="testimonial-content">' . $content . '</div><div class="testimonial-arrow"></div><div class="testimonial-author"><i class="moon-user-6"></i>' . $author . '</div></div>';
		
		return $return;
	}
	
	/**
	 * Shortcode: Testimonial with image
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_img_testimonial_shortcode( $atts, $content ) {
		extract( shortcode_atts( array( 
				'img' => '#', 
				'author' => 'Author Name' 
				), $atts ) );

		$return = '<div class="big-testimonial-wrapper"><div class="big-testimonial-image"><img src="'. aq_resize( $img, '230', '230', true ) .'" alt="" /></div><div class="big-testimonial-content">' . $content . '<span>' . $author . '</span></div><div class="clear"></div></div>';
		
		return $return;
	}



	/**
	 * Shortcode: tabs
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_tabs_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
				'style' => 1
				), $atts ) );

		$GLOBALS['tab_count'] = 0;

		do_shortcode( $content );

		if ( is_array( $GLOBALS['tabs'] ) ) {
			foreach ( $GLOBALS['tabs'] as $tab ) {
				$tab_icon = ( $tab['icon'] ) ? '<i class="' . $tab['icon'] . ' su-tab-icon"></i>' : '';
				$tabs[] = '<span>' . $tab_icon . $tab['title'] . '</span>';
				$panes[] = '<div class="pane-wrapper"><div class="pane-title"><i class="' . $tab['icon'] . ' su-tab-icon"></i>' . $tab['title'] . '</div><div class="su-tabs-pane">' . $tab['content'] . '</div></div>';
			}
			$return = '<div class="su-tabs su-tabs-style-' . $style . '"><div class="su-tabs-nav">' . implode( '', $tabs ) . '<div class="su-tabs-nav-shadow"></div></div><div class="su-tabs-panes">' . implode( "\n", $panes ) . '</div><div class="clear"></div></div>';
		}

		// Unset globals
		unset( $GLOBALS['tabs'], $GLOBALS['tab_count'] );

		return $return;
	}

	/**
	 * Shortcode: tab
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_tab_shortcode( $atts, $content ) {
		extract( shortcode_atts( array( 'title' => 'Tab %d', 'icon' => '' ), $atts ) );
		$x = $GLOBALS['tab_count'];
		$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'icon' => $icon, 'content' => do_shortcode( $content ) );
		$GLOBALS['tab_count']++;
	}

	/**
	 * Shortcode: spoiler
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_spoiler_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'title' => __( 'Spoiler title', 'mnky-admin' ),
				'open' => false,
				'style' => 1,
				'color' => ''
				), $atts ) );

		$open_class = ( $open ) ? ' su-spoiler-open' : '';
		$open_display = ( $open ) ? ' style="display:block"' : '';

		return '<div class="su-spoiler su-spoiler-style-' . $style . $open_class . '"><div class="su-spoiler-title"><i class="moon-arrow-right-2 spoiler-button"></i><i class="moon-arrow-down spoiler-button spoiler-active"></i>' . $title . '</div><div class="su-spoiler-content"' . $open_display . '>' . su_do_shortcode( $content, 's' ) . '</div></div>';
	}

	/**
	 * Shortcode: accordion
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_accordion_shortcode( $atts = null, $content = null ) {

		return '<div class="su-accordion">' . su_do_shortcode( $content, 'a' ) . '</div>';
	}

	/**
	 * Shortcode: divider
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_divider_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'style' => 'default',
				'color' => '#E7E7E7'
				), $atts ) );

		if ($style == 'with-link-to-top'){
			$return = '<div class="divider" style="border-color:' . $color . ';"><a href="#top">' . __( 'Top', 'kickstart' ) . '</a></div>';
		} elseif ($style == 'with-bottom-pointer'){
			$return = '<div class="divider-arrow-down" style="background-color:' . $color . '; border-top-color:' . $color . ';"></div>';
		} elseif ($style == 'with-top-pointer'){
			$return = '<div class="divider-arrow-up" style="background-color:' . $color . '; border-bottom-color:' . $color . ';"></div>';
		} else {
			$return = '<div class="divider" style="border-color:' . $color . ';"></div>';
		};
		
		return $return;
	}
	
	/**
	 * Shortcode: spacer
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_spacer_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'size' => 0
				), $atts ) );

		return '<div class="spacer" style="height:' . $size . 'px"></div>';
	}

	/**
	 * Shortcode: highlight
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_highlight_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'bg' => '#fff287',
				'color' => '#000'
				), $atts ) );

		return '<span class="su-highlight" style="background:' . $bg . ';color:' . $color . '">&nbsp;' . $content . '&nbsp;</span>';
	}

	/**
	 * Shortcode: column
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_column_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'size' => '1-2',
				'last' => false
				), $atts ) );

		return ( $last ) ? '<div class="column column-' . $size . ' column-last">' . do_shortcode( $content ) . '</div><div class="clear"></div>' : '<div class="column column-' . $size . '">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 * Shortcode: quote
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_quote_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'style' => 1,
				'author' => ' Author Name'
				), $atts ) );

		return '<div class="su-quote"><i class="moon-quotes-left"></i><div class="su-quote-shell">' . do_shortcode( $content ) . '</div><div class="quote-author">' . $author . '</div></div>';
	}

	/**
	 * Shortcode: pullquote
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_pullquote_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'style' => 1,
				'align' => 'left'
				), $atts ) );

		return '<div class="su-pullquote su-pullquote-style-' . $style . ' su-pullquote-align-' . $align . '">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 * Shortcode: button
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_button_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'link' => '#',
				'color' => '',
				'icon' => '',
				'text' => 'light',
				'target' => false
				), $atts ) );

		$v_icon = ( $icon ) ? '<i class="' . $icon . '"></i>' : '';
		$text_color = ( $text == 'dark' ) ? 'dark-text' : '';

		$target = ( $target ) ? ' target="_' . $target . '"' : '';

		return '<a href="' . $link . '" class="su-button '. $text_color .'" ' . $target . ' style="background-color:'. $color .'">' . $v_icon . $content . '</a>';
	}

	/**
	 * Shortcode: fancy-link
	 *
	 * @param string $content
	 * @return string Output html
	 */
	function su_fancy_link_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'link_text' => 'Learn More',
				'url' => '#',
				'float' => 'left'
				), $atts ) );

		return '<a class="su-fancy-link" style="float:' . $float . '" href="' . $url . '">' . $link_text . '<span>&rsaquo;</span></a>';
	}

	/**
	 * Shortcode: box
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_box_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'color' => '#333',
				'title' => __( 'This is box title', 'mnky-admin' )
				), $atts ) );

		$styles = array(
			'dark_color' => su_hex_shift( $color, 'darker', 20 ),
			'text_color' => su_hex_shift( $color, 'darker', 60 ),
			'light_color' => su_hex_shift( $color, 'lighter', 60 ),
			'text_shadow' => su_hex_shift( $color, 'darker', 20 ),
			'extra_light_color' => su_hex_shift( $color, 'lighter', 80 ),
		);

		return '<div class="su-box"><div class="su-box-title" style="background-color:' . $color . '; text-shadow:1px 1px 0 ' . $styles['text_shadow'] . '">' . $title . '</div><div class="su-box-content"  style="color:' . $styles['text_color'] . '; background-color:' . $styles['extra_light_color'] . ';">' . do_shortcode( $content ) . '</div></div>';
	}

	/**
	 * Shortcode: note
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_note_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'color' => '#fc0'
				), $atts ) );

		$styles = array(
			'dark_color' => su_hex_shift( $color, 'darker', 20 ),
			'light_color' => su_hex_shift( $color, 'lighter', 10 ),
			'extra_light_color' => su_hex_shift( $color, 'lighter', 50 ),
			'text_color' => su_hex_shift( $color, 'darker', 60 )
		);

		return '<div class="su-note" style="background-color:' . $styles['light_color'] . ';border:1px solid ' . $styles['dark_color'] . '"><div class="su-note-shell" style="border:1px solid ' . $styles['extra_light_color'] . '; color:' . $styles['text_color'] . '">' . do_shortcode( $content ) . '</div></div>';
	}
	
	/**
	 * Shortcode: call out
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_callout_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'callout_icon' => 'moon-redo-2',
				'button_color' => '',
				'add_button' => 'no',
				'button_text' => 'Learn More',
				'button_icon' => '',
				'button_url' => '#'
				), $atts ) );
				
		if ($add_button == 'yes') { 
			$b_icon = ( $button_icon ) ? '<i class="' . $button_icon . '"></i>' : '';	
			$button = '<a href="' . $button_url . '" class="su-button callout-button" style="background-color:'. $button_color .'">' . $b_icon . $button_text . '</a>';
		} else { $button = ''; }			

		$return = '<div class="su-callout"><div class="callout-content">' . do_shortcode( $content ) .'</div>'. $button .'<div class="clear"></div></div>';
		
		return $return;
	}

	/**
	 * Shortcode: nivo_slider
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_nivo_slider_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'width' => 940,
				'height' => 300,
				'link' => false,
				'effect' => 'random',
				'navigation' => 1,
				'bullets' => 1,
				'pauseonhover' => 0,
				'speed' => 600,
				'delay' => 3000,
				'p' => false
				), $atts ) );

		global $post;
		$post_id = ( $p ) ? $p : $post->ID;

		$args = array(
			'post_type' => 'attachment',
			'numberposts' => -1,
			'order' => 'ASC',
			'post_status' => null,
			'post_parent' => $post_id
		);

		// Get attachments
		$attachments = get_posts( $args );

		// If has attachments
		if ( count( $attachments ) > 1 ) {
			$slider_id = uniqid( 'nivo-slider_' );
			$return = '<script type="text/javascript">
						jQuery(window).load(function() {
							jQuery("#' . $slider_id . '").nivoSlider({
								effect: "' . $effect . '",
								animSpeed: ' . $speed . ',
								directionNav: ' . $navigation . ',
								controlNav: ' . $bullets . ',
								pauseTime: ' . $delay . ',
								pauseOnHover: ' . $pauseonhover . ',
								afterLoad: function(){jQuery(".nivo-size-wrap").removeClass("nivo-loading");}
							});
						});
					</script>';
			$return .= '<div class="nivo-size-wrap nivo-loading" style="width:' . $width . 'px;"><div id="' . $slider_id . '" class="nivoSlider">';
			foreach ( $attachments as $attachment ) {

				$title = apply_filters( 'the_title', $attachment->post_title );
				$url = wp_get_attachment_image_src( $attachment->ID, 'full', false );
				$image = aq_resize( $url[0], $width, $height, true ); 

				// Link to file
				if ( $link == 'file' ) {
					$return .= '<a href="' . $url[0] . '" title=""><img src="' . $image . '" alt="' . $title . '" /></a>';
				}

				// Link to attachment page
				elseif ( $link == 'attachment' ) {
					$return .= '<a href="' . get_permalink( $attachment->ID ) . '"><img src="' . $image . '" alt="' . $title . '" /></a>';
				}

				// Custom link
				elseif ( $link == 'caption' ) {
					if ( $attachment->post_excerpt ) {
						$return .= '<a href="' . $attachment->post_excerpt . '" title=""><img src="' . $image . '" alt="' . $title . '" /></a>';
					} else {
						$return .= '<img src="' . $image . '" alt="' . $title . '" />';
					}
				}

				// No link
				else {
					$return .= '<img src="' . $image . '" alt="' . $title . '" />';
				}
			}
			$return .= '</div></div>';
		}

		// No attachments
		else {
			$return = '<p class="su-error"><strong>Nivo slider:</strong> ' . __( 'no attached images, or only one attached image', 'mnky-admin' ) . '&hellip;</p>';
		}
		return $return;
	}

	/**
	 * Shortcode: menu
	 *
	 * @param string $content
	 * @return string Output html
	 */
	function su_sitemap_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'name' => 1
				), $atts ) );

		$return = wp_nav_menu( array(
			'echo' => false,
			'menu' => $name,
			'container' => false,
			'menu_id' => 'sitemap_menu',
			'fallback_cb' => 'su_menu_shortcode_fb_cb'
			) );

		return ( $name ) ? $return : false;
	}

	/**
	 * Fallback callback function for menu shortcode
	 *
	 * @return string Text message
	 */
	function su_menu_shortcode_fb_cb() {
		return __( 'This menu doesn\'t exists, or has no elements', 'mnky-admin' );
	}

	/**
	 * Shortcode: document
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_document_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'width' => 600,
				'height' => 400,
				'file' => ''
				), $atts ) );

		return '<iframe src="http://docs.google.com/viewer?embedded=true&url=' . $file . '" width="' . $width . '" height="' . $height . '" class="su-document"></iframe>';
	}

	/**
	 * Shortcode: gmap
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_gmap_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'width' => 600,
				'height' => 400,
				'address' => 'New York'
				), $atts ) );

		return '<iframe style="margin-bottom:-5px;" width="' . $width . '" height="' . $height . '" src="http://maps.google.com/maps?q=' . urlencode( $address ) . '&amp;iwloc=near&amp;output=embed" class="su-gmap"></iframe>';
	}

	/**
	 * Shortcode: Featured post carousel
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_fp_carousel_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'width' => 1005,
				'height' => 130,
				'items' => 5,
				'margin' => 20,
				'speed' => 600,
				'post_type' => 'post',
				'cat' => null,
				'tag' => null,
				'include' => null,
				'exclude' => null,
				'num' => -1,
				'orderby' => 'date',
				'order' => 'DESC'
				), $atts ) );

	
		global $post;
		$args = array(
			'post_type' => $post_type,
			'category_name' => $cat,
			'tag' => $tag,
			'numberposts' => $num,
			'orderby' => $orderby,
			'include' => $include,
			'exclude' => $exclude,
			'order' => $order
		);
        $myposts = get_posts($args);

			$carousel_id = uniqid( 'su-fpcarousel_' );

			$item_width = round( ( $width - ( ( $items - 1 ) * $margin ) ) / $items );

			$return = '
				<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery("#' . $carousel_id . '").css("display","block");
						jQuery("#' . $carousel_id . '").jcarousel({
							auto: 2,
							scroll: 1,
							wrap: "last",
							animation: ' . $speed . ',
							initCallback: mycarousel_initCallback
						 });
					});
				</script>
			';	

			if (ot_get_option('responsive_layout') == 'responsive_mobile' || ot_get_option('responsive_layout') == 'responsive_all' ) {
			$return .='<style>
			@media only screen and (min-width: 480px) and (max-width: 767px) {
				.mobile-' . $carousel_id . '{
				height: ' . round($height*0.469-2) . 'px !important;
				width: ' . round($width*0.469-2) . 'px !important;
				}				
				.mobile-' . $carousel_id . ' img, .mobile-' . $carousel_id . ' .jcarousel-container li { 
				width: ' . round($item_width*0.469-2) . 'px !important;
				height: auto !important;
				}				
			}
			@media only screen and (max-width: 479px) {
				.mobile-' . $carousel_id . '{
				height: ' . round($height*0.3-2) . 'px !important;
				width: ' . round($width*0.3-2) . 'px !important;
				}				
				.mobile-' . $carousel_id . ' .jcarousel-list img, .mobile-' . $carousel_id . ' .jcarousel-container li { 
				width: ' . round($item_width*0.3-2) . 'px !important;
				height: auto !important;
				}
			}';
			}
			if (ot_get_option('responsive_layout') == 'responsive_all') {
				$return .='@media only screen and (min-width: 768px) and (max-width: 979px) {
				.mobile-' . $carousel_id . ', .mobile-' . $carousel_id . ' .jcarousel-container{
				height: ' . round($height*0.74+2) . 'px !important;
				width: ' . round($width*0.74+2) . 'px !important;
				}				
				.mobile-' . $carousel_id . ' img, .mobile-' . $carousel_id . ' .jcarousel-container li { 
				width: ' . round($item_width*0.74+2) . 'px !important;
				height: ' . round($height*0.74+2) . 'px !important;
				}				
			}</style>';
			} else { $return .='</style>';}

			$return .= '<div class="fp_carousel mobile-' . $carousel_id . '" style="width:' . $width . 'px; height:' . $height . 'px;"><div class="fp_carousel-shell"><ul id="' . $carousel_id . '" style="display:none;">';

			foreach($myposts as $post) :
                setup_postdata($post);
				global $more;
                $more = 0;
				
				if (strlen($post->post_title) > 30) {
				$title = substr(get_the_title($before = '', $after = '', FALSE), 0, 30) . '...'; } else {
				$title = get_the_title();}
				
				$url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				$image = aq_resize( $url[0], $item_width, $height, true ); 

				$return .= '<li style="width:' . $item_width . 'px; height:' . $height . 'px; margin-right:' . $margin . 'px">';

				$return .= '<img src="' . $image . '" width="' . $item_width . '" height="' . $height . '" alt="'. get_the_title() .'" />
				<a href="' . get_permalink() . '" title="'. get_the_title() .'"><div class="fp_mask"></div><div class="fp_title">'. $title .'</div></a>';
			
				$return .= '</li>';
			endforeach;
			wp_reset_query();

			$return .= '</ul></div></div>';

		return $return;
	}
	
	/**
	 * Shortcode: Post shortcode
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_show_posts_shortcode($atts) {
	extract( shortcode_atts( array(
				'category' => '',
				'tag' => '',
				'id' => '',
				'offset' => 0,
				'limit' => 3,
				'type' => 'excerpt',
				'excerpt_words' => 24,
				'orderby' => 'post_date',
				'order' => 'DESC',
				'post_type' => 'post',
				'paging' => false
				), $atts ) );

		$paged = get_query_var('paged') ? get_query_var('paged') : 1;  

		query_posts(  array ( 
			'posts_per_page' => $limit, 
			'tag' => $tag,
			'p' => $id,
			'category_name' => $category,
			'post_type' => $post_type, 
			'order' => $order, 
			'orderby' => $orderby,
			'offset' => $offset,			
			'paged' => $paged ) );

		global $more;
        $more = 0;
		$inner = '';
		$count = 0;
		
		while ( have_posts() ) : the_post();
		$count++;
		
		if( $count == 3  ){ 
			$add_class = 'column column-1-3 column-last';
			$count = 0;			
		} else {
			$add_class = 'column column-1-3';	
		}

				
			// Content
			if ( $type == 'excerpt' ) {
				$title = '<h2 class="post-title"><a href="'. get_permalink() .'">'.the_title("","",false).'</a></h2>';
				$meta = '<div class="blog-entry-date"><span>'. get_the_time('M') .'</span>'. get_the_time('j') .'</div>';
				$content = apply_filters('the_excerpt', get_excerpt($excerpt_words) );
				
				$output = '<div class="latest-blog-entry">'. $meta .'<div class="blog-entry-content">'. $title . $content . '</div></div>';
				$inner .= apply_filters( 'display_posts_shortcode_output', $output, $atts, $title, $meta, $content );
				
			} elseif ( $type == 'thumbnail-excerpt' ) {
				if ( has_post_format('video') ||  has_post_format('audio')) {
					$thumb = get_post_meta(get_the_ID(), 'post_embed', true);
				} elseif ( has_post_format('gallery')){
					$thumb = do_shortcode('[nivo_slider width="650" height="360" navigation="1" speed="900" delay="4000" bullets="0" effect="fade"]');
				} else {
					$large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' ); 
					$large_image = $large_image[0]; 
					$thumb = '<a href="'. get_permalink() .'"><img class="blog-entry-img" src="'. aq_resize( $large_image, '650', '360', true ) .'" /></a>';

				}
				
				$title = '<h2 class="post-title"><a href="'. get_permalink() .'">'.the_title("","",false).'</a></h2>';
				$content = apply_filters('the_excerpt', get_excerpt($excerpt_words) );
				
				$output = '<div class="latest-blog-entry-thumb '. $add_class .'">'. $thumb .'<div class="blog-entry-content">'. $title . $content . '</div></div>';
				$inner .= apply_filters( 'display_posts_shortcode_output', $output, $atts, $thumb, $title, $content );

			} else {
				ob_start(); 
				get_template_part( 'content', get_post_format() );
				$inner .= ob_get_contents();  
				ob_end_clean();
			}
				
		endwhile;
	
	if ( $paging == 'true') {
		ob_start();
		wp_pagenavi();
		$pagenavi = ob_get_contents();
		ob_end_clean();	
	} else { 
		$pagenavi = '';
	}
	
	wp_reset_query();
	
	if ( $type == 'thumbnail-excerpt' ) {
		$return = $inner .'<div class="clear"></div>'.  $pagenavi;
	} else { 
		$return = $inner . $pagenavi;
	}	

	return $return;

	}
	
	/**
	 * Shortcode: staff
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_staff_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'name' => 'Full Name',
				'position' => 'Job title',
				'img' => ''
				), $atts ) );
				
		$image = aq_resize( $img, 440, 300);		

		return '<div class="staff-wrapper"><img src="'. $image .'" alt=""/><div class="person-name">'. $name .'<i class="moon-users-2"></i></div><div class="person-title">' . $position .'</div><div class="person-description">'. do_shortcode( $content ) .'</div></div>';
	}
		
	/**
	 * Shortcode: skill
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_skillbar_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'title' => 'WordPress',
				'level' => '90'
				), $atts ) );		

		return '<div class="skillbar-title">'. $title . ' <span>'. $level .'%</span></div><div class="skillbar-wrapper" data-perc="'. $level .'"><div class="skillbar"></div></div>';
	}
	
	
	/**
	 * Shortcode: dropcap
	 */
	function su_dropcap_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'bg' => '#222',
		'color' => '#fff'
	), $atts));
	
		return '<span class="su-dropcap" style="background-color:' . $bg . '; color:' . $color . ';">'. $content .'</span>';
	}
	
	/**
	 * Shortcode: list
	 */
	function su_list_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'icon' => '',
		'color' => ''
	), $atts));
	
		return '<div class="custom-list"><i class="'. $icon .'" style="color:'. $color .';"></i>' . do_shortcode( $content ) . '</div>';
	}

	
	/**
	 * Div clear - shortcode
	 */
	function su_clear_shortcode() {
		 return '<div class="clear"></div>';
	}
	
		
	/**
	 * Break - shortcode
	 */
	function break_shortcode() {
		 return '<br />';
	}
	add_shortcode('br', 'break_shortcode');
	
	/**
	 * Shortcode: Pricing box
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function su_pricing_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'color' => '#2b2b2b',
				'currency' => '$',
				'price' => 10,
				'period' => '/mo',
				'slug' => '',
				'title' => __( 'This is title', 'mnky-admin' )
				), $atts ) );

		$styles = array(
			'dark_color' => su_hex_shift( $color, 'darker', 20 ),
			'extra_light_color' => su_hex_shift( $color, 'lighter', 50 ),
		);
		
		$return = '<div class="pricing-box-wrapper">';
		
		$return .= '<div class="pricing-box-header" style="background-color:' . $color . '"><h3 class="pricing-box-title" style="border-color: ' . $styles['dark_color'] . ';"> ' . $title . '</h3>';
		
		$return .= '<span class="pricing-box-currency">' . $currency . '</span>
		<span class="pricing-box-value">'. $price . '</span>
		<span class="pricing-box-period">' . $period . '</span>
		<div class="pricing-box-info" style="color: ' . $styles['extra_light_color'] . ';">' . $slug . '</div>
		</div>';
		
		$return .= '<div class="pricing-box-content">' . do_shortcode( $content ) . '</div>';
		
		$return .= '</div>';
		

		return $return;
	}
?>