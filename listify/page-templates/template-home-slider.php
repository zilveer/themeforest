<?php
/**
 * Template Name: Page: Home (Slider)
 *
 * @package Listify
 */

if ( ! listify_has_integration( 'wp-job-manager' ) ) {
	return locate_template( array( 'page.php' ), true );
}

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php the_content(); ?>

		<?php do_action( 'listify_page_before' ); ?>

		<div class="container">

			<?php if ( listify_has_integration( 'woocommerce' ) ) : ?>
				<?php wc_print_notices(); ?>
			<?php endif; ?>

			<?php dynamic_sidebar( 'widget-area-page-' . get_the_ID() ); ?>

		</div>

	<?php endwhile; ?>

<?php get_footer(); ?>
