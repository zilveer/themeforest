<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

get_header(); ?>
	<?php $header_background_for_blog = ot_get_option( 'header_background_for_blog' ); ?>
	<?php if ( ! empty( $header_background_for_blog ) ) { ?>
	
	<?php $blog_title_on_single_blog_post_pages = ot_get_option( 'blog_title_on_single_blog_post_pages' ); ?>
	<?php if ( empty( $blog_title_on_single_blog_post_pages ) ) { ?>
		<?php $blog_title_on_single_blog_post_pages = __( 'Blog', 'mega' ); ?>
	<?php } ?>
	
	<?php $parallax_header_background_for_blog = ot_get_option( 'parallax_header_background_for_blog' ); ?>
	<div class="entry-header-wrapper" style="background-image: url(<?php echo esc_attr( $header_background_for_blog ); ?>);" <?php if ( ! empty( $parallax_header_background_for_blog ) ) { ?>data-600-top="background-position:50% 75%;" data--600-top="background-position:50% 25%;" data-smooth-scrolling="on"<?php } ?>>
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php echo $blog_title_on_single_blog_post_pages; ?></h1>
		</header><!-- .entry-header -->
	</div>
	<?php } else { ?>
		
	<?php } ?>

	<div id="main" class="clearfix">

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<?php if ( 'portfolio' == get_post_type() ) : ?>
					<?php get_template_part( 'single-portfolio' ); ?>
				<?php else : ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endif; // End if ( 'portfolio' == get_post_type() ) ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php $remove_sidebar_and_center_posts = ot_get_option( 'remove_sidebar_and_center_posts' ); ?>
<?php if ( empty( $remove_sidebar_and_center_posts ) ) { ?>
<?php get_sidebar(); ?>
<?php } ?>
<?php get_footer(); ?>