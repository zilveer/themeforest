<?php 
global $post;
	$attachment_ids = get_post_meta($post->ID, THEME_SLUG.'post_gallery', true);
	if( $attachment_ids != '' ){
		$attachment_ids = explode(',', $attachment_ids);
	}
	if( !is_array($attachment_ids) ){
		$attachment_ids = array();
	}
?>

<div class="post_gallery_wrapper">
	<div class="post_gallery_wrapper_inner">
		<input type="hidden" value="1" name="_post_gallery">
		<?php wp_nonce_field( "_update_post_gallery", "nonce_post_gallery" ); ?>
		<ul class="post_gallery_list">
			<?php foreach( $attachment_ids as $attachment_id ): ?>
			<li class="image" >
				<span class="del_image"></span>
				<?php echo wp_get_attachment_image( $attachment_id, 'thumbnail', false, array('data-id'=> $attachment_id) ); ?>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<input type="hidden" name="attachment_ids" value="<?php echo implode(',', $attachment_ids); ?>" class="attachment_ids" />
	<a href="#" class="add_images">Add Images to Post Gallery</a>
</div>