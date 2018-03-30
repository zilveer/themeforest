<?php get_header(); ?>

<?php
	$options = get_option('sf_pinpoint_options');
	$page_layout = $options['page_layout'];
	$blog_page = __($options['blog_page'], 'swiftframework');
	if ($blog_page) {
	$blog_page_title = get_page_by_path( $blog_page );
		if (isset($blog_page_title)) {
			$blog_page_id = $blog_page_title->ID;
		}
	}
	
	$show_author_info = get_post_meta($post->ID, 'sf_author_info', true);
	$show_social = get_post_meta($post->ID, 'sf_social_sharing', true);
	$show_related =  get_post_meta($post->ID, 'sf_related_articles', true);
	
	$sidebar_config = get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = strtolower(get_post_meta($post->ID, 'sf_left_sidebar', true));
	$right_sidebar = strtolower(get_post_meta($post->ID, 'sf_right_sidebar', true));
	
	$page_wrap_class = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar';
	} elseif ($sidebar_config == "right-sidebar") {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar';
	} elseif ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars';
	} else {
	$page_wrap_class = 'has-no-sidebar';
	}
	
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
	
	
	<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
	
		<!-- OPEN article -->
		<?php if ($sidebar_config == "left-sidebar") { ?>
		<article <?php post_class('clearfix eleven columns omega'); ?> id="<?php the_ID(); ?>">
		<?php } elseif ($sidebar_config == "right-sidebar") { ?>
		<article <?php post_class('clearfix eleven columns alpha'); ?> id="<?php the_ID(); ?>">
		<?php } else { ?>
		<article <?php post_class('clearfix'); ?> id="<?php the_ID(); ?>">
		<?php } ?>
		
		<?php if ($sidebar_config == "both-sidebars") { ?>
			<div class="page-content eight columns omega clearfix">
		<?php } else { ?>
			<div class="page-content clearfix">
		<?php } ?>
		
				<?php
				
					$post_author = get_the_author_link();
					$post_date = get_the_date();
					$post_categories = get_the_category_list(', ');
					$post_comments = get_comments_number();
					
					$media_type = $media_image = $media_video = $media_gallery = '';
					
					$hide_details = get_post_meta($post->ID, 'sf_hide_details', true);
					 
					$use_thumb_content = get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true);
					
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
						break;
					}
													
					if (!$media_image) {
						$media_image = get_post_thumbnail_id();
						$media_image_url = wp_get_attachment_url( $media_image, 'full' );
					}
					
					if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar") || ($sidebar_config == "both-sidebars")) {
					$media_width = 640;
					$media_height = NULL;
					$video_height = 360;
					} else {
					$media_width = 940;
					$media_height = NULL;
					$video_height = 530;;
					}
				?>
				
				<?php if (!$hide_details) { ?>
			
				<div class="blog-item-details clearfix">
					<?php printf(__('By %1$s on %2$s in %3$s', 'swiftframework'), $post_author, $post_date, $post_categories); ?>
					<div class="comments-likes">
						<?php if ( comments_open() ) { ?>
						<i class="icon-comments"></i><?php echo $post_comments; ?>
						<?php } ?>
						<?php if (function_exists( 'lip_love_it_link' )) {
							echo lip_love_it_link(get_the_ID(), '<i class="icon-heart"></i>', '<i class="icon-heart"></i>');
						} ?>
					</div>
				</div>
				
				<?php } ?>
				
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
						<img src="<?php echo $detail_image[0]; ?>" width="<?php echo $detail_image[1]; ?>" height="<?php echo $detail_image[2]; ?>" />
					<?php } ?>
					
				<?php } ?>
				
				</figure>
				
				<?php } ?>
					
				<section class="article-body-wrap">
					<div class="body-text">
						<?php the_content(); ?>
					</div>
					
					<?php if ($show_author_info) { ?>
					
					<div class="author-info-wrap clearfix">
						<div class="author-avatar"><?php if(function_exists('get_avatar')) { echo get_avatar(get_the_author_meta('ID'), '75'); } ?></div>
						<div class="author-info">
							<h2><?php _e("About the Author", "swiftframework"); ?></h2>
							<span class="author-name"><?php the_author_meta('display_name'); ?></span><a class="read-more" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php _e("View all posts by", "swiftframework"); ?> <?php the_author_meta('display_name'); ?> <i class="icon-chevron-right"></i></a>
							<div class="author-bio"><?php echo get_the_author_meta('description'); ?></div>
						</div>
					</div>
					
					<?php } ?>
					
					<?php if ($show_social) { ?>
					
					<div class="share-links">
						<div class="share-text"><i class="icon-share"></i><?php _e("Share:", "swiftframework"); ?></div>
						<div class="share-buttons">
							<span class='st_facebook_hcount' displayText='Facebook'></span>
							<span class='st_twitter_hcount' displayText='Tweet'></span>
							<span class='st_googleplus_hcount' displayText='Google +'></span>
							<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
							<span class='st_pinterest_hcount' displayText='Pinterest'></span>
						</div>
					</div>
					
					<?php } ?>
					
					<div class="tags-link-wrap clearfix">
						<?php if (has_tag()) { ?>
						<div class="tags-wrap">
							<i class="icon-tags"></i><?php _e("Tags:", "swiftframework"); ?>
							<span class="tags"><?php the_tags(''); ?></span>
						</div>
						<?php } ?>
						<a class="permalink item-link" href="<?php the_permalink(); ?>"><i class="icon-link"></i><?php _e("Permanent Link", "swiftframework"); ?></a>
					</div>
					
				</section>
				
				<?php if ($show_related) { ?>
				
				<div class="related-wrap">
				<?php
					$categories = get_the_category($post->ID);
					if ($categories) {
						$category_ids = array();
						foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	
						$args=array(
							'category__in' => $category_ids,
							'post__not_in' => array($post->ID),
							'showposts'=> 4, // Number of related posts that will be shown.
							'orderby' => 'rand'
						);
					}
					$related_posts_query = new wp_query($args);
					if( $related_posts_query->have_posts() ) {
						_e("<h2>Related Articles</h2>", "swiftframework");
						echo '<ul class="related-items clearfix">';
						while ($related_posts_query->have_posts()) {
							$related_posts_query->the_post();
							$thumb_image = "";
							$thumb_image = get_post_meta($post->ID, 'sf_thumbnail_image', true);
							if (!$thumb_image) {
								$thumb_image = get_post_thumbnail_id();
							}
							$post_comments = get_comments_number();
							$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
							$image = aq_resize( $thumb_img_url, 220, 152, true, false);
							?>
							<li class="related-item clearfix four columns">
								<figure>
									<a href="<?php the_permalink(); ?>">
										<div class="overlay"><div class="thumb-info">
										<?php if ( comments_open() ) { ?>
										<div class="overlay-comments"><i class="icon-comment"></i><span><?php echo $post_comments ?></span></div>
										<?php } ?>
										<?php if (function_exists( 'lip_love_it_nolink' )) {
											lip_love_it_nolink($post->ID, '<i class="icon-heart"></i>', '<i class="icon-heart"></i>', false);
										} ?>
										</div></div>
										<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" />
									</a>
									<figcaption><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></figcaption>
								</figure>
							</li>
						<?php }
						echo '</ul>';
					}
												
					wp_reset_query();
				?>
				</div>
				
				<?php } ?>
				
				<?php if ( comments_open() ) { ?>
				<div id="comment-area">
					<?php comments_template('', true); ?>
				</div>
				<?php } ?>
				
				<div class="pagination-wrap blog-pagination full-width clearfix">
					<div class="nav-previous"><?php next_post_link('%link', __('<i class="icon-chevron-left"></i> <span class="nav-text">%title</span>', 'swiftframework'), FALSE); ?></div>
					<div class="nav-index"><?php if ($blog_page && isset($blog_page_title)) { ?><a href="<?php echo get_permalink( $blog_page_id ); ?>"><?php _e('<span><i class="icon-list"></i> </span><span class="nav-text">Index</span>', 'swiftframework'); ?></a><?php } ?></div>
					<div class="nav-next"><?php previous_post_link('%link', __('<span class="nav-text">%title</span><i class="icon-chevron-right"></i>', 'swiftframework'), FALSE); ?></div>
				</div>
			
			</div>
			
			<?php if ($sidebar_config == "both-sidebars") { ?>
			<aside class="sidebar left-sidebar four columns alpha">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
			<?php } ?>
		
		<!-- CLOSE article -->
		</article>
	
		<?php if ($sidebar_config == "left-sidebar") { ?>
				
			<aside class="sidebar left-sidebar five columns alpha">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
	
		<?php } else if ($sidebar_config == "right-sidebar") { ?>
			
			<aside class="sidebar right-sidebar five columns omega">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
			
		<?php } else if ($sidebar_config == "both-sidebars") { ?>
	
			<aside class="sidebar right-sidebar four columns omega">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
		
		<?php } ?>
				
	</div>
	
	<?php if ($page_layout == "fullwidth") { ?>
	</div>
	</div>
	<?php } ?>

<?php endif; ?>

<!-- WordPress Hook -->
<?php get_footer(); ?>