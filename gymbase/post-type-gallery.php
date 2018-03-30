<?php
global $themename;
//custom post type - gallery
function theme_gallery_init()
{
	global $themename;
	$labels = array(
		'name' => _x('Gallery', 'post type general name', 'gymbase'),
		'singular_name' => _x('Gallery Item', 'post type singular name', 'gymbase'),
		'add_new' => _x('Add New', $themename . '_gallery', 'gymbase'),
		'add_new_item' => __('Add New Gallery Item', 'gymbase'),
		'edit_item' => __('Edit Gallery Item', 'gymbase'),
		'new_item' => __('New Gallery Item', 'gymbase'),
		'all_items' => __('All Gallery Items', 'gymbase'),
		'view_item' => __('View Gallery Item', 'gymbase'),
		'search_items' => __('Search Gallery Item', 'gymbase'),
		'not_found' =>  __('No gallery items found', 'gymbase'),
		'not_found_in_trash' => __('No gallery items found in Trash', 'gymbase'), 
		'parent_item_colon' => '',
		'menu_name' => __("Gallery", 'gymbase')
	);
	$args = array(  
		"labels" => $labels, 
		"public" => true,  
		"show_ui" => true,  
		"capability_type" => "post",  
		"menu_position" => 20,
		"hierarchical" => false,  
		"rewrite" => true,  
		"supports" => array("title", "editor", "thumbnail", "page-attributes")  
	);
	register_post_type($themename . "_gallery", $args);  
	
	register_taxonomy($themename . "_gallery_category", array($themename . "_gallery"), array("label" => "Categories", "singular_label" => "Category", "rewrite" => true)); 
}  
add_action("init", "theme_gallery_init"); 

//Adds a box to the main column on the Gallery edit screens
function theme_add_gallery_custom_box() 
{
	global $themename;
    add_meta_box( 
        "gallery_config",
        __("Options", 'gymbase'),
        "theme_inner_gallery_custom_box",
        $themename . "_gallery",
		"normal",
		"high"
    );
}
add_action("add_meta_boxes", "theme_add_gallery_custom_box");
//backwards compatible (before WP 3.0)
//add_action("admin_init", "theme_add_custom_box", 1);

// Prints the box content
function theme_inner_gallery_custom_box($post) 
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_gallery_noncename");

	//The actual fields for data entry
	$external_url_target = get_post_meta($post->ID, "external_url_target", true);
	echo '
	<table>
		<tr>
			<td>
				<label for="subtitle">' . __('Subtitle', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="subtitle" name="subtitle" value="' . esc_attr(get_post_meta($post->ID, "subtitle", true)) . '" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="gallery_video_url">' . __('Video URL (optional)', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="gallery_video_url" name="gallery_video_url" value="' . esc_attr(get_post_meta($post->ID, "video_url", true)) . '" />
				<span class="description">For Vimeo please use http://player.vimeo.com/video/%video_id%</span>
			</td>
		</tr>
		<tr>
			<td>
				<label for="gallery_iframe_url">' . __('Ifame URL (optional)', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="gallery_iframe_url" name="gallery_iframe_url" value="' . esc_attr(get_post_meta($post->ID, "iframe_url", true)) . '" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="gallery_external_url">' . __('External URL (optional)', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="gallery_external_url" name="gallery_external_url" value="' . esc_attr(get_post_meta($post->ID, "external_url", true)) . '" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="gallery_external_url_target">' . __('External URL target', 'gymbase') . ':</label>
			</td>
			<td>
				<select id="gallery_external_url_target" name="gallery_external_url_target">
					<option value="same_window"' . ($external_url_target=="same_window" ? ' selected="selected"' : '') . '>' . __('same window', 'gymbase') . '</option>
					<option value="new_window"' . ($external_url_target=="new_window" ? ' selected="selected"' : '') . '>' . __('new window', 'gymbase') . '</option>
				</select>
			</td>
		</tr>
	</table>
	';
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
	if(!isset($_POST[$themename . '_gallery_noncename']) || !wp_verify_nonce($_POST[$themename . '_gallery_noncename'], plugin_basename( __FILE__ )))
		return;


	//Check permissions
	if(!current_user_can('edit_post', $post_id))
		return;

	//OK, we're authenticated: we need to find and save the data
	update_post_meta($post_id, "subtitle", $_POST["subtitle"]);
	update_post_meta($post_id, "video_url", $_POST["gallery_video_url"]);
	update_post_meta($post_id, "iframe_url", $_POST["gallery_iframe_url"]);
	update_post_meta($post_id, "external_url", $_POST["gallery_external_url"]);
	update_post_meta($post_id, "external_url_target", $_POST["gallery_external_url_target"]);
}
add_action("save_post", "theme_save_gallery_postdata");

//custom gallery items list
function gymbase_gallery_edit_columns($columns)
{
	global $themename;
	$columns = array(  
		"cb" => "<input type=\"checkbox\" />",  
		"title" => _x('gallery Item', 'post type singular name', 'gymbase'),   
		"video_url" => __('Video URL', 'gymbase'),
		"iframe_url" => __('Iframe URL', 'gymbase'),
		"external_url" => __('External URL', 'gymbase'),
		$themename . "_gallery_category" => __('Categories', 'gymbase'),
		"date" => __('Date', 'gymbase')
	);    

	return $columns;  
}  
add_filter("manage_edit-" . $themename . "_gallery_columns", $themename . "_gallery_edit_columns");   

function manage_gymbase_gallery_posts_custom_column($column)
{
	global $themename;
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
		case $themename . "_gallery_category":
			echo get_the_term_list($post->ID, $themename . "_gallery_category", '', ', ',''); 
			break;
	}  
}
add_action("manage_" . $themename . "_gallery_posts_custom_column", "manage_" . $themename . "_gallery_posts_custom_column");

function theme_gallery_shortcode($atts)
{
	global $themename;
	global $post;
	
	extract(shortcode_atts(array(
		"category" => ""
	), $atts));
	
	query_posts(array( 
		'post_type' => $themename . '_gallery',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		$themename . '_gallery_category' => $category,
		'orderby' => 'menu_order', 
		'order' => 'ASC'
	));
	
	$output = "";
	if(have_posts())
	{
		$categories = array_values(array_filter(explode(',', $category)));
		$categories_count = count($categories);
		$output .= '<ul class="tabs_navigation isotope_filters clearfix page_margin_top">
				<li>
					<a class="selected" href="#filter=*" title="' . __('All Classes', 'gymbase') . '">' . __('All Classes', 'gymbase') . '</a>
				</li>';
		for($i=0; $i<$categories_count; $i++)
		{
			$term = get_term_by('slug', $categories[$i], $themename . "_gallery_category");
			$output .= '<li>
					<a href="#filter=.' . trim($categories[$i]) . '" title="' . esc_attr($term->name) . '">' . $term->name . '</a>
				</li>';
		}
		$output .= '</ul>
		<ul class="gallery_item_details_list clearfix page_margin_top">';
		while(have_posts()): the_post();
			$output .= '<li id="gallery-details-' . $post->post_name . '" class="gallery_item_details clearfix">
				<div class="image_box">';
					if(has_post_thumbnail())
						$output .= get_the_post_thumbnail(get_the_ID(), $themename . "-gallery-image", array("alt" => get_the_title(), "title" => ""));
				$output .= '<ul class="controls">
						<li>
							<a href="#gallery-details-close" class="close"></a>
						</li>
						<li>
							<a href="#" class="prev"></a>
						</li>
						<li>
							<a href="#" class="next"></a>
						</li>
					</ul>
				</div>
				<div class="details_box_outer">
					<div class="details_box">
						<h2>' . get_the_title() . '</h2><h3 class="subheader">' . get_post_meta(get_the_ID(), "subtitle", true) . '</h3>' . wpb_js_remove_wpautop(apply_filters('the_content', get_the_content())) . '
					</div>
				</div>
			</li>';
		endwhile;
		$output .= '</ul>
		<ul class="theme_gallery">';
		while(have_posts()): the_post();
			$categories = array_filter((array)get_the_terms(get_the_ID(), $themename . "_gallery_category"));
			$categories_count = count($categories);
			$categories_string = "";
			$i = 0;
			foreach($categories as $category)
			{
				$categories_string .= urldecode($category->slug) . ($i+1<$categories_count ? ' ' : '');
				$i++;
			}
			$output .= '<li class="' . $categories_string . '" id="gallery-item-' . $post->post_name . '">
					<div class="gallery_box">';
					if(has_post_thumbnail())
						$output .= get_the_post_thumbnail(get_the_ID(), $themename . "-gallery-thumb", array("alt" => get_the_title(), "title" => ""));
				$output .= '
						<div class="description icon_small_arrow top_white">
							<h3>' . get_the_title() . '</h3>
							<h5>' . get_post_meta(get_the_ID(), "subtitle", true) . '</h5>
						</div>
						<ul class="controls">
							<li>
								<a href="#gallery-details-' . $post->post_name . '" class="open_details"></a>
							</li>
							<li>';
								$video_url = get_post_meta(get_the_ID(), "video_url", true);
								if($video_url!="")
									$large_image_url = $video_url;
								else
								{
									$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
									$large_image_url = $attachment_image[0];
								}
								$external_url = get_post_meta(get_the_ID(), "external_url", true);
								$external_url_target = get_post_meta(get_the_ID(), "external_url_target", true);
								$iframe_url = get_post_meta(get_the_ID(), "iframe_url", true);
								$output .= '<a' . ($external_url!="" && $external_url_target=="new_window" ? ' target="_blank"' : '') . ' href="' . ($external_url=="" ? ($iframe_url!="" ? $iframe_url : $large_image_url) : $external_url) . '" class="fancybox' . ($video_url!="" ? '-video' : ($iframe_url!="" ? '-iframe' : ($external_url!="" ? '-url' : ''))) . ' open' . ($video_url!="" ? '_video' : ($iframe_url!="" ? '_iframe' : ($external_url!="" ? '_url' : ''))) . '_lightbox"></a>
							</li>
						</ul>
					</div>
				</li>';
		endwhile;
		$output .= '</ul>';
	}
	//Reset Query
	wp_reset_query();
	return $output;
}
add_shortcode($themename . "_gallery", "theme_gallery_shortcode");

//visual composer
function theme_gymbase_gallery_vc_init()
{
	//get categories list
	$categories = get_terms("gymbase_gallery_category");
	$categories_array = array();
	$categories_array[__("All", 'gymbase')] = "";
	foreach($categories as $category) {
		$categories_array[$category->name] = $category->slug;
	}
	
	vc_map( array(
		"name" => __("Gallery", 'gymbase'),
		"base" => "gymbase_gallery",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-gallery",
		"category" => __('GymBase', 'gymbase'),
		"params" => array(
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Category", 'gymbase'),
				"param_name" => "category",
				"value" => $categories_array
			)
		)
	));
}
add_action("init", "theme_gymbase_gallery_vc_init");
?>