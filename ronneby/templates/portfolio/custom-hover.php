<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$hover_subtitle_text = false;
	
	$custom_head_subtitle = DfdMetaBoxSettings::get('stunnig_headers_subtitle');
		
	$external_link = DfdMetaBoxSettings::get('folio_client_site');
	
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
?>

<div class="portfolio-custom-hover">
	<?php switch($options['folio_hover_main_dedcoration']) {
		case 'plus':
		?>
			<a class="plus-link <?php echo esc_attr($options['folio_hover_plus_position']) ?>" href="<?php the_permalink(); ?>">
				<span class="plus-link-container">
					<span class="plus-link-out"></span>
					<span class="plus-link-come"></span>
				</span>
			</a>
		<?php
			break;
		case 'lines':
		?>
			<a class="dfd-dotted-link" href="<?php the_permalink(); ?>">
				<span class="dfd-left-line"></span><span></span><span class="dfd-right-line"></span>
			</a>
		<?php
			break;
		case 'dots':
		?>
			<a class="dfd-dots-link" href="<?php the_permalink(); ?>">
				<span class="dfd-left-dot"></span><span class="dfd-middle-dot"></span><span class="dfd-right-dot"></span>
			</a>
		<?php
			break;
		case 'none':
			break;
		case 'heading':
		default:
		?>
			<div class="title-wrap <?php echo esc_attr($options['folio_hover_title_dedcoration']) ?>">
				<?php if($options['folio_hover_show_title'] == 'on') : ?>
					<h6 class="widget-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
				<?php endif; ?>
				<?php if($options['folio_hover_show_subtitle'] == 'on' && !empty($custom_head_subtitle)) : ?>
					<h6 class="widget-sub-title">
						<?php echo esc_html($custom_head_subtitle); ?>
					</h6>
				<?php endif; ?>
			</div>
	<?php } ?>
	<div class="dfd-folio-icons-wrap">
		<?php if($options['folio_hover_show_ext_link'] == 'on' && $external_link && !empty($external_link)) : ?>
			<a class="dfd-icon-down_right" href="<?php echo esc_url($external_link); ?>"></a>
		<?php endif; ?>
		<?php if($options['folio_hover_show_quick_view'] == 'on') : ?>
			<a data-rel="prettyPhoto[iframe]" class="dfd-icon-full_screen" href="<?php the_permalink(); ?>?iframe=true&amp;width=100%25&amp;height=100%25"></a>
		<?php endif; ?>
		<?php if($options['folio_hover_show_lightbox'] == 'on') : ?>
			<a data-rel="prettyPhoto[<?php echo esc_attr($gallery_id); ?>]" <?php echo $thumb_data_attr ?> class="dfd-icon-image" href="<?php echo esc_url($img_url); ?>"></a>
		<?php endif; ?>
	</div>
</div>

<?php if (!empty($attachments) && $options['folio_hover_show_lightbox'] == 'on'): ?>
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
<?php endif;