<?php
/**
 * Template Name: Gallery
 * Description: A Page Template that adds a gallery to pages
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */

get_header(); ?>

	<div id="main" class="clearfix">

		<div id="primary">
			<div id="content" role="main">	
				<header class="entry-header">
					<h1 class="entry-title"><?php echo the_title();?></h1>
				</header><!-- .entry-header -->
				<?php if ( post_password_required() ) : ?>
					<div class="password-protected">
						<?php the_content(); ?>
					</div>
				<?php else : ?>
						
					<?php 
					$imageNumber = get_post_meta( $post->ID, 'mega_photos_number', true );
					if ( empty( $imageNumber ) )  
						$imageNumber = 30;
							  
					$showtitle = get_post_meta( $post->ID, 'mega_photos_title', true );
						
					if ( $showtitle == __( 'yes', 'mega' ) ) 
						$showtitle = 'true';
					else $showtitle = 'false';			
					?>
						
					<?php
					global $post;
					
					if ( metadata_exists( 'post', $post->ID, '_page_image_gallery' ) ) {
						$page_image_gallery = get_post_meta( $post->ID, '_page_image_gallery', true );
					} else {
						// Backwards compat
						$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
						$page_image_gallery = implode( ',', $attachment_ids );
					}
					
					$attachments = array_filter( explode( ',', $page_image_gallery ) );
					$thumbs = array();
					
					$args2 = array(
						'post_type' => 'attachment',
						'post_parent' => get_the_ID(),
						'post_mime_type' => 'image',
						'post_status' => null,
						'numberposts' => -1
					);
					$attachments2 = get_posts($args2);
					
					if ( $attachments ) { ?>
					
						<div id="block-gallery" class="clearfix">
							<ul class="photos-gallery clearfix" id="gallery-<?php the_ID(); ?>" data-pageid="<?php echo the_ID();?>" data-total="<?php echo count($attachments2); ?>" data-offset="<?php echo $imageNumber; ?>" data-mega-title="<?php echo $showtitle; ?>">
						
									<?php foreach ( $attachments as $attachment_id ) { ?>                
										<?php 
											$gallery_image_src = wp_get_attachment_image_src( $attachment_id, 'full' );
											$zoom = $gallery_image_src[0];
											$gallery_image_thumb = wp_get_attachment_image( $attachment_id, 'gallery-thumb' );
											$gallery_image_title = esc_attr( get_the_title( $attachment_id ) );
											$class = "media-image";
										?>
														
										<li class="gallery-item <?php echo $class; ?>">
											<a href="<?php echo $zoom; ?>" rel="external" <?php if ( $showtitle == 'true' ) echo 'title="'. $gallery_image_title .'"'; ?>>
												<?php echo $gallery_image_thumb; ?>
												<div class="entry-view-wrapper"></div>
											</a>
										</li>    
															
									<?php } ?>
														
							</ul><!-- .photos-gallery -->
							
							<div id="ajax-loading"></div>
						</div><!-- #block-gallery -->
					<?php } ?>
					
				<?php endif; ?>
				
				</div><!-- #content -->
			</div><!-- #primary -->
	
<?php get_footer(); ?>