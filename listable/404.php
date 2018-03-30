<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Listable
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<article>
			<header class="entry-header">
				<div class="entry-featured"></div>
				<div class="header-content">
					<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'listable' ); ?></h1>
				</div>
			</header><!-- .entry-header -->

			<div class="entry-content" id="entry-content-anchor">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'listable' ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .entry-content -->

		</article><!-- #post-## -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
