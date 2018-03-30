<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head data-template-uri="<?php echo get_template_directory_uri() ?>">

    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php if ( lsvr_get_image_field( 'favicon' ) ) { ?><link rel="shortcut icon" href="<?php echo esc_url( lsvr_get_image_field( 'favicon' ) ); ?>"><?php } ?>

    <?php wp_head(); ?>

</head>

<?php if ( defined( 'enable_style_switcher' ) && enable_style_switcher ) : ?>
<body <?php body_class( 'm-has-style-switcher' ); ?>>
<?php else : ?>
<body <?php body_class(); ?>>
<?php endif; ?>

	<!-- HEADER : begin -->
	<header id="header"
		<?php if ( lsvr_get_image_field( 'header_bg_image' ) ) { echo ' style="background-image: url( ' . esc_url( lsvr_get_image_field( 'header_bg_image' ) ) . ' );" '; } ?>
		class="<?php if ( lsvr_get_field( 'enable_animated_header_bg', true, true ) ) { echo ' m-animated'; } ?><?php if ( lsvr_get_field( 'enable_header_panel', true, true ) ) { echo ' m-has-header-panel'; } ?>">
		<div class="header-bg">
			<div class="header-inner">

				<!-- HEADER BRANDING : begin -->
				<?php if ( lsvr_get_image_field( 'default_logo' ) ) : ?>
				<div class="header-branding">
					<a href="<?php echo home_url(); ?>">
						<img src="<?php echo esc_url( lsvr_get_image_field( 'default_logo' ) ); ?>"
						<?php if ( lsvr_get_image_field( 'default_logo_2x' ) !== '' ) { echo ' data-hires="' . esc_url( lsvr_get_image_field( 'default_logo_2x' ) ) . '"'; } ?>
						width="<?php echo esc_attr( lsvr_get_field( 'default_logo_width', 291 ) ); ?>"
						alt="<?php bloginfo( 'name' ); ?>">
					</a>
				</div>
				<?php endif; ?>
				<!-- HEADER BRANDING : end -->

				<!-- HEADER NAVIGATION : begin -->
				<div class="header-navigation">

					<?php // HEADER MENU
					get_template_part( 'menu', 'header' ); // Load menu-header.php template. ?>

					<?php if ( class_exists( 'woocommerce' ) && lsvr_get_field( 'enable_header_cart', true, true ) ) : ?>
					<?php global $woocommerce; ?>
						<?php $cart_url = $woocommerce->cart->get_cart_url(); ?>
						<!-- HEADER CART : begin -->
						<div class="header-cart">
							<div class="header-cart-inner">
								<a href="<?php echo esc_url( $cart_url ); ?>"><i class="cart-ico fa fa-shopping-cart"></i>
								<span class="cart-label"><?php _e( 'Cart', 'beautyspot' ); ?></span>
								<span class="cart-count">(<?php echo sprintf( _n( '%d item', '%d items', $woocommerce->cart->cart_contents_count, 'beautyspot' ), $woocommerce->cart->cart_contents_count ); ?>)</span></a>
							</div>
						</div>
						<!-- HEADER CART : end -->
					<?php endif; ?>

					<?php if ( lsvr_get_field( 'enable_header_search', true, true ) ) : ?>
					<!-- HEADER SEARCH : begin -->
					<div class="header-search">
						<div class="header-search-inner">
							<form class="search-form" action="<?php echo home_url( '/' ) ?>" method="get">
								<i class="search-ico fa fa-search"></i>
								<input class="search-input" type="text" id="s" name="s" placeholder="<?php _e( 'Search for ...', 'beautyspot' ); ?>">
								<button class="search-submit" type="submit"><i class="fa fa-angle-right"></i></button>
								<button class="search-toggle" type="button"><?php _e( 'Search', 'beautyspot' ); ?></button>
							</form>
						</div>
						<button class="search-toggle-mobile" type="button"><i class="fa"></i></button>
					</div>
					<!-- HEADER SEARCH : end -->
					<?php endif; ?>

				</div>
				<!-- HEADER NAVIGATION : end -->

				<?php if ( lsvr_get_field( 'enable_header_panel', true, true ) ) : ?>
				<!-- HEADER PANEL : begin -->
				<div class="header-panel<?php if ( lsvr_get_field( 'header_panel_closed', false, true ) ) { echo ' m-closed'; } ?><?php if ( lsvr_get_field( 'enable_reservation_form_btn', true, true ) ) { echo ' m-has-reservation-btn'; } ?>">

					<button class="header-panel-toggle" type="button"><i class="fa"></i></button>

					<?php if ( lsvr_get_field( 'enable_reservation_form_btn', true, true ) ) : ?>
					<!-- HEADER RESERVATION : begin -->
					<div class="header-reservation">
						<a href="#reservation-form" class="c-button"><?php echo lsvr_get_field( 'header_reservation_btn_label', __( 'Make An Appointment', 'beautyspot' ) ); ?></a>
					</div>
					<!-- HEADER RESERVATION : end -->
					<?php endif; ?>

					<?php if ( lsvr_get_field( 'enable_header_contact', true, true ) ) : ?>
					<!-- HEADER CONTACT : begin -->
					<div class="header-contact">
						<ul>

							<?php if ( lsvr_get_field( 'header_contact_1_text' ) !== '' ) : ?>
							<li>
								<div class="item-inner">
									<i class="ico fa <?php echo esc_attr( lsvr_get_field( 'header_contact_1_ico' ) ); ?>"></i>
									<?php echo wpautop( lsvr_get_field( 'header_contact_1_text' ) ); ?>
								</div>
							</li>
							<?php endif; ?>

							<?php if ( lsvr_get_field( 'header_contact_2_text' ) !== '' ) : ?>
							<li>
								<div class="item-inner">
									<i class="ico fa <?php echo esc_attr( lsvr_get_field( 'header_contact_2_ico' ) ); ?>"></i>
									<?php echo wpautop( lsvr_get_field( 'header_contact_2_text' ) ); ?>
								</div>
							</li>
							<?php endif; ?>

							<?php if ( lsvr_get_field( 'header_contact_3_text' ) !== '' ) : ?>
							<li>
								<div class="item-inner">
									<i class="ico fa <?php echo esc_attr( lsvr_get_field( 'header_contact_3_ico' ) ); ?>"></i>
									<?php echo wpautop( lsvr_get_field( 'header_contact_3_text' ) ); ?>
								</div>
							</li>
							<?php endif; ?>

							<?php if ( lsvr_get_field( 'header_contact_4_text' ) !== '' ) : ?>
							<li>
								<div class="item-inner">
									<i class="ico fa <?php echo esc_attr( lsvr_get_field( 'header_contact_4_ico' ) ); ?>"></i>
									<?php echo wpautop( lsvr_get_field( 'header_contact_4_text' ) ); ?>
								</div>
							</li>
							<?php endif; ?>

						</ul>
					</div>
					<!-- HEADER CONTACT : end -->
					<?php endif; ?>

					<?php $social_links = lsvr_get_social_links(); ?>
					<?php $social_links_target = lsvr_get_field( 'social_links_target', false, true ); ?>
					<?php if ( $social_links ) : ?>
					<!-- HEADER SOCIAL : begin -->
					<div class="header-social">
						<ul>
							<?php $special_icons = array( 'email' => 'fa fa-envelope-o', 'twitter' => 'soc-twitter-bird', 'vk' => 'fa fa-vk', 'yelp' => 'fa fa-yelp' ); ?>
							<?php foreach ( $social_links as $key => $val ) : ?>
								<?php if ( strpos( $val, 'http://' ) === 0 || strpos( $val, 'https://' ) === 0 || strpos( $val, '#' ) === 0 || strpos( $val, '@' ) ) : ?>

									<?php if ( $key === 'email' ) : ?>
										<?php $val = 'mailto:' . $val; ?>
									<?php endif; ?>

									<li><a href="<?php echo esc_url( $val ); ?>"<?php if ( $social_links_target ) { echo ' target="_blank"'; } ?>>
										<?php if ( array_key_exists( $key, $special_icons ) ) : ?>
											<i class="<?php echo esc_attr( $special_icons[ $key ] ); ?>"></i>
										<?php else : ?>
											<i class="soc-<?php echo esc_attr( $key ); ?>"></i>
										<?php endif; ?>
									</a></li>

								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</div>
					<!-- HEADER SOCIAL : end -->
					<?php endif; ?>

				</div>
				<!-- HEADER PANEL : end -->
				<?php endif; ?>

			</div>
		</div>
	</header>
	<!-- HEADER : end -->

	<!-- WRAPPER : begin -->
	<div id="wrapper">