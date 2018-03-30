<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php $unique_id = uniqid() ?>
<li id="slide_item_<?php echo $unique_id ?>" class="gallery_item">
	<img class="gallery_thumb" src="<?php echo esc_url(TMM_Helper::resize_image($imgurl, "100*100")) ?>" alt="<?php esc_attr_e('media item', 'diplomat'); ?>" />
	<input type="hidden" name="tmm_gallery[<?php echo $unique_id ?>][imgurl]" value="<?php echo esc_attr($imgurl); ?>" />

	<a href="#" class="delete_gallery_item" slide-id="<?php echo esc_attr($unique_id); ?>" title="<?php esc_attr_e("Delete Item", 'diplomat') ?>"><?php esc_html_e("Delete Item", 'diplomat'); ?></a>

</li>