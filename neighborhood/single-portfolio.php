<?php get_header(); ?>
	
<?php
	
	global $sidebars, $sf_pb_active;
	$sidebars = 'no-sidebars';
	
	$options = get_option('sf_neighborhood_options');
	
	$portfolio_data = sf_get_post_meta( $post->ID, 'portfolio', true );
	$current_item_id = $post->ID;	
	
	$page_class = 'portfolio-article clearfix';
	$pb_active = sf_get_post_meta($post->ID, '_spb_js_status', true);
	if ($pb_active == "true") {
		$page_class = 'portfolio-article clearfix';
	}
?>

<?php if (have_posts()) : the_post(); ?>
		
	<div class="inner-page-wrap has-no-sidebar clearfix">
			
		<!-- OPEN article -->
		<article <?php post_class($page_class); ?> id="<?php the_ID(); ?>" itemscope itemtype="http://schema.org/CreativeWork">
		
			<?php
				
				$media_type = $media_image = $media_video = $media_gallery = '';
				 
				$use_thumb_content = sf_get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true);
				$hide_details = sf_get_post_meta($post->ID, 'sf_hide_details', true);
				
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
				$custom_media = sf_get_post_meta($post->ID, 'sf_custom_media', true);
				}
				
				foreach ($media_image as $detail_image) {
					$media_image_url = $detail_image['url'];
					break;
				}
												
				if (!$media_image) {
					$media_image = get_post_thumbnail_id();
					$media_image_url = wp_get_attachment_url( $media_image, 'full' );
				}
												
				// META VARIABLES
				$media_width = 1170;
				$media_height = NULL;
				$video_height = 658;
			?>
			
			<?php if ($media_type != "none") { ?>
			
			<figure class="media-wrap">
					
			<?php if ($media_type == "video") { ?>
				
				<?php echo video_embed($media_video, $media_width, $video_height); ?>
				
			<?php } else if ($media_type == "slider") { ?>
				
				<div class="flexslider item-slider">
					
					<ul class="slides">
							
					<?php foreach ( $media_gallery as $image ) {
				    	echo "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></li>";
					} ?>
																
					</ul>
				
				</div>
				
			<?php } else if ($media_type == "layer-slider") { ?>
				
				<div class="layerslider">
					
					<?php echo do_shortcode('[rev_slider '.$media_slider.']'); ?>
				
				</div>
					
			<?php } else if ($media_type == "custom") {
										
				echo $custom_media;					
				
			} else { ?>
				
				<?php $detail_image = aq_resize( $media_image_url, $media_width, $media_height, true, false); ?>
				
				<?php if ($detail_image) { ?>
					
					<img itemprop="image" src="<?php echo $detail_image[0]; ?>" width="<?php echo $detail_image[1]; ?>" height="<?php echo $detail_image[2]; ?>" />
					
				<?php } ?>
				
			<?php } ?>
			
			</figure>
			
			<?php } ?>
				
			<section class="article-body-wrap">
				
				<?php 
					$item_client = sf_get_post_meta($post->ID, 'sf_portfolio_client', true);
					$item_date = get_the_date();
					$item_categories = get_the_term_list($post->ID, 'portfolio-category', '', ', ');
					$item_link = sf_get_post_meta($post->ID, 'sf_portfolio_external_link', true);
					$show_social = sf_get_post_meta($post->ID, 'sf_social_sharing', true);
				?>
				
				<?php if (!$hide_details) { ?>
				
					<?php if ( $sf_pb_active ) { ?>
					<div class="container">
					<?php } ?>
					
					<div class="portfolio-details-wrap">
						<?php if ($item_client) { ?>
						<span class="client"><?php _e("Client: ", "swiftframework"); ?><span><?php echo $item_client; ?></span></span>
						<?php } ?>
						<span class="date"><?php _e("Date: ", "swiftframework"); ?><span><?php echo $item_date; ?></span></span>
						<span class="tags-wrap"><?php _e("Category: ", "swiftframework"); ?><span class="tags"><?php echo $item_categories; ?></span></span>
						<?php if ($item_link) { ?>
						<a class="item-link" href="<?php echo $item_link; ?>" target="_blank"><?php _e("View Project", "swiftframework"); ?><i class="fa-angle-right"></i></a>
						<?php } ?>
					</div>
					
					<?php if ( $sf_pb_active ) { ?>
					</div>
					<?php } ?>
					
				<?php } ?>				
				
				<section class="portfolio-detail-description">
					<div class="body-text clearfix">
						<?php the_content(); ?>
					</div>
				</section>
				
				<?php if ($show_social) { ?>
				
				<div class="share-links container clearfix">
					<div class="share-text"><?php _e("Share:", "swiftframework"); ?></div>
					<div class="comments-likes">
					<?php if (function_exists( 'lip_love_it_link' )) {
						echo lip_love_it_link(get_the_ID(), '<i class="fa-heart"></i>', '<i class="fa-heart"></i>', false);
					} ?>
					</div>
					<ul>
					    <li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="product_share_facebook"><i class="fa-facebook"></i></a></li>
					    <li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="product_share_twitter"><i class="fa-twitter"></i></a></li>   
					    <li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
					      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa-google-plus"></i></a></li>
						<li><a href="mailto:?subject=<?php the_title(); ?>&body=<?php echo strip_tags(get_the_excerpt()); ?> <?php the_permalink(); ?>" class="product_share_email"><i class="fa-envelope"></i></a></li>
					    <li><a class="permalink item-link" href="<?php the_permalink(); ?>"><i class="fa-link"></i></a></li>
					</ul>						
				</div>
				
				<?php } ?>
								
				<div class="pagination-wrap portfolio-pagination container clearfix">
					<div class="nav-previous"><?php next_post_link(__('<i class="fa-angle-left"></i> <span class="nav-text">%link</span>', 'swiftframework'), '%title'); ?></div>
					<div class="nav-next"><?php previous_post_link(__('<span class="nav-text">%link</span><i class="fa-angle-right"></i>', 'swiftframework'), '%title'); ?></div>
				</div>	
				
			</section>
				
		<!-- CLOSE article -->
		</article>
	
	</div>

<?php endif; ?>

<!--// WordPress Hook //-->
<?php get_footer(); ?>