<?php
/**
 * The template for displaying Search Results pages.
 *
 */

get_header(); ?>

<div class="blog_header_wrap">

	<div class="row">

		<div class="large-12 columns">

			<header class="page-header blog_header_content">

				<h1 class="page-title">
					<?php printf( __( 'Search Results for: %s', 'heartfelt' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>

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

					<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );
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

</div><!-- .row -->

<?php get_footer(); ?>