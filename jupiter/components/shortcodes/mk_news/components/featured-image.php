<?php

$featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), 'crop', $view_params['image_width'], $view_params['image_height'], $crop = true, $dummy = true);

if (has_post_thumbnail()) { ?>

    <img alt="<?php the_title_attribute(); ?>" 
    	 title="<?php the_title_attribute(); ?>" 
    	 width="<?php echo $view_params['image_width']; ?>" 
    	 height="<?php echo $view_params['image_height']; ?>" 
    	 src="<?php echo $featured_image_src['dummy']; ?>" 
    	 <?php echo $featured_image_src['data-set']; ?> 
    	 itemprop="image" />

<?php }