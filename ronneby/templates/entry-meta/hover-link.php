<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (has_post_thumbnail()) {
	$thumb = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url($thumb, 'full');
} else {
	$img_url = get_template_directory_uri() . '/img/no-image-large.jpg';
}
?>
<div class="hover-link">
	<a href="<?php echo esc_url($img_url); ?>" class="image-link" data-rel="prettyPhoto[folio<?php echo the_ID(); ?>]"><i class="infinityicon-pic_mountains"></i></a>
	<a href="<?php the_permalink(); ?>" class="post-link"><i class="infinityicon-paperclip"></i></a>
</div>