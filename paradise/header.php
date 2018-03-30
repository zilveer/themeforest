<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage Paradise
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="content-type" content="text/html;charset=<?php bloginfo( 'charset' ); ?>" />
<link rel="shortcut icon" href="<?php theme_favico(); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', TEMPLATENAME ), max( $paged, $page ) );

	?></title>

	<?php enqueue_color_styles();	?>
	<?php wp_enqueue_style('css_ddsmoothmenu'); ?>
	<?php wp_enqueue_style('css_tipsy'); ?>
	<?php wp_enqueue_style('css_custom'); ?>

	<?php slider_enqueue(); ?>

	<?php if (get_option('show_switcher')): ?>
		<?php wp_enqueue_script('js_style_switcher'); ?>
	<?php endif; ?>
	<?php wp_enqueue_script('js_watermarkinput'); ?>
	<?php wp_enqueue_script('js_ddsmoothmenu'); ?>
	<?php wp_enqueue_script('jquery-color'); ?>
	<?php wp_enqueue_script('jquery-ui-tabs'); ?>
	<?php wp_enqueue_script('js_tipsy'); ?>
	<?php wp_enqueue_script('js_localscrol'); ?>
	<?php wp_enqueue_script('js_autoAlign'); ?>
	<?php wp_enqueue_script('js_preloader'); ?>
	<?php wp_enqueue_script('js_common'); ?>
<?php
	if (is_portfolio() || is_tax('gallery')) {
		wp_enqueue_style('css_pretty');
		wp_enqueue_script('js_pretty');
	}
 ?>
<?php
	if (is_tax('gallery')) {
		wp_enqueue_script('js_quicksand');
		wp_enqueue_script('js_easing');
	}
 ?>

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
	<?php theme_color_switcher('init'); ?>

	<?php slider_init(); ?>

	<?php if (get_option('ga_use')) echo get_option('ga_code'); ?>
</head>
<body<?php if (!is_front_page() || (is_front_page() && get_option('slider_type') == 'disable')): ?> id="sp"<?php endif; ?>>
<?php theme_color_switcher('render'); ?>
<!-- Begin Container -->
<div class="container">
	<!-- Begin Header -->
	<div id="header">
		<!-- Site Logo -->
		<a href="<?php echo home_url('/'); ?>" class="logo">
			<img src="<?php theme_logo(); ?>" alt="" />
		</a>
		<!-- SearchBox -->
		<?php get_search_form(); ?>
		<div class="clear"></div>
	</div>
	<!-- End Header -->
	<!-- Start Main Nav -->
	<div id="MainNav">
		<a href="<?php echo home_url('/'); ?>" class="home_btn"><img src="<?php echo get_bloginfo('template_url').'/images/icon_home.gif'; ?>" width="17" height="19" alt="<?php _e('Home', TEMPLATENAME); ?>" /></a>
		<div id="menu">
		<?php wp_nav_menu(
			array(
				'container' => false,
				'menu_class' => 'ddsmoothmenu',
				'theme_location' => 'primary',
			)
		); ?>
		</div>
		<?php get_social_links(); ?>
		<div class="clear"></div>
	</div>
	<!-- End Main Nav -->
	<?php if (is_front_page()): ?>
	<?php theme_slider_render(); ?>
	<?php if (get_option('use_feature_home_box')): ?>
	<!-- Start Featured Home Page Line -->
	<div id="featured_line">
		<?php echo do_shortcode(get_option('feature_home_box')); ?>
		<div class="clear"></div>
	</div>
	<!-- End Featured Home Page Line -->
	<?php endif; ?>
	<?php else: ?>
	<!-- Start Breadcrumbs -->
	<?php if (function_exists('theme_breadcrumbs') && get_option('use_breadcrumbs', true)) theme_breadcrumbs(); ?>
	<!-- End Breadcrumbs -->
	<?php endif; ?>
