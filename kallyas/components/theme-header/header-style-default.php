<?php if(! defined('ABSPATH')){ return; }

/**
* Display the default header
* Hooks mostly, markup loaded through own template
*/

/**
 * ==========================================================
 * CSS custom classes customisations
 * ==========================================================
 */

/**
 * Add custom CSS classes to the <header> tag
 */
// $header_class[] = '';


/**
 * Flexbox scheme override
 *
 * You can override the default markup's vertical and horizontal alignment, as well as "cell" stretch.
 * Also you can add custom CSS Classes.
 *
 */
$flexbox_scheme = array();


/**
 * ==========================================================
 * Hook header's components
 * ==========================================================
 *
 * Components are loaded through hooks into their predefined area.
 * You can move or reorder components through simple remove_action / add_action through Kallyas child theme.
 */

/**** TOP LEFT */

if($headerLayoutStyle == 'style2' || $headerLayoutStyle == 'style3'){
    if(zn_check_components('flags')) add_action( 'zn_head__top_left', 'zn_wpml_language_switcher', 10 ); // WPML LANGUAGE SWITCHER
    if(zn_check_components('cart')) add_action( 'zn_head__top_left', 'zn_woocomerce_cart_init', 20 ); // CART PANEL
    if(zn_check_components('custom_text')) add_action( 'zn_head__top_left', 'zn_header_head_text', 80 ); // CUSTOM TEXT
}


/**** TOP RIGHT */

if(zn_check_components('header_nav')) add_action( 'zn_head__top_right', 'zn_add_navigation', 10 ); // HEADER NAVIGATION
if(zn_check_components('hidden_panel')) add_action( 'zn_head__top_right', 'zn_hidden_pannel_link', 20 ); // HIDDEN PANEL LINK
if(zn_check_components('register')) add_action( 'zn_head__top_right', 'zn_register_text', 30 ); // REGISTER TEXT
if(zn_check_components('login')) add_action( 'zn_head__top_right', 'zn_login_text', 40 ); // LOGIN/LOGOUT TEXT
if(zn_check_components('social_icons')) add_action( 'zn_head__top_right', 'zn_header_social_icons', 70, 1 ); // SOCIAL ICONS
if(zn_check_components('search_box')) add_action( 'zn_head__top_right', 'zn_header_searchbox_def', 80 ); // SEARCH BOX

if($headerLayoutStyle == 'style1' || $headerLayoutStyle == 'style4' || $headerLayoutStyle == 'style5' || $headerLayoutStyle == 'style6'){
    if(zn_check_components('flags')) add_action( 'zn_head__top_right', 'zn_wpml_language_switcher', 50 ); // WPML LANGUAGE SWITCHER
    if(zn_check_components('custom_text')) add_action( 'zn_head__top_right', 'zn_header_head_text', 2 ); // CUSTOM TEXT
    if(zn_check_components('cart')) add_action( 'zn_head__top_right', 'zn_woocomerce_cart_init', 60 ); // CART PANEL
}


/**** MAIN RIGHT */

add_action( 'zn_head__main_right', 'zn_header_main_menu', 10 ); // MAIN NAVIGATION
add_action( 'zn_head__main_right', 'zn_header_calltoaction', 20 ); // CALL TO ACTION BUTTON button


/**** OTHERS */

// Add separators only for XS breakpoint
add_action( 'zn_head__before__top', 'zn_header_separator_xs', 10 );
add_action( 'zn_head__after__top', 'zn_header_separator_xs', 10 );

if($headerLayoutStyle == 'style5'){
    // Add separator after top
    add_action( 'zn_head__after__main_wrapper', 'zn_header_separator' );
}


/**
 * ==========================================================
 * Load general HTML markup
 * ==========================================================
 *
 * The header's markup is loaded for all headers. If you plan on overriding the HTML markup,
 * first make sure you can do it through hooks. If you're sure, simply copy the markup, paste it inside this file and
 * copy this file to ../kallyas-child/components/theme-header/ folder.
 */

// DEFAULT FLEXBOX SCHEME
$inner = array(
	'left' => array(
		'alignment_x' => 'fxb-start-x',
		'alignment_y' => 'fxb-center-y',
		'stretch' => 'fxb-basis-auto',
	),
	'center' => array(
		'alignment_x' => 'fxb-center-x',
		'alignment_y' => 'fxb-center-y',
		'stretch' => 'fxb-basis-auto',
	),
	'right' => array(
		'alignment_x' => 'fxb-end-x',
		'alignment_y' => 'fxb-center-y',
		'stretch' => 'fxb-basis-auto',
	),
);
$flexbox_scheme_defaults = array(
	'top' => $inner,
	'main' => $inner,
	'bottom' => $inner
);

// Extend Flexbox scheme defaults
$flexbox_scheme = zn_wp_parse_args( $flexbox_scheme, $flexbox_scheme_defaults );

// START MARKUP

// Area checks - TOP
$check_top =  has_action('zn_head__top_left') || has_action('zn_head_left_area') || has_action('zn_head_left_area_s7') || has_action('zn_head_left_area_s9') || has_action('zn_head__top_right') || has_action('zn_head_right_area') || has_action('zn_head_right_area_s7') || has_action('zn_head_right_area_s9') ;

// Add Classes to Main if no Top/Bottom
$main_extra_classes[] = !$check_top ? ' header-no-top':'';

// Extra classes
$top_extra_classes[] = isset($top_extra_class) ? $top_extra_class : '';
$main_extra_classes[] = isset($main_extra_class) ? $main_extra_class : '';

// If Custom bg selected, make sure it's not default text scheme
if ( $header_text_scheme && $header_style == 'image_color' ) {
	if($header_text_scheme != 'default' && $header_text_scheme != ''){
		$headerTextScheme = 'sh--' . $header_text_scheme;
	}
}
$header_class[] = 'sheader-' . $headerTextScheme;

$main_extra_classes[] = $headerTextScheme;

?>
<header id="header" class="site-header <?php echo implode( ' ', $header_class ); ?>" <?php echo $stickyMenuAttrs; ?> <?php echo $style;?>>
	<?php
		// place a hook before markup
		do_action('zn_before_siteheader_inside');
	?>
	<div class="site-header-wrapper sticky-top-area">

		<div class="kl-top-header site-header-main-wrapper clearfix <?php echo implode(' ', $main_extra_classes); ?>">

			<div class="container siteheader-container header--oldstyles">

				<div class="fxb-row fxb-row-col-sm">

					<?php if(zn_check_components('logo')): ?>
					<div class='fxb-col fxb fxb-center-x fxb-center-y fxb-basis-auto fxb-grow-0'>
						<?php echo zn_header_display_logo(); ?>
					</div>
					<?php endif; ?>

					<div class='fxb-col fxb-basis-auto'>

						<?php
							// Include Top Bar
							include(locate_template('components/theme-header/header-markup-topbar.php'));

							// Include Main Bar
							include(locate_template('components/theme-header/header-markup-main.php'));
						?>

					</div>
				</div>
				<?php do_action('zn_head__after__main_wrapper'); ?>
			</div><!-- /.siteheader-container -->
		</div><!-- /.site-header-main-wrapper -->

	</div><!-- /.site-header-wrapper -->
	<?php
		do_action('zn_after_siteheader_inside');
	?>
</header>
