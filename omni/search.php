<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package omni
 */

$page_sidebar = cs_get_customize_option( 'archive_sidebar' );

if ( isset( $page_sidebar ) && ( 'left' === $page_sidebar ) ) {
	$sidebar_class = 'pull-right';
} else {
	$sidebar_class = '';
}

get_header(); ?>

<section class="blog-section">
	<div class="container">
		<div class="row">
			<?php if ( isset( $page_sidebar ) && ( 'none' === $page_sidebar ) ) { ?>
			<div class=" col-md-12 col-sm-12 col-xs-12">
				<?php } else { ?>
				<div class=" col-md-8 col-sm-8 col-xs-12 <?php echo esc_attr( $sidebar_class ); ?>">
					<?php } ?>
					<?php if ( have_posts() ) : ?>

						<header class="page-header">
							<h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'omni' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
						</header><!-- .page-header -->

						<?php get_search_form(); ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */

							get_template_part( 'post-formats/format', 'search' );
							?>

						<?php endwhile; ?>

						<?php crum_posts_navigation(); ?>

					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>

				</div>
				<!-- end content -->

				<?php if ( 'none' !== $page_sidebar ) { get_sidebar(); } ?>

			</div>
			<!-- end row -->
		</div>
		<!-- end container -->
</section><!-- end blog-section -->

<?php get_footer(); ?>

<?php get_footer(); ?>
