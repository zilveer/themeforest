<?php
/**
 * The Header.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes, minimum-scale=1.0" />
<?php // header('X-UA-Compatible: IE=edge,chrome=1'); ?>

<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

<?php
	/*
	 * Print the favicon.
	 */
	$favicon = ot_get_option( 'favicon' );
 ?>
 
<?php if ( ! empty( $favicon ) ) : ?>
	<!-- Favicon -->
	<link rel="icon" href="<?php echo esc_url( $favicon ); ?>" type="image/x-icon">
<?php endif; ?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	if ( is_singular('post') && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
?>

<?php
/*
* Retina logo.
*/
$logo_retina = ot_get_option( 'logo_retina' );
$logo_retina_light = ot_get_option( 'logo_retina_light' );
$logo_retina_width = ot_get_option( 'logo_retina_width' );
$logo_retina_height = ot_get_option( 'logo_retina_height' );
?>
<?php if ( ! empty( $logo_retina ) ) : ?>
	<style>
	@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (min-resolution: 120dpi) {
		.site-title-custom img { display:none !important; }
		.site-title-custom .logo-retina { display:block !important;max-width:<?php echo esc_attr( $logo_retina_width ); ?>px!important;max-height:<?php echo esc_attr( $logo_retina_height ); ?>px!important; }
	}
	</style>
<?php endif; ?>

<?php if ( ! empty( $logo_retina_light ) ) : ?>
	<style>
	@media only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen and (min-resolution: 120dpi) {
		.site-title-custom .logo-default { display:none !important; }
		.site-title-custom .logo-light { display:none !important; }
		.site-title-custom .logo-retina { display:block !important;max-width:<?php echo esc_attr( $logo_retina_width ); ?>px!important;max-height:<?php echo esc_attr( $logo_retina_height ); ?>px!important; }
		.site-title-custom .logo-retina-light { display:block !important;max-width:<?php echo esc_attr( $logo_retina_width ); ?>px!important;max-height:<?php echo esc_attr( $logo_retina_height ); ?>px!important; }
		@media (max-width: 1024px) {
			.transparent-header .site-title-custom .logo-retina,
			.site-title-custom .logo-retina {
				display:block !important;
				opacity: 1 !important;
			}
			.transparent-header .site-title-custom .logo-retina-light,
			.site-title-custom .logo-retina-light {
				display:none !important;
				opacity: 0 !important;
			}
		}
	}
	</style>
<?php endif; ?>
	
<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>

<?php //if ( ! is_404() ) { ?>
	<!-- Page
================================================== -->


<?php $left_menu = ot_get_option( 'left_menu' ); ?>
<?php if ( empty( $left_menu ) ) { ?>


<?php $header_style = ot_get_option( 'header_style' ); ?>
<?php if ( empty( $header_style ) ) { ?>
	<?php $header_style = 'fixed'; ?>
<?php } ?>
<?php $enable_top_bar = ot_get_option( 'enable_top_bar' ); ?>
<?php $header_background_for_blog = ot_get_option( 'header_background_for_blog' ); ?>

<?php $enable_transparent_header_background_for_blog = ot_get_option( 'enable_transparent_header_background_for_blog' ); ?>
<?php $enable_transparent_header_background_for_shop = ot_get_option( 'enable_transparent_header_background_for_shop' ); ?>

<?php $header_background_for_shop = ot_get_option( 'header_background_for_shop' ); ?>

<?php global $post_type; ?>
<?php $enable_transparent_header_background_for_single_portfolio_pages = ot_get_option( 'enable_transparent_header_background_for_single_portfolio_pages' ); ?>

<?php $optiontree_enable_transparent_header_background_for_single_portfolio_pages = get_post_meta( get_the_ID(), 'optiontree_enable_transparent_header_background_for_single_portfolio_pages', true ); ?>

<?php $header_background_for_shop = ot_get_option( 'header_background_for_shop' ); ?>

<?php $center_logo_and_menu = ot_get_option( 'center_logo_and_menu' ); ?>
<?php if ( ! empty( $center_logo_and_menu ) ) { ?>
	<?php $center_logo_and_menu_class = 'center-logo-and-menu-enabled' ; ?>
<?php } else { ?>
	<?php $center_logo_and_menu_class = 'center-logo-and-menu-disabled' ; ?>
<?php } ?>

<?php $enable_full_width_for_header_and_footer = ot_get_option( 'enable_full_width_for_header_and_footer' ); ?>
<?php if ( ! empty( $enable_full_width_for_header_and_footer ) ) { ?>
	<?php $full_width_for_header_and_footer = 'full-width-header-footer-enabled ' ;?>
<?php } else { ?>
	<?php $full_width_for_header_and_footer = 'full-width-header-footer-disabled ' ;?>
<?php } ?>

<?php $remove_header_height_reduction = ot_get_option( 'remove_header_height_reduction' ); ?>

<section id="page" class="<?php echo sanitize_html_class( $full_width_for_header_and_footer ); ?> hfeed <?php echo sanitize_html_class( $center_logo_and_menu_class ); if ( $header_style == 'non_fixed' ) { ?> non-sticky-header <?php } else { ?> sticky-header <?php } ?><?php if ( ! empty( $remove_header_height_reduction ) ) { ?>no-height-reduction <?php } ?><?php if ( ! empty( $enable_top_bar ) ) { ?>top-bar-enabled<?php } else { ?>top-bar-disabled<?php } ?> <?php if ( is_page_template( 'page-header-tansparent.php' ) || ! empty( $enable_transparent_header_background_for_blog ) && ! empty( $header_background_for_blog ) && mega_is_blog() || ! empty( $enable_transparent_header_background_for_blog ) && ! empty( $header_background_for_blog ) && is_search() || ! empty( $enable_transparent_header_background_for_blog ) && ! empty( $header_background_for_blog ) && is_404() || ! empty( $enable_transparent_header_background_for_shop ) && ! empty( $header_background_for_shop ) && is_shop() || ! empty( $enable_transparent_header_background_for_shop ) && ! empty( $header_background_for_shop ) && is_product_category() || ! empty( $enable_transparent_header_background_for_shop ) && ! empty( $header_background_for_shop ) && is_product_tag() || ! empty( $enable_transparent_header_background_for_single_portfolio_pages ) && $post_type == 'portfolio' || ! empty( $optiontree_enable_transparent_header_background_for_single_portfolio_pages ) ) { ?>transparent-header<?php } ?> <?php if ( ! empty( $header_background_for_blog ) && mega_is_blog() || ! empty( $header_background_for_blog ) && is_search() || ! empty( $header_background_for_blog ) && is_404() || ! empty( $header_background_for_shop ) && is_shop() || ! empty( $header_background_for_shop ) && is_product_category() || ! empty( $header_background_for_shop ) && is_product_tag() || ! empty( $enable_transparent_header_background_for_single_portfolio_pages ) && $post_type == 'portfolio' || ! empty( $optiontree_enable_transparent_header_background_for_single_portfolio_pages ) ) { ?>big-header-enabled<?php } ?>">

	<!-- Head
================================================== -->
	<?php if ( ! empty( $enable_top_bar ) ) { ?>
		<section id="top-bar-wrapper">
			<div id="top-bar" class="clearfix">
				<?php $search_header_position = ot_get_option( 'search_header_position' ); ?>
				<?php if ( $search_header_position == 'top_bar' ) { ?>
					<div class="search-wrapper">
						<div class="search-form-wrapper">
							<?php //get_search_form(); // Search form ?>
							<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<label for="s"></label>
								<input type="text" class="field" name="s" id="s" placeholder="<?php _e( 'Search', 'mega' ) ?>" autocomplete="off" /> 
								<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'mega' ); ?>" />
								<input type="hidden" name="post_type" value="post" />
							</form>
							<span id="remove-search">&times;</span>
						</div>
					</div>
								
					<div class="search-header-wrapper">
						<a id="search-header-icon" href="#">
							<i></i>
						</a>
					</div>
				<?php } ?>
				
				<?php $social_icons_position = ot_get_option( 'social_icons_position' ); ?>
				<?php if ( $social_icons_position == 'top_bar' ) { ?>
					<div class="social-accounts-wrapper">
						<?php get_template_part( 'social-accounts' ); // Social accounts ?>
					</div>
				<?php } ?>
			
				<?php $top_bar_info = ot_get_option( 'top_bar_info' ); ?>
				<?php if ( ! empty( $top_bar_info ) ) { ?>
					<div class="info-header">
							<?php if ( function_exists( 'icl_t' ) ) { ?>
								<?php echo icl_t( 'OptionTree', 'top_bar_info', $top_bar_info ); ?>
							<?php } else { ?>
								<?php echo $top_bar_info; ?>
							<?php } ?>
					</div>
				<?php } ?>
					
				
				<?php $woocommerce_cart_position = ot_get_option( 'woocommerce_cart_position' ); ?>
				<?php if ( $woocommerce_cart_position == 'top_bar' ) { ?>
					<?php global $woocommerce; ?>
					<?php if ( $woocommerce ) { ?>
						<div class="woocommerce-cart-wrapper">
							<?php if ( ! $woocommerce->cart->cart_contents_count ) { ?>
								<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i> (<?php echo $woocommerce->cart->cart_contents_count; ?>)</span></a>
							<?php } else { ?>
								<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i> (<?php echo $woocommerce->cart->cart_contents_count; ?>)</span></a>
								<div class="product-list-cart">
									<ul>
									<?php foreach($woocommerce->cart->cart_contents as $cart_item): //var_dump($cart_item); ?>
										<li>
											<a href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
												<?php echo get_the_post_thumbnail( $cart_item['product_id'], 'shop_thumbnail' ); ?>
												<?php echo $cart_item['data']->post->post_title; ?>
											</a>
											<?php echo $cart_item['quantity']; ?> x <?php echo $woocommerce->cart->get_product_subtotal( $cart_item['data'], $cart_item['quantity'] ); ?>
										</li>
										<?php endforeach; ?>
										<div class="woocommerce-cart-checkout">
											<a class="button" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_cart_page_id' ) ) ); ?>"><?php _e( 'View Cart', 'mega' ); ?></a>
											<a class="button alt" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_checkout_page_id' ) ) ); ?>"><?php _e( 'Checkout', 'mega' ); ?> &rarr;</a>
										</div>
									</ul>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				<?php } ?>
				
				<?php global $woocommerce; ?>
				<?php if ( $woocommerce ) { ?>
					<div class="woocommerce-links">
						<?php if ( is_user_logged_in() ) { ?>
							<a class="logout" href="<?php echo esc_url( get_permalink( get_option('woocommerce_logout_page_id') ) ); ?>"><?php _e( 'Logout', 'mega' ); ?></a>
							<a class="account" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><?php _e( 'My Account', 'mega' ); ?></a>
						<?php } else { ?>
							<a class="account" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><?php _e( 'Login', 'mega' ); ?></a>
						<?php } ?>
					</div>
				<?php } ?>
				
				<?php // WPML
				$enable_wpml_language_switcher = ot_get_option( 'enable_wpml_language_switcher' );
				if ( !empty( $enable_wpml_language_switcher ) ) {
					?>
					<div class="lang_sel-wrapper">
						<?php do_action('icl_language_selector'); ?>
					</div>
				<?php } ?>
			</div>
		</section>
	<?php } // End if ( ! empty( $enable_top_bar ) ) ?>
	<?php $remove_header_height_reduction = ot_get_option( 'remove_header_height_reduction' ); ?>
	<section id="header-wrapper" <?php if ( $header_style == 'fixed' ) { ?>class="fixed"<?php } ?>>
		<section id="header" <?php if ( $header_style == 'fixed' ) { ?> <?php if ( empty( $remove_header_height_reduction ) ) { ?> data-99="height:73px;" data-100="height:50px;" data-smooth-scrolling="off"<?php } else { ?>class="no-height-reduction"<?php } ?><?php } ?>>
			
			<?php if ( empty( $center_logo_and_menu ) ) { ?>
			
				<?php $search_header_position = ot_get_option( 'search_header_position' ); ?>
				<?php if ( $search_header_position == 'header' ) { ?>
					<div class="search-wrapper">
						<div class="search-form-wrapper">
							<?php //get_search_form(); // Search form ?>
							<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<label for="s"></label>
								<input type="text" class="field" name="s" id="s" placeholder="<?php _e( 'Search', 'mega' ) ?>" autocomplete="off" /> 
								<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'mega' ); ?>" />
								<input type="hidden" name="post_type" value="post" />
							</form>
							<span id="remove-search" <?php if ( $header_style == 'fixed' ) { ?> <?php if ( empty( $remove_header_height_reduction ) ) { ?>data-99="padding:27px 0 27px;" data-100="padding:15px 0px 14px;" data-smooth-scrolling="off"<?php } ?><?php } ?>>&times;</span>
						</div>
					</div>
				<?php } ?>
			
			<?php } ?>
			
			<header id="branding" class="clearfix" role="banner">
					
					<?php
					/*
					 * Print the logo.
					 */
					$logo = ot_get_option( 'logo' );
					?>
					<?php if ( ! empty( $logo ) ) { ?>
						<?php $id = mega_custom_get_attachment_id( $logo ); ?>
						<?php $id_retina = mega_custom_get_attachment_id( $logo_retina ); ?>
						<?php $id_retina_light = mega_custom_get_attachment_id( $logo_retina_light ); ?>
						<?php $src = wp_get_attachment_image_src( $id, 'large' ); ?>
						<?php $src_retina = wp_get_attachment_image_src( $id_retina, 'large' ); ?>
						<?php $src_retina_light = wp_get_attachment_image_src( $id_retina_light, 'large' ); ?>
						<div class="site-title-custom clearfix" <?php if ( $header_style == 'fixed' ) { ?><?php if ( empty( $remove_header_height_reduction ) ) { ?>data-99="margin:23px 0px;" data-100="margin:11px 0px;" data-smooth-scrolling="off"<?php } ?><?php } ?>>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="custom-logo">
								<?php
								/*
								 * Print the light logo.
								 */
								$logo_light = ot_get_option( 'logo_light' );
								?>
								<?php if ( ! empty( $logo_light ) ) { ?>
									<?php $id_light = mega_custom_get_attachment_id( $logo_light ); ?>
									<?php $src_light = wp_get_attachment_image_src( $id_light, 'large' ); ?>
									<img class="logo-light" src="<?php echo esc_url( $src_light[0] ); ?>" width="<?php echo esc_attr( $src_light[1] ); ?>" height="<?php echo esc_attr( $src_light[2] ); ?>" <?php if ( $header_style == 'fixed' ) { ?><?php if ( empty( $remove_header_height_reduction ) ) { ?>data-99="max-height:<?php echo esc_attr( $src[2] ); ?>px; min-height: <?php echo esc_attr( $src[2] ); ?>px;" data-100="max-height:39px; min-height: 39px" data-smooth-scrolling="off"<?php } ?><?php } ?> />
								<?php } ?>
								
								<?php if ( ! empty( $logo_retina ) ) : ?>
									<img class="logo-retina" src="<?php echo esc_url( $src_retina[0] ); ?>" width="<?php echo esc_attr( $src_retina[1] ); ?>" height="<?php echo esc_attr( $src_retina[2] ); ?>" <?php if ( $header_style == 'fixed' ) { ?><?php if ( empty( $remove_header_height_reduction ) ) { ?>data-99="max-height:<?php echo esc_attr( $src[2] ); ?>px; min-height: <?php echo esc_attr( $src[2] ); ?>px;" data-100="max-height:39px; min-height: 39px" data-smooth-scrolling="off"<?php } ?><?php } ?> />
								<?php endif; ?>
								
								<?php if ( ! empty( $logo_retina_light ) ) : ?>
									<img class="logo-retina-light" src="<?php echo esc_url( $src_retina_light[0] ); ?>" width="<?php echo esc_attr( $src_retina_light[1] ); ?>" height="<?php echo esc_attr( $src_retina_light[2] ); ?>" <?php if ( $header_style == 'fixed' ) { ?><?php if ( empty( $remove_header_height_reduction ) ) { ?>data-99="max-height:<?php echo esc_attr( $src[2] ); ?>px; min-height: <?php echo esc_attr( $src[2] ); ?>px;" data-100="max-height:39px; min-height: 39px" data-smooth-scrolling="off"<?php } ?><?php } ?> />
								<?php endif; ?>
								
								<img class="logo-default" src="<?php echo esc_url( $src[0] ); ?>" width="<?php echo esc_attr( $src[1] ); ?>" height="<?php echo esc_attr( $src[2] ); ?>" <?php if ( $header_style == 'fixed' ) { ?><?php if ( empty( $remove_header_height_reduction ) ) { ?>data-99="max-height:<?php echo esc_attr( $src[2] ); ?>px; min-height: <?php echo esc_attr( $src[2] ); ?>px;" data-100="max-height:26px; min-height: 26px" data-smooth-scrolling="off"<?php } ?><?php } ?> />
							</a>
						</div>
					<?php } else { ?>
						<div id="site-title" class="clearfix" <?php if ( $header_style == 'fixed' ) { ?><?php if ( empty( $remove_header_height_reduction ) ) { ?>data-99="margin:27px 0px;" data-100="margin:15px 0px;" data-smooth-scrolling="off"<?php } ?><?php } ?>>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?>
							</a>
						</div>
					<?php } ?>
					
					<!-- Navbar
	================================================== -->
					<nav id="access" role="navigation" class="clearfix">
						<?php if ( ! empty( $center_logo_and_menu ) ) { ?>
			
							<?php $search_header_position = ot_get_option( 'search_header_position' ); ?>
							<?php if ( $search_header_position == 'header' ) { ?>
								<div class="search-wrapper">
									<div class="search-form-wrapper">
										<?php //get_search_form(); // Search form ?>
										<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
											<label for="s"></label>
											<input type="text" class="field" name="s" id="s" placeholder="<?php _e( 'Search', 'mega' ) ?>" autocomplete="off" /> 
											<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'mega' ); ?>" />
											<input type="hidden" name="post_type" value="post" />
										</form>
										<span id="remove-search" <?php if ( $header_style == 'fixed' ) { ?> <?php if ( empty( $remove_header_height_reduction ) ) { ?>data-99="padding:28px 0 28px;" data-100="padding:16px 0px 15px;" data-smooth-scrolling="off"<?php } ?><?php } ?>>&times;</span>
									</div>
								</div>
							<?php } ?>
						
						<?php } ?>
						
						<?php $search_header_position = ot_get_option( 'search_header_position' ); ?>
						<?php if ( $search_header_position == 'header' ) { ?>	
							<div class="search-header-wrapper" <?php if ( $header_style == 'fixed' ) { ?><?php if ( empty( $remove_header_height_reduction ) ) { ?>data-99="margin:28px 0 28px" data-100="margin:16px 0px 15px;" data-smooth-scrolling="off"<?php } ?><?php } ?>>
								<a id="search-header-icon" href="#">
									<i></i>
								</a>
							</div>
						<?php } ?>
						
						<?php $social_icons_position = ot_get_option( 'social_icons_position' ); ?>
						<?php if ( $social_icons_position == 'header' ) { ?>
							<div class="social-accounts-wrapper" <?php if ( $header_style == 'fixed' ) { ?><?php if ( empty( $remove_header_height_reduction ) ) { ?>data-99="margin:28px 0 28px" data-100="margin:16px 0px 15px;" data-smooth-scrolling="off"<?php } ?><?php } ?>>
								<?php get_template_part( 'social-accounts' ); // Social accounts ?>
							</div>
						<?php } ?>
						
						<?php $woocommerce_cart_position = ot_get_option( 'woocommerce_cart_position' ); ?>
						<?php if ( $woocommerce_cart_position == 'header' ) { ?>
							<?php global $woocommerce; ?>
							<?php if ( $woocommerce ) { ?>
								<div class="woocommerce-cart-wrapper">
									<?php if ( ! $woocommerce->cart->cart_contents_count ) { ?>
										<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i> (<?php echo $woocommerce->cart->cart_contents_count; ?>)</span></a>
									<?php } else { ?>
										<a class="woocommerce-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><span><i></i> (<?php echo $woocommerce->cart->cart_contents_count; ?>)</span></a>
										<div class="product-list-cart">
											<ul>
											<?php foreach($woocommerce->cart->cart_contents as $cart_item): //var_dump($cart_item); ?>
												<li>
													<a href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
														<?php echo get_the_post_thumbnail( $cart_item['product_id'], 'shop_thumbnail' ); ?>
														<?php echo $cart_item['data']->post->post_title; ?>
													</a>
													<?php echo $cart_item['quantity']; ?> x <?php echo $woocommerce->cart->get_product_subtotal( $cart_item['data'], $cart_item['quantity'] ); ?>
												</li>
												<?php endforeach; ?>
												<div class="woocommerce-cart-checkout">
													<a class="button" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_cart_page_id' ) ) ); ?>"><?php _e( 'View Cart', 'mega' ); ?></a>
													<a class="button alt" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_checkout_page_id' ) ) ); ?>"><?php _e( 'Checkout', 'mega' ); ?> &rarr;</a>
												</div>
											</ul>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						<?php } ?>
						
						<?php if ( has_nav_menu( 'primary' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'sf-menu', 'container_class' => 'nav-menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						<?php } else { ?>
							<?php //wp_page_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'page-menu' ) ); ?>
						<?php } ?>
						
						<?php if ( has_nav_menu( 'primary' ) ) { ?>
							<a id="mobile-menu-dropdown" class="clearfix" href="#">
								<i></i>
							</a>
					<?php } ?>
					</nav><!-- #access -->
			</header><!-- #branding -->		
		</section><!-- #header -->
		
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<div id="access-mobile-wrapper" class="clearfix">
				<nav id="access-mobile" role="navigation" class="clearfix">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'mobile-menu' ) ); ?>
					
					<?php $social_icons_position = ot_get_option( 'social_icons_position' ); ?>
					<?php if ( $social_icons_position == 'header' || $social_icons_position == 'top_bar' ) { ?>
						<div class="social-accounts-wrapper-mobile clearfix">
							<?php get_template_part( 'social-accounts' ); // Social accounts ?>
						</div>
					<?php } ?>
					
					<?php $search_header_position = ot_get_option( 'search_header_position' ); ?>
					<?php if ( $search_header_position == 'top_bar' || $search_header_position == 'header' ) { ?>
						<?php get_search_form(); // Search form ?>
					<?php } ?>
				</nav><!-- #access-mobile -->
			</div>
		<?php endif; ?>
	</section><!-- #header-wrapper -->
	
	
	<?php } else { ?>
		
	<section id="page" class="hfeed <?php if ( is_page_template( 'page-header-tansparent.php' ) || is_page_template( 'page-header-tansparent-slider.php' ) ) { ?>transparent-header<?php } ?>">
	<section id="header-wrapper">
		<section id="header">
			<header id="branding" class="clearfix" role="banner">
					
					<?php
					/*
					 * Print the logo.
					 */
					$logo = ot_get_option( 'logo' );
					?>
					<?php if ( ! empty( $logo ) ) { ?>
						<?php $id = mega_custom_get_attachment_id( $logo ); ?>
						<?php $id_retina = mega_custom_get_attachment_id( $logo_retina ); ?>
						<?php $id_retina_light = mega_custom_get_attachment_id( $logo_retina_light ); ?>
						<?php $src = wp_get_attachment_image_src( $id, 'large' ); ?>
						<?php $src_retina = wp_get_attachment_image_src( $id_retina, 'large' ); ?>
						<?php $src_retina_light = wp_get_attachment_image_src( $id_retina_light, 'large' ); ?>
						<div class="site-title-custom clearfix">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" id="custom-logo">
								<?php
								/*
								 * Print the light logo.
								 */
								$logo_light = ot_get_option( 'logo_light' );
								?>
								<?php if ( ! empty( $logo_light ) ) { ?>
									<?php $id_light = mega_custom_get_attachment_id( $logo_light ); ?>
									<?php $src_light = wp_get_attachment_image_src( $id_light, 'large' ); ?>
									<img class="logo-light" src="<?php echo esc_url( $src_light[0] ); ?>" width="<?php echo esc_attr( $src_light[1] ); ?>" height="<?php echo esc_attr( $src_light[2] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
								<?php } ?>
								
								<?php if ( ! empty( $logo_retina ) ) : ?>
									<img class="logo-retina" src="<?php echo esc_url( $src_retina[0] ); ?>" width="<?php echo esc_attr( $src_retina[1] ); ?>" height="<?php echo esc_attr( $src_retina[2] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
								<?php endif; ?>
								
								<?php if ( ! empty( $logo_retina_light ) ) : ?>
									<img class="logo-retina-light" src="<?php echo esc_url( $src_retina_light[0] ); ?>" width="<?php echo esc_attr( $src_retina_light[1] ); ?>" height="<?php echo esc_attr( $src_retina_light[2] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
								<?php endif; ?>
								
								<img class="logo-default" src="<?php echo esc_url( $src[0] ); ?>" width="<?php echo esc_attr( $src[1] ); ?>" height="<?php echo esc_attr( $src[2] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							</a>
						</div>
					<?php } else { ?>
						<div id="site-title" class="clearfix">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?>
							</a>
						</div>
					<?php } ?>
					
					<!-- Navbar
	================================================== -->
					<nav id="access" role="navigation" class="clearfix">
						<?php if ( has_nav_menu( 'primary' ) ) { ?>
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'sf-menu', 'container_class' => 'nav-menu', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						<?php } else { ?>
							<?php //wp_page_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'page-menu' ) ); ?>
						<?php } ?>
						
						<?php if ( has_nav_menu( 'primary' ) ) { ?>
							<a id="mobile-menu-dropdown" class="clearfix" href="#">
								<i></i>
							</a>
					<?php } ?>
					
						<div class="header-elements-wrapper">
							<?php if ( is_page_template( 'page-header-tansparent-slider.php' ) ) { ?>
								<nav class="rs-arrows-wrapper">
									<div class="tp-leftarrow  tparrows default round"></div>
									<div class="tp-rightarrow  tparrows default round"></div>
								</nav>
							<?php } ?>
						
							<?php $social_icons_position = ot_get_option( 'social_icons_position' ); ?>
							<?php if ( $social_icons_position == 'header' ) { ?>
								<div class="social-accounts-wrapper">
									<?php get_template_part( 'social-accounts' ); // Social accounts ?>
								</div>
							<?php } ?>
							
							<?php $header_info = ot_get_option( 'header_info' ); ?>
							<?php if ( ! empty( $header_info ) ) { ?>
								<div class="info-header">
										<?php if ( function_exists( 'icl_t' ) ) { ?>
											<?php echo icl_t( 'OptionTree', 'header_info', $header_info ); ?>
										<?php } else { ?>
											<?php echo wpautop( $header_info ); ?>
										<?php } ?>
								</div>
							<?php } ?>
						</div>
					</nav><!-- #access -->
			</header><!-- #branding -->
		</section><!-- #header -->
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<div id="access-mobile-wrapper" class="clearfix">
				<nav id="access-mobile" role="navigation" class="clearfix">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'mobile-menu' ) ); ?>
					
					<?php $social_icons_position = ot_get_option( 'social_icons_position' ); ?>
					<?php if ( $social_icons_position == 'header' || $social_icons_position == 'top_bar' ) { ?>
						<div class="social-accounts-wrapper-mobile clearfix">
							<?php get_template_part( 'social-accounts' ); // Social accounts ?>
						</div>
					<?php } ?>
					
					<?php $search_header_position = ot_get_option( 'search_header_position' ); ?>
					<?php if ( $search_header_position == 'top_bar' || $search_header_position == 'header' ) { ?>
						<?php get_search_form(); // Search form ?>
					<?php } ?>
				</nav><!-- #access-mobile -->
			</div>
		<?php endif; ?>
	</section><!-- #header-wrapper -->
		
	<?php } // End if ( empty( $left_menu ) ) ?>
<?php //} // End if ( ! is_404() ) ?>