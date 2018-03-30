<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */

get_header(); ?>

	<div id="main" class="clearfix">

	<div id="primary">
		<div id="content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( '404', 'mega' ); ?></h1>
				</header>

				<div class="entry-content">
					<h2><?php _e( 'Sorry, the page you were looking for doesn&rsquo;t exist.', 'mega' ); ?></h2>
					
					<p>
					<?php _e( 'Let us take you', 'mega' ); ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" id="back">
							<?php _e( 'home', 'mega' ); ?>
						</a>
					</p>

				<?php
				/*
				 * Print the logo.
				 */
				$logo = ot_get_option( 'logo' );
				?>
				
				<?php if ( ! empty( $logo ) ) : ?>
				<?php //$logo_id = $wpdb->get_var( $wpdb->prepare("SELECT DISTINCT ID FROM $wpdb->posts WHERE guid='$logo'") ); ?>
				<?php //$logo_attributes = wp_get_attachment_image_src( $logo_id, 'full' ); ?>
					<h1 id="site-title" class="clearfix">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" id="custom-logo">
							<img src="<?php echo $logo; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
						</a>
					</h1>
				<?php else : ?>
					<h1 id="site-title" class="clearfix">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
				<?php endif; ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->