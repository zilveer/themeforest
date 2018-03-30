<?php
/**
 * Template Name: Page with Header
 * Description: A Page Template that adds a header to pages
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

get_header(); ?>

	<div id="main" class="clearfix">

		<div id="primary">
			<div id="content" role="main">
			
				<?php $background_overlay_color_for_heading = ot_get_option( 'background_overlay_color_for_heading' ); ?>
				<?php if ( empty( $background_overlay_color_for_heading ) ) { ?>
					<?php $background_overlay_color_for_heading = '#ffffff'; ?>
				<?php } ?>
				
				<?php $background_overlay_opacity_for_heading = ot_get_option( 'background_overlay_opacity_for_heading' ); ?>
				<?php if ( empty( $background_overlay_opacity_for_heading ) ) { ?>
					<?php $background_overlay_opacity_for_heading = '.1'; ?>
				<?php } ?>
				<?php $rgb = mega_hex2rgb( $background_overlay_color_for_heading ); ?>
				<?php $rgba = "rgba(" . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ", " . $background_overlay_opacity_for_heading . ")"; ?>
				
				<?php $color_for_heading = ot_get_option( 'color_for_heading' ); ?>
				<?php if ( empty( $color_for_heading ) ) { ?>
					<?php $color_for_heading = '#111111'; ?>
				<?php } ?>
				
				<div class="entry-header-wrapper" <?php if ( $background_overlay_color_for_heading != '#ffffff' || $background_overlay_opacity_for_heading != '.1' ) { ?>style="<?php if ( $background_overlay_color_for_heading != '#ffffff' ) { ?>background: <?php echo esc_attr( $background_overlay_color_for_heading ); ?>;<?php } ?> <?php if ( $background_overlay_opacity_for_heading != '.1' ) { ?>background: <?php echo esc_attr( $rgba ); ?>;<?php } ?>"<?php } ?>>
					<header class="entry-header clearfix">
						<h1 class="entry-title" <?php if ( $color_for_heading != '#111111' ) { ?>style="color: <?php echo esc_attr( $color_for_heading ); ?>";<?php } ?>><?php echo the_title();?></h1>
					</header><!-- .entry-header -->
				</div>
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>