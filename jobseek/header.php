<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<meta name="viewport" content="initial-scale=1">
	<meta name="viewport" content="width=device-width" />

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<header id="header">
	<div class="container">
		<div id="logo">
			<a href="<?php echo home_url(); ?>">
				<?php $site_logo_id = get_theme_mod( 'site_logo', '' );
				if ( empty( $site_logo_id ) ) { ?>
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="">
				<?php } else {
					$site_logo_meta = wp_get_attachment_metadata( $site_logo_id );
					$site_logo_url = wp_get_attachment_image_src( $site_logo_id, 'full' ); ?>
					<img src="<?php echo $site_logo_url[0]; ?>" alt="<?php echo esc_url( $site_logo_meta['image_meta']['title'] ); ?>">
				<?php } ?>
			</a>
		</div>
		<nav>
			<ul id="main-nav"><?php	wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '%3$s', 'container' => false, 'depth' => 3, 'fallback_cb' => 'jobseek_menu_fallback' ) ); ?></ul>
		</nav>
	</div>
</header>