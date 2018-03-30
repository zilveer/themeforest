<?php get_header(); ?>

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
				
					<?php $gallery_script = get_post_meta(get_the_ID(), 'mega_gallery_script', true);	?>
					
					<?php if ( $gallery_script == 'Full Width Slider' ) : ?>
					
						<?php
						$full_width_slider_title = get_post_meta( get_the_ID(), 'mega_full_width_slider_title', true );
						if ( $full_width_slider_title == __( 'yes', 'mega') ) 
							$full_width_slider_title = 'true';
						else $full_width_slider_title = 'false';
						
						global $post;

						if ( metadata_exists( 'post', $post->ID, '_gallery_post_type_image_gallery' ) ) {
							$gallery_post_type_image_gallery = get_post_meta( $post->ID, '_gallery_post_type_image_gallery', true );
						} else {
							// Backwards compat
							$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
							$gallery_post_type_image_gallery = implode( ',', $attachment_ids );
						}
									
						$attachments = array_filter( explode( ',', $gallery_post_type_image_gallery ) );
						$thumbs = array();
						if ( $attachments ) { ?>
							<div id="full-width-slider" class="royalSlider rsMinW clearfix">
								<?php foreach ( $attachments as $attachment_id ) { ?>
									<div class="rsContent" data-attachment_id="<?php echo $attachment_id; ?>">
										<?php $gallery_image_src = wp_get_attachment_image_src( $attachment_id, 'full' ); ?>
										<?php $gallery_image_thumb = wp_get_attachment_image_src( $attachment_id, 'thumbnail' ); ?>
										<?php $attachment = get_post( $attachment_id ); ?>
										<?php $attachment_title = apply_filters( 'the_title', $attachment->post_title ); ?>
										<?php $attachment_caption = apply_filters( 'the_title', $attachment->post_excerpt ); ?>
										<img class="rsImg" src="<?php echo $gallery_image_src[0]; ?>" width="<?php echo $gallery_image_src[1]; ?>" height="<?php echo $gallery_image_src[2]; ?>" alt="<?php echo $attachment_title; ?>" data-rsTmb="<?php echo $gallery_image_thumb[0]; ?>" />
										<?php if ( ! empty( $attachment_caption ) ) { ?>
											<span class="rsTitle rsABlock rsNoDrag rsAbsoluteEl" data-fade-effect="true" data-move-offset="8" data-move-effect="bottom" data-speed="300"><?php echo $attachment_caption; ?></span>
										<?php } ?>
									</div>
								<?php } ?>
							</div><!-- #gallery-slider -->
										
						<?php } else { ?>
							<p class="no-found"><?php _e( 'No images found, please add some images.', 'mega' ); ?></p>
						<?php } // end if ( $attachments ) ?>
						
					<?php elseif ( $gallery_script == 'Slider' ) : ?>
					
						<?php								
						global $post;

						if ( metadata_exists( 'post', $post->ID, '_gallery_post_type_image_gallery' ) ) {
							$gallery_post_type_image_gallery = get_post_meta( $post->ID, '_gallery_post_type_image_gallery', true );
						} else {
							// Backwards compat
							$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
							$gallery_post_type_image_gallery = implode( ',', $attachment_ids );
						}
									
						$attachments = array_filter( explode( ',', $gallery_post_type_image_gallery ) );
						$thumbs = array();
						?>
						
						<div id="carousel-gallery-wrapper" class="container clearfix">
							<div id="carousel-gallery" class="container clearfix">
								<div class = "iosSliderContainer clearfix">
									<div class = "iosSlider clearfix">
										<div class="slider clearfix">
											<?php foreach ( $attachments as $attachment_id ) { ?>
												<?php
													$gallery_image_src = wp_get_attachment_image_src( $attachment_id, 'full' );
													$attachment = get_post( $attachment_id );
													$attachment_title = apply_filters( 'the_title', $attachment->post_title );
												?>
												<div class="item">
													<img src="<?php echo $gallery_image_src[0]; ?>" width="<?php echo $gallery_image_src[1];?>" height="<?php echo $gallery_image_src[2];?>" alt="<?php echo $attachment_title; ?>" />
												</div><!-- .item -->
											<?php } ?>
										</div><!-- .slider -->
										<div class="iosNext"></div>
										<div class="iosPrev iosUnselectable"></div>
									</div><!-- .iosSlider -->
								</div><!-- .iosSliderContainer -->
							</div><!-- #carousel-gallery -->
						</div><!-- #carousel-gallery-wrapper -->
						
					<?php elseif ( $gallery_script == 'Video Gallery' ) : ?>
					
						<?php 
						$videoNumber = get_post_meta( $post->ID, 'mega_videos_number', true );
						if ( empty( $videoNumber ) )  
							$videoNumber = 30;
								  
						$show_videos_title = get_post_meta( $post->ID, 'mega_videos_title', true );
							
						if ( $show_videos_title == __( 'yes', 'mega' ) ) 
							$show_videos_title = 'true';
						else $show_videos_title = 'false';			
						?>
							
						<?php								
						global $post;

						if ( metadata_exists( 'post', $post->ID, '_gallery_post_type_image_gallery' ) ) {
							$gallery_post_type_image_gallery = get_post_meta( $post->ID, '_gallery_post_type_image_gallery', true );
						} else {
							// Backwards compat
							$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
							$gallery_post_type_image_gallery = implode( ',', $attachment_ids );
						}
									
						$attachments = array_filter( explode( ',', $gallery_post_type_image_gallery ) );
						$thumbs = array();
						?>
						
						<?php if ( $attachments ) : ?>
					
							<div id="block-video-gallery" class="clearfix">
								<ul class="videos-gallery clearfix" id="gallery-<?php the_ID(); ?>" data-pageid="<?php echo the_ID();?>" data-total="<?php echo count($attachments2); ?>" data-offset="<?php echo $videoNumber; ?>" data-mega-title="<?php echo $show_videos_title; ?>">
							
										<?php foreach ( $attachments as $attachment_id ) { ?>
											<?php 
												$gallery_image_src = wp_get_attachment_image_src( $attachment_id, 'video-gallery-thumb' );
												$zoom = $bigsrc[0];
												$attachment = get_post( $attachment_id );
												$attachment_title = apply_filters( 'the_title', $attachment->post_title );
												$video_url = get_post_meta( $attachment_id, 'mega-attachment-video-url', true );
												$class = "media-image";
												if ( ! empty( $video_url ) ) {
													$zoom  = $video_url;
													$class = "media-video";
												}
											?>
															
											<li class="video-gallery-item <?php echo $class;?>">
												<a class="fancybox" href="<?php echo $zoom; ?>" rel="external" <?php if ( $show_videos_title == 'true' ) echo 'title="'. $attachment_title .'"'; ?>>
													<img src="<?php echo $gallery_image_src[0]; ?>" width="<?php echo $gallery_image_src[1]; ?>" height="<?php echo $gallery_image_src[2]; ?>" alt="<?php echo $attachment_title; ?>" />
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
						<?php endif; ?>
						
					<?php elseif ( $gallery_script == 'Gallery with Visible Nearby Images' ) : ?>
					
						<?php
						global $post;

						if ( metadata_exists( 'post', $post->ID, '_gallery_post_type_image_gallery' ) ) {
							$gallery_post_type_image_gallery = get_post_meta( $post->ID, '_gallery_post_type_image_gallery', true );
						} else {
							// Backwards compat
							$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
							$gallery_post_type_image_gallery = implode( ',', $attachment_ids );
						}
									
						$attachments = array_filter( explode( ',', $gallery_post_type_image_gallery ) );
						$thumbs = array();
						?>
						
						<?php if ( $attachments ) { ?>
					
							<div id="gallery-visible-nearby" class="royalSlider rsDefault visibleNearby clearfix">
							
								<?php foreach ( $attachments as $attachment_id ) { ?>							
									<?php $gallery_image_src = wp_get_attachment_image_src( $attachment_id, 'large' ); ?>
									<a class="rsImg" href="<?php echo $gallery_image_src[0]; ?>"></a>							
								<?php } ?>
							</div><!-- #block-gallery -->
						<?php } ?>
					
					<?php else : ?>
						
						<?php 	  
						$showtitle = get_post_meta( $post->ID, 'mega_photos_title', true );
							
						if ( $showtitle == __( 'yes', 'mega' ) ) 
							$showtitle = 'true';
						else $showtitle = 'false';			
						?>
							
						<?php
						global $post;
						
						if ( metadata_exists( 'post', $post->ID, '_gallery_post_type_image_gallery' ) ) {
							$gallery_post_type_image_gallery = get_post_meta( $post->ID, '_gallery_post_type_image_gallery', true );
						} else {
							// Backwards compat
							$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=' . $imageNumber . '&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
							$gallery_post_type_image_gallery = implode( ',', $attachment_ids );
						}
						
						$attachments = array_filter( explode( ',', $gallery_post_type_image_gallery ) );
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
								<ul class="photos-gallery clearfix" id="gallery-<?php the_ID(); ?>" data-pageid="<?php echo the_ID();?>" data-total="<?php echo count($attachments2); ?>" data-offset="<?php echo $imageNumber;?>" data-mega-title="<?php echo $showtitle; ?>">
							
									<?php foreach ( $attachments as $attachment_id ) { ?>                
										<?php 
											$big_gallery_image_src = wp_get_attachment_image_src( $attachment_id, 'full' );
											$zoom = $big_gallery_image_src[0];
											$gallery_image_src = wp_get_attachment_image_src( $attachment_id, 'gallery-thumb' );
											$gallery_image_title = esc_attr( get_the_title( $attachment_id ) );
											$class = "media-image";
										?>
															
										<li class="gallery-item <?php echo $class;?>">
											<a href="<?php echo $zoom ;?>" rel="external" <?php if ( $showtitle == 'true' ) echo 'title="'. $gallery_image_title .'"'; ?>>
												<img src="<?php echo $gallery_image_src[0]; ?>" width="<?php echo $gallery_image_src[1]; ?>" height="<?php echo $gallery_image_src[2]; ?>" alt="<?php echo $gallery_image_title; ?>" />
												<div class="entry-view-wrapper"></div>
											</a>
										</li>    
																
									<?php } ?>
															
								</ul><!-- .photos-gallery -->
							</div><!-- #block-gallery -->
						<?php } // End if if ( $attachments ) ?>
												
					<?php endif; // End if ( $gallery_script == 'Full Width Slider' ) ?>
					
				<?php endif; // End if ( post_password_required() ) ?>
				
			</div><!-- #content -->
		</div><!-- #primary -->
	
<?php get_footer(); ?>