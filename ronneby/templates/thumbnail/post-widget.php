<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (has_post_thumbnail()) {
	$thumbnail_size = array(80, 80);
	$thumb_img = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url($thumb_img, 'thumb'); //get img URL
	$article_image = dfd_aq_resize($img_url, $thumbnail_size[0], $thumbnail_size[1], true, true, true);
	if(!$article_image) {
		$article_image = $img_url;
	}
	echo '<img src="'. esc_url($article_image) .'" alt="'. esc_attr(get_the_title()) .'" />';
} else {
	get_template_part('templates/entry-meta/post-format-icon');
}
?>