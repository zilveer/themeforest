<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */

get_header();
?>

<?php get_template_part('page-parts/general-before-wrap'); ?>

<?php get_template_part( 'page-parts/page-title' ); ?>

	<div class="main-content <?php echo Kleo::get_config('container_class'); ?>">

		<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="entry-content">
					<div class="entry-attachment">
						<div class="attachment">
							<?php kleo_the_attached_image(); ?>
						</div><!-- .attachment -->

						<?php if ( has_excerpt() ) : ?>
						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div><!-- .entry-caption -->
						<?php endif; ?>
					</div><!-- .entry-attachment -->

					<?php
						the_content();
						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'buddyapp' ), 'after' => '</div>' ) );
					?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

			<nav id="image-navigation" class="navigation image-navigation">
				<div class="nav-links">
				<?php previous_image_link( false, '<div class="previous-image">' . esc_html__( 'Previous Image', 'buddyapp' ) . '</div>' ); ?>
				<?php next_image_link( false, '<div class="next-image">' . esc_html__( 'Next Image', 'buddyapp' ) . '</div>' ); ?>
				</div><!-- .nav-links -->
			</nav><!-- #image-navigation -->

			<?php comments_template(); ?>

		<?php endwhile; // end of the loop. ?>

	</div>

<?php get_template_part('page-parts/general-after-wrap'); ?>

<?php
get_footer();