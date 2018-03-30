<?php

/*-----------------------------------------------------------------------------------*/
/* Output CSS to a file called custom.php */
/*-----------------------------------------------------------------------------------*/

function eq_custom_css() {
	
	$body_bg_img = of_get_option( 'alt_pattern', 'scan-lines.png' );
	$body_background = of_get_option( 'body_bg', array( 'color' => '#ffffff', 'image' => '', 'repeat' => 'repeat', 'position' => 'top left', 'attachment' => 'scroll' ) );
		
	$output = "<?php header('Content-type: text/css'); ?>"; //set the appropriate content type for the file that is going to containt the custom css.
    $output .= "/*\tCustom Styles";
	$output .= "\n\t....................................................................................................................................... */\n";
	$output .= "\n\t";
	
	//set body background color and background image if defined; otherwise, set the background pattern
	if( $body_background ) {
		
		if ( $body_bg_img !== 'none' ) {
			$output .= "html body { background: " . $body_background['color'] . " url('../images/layout/" . $body_bg_img . "') repeat left top; }";
		}
		elseif ( $body_background['image'] && $body_background['color'] ) {
			$output .= "html body { background: " . $body_background['color'] . " url('" . $body_background['image'] . "') " . $body_background['repeat'] . ' ' . $body_background['position'] . ' ' . $body_background['attachment'] . '; }';
		}
		elseif ( $body_background['image'] ) {
			$output .= "html body { background: url('" . $body_background['image'] . "') " . $body_background['repeat'] . ' ' . $body_background['position'] . ' ' . $body_background['attachment'] . '; }';	
		}
		else { // only color
			$output .= "html body { background: " . $body_background['color'] . '; }';
		}
		
	}
		
	// Output styles
	if ( $output <> '' ) {
		//get the absolute path to the file
		$file = get_theme_root() . '/' . get_template() . '/styles/custom.php';
		
		// Write the contents to the file 
		file_put_contents( $file, $output );
	}
}


/*-----------------------------------------------------------------------------------*/
/* Output Javascript/jQuery slides options to a file */
/*-----------------------------------------------------------------------------------*/

function eq_process_homepage_slider_options() {
	
	$output = "<?php header('Content-type: text/javascript'); ?>"; //set the appropriate content type for the file that is going to containt the custom javascript.
   
	$slider_type = of_get_option( 'slider_type', 'fade' );
	$transition_speed = intval( of_get_option( 'transition_speed', '5000' ) );
	$slider_pause = intval( of_get_option( 'slider_pause', '2500' ) );
	$pause_enabled = ( intval( of_get_option( 'pause_enabled', '1') ) ) ? true : false;
	$pagination_disabled = ( intval( of_get_option( 'disable_pagination', '0' ) ) ) ? false : true;
	$random_slides = ( intval( of_get_option( 'randomize', '0' ) ) ) ? true : false;
	$fade_speed = intval( of_get_option( 'fade_speed', '350' ) );
	$slide_speed = intval( of_get_option( 'slide_speed', '350' ) );
	$auto_height = ( intval( of_get_option( 'auto_height_enabled', '0' ) ) ) ? true : false;
	$auto_height_speed = intval( of_get_option( 'auto_height_speed', '350' ) );
	
	$output .= "jQuery(document).ready(function( $ ) { ";
	$output .= "$(\"#slides\").slides({ ";	
	$output .= 'preload: true, ';
	$output .= "preloadImage: \"" . get_template_directory_uri() . '/images/layout/loading.gif' . "\", ";
	$output .= 'play: ' . json_encode( intval( $transition_speed ) ) . ', ' . 
			   'pause: ' . json_encode( intval( $slider_pause ) ) . ', ' . 
			   "slideEasing: 'easeOutSine', " .
			   "fadeEasing: 'easeOutSine', " . 
			   'hoverPause: ' . json_encode( $pause_enabled ) . ', ' . 
			   "container: 'slides-container'" . ', ' . 
			   'pagination: ' . json_encode( $pagination_disabled ) . ', ' . 
			   'generatePagination: ' . json_encode( $pagination_disabled ) . ', ' . 
			   'fadeSpeed: ' . json_encode( intval( $fade_speed ) ) . ', ' . 
			   'slideSpeed: ' . json_encode( intval( $slide_speed ) ) . ', ' .  
			   'autoHeight: ' . json_encode( $auto_height ) . ', ' . 
			   'autoHeightSpeed: ' . json_encode( intval( $auto_height_speed ) ) . ', ' . 
			   'effect: ' . json_encode( $slider_type ) . ', ' .  
			   'crossfade: true' . ', ' . 
			   'randomize: '  . json_encode( $random_slides ) . ', ' . 
			   'start: 1';
	$output .= '});});';
	
	// Output styles
	if ( $output <> '' ) {
		//get the absolute path to the file
		$file = get_theme_root() . '/' . get_template() . '/js/jquery.homepage.slider.options.php';
		
		// Write the contents to the file 
		file_put_contents( $file, $output );
	}
}



/*-----------------------------------------------------------------------------------*/
/* Output Javascript/jQuery portfolio slider options to a file */
/*-----------------------------------------------------------------------------------*/

function eq_process_portfolio_slider_options() {
	
	$output = "<?php header('Content-type: text/javascript'); ?>"; //set the appropriate content type for the file that is going to containt the custom javascript.
   
	$slider_type = of_get_option( 'pf_slider_type', 'slide' );
	$transition_speed = intval ( of_get_option( 'pf_transition_speed', '0' ) );
	$slider_pause = intval ( of_get_option( 'pf_slider_pause', '2500' ) );
	$pause_enabled = ( intval ( of_get_option( 'pf_pause_enabled', '1' ) ) ) ? true : false;
	$pagination_disabled = ( intval ( of_get_option( 'pf_disable_pagination', '0' ) ) ) ? false : true;
	$random_slides = ( intval ( of_get_option( 'pf_randomize', '0' ) ) ) ? true : false;
	$fade_speed = intval ( of_get_option( 'pf_fade_speed', '350' ) );
	$slide_speed = intval (of_get_option( 'pf_slide_speed', '350' ) );
	$auto_height = true;
	$auto_height_speed = intval ( of_get_option( 'pf_auto_height_speed', '350' ) );
	
	$output .= "jQuery(document).ready(function( $ ) { ";
	$output .= "$(\"#slides\").slides({ ";	
	$output .= 'preload: true, ';
	$output .= "preloadImage: \"" . get_template_directory_uri() . '/images/layout/loading.gif' . "\", ";
	$output .= 'play: ' . json_encode( intval( $transition_speed ) ) . ', ' . 
			   'pause: ' . json_encode( intval( $slider_pause ) ) . ', ' .  
			   "slideEasing: 'easeOutSine', " .
			   "fadeEasing: 'easeOutSine', " . 
			   'hoverPause: ' . json_encode( $pause_enabled ) . ', ' . 
			   "container: 'slides-container'" . ', ' . 
			   'pagination: ' . json_encode( $pagination_disabled ) . ', ' . 
			   'generatePagination: ' . json_encode( $pagination_disabled ) . ', ' . 
			   'fadeSpeed: ' . json_encode( intval( $fade_speed ) ) . ', ' . 
			   'slideSpeed: ' . json_encode ( intval( $slide_speed ) ) . ', ' .  
			   'autoHeight: ' . json_encode( $auto_height ) . ', ' . 
			   'autoHeightSpeed: ' . json_encode( intval( $auto_height_speed ) ) . ', ' . 
			   'effect: ' . json_encode( $slider_type ) . ', ' .  
			   'crossfade: true' . ', ' . 
			   'randomize: '  . json_encode( $random_slides ) . ', ' . 
			   'start: 1';
	$output .= '});});';
	
	// Output styles
	if ( $output <> '' ) {
		//get the absolute path to the file
		$file = get_theme_root() . '/' . get_template() . '/js/jquery.portfolio.slider.options.php';
		
		// Write the contents to the file 
		file_put_contents( $file, $output );
	}
}


/*-----------------------------------------------------------------------------------*/
/* Output Javascript/jQuery pretty photo options to a file							 */
/*-----------------------------------------------------------------------------------*/

function eq_process_lightbox_options() {
	
		$output = "<?php header('Content-type: text/javascript'); ?>"; //Set the appropriate content type for the file.
	   
		$animation_speed = of_get_option( 'pp_animation_speed', 'fast' );
		$slideshow_enabled = ( intval( of_get_option( 'pp_slideshow_enabled', '0' ) ) ) ? true : false;
		$slideshow_speed = of_get_option( 'pp_slideshow_speed', '1500' );
		$autoplay_slideshow = ( intval( of_get_option( 'pp_autoplay_slideshow', '0' ) ) ) ? true : false;
		$titles_shown = ( intval( of_get_option( 'pp_titles_shown', '0' ) ) ) ? true : false;
		$resize_allowed = ( intval( of_get_option( 'pp_resize_allowed', '1' ) ) ) ? true : false;
		$default_width = of_get_option( 'pp_default_width', '500' );
		$default_height = of_get_option( 'pp_default_height', '344' );
		$theme = of_get_option( 'pp_theme', 'pp_default' );
		$autoplay_videos = ( intval( of_get_option( 'pp_autoplay_videos', '1') ) ) ? true : false;
		$modal = ( intval( of_get_option( 'pp_modal', '0' ) ) ) ? true : false;
		$overlay_gallery = ( intval( of_get_option( 'pp_overlay_gallery', '1' ) ) ) ? true : false;
		$social_tools_disabled = ( intval( of_get_option( 'pp_sociables', '0' ) ) ) ? false : '<div class="pp_social"><div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="http://www.facebook.com/plugins/like.php?locale=en_US&href=' . '+location.href+' . '&amp;layout=button_count&amp;show_faces=true&amp;width=500&amp;action=like&amp;font&amp;colorscheme=light&amp;height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div></div>';
		
		$slideshow = false;
		
		//if slideshow is enabled, set the speed of the slideshow
		if( $slideshow_enabled ) {
			$slideshow = $slideshow_speed;
		}
				
		$output .= "(function($) { ";
		$output .= "$(\"a[rel^='prettyPhoto']\").prettyPhoto({ ";
		$output .= 'animation_speed: ' . json_encode( $animation_speed ) . ', ' . 
				   'slideshow: ' . json_encode( $slideshow ) . ', ' . 
				   'autoplay_slideshow: ' . json_encode( $autoplay_slideshow ) . ', ' . 
				   'opacity: 0.55' . ', ' .
				   'deeplinking: false' . ', ' . // Disable deeplinking to avoid problems with QuickSand’s sorting
				   'show_title: ' . json_encode( $titles_shown ) . ', ' . 
				   'allow_resize: ' . json_encode( $resize_allowed ) . ', ' .
				   'default_width: ' . json_encode( intval( $default_width ) ) . ', ' . 
				   'default_height: ' . json_encode( intval( $default_height ) ) . ', ' .
				   "counter_separator_label: '/'" . ', ' .
				   "theme: " . json_encode( $theme ) .  ', ' .
				   'autoplay: ' . json_encode( $autoplay_videos ) . ', ' .
				   'modal: ' . json_encode( $modal ) . ', ' . 
				   'overlay_gallery: ' . json_encode( $overlay_gallery ) . ', ' .
				   'social_tools: '  . json_encode( $social_tools_disabled ) . ', ';	       	
				   
		$output .= 'keyboard_shortcuts: true' .  
				   '});' .
				   '})( jQuery );';
		
		// Output styles
		if ($output <> '') {
			//get the absolute path to the file
			$file = get_theme_root() . '/' . get_template() . '/js/jquery.pretty.photo.options.php';
			
			// Write the contents to the file
			$saved_content = file_put_contents( $file, $output );
			return $saved_content;
		}
}

?>