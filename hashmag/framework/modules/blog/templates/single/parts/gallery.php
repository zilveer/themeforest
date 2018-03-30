<?php

$image_gallery_val = get_post_meta( get_the_ID(), 'mkdf_post_gallery_images_meta' , true );

$display_custom_feature_image_width = '';
if(hashmag_mikado_options()->getOptionValue('blog_single_feature_image_max_width') !== ''){
	$display_custom_feature_image_width = intval(hashmag_mikado_options()->getOptionValue('blog_single_feature_image_max_width'));
}
?>
<?php if($image_gallery_val !== ""){ ?>
	<div class="mkdf-post-image">
		<div class="mkdf-blog-gallery clearfix">
			<ul class="mkdf-pg-slider">
				<?php
				if($image_gallery_val != '' ) {
					$image_gallery_array = explode(',',$image_gallery_val);
				}
				if(isset($image_gallery_array) && count($image_gallery_array) != 0):
					foreach($image_gallery_array as $gimg_id): ?>
						<li class="mkdf-pg-slides">
							<?php if($display_custom_feature_image_width !== '') {
								echo wp_get_attachment_image( $gimg_id, array($display_custom_feature_image_width, 0) );
							} else {
								echo wp_get_attachment_image( $gimg_id, 'hashmag_mikado_post_feature_image' );
							} ?>
						</li>
					<?php endforeach;
				endif;
				?>
			</ul>
		</div>
	</div>
<?php } ?>