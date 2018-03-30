<?php $imageUrl = '';
$width = 600;
$height = 1000; ?>

<?php if (has_post_thumbnail(get_the_ID())): ?>
	<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array($width, $height)); ?>
	<?php $imageUrl = $image[0]; ?>
<?php endif; ?>
<?php echo do_shortcode('[img src="' . $imageUrl . '" width="' . $width . '" height="' . $height . '"]') ?>