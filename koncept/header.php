<!DOCTYPE html>
<!--[if lt IE 8]> <html <?php language_attributes(); ?> class="ie7" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 8]> <html <?php language_attributes(); ?> class="ie8 ie" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 9]> <html <?php language_attributes(); ?> class="ie9 ie" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<head>

	<!-- META -->

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">

	<!-- LINKS -->

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php if ( get_option( 'krown_fav' ) != '' ) : ?>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_option( 'krown_fav' ); ?>" />

	<?php endif; ?>

	<!-- WP HEAD -->

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!–[if IEMobile]>
		<style type="text/css">
			.regular-select-inner {
				background-position: calc(100% - 10px) center !important;
				background-image: url(<?php echo get_template_directory_uri(); ?>/images/arrow_x2.png) !important;
				background-size: 6px 3px !important;
			}
		</style>
	<![endif]—> 

	<?php wp_head(); ?>

	<?php global $post; ?>
		
</head>

<body id="body" <?php body_class( 'no-touch no-js ' . get_option( 'krown_menu_sticky', 'no-sticky' ) ); ?> <?php echo get_option( 'krown_menu_sticky', 'no-sticky' ) == 'sticky' ? ' style="padding-top:' . ( get_option( 'krown_logo_height', '29') + 155 ) . 'px"' : '' ;?>>

    <!-- Secondary Header Start -->
    <header id="header" class="clearfix" style="height:<?php echo get_option( 'krown_logo_height', '29') + 155; ?>px">

    	<div class="clearfix">

	    	<div id="menu-class" class="wrapper <?php echo get_option( 'krown_menu_style', 'menu-two' ); ?> clearfix">

				<!-- Logo Start -->
				<?php 

				$logo = get_option( 'krown_logo' );
				$logo_x2 = get_option( 'krown_logo_x2' );

				if ( $logo == '' ) {
					$logo = get_template_directory_uri() . '/images/logo.png';
				}
				if ( $logo_x2 == '' ) {
					$logo_x2 = $logo;
				}

				?>

				<a id="logo" href="<?php echo home_url(); ?>" style="width:<?php echo get_option( 'krown_logo_width', '166' ); ?>px;height:<?php echo get_option( 'krown_logo_height', '29' ); ?>px;">
					<img class="default" src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
					<img class="retina" src="<?php echo $logo_x2; ?>" alt="<?php bloginfo('name'); ?>" />
				</a>
				<!-- Logo End -->

		        <!-- Menu Start -->

				<a id="menu-opener" href="#"><?php echo krown_svg( 'hamburger' ); ?></a>

				<?php if ( is_page_template( 'template-portfolio.php' ) && get_post_meta( $post->ID, 'folio_filter', true ) == 'enable-filters' ) : ?>

					<a href="#" id="filter-opener"><?php echo krown_svg( 'filter' ); ?></a>

				<?php endif; ?>

				<?php if ( ( function_exists( 'is_woocommerce' ) && get_option( 'krown_shop_cart', 'show' ) == 'show' ) && ( is_cart() || is_checkout() || is_shop() || is_account_page() || is_singular( 'product' ) ) ) : ?>

					<?php global $woocommerce; ?>

					<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" id="filter-opener">
						<?php echo krown_svg( 'cart' ); ?>
						<span class="count"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
					</a>

				<?php endif; ?>

		        <nav id="main-menu" class="clearfix right" data-nav-text="<?php _e( 'Navigation', 'krown' ); ?>">
		        	
		        	<div>

						<?php if ( has_nav_menu( 'primary' ) ) {

							wp_nav_menu( array(
								'container' => false,
								'menu_class' => 'clearfix top-menu',
								'echo' => true,
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'depth' => 3,
								'theme_location' => 'primary',
								'walker' => new Krown_Nav_Walker()
								)
							);

						} ?>

					</div>

					<?php if ( get_option( 'krown_menu_style', 'menu-one' ) == 'menu-one' || get_option( 'krown_menu_style' ) == 'menu-two' ) : ?>
						<div id="menu-text"><?php echo do_shortcode( get_option( 'krown_menu_text' ) ); ?></div>
					<?php endif; ?>

				</nav>	

				<a id="menu-closer" href="#"><?php echo krown_svg( 'close' ); ?></a>

				<?php if ( is_active_sidebar( 'krown_header_widget' ) ) : ?>
					<div id="header-widgets" class="clearfix">
						<?php dynamic_sidebar( 'krown_header_widget' ); ?>
					</div>
				<?php endif; ?>

				<!-- Menu End -->

			</div>

		</div>

	</header>
	<!-- Secondary Header End -->

	<!-- Main Wrapper Start -->

	<div id="content" class="clearfix">

		<!-- Page Title Start -->
		
		<?php if ( krown_check_page_title() != '' ) : ?>

		<div id="page-title" class="clearfix <?php 
			global $post; 
			if ( isset( $post ) ) 
				echo get_post_meta( $post->ID, 'krown_show_title', true );
			?>">
			<div class="clearfix wrapper">
				<?php echo krown_check_page_title(); ?>
				<div id="main-search"><?php echo get_search_form(); ?></div>
			</div>
		</div>

		<?php endif; ?>
		<!-- Page Title End -->

		<?php krown_custom_header(); ?>

		<article id="article" class="clearfix wrapper">

			<?php if ( function_exists( 'is_woocommerce' ) ) krown_woo_header(); ?>