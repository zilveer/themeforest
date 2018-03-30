<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

get_header(); ?>
	<?php $header_background_for_blog = ot_get_option( 'header_background_for_blog' ); ?>
	<?php if ( ! empty( $header_background_for_blog ) ) { ?>
	<?php $parallax_header_background_for_blog = ot_get_option( 'parallax_header_background_for_blog' ); ?>
	<div class="entry-header-wrapper" style="background-image: url(<?php echo esc_url( $header_background_for_blog ); ?>);" <?php if ( ! empty( $parallax_header_background_for_blog ) ) { ?>data-600-top="background-position:50% 75%;" data--600-top="background-position:50% 25%;" data-smooth-scrolling="on"<?php } ?>>
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php printf( __( 'Author Archives: %s', 'mega' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></h1>
		</header><!-- .entry-header -->
	</div>
	<?php } else { ?>
		<div class="entry-header-wrapper">
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php printf( __( 'Author Archives: %s', 'mega' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></h1>
		</header><!-- .entry-header -->
	</div>
	<?php } ?>	
	<div id="main" class="clearfix">

		<section id="primary">
			<div id="content" role="main">
			
				<?php if ( have_posts() ) : ?>

					<?php
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						 *
						 * We reset this later so we can run the loop
						 * properly with a call to rewind_posts().
						 */
						the_post();
					?>

					<?php
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();
					?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to overload this in a child theme then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php mega_pagination_content_nav( 'nav-pagination' ); ?>

				<?php else : ?>

					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Nothing Found', 'mega' ); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<p><?php _e( 'Apologies, but no results were found for the requested archive.', 'mega' ); ?></p>
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

				<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>