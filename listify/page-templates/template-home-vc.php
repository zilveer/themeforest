<?php
/**
 * Template Name: Page: Home (Visual Composer)
 *
 * @package Listify
 */

if ( ! listify_has_integration( 'wp-job-manager' ) ) {
	return locate_template( array( 'page.php' ), true );
}

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php $style = get_post()->hero_style; ?>

		<?php if ( 'none' !== $style ) : ?>

			<?php if ( in_array( $style, array( 'image', 'video' ) ) ) : ?>

			<div <?php echo apply_filters( 'listify_cover', 'homepage-cover page-cover entry-cover entry-cover--home entry-cover--' . get_theme_mod( 'home-hero-overlay-style', 'gradient' ), array( 'size' => 'full' ) ); ?>>
				<div class="cover-wrapper container">
					<?php
						the_widget(
							'Listify_Widget_Search_Listings',
							array(
								'title' => get_the_title(),
								'description' => strip_shortcodes( get_the_content() )
							),
							array(
								'before_widget' => '<div class="listify_widget_search_listings">',
								'after_widget'  => '</div>',
								'before_title'  => '<div class="home-widget-section-title"><h3 class="home-widget-title">',
								'after_title'   => '</h3></div>',
								'widget_id'     => 'search-12391'
							)
						);
					?>
				</div>

				<?php
					if ( 'video' == $style ) :
						add_filter( 'wp_video_shortcode_library', '__return_false' );
				?>
					<?php the_content(); ?>
				<?php
						remove_filter( 'wp_video_shortcode_library', '__return_false' );
					endif;
				?>
			</div>

			<?php else : ?>

				<div class="homepage-cover has-map">
					<?php
						do_action( 'listify_output_map' );

						if ( ! is_active_widget( false, false, 'listify_widget_map_listings', true ) ) {
							do_action( 'listify_output_results' );
						}
					?>
				</div>

			<?php endif; ?>

		<?php endif; ?>

		<?php if ( listify_has_integration( 'woocommerce' ) ) : ?>
			<?php wc_print_notices(); ?>
		<?php endif; ?>

		<?php the_content(); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>
