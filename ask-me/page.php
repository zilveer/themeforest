<?php get_header();
	$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
	$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
	$vbegy_sidebar = rwmb_meta('vbegy_sidebar','select',$post->ID);
	if ($vbegy_sidebar == "default") {
		$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	}else {
		$vbegy_sidebar_all = $vbegy_sidebar;
	}
	$vbegy_google = rwmb_meta('vbegy_google',"textarea",$post->ID);
	$video_id = rwmb_meta('vbegy_video_post_id',"select",$post->ID);
	$video_type = rwmb_meta('vbegy_video_post_type',"text",$post->ID);
	$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);
	if ($video_type == 'youtube') {
		$type = "http://www.youtube.com/embed/".$video_id;
	}else if ($video_type == 'vimeo') {
		$type = "http://player.vimeo.com/video/".$video_id;
	}else if ($video_type == 'daily') {
		$type = "http://www.dailymotion.com/swf/video/".$video_id;
	}
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
		$post_meta_s = rwmb_meta('vbegy_post_meta_s','checkbox',$post->ID);
		$post_comments_s = rwmb_meta('vbegy_post_comments_s','checkbox',$post->ID);?>
		<article <?php post_class('post single-post');?> id="post-<?php the_ID();?>">
			<div class="post-inner">
				<div class="post-img<?php if (($vbegy_what_post == "image" && !has_post_thumbnail()) || !has_post_thumbnail()) {echo " post-img-0";}else if ($vbegy_what_post == "video") {echo " video_embed";}if ($vbegy_sidebar_all == "full") {echo " post-img-12";}else {echo " post-img-9";}?>">
					<?php include (get_template_directory() . '/includes/head.php');?>
				</div>
	        	<h2 class="post-title"><?php the_title()?></h2>
				<?php $posts_meta = vpanel_options("post_meta");
				if (($posts_meta == 1 && $post_meta_s == "") || ($posts_meta == 1 && isset($custom_page_setting) && $custom_page_setting == 0) || ($posts_meta == 1 && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s == 1)) {?>
					<div class="post-meta">
					    <span class="meta-author"><i class="icon-user"></i><?php the_author_posts_link();?></span>
					    <span class="meta-date"><i class="fa fa-calendar"></i><?php the_time($date_format);?></span>
					    <span class="meta-comment"><i class="fa fa-comments-o"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></span>
					    <span class="post-view"><i class="icon-eye-open"></i><?php $post_stats = get_post_meta($post->ID, 'post_stats', true);echo ($post_stats != ""?$post_stats:0);?> <?php _e("views","vbegy");?></span>
					</div>
				<?php }?>
				<div class="post-content">
					<?php the_content();?>
					<div class="clearfix"></div>
				</div>
			</div><!-- End post-inner -->
		</article><!-- End article.post -->
		<?php $post_comments = vpanel_options("post_comments");
		if (($post_comments == 1 && $post_comments_s == "") || ($post_comments == 1 && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_comments == 1 && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_comments_s) && $post_comments_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_comments_s) && $post_comments_s == 1)) {
			comments_template();
		}
	endwhile; endif;
get_footer();?>