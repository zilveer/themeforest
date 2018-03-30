<?php
/**
 * Template Name: Layout: Full Width (Boxless)
 *
 * @package Listify
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div <?php echo apply_filters( 'listify_cover', 'page-cover', array( 'size' => 'full' ) ); ?>>
			<h1 class="page-title cover-wrapper"><?php the_title(); ?></h1>
		</div>

		<?php do_action( 'listify_page_before' ); ?>

		<div id="primary" class="container">
			<div class="content-area">

				<main id="main" class="site-main" role="main">

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</article>

					<?php comments_template(); ?>

				</main>

			</div>
		</div>

	<?php endwhile; ?>

<?php get_footer(); ?>
