<?php get_header(); ?>

<?php
	$options = get_option('sf_supreme_options');
	
	$full_width_display = get_post_meta($post->ID, 'sf_full_width_display', true);
	$review_post = get_post_meta($post->ID, 'sf_review_post', true);
	$show_author_info = get_post_meta($post->ID, 'sf_author_info', true);
    if ($show_author_info == "") {
    $show_author_info = true;
    }
	$show_social = get_post_meta($post->ID, 'sf_social_sharing', true);
    if ($show_social == "") {
    $show_social = true;
    }
	$show_related = get_post_meta($post->ID, 'sf_related_articles', true);
	if ($show_related == "") {
    $show_related = true;
    }
	
	$sidebar_config = get_post_meta($post->ID, 'sf_sidebar_config', true);
	$left_sidebar = strtolower(get_post_meta($post->ID, 'sf_left_sidebar', true));
	$right_sidebar = strtolower(get_post_meta($post->ID, 'sf_right_sidebar', true));
	
	$page_wrap_class = '';
	if ($sidebar_config == "left-sidebar") {
	$page_wrap_class = 'has-left-sidebar has-one-sidebar';
	} else if ($sidebar_config == "no-sidebars") {
	$page_wrap_class = 'has-no-sidebar';
	} else if ($sidebar_config == "both-sidebars") {
	$page_wrap_class = 'has-both-sidebars';
	} else {
	$page_wrap_class = 'has-right-sidebar has-one-sidebar';
	}
	
	if ($right_sidebar == "") {
	    $right_sidebar = "Sidebar-1";
	}
	
	$twitter_share = $options['twitter_share_username'];
	$use_disqus = $options['use_disqus'];
	$hide_title = get_post_meta($post->ID, 'sf_hide_title', true);
?>

<?php if (!$hide_title) { ?>
<div class="page-heading clearfix">

	<h1><?php the_title(); ?></h1>
	
	<?php if(function_exists('bcn_display')) { ?>	
	<div class="breadcrumbs-wrap">
		<div id="breadcrumbs">
			<?php bcn_display(); ?>
		</div>
	</div>
	<?php } ?>
	
	<div class="heading-divider"></div>
	
</div>
<?php } ?>

<?php if (have_posts()) : the_post(); ?>
	
	<?php		
		$post_author = get_the_author_link();
		$post_date = get_the_date();
		$post_categories = sf_get_custom_post_cat_list($post->ID);
		
		$media_type = $media_image = $media_video = $media_gallery = '';
				 
		$use_thumb_content = get_post_meta($post->ID, 'sf_thumbnail_content_main_detail', true);
		
		if ($use_thumb_content) {
		$media_type = get_post_meta($post->ID, 'sf_thumbnail_type', true);
		$media_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
		$media_video = get_post_meta($post->ID, 'sf_thumbnail_video_url', true);
		$media_gallery = rwmb_meta('sf_thumbnail_gallery', 'type=image&size=full-width-image-gallery');
		} else {
		$media_type = get_post_meta($post->ID, 'sf_detail_type', true);
		$media_image = rwmb_meta('sf_detail_image', 'type=image&size=full');
		$media_video = get_post_meta($post->ID, 'sf_detail_video_url', true);
		$media_gallery = rwmb_meta( 'sf_detail_gallery', 'type=image&size=full-width-image-gallery' );
		$media_slider = get_post_meta($post->ID, 'sf_detail_rev_slider_alias', true);
		$custom_media = get_post_meta($post->ID, 'sf_custom_media', true);
		}
		
		foreach ($media_image as $detail_image) {
			$media_image_url = $detail_image['url'];
			break;
		}
										
		if (!$media_image) {
			$media_image = get_post_thumbnail_id();
			$media_image_url = wp_get_attachment_url( $media_image, 'full' );
		}
		
		if (!$full_width_display && ($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar") || ($sidebar_config == "both-sidebars")) {
		$media_width = 770;
		$media_height = NULL;
		$video_height = 433;
		} else {
		$media_width = 1170;
		$media_height = NULL;
		$video_height = 658;
		}
		$figure_output = '';
		
		if ($media_type != "none") {
		
		if ($full_width_display) {
			$figure_output .= '<figure class="media-wrap full-width-detail">'."\n";
		} else {
			$figure_output .= '<figure class="media-wrap">'."\n";
		}
							
			if ($media_type == "video") {
						
				$figure_output .= video_embed($media_video, $media_width, $video_height)."\n";
						
			} else if ($media_type == "slider") {
						
				$figure_output .= '<div class="flexslider item-slider">'."\n";
				$figure_output .= '<ul class="slides">'."\n";
									
				foreach ( $media_gallery as $image ) {
					$figure_output .= "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></li>";					
				}
																		
				$figure_output .= '</ul>'."\n";
				$figure_output .= '</div>'."\n";
					
			} else if ($media_type == "layer-slider") {
						
				$figure_output .= '<div class="layerslider">'."\n";
							
				$figure_output .= do_shortcode('[rev_slider '.$media_slider.']')."\n";
						
				$figure_output .= '</div>'."\n";
						
			} else if ($media_type == "custom") {
												
				$figure_output .= $custom_media."\n";				
						
			} else {
							
				$detail_image = aq_resize( $media_image_url, $media_width, $media_height, true, false);
						
				if ($detail_image) {
					$figure_output .= '<img src="'.$detail_image[0].'" width="'.$detail_image[1].'" height="'.$detail_image[2].'" />'."\n";
				}
						
			}
					
			$figure_output .= '</figure>'."\n";
					
			}
	?>
	
	<?php if ($full_width_display) {
		echo $figure_output;
	} ?>
	
	<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
	
		<!-- OPEN article -->
		<?php if ($sidebar_config == "left-sidebar") { ?>
		<article <?php post_class('clearfix two-thirds column omega'); ?> id="<?php the_ID(); ?>">
		<?php } else if (($sidebar_config == "no-sidebars") || ($sidebar_config == "both-sidebars")) { ?>
		<article <?php post_class('clearfix'); ?> id="<?php the_ID(); ?>">
		<?php } else { ?>
		<article <?php post_class('clearfix two-thirds column alpha'); ?> id="<?php the_ID(); ?>">
		<?php } ?>
		
		<?php if ($sidebar_config == "both-sidebars") { ?>
			<section class="page-content eight columns omega clearfix">
		<?php } else { ?>
			<section class="page-content clearfix">
		<?php } ?>
		
				<?php if (!$full_width_display) {
					echo $figure_output;
				} ?>
					
				<div class="article-body-wrap">
					<div class="body-text">
						<?php the_content(); ?>
					</div>
					
					<?php if ($show_author_info) { ?>
					
					<div class="author-info-wrap clearfix">
						<div class="author-avatar"><?php if(function_exists('get_avatar')) { echo get_avatar(get_the_author_meta('ID'), '164'); } ?></div>
						<div class="post-info">
							<div class="author-name"><span><?php _e("By", "swiftframework"); ?></span><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta('display_name'); ?></a></div>
							<div class="post-date"><?php printf(__('On %1$s', 'swiftframework'), $post_date); ?></div>
							<div class="item-cats"><?php echo $post_categories; ?></div>
						</div>
						<div class="comments-likes cl-circles">
						<?php if (function_exists( 'lip_love_it_link' )) {
							echo lip_love_it_link(get_the_ID(), '<i class="icon-heart"></i>', '<i class="icon-heart"></i>', false);
						} ?>				
						<?php if ( comments_open() ) {
						if ($use_disqus) { ?>
							<div class="comment-circle"><i class="icon-comments"></i><span><?php disqus_count(); ?></span></div>
						<?php } else { ?>
							<div class="comment-circle"><i class="icon-comments"></i><span><?php comments_number('0', '1', '%'); ?></span></div>
						<?php }} ?>
						</div>
					</div>
					
					<?php } ?>
					
					<?php if ($review_post) { ?>
					
					<div class="article-review-wrap clearfix">
						
						<?php
							$review_format = "percentage";
							if (isset($options['review_format'])) {
							$review_format = $options['review_format'];
							}
							
							$review_cat1_name = get_post_meta($post->ID, 'sf_review_cat_1', true);
							$review_cat1_value = get_post_meta($post->ID, 'sf_review_cat_1_value', true);
							$review_cat2_name = get_post_meta($post->ID, 'sf_review_cat_2', true);
							$review_cat2_value = get_post_meta($post->ID, 'sf_review_cat_2_value', true);
							$review_cat3_name = get_post_meta($post->ID, 'sf_review_cat_3', true);
							$review_cat3_value = get_post_meta($post->ID, 'sf_review_cat_3_value', true);
							$review_cat4_name = get_post_meta($post->ID, 'sf_review_cat_4', true);
							$review_cat4_value = get_post_meta($post->ID, 'sf_review_cat_4_value', true);
							$review_summary = get_post_meta($post->ID, 'sf_review_summary', true);
							
							$review_cat1_width = $review_cat2_width = $review_cat3_width = $review_cat4_width = "";
							
							$values_array = array();
							
							if ($review_cat1_name != "") {
							array_push($values_array, $review_cat1_value);
							$review_cat1_width = sf_review_barpercent($review_cat1_value, $review_format);
							}
							if ($review_cat2_name != "") {
							array_push($values_array, $review_cat2_value);
							$review_cat2_width = sf_review_barpercent($review_cat2_value, $review_format);
							}
							if ($review_cat3_name != "") {
							array_push($values_array, $review_cat3_value);
							$review_cat3_width = sf_review_barpercent($review_cat3_value, $review_format);
							}
							if ($review_cat4_name != "") {
							array_push($values_array, $review_cat4_value);
							$review_cat4_width = sf_review_barpercent($review_cat4_value, $review_format);
							}
							
							$review_overall = sf_review_overall($values_array);
						?>
						
						<h3><?php _e("Review", "swiftframework"); ?></h3>
						
						<?php if ($review_cat1_name != "") { ?>
						<div class="review-bar">
						  <div class="bar" style="width: <?php echo $review_cat1_width; ?>%;">
						  	<div class="bar-text" style="display: block;"><?php echo $review_cat1_name; ?><span><?php echo $review_cat1_value; ?></span></div>
						  </div>
						</div>
						<?php } ?>
						<?php if ($review_cat2_name != "") { ?>
						<div class="review-bar">
						  <div class="bar" style="width: <?php echo $review_cat2_width; ?>%;">
						  	<div class="bar-text" style="display: block;"><?php echo $review_cat2_name; ?><span><?php echo $review_cat2_value; ?></span></div>
						  </div>
						</div>
						<?php } ?>
						<?php if ($review_cat3_name != "") { ?>
						<div class="review-bar">
						  <div class="bar" style="width: <?php echo $review_cat3_width; ?>%;">
						  	<div class="bar-text" style="display: block;"><?php echo $review_cat3_name; ?><span><?php echo $review_cat3_value; ?></span></div>
						  </div>
						</div>
						<?php } ?>
						<?php if ($review_cat4_name != "") { ?>
						<div class="review-bar">
						  <div class="bar" style="width: <?php echo $review_cat4_width; ?>%;">
						  	<div class="bar-text" style="display: block;"><?php echo $review_cat4_name; ?><span><?php echo $review_cat4_value; ?></span></div>
						  </div>
						</div>
						<?php } ?>
						
						<div class="review-overview-wrap clearfix">
							<div class="overview-circle">
								<span class="overview-text"><?php _e("Overall", "swiftframework"); ?></span>
								<?php if ($review_format == "percentage") { ?>
								<span class="overview-score"><?php echo $review_overall; ?>%</span>
								<?php } else { ?>
								<span class="overview-score score-pts"><?php echo $review_overall; ?></span>
								<?php } ?>
							</div>
							<p><?php echo $review_summary; ?></p>
						</div>
					</div>
					
					<?php } ?>
						
					<?php if (has_tag()) { ?>				
					<div class="tags-link-wrap clearfix">
						
						<div class="tags-wrap"><?php _e("Tags:", "swiftframework"); ?><span class="tags"><?php the_tags(''); ?></span></div>
						
					</div>
					<?php } ?>
					
					<?php if ($show_social) { ?>
					
					<div class="share-links clearfix">
						<div class="share-text"><?php _e("Share:", "swiftframework"); ?></div>
						<div class="share-buttons">
							<span class='st_facebook_hcount' displayText='Facebook'></span>
							<span class='st_twitter_hcount' st_via='<?php echo $twitter_share; ?>' st_username='<?php echo $twitter_share; ?>' displayText='Tweet'></span>
							<span class='st_googleplus_hcount' displayText='Google +'></span>
							<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
							<span class='st_pinterest_hcount' displayText='Pinterest'></span>
						</div>
						<a class="permalink item-link" href="<?php the_permalink(); ?>"><i class="icon-link"></i><?php _e("Permanent Link", "swiftframework"); ?></a>
						<a class="email-link item-link" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>" title="Share by Email"><i class="icon-envelope-alt"></i><?php _e("Share via Email", "swiftframework"); ?></a>						
					</div>
					
					<?php } ?>
					
				</div>
				
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
						_e("<h3>Related Articles</h3>", "swiftframework");
						echo '<ul class="related-items clearfix">';
						while ($related_posts_query->have_posts()) {
							$related_posts_query->the_post();
							$thumb_image = "";
							$thumb_image = get_post_meta($post->ID, 'sf_thumbnail_image', true);
							if (!$thumb_image) {
								$thumb_image = get_post_thumbnail_id();
							}
							$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
							$image = aq_resize( $thumb_img_url, 220, 152, true, false);
							?>
							<li class="related-item clearfix four columns">
								<figure>
									<a href="<?php the_permalink(); ?>">
										<div class="overlay"><div class="thumb-info">
											<i class="icon-file-alt"></i>
										</div></div>
										<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" />
									</a>
								</figure>
								<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							</li>
						<?php }
						echo '</ul>';
					}
												
					wp_reset_query();
				?>
				</div>
				
				<?php } ?>
				
				<div class="pagination-wrap blog-pagination clearfix">
					<div class="nav-previous"><?php next_post_link('%link', __('<i class="icon-chevron-left"></i> <span class="nav-text">%title</span>', 'swiftframework'), FALSE); ?></div>
					<div class="nav-next"><?php previous_post_link('%link', __('<span class="nav-text">%title</span><i class="icon-chevron-right"></i>', 'swiftframework'), FALSE); ?></div>
				</div>
				
				<?php if ( comments_open() ) { ?>
				<div id="comment-area">
					<?php
					if ($use_disqus) {
					    disqus_embed();
					} else {
						comments_template('', true);
					}
					?>
				</div>
				<?php } ?>
			
			</section>
			
			<?php if ($sidebar_config == "both-sidebars") { ?>
			<aside class="sidebar left-sidebar four columns alpha">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
			<?php } ?>
		
		<!-- CLOSE article -->
		</article>
	
		<?php if ($sidebar_config == "left-sidebar") { ?>
					
			<aside class="sidebar left-sidebar one-third column alpha">
				<?php dynamic_sidebar($left_sidebar); ?>
			</aside>
			
		<?php } else if ($sidebar_config == "both-sidebars") { ?>
	
			<aside class="sidebar right-sidebar four columns omega">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
			
		<?php } else if ($sidebar_config != "no-sidebars") { ?>
			
			<aside class="sidebar right-sidebar one-third column omega">
				<?php dynamic_sidebar($right_sidebar); ?>
			</aside>
		
		<?php } ?>
				
	</div>

<?php endif; ?>

<!-- WordPress Hook -->
<?php get_footer(); ?>