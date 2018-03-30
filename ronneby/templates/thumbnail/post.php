<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $save_image_ratio, $dfd_ronneby;

if (has_post_thumbnail()) {
	if (!isset($dfd_ronneby['thumb_image_crop']) || !$dfd_ronneby['thumb_image_crop']) {
		$image_crop = true;
	} else {
		$image_crop = $dfd_ronneby['thumb_image_crop'];
	}
	
	$thumb = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
	
	if (isset($dfd_ronneby['post_thumbnails_width']) && $dfd_ronneby['post_thumbnails_width'] && isset($dfd_ronneby['post_thumbnails_height']) && $dfd_ronneby['post_thumbnails_height']) {
		$width = $dfd_ronneby['post_thumbnails_width'];
		$height = $dfd_ronneby['post_thumbnails_height'];
	} else {
		$width = 900;
		$height = 400;
	}
	
	if ($save_image_ratio) {
		$height = null;
	}
	
	$article_image = dfd_aq_resize($img_url, $width, $height, $image_crop, true, true);
	if(!$article_image) {
		$article_image = $img_url;
	}
?>
	<div class="entry-thumb">
		<img src="<?php echo esc_url($article_image); ?>" alt="<?php the_title(); ?>"/>
		<div class="post-comments-wrap">
			<?php get_template_part('templates/entry-meta/mini', 'comments-number'); ?>
		</div>
		<div class="post-like-wrap">
			<?php get_template_part('templates/entry-meta/mini', 'like'); ?>
        </div>
	</div>
<?php
}