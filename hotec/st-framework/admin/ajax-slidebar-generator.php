<?php

/**
 * @author Kien Trong - Http://www.smooththemes.com
 * @copyright 2012
 */

#-----------------------------------------------------------------
# SmoothThemes Sidebar Generator
#-----------------------------------------------------------------

function st_sidebar_generator(){
    
	//echo var_dump($_POST);
	$smooththemes_sidebar = get_option(smooththemes_sidebar, $default = true);
	if(!is_array($smooththemes_sidebar)){
		$smooththemes_sidebar = array();
	}
	extract($_POST);

	switch ($st_sidebar_do) {
		case 'edit':
			if($id != ''){
				$smooththemes_sidebar[$id]['id'] = $id;
				$smooththemes_sidebar[$id]['title'] = $name;
				$smooththemes_sidebar[$id]['unique_css_class'] = $unique_css_class;
			}
			break;
		case 'add':
			$count_sidebar = count($smooththemes_sidebar);
			while (key_exists('sidebar-'.$count_sidebar,$smooththemes_sidebar)) {
				$count_sidebar+=1;
			}
				$count_sidebar = 'sidebar-'.$count_sidebar;
				$smooththemes_sidebar[$count_sidebar]['id'] = $count_sidebar;
				$smooththemes_sidebar[$count_sidebar]['title'] = $name;
				$smooththemes_sidebar[$count_sidebar]['unique_css_class'] = $unique_css_class;
			break;
		case 'delete':
			if($id!=''){
				unset($smooththemes_sidebar[$id]);
			}
			break;
	} // end switch

	if(update_option('smooththemes_sidebar', $smooththemes_sidebar)){
		$json=1;
	}else{
		$json=0;
	}

	echo json_decode($json);
	die();
}

add_action('wp_ajax_st_sidebar_generator', 'st_sidebar_generator');