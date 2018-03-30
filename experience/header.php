<?php
/**
 * Theme header.
 *
 * Displays all of the <head> section and everything up to the main site navigation.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/ 

/**
 * Add class to allow styling for toolbar.
 **/

// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

$html_class = ( is_admin_bar_showing() ) ? 'wp-toolbar' : ''; ?>
<!DOCTYPE html>
<html class="<?php echo esc_attr( $html_class ); ?>" <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) { ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php } ?>
	
	<?php wp_head(); ?>	
	
</head>
<?php // Add section pagination data attribute
$section_paging_attr = "";
if ( is_singular() ) {
	
	if ( get_post_meta( $post->ID, "experience_section_pagination", true ) != "" ) {
		$section_paging_attr = 'data-section-pagination="true"';	
	}
	
} ?>

<body id="top" <?php body_class(); ?> <?php echo esc_attr( $section_paging_attr ); ?>>
	
	<!-- BEGIN #page-preloader  -->
	<div id="page-preloader">
		<span class="loader">
			<span class="loader-inner"></span>
		</span>		
	</div>
	<!-- END #page-preloader  -->
	
	<?php get_template_part( 'navigation' ); ?>
	
	<!-- BEGIN .wrapper -->
	<div class="wrapper">	
		
		<!-- BEGIN .site-header -->
		<header class="site-header">

			<?php // Set navigation content width
			if (
				isset( $experience_theme_array['nav-width'] )
				&& $experience_theme_array['nav-width'] == 'narrow-width'
			) {
				$header_width = 'narrow-width';
			} elseif (
				isset( $experience_theme_array['nav-width'] )
				&& $experience_theme_array['nav-width'] == 'site-width'
			) {
				$header_width = 'site-width';
			} else {
				$header_width = '';
			} ?>

			<div class="clearfix padding-h <?php echo esc_attr( $header_width ); ?>">
				
				<?php $title_attr = get_bloginfo( 'name' );
				if ( get_bloginfo( 'description' ) != "" ) { 
					$title_attr .= $title_attr .' - '. get_bloginfo( 'description' ); 
				} ?>
				
				<!-- BEGIN .logo -->
				<a class="logo" href="<?php echo esc_url( home_url() ."/" ); ?>" title="<?php echo esc_attr( $title_attr ); ?>">
					<?php experience_the_logo(); ?>
				</a>
				<!-- END .logo -->
				
				<!-- BEGIN .header-nav-wrapper -->
				<div class="header-nav-wrapper">
					
					<!-- BEGIN .header-nav -->
					<ul class="header-nav">
						
						<?php $lang_button = $social_button = $search_button = $menu_button = false;
						
						if ( experience_get_active_lang() ) {
						
							$lang_button = true; ?>
						
							<!-- WPMP selector -->
							<li class="show-desktop">
								<?php echo experience_get_active_lang(); ?>
							</li>	
						
						<?php } ?>
						
						<?php if (
							isset( $experience_theme_array['panel-search'] )
							&& $experience_theme_array['panel-search'] == '1'
						) { 
						
							$search_button = true; ?>
						
							<!-- Search -->
							<li class="show-desktop">
								<span class="search-toggle">
									<span class="funky-icon-search"></span>
								</span>
							</li>
						
						<?php } ?>
						
						<?php if ( 
							!empty( $experience_theme_array['facebook-url'] )
							|| !empty( $experience_theme_array['twitter-url'] )
							|| !empty( $experience_theme_array['google-plus-url'] )
							|| !empty( $experience_theme_array['youtube-url'] )
							|| !empty( $experience_theme_array['vimeo-url'] )
							|| !empty( $experience_theme_array['flickr-url'] )
							|| !empty( $experience_theme_array['dribbble-url'] )
							|| !empty( $experience_theme_array['instagram-url'] )
							|| !empty( $experience_theme_array['pinterest-url'] )
							|| !empty( $experience_theme_array['behance-url'] )
							|| !empty( $experience_theme_array['foursquare-url'] )
						) { 
						
							$social_button = true; ?>
						
							<!-- Social -->
							<li class="show-desktop">
								<span class="social-toggle">
									<span class="funky-icon-share"></span>
								</span>
							</li>
							
						<?php } ?>						
						
						<?php if ( !has_nav_menu( 'primary' ) && ( $lang_button = true || $social_button = true || $search_button = true ) ) {
							$menu_button_visibility = 'show-mobile';
						} else {
							$menu_button_visibility = '';
						}

						if ( has_nav_menu( 'primary' ) || $lang_button = true || $social_button = true || $search_button = true ) { ?>
							
							<!-- Menu toggle -->
							<li class="<?php echo esc_attr( $menu_button_visibility ) ;?>">
								<span class="menu-icon">
									<span class="line"></span>
									<span class="line"></span>
									<span class="line"></span>
								</span>
							</li>
						
						<?php } ?>
						
					</ul>
					<!-- END .header-nav -->
					
				</div>
				<!-- END .header-nav-wrapper -->
				
			</div>

		</header>
		<!-- END .site-header -->
