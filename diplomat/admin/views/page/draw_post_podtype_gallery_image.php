<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$image_types = array( 'grid-col-third' => 'One Third',
                     'grid-col-half' => 'One Half',
                     'grid-col-four' => 'One Fourth'  
                    );     
 $unique_id = uniqid();
  

    if (isset($change_gallry_type)&&($change_gallry_type==true)){       
       $imgurl = $imgurl['url'];
    }


 ?>
<li class="gallery_item">
	<img class="gallery_thumb" src="<?php echo esc_url(TMM_Helper::resize_image($imgurl, "100*100")); ?>" alt="" />
	<input type="hidden" value="<?php echo esc_attr($imgurl); ?>" class="post_pod_gallery_item" name="post_type_values[gallery][]">
	<a href="#" class="delete_gallery_item" title="<?php esc_attr_e("Delete Item", 'diplomat') ?>"><?php esc_html_e("Delete Item", 'diplomat') ?></a>

</li>