<?php

/*-----------------------------------------------------------------------------------*/
/* 1. Shortcodes  */
/*-----------------------------------------------------------------------------------*/

// Enable shortcodes in widget areas
add_filter( 'widget_text', 'do_shortcode' );

// Add stylesheet for shortcodes to HEAD (added to HEAD in admin-functions.php)
if ( !function_exists( 'tmnf_shortcode_stylesheet' ) AND get_option( 'themnific_disable_shortcodes') != "true" ) {
	function tmnf_shortcode_stylesheet() {
		echo "<!-- Themnific Shortcodes CSS -->\n";
		echo '<link href="'. get_template_directory_uri() . '/functions/css/shortcodes.css" rel="stylesheet" type="text/css" />'."\n\n";
	}
}


/*-----------------------------------------------------------------------------------*/
/* 1.1 Output shortcode JS in footer */
/*-----------------------------------------------------------------------------------*/

// Enqueue shortcode JS file.

add_action( 'init', 'tmnf_enqueue_shortcode_js' );

function tmnf_enqueue_shortcode_js () {

	if ( is_admin() ) {} else {
		wp_enqueue_script( 'tmnf-shortcodes', get_template_directory_uri() . '/functions/js/shortcodes.js','','', true, array( 'jquery', 'jquery-ui-tabs' ), true );
	} // End IF Statement

} // End tmnf_enqueue_shortcode_js()

// Check if option to output shortcode JS is active
if (!function_exists( "tmnf_check_shortcode_js")) {
	function tmnf_check_shortcode_js($shortcode) {
	   	$js = get_option( "tmnf_sc_js" );
	   	if ( !$js )
	   		tmnf_add_shortcode_js($shortcode);
	   	else {
	   		if ( !in_array($shortcode, $js) ) {
		   		$js[] = $shortcode;
	   			update_option( "tmnf_sc_js", $js);
	   		}
	   	}
	}
}

// Add option to handle JS output
if (!function_exists( "tmnf_add_shortcode_js")) {
	function tmnf_add_shortcode_js($shortcode) {
		$update = array();
		$update[] = $shortcode;
		update_option( "tmnf_sc_js", $update);
	}
}

// Output queued shortcode JS in footer
if (!function_exists( "tmnf_output_shortcode_js")) {
	function tmnf_output_shortcode_js() {
		$option = get_option( 'tmnf_sc_js' );
		if ( $option ) {

			// Toggle JS output
			if ( in_array( 'toggle', $option) ) {

			   	$output = '
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery( ".tmnf-sc-toggle-box").hide();
		jQuery( ".tmnf-sc-toggle-trigger").click(function() {
			jQuery(this).next( ".tmnf-sc-toggle-box").slideToggle(400);
		});
	});
</script>
';
				echo $output;
			}

			// Reset option
			delete_option( 'tmnf_sc_js' );
		}
	}
}
add_action( 'wp_footer', 'tmnf_output_shortcode_js' );

/*-----------------------------------------------------------------------------------*/
/* 2. Boxes - box
/*-----------------------------------------------------------------------------------*/
/*

Optional arguments:
 - type: info, alert, tick, download, note
 - size: medium, large
 - style: rounded
 - border: none, full
 - icon: none OR full URL to a custom icon

*/
function tmnf_shortcode_box($atts, $content = null) {
   extract(shortcode_atts(array(	'type' => 'normal',
   									'size' => '',
   									'style' => '',
   									'border' => '',
   									'icon' => ''), $atts));

   	$custom = '';
   	if ( $icon == "none" )
   		$custom = ' style="padding-left:15px;background-image:none;"';
   	elseif ( $icon )
   		$custom = ' style="padding-left:50px;background-image:url( '.$icon.' ); background-repeat:no-repeat; background-position:20px 45%;"';


   	return '<div class="tmnf-sc-box '.$type.' '.$size.' '.$style.' '.$border.'"'.$custom.'>' . do_shortcode( tmnf_sc_formatting($content) ) . '</div>';
}
add_shortcode( 'box', 'tmnf_shortcode_box' );

/*-----------------------------------------------------------------------------------*/
/* 3. Buttons - button
/*-----------------------------------------------------------------------------------*/
/*

Optional arguments:
 - size: small, large
 - style: info, alert, tick, download, note
 - color: red, green, black, grey OR custom hex color (e.g #000000)
 - border: border color (e.g. red or #000000)
 - text: black (for light color background on button)
 - class: custom class
 - link: button link (e.g http://www.google.com)
 - window: true/false

*/
function tmnf_shortcode_button($atts, $content = null) {
   	extract(shortcode_atts(array(	'size' => '',
   									'style' => '',
   									'bg_color' => '',
   									'color' => '',
   									'border' => '',
   									'text' => '',
   									'class' => '',
   									'link' => '#',
   									'window' => ''), $atts));


   	// Set custom background and border color
   	$color_output = '';
   	if ( $color ) {

   		if ( 	$color == "red" OR
   			 	$color == "orange" OR
   			 	$color == "green" OR
   			 	$color == "aqua" OR
   			 	$color == "teal" OR
   			 	$color == "purple" OR
   			 	$color == "pink" OR
   			 	$color == "silver"
   			 	 ) {
	   		$class .= " ".$color;

   		} else {
		   	if ( $border )
		   		$border_out = $border;
		   	else
		   		$border_out = $color;

	   		$color_output = 'style="background:'.$color.';border-color:'.$border_out.'"';

	   		// add custom class
	   		$class .= " custom";
   		}

   	} else {

   		if ( $border )
		   		$border_out = $border;
		   	else
		   		$border_out = $bg_color;

	   		$color_output = 'style="background:'.$bg_color.';border-color:'.$border_out.'"';

	   		// add custom class
	   		$class .= " custom";

   	} // End IF Statement

	$class_output = '';

	// Set text color
	if ( $text )
		$class_output .= ' dark';

	// Set class
	if ( $class )
		$class_output .= ' '.$class;

	// Set Size
	if ( $size )
		$class_output .= ' '.$size;

	if ( $window )
		$window = 'target="_blank" ';


   	$output = '<a '.$window.'href="'.$link.'" class="tmnf-sc-button'.$class_output.'" '.$color_output.'><span class="tmnf-'.$style.'">' . tmnf_sc_formatting($content) . '</span></a>';
   	return $output;
}
add_shortcode( 'button', 'tmnf_shortcode_button' );



/*-----------------------------------------------------------------------------------*/
/* 5. Tweetmeme button - tweetmeme
/*-----------------------------------------------------------------------------------*/
/*

Source: http://help.tweetmeme.com/2009/04/06/tweetmeme-button/

Optional arguments:
 - link: specify URL directly
 - style: compact
 - source: username
 - float: none, left, right (default: left)

*/
function tmnf_shortcode_tweetmeme($atts, $content = null) {
   	extract(shortcode_atts(array(	'link' => '',
   									'style' => '',
   									'source' => '',
   									'float' => 'left'), $atts));
	$output = '';

	if ( $link == '' ) {
		global $post;
		$link = get_permalink( $post->ID );
	}

	if ( $link )
		$output .= "tweetmeme_url = '".$link."';";

	if ( $style )
		$output .= "tweetmeme_style = 'compact';";

	if ( $source )
		$output .= "tweetmeme_source = '".$source."';";

	if ( $link OR $style )
		$output = '<script type="text/javascript">'.$output.'</script>';

	$output .= '<div class="tmnf-tweetmeme '.$float.'"><script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script></div>';
	return $output;

}
add_shortcode( 'tweetmeme', 'tmnf_shortcode_tweetmeme' );

/*-----------------------------------------------------------------------------------*/
/* 6. Twitter button - twitter
/*-----------------------------------------------------------------------------------*/
/*

Source: http://twitter.com/goodies/tweetbutton

Optional arguments:
 - style: vertical, horizontal, none ( default: vertical )
 - url: specify URL directly
 - source: username to mention in tweet
 - related: related account
 - text: optional tweet text (default: title of page)
 - float: none, left, right (default: left)
 - lang: fr, de, es, js (default: english)
 - use_post_url: automatically retrieve the URL to the specific post (useful on archive screens)
*/
function tmnf_shortcode_twitter($atts, $content = null) {
   	global $post;
   	extract(shortcode_atts(array(	'url' => '',
   									'style' => 'vertical',
   									'source' => '',
   									'text' => '',
   									'related' => '',
   									'lang' => '',
   									'float' => 'left', 
   									'use_post_url' => 'false' ), $atts));
	$output = '';

	if ( $url )
		$output .= ' data-url="'.$url.'"';

	if ( $source )
		$output .= ' data-via="'.$source.'"';

	if ( $text )
		$output .= ' data-text="'.$text.'"';

	if ( $related )
		$output .= ' data-related="'.$related.'"';

	if ( $lang )
		$output .= ' data-lang="'.$lang.'"';
		
	if ( $use_post_url == 'true' && $url == '' ) {
		$output .= ' data-url="' . get_permalink( $post->ID ) . '"';
	}

	$output = '<div class="tmnf-sc-twitter '.$float.'"><a href="http://twitter.com/share" class="twitter-share-button"'.$output.' data-count="'.$style.'">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>';
	return $output;

}
add_shortcode( 'twitter', 'tmnf_shortcode_twitter' );

/*-----------------------------------------------------------------------------------*/
/* 7. Digg Button - digg
/*-----------------------------------------------------------------------------------*/
/*

Source: http://about.digg.com/button

Optional arguments:
 - link: specify URL directly
 - title: specify a title (must add link also)
 - style: medium, large, compact, icon (default: medium)
 - float: none, left, right (default: left)
*/
function tmnf_shortcode_digg($atts, $content = null) {
   	extract(shortcode_atts(array(	'link' => '',
   									'title' => '',
   									'style' => 'medium',
   									'float' => 'left' ), $atts));
	$output = "
	<script type=\"text/javascript\">
	(function() {
	var s = document.createElement( 'SCRIPT'), s1 = document.getElementsByTagName( 'SCRIPT')[0];
	s.type = 'text/javascript';
	s.async = true;
	s.src = 'http://widgets.digg.com/buttons.js';
	s1.parentNode.insertBefore(s, s1);
	})();
	</script>
	";

	// Add custom URL
	if ( $link ) {
		// Add custom title
		if ( $title )
			$title = '&amp;title='.urlencode( $title );

		$link = ' href="http://digg.com/submit?url='.urlencode( $link ).$title.'"';
	}

	if ( $link == '' ) {
		global $post;
		$link = get_permalink( $post->ID );
	}

	if ( $style == "large" )
		$style = "Large";
	elseif ( $style == "compact" )
		$style = "Compact";
	elseif ( $style == "icon" )
		$style = "Icon";
	else
		$style = "Medium";

	$output .= '<div class="tmnf-digg '.$float.'"><a class="DiggThisButton Digg'.$style.'"'.$link.'></a></div>';
	return $output;

}
add_shortcode( 'digg', 'tmnf_shortcode_digg' );


/*-----------------------------------------------------------------------------------*/
/* 8. Facebook Like Button - fblike
/*-----------------------------------------------------------------------------------*/
/*

Source: http://developers.facebook.com/docs/reference/plugins/like

Optional arguments:
 - float: none (default), left, right
 - url: link you want to share (default: current post ID)
 - style: standard (default), button
 - showfaces: true or false (default)
 - width: 450
 - verb: like (default) or recommend
 - colorscheme: light (default), dark
 - font: arial (default), lucida grande, segoe ui, tahoma, trebuchet ms, verdana

*/
function tmnf_shortcode_fblike($atts, $content = null) {
   	extract(shortcode_atts(array(	'float' => 'none',
   									'url' => '',
   									'style' => 'standard',
   									'showfaces' => 'false',
   									'width' => '450',
   									'verb' => 'like',
   									'colorscheme' => 'light',
   									'font' => 'arial'), $atts));

	global $post;

	if ( ! $post ) {

		$post = new stdClass();
		$post->ID = 0;

	} // End IF Statement

	$allowed_styles = array( 'standard', 'button_count', 'box_count' );

	if ( ! in_array( $style, $allowed_styles ) ) { $style = 'standard'; } // End IF Statement

	if ( !$url )
		$url = get_permalink($post->ID);

	$height = '60';
	if ( $showfaces == 'true')
		$height = '100';

	if ( ! $width || ! is_numeric( $width ) ) { $width = 450; } // End IF Statement

	switch ( $float ) {

		case 'left':

			$float = 'fl';

		break;

		case 'right':

			$float = 'fr';

		break;

		default:
		break;

	} // End SWITCH Statement

	$output = '
<div class="tmnf-fblike '.$float.'">
<iframe src="http://www.facebook.com/plugins/like.php?href='.$url.'&amp;layout='.$style.'&amp;show_faces='.$showfaces.'&amp;width='.$width.'&amp;action='.$verb.'&amp;colorscheme='.$colorscheme.'&amp;font=' . $font . '" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:'.$width.'px; height:'.$height.'px"></iframe>
</div>
	';
	return $output;

}
add_shortcode( 'fblike', 'tmnf_shortcode_fblike' );


/*-----------------------------------------------------------------------------------*/
/* 9. Columns
/*-----------------------------------------------------------------------------------*/
/*

Description:

Columns are named with this convention Xcol_Y where X is the total number of columns and Y is
the number of columns you want this column to span. Add _last behind the shortcode if it is the
last column.

*/

/* ============= Two Columns ============= */

function tmnf_shortcode_twocol_one($atts, $content = null) {
   return '<div class="twocol-one">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'twocol_one', 'tmnf_shortcode_twocol_one' );

function tmnf_shortcode_twocol_one_last($atts, $content = null) {
   return '<div class="twocol-one last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'twocol_one_last', 'tmnf_shortcode_twocol_one_last' );


/* ============= Three Columns ============= */

function tmnf_shortcode_threecol_one($atts, $content = null) {
   return '<div class="threecol-one">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'threecol_one', 'tmnf_shortcode_threecol_one' );

function tmnf_shortcode_threecol_one_last($atts, $content = null) {
   return '<div class="threecol-one last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'threecol_one_last', 'tmnf_shortcode_threecol_one_last' );

function tmnf_shortcode_threecol_two($atts, $content = null) {
   return '<div class="threecol-two">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'threecol_two', 'tmnf_shortcode_threecol_two' );

function tmnf_shortcode_threecol_two_last($atts, $content = null) {
   return '<div class="threecol-two last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'threecol_two_last', 'tmnf_shortcode_threecol_two_last' );

/* ============= Four Columns ============= */

function tmnf_shortcode_fourcol_one($atts, $content = null) {
   return '<div class="fourcol-one">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fourcol_one', 'tmnf_shortcode_fourcol_one' );

function tmnf_shortcode_fourcol_one_last($atts, $content = null) {
   return '<div class="fourcol-one last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fourcol_one_last', 'tmnf_shortcode_fourcol_one_last' );

function tmnf_shortcode_fourcol_two($atts, $content = null) {
   return '<div class="fourcol-two">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fourcol_two', 'tmnf_shortcode_fourcol_two' );

function tmnf_shortcode_fourcol_two_last($atts, $content = null) {
   return '<div class="fourcol-two last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fourcol_two_last', 'tmnf_shortcode_fourcol_two_last' );

function tmnf_shortcode_fourcol_three($atts, $content = null) {
   return '<div class="fourcol-three">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fourcol_three', 'tmnf_shortcode_fourcol_three' );

function tmnf_shortcode_fourcol_three_last($atts, $content = null) {
   return '<div class="fourcol-three last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fourcol_three_last', 'tmnf_shortcode_fourcol_three_last' );

/* ============= Five Columns ============= */

function tmnf_shortcode_fivecol_one($atts, $content = null) {
   return '<div class="fivecol-one">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fivecol_one', 'tmnf_shortcode_fivecol_one' );

function tmnf_shortcode_fivecol_one_last($atts, $content = null) {
   return '<div class="fivecol-one last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fivecol_one_last', 'tmnf_shortcode_fivecol_one_last' );

function tmnf_shortcode_fivecol_two($atts, $content = null) {
   return '<div class="fivecol-two">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fivecol_two', 'tmnf_shortcode_fivecol_two' );

function tmnf_shortcode_fivecol_two_last($atts, $content = null) {
   return '<div class="fivecol-two last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fivecol_two_last', 'tmnf_shortcode_fivecol_two_last' );

function tmnf_shortcode_fivecol_three($atts, $content = null) {
   return '<div class="fivecol-three">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fivecol_three', 'tmnf_shortcode_fivecol_three' );

function tmnf_shortcode_fivecol_three_last($atts, $content = null) {
   return '<div class="fivecol-three last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fivecol_three_last', 'tmnf_shortcode_fivecol_three_last' );

function tmnf_shortcode_fivecol_four($atts, $content = null) {
   return '<div class="fivecol-four">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fivecol_four', 'tmnf_shortcode_fivecol_four' );

function tmnf_shortcode_fivecol_four_last($atts, $content = null) {
   return '<div class="fivecol-four last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'fivecol_four_last', 'tmnf_shortcode_fivecol_four_last' );


/* ============= Six Columns ============= */

function tmnf_shortcode_sixcol_one($atts, $content = null) {
   return '<div class="sixcol-one">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'sixcol_one', 'tmnf_shortcode_sixcol_one' );

function tmnf_shortcode_sixcol_one_last($atts, $content = null) {
   return '<div class="sixcol-one last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'sixcol_one_last', 'tmnf_shortcode_sixcol_one_last' );

function tmnf_shortcode_sixcol_two($atts, $content = null) {
   return '<div class="sixcol-two">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'sixcol_two', 'tmnf_shortcode_sixcol_two' );

function tmnf_shortcode_sixcol_two_last($atts, $content = null) {
   return '<div class="sixcol-two last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'sixcol_two_last', 'tmnf_shortcode_sixcol_two_last' );

function tmnf_shortcode_sixcol_three($atts, $content = null) {
   return '<div class="sixcol-three">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'sixcol_three', 'tmnf_shortcode_sixcol_three' );

function tmnf_shortcode_sixcol_three_last($atts, $content = null) {
   return '<div class="sixcol-three last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'sixcol_three_last', 'tmnf_shortcode_sixcol_three_last' );

function tmnf_shortcode_sixcol_four($atts, $content = null) {
   return '<div class="sixcol-four">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'sixcol_four', 'tmnf_shortcode_sixcol_four' );

function tmnf_shortcode_sixcol_four_last($atts, $content = null) {
   return '<div class="sixcol-four last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'sixcol_four_last', 'tmnf_shortcode_sixcol_four_last' );

function tmnf_shortcode_sixcol_five($atts, $content = null) {
   return '<div class="sixcol-five">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'sixcol_five', 'tmnf_shortcode_sixcol_five' );

function tmnf_shortcode_sixcol_five_last($atts, $content = null) {
   return '<div class="sixcol-five last">' . tmnf_sc_formatting($content) . '</div>';
}
add_shortcode( 'sixcol_five_last', 'tmnf_shortcode_sixcol_five_last' );


/*-----------------------------------------------------------------------------------*/
/* 10. Horizontal Rule / Divider - hr - divider
/*-----------------------------------------------------------------------------------*/
/*

Description: Use to separate text.

*/
function tmnf_shortcode_hr($atts, $content = null) {
   return '<div class="tmnf-sc-hr"></div>';
}
add_shortcode( 'hr', 'tmnf_shortcode_hr' );

function tmnf_shortcode_divider($atts, $content = null) {
   return '<div class="hrlineB"></div>';
}
add_shortcode( 'divider', 'tmnf_shortcode_divider' );

function tmnf_shortcode_divider_flat($atts, $content = null) {
   return '<div class="hrline"></div>';
}
add_shortcode( 'divider_flat', 'tmnf_shortcode_divider_flat' );


/*-----------------------------------------------------------------------------------*/
/* 11. Quote - quote
/*-----------------------------------------------------------------------------------*/
/*

Optional arguments:
 - style: boxed
 - float: left, right

*/
function tmnf_shortcode_quote($atts, $content = null) {
   	extract(shortcode_atts(array(	'style' => '',
   									'float' => ''), $atts));
   $class = '';
   if ( $style )
   		$class .= ' '.$style;
   if ( $float )
   		$class .= ' '.$float;

   return '<div class="tmnf-sc-quote' . $class . '"><p>' . tmnf_sc_formatting($content) . '</p></div>';
}
add_shortcode( 'quote', 'tmnf_shortcode_quote' );

/*-----------------------------------------------------------------------------------*/
/* 12. Icon links - ilink
/*-----------------------------------------------------------------------------------*/
/*

Optional arguments:
 - style: download, note, tick, info, alert
 - url: the url for your link
 - icon: add an url to a custom icon

*/
function tmnf_shortcode_ilink($atts, $content = null) {
   	extract(shortcode_atts(array( 'style' => 'info', 'url' => '', 'icon' => ''), $atts));

   	$custom_icon = '';
   	if ( $icon )
   		$custom_icon = 'style="background:url( '.$icon.') no-repeat left 40%;"';

   return '<span class="tmnf-sc-ilink"><a class="'.$style.'" href="'.$url.'" '.$custom_icon.'>' . tmnf_sc_formatting($content) . '</a></span>';
}
add_shortcode( 'ilink', 'tmnf_shortcode_ilink' );

/*-----------------------------------------------------------------------------------*/
/* 13. jQuery Toggle
/*-----------------------------------------------------------------------------------*/
/*

}

Optional arguments:
 - title: The text in the main trigger
 - hide: Hide the toggle box on load
 - display_main_trigger: Display the main trigger on the toggle

*/
function tmnf_shortcode_toggle ( $atts, $content = null ) {

		$defaults = array(
							'title_open' => __( 'Hide the Content','themnific'),
							'title_closed' => __( 'Show the Content','themnific'),
							'hide' => 'yes',
							'display_main_trigger' => 'yes',
							'style' => 'default',
							'border' => 'yes',
							'excerpt_length' => '0',
							'include_excerpt_html' => 'no',
							'read_more_text' => __( 'Read More','themnific'),
							'read_less_text' => __( 'Read Less','themnific')
						);

		extract( shortcode_atts( $defaults, $atts ) );

		$title = '';
		$class = '';

		$class_open = ' toggle-' . sanitize_title( $title_open );

		$class_closed = ' toggle-' . sanitize_title( $title_closed );

		if ( $hide == 'yes' ) {
			$class .= $class_closed . ' closed'; $title = $title_closed;
		} else {
			$class .= $class_open . ' open'; $title = $title_open;
		} // End IF Statement

		$main_trigger = '';

		if ( $display_main_trigger == 'yes' ) {

			$main_trigger = '<h4 class="toggle-trigger"><a href="#">' . $title . '</a></h4>' . "\n";

		} // End IF Statement

		// Add the alternate style to the CSS class.
		$class .= ' ' . $style;

		// Add the border class, if necessary.
		if ( $border == 'yes' ) { $class .= ' border'; } // End IF Statement

		// If the excerpt length is greater than 0, apply the excerpt logic.
		$excerpt_length = intval( $excerpt_length );

		if ( $excerpt_length > 0 ) {
			$orig_content = $content;

			if ( $include_excerpt_html == 'no' ) {
				$content = strip_tags( $content );
			}

			$excerpt = substr( $content, 0, $excerpt_length );

			$more_link = '<a href="#read-more" class="more-link read-more" readless="' . esc_attr( $read_less_text ) . '">' . $read_more_text . '</a>';

			$content = '<span class="excerpt">' . $excerpt . '</span><!--/.excerpt-->' . "\n" . $more_link . "\n" . '<span class="more-text closed">' . substr( $content, $excerpt_length, strlen( $content ) ) . '</span><!--/.more-text-->' . "\n";
		}

		return '<div class="shortcode-toggle' . $class . '">' . $main_trigger . '<div class="toggle-content">' . do_shortcode( $content ) . '</div><!--/.toggle-content-->' . "\n" . '<input type="hidden" name="title_open" value="' . esc_attr( $title_open ) . '" /><input type="hidden" name="title_closed" value="' . esc_attr( $title_closed ) . '" />' . '</div><!--/.shortcode-toggle-->';

} // End tmnf_shortcode_toggle()

add_shortcode( 'toggle', 'tmnf_shortcode_toggle', 99 );

/*-----------------------------------------------------------------------------------*/
/* 14. Facebook Share Button - fbshare
/*-----------------------------------------------------------------------------------*/
/*

Source: http://developers.facebook.com/docs/share

Optional arguments:
 - type: box_count, button_count, button (default), icon_link, or icon
 - float: none, left, right (default: left)

*/
function tmnf_shortcode_fbshare($atts, $content = null) {
   	extract(shortcode_atts(array( 'url' => '', 'type' => 'button', 'float' => 'left' ), $atts));

	global $post;

	if ( $url == '' ) { $url = get_permalink($post->ID); } // End IF Statement

	$output = '
<div class="tmnf-fbshare '.$float.'">
<a name="fb_share" type="'.$type.'" share_url="'.$url.'">' . tmnf_sc_formatting($content) . '</a>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"
        type="text/javascript">
</script>
</div>
	';
	return $output;

}
add_shortcode( 'fbshare', 'tmnf_shortcode_fbshare' );


/*-----------------------------------------------------------------------------------*/
/* 15. Advanced Contact Form - contact_form
/*-----------------------------------------------------------------------------------*/
/*

Optional arguments:
 - email: The e-mail address to which the form will send (defaults to tmnf_contactform_email).
 - subject: The subject of the e-mail (defaults to "Message via the contact form".
 - button_text: Optionally change the text of the "submit" button.

 - Advanced form fields functionality, for creating dynamic form fields:
 --- Text Input: text_fieldname="Text Field Label|Optional Default Text"
 --- Select Box: select_fieldname="Select Box Label|key=value,key=value,key=value"
 --- Textarea Input: textarea_fieldname="Textarea Field Label|Optional Default Text|Optional Number of Rows|Optional Number of Columns"
 --- Checkbox Input: checkbox_fieldname="Checkbox Field Label|Value of the Checkbox|Checked By Default"
 --- Radio Button Input: radio_fieldname="Radio Field Label|key=value,key=value,key=value|Optional Default Value"

*/

function tmnf_shortcode_contactform ( $atts, $content = null ) {

		$defaults = array(
						'email' => get_option( 'tmnf_contactform_email'),
						'subject' => __( 'Message via the contact form','themnific'),
						'button_text' => apply_filters( 'tmnf_contact_form_button_text', __( 'Submit','themnific') )
						);

		extract( shortcode_atts( $defaults, $atts ) );

		// Extract the dynamic fields as well, if they don't have a value in $defaults.

		$html = '';
		$dynamic_atts = array();
		$formatted_dynamic_atts = array();
		$error_messages = array();

		if ( is_array( $atts ) ) {

			foreach ( $atts as $k => $v ) {

				${$k} = $v;

				$dynamic_atts[$k] = ${$k};

			} // End FOREACH Loop

		} // End IF Statement

		// Parse dynamic fields.

		if ( count( $dynamic_atts ) ) {

			foreach ( $dynamic_atts as $k => $v ) {

				/* Parse the radio buttons.
				--------------------------------------------------*/

				if ( substr( $k, 0, 6 ) == 'radio_' ) {

					// Separate the parameters.
					$params = explode( '|', $v );

					// The title.
					if ( array_key_exists( 0, $params ) ) { $label = $params[0]; } else { $label = $k; } // End IF Statement

					// The options.
					if ( array_key_exists( 1, $params ) ) { $options_string = $params[1]; } else { $options_string = ''; } // End IF Statement

					// The default value.
					if ( array_key_exists( 2, $params ) ) { $default_value = $params[2]; } else { $default_value = ''; } // End IF Statement

					// Format the options.
					$options = array();

					if ( $options_string ) {

						$options_raw = explode( ',', $options_string );

						if ( count( $options_raw ) ) {

							foreach ( $options_raw as $o ) {

								$o = trim( $o );

								$is_formatted = strpos( $o, '=' );

								// It's not formatted how we'd like it, so just add the value is both the value and label.
								if ( $is_formatted === false ) {

									$options[$o] = $o;

								// That's more like it. A separate value and label.
								} else {

									$option_data = explode( '=', $o );

									$options[$option_data[0]] = $option_data[1];

								} // End IF Statement

							} // End FOREACH Loop

						} // End IF Statement

					} // End IF Statement

					// Remove this field from the array, as we're done with it.
					unset( $dynamic_atts[$k] );

					$formatted_dynamic_atts[$k] = array( 'label' => $label, 'options' => $options, 'default_value' => $default_value );

				} // End IF Statement

				/* Parse the radio buttons.
				--------------------------------------------------*/

				if ( substr( $k, 0, 6 ) == 'radio_' ) {

					// Separate the parameters.
					$params = explode( '|', $v );

					// The title.
					if ( array_key_exists( 0, $params ) ) { $label = $params[0]; } else { $label = $k; } // End IF Statement

					// The options.
					if ( array_key_exists( 1, $params ) ) { $options_string = $params[1]; } else { $options_string = ''; } // End IF Statement

					// The default value.
					if ( array_key_exists( 2, $params ) ) { $default_value = $params[2]; } else { $default_value = ''; } // End IF Statement

					// Format the options.
					$options = array();

					if ( $options_string ) {

						$options_raw = explode( ',', $options_string );

						if ( count( $options_raw ) ) {

							foreach ( $options_raw as $o ) {

								$o = trim( $o );

								$is_formatted = strpos( $o, '=' );

								// It's not formatted how we'd like it, so just add the value is both the value and label.
								if ( $is_formatted === false ) {

									$options[$o] = $o;

								// That's more like it. A separate value and label.
								} else {

									$option_data = explode( '=', $o );

									$options[$option_data[0]] = $option_data[1];

								} // End IF Statement

							} // End FOREACH Loop

						} // End IF Statement

					} // End IF Statement

					// Remove this field from the array, as we're done with it.
					unset( $dynamic_atts[$k] );

					$formatted_dynamic_atts[$k] = array( 'label' => $label, 'options' => $options, 'default_value' => $default_value );

				} // End IF Statement

				/* Parse the checkbox inputs.
				--------------------------------------------------*/

				if ( substr( $k, 0, 9 ) == 'checkbox_' ) {

					// Separate the parameters.
					$params = explode( '|', $v );

					// The title.
					if ( array_key_exists( 0, $params ) ) { $label = $params[0]; } else { $label = $k; } // End IF Statement

					// The value of the checkbox.
					if ( array_key_exists( 1, $params ) ) { $value = $params[1]; } else { $value = ''; } // End IF Statement

					// Checked by default?
					if ( array_key_exists( 1, $params ) ) { $checked = $params[2]; } else { $checked = ''; } // End IF Statement

					// Remove this field from the array, as we're done with it.
					unset( $dynamic_atts[$k] );

					$formatted_dynamic_atts[$k] = array( 'label' => $label, 'value' => $value, 'checked' => $checked );

				} // End IF Statement

				/* Parse the text inputs.
				--------------------------------------------------*/

				if ( substr( $k, 0, 5 ) == 'text_' ) {

					// Separate the parameters.
					$params = explode( '|', $v );

					// The title.
					if ( array_key_exists( 0, $params ) ) { $label = $params[0]; } else { $label = $k; } // End IF Statement

					// The default text.
					if ( array_key_exists( 1, $params ) ) { $default_text = $params[1]; } else { $default_text = ''; } // End IF Statement

					// Remove this field from the array, as we're done with it.
					unset( $dynamic_atts[$k] );

					$formatted_dynamic_atts[$k] = array( 'label' => $label, 'default_text' => $default_text );

				} // End IF Statement

				/* Parse the select boxes.
				--------------------------------------------------*/

				if ( substr( $k, 0, 7 ) == 'select_' ) {

					// Separate the parameters.
					$params = explode( '|', $v );

					// The title.
					if ( array_key_exists( 0, $params ) ) { $label = $params[0]; } else { $label = $k; } // End IF Statement

					// The options.
					if ( array_key_exists( 1, $params ) ) { $options_string = $params[1]; } else { $options_string = ''; } // End IF Statement

					// Format the options.
					$options = array();

					if ( $options_string ) {

						$options_raw = explode( ',', $options_string );

						if ( count( $options_raw ) ) {

							foreach ( $options_raw as $o ) {

								$o = trim( $o );

								$is_formatted = strpos( $o, '=' );

								// It's not formatted how we'd like it, so just add the value is both the value and label.
								if ( $is_formatted === false ) {

									$options[$o] = $o;

								// That's more like it. A separate value and label.
								} else {

									$option_data = explode( '=', $o );

									$options[$option_data[0]] = $option_data[1];

								} // End IF Statement

							} // End FOREACH Loop

						} // End IF Statement

					} // End IF Statement

					// Remove this field from the array, as we're done with it.
					unset( $dynamic_atts[$k] );

					$formatted_dynamic_atts[$k] = array( 'label' => $label, 'options' => $options );

				} // End IF Statement

				/* Parse the textarea inputs.
				--------------------------------------------------*/

				if ( substr( $k, 0, 9 ) == 'textarea_' ) {

					// Separate the parameters.
					$params = explode( '|', $v );

					// The title.
					if ( array_key_exists( 0, $params ) ) { $label = $params[0]; } else { $label = $k; } // End IF Statement

					// The default text.
					if ( array_key_exists( 1, $params ) ) { $default_text = $params[1]; } else { $default_text = ''; } // End IF Statement

					// The number of rows.
					if ( array_key_exists( 2, $params ) ) { $number_of_rows = $params[2]; } else { $number_of_rows = 10; } // End IF Statement

					// The number of columns.
					if ( array_key_exists( 3, $params ) ) { $number_of_columns = $params[3]; } else { $number_of_columns = 10; } // End IF Statement

					// Remove this field from the array, as we're done with it.
					unset( $dynamic_atts[$k] );

					$formatted_dynamic_atts[$k] = array( 'label' => $label, 'default_text' => $default_text, 'number_of_rows' => $number_of_rows, 'number_of_columns' => $number_of_columns );

				} // End IF Statement

			} // End FOREACH Loop

		} // End IF Statement

		/*--------------------------------------------------
		 * Form Processing.
		 *
		 * Here is where we validate the POST'ed data and
		 * format it for sending in an e-mail.
		 *
		 * We then send the e-mail and notify the user.
		--------------------------------------------------*/

		$emailSent = false;

		if ( ( count( $_POST ) > 3 ) && isset( $_POST['submitted'] ) ) {

			$fields_to_skip = array( 'checking', 'submitted', 'sendCopy' );
			$default_fields = array( 'contactName' => '', 'contactEmail' => '', 'contactMessage' => '' );
			$error_responses = array(
									'contactName' => __( 'Please enter your name','themnific'),
									'contactEmail' => __( 'Please enter your email address (and please make sure it\'s valid)','themnific'),
									'contactMessage' => __( 'Please enter your message','themnific')
									);

			$posted_data = $_POST;

			// Check for errors.
			foreach ( array_keys( $default_fields ) as $d ) {

				if ( !isset ( $_POST[$d] ) || $_POST[$d] == '' || ( $d == 'contactEmail' && ! is_email( $_POST[$d] ) ) ) {

					$error_messages[$d] = $error_responses[$d];

				} // End IF Statement

			} // End FOREACH Loop

			// If we have errors, don't do anything. Otherwise, run the processing code.

			if ( count( $error_messages ) ) {} else {

				// Setup e-mail variables.
				$message_fromname = $default_fields['contactName'];
				$message_fromemail = strtolower( $default_fields['contactEmail'] );
				$message_subject = $subject;
				$message_body = $default_fields['contactMessage'] . "\n\r\n\r";

				// Filter out skipped fields and assign default fields.
				foreach ( $posted_data as $k => $v ) {

					if ( in_array( $k, $fields_to_skip ) ) {

						unset( $posted_data[$k] );

					} // End IF Statement

					if ( in_array( $k, array_keys( $default_fields ) ) ) {

						$default_fields[$k] = $v;

						unset( $posted_data[$k] );

					} // End IF Statement

				} // End FOREACH Loop

				// Okay, so now we're left with only the dynamic fields. Assign to a fresh variable.
				$dynamic_fields = $posted_data;

				// Format the default fields into the $message_body.

				foreach ( $default_fields as $k => $v ) {

					if ( $v == '' ) {} else {

						$message_body .= str_replace( 'contact', '', $k ) . ': ' . $v . "\n\r";

					} // End IF Statement

				} // End FOREACH Loop

				// Format the dynamic fields into the $message_body.

				foreach ( $dynamic_fields as $k => $v ) {

					if ( $v == '' ) {} else {

						$value = '';

						if ( substr( $k, 0, 7 ) == 'select_' || substr( $k, 0, 6 ) == 'radio_' ) {

							$message_body .= $formatted_dynamic_atts[$k]['label'] . ': ' . $formatted_dynamic_atts[$k]['options'][$v] . "\n\r";

						} else {

							$message_body .= $formatted_dynamic_atts[$k]['label'] . ': ' . $v . "\n\r";

						} // End IF Statement

					} // End IF Statement

				} // End FOREACH Loop

				// Send the e-mail.
				$headers = __( 'From: ','themnific') . $default_fields['contactName'] . ' <' . $default_fields['contactEmail'] . '>' . "\r\n" . __( 'Reply-To: ','themnific') . $default_fields['contactEmail'];

				$emailSent = wp_mail($email, $subject, $message_body, $headers);

				// Send a copy of the e-mail to the sender, if specified.

				if ( isset( $_POST['sendCopy'] ) && $_POST['sendCopy'] == 'true' ) {

					$headers = __( 'From: ','themnific') . $default_fields['contactName'] . ' <' . $default_fields['contactEmail'] . '>' . "\r\n" . __( 'Reply-To: ','themnific') . $default_fields['contactEmail'];

					$emailSent = wp_mail($default_fields['contactEmail'], $subject, $message_body, $headers);

				} // End IF Statement

			} // End IF Statement ( count( $error_messages ) )

		} // End IF Statement

		/* Generate the form HTML.
		--------------------------------------------------*/

		$html .= '<div class="post contact-form">' . "\n";

		/* Display message HTML if necessary.
		--------------------------------------------------*/

		// Success message.

		if( isset( $emailSent ) && $emailSent == true ) {

			$html .= do_shortcode( '[box type="tick"]' . __( 'Your email was successfully sent.','themnific') . '[/box]' );
			$html .= '<span class="has_sent hide"></span>' . "\n";

		} // End IF Statement

		// Error messages.

		if( count( $error_messages ) ) {

			$html .= do_shortcode( '[box type="alert"]' . __( 'There were one or more errors while submitting the form.','themnific') . '[/box]' );

		} // End IF Statement

        // No e-mail address supplied.

        if( $email == '' ) {

			$html .= do_shortcode( '[box type="alert"]' . __( 'E-mail has not been setup properly. Please add your contact e-mail!','themnific') . '[/box]' );

		} // End IF Statement

		if ( $email == '' ) {} else {

			$html .= '<form action="" id="contactForm" method="post">' . "\n";

				$html .= '<fieldset class="forms">' . "\n";

			/* Parse the "static" form fields.
			--------------------------------------------------*/

			$contactName = '';
			if( isset( $_POST['contactName'] ) ) { $contactName = $_POST['contactName']; } // End IF Statement

			$contactEmail = '';
			if( isset( $_POST['contactEmail'] ) ) { $contactEmail = $_POST['contactEmail']; } // End IF Statement

			$contactMessage = '';
			if( isset( $_POST['contactMessage'] ) ) { $contactMessage = stripslashes( $_POST['contactMessage'] ); } // End IF Statement

			$html .= '<p class="fl"><label for="contactName">' . __( 'Name','themnific') . '</label>' . "\n";
			$html .= '<input type="text" name="contactName" id="contactName" value="' . esc_attr( $contactName ) . '" class="txt requiredField" />' . "\n";

			if( array_key_exists( 'contactName', $error_messages ) ) {

				$html .= '<span class="error">' . $error_messages['contactName'] . '</span>' . "\n";

			} // End IF Statement

			$html .= '</p>' . "\n";

			$html .= '<p class="fr"><label for="contactEmail">' . __( 'Email','themnific') . '</label>' . "\n";
			$html .= '<input type="text" name="contactEmail" id="contactEmail" value="' . esc_attr( $contactEmail ) . '" class="txt requiredField email" />' . "\n";

			if( array_key_exists( 'contactEmail', $error_messages ) ) {

				$html .= '<span class="error">' . $error_messages['contactEmail'] . '</span>' . "\n";

			} // End IF Statement

			$html .= '</p>' . "\n";

			$html .= '<p class="textarea"><label for="contactMessage">' . __( 'Message','themnific') . '</label>' . "\n";
			$html .= '<textarea name="contactMessage" id="contactMessage" rows="20" cols="30" class="textarea requiredField">' . esc_textarea( $contactMessage ) . '</textarea>' . "\n";

			if( array_key_exists( 'contactMessage', $error_messages ) ) {

				$html .= '<span class="error">' . $error_messages['contactMessage'] . '</span>' . "\n";

			} // End IF Statement

			$html .= '</p>' . "\n";

			/* Parse dynamic fields into HTML.
			--------------------------------------------------*/

			if ( count( $formatted_dynamic_atts ) ) {

				foreach ( $formatted_dynamic_atts as $k => $v ) {

					/* Parse the radio buttons.
					--------------------------------------------------*/

					if ( substr( $k, 0, 6 ) == 'radio_' ) {

						/* Generate Select Box Field HTML.
						----------------------------------------------*/

						${$k} = $v['default_value'];
						if ( isset( $_POST[$k] ) ) { ${$k} = trim( strip_tags( $_POST[$k] ) ); } // End IF Statement

						$html .= '<p><label for="' . $k . '">' . $v['label'] . '</label>' . "\n";

							$html .= '<span class="tmnf-radio-container fl">' . "\n";

							foreach ( $v['options'] as $value => $label ) {

								$html .= '<input type="radio" name="' . $k . '" class="radio-button tmnf-input-radio" value="' . $value . '"' . checked( $value, ${$k}, false ) . ' />&nbsp;' . $label . '<br />' . "\n";

							} // End FOREACH Loop

							$html .= '</span><!--/.tmnf-radio-container-->' . "\n";

					} // End IF Statement

					/* Parse the checkbox inputs.
					--------------------------------------------------*/

					if ( substr( $k, 0, 9 ) == 'checkbox_' ) {

						/* Generate Checkbox Input Field HTML.
						----------------------------------------------*/

						${$k} = $v['value'];
						if ( isset( $_POST[$k] ) ) { ${$k} = trim( strip_tags( $_POST[$k] ) ); } // End IF Statement

						$checked = 0;
						if ( array_key_exists( 'checked', $v ) && $v['checked'] == 'yes' ) { $checked = ${$k}; }

						$html .= '<p class="inline">' . "\n";
						$html .= '<input type="checkbox" value="' . ${$k} . '" name="' . $k . '" id="' . $k . '" class="checkbox input-checkbox tmnf-input-checkbox"' . checked( $checked, ${$k}, false ) . ' />' . "\n";
						$html .= '<label for="' . $k . '">' . $v['label'] . '</label></p>' . "\n";

					} // End IF Statement

					/* Parse the text inputs.
					--------------------------------------------------*/

					if ( substr( $k, 0, 5 ) == 'text_' ) {

						/* Generate Text Input Field HTML.
						----------------------------------------------*/

						${$k} = $v['default_text'];
						if ( isset( $_POST[$k] ) ) { ${$k} = trim( strip_tags( $_POST[$k] ) ); } // End IF Statement

						$html .= '<p><label for="' . $k . '">' . $v['label'] . '</label>' . "\n";
						$html .= '<input type="text" value="' . esc_attr( ${$k} ) . '" name="' . $k . '" id="' . $k . '" class="txt input-text textfield tmnf-input-text" /></p>' . "\n";

					} // End IF Statement

					/* Parse the select boxes.
					--------------------------------------------------*/

					if ( substr( $k, 0, 7 ) == 'select_' ) {

						/* Generate Select Box Field HTML.
						----------------------------------------------*/

						${$k} = '';
						if ( isset( $_POST[$k] ) ) { ${$k} = trim( strip_tags( $_POST[$k] ) ); } // End IF Statement

						$html .= '<p><label for="' . $k . '">' . $v['label'] . '</label>' . "\n";
						$html .= '<select name="' . $k . '" id="' . $k . '" class="select selectfield tmnf-select">' . "\n";

							foreach ( $v['options'] as $value => $label ) {

								$selected = '';
								if ( $value == ${$k} ) { $selected = ' selected="selected"'; } // End IF Statement

								$html .= '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>' . "\n";

							} // End FOREACH Loop

						$html .= '</select></p>' . "\n";

					} // End IF Statement

					/* Parse the textarea inputs.
					--------------------------------------------------*/

					if ( substr( $k, 0, 9 ) == 'textarea_' ) {

						/* Generate Textarea Input Field HTML.
						----------------------------------------------*/

						${$k} = $v['default_text'];
						if ( isset( $_POST[$k] ) ) { ${$k} = trim( strip_tags( $_POST[$k] ) ); } // End IF Statement

						$html .= '<p><label for="' . $k . '">' . $v['label'] . '</label>' . "\n";
						$html .= '<textarea rows="' . $v['number_of_rows'] . '" cols="' . $v['number_of_columns'] . '" name="' . $k . '" id="' . $k . '" class="input-textarea textarea tmnf-textarea">' . $v['default_text'] . '</textarea></p>' . "\n";

					} // End IF Statement

				} // End FOREACH Loop

			} // End IF Statement

			/* The end of the form.
			----------------------------------------------*/

			$sendCopy = '';
			if(isset($_POST['sendCopy']) && $_POST['sendCopy'] == true) {

				$sendCopy = ' checked="checked"';

			} // End IF Statement

			$html .= '<p class="inline"><input type="checkbox" name="sendCopy" id="sendCopy" value="true"' . $sendCopy . ' /><label for="sendCopy">' . __( 'Send a copy of this email to yourself','themnific') . '</label></p>' . "\n";

			$checking = '';
			if(isset($_POST['checking'])) {

				$checking = $_POST['checking'];

			} // End IF Statement

			$html .= '<p class="screenReader"><label for="checking" class="screenReader">' . __('If you want to submit this form, do not enter anything in this field','themnific') . '</label><input type="text" name="checking" id="checking" class="screenReader" value="' . esc_attr( $checking ) . '" /></p>' . "\n";

			$html .= '<p class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><input class="submit button" type="submit" value="' . $button_text . '" /></p>';

				$html .= '</fieldset>' . "\n";

			$html .= '</form>' . "\n";

			$html .= '</div><!--/.post .contact-form-->' . "\n";

			$html .= '<div class="fix"></div>' . "\n";

		} // End IF Statement ( $email == '' )

		return $html;

} // End tmnf_shortcode_contactform()

add_shortcode( 'contact_form', 'tmnf_shortcode_contactform' );



/*-----------------------------------------------------------------------------------*/
/* 17. Dropcap - [dropcap][/dropcap]
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_dropcap ( $atts, $content = null ) {

	$defaults = array();

	extract( shortcode_atts( $defaults, $atts ) );

	return '<span class="dropcap">' . $content . '</span><!--/.dropcap-->';

} // End tmnf_shortcode_dropcap()

add_shortcode( 'dropcap', 'tmnf_shortcode_dropcap' );

/*-----------------------------------------------------------------------------------*/
/* 18. Highlight - [highlight][/highlight]
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_highlight ( $atts, $content = null ) {

	$defaults = array();

	extract( shortcode_atts( $defaults, $atts ) );

	return '<span class="shortcode-highlight">' . $content . '</span><!--/.shortcode-highlight-->';

} // End tmnf_shortcode_highlight()

add_shortcode( 'highlight', 'tmnf_shortcode_highlight' );

/*-----------------------------------------------------------------------------------*/
/* 18A. Services - [services]
/*-----------------------------------------------------------------------------------*/

add_shortcode('services', 'tmnf_shortcode_services');   
function tmnf_shortcode_services($attr, $content)
{        
    ob_start();  
    get_template_part('/includes/home-services');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* 18B. Clients - [clients]
/*-----------------------------------------------------------------------------------*/


add_shortcode('clients', 'tmnf_shortcode_clients');   
function tmnf_shortcode_clients($attr, $content)
{        
    ob_start();  
    get_template_part('/includes/home-clients');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* 18C. Pricing Tabs 3col - [pricing_tabs3]
/*-----------------------------------------------------------------------------------*/


add_shortcode('pricing_tabs3', 'tmnf_shortcode_pricing_tabs3');   
function tmnf_shortcode_pricing_tabs3($attr, $content)
{        
    ob_start();  
    get_template_part('/includes/home-pricing_tabs3');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* 18C. Pricing Tabs 4col - [pricing_tabs4]
/*-----------------------------------------------------------------------------------*/

add_shortcode('pricing_tabs4', 'tmnf_shortcode_pricing_tabs4');   
function tmnf_shortcode_pricing_tabs4($attr, $content)
{        
    ob_start();  
    get_template_part('/includes/home-pricing_tabs4');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* 18C. Social Networks - [social_networks]
/*-----------------------------------------------------------------------------------*/

add_shortcode('social_networks', 'tmnf_shortcode_social_networks');   
function tmnf_shortcode_social_networks($attr, $content)
{        
    ob_start();  
    get_template_part('/includes/uni-social');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* 18E. Staff - [staff]
/*-----------------------------------------------------------------------------------*/

add_shortcode('staff', 'tmnf_staff');   
function tmnf_staff($attr, $content)
{        
    ob_start();  
    get_template_part('/includes/home-staff');  
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}

/*-----------------------------------------------------------------------------------*/
/* 19. Abbreviation - [abbr][/abbr]
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_abbreviation ( $atts, $content = null ) {

	$defaults = array( 'title' => '' );

	extract( shortcode_atts( $defaults, $atts ) );

	return '<abbr title="' . $title . '">' . $content . '</abbr>';

} // End tmnf_shortcode_abbreviation()

add_shortcode( 'abbr', 'tmnf_shortcode_abbreviation' );



/*-----------------------------------------------------------------------------------*/
/* 21. List Styles - Unordered List - [unordered_list style=""][/unordered_list]
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_unorderedlist ( $atts, $content = null ) {

	$defaults = array( 'style' => 'default' );

	extract( shortcode_atts( $defaults, $atts ) );

	return '<div class="shortcode-unorderedlist ' . $style . '">' . do_shortcode( $content ) . '</div>' . "\n";

} // End tmnf_shortcode_unorderedlist()

add_shortcode( 'unordered_list', 'tmnf_shortcode_unorderedlist' );

/*-----------------------------------------------------------------------------------*/
/* 22. List Styles - Ordered List - [ordered_list style=""][/ordered_list]
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_orderedlist ( $atts, $content = null ) {

	$defaults = array( 'style' => 'default' );

	extract( shortcode_atts( $defaults, $atts ) );

	return '<div class="shortcode-orderedlist ' . $style . '">' . do_shortcode( $content ) . '</div>' . "\n";

} // End tmnf_shortcode_orderedlist()

add_shortcode( 'ordered_list', 'tmnf_shortcode_orderedlist' );

/*-----------------------------------------------------------------------------------*/
/* 23. Social Icon - [social_icon url="" float="" icon_url="" title="" profile_type="" window=""]
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_socialicon ( $atts, $content = null ) {

	$defaults = array( 'url' => '', 'float' => 'none', 'icon_url' => '', 'title' => '', 'profile_type' => '', 'window' => 'no', 'rel' => '' );

	extract( shortcode_atts( $defaults, $atts ) );

	if ( ! $url ) { return; } // End IF Statement - Don't run the shortcode if no URL has been supplied.

	// Attempt to determine the location of the social profile.
	// If no location is found, a default icon will be used.

	$_default_icon = '';

	$_supported_profiles = array(
									'facebook' => 'facebook.com',
									'twitter' => 'twitter.com',
									'youtube' => 'youtube.com',
									'delicious' => 'delicious.com',
									'flickr' => 'flickr.com',
									'linkedin' => 'linkedin.com', 
									'googleplus' => 'plus.google.com'
								);

	$_profile_to_display = '';
	$_alt_text = '';
	$_classes = 'social-icon';

	$_profile_match = false;

	// If they've specified an icon, skip the automation.

	if ( $profile_type != '' ) {

		$_profile_match = true;
		$_profile_to_display = $profile_type;
		if ( $title ) { $_alt_text = $title; } else { $_alt_text = ucwords( $_profile_to_display ); $_alt_text = sprintf( __( 'My %s Profile','themnific'), $_alt_text ); } // End IF Statement
		$_profile_class = ' social-icon-' . $_profile_to_display;

		if ( $icon_url ) {

			$_img_url = $icon_url;

		} else {

			$_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/images/ico-social-' . $_profile_to_display . '.png';

		} // End IF Statement

	} // End IF Statement

	// Create a special scenario for use with the RSS feed for this website.

	if ( $url == 'feed' ) {

		$_profile_match = true;
		$_profile_to_display = 'rss';
		if ( $title ) { $_alt_text = $title; } else { $_alt_text = __( 'Subscribe to our RSS feed','themnific'); } // End IF Statement
		$_classes .= ' social-icon-subscribe';
		$url = get_bloginfo( 'rss2_url' );

		if ( $icon_url ) {

			$_img_url = $icon_url;

		} else {

			$_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/images/ico-social-' . $_profile_to_display . '.png';

		} // End IF Statement

	} else {

		foreach ( $_supported_profiles as $k => $v ) {

			if ( $_profile_match == true ) { break; } // End IF Statement - Break out of the loop if we already have a match.

			// Get host name from URL

			preg_match( '@^(?:http://)?([^/]+)@i', $url, $matches );
			$host = $matches[1];

			if ( $host == $v ) {

				$_profile_match = true;
				$_profile_to_display = $k;
				if ( $title ) { $_alt_text = $title; } else { $_alt_text = ucwords( $_profile_to_display ); $_alt_text = sprintf( __( 'My %s Profile','themnific'), $_alt_text ); } // End IF Statement
				$_profile_class = ' social-icon-' . $_profile_to_display;

				if ( $icon_url ) {

					$_img_url = $icon_url;

				} else {

				$_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/images/ico-social-' . $_profile_to_display . '.png';

				} // End IF Statement

			} else {

				$_profile_to_display = 'default';
				if ( $title ) { $_alt_text = $title; } else { $_alt_text = ucwords( $matches[1] ); $_alt_text = sprintf( __( 'My %s Profile','themnific'), $_alt_text ); } // End IF Statement

				$_host_bits = explode( '.', $matches[1] );
				$_profile_class = ' social-icon-' . $_host_bits[0];

				if ( $icon_url ) {

					$_img_url = $icon_url;

				} else {

					$_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/images/ico-social-' . $_profile_to_display . '.png';

					// Check if an image has been added for this social icon.

					if ( file_exists( trailingslashit( get_stylesheet_directory() ) . 'images/ico-social-' . $_host_bits[0] . '.png' ) ) {

						$_img_url = trailingslashit( get_stylesheet_directory_uri() ) . 'images/ico-social-' . $_host_bits[0] . '.png';

					} // End IF Statement

				} // End IF Statement

			} // End IF Statement

		} // End FOREACH Loop

		$_classes .= $_profile_class;

		// Determine the floating CSS class to be used.

		switch ( $float ) {

			case 'left':

				$_classes .= ' fl';

			break;

			case 'right':

				$_classes .= ' fr';

			break;

			default:

			break;

		} // End SWITCH Statement

	} // End IF Statement

	$target = '';
	if ( $window == 'yes' ) { $target = ' target="_blank"'; } // End IF Statement

	if ( $rel != '' ) { $rel = ' rel="' . $rel . '"'; }

	return '<a href="' . $url . '" title="' . $_alt_text . '"' . $target . $rel . '><img src="' . $_img_url . '" alt="' . $_alt_text . '" class="' . $_classes . '" /></a>' . "\n";

} // End tmnf_shortcode_socialicon()

add_shortcode( 'social_icon', 'tmnf_shortcode_socialicon' );

/*-----------------------------------------------------------------------------------*/
/* 24. LinkedIn Button - [linkedin_share url="" style=""]
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_linkedin_share ( $atts, $content = null ) {

	$defaults = array( 'url' => '', 'style' => 'none', 'float' => 'none' );

	extract( shortcode_atts( $defaults, $atts ) );

	$allowed_floats = array( 'left' => 'fl', 'right' => 'fr', 'none' => '' );
	$allowed_styles = array( 'top' => ' data-counter="top"', 'right' => ' data-counter="right"', 'none' => '' );

	if ( ! in_array( $float, array_keys( $allowed_floats ) ) ) { $float = 'none'; }
	if ( ! in_array( $style, array_keys( $allowed_styles ) ) ) { $style = 'none'; }

	if ( $url ) { $url = ' data-url="' . esc_url( $url ) . '"'; }

	$output = '';

	if ( $float == 'none' ) {} else { $output .= '<div class="shortcode-linkedin_share ' . $allowed_floats[$float] . '">' . "\n"; }

	$output .= '<script type="IN/Share" ' . $url . $allowed_styles[$style] . '></script>' . "\n";

	if ( $float == 'none' ) {} else { $output .= '</div><!--/.shortcode-linkedin_share-->' . "\n"; }

	// Enqueue the LinkedIn button JavaScript from their API.
	add_action( 'wp_footer', 'tmnf_shortcode_linkedin_js' );
	add_action( 'tmnf_shortcode_generator_preview_footer', 'tmnf_shortcode_linkedin_js' );

	return $output . "\n";

} // End tmnf_shortcode_linkedin_share()

add_shortcode( 'linkedin_share', 'tmnf_shortcode_linkedin_share' );

/*-----------------------------------------------------------------------------------*/
/* 24.1 Load Javascript for LinkedIn Button
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_linkedin_js () {
	echo '<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>' . "\n";
} // End tmnf_shortcode_linkedin_js()

/*-----------------------------------------------------------------------------------*/
/* 25. Google +1 Button - [google_plusone]
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_google_plusone ( $atts, $content = null ) {

	global $post;

	$defaults = array(
						'size' => '',
						'language' => '',
						'count' => '',
						'href' => '',
						'callback' => '',
						'float' => 'none'
					);

	$atts = shortcode_atts( $defaults, $atts );

	extract( $atts );

	$allowed_floats = array( 'left' => ' fl', 'right' => ' fr', 'none' => '' );
	if ( ! in_array( $float, array_keys( $allowed_floats ) ) ) { $float = 'none'; }

	$output = '';
	$tag_atts = '';

	// Make sure we only have Google +1 attributes in our array, after parsing the "float" parameter.
	unset( $atts['float'] );

	if ( $atts['href'] == '' & isset( $post->ID ) ) {
		$atts['href'] = get_permalink( $post->ID );
	}

	foreach ( $atts as $k => $v ) {
		if ( ${$k} != '' ) {
			$tag_atts .= ' ' . $k . '="' . ${$k} . '"';
		}
	}

	$output = '<div class="shortcode-google-plusone' . $allowed_floats[$float] . '"><g:plusone' . $tag_atts . '></g:plusone></div><!--/.shortcode-google-plusone-->' . "\n";

	// Enqueue the Google +1 button JavaScript from their API.
	add_action( 'wp_footer', 'tmnf_shortcode_google_plusone_js' );
	add_action( 'tmnf_shortcode_generator_preview_footer', 'tmnf_shortcode_google_plusone_js' );

	return $output . "\n";

} // End tmnf_shortcode_google_plusone()

add_shortcode( 'google_plusone', 'tmnf_shortcode_google_plusone' );

/*-----------------------------------------------------------------------------------*/
/* 25.1 Load Javascript for Google +1 Button
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_google_plusone_js () {
	echo '<script src="https://apis.google.com/js/plusone.js" type="text/javascript"></script>' . "\n";
	echo '<script type="text/javascript">gapi.plusone.go();</script>' . "\n";
} // End tmnf_shortcode_google_plusone_js()

/*-----------------------------------------------------------------------------------*/
/* Twitter Follow Button - [twitter_follow]
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_twitter_follow ( $atts, $content = null ) {

	global $post;

	if ( ! isset( $atts['username'] ) || ( $atts['username'] == '' ) ) { return; } // We can't continue without the username.

	$defaults = array(
						'username' => '', 
						'button_color' => 'blue',
						'text_color' => '',
						'link_color' => '',
						'width' => '',
						'align' => '',
						'language' => '',
						'count' => '',
						'float' => 'none'
					);

	$atts = shortcode_atts( $defaults, $atts );

	extract( $atts );

	$allowed_floats = array( 'left' => ' fl', 'right' => ' fr', 'none' => '' );
	if ( ! in_array( $float, array_keys( $allowed_floats ) ) ) { $float = 'none'; }
	
	$allowed_langs = array( 'en', 'fr', 'de', 'it', 'es', 'ko', 'ja' );
	if ( ! in_array( $language, array_keys( $allowed_langs ) ) ) { $language = ''; }

	$output = '';
	$tag_atts = '';

	// Make sure we only have Google +1 attributes in our array, after parsing the "float" parameter.
	unset( $atts['float'] );
	unset( $atts['username'] );

	// Setup array of attributes and the value keys containing the data for each.
	$att_keys = array(
						'button_color' => 'data-button', 
						'text_color' => 'data-text-color', 
						'link_color' => 'data-link-color', 
						'width' => 'data-width', 
						'align' => 'data-align', 
						'language' => 'data-lang', 
						'count' => 'data-show-count'
					);

	foreach ( $atts as $k => $v ) {
		if ( ${$k} != '' ) {
			$tag_atts .= ' ' . $att_keys[$k] . '="' . ${$k} . '"';
		}
	}

	$output = '<div class="shortcode-twitter-follow' . $allowed_floats[$float] . '"><a href="http://twitter.com/' . $username . '/"' . $tag_atts . ' class="twitter-follow-button">' . __( 'Follow','themnific') . ' ' . $username . '</a></div><!--/.shortcode-twitter-follow-->' . "\n";

	// Enqueue the Twitter Follow button JavaScript from their API.
	add_action( 'wp_footer', 'tmnf_shortcode_twitter_follow_js' );
	add_action( 'tmnf_shortcode_generator_preview_footer', 'tmnf_shortcode_twitter_follow_js' );

	return $output . "\n";

} // End tmnf_shortcode_twitter_follow()

add_shortcode( 'twitter_follow', 'tmnf_shortcode_twitter_follow' );

/*-----------------------------------------------------------------------------------*/
/* 26.1 Load Javascript for Google +1 Button
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_twitter_follow_js () {
	echo '<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>' . "\n";
} // End tmnf_shortcode_twitter_follow_js()


/*-----------------------------------------------------------------------------------*/
/* 27. Homepage Video - [video][/video]
/*-----------------------------------------------------------------------------------*/

function tmnf_shortcode_home_video ( $atts, $content = null ) {

	$defaults = array();

	extract( shortcode_atts( $defaults, $atts ) );

	return '<span class="homepage-video">' . $content . '</span><!--/.shortcode-_home_video-->';

} // End tmnf_shortcode_home_video()

add_shortcode( 'home_video', 'tmnf_shortcode_home_video' );






// do some shortcode magic

if (!function_exists( "tmnf_sc_formatting")) {
	function tmnf_sc_formatting($content) {
		$content = do_shortcode( $content  );
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content);
		return $content;
	}
}

/*-----------------------------------------------------------------------------------*/
/* THE END */
/*-----------------------------------------------------------------------------------*/
?>