<?php
// Return if no thumbnail provided
if (!strlen( get_the_post_thumbnail( get_the_ID() ) )) return false;

$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'image-size-150x150');

?>

<div class="mk-testimonial-image">
	<img width="50" height="50" src="<?php echo $image_src_array[0]; ?>" alt="<?php echo strip_tags( get_post_meta( get_the_ID(), '_author', true ) ); ?>" />
</div>
