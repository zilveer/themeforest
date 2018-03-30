<?php
/**
*  loop attachment
 */
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php // get_sidebar(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-wrapper entry-content clearfix">
						<?php
						// Show Image
						if ( wp_attachment_is_image() ) :
							?>
							<a rel="prettyPhoto" title="<?php echo $post->post_title; ?>" href="<?php echo wp_get_attachment_url(); ?>">
								<?php
								echo display_post_image (
									$post->ID,
									$have_image_url=false,
									$link=false,
									$type="fullwidth",
									$post->post_title,
									$class="" 
								);
								?>
							</a>
							<?php
						endif;
						?>
						
						<div class="navigation">
							<div class="nav-previous">
							<?php //previous_image_link( array( 35, 35 ) ); ?>
							<span>&nbsp;</span>
							<?php previous_image_link( false , __('Previous Image','mthemelocal') ); ?>
							
							</div>
							<div class="nav-lightbox">
								<a rel="prettyPhoto" title="<?php echo $post->post_title; ?>" href="<?php echo wp_get_attachment_url(); ?>">
									<?php _e('Lightbox','mthemelocal'); ?>
								</a>
							</div>
							<div class="nav-next">
							<?php //next_image_link( array( 35, 35 ) ); ?>
							<?php next_image_link( false , __('Next Image','mthemelocal') ); ?>
							</div>
						</div><!-- #nav-below -->
						
						<div class="entry-attachment">
						<?php if ( wp_attachment_is_image() ) :
							$attachments = array_values( get_children( array( 
										'post_parent' => $post->post_parent, 
										'post_status' => 'inherit', 
										'post_type' => 'attachment', 
										'post_mime_type' => 'image', 
										'order' => 'ASC', 
										'orderby' => 'menu_order ID' ) ) );
										
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
						<?php else : ?>
						<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
							<?php echo basename( get_permalink() ); ?>
						</a>
						<?php endif; ?>
						</div><!-- .entry-attachment -->
			
						<?php the_excerpt(); ?>
						<?php 
							wp_link_pages( array(
							'pagelink' => __( 'Page', 'mthemelocal' ) . ' %',
							'before' => '<div class="page-link">', 
							'after' => '</div>' ));
						?>
						<div class="clear"></div>			

			</div>

<?php endwhile; // end of the loop. ?>