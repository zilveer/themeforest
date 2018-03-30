<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php
		wp_head();
		$settings = crazyblog_opt();
		$theme_setting = $settings;
		?>
		<script type='application/ld+json'>{"@context":"http:\/\/schema.org","@type":"WebSite","url":"http:\/\/<?php echo home_url( '/' ); ?>\/crazyblog\/","name":"crazyblog","potentialAction":{"@type":"SearchAction","target":"http:\/\/<?php echo home_url( '/' ); ?>\/crazyblog\/?s={search_term}","query-input":"required name=search_term"}}</script>
    </head>
	<?php
	if ( crazyblog_set( $settings, 'custom_header' ) == 'header_5' ):
		$isCenter = (crazyblog_set( $settings, 'h_5_logo_type' ) == 'center' ) ? 'center-logo' : '';
		$theme = (crazyblog_set( $settings, 'h_5_style' ) == 'style2' ) ? 'style2' : '';
		$mPos = (crazyblog_set( $settings, 'h_5_menu_pos' ) == 'center' ) ? 'center' : '';
		$bg = (crazyblog_set( $settings, 'header_5_bg' ) != '' ) ? crazyblog_set( $settings, 'header_5_bg' ) : '';
		$social = crazyblog_set( crazyblog_set( $settings, 'crazyblog_social_icons' ), 'crazyblog_social_icons' );
		array_pop( $social );
		?>
		<body <?php body_class(); ?> itemscope>
			<div class="add-bar <?php echo esc_attr( $isCenter ) ?>" style="background:url(<?php echo esc_url( $bg ) ?>)">
				<div class="container">
					<div class="logo"><?php echo crazyblog_Header::crazyblog_logo(); ?></div>
					<?php if ( crazyblog_set( $settings, 'h_5_logo_type' ) == 'left' ): ?>
						<div class="add">
							<?php if ( crazyblog_set( $settings, 'header_5_ad_type' ) == "crazyblog_own_image" ) : ?>
								<a href="<?php echo esc_url( crazyblog_set( $settings, 'ad_5_image_link' ) ); ?>" title=""><img src="<?php echo esc_url( crazyblog_set( $settings, 'upload_5_ad_image' ) ); ?>" alt="" /></a>
							<?php else: ?>
								<?php echo crazyblog_set( $general, 'crazyblog_5_google_ad_code' ); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="theme-layout <?php echo esc_attr( (crazyblog_set( $theme_setting, 'boxed_layout_status' )) ? "boxed" : ''  ) ?>">
				<div class="header-wrap">
					<div class="bar-header <?php echo esc_attr( $theme . ' ' . $mPos ) ?>">
						<nav>
							<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu-links', 'container' => false ) ); ?>
							<?php if ( !empty( $social ) && count( $social ) > 0 && crazyblog_set( $settings, 'header_five_social' ) == '1' ) : ?>
								<div class="simple-social">	
									<?php foreach ( $social as $s ) : ?>
										<a title="" href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>"><i class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i></a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<?php if ( crazyblog_set( $settings, 'header_five_search' ) == '1' ): ?>
								<form method="get" class="header-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<input type="text" placeholder="<?php esc_html_e( 'Search', 'crazyblog' ); ?>" name="s" />
									<button type="submit"><i class="fa fa-search"></i></button>
								</form>
							</nav>
						</div>
					<?php endif; ?>
				</div>

				<?php
				(new crazyblog_Header )->crazyblog_responsive_header( $settings );
			else:
				?>
				<body <?php body_class(); ?> itemscope>
					<div class="theme-layout <?php echo esc_attr( (crazyblog_set( $theme_setting, 'boxed_layout_status' )) ? "boxed" : ''  ) ?>">
						<?php do_action( 'crazyblog_custom_header' ); ?>
					<?php endif; ?>