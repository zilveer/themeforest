<?php

if ( !function_exists( 'mysite_slider_module' ) ) :
/**
 *
 */
function mysite_slider_module() {
	global $mysite;
	
	$slider_page = apply_filters( 'mysite_slider_page', mysite_get_setting( 'slider_page' ) );
	$mobile_slider = apply_filters( 'mysite_mobile_slider', mysite_get_setting( 'mobile_slider' ) );
	
	if( ( !is_front_page() && !$slider_page ) || ( is_front_page() && mysite_get_setting( 'home_slider_disable' ) != false ) || ( isset( $mysite->mobile ) && $mobile_slider == 'disable_slider' ) )
		return;
	
	$out = '';
	$slider = '';
	
	# Custom Moblie Content
	if( isset( $mysite->mobile ) && $mobile_slider == 'custom_content' ) {
		$slider .= mysite_get_setting( 'mobile_slider_custom' );
		if( !empty( $slider ) )
			$out .= '<div class="mobile_slider_content">' . do_shortcode( $slider ) . '</div>';
			
		echo apply_atomic( 'slider', $out );
		return;
	}
	
	$slider_type = apply_filters( 'mysite_slider_type', mysite_get_setting( 'homepage_slider' ) );
	if( isset( $mysite->mobile ) && $mobile_slider == 'default_slider' )
		$slider_type = 'responsive_slider';
	
	$slider_custom = mysite_get_setting( 'slider_custom' );
	
	if( $slider_custom == 'categories' )
		$slider_setting = mysite_category_slider();
	else
		$slider_setting = mysite_get_setting( 'slideshow' );
		
	$slider_setting = apply_filters('mysite_slider_settings', $slider_setting );
	
	if( $slider_type == 'fading_slider' )
		$slider = mysite_fading( $slider_type, $slider_setting );
		
	elseif( $slider_type == 'scrolling_slider' )
		$slider = mysite_scrolling( $slider_type, $slider_setting );
		
	elseif( $slider_type == 'nivo_slider' )
		$slider = mysite_nivo( $slider_type, $slider_setting );
		
	elseif( $slider_type == 'responsive_slider' )
		$slider = mysite_responsive( $slider_type, $slider_setting );
		
	if( !empty( $slider ) ) {
		$out .= '<div id="slider_module">';
		$out .= '<div id="slider_module_inner">';
		
		$out .= $slider;
		
		$out .= '<div class="clearboth"></div>';
		$out .= '</div>';
		$out .= '</div>';
	}
	
	echo apply_atomic( 'slider', $out );
}
endif;

if ( !function_exists( 'mysite_category_slider' ) ) :
/**
 *
 */
function mysite_category_slider() {
	global $post, $wpdb;
	$slider_settings = array();
	$counter = 0;
	
	$slider_count = 4;
	$slider_cats = mysite_get_setting( 'slider_cats' );
	$slider_cat_count = mysite_get_setting( 'slider_cat_count' );
	$slider_showcats = join( ',', $slider_cats );
	$slider_keys = array();
	
	$slider_count = ( is_numeric( $slider_cat_count ) ) ? $slider_cat_count : 5;
	$cat_slider_query = new WP_Query("cat={$slider_showcats}&showposts={$slider_count}");
	
	if( $cat_slider_query->have_posts() ) : while( $cat_slider_query->have_posts() ) : $cat_slider_query->the_post();
	
	$_homepage_image = get_post_meta( $post->ID, '_homepage_image', true );
	$_homepage_slider_stage = get_post_meta( $post->ID, '_homepage_slider_stage', true );
	$_homepage_disable_excerpt = get_post_meta( $post->ID, '_homepage_disable_excerpt', true );
	
	if( $_homepage_image || $_homepage_slider_stage == 'raw_html' ) {
		$slider_settings[$counter]['slider_url'] = esc_url( $_homepage_image );
		$slider_settings[$counter]['alt_attr'] = esc_attr( get_the_title() );
		$slider_settings[$counter]['stage_effect'] =  ( !empty( $_homepage_slider_stage ) ) ? $_homepage_slider_stage : 'staged_slide';
		$slider_settings[$counter]['link_url'] = esc_url( get_permalink() );
		$slider_keys = array_merge( $slider_keys, array( (int)$counter ) );
		
		if( !$_homepage_disable_excerpt && $_homepage_slider_stage != 'raw_html' ) {
			$slider_settings[$counter]['description'] = mysite_excerpt( get_the_excerpt(), apply_filters( 'mysite_cat_slider_excerpt_length', 100 ), apply_filters( 'mysite_cat_slider_excerpt_ellipsis', ' ... ' ) );
			$slider_settings[$counter]['title'] = get_the_title();
			$slider_settings[$counter]['read_more'] = false;
		} else {
			$slider_settings[$counter]['read_more'] = true;
		}
		
		if( $_homepage_slider_stage == 'raw_html' )
			$slider_settings[$counter]['description'] = get_the_excerpt();
		
		$counter++;
	}
	endwhile; endif;
	
	$slider_keys = array_merge( $slider_keys, array( '#' ) );
	$slider_settings['slider_keys'] = join( ',', $slider_keys );
	
	wp_reset_query();
	
	return $slider_settings;
}
endif;

if ( !function_exists( 'mysite_fading' ) ) :
/**
 *
 */
function mysite_fading( $slider_type, $slider ) {
	global $mysite;
	
	$img_sizes = $mysite->layout['images_slider'];
	$slider_keys = explode(',', $slider['slider_keys']);
		
	$out = '<div class="mysite_preloader_large" style="text-align:center;">';
	$out .= '<img src="' . esc_url( THEME_IMAGES_ASSETS . '/transparent.gif' ) . '" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloader.png);">';
	$out .= '</div>';
	
	$out .= '<div id="mysite_fading_slider">';
	$out .= '<div id="fading_slides" class="noscript">';
	
	foreach ( $slider_keys as $key ) {
		if( $key != '#' ) {
			$stage_effect = $slider[$key]['stage_effect'];
			$slide_img = esc_url( $slider[$key]['slider_url'] );
			$img_alt = !empty( $slider[$key]['alt_attr'] ) ? esc_attr( $slider[$key]['alt_attr'] ) : '';
			$slide_content = stripslashes( $slider[$key]['description'] );
			$slider_title = stripslashes( $slider[$key]['title'] );
			$link_url = esc_url( $slider[$key]['link_url'] );
			$disable_read_more = ( !empty( $slider[$key]['read_more'] ) ) ? $slider[$key]['read_more'] : '';
			
			if( ( !empty( $slide_img ) ) || ( $stage_effect == 'raw_html' ) ) {
				
				if ( $stage_effect == 'floating_slide' )
					$img = array( 'w' => $img_sizes['floating_slide'][0], 'h' => $img_sizes['floating_slide'][1] );
					
				elseif( $stage_effect == 'staged_slide' )
					$img = array( 'w' => $img_sizes['staged_slide'][0], 'h' => $img_sizes['staged_slide'][1] );

				elseif( $stage_effect == 'partial_staged_slide' || $stage_effect == 'partial_staged_slideL' )
					$img = array( 'w' => $img_sizes['partial_staged_slide'][0], 'h' => $img_sizes['partial_staged_slide'][1] );

				elseif( $stage_effect == 'partial_gradient_slide' )
					$img = array( 'w' => $img_sizes['partial_gradient_slide'][0], 'h' => $img_sizes['partial_gradient_slide'][1] );
					
				elseif( $stage_effect == 'overlay_slide' )
					$img = array( 'w' => $img_sizes['overlay_slide'][0], 'h' => $img_sizes['overlay_slide'][1] );

				elseif( $stage_effect == 'full_slide' )
					$img = array( 'w' => $img_sizes['full_slide'][0], 'h' => $img_sizes['full_slide'][1] );
					
				else
					$img = array( 'w' => '', 'h' => '' );
					
				# YouTube or Vimeo
				$video = mysite_video( $args = array( 'url' => $slide_img ) );

				$out .= '<div class="single_fading_slide ' . $stage_effect . ( $video ? ' ' . $video . '_slide' : '' ) . '">';

				# Slider image
				if( preg_match_all( '!.+\.(?:jpe?g|png|gif)!Ui', $slide_img, $matches )) {
					if( !empty( $link_url ) )
					{
						$out .= '<div class="positioning">';
						$out .= mysite_display_image(
								array(
									'src' => $slide_img,
									'alt' => $img_alt,
									'class' => 'slide_image',
									'height' => $img['h'],
									'width' => $img['w'],
									'link_to' => $link_url,
									'link_class' =>'load_slide_image',
									'preload' => true,
									'no_preload_img' => true
								));
						$out .= '</div><!-- .positioning .slide_image -->';
					}
					else
					{
						$out .= '<div class="positioning load_slide_image">';
						$out .= mysite_display_image(
								array(
									'src' => $slide_img,
									'alt' => $img_alt,
									'class' => 'slide_image',
									'height' => $img['h'],
									'width' => $img['w'],
									'preload' => true,
									'no_preload_img' => true
								));
						$out .= '</div><!-- .positioning .slide_image -->';
					}
				}
				
				# YouTube or Vimeo
				$video = mysite_video( $args = array( 'url' => $slide_img, 'width' => $img['w'], 'height' => $img['h'], 'parse' => true, 'video_controls' => '' ) );
				
				if( $video )
					$out .= '<div class="positioning">' . $video . '</div>';
				
				# Slider content
				if( ( !empty( $slider_title ) ) || ( !empty( $slide_content ) ) || ( !empty( $link_url ) ) && ( empty( $disable_read_more ) ) ) {
					$out .= '<div class="slide_content">';

					if( !empty( $slider_title ) )
						$out .= '<h2 class="slide_title">' . do_shortcode( $slider_title ) . '</h2>';

					if( !empty( $slide_content ) && $stage_effect != 'raw_html' )
						$out .= '<p>' . do_shortcode( $slide_content ) . '</p>';
						
					if( !empty( $slide_content ) && $stage_effect == 'raw_html' )
						$out .= do_shortcode( $slide_content );

					if( ( !empty( $link_url ) ) && ( empty( $disable_read_more ) ) )
						$out .= '<p><a href="' . $link_url . '" class="button_link hover_fade"><span>' . __( 'Read More', MYSITE_TEXTDOMAIN ) . '</span></a></p>';

					$out .= '</div><!-- .slide_content -->';
				}
				
				if( $stage_effect != 'raw_html' )
					$out .= '<div class="slide_overlay' . ( $video ? ' video_overlay' : '' ) . '"></div>';

				$out .= '</div><!-- .single_fading_slide -->';
			}
		}
	}
	$out .= '</div><!-- #fading_slides -->';
	
	# Slider nav
	$nav = apply_filters('mysite_slider_nav', mysite_get_setting( 'slider_nav' ) );
	
	$out .= '<div class="slider_nav noscript"' . ( count($slider_keys) == 2 ? ' style="display:none;"' : '' ) . '>';
	
	foreach ( $slider_keys as $key ) {
		
		if( $key != '#' && ( !empty( $slide_img ) || $stage_effect == 'raw_html' ) ) {

			$slide_img = $slider[$key]['slider_url'];
			
			if( $nav == 'thumb' )
				$out .= mysite_display_image( array( 'src' => $slide_img, 'link_to' => '#', 'alt' => '', 'width' => $img_sizes['nav_thumbs'][0], 'height' => $img_sizes['nav_thumbs'][1] ) );
			
			elseif( $nav == 'dots' )
				$out .= '<a href="#"></a>';
		}
		
	}
	$out .= '</div><!-- .slider_nav -->';
	
	$out .= '</div><!-- #mysite_fading_slider -->';
	
	mysite_slider_script( $slider_type );
	
	return $out;
}
endif;

if ( !function_exists( 'mysite_scrolling' ) ) :
/**
 *
 */
function mysite_scrolling( $slider_type, $slider ) {
	global $mysite;
	
	$img_sizes = $mysite->layout['images_slider'];
	$slider_keys = explode(',', $slider['slider_keys']);
	
	$out = '<div class="mysite_preloader_large" style="text-align:center;">';
	$out .= '<img src="' . esc_url( THEME_IMAGES_ASSETS . '/transparent.gif' ) . '" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloader.png);">';
	$out .= '</div>';
	
	$out .='<div id="mysite_scrolling_slider">';
	$out .='<div id="scrolling_slides" class="noscript">';
	
	foreach ( $slider_keys as $key ) {
		if( $key != '#' ) {
			$stage_effect = $slider[$key]['stage_effect'];
			$slide_img = esc_url( $slider[$key]['slider_url'] );
			$img_alt = !empty( $slider[$key]['alt_attr'] ) ? esc_attr( $slider[$key]['alt_attr'] ) : '';
			$slide_content = stripslashes( $slider[$key]['description'] );
			$slider_title = stripslashes( $slider[$key]['title'] );
			$link_url = esc_url( $slider[$key]['link_url'] );
			$disable_read_more = ( !empty( $slider[$key]['read_more'] ) ) ? $slider[$key]['read_more'] : '';
			
			if ( $stage_effect == 'floating_slide' )
				$img = array( 'w' => $img_sizes['floating_slide'][0], 'h' => $img_sizes['floating_slide'][1] );
				
			elseif( $stage_effect == 'staged_slide' )
				$img = array( 'w' => $img_sizes['staged_slide'][0], 'h' => $img_sizes['staged_slide'][1] );

			elseif( $stage_effect == 'partial_staged_slide' || $stage_effect == 'partial_staged_slideL' )
				$img = array( 'w' => $img_sizes['partial_staged_slide'][0], 'h' => $img_sizes['partial_staged_slide'][1] );

			elseif( $stage_effect == 'partial_gradient_slide' )
				$img = array( 'w' => $img_sizes['partial_gradient_slide'][0], 'h' => $img_sizes['partial_gradient_slide'][1] );
				
			elseif( $stage_effect == 'overlay_slide' )
				$img = array( 'w' => $img_sizes['overlay_slide'][0], 'h' => $img_sizes['overlay_slide'][1] );

			elseif( $stage_effect == 'full_slide' )
				$img = array( 'w' => $img_sizes['full_slide'][0], 'h' => $img_sizes['full_slide'][1] );
				
			else
				$img = array( 'w' => '', 'h' => '' );
				
			$out .= '<div class="single_scrolling_slide ' . $stage_effect . '">';
			
			# Slider image
			if( preg_match_all( '!.+\.(?:jpe?g|png|gif)!Ui', $slide_img, $matches )) {
				if( !empty( $link_url ) )
				{
					$out .= '<div class="positioning">';
					$out .= mysite_display_image(
							array(
								'src' => $slide_img,
								'alt' => $img_alt,
								'class' => 'slide_image',
								'height' => $img['h'],
								'width' => $img['w'],
								'link_to' => $link_url,
								'link_class' =>'load_slide_image',
								'preload' => true,
								'no_preload_img' => true
							));
					$out .= '</div><!-- .positioning .slide_image -->';
				}
				else
				{
					$out .= '<div class="positioning load_slide_image">';
					$out .= mysite_display_image(
							array(
								'src' => $slide_img,
								'alt' => $img_alt,
								'class' => 'slide_image',
								'height' => $img['h'],
								'width' => $img['w'],
								'preload' => true,
								'no_preload_img' => true
							));
					$out .= '</div><!-- .positioning .slide_image -->';
				}
			}
			
			# YouTube or Vimeo
			$video = mysite_video( $args = array( 'url' => $slide_img, 'width' => $img['w'], 'height' => $img['h'], 'parse' => true, 'video_controls' => '' ) );
			
			if( $video )
				$out .= '<div class="positioning">' . $video . '</div>';
			
			# Slider content
			if( ( !empty( $slider_title ) ) || ( !empty( $slide_content ) ) || ( !empty( $link_url ) ) && ( empty( $disable_read_more ) ) ) {
				$out .= '<div class="slide_content">';

				if( !empty( $slider_title ) )
					$out .= '<h2 class="slide_title">' . do_shortcode( $slider_title ) . '</h2>';

				if( !empty( $slide_content ) && $stage_effect != 'raw_html' )
					$out .= '<p>' . do_shortcode( $slide_content ) . '</p>';
					
				if( !empty( $slide_content ) && $stage_effect == 'raw_html' )
					$out .= do_shortcode( $slide_content );

				if( ( !empty( $link_url ) ) && ( empty( $disable_read_more ) ) )
					$out .= '<p><a href="' . $link_url . '" class="button_link hover_fade"><span>' . __( 'Read More', MYSITE_TEXTDOMAIN ) . '</span></a></p>';

				$out .= '</div><!-- .slide_content -->';
			}
			
			if( $stage_effect != 'raw_html' )
				$out .= '<div class="slide_overlay' . ( $video ? ' video_overlay' : '' ) . '"></div>';
			
			$out .= '</div><!-- .single_scrolling_slide -->';
		}
	}
	$out .= '</div><!-- #scrolling_slides -->';
	
	$nav = apply_filters('mysite_slider_nav', mysite_get_setting( 'slider_nav' ) );
	
	$out .= '<div class="navi slider_nav noscript">';

	foreach ( $slider_keys as $key ) {

		if( $key != '#' && ( !empty( $slide_img ) || $stage_effect == 'raw_html' ) ) {

			$slide_img = $slider[$key]['slider_url'];

			if( $nav == 'thumb' )
				$out .= mysite_display_image( array( 'src' => $slide_img, 'alt' => '', 'width' => $img_sizes['nav_thumbs'][0], 'height' => $img_sizes['nav_thumbs'][1], 'link_to' => '#', 'link_class' => ( $key == 1 ? 'scrollable_nav current' : 'scrollable_nav' ) ) );

			elseif( $nav == 'dots' )
				$out .= '<a href="#" class="scrollable_nav' . ( $key == 1 ? ' current' : '' ) . '"></a>';
		}
	}
	$out .= '</div><!-- .slider_nav -->';
	
	$out .= '</div><!-- #mysite_scrolling_slider -->';
	
	mysite_slider_script( $slider_type );
	
	return $out;
}
endif;

if ( !function_exists( 'mysite_nivo' ) ) :
/**
 *
 */
function mysite_nivo( $slider_type, $slider ) {
	global $mysite;
	
	$img_sizes = $mysite->layout['images_slider'];
	$slider_keys = explode(',', $slider['slider_keys']);
	
	$img = array( 'w' => $img_sizes['nivo_slide'][0], 'h' => $img_sizes['nivo_slide'][1] );
		
	$out = '<div class="mysite_preloader_large" style="text-align:center;">';
	$out .= '<img src="' . THEME_IMAGES_ASSETS . '/transparent.gif" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloader.png);">';
	$out .= '</div>';
	
	$out .='<div id="mysite_nivo_slider">';
	$out .='<div id="nivo_slider" class="noscript">';
	
	foreach ( $slider_keys as $key ) {

		if( $key != '#' ) {
			$slide_img = esc_url( $slider[$key]['slider_url'] );
			$img_alt = !empty( $slider[$key]['alt_attr'] ) ? esc_attr( $slider[$key]['alt_attr'] ) : '';
			
			if( preg_match_all( '!.+\.(?:jpe?g|png|gif)!Ui', $slide_img, $matches ) ) {
				
				$title = ( !empty( $slider[$key]['title'] ) ) ? $slider[$key]['title'] : '';
				$description = ( !empty( $slider[$key]['description'] ) ) ? $slider[$key]['description'] : '';
				
				if ( !empty( $slider[$key]['link_url'] ) )
					$out .= '<a href = "'.$slider[$key]['link_url'].'">';
					
				$out .= '<span>';
				
				if( !empty( $title ) || !empty( $description ) )
					$out .= mysite_display_image( array( 'src' => $slide_img, 'title' => '#htmlcaption_' . $key, 'alt' => $img_alt, 'height' => $img['h'], 'width' => $img['w'] ) );
				else
					$out .= mysite_display_image( array( 'src' => $slide_img, 'alt' => $img_alt, 'height' => $img['h'], 'width' => $img['w'] ) );
				
				$out .= '</span>';
				
				if ( !empty( $slider[$key]['link_url'] ) )
					$out .= '</a>';
			}
		}
	}
	
	$out .= '</div><!-- #nivo_slider -->';
	
	$out .= '</div><!-- #mysite_nivo_slider -->';
	
	foreach ( $slider_keys as $key ) {
		$title = ( !empty( $slider[$key]['title'] ) ) ? stripslashes( $slider[$key]['title'] ) : '';
		$description = ( !empty( $slider[$key]['description'] ) ) ? stripslashes( $slider[$key]['description'] ) : '';
		
		if( !empty( $title ) || !empty( $description ) ) {
			$out .= '<div id="htmlcaption_' . $key . '" class="nivo-html-caption">';
			
			if( !empty( $title ) )
				$out .= $title . ' ';
				
			if( !empty( $description ) )
				$out .= $description;
			
			$out .= '</div>';
		}
	}
	
	mysite_slider_script( $slider_type );
	
	return $out;
}
endif;

if ( !function_exists( 'mysite_responsive' ) ) :
/**
 *
 */
function mysite_responsive( $slider_type, $slider ) {
	global $mysite;
	
	# Static responsive slider content
	$responsive_slider_content = trim( apply_filters('mysite_responsive_slider_content', mysite_get_setting( 'static_slider_content_text' ) ) );
	$responsive_content_float = apply_filters('mysite_responsive_content_float', mysite_get_setting( 'static_slider_content' ) );
	
	$img_sizes = $mysite->layout['images_slider'];
	$slider_keys = explode(',', $slider['slider_keys']);
	$img_layout = ( !empty( $responsive_slider_content ) ? 'partial_staged_slide' : 'responsive_slide' );
	
	$out = '<div class="mysite_preloader_large" style="text-align:center;">';
	$out .= '<img src="' . THEME_IMAGES_ASSETS . '/transparent.gif" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloader.png);">';
	$out .= '</div>';
	
	$out .= '<div id="mysite_flexslider" class="noscript">';
	$out .= '<div class="flexslider">';
	$out .= '<ul class="slides">';
	
	foreach ( $slider_keys as $key ) {
		if( $key != '#' ) {
			$slide_img = esc_url( $slider[$key]['slider_url'] );
			$img_alt = !empty( $slider[$key]['alt_attr'] ) ? esc_attr( $slider[$key]['alt_attr'] ) : '';
			$slide_content = stripslashes( $slider[$key]['description'] );
			$link_url = esc_url( $slider[$key]['link_url'] );
			
			if( !empty( $slide_img ) ) {
				# Image sizes
				$img = array( 'w' => $img_sizes[$img_layout][0], 'h' => $img_sizes[$img_layout][1] );
				
				# YouTube or Vimeo
				$video = mysite_video( $args = array( 'url' => $slide_img ) );
				
				$out .= '<li class="single_responsive_slide' . ( $video ? ' ' . $video . '_slide' : '' ) . '">';
				
				# Slider image
				if( preg_match_all( '!.+\.(?:jpe?g|png|gif)!Ui', $slide_img, $matches )) {
					if( !empty( $link_url ) )
					{
						$out .= mysite_display_image(
								array(
									'src' => $slide_img,
									'alt' => $img_alt,
									'class' => 'slide_image',
									'height' => $img['h'],
									'width' => $img['w'],
									'link_to' => $link_url,
									'link_class' =>'load_slide_image',
									'preload' => true,
									'no_preload_img' => true
								));
					}
					else
					{
						$out .= '<div class="load_slide_image">';
						$out .= mysite_display_image(
								array(
									'src' => $slide_img,
									'alt' => $img_alt,
									'class' => 'slide_image',
									'height' => $img['h'],
									'width' => $img['w'],
									'preload' => true,
									'no_preload_img' => true
								));
						$out .= '</div><!-- .slide_image -->';
					}
				}
				
				# YouTube or Vimeo
				$video = mysite_video( $args = array( 'url' => $slide_img, 'width' => $img['w'], 'height' => $img['h'], 'parse' => true, 'video_controls' => '' ) );
				
				if( $video )
					$out .= $video;
				
				# Slider content
				if( !empty( $slide_content ) )
					$out .= '<p class="flex-caption">' . strip_shortcodes( $slide_content ) . '</p>';

				$out .= '</li>';
			}
		}
	}
		
	$out .= '</ul>';
	$out .= '</div>';
	
	if( !empty( $responsive_slider_content ) )
		$out .= '<div class="flexslider_content">' . do_shortcode( $responsive_slider_content ) . '</div>';
	
	$out .= '</div>'; # end #mysite_flexslider
	
	mysite_slider_script( $slider_type );
	
	return $out;
}
endif;

if ( !function_exists( 'mysite_slider_script' ) ) :
/**
 *
 */
function mysite_slider_script( $slider_type ) {
	
	$defaults = array(
		'slider_disable_trans' => mysite_get_setting( 'slider_disable_trans' ), // true | false
		'slider_speed' => mysite_get_setting( 'slider_speed' ), // 2000 milli
		'hover_pause' => ( mysite_get_setting( 'slider_hover_pause' ) ? 'false' : 'true' ) // true | fasle
	);
	
	$args = wp_parse_args( apply_filters( 'mysite_slider_options', '' ), $defaults );

	extract( $args );
		
	if( $slider_type == 'nivo_slider' )
		$disable_trans = ( !empty( $slider_disable_trans ) ) ? 'true' : 'false';

	else
		$disable_trans = ( !empty( $slider_disable_trans ) ) ? 'false' : 'true';
		
	if( $slider_type != 'nivo_slider' && $disable_trans == 'false' )
		$hover_pause = 'false';
		
?><script type="text/javascript">
/* <![CDATA[ */


jQuery(document).ready(function(){
	
	// Add class nopreload to all images in 'slide_content' div
	if( jQuery('.slide_content').length>0 ) {
		jQuery('.slide_content').find('img').addClass('nopreload');
	}
	
	<?php
	switch ( $slider_type ) {
		case 'fading_slider': ?>
		jQuery('#fading_slides').preloader({
			imgAppend: '.load_slide_image',
			fade: false,
			slider: true,
			beforeShowAll: function(){
				jQuery('#fading_slides').find('.video_frame iframe').css('display','none')
			},
			onDone: function(){
				jQuery('#slider_module .mysite_preloader_large').remove();
				jQuery('.slider_nav').tabs('#fading_slides > div.single_fading_slide', {
					effect: 'fade',
					fadeInSpeed: '<?php echo mysite_get_setting( 'slider_fade_speed' ); ?>',
					rotate: true,
					onBeforeClick : function(event,index) {
						if(this.getPanes().eq(index).children().eq(0).find('.vimeo_video').length>0) {
							var vimeo_video = this.getPanes().eq(index).children().eq(0).find('.vimeo_video').parent().html();
							this.getPanes().eq(index).children().eq(0).find('.vimeo_video').parent().empty().html(vimeo_video);
							jQuery('.vimeo_video').each(function(index, vimeo_video){
								Froogaloop.init([vimeo_video]);
					            vimeo_video.addEvent('onLoad', VimeoEmbed.vimeo_player_loaded);
					        });
						}
						if(this.getPanes().eq(index).children().eq(0).find('.youtube_video').length>0) {
							var vimeo_video = this.getPanes().eq(index).children().eq(0).find('.youtube_video').parent().html();
							this.getPanes().eq(index).children().eq(0).find('.youtube_video').parent().empty().html(vimeo_video);
							jQuery('.youtube_video').each(function(index, youtube_video){
								onYouTubePlayerAPIReady(youtube_video.id);
							});
						}
						_class = this.getPanes().eq(index).attr('class');
						jQuery('#slider_module_inner').removeClass();
						jQuery('#slider_module_inner').addClass( _class.replace('single_fading_slide ', '') );

						if(this.getPanes().eq(index).children().eq(0).find('.vimeo_video').length>0 && typeof navScript != 'undefined'){
							setTimeout(function(){
							    jQuery('.slider_nav_thumb .slider_nav').animate({opacity:0},300);
								jQuery('.slider_nav_thumb .slider_nav').animate({height:'0px'},300);
							  }, 1000 );
						}
					},
					onClick : function(event,index) {}

				}).slideshow({clickable:false, autoplay:<?php echo $disable_trans; ?>, interval:<?php echo $slider_speed; ?>, autopause:<?php echo $hover_pause; ?>});
				jQuery('#fading_slides').removeClass('noscript');
				jQuery('.slider_nav').removeClass('noscript');
				jQuery('#fading_slides').find('.video_frame iframe').css('display','block')
			}
		});

		<?php break; ?>
	<?php case 'scrolling_slider': ?>

		jQuery('#scrolling_slides').preloader({
			imgAppend: '.load_slide_image',
			fade: false,
			slider: true,
			onDone: function(){
				jQuery('#slider_module .mysite_preloader_large').remove();
				var initClass = jQuery('#scrolling_slides').children().eq(0).attr('class');
				jQuery('#slider_module_inner').addClass( initClass.replace('single_scrolling_slide ', '') );

				jQuery("#mysite_scrolling_slider").scrollable({
					items: '#scrolling_slides',
					size: 1,
					clickable: false,
					circular: true,
					onBeforeSeek : function(event,index) {
						if( index != this.getSize() ) {
							_class = this.getItems().eq(index).attr('class');
							jQuery('#slider_module_inner').removeClass();
							jQuery('#slider_module_inner').addClass( _class.replace('single_scrolling_slide ', '') );

							if(this.getItems().eq(index).children().eq(0).find('.vimeo_video').length>0 && typeof navScript != 'undefined'){
								setTimeout(function(){
								    jQuery('.slider_nav_thumb .slider_nav').animate({opacity:0},300);
									jQuery('.slider_nav_thumb .slider_nav').animate({height:'0px'},300);
								  }, 1000 );
							}
						}
					},
					onSeek : function(event,index) {}
				}).autoscroll({autoplay:<?php echo $disable_trans; ?>, interval:<?php echo $slider_speed; ?>, autopause:<?php echo $hover_pause; ?>}).navigator({naviItem:'.scrollable_nav',api: true,activeClass:'current'});
				jQuery('#scrolling_slides').removeClass('noscript');
				jQuery('.slider_nav').removeClass('noscript');
			}
		});
	
	<?php break; ?>
<?php case 'nivo_slider': ?>

	<?php
	$get_nivo_effect = mysite_get_setting( 'nivo_effect' );
	$get_nivo_slices = mysite_get_setting( 'nivo_slices' );
	$get_nivo_anim_speed = mysite_get_setting( 'nivo_anim_speed' );
	$get_nivo_control_nav = mysite_get_setting( 'nivo_control_nav' );
	$get_nivo_direction_nav = mysite_get_setting( 'nivo_direction_nav' );
	$get_disable_cufon = mysite_get_setting( 'disable_cufon' );
	
	$defaults = array(
		'nivo_effect' => ( !empty( $get_nivo_effect ) ? $get_nivo_effect : 'sliceDown' ),
		'nivo_slices' => ( !empty( $get_nivo_slices ) ? $get_nivo_slices : '10' ),
		'nivo_anim_speed' => ( !empty( $get_nivo_anim_speed ) ? $get_nivo_anim_speed : '500' ),
		'nivo_control_nav' => ( !empty( $get_nivo_control_nav ) ? 'true' : 'false' ),
		'get_nivo_direction_nav' => $get_nivo_direction_nav, // button, button_hover, disable
		'nivo_caption' => ( empty( $get_disable_cufon ) ? "Cufon.replace('.nivo-caption');" : '' )
		
	);
	
	$args = wp_parse_args( apply_filters( 'mysite_nivo_options', '' ), $defaults );

	extract( $args );
	
	if( $get_nivo_direction_nav == 'button' ) {
		$nivo_direction_nav = 'true';
		$nivo_direction_nav_hide = 'false';
		
	} elseif( $get_nivo_direction_nav == 'button_hover' ) {
		$nivo_direction_nav = 'true';
		$nivo_direction_nav_hide = 'true';
		
	} elseif( $get_nivo_direction_nav == 'disable') {
		$nivo_direction_nav = 'false';
		$nivo_direction_nav_hide = 'false';
	}
	?>

	jQuery('#nivo_slider').nivoSlider({
		effect:'<?php echo $nivo_effect; ?>',
		slices:<?php echo $nivo_slices; ?>,
		animSpeed:<?php echo $nivo_anim_speed; ?>, //Slide transition speed
		pauseTime:<?php echo $slider_speed; ?>,
		directionNav:<?php echo $nivo_direction_nav; ?>, //Next & Prev
		directionNavHide:<?php echo $nivo_direction_nav_hide; ?>, //Only show on hover
		controlNav:<?php echo $nivo_control_nav; ?>, //1,2,3...
		keyboardNav:false, //Use left & right arrows
		pauseOnHover:<?php echo $hover_pause; ?>, //Stop animation while hovering
		manualAdvance:<?php echo $disable_trans; ?>, //Force manual transitions
		customChange: function(){ <?php echo $nivo_caption; ?> },
		afterLoad: function(){
			jQuery('#slider_module .mysite_preloader_large').remove();
			jQuery('#nivo_slider').removeClass('noscript');
		}
	});
	
	<?php break; ?>
<?php case 'responsive_slider': ?>

	<?php
	$get_responsive_effect = mysite_get_setting( 'responsive_effect' );
	$get_responsive_direction = mysite_get_setting( 'responsive_direction' );
	$get_responsive_anim_speed = mysite_get_setting( 'responsive_anim_speed' );
	$get_responsive_direction_nav = mysite_get_setting( 'responsive_direction_nav' );
	$get_responsive_dots_nav = mysite_get_setting( 'responsive_dots_nav' );
	$get_responsive_randomize = mysite_get_setting( 'responsive_randomize' );
	$get_responsive_slider_transitions = mysite_get_setting( 'responsive_slider_transitions' );
	
	$defaults = array(
		'responsive_effect' => ( !empty( $get_responsive_effect ) ? $get_responsive_effect : 'fade' ),
		'responsive_direction' => ( !empty( $get_responsive_direction ) ? $get_responsive_direction : 'horizontal' ),
		'responsive_anim_speed' => ( !empty( $get_responsive_anim_speed ) ? $get_responsive_anim_speed : '600' ),
		'responsive_direction_nav' => ( !empty( $get_responsive_direction_nav ) ? 'false' : 'true' ),
		'responsive_dots_nav' => ( !empty( $get_responsive_dots_nav ) ? 'false' : 'true' ),
		'responsive_randomize' => ( !empty( $get_responsive_randomize ) ? 'true' : 'false' ),
		'responsive_slider_transitions' => ( !empty( $get_responsive_slider_transitions ) ? 'false' : 'true' ),
	);
	
	$args = wp_parse_args( apply_filters( 'mysite_responsive_options', '' ), $defaults );

	extract( $args );
	?>
	
	jQuery('.flexslider').preloader({
		imgAppend: '.load_slide_image',
		fade: false,
		slider: true,
		onDone: function(){
			jQuery('.flexslider').fitVids().flexslider({
				animation: '<?php echo $responsive_effect; ?>',
				slideDirection: '<?php echo $responsive_direction; ?>',
				slideshow: <?php echo $disable_trans; ?>,
				slideshowSpeed: <?php echo $slider_speed; ?>,
				animationDuration: <?php echo $responsive_anim_speed; ?>,
				directionNav: <?php echo $responsive_direction_nav; ?>,
				controlNav: <?php echo $responsive_dots_nav; ?>,
				randomize: <?php echo $responsive_randomize; ?>,
				animationLoop: <?php echo $responsive_slider_transitions; ?>,
				pauseOnHover: <?php echo $hover_pause; ?>,
				before: function(slider){
					/*
					var slideFirst = slider.find('.slides li:first'),
						slide = slider.find('.slides li:visible').next();
					*/
				},
			});

			jQuery('#slider_module .mysite_preloader_large').remove();
			jQuery('#mysite_flexslider').removeClass('noscript');
		}
	});

	<?php break; ?>
<?php } ?>

});
/* ]]> */
</script>
<?php
do_action( 'mysite_after_slider_script' );
}
endif;

?>