<?php
$single_summary_type= get_post_meta($post->ID, MTHEME . '_post_summary_type', true);
$single_video_type= get_post_meta($post->ID, MTHEME . '_post_video_type', true);
$width=MIN_CONTENT_WIDTH;
?>
	<?php
	switch ($single_summary_type) {
	
		case "Show video":
			$single_video_code= get_post_meta($post->ID, MTHEME . '_post_video', true);
			if ($single_video_type=="Vimeo") {
				echo do_shortcode('[video type="vimeo" clip_id="' . $single_video_code . '" height="" width="' . $width . '"]');
				}
			if ($single_video_type=="Youtube") {
				echo do_shortcode('[video type="youtube" clip_id="' . $single_video_code . '" height="" width="' . $width . '"]');
			}
			break;
	
		case "Show image":
		case "":
			echo '<a class="postsummaryimage" href="'. get_permalink() .'">';
			// Show Image
				echo mtheme_display_post_image (
				$ID=get_the_id(),
				$image_url=false,
				$linked,
				$type="blog-post",
				$post->post_title,
				$class=""
				);
			echo '</a>';
			break;
		
		case "Show nivo slides":
			$nivoslider = do_shortcode('[nivoslides width="' . $width . '"]');
			echo $nivoslider;
	}
	?>
<div class="clear"></div>
<div class="postsummarywrap">
	<div class="datecomment">
		<?php
		$mtheme_datetime=of_get_option( 'mtheme_datetime');
		if ($mtheme_datetime=="Traditional") { ?>
		<span class="posted-date"><?php echo esc_attr( get_the_time() ); echo " , "; echo get_the_date(); ?></span>
		<?php } else { ?>
		<span class="posted-date"><?php echo time_since(abs(strtotime($post->post_date_gmt . " GMT")), time()); ?> ago</span>
		<?php } ?>
		<span class="comments"><?php comments_popup_link('0', '1', '%'); ?></span>
		
		<div class="postedin"><?php _e('Posted in:','mthemelocal');?> <?php the_category(', ') ?></div>
		
	</div>
</div>	
	<div class="postsummarytitle">
	<h2>
		<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
	</h2>
	</div>

	<?php
	if ( of_get_option( 'blog_list_type')=="summary" ) {
		echo '<div class="entry-content">';
		the_excerpt();
		echo '</div>';
		?>
		<div class="readmore_link">
		<a href="<?php the_permalink(); ?>"><?php echo of_get_option ( 'readmore_link' ); ?></a>
		</div>
		<?php
	} else {
		echo '<div class="entry-content">';
		the_content();
		echo '</div>';
	?>
	<div class="clear"></div>				

	<div class="postinfo">
		<p><?php the_tags( __('Tags: ','mthemelocal'), ', ', ''); ?></p>
		<p><?php _e('This entry was posted on','mthemelocal');?> <?php the_time('l, F jS, Y') ?> at <?php the_time() ?></p>
		<p><?php _e('You can follow any responses to this entry through the','mthemelocal'); ?> <?php post_comments_feed_link('RSS 2.0');?> <?php _e('feed.','mthemelocal'); ?></p>
	</div>
	<?php
	}
	?>

<div class="clear"></div>
<div class="blogseperator"></div>



