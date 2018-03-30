<?php $imageUrl = '';
$width = 600;
$height = 1000;
$args = array(
	'post_type' => 'attachment',
	'numberposts' => -1,
	'post_status' => null,
	'post_parent' => get_the_ID()
);

$attachments = get_posts($args);
$code = '[flex_slider fullheight="false"]'
?>

<?php if ($attachments): ?>
	<?php foreach ($attachments as $attach): ?>
		<?php $image = wp_get_attachment_image_src($attach->ID, 'full'); ?>
		<?php $imageUrl = $image[0]; ?>
		<?php $code .= ('[flex_slider_item imgsrc="' . $imageUrl . '"]') ?>
	<?php endforeach; ?>
<?php endif;

$code .= "[/flex_slider]";

echo do_shortcode($code)?>