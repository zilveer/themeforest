<?php
//Adds a box to the main column on the Page edit screens
function theme_add_custom_box() 
{
	global $themename;
	add_meta_box( 
        "page-custom-options",
        __("Options", 'medicenter'),
        "theme_inner_custom_box",
        "page",
		"normal",
		"high"
    );
	add_meta_box( 
        "options",
        __("Options", 'medicenter'),
        "theme_inner_custom_box_post",
        "post",
		"normal",
		"high"
    );	
}
add_action("add_meta_boxes", "theme_add_custom_box");

// Prints the box content
function theme_inner_custom_box($post)
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_noncename");
}

// Prints the box content post
function theme_inner_custom_box_post($post)
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_noncename");

	//The actual fields for data entry
	$attachment_ids = get_post_meta($post->ID, $themename. "_attachment_ids", true);
	$images = get_post_meta($post->ID, $themename. "_images", true);
	$images_titles = get_post_meta($post->ID, $themename. "_images_titles", true);
	$videos = get_post_meta($post->ID, $themename. "_videos", true);
	$iframes = get_post_meta($post->ID, $themename. "_iframes", true);
	$external_urls = get_post_meta($post->ID, $themename. "_external_urls", true);
	$features_images_loop = get_post_meta($post->ID, $themename. "_features_images_loop", true);
	$show_images_in = get_post_meta($post->ID, $themename. "_show_images_in", true);
	echo '
	<table>
		<tbody>
			<tr valign="top">
				<th colspan="2" scope="row" style="font-weight: bold;">
					' . __('Additional featured images', 'medicenter') . '
				</th>
			</tr>';
			$images_count = count(array_values(array_filter((array)$images)));
			if($images_count==0)
				$images_count = 3;
			for($i=0; $i<$images_count; $i++)
			{
			echo '
			<tr class="image_url_row">
				<td>
					<label>' . __('Image url', 'medicenter') . " " . ($i+1) . '</label>
				</td>
				<td>
					<input type="hidden" name="attachment_ids[]" id="' . $themename . '_attachment_id_' . ($i+1) . '" value="' . (!empty($attachment_ids[$i]) ? esc_attr($attachment_ids[$i]) : '') . '" />
					<input class="regular-text" type="text" id="' . $themename . '_image_url_' . ($i+1) . '" name="images[]" value="' . (!empty($images[$i]) ? esc_attr($images[$i]) : '') . '" />
					<input type="button" class="button" name="' . $themename . '_upload_button" id="' . $themename . '_image_url_button_' . ($i+1) . '" value="' . __('Browse', 'medicenter') . '" />
				</td>
			</tr>
			<tr class="image_title_row">
				<td>
					<label>' . __('Image description', 'medicenter') . " " . ($i+1) . '</label>
				</td>
				<td>
					<input class="regular-text" type="text" id="' . $themename . '_image_title_' . ($i+1) . '" name="images_titles[]" value="' . (!empty($images_titles[$i]) ? esc_attr($images_titles[$i]) : '') . '" />
				</td>
			</tr>
			<tr class="video_row">
				<td>
					<label>' . __('Video url', 'medicenter') . " " . ($i+1) . '</label>
				</td>
				<td>
					<input class="regular-text" type="text" id="' . $themename . '_video_' . ($i+1) . '" name="videos[]" value="' . (!empty($videos[$i]) ? esc_attr($videos[$i]) : '') . '" />
				</td>
			</tr>
			<tr class="iframe_row">
				<td>
					<label>' . __('Iframe url', 'medicenter') . " " . ($i+1) . '</label>
				</td>
				<td>
					<input class="regular-text" type="text" id="' . $themename . '_iframe_' . ($i+1) . '" name="iframes[]" value="' . (!empty($iframes[$i]) ? esc_attr($iframes[$i]) : '') . '" />
				</td>
			</tr>
			<tr class="external_url_row">
				<td>
					<label>' . __('External url', 'medicenter') . " " . ($i+1) . '</label>
				</td>
				<td>
					<input class="regular-text" type="text" id="' . $themename . '_external_url_' . ($i+1) . '" name="external_urls[]" value="' . (!empty($external_urls[$i]) ? esc_attr($external_urls[$i]) : '') . '" />
				</td>
			</tr>';
			}
			echo '
			<tr>
				<td></td>
				<td>
					<input type="button" class="button" name="' . $themename . '_add_new_button" id="' . $themename . '_add_new_button_image" value="' . __('Add image', 'medicenter') . '" />
				</td>
			</tr>
			<tr>
				<td>
					<label for="features_images_loop">' . __('Features images lightbox loop', 'medicenter') . ':</label>
				</td>
				<td>
					<select id="features_images_loop" name="features_images_loop">
						<option value="yes"' . ($features_images_loop=="yes" ? ' selected="selected"' : '') . '>' . __('yes', 'medicenter') . '</option>
						<option value="no"' . ($features_images_loop=="no" ? ' selected="selected"' : '') . '>' . __('no', 'medicenter') . '</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					' . __('Show featured images lightbox', 'medicenter') . '
				</td>
				<td>
					<select id="show_images_in" name="show_images_in">
						<option value="post"' . ($show_images_in=="post" ? ' selected="selected"' : '') . '>' . __('in single post', 'medicenter') . '</option>
						<option value="blog"' . ($show_images_in=="blog" ? ' selected="selected"' : '') . '>' . __('on post list', 'medicenter') . '</option>
						<option value="both"' . ($show_images_in=="both" ? ' selected="selected"' : '') . '>' . __('both', 'medicenter') . '</option>
					</select>
				</td>
			</tr>
		</tbody>
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
	if (!isset($_POST[$themename . '_noncename']) || !wp_verify_nonce($_POST[$themename . '_noncename'], plugin_basename( __FILE__ )))
		return;

	// Check permissions
	if(!current_user_can('edit_post', $post_id))
		return;
	//OK, we're authenticated: we need to find and save the data	
	if(isset($_POST["attachment_ids"]))
		update_post_meta($post_id, $themename . "_attachment_ids", array_filter((array)$_POST["attachment_ids"]));
	if(isset($_POST["images"]))
		update_post_meta($post_id, $themename . "_images", array_filter((array)$_POST["images"]));
	if(isset($_POST["images_titles"]))
		update_post_meta($post_id, $themename . "_images_titles", array_filter((array)$_POST["images_titles"]));
	if(isset($_POST["videos"]))
		update_post_meta($post_id, $themename . "_videos", array_filter((array)$_POST["videos"]));
	if(isset($_POST["iframes"]))
		update_post_meta($post_id, $themename . "_iframes", array_filter((array)$_POST["iframes"]));
	if(isset($_POST["external_urls"]))
		update_post_meta($post_id, $themename . "_external_urls", array_filter((array)$_POST["external_urls"]));
	if(isset($_POST["features_images_loop"]))
		update_post_meta($post_id, $themename . "_features_images_loop", $_POST["features_images_loop"]);
	if(isset($_POST["show_images_in"]))
		update_post_meta($post_id, $themename . "_show_images_in", $_POST["show_images_in"]);
	if(isset($_POST["page_sidebar_header"]))
		update_post_meta($post_id, "page_sidebar_header", $_POST["page_sidebar_header"]);
	if(isset($_POST["page_sidebar_top"]))
		update_post_meta($post_id, "page_sidebar_top", $_POST["page_sidebar_top"]);
	if(isset($_POST["page_sidebar_right"]))
		update_post_meta($post_id, "page_sidebar_right", $_POST["page_sidebar_right"]);
	if(isset($_POST["page_sidebar_footer_top"]))
		update_post_meta($post_id, "page_sidebar_footer_top", $_POST["page_sidebar_footer_top"]);
	if(isset($_POST["page_sidebar_footer_bottom"]))
		update_post_meta($post_id, "page_sidebar_footer_bottom", $_POST["page_sidebar_footer_bottom"]);
	update_post_meta($post_id, $themename . "_page_sidebars", array_values(array_filter(array(
		(!empty($_POST["page_sidebar_header"]) ? $_POST["page_sidebar_header"] : NULL),
		(!empty($_POST["page_sidebar_top"]) ? $_POST["page_sidebar_top"] : NULL),
		(!empty($_POST["page_sidebar_right"]) ? $_POST["page_sidebar_right"] : NULL),
		(!empty($_POST["page_sidebar_footer_top"]) ? $_POST["page_sidebar_footer_top"] : NULL),
		(!empty($_POST["page_sidebar_footer_bottom"]) ? $_POST["page_sidebar_footer_bottom"] : NULL)
	))));
	if(isset($_POST["main_slider"]))
		update_post_meta($post_id, "main_slider", $_POST["main_slider"]);
}
add_action("save_post", "theme_save_postdata");
?>