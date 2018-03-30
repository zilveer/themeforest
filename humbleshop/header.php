<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package humbleshop
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link rel="icon" href="<?php echo get_theme_mod('favicon'); ?>">

<?php wp_head(); ?>
<!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv-printshiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>

	<!-- ======= -->
	<!-- TOPHEAD -->
	<!-- ======= -->
	<section id="tophead">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 hidden-xs site-description">
					<?php bloginfo( 'description' ); ?>
					<?php //echo do_shortcode('[edd_login]'); ?>
				</div>
				<div class="col-sm-6 topbasket">					
					<?php if( function_exists( 'EDD' ))   : ?>
						<a href="<?php echo edd_get_checkout_uri(); ?>">
							<i class="fa fa-shopping-cart"></i> <?php _e( 'Total', 'humbleshop' ); ?> (<span class="header-cart edd-cart-quantity"><?php echo edd_get_cart_quantity(); ?></span>)
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- ====== -->
	<!-- HEADER -->
	<!-- ====== -->
	<header id="masthead" class="site-header container" role="banner">
		<div class="row">
			<div class="site-branding col-sm-8">
				<?php 
					if( get_theme_mod('logo')) : ?>
						 <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod('logo'); ?>" alt="" class="img-responsive"></a>
					<?php  else : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<!-- <p class="site-description"><small><?php bloginfo( 'description' ); ?></small></p> -->
					<?php endif;
				?>
			</div>
			<div class="col-sm-4 text-right" id="topsearch">
				<?php get_search_form(); ?>
			</div>
		</div>
	</header><!-- #masthead -->

	<!-- ========== -->
	<!-- NAVIGATION -->
	<!-- ========== -->
	<section id="navigation">
		<div class="container"><div class="row"><div class="col-12">

			<nav class="navbar" role="navigation">
				<!-- Collect the nav links, forms, and other content for toggling -->
				<?php
		            wp_nav_menu( array(
		                'menu'              => 'primary',
		                'theme_location'    => 'primary',
		                'depth'             => 2,
		                'container'         => 'div',
		                'container_class'   => 'collapse navbar-collapse topnav',
		                'menu_class'        => 'nav nav-justified hidden-xs',
		                'menu_id'		=> 'menu-top',
		                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
		                'walker'            => new wp_bootstrap_navwalker())
		            );
		        ?>
			</nav>

		</div></div></div>
	</section>

	<?php
	if ( is_front_page() ) {
		 get_template_part('slider'); 
	} elseif ( is_page_template('contact.php') ) {
		 get_template_part('map');
	} else { ?>
	
	<!-- ========= -->
	<!-- PAGE HEAD -->
	<!-- ========= -->
	<section id="head">
		<div class="container">
			<div class="row">
				<header class="entry-header text-center col-xs-12">
					<h1 class="entry-title">
						<?php 
				
						if( is_home() && get_option( 'page_for_posts' ) ) :
							echo get_the_title( get_option( 'page_for_posts' ) );
						
						elseif ( is_search() ) :
							printf( __( 'Search Results for: %s', 'humbleshop' ), '<span>' . get_search_query() . '</span>' );

						elseif ( is_archive() ) :

							if ( is_category() ) :
								single_cat_title();

							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								/* Queue the first post, that way we know
								 * what author we're dealing with (if that is the case).
								*/
								the_post();
								printf( __( 'Author: %s', 'humbleshop' ), '<span class="vcard">' . get_the_author() . '</span>' );
								/* Since we called the_post() above, we need to
								 * rewind the loop back to the beginning that way
								 * we can run the loop properly, in full.
								 */
								rewind_posts();

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'humbleshop' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'humbleshop' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'humbleshop' ) ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'humbleshop' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'humbleshop' ) ) . '</span>' );

							elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
								_e( 'Asides', 'humbleshop' );

							elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								_e( 'Images', 'humbleshop');

							elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
								_e( 'Videos', 'humbleshop' );

							elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
								_e( 'Quotes', 'humbleshop' );

							elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
								_e( 'Links', 'humbleshop' );

							elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
								_e( 'Audio', 'humbleshop' );

							elseif ( 'download' == get_post_type() ) :
								printf( __( single_cat_title( '', false ) ) );
							else :
								_e( 'Archives', 'humbleshop' );
							endif;

							$term_description = term_description();
							if ( ! empty( $term_description ) ) :
								printf( '<div class="taxonomy-description">%s</div>', $term_description );
							endif;

						else : 
							the_title();
						endif; ?>
					</h1>
					
				</header><!-- .entry-header -->
			</div>
		</div>
	</section>

	<?php } ?>

	<!-- ============ -->
	<!-- MAIN CONTENT -->
	<!-- ============ -->
	<div id="content" class="site-content">