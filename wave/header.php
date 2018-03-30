<?php
/**
 * The Header for our theme.
 */

global $dd_sn;

?><!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8 ie-ver-7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9 ie-ver-8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="ie-ver-9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<title><?php

			if ( defined('WPSEO_VERSION') ) {
				wp_title();
			} else {

				if ( is_home() || is_front_page() ) {
					bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
				} else {
					wp_title( '|', true, 'right' ); bloginfo( 'name' );
				}

			}
	
	?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php if( ot_get_option( $dd_sn . 'favicon') ) : ?>
	
		<link rel="shortcut icon" href="<?php echo ot_get_option( $dd_sn . 'favicon'); ?>" type="image/x-icon" />
		
	<?php endif; ?>

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	
	<?php wp_head(); ?>

</head>

<?php

	$body_class = '';
	$header_image = '';
	$has_slider = false;

	// Header BG Image

	if ( ! is_home() ) {

		$header_image = get_post_meta( get_the_ID(), $dd_sn . 'header_image', true );

		if ( empty ( $header_image ) )
			$header_image = ot_get_option( $dd_sn . 'header_image' );

	} else {

		$header_image = ot_get_option( $dd_sn . 'header_image' );

	}

	// Slider
	
	if ( is_home() ) {

		$slider = ot_get_option( $dd_sn . 'slider' );
		
		if ( ! empty ( $slider ) )
			$has_slider = true;

		if ( $has_slider )
			$body_class = 'has-slider ';

		if ( ot_get_option( $dd_sn . 'slider_overlay', 'enabled' ) == 'enabled' )
			$has_slider_overlay = true;
		else
			$has_slider_overlay = false;

	}

?>

<body <?php body_class( $body_class ); ?>>
	
	<?php if ( ot_get_option ( $dd_sn . 'header_top_bar', 'enabled' ) == 'enabled' ) : ?>

		<div id="top-info">

			<div class="container">

				<div id="top-info-inner" class="clearfix">

					<?php if ( ! dynamic_sidebar( 'sidebar-top-bar' ) ) : ?>

						<div class="align-center">There aren't any widgets in this section. Go to WP Admin &rarr; Appearance &rarr; Widgets and add some to <strong>Top Bar Widgets</strong>. You can disable this section in the Theme Options.</div>

					<?php endif; ?>

				</div><!-- #top-info-inner -->

			</div><!-- .container -->

			<a href="#" class="top-info-hide"></a>
			<a href="#" class="top-info-show"></a>

		</div><!-- #top-info -->

	<?php endif; ?>

	<div id="page-container">

		<?php if ( $has_slider ) : ?>

			<div id="slider" class="slider-mobile-arrows-<?php echo ot_get_option( $dd_sn . 'slider_arrows_mobile', 'enabled' ); ?>" data-animation="<?php echo ot_get_option( $dd_sn . 'slider_animation', 'slide' ); ?>" data-autoplay="<?php echo ot_get_option( $dd_sn . 'slider_autoplay', '0' ); ?>" data-loop="<?php echo ot_get_option( $dd_sn . 'slider_loop', 'enabled' ); ?>">

				<div class="flexslider">

					<ul class="slides">

						<?php foreach ( $slider as $key => $slide ) : ?>
							
							<?php if ( ! isset( $slide['link_text'] ) || $slide['link_text'] == '' ) $slide['link_text'] = __( 'MORE INFO', 'dd_string' ); ?>

							<li class="slide">
								
								<img class="slide-img" src="<?php echo $slide['image']; ?>" />

								<?php if ( $has_slider_overlay ) : ?>
									<div class="slide-overlay"></div>
								<?php endif; ?>

								<div class="slide-info">
									<div class="container slide-info-inner">
										
										<?php if ( ! empty( $slide['title'] ) ) : ?>
											<div class="slide-title"><?php echo $slide['title']; ?></div>
										<?php endif; ?>
										
										<?php if ( ! empty( $slide['description'] ) ) : ?>
											<div class="slide-description"><?php echo $slide['description']; ?></div>
										<?php endif; ?>
										
										<?php if ( ! empty( $slide['link'] ) ) : ?>
											<a href="<?php echo $slide['link']; ?>" class="button white slide-link"><?php echo $slide['link_text']; ?></a>
										<?php endif; ?>

									</div><!-- .slide-info-inner -->
								</div><!-- .slide-info -->

							</li>

						<?php endforeach; ?>

					</ul><!-- .slides -->

				</div><!-- .flexslider -->			

				<div class="slider-nav container">
					<div class="slider-nav-inner">
						<a href="#" class="slider-prev"></a>
						<a href="#" class="slider-next"></a>
					</div>
				</div><!-- .slider-nav -->

			</div><!-- #slider -->

		<?php endif; ?>

		<header id="header" data-bg-image="<?php echo $header_image; ?>">

			<div id="header-overlay"></div>

			<div id="header-inner" class="container clearfix">

				<div id="logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">						
						<img src="<?php echo ot_get_option( $dd_sn . 'logo', get_template_directory_uri() . '/images/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
					</a>
				</div>

				<nav id="nav">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'sf-menu' ) ); ?>
				</nav><!-- #nav -->

				<nav id="mobile-nav">
					
					<?php
						if( has_nav_menu('primary') ) {
							
							$locations = get_nav_menu_locations();
							$menu = wp_get_nav_menu_object($locations['primary']);
							$menu_items = wp_get_nav_menu_items($menu->term_id);
							$mobile_nav_output = '';
							
							$mobile_nav_output .= '<select>';
								
								foreach ( $menu_items as $key => $menu_item ) {
									$title = $menu_item->title;
									$url = $menu_item->url;
									$nav_selected = '';
									if($menu_item->object_id == get_the_ID()){ $nav_selected = 'selected="selected"'; }
									if($menu_item->post_parent !== 0){
										$mobile_nav_output .= '<option value="'.$url.'" '.$nav_selected.'> - '.$title.'</option>';
									}else{
										$mobile_nav_output .= '<option value="'.$url.'" '.$nav_selected.'>'.$title.'</option>';
									}
								}

							$mobile_nav_output .= '</select>';

							echo $mobile_nav_output;
						}
					?>
					<div id="mobile-nav-hook"><?php _e( 'GO TO...', 'dd_string' ); ?></div>

				</nav><!-- .mobile-nav -->

			</div><!-- #header-inner -->

		</header><!-- #header -->

		<section id="main">