<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> <?php thb_html_class(); ?>>
	<head>
		<?php thb_head_meta(); ?>
		
		<title><?php thb_title(); ?></title>
		
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<?php thb_body_start(); ?>

		<div id="page">

			<?php thb_header_before(); ?>

			<header id="header">
				<?php thb_header_start(); ?>

				<h1 id="logo">
					<?php 
						$logo = thb_get_option('main_logo');
					?>
					<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php if( isset($logo['id']) && $logo['id'] != '' ) : ?>
							<img src="<?php echo thb_image_get_size($logo['id'], 'full'); ?>" alt="">
						<?php else : ?>
							<?php bloginfo( 'name' ); ?>
						<?php endif; ?>
					</a>
				</h1>

				<span id="mobile-nav-trigger">m</span>

				<?php thb_nav_before(); ?>
				<nav id="main-nav" class="primary">
					<?php thb_nav_start(); ?>

					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				
					<?php thb_nav_end(); ?>
				</nav>
				<?php thb_nav_after(); ?>

				<?php thb_header_end(); ?>
			</header>

			<nav id="mobile-nav" class="primary menu mobile">
				<?php wp_nav_menu( array( 'container' => '', 'container_class' => '', 'theme_location' => 'mobile' ) ); ?>
			</nav><!-- /#main-nav -->
			
			<?php thb_header_after(); ?>	

			<?php thb_content_before(); ?>

			<section id="content">
				
				<?php thb_content_start(); ?>