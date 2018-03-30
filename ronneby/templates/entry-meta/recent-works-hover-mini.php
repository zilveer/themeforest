<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }
	$thumb = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url($thumb, 'full'); //get img URL
?>

<div class="hover-link">
	<a data-rel="prettyPhoto[post-<?php the_ID(); ?>]" class="zoom-post" href="<?php echo esc_url($img_url); ?>">
		<?php _e('zoom', 'dfd'); ?>
	</a>
	<a class="open-post" href="<?php the_permalink(); ?>">
		<?php _e('view', 'dfd'); ?>
	</a>
</div>
