<?php
	
	$options = get_option('sf_pinpoint_options');
	$blog_type = $options['archive_display_type'];
	
	$post_title = get_the_title();
	$post_author = get_the_author_link();
	$post_date = get_the_date();
	$post_categories = get_the_category_list(', ');
	$post_comments = get_comments_number();
	$post_permalink = get_permalink();
	$custom_excerpt = get_post_meta($post->ID, 'sf_custom_excerpt', true);
	$post_excerpt = '';
	if ($custom_excerpt != '') {
	$post_excerpt = $custom_excerpt;
	} else {
	$post_excerpt = get_the_excerpt();
	}
	$post_content = get_the_content();
		
	$thumb_image = $thumb_width = $thumb_height = $bordered_thumb_width = $bordered_thumb_height = $video = $video_height = $bordered_video_height = $item_class = $link_config = $item_icon = '';
	
	if ($blog_type == "mini") {
		$thumb_width = 446;
		$thumb_height = NULL;
		$video_height = 250;
	} else {
		$thumb_width = 640;
		$thumb_height = NULL;
		$video_height = 360;
		$bordered_thumb_width = 408;
		$bordered_thumb_height = 303;
		$bordered_video_height = 303;
	}
	
	$thumb_type = get_post_meta($post->ID, 'sf_thumbnail_type', true);
	$thumb_image = rwmb_meta('sf_thumbnail_image', 'type=image&size=full');
	$thumb_video = get_post_meta($post->ID, 'sf_thumbnail_video_url', true);
	$thumb_gallery = rwmb_meta( 'sf_thumbnail_gallery', 'type=image&size=blog-image' );
	$thumb_link_type = get_post_meta($post->ID, 'sf_thumbnail_link_type', true);
	$thumb_link_url = get_post_meta($post->ID, 'sf_thumbnail_link_url', true);
	$thumb_lightbox_thumb = rwmb_meta( 'sf_thumbnail_image', 'type=image&size=large' );
	$thumb_lightbox_image = rwmb_meta( 'sf_thumbnail_link_image', 'type=image&size=large' );
	$thumb_lightbox_video_url = get_post_meta($post->ID, 'sf_thumbnail_link_video_url', true);
	
	foreach ($thumb_image as $detail_image) {
		$thumb_img_url = $detail_image['url'];
		break;
	}
									
	if (!$thumb_image) {
		$thumb_image = get_post_thumbnail_id();
		$thumb_img_url = wp_get_attachment_url( $thumb_image, 'full' );
	}

	$thumb_lightbox_img_url = wp_get_attachment_url( $thumb_lightbox_image, 'full' );
	
	$item_figure = $link_config = "";
	
	// LINK TYPE VARIABLES			
	if ($thumb_link_type == "link_to_url") {
		$link_config = 'href="'.$thumb_link_url.'" class="link-to-url"';
		$item_icon = "link";
	} else if ($thumb_link_type == "link_to_url_nw") {
		$link_config = 'href="'.$thumb_link_url.'" class="link-to-url" target="_blank"';
		$item_icon = "link";
	} else if ($thumb_link_type == "lightbox_thumb") {
		$link_config = 'href="'.$thumb_img_url.'" class="view"';
		$item_icon = "search";
	} else if ($thumb_link_type == "lightbox_image") {
		$lightbox_image_url = '';
		foreach ($thumb_lightbox_image as $image) {
			$lightbox_image_url = $image['full_url'];
		}
		$link_config = 'href="'.$lightbox_image_url.'" class="view"';
		$item_icon = "search";	
	} else if ($thumb_link_type == "lightbox_video") {
		$link_config = 'href="'.$thumb_lightbox_video_url.'" class="fancybox-media"';
		$item_icon = "facetime-video";
	} else {
		$link_config = 'href="'.$post_permalink.'" class="link-to-post"';
		$item_icon = "file-alt";
	}	
	
	// THUMBNAIL MEDIA TYPE SETUP
	
	if ($thumb_type != "none") {

		$item_figure .= '<figure>';
						
		if ($thumb_type == "video") {
			
			$video = video_embed($thumb_video, $thumb_width, $video_height);
			
			$item_figure .= $video;
			
		} else if ($thumb_type == "slider") {
			
			$item_figure .= '<div class="flexslider thumb-slider"><ul class="slides">';
						
			foreach ( $thumb_gallery as $image )
			{
			    $item_figure .= "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></li>";
			}
															
			$item_figure .= '</ul><div class="open-item"><a '.$link_config.'><i class="icon-plus"></i></a></div></div>';
			
		} else {
		
			$image = aq_resize( $thumb_img_url, $thumb_width, $thumb_height, true, false);
			
			if ($image) {
				
				$item_figure .= '<a '.$link_config.'>';
				
				if ($blog_type == "masonry") { 
				
				$item_figure .= '<div class="overlay"><div class="thumb-info">';
				$item_figure .= '<i class="icon-'.$item_icon.'"></i>';
				$item_figure .= '</div></div>';
				
				}
				
				$item_figure .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" />';
							
				$item_figure .= '</a>';
			}
		}
	
	$item_figure .= '</figure>';
	
	}
	
?>

<?php if ($blog_type == "masonry") { ?>
<?php echo $item_figure; ?>
<?php } ?>
<div class="blog-details-wrap">
	<?php if ($blog_type == "masonry") { ?>
	<h4><a href="<?php echo $post_permalink; ?>"><?php echo $post_title; ?></a></h4>
	<?php } else { ?>
	<h2><a href="<?php echo $post_permalink; ?>"><?php echo $post_title; ?></a></h2>
	<?php } ?>
	<div class="blog-item-details clearfix"><?php printf(__('By <a href="%2$s">%1$s</a> on %3$s', 'swiftframework'), $post_author, get_author_posts_url(get_the_author_meta( 'ID' )), $post_date); ?>
	<div class="comments-likes">
		<a href="<?php echo $post_permalink; ?>#comment-area"><i class="icon-comments"<i class="icon-comments"></i><span><?php echo $post_comments; ?></span></a>
		<?php if (function_exists( 'lip_love_it_link' )) {
			echo lip_love_it_link(get_the_ID(), '<i class="icon-heart"></i>', '<i class="icon-heart"></i>');
		} ?>
	</div>
	</div>
	<?php if ($blog_type != "masonry") { ?>
	<?php echo $item_figure; ?>
	<?php } ?>
	<div class="excerpt"><?php echo $post_excerpt; ?></div>
	<div class="read-more-bar">
		<a class="read-more" href="<?php echo $post_permalink; ?>"><?php _e("Read more", "swiftframework"); ?><i class="icon-chevron-right"></i></a>
	</div>
</div>