<?php // Logo & Hgroup Sidebar

	$logo_position = handy_get_option('site_logo_position');
	switch ($logo_position) {
		case 'left':
			$logo_class = ' col-lg-3 col-md-3 col-sm-12';
			$sidebar_class = ' col-lg-9 col-md-12 col-sm-12';
		break;
		case 'center':
			$logo_class = ' col-lg-4 col-md-4 col-sm-12 col-md-offset-4 col-lg-offset-4 center-pos';
			$sidebar_class = ' col-lg-12 col-md-12 col-sm-12 center-pos';
		break;
		case 'right':
			$logo_class = ' col-md-3 col-lg-3 col-sm-12 col-lg-push-9 col-md-push-9 right-pos';
			$sidebar_class = ' col-lg-9 col-md-12 col-sm-12 col-lg-pull-3 right-pos';
		break;
		default:
			$logo_class = ' col-md-3 col-sm-12';
			$sidebar_class = ' col-md-9 col-sm-12';
	}; ?>

	<?php /* Check if logo img exists */
		$img_url = handy_get_option('site_logo');
		if ( $img_url && $img_url !='' ) {
			$upload_dir = wp_upload_dir();
			$upload_basedir = $upload_dir['basedir'];
			$upload_subdir = substr( strstr($img_url, 'uploads'), 7 );
			$img_file = $upload_basedir . $upload_subdir;
		}
		$custom_logo_id = get_theme_mod( 'custom_logo' ); ?>

	<?php if ( handy_get_option('site_logo') && file_exists( $img_file ) ) { ?>
		<div class="site-logo<?php echo esc_attr($logo_class);?>" itemscope itemtype="http://schema.org/Organization">
			<?php if ( !is_front_page() ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php esc_attr( bloginfo( 'name' ) );?>" itemprop="url">
					<img src="<?php echo esc_url(handy_get_option('site_logo')) ?>" alt="<?php esc_html( bloginfo( 'description' ) ); ?>" itemprop="logo" />
				</a>
			<?php else : ?>
				<img src="<?php echo esc_url(handy_get_option('site_logo')) ?>" alt="<?php esc_html( bloginfo( 'description' ) ); ?>" title="<?php esc_attr( bloginfo( 'name' ) ); ?>" itemprop="logo" />
				<meta name="url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php endif; ?>
		</div>
	<?php } elseif ($custom_logo_id && $custom_logo_id!='') {
		$logo_image = wp_get_attachment_image( $custom_logo_id , 'full', array('itemprop' => 'logo' ) ); ?>
		<div class="site-logo<?php echo esc_attr($logo_class);?>" itemscope itemtype="http://schema.org/Organization">
			<?php if ( !is_front_page() ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php esc_attr( bloginfo( 'name' ) );?>" itemprop="url">
					<?php echo $logo_image; ?>
				</a>
			<?php else : ?>
				<?php echo $logo_image; ?>
				<meta name="url" content="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php endif; ?>
		</div>
	<?php } else { ?>
		<div class="header-group<?php echo esc_attr($logo_class);?>">
			<h1 class="site-title" itemprop="headline">
				<?php if ( !is_front_page() ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home" itemprop="url">
						<?php esc_attr( bloginfo( 'name' ) ); ?>
					</a>
				<?php else : esc_attr( bloginfo( 'name' ) ); endif; ?>
			</h1>
			<h2 class="site-description" itemprop="description"><?php esc_html( bloginfo( 'description' ) ); ?></h2>
		</div>
	<?php } ?>

	<?php if ( is_active_sidebar( 'hgroup-sidebar' ) ) : ?>
	    <div class="hgroup-sidebar<?php echo esc_attr($sidebar_class);?>">
	        <?php dynamic_sidebar( 'hgroup-sidebar' ); ?>
	    </div>
	<?php endif; ?>
