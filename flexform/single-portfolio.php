<?php get_header(); ?>
	
<?php
	$options = get_option('sf_flexform_options');
	$default_show_page_heading = $options['default_show_page_heading'];
	$default_page_heading_bg_alt = $options['default_page_heading_bg_alt'];
	
	$portfolio_data = get_post_meta( $post->ID, 'portfolio', true );
	$current_item_id = $post->ID;	
	$show_page_title = get_post_meta($post->ID, 'sf_page_title', true);
	$page_title_one = get_post_meta($post->ID, 'sf_page_title_one', true);
	$page_title_two = get_post_meta($post->ID, 'sf_page_title_two', true);
	$page_title_bg = get_post_meta($post->ID, 'sf_page_title_bg', true);
	
	if ($show_page_title == "") {
		$show_page_title = $default_show_page_heading;
	}
	if ($page_title_bg == "") {
		$page_title_bg = $default_page_heading_bg_alt;
	}
	
	$remove_breadcrumbs = get_post_meta($post->ID, 'sf_no_breadcrumbs', true);
	
	$sidebar_config = get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = strtolower(get_post_meta($post->ID, 'sf_left_sidebar', true));
	$right_sidebar = strtolower(get_post_meta($post->ID, 'sf_right_sidebar', true));
	
	if ($sidebar_config == "") {
		$sidebar_config = $default_sidebar_config;
	}
	if ($left_sidebar == "") {
		$left_sidebar = $default_left_sidebar;
	}
	if ($right_sidebar == "") {
		$right_sidebar = $default_right_sidebar;
	}
	
	$page_wrap_class = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar row';
	} else if ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars';
	} else {
	$page_wrap_class = 'has-no-sidebar';
	}
?>

<?php if (have_posts()) : the_post(); ?>
	
	<?php if ($show_page_title) { ?>	
		<div class="row">
			<div class="page-heading span12 clearfix alt-bg <?php echo $page_title_bg; ?>">
				<?php if ($page_title_one) { ?>
				<h1><?php echo $page_title_one; ?></h1>
				<?php } else { ?>
				<h1><?php the_title(); ?></h1>
				<?php } ?>
				<?php if ($page_title_one) { ?>
				<h3><?php echo $page_title_two; ?></h3>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
	
	<?php 
		// BREADCRUMBS
		if(!$remove_breadcrumbs) {	
			echo sf_breadcrumbs();
	} ?>
	
	<?php
		
		$media_type = $media_image = $media_image_alt = $media_video = $media_gallery = '';
		 
		$use_thumb_content = get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true);
		$hide_details = get_post_meta($post->ID, 'sf_hide_details', true);
		
		if ($use_thumb_content) {
		$media_type = get_post_meta($post->ID, 'sf_thumbnail_type', true);
		$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
		$media_video = get_post_meta($post->ID, 'sf_thumbnail_video_url', true);
		$media_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=thumb-image-onecol' );
		} else {
		$media_type = get_post_meta($post->ID, 'sf_detail_type', true);
		$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full');
		$media_video = get_post_meta($post->ID, 'sf_detail_video_url', true);
		$media_gallery = rwmb_meta( 'sf_detail_gallery', 'type=image&size=thumb-image-onecol' );
		$media_slider = get_post_meta($post->ID, 'sf_detail_rev_slider_alias', true);
		$custom_media = get_post_meta($post->ID, 'sf_custom_media', true);
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
			
			<img src="<?php echo $detail_image[0]; ?>" width="<?php echo $detail_image[1]; ?>" height="<?php echo $detail_image[2]; ?>" alt="<?php echo $media_image_alt; ?>" />
			
		<?php } ?>
		
	<?php } ?>
	
	</figure>
	
	<?php } ?>
		
	<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
	
		<!-- OPEN article -->
		<?php if ($sidebar_config == "left-sidebar") { ?>
		<article <?php post_class('portfolio-article clearfix span8'); ?> id="<?php the_ID(); ?>">
		<?php } elseif ($sidebar_config == "right-sidebar") { ?>
		<article <?php post_class('portfolio-article clearfix span8'); ?> id="<?php the_ID(); ?>">
		<?php } else { ?>
		<article <?php post_class('portfolio-article clearfix row'); ?> id="<?php the_ID(); ?>">
		<?php } ?>
		
		<?php if ($sidebar_config == "both-sidebars") { ?>
			<div class="page-content span6 clearfix">
		<?php } else if ($sidebar_config == "no-sidebars") { ?>
			<div class="page-content span12 clearfix">
		<?php } else { ?>
			<div class="page-content clearfix">
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
						<span class="tags-wrap"><?php _e("Category: ", "swiftframework"); ?><span class="tags"><?php echo $item_categories; ?></span></span>
						<?php if ($item_link) { ?>
						<a class="item-link" href="<?php echo $item_link; ?>" target="_blank"><?php _e("View Project", "swiftframework"); ?><i class="icon-angle-right"></i></a>
						<?php } ?>
					</div>
					
					<?php } ?>
					
					<section class="portfolio-detail-description">
						<div class="body-text clearfix">
							<?php the_content(); ?>
						</div>
					</section>
					
									
					<?php if ($show_social) { ?>
					
					<div class="share-links clearfix">
						<div class="share-text"><?php _e("Share:", "swiftframework"); ?></div>
						<div class="comments-likes">
						<?php if (function_exists( 'lip_love_it_link' )) {
							echo lip_love_it_link(get_the_ID(), '<i class="icon-heart"></i>', '<i class="icon-heart"></i>', false);
						} ?>
						</div>
						
						<div class="share-buttons">
							<span class='st_facebook_hcount' displayText='Facebook'></span>
							<span class='st_twitter_hcount' displayText='Tweet'></span>
							<span class='st_googleplus_hcount' displayText='Google +'></span>
							<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
							<span class='st_pinterest_hcount' displayText='Pinterest'></span>
						</div>
						<a class="permalink item-link" href="<?php the_permalink(); ?>"><i class="icon-link"></i></a>
						<a class="email-link item-link" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>" title="Share by Email"><i class="icon-envelope-alt"></i></a>						
					</div>
					
					<?php } ?>
					
				</section>
				
				
				<div class="pagination-wrap portfolio-pagination clearfix">
					<div class="nav-previous"><?php next_post_link(__('<i class="icon-angle-left"></i> <span class="nav-text">%link</span>', 'swiftframework'), '%title'); ?></div>
					<div class="nav-next"><?php previous_post_link(__('<span class="nav-text">%link</span><i class="icon-angle-right"></i>', 'swiftframework'), '%title'); ?></div>
				</div>
			
			</div>
			
			<?php if ($sidebar_config == "both-sidebars") { ?>
			<aside class="sidebar left-sidebar span3">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
			<?php } ?>
					
		<!-- CLOSE article -->
		</article>
		
		<?php if ($sidebar_config == "left-sidebar") { ?>
					
			<aside class="sidebar left-sidebar span4">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
	
		<?php } else if ($sidebar_config == "right-sidebar") { ?>
			
			<aside class="sidebar right-sidebar span4">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
			
		<?php } else if ($sidebar_config == "both-sidebars") { ?>
	
			<aside class="sidebar right-sidebar span3">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
		
		<?php } ?>
	
	</div>

<?php endif; ?>

<!--// WordPress Hook //-->
<?php get_footer(); ?>