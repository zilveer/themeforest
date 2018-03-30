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
	   <label for="<?php echo $field['id'] ?>_onsale"><input type="radio" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>_onsale" value="onsale"<?php checked($preset, 'onsale'); ?> /> On Sale!</label><br />
	   <label for="<?php echo $field['id'] ?>_50"><input type="radio" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>_50" value="-50%"<?php checked($preset, '-50%'); ?> /> -50%</label><br /> 
	   <label for="<?php echo $field['id'] ?>_25"><input type="radio" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>_25" value="-25%"<?php checked($preset, '-25%'); ?> /> -25%</label><br /> 
	   <label for="<?php echo $field['id'] ?>_10"><input type="radio" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>_10" value="-10%"<?php checked($preset, '-10%'); ?> /> -10%</label><br />    
	   <label for="<?php echo $field['id'] ?>_custom"><input type="radio" name="<?php echo $field['id'] ?>" id="<?php echo $field['id'] ?>_custom" value="custom"<?php checked($preset, 'custom'); ?> /> <?php _e( 'Custom', 'yit' ) ?></label><br />    
	   <small><?php _e( '(if you have choosen "Custom", upload your image in the option below, suggested size: 75x75px)', 'yit' ) ?></small>
    </p>
	
	<?php

	// Upload custom onsale icon
	$field = array( 'id' => '_custom_onsale_icon', 'label' => __('Custom onsale icon URL', 'yit') ); 
	$file_path = get_post_meta($post->ID, $field['id'], true);
	echo '<p class="form-field"><label for="'.$field['id'].'">'.$field['label'].':</label>
		<input type="text" id="custom-onsale" class="short custom_onsale" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$file_path.'" placeholder="'.__('File path/URL', 'yit').'" />
		<input type="button" id="custom-onsale-button" class="upload_button button" value="' . __( 'Choose a file', 'yit' ) . '" title="' . __( 'Upload', 'yit' ) . '" data-choose="' . __( 'Choose a file', 'yit' ) . '" data-update="' . __( 'Insert file URL', 'yit' ) . '" />
   </p>';

	do_action('woocommerce_product_options_custom_onsale');

echo '</div>';  ?>

<script type="text/javascript">
jQuery( function($){

    jQuery(document).on('click', '.upload_button.button', function(e) {
        var button = $(this);
        var id = button.attr('id').replace('-button', '');
        wp.media.editor.send.attachment = function(props, attachment){
            $("#"+id).val(attachment.url);
        };

        wp.media.editor.open(button);
        return false;
    });
});
</script>