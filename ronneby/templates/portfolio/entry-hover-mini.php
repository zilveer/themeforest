<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	if (has_post_thumbnail()) {
		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url($thumb, 'full');
	} else {
		$img_url = get_template_directory_uri() . '/img/no-image-large.jpg';
	}
	
	$_folio_id = get_the_ID();
	
	# Extract gallery images
	$gallery_id = uniqid($_folio_id);

	if (metadata_exists('post', $_folio_id, '_my_product_image_gallery')) {
		$my_product_image_gallery = get_post_meta($_folio_id, '_my_product_image_gallery', true);
	} else {
		// Backwards compat
		$attachment_ids = get_posts('post_parent=' . $_folio_id . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
		$attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
		$my_product_image_gallery = implode(',', $attachment_ids);
	}

	$attachments = array_filter(explode(',', $my_product_image_gallery));
	
	$client_site = get_post_meta(get_the_ID(), 'folio_client_site', true);
	if(empty($client_site)) {
		$client_site = get_permalink();
	}
?>
<div class="portfolio-entry-hover mini">
	<a class="custom-link" href="<?php echo esc_url($client_site); ?>">
		<i class="infinityicon-file"></i>
	</a>
	<a class="open-post" href="<?php the_permalink(); ?>">
		<i class="infinityicon-paperclip"></i>
	</a>
	<a data-rel="prettyPhoto[<?php echo esc_attr($gallery_id); ?>]" class="zoom-post" href="<?php echo esc_url($img_url); ?>">
		<i class="infinityicon-search"></i>
	</a>
	<div class="entry-share-clickable">
		<a href="#"><i class="infinityicon-heart"></i></a>
	</div>
</div>

<?php get_template_part('templates/entry-meta/folio', 'loop-share'); ?>

<?php if (!empty($attachments)): ?>
<div class="hide">
<?php
	foreach ($attachments as $attachment_id) {
		$image_src = wp_get_attachment_image_src($attachment_id, 'full');
		if (empty($image_src[0])) {
			continue;
		}
		$attachment_img_url = $image_src[0];

		if (strcmp($attachment_img_url, $img_url)===0) {
			continue;
		}

		echo '<a href="'. esc_url($attachment_img_url) .'" data-rel="prettyPhoto['. esc_attr($gallery_id) .']"></a>';
	}
?>
</div>
<?php endif; ?>