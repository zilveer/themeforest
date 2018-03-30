<?php
$featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), $view_params['image_size'], $view_params['width'], $view_params['height'], $crop = true, $dummy = true);
$image_size_atts = Mk_Image_Resize::get_image_dimension_attr(get_post_thumbnail_id(), $view_params['image_size'], $view_params['width'], $view_params['height']);

?>

<img width="<?php echo $image_size_atts['width']; ?>" height="<?php echo $image_size_atts['height']; ?>" src="<?php echo $featured_image_src['dummy']; ?>" <?php echo $featured_image_src['data-set']; ?> alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"  class="item-featured-image" />
