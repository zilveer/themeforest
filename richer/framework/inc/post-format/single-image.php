<?php
global $single_img_size;
if($single_img_size == '') {
	$single_img_size='standard';
}
if ( has_post_thumbnail() ) { ?>
<div class="post-image">
	<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" title="<?php the_title(); ?>" rel="bookmark">
		<?php the_post_thumbnail($single_img_size); ?>
	</a>
</div>
<?php } ?>

