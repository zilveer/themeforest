<?php
/**
 * The template for the gallery upload modal.
 *
 * @package Listify
 */

$gallery_url = esc_url( Listify_WP_Job_Manager_Gallery::url( get_post()->ID ) );
?>

<div id="add-photo" class="popup">

	<h2 class="popup-title"><?php _e( 'Upload Images', 'listify' ); ?></h2>

	<div class="content-single-job_listing-upload-area">
		<form action="" method="post" class="listify-add-to-gallery" enctype= "multipart/form-data">
			<input type="file" multiple="true" name="listify_gallery_images[]" id="listify-new-gallery-images" value="" />
			<input type="submit" name="submit" value="<?php esc_attr_e( 'Add Images to Gallery', 'listify' ); ?>" />
			<input type="hidden" name="post_id" id="post_id" value="<?php echo get_post()->ID; ?>" />
			<input type="hidden" name="redirect" id="gallery-redirect" value="<?php echo $gallery_url; ?>" />
			<input type="hidden" name="listify_action" value="listify_add_to_gallery" />
			<?php wp_nonce_field( 'listify_add_to_gallery' ) ?>
		</form>
	</div>

</div>
