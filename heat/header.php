<?php
/**
 * The Header.
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0, maximum-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

<?php
	/*
	 * Print the favicon.
	 */
	$favicon = ot_get_option( 'favicon' );
 ?>
 
<?php if ( ! empty( $favicon ) ) : ?>
	<!-- Le fav -->
	<link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon">
<?php endif; ?>

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
		echo ' | ' . sprintf( __( 'Page %s', 'mega' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	if ( is_singular('post') && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
?>
</head>


<body <?php body_class(); ?>>

<?php if ( ! is_404() ) { ?>

	<!-- Head
================================================== -->

	<section id="header-wrapper">
		<header id="branding" class="clearfix" role="banner">
				
				<?php
				/*
				 * Print the logo.
				 */
				$logo = ot_get_option( 'logo' );
				?>
				
				<?php if ( ! empty( $logo ) ) : ?>
				<?php //$logo_id = $wpdb->get_var( $wpdb->prepare("SELECT DISTINCT ID FROM $wpdb->posts WHERE guid='$logo'") ); ?>
				<?php //$logo_attributes = wp_get_attachment_image_src( $logo_id, 'full' ); ?>
					<h1 id="site-title-custom" class="clearfix">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="custom-logo">
							<img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
						</a>
					</h1>
				<?php else : ?>
					<h1 id="site-title" class="clearfix">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
				<?php endif; ?>
				
				<!-- Navbar
================================================== -->
				<nav id="access" role="navigation" class="clearfix">
					<?php if ( has_nav_menu( 'primary' ) ) : ?>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'sf-menu' ) ); ?>
					<?php else : ?>
						<?php wp_page_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'page-menu' ) ); ?>
					<?php endif; ?>
				</nav><!-- #access -->
				
				<?php if ( has_nav_menu( 'mobile_menu' ) ) : ?>
					<a id="mega-menu-dropdown" class="clearfix" href="#"><span><?php _e( 'Menu', 'mega' ); ?> <i class="icon-reorder"></i></span></a>
					<nav id="access-mobile"><?php wp_nav_menu( array( 'theme_location' => 'mobile_menu', 'menu_class' => 'mobile-menu' ) ); ?></nav>
				<?php endif; ?>
				
				<?php if ( is_page_template( 'page-portfolio.php' ) ) { ?>
					<?php $portfolio_filtering = ot_get_option( 'portfolio_filtering' ); ?>
					
					<?php if ( ! empty( $portfolio_filtering ) ) : ?>
					
						<?php $wp_list_categories = wp_list_categories( array( 'title_li' => '', 'show_option_none' => '', 'taxonomy' => 'portfolio-category', 'walker' => new Walker_Portfolio_Category(), 'orderby' => 'name', 'style' => 'none', 'echo' => 0 ) ); ?>
						
						<?php if ( ! empty( $wp_list_categories ) ) : ?>
						
							<nav id="filters" class="clearfix option-set">
								<?php $sep = '<span class="sep">/</span>'; ?>
								<?php $wp_list_categories = str_replace( '<br />', $sep, $wp_list_categories ); ?>
								<a href="#" data-filter="*" class="selected"><?php _e( 'All', 'mega' ) ?></a>
								<?php echo $sep; ?>
												
								<?php
								if ( $sep != '' ) {
									$wp_list_categories = strrev( $wp_list_categories );
									$sep = strrev( $sep );
									$wp_list_categories = explode( $sep, $wp_list_categories, 2 );
									$wp_list_categories = implode( '', $wp_list_categories );
									$wp_list_categories = strrev( $wp_list_categories );
								}
								?>
												
								<?php echo $wp_list_categories; ?>
							</nav>
						
						<?php endif; // End if ( ! empty( $wp_list_categories ) ) ?>
						
					<?php endif; // End if ( ! empty( $portfolio_filtering ) ) ?>
				<?php } else if ( is_page_template( 'page-galleries-list.php' ) ) { ?>
					<?php $gallery_filtering = ot_get_option( 'gallery_filtering' ); ?>
					
					<?php if ( ! empty( $gallery_filtering ) ) : ?>
					
						<?php $wp_list_categories = wp_list_categories( array( 'title_li' => '', 'show_option_none' => '', 'taxonomy' => 'gallery-category', 'walker' => new Walker_Portfolio_Category(), 'orderby' => 'name', 'style' => 'none', 'echo' => 0 ) ); ?>
						
						<?php if ( ! empty( $wp_list_categories ) ) : ?>
					
							<nav id="filters" class="clearfix option-set">
								<?php $sep = '<span class="sep">/</span>'; ?>
								<?php $wp_list_categories = str_replace( '<br />', $sep, $wp_list_categories ); ?>
								<a href="#" data-filter="*" class="selected"><?php _e( 'All', 'mega' ) ?></a>
								<?php echo $sep; ?>
												
								<?php
								if ( $sep != '' ) {
									$wp_list_categories = strrev( $wp_list_categories );
									$sep = strrev( $sep );
									$wp_list_categories = explode( $sep, $wp_list_categories, 2 );
									$wp_list_categories = implode( '', $wp_list_categories );
									$wp_list_categories = strrev( $wp_list_categories );
								}
								?>
												
								<?php echo $wp_list_categories; ?>
							</nav>
						
						<?php endif; // End if ( ! empty( $wp_list_categories ) ) ?>
					<?php endif; // End if ( ! empty( $gallery_filtering ) ) ?>
				<?php } ?>
				
				<?php if ( is_home() || is_archive() || is_search() ) : ?>
					<?php get_search_form(); ?>
				<?php endif; ?>

		</header><!-- #branding -->
	</section><!-- #header-wrapper -->
	
<?php } ?>

<!-- Page
================================================== -->
<section id="page" class="hfeed">