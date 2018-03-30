<?php if($view_params['icon_type'] != 'image') return false; ?>
<div class="item-image padding-<?php echo $view_params['image_padding']; ?>">
	<img src="<?php echo $view_params['item_image']; ?>" alt="<?php echo $view_params['item_title']; ?>" />
</div>