<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

get_header(); ?>
	<?php $header_background_for_blog = ot_get_option( 'header_background_for_blog' ); ?>
	<?php if ( ! empty( $header_background_for_blog ) ) { ?>
	<?php $parallax_header_background_for_blog = ot_get_option( 'parallax_header_background_for_blog' ); ?>
	<div class="entry-header-wrapper" style="background-image: url(<?php echo esc_attr( $header_background_for_blog ); ?>);" <?php if ( ! empty( $parallax_header_background_for_blog ) ) { ?>data-600-top="background-position:50% 75%;" data--600-top="background-position:50% 25%;" data-smooth-scrolling="on"<?php } ?>>
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'mega' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header><!-- .entry-header -->
	</div>
	<?php } else { ?>
		<div class="entry-header-wrapper">
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'mega' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header><!-- .entry-header -->
	</div>
	<?php } ?>
	
	<div id="main" class="clearfix">

		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>
			
				<div id="hentry-wrapper">

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'search' ); ?>

					<?php endwhile; ?>
				
				</div><!-- #hentry-wrapper -->

				<?php mega_content_nav( 'nav-pagination-single' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">

					<div class="entry-content">
						<p><?php _e( 'Sorry, no posts matched your criteria. Please make sure all words are spelled correctly or try different keywords.', 'mega' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php $remove_sidebar_and_center_posts = ot_get_option( 'remove_sidebar_and_center_posts' ); ?>
<?php if ( empty( $remove_sidebar_and_center_posts ) ) { ?>
	<?php if ( have_posts() ) { ?>
	<?php get_sidebar(); ?>
	<?php } ?>
<?php } ?>
<?php get_footer(); ?>