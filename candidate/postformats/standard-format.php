<?php if(has_post_thumbnail()  && ! post_password_required() ): 
$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); 
$sidebar_position = get_meta_option('sidebar_position_meta_box');
$type = 'post-blog';
if('full' == $sidebar_position) {
	$type = 'post-full';
	}
?>
		<?php the_post_thumbnail($type); ?>
<?php endif; ?>
