<?php

$display_custom_feature_image_width = '';
if(hashmag_mikado_options()->getOptionValue('blog_single_feature_image_max_width') !== ''){
	$display_custom_feature_image_width = intval(hashmag_mikado_options()->getOptionValue('blog_single_feature_image_max_width'));
}
?>
<?php if ( has_post_thumbnail() ) { ?>
	<div class="mkdf-post-image">
		<?php if($display_custom_feature_image_width !== '') {
			the_post_thumbnail(array($display_custom_feature_image_width, 0));
		} else {
			the_post_thumbnail('hashmag_mikado_post_feature_image');
		} ?>
	</div>
<?php } ?>