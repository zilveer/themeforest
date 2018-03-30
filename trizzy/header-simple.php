<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Trizzy
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo ot_get_option('pp_favicon_upload', get_template_directory_uri().'/images/favicon.ico')?>" />

	<?php wp_head(); ?>
</head>

<body <?php $style = get_theme_mod( 'trizzy_layout_style', 'boxed' ); body_class($style); ?>>
	<div id="wrapper">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'trizzy' ); ?></a>


	<!-- Top Bar
	================================================== -->
	<div id="top-bar">
		<div class="container">

			<!-- Top Bar Menu -->
			<div class="ten columns">
				<ul class="top-bar-menu">
					<?php
					if(ot_get_option( 'pp_contact_details') == 'on') {
						$email = ot_get_option( 'pp_cdetails_email');
						$phone = ot_get_option( 'pp_cdetails_phone');
						if($phone) { ?><li><i class="fa fa-phone"></i><?php echo $phone;?></li><?php }
						if($email) { ?><li><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_attr($email) ;?>"><?php echo $email;?></a></li><?php }
					} ?>

				</ul>
			</div>

			<!-- Social Icons -->
			<div class="six columns">
				<?php /* get the slider array */
				$headericons = ot_get_option( 'pp_headericons', array() );
				if ( !empty( $headericons ) ) {
					echo '<ul class="social-icons">';
					foreach( $headericons as $icon ) {
						echo '<li><a class="' . $icon['icons_service'] . '" title="' . esc_attr($icon['title']) . '" href="' . esc_url($icon['icons_url']) . '"><i class="icon-' . $icon['icons_service'] . '"></i></a></li>';
					}
					echo '</ul>';
				}
				?>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>



<!-- Header
	================================================== -->
<div class="container">
	<?php
	$logo_area_width = ot_get_option('pp_logo_area_width',4);
	$menu_area_width = 16 - $logo_area_width;
	?>
	<!-- Logo -->
	<div class="sixteen columns">
		<div id="logo" class="simple-home-logo" style="margin-bottom: 22px;">
		<?php
			$logo = ot_get_option( 'pp_logo_upload' );
			if($logo) {
				if(is_front_page()){ ?>
					<h1><a class="current homepage" id="current" href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php echo $logo; ?>" alt="<?php esc_attr(bloginfo('name')); ?>"/></a></h1>
				<?php } else { ?>
					<h2><a class="current homepage" id="current" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo $logo; ?>" alt="<?php esc_attr(bloginfo('name')); ?>"/></a></h2>
			<?php }
			} else {
				if(is_front_page()) { ?>
					<h1><a class="current homepage" id="current" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		  <?php } else { ?>
					<h2><a class="current homepage" id="current" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
		  <?php }
			}
		?>
		<?php if(get_theme_mod('trizzy_tagline_switch','hide') == 'show') { ?><div id="tagline"><?php bloginfo( 'description' ); ?></div><?php } ?>
	    <div class="clearfix"></div>
		</div>
	</div>


</div>


	<!-- Navigation
	================================================== -->
	<div class="container">
		<div class="sixteen columns">

			<a href="#menu" class="menu-trigger"><i class="fa fa-bars"></i> Menu</a>

			<nav id="navigation" class="<?php echo get_theme_mod( 'trizzy_menu_style', 'dark' ); ?>">
				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'container' => false,
					'menu_id' => 'responsive',
					'fallback_cb' => 'trizzy_fallback_menu',
					'walker' => new trizzy_megamenu_walker
				));
				?>

			</nav>
		</div>
	</div>
