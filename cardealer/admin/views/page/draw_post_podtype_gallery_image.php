<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<li class="gallery_item">
	<img class="gallery_thumb" src="<?php echo TMM_Helper::resize_image($imgurl, "100*100") ?>" alt="" />
	<input type="hidden" value="<?php echo $imgurl ?>" class="post_pod_gallery_item" name="post_type_values[gallery][]">
	<a href="#" class="delete_gallery_item" title="<?php _e("Delete Item", 'cardealer') ?>"><?php _e("Delete Item", 'cardealer') ?></a>
</li>