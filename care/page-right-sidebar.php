<?php
/**
 * Template Name: Content / Right Sidebar
 */
?>

<?php get_header(); ?>

		<div id="container" class="row-inner">
			<div id="content" class="float-left">

				<?php the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

					<div class="entry-content clearfix">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'care' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php if (ot_get_option('page_comments') != 'off') {
					comments_template( '', true );
				} ?>

			</div><!-- #content -->
			
			<div id="sidebar" class="float-right">
				<?php get_sidebar(); ?>
			</div>
		</div><!-- #container -->
		
<?php get_footer(); ?>