<?php
/**
 * The template for displaying Archive pages.
 *
 */

get_header(); ?>

<div class="blog_header_wrap">

<?php if ( have_posts() ) : ?>

<div class="row">

	<div class="large-12 columns">

		<header class="page-header blog_header_content">

			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<p class="taxonomy-description">', '</p>' );
			?>
				
		</header><!-- .page-header .blog_header_content -->	

	</div><!-- large-12 -->

</div><!-- .row -->

</div><!-- .blog_header_wrap -->

<div class="row content_row">

	<div class="large-9 columns">

		<div id="page" class="hfeed site">

			<div id="content" class="site-content">

				<div id="primary" class="content-area">

					<main id="main" class="site-main" role="main">

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );
						?>

					<?php endwhile; ?>

						<?php heartfelt_paging_nav(); ?>

					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>

					</main><!-- #main .site-main -->

				</div><!-- #primary .content-area -->

			</div><!-- #content .site-content -->

		</div><!-- #page -->

	</div><!-- .large-9 -->

<?php get_sidebar(); ?>

</div><!-- .row .content_row -->

<?php get_footer(); ?>
