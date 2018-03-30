<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	global $dfd_ronneby;
	$hover_subtitle_text = '';
	
	$custom_head_subtitle = DfdMetaBoxSettings::get('stunnig_headers_subtitle');

	$thumb_data_attr = '';
	if (has_post_thumbnail()) {
		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url($thumb, 'full');
		$thumb_url = wp_get_attachment_image_src($thumb, 'thumbnail');
		if(!empty($thumb_url[0])) {
			$thumb_data_attr = 'data-thumb="'.esc_url($thumb_url[0]).'"';
		}
	} else {
		$img_url = get_template_directory_uri() . '/assets/images/no_image_resized_480-360.jpg';
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
	
	if(isset($dfd_ronneby['hover_subtitle_text']) && !empty($dfd_ronneby['hover_subtitle_text'])) {
		$hover_subtitle_text = $dfd_ronneby['hover_subtitle_text'];
	}
?>

<div class="portfolio-entry-hover">
	<div class="title-wrap">
		<h6 class="widget-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
		<?php if($hover_subtitle_text) { ?>
			<div class="entry-tags">
				<span class="folio-inner-subtitle subtitle">
					<?php if (!empty($custom_head_subtitle)): ?>
						<?php echo $custom_head_subtitle; ?>
					<?php endif; ?>
				</span>
			</div>
		<?php } else {
			get_template_part('templates/folio', 'terms');
		}?>
	</div>
	<a data-rel="prettyPhoto[<?php echo esc_attr($gallery_id); ?>]" class="zoom-post" href="<?php echo esc_url($img_url); ?>">
		<i class="dfd-icon-zoom"></i>
	</a>
	<a data-rel="prettyPhoto[iframe]" class="quick-view" href="<?php the_permalink(); ?>?iframe=true&amp;width=100%25&amp;height=100%25">
		<span class="quick-view-text chaffle" data-lang="en"><?php _e('Quick view', 'dfd'); ?></span>
	</a>
	<a class="open-post" href="<?php the_permalink(); ?>">
		<i class="dfd-icon-link"></i>
	</a>
	<a class="plus-link" href="<?php the_permalink(); ?>">
		<span class="plus-link-container">
			<span class="plus-link-out"></span>
			<span class="plus-link-come"></span>
		</span>
	</a>
	<a class="dfd-dotted-link" href="<?php the_permalink(); ?>">
		<span class="dfd-left-line"></span><span></span><span class="dfd-right-line"></span>
	</a>
</div>

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
		
		$thumb_src = wp_get_attachment_image_src($attachment_id, 'thumbnail');
		$thumb_data = '';
		if (!empty($thumb_src[0])) {
			$thumb_data .= 'data-thumb="'.esc_url($thumb_src[0]).'"';
		}

		echo '<a href="'. $attachment_img_url .'" '.$thumb_data.' data-rel="prettyPhoto['. esc_attr($gallery_id) .']"></a>';
	}
?>
</div>
<?php endif; ?>