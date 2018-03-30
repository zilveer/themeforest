<?php 
/**
 * format.php
 *
 * The default template for post contents.
 */

?>

<div class="image-wrapper post-format-video">
	<?php if(get_post_meta(get_the_ID() , 'video' , true) != '') : ?>
	<div class="video-container">
		<?php echo get_post_meta(get_the_ID() , 'video' , true); ?>
	</div>	
	<?php endif; ?>
</div>



