<?php
//Adds a box to the main column on the Page edit screens
function theme_add_custom_box() 
{
	global $themename;
    add_meta_box( 
        "options",
        __("Options", 'gymbase'),
        "theme_inner_custom_box",
        "page",
		"normal",
		"high"
    );
	add_meta_box( 
        "options",
        __("Options", 'gymbase'),
        "theme_inner_custom_box_post",
        "post",
		"normal",
		"high"
    );
}
add_action("add_meta_boxes", "theme_add_custom_box");
//backwards compatible (before WP 3.0)
//add_action("admin_init", "theme_add_custom_box", 1);

// Prints the box content
function theme_inner_custom_box($post)
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_noncename");
	echo '
	<table>
		<tr>
			<td>
				<label for="subtitle">' . __('Subtitle', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="subtitle" name="subtitle" value="' . esc_attr(get_post_meta($post->ID, $themename . "_subtitle", true)) . '" />
			</td>
		</tr>
	</table>
	';
}

// Prints the box content post
function theme_inner_custom_box_post($post)
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_noncename");

	//The actual fields for data entry
	$subtitle = get_post_meta($post->ID, $themename. "_subtitle", true);
	echo '
	<table>
		<tr>
			<td>
				<label for="subtitle">' . __('Subtitle', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="subtitle" name="subtitle" value="' . esc_attr(get_post_meta($post->ID, $themename . "_subtitle", true)) . '" />
			</td>
		</tr>
	</table>
	';
}

//When the post is saved, saves our custom data
function theme_save_postdata($post_id) 
{
	global $themename;
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

	//verify this came from the our screen and with proper authorization,
	//because save_post can be triggered at other times
	if(!isset($_POST[$themename . '_noncename']) || !wp_verify_nonce($_POST[$themename . '_noncename'], plugin_basename( __FILE__ )))
		return;


	// Check permissions
	if(!current_user_can('edit_post', $post_id))
		return;
		
	//OK, we're authenticated: we need to find and save the data
	if(isset($_POST["subtitle"]))
		update_post_meta($post_id, $themename . "_subtitle", $_POST["subtitle"]);	
}
add_action("save_post", "theme_save_postdata");
?>