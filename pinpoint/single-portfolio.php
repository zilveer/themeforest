<?php get_header(); ?>
	
<?php
	$options = get_option('sf_pinpoint_options');
	$page_layout = $options['page_layout'];	
	$portfolio_data = get_post_meta( $post->ID, 'portfolio', true );
	$current_item_id = $post->ID;
	$twitter_share = $options['twitter_share_username'];
?>

<?php if (have_posts()) : the_post(); ?>
	
	<?php $hide_title = get_post_meta($post->ID, 'sf_hide_title', true); ?>

	<?php if (!$hide_title) { ?>
	<div class="page-heading full-width clearfix">
		<?php if ($page_layout == "fullwidth") { ?>
		<div class="container">
		<div class="sixteen columns">
		<?php } ?>
		<h1><?php the_title(); ?></h1>
		<?php if ($page_layout == "fullwidth") { ?>
		</div>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	
	<?php if ($page_layout == "fullwidth") { ?>
	<div class="container">
	<div class="sixteen columns">
	<?php } ?>
	
	<div class="inner-page-wrap clearfix">
			
		<!-- OPEN article -->
		<article <?php post_class('portfolio-article clearfix'); ?> id="<?php the_ID(); ?>">
		
			<?php
				
				$media_type = $media_image = $media_image_alt = $media_video = $media_gallery = '';
				 
				$use_thumb_content = get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true);
				$hide_details = get_post_meta($post->ID, 'sf_hide_details', true);
				
				if ($use_thumb_content) {
				$media_type = get_post_meta($post->ID, 'sf_thumbnail_type', true);
				$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
				$media_video = get_post_meta($post->ID, 'sf_thumbnail_video_url', true);
				$media_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=full-width-image' );
				} else {
				$media_type = get_post_meta($post->ID, 'sf_detail_type', true);
				$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full');
				$media_video = get_post_meta($post->ID, 'sf_detail_video_url', true);
				$media_gallery = rwmb_meta( 'sf_detail_gallery', 'type=image&size=full-width-image' );
				$media_slider = get_post_meta($post->ID, 'sf_detail_rev_slider_alias', true);
				}
				
				foreach ($media_image as $detail_image) {
					$media_image_url = $detail_image['url'];
					$media_image_alt = $detail_image['alt'];
					break;
				}
												
				if (!$media_image) {
					$media_image = get_post_thumbnail_id();
					$media_image_url = wp_get_attachment_url( $media_image, 'full' );
					$media_image_alt = get_post_meta( $media_image, '_wp_attachment_image_alt', true );
				}
				
				// META VARIABLES
				$media_width = 940;
				$media_height = NULL;
				$video_height = 530;
			?>
			
			<?php if ($media_type != "none") { ?>
			
			<figure class="media-wrap">
					
			<?php if ($media_type == "video") { ?>
				
				<?php echo video_embed($media_video, $media_width, $video_height); ?>
				
			<?php } else if ($media_type == "slider") { ?>
				
				<div class="flexslider portfolio-slider">
					
					<ul class="slides">
							
					<?php foreach ( $media_gallery as $image ) {
				    	echo "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></li>";
					} ?>
																
					</ul>
				
				</div>
				
			<?php } else if ($media_type == "layer-slider") { ?>
				
				<div class="layerslider portfolio-slider">
					
					<?php echo do_shortcode('[rev_slider '.$media_slider.']'); ?>
				
				</div>
					
			<?php } else { ?>
					
				<?php $detail_image = aq_resize( $media_image_url, $media_width, $media_height, true, false); ?>
				
				<?php if ($detail_image) { ?>
					
					<img src="<?php echo $detail_image[0]; ?>" width="<?php echo $detail_image[1]; ?>" height="<?php echo $detail_image[2]; ?>" alt="<?php echo $media_image_alt; ?>" />
					
				<?php } ?>
				
			<?php } ?>
			
			</figure>
			
			<?php } ?>
				
			<section class="article-body-wrap">
				
				<?php 
					$item_client = get_post_meta($post->ID, 'sf_portfolio_client', true);
					$item_date = get_the_date();
					$item_categories = get_the_term_list($post->ID, 'portfolio-category', '', ', ');
					$item_link = get_post_meta($post->ID, 'sf_portfolio_external_link', true);
					$show_social = get_post_meta($post->ID, 'sf_social_sharing', true);
				?>
				
				<?php if (!$hide_details) { ?>
				
				<div class="portfolio-details-wrap">
					<?php if ($item_client) { ?>
					<span class="client"><?php _e("Client: ", "swiftframework"); ?><span><?php echo $item_client; ?></span></span>
					<?php } ?>
					<span class="date"><?php _e("Date: ", "swiftframework"); ?><span><?php echo $item_date; ?></span></span>
					<?php if ($item_categories != "") { ?>
					<span class="tags-wrap"><?php _e("Category: ", "swiftframework"); ?><span class="tags"><?php echo $item_categories; ?></span></span>
					<?php } ?>
					<?php if ($item_link) { ?>
					<a class="item-link" href="<?php echo $item_link; ?>" target="_blank"><i class="icon-link"></i><?php echo $item_link; ?></a>
					<?php } ?>
				</div>
				
				<?php } ?>
				
				<section class="portfolio-detail-description">
					<div class="body-text">
						<?php the_content(); ?>
					</div>
				</section>
				
				<?php if ($show_social) { ?>
				
				<div class="share-links">
					<?php if (function_exists( 'lip_love_it_link' )) { ?>
					<div class="item-loves">
						<?php echo lip_love_it_link(get_the_ID(), '<i class="icon-heart"></i>', '<i class="icon-heart"></i>'); ?>
					</div>
					<?php } ?>
					<div class="share-buttons">
						<span class='st_facebook_hcount' displayText='Facebook'></span>
						<span class='st_twitter_hcount' displayText='Tweet'></span>
						<span class='st_googleplus_hcount' displayText='Google +'></span>
						<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
						<span class='st_pinterest_hcount' displayText='Pinterest'></span>
					</div>
				</div>
				
				<?php } ?>
				
			</section>
			
			
			<div class="pagination-wrap portfolio-pagination full-width clearfix">
				<div class="nav-previous"><?php next_post_link(__('<i class="icon-chevron-left"></i> <span class="nav-text">%link</span>', 'swiftframework'), '%title'); ?></div>
				<div class="nav-next"><?php previous_post_link(__('<span class="nav-text">%link</span><i class="icon-chevron-right"></i>', 'swiftframework'), '%title'); ?></div>
			</div>	
				
		<!-- CLOSE article -->
		</article>
	
	</div>
	
	<?php if ($page_layout == "fullwidth") { ?>
	</div>
	</div>
	<?php } ?>

<?php endif; ?>

<!-- WordPress Hook -->
<?php get_footer(); ?>