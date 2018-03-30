<?php
/**
 * Template Name: Video Gallery
 * Description: A Page Template that adds a video gallery to pages
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
					$show_videos_title = get_post_meta( $post->ID, 'mega_videos_title', true );
						
					if ( $show_videos_title == __( 'yes', 'mega' ) ) 
						$show_videos_title = 'true';
					else $show_videos_title = 'false';			
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
					
					if ( $attachments ) { ?>
					
						<div id="block-video-gallery" class="clearfix">
							<ul class="videos-gallery clearfix" id="gallery-<?php the_ID(); ?>" data-pageid="<?php echo the_ID();?>" data-mega-title="<?php echo $show_videos_title; ?>">
						
									<?php foreach ( $attachments as $attachment_id ) { ?>                
										<?php 
											$gallery_image_src = wp_get_attachment_image_src( $attachment_id, 'full' );
											$zoom = $gallery_image_src[0];
											$gallery_image_thumb = wp_get_attachment_image_src( $attachment_id, 'video-gallery-thumb' );
											$gallery_image_title = esc_attr( get_the_title( $attachment_id ) );
											$video_url = get_post_meta( $attachment_id, 'mega-attachment-video-url', true );
											$class = "media-image";
											if ( ! empty( $video_url ) ) {
												$zoom  = $video_url;
												$class = "media-video";
											}
										?>
														
										<li class="video-gallery-item <?php echo $class;?>">
											<a class="fancybox" href="<?php echo $zoom; ?>" rel="external" <?php if ( $show_videos_title == 'true' ) echo 'title="'. $gallery_image_title .'"'; ?>>
												<img src="<?php echo $gallery_image_thumb[0]; ?>" width="<?php echo $gallery_image_thumb[1]; ?>" height="<?php echo $gallery_image_thumb[2]; ?>" alt="<?php echo $gallery_image_title; ?>" />
												<div class="entry-view-wrapper">
													<div class="entry-view">
														<div class="entry-view-content">
															<?php  if ( ! empty( $video_url ) ) { ?>
																<i class="icon-play"></i>
															<?php  } ?>
														</div>
													</div>
												</div>
											</a>
										</li>    
															
									<?php } ?>
														
							</ul><!-- .videos-gallery -->
						</div><!-- #block-video-gallery -->
					<?php } ?>
										
				<?php endif; ?>
				
				</div><!-- #content -->
			</div><!-- #primary -->
	
<?php get_footer(); ?>