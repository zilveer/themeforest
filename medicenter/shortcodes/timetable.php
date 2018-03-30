<?php
//timetable
function theme_timetable($atts, $content)
{
	global $themename;
	extract(shortcode_atts(array(
		"department" => "",
		/*"category" => "",*/
		"departments_page" => "",
		"filter_style" => "dropdown_list",
		"filter_title" => __("All Departments", 'medicenter'),
		"mode" => "24h",
		"hour_category" => "",
		"top_margin" => "page_margin_top"
	), $atts));

	$departments_array = array_values(array_diff(array_filter(array_map('trim', explode(",", $department))), array("-")));
	/*$category = explode(",", $category);
	if($category[0]=="-" || $category[0]=="")
	{
		unset($category[0]);
		$category = array_values($category);
	}*/

	$departments_list_html = '<li>
		<a href="#all-departments" title="' . esc_attr($filter_title) . '">
			' . $filter_title . '
		</a>
	</li>';
	$departments_array_count = count($departments_array);
	for($i=0; $i<$departments_array_count; $i++)
	{
		query_posts(array(
			"name" => $departments_array[$i],
			'post_type' => 'departments',
			'post_status' => 'publish'
		));
		if(have_posts())
		{
			the_post();
			$departments_list_html .= '<li>
				<a href="#' . $departments_array[$i] . '" title="' . esc_attr(get_the_title()) . '">
					' . get_the_title() . '
				</a>
			</li>';
		}
	}
	
	$output = '';
	if($filter_style=="dropdown_list")
	{
		$output .= '<ul class="clearfix tabs_box_navigation sf-menu' . ($top_margin!="none" ? ' ' . $top_margin : '') . '">
			<li class="tabs_box_navigation_selected wide">
				<span>' . $filter_title . '</span>
				<ul class="sub-menu">' . $departments_list_html . '</ul>
			</li>
		</ul>';
	}
	$output .= '<div class="clearfix tabs' . ($top_margin!="none" && $filter_style!="dropdown_list" ? ' ' . $top_margin : '') . '">
		<ul class="clearfix tabs_navigation"' . ($filter_style=="dropdown_list" ? ' style="display: none;"' : '') . '>' . $departments_list_html . '</ul>';
	$output .= '<div id="all-departments">' . get_timetable($departments_page, $departments_array, $mode, $hour_category) . '</div>';
	for($i=0; $i<$departments_array_count; $i++)
		$output .= '<div id="' . $departments_array[$i] . '">' . get_timetable($departments_page, $departments_array[$i], $mode, $hour_category) . '</div>';
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
		if((!isset($array[$i]["displayed"]) || (bool)$array[$i]["displayed"]!=true) && (int)$array[$i]["start"]==(int)$hour)
			return true;
	}
	return false;
}
function get_rowspan_value($hour, $array, $rowspan)
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
			$end_explode = explode(".", $array[$i]["end"]);
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
		return get_rowspan_value($hour, $array, $rowspan);
}
function get_row_content($departments, $departments_page, $mode)
{
	global $themename;
	$content = "";
	
	foreach($departments as $key=>$details)
	{
		$tooltip = "";
		$color = "";
		$hover_color = "";
		$textcolor = "";
		$hover_text_color = "";
		$hours_text_color = "";
		if(count($departments)>1)
		{
			$color = get_post_meta($details["id"], $themename . "_color", true);
			$hover_color = get_post_meta($details["id"], $themename . "_hover_color", true);
		}
		$text_color = get_post_meta($details["id"], $themename . "_text_color", true);
		$hover_text_color = get_post_meta($details["id"], $themename . "_hover_text_color", true);
		$hours_text_color = get_post_meta($details["id"], $themename . "_hours_text_color", true);
		$hours_hover_text_color = get_post_meta($details["id"], $themename . "_hours_hover_text_color", true);
		$timetable_custom_url = get_post_meta($details["id"], $themename . "_timetable_custom_url", true);
		$classes_url = ($timetable_custom_url!="" ? $timetable_custom_url : get_permalink($departments_page));
		$content .= '<div class="event_container' . (count(array_filter(array_values($details['tooltip']))) && count($departments)>1 ? ' tooltip' : '' ) . '"' . ($color!="" || ($text_color!="" && count($departments)>1) ? ' style="' . ($color!="" ? 'background-color: #' . $color . ';' : '') . ($text_color!="" && count($departments)>1 ? 'color: #' . $text_color . ';' : '') . '"': '') . (($hover_color!="" || $hover_text_color!="" || $hours_hover_text_color!="") && count($departments)>1 ? ' onMouseOver="' . ($hover_color!="" ? 'this.style.backgroundColor=\'#'.$hover_color.'\';' : '') . ($hover_text_color!="" ? 'this.style.color=\'#'.$hover_text_color.'\';jQuery(this).find(\'.event_header\').css(\'color\', \'#'.$hover_text_color.'\');' : '') . ($hours_hover_text_color!="" ? 'jQuery(this).find(\'.hours\').css(\'color\',\'#'.$hours_hover_text_color.'\');' : '') . '" onMouseOut="' . ($hover_color!="" ? 'this.style.backgroundColor=\'#'.$color.'\';' : '') . ($hover_text_color!="" ? 'this.style.color=\'#'.$text_color.'\';jQuery(this).find(\'.event_header\').css(\'color\',\'#'.$text_color.'\');' : '') . ($hours_hover_text_color!="" ? 'jQuery(this).find(\'.hours\').css(\'color\',\'#'.$hours_text_color.'\');' : '') . '"' : '') . '>';
		$class_link = '<a class="event_header" href="' . $classes_url . '#' . urldecode($details["name"]) . '" title="' .  esc_attr($key) . '"' . ($text_color!="" ? ' style="color: #' . $text_color . ';"' : '') . '>' . $key . '</a>';
		$content .= $class_link;
		$hours_count = count($details["hours"]);
		for($i=0; $i<$hours_count; $i++)
		{
			if($mode=="12h")
			{
				$hoursExplode = explode(" - ", $details["hours"][$i]);
				$details["hours"][$i] = date("h.i a", strtotime($hoursExplode[0])) . " - " . date("h.i a", strtotime($hoursExplode[1]));
			}
			$content .= ($i!=0 ? '<br />' : '');
			if($details["before_hour_text"][$i]!="")
				$content .= "<div class='before_hour_text'>" . $details["before_hour_text"][$i] . "</div>";
			$content .= '<span class="hours"' . ($hours_text_color!="" ? ' style="color:#' . $hours_text_color . ';"' : '') . '>' . $details["hours"][$i] . '</span>';
			if($details["doctors"][$i]!="")
				$content .= "<div class='class_doctors'>" . $details["doctors"][$i] . "</div>";
			if($details["after_hour_text"][$i]!="")
				$content .= "<div class='after_hour_text'>" . $details["after_hour_text"][$i] . "</div>";
			$class_link_tooltip = '<a' . ($hover_text_color!="" ? ' style="color: #' . $hover_text_color . ';"': '') . ' href="' . $classes_url . '#' . urldecode($details["name"]) . '" title="' .  esc_attr($key) . '">' . $key . '</a>';
			$tooltip .= ($tooltip!="" && $details["tooltip"][$i]!="" ? '<br /><br />' : '' ) . ($details["tooltip"][$i]!="" ? $class_link_tooltip : '') . $details["tooltip"][$i];
		}
		if(count($departments)==1)
			$content .= '</div>';
		if($tooltip!="")
		{
			$hover_color = get_post_meta($details["id"], $themename . "_hover_color", true);
			$content .= '<div class="tooltip_text"><div class="tooltip_content"' . ($hover_color!="" || $hover_text_color!="" ? ' style="' . ($hover_color!="" ? 'background-color: #' . $hover_color . ';' : '') . ($hover_text_color!="" ? 'color: #' . $hover_text_color . ';' : '') . '"': '') . '>' . $tooltip . '</div><span class="tooltip_arrow"' . ($hover_color!="" ? ' style="border-color: #' . $hover_color . ' transparent;"' : '') . '></span></div>';	
		}
		if(count($departments)>1)
			$content .= '</div>';
	}
	return $content;
}
function get_timetable($departments_page, $department = null, $mode = null, $hour_category = null)
{
	global $themename;
	global $blog_id;
	global $wpdb;
	if($hour_category!=null && $hour_category!="-")
		$hour_category = array_values(array_diff(array_filter(array_map('trim', explode(",", $hour_category))), array("-")));
	$output = "";
	$query = "SELECT TIME_FORMAT(t1.start, '%H.%i') AS start, TIME_FORMAT(t1.end, '%H.%i') AS end, t1.tooltip AS tooltip, t1.before_hour_text AS before_hour_text, t1.after_hour_text AS after_hour_text, t1.doctors AS doctors, t2.ID AS department_id, t2.post_title AS department_title, t2.post_name AS post_name, t3.post_title, t3.menu_order FROM " . $wpdb->prefix . "department_hours AS t1 
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.department_id=t2.ID 
			LEFT JOIN {$wpdb->posts} AS t3 ON t1.weekday_id=t3.ID 
			WHERE 
			t2.post_type='departments'
			AND t2.post_status='publish'";
	if(is_array($department) && count($department))
		$query .= "
			AND t2.post_name IN('" . join("','", $department) . "')";
	else if($department!=null)
		$query .= "
			AND t2.post_name='" . strtolower(urlencode($department)) . "'";
	if($hour_category!=null && $hour_category!="-")
		$query .= "
			AND t1.category IN('" . join("','", $hour_category) . "')";
	$query .= "
			AND 
			t3.post_type='" . $themename . "_weekdays'
			ORDER BY FIELD(t3.menu_order,2,3,4,5,6,7,1), t1.start, t1.end";
	$department_hours = $wpdb->get_results($query);
	$department_hours_tt = array();
	foreach($department_hours as $department_hour)
	{
		$doctorsString = "";
		if($department_hour->doctors!="")
		{
			query_posts(array( 
				'post__in' => explode(",", $department_hour->doctors),
				'post_type' => 'doctors',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'orderby' => 'post_title', 
				'order' => 'DESC'
			));
			while(have_posts()): the_post();
				$doctorsString .= get_the_title() . ", ";
			endwhile;
			if($doctorsString!="")
				$doctorsString = substr($doctorsString, 0, -2);
		}
		$department_hours_tt[($department_hour->menu_order>1 ? $department_hour->menu_order-1 : 7)][] = array(
			"start" => $department_hour->start,
			"end" => $department_hour->end,
			"tooltip" => $department_hour->tooltip,
			"before_hour_text" => $department_hour->before_hour_text,
			"after_hour_text" => $department_hour->after_hour_text,
			"doctors" => $doctorsString,
			"tooltip" => $department_hour->tooltip,
			"id" => $department_hour->department_id,
			"title" => $department_hour->department_title,
			"name" => $department_hour->post_name
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
		$output .= '	<th>' . mb_strtoupper($weekday->post_title) . '</th>';
	}
	$output .= '	</tr>
				</thead>
				<tbody>';
	//get min anx max hour
	$query = "SELECT min(TIME_FORMAT(t1.start, '%H.%i')) AS min, max(REPLACE(TIME_FORMAT(t1.end, '%H.%i'), '00.00', '24.00')) AS max FROM " . $wpdb->prefix . "department_hours AS t1
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.department_id=t2.ID 
			LEFT JOIN {$wpdb->posts} AS t3 ON t1.weekday_id=t3.ID 
			WHERE 
			t2.post_type='departments'
			AND t2.post_status='publish'";
	if(is_array($department) && count($department))
		$query .= "
			AND t2.post_name IN('" . join("','", $department) . "')";
	else if($department!=null)
		$query .= "
			AND t2.post_name='" . strtolower(urlencode($department)) . "'";
	if($hour_category!=null && $hour_category!="-")
		$query .= "
			AND t1.category IN('" . join("','", $hour_category) . "')";
	$query .= "
			AND 
			t3.post_type='" . $themename . "_weekdays'";
	$hours = $wpdb->get_row($query);
	$drop_columns = array();
	$l = 0;
	$max_explode = explode(".", $hours->max);
	$max_hour = (int)$hours->max + ((int)$max_explode[1]>0 ? 1 : 0);
	for($i=(int)$hours->min; $i<$max_hour; $i++)
	{
		$start = str_pad($i, 2, '0', STR_PAD_LEFT) . '.00';
		$end = str_replace("24", "00", str_pad($i+1, 2, '0', STR_PAD_LEFT)) . '.00';
		if($mode=="12h")
		{
			$start = date("h.i a", strtotime($start));
			$end = date("h.i a", strtotime($end));
		}
		$output .= '<tr class="row_' . ($l+1) . ($l%2==0 ? ' row_gray' : '') . '">
						<td>
							' . $start . ' - ' . $end . '
						</td>';
						for($j=0; $j<count($weekdays); $j++)
						{
							$weekday_fixed_number = ($weekdays[$j]->menu_order>1 ? $weekdays[$j]->menu_order-1 : 7);
							if(!in_array($weekday_fixed_number, (array)(isset($drop_columns[$i]["columns"]) ? $drop_columns[$i]["columns"] : array())))
							{
								if(hour_in_array($i, (isset($department_hours_tt[$weekday_fixed_number]) ? $department_hours_tt[$weekday_fixed_number] : array())))
								{
									$rowspan = get_rowspan_value($i, $department_hours_tt[$weekday_fixed_number], 1);
									if($rowspan>1)
									{
										for($k=1; $k<$rowspan; $k++)
											$drop_columns[$i+$k]["columns"][] = $weekday_fixed_number;	
									}
									$array_count = count($department_hours_tt[$weekday_fixed_number]);
									$hours = array();
									for($k=(int)$i; $k<(int)$i+$rowspan; $k++)
										$hours[] = $k;
									$departments = array();
									for($k=0; $k<$array_count; $k++)
									{
										if(in_array((int)$department_hours_tt[$weekday_fixed_number][$k]["start"], $hours))
										{
											$departments[$department_hours_tt[$weekday_fixed_number][$k]["title"]]["name"] = $department_hours_tt[$weekday_fixed_number][$k]["name"];
											$departments[$department_hours_tt[$weekday_fixed_number][$k]["title"]]["tooltip"][] = $department_hours_tt[$weekday_fixed_number][$k]["tooltip"];
											$departments[$department_hours_tt[$weekday_fixed_number][$k]["title"]]["before_hour_text"][] = $department_hours_tt[$weekday_fixed_number][$k]["before_hour_text"];
											$departments[$department_hours_tt[$weekday_fixed_number][$k]["title"]]["after_hour_text"][] = $department_hours_tt[$weekday_fixed_number][$k]["after_hour_text"];
											$departments[$department_hours_tt[$weekday_fixed_number][$k]["title"]]["doctors"][] = $department_hours_tt[$weekday_fixed_number][$k]["doctors"];
											$departments[$department_hours_tt[$weekday_fixed_number][$k]["title"]]["id"] = $department_hours_tt[$weekday_fixed_number][$k]["id"];
											$departments[$department_hours_tt[$weekday_fixed_number][$k]["title"]]["hours"][] = $department_hours_tt[$weekday_fixed_number][$k]["start"] . " - " . $department_hours_tt[$weekday_fixed_number][$k]["end"];
											$department_hours_tt[$weekday_fixed_number][$k]["displayed"] = true;
										}
									}
									$color = "";
									$text_color = "";
									$hover_color = "";
									$hover_text_color = "";
									$hours_text_color = "";
									$hours_hover_text_color = "";
									if(count($departments)==1)
									{
										$color = get_post_meta($departments[key($departments)]["id"], $themename . "_color", true);
										$hover_color = get_post_meta($departments[key($departments)]["id"], $themename . "_hover_color", true);
										$text_color = get_post_meta($departments[key($departments)]["id"], $themename . "_text_color", true);
										$hover_text_color = get_post_meta($departments[key($departments)]["id"], $themename . "_hover_text_color", true);
										$hours_text_color = get_post_meta($departments[key($departments)]["id"], $themename . "_hours_text_color", true);
										$hours_hover_text_color = get_post_meta($departments[key($departments)]["id"], $themename . "_hours_hover_text_color", true);
									}
									$output .= '<td' . ($color!="" || $text_color!="" ? ' style="' . ($color!="" ? 'background-color: #' . $color . ';' : '') . ($text_color!="" ? 'color: #' . $text_color . ';' : '') . '"': '') . ($hover_color!="" || $hover_text_color!="" || $hours_hover_text_color!="" ? ' onMouseOver="' . ($hover_color!="" ? 'this.style.backgroundColor=\'#'.$hover_color.'\';' : '') . ($hover_text_color!="" ? 'this.style.color=\'#'.$hover_text_color.'\';jQuery(this).find(\'.event_header\').css(\'color\', \'#'.$hover_text_color.'\');' : '') . ($hours_hover_text_color!="" ? 'jQuery(this).find(\'.hours\').css(\'color\',\'#'.$hours_hover_text_color.'\');' : '') . '" onMouseOut="' . ($hover_color!="" ? 'this.style.backgroundColor=\'#'.$color.'\';' : '') . ($hover_text_color!="" ? 'this.style.color=\'#'.$text_color.'\';jQuery(this).find(\'.event_header\').css(\'color\',\'#'.$text_color.'\');' : '') . ($hours_hover_text_color!="" ? 'jQuery(this).find(\'.hours\').css(\'color\',\'#'.$hours_text_color.'\');' : '') . '"' : '') . ' class="event' . (count(array_filter(array_values($departments[key($departments)]['tooltip']))) && count($departments)==1 ? ' tooltip' : '' ) . '"' . ($rowspan>1 ? ' rowspan="' . $rowspan . '"' : '') . '>';
									$output .= get_row_content($departments, $departments_page, $mode);
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
								' . __("Click on the department name to get additional info", 'medicenter') . '
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
		if(isset($department_hours_tt[$weekday_fixed_number]))
		{
			$output .= '<h3 class="box_header' . ($l>0 ? ' page_margin_top' : '') . '">
				' . $weekday->post_title . '
			</h3>
			<ul class="items_list thin page_margin_top clearfix' . ($mode=='12h' ? ' mode12' : '') . '">';
				$department_hours_count = count($department_hours_tt[$weekday_fixed_number]);
					
				for($i=0; $i<$department_hours_count; $i++)
				{
					if($mode=="12h")
					{
						$department_hours_tt[$weekday_fixed_number][$i]["start"] = date("g.i a", strtotime($department_hours_tt[$weekday_fixed_number][$i]["start"]));
						$department_hours_tt[$weekday_fixed_number][$i]["end"] = date("g.i a", strtotime($department_hours_tt[$weekday_fixed_number][$i]["end"]));
					}
					$timetable_custom_url = get_post_meta($department_hours_tt[$weekday_fixed_number][$i]["id"], $themename . "_timetable_custom_url", true);
					$classes_url = ($timetable_custom_url!="" ? $timetable_custom_url : get_permalink($departments_page));
					$output .= '<li class="clearfix icon_clock_black">
							<a href="' . $classes_url . '#' . urldecode($department_hours_tt[$weekday_fixed_number][$i]["name"]) . '" title="' . $department_hours_tt[$weekday_fixed_number][$i]["title"] . '">
								' . $department_hours_tt[$weekday_fixed_number][$i]["title"];
							if($department_hours_tt[$weekday_fixed_number][$i]["doctors"]!="")
								$output .= ', ' . $department_hours_tt[$weekday_fixed_number][$i]["doctors"];
					$output .= '</a>';
					$output .= '<div class="value">
								' . $department_hours_tt[$weekday_fixed_number][$i]["start"] . ' - ' . $department_hours_tt[$weekday_fixed_number][$i]["end"] . '
							</div>
						</li>';
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
	//get departments list
	$departments_list = get_posts(array(
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_type' => 'departments'
	));
	$departments_array = array();
	$departments_array[__("All", 'medicenter')] = "-";
	foreach($departments_list as $department)
		$departments_array[$department->post_title . " (id:" . $department->ID . ")"] = $department->post_name;

	//get departments categories list
	/*$departments_categories = get_terms("departments_category");
	$departments_categories_array = array();
	$departments_categories_array[__("All", 'medicenter')] = "-";
	foreach($departments_categories as $departments_category)
		$departments_categories_array[$departments_category->name] =  $departments_category->slug;*/
	
	//get all pages
	global $medicenter_pages_array;
	
	//get all hour categories
	global $wpdb;
	global $blog_id;
	$query = "SELECT distinct(category) AS category FROM " . $wpdb->prefix . "department_hours AS t1
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.department_id=t2.ID 
			WHERE 
			t2.post_type='departments'
			AND t2.post_status='publish'
			AND category<>''";
	$hour_categories = $wpdb->get_results($query);
	$hour_categories_array = array();
	$hour_categories_array[__("All", 'medicenter')] = "-";
	foreach($hour_categories as $hour_category)
		$hour_categories_array[$hour_category->category] = $hour_category->category;
	vc_map( array(
		"name" => __("Timetable", 'medicenter'),
		"base" => "timetable",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-timetable",
		"category" => __('MediCenter', 'medicenter'),
		"params" => array(
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display selected", 'medicenter'),
				"param_name" => "department",
				"value" => $departments_array
			),
			/*array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display from Category", 'medicenter'),
				"param_name" => "category",
				"value" => $departments_categories_array
			),*/
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Mode", 'medicenter'),
				"param_name" => "mode",
				"value" => array(__("24h (military time)", 'medicenter') => "24h", __("12h (am/pm)", 'medicenter') => "12h")
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display from hour category", 'medicenter'),
				"param_name" => "hour_category",
				"value" => $hour_categories_array
			),
			array(
				"type" => (count($medicenter_pages_array) ? "dropdownmulti" : "textfield"),
				"class" => "",
				"heading" => __("Departments page", 'medicenter'),
				"param_name" => "departments_page",
				"value" => (count($medicenter_pages_array) ? $medicenter_pages_array : ''),
				"description" => (count($medicenter_pages_array) ? '' : __("Please provide departments page id", 'medicenter'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Filter style", 'medicenter'),
				"param_name" => "filter_style",
				"value" => array(__("dropdown list", 'medicenter') => "dropdown_list", __("tabs", 'medicenter') => "tabs")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Filter title", 'medicenter'),
				"param_name" => "filter_title",
				"value" => __("All Departments", 'medicenter')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'medicenter'),
				"param_name" => "top_margin",
				"value" => array(__("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section", __("None", 'medicenter') => "none")
			)
		)
	));
}
add_action("init", "theme_timetable_vc_init");
?>