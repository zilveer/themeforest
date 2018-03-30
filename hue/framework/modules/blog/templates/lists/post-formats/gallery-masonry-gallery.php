<?php
$id = get_the_ID();
$image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'large');
$image_gallery = get_post_meta($id, 'mkd_post_gallery_images_meta', true);
$gallery_urls = array();
if ($image_gallery != '') {
	$image_gallery_array = explode(',', $image_gallery);
	foreach ($image_gallery_array as $pic_id) {
		$temp = wp_get_attachment_image_src($pic_id, $image_size);
		$gallery_urls[] = $temp[0];
	}
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<?php if (!empty($gallery_urls)) { ?>
		<div class="mkd-blog-gallery mkd-owl-slider">
			<?php
			foreach ($gallery_urls as $pic_url): ?>
				<div class="mkd-blog-gallery-item" style="background-image:url('<?php echo esc_url($pic_url); ?>');">
					<a href="<?php the_permalink(); ?>"></a>
				</div>
			<?php endforeach; ?>
		</div>
	<?php } ?>
</article>