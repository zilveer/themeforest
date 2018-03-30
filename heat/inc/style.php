<?php
/**
 * Filter Primary Typography Fonts.
 */
function filter_ot_recognized_font_families( $array, $field_id ) {
  if ( $field_id == 'primary_typography' || $field_id == 'menu_typography' || $field_id == 'header_typography' ) {
  
	$systemFontSelect = array(
		'Arial' => 'Arial',
		'Calibri' => 'Calibri',
		'Century Gothic' => 'Century Gothic',
		'Courier' => 'Courier',
		'Courier New' => 'Courier New',
		'Georgia' => 'Georgia',
		'Modern' => 'Modern',
		'Tahoma' => 'Tahoma',
		'Times New Roman' => 'Times New Roman',
		'Trebuchet MS' => 'Trebuchet MS',
		'Verdana' => 'Verdana'
	);
  
    $array = $systemFontSelect;
  }
  
  return $array;
  
}
add_filter( 'ot_recognized_font_families', 'filter_ot_recognized_font_families', 10, 2 );

/**
 * A safe way to add/enqueue a CSS/JavaScript to the wordpress generated page. 
 */
function mega_enqueue_google_fonts() {
	$google_font_family = ot_get_option( 'google_font_family' );
	if ( ! empty( $google_font_family ) ) {
		echo $google_font_family;
	}
}
add_action( 'wp_head', 'mega_enqueue_google_fonts' );

function mega_enqueue_menu_google_fonts() {
	$menu_google_font_family = ot_get_option( 'menu_google_font_family' );
	if ( ! empty( $menu_google_font_family ) ) {
		echo $menu_google_font_family;
	}
}
add_action( 'wp_head', 'mega_enqueue_menu_google_fonts' );

function mega_enqueue_header_google_fonts() {
	$header_google_font_family = ot_get_option( 'header_google_font_family' );
	if ( ! empty( $header_google_font_family ) ) {
		echo $header_google_font_family;
	}
}
add_action( 'wp_head', 'mega_enqueue_header_google_fonts' );

/**
 * Add a style block to the theme for the primary typography.
 */
function mega_print_primary_typography() {
	$primary_typography = ot_get_option( 'primary_typography', array() );
	
	// Don't do anything if the font-color is empty or the default.
	if ( ! empty( $primary_typography['font-color'] ) && $primary_typography['font-color'] !== '#111111' ) :
?>
	<style>
		/* Primary Text Color */
		body,
		a:focus,
		a:active,
		a:hover,
		#site-title a,
		.widget ul li,
		.entry-title,
		.entry-title a,
		h1 a,
		#content #filters a.selected,
		.widget_pages a,
		.ui-accordion .ui-state-default a,
		.ui-accordion .ui-state-default a:link,
		.ui-accordion .ui-state-default a:visited,
		#site-generator a,
		.more-link,
		.widget-title,
		.widget-area,
		.comment-reply-link,
		.comment-edit-link,
		.entry-meta a:focus,
		.entry-meta a:active,
		.entry-meta a:hover,
		#site-generator .social:focus,
		#site-generator .social:active,
		#site-generator .social:hover,
		#content nav a:focus,
		#content nav a:active,
		#content nav a:hover {
			color: <?php echo $primary_typography['font-color']; ?>;
		}
		#respond input#submit {
			background-color: <?php echo $primary_typography['font-color']; ?>;
		}
		abbr,
		acronym,
		dfn,
		input[type="text"]:focus,
		input[type="password"]:focus,
		textarea:focus,
		#respond input[type="text"]:focus,
		#respond textarea:focus {
			border-color: <?php echo $primary_typography['font-color']; ?>;
		}
		a:focus > .sf-sub-indicator,
		a:hover > .sf-sub-indicator,
		a:active > .sf-sub-indicator,
		li:hover > a > .sf-sub-indicator,
		li.sfHover > a > .sf-sub-indicator {
			border-top-color: <?php echo $primary_typography['font-color']; ?>;
		}
	</style>
<?php
	endif;
	
	$google_font_name = ot_get_option( 'google_font_name' );
	
	if ( ! empty( $google_font_name ) ) {
		$primary_font = $google_font_name;
	} else if ( ! empty( $primary_typography['font-family'] ) ) {
		$primary_font = $primary_typography['font-family'];
	}
	
	// Don't do anything if the font-family is empty.
	if ( ! empty( $primary_typography['font-family'] ) || ! empty( $google_font_name ) ) :
?>
	<style>
		/* Primary Typography */
		body, input, textarea, select {
			font-family: "<?php echo $primary_font; ?>", 'Helvetica Neue', Helvetica, sans-serif;
		}
		/* AddThis Typography */
		#at16recap, #at_msg, #at16p label, #at16nms, #at16sas, #at_share .at_item, #at16p, #at15s, #at16p form input, #at16p textarea {
			font-family: "<?php echo $primary_font; ?>", 'Helvetica Neue', Helvetica, sans-serif !important;
		}
	</style>
<?php
	endif;
}
add_action( 'wp_head', 'mega_print_primary_typography' );

/**
 * Add a style block to the theme for the header typography.
 */
function mega_print_menu_typography() {
	$menu_typography = ot_get_option( 'menu_typography' );
	
	$menu_google_font_name = ot_get_option( 'menu_google_font_name' );
	
	if ( ! empty( $menu_google_font_name ) ) {
		$menu_font = $menu_google_font_name;
	} else if ( ! empty( $menu_typography['font-family'] ) ) {
		$menu_font = $menu_typography['font-family'];
	}
	
	
	// Don't do anything if the font-family is empty.
	if ( ! empty( $menu_typography['font-family'] ) || ! empty( $menu_google_font_name ) ) :
?>
	<style>
		/* Menu Typography */
		#access ul {
			font-family: "<?php echo $menu_font; ?>", 'Helvetica Neue', Helvetica, sans-serif;
		}
	</style>
<?php
	endif;
}
add_action( 'wp_head', 'mega_print_menu_typography' );

/**
 * Add a style block to the theme for the header typography.
 */
function mega_print_header_typography() {
	$header_typography = ot_get_option( 'header_typography' );
	
	$header_google_font_name = ot_get_option( 'header_google_font_name' );
	
	if ( ! empty( $header_google_font_name ) ) {
		$header_font = $header_google_font_name;
	} else if ( ! empty( $header_typography['font-family'] ) ) {
		$header_font = $header_typography['font-family'];
	}
	
	
	// Don't do anything if the font-family is empty.
	if ( ! empty( $header_typography['font-family'] ) || ! empty( $header_google_font_name ) ) :
?>
	<style>
		/* Header Typography */
		h1, h2, h3, h4, h5, h6 {
			font-family: "<?php echo $header_font; ?>", 'Helvetica Neue', Helvetica, sans-serif;
		}
	</style>
<?php
	endif;
}
add_action( 'wp_head', 'mega_print_header_typography' );

/**
 * Add a style block to the theme for the primary link color.
 */
function mega_print_primary_link_color_style() {
	$primary_link_color = ot_get_option( 'primary_link_color' );
	
	// Don't do anything if the primary link color is empty or the default.
	if ( empty( $primary_link_color ) || $primary_link_color == '#ababab' )
		return;
?>
	<style>
		/* Primary Link color */
		a,
		#filters a {
			color: <?php echo $primary_link_color; ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_primary_link_color_style' );

/**
 * Add a style block to the theme for the secondary link color.
 */
function mega_print_secondary_link_color_style() {
	$secondary_link_color = ot_get_option( 'secondary_link_color' );
	
	// Don't do anything if the secondary link color is empty or the default.
	if ( empty( $secondary_link_color ) || $secondary_link_color == '#666666' )
		return;
?>
	<style>
		/* Secondary Link color */
		#site-generator .social {
			color: <?php echo $secondary_link_color; ?>;
		}
		#respond input#submit:hover,
		#respond input#submit:active {
			background-color: <?php echo $secondary_link_color; ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_secondary_link_color_style' );

/**
 * Add a style block to the theme for the navigation link color.
 */
function mega_print_navigation_link_color_style() {
	$navigation_link_color = ot_get_option( 'navigation_link_color' );
	
	// Don't do anything if the navigation link color is empty or the default.
	if ( empty( $navigation_link_color ) || $navigation_link_color == '#ff7260' )
		return;
?>
	<style>
		/* Navigation Link color */
		#access ul li a:hover,
		#access ul li.sfHover > a,
		#access ul .current-menu-item > a,
		#access ul .current_page_item > a {
			color: <?php echo $navigation_link_color; ?>;
		}
		#access ul li li a:hover,
		#access ul li li.sfHover > a,
		#access ul li .current-menu-item > a,
		#access ul li .current_page_item > a {
			color: <?php echo $navigation_link_color; ?>;
		}
		a:focus > .sf-sub-indicator,
		a:hover > .sf-sub-indicator,
		a:active > .sf-sub-indicator,
		li:hover > a > .sf-sub-indicator,
		li.sfHover > a > .sf-sub-indicator {
			border-top-color: <?php echo $navigation_link_color; ?>;
		}
		#access ul ul a:focus > .sf-sub-indicator,
		#access ul ul a:hover > .sf-sub-indicator,
		#access ul ul a:active > .sf-sub-indicator,
		#access ul ul li:hover > a > .sf-sub-indicator,
		#access ul ul li.sfHover > a > .sf-sub-indicator {
			border-left-color: <?php echo $navigation_link_color; ?>;
		}
		.ui-tabs .ui-tabs-nav .ui-tabs-active {
			border-color: <?php echo $navigation_link_color; ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_navigation_link_color_style' );

/**
 * Add a style block to the theme for the secondary text color.
 */
function mega_print_secondary_text_color() {
	$secondary_text_color = ot_get_option( 'secondary_text_color' );
	
	// Don't do anything if the secondary text color is empty or the default.
	if ( empty( $secondary_text_color ) || $secondary_text_color == '#cfcfcf' )
		return;
?>
	<style>
		/* Secondary Text Color */
		input#s,
		label[for="s"]::before,
		.entry-meta,
		.entry-meta a,
		.entry-meta p,
		.sep,
		.archive footer.entry-meta span,
		.search footer.entry-meta span,
		.blog footer.entry-meta span,
		.jta-tweet-timestamp a {
			color: <?php echo $secondary_text_color; ?>;
		}
		input[type=text],
		input[type=password],
		textarea
		#respond input[type="text"],
		#respond textarea {
			border-color: <?php echo $secondary_text_color; ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_secondary_text_color' );

/**
 * Add a style block to the theme for the body background color.
 */
function mega_print_body_background_color() {
	$body_background_color = ot_get_option( 'body_background_color' );
	
	// Don't do anything if the body background color is empty or the default.
	if ( empty( $body_background_color ) || $body_background_color == '#f5f5f5' )
		return;
?>
	<style>
		/* Body Background Color */
		body {
			background-color: <?php echo $body_background_color; ?> !important;
		}
	</style>
<?php
}
add_action( 'wp_head', 'mega_print_body_background_color' );
