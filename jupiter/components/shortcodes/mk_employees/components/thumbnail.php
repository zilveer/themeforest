<?php

$image_src = Mk_Image_Resize::resize_by_id( get_post_thumbnail_id(), $view_params['image_size'], false, false);

if(!empty($view_params['link'])) { ?>
	<a href="<?php echo $view_params['link']; ?>">
<?php } ?>
		<img alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" src="<?php echo $image_src; ?>" />

<?php if(!empty($view_params['link'])) { ?>
	</a>
<?php } ?>
