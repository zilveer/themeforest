<?php
/**
 * The template for displaying image attachments
 */

// Retrieve attachment metadata.
$metadata = wp_get_attachment_metadata();

get_header(); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

		<div class="single-meta">

			<span class="single-date"><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>

			<span class="full-size-link"><a class="flow-fa fa-search-plus" href="<?php echo wp_get_attachment_url(); ?>"><?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?></a></span>

			<?php $post_title = get_the_title( $post->post_parent ); ?>
			<?php if ( ! empty( $post_title ) && 0 != $post->post_parent ) { ?>
				<span class="parent-post-link"><a class="flow-fa fa-folder" href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></span>
			<?php } ?>
			
			<?php edit_post_link( __( 'Edit', 'flowthemes' ), '<span class="edit-link flow-fa flow-fa-pencil">', '</span>' ); ?>
		</div>
	</header>
				
	<div class="site-content clearfix" role="main">
		<div class="content-area">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<div class="entry-attachment">
							<div class="attachment">
								<?php flow_the_attached_image(); ?>
							</div>

							<?php if ( has_excerpt() ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
							<?php endif; ?>
						</div>

						<?php
							the_content();
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'flowthemes' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) );
						?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
	<nav class="navigation image-navigation">
		<div class="nav-links">
			<?php previous_image_link( false, '<div class="previous-image">' . __( 'Previous Image', 'flowthemes' ) . '</div>' ); ?>
			<?php next_image_link( false, '<div class="next-image">' . __( 'Next Image', 'flowthemes' ) . '</div>' ); ?>
		</div>
	</nav>
	<?php comments_template(); ?>
	
<?php get_footer(); ?>