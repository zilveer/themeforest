<?php
/**
 * Template Name: Page: Widgetized
 *
 * @package Listify
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div <?php echo apply_filters( 'listify_cover', 'page-cover', array( 'size' => 'full' ) ); ?>>
			<h1 class="page-title cover-wrapper"><?php the_title(); ?></h1>
		</div>

		<?php do_action( 'listify_page_before' ); ?>
			
		<?php if ( '' != get_the_content() ) : ?>

		<div id="primary" class="container">
			<div class="row content-area">
				<main id="main" class="site-main" role="main">

					<?php if ( listify_has_integration( 'woocommerce' ) ) : ?>
						<?php wc_print_notices(); ?>
					<?php endif; ?>

					<?php get_template_part( 'content', 'page' ); ?>

				</main>
			</div>
		</div>

		<?php endif; ?>

		<div class="container">
			<?php dynamic_sidebar( 'widget-area-page-' . get_the_ID() ); ?>
		</div>

	<?php endwhile; ?>

<?php get_footer(); ?>
