<?php
function flow_customize_sanitize_background_size( $value ) {
	$safe = array( 'contain', 'cover' ); // Empty string will be returned instead of default 'auto'.
	return in_array( $value, $safe ) ? $value : '';
}

function flow_customize_register( $wp_customize ) {
	
	// Adjust some existing settings.
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Site identity section.
	$wp_customize->add_setting( 'flow_logo', array(
		'default' => '',
		'type' => 'option',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'flow_logo', array(
		'label' => __( 'Logo image', 'flowthemes' ),
		'description' => __( 'When image logo is uploaded the site title and tagline are not displayed.', 'flowthemes' ),
		'section' => 'title_tagline',
		'priority' => 10,
	) ) );

	// Theme settings section.
	$wp_customize->add_section( 'flow_theme_settings', array(
		'title' => __( 'Theme Settings', 'flowthemes' ),
		'priority' => 35,
		'description' => __( 'Allows you to customize some general settings for this theme.', 'flowthemes' ),
	) );
	
	$wp_customize->add_setting( 'info_box', array(
		'default' => '',
		'type' => 'option',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'info_box', array(
		'label'      => __( 'Top drop-down panel', 'flowthemes' ),
		'section'    => 'flow_theme_settings',
		'type'       => 'dropdown-pages',
	) );

	$wp_customize->add_setting( 'flow_portfolio_page', array(
		'default' => '',
		'type' => 'option',
		'transport' => 'refresh',
	) );

	$wp_customize->add_control( 'flow_portfolio_page', array(
		'label'      => __( 'Main portfolio page', 'flowthemes' ),
		'section'    => 'flow_theme_settings',
		'type'       => 'dropdown-pages',
	) );

	// Add background-size support for add_theme_support( 'custom-background' ).
	$wp_customize->add_setting( 'flow_background_size', array(
		'default' => '',
		'sanitize_callback' => 'flow_customize_sanitize_background_size',
		'transport' => 'postMessage',
	 ) );

	$wp_customize->add_control( 'flow_background_size', array(
		'label' => __( 'Background Size', 'flowthemes' ),
		'section' => 'background_image',
		'theme_supports' => 'custom-background',
		'type' => 'radio',
		'choices' => array(
			'auto' => __( 'Auto', 'flowthemes' ),
			'contain' => __( 'Contain', 'flowthemes' ),
			'cover' => __( 'Cover', 'flowthemes' ),
		),
	) );

	// Colors section.
	$wp_customize->add_setting( 'flow_accent_color', array(
		'default' => '#00a4a7',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'flow_accent_color', array(
		'label' => __( 'Accent color', 'flowthemes' ),
		'section' => 'colors',
	) ) );

	$wp_customize->add_setting( 'custom_css_style', array(
		'default' => '',
		'type' => 'option',
		'sanitize_callback' => 'wp_filter_nohtml_kses', // @TODO: This isn't the best sanitization method but it's sufficient for now.
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'custom_css_style', array(
		'label' => __( 'Custom CSS', 'flowthemes' ),
		'section' => 'colors',
		'type' => 'textarea',
	) ) );

	// Footer section.
	$wp_customize->add_section( 'flow_footer', array(
		'title' => __( 'Footer', 'flowthemes' ),
		'description' => __( 'Footer', 'flowthemes' ),
		'priority' => 140,
	) );
}
add_action( 'customize_register', 'flow_customize_register' );

/**
 * Binds JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 */
function flow_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20141216', true );
}
add_action( 'customize_controls_enqueue_scripts', 'flow_customize_control_js' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @return void
 */
function flow_customize_preview_js() {
	wp_enqueue_script( 'flow-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'flow_customize_preview_js' );

function flow_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
	$return = '';
	$mod = get_theme_mod($mod_name);
	if ( ! empty( $mod ) ) {
		$return = sprintf('%s { %s:%s; }', $selector, $style, $prefix.$mod.$postfix);
		if ( $echo ) {
			echo $return;
		}
	}
	return $return;
}

/**
 * Prints CSS for options on front-end.
 *
 * @TODO It prints this even with default values.
 */
function flow_customize_wp_head() {
	echo '<style type="text/css" id="flow-custom-background-css">';
		flow_generate_css( 'body', 'background-size', 'flow_background_size' );
	echo '</style>';
}
add_action( 'wp_head' , 'flow_customize_wp_head' );

/**
 * Prints custom CSS on front-end.
 *
 * @TODO Use better CSS sanitization like JetPack plugin http://wordpress.stackexchange.com/questions/53970/sanitize-user-entered-css
 *       Current doesn't allow " and ' among other things.
 */
function flow_customize_add_custom_css(){
	$custom_css_style = get_option( 'custom_css_style' );
	if ( $custom_css_style ) {
		echo '<style type="text/css" id="flow-custom-css">' . wp_filter_nohtml_kses( $custom_css_style ) . '</style>';
	}
}
add_action( 'wp_head', 'flow_customize_add_custom_css', 11 );

/**
 * Enqueues front-end CSS for color scheme.
 */
function flow_color_scheme_css() {
	$accent_color_option = get_theme_mod( 'flow_accent_color', '#00a4a7' );
	
	// Don't do anything if the default accent color is selected.
	if ( '#00a4a7' === $accent_color_option ) {
		return;
	}
	
	$colors[ 'accent_color' ] = $accent_color_option;
	$color_scheme_css = flow_get_color_scheme_css( $colors );

	wp_add_inline_style( 'flow-style', $color_scheme_css[0] );
	wp_add_inline_style( 'flow-content-slider', $color_scheme_css[1] );
	wp_add_inline_style( 'flow-portfolio-style', $color_scheme_css[2] );
	wp_add_inline_style( 'ns-isotope', $color_scheme_css[3] );
}
add_action( 'wp_enqueue_scripts', 'flow_color_scheme_css' );

/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function flow_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'accent_color'                => '',
	) );

	$css[] = <<<CSS
	/* Color Scheme */
	a { color: {$colors['accent_color']}; }
	a:hover { color: {$colors['accent_color']}; }

	button:hover, button:focus, input[type="submit"]:hover,
	input[type="button"]:hover, input[type="reset"]:hover,
	input[type="submit"]:focus, input[type="button"]:focus,
	input[type="reset"]:focus { background-color: {$colors['accent_color']}; }
	.post-password-required input[type="submit"]:hover { color: {$colors['accent_color']}; }
	
	.site-title:hover { color: {$colors['accent_color']}; }

	.menu-item[class^="modernpicrograms-icon-"].has-submenu:hover > a:before,
	.menu-item[class*=" modernpicrograms-icon-"].has-submenu:hover > a:before { color: {$colors['accent_color']}; }
	.nav-menu li:hover > a,
	.nav-menu li a:hover { color: {$colors['accent_color']}; }
	.nav-menu > .has-submenu:hover > a,
	.nav-menu > .has-submenu > a:hover { background-color: {$colors['accent_color']}; }
	.nav-menu .menu-item[class^="modernpicrograms-icon-"] > a:before:hover,
	.menu-item[class*=" modernpicrograms-icon-"] > a:before:hover,
	.nav-menu .menu-item[class^="modernpicrograms-icon-"]:hover > a:before,
	.menu-item[class*=" modernpicrograms-icon-"]:hover > a:before { color: {$colors['accent_color']}; }
	.nav-menu .menu-item[class^="modernpicrograms-icon-"] > a:before:hover,
	.menu-item[class*=" modernpicrograms-icon-"] > a:before:hover,
	.nav-menu .menu-item[class^="modernpicrograms-icon-"]:hover > a:before,
	.menu-item[class*=" modernpicrograms-icon-"]:hover > a:before { color: {$colors['accent_color']}; }
	.nav-menu > .current_page_item > a,
	.nav-menu > .current-menu-item > a { color: {$colors['accent_color']}; }
	
	.entry-title a:hover { color: {$colors['accent_color']}; }

	.blog-comments-wrapper:hover .blog-comments-icon-shape path { fill: {$colors['accent_color']}; }
	.blog-comments-wrapper:hover .blog-comments-icon-shape path { stroke: {$colors['accent_color']}; }
	.blog-comments-wrapper.blog-comments-wrapper-zero:hover .blog-comments-icon-shape path { stroke: {$colors['accent_color']}; }
	.blog-comments-value a { color: #fff; }

	.attachment .single-meta .full-size-link a:hover { color: {$colors['accent_color']}; }
	.attachment .single-meta .parent-post-link a:hover { color: {$colors['accent_color']}; }
	.attachment .single-meta .edit-link a:hover { color: {$colors['accent_color']}; }

	.paging-navigation .nav-previous a:hover,
	.paging-navigation .nav-previous a:hover:before { color: {$colors['accent_color']}; }
	.paging-navigation .nav-next a:hover,
	.paging-navigation .nav-next a:hover:before { color: {$colors['accent_color']}; }
	.post-navigation .nav-links a:hover,
	.post-navigation .nav-links a:hover:before { color: {$colors['accent_color']}; }
	.image-navigation .nav-links a:hover,
	.image-navigation .previous-image:hover:before,
	.image-navigation .next-image:hover:before { color: {$colors['accent_color']}; }

	.comments-title a:hover,
	.image-navigation .next-image:hover:before { color: {$colors['accent_color']}; }
	.comment-author .fn a:hover { color: {$colors['accent_color']}; }
	.comment-navigation .nav-next a:hover:after { color: {$colors['accent_color']}; }
	#cancel-comment-reply-link:hover:before { color: {$colors['accent_color']}; }
	.form-submit  input[type="submit"]:hover { color: {$colors['accent_color']}; }

	.homepage-read-more:hover { color: {$colors['accent_color']}; }

	.rbp-header a { background-color: {$colors['accent_color']}; }
	.rbp-entry .rbp-title:hover { color: {$colors['accent_color']}; }
	.rpp-header a { background-color: {$colors['accent_color']}; }

	input.wpcf7-submit:hover { color: {$colors['accent_color']} !important; }

	.widget a:hover { color: {$colors['accent_color']}; }
	.widget_pages ul li a:before { color: {$colors['accent_color']}; }
	.widget_categories .current-cat > a { color: {$colors['accent_color']}; }
	.widget_tag_cloud a:hover { color: {$colors['accent_color']}; }
	.widget_archive ul li a:before,
	.widget_categories ul li a:before,
	.widget_links ul li a:before,
	.widget_meta ul li a:before,
	.widget_nav_menu ul li a:before,
	.widget_recent_comments ul li:before,
	.widget_recent_entries ul li a:before,
	.widget_rss ul li a:before,
	.widget_pages ul li a:before { color: {$colors['accent_color']}; }

	.site-footer .footer-social-icons a:hover { color: {$colors['accent_color']}; }
	.site-footer .footer-fa a:hover { color: {$colors['accent_color']}; }
CSS;

	$css[] = <<<CSS
	.cb-title a:hover { color: {$colors['accent_color']}; }
	.cb-image:hover + .cb-title { color: {$colors['accent_color']}; }
	.cb-image-link:hover + .cb-title { color: {$colors['accent_color']}; }
	.cb-image-link:hover + .cb-title .cb-title-link { color: {$colors['accent_color']}; }
CSS;

	$css[] = <<<CSS
	#options li a:hover { background-color: {$colors['accent_color']}; }
	#options li a.selected { background-color: {$colors['accent_color']}; }
	@media (max-width: 767px){
		.portfolio-arrowleft:hover,
		.portfolio-arrowright:hover { color: {$colors['accent_color']}; }
		.portfolio-arrowleft:hover:before,
		.portfolio-arrowright:hover:before { color: {$colors['accent_color']}; }
	}
CSS;

	$css[] = <<<CSS
	.ns-filter-category li a:hover { background-color: {$colors['accent_color']}; }
	.ns-filter-category li a.selected { background-color: {$colors['accent_color']}; }
CSS;

	return $css;
}

/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 */
function flow_color_scheme_css_template() {
	$colors = array(
		'accent_color'                => '{{ data.accent_color }}',
	);
	?>
	<script type="text/html" id="tmpl-flow-color-scheme">
		<?php $css = flow_get_color_scheme_css( $colors ); ?>
		<?php foreach ( $css as $value ) { ?>
		<?php echo $value; ?>
		<?php //echo flow_get_color_scheme_css( $colors ); ?>
		<?php } ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'flow_color_scheme_css_template' );
