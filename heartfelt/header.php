<?php
/**
 * The Header for our theme.
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>

  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="inner_header_wrap">

	<div class="header_bg clearfix">

	<header id="masthead" class="site-header" role="banner">

		<div class="mini_nav_wrap">

			<div class="row">
				
				<!-- Top Header Navigation -->
				<div class="large-12 columns mini_nav">

					<div class="menu-top-header-container">

					<?php // checking for woocommerce & displaying cart 
						include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
							if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) : ?>

						<div class="header-cart">

							<?php global $woocommerce; ?>

							<a class="cart_count" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" data-dropdown="cart_drop" data-options="is_hover:true;align:left">
								
								<i class="fa fa-shopping-cart"></i>

								<?php $cart_contents_count = $woocommerce->cart->cart_contents_count; ?>

								<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'heartfelt'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'heartfelt'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>

							</a><!-- .cart_count -->

							<ul id="cart_drop" class="content f-dropdown small" data-dropdown-content>

							<?php if ( $cart_contents_count >= 1 ) { ?>

									<li><a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php _e('View Cart', 'heartfelt'); ?>" class="header_shop_button radius view_cart_button"><?php _e('View Cart', 'heartfelt'); ?></a></li>

									<li><a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" title="<?php _e('Proceed to Checkout', 'heartfelt'); ?>" class="header_shop_button radius checkout_button"><?php _e('Checkout', 'heartfelt'); ?></a></li>

							<?php } else { $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>

									<li><a href="<?php echo esc_url( $shop_page_url ); ?>" title="<?php _e('View Shop', 'heartfelt'); ?>" class="header_shop_button radius view_cart_button"><?php _e('Go to Shop', 'heartfelt'); ?></a></li>

							<?php } ?>

							</ul><!-- #cart_drop -->

						</div><!-- .header-cart -->

					<?php endif; // end woocommerce check ?>
						
					<?php wp_nav_menu( array( 'theme_location' => 'top_header', ) ); ?>

					</div><!-- .menu-top-header-container -->

				</div><!-- .mini_nav .large-12-->

			</div><!-- .row -->

		</div><!-- .mini_nav_wrap -->

		<div class="row bottom_nav_wrap">

			<div class="large-3 columns header-logo">

			<!-- Logo -->
		    <?php
		        if ( get_theme_mod( 'logo_image' ) ) {
		    ?>
		        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( get_theme_mod( 'logo_image' ) ); ?>" alt=""></a>

		    <?php } else { ?>
	 
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-subtitle"><?php bloginfo( 'description' ); ?></h2>

			<?php } ?>

			</div><!-- .large-3 -->

			<div class="large-9 columns">

		    	<nav class="top-bar" data-topbar data-options="mobile_show_parent_link: true">

		        	<ul class="title-area">

			            <li class="name"></li>

			            <!-- Mobile Menu Toggle -->
			            <li class="toggle-topbar menu-icon"><a href="#"><?php //_e('Menu','heartfelt'); ?></a></li>

		         	</ul><!-- .title-area -->

					<!-- Bottom Header Navigation -->
			        <section class="top-bar-section">

						<?php 
							$defaults = array(
						        'theme_location' => 'bottom_header',
						        'container' 	 => false,
						        'menu_class'	 => 'right',
						        'depth' 		 => 5,
						        'fallback_cb'    => false,
						        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						        'walker' 		 => new heartfelt_foundation_walker()
							);

							wp_nav_menu( $defaults );
						?>

			        </section><!-- .top-bar-section -->

		    	</nav><!-- .top-bar -->

				<!-- Donation Button -->
				<div class="donate-button-wrap">

					<?php 
						$button_choice = get_theme_mod( 'button_choice' );

						if ( $button_choice == '1' ) {

							$donate_modal 	= get_theme_mod( 'donate_modal' );
							$button_page 	= get_theme_mod( 'button_page' );
							$button_animate = get_theme_mod( 'button_animate' );
					?>

						<a href="<?php if ( $donate_modal == '0' ) { echo esc_url( get_page_link( $button_page ) ); } else { echo "&num;"; } ?>" <?php if ( $donate_modal == '1' ) { ?> data-reveal-id="donateModal" <?php } ?> class="<?php if ( $button_animate != 'none' ) { echo 'wow '; echo esc_attr( $button_animate ); };  ?>">
							<span class="donate_button round"><?php echo esc_attr( get_theme_mod( 'button_text', customizer_library_get_default( 'button_text' ) ) ); ?></span>
						</a>
			
					<?php 
						if ( $donate_modal == '1' ) { ?>

						<div id="donateModal" class="reveal-modal small" data-reveal>

							<?php
								$args = array(
									'post_type' => 'page',
									'page_id' => $button_page
								);
								$header_button_query = new WP_Query( $args );

								// The Loop
								while ( $header_button_query->have_posts() ) {
									$header_button_query->the_post();
									the_content();
								}

								wp_reset_postdata();
							?>
							
							<a class="close-reveal-modal">&#215;</a>
						</div><!-- #donateModal -->
						
					<?php 
							} // end modal choice
						} // end button choice
					?>

				</div><!-- .donate-button-wrap -->

			</div><!-- .large-9 -->

		</div><!-- .bottom_nav_wrap .row -->

	</header><!-- #masthead -->

	</div><!-- .header_bg -->

</div><!-- .inner_header_wrap -->
