<?php
	global $post;
	
	$attachments = get_post_meta( $post->ID, '_ebor_gallery_list', true );
	
	if ( $attachments ) : 
	
	$class = ( get_post_type() == 'post') ? 'blog-carousel-bottom' : '';
?>

	<div id="big" class="owl-carousel <?php echo $class; ?>">
	
		<?php foreach( $attachments as $key => $attachment ) : ?>
		  <div class="item"> 
		  	<img src="<?php echo esc_url($attachment); ?>" alt="<?php echo $post->title; ?>" /> 
		  </div>
		<?php endforeach; ?>
	
	</div>

<?php 
	endif;

