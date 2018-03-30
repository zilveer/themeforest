<?php

global $sidebar_admin, $sidebar_settings;

// $required = '<em class="required">' . __('Required', THEME_NAME) . '</em>';
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if($action != ''){
	switch ($action) {
		case 'update-sidebar':{						
			$title = isset($_REQUEST['sidebar-title']) ? $_REQUEST['sidebar-title'] : '';
			$alias = isset($_REQUEST['sidebar-alias']) ? sanitize_title($_REQUEST['sidebar-alias']) : '';
			$description = isset($_REQUEST['sidebar-description']) ? $_REQUEST['sidebar-description'] : '';

			if($title != '' && $alias != ''){
				$options = array(
					'title' => $title,
					'alias' => $alias,
					'description' => $description,
				);				
				$sidebar_settings->update_sidebar($options);				
			}
		} break;

		case 'delete-sidebar':{
			$alias = isset($_REQUEST['alias']) ? sanitize_title($_REQUEST['alias']) : '';
			if($alias != ''){
				$sidebar_settings->delete_sidebar($alias);
			}
		} break;
		
		default:{
			// nothing to do
		} break;
	}
}

switch ($sidebar_admin->navigation) {
	case 'add-sidebar':{
		require_once('views/add-edit-sidebar.php');
	} break;

	case 'edit-sidebar':{
		$alias = isset($_REQUEST['alias']) ? $_REQUEST['alias'] : '';
		if($alias != ''){
			$sidebars = $sidebar_settings->get_sidebars();
			$sidebar = $sidebar_settings->get_sidebar($alias);
		}
		require_once('views/add-edit-sidebar.php');
	} break;

	default:{
		$sidebars = $sidebar_settings->get_sidebars();
		require_once('views/admin-home.php');
	}
}  
?>