<?php
//custom post type - trainers
function theme_trainers_init()
{
	global $themename;
	$labels = array(
		'name' => _x('Trainers', 'post type general name', 'gymbase'),
		'singular_name' => _x('Trainer', 'post type singular name', 'gymbase'),
		'add_new' => _x('Add New', 'trainers', 'gymbase'),
		'add_new_item' => __('Add New Trainer', 'gymbase'),
		'edit_item' => __('Edit Trainer', 'gymbase'),
		'new_item' => __('New Trainer', 'gymbase'),
		'all_items' => __('All Trainers', 'gymbase'),
		'view_item' => __('View Trainer', 'gymbase'),
		'search_items' => __('Search Trainer', 'gymbase'),
		'not_found' =>  __('No trainers found', 'gymbase'),
		'not_found_in_trash' => __('No trainers found in Trash', 'gymbase'), 
		'parent_item_colon' => '',
		'menu_name' => __("Trainers", 'gymbase')
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
	register_post_type("trainers", $args);
	register_taxonomy("trainers_category", array("trainers"), array("label" => "Categories", "singular_label" => "Category", "rewrite" => true));
}  
add_action("init", "theme_trainers_init"); 

//Adds a box to the right column and to the main column on the Trainers edit screens
function theme_add_trainers_custom_box() 
{
	global $themename;
	add_meta_box( 
        "trainers_config",
        __("Options", 'gymbase'),
        "theme_inner_trainers_custom_box_main",
        "trainers",
		"normal",
		"high"
    );
}
add_action("add_meta_boxes", "theme_add_trainers_custom_box");
//backwards compatible (before WP 3.0)
//add_action("admin_init", "theme_add_custom_box", 1);

function theme_inner_trainers_custom_box_main($post)
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_trainers_noncename");
	
	echo '
	<table>
		<tr>
			<td>
				<label for="trainer_subtitle">' . __('Subtitle', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="trainer_subtitle" name="trainer_subtitle" value="' . esc_attr(get_post_meta($post->ID, "subtitle", true)) . '" />
			</td>
		</tr>
	</table>';
}

//When the post is saved, saves our custom data
function theme_save_trainers_postdata($post_id) 
{
	global $themename;
	//verify if this is an auto save routine. 
	//if it is our form has not been submitted, so we dont want to do anything
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

	//verify this came from the our screen and with proper authorization,
	//because save_post can be triggered at other times
	if(!isset($_POST[$themename . '_trainers_noncename']) || !wp_verify_nonce($_POST[$themename . '_trainers_noncename'], plugin_basename( __FILE__ )))
		return;


	//Check permissions
	if(!current_user_can('edit_post', $post_id))
		return;

	//OK, we're authenticated: we need to find and save the data
	update_post_meta($post_id, "subtitle", $_POST["trainer_subtitle"]);
}
add_action("save_post", "theme_save_trainers_postdata");

function trainers_edit_columns($columns)
{
	global $themename;
	$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => _x('Title', 'post type singular name', 'gymbase'),
			"trainers_category" => __('Categories', 'gymbase'),
			"date" => __('Date', 'gymbase')
	);

	return $columns;
}
add_filter("manage_edit-trainers_columns", "trainers_edit_columns");

function manage_trainers_posts_custom_column($column)
{
	global $themename;
	global $post;
	switch ($column)
	{
		case "trainers_category":
			echo get_the_term_list($post->ID, "trainers_category", '', ', ','');
			break;
	}
}
add_action("manage_trainers_posts_custom_column", "manage_trainers_posts_custom_column");

function theme_trainers_shortcode($atts)
{
	global $themename;
	global $post;
	
	extract(shortcode_atts(array(
		"category" => "",
		"top_margin" => "page_margin_top"
	), $atts));
	
	query_posts(array( 
		'post_type' => 'trainers',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'trainers_category' => $category,
		'orderby' => 'menu_order', 
		'order' => 'ASC'
	));
	
	$output = "";
	if(have_posts())
	{
		$categories = array_values(array_filter(explode(',', $category)));
		$categories_count = count($categories);
		$output .= '<ul class="tabs_navigation isotope_filters clearfix ' . $top_margin . '">
				<li>
					<a class="selected" href="#filter=*" title="' . __('All Trainers', 'gymbase') . '">' . __('All Trainers', 'gymbase') . '</a>
				</li>';
		for($i=0; $i<$categories_count; $i++)
		{
			$term = get_term_by('slug', $categories[$i], "trainers_category");
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
						<h2>' . get_the_title() . '</h2>
						<h3 class="subheader">' . get_the_excerpt() . '</h3>
						' . wpb_js_remove_wpautop(apply_filters('the_content', get_the_content())) . '
					</div>
				</div>
			</li>';
		endwhile;
		$output .= '</ul>
		<ul class="theme_gallery">';
		while(have_posts()): the_post();
			$categories = array_filter((array)get_the_terms(get_the_ID(), "trainers_category"));
			$categories_count = count($categories);
			$categories_string = "";
			$i = 0;
			foreach($categories as $category)
			{
				$categories_string .= urldecode($category->slug) . ($i+1<$categories_count ? ' ' : '');
				$i++;
			}
		$output .= '<li  class="' . $categories_string . '" id="gallery-item-' . $post->post_name . '">
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
							$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
							$large_image_url = $attachment_image[0];
				$output .= '<a href="' . $large_image_url . '" rel="gallery" class="fancybox open_lightbox"></a>
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
add_shortcode("trainers", "theme_trainers_shortcode");

//visual composer
function theme_trainers_vc_init()
{
	//get categories list
	$categories = get_terms("trainers_category");
	$categories_array = array();
	$categories_array[__("All", 'gymbase')] = "";
	foreach($categories as $category) {
		$categories_array[$category->name] = $category->slug;
	}
	
	vc_map( array(
		"name" => __("Trainers List", 'gymbase'),
		"base" => "trainers",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-trainers-list",
		"category" => __('GymBase', 'gymbase'),
		"params" => array(
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Category", 'gymbase'),
				"param_name" => "category",
				"value" => $categories_array
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'gymbase'),
				"param_name" => "top_margin",
				"value" => array( __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section", __("None", 'gymbase') => "page_margin_top_none")
			)
		)
	));
}
add_action("init", "theme_trainers_vc_init");
?>