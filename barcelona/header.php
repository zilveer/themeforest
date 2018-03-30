<?php

$barcelona_options = barcelona_get_options( array(
	'show_top_bar_menu',
	'show_header_social_icons',
	'header_style',
	'header_cover_image'
) );

if ( ! has_nav_menu( 'top' ) ) {
	$barcelona_options['show_top_bar_menu'] = 'off';
}

$barcelona_social_icons = barcelona_social_icons();
if ( empty( $barcelona_social_icons ) ) {
	$barcelona_options['show_header_social_icons'] = 'off';
}

$barcelona_fb_app_id = barcelona_get_option( 'facebook_app_id' );

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="user-scalable=yes, width=device-width, initial-scale=1.0, maximum-scale=1">

	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->

	<link rel="pingback" href="<?php echo esc_url( get_bloginfo('pingback_url') ); ?>">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php if ( barcelona_get_option( 'add_facebook_sdk' ) == 'on' ) { ?>
<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function(){
		FB.init({
			<?php if ( is_numeric( $barcelona_fb_app_id ) ): ?>
			appId: '<?php echo intval( $barcelona_fb_app_id ); ?>',
			<?php endif; ?>
			status: true,
			xfbml: true,
			version: 'v2.3'
		});
	};

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/<?php echo barcelona_get_locale(); ?>/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
<?php } ?>

<nav class="<?php echo esc_attr( barcelona_nav_class() ); ?>">

	<div class="navbar-inner">

		<div class="container">

			<?php if ( in_array( 'on', $barcelona_options ) ): ?>
			<div class="navbar-top clearfix">

				<div class="navbar-top-left clearfix">
					<?php
					if ( $barcelona_options['show_top_bar_menu'] == 'on' ) {

						wp_nav_menu( array(
							'theme_location' => 'top',
							'container' => false,
							'menu_class' => 'navbar-top-menu'
						) );

					}
					?>
				</div>

				<div class="navbar-top-right">
					<?php
						if ( barcelona_get_option( 'show_header_social_icons' ) == 'on' ) {
							echo $barcelona_social_icons;
						}
					?>
				</div>

			</div><!-- .navbar-top -->
			<?php endif; ?>

			<div class="navbar-header">

				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
					<span class="sr-only">Menu</span>
					<span class="fa fa-navicon"></span>
				</button><!-- .navbar-toggle -->

				<?php if ( barcelona_get_option( 'show_search_button' ) == 'on' ): ?>
				<button type="button" class="navbar-search btn-search">
					<span class="fa fa-search"></span>
				</button>
				<?php endif; ?>

				<?php barcelona_header_ad(); ?>

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-logo">
					<?php barcelona_logo(); ?>
				</a>

				<?php if ( $barcelona_options['header_style'] == 'c' && ! empty( $barcelona_options['header_cover_image'] ) ): ?>
				<div class="header-cover-image">
					<img src="<?php echo $barcelona_options['header_cover_image']; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
				</div>
				<?php endif; ?>

			</div><!-- .navbar-header -->

			<?php if ( has_nav_menu( 'main' ) ): ?>
			<div id="navbar" class="navbar-collapse collapse">
			<?php

				wp_nav_menu( array(
					'theme_location' => 'main',
					'container'      => false,
					'menu_class'     => 'navbar-nav nav',
					'walker'         => new barcelona_megamenu_walker
				) );

			?>
			</div><!-- .navbar-collapse -->
			<?php endif; ?>

		</div><!-- .container -->

	</div><!-- .navbar-inner -->

</nav><!-- .navbar -->

<div id="page-wrapper">