<?php 
global $blog_style,$vbegy_sidebar_all,$authordata;
$posts_meta = vpanel_options("post_meta");
$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
$post_excerpt = (isset($post_excerpt) && $post_excerpt != ""?$post_excerpt:40);
$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
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
if (isset($k) && $k == vpanel_options("between_questions_position")) {
	$between_adv_type = vpanel_options("between_adv_type");
	$between_adv_code = vpanel_options("between_adv_code");
	$between_adv_href = vpanel_options("between_adv_href");
	$between_adv_img = vpanel_options("between_adv_img");
	if (($between_adv_type == "display_code" && $between_adv_code != "") || ($between_adv_type == "custom_image" && $between_adv_img != "")) {
		echo '<div class="clearfix"></div>
		<div class="advertising">';
		if ($between_adv_type == "display_code") {
			echo stripcslashes($between_adv_code);
		}else {
			if ($between_adv_href != "") {
				echo '<a target="_blank" href="'.$between_adv_href.'">';
			}
			echo '<img alt="" src="'.$between_adv_img.'">';
			if ($between_adv_href != "") {
				echo '</a>';
			}
		}
		echo '</div><!-- End advertising -->
		<div class="clearfix"></div>';
	}
}?>
<article <?php post_class('post  clearfix '.($blog_style == "blog_2"?"blog_2":"").(is_sticky()?" sticky_post":""));?> role="article" itemtype="http://schema.org/Article">
	<div class="post-inner">
		<?php if ($blog_style != "blog_2") {?>
			<div class="post-img<?php if ($vbegy_what_post == "video") {echo " video_embed";}else if ($vbegy_what_post == "lightbox") {echo " post-img-lightbox";}else if ($vbegy_what_post == "google") {echo " map_embed";}else if (($vbegy_what_post == "image" && !has_post_thumbnail()) || !has_post_thumbnail()) {echo " post-img-0";}if ($vbegy_sidebar_all == "full") {echo " post-img-12";}else {echo " post-img-9";}?>">
				<?php if (has_post_thumbnail() && $vbegy_what_post == "image") {?><a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php }
					include (get_template_directory() . '/includes/head.php');?>
				<?php if (has_post_thumbnail()) {?></a><?php }?>
			</div>
        <?php }?>
        <h2 itemprop="name" class="post-title">
        	<?php if ($vbegy_what_post == "lightbox") {?>
        		<span class="post-type"><i class="icon-zoom-in"></i></span>
        	<?php }else if ($vbegy_what_post == "google") {?>
        		<span class="post-type"><i class="icon-map-marker"></i></span>
        	<?php }else if ($vbegy_what_post == "video") {?>
        		<span class="post-type"><i class="icon-play-circle"></i></span>
        	<?php }else if ($vbegy_what_post == "slideshow") {?>
        		<span class="post-type"><i class="icon-film"></i></span>
        	<?php }else {
        		if (has_post_thumbnail()) {?>
    	        	<span class="post-type"><i class="icon-picture"></i></span>
        		<?php }else {?>
    	        	<span class="post-type"><i class="icon-file-alt"></i></span>
        		<?php }
        	}?>
        	<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title();?></a>
        </h2>
        <?php
        if ($blog_style == "blog_2") {?>
	        <div class="post-img<?php if ($vbegy_what_post == "image" && !has_post_thumbnail()) {echo " post-img-0";}else if ($vbegy_what_post == "lightbox") {echo " post-img-lightbox";}else if ($vbegy_what_post == "video") {echo " video_embed";}else if ($vbegy_what_post == "google") {echo " map_embed";}if ($vbegy_sidebar_all == "full") {echo " post-img-12";}else {echo " post-img-9";}?>">
	        	<?php if (has_post_thumbnail() && $vbegy_what_post == "image") {?><a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php }
	        		include (get_template_directory() . '/includes/head.php');?>
	        	<?php if (has_post_thumbnail()) {?></a><?php }?>
	        </div>
        <?php }
        if ($posts_meta == 1) {
        	$post_username = get_post_meta($post->ID, 'post_username',true);
        	$post_email = get_post_meta($post->ID, 'post_email',true);?>
        	<div class="post-meta">
        	    <span class="meta-author" itemprop="author" rel="author"><i class="icon-user"></i>
        	    	<?php 
        	    	if ($post->post_author > 0) {?>
        	    		<a href="<?php echo vpanel_get_user_url($authordata->ID);?>" title="<?php the_author();?>"><?php the_author();?></a>
        	    	<?php }else {
        	    		echo ($post_username);
        	    	}
        	    	?>
        	    </span>
        	    <?php if (isset($authordata->ID) && $authordata->ID > 0) {
        	    	echo vpanel_get_badge($authordata->ID);
        	    }?>
        	    <span class="meta-date" datetime="<?php the_time('c'); ?>" itemprop="datePublished"><i class="fa fa-calendar"></i><?php the_time($date_format);?></span>
        	    <?php if (!is_page()) {?>
	        	    <span class="meta-categories"><i class="icon-suitcase"></i><?php the_category(' , ');?></span>
        	    <?php }?>
        	    <span class="meta-comment"><i class="fa fa-comments-o"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></span>
        	    <meta itemprop="interactionCount" content="<?php comments_number( 'UserComments: 0', 'UserComments: 1', 'UserComments: %' ); ?>">
        	    <span class="post-view"><i class="icon-eye-open"></i><?php $post_stats = get_post_meta($post->ID, 'post_stats', true);echo ($post_stats != ""?$post_stats:0);?> <?php _e("views","vbegy");?></span>
        	</div>
        <?php }?>
        <div class="post-content">
            <p><?php if ($blog_style == "blog_2") {excerpt($post_excerpt);}else {excerpt($post_excerpt);}?></p>
            <a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark" class="post-read-more button color small"><?php _e("Continue reading","vbegy");?></a>
        </div><!-- End post-content -->
    </div><!-- End post-inner -->
</article><!-- End article.post -->