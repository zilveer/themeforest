<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */

get_header(); ?>

<div id="content" class="container" role="main">

	<article id="post-0" class="post error404 no-results not-found">
		<header class="entry-header bb-1px">
			<h1 class="archive-title"><?php _e( 'Not found', 'color-theme-framework' ); ?></h1>
			<div class="page-border"></div>
		</header>

		<div class="entry-content">
			<h3><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'color-theme-framework' ); ?></h3>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'color-theme-framework' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->

</div><!-- #content -->

<?php get_footer(); ?>