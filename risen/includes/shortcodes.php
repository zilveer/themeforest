<?php
/**
 * Shortcodes
 */

// Enable shortcodes on init (see functions.php)
function risen_shortcodes() {

	// Add all shortcodes (make sure available to widgets, do_shortcode(), etc.)
	risen_add_shortcodes();
	
	// Preprocess shortcodes
	// This helps prevent unwanted <p> and <br /> tags in content
	add_filter( 'the_content', 'risen_preprocess_shortcodes', 9 ); // before wpautop and wptexturize which are 10
	
	// Enable shortcodes for widgets
	add_filter( 'widget_text', 'do_shortcode' );

}

// Add shortcodes
if ( ! function_exists( 'risen_add_shortcodes' ) ) {

	function risen_add_shortcodes( $options = array() ) {

		// Note: preprocess those that will contain user-provided content to avoid unwanted <p> and <br />
		$shortcodes = array(	
		
			'site_name' => array(
				'function'		=> 'risen_shortcode_site_name',
				'preprocess'	=> false
			),
			
			'tagline' => array(
				'function'		=> 'risen_shortcode_tagline',
				'preprocess'	=> false
			),
			
			'home_url' => array(
				'function'		=> 'risen_shortcode_home_url',
				'preprocess'	=> false
			),
			
			'feed_url' => array(
				'function'		=> 'risen_shortcode_feed_url',
				'preprocess'	=> false
			),
			
			'copyright_symbol' => array(
				'function'		=> 'risen_shortcode_copyright_symbol',
				'preprocess'	=> false
			),
			
			'current_year' => array(
				'function'		=> 'risen_shortcode_current_year',
				'preprocess'	=> false
			),
			
			'contact_form' => array(
				'function'		=> 'risen_shortcode_contact_form',
				'preprocess'	=> false
			),
			
			'google_map' => array(
				'function'		=> 'risen_shortcode_google_map',
				'preprocess'	=> false
			),
			
			'button' => array(
				'function'		=> 'risen_shortcode_button',
				'preprocess'	=> true
			),
			
			'columns' => array(
				'function'		=> 'risen_shortcode_columns',
				'preprocess'	=> true
			),
			
			'one_fourth' => array(
				'function'		=> 'risen_shortcode_column_one_fourth',
				'preprocess'	=> true
			),
			
			'one_third' => array(
				'function'		=> 'risen_shortcode_column_one_third',
				'preprocess'	=> true
			),
			
			'one_half' => array(
				'function'		=> 'risen_shortcode_column_one_half',
				'preprocess'	=> true
			),
			
			'two_thirds' => array(
				'function'		=> 'risen_shortcode_column_two_thirds',
				'preprocess'	=> true
			),
			
			'three_fourths' => array(
				'function'		=> 'risen_shortcode_column_three_fourths',
				'preprocess'	=> true
			),
			
			'tabs' => array(
				'function'		=> 'risen_shortcode_tabs',
				'preprocess'	=> true
			),
			
			'tab' => array(
				'function'		=> 'risen_shortcode_tab',
				'preprocess'	=> true
			),
			
			'accordion' => array(
				'function'		=> 'risen_shortcode_accordion',
				'preprocess'	=> true
			),
			
			'accordion_section' => array(
				'function'		=> 'risen_shortcode_accordion_section',
				'preprocess'	=> true
			),
			
			'quote' => array(
				'function'		=> 'risen_shortcode_quote',
				'preprocess'	=> true
			),
			
			'box' => array(
				'function'		=> 'risen_shortcode_box',
				'preprocess'	=> true
			)
			
		);
		
		// Allow filtering of shortcodes array
		$shortcodes = apply_filters( 'risen_shortcodes', $shortcodes );

		// Loop shortcodes to add
		foreach( $shortcodes as $shortcode => $shortcode_options ) {
		
			// add all or only those specified for preprocessing if function option is set
			if ( empty( $options['preprocess'] ) || ! empty( $shortcode_options['preprocess'] ) ) {
				add_shortcode( $shortcode, $shortcode_options['function'] );
			}

		}

	}

}

// Preprocess shortcodes with user-provided content
// This helps prevent unwanted <p> and <br /> tags in content
// Credit to Viper007Bond - http://www.viper007bond.com/2009/11/22/wordpress-code-earlier-shortcodes/
// Related resources:
// http://betterwp.net/17-protect-shortcodes-from-wpautop-and-the-likes/
// http://wpforce.com/prevent-wpautop-filter-shortcode/ (Carl Hancock comment)
function risen_preprocess_shortcodes( $content ) {

    global $shortcode_tags;

    // Store current shortcodes then temporarily remove them
    $current_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes(); 
	
	// Preprocess specific shortcodes
	$options = array();
	$options['preprocess'] = true; // limit to shortcodes specified to preprocessing
	risen_add_shortcodes( $options );

    // Process shortcodes
    $content = do_shortcode( $content );
 
    // Restore the current shortcodes
    $shortcode_tags = $current_shortcode_tags;
 
    return $content;

} 

/************************************************
 * BASIC SHORTCODES
 ************************************************/

// Site Name
function risen_shortcode_site_name() {
	return get_bloginfo( 'name' );
}

// Tagline
function risen_shortcode_tagline() {
	return get_bloginfo( 'description' );
}

// Current Year
function risen_shortcode_current_year() {
	return date( 'Y' );
}

// Copyright Symbol (since &copy; doesn't behave directly in theme options input field)
function risen_shortcode_copyright_symbol() {
	return '&copy;';
}

// RSS Feed URL
// [feed_url] can be used by social media icons
function risen_shortcode_feed_url() {
	return get_bloginfo( 'rss_url' );
}

// Home URL
function risen_shortcode_home_url() {
	return home_url();
}

/************************************************
 * BUTTONS
 ************************************************/
 
// Shortcode: Button
function risen_shortcode_button( $atts, $content = null ) {

	// Get attributes, set defaults
	extract( shortcode_atts( array(
		'url'		=> '',			// click URL
		'size'		=> 'small',		// small or large
		'width'		=> '',			// "auto" or numeric value representing pixels (blank uses min width in CSS)
		'color'		=> '',			// #hex, red, orange, yellow, green, teal, blue, purple, pink, brown, tan, silver, gray, black
		'textcolor'	=> '',			// white or black
		'newwindow'	=> 'false',		// true or false
		'class'		=> ''			// class or classes separated by spaces
	), $atts ) );

	// Arrays
	$classes = array( 'button' );
	$styles = array();
	$link_atts = array();
	
	// URL
	$url = trim( $url );
	$url = empty( $url ) ? '#' : $url; // # if no URL
	$link_atts[] = 'href="' . esc_url( $url ) . '"';
	
	// Size: small or large?
	if ( $size != 'large' ) {
		$classes[] = 'button-small'; // by default use small button
	}
	
	// Minimum width
	if ( 'auto' != $width ) {
		$classes[] = 'button-min-width'; // use min width if not "fitting" with auto
	}

	// Set width
	if ( $width = (int) $width ) { // // trim 'px' of if given
		$styles[] = 'width:' . $width . 'px';
	}
	
	// Color
	$color = strtolower( $color );
	$valid_colors = array( 'red', 'orange', 'yellow', 'green', 'teal', 'blue', 'purple', 'pink', 'brown', 'tan', 'silver', 'gray', 'black' );
	if ( in_array( $color, $valid_colors ) ) { // given color is valid preset
		$classes[] = 'button-' . $color;
	} else if ( preg_match( '/^#?([a-f0-9]{3}|[a-f0-9]{6})$/', $color ) ) { // color is hex
		$hexcolor = ltrim( $color, '#' );
		$styles[] = 'background-color:#' . $hexcolor . ';border-color:#' . $hexcolor;
		$textcolor = empty( $textcolor ) ? 'white' : $textcolor;
	}
	
	// Text color
	$textcolor = strtolower( $textcolor );
	$valid_text_colors = array( 'white', 'black' );
	if ( in_array( $textcolor, $valid_text_colors ) ) { // given color is valid preset
		$classes[] = 'button-text-' . $textcolor;
	}

	// Build class attribute
	if ( ! empty( $class ) ) {
		$classes = array_merge( $classes, explode( ' ', $class ) );
	}
	$link_atts[] = 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
	
	// Build style attribute
	if ( ! empty( $styles ) ) {
		$link_atts[] = 'style="' . esc_attr( implode( ';', $styles ) ) . '"';
	}
	
	// Build target attribute
	if ( 'true' == $newwindow ) {
		$link_atts[] = 'target="_blank"';
	}
	
	// Return HTML
	return '<a ' . implode( ' ', $link_atts ) . '>' . $content . '</a>';

}

/************************************************
 * COLUMNS
 ************************************************/

// Column Helper
// Build column HTML with appropriate width
function risen_column_helper( $content, $size ) {

	$content = do_shortcode( $content ); // allow other shortcodes in column

	$column  = '<div class="' . $size . '">';
	$column .= '<div class="column-content">';
	$column .= $content;
	$column .= '</div>';
	$column .= '</div>';
	
	return $column;

}
 
// Shortcode: Columns (Wrapper)
function risen_shortcode_columns( $atts, $content = null ) {
	
	$content = do_shortcode( $content ); // enable nesting
	
	$columns  = '<p>';
	$columns  = '<div class="columns">';
	$columns .= $content;
	$columns .= '<div class="clear"></div>';
	$columns .= '</div>';
	$columns .= '<p>';

	return $columns;

}

// Shortcode: Column - One Fourth
function risen_shortcode_column_one_fourth( $atts, $content = null ) {
	return risen_column_helper( $content, 'one-fourth' );
}

// Shortcode: Column - One Third
function risen_shortcode_column_one_third( $atts, $content = null ) {
	return risen_column_helper( $content, 'one-third' );
}

// Shortcode: Column - One Half
function risen_shortcode_column_one_half( $atts, $content = null ) {
	return risen_column_helper( $content, 'one-half' );
}

// Shortcode: Column - Two Thirds
function risen_shortcode_column_two_thirds( $atts, $content = null ) {
	return risen_column_helper( $content, 'two-thirds' );
}

// Shortcode: Column - Three Fourths
function risen_shortcode_column_three_fourths( $atts, $content = null ) {
	return risen_column_helper( $content, 'three-fourths' );
}

/************************************************
 * TABS
 ************************************************/
 
// Shortcode: Tabs (Wrapper)
function risen_shortcode_tabs( $atts, $content = null ) {

	// Get all nested [tab] shortcodes into array with attributes
	$tag_attributes = risen_get_tag_attributes( $content, 'tab', array( 'title', 'active' ) );
	
	// Make sure only one active tab is set
	$active_set = false;
	foreach( $tag_attributes as $single_tag ) {
		
		if ( 'true' == $single_tag['active'] ) {
		
			// Another was already set
			if ( true == $active_set ) {
				$single_tag['active'] = '';
			}

			$active_set = true;

		}
		
	}
	
	// If no tabs set to active, make first active
	if ( false == $active_set && isset( $tag_attributes[0] ) ) {
		$tag_attributes[0]['active'] = 'true';
	}
	
	// Build tabs list for top
	$tabs_list = '';
	foreach( $tag_attributes as $single_tag ) {
	
		// Clean title
		$title = trim( $single_tag['title'] ); // remove whitespace
		$title = ! empty( $title ) ? $title : '&nbsp;'; // if no title, use a space so tab shows
		$title = esc_html( $title ); // clean output
	
		// Active tab attribute set?
		$active_class_attr = '';
		if ( 'true' == strtolower( $single_tag['active'] ) ) {
			$active_class_attr = ' class="tabber-active"';
		}
	
		$tabs_list .= '<li' . $active_class_attr . '>';
		$tabs_list .= $title;
		$tabs_list .= '</li>';
	}
	
	// Start tabs container
	$tabs  = '<div class="tabber">';
	
	// Tabs at top
	$tabs .= '<ul>';
	$tabs .= $tabs_list;
	$tabs .= '</ul>';
	
	// Tab contents
	$tabs .= '<div>';
	$tabs .= do_shortcode( $content ); // enable the nested tab shortcodes
	$tabs .= '</div>';
	
	// End tabs container
	$tabs .= '</div>';
	
	return $tabs;

}

// Shortcode: Tab (Single)
function risen_shortcode_tab( $atts, $content = null ) {

	// Get attributes, set defaults
	extract( shortcode_atts( array(
		'title'		=> '', // used in shortcode_tabs above
		'active'	=> 'false'
	), $atts ) );

	// Set tab content active
	$active_class_attr = '';
	if ( 'true' == strtolower( $active ) ) {
		$active_class_attr = ' class="tabber-active"';
	}
	
	// Tab content
	$tab  = '<div' . $active_class_attr . '>';
	$tab .= do_shortcode( $content );
	$tab .= '</div>';
		
	return $tab;

}

/************************************************
 * ACCORDION
 ************************************************/
 
// Shortcode: Accordion (Wrapper)
function risen_shortcode_accordion( $atts, $content = null ) {
	
	$accordion  = '<div class="accordion">';
	$accordion .= do_shortcode( $content ); // enable nesed tags for sections
	$accordion .= '</div>';
	
	return $accordion;

}

// Shortcode: Accordion Section
function risen_shortcode_accordion_section( $atts, $content = null ) {

	// Get attributes, set defaults
	extract( shortcode_atts( array(
		'title'		=> '',
		'active'	=> 'false'
	), $atts ) );

	// Clean title
	$title = trim( $title ); // remove whitespace
	$title = ! empty( $title ) ? $title : '&nbsp;'; // if no title, use a space so tab shows
	$title = esc_html( $title ); // clean output
	
	// Set active section
	$active_class_attr = '';
	if ( 'true' == strtolower( $active ) ) {
		$active_class_attr = ' class="accordion-active"';
	}
	
	// Section content
	$section  = '<section' . $active_class_attr . '>';
	$section .= '<div class="accordion-section-title">' . $title . '</div>'; /* <h1> not used due to issue w/font switching */
	$section .= '<div class="accordion-content">';
	$section .= do_shortcode( $content ); // allow shortcodes in sections
	$section .= '</div>';
	$section .= '</section>';
		
	return $section;

}

/************************************************
 * QUOTE
 ************************************************/
 
// Shortcode: Quote
function risen_shortcode_quote( $atts, $content = null ) {

	// Get attributes, set defaults
	extract( shortcode_atts( array(
		'center'		=> '',
		'float'			=> '',
		'size'			=> '',
		'name'			=> ''
	), $atts ) );

	$content = trim( $content );
	
	// Default tag
	$tag = 'blockquote';
	
	// Start class array
	$classes = array( 'quote' );
	
	// Center Text
	if ( 'true' == strtolower( trim( $center ) ) ) {
		$classes[] = 'quote-centered';
	}
	
	// Size
	$no_size = false;
	$size = strtolower( trim( $size ) );
	if ( in_array( $size, array( 'one-third', 'one-half', 'two-thirds' ) ) ) {
		$classes[] = 'quote-' . $size;
	} else {
		$no_size = true;
	}
	
	// Float left/right
	$float = strtolower( trim( $float ) );
	if ( in_array( $float, array( 'right', 'left' ) ) ) {
	
		$classes[] = 'quote-float-' . $float;
		
		$tag = 'aside'; // it's a pull quote now
		
		// set a default size if floating and no size specified
		if ( true == $no_size ) {
			$size = 'one-half';
			$classes[] = 'quote-' . $size;
		}
		
	}
	
	// Name
	$name = trim( $name );
	$name = esc_html( $name );
	
	// Build quote
	$quote  = '<' . $tag . ' class="' . implode( ' ', $classes ) . '">';
	$quote .= do_shortcode( $content ); // allow shortcodes in content
	if ( ! empty( $name ) ) {
		$quote .= '<cite>&mdash; ' . $name . '</cite>';
	}
	$quote .= '</' . $tag . '>';

	return $quote;

}

/************************************************
 * BOX
 ************************************************/
 
// Shortcode: Box
function risen_shortcode_box( $atts, $content = null ) {

	// Get attributes, set defaults
	extract( shortcode_atts( array(
		'icon'	=> ''
	), $atts ) );
	
	// Allow shortcodes in boxes
	$content = do_shortcode( $content );

	// Start classes
	$classes = array( 'box', 'shortcode-box' );
	
	// Using icon?
	$icon = strtolower( trim( $icon ) );
	if ( in_array( $icon, array( 'alert', 'check', 'down', 'info', 'x' ) ) ) {
		
		// Map to icon font
		$icon_map = array(
			'alert'	=> 'warning-sign',
			'check'	=> 'check',
			'down'	=> 'download',
			'info'	=> 'info-sign',
			'x'		=> 'remove-sign'
		);
		$font_icon = isset( $icon_map[$icon] ) ? $icon_map[$icon] : '';

		$classes[] = 'risen-icon-message';
		
		$icon_content  = '<div class="icon risen-font-icon-' . $font_icon . '"></div>';
		$icon_content .= '<div class="risen-icon-message-content">';
		$icon_content .= $content;
		$icon_content .= '</div>';
		
		$content = $icon_content;
		
	}
	
	// Box container and content
	$box  = '<div class="' . implode( ' ', $classes ) . '">';
	$box .= $content;
	$box .= '</div>';
	
	return $box;

}

/************************************************
 * GOOGLE MAP
 ************************************************/
 
// Google Map
function risen_shortcode_google_map( $options ) {

	$options['show_error'] = true;
	
	$map = risen_google_map( $options );
	
	return $map;	

}

/************************************************
 * CONTACT FORM
 ************************************************/
 
// Shortcode: Contact Form
function risen_shortcode_contact_form() {

	// Get HTML from contact-form.php template
	$contact_form = risen_contact_form();
	
	// Get rid of line breaks and tabs to prevent <br /> and <p> being inserted
	// when used as shortcode when risen_shortcode_formatting() filter used (includes/shortcode.php)
	$contact_form = trim( str_replace( array( "\n", "\r", "\t" ), " ", $contact_form ) );
	$contact_form = str_replace( array( '  ', '  ' ), ' ', $contact_form ); // get rid of double spaces
	
	return $contact_form;

}

/************************************************
 * HELPER FUNCTIONS
 ************************************************/

// Create array of each instance of a tag in content and extract attributes for each tag
function risen_get_tag_attributes( $content, $tag, $attributes = array() ) {

	$tags = array();
	
	if ( ! empty( $content ) && ! empty( $tag ) && ! empty( $attributes ) ) {
		
		preg_match_all( '/\[' . preg_quote( $tag ) . '.*\]/i', $content, $matches, PREG_OFFSET_CAPTURE );
		$tags_array = isset( $matches[0] ) ? $matches[0] : array();
		
		$i = 0;
		foreach( $tags_array as $single_tag ) {
		
			$single_tag = isset( $single_tag[0] ) ? $single_tag[0] : '';
		
			foreach( $attributes as $attribute ) {
				preg_match( '/' . preg_quote( $attribute ) . '="([^\"]+)"/i', $single_tag, $matches, PREG_OFFSET_CAPTURE );
				$tags[$i][$attribute] = isset( $matches[1][0] ) ? $matches[1][0] : '';
			}
			
			$i++;
		
		}
	
	}

	return $tags;

}