<?php 
/**
 * format.php
 *
 * The default template for post contents.
 */

?>



<div class="image-wrapper post-format-status">
	<?php 
	$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full');
    $imagesrc = $imagesrc[0];
	?>
    <div class="inner-wrap" style="background-image: url(<?php echo $imagesrc; ?>) ; background-repeat: no-repeat;">
    	<div class="status-wrap">			
    		<?php echo get_post_meta(get_the_ID() , 'status' , true); ?>
    	</div>
    </div><!-- end inner wrap -->
</div>



