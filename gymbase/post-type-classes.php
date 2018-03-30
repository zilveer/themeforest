<?php
//custom post type - classes
function theme_classes_init()
{
	global $themename;
	global $blog_id;
	global $wpdb;
	$labels = array(
		'name' => _x('Classes', 'post type general name', 'gymbase'),
		'singular_name' => _x('Class', 'post type singular name', 'gymbase'),
		'add_new' => _x('Add New', 'classes', 'gymbase'),
		'add_new_item' => __('Add New Class', 'gymbase'),
		'edit_item' => __('Edit Class', 'gymbase'),
		'new_item' => __('New Class', 'gymbase'),
		'all_items' => __('All Classes', 'gymbase'),
		'view_item' => __('View Class', 'gymbase'),
		'search_items' => __('Search Class', 'gymbase'),
		'not_found' =>  __('No classes found', 'gymbase'),
		'not_found_in_trash' => __('No classes found in Trash', 'gymbase'), 
		'parent_item_colon' => '',
		'menu_name' => __("Classes", 'gymbase')
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
	register_post_type("classes", $args);
	
	register_taxonomy("classes_category", array("classes"), array("label" => "Categories", "singular_label" => "Category", "rewrite" => true)); 
	if(get_option($themename . "_class_hours_table_installed") && !get_option($themename . "_class_hours_table_renamed"))
	{
		// CHECK IF OLD TABLE NAME EXISTS AND CHANGE IT TO NEW ONE		
		if($wpdb->query("SHOW TABLES LIKE 'wp_" . $blog_id . "_class_hours'") && ("wp_" . $blog_id . "_")!=($wpdb->prefix) )
		{
			$query = "RENAME TABLE `wp_" . $blog_id . "_class_hours` to `".$wpdb->prefix."class_hours` ";
			$wpdb->query($query);
		}
		add_option($themename . "_class_hours_table_renamed", 1);
    }
	if(!get_option($themename . "_class_hours_table_installed"))
	{
		//create custom db table
		$query = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."class_hours` (
			`class_hours_id` BIGINT( 20 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
			`class_id` BIGINT( 20 ) NOT NULL ,
			`weekday_id` BIGINT( 20 ) NOT NULL ,
			`start` TIME NOT NULL ,
			`end` TIME NOT NULL,
			`tooltip` text NOT NULL,
			`before_hour_text` text NOT NULL,
			`after_hour_text` text NOT NULL,
			`trainers` varchar(255) NOT NULL,
			`category` varchar(255) NOT NULL,
			INDEX ( `class_id` ),
			INDEX ( `weekday_id` )
		) ENGINE = MYISAM DEFAULT CHARSET=utf8;";
		$wpdb->query($query);
		//insert sample data
		$query = "INSERT INTO `".$wpdb->prefix."class_hours` (`class_hours_id`, `class_id`, `weekday_id`, `start`, `end`, `tooltip`, `before_hour_text`, `after_hour_text`, `trainers`, `category`) VALUES
			(1, 33, 43, '06:00:00', '07:00:00', '', '', '', '', ''),
			(2, 33, 42, '06:00:00', '07:00:00', '', '', '', '', ''),
			(58, 34, 44, '16:00:00', '17:30:00', '', '', '', '', ''),
			(57, 34, 38, '11:00:00', '12:00:00', '', '', '', '', ''),
			(5, 33, 39, '17:00:00', '18:00:00', '', '', '', '', ''),
			(6, 33, 38, '17:00:00', '18:00:00', '', '', '', '', ''),
			(7, 34, 43, '16:00:00', '17:30:00', '', '', '', '', ''),
			(8, 34, 42, '16:00:00', '17:30:00', '', '', '', '', ''),
			(9, 34, 40, '16:00:00', '17:30:00', '', '', '', '', ''),
			(10, 34, 39, '08:00:00', '09:30:00', '', '', '', '', ''),
			(11, 34, 38, '08:00:00', '09:30:00', '', '', '', '', ''),
			(71, 33, 38, '10:00:00', '11:00:00', '', '', '', '', ''),
			(70, 33, 39, '10:00:00', '11:00:00', '', '', '', '', ''),
			(69, 63, 44, '18:00:00', '20:00:00', '', '', '', '', ''),
			(68, 33, 39, '12:00:00', '13:00:00', '', '', '', '', ''),
			(67, 33, 38, '12:00:00', '13:00:00', '', '', '', '', ''),
			(66, 33, 40, '12:00:00', '13:00:00', '', '', '', '', ''),
			(65, 33, 41, '12:00:00', '13:00:00', '', '', '', '', ''),
			(19, 61, 43, '07:00:00', '08:00:00', '', '', '', '', ''),
			(20, 61, 42, '07:00:00', '08:00:00', '', '', '', '', ''),
			(21, 61, 40, '10:00:00', '11:30:00', '', '', '', '', ''),
			(22, 61, 44, '10:00:00', '11:30:00', '', '', '', '', ''),
			(23, 61, 39, '14:00:00', '16:00:00', '', '', '', '', ''),
			(24, 61, 38, '14:00:00', '16:00:00', '', '', '', '', ''),
			(27, 33, 43, '14:00:00', '16:15:00', '', '', '', '', ''),
			(28, 33, 42, '14:00:00', '16:15:00', '', '', '', '', ''),
			(29, 33, 44, '17:30:00', '20:00:00', '', '', '', '', ''),
			(30, 34, 43, '09:00:00', '11:25:00', '', '', '', '', ''),
			(31, 34, 42, '09:00:00', '11:25:00', '', '', '', '', ''),
			(32, 34, 39, '11:00:00', '12:00:00', '', '', '', '', ''),
			(44, 63, 39, '12:00:00', '15:45:00', '', '', '', '', ''),
			(41, 63, 43, '05:00:00', '06:00:00', '', '', '', '', ''),
			(43, 63, 44, '12:00:00', '15:45:00', '', '', '', '', ''),
			(40, 63, 43, '18:00:00', '19:00:00', '', '', '', '', ''),
			(42, 63, 42, '05:00:00', '06:00:00', '', '', '', '', ''),
			(45, 63, 42, '18:00:00', '19:00:00', '', '', '', '', ''),
			(46, 63, 41, '18:00:00', '20:00:00', '', '', '', '', ''),
			(47, 63, 40, '18:00:00', '20:00:00', '', '', '', '', ''),
			(52, 33, 41, '06:00:00', '08:30:00', '', '', '', '', ''),
			(56, 34, 44, '09:00:00', '10:00:00', '', '', '', '', ''),
			(55, 34, 40, '09:00:00', '10:00:00', '', '', '', '', ''),
			(53, 33, 40, '06:00:00', '08:30:00', '', '', '', '', ''),
			(54, 33, 44, '06:00:00', '08:30:00', '', '', '', '', ''),
			(59, 55, 43, '18:30:00', '20:00:00', '', '', '', '', ''),
			(60, 55, 42, '18:30:00', '20:00:00', '', '', '', '', ''),
			(61, 55, 41, '18:30:00', '20:00:00', '', '', '', '', ''),
			(62, 55, 40, '18:30:00', '20:00:00', '', '', '', '', ''),
			(63, 55, 39, '19:00:00', '20:30:00', '', '', '', '', ''),
			(64, 55, 38, '19:00:00', '20:30:00', '', '', '', '', ''),
			(75, 61, 40, '06:00:00', '08:30:00', '', '', '', '', ''),
			(74, 61, 41, '06:00:00', '08:30:00', '', '', '', '', ''),
			(76, 61, 44, '06:00:00', '08:30:00', '', '', '', '', '');";
		$wpdb->query($query);
		add_option($themename . "_class_hours_table_installed", 1);
		add_option($themename . "_class_hours_table_updated_new", 1);
	}
	else if(!get_option($themename . "_class_hours_table_updated_new"))
	{
		$query = "ALTER TABLE `".$wpdb->prefix."class_hours` 
			ADD `tooltip` TEXT NOT NULL ,
			ADD `before_hour_text` TEXT NOT NULL ,
			ADD `after_hour_text` TEXT NOT NULL ,
			ADD `trainers` VARCHAR( 255 ) NOT NULL ,
			ADD `category` VARCHAR( 255 ) NOT NULL";
		$wpdb->query($query);
		add_option($themename . "_class_hours_table_updated_new", 1);
	}
}  
add_action("init", "theme_classes_init"); 

//Adds a box to the right column and to the main column on the Classes edit screens
function theme_add_classes_custom_box() 
{
	global $themename;
    add_meta_box(
        "class_hours",
        __("Class hours", 'gymbase'),
        "theme_inner_classes_custom_box_side",
        "classes",
		"normal"
    );
	add_meta_box( 
        "class_config",
        __("Options", 'gymbase'),
        "theme_inner_classes_custom_box_main",
        "classes",
		"normal",
		"high"
    );
}
add_action("add_meta_boxes", "theme_add_classes_custom_box");
//backwards compatible (before WP 3.0)
//add_action("admin_init", "theme_add_custom_box", 1);

//get class hour details
function theme_get_class_hour_details()
{
	global $blog_id;
	global $wpdb;
	$query = "SELECT * FROM `".$wpdb->prefix."class_hours` AS t1 LEFT JOIN {$wpdb->posts} AS t2 ON t1.weekday_id=t2.ID WHERE t1.class_id='" . $_POST["post_id"] . "' AND t1.class_hours_id='" . $_POST["id"] . "'";
	$class_hour = $wpdb->get_row($query);
	$class_hour->start = date("H:i", strtotime($class_hour->start));
	$class_hour->end = date("H:i", strtotime($class_hour->end));
	echo "class_hour_start" . json_encode($class_hour) . "class_hour_end";
	exit();
}
add_action('wp_ajax_get_class_hour_details', 'theme_get_class_hour_details');

// Prints the box content
function theme_inner_classes_custom_box_side($post) 
{
	global $themename;
	global $blog_id;
	global $wpdb;
	
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_classes_noncename");

	//The actual fields for data entry
	$query = "SELECT * FROM `".$wpdb->prefix."class_hours` AS t1 LEFT JOIN {$wpdb->posts} AS t2 ON t1.weekday_id=t2.ID WHERE t1.class_id='" . $post->ID . "' ORDER BY FIELD(t2.menu_order,2,3,4,5,6,7,1), t1.start, t1.end";
	$class_hours = $wpdb->get_results($query);
	$class_hours_count = count($class_hours);
	
	//get weekdays
	$query = "SELECT ID, post_title FROM {$wpdb->posts}
			WHERE 
			post_type='" . $themename . "_weekdays'
			ORDER BY FIELD(menu_order,2,3,4,5,6,7,1)";
	$weekdays = $wpdb->get_results($query);
	
	echo '
	<ul id="class_hours_list"' . (!$class_hours_count ? ' style="display: none;"' : '') . '>';
		for($i=0; $i<$class_hours_count; $i++)
		{
			//get day by id
			$current_day = get_post($class_hours[$i]->weekday_id);
			echo '<li id="class_hours_' . $class_hours[$i]->class_hours_id . '">' . $current_day->post_title . ' ' . date("H:i", strtotime($class_hours[$i]->start)) . '-' . date("H:i", strtotime($class_hours[$i]->end)) . '<img class="operation_button delete_button" src="' . get_template_directory_uri() . '/images/delete.png" alt="del" /><img class="operation_button edit_button" src="' . get_template_directory_uri() . '/images/edit.png" alt="edit" /><img class="operation_button edit_hour_class_loader" src="' . get_template_directory_uri() . '/admin/images/ajax-loader.gif" alt="loader" />';
			$trainersString = "";
			if($class_hours[$i]->trainers!="")
			{
				query_posts(array( 
					'post__in' => explode(",", $class_hours[$i]->trainers),
					'post_type' => 'trainers',
					'posts_per_page' => '-1',
					'post_status' => 'publish',
					'orderby' => 'post_title', 
					'order' => 'DESC'
				));
				while(have_posts()): the_post();
					$trainersString .= get_the_title() . ", ";
				endwhile;
				if($trainersString!="")
					$trainersString = substr($trainersString, 0, -2);
			}
			if($class_hours[$i]->tooltip!="" || $class_hours[$i]->before_hour_text!="" || $class_hours[$i]->after_hour_text!="" || $trainersString!="" || $class_hours[$i]->category!="")
			{
				echo '<div>';
				if($class_hours[$i]->tooltip!="")
					echo '<br /><strong>' . __('Tooltip', 'gymbase') . ':</strong> ' . $class_hours[$i]->tooltip;
				if($class_hours[$i]->before_hour_text!="")
					echo '<br /><strong>' . __('Before hour text', 'gymbase') . ':</strong> ' . $class_hours[$i]->before_hour_text;
				if($class_hours[$i]->after_hour_text!="")
					echo '<br /><strong>' . __('After hour text', 'gymbase') . ':</strong> ' . $class_hours[$i]->after_hour_text;
				if($trainersString)
					echo '<br /><strong>' . __('Trainers', 'gymbase') . ':</strong> ' . $trainersString;
				if($class_hours[$i]->category!="")
					echo '<br /><strong>' . __('Category', 'gymbase') . ':</strong> ' . $class_hours[$i]->category;
				echo '</div>';
			}
			echo '</li>';
		}
	echo '
	</ul>
	<table id="class_hours_table">
		<tr>
			<td>
				<label for="weekday_id">' . __('Day', 'gymbase') . ':</label>
			</td>
			<td>
				<select name="weekday_id" id="weekday_id">';
				foreach($weekdays as $weekday)
					echo '<option value="' . $weekday->ID . '">' . $weekday->post_title . '</option>';
	echo '		</select>
			</td>
		</tr>
		<tr>
			<td>
				<label for="start_hour">' . __('Start hour', 'gymbase') . ':</label>
			</td>
			<td>
				<input size="5" maxlength="5" type="text" id="start_hour" name="start_hour" value="" />
				<span class="description">hh:mm</span>
			</td>
		</tr>
		<tr>
			<td>
				<label for="end_hour">' . __('End hour', 'gymbase') . ':</label>
			</td>
			<td>
				<input size="5" maxlength="5" type="text" id="end_hour" name="end_hour" value="" />
				<span class="description">hh:mm</span>
			</td>
		</tr>
		<tr>
			<td>
				<label for="before_hour_text">' . __('Before hour text', 'gymbase') . ':</label>
			</td>
			<td>
				<textarea id="before_hour_text" name="before_hour_text"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<label for="after_hour_text">' . __('After hour text', 'gymbase') . ':</label>
			</td>
			<td>
				<textarea id="after_hour_text" name="after_hour_text"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<label for="tooltip">' . __('Tooltip', 'gymbase') . ':</label>
			</td>
			<td>
				<textarea id="tooltip" name="tooltip"></textarea>
			</td>
		</tr>';
		if(wp_count_posts("trainers"))
		{
			echo '
		<tr>
			<td>
				<label for="trainers">' . __('Trainers', 'gymbase') . ':</label>
			</td>
			<td>
				<select id="class_hour_trainers" name="class_hour_trainers[]" multiple="multiple">';
					query_posts(array( 
						'post_type' => 'trainers',
						'posts_per_page' => '-1',
						'post_status' => 'publish',
						'orderby' => 'post_title', 
						'order' => 'DESC'
					));
					while(have_posts()): the_post();
						echo '<option value="' . get_the_ID() . '"' . (!empty($trainers) && in_array(get_the_ID(), (array)$trainers) ? ' selected="selected"' : '') . '>' . get_the_title() . '</option>';
					endwhile;
			echo '
				</select>
			</td>
		</tr>';
		}
		echo '
		<tr>
			<td>
				<label for="class_hour_category">' . __('Category', 'gymbase') . ':</label>
			</td>
			<td>
				<input type="text" id="class_hour_category" name="class_hour_category" value="" />
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: right;">
				<input id="add_class_hours" type="button" class="button" value="' . __("Add", 'gymbase') . '" />
			</td>
		</tr>
	</table>
	';
	//Reset Query
	wp_reset_query();
}

function theme_inner_classes_custom_box_main($post)
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_classes_noncename");
	
	//The actual fields for data entry
	$trainers = get_post_meta($post->ID, $themename . "_trainers", true);
	echo '
	<table>
		<tr>
			<td>
				<label for="subtitle">' . __('Subtitle', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="subtitle" name="subtitle" value="' . esc_attr(get_post_meta($post->ID, $themename . "_subtitle", true)) . '" />
			</td>
		</tr>';
		if(wp_count_posts("trainers"))
		{
			echo '
		<tr>
			<td>
				<label for="trainers">' . __('Trainers', 'gymbase') . ':</label>
			</td>
			<td>
				<select id="trainers" name="trainers[]" multiple="multiple">';
					query_posts(array( 
						'post_type' => 'trainers',
						'posts_per_page' => '-1',
						'post_status' => 'publish',
						'orderby' => 'post_title', 
						'order' => 'DESC'
					));
					while(have_posts()): the_post();
						echo '<option value="' . get_the_ID() . '"' . (in_array(get_the_ID(), (array)$trainers) ? ' selected="selected"' : '') . '>' . get_the_title() . '</option>';
					endwhile;
			echo '
				</select>
			</td>
		</tr>';
		}
		echo '
		<tr>
			<td>
				<label for="color">' . __('Timetable box background color', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text color" type="text" id="color" name="color" value="' . esc_attr(get_post_meta($post->ID, $themename . "_color", true)) . '" data-default-color="FFFFFF" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="text_color">' . __('Timetable box text color', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text color" type="text" id="text_color" name="text_color" value="' . esc_attr(get_post_meta($post->ID, $themename . "_text_color", true)) . '" data-default-color="FFFFFF" />
			</td>
		</tr>
	</table>';
}

//When the post is saved, saves our custom data
function theme_save_classes_postdata($post_id) 
{
	global $themename;
	global $blog_id;
	global $wpdb;
	//verify if this is an auto save routine. 
	//if it is our form has not been submitted, so we dont want to do anything
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

	//verify this came from the our screen and with proper authorization,
	//because save_post can be triggered at other times
	if (!isset($_POST[$themename . '_classes_noncename']) || !wp_verify_nonce($_POST[$themename . '_classes_noncename'], plugin_basename( __FILE__ )))
		return;


	//Check permissions
	if(!current_user_can('edit_post', $post_id))
		return;

	//OK, we're authenticated: we need to find and save the data
	$hours_count = count($_POST["weekday_ids"]);
	for($i=0; $i<$hours_count; $i++)
	{
		$query = "INSERT INTO `".$wpdb->prefix."class_hours` VALUES(
			NULL,
			'" . $post_id . "',
			'" . $_POST["weekday_ids"][$i] . "',
			'" . $_POST["start_hours"][$i] . "',
			'" . $_POST["end_hours"][$i] . "',
			'" . $_POST["tooltips"][$i] . "',
			'" . $_POST["before_hour_texts"][$i] . "',
			'" . $_POST["after_hour_texts"][$i] . "',
			'" . $_POST["class_hours_trainers"][$i] . "',
			'" . $_POST["class_hours_category"][$i] . "'
		);";
		$wpdb->query($query);
	}
	//removing data if needed
	$delete_class_hours_ids_count = count($_POST["delete_class_hours_ids"]);
	if($delete_class_hours_ids_count)
		$wpdb->query("DELETE FROM `".$wpdb->prefix."class_hours` WHERE class_hours_id IN(" . implode(",", $_POST["delete_class_hours_ids"]) . ");");
	//post meta
	update_post_meta($post_id, $themename . "_subtitle", $_POST["subtitle"]);
	update_post_meta($post_id, $themename . "_trainers", $_POST["trainers"]);
	update_post_meta($post_id, $themename . "_color", $_POST["color"]);
	update_post_meta($post_id, $themename . "_text_color", $_POST["text_color"]);
}
add_action("save_post", "theme_save_classes_postdata");

//custom classes items list
function classes_edit_columns($columns)
{
	global $themename;
	$columns = array(  
		"cb" => "<input type=\"checkbox\" />",  
		"title" => _x('Title', 'post type singular name', 'gymbase'),
		"classes_category" => __('Categories', 'gymbase'),
		"date" => __('Date', 'gymbase')
	);    

	return $columns;  
}  
add_filter("manage_edit-classes_columns", "classes_edit_columns"); 

function manage_classes_posts_custom_column($column)
{
	global $themename;
	global $post;
	switch ($column)  
	{
		case "classes_category":
			echo get_the_term_list($post->ID, "classes_category", '', ', ',''); 
			break;
	}  
}
add_action("manage_classes_posts_custom_column", "manage_classes_posts_custom_column");

//classes sidebar
function theme_classes_sidebar($atts, $content)
{
	global $themename;
	
	extract(shortcode_atts(array(
		"order" => "ASC",
		"classes_url" => get_home_url() . "/classes",
		"timetable_url" => get_home_url() . "/timetable",
		"category" => ""		
	), $atts));
	
	query_posts(array(
		'post_type' => 'classes',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'order' => $order,
		'classes_category' => $category
	));
	
	$output = '';
	if(have_posts()):
		$output .= '<ul class="accordion">';
		while(have_posts()): the_post();
			global $post;
			$output .= '<li>
				<div id="accordion-' . urldecode($post->post_name) . '">
					<h3>' . get_the_title() . '</h3>
					<h5>' . esc_attr(get_post_meta($post->ID, "subtitle", true)) . '</h5>
				</div>
				<div class="clearfix">
					<div class="item_content clearfix">';
						if(has_post_thumbnail())
							$output .= '<a class="thumb_image" href="' . $classes_url . '/#' . urldecode($post->post_name) . '" title="' . get_the_title() . '">
								' . get_the_post_thumbnail(get_the_ID(), $themename . "-small-thumb", array("alt" => get_the_title(), "title" => "")) . '
							</a>';
			$output .= '<div class="text">
							' . get_the_excerpt() . '
						</div>
					</div>
					<div class="item_footer clearfix">
						<a class="more icon_small_arrow margin_right_white" href="' . $classes_url . '/#' . urldecode($post->post_name) . '" title="' . __("Details", 'gymbase') . '">' . __("Details", 'gymbase') . '</a>
						<a class="more icon_small_arrow margin_right_white" href="' . $timetable_url . '/#' . urldecode($post->post_name) . '" title="' . __("Timetable", 'gymbase') . '">' . __("Timetable", 'gymbase') . '</a>
					</div>
				</div>
			</li>';
		endwhile;
		$output .= '</ul>';
	endif;
	
	return $output;
}
add_shortcode("classes_sidebar", "theme_classes_sidebar");

//classes shortcode
function theme_classes($atts, $content)
{
	global $themename;
	
	extract(shortcode_atts(array(
		"order_by" => "menu_order",
		"order" => "ASC",
		"timetable_url" => get_home_url() . "/timetable",
		"category" => "",
		"top_margin" => "page_margin_top",
		"about_button" => 1,
		"trainers_button" => 1,
		"timetable_button" => 1
	), $atts));
	
	query_posts(array( 
		'post_type' => 'classes',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'orderby' => $order_by, 
		'order' => $order,
		'classes_category' => $category
	));

	$controls = (($about_button && $trainers_button) || ($timetable_button && ($about_button || $trainers_button)) ? 1 : 0);
	$output = '';
	if(have_posts()):
		$output .= '<ul class="classes-accordion accordion wide ' . $top_margin . (!$controls ? ' full-width' : '') . '">';
		while(have_posts()): the_post();
			global $post;
			$trainers = array_values(array_filter((array)get_post_meta(get_the_ID(), $themename . "_trainers", true)));
			$output .= '<li>
				<div id="accordion-' . urldecode($post->post_name) . '">
					<h3>' . get_the_title() . '</h3>
					<h5>' . esc_attr(get_post_meta(get_the_ID(), $themename . "_subtitle", true)) . '</h5>
				</div>
				<div class="clearfix ' . ($controls ? 'tabs' : '') . '">';
			if($controls):
			$output .= '<ul>';
					if($about_button):
					$output .= '
					<li>
						<a href="#' . urldecode($post->post_name) . '-about" title="' . __("About", 'gymbase') . '">' . __("About", 'gymbase') . '</a>
					</li>';
					endif;
					if(count($trainers) && $trainers_button):
					$output .= '
					<li>
						<a href="#' . urldecode($post->post_name) . '-trainers" title="' . __("Trainers", 'gymbase') . '">' . __("Trainers", 'gymbase') . '</a>
					</li>';
					endif;
					if($timetable_button):
					$output .= '
					<li>
						<a href="' . $timetable_url . '/#' . urldecode($post->post_name) . '" title="' . __("Timetable", 'gymbase') . '">' . __("Timetable", 'gymbase') . '</a>
					</li>';
					endif;
				$output .= '</ul>';
			endif;	
					
					if($about_button):
						$output .= '<div id="' . urldecode($post->post_name) . '-about" class="tabs-panel">';
							if(has_post_thumbnail())
								$output .= get_the_post_thumbnail(get_the_ID(), "blog-post-thumb", array("alt" => get_the_title(), "title" => "", "class" => "about_img"));
					$output .= do_shortcode( get_the_content()) . '
						</div>';
					endif;
				if(count($trainers) && $trainers_button):
					$trainers_list = get_posts(array(
						'include' => implode(",", (array)$trainers),
						'post_type' => 'trainers',
						'numberposts' => -1,
						'orderby' => 'post_title', 
						'order' => 'DESC'
					));
				$output .= '
					<div id="' . urldecode($post->post_name) . '-trainers" class="tabs-panel">
						<ul>';
						$i = 0;
						foreach($trainers_list as $post):
							setup_postdata($post);
						$output .= '<li' . ($i>0 ? ' class="page_margin_top"' : '') . '>';
							if(has_post_thumbnail())
								$output .= get_the_post_thumbnail(get_the_ID(), "blog-post-thumb", array("alt" => get_the_title(), "title" => "", "class" => "about_img"));
						$output .= '
							<h2>' . get_the_title() . '</h2>
							<h4 class="sentence">'. get_the_excerpt() . '</h4>
							' . wpb_js_remove_wpautop(apply_filters('the_content', get_the_content()))
							. '</li>';
							$i++;
						endforeach;
				$output .= '
						</ul>
					</div>';
				endif;
				$output .= '
				</div>
			</li>';
		endwhile;
		$output .= '</ul>';
	endif;
	
	//Reset Query
	wp_reset_query();
	return $output;
}
add_shortcode("classes", "theme_classes");

//visual composer
function theme_classes_vc_init()
{
	//get categories list
	$categories = get_terms("classes_category");
	$categories_array = array();
	$categories_array[__("All", 'gymbase')] = "";
	foreach($categories as $category) {
		$categories_array[$category->name] = $category->slug;
	}
	//get all pages
	$timetable_page = get_page_by_title("timetable");	
	$pages_list = get_posts(array(
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'page',
		'post__not_in' => !empty($timetable_page->ID) ?  array($timetable_page->ID) : ''
	));
	if(!empty($timetable_page)) {
		array_unshift($pages_list, $timetable_page);
	}
	$pages_array = array();
	foreach($pages_list as $page)
		$pages_array[$page->post_title . " (id:" . $page->ID . ")"] = home_url() . "/" . $page->post_name;
	
	vc_map( array(
		"name" => __("Classes Accordion", 'gymbase'),
		"base" => "classes",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-ui-accordion",
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
				"heading" => __("About button", 'gymbase'),
				"param_name" => "about_button",
				"value" => array(__("Enable", 'gymbase') => 1, __("Disable", 'gymbase') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Trainers button", 'gymbase'),
				"param_name" => "trainers_button",
				"value" => array(__("Enable", 'gymbase') => 1, __("Disable", 'gymbase') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Timetable button", 'gymbase'),
				"param_name" => "timetable_button",
				"value" => array(__("Enable", 'gymbase') => 1, __("Disable", 'gymbase') => 0),
				"description" => "Button won't be visible, if both About and Trainers buttons are disabled"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Timetable page", 'gymbase'),
				"param_name" => "timetable_url",
				"value" => $pages_array				
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order by", 'gymbase'),
				"param_name" => "order_by",
				"value" => array(__("Menu order", 'gymbase') => "menu_order", __("Title", 'gymbase') => "title" )
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order", 'gymbase'),
				"param_name" => "order",
				"value" => array(__("ASC", 'gymbase') => "asc", __("DESC", 'gymbase') => "desc" )
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
add_action("init", "theme_classes_vc_init");

?>