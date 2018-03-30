<?php /* The Header */ ?>

<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">

		<?php /* Main wrapper start */ if (function_exists('pt_site_wrapper_start')) pt_site_wrapper_start(); ?>

		<header class="site-header"<?php if (function_exists('pt_custom_header_bg')) pt_custom_header_bg(); ?> itemscope="itemscope" itemtype="http://schema.org/WPHeader"><!-- Site's Header -->

			<?php /* Top panel */
			if ( handy_get_option( 'header_top_panel' ) == 'on' && (has_nav_menu( 'header-top-nav' ) || handy_get_option('top_panel_info') || is_active_sidebar('top-sidebar')) ) {
				get_template_part( 'partials/top-panel' );
			} ?>

			<div class="logo-wrapper"><!-- Logo & hgroup -->
				<div class="container">
					<div class="row">
						<?php /* Logo group */ get_template_part( 'partials/logo-group' ); ?>
	        </div>
				</div>
			</div><!-- end of Logo & hgroup -->

			<?php if (has_nav_menu( 'primary-nav' )) : ?>
				<div class="header-primary-nav"><!-- Primary nav -->
					<div class="container">
						<div class="row">
							<nav class="primary-nav col-md-12 col-sm-12" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
								<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'plumtree' ); ?></a>
								<?php wp_nav_menu( array('theme_location'  => 'primary-nav') ); ?>
							</nav>
						</div>
					</div>
				</div><!-- end of Primary nav -->
			<?php endif; ?>

		</header><!-- end of Site's Header -->

		<div class="site-main container"><!-- Content wrapper -->
			<div class="row">

			<?php if ( class_exists('Woocommerce') ) {
				if (!is_woocommerce()) { ?>
					<?php get_template_part( 'partials/breadcrumbs' ); ?>
			<?php } } else { ?>
					<?php get_template_part( 'partials/breadcrumbs' ); ?>
			<?php } ?>
