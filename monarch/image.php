<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */

get_header(); ?>

<?php get_template_part( 'header-panel' ); ?>

<!-- Content -->
<div class="content with-sb clearfix">

	<!-- Main -->
	<main class="main col-xs-12 col-sm-12 col-md-12 col-lg-7 col-bg-6" role="main">

		<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
		?>

		<!-- Post Wrapper -->
		<div class="post-wrap">

			<div class="timeline"></div>

			<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'ShowOnScroll' ) ); ?> >

				<span class="post-date"><?php monarch_post_date(); ?></span>

				<header class="post-header <?php if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) : ?>without-post-thumbnail<?php endif; ?>">
					<div class="titles">
						<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
					</div>
				</header>

				<div class="post-content clearfix">

					<div class="post-attachment">
						<?php
							/**
							 * Filter the default monarch image attachment size.
							 *
							 * @since Monarch 1.0
							 *
							 * @param string $image_size Image size. Default 'large'.
							 */
							$image_size = apply_filters( 'monarch_attachment_size', 'large' );
							
							echo wp_get_attachment_image( get_the_ID(), $image_size );
							?>
						<?php if ( has_excerpt() ) : ?>

						<div class="entry-caption">
							<?php the_excerpt(); ?>
						</div>
						<!-- .entry-caption -->

						<?php endif; ?>
					</div>
					<!-- .entry-attachment -->

					<?php
						the_content();
						wp_link_pages_monarch();
					?>

					<nav id="image-navigation" class="navigation image-navigation">
						<div class="nav-links">
							<div class="nav-previous"><?php previous_image_link( false, esc_html__( 'Previous Image', 'monarch' ) ); ?></div>
							<div class="nav-next"><?php next_image_link( false, esc_html__( 'Next Image', 'monarch' ) ); ?></div>
						</div>
					</nav>
					<!-- .image-navigation -->

				</div>

				<footer class="post-footer">
					<ul>
						<li class="author"><?php the_author_posts_link(); ?></li>
						<?php monarch_attachments() ?>
						<?php monarch_post_format_footer(); ?>
						<li class="share"><a href="#" data-toggle="modal" data-target="#modal-like-<?php the_ID(); ?>"><?php esc_html_e('Share', 'monarch'); ?></a></li>
						<li class="comments pull-right"><?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { comments_popup_link( esc_html__( '0', 'monarch' ), esc_html__( '1', 'monarch' ), esc_html__( '%', 'monarch' ) ); } ?></li>
					</ul>
				</footer>

			</article>
			
		</div>
		<!-- #post-## -->

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			
			// Previous/next post navigation.
			the_post_navigation( array(
				'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'monarch' ),
			) );
			
			// End the loop.
			endwhile;
		?>

		<!-- Modal Post Like -->
		<div class="modal modal-vcenter fade modal-like" id="modal-like-<?php the_ID(); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<div class="shareinit" data-url="<?php the_permalink() ?>" data-title="<?php the_title() ?>"></div>
					</div>
				</div>
			</div>
		</div>
		
	</main>

	<!-- Sidebar one and two -->
	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>