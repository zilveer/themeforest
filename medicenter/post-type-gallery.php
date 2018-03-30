<?php
//custom post type - gallery
function theme_gallery_init()
{
	$labels = array(
		'name' => _x('Gallery', 'post type general name', 'medicenter'),
		'singular_name' => _x('Gallery Item', 'post type singular name', 'medicenter'),
		'add_new' => _x('Add New', 'medicenter_gallery', 'medicenter'),
		'add_new_item' => __('Add New Gallery Item', 'medicenter'),
		'edit_item' => __('Edit Gallery Item', 'medicenter'),
		'new_item' => __('New Gallery Item', 'medicenter'),
		'all_items' => __('All Gallery Items', 'medicenter'),
		'view_item' => __('View Gallery Item', 'medicenter'),
		'search_items' => __('Search Gallery Item', 'medicenter'),
		'not_found' =>  __('No gallery items found', 'medicenter'),
		'not_found_in_trash' => __('No gallery items found in Trash', 'medicenter'), 
		'parent_item_colon' => '',
		'menu_name' => __("Gallery", 'medicenter')
	);
	$args = array(  
		"labels" => $labels, 
		"public" => true,  
		"show_ui" => true,  
		"capability_type" => "post",  
		"menu_position" => 20,
		"hierarchical" => false,  
		"rewrite" => true,  
		"supports" => array("title", "editor", "excerpt", "thumbnail", "page-attributes")  
	);
	register_post_type("medicenter_gallery", $args);
	register_taxonomy("medicenter_gallery_category", array("medicenter_gallery"), array("label" => "Categories", "singular_label" => "Category", "rewrite" => true));
}  
add_action("init", "theme_gallery_init"); 

//Adds a box to the right column and to the main column on the Gallery items edit screens
function theme_add_gallery_custom_box() 
{
	add_meta_box( 
        "gallery_config",
        __("Options", 'medicenter'),
        "theme_inner_gallery_custom_box_main",
        "medicenter_gallery",
		"normal",
		"high"
    );
}
add_action("add_meta_boxes", "theme_add_gallery_custom_box");
//backwards compatible (before WP 3.0)
//add_action("admin_init", "theme_add_custom_box", 1);

function theme_inner_gallery_custom_box_main($post)
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_gallery_noncename");
	
	//The actual fields for data entry
	$external_url_target = get_post_meta($post->ID, "external_url_target", true);
	$icon_type = get_post_meta($post->ID, "social_icon_type", true);
	$icon_url = get_post_meta($post->ID, "social_icon_url", true);
	$icon_target = get_post_meta($post->ID, "social_icon_target", true);
	$icon_color = get_post_meta($post->ID, "social_icon_color", true);
	$attachment_ids = get_post_meta($post->ID, $themename. "_attachment_ids", true);
	$images = get_post_meta($post->ID, $themename. "_images", true);
	$images_titles = get_post_meta($post->ID, $themename. "_images_titles", true);
	$videos = get_post_meta($post->ID, $themename. "_videos", true);
	$iframes = get_post_meta($post->ID, $themename. "_iframes", true);
	$external_urls = get_post_meta($post->ID, $themename. "_external_urls", true);
	$features_images_loop = get_post_meta($post->ID, $themename. "_features_images_loop", true);
	
	$icons = array(
		"blogger",
		"cart",
		"deviantart",
		"dribbble",
		"envato",
		"facebook",
		"flickr",
		"form",
		"forrst",
		"googleplus",
		"instagram",
		"linkedin",
		"mail",
		"myspace",
		"phone",
		"picasa",
		"pinterest",
		"rss",
		"skype",
		"soundcloud",
		"stumbleupon",
		"tumblr",
		"twitter",
		"vimeo",
		"xing",
		"youtube"
	);
	
	echo '
	<table>
		<tr>
			<td>
				<label for="gallery_subtitle">' . __('Subtitle', 'medicenter') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="gallery_subtitle" name="gallery_subtitle" value="' . esc_attr(get_post_meta($post->ID, "subtitle", true)) . '" />
			</td>
		</tr>
		<tr>
			<td>
				<label>' . __('Featured image description', 'medicenter') . '</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="image_title" name="image_title" value="' . esc_attr(get_post_meta($post->ID, "image_title", true)) . '" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="gallery_video_url">' . __('Video URL (optional)', 'medicenter') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="gallery_video_url" name="gallery_video_url" value="' . esc_attr(get_post_meta($post->ID, "video_url", true)) . '" />
				<span class="description">' . __('For Vimeo please use http://player.vimeo.com/video/%video_id% For YouTube: http://youtube.com/embed/%video_id%', 'medicenter') . '</span>
			</td>
		</tr>
		<tr>
			<td>
				<label for="gallery_iframe_url">' . __('Ifame URL (optional)', 'medicenter') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="gallery_iframe_url" name="gallery_iframe_url" value="' . esc_attr(get_post_meta($post->ID, "iframe_url", true)) . '" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="gallery_external_url">' . __('External URL (optional)', 'medicenter') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="gallery_external_url" name="gallery_external_url" value="' . esc_attr(get_post_meta($post->ID, "external_url", true)) . '" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="gallery_external_url_target">' . __('External URL target', 'medicenter') . ':</label>
			</td>
			<td>
				<select id="gallery_external_url_target" name="gallery_external_url_target">
					<option value="same_window"' . ($external_url_target=="same_window" ? ' selected="selected"' : '') . '>' . __('same window', 'medicenter') . '</option>
					<option value="new_window"' . ($external_url_target=="new_window" ? ' selected="selected"' : '') . '>' . __('new window', 'medicenter') . '</option>
				</select>
			</td>
		</tr>
	</table>
	<div class="clearfix">
		<table class="meta_box_options_left">
			<tr valign="top">
				<th colspan="2" scope="row" style="font-weight: bold;">
					' . __('Social icons', 'medicenter') . '
				</th>
			</tr>';
			for($i=0; $i<(count($icon_type)<4 ? 4 : count($icon_type)); $i++)
			{
			echo '
			<tr class="repeated_row_id_1 repeated_row_' . ($i+1) . '">
				<td colspan="2">
					<table>
						<tr>
							<td>
								<label>' . __('Icon type', 'medicenter') . " " . ($i+1) . ':</label>
							</td>
							<td>
								<select id="icon_type_' . ($i+1) . '" name="icon_type[]">
									<option value="">-</option>';
									for($j=0; $j<count($icons); $j++)
									{
									echo '<option value="' . esc_attr($icons[$j]) . '"' . (isset($icon_type[$i]) && $icons[$j]==$icon_type[$i] ? " selected='selected'" : "") . '>' . $icons[$j] . '</option>';
									}
							echo '</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>' . __('Icon url', 'medicenter') . " " . ($i+1) . ':</label>
							</td>
							<td>
								<input type="text" class="regular-text" value="' . esc_attr($icon_url[$i]) . '" name="icon_url[]">
							</td>
						</tr>
						<tr>
							<td>
								<label>' . __('Icon target', 'medicenter') . " " . ($i+1) . ':</label>
							</td>
							<td>
								<select name="icon_target[]">
									<option value="same_window"' . ($icon_target[$i]=="same_window" ? " selected='selected'" : "") . '>' . __('same window', 'medicenter') . '</option>
									<option value="new_window"' . ($icon_target[$i]=="new_window" ? " selected='selected'" : "") . '>' . __('new window', 'medicenter') . '</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>' . __('Icon color', 'medicenter') . " " . ($i+1) . ':</label>
							</td>
							<td>
								<select name="icon_color[]">
									<option value="blue_light"' . ($icon_color[$i]=="blue_light" ? ' selected="selected"' : '') . '>' . __('light blue', 'medicenter') . '</option>
									<option value="blue"' . ($icon_color[$i]=="blue" ? ' selected="selected"' : '') . '>' . __('blue', 'medicenter') . '</option>
									<option value="blue_dark"' . ($icon_color[$i]=="blue_dark" ? ' selected="selected"' : '') . '>' . __('dark blue', 'medicenter') . '</option>
									<option value="black"' . ($icon_color[$i]=="black" ? ' selected="selected"' : '') . '>' . __('black', 'medicenter') . '</option>
									<option value="gray"' . ($icon_color[$i]=="gray" ? ' selected="selected"' : '') . '>' . __('gray', 'medicenter') . '</option>
									<option value="gray_dark"' . ($icon_color[$i]=="gray_dark" ? ' selected="selected"' : '') . '>' . __('dark gray', 'medicenter') . '</option>
									<option value="gray_light"' . ($icon_color[$i]=="gray_light" ? ' selected="selected"' : '') . '>' . __('light gray', 'medicenter') . '</option>
									<option value="green"' . ($icon_color[$i]=="green" ? ' selected="selected"' : '') . '>' . __('green', 'medicenter') . '</option>
									<option value="green_dark"' . ($icon_color[$i]=="green_dark" ? ' selected="selected"' : '') . '>' . __('dark green', 'medicenter') . '</option>
									<option value="green_light"' . ($icon_color[$i]=="green_light" ? ' selected="selected"' : '') . '>' . __('light green', 'medicenter') . '</option>
									<option value="orange"' . ($icon_color[$i]=="orange" ? ' selected="selected"' : '') . '>' . __('orange', 'medicenter') . '</option>
									<option value="orange_dark"' . ($icon_color[$i]=="orange_dark" ? ' selected="selected"' : '') . '>' . __('dark orange', 'medicenter') . '</option>
									<option value="orange_light"' . ($icon_color[$i]=="orange_light" ? ' selected="selected"' : '') . '>' . __('light orange', 'medicenter') . '</option>
									<option value="red"' . ($icon_color[$i]=="red" ? ' selected="selected"' : '') . '>' . __('red', 'medicenter') . '</option>
									<option value="red_dark"' . ($icon_color[$i]=="red_dark" ? ' selected="selected"' : '') . '>' . __('dark red', 'medicenter') . '</option>
									<option value="red_light"' . ($icon_color[$i]=="red_light" ? ' selected="selected"' : '') . '>' . __('light red', 'medicenter') . '</option>
									<option value="turquoise"' . ($icon_color[$i]=="turquoise" ? ' selected="selected"' : '') . '>' . __('turquoise', 'medicenter') . '</option>
									<option value="turquoise_dark"' . ($icon_color[$i]=="turquoise_dark" ? ' selected="selected"' : '') . '>' . __('dark turquoise', 'medicenter') . '</option>
									<option value="turquoise_light"' . ($icon_color[$i]=="turquoise_light" ? ' selected="selected"' : '') . '>' . __('light turquoise', 'medicenter') . '</option>
									<option value="violet"' . ($icon_color[$i]=="violet" ? ' selected="selected"' : '') . '>' . __('violet', 'medicenter') . '</option>
									<option value="violet_dark"' . ($icon_color[$i]=="violet_dark" ? ' selected="selected"' : '') . '>' . __('dark violet', 'medicenter') . '</option>
									<option value="violet_light"' . ($icon_color[$i]=="violet_light" ? ' selected="selected"' : '') . '>' . __('light violet', 'medicenter') . '</option>
									<option value="white"' . ($icon_color[$i]=="white" ? ' selected="selected"' : '') . '>' . __('white', 'medicenter') . '</option>
									<option value="yellow"' . ($icon_color[$i]=="yellow" ? ' selected="selected"' : '') . '>' . __('yellow', 'medicenter') . '</option>
								</select>
							</td>
						</tr>
					</table>
					<br />
				</td>
			</tr>';
			}
			echo '
			<tr>
				<td colspan="2">
					<input type="button" class="button ' . $themename . '_add_new_repeated_row" name="' . $themename . '_add_new_repeated_row" id="repeated_row_id_1" value="' . __('Add icon', 'medicenter') . '" />
				</td>
			</tr>
		</table>
		<table class="meta_box_options_right">
			<tr valign="top">
				<th colspan="2" scope="row" style="font-weight: bold;">
					' . __('Additional featured images', 'medicenter') . '
				</th>
			</tr>';
			for($i=0; $i<(count($images)<3 ? 3 : count($images)); $i++)
			{
			echo '
			<tr class="repeated_row_id_2 repeated_row_' . ($i+1) . '">
				<td colspan="2">
					<table>
						<tr class="image_url_row">
							<td>
								<label>' . __('Image url', 'medicenter') . " " . ($i+1) . '</label>
							</td>
							<td>
								<input type="hidden" name="attachment_ids[]" id="' . $themename . '_attachment_id_' . ($i+1) . '" value="' . esc_attr($attachment_ids[$i]) . '" />
								<input class="regular-text" type="text" id="' . $themename . '_image_url_' . ($i+1) . '" name="images[]" value="' . (isset($images[$i]) ? esc_attr($images[$i]) : "") . '" />
								<input type="button" class="button" name="' . $themename . '_upload_button" id="' . $themename . '_image_url_button_' . ($i+1) . '" value="' . __('Browse', 'medicenter') . '" />
							</td>
						</tr>
						<tr class="image_title_row">
							<td>
								<label>' . __('Image description', 'medicenter') . " " . ($i+1) . '</label>
							</td>
							<td>
								<input class="regular-text" type="text" id="' . $themename . '_image_title_' . ($i+1) . '" name="images_titles[]" value="' . esc_attr($images_titles[$i]) . '" />
							</td>
						</tr>
						<tr class="video_row">
							<td>
								<label>' . __('Video url', 'medicenter') . " " . ($i+1) . '</label>
							</td>
							<td>
								<input class="regular-text" type="text" id="' . $themename . '_video_' . ($i+1) . '" name="videos[]" value="' . esc_attr($videos[$i]) . '" />
							</td>
						</tr>
						<tr class="iframe_row">
							<td>
								<label>' . __('Iframe url', 'medicenter') . " " . ($i+1) . '</label>
							</td>
							<td>
								<input class="regular-text" type="text" id="' . $themename . '_iframe_' . ($i+1) . '" name="iframes[]" value="' . esc_attr($iframes[$i]) . '" />
							</td>
						</tr>
						<tr class="external_url_row">
							<td>
								<label>' . __('External url', 'medicenter') . " " . ($i+1) . '</label>
							</td>
							<td>
								<input class="regular-text" type="text" id="' . $themename . '_external_url_' . ($i+1) . '" name="external_urls[]" value="' . esc_attr($external_urls[$i]) . '" />
							</td>
						</tr>
					</table>
					<br />
				</td>
			</tr>';
			}
			echo '
			<tr>
				<td colspan="2">
					<input type="button" class="button ' . $themename . '_add_new_repeated_row" name="' . $themename . '_add_new_repeated_row" id="repeated_row_id_2" value="' . __('Add image', 'medicenter') . '" />
				</td>
			</tr>
			<tr>
				<td>
					<br />
					<label for="features_images_loop">' . __('Featured images lightbox loop', 'medicenter') . ':</label>
				</td>
				<td>
					<select id="features_images_loop" name="features_images_loop">
						<option value="yes"' . ($features_images_loop=="yes" ? ' selected="selected"' : '') . '>' . __('yes', 'medicenter') . '</option>
						<option value="no"' . ($features_images_loop=="no" ? ' selected="selected"' : '') . '>' . __('no', 'medicenter') . '</option>
					</select>
				</td>
			</tr>
		</table>
	</div>';
}

//When the post is saved, saves our custom data
function theme_save_gallery_postdata($post_id) 
{
	global $themename;
	//verify if this is an auto save routine. 
	//if it is our form has not been submitted, so we dont want to do anything
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

	//verify this came from the our screen and with proper authorization,
	//because save_post can be triggered at other times
	if (!isset($_POST[$themename . '_gallery_noncename']) || !wp_verify_nonce($_POST[$themename . '_gallery_noncename'], plugin_basename( __FILE__ )))
		return;


	//Check permissions
	if(!current_user_can('edit_post', $post_id))
		return;

	//OK, we're authenticated: we need to find and save the data
	update_post_meta($post_id, "subtitle", $_POST["gallery_subtitle"]);
	update_post_meta($post_id, "image_title", $_POST["image_title"]);
	update_post_meta($post_id, "video_url", $_POST["gallery_video_url"]);
	update_post_meta($post_id, "iframe_url", $_POST["gallery_iframe_url"]);
	update_post_meta($post_id, "external_url", $_POST["gallery_external_url"]);
	update_post_meta($post_id, "external_url_target", $_POST["gallery_external_url_target"]);
	$icon_type = (array)$_POST["icon_type"];
	while(end($icon_type)==="")
		array_pop($icon_type);
	update_post_meta($post_id, "social_icon_type", $icon_type);
	update_post_meta($post_id, "social_icon_url", $_POST["icon_url"]);
	update_post_meta($post_id, "social_icon_target", $_POST["icon_target"]);
	update_post_meta($post_id, "social_icon_color", $_POST["icon_color"]);
	update_post_meta($post_id, $themename . "_attachment_ids", $_POST["attachment_ids"]);
	$images = (array)$_POST["images"];
	while(end($images)==="")
		array_pop($images);
	update_post_meta($post_id, $themename . "_images", $images);
	update_post_meta($post_id, $themename . "_images_titles", $_POST["images_titles"]);
	update_post_meta($post_id, $themename . "_videos", $_POST["videos"]);
	update_post_meta($post_id, $themename . "_iframes", $_POST["iframes"]);
	update_post_meta($post_id, $themename . "_external_urls", $_POST["external_urls"]);
	update_post_meta($post_id, $themename . "_features_images_loop", $_POST["features_images_loop"]);
}
add_action("save_post", "theme_save_gallery_postdata");

function gallery_edit_columns($columns)
{
	$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => _x('Title', 'post type singular name', 'medicenter'),
			"video_url" => __('Video URL', 'medicenter'),
			"iframe_url" => __('Iframe URL', 'medicenter'),
			"external_url" => __('External URL', 'medicenter'),
			"medicenter_gallery_category" => __('Categories', 'medicenter'),
			"date" => __('Date', 'medicenter')
	);

	return $columns;
}
add_filter("manage_edit-gallery_columns", "gallery_edit_columns");

function manage_gallery_posts_custom_column($column)
{
	global $post;
	switch ($column)
	{
		case "video_url":   
			echo get_post_meta($post->ID, "video_url", true);  
			break;
		case "iframe_url":   
			echo get_post_meta($post->ID, "iframe_url", true);  
			break;
		case "external_url":   
			echo get_post_meta($post->ID, "external_url", true);  
			break;
		case "medicenter_gallery_category":
			echo get_the_term_list($post->ID, "medicenter_gallery_category", '', ', ','');
			break;
	}
}
add_action("manage_gallery_posts_custom_column", "manage_gallery_posts_custom_column");

add_shortcode("medicenter_gallery", "theme_gallery_shortcode");
//ajax pagination
add_action("wp_ajax_theme_gallery_pagination", "theme_gallery_shortcode");
add_action("wp_ajax_nopriv_theme_gallery_pagination", "theme_gallery_shortcode");

//visual composer
function theme_gallery_vc_init()
{
	//get gallery items list
	$gallery_items_list = get_posts(array(
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'medicenter_gallery'
	));
	$gallery_items_array = array();
	$gallery_items_array[__("All", 'medicenter')] = "-";
	foreach($gallery_items_list as $gallery_item)
		$gallery_items_array[$gallery_item->post_title . " (id:" . $gallery_item->ID . ")"] = $gallery_item->ID;

	//get gallery items categories list
	$gallery_items_categories = get_terms("medicenter_gallery_category");
	$gallery_items_categories_array = array();
	$gallery_items_categories_array[__("All", 'medicenter')] = "-";
	foreach($gallery_items_categories as $gallery_items_category)
		$gallery_items_categories_array[$gallery_items_category->name] =  $gallery_items_category->slug;
	
	//get all pages
	global $medicenter_pages_array;
	
	//image sizes
	$image_sizes_array = array();
	$image_sizes_array[__("Default", 'medicenter')] = "default";
	global $_wp_additional_image_sizes;
	foreach(get_intermediate_image_sizes() as $s) 
	{
		if(isset($_wp_additional_image_sizes[$s])) 
		{
			$width = intval($_wp_additional_image_sizes[$s]['width']);
			$height = intval($_wp_additional_image_sizes[$s]['height']);
		} 
		else
		{
			$width = get_option($s.'_size_w');
			$height = get_option($s.'_size_h');
		}
		$image_sizes_array[$s . " (" . $width . "x" . $height . ")"] = "mc_" . $s;
	}

	vc_map( array(
		"name" => __("Gallery items list", 'medicenter'),
		"base" => "medicenter_gallery",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-gallery-items-list",
		"category" => __('MediCenter', 'medicenter'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Header", 'medicenter'),
				"param_name" => "header",
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Header border animation", 'medicenter'),
				"param_name" => "animation",
				"value" => array(__("no", 'medicenter') => 0,  __("yes", 'medicenter') => 1)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order by", 'medicenter'),
				"param_name" => "order_by",
				"value" => array(__("Title, menu order", 'medicenter') => "title,menu_order", __("Menu order", 'medicenter') => "menu_order", __("Date", 'medicenter') => "date")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order", 'medicenter'),
				"param_name" => "order",
				"value" => array(__("ascending", 'medicenter') => "ASC", __("descending", 'medicenter') => "DESC")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Type", 'medicenter'),
				"param_name" => "type",
				"value" => array(__("List with details", 'medicenter') => "list_with_details", __("List", 'medicenter') => "list", __("Details", 'medicenter') => "details")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Layout", 'medicenter'),
				"param_name" => "layout",
				"value" => array(__("Item width 225px", 'medicenter') => "gallery_4_columns", __("Item width 480px", 'medicenter') => "gallery_2_columns", __("Item width 310px", 'medicenter') => "gallery_3_columns")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Featured image size", 'medicenter'),
				"param_name" => "featured_image_size",
				"value" => $image_sizes_array
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hover icons", 'medicenter'),
				"param_name" => "hover_icons",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => "0")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Title box in details", 'medicenter'),
				"param_name" => "title_box",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0),
				"dependency" => Array('element' => "type", 'value' => array('list_with_details'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Details page", 'medicenter'),
				"param_name" => "details_page",
				"value" => $medicenter_pages_array,
				"dependency" => Array('element' => "type", 'value' => array('list'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Display method", 'medicenter'),
				"param_name" => "display_method",
				"value" => array(__("Filters", 'medicenter') => 'dm_filters', __("Carousel", 'medicenter') => 'dm_carousel', __("Pagination", 'medicenter') => 'dm_pagination', __("Simple", 'medicenter') => 'dm_simple'),
				"dependency" => Array('element' => "type", 'value' => array('list_with_details', 'list'))
			),
			//filters options
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("All filter label", 'medicenter'),
				"param_name" => "all_label",
				"value" => __('All Departments', 'medicenter'),
				"dependency" => Array('element' => "display_method", 'value' => 'dm_filters')
			),
			//carousel options
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Id", 'medicenter'),
				"param_name" => "id",
				"value" => "carousel",
				"description" => __("Please provide unique id for each carousel on the same page/post", 'medicenter'),
				"dependency" => Array('element' => "display_method", 'value' => 'dm_carousel')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Autoplay", 'medicenter'),
				"param_name" => "autoplay",
				"value" => array(__("No", 'medicenter') => 0, __("Yes", 'medicenter') => 1),
				"dependency" => Array('element' => "display_method", 'value' => 'dm_carousel')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Pause on hover", 'medicenter'),
				"param_name" => "pause_on_hover",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0),
				"description" => __("Affect only when autoplay is set to yes", 'medicenter'),
				"dependency" => Array('element' => "display_method", 'value' => 'dm_carousel')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Scroll", 'medicenter'),
				"param_name" => "scroll",
				"value" => 1,
				"description" => __("Number of items to scroll in one step", 'medicenter'),
				"dependency" => Array('element' => "display_method", 'value' => 'dm_carousel')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Effect", 'medicenter'),
				"param_name" => "effect",
				"value" => array(
					__("scroll", 'medicenter') => "scroll", 
					__("none", 'medicenter') => "none", 
					__("directscroll", 'medicenter') => "directscroll",
					__("fade", 'medicenter') => "_fade",
					__("crossfade", 'medicenter') => "crossfade",
					__("cover", 'medicenter') => "cover",
					__("uncover", 'medicenter') => "uncover"
				),
				"dependency" => Array('element' => "display_method", 'value' => 'dm_carousel')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Sliding easing", 'medicenter'),
				"param_name" => "easing",
				"value" => array(
					__("swing", 'medicenter') => "swing", 
					__("linear", 'medicenter') => "linear", 
					__("easeInQuad", 'medicenter') => "easeInQuad",
					__("easeOutQuad", 'medicenter') => "easeOutQuad",
					__("easeInOutQuad", 'medicenter') => "easeInOutQuad",
					__("easeInCubic", 'medicenter') => "easeInCubic",
					__("easeOutCubic", 'medicenter') => "easeOutCubic",
					__("easeInOutCubic", 'medicenter') => "easeInOutCubic",
					__("easeInQuart", 'medicenter') => "easeInQuart",
					__("easeOutQuart", 'medicenter') => "easeOutQuart",
					__("easeInOutQuart", 'medicenter') => "easeInOutQuart",
					__("easeInSine", 'medicenter') => "easeInSine",
					__("easeOutSine", 'medicenter') => "easeOutSine",
					__("easeInOutSine", 'medicenter') => "easeInOutSine",
					__("easeInExpo", 'medicenter') => "easeInExpo",
					__("easeOutExpo", 'medicenter') => "easeOutExpo",
					__("easeInOutExpo", 'medicenter') => "easeInOutExpo",
					__("easeInQuint", 'medicenter') => "easeInQuint",
					__("easeOutQuint", 'medicenter') => "easeOutQuint",
					__("easeInOutQuint", 'medicenter') => "easeInOutQuint",
					__("easeInCirc", 'medicenter') => "easeInCirc",
					__("easeOutCirc", 'medicenter') => "easeOutCirc",
					__("easeInOutCirc", 'medicenter') => "easeInOutCirc",
					__("easeInElastic", 'medicenter') => "easeInElastic",
					__("easeOutElastic", 'medicenter') => "easeOutElastic",
					__("easeInOutElastic", 'medicenter') => "easeInOutElastic",
					__("easeInBack", 'medicenter') => "easeInBack",
					__("easeOutBack", 'medicenter') => "easeOutBack",
					__("easeInOutBack", 'medicenter') => "easeInOutBack",
					__("easeInBounce", 'medicenter') => "easeInBounce",
					__("easeOutBounce", 'medicenter') => "easeOutBounce",
					__("easeInOutBounce", 'medicenter') => "easeInOutBounce"
				),
				"dependency" => Array('element' => "display_method", 'value' => 'dm_carousel')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Sliding transition speed (ms)", 'medicenter'),
				"param_name" => "duration",
				"value" => 500,
				"dependency" => Array('element' => "display_method", 'value' => 'dm_carousel')
			),
			//pagination options
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Items per page", 'medicenter'),
				"param_name" => "items_per_page",
				"value" => 4,
				"dependency" => Array('element' => "display_method", 'value' => 'dm_pagination')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Ajax pagination", 'medicenter'),
				"param_name" => "ajax_pagination",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0),
				"dependency" => Array('element' => "display_method", 'value' => 'dm_pagination')
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display selected", 'medicenter'),
				"param_name" => "ids",
				"value" => $gallery_items_array
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display from Category", 'medicenter'),
				"param_name" => "category",
				"value" => $gallery_items_categories_array
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Display headers in details", 'medicenter'),
				"param_name" => "display_headers",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0),
				"dependency" => Array('element' => "type", 'value' => array('list_with_details', 'details'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Headers type", 'medicenter'),
				"param_name" => "headers_type",
				"value" => array(__("H2", 'medicenter') => "h2", __("H1", 'medicenter') => "h1", __("H3", 'medicenter') => "h3", __("H4", 'medicenter') => "h4", __("H5", 'medicenter') => "h5"),
				"dependency" => Array('element' => "type", 'value' => array('list_with_details', 'details'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Display social icons", 'medicenter'),
				"param_name" => "display_social_icons",
				"value" => array(__("Yes", 'medicenter') => 1, __("No", 'medicenter') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Lightbox images loop", 'medicenter'),
				"param_name" => "images_loop",
				"value" => array(__("No", 'medicenter') => 0, __("Yes", 'medicenter') => 1),
				"dependency" => Array('element' => "type", 'value' => array('list_with_details', 'list'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Lightbox icon color", 'medicenter'),
				"param_name" => "lightbox_icon_color",
				"value" => array(
					__("light blue", 'medicenter') => 'blue_light', 
					__("dark blue", 'medicenter') => 'blue_dark',
					__("blue", 'medicenter') => 'blue',
					__("black", 'medicenter') => 'black',
					__("gray", 'medicenter') => 'gray',
					__("dark gray", 'medicenter') => 'gray_dark',
					__("light gray", 'medicenter') => 'gray_light',
					__("green", 'medicenter') => 'green',
					__("dark green", 'medicenter') => 'green_dark',
					__("light green", 'medicenter') => 'green_light',
					__("orange", 'medicenter') => 'orange',
					__("dark orange", 'medicenter') => 'orange_dark',
					__("light orange", 'medicenter') => 'orange_light',
					__("red", 'medicenter') => 'red',
					__("dark red", 'medicenter') => 'red_dark',
					__("light red", 'medicenter') => 'red_light',
					__("turquoise", 'medicenter') => 'turquoise',
					__("dark turquoise", 'medicenter') => 'turquoise_dark',
					__("light turquoise", 'medicenter') => 'turquoise_light',
					__("violet", 'medicenter') => 'violet',
					__("dark violet", 'medicenter') => 'violet_dark',
					__("light violet", 'medicenter') => 'violet_light',
					__("white", 'medicenter') => 'white',
					__("yellow", 'medicenter') => 'yellow'
				)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'medicenter'),
				"param_name" => "top_margin",
				"value" => array(__("Section (large)", 'medicenter') => "page_margin_top_section", __("Page (small)", 'medicenter') => "page_margin_top", __("None", 'medicenter') => "none")
			)
		)
	));
}
add_action("init", "theme_gallery_vc_init");
?>