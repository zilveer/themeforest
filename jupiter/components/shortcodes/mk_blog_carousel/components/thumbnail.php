<?php 
$featured_image_src = Mk_Image_Resize::resize_by_id_adaptive( get_post_thumbnail_id(), 'blog-carousel', 245, 180, $crop = true, $dummy = true);
?>

<img src="<?php echo $featured_image_src['dummy']; ?>" <?php echo $featured_image_src['data-set']; ?> width="245" height="180" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />