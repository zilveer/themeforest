<?php
/**
 * Attachment
 */

// Main header 
get_header();

?>
		
<?php while ( have_posts() ) : the_post(); ?>

<div id="content">

	<div id="content-inner">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
			<header id="attachment-header">

				<?php if ( get_the_title() ) : ?>
					<h1 class="page-title"><?php the_title(); ?></h1>	
				<?php endif; ?>

				<div id="attachment-header-meta" class="box">

					<ul id="attachment-header-meta">

						<li>
							<time datetime="<?php esc_attr( the_time( 'c' ) ); ?>"><?php printf( __( 'Uploaded %s', 'risen' ), '<span>' . risen_date_ago( get_the_time( 'U' ) ) . '</span>' ); ?></time>
						</li>

						<?php if ( $post->post_parent ) : ?>
							<li>
								<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" title="<?php echo esc_attr( get_the_title( $post->post_parent ) ); ?>"><?php echo get_the_title( $post->post_parent ); ?></a>
							</li>
						<?php endif; ?>

					</ul>

				</div>

			</header>

			<div class="post-attachment">

				<?php
				// Image is displayed
				if ( wp_attachment_is_image() ) :
				?>

					<div class="wp-caption aligncenter">

						<?php echo wp_get_attachment_image( $post->ID, 'large' ); ?>

						<?php if ( risen_has_manual_excerpt() ) : ?>
							<p class="wp-caption-text">
								<?php echo wptexturize( get_the_excerpt() ); ?>
							</p>
						<?php endif; ?>

					</div>

				<?php
				// Other files are represented by download link
				// (typically non-image file attachment pages are never linked to)
				else :
				?>

					<a href="<?php echo esc_url( risen_force_download_url( wp_get_attachment_url( $post->ID ) ) ); ?>" class="button">
						<?php
						$filetype = wp_check_filetype( wp_get_attachment_url( $post->ID ) );
						if ( $filetype['ext'] ) {
							/* translators: %s is file extension */
							printf( __( 'Download %s', 'risen' ), strtoupper( $filetype['ext'] ) );
						}
						?>
					</a>

				<?php endif; ?>

			</div>

			<div class="post-content"> <!-- confines heading font to this content -->
				<?php the_content() ?>
			</div>
			
			<?php if ( get_edit_post_link( $post->ID ) ) : ?>
			<footer class="box page-footer">
				<?php edit_post_link( __( 'Edit Attachment', 'risen' ), '<span class="edit-link">', '</span>' ); ?>
			</footer>
			<?php endif; ?>
			
		</article>

		<?php //comments_template( '', true ); ?>
		
	</div>

</div>

<?php endwhile; ?>

<?php get_footer(); ?>