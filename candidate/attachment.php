<?php
get_header(); ?>


<section id="content">	
			
			<!-- Page Heading -->
			<section class="section page-heading ">
				<h1>
			<?php echo esc_html(get_the_title()); ?>
				</h1>
				
			</section>
			<!-- Page Heading -->


		<!-- Section -->
		<section class="section full-width-bg gray-bg">
			
			<div class="row">
			
				<div class="main-content-page col-lg-12 col-md-12 col-sm-12">

				<?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>

						<?php
							printf(__('By %2$s', 'candidate'),
								'meta-prep meta-prep-author',
								sprintf( '<a class="url fn n" href="%1$s" title="%2$s">%3$s</a>',
								get_author_posts_url( get_the_author_meta( 'ID' ) ),
								sprintf( esc_attr__( 'View all posts by %s', 'candidate' ), get_the_author() ),
								get_the_author()
								)
							);
						?>
						<span>|</span>
						<?php
							printf( __('Published %2$s', 'candidate'),
								'meta-prep meta-prep-entry-date',
								sprintf( '<abbr title="%1$s">%2$s</abbr>',
								esc_attr( get_the_time() ),
								get_the_date()
								)
							);
							if ( wp_attachment_is_image() ) {
								echo ' | ';
								$metadata = wp_get_attachment_metadata();
								printf( __( 'Full size is %s pixels', 'candidate'),
									sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
									wp_get_attachment_url(),
									esc_attr( __('Link to full-size image', 'candidate') ),
									$metadata['width'],
									$metadata['height']
									)
								);
							}
						?>
						<?php edit_post_link( __( 'Edit', 'candidate' ), '', '' ); ?>




				<section id="content" class="content-attachment" >
					<?php if ( wp_attachment_is_image() ) :
						$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
						foreach ( $attachments as $k => $attachment ) {
							if ( $attachment->ID == $post->ID )
								break;
						}
						$k++;
						// If there is more than 1 image attachment in a gallery
						if ( count( $attachments ) > 1 ) {
							if ( isset( $attachments[ $k ] ) )
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
							else
								// or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
						} else {
							// or, if there's only 1 image attachment, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
						}
					?>
											<p><a href="<?php echo esc_url($next_attachment_url); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
												echo wp_get_attachment_image( $post->ID, 'post-full' ); // filterable image width with, essentially, no limit for image height.
											?></a></p>
												<?php previous_image_link( false ); ?>
												<?php next_image_link( false ); ?>
					<?php else : ?>
											<a href="<?php echo esc_url(wp_get_attachment_url()); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
					<?php endif; ?>
											<?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?>
											<?php the_content( __( 'Continue reading &rarr;', 'candidate' ) ); ?>
											<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'candidate' ), 'after' => '' ) ); ?>
											<?php edit_post_link( __( 'Edit', 'candidate' ), ' ', '' ); ?>
					<?php comments_template(); ?>
					

				</section>		
						
			<?php endwhile; ?>	
						
</div>
</div>



		</section>
		<!-- /Section -->
		
</section>

<?php get_footer(); ?>