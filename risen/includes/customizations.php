<?php
/**
 * Customization Functions
 *
 * Functions that help apply colors, background, fonts, logo, favicon, Google Analytics, show social icons, etc.
 */

/*******************************************
 * HEAD <title>
 *******************************************/

/**
 * Apply custom <title> format for homepage or subpage as specified in Theme Options
 *
 * Not used now that add_theme_support( 'title-tag' ); is used.
 */

if ( ! function_exists( 'risen_title' ) ) {

	function risen_title( $title, $sep, $seplocation ) {

		return $title;

		/*

		// Prevent double title in feed
		if ( is_feed() ) {
			return $title;
		}

		$title = trim( $title );

		// homepage title format from Theme Options
		if ( is_front_page() ) { // whether 'posts' (default homepage) or static page
			$title_format = risen_option( 'custom_home_title' ) ? risen_option( 'custom_home_title' ) : risen_option_default( 'custom_home_title' ); // if blank use default
		}

		// subpage title format from Theme Options
		else {
			$title_format = risen_option( 'custom_subpage_title' ) ? risen_option( 'custom_subpage_title' ) : risen_option_default( 'custom_subpage_title' ); // if blank use default
		}

		// make shortcode replacements
		$new_title = str_replace( '[page_title]', $title, $title_format ); // [page_title]
		$new_title = do_shortcode( $new_title ); // [site_name], [tagline]

		return $new_title;

	*/

	}

}

/*******************************************
 * APPLY STYLES
 *******************************************/

/**
 * Inject custom styles (colors, background, fonts) and logo (if uploaded) from Theme Options into <head>
 */

if ( ! function_exists( 'risen_styles' ) ) {

	function risen_styles() {

		// Colors
		$main_color = risen_option( 'main_color' ) ? risen_option( 'main_color' ) : risen_option_default( 'main_color' );
		$link_color = risen_option( 'link_color' ) ? risen_option( 'link_color' ) : risen_option_default( 'link_color' );

		// Background
		$background_type = risen_option( 'background_type' ) ? risen_option( 'background_type' ) : risen_option_default( 'background_type' );
		$background_color = risen_option( 'background_color' ) ? risen_option( 'background_color' ) : risen_option_default( 'background_color' );
		if ( 'preset' == $background_type ) { // Preset Background Image
			$background_presets = risen_background_image_presets();
			$background_image = risen_option( 'background_image_preset' ) ? risen_option( 'background_image_preset' ) : risen_option_default( 'background_image_preset' );
			$background_image_url = risen_locate_template_uri( 'images/backgrounds/' . $background_image ); // if image exists in child theme, use it; otherwise use parent theme's file
			$background_image_fullscreen = ! empty( $background_presets[$background_image]['fullscreen'] ) ? $background_presets[$background_image]['fullscreen'] : '';
			$background_image_repeat = ! empty( $background_presets[$background_image]['repeat'] ) ? $background_presets[$background_image]['repeat'] : '';
			$background_image_attachment = ! empty( $background_presets[$background_image]['attachment'] ) ? $background_presets[$background_image]['attachment'] : '';
			$background_image_size = ! empty( $background_presets[$background_image]['size'] ) ? $background_presets[$background_image]['size'] : '';
			$background_image_position = ! empty( $background_presets[$background_image]['position'] ) ? $background_presets[$background_image]['position'] : '';
		} else if ( 'upload' == $background_type ) { // Uploaded Background Image
			$background_image_url = risen_option( 'background_image_upload' );
			$background_image_fullscreen = risen_option( 'background_image_upload_fullscreen' ) ? risen_option( 'background_image_upload_fullscreen' ) : risen_option_default( 'background_image_upload_fullscreen' );
			$background_image_repeat = risen_option( 'background_image_upload_repeat' ) ? risen_option( 'background_image_upload_repeat' ) : risen_option_default( 'background_image_upload_repeat' );
			$background_image_attachment = risen_option( 'background_image_upload_attachment' ) ? risen_option( 'background_image_upload_attachment' ) : risen_option_default( 'background_image_upload_attachment' );
			$background_image_size = risen_option( 'background_image_upload_size' ) ? risen_option( 'background_image_upload_size' ) : risen_option_default( 'background_image_upload_size' );
			$background_image_position = risen_option( 'background_image_upload_position' );
		}

			// Prepare Background CSS Values
			// Note: background-size should be on its own line, not shorthand for best compatibility
			$background_css_values = array();
			if ( empty( $background_image_fullscreen ) ) { // fullscreen uses JavaScript and so these have no effect
				if ( ! empty( $background_color ) ) {
					$background_css_values[] = $background_color;
				}
				if ( ! empty( $background_image_url ) ) { // if preset or upload image exists
					$background_css_values[] = 'url(' . $background_image_url . ')';
					if ( ! empty( $background_image_repeat ) ) {
						$background_css_values[] = $background_image_repeat;
					}
					if ( ! empty( $background_image_position ) ) {
						$background_css_values[] = $background_image_position;
					}
					if ( ! empty( $background_image_attachment ) ) {
						$background_css_values[] = $background_image_attachment;
					}
				}
			}
			$background_css_values = implode( ' ', $background_css_values );

		// Fonts
		$body_font_stack = risen_font_stack( risen_option( 'body_font' ) );
		$menu_font_stack = risen_font_stack( risen_option( 'menu_font' ) );
		$heading_font_stack = risen_font_stack( risen_option( 'heading_font' ) );

?>
<?php if ( ! empty( $background_image_fullscreen ) &&  ! empty( $background_image_url ) ) : ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	if (screen.width > 480) { // mobile performance - no full image background if device not capable of showing media query width 480px
		jQuery.backstretch('<?php echo $background_image_url; ?>');
	}
});
</script>
<?php endif; ?>
<style type="text/css">
<?php if ( ! empty( $background_css_values ) ) : ?>
<?php echo risen_style_element_list( 'background' ); ?> {
	background: <?php echo $background_css_values; ?>;
	<?php if ( ! empty( $background_image_size ) ) : ?>background-size: <?php echo $background_image_size; ?>;<?php endif; ?>

}
<?php endif; ?>

<?php echo risen_style_element_list( 'link_color' ); ?> {
	color: <?php echo $link_color; ?>;
}

<?php echo risen_style_element_list( 'main_color' ); ?> {
	background-color: <?php echo $main_color; ?>;
}

<?php echo risen_style_element_list( 'body_font' ); ?> {
	font-family: <?php echo $body_font_stack; ?>;
}

<?php echo risen_style_element_list( 'menu_font' ); ?> {
	font-family: <?php echo $menu_font_stack; ?>;
}

<?php echo risen_style_element_list( 'heading_font' ); ?> {
	font-family: <?php echo $heading_font_stack; ?>;
}
</style>
<?php

	}

}

/**
 * Produce list of elements for specific style changes
 * This is used by risen_styles() and by the live demp style picker
 */

function risen_style_element_list( $target ) {

	$element_list = '';

	// Build elements array
	$areas = array(

		// Body Background
		'background' => array(
			'body'
		),

		// Main Color
		'main_color' => array(
			'#header-menu',
			'#footer-bottom',
			'.flex-caption',
			'.flex-control-nav li a.active',
			'#home-row-widgets .widget-image-title',
			'#page-header h1',
			'.sidebar-widget-title'
		),

		// Link Color
		'link_color' => array(
			'a',
			'.resurrect-list-icons a:hover',
			'.flex-caption a'
		),

		// Menu/Label Font
		'menu_font' => array(

			'#header-menu-links',
			'.flex-caption',
			'#home-row-widgets .widget-image-title',
			'#page-header h1',
			'h1.sidebar-widget-title',

			// buttons
			'a.button',
			'a.comment-reply-link',
			'a.comment-edit-link',
			'a.post-edit-link',
			'.nav-left-right a',
			'input[type=submit]'

		),

		// Heading Font
		'heading_font' => array(
			'.heading',
			'.page-title',
			'.post-content h1',
			'.post-content h2',
			'.post-content h3',
			'.post-content h4',
			'.post-content h5',
			'.post-content h6',
			'.author-box h1',
			'.staff header h1',
			'.location header h1',
			'#reply-title',
			'#comments-title',
			'.home-column-widgets-title',
			'.ppt', // lightbox title
			'#tagline',
			'#intro'
		),

		// Body Font
		'body_font' => array(
			'body',
			'input',
			'textarea',
			'select',
			'.multimedia-short h1',
			'#cancel-comment-reply-link',
			'.accordion-section-title',
			'.staff header h1 a',
		)

	);

	// Allow filtering
	$areas = apply_filters( 'risen_style_elements', $areas );

	// Build list
	if ( ! empty( $areas[$target] ) ) {
		$element_list = implode( ', ', $areas[$target] );
	}

	return $element_list;

}

/*******************************************
 * BASE STYLES
 *******************************************/

// Return array of base styles from styles directory
// If styles exist in child theme then use those instead of parent
function risen_base_styles() {

	$parent_styles_dir = RISEN_THEME_DIR . '/styles'; // parent theme
	$child_styles_dir = RISEN_CHILD_DIR . '/styles';
	$styles_dir = file_exists( $child_styles_dir ) ? $child_styles_dir : $parent_styles_dir;  // if a styles dir was made for child theme, use it

	$base_styles = array();
	if ( file_exists( $styles_dir ) && $handle = opendir( $styles_dir ) ) { // if styles directory exists in child theme, use it
		while ( false !== ( $entry = readdir($handle) ) ) { // loop style schemes available in style directory
			if ( ! preg_match( '/\./', $entry ) ) { // directories only
				$style_name = str_replace( array( '-', '_' ), ' ', $entry ); // replace - and _ with space
				$style_name = ucwords( $style_name ); // capitalize words
				$base_styles[$entry] = $style_name;
			}
		}
		closedir( $handle );
	}

	$base_styles = apply_filters( 'risen_base_styles', $base_styles );

	return $base_styles;

}

/**
 * Check if base style is valid
 * Make sure active base style is valid so nobody tries to mess with file path via front-end style picker cookie
 */

if ( ! function_exists( 'risen_valid_base_style' ) ) {

	function risen_valid_base_style() {

		$base_styles = risen_base_styles();
		$base_style = risen_option( 'base_style' );

		if ( ! empty( $base_styles[$base_style] ) ) {
			return true;
		}

		return false;

	}

}

/**
 * Check if child is overriding the active base style
 * Used by child theme
 */

if ( ! function_exists( 'risen_child_base_style_exists' ) ) {

	function risen_child_base_style_exists() {

		if ( risen_valid_base_style() ) { // make sure active base style is valid as security precaution

			$base_style = risen_option( 'base_style' );
			$base_style_child_path = RISEN_CHILD_DIR . '/styles/' . $base_style . '/style.css';

			if ( file_exists( $base_style_child_path ) ) {
				return true;
			}

		}

		return false;

	}

}

/**
 * Enqueue Base Style (Light or Dark, for example)
 * This is also used in child theme
 */

if ( ! function_exists( 'risen_enqueue_base_style' ) ) {

	function risen_enqueue_base_style( $handle, $theme = false ) {

		// make sure active base style is valid so nobody tries to mess with file path via front-end style picker cookie
		if ( risen_valid_base_style() ) {

			$base_style = risen_option( 'base_style' );

			$base_style_rel = 'styles/' . $base_style . '/style.css';

			$base_style_parent_path = RISEN_THEME_DIR . '/' . $base_style_rel;
			$base_style_parent_uri = RISEN_THEME_URI . '/' . $base_style_rel;

			$base_style_child_path = RISEN_CHILD_DIR . '/' . $base_style_rel;
			$base_style_child_uri = RISEN_CHILD_URI . '/' . $base_style_rel;

			// Force parent version
			if ( 'parent' == $theme && file_exists( $base_style_parent_path ) ) {
				$base_style_uri = $base_style_parent_uri;
			}

			// Force child version
			else if ( 'child' == $theme && file_exists( $base_style_child_path ) ) {
				$base_style_uri = $base_style_child_uri;
			}

			// Auto-detect (default)
			// If parent or child not explicit, use default behavior (child if exists, otherwise parent)
			else {
				$base_style_uri = risen_locate_template_uri( $base_style_rel ); // use child theme version if provided
			}

			// Enqueue it
			if ( ! empty( $base_style_uri ) ) { // only if file exists
				wp_enqueue_style( $handle, $base_style_uri, false, RISEN_VERSION );  // bust cache on theme update
			}

		}

	}

}

/*******************************************
 * PRESET BACKGROUNDS
 *******************************************/

/**
 * Preset Backgrounds
 * Backgrounds available in Theme Options as preset options
 */

function risen_background_image_presets() {

	// images are stored in wp-content/themes/risen/images/backgrounds
	// see documentation for manipulating preset image selection using a child theme
	// (note the filter hook at bottom of this function)

	$backgrounds = array(

		// Background Photos from PhotoDune
		// Included with this theme under Envato's Extended License
		// http://photodune.net/item/sun/1901106
		// http://photodune.net/item/wheat-field/586249

		'sun.jpg'	=> array(
			'thumb' => 'sun-thumb.jpg',
			'fullscreen' => true, // fit image to viewport (repeat, attachment, position and size have no effect when true)
			'repeat' => '',
			'attachment' => '',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		'wheat.jpg'	=> array(
			'thumb' => 'wheat-thumb.jpg',
			'fullscreen' => true, // fit image to viewport (repeat, attachment, position and size have no effect when true)
			'repeat' => '',
			'attachment' => '',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		// Elemis Wood Background
		// http://elemisfreebies.com/02/09/colorful-wood-background-3/
		// Free for commercial use and in ThemeForest themes

		'elemis-wood.jpg'	=> array(
			'thumb' => 'elemis-wood-thumb.jpg',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		'elemis-wood-dark.jpg'	=> array(
			'thumb' => 'elemis-wood-dark-thumb.jpg',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		'elemis-wood-colorable.png'	=> array(
			'thumb' => 'elemis-wood-colorable-thumb.png',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => true
		),

		// Subtle Patterns by Orman Clark
		// Free for commercial use and in ThemeForest themes
		// http://www.premiumpixels.com/freebies/11-light-subtle-patterns-pat/

		'orman-clark-subtle-pattern-7-colorable.png'	=> array(
			'thumb' => 'orman-clark-subtle-pattern-7-colorable-thumb.png',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => true
		),

		'orman-clark-subtle-pattern-6-colorable.png'	=> array(
			'thumb' => 'orman-clark-subtle-pattern-6-colorable-thumb.png',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => true
		),

		'orman-clark-subtle-pattern-2-colorable.png' => array(
			'thumb' => 'orman-clark-subtle-pattern-2-colorable-thumb.png',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => true
		),

		// Elemis Paper Texture (inverted into a grungle-like texture)
		// http://elemisfreebies.com/08/31/2-tileable-paper-textures/
		// Free for commercial use and in ThemeForest themes

		'elemis-paper-grunge.png'	=> array(
			'thumb' => 'elemis-paper-grunge-thumb.png',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => true
		),

		// Elemis Dark Wood (Plank) Texture
		// http://elemisfreebies.com/05/13/tileable-wood-texture-with-7-colors/
		// Free for commercial use and in ThemeForest themes

		'elemis-plank-dark.jpg'	=> array(
			'thumb' => 'elemis-plank-dark-thumb.jpg',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		// Elemis Brick Texture
		// http://elemisfreebies.com/02/23/tileable-brick-texture-with-15-colors/
		// Free for commercial use and in ThemeForest themes

		'elemis-brick.jpg'	=> array(
			'thumb' => 'elemis-brick-thumb.jpg',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		// Elemis Leather Texture
		// http://elemisfreebies.com/10/11/tileable-leather-texture-with-2-colors/
		// Free for commercial use and in ThemeForest themes

		'elemis-leather-light.jpg'	=> array(
			'thumb' => 'elemis-leather-light-thumb.jpg',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		// Elemis Corkboard Texture
		// http://elemisfreebies.com/09/02/tileable-corkboard-texture-with-6-color-options/
		// Free for commercial use and in ThemeForest themes

		'elemis-corkboard.jpg'	=> array(
			'thumb' => 'elemis-corkboard-thumb.jpg',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		// Dark Metal Grid Patterns by Orman Clark
		// Free for commercial use and in ThemeForest themes
		// http://www.premiumpixels.com/freebies/11-light-subtle-patterns-pat/

		'orman-clark-dark-metal-grid-3.png'	=> array(
			'thumb' => 'orman-clark-dark-metal-grid-3-thumb.jpg',
			'fullscreen' => false,
			'repeat' => 'repeat',
			'attachment' => 'scroll',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		// Bokeh Effect Backgrounds by Orman Clark
		// Free for commercial use and in ThemeForest themes
		// http://www.premiumpixels.com/freebies/5-bokeh-effect-backgrounds/

		'orman-clark-bokeh-1.jpg'	=> array(
			'thumb' => 'orman-clark-bokeh-1-thumb.jpg',
			'fullscreen' => true, // fit image to viewport (repeat, attachment, position and size have no effect when true)
			'repeat' => '',
			'attachment' => '',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		'orman-clark-bokeh-2.jpg'	=> array(
			'thumb' => 'orman-clark-bokeh-2-thumb.jpg',
			'fullscreen' => true, // fit image to viewport (repeat, attachment, position and size have no effect when true)
			'repeat' => '',
			'attachment' => '',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		'orman-clark-bokeh-3.jpg'	=> array(
			'thumb' => 'orman-clark-bokeh-3-thumb.jpg',
			'fullscreen' => true, // fit image to viewport (repeat, attachment, position and size have no effect when true)
			'repeat' => '',
			'attachment' => '',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		'orman-clark-bokeh-4.jpg'	=> array(
			'thumb' => 'orman-clark-bokeh-4-thumb.jpg',
			'fullscreen' => true, // fit image to viewport (repeat, attachment, position and size have no effect when true)
			'repeat' => '',
			'attachment' => '',
			'position' => '',
			'size' => '',
			'colorable' => false
		),

		'orman-clark-bokeh-5.jpg'	=> array(
			'thumb' => 'orman-clark-bokeh-5-thumb.jpg',
			'fullscreen' => true, // fit image to viewport (repeat, attachment, position and size have no effect when true)
			'repeat' => '',
			'attachment' => '',
			'position' => '',
			'size' => '',
			'colorable' => false
		)

	);

	$backgrounds = apply_filters( 'risen_background_image_presets', $backgrounds );

	return $backgrounds;

}

/**
 * List of Colorable Preset Backgrounds
 * helps tell admin.js which Theme Option background image presets should show the color picker
 */

if ( ! function_exists( 'risen_colorable_background_images' ) ) {

	function risen_colorable_background_images() {

		$colorable_backgrounds = '';

		$preset_backgrounds = risen_background_image_presets();
		foreach ( $preset_backgrounds as $image_file => $background_data ) {

			if ( ! empty( $background_data['colorable'] ) ) { // it's semi-transparent and can take advantage of background color

				if ( ! empty( $colorable_backgrounds  ) ) {
					$colorable_backgrounds .= ',';
				}

				$colorable_backgrounds .= $image_file;

			}

		}

		return $colorable_backgrounds;

	}

}

/*******************************************
 * GOOGLE FONTS
 *******************************************/

/**
 * Google Web Fonts
 * A selection of Google Web Fonts to choose in Theme Options
 * http://www.google.com/webfonts
 */

function risen_google_web_fonts() {

	// See documentation for manipulating preset font selection using a child theme
	// (note the filter hook at bottom of this function)

	// Fonts that look best in theme are not too big or small and have even space on top and bottom, so they fit anywhere nicely
	// (and so these are what were selected)

	$fonts = array(

		// Sans Serif Fonts

		'PT Sans' => array( // exact font name from Google to use in CSS font-family
			'sizes'	=> '400,700,400italic,700italic', // copied from Google URL (can be blank if single size)
			'type'	=> 'sans-serif' // serif, sans-serif, handwriting or display (for fallback)
		), // as an example, the above data came from this URL: http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic

		'Fresca' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Puritan' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'sans-serif'
		),

		'Dosis' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Abel' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Droid Sans' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Jockey One' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Lato' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'sans-serif'
		),

		'Cabin' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'sans-serif'
		),

		'Inder' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Economica' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'sans-serif'
		),

		'Michroma' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Acme' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Duru Sans' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Chau Philomene One' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'PT Sans Narrow' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Cabin Condensed' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Federo' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Quicksand' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Ubuntu' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'sans-serif'
		),

		'Cagliostro' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Tenor Sans' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Magra' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Russo One' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Sigmar One' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Convergence' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Asap' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'sans-serif'
		),

		'Days One' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Muli' => array(
			'sizes'	=> '400,400italic',
			'type'	=> 'sans-serif'
		),

		'Ubuntu Condensed' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Oxygen' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Nunito' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Homenaje' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Pontano Sans' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Open Sans' => array(
			'sizes'	=> '400italic,700italic,400,700',
			'type'	=> 'sans-serif'
		),

		'Oswald' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Yanone Kaffeesatz' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Francois One' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Cuprum' => array(
			'sizes'	=> '400,400italic,700,700italic',
			'type'	=> 'sans-serif'
		),

		'Maven Pro' => array(
			'sizes'	=> '400,500,700',
			'type'	=> 'sans-serif'
		),

		'Amaranth' => array(
			'sizes'	=> '400,400italic,700,700italic',
			'type'	=> 'sans-serif'
		),

		'PT Sans Caption' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Didact Gothic' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Allerta Stencil' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Inconsolata' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Signika' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Chivo' => array(
			'sizes'	=> '400,400italic,900italic,900',
			'type'	=> 'sans-serif'
		),

		'Comfortaa' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Shanti' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Varela' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Actor' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Spinnaker' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Hammersmith One' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Marmelad' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Aldrich' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Ruluko' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Doppio One' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Electrolize' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Karla' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'sans-serif'
		),

		'Galdeano' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		'Advent Pro' => array(
			'sizes'	=> '400,700',
			'type'	=> 'sans-serif'
		),

		'Imprima' => array(
			'sizes'	=> '',
			'type'	=> 'sans-serif'
		),

		// Serif Fonts

		'Caudex' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'serif'
		),

		'Brawler' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Cantata One' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Arvo' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'serif'
		),

		'Judson' => array(
			'sizes'	=> '400,700,400italic',
			'type'	=> 'serif'
		),

		'Neuton' => array(
			'sizes'	=> '400,700,400italic',
			'type'	=> 'serif'
		),

		'Lora' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'serif'
		),

		'Belgrano' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Tinos' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Simonetta' => array(
			'sizes'	=> '400,900,400italic,900italic',
			'type'	=> 'serif'
		),

		'Podkova' => array(
			'sizes'	=> '400,700',
			'type'	=> 'serif'
		),

		'PT Serif Caption' => array(
			'sizes'	=> '400,400italic',
			'type'	=> 'serif'
		),

		'Artifika' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Bitter' => array(
			'sizes'	=> '400,700,400italic',
			'type'	=> 'serif'
		),

		'PT Serif' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'serif'
		),

		'Mate SC' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Kreon' => array(
			'sizes'	=> '400,700',
			'type'	=> 'serif'
		),

		'Kameron' => array(
			'sizes'	=> '400,700',
			'type'	=> 'serif'
		),

		'Holtwood One SC' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Antic Didone' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Crete Round' => array(
			'sizes'	=> '400,400italic',
			'type'	=> 'serif'
		),

		'Josefin Slab' => array(
			'sizes'	=> '400,600,700,400italic,600italic,700italic',
			'type'	=> 'serif'
		),

		'Copse' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Tienne' => array(
			'sizes'	=> '400,700',
			'type'	=> 'serif'
		),

		'Amethysta' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'EB Garamond' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Droid Serif' => array(
			'sizes'	=> '400,700,400italic,700italic',
			'type'	=> 'serif'
		),

		'Crimson Text' => array(
			'sizes'	=> '400,400italic,700,700italic',
			'type'	=> 'serif'
		),

		'Cardo' => array(
			'sizes'	=> '400,400italic,700',
			'type'	=> 'serif'
		),

		'Bevan' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Old Standard TT' => array(
			'sizes'	=> '400,400italic,700',
			'type'	=> 'serif'
		),

		'Goudy Bookletter 1911' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Volkhov' => array(
			'sizes'	=> '400,400italic,700italic,700',
			'type'	=> 'serif'
		),

		'Bree Serif' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Noticia Text' => array(
			'sizes'	=> '400,400italic,700,700italic',
			'type'	=> 'serif'
		),

		'Alice' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Poly' => array(
			'sizes'	=> '400,400italic',
			'type'	=> 'serif'
		),

		'Almendra SC' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Adamina' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Vidaloka' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Arapey' => array(
			'sizes'	=> '400italic,400',
			'type'	=> 'serif'
		),

		'Lusitana' => array(
			'sizes'	=> '400,700',
			'type'	=> 'serif'
		),

		'Fanwood Text' => array(
			'sizes'	=> '400,400italic',
			'type'	=> 'serif'
		),

		'Trocchi' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Junge' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		'Alegreya SC' => array(
			'sizes'	=> '400,400italic,700italic,700',
			'type'	=> 'serif'
		),

		'Stoke' => array(
			'sizes'	=> '',
			'type'	=> 'serif'
		),

		// Display Fonts

		'Nova Round' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Alfa Slab One' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Codystar' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Fredericka the Great' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Cabin Sketch' => array(
			'sizes'	=> '400,700',
			'type'	=> 'display'
		),

		'Cherry Cream Soda' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Maiden Orange' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Corben' => array(
			'sizes'	=> '400,700',
			'type'	=> 'display'
		),

		'Kelly Slab' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Limelight' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Lobster' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Fugaz One' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Smythe' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Frijole' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Fontdiner Swanky' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Monoton' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Chewy' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Luckiest Guy' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Lobster Two' => array(
			'sizes'	=> '400,700italic,700,400italic',
			'type'	=> 'display'
		),

		'Salsa' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Carter One' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Kranky' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Gruppo' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Mountains of Christmas' => array(
			'sizes'	=> '400,700',
			'type'	=> 'display'
		),

		'Stardos Stencil' => array(
			'sizes'	=> '400,700',
			'type'	=> 'display'
		),

		'Miltonian Tattoo' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Sansita One' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Changa One' => array(
			'sizes'	=> '400italic,400',
			'type'	=> 'display'
		),

		'Bowlby One SC' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Love Ya Like A Sister' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Share' => array(
			'sizes'	=> '400,400italic,700,700italic',
			'type'	=> 'display'
		),

		'Coda' => array(
			'sizes'	=> '400,800',
			'type'	=> 'display'
		),

		'Bangers' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Sancreek' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Modern Antiqua' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Abril Fatface' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Happy Monkey' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Righteous' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Black Ops One' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Baumans' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Megrim' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Wallpoet' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Boogaloo' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Chelsea Market' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Playball' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Miltonian' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Ribeye Marrow' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Ewert' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		'Audiowide' => array(
			'sizes'	=> '',
			'type'	=> 'display'
		),

		// Handwriting Fonts

		'Shadows Into Light Two' => array( // exact font name from Google to use in CSS font-family
			'sizes'			=> '', // copied from Google URL (can be blank if single size)
			'type'			=> 'handwriting' // serif, sans-serif, handwriting or display (for fallback)
		), // http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic

		'Princess Sofia' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Patrick Hand' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Crafty Girls' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Permanent Marker' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Sue Ellen Francisco' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Parisienne' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Delius Swash Caps' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Montez' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Short Stack' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Neucha' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Bad Script' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Sofia' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Marck Script' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Swanky and Moo Moo' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Allura' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Waiting for the Sunrise' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Reenie Beanie' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Schoolbell' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Redressed' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Walter Turncoat' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Gloria Hallelujah' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Tangerine' => array(
			'sizes'	=> '400,700',
			'type'	=> 'handwriting'
		),

		'Just Me Again Down Here' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Dynalight' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Great Vibes' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Playball' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Seaweed Script' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Dancing Script' => array(
			'sizes'	=> '400,700',
			'type'	=> 'handwriting'
		),

		'Rock Salt' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Pacifico' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Sunshiney' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Architects Daughter' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Indie Flower' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Covered By Your Grace' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Leckerli One' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Rancho' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Rochester' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Delius Unicase' => array(
			'sizes'	=> '400,700',
			'type'	=> 'handwriting'
		),

		'Nothing You Could Do' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Cookie' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Satisfy' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Damion' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Over the Rainbow' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Cedarville Cursive' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Norican' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Dawning of a New Day' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Kaushan Script' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		),

		'Berkshire Swash' => array(
			'sizes'	=> '',
			'type'	=> 'handwriting'
		)

	);

	// Enable filtering to add/remove fonts
	$fonts = apply_filters( 'risen_google_web_fonts', $fonts );

	return $fonts;

}

/**
 * Define Font Stacks
 * Default font stacks for each type of font
 */

function risen_default_font_stacks() {

	// These fonts in the given order when available will be used for each type if for whatever reason the browser cannot load the Google font
	$default_font_stacks = array(
		'serif'			=> "Georgia, 'Bitstream Vera Serif', 'Times New Roman', Times, serif",
		'sans-serif'	=> "Arial, Helvetica, sans-serif",
		'display'		=> "Arial, Helvetica, sans-serif",
		'handwriting'	=> "Georgia, 'Bitstream Vera Serif', 'Times New Roman', Times, cursive"
	);

	// Enable filtering to change default font stacks
	$default_font_stacks = apply_filters( 'risen_default_font_stacks', $default_font_stacks );

	return $default_font_stacks;

}

/**
 * Font Stack based on Google Font's Type
 * Build a font stack based on font and its type - use in CSS
 */

if ( ! function_exists( 'risen_font_stack' ) ) {

	function risen_font_stack( $font ) {

		// Get the default dont stack for each type
		$default_font_stacks = risen_default_font_stacks();

		// Build font stack with Google font as primary
		$available_fonts = risen_google_web_fonts();
		if ( ! empty( $available_fonts[$font] ) && ! empty( $default_font_stacks[$available_fonts[$font]['type']] ) ) {
			$default_font_stack = $default_font_stacks[$available_fonts[$font]['type']];
		} else { // if invalid, type use first in list (should be serif)
			$default_font_stack = current( $default_font_stacks );
		}
		$font_stack = "'" . $font . "', " . $default_font_stack;

		return $font_stack;

	}

}

/*******************************************
 * LOGO
 *******************************************/

/**
 * Logo URL
 * Return the uploaded logo URL or use light or dark default logo
 */

if ( ! function_exists( 'risen_logo_url' ) ) {

	function risen_logo_url( $hidpi = false ) {

		// Regular or HiDPI
		if ( ! $hidpi ) {
			$option = 'logo';
			$default_file = 'logo.png';
		} else {
			$option = 'logo_hidpi';
			$default_file = 'logo-hidpi.png';
		}

		// Get uploaded logo
		$logo_url = risen_option( $option );

		// No uploaded logo - use theme default
		if ( empty( $logo_url ) ) {

			// Light or dark style?
			$base_style = risen_option( 'base_style' );
			$base_style = ! empty( $base_style ) ? $base_style : 'light'; // just in case

			// URL to logo for base style
			$logo_url = risen_locate_template_uri( 'styles/' . $base_style . '/images/' . $default_file ); // if image exists in child theme, use it; otherwise use parent theme's file

		}

		return $logo_url;

	}

}

/***********************************
 * SOCIAL ICONS (Header/Footer)
 ***********************************

/**
 * Icons available
 *
 * This is used in displaying icons with risen_social_icons() and
 * to tell which social networks are supported with risen_social_icon_sites().
 *
 * @since 2.0
 * @return array Icon map
 */
function risen_icon_map() {

	 // Social media sites with icons
	$icon_map = array(

		// CSS Class 								// Match in URL 	// Site Name
		'risen-font-icon-facebook'		=> array(	'facebook',			'Facebook' ),
		'risen-font-icon-twitter'		=> array(	'twitter',			'Twitter' ),
		'risen-font-icon-googleplus'	=> array(	'plus.google',		'Google+' ),
		'risen-font-icon-pinterest'		=> array( 	'pinterest',		'Pinterest' ),
		'risen-font-icon-youtube'		=> array( 	'youtube',			'YouTube' ),
		'risen-font-icon-vimeo'			=> array( 	'vimeo', 			'Vimeo' ),
		'risen-font-icon-flickr'		=> array( 	'flickr',			'Flickr' ),
		'risen-font-icon-picasa'		=> array( 	'picasa',			'Picasa' ),
		'risen-font-icon-instagram'		=> array( 	'instagram',		'Instagram' ),
		'risen-font-icon-foursquare'	=> array( 	'foursquare',		'Foursquare' ),
		'risen-font-icon-tumblr'		=> array( 	'tumblr',			'Tumblr' ),
		'risen-font-icon-skype'			=> array( 	'skype', 			'Skype' ),
		'risen-font-icon-soundcloud'	=> array( 	'soundcloud', 		'SoundCloud' ),
		'risen-font-icon-linkedin'		=> array( 	'linkedin', 		'LinkedIn' ),
		'risen-font-icon-stumbleupon'	=> array( 	'stumbleupon',		'StumbleUpon' ),
		'risen-font-icon-github'		=> array( 	'github',			'GitHub' ),
		'risen-font-icon-dribble'		=> array( 	'dribbble',			'Dribbble' ),
		'risen-font-icon-podcast'		=> array( 	array( 'itunes', 'podcast' ),	'Podcast' ),
		'risen-font-icon-rss'			=> array( 	array( 'rss', 'feed', 'atom' ), 'RSS' ),
		'risen-font-icon-website-alt'	=> array( 	'http', 			'Website' ), // anything not matching the above will show a generic website icon

	);

	// Return filtered
	return apply_filters( 'risen_icon_map', $icon_map );

}

/**
 * List of sites with icons
 *
 * Shown to user in Theme Customizer
 *
 * @since 2.0
 * @param bool $or True to use "or"; otherwise "and"
 * @return string List of sites with icons
 */
function risen_icon_sites( $or = false ) {

	$icon_map = risen_icon_map();

	$sites_with_icons = '';
	$sites_with_icons_count = count( $icon_map );

	$i = 0;

	foreach ( $icon_map as $site_data ) { // make list of sites with icons

		$i++;

		if ( $i > 1 ) { // not first one
			if ( $i < $sites_with_icons_count ) { // not last one
				$sites_with_icons .= _x( ', ', 'social icons list', 'risen' );
			} else { // last one
				if ( ! empty( $or ) ) {
					$sites_with_icons .= _x( ' or ', 'social icons list', 'risen' );
				} else {
					$sites_with_icons .= _x( ' and ', 'social icons list', 'risen' );
				}
			}
		}

		$sites_with_icons .= $site_data[1];

	}

	return apply_filters( 'risen_icon_sites', $sites_with_icons );

}

/**
 * Show icons
 *
 * @since 2.0
 * @param array $urls URLs set in Customizer
 * @param bool $return Return or echo
 * @return string Icons HTML if not echoing
 */
function risen_icons( $location = false ) {

	$icon_list = '';

	// Header or Footer?
	$location = in_array( $location, array( 'header', 'footer' ) ) ? $location : 'header';
	$option_key = $location . '_icon_urls';
	$urls = risen_option( $option_key );

	// Have URLs?
	if ( ! empty( $urls ) ) {

		// Available Icons
		$icon_map = risen_icon_map();

		// Loop URLs (in order entered by user) to build icon list
		$icon_items = '';
		$url_array = explode( "\n", $urls );
		foreach ( $url_array as $url ) {

			$url = trim( $url );

			// URL is valid
			if ( ! empty( $url ) && ( '[feed_url]' == $url || preg_match( '/^(http(s*)):\/\/(.+)\.(.+)|skype:(.+)/i', $url ) ) ) { // basic URL check

				// Find matching icon
				foreach ( $icon_map as $icon_class => $site_data ) {

					$url_checks = (array) $site_data[0];
					$url_matched = false;

					foreach ( $url_checks as $url_match ) {
						if ( preg_match( '/' . preg_quote( $url_match ) . '/i', $url ) && ! $url_matched ) {
							$url_matched = true;
							$icon_items .= '	<li><a href="' . esc_attr( $url ) . '" class="' . esc_attr( $icon_class ) . '" title="' . esc_attr( $site_data[1] ) . '" target="' . apply_filters( 'risen_icons_link_target', '_blank' ) . '"></a></li>' . "\n";
						}
					}

					if ( $url_matched ) {
						break;
					}

				}

			}

		}

		// Wrap with <ul> tags and apply shortcodes
		if ( ! empty( $icon_items ) ) {
			$icon_list = '<ul id="' . $location . '-icons" class="risen-list-font-icons">' . "\n";
			$icon_list .= do_shortcode( $icon_items ); // for [feed_url]
			$icon_list .= '</ul>';
		}

	}

	// Echo or return filtered
	$icon_list = apply_filters( 'risen_icons', $icon_list, $urls );
	echo $icon_list;

}

/*******************************************
 * FAVICON
 *******************************************/

/**
 * Apply favicon chosen in theme options
 */

function risen_favicon() {

	$favicon_uri = risen_option( 'favicon' );

	// Favicon has been uploaded and is ICO or PNG file
	if ( ! empty( $favicon_uri ) && preg_match( '/\.(png|ico)$/i', $favicon_uri ) ) {
		echo '<link rel="shortcut icon" href="' . esc_attr($favicon_uri) . '" />' . "\n";
	}

}

/*******************************************
 * GOOGLE ANALYTICS
 *******************************************/

/**
 * Insert tracking code (usually Google Analytics) from theme options into header.php's <head>
 */

function risen_google_analytics() {

	// Add Google Analytics code if Property ID was supplied
	$ga_property_id = risen_option( 'ga_property_id' );
	if ( ! empty( $ga_property_id ) ) {

?>
<script type="text/javascript">

var _gaq = _gaq || [];
_gaq.push(['_setAccount', '<?php echo $ga_property_id; ?>']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

</script>
<?php

	}

}
