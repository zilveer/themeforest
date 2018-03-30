<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page' );
}

$woo_options = get_option( 'woo_options' );

/*-----------------------------------------------------------------------------------*/
/* Add custom typograhpy to HEAD 													 */
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_head', 'woo_custom_typography' ); // Add custom typography to HEAD

if ( ! function_exists( 'woo_custom_typography' ) ) {
	function woo_custom_typography() {

		// Get options
		global $woo_options;

		// Reset
		$output 			 = '';
		$default_google_font = false;

		if ( isset( $woo_options['woo_typography'] ) && $woo_options['woo_typography'] == 'true' ) {

			if ( isset( $woo_options['woo_font_body'] ) && $woo_options['woo_font_body'] ) {
				/* body font css output */
				$output .= 'body { font:' . $woo_options['woo_font_body']["style"] . ' ' . $woo_options['woo_font_body']["size"] . $woo_options['woo_font_body']["unit"] . ' ' . stripslashes( $woo_options['woo_font_body']["face"] ) . '; color:' . $woo_options['woo_font_body']["color"] . '; }';
			}

			// if ( isset($woo_options['woo_top_nav_font']) && $woo_options['woo_top_nav_font'] ) {
			// 	$output .= '#top ul.nav li a { ' . woo_generate_font_css( $woo_options['woo_top_nav_font'], 1.6 ) . ' }';
			// 	if ( isset( $woo_options['woo_top_nav_font']['color'] ) && strlen( $woo_options['woo_top_nav_font']['color'] ) == 7 ) {
			// 		$output .= '#top ul.nav li.parent > a:after { border-top-color:'. esc_attr( $woo_options['woo_top_nav_font']['color'] ) . '; }';
			// 	}
			// }

			if ( isset( $woo_options['woo_font_nav'] ) && $woo_options['woo_font_nav'] ) {
				$output .= '.callus, #navigation ul.nav li a, #top li a { ' . woo_generate_font_css( $woo_options['woo_font_nav'], '1') . '; }';
				if ( isset( $woo_options['woo_font_nav']['color'] ) && strlen( $woo_options['woo_font_nav']['color'] ) == 7 ) {
					$output .= '#top ul.nav li.parent > a:after { border-top-color:'. esc_attr( $woo_options['woo_font_nav']['color'] ) . '; }';
				}
			}

			if ( isset( $woo_options['woo_font_page_title'] ) && $woo_options['woo_font_page_title'] ) {
				/* title font css output */
				$output   .= 'h1, h2, h3, h4:not(.given-name), h5, h6 { font:' . $woo_options['woo_font_page_title']["style"] . ' ' . $woo_options['woo_font_page_title']["size"] . $woo_options['woo_font_page_title']["unit"] . '/1.2em ' . stripslashes( $woo_options['woo_font_page_title']["face"] ) . '; color:' . $woo_options['woo_font_page_title']["color"] . '; }';
			}

			// if ( isset( $woo_options['woo_font_post_title'] ) && $woo_options['woo_font_post_title'] ) {
			// 	$font_mask = $woo_options['woo_font_post_title'];
			// 	$output .= '.post .title, .post .title h1 a:link, .post .title h1 a:visited { font:'.$font_mask["style"].' '.$font_mask["size"].$font_mask["unit"].'/1.2em '.stripslashes($font_mask["face"]).'!important;color:'.$font_mask["color"].'!important;}' . "\n";
			// }

			// if ( isset( $woo_options['woo_font_post_meta'] ) && $woo_options['woo_font_post_meta'] ) {
			// 	$font_mask = $woo_options['woo_font_post_meta'];
			// 	$output .= '.post-meta {  font:'.$font_mask["style"].' '.$font_mask["size"].$font_mask["unit"].'/2em '.stripslashes($font_mask["face"]).'!important;color:'.$font_mask["color"].'!important;}' . "\n";
			// }

			// if ( isset( $woo_options['woo_font_post_entry'] ) && $woo_options['woo_font_post_entry'] ) {
			// 	$font_mask = $woo_options['woo_font_post_entry'];
			// 	$output .= '.entry, .entry p, .blog-list-item-excerpt p { font:'.$font_mask["style"].' '.$font_mask["size"].$font_mask["unit"].'/20px '.stripslashes($font_mask["face"]).'!important;color:'.$font_mask["color"].'!important; } h1, h2, h3, h4, h5, h6 { font-family: '.stripslashes($woo_options[ 'woo_font_post_entry' ]['face']).', arial, sans-serif; }'  . "\n";
			// }

			// if ( isset( $woo_options['woo_font_recipe_title'] ) && $woo_options['woo_font_recipe_title'] ) {
			// 	$output .= '.recipe-info h3 a , .recipe-title ,.menu-tab a { '.woo_generate_font_css($woo_options[ 'woo_font_recipe_title' ]).' }' . "\n";
			// }

			// if ( isset( $woo_options['woo_font_widget_titles'] ) && $woo_options['woo_font_widget_titles'] ) {
			// 	$font_mask = $woo_options['woo_font_widget_titles'];
			// 	$output .= '.widget h3 {  font:'.$font_mask["style"].' '.$font_mask["size"].$font_mask["unit"].' '.stripslashes($font_mask["face"]).'!important;color:'.$font_mask["color"].'!important; }'  . "\n";
			// }

			// if ( isset( $woo_options['woo_font_widget_text'] ) && $woo_options['woo_font_widget_text'] ) {
			// 	$font_mask = $woo_options['woo_font_widget_text'];
			// 	$output .= '.widget p, .widget a, .widget span, .widget li {font:'.$font_mask["style"].' '.$font_mask["size"].$font_mask["unit"].'/1.2em '.stripslashes($font_mask["face"]).'!important;color:'.$font_mask["color"].'!important;}'; "\n";
			// }

			// if ( isset( $woo_options['woo_font_footer_titles'] ) && $woo_options['woo_font_footer_titles'] ) {
			// 	$font_mask = $woo_options['woo_font_footer_titles'];
			// 	$output .= '#footer-widgets h3 {  font:'.$font_mask["style"].' '.$font_mask["size"].$font_mask["unit"].'/18px '.stripslashes($font_mask["face"]).'!important;color:'.$font_mask["color"].'!important; }'  . "\n";
			// }

			// if ( isset( $woo_options['woo_font_footer_text'] ) && $woo_options['woo_font_footer_text'] ) {
			// 	$font_mask = $woo_options['woo_font_footer_text'];
			// 	$output .= '#footer-widgets p, #footer-widgets span, #footer-widgets li, #copyright, #credit{font:'.$font_mask["style"].' '.$font_mask["size"].$font_mask["unit"].'/1.2em '.stripslashes($font_mask["face"]).'!important;color:'.$font_mask["color"].'!important;}'; "\n";
			// }

			// Component titles
			// if ( isset( $woo_options['woo_font_component_titles'] ) && $woo_options['woo_font_component_titles'] ) {
			// 	$output .= '.component h2.component-title { '.woo_generate_font_css($woo_options[ 'woo_font_component_titles' ]).' }'  . "\n";
			// }
		// Add default typography Google Font
		} else {

			// Load default Google Fonts
			global $default_google_fonts;
			if ( is_array( $default_google_fonts) and count( $default_google_fonts ) > 0 ) :

				$count = 0;
				foreach ( $default_google_fonts as $font ) {
					$count++;
					$woo_options[ 'woo_default_google_font_'.$count ] = array( 'face' => $font );
				}
				$default_google_font = true;

			endif;

		}

		// Output styles
		if ( isset( $output ) && $output != '') {

			// Load Google Fonts stylesheet in HEAD
			if ( function_exists( 'woo_google_webfonts' ) ) { woo_google_webfonts(); }

			$output = "\n" . "<!-- Woo Custom Typography -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;

		// Check if default google font is set and load Google Fonts stylesheet in HEAD
		} elseif ( $default_google_font ) {

			// Enable Google Fonts stylesheet in HEAD
			if ( function_exists( 'woo_google_webfonts' ) ) { woo_google_webfonts(); }

		}

	} // End woo_custom_typography()
}


add_action( 'wp_head', 'woo_google_webfonts', 10 );	// Add Google Fonts output to HEAD

// Returns proper font css output
if ( ! function_exists( 'woo_generate_font_css' ) ) {
	function woo_generate_font_css( $option, $em = '1' ) {

		// Test if font-face is a Google font
		global $google_fonts;
		foreach ( $google_fonts as $google_font ) {
			// Add single quotation marks to font name and default arial sans-serif ending
			if ( $option['face'] == $google_font['name'] ) {
				$option['face'] = "'" . $option['face'] . "', arial, sans-serif";
			}
		} // END foreach

		if ( !@$option['style'] && !@$option['size'] && !@$option['unit'] && !@$option['color'] ) {
			return 'font-family: '.stripslashes($option["face"]).';';
		} else {
			return 'font:'.$option['style'].' '.$option['size'].$option['unit'].'/'.$em.'em '.stripslashes($option['face']).';color:'.$option['color'].';';
		}
	} // End woo_generate_font_css()
}