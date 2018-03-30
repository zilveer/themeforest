<?php

	/*
	*
	*	Portfolio Detail Function Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*	sf_portfolio_items()
	*	sf_portfolio_filter()
	*
	*/
	
	
	if ( !function_exists( 'sf_portfolio_detail_media' ) ) {
		function sf_portfolio_detail_media($extra_class) {
			global $post;
			$media_type = $media_image = $media_video = $media_gallery = '';
			 
			$fw_media_display = sf_get_post_meta($post->ID, 'sf_fw_media_display', true);
			$use_thumb_content = sf_get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true);
			$hide_details = sf_get_post_meta($post->ID, 'sf_hide_details', true);
			$show_social = sf_get_post_meta($post->ID, 'sf_social_sharing', true);
			$item_categories = get_the_term_list($post->ID, 'portfolio-category', '<li>', '</li><li>', '</li>');
			$item_link = sf_get_post_meta($post->ID, 'sf_portfolio_external_link', true);
			
			if ($use_thumb_content) {
			$media_type = sf_get_post_meta($post->ID, 'sf_thumbnail_type', true);
			$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
			$media_video = sf_get_post_meta($post->ID, 'sf_thumbnail_video_url', true);
			$media_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image-onecol' );
			} else {
			$media_type = sf_get_post_meta($post->ID, 'sf_detail_type', true);
			$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full');
			$media_video = sf_get_post_meta($post->ID, 'sf_detail_video_url', true);
			$media_gallery = rwmb_meta( 'sf_detail_gallery', 'type=image&size=thumb-image-onecol' );
			$media_slider = sf_get_post_meta($post->ID, 'sf_detail_rev_slider_alias', true);
			$media_layerslider = sf_get_post_meta($post->ID, 'sf_detail_layer_slider_alias', true);
			$custom_media = sf_get_post_meta($post->ID, 'sf_custom_media', true);
			}
			
			foreach ($media_image as $detail_image) {
				$media_image_url = $detail_image['url'];
				$share_image_url = $media_image_url;
				break;
			}
											
			if (!$media_image) {
				$media_image = get_post_thumbnail_id();
				$media_image_url = wp_get_attachment_url( $media_image, 'full' );
				$share_image_url = $media_image_url;
			}
			
			$image_caption = $image_alt = $image_title = "";
			$image_meta 		= sf_get_attachment_meta( $media_image );
			
			if ( isset($image_meta) ) {
				$image_caption 		= esc_attr( $image_meta['caption'] );
				$image_title 		= esc_attr( $image_meta['title'] );
				$image_alt 			= esc_attr( $image_meta['alt'] );
			}
													
			// META VARIABLES
			$media_width = 850;
			$video_height = 638;
			if ($fw_media_display) {
			$media_width = 2000;
			$video_height = 800;
			}
			$media_height = NULL;
		?>
			<figure class="media-wrap <?php echo $extra_class; ?>">
				<?php if ($media_type == "video") { ?>
					
					<?php echo sf_video_embed($media_video, $media_width, $video_height); ?>
					
				<?php } else if ($media_type == "slider") { ?>
					
					<div class="flexslider item-slider">
						<ul class="slides">
						<?php foreach ( $media_gallery as $image ) {
							echo "<li>";
							if (!empty($image['caption'])) {
							echo "<p class='flex-caption'>{$image['caption']}</p>";
							}
							echo "<img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' />";
							echo "</li>";
						} ?>										
						</ul>
					</div>
					
				<?php } else if ($media_type == "layer-slider") { ?>
					
					<div class="layerslider">
						
						<?php if ($media_slider != "") {
						
								echo do_shortcode('[rev_slider '.$media_slider.']');
							
							} else {
							
								echo do_shortcode('[layerslider id="'.$media_layerslider.'"]');
								
							} ?>
						
					</div>
						
				<?php } else if ($media_type == "custom") {
											
					echo $custom_media;					
					
				} else if ($media_type != "none") { ?>
					
					<?php 
						if ($media_type == "image" && $media_image_url == "") {
							$media_image_url = "default";
						}
						$detail_image = sf_aq_resize( $media_image_url, $media_width, $media_height, true, false);
					?>
					
					<?php if ($detail_image) { ?>
						
						<img itemprop="image" src="<?php echo $detail_image[0]; ?>" width="<?php echo $detail_image[1]; ?>" height="<?php echo $detail_image[2]; ?>" alt="<?php echo $image_alt; ?>" title="<?php echo $image_title; ?>" />
						
					<?php } ?>
					
				<?php } ?>
			</figure>
		<?php }
	}
	
	if ( !function_exists( 'sf_portfolio_social_links' ) ) {
		function sf_portfolio_social_links() {

			global $post;			
			$page_title = get_the_title();
			$page_permalink = get_the_permalink();
			$media_type = $media_image = '';
			 
			$use_thumb_content = sf_get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true);
			
			if ($use_thumb_content) {
			$media_type = sf_get_post_meta($post->ID, 'sf_thumbnail_type', true);
			$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
			} else {
			$media_type = sf_get_post_meta($post->ID, 'sf_detail_type', true);
			$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full');
			}
			
			foreach ($media_image as $detail_image) {
				$media_image_url = $detail_image['url'];
				$share_image_url = $media_image_url;
				break;
			}
											
			if (!$media_image) {
				$media_image = get_post_thumbnail_id();
				$media_image_url = wp_get_attachment_url( $media_image, 'full' );
				$share_image_url = $media_image_url;
			}
			
		?>
			<div class="share-links clearfix">
				<ul class="bar-styling">
					<li class="sf-love">
						<div class="comments-likes">
						<?php if (function_exists( 'lip_love_it_link' )) {
							echo lip_love_it_link(get_the_ID(), '<i class="ss-heart"></i>', '<i class="ss-heart"></i>', false);
						} ?>
						</div>
					</li>
				    <li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php echo $page_permalink; ?>" class="product_share_facebook" onclick="javascript:window.open(this.href,
				      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"><i class="fa-facebook"></i></a></li>
				    <li class="twitter"><a href="https://twitter.com/share?url=<?php echo $page_permalink; ?>&text=<?php echo urlencode(get_the_title()); ?>" onclick="javascript:window.open(this.href,
				      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;" class="product_share_twitter"><i class="fa-twitter"></i></a></li>   
				    <li class="google-plus"><a href="https://plus.google.com/share?url=<?php echo $page_permalink; ?>" onclick="javascript:window.open(this.href,
				      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa-google-plus"></i></a></li>
				    <?php if ($share_image_url != "") { ?>
				    <li class="pinterest"><a href="//pinterest.com/pin/create/button/?url=<?php echo $page_permalink; ?>&media=<?php echo $share_image_url; ?>&description=<?php echo $page_title; ?>" onclick="javascript:window.open(this.href,
				      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=320,width=600');return false;" class="product_share_pinterest"><i class="fa-pinterest"></i></a></li>
				    <?php } else { ?>
				    <li class="pinterest"><a href="//pinterest.com/pin/create/button/?url=<?php echo $page_permalink; ?>&description=<?php echo $page_title; ?>" onclick="javascript:window.open(this.href,
				      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=320,width=600');return false;" class="product_share_pinterest"><i class="fa-pinterest"></i></a></li>
				    <?php } ?>
				    <li class="mail"><a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo strip_tags(get_the_excerpt()); ?> <?php $page_permalink; ?>" class="product_share_email"><i class="ss-mail"></i></a></li>
				</ul>						
			</div>
		<?php }
	}
	
	
	if ( !function_exists( 'sf_portfolio_details' ) ) {
		function sf_portfolio_details($extra_class = "") {
			global $post;
			$item_categories = get_the_term_list($post->ID, 'portfolio-category', '<li>', '</li><li>', '</li>');	
			$item_sidebar_content = sf_get_post_meta($post->ID, 'sf_item_sidebar_content', true);
			$item_link = sf_get_post_meta($post->ID, 'sf_portfolio_external_link', true);
		?>
			<div class="portfolio-details-wrap <?php echo $extra_class; ?>">
				<?php if ($item_sidebar_content != "") { ?>
				<div class="sidebar-content">
					<?php echo do_shortcode($item_sidebar_content); ?>
				</div>
				<?php } ?>
				<div class="date updated">
					<?php echo get_the_date();?>
				</div>
				<?php if ($item_link) { ?>
				<a class="item-link" href="<?php echo $item_link; ?>" target="_blank"><i class="ss-link"></i><?php _e("View Project", "swiftframework"); ?></a>
				<?php } ?>
				<?php if ($item_categories != "") { ?>
				<ul class="portfolio-categories">
					<?php echo $item_categories; ?>
				</ul>
				<?php } ?>
				<?php if (has_tag()) { ?>
				<div class="tags-link-wrap clearfix">
					<div class="tags-wrap"><?php _e("Tags:", "swiftframework"); ?><span class="tags"><?php the_tags(''); ?></span></div>
				</div>
				<?php } ?>
			</div>
		<?php }
	}
	
	
	if ( !function_exists( 'sf_portfolio_related' ) ) {
		function sf_portfolio_related() {
			global $post;
			$related =  sf_portfolio_related_posts( $post->ID );
			if ($related->have_posts()) { 
		?>
		
			<div class="container">
			
				<div class="related-projects clearfix">
					
					<h3 class="spb-heading"><span><?php _e("Related Projects", "swiftframework"); ?></span></h3>
					
					<ul class="row">
					<?php while ( $related->have_posts() ): $related->the_post(); ?>
					    	<?php
					    		$item_title = get_the_title();
					    		$thumb_image = "";
					    		$thumb_image = sf_get_post_meta($post->ID, 'sf_thumbnail_image', true);
					    		if ($thumb_image == "") {
					    			$thumb_image = get_post_thumbnail_id($post->ID);
					    		}
					    		$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
					    		if ($thumb_img_url == "") {
					    			$thumb_img_url = "default";
					    		}
					    		$image = sf_aq_resize( $thumb_img_url, 300, 225, true, false);
					    	?>
					    	
					        <li class="col-sm-3">
					        	<figure class="animated-overlay">
					        		<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $item_title; ?>" />
					        		<a href="<?php the_permalink(); ?>"></a>
					        		<figcaption>
					        			<div class="thumb-info">						
					        				<h4><?php echo $item_title; ?></h4>
				        					<i class="ss-navigateright"></i>
					        			</div>
					        		</figcaption>
					        	</figure>
					        </li>
					    <?php endwhile; ?>
					</ul>
					
				</div>
				
				</div>
			
			<?php } ?>		
								
		<?php }
	}