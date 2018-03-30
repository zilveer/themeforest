<?php if(! defined('ABSPATH')){ return; }
/**
 * Display Header's HTML markup
 * DON'T OVERRIDE THIS FILE, instead copy the header-style##.php to Kallyas Child theme (same location) and paste this markup into it;
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

// Top Bar Style
$opt_topbar_style = zget_option('topbar_style', 'general_options', false, 'default');
$top_extra_classes[] = 'topbar-style--'.$opt_topbar_style;

// TOPBAR Size
$topbar_size = isset($topbar_size) ? $topbar_size : 'default';
$opt_topbar_size = zget_option('topbar_size', 'general_options', false, 'default');
if( $opt_topbar_style == 'custom' && $opt_topbar_size != 'default'){
	$topbar_size = $opt_topbar_size;
}

// Area checks - TOP
$check_top =  has_action('zn_head__top_left') || has_action('zn_head_left_area') || has_action('zn_head_left_area_s7') || has_action('zn_head_left_area_s9') || has_action('zn_head__top_right') || has_action('zn_head_right_area') || has_action('zn_head_right_area_s7') || has_action('zn_head_right_area_s9') ;
// Area checks - BOTTOM
$check_bottom = has_action('zn_head__bottom_left') || has_action('zn_head__bottom_center') || has_action('zn_head__bottom_right') || has_action('zn_head_cart_area_s8') || has_action('zn_head__before__bottom') || has_action('zn_head__after__bottom');

// Add Classes to Main if no Top/Bottom
$main_extra_classes[] = !$check_top ? ' header-no-top':'';
$main_extra_classes[] = !$check_bottom ? ' header-no-bottom':'';

// Extra classes
$top_extra_classes[] = isset($top_extra_class) ? $top_extra_class : '';
$main_extra_classes[] = isset($main_extra_class) ? $main_extra_class : '';
$bottom_extra_classes[] = isset($bottom_extra_class) ? $bottom_extra_class : '';

// SiteHeader container class
$siteheader_container_class = isset($siteheader_container_class) ? $siteheader_container_class : '';

// Sticky class
$sticky_class = isset($sticky_class) ? $sticky_class : '';

// If Custom bg selected, make sure it's not default text scheme
if ( $header_text_scheme && $header_style == 'image_color' ) {
	if($header_text_scheme != 'default' && $header_text_scheme != ''){
		$headerTextScheme = 'sh--' . $header_text_scheme;
	}
}
$header_class[] = 'sheader-' . $headerTextScheme;

// Determine topbar color scheme
$topbar_text_scheme = isset($topbar_text_scheme) ? $topbar_text_scheme : $headerTextScheme;
$opt_topbar_text_scheme = zget_option('topbar_text_scheme', 'general_options', false, 'default');
if( $opt_topbar_style == 'custom' && $opt_topbar_text_scheme != 'default'){
	$topbar_text_scheme = 'sh--' . $opt_topbar_text_scheme;
}

$top_extra_classes[] = $topbar_text_scheme;
$main_extra_classes[] = $headerTextScheme;
$bottom_extra_classes[] = $headerTextScheme;


?>
<header id="header" class="site-header <?php echo implode( ' ', $header_class ); ?>" <?php echo $stickyMenuAttrs; ?> <?php echo $style;?> <?php echo WpkPageHelper::zn_schema_markup('header'); ?>>
	<?php
	// place a hook before markup
	do_action('zn_before_siteheader_inside');
	?>
	<div class="site-header-wrapper <?php echo $sticky_class; ?>">

		<div class="site-header-top-wrapper <?php echo implode(' ', $top_extra_classes); ?>">

			<div class="siteheader-container <?php echo $topbar_size == 'full' ? 'topbar-full' : 'container'; ?>">

				<?php
					// If full-width topbar
					include(locate_template('components/theme-header/header-markup-topbar.php'));
				?>

			</div>
		</div><!-- /.site-header-top-wrapper -->

		<div class="kl-top-header site-header-main-wrapper clearfix <?php echo implode(' ', $main_extra_classes); ?>">

			<div class="container siteheader-container <?php echo $siteheader_container_class; ?>">

				<div class='fxb-col fxb-basis-auto'>

					<?php
						// Include Main Bar
						include(locate_template('components/theme-header/header-markup-main.php'));
					?>

				</div>

				<?php do_action('zn_head__after__main_wrapper'); ?>
			</div><!-- /.siteheader-container -->

		</div><!-- /.site-header-main-wrapper -->

		<?php
			// Include Bottom Bar
			include(locate_template('components/theme-header/header-markup-bottom.php'));
		?>

	</div><!-- /.site-header-wrapper -->
	<?php
		do_action('zn_after_siteheader_inside');
	?>
</header>
