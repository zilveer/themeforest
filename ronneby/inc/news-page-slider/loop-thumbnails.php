<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (has_post_thumbnail()) {
	$thumb = get_post_thumbnail_id();
	$img_url_full = wp_get_attachment_url($thumb, 'full'); //get img URL
	$img_url = dfd_aq_resize($img_url_full, 60, 60, true, true, true);
	if(!$img_url) {
		$img_url = $img_url_full;
	}
} else {
	$img_url = get_stylesheet_directory_uri().'/assets/images/no_image_resized_120-120.jpg';
}
?>
<div class="thumbnail-item">
	<img src="<?php echo esc_url($img_url); ?>" alt="post thumb" />
</div>