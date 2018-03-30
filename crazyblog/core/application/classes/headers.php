<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Header {

	static public function crazyblog_headers() {
		$settings = crazyblog_opt();
		$header_opt = $settings;
		$header = crazyblog_set( $header_opt, 'custom_header', 'header_1' );
		switch ( $header ) {
			case "header_1":
				self::crazyblog_header_1( $settings );
				break;
			case "header_2":
				self::crazyblog_header_2( $settings );
				break;
			case "header_3":
				self::crazyblog_header_3( $settings );
				break;
			case "header_4":
				self::crazyblog_header_4( $settings );
				break;
			default:
				self::crazyblog_header_1( $settings );
		}
		self::crazyblog_responsive_header( $settings );
	}

	static public function crazyblog_header_1( $settings ) {
		$general = $settings;
		$subNav = crazyblog_set( $general, 'subMenuStyle' );
		$bg = (crazyblog_set( $general, 'upload_logobar_bg' )) ? "style=background:url('" . crazyblog_set( $general, 'upload_logobar_bg' ) . "');" : "sytle=background:url(" . crazyblog_URI . "assets/images/pagetop.jgp)";
		$header_color = (crazyblog_set( $general, 'header_one_color' ) != 'dark') ? crazyblog_set( $general, 'header_one_color' ) : "";
		$stickyHeader = (crazyblog_set( $general, 'header_one_sticky' )) ? 'stick' : '';
		?>
		<div class="header-wrap">
			<div class="creative-header <?php echo esc_attr( $header_color ); ?> <?php echo esc_attr( $stickyHeader ); ?>">
				<?php if ( crazyblog_set( $general, 'show_topbar' ) ) : ?>
					<?php echo self::crazyblog_topbar(); ?>
				<?php endif; ?>
				<div class="logobar" <?php echo esc_attr( $bg ); ?>>
					<div class="container">
						<div class="logo"><?php echo self::crazyblog_logo(); ?></div>
						<?php crazyblog_adCode( 'header', 'h', 'add' ); ?>
					</div>
				</div><!-- Logobar -->
				<nav class="<?php echo esc_attr( $subNav ) ?>">
					<div class="container">

						<?php
						if ( has_nav_menu( 'primary-menu' ) ) {
							wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu-links', 'container' => false ) );
						} else {
							wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu-links', 'container' => false ) );
						}
						if ( has_nav_menu( 'primary-menu' ) ):
							?>
							<div class="header-form">
								<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<input type="text" placeholder="<?php esc_html_e( 'Search', 'crazyblog' ); ?>" name="s" />
									<button type="submit"><i class="fa fa-search"></i></button>
								</form>
							</div>
						<?php endif; ?>
					</div>
				</nav>
			</div>
		</div>

		<?php
	}

	static public function crazyblog_header_2( $settings ) {
		$general = $settings;
		$subNav = crazyblog_set( $general, 'subMenuStyle' );
		$stickyHeader = (crazyblog_set( $general, 'header_two_sticky' )) ? 'stick' : '';
		$social = crazyblog_set( crazyblog_set( $settings, 'crazyblog_social_icons' ), 'crazyblog_social_icons' );
		$upperType = crazyblog_set( $general, 'header_upper_area_type' );
		$videoSrc = crazyblog_set( $general, 'header_upper_area_video' );
		$mouse = (crazyblog_set( $general, 'header_upper_area_type' ) == 'video') ? 'mouse.png' : 'mouse-black.png';
		$scrollDown = crazyblog_URI . 'assets/images/' . $mouse;
		$crazyblog_meta = get_post_meta( get_the_ID(), 'crazyblog_page_meta', true );
		if ( crazyblog_set( $settings, 'before_header' ) == '1' && crazyblog_set( $crazyblog_meta, 'page_upper_section' ) == '1' ):
			echo '<div class="text-main">';
			$routating_text = crazyblog_set( crazyblog_set( $settings, 'crazyblog_header_routating_text' ), 'crazyblog_header_routating_text' );
			array_pop( $routating_text );
			$autoplay = (count( $routating_text ) > 1) ? 'true' : 'false';
			if ( $upperType == 'video' && !is_single() ):
				?>
				<div class="bg-div layered">
					<video preload="auto" autoplay loop="loop">
						<source src="<?php echo esc_url( $videoSrc ) ?>" type="video/mp4" />
					</video>
				</div>
				<?php
			else:
				if ( !is_single() ):
					?>
					<div class="bg-div">
						<img src="<?php echo esc_url( crazyblog_set( $settings, 'header_upper_bg' ) ) ?>" alt="" />
						<?php
						if ( !empty( $routating_text ) && count( $routating_text ) > 0 ):
							crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
							?>
							<div class="imgtext">
								<div class="container">
									<div class="text-carousel">
										<?php
										foreach ( $routating_text as $text ):
											$parts = explode( ' ', crazyblog_set( $text, 'heading' ), 3 );
											$tmp = '';
											if ( count( $parts ) > 1 ) {
												$tmp .= '<strong>' . crazyblog_set( $parts, '0' ) . ' <span>' . crazyblog_set( $parts, '2' ) . '</span> ' . crazyblog_set( $parts, '3' ) . '</strong>';
											} else {
												$tmp .= '<strong>' . crazyblog_set( $text, 'heading' ) . '</strong>';
											}
											?>
											<div class="text-div">
												<?php echo wp_kses_post( $tmp ) ?>
												<span><?php echo crazyblog_set( $text, 'sub_heading' ) ?></span>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>

							<?php $owl_carousel = 'jQuery(document).ready(function ($) {
				$(".text-carousel").owlCarousel({
				autoplay: ' . $autoplay . ',
				autoplayTimeout: 2500,
				smartSpeed: 2000,
				autoplayHoverPause: true,
				animateIn: "fadeIn",
				animateOut: "fadeOut",
				loop: true,
				dots: false,
				nav: false,
				margin: 0,
				mouseDrag: true,
				singleItem: true,
				items: 1,
				autoHeight: true
				});
				});
				'; ?>

							<?php wp_add_inline_script( 'crazyblog_df-owl', $owl_carousel ); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<a href="javascript:void(0)" data-info="Scroll Down" class="trigger <?php echo esc_attr( (crazyblog_set( $general, 'header_upper_area_type' ) == 'video') ? '' : 'triger2'  ) ?> bounce">
					<span>
						<img src="<?php echo esc_url( $scrollDown ) ?>" alt="" />
					</span>
				</a>
			<?php
			endif;
		endif;
		?>
		<div class="header-wrap" id="scrolled">
			<div class="<?php echo esc_attr( (crazyblog_set( $general, 'header_two_styles' )) ? crazyblog_set( $general, 'header_two_styles' ) : ""  ); ?> <?php echo esc_attr( (crazyblog_set( $general, 'header_two_color_scheme' )) ? " light " : ''  ); ?> ">
				<div class="container">
					<div class="logo"><?php echo self::crazyblog_logo(); ?></div>
					<nav class="<?php echo esc_attr( $subNav ) ?>">
						<?php
						if ( has_nav_menu( 'primary-menu' ) ) {
							wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu-links', 'container' => false ) );
						}
						?>
					</nav>
					<?php if ( !empty( $social ) && crazyblog_set( $general, 'header_two_social' ) && crazyblog_set( $general, 'header_two_styles' ) == "simple-header" ) : ?>
						<div class="simple-links">
							<?php
							foreach ( $social as $s ) :
								if ( crazyblog_set( $s, 'tocopy' ) )
									continue;
								?>
								<a href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>" title=""><i style="color:<?php echo esc_attr( crazyblog_set( $s, 'icon_color' ) ); ?>" class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i></a>
							<?php endforeach; ?>
						</div>

					<?php endif; ?>

					<?php if ( !empty( $social ) && crazyblog_set( $general, 'header_two_social' ) && (crazyblog_set( $general, 'header_two_styles' ) == "transparent-header" || crazyblog_set( $general, 'header_two_styles' ) == "transparent-header style2" ) ) : ?>
						<div class="simple-social">	
							<?php
							foreach ( $social as $s ) :
								if ( crazyblog_set( $s, 'tocopy' ) )
									continue;
								?>
								<a title="" href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>"><i class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if ( crazyblog_set( $general, 'header_two_search' ) ) : ?>
						<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<button type="submit"><i class="fa fa-search"></i></button>
							<input type="text" placeholder="<?php esc_html_e( 'Enter Your Search', 'crazyblog' ); ?>" name="s" />
						</form>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
		if ( crazyblog_set( $settings, 'before_header' ) == '1' ):
			echo '</div>';
		endif;
	}

	static public function crazyblog_header_3( $settings ) {
		$general = $settings;
		$subNav = crazyblog_set( $general, 'subMenuStyle' );
		?>
		<div class="header-wrap">
			<div class="fancy-header stick">
				<?php
				if ( crazyblog_set( $general, 'header_three_topbar' ) ) {
					$social = crazyblog_set( crazyblog_set( $settings, 'crazyblog_social_icons' ), 'crazyblog_social_icons' );
					array_pop( $social );
					?>
					<div class="topbar coloured">
						<div class="container">
							<?php if ( crazyblog_set( $general, 'header_three_topnav' ) ) : ?>
								<?php
								if ( has_nav_menu( 'topbar-menu' ) ) {
									wp_nav_menu( array( 'theme_location' => 'topbar-menu', 'menu_class' => '', 'container' => false ) );
								} else {
									wp_nav_menu( array( 'theme_location' => 'topbar-menu', 'menu_class' => '', 'container' => false ) );
								}
								?>
							<?php endif; ?>
							<?php if ( !empty( $social ) && crazyblog_set( $general, 'header_three_social' ) ) : ?>
								<div class="simple-social-links">
									<?php
									foreach ( $social as $s ) :
										?>
										<a title="" href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>"><i class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i></a>
										<?php
									endforeach;
									?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php
				}
				?>
				<div class="fancy-menu <?php echo esc_attr( $subNav ) ?>">
					<?php
					if ( has_nav_menu( 'left-menu' ) ) {
						wp_nav_menu( array( 'theme_location' => 'left-menu', 'menu_class' => 'menu-links', 'container' => false ) );
					} else {
						wp_nav_menu( array( 'theme_location' => 'left-menu', 'menu_class' => 'menu-links', 'container' => false ) );
					}
					?>
					<div class="fancy-logo">
						<?php echo self::crazyblog_logo() ?>
					</div>
					<?php
					if ( has_nav_menu( 'right-menu' ) ) {
						wp_nav_menu( array( 'theme_location' => 'right-menu', 'menu_class' => 'menu-links', 'container' => false ) );
					} else {
						wp_nav_menu( array( 'theme_location' => 'right-menu', 'menu_class' => 'menu-links', 'container' => false ) );
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}

	static public function crazyblog_header_4( $settings ) {
		$general = $settings;
		$subNav = crazyblog_set( $general, 'subMenuStyle' );
		$bg = (crazyblog_set( $settings, 'header_4_bg' ) != '') ? 'style = background:url(' . crazyblog_set( $settings, 'header_4_bg' ) . ')' : '';
		?>
		<div class="header-wrap">
			<div class="shop-header" <?php echo esc_attr( $bg ) ?>>
				<?php
				if ( crazyblog_set( $general, 'header_4_topbar' ) ) {
					$social = crazyblog_set( crazyblog_set( $settings, 'crazyblog_social_icons' ), 'crazyblog_social_icons' );
					array_pop( $social );
					?>
					<div class="topbar">
						<div class="container">
							<?php if ( crazyblog_set( $general, 'header_4_contact' ) != '' && crazyblog_set( $general, 'header_4_email' ) != '' ): ?>
								<div class="contact-infos">
									<?php if ( crazyblog_set( $general, 'header_4_contact' ) != '' ): ?><span><i class="fa fa-phone"></i> <?php esc_html_e( 'Call Us', 'crazyblog' ) ?>: <?php echo crazyblog_set( $general, 'header_4_contact' ) ?></span><?php endif; ?>
									<?php if ( crazyblog_set( $general, 'header_4_email' ) != '' ): ?><span><i class="fa fa-envelope"></i>  <?php esc_html_e( 'Email', 'crazyblog' ) ?>: <?php echo crazyblog_set( $general, 'header_4_email' ) ?></span><?php endif; ?>
								</div>
							<?php endif; ?>
							<?php if ( !empty( $social ) && crazyblog_set( $general, 'header_4_social' ) ) : ?>
								<div class="simple-social-links">
									<?php
									foreach ( $social as $s ) :
										?>
										<a title="" href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>"><i class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i></a>
										<?php
									endforeach;
									?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php
				}
				?>
				<div class="shop-menu">
					<div class="container">
						<div class="shop-logo">
							<?php echo self::crazyblog_logo() ?>
							<div class="popups">
								<!-- <a href="#" title=""><i class="fa fa-user"></i></a> -->
								<?php if ( class_exists( 'WooCommerce' ) ): ?>
									<a href="<?php echo esc_url( WC()->cart->get_cart_url() ) ?>" title=""><i class="fa fa-shopping-bag"></i> <?php echo esc_html( WC()->cart->get_cart_contents_count() ) ?></a>
								<?php endif; ?>
							</div>
						</div>
						<nav class="<?php echo esc_attr( $subNav ) ?>">
							<?php
							if ( has_nav_menu( 'primary-menu' ) ) {
								wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu-links', 'container' => false ) );
							} else {
								wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu-links', 'container' => false ) );
							}
							?>
							<?php if ( crazyblog_set( $general, 'header_4_search' ) ): ?>
								<button class="form"><i class="fa fa-search"></i></button>
							<?php endif; ?>
						</nav>
						<?php if ( crazyblog_set( $general, 'header_4_search' ) ): ?>
							<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
								<input name="s" type="text" placeholder="<?php esc_html_e( 'Search Here', 'crazyblog' ) ?>" value="<?php echo get_search_query(); ?>" />
								<a href="javascript:void(0)" class="form-close"><i class="fa fa-close"></i></a>
							</form>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	static public function crazyblog_responsive_header( $settings ) {
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-enscroll' ) );
		$general = $settings;
		$social = crazyblog_set( crazyblog_set( $settings, 'crazyblog_social_icons' ), 'crazyblog_social_icons' );
		$position = (crazyblog_set( $settings, 'responsive_position' ) != '') ? crazyblog_set( $settings, 'responsive_position' ) : '';
		?>	
		<div class="responsive-header">
			<?php if ( crazyblog_set( $general, 'responsive_show_ad' ) ) : ?>
				<div class="add">
					<?php if ( crazyblog_set( $general, 'header_ad_type' ) == "crazyblog_own_image" ) : ?>
						<a href="<?php echo esc_url( crazyblog_set( $general, 'ad_image_link' ) ); ?>" title=""><img src="<?php echo esc_url( crazyblog_set( $general, 'upload_ad_image' ) ); ?>" alt="" /></a>
					<?php else: ?>
						<?php echo crazyblog_set( $general, 'crazyblog_google_ad_code' ); ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>        
			<div class="responsivebar">
				<div class="responsive-logo"><?php echo self::crazyblog_logo(); ?></div>
				<div class="responsive-btns">
					<?php if ( crazyblog_set( $general, 'responsive_show_search' ) ) : ?>
						<a class="open-search" href="#" title=""><i class="fa fa-search"></i></a>
					<?php endif; ?>
					<a class="open-menu" href="#" title=""><i class="fa fa-align-justify"></i></a>
				</div><!-- Responsive Buttons -->
				<?php if ( crazyblog_set( $general, 'responsive_show_search' ) ) : ?>
					<div class="responsive-search">
						<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="text" placeholder="<?php esc_html_e( 'Search here', 'crazyblog' ); ?>" name="s"/>
							<button type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
				<?php endif; ?>

				<div class="responsive-menu <?php echo esc_attr( $position ) ?>">
					<span class="close-this"><i class="fa fa-remove"></i></span>
					<div class="responsive-logo"><?php echo self::crazyblog_logo(); ?></div>
					<?php wp_nav_menu( array( 'theme_location' => 'responsive-menu', 'menu_class' => '', 'container' => false ) ); ?>

					<?php
					$counter = 0;
					if ( !empty( $social ) && crazyblog_set( $general, 'responsive_show_social' ) ) :
						?>
						<div class="simple-social">
							<?php
							array_pop( $social );
							foreach ( $social as $s ) :

								if ( crazyblog_set( $general, 'responsive_number_social' ) == $counter )
									break;
								?>
								<a href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>" title=""><i class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i></a>
								<?php
								$counter++;
							endforeach;
							?>
						</div>
					<?php endif; ?>

				</div><!-- Responsive Menu -->
			</div>
			<?php crazyblog_adCode( 'header', 'h', 'add' ); ?>
		</div>

		<?php
	}

	static public function crazyblog_topbar() {
		$settings = crazyblog_opt();
		$topbar = $settings;
		$social = crazyblog_set( crazyblog_set( $settings, 'crazyblog_social_icons' ), 'crazyblog_social_icons' );
		?>
		<div class="topbar">
			<div class="container">
				<?php if ( crazyblog_set( $topbar, 'show_topbar_nav' ) ) : ?>
					<?php
					if ( has_nav_menu( 'topbar-menu' ) ) {
						wp_nav_menu( array( 'theme_location' => 'topbar-menu', 'menu_class' => '', 'container' => false ) );
					} else {
						wp_nav_menu( array( 'theme_location' => 'topbar-menu', 'menu_class' => '', 'container' => false ) );
					}
					?>
				<?php endif; ?>
				<?php
				if ( !empty( $social ) && crazyblog_set( $topbar, 'show_topbar_social' ) ) :
					array_pop( $social );
					?>
					<div class="simple-social-links">
						<?php foreach ( $social as $s ) : ?>
							<a title="" href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>"><i class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div><!-- Topbar -->

		<?php
	}

	static public function crazyblog_logo( $onlyUrl = false ) {
		$settings = crazyblog_opt();
		$general_settings = $settings;

		if ( crazyblog_set( $general_settings, 'logo_type' ) === 'text' ) {
			$LogoStyle = (crazyblog_set( $general_settings, 'logo_font_size' )) ? 'font-size:' . crazyblog_set( $general_settings, 'logo_font_size' ) . 'px;
				' : '';
			$LogoStyle .= (crazyblog_set( $general_settings, 'logo_font_face' )) ? 'font-family:' . crazyblog_set( $general_settings, 'logo_font_face' ) . ';
				' : '';
			$LogoStyle .= (crazyblog_set( $general_settings, 'logo_font_weight' )) ? 'font-weight:' . crazyblog_set( $general_settings, 'logo_font_weight' ) . ';
				' : '';
			$LogoStyle .= (crazyblog_set( $general_settings, 'logo_color' )) ? 'color:' . crazyblog_set( $general_settings, 'logo_color' ) . ';
				' : '';
			$Logo = '<a style = "' . $LogoStyle . '" href = "' . esc_url( home_url( '/' ) ) . '" title = "' . get_bloginfo( 'name' ) . '">' . crazyblog_set( $general_settings, 'logo_heading' ) . '</a>';
		} else {
			$LogoStyle = '';
			$LogoImageStyle = '';
			$LogoImageStyle .= ( crazyblog_set( $general_settings, 'logo_width' ) ) ? ' width:' . crazyblog_set( $general_settings, 'logo_width' ) . 'px;
				' : '';
			$LogoImageStyle .= ( crazyblog_set( $general_settings, 'logo_height' ) ) ? ' height:' . crazyblog_set( $general_settings, 'logo_height' ) . 'px;
				' : '';
			$Logo = '<a href = "' . esc_url( home_url( '/' ) ) . '" title = "' . get_bloginfo( 'name' ) . '"><img src = "' . crazyblog_set( $general_settings, 'logo_image', crazyblog_URI . '/assets/images/logo.png' ) . '" alt = "logo" style = "' . $LogoImageStyle . '" /></a>';
		}

		if ( $onlyUrl == true ) {
			return crazyblog_set( $general_settings, 'logo_image', crazyblog_URI . '/assets/images/logo.png' );
		}
		return $Logo;
	}

}
