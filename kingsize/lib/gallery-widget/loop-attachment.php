<?php
/**
 * The loop that displays an attachment.
 * @KingSize 2011 - This is the page.php
 *
 * @KingSize Template by Denoizzed and Our Web Media
 * Developed by: Our Web Media 2011
 * Developer URL: http://themeforest.net/user/OurWebMedia
 * Original design by: Denoizzed 2010
 * Author URL: http://themeforest.net/user/Denoizzed
 **/
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				

				<h2 class="section_title"><?php the_title(); ?></h2>					

				
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

				<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
				<?php
					$attachment_width  =  680 ;
					$attachment_height = 450 ;
					echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) ); // filterable image width with, essentially, no limit for image height.
				?>
			   </a>

			<!-- <div id="nav-below" class="navigation">
				<div class="nav-previous"><?php previous_image_link( false ); ?></div>
				<div class="nav-next"><?php next_image_link( false ); ?></div>
			</div>#nav-below -->
<?php else : ?>
			<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
<?php endif; ?>
			

<?php comments_template(); ?>

<?php endwhile; // end of the loop. ?>