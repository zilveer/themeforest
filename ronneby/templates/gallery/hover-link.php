<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$thumb_data_attr = $data_gallery = $attachments_html = '';

$_gallery_id = get_the_id();

$gallery_id = uniqid($_gallery_id);

$gallery_url = get_permalink();

if($options['dfd_gallery_hover_link'] == 'link') {
	$link_url = $gallery_url;
} else {
	$link_url = $img_url;

	$thumb_url = wp_get_attachment_image_src($thumb, 'thumbnail');

	if(!empty($thumb_url[0])) {
		$thumb_data_attr .= 'data-thumb="'.esc_url($thumb_url[0]).'"';
	}
	if (metadata_exists('post', $_gallery_id, '_gallery_image_gallery')) {
		$image_gallery = get_post_meta($_gallery_id, '_gallery_image_gallery', true);
	} else {
		// Backwards compat
		$attachment_ids = get_posts('post_parent=' . $_gallery_id . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids');
		$attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
		$image_gallery = implode(',', $attachment_ids);
	}

	$attachments = array_filter(explode(',', $image_gallery));
	$data_gallery .= 'data-rel="prettyPhoto['. esc_attr($gallery_id) .']"';

	if($attachments) :
		$attachments_html .= '<div class="hide">';
			foreach ($attachments as $attachment_id) {
				$image_src = wp_get_attachment_image_src($attachment_id, 'full');
				if (empty($image_src[0])) {
					continue;
				}
				$attachment_img_url = $image_src[0];

				if (strcmp($attachment_img_url, $img_url)===0) {
					continue;
				}
				$thumb_src = wp_get_attachment_image_src($attachment_id, 'thumbnail');
				$thumb_data = '';
				if (!empty($thumb_src[0])) {
					$thumb_data .= 'data-thumb="'.esc_url($thumb_src[0]).'"';
				}
				$thumb_meta = wp_get_attachment_metadata($thumb);
				if(isset($thumb_meta['image_meta']['title']) && !empty($thumb_meta['image_meta']['title'])) {
					$desc = $thumb_meta['image_meta']['title'];
				} elseif(isset($thumb_meta['image_meta']['caption']) && !empty($thumb_meta['image_meta']['caption'])) {
					$desc = $thumb_meta['image_meta']['caption'];
				} else {
					$desc = $subtitle;
				}

				$attachments_html .= '<a href="'. esc_url($attachment_img_url) .'" '.$thumb_data.' title="'.esc_attr($desc).'" data-rel="prettyPhoto['. esc_attr($gallery_id) .']"></a>';
			}
		$attachments_html .= '</div>';
	endif;
}