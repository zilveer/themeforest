<?php
add_action("admin_init", "etheme_add_product_meta_box");
function etheme_add_product_meta_box(){
	add_meta_box("etheme-product-meta-box", __( "Custom Settings", ETHEME_DOMAIN ), "etheme_product_meta_box", "wpsc-product", "normal", "low");
}
function etheme_product_meta_box() {
    global $post;
?>
    <div class="etheme-metaboxes">
    	<input type="hidden" name="etheme_product_meta_box_nonce" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
    
     
        <p>
            <input type="checkbox" name="etheme_product[_etheme_size_guide]" id="etheme_product[_etheme_size_guide]" value="1" <?php checked(1, etheme_get_custom_field('_etheme_size_guide')); ?> /> 
            <label for="etheme_product[_etheme_size_guide]"><?php _e("Enable Size Guide on this product", ETHEME_DOMAIN); ?></label>
        </p>
        <p>
            <input type="checkbox" name="etheme_product[_etheme_new_label]" id="etheme_product[_etheme_new_label]" value="1" <?php checked(1, etheme_get_custom_field('_etheme_new_label')); ?> /> 
            <label for="etheme_product[_etheme_new_label]"><?php _e("Mark this product as a NEW one", ETHEME_DOMAIN); ?></label>
        </p>
        
        <hr class="div" style="clear:both"/>
        <p><?php _e("Hover img", ETHEME_DOMAIN); ?>
        <br/><span class="description"><?php _e("png, jpg or gif file", ETHEME_DOMAIN); ?></span></p>
    	<?php echo etheme_add_upload_product_setting($post->ID,'etheme_hover', __("Upload image: png, jpg or gif file", ETHEME_DOMAIN)); ?>
        <hr class="div" style="clear:both"/>
        <p>
            <?php _e("Tab 1 title:", ETHEME_DOMAIN); ?> <input type="text" class="text" name="etheme_product[_etheme_custom_tab1_title]" value="<?php etheme_custom_field('_etheme_custom_tab1_title'); ?>" />
        </p>
        
    	<p><?php _e("Enter custom content you would like output to the product custom tab:", ETHEME_DOMAIN); ?><br />
    	<textarea name="etheme_product[_etheme_custom_tab1]" id="etheme_custom_tab1" cols="39" rows="5"><?php etheme_custom_field('_etheme_custom_tab1'); ?></textarea><br />
    	<span class="description"><?php _e('<b>NOTE:</b>  You can use any shortcode / HTML code.', ETHEME_DOMAIN); ?></span></p>
        <hr />
        <p>
            <?php _e("Tab 2 title:", ETHEME_DOMAIN); ?> <input type="text" class="text" name="etheme_product[_etheme_custom_tab2_title]" value="<?php etheme_custom_field('_etheme_custom_tab2_title'); ?>" />
        </p>
        
    	<p><?php _e("Enter custom content you would like output to the product custom tab (second):", ETHEME_DOMAIN); ?><br />
    	<textarea name="etheme_product[_etheme_custom_tab2]" cols="39" rows="5"><?php etheme_custom_field('_etheme_custom_tab2'); ?></textarea><br />
    	<span class="description"><?php _e('<b>NOTE:</b>  You can use any shortcode / HTML code.', ETHEME_DOMAIN); ?></span></p>
    </div>
<?php
}
add_action('save_post', 'etheme_product_meta_box_save', 1, 2);
function etheme_product_meta_box_save($post_id, $post) {
	//	verify the nonce
	if ( !isset($_POST['etheme_product_meta_box_nonce']) || !wp_verify_nonce( $_POST['etheme_product_meta_box_nonce'], plugin_basename(__FILE__) ) )
		return $post->ID;
	//	don't try to save the data under autosave, ajax, or future post.
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
	if ( defined('DOING_AJAX') && DOING_AJAX ) return;
	if ( defined('DOING_CRON') && DOING_CRON ) return;
	//	is the user allowed to edit the post or page?
	if ( ('page' == $_POST['post_type'] && !current_user_can('edit_page', $post->ID)) || !current_user_can('edit_post', $post->ID ) )
		return $post->ID;
	$product_defaults = array(
        '_etheme_size_guide' => '',
		'_etheme_hover' => '',
		'_etheme_new_label' => '',
		'_etheme_custom_tab1_title' => '',
		'_etheme_custom_tab2' => '',
		'_etheme_custom_tab2_title' => '',
		'_etheme_custom_tab2' => ''
	); 
	$product = wp_parse_args($_POST['etheme_product'], $product_defaults);
	//	store the custom fields
	foreach ( (array)$product as $key => $value ) {
		if ( $post->post_type == 'revision' ) return; // don't try to store data during revision save
		//	sanitize the url before storage
		if ( $key == 'link' && $value ) $value = esc_url( $value );
		if ( $value )
			update_post_meta($post->ID, $key, $value);
		else
			delete_post_meta($post->ID, $key);
	}
}