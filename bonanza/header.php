<?php global $theme_shortname, $theme_options; ?>
<?php $theme_options = get_option( $theme_shortname . '_options' ); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>	
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="author" content="UFO Themes" />

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
		echo ' | ' . sprintf( __( 'Page %s', 'Bonanza' ), max( $paged, $page ) );

	?></title>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style-ie8.css" />
<![endif]--> 

<?php wp_head(); ?>  
</head>
<body <?php body_class(); ?>>
	<div id="header-wrap-outer" class="primary-color">
	<div id="header-wrap">
		<div id="header-border" class="secondary-color"></div>
			<div id="header" class="container">
				<div id="header-bg">
					<div id="header-inner">
						<div id="logo-wrap">
						<!-- Print logo -->            
							<h1 class="logo">
								<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
									<?php if ( isset( $theme_options['logo'] ) && '' != $theme_options['logo'] ) : ?>
										<img id="logo" src="<?php echo esc_url( $theme_options['logo'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
									<?php else : ?>
										<?php bloginfo( 'name' ); ?>
									<?php endif; ?>
								</a>
							</h1>
							<h2 id="tagline"><?php bloginfo('description'); ?></h2>
		            		<!-- End Logo -->
						</div> <!-- #logo-wrap -->
						<div id="top-container">
							<div id="top-menu-wrap">
								<?php if (class_exists('woocommerce')) { 
						         		echo icore_woocommerce_cart_menu(); } ?>
								<?php icore_nav_menu('top-menu', 'top', 'desc_on'); ?>
							</div>
						</div>  <!--  and #top-container  -->
	             
		    			<div id="main-menu-wrap">          
					    	<?php icore_nav_menu('primary-menu', 'nav sf'); ?>
							<?php echo '<a href="#" id="mobile_nav" class="closed">' . '<span></span>' . esc_html__( 'Menu', 'Bonanza' ) . '</a>'; ?>
							<?php icore_search_bar(); ?>
					    </div>
     
					</div> 
				</div>
			</div>  <!--  end #header  -->
		</div> <!-- #header-wrap -->
	</div> <!-- #header-wrap-outer -->	

	<?php if ( is_home() && isset( $theme_options['slider_enabled'] ) && $theme_options['slider_enabled'] == '1' || is_front_page() && isset( $theme_options['slider_enabled'] ) && $theme_options['slider_enabled'] == '1') { ?>
		<div id="slider-wrap" <?php if ( $theme_options["slider_size"] == 'boxed' ) { echo 'class="container"'; } else { echo 'class="slider-full"'; } ?> >
			
			<?php $slider_part = $theme_options["slider_type"]; ?>
			<?php get_template_part( '/includes/' . $slider_part ); ?>

		</div><!-- #slider-wrap -->
	<?php } ?>
	
	<div class="wrapper container">
		
		<div class="wrap-inside">     
	
        	<div class="main-content">  

				<div id="woo-ordering">
					<?php do_action('woo_breadcrumbs'); ?>
					<?php do_action('woo_ordering'); ?>
				</div>