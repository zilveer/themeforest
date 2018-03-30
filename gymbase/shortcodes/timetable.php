<?php
//timetable
function theme_timetable($atts, $content)
{
	global $themename;
	extract(shortcode_atts(array(
		"class" => "",
		"class_category" => "",
		"classes_url" => get_home_url() . "/classes/",
		"filter_style" => "",
		"mode" => "",
		"hour_category" => "",
		"top_margin" => "page_margin_top",
		"hour_minute_separator" => ".",
	), $atts));
	$classes_array = array_filter(array_map('trim', explode(",", $class)));
	$classes_category_array = array_filter(array_map('trim', explode(",", $class_category)));	

	$output = '';
	$outputSelect = '';
	$output .= '<div class="tabs ' . $top_margin . '">';
	if($filter_style=="dropdown_list")
	{
		$outputSelect = '<select class="timetable_dropdown_navigation ">
						<option value="#all-classes">' . __("All Classes", 'gymbase') . '</option>';
	}
	$output .= '<ul class="clearfix tabs_navigation"' . ($filter_style=="dropdown_list" ? ' style="display: none;"' : '') . '>
			<li>
				<a href="#all-classes" title="' . __("All Classes", 'gymbase') . '">
					' . __("All Classes", 'gymbase') . '
				</a>
			</li>';
	if(empty($class_category))
	{
		//filter by classes
		$classes_array_count = count($classes_array);
		for($i=0; $i<$classes_array_count; $i++)
		{
			query_posts(array(
				"name" => $classes_array[$i],
				'post_type' => 'classes',
				'post_status' => 'publish'
			));
			if(have_posts())
			{
				the_post();
				if($filter_style=="dropdown_list")
					$outputSelect .= '<option value="#' . $classes_array[$i] . '">' . get_the_title() . '</option>';
				$output .= '<li>
					<a href="#' . $classes_array[$i] . '" title="' . esc_attr(get_the_title()) . '">
						' . get_the_title() . '
					</a>
				</li>';
			}
		}
	} 
	else
	{
		//filter by class categories
		$classes_category_array_count = count($classes_category_array);
		for($i=0; $i<$classes_category_array_count; $i++)
		{
			$class_category_info = get_terms(
				array(
					"classes_category"
				), 
				array(
					"slug" => $classes_category_array[$i],	
				)
			);
			if(!empty($class_category_info[0]))
			{
				if($filter_style=="dropdown_list")
					$outputSelect .= '<option value="#' . $class_category_info[0]->slug . '">' . $class_category_info[0]->name . '</option>';
				$output .= '<li>
					<a href="#' . $class_category_info[0]->slug . '" title="' . esc_attr($class_category_info[0]->name) . '">
						' . $class_category_info[0]->name . '
					</a>
				</li>';
			}
		}
		//get classes for each class category	
		if(!empty($class_category))
		{
			$classes_array = array();
			$classes_array_by_category = array();
			global $post;
			foreach($classes_category_array as $val)
			{
				$classes_array_by_category[$val] = array();
				query_posts(array(
					'classes_category' => $val,
					'post_type' => 'classes',
					'post_status' => 'publish',
					'posts_per_page' => -1,
				));
				while ( have_posts() ) : the_post();
					$classes_array[] = $post->post_name;
					$classes_array_by_category[$val][] = $post->post_name;
				endwhile;
			}
		}
	}
	if($filter_style=="dropdown_list")
		$outputSelect .= '</select>';
	$output .= '</ul>';
	$output .= $outputSelect;
	$output .= '<div id="all-classes">' . get_timetable($classes_url, $classes_array, $mode, $hour_category, $hour_minute_separator) . '</div>';	
	foreach((!empty($class_category) ? $classes_array_by_category : $classes_array) as $key=>$val)
		$output .= '<div id="' . (!empty($class_category) ? $key : $val) . '">' . get_timetable($classes_url, $val, $mode, $hour_category, $hour_minute_separator) . '</div>';
	$output .= '</div>';
	//Reset Query
	wp_reset_query();
	return $output;
}
add_shortcode("timetable", "theme_timetable");

function hour_in_array($hour, $array)
{
	$array_count = count($array);
	for($i=0; $i<$array_count; $i++)
	{
		if(!isset($array[$i]["displayed"]))
			$array[$i]["displayed"] = false;
		if(!isset($array[$i]["start"]))
			$array[$i]["start"] = false;
		if((bool)$array[$i]["displayed"]!=true && (int)$array[$i]["start"]==(int)$hour)
			return true;
	}
	return false;
}
function get_rowspan_value($hour, $array, $rowspan, $hour_minute_separator = null)
{
	$array_count = count($array);
	$found = false;
	$hours = array();
	for($i=(int)$hour; $i<(int)$hour+$rowspan; $i++)
		$hours[] = $i;
	for($i=0; $i<$array_count; $i++)
	{
		if(in_array((int)$array[$i]["start"], $hours))
		{
			$end_explode = explode($hour_minute_separator, $array[$i]["end"]);
			$end_hour = (int)$array[$i]["end"] + ((int)$end_explode[1]>0 ? 1 : 0);
			if($end_hour-(int)$hour>1 && $end_hour-(int)$hour>$rowspan)
			{
				$rowspan = $end_hour-(int)$hour;
				$found = true;
			}
		}
		
	}
	if(!$found)
		return $rowspan;
	else
		return get_rowspan_value($hour, $array, $rowspan, $hour_minute_separator);
}
function get_row_content($classes, $classes_url, $mode, $hour_minute_separator = null)
{
	global $themename;
	$content = "";
	
	$tooltip = "";
	foreach($classes as $key=>$details)
	{
		$color = "";
		$textcolor = ""; 
                $temp = explode('_',$key);
		$key = $temp[0]; 
		if(count($classes)>1)
		{
			$color = get_post_meta($details["id"], $themename . "_color", true);
		}
		$text_color = get_post_meta($details["id"], $themename . "_text_color", true);
		$content .= ($content!="" ? '<br /><br />' : '') . '<a' . ($color!="" || $text_color!="" ? ' style="' . ($color!="" ? 'background-color: #' . $color . ';' : '') . ($text_color!="" ? 'color: #' . $text_color . ';' : '') . '"': '') . ' href="' . $classes_url . '#' . urldecode($details["name"]) . '" title="' .  esc_attr($key) . '">' . $key . '</a>';
		$hours_count = count($details["hours"]);
		for($i=0; $i<$hours_count; $i++)
		{
			if($mode=="12h")
			{
				$hoursExplode = explode(" - ", $details["hours"][$i]);
				$details["hours"][$i] = date("h" . $hour_minute_separator . "i a", strtotime($hoursExplode[0])) . " - " . date("h" . $hour_minute_separator . "i a", strtotime($hoursExplode[1]));
			}
			$content .= ($i!=0 ? '<br />' : '');
			if($details["before_hour_text"][$i]!="")
				$content .= "<div class='before_hour_text'>" . $details["before_hour_text"][$i] . "</div>";
			$content .= $details["hours"][$i];
			if($details["after_hour_text"][$i]!="")
				$content .= "<div class='after_hour_text'>" . $details["after_hour_text"][$i] . "</div>";
			if($details["trainers"][$i]!="")
				$content .= "<div class='class_trainers'>" . $details["trainers"][$i] . "</div>";	
			$tooltip .= ($tooltip!="" && $details["tooltip"][$i]!="" ? '<br />' : '' ) . $details["tooltip"][$i];
		}
	}
	if($tooltip!="")
		$content .= '<div class="tooltip_text"><div class="tooltip_content">' . $tooltip . '</div></div>';	
	return $content;
}
function get_timetable($classes_url, $class = null, $mode = null, $hour_category = null, $hour_minute_separator = null)
{
	global $themename;
	global $blog_id;
	global $wpdb;
	if($hour_category!=null)
		$hour_category = explode(",", $hour_category);
	$output = ""; 
	$query = "SELECT TIME_FORMAT(t1.start, '%H" . $hour_minute_separator . "%i') AS start, TIME_FORMAT(t1.end, '%H" . $hour_minute_separator . "%i') AS end, t1.tooltip AS tooltip, t1.before_hour_text AS before_hour_text, t1.after_hour_text AS after_hour_text, t1.trainers AS trainers, t2.ID AS class_id, t2.post_title AS class_title, t2.post_name AS post_name, t3.post_title, t3.menu_order FROM ".$wpdb->prefix."class_hours AS t1 
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.class_id=t2.ID 
			LEFT JOIN {$wpdb->posts} AS t3 ON t1.weekday_id=t3.ID 
			WHERE 
			t2.post_type='classes'
			AND t2.post_status='publish'";
	if(is_array($class) && count($class))
		$query .= "
			AND t2.post_name IN('" . join("','", $class) . "')";
	else if($class!=null)
		$query .= "
			AND t2.post_name='" . strtolower(urlencode($class)) . "'";
	if($hour_category!=null)
		$query .= "
			AND t1.category IN('" . join("','", $hour_category) . "')";
	$query .= "
			AND 
			t3.post_type='" . $themename . "_weekdays'
			ORDER BY FIELD(t3.menu_order,2,3,4,5,6,7,1), t1.start, t1.end";
	$class_hours = $wpdb->get_results($query);
	$class_hours_tt = array();
	foreach($class_hours as $class_hour)
	{
		$trainersString = "";
		if($class_hour->trainers!="")
		{
			query_posts(array( 
				'post__in' => explode(",", $class_hour->trainers),
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
		$class_hours_tt[($class_hour->menu_order>1 ? $class_hour->menu_order-1 : 7)][] = array(
			"start" => $class_hour->start,
			"end" => $class_hour->end,
			"tooltip" => $class_hour->tooltip,
			"before_hour_text" => $class_hour->before_hour_text,
			"after_hour_text" => $class_hour->after_hour_text,
			"trainers" => $trainersString,
			"tooltip" => $class_hour->tooltip,
			"id" => $class_hour->class_id,
			"title" => $class_hour->class_title,
			"name" => $class_hour->post_name
		);
	}

	$output .= '<table class="timetable">
				<thead>
					<tr>
						<th></th>';
	//get weekdays
	$query = "SELECT post_title, menu_order FROM {$wpdb->posts}
			WHERE 
			post_type='" . $themename . "_weekdays'
			AND post_status='publish'
			ORDER BY FIELD(menu_order,2,3,4,5,6,7,1)";
	$weekdays = $wpdb->get_results($query);
	foreach($weekdays as $weekday)
	{
		$output .= '	<th>' . strtoupper($weekday->post_title) . '</th>';
	}
	$output .= '	</tr>
				</thead>
				<tbody>';
	//get min anx max hour
	$query = "SELECT min(TIME_FORMAT(t1.start, '%H" . $hour_minute_separator . "%i')) AS min, max(REPLACE(TIME_FORMAT(t1.end, '%H" . $hour_minute_separator . "%i'), '00" . $hour_minute_separator . "00', '24" . $hour_minute_separator . "00')) AS max FROM ".$wpdb->prefix."class_hours AS t1
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.class_id=t2.ID 
			LEFT JOIN {$wpdb->posts} AS t3 ON t1.weekday_id=t3.ID 
			WHERE 
			t2.post_type='classes'
			AND t2.post_status='publish'";
	if(is_array($class) && count($class))
		$query .= "
			AND t2.post_name IN('" . join("','", $class) . "')";
	else if($class!=null)
		$query .= "
			AND t2.post_name='" . strtolower(urlencode($class)) . "'";
	if($hour_category!=null)
		$query .= "
			AND t1.category IN('" . join("','", $hour_category) . "')";
	$query .= "
			AND 
			t3.post_type='" . $themename . "_weekdays'";
	$hours = $wpdb->get_row($query);
	$drop_columns = array();
	$l = 0;
	$max_explode = explode($hour_minute_separator, $hours->max);
	$max_hour = (int)$hours->max + ((int)$max_explode[1]>0 ? 1 : 0);
	for($i=(int)$hours->min; $i<$max_hour; $i++)
	{
		$start = str_pad($i, 2, '0', STR_PAD_LEFT) . $hour_minute_separator . '00';
		$end = str_replace("24", "00", str_pad($i+1, 2, '0', STR_PAD_LEFT)) . $hour_minute_separator . '00';
		if($mode=="12h")
		{
			$start = date("h" . $hour_minute_separator . "i a", strtotime($start));
			$end = date("h" . $hour_minute_separator . "i a", strtotime($end));
		}
		$output .= '<tr class="row_' . ($l+1) . ($l%2==0 ? ' row_gray' : '') . '">
						<td>
							' . $start . ' - ' . $end . '
						</td>';
						for($j=1; $j<=count($weekdays); $j++)
						{
							if(!isset($drop_columns[$i]["columns"]))
								$drop_columns[$i]["columns"] = '';
							if(!in_array($j, (array)$drop_columns[$i]["columns"]))
							{
								if(isset($class_hours_tt[$j]) && hour_in_array($i, $class_hours_tt[$j]))
								{
									$rowspan = get_rowspan_value($i, $class_hours_tt[$j], 1, $hour_minute_separator);
									if($rowspan>1)
									{
										for($k=1; $k<$rowspan; $k++)
											$drop_columns[$i+$k]["columns"][] = $j;	
									}
									$array_count = count($class_hours_tt[$j]);
									$hours = array();
									for($k=(int)$i; $k<(int)$i+$rowspan; $k++)
										$hours[] = $k;
									$classes = array();
									for($k=0; $k<$array_count; $k++)
									{
										if(in_array((int)$class_hours_tt[$j][$k]["start"], $hours))
										{
											$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["name"] = $class_hours_tt[$j][$k]["name"];
											$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["tooltip"][] = $class_hours_tt[$j][$k]["tooltip"];
											$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["before_hour_text"][] = $class_hours_tt[$j][$k]["before_hour_text"];
											$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["after_hour_text"][] = $class_hours_tt[$j][$k]["after_hour_text"];
											$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["trainers"][] = $class_hours_tt[$j][$k]["trainers"];
											$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["id"] = $class_hours_tt[$j][$k]["id"];
											$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["hours"][] = $class_hours_tt[$j][$k]["start"] . " - " . $class_hours_tt[$j][$k]["end"];
											$class_hours_tt[$j][$k]["displayed"] = true;
										}
									}
									$color = "";
									$text_color = "";
									if(count($classes)==1)
									{
										$color = get_post_meta($classes[key($classes)]["id"], $themename . "_color", true);
										$text_color = get_post_meta($classes[key($classes)]["id"], $themename . "_text_color", true);
									}
									$output .= '<td' . ($color!="" || $text_color!="" ? ' style="' . ($color!="" ? 'background-color: #' . $color . ';' : '') . ($text_color!="" ? 'color: #' . $text_color . ';' : '') . '"': '') . ' class="event' . (count(array_filter(array_values($classes[key($classes)]['tooltip']))) ? ' tooltip' : '' ) . '"' . ($rowspan>1 ? ' rowspan="' . $rowspan . '"' : '') . '>';
									$output .= get_row_content($classes, $classes_url, $mode, $hour_minute_separator);
									$output .= '</td>';
								}
								else
									$output .= '<td></td>';
							}
						}
		$output .= '</tr>';
		$l++;
	}
	$output .= '	<tr>
						<td colspan="8" class="last">
							<div class="tip">
								' . __("Click on the class name to get additional info", 'gymbase') . '
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="timetable small">';
	$l = 0;
	foreach($weekdays as $weekday)
	{
		$weekday_fixed_number = ($weekday->menu_order>1 ? $weekday->menu_order-1 : 7);
		if(isset($class_hours_tt[$weekday_fixed_number]))
		{
			$output .= '<h3 class="box_header' . ($l>0 ? ' page_margin_top' : '') . '">
				' . $weekday->post_title . '
			</h3>
			<ul class="items_list dark opening_hours">';
				$class_hours_count = count($class_hours_tt[$weekday_fixed_number]);
					
				for($i=0; $i<$class_hours_count; $i++)
				{
					if($mode=="12h")
					{
						if(empty($class_hours_tt[$weekday_fixed_number][$i]))
							continue;
						$class_hours_tt[$weekday_fixed_number][$i]["start"] = date("h" . $hour_minute_separator . "i a", strtotime($class_hours_tt[$weekday_fixed_number][$i]["start"]));
						$class_hours_tt[$weekday_fixed_number][$i]["end"] = date("h" . $hour_minute_separator . "i a", strtotime($class_hours_tt[$weekday_fixed_number][$i]["end"]));
					}
					if(isset($class_hours_tt[$weekday_fixed_number][$i]))
					{
						$output .= '<li class="icon_clock_green">
								<a href="' . $classes_url . '#' . urldecode($class_hours_tt[$weekday_fixed_number][$i]["name"]) . '" title="' . $class_hours_tt[$weekday_fixed_number][$i]["title"] . '">
									' . $class_hours_tt[$weekday_fixed_number][$i]["title"] . '
								</a>
								<div class="value">
									' . $class_hours_tt[$weekday_fixed_number][$i]["start"] . ' - ' . $class_hours_tt[$weekday_fixed_number][$i]["end"] . '
								</div>
							</li>';
					}
				}
			$output .= '</ul>';
			$l++;
		}
	}
	$output .= '</div>';
	return $output;
}
//visual composer
function theme_timetable_vc_init()
{
	//get classes list
	$classes_list = get_posts(array(
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_type' => 'classes'
	));
	$classes_array = array();
	$classes_array[__("All", 'gymbase')] = "";
	foreach($classes_list as $class)
		$classes_array[$class->post_title . " (id:" . $class->ID . ")"] = $class->post_name;
	
	//get all pages
	$classes_page = get_page_by_title("classes");	
	$pages_list = get_posts(array(
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'page',
		'post__not_in' => !empty($classes_page->ID) ? array($classes_page->ID) : ""
	));
	if(!empty($classes_page)) {
		array_unshift($pages_list, $classes_page);
	}
	$pages_array = array();
	foreach($pages_list as $page)
		$pages_array[$page->post_title . " (id:" . $page->ID . ")"] = home_url() . "/" . $page->post_name;
	
	//get all class categories
	$class_categories = get_terms(array(
		"classes_category"
	));
	$class_categories_array = array();
	$class_categories_array[__("All", 'gymbase')] = "";
	foreach($class_categories as $class_category)
		$class_categories_array[$class_category->name] = $class_category->slug;
	
	//get all hour categories
	global $wpdb;
	global $blog_id;
	$query = "SELECT distinct(category) AS category FROM ".$wpdb->prefix."class_hours AS t1
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.class_id=t2.ID 
			WHERE 
			t2.post_type='classes'
			AND t2.post_status='publish'
			AND category<>''";
	$hour_categories = $wpdb->get_results($query);
	$hour_categories_array = array();
	$hour_categories_array[__("All", 'gymbase')] = "";
	foreach($hour_categories as $hour_category)
		$hour_categories_array[$hour_category->category] = $hour_category->category;
	
	vc_map( array(
		"name" => __("Timetable", 'gymbase'),
		"base" => "timetable",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-timetable",
		"category" => __('GymBase', 'gymbase'),
		"params" => array(
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display selected", 'gymbase'),
				"param_name" => "class",
				"value" => $classes_array
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Mode", 'gymbase'),
				"param_name" => "mode",
				"value" => array(__("24h (military time)", 'gymbase') => "", __("12h (am/pm)", 'gymbase') => "12h")
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display from class category", 'gymbase'),
				"param_name" => "class_category",
				"value" => $class_categories_array
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display from hour category", 'gymbase'),
				"param_name" => "hour_category",
				"value" => $hour_categories_array
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Classes page", 'gymbase'),
				"param_name" => "classes_url",
				"value" => $pages_array
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hour minute separator", 'gymbase'),
				"param_name" => "hour_minute_separator",
				"value" => array(".", ":")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Filter style", 'gymbase'),
				"param_name" => "filter_style",
				"value" => array(__("tabs", 'gymbase') => "", __("dropdown list", 'gymbase') => "dropdown_list" )
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
add_action("init", "theme_timetable_vc_init");

?>