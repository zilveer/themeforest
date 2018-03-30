<?php
/**
 * @author 		YIThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
 
global $post;
 
echo '<div class="options_group">';
	
	// Active custom onsale                         
	$active = get_post_meta($post->ID, '_active_custom_onsale', true);
	woocommerce_wp_checkbox( array( 'id' => '_active_custom_onsale', 'label' => __('Active custom onsale icon', 'yit'), 'cbvalue' => 'yes', 'value' => $active ) );

    // Choose a preset                                                    
    $field = array( 'id' => '_preset_onsale_icon', 'label' => __('Choose a preset', 'yit') );                              
	$preset = get_post_meta($post->ID, $field['id'], true); ?>
	
	<p class="form-field <?php echo $field['id'] ?>_field">
	   <b><?php echo $field['label'] ?></b><br />
	   <label for="<?php echo $field['id'] ?>_onsale">On Sale!<input type="radio" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>_onsale" value="onsale"<?php checked($preset, 'onsale'); ?> /></label><br /> 
	   <label for="<?php echo $field['id'] ?>_50">-50%<input type="radio" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>_50" value="-50%"<?php checked($preset, '-50%'); ?> /></label><br /> 
	   <label for="<?php echo $field['id'] ?>_25">-25%<input type="radio" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>_25" value="-25%"<?php checked($preset, '-25%'); ?> /></label><br /> 
	   <label for="<?php echo $field['id'] ?>_10">-10%<input type="radio" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>_10" value="-10%"<?php checked($preset, '-10%'); ?> /></label><br />    
	   <label for="<?php echo $field['id'] ?>_custom"><?php _e( 'Custom', 'yit' ) ?><input type="radio" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>_custom" value="custom"<?php checked($preset, 'custom'); ?> /></label><br />    
	   <small><?php _e( '(if you have choosen "Custom", upload your image in the option below, suggested size: 75x75px)', 'yit' ) ?></small>
    </p>
	
	<?php

	// Upload custom onsale icon
	$field = array( 'id' => '_custom_onsale_icon', 'label' => __('Custom onsale icon URL', 'yit') );
	$file_path = get_post_meta($post->ID, $field['id'], true);
	echo '<p class="form-field"><label for="'.$field['id'].'">'.$field['label'].':</label>
		<input type="text" class="short custom_onsale" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$file_path.'" placeholder="'.__('File path/URL', 'yit').'" />
		<input type="button" class="upload_custom_onsale button" value="' . __( 'Choose a file', 'yit' ) . '" title="' . __( 'Upload', 'yit' ) . '" data-choose="' . __( 'Choose a file', 'yit' ) . '" data-update="' . __( 'Insert file URL', 'yit' ) . '" value="' . __( 'Choose a file', 'yit' ) . '" />
   </p>';

	do_action('woocommerce_product_options_custom_onsale');

echo '</div>';  ?>

<script type="text/javascript">
jQuery( function($){
    var downloadable_file_frame;

	jQuery(document).on( 'click', '.upload_custom_onsale', function( event ){

		var $el = $(this);
		var $file_path_field = $el.parent().find('.custom_onsale');
		var file_paths = $file_path_field.val();

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( downloadable_file_frame ) {
			downloadable_file_frame.open();
			return;
		}

		var downloadable_file_states = [
			// Main states.
			new wp.media.controller.Library({
				library:   wp.media.query(),
				multiple:  false,
				title:     $el.data('choose'),
				priority:  20,
				filterable: 'uploaded',
			})
		];

		// Create the media frame.
		downloadable_file_frame = wp.media.frames.downloadable_file = wp.media({
			// Set the title of the modal.
			title: $el.data('choose'),
			library: {
				type: ''
			},
			button: {
				text: $el.data('update'),
			},
			multiple: true,
			states: downloadable_file_states,
		});

		// When an image is selected, run a callback.
		downloadable_file_frame.on( 'select', function() {

			var selection = downloadable_file_frame.state().get('selection');

			selection.map( function( attachment ) {

				attachment = attachment.toJSON();

				if ( attachment.url )
					file_paths = file_paths ? file_paths + "\n" + attachment.url : attachment.url

			} );

			$file_path_field.val( file_paths );
		});

		// Set post to 0 and set our custom type
		downloadable_file_frame.on( 'ready', function() {
			downloadable_file_frame.uploader.options.uploader.params = {
				type: 'downloadable_product'
			};
		});

		// Finally, open the modal.
		downloadable_file_frame.open();
	});
});
</script>