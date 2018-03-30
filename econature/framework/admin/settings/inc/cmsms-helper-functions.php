<?php 
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Admin Panel Helper Functions
 * Created by CMSMasters
 * 
 */


function cmsms_get_admin_page() {
	global $pagenow;
	
	$current_page = (isset($_GET['page'])) ? trim($_GET['page']) : '';
	
	if ($pagenow == 'options.php' && isset($_POST['_wp_http_referer'])) {
		$parts = explode('page=', $_POST['_wp_http_referer']);
		
		if (isset($parts[1])) {
			$page = $parts[1];
			$t = strpos($page, '&');
			
			if ($t !== false) {
				$page = substr($parts[1], 0, $t);
			}
			
			$current_page = trim($page);
		} else {
			$current_page = false;
		}
	}
	
	return $current_page;
}


function cmsms_default_tab() {
	$cmsms_option = cmsms_get_global_options();
	
	$current_page = cmsms_get_admin_page();
	
	if ($current_page == 'cmsms-settings') {
		$default_tab = 'general';
	} elseif ($current_page == 'cmsms-settings-style') {
		$default_tab = 'logo';
	} elseif ($current_page == 'cmsms-settings-font') {
		$default_tab = 'content';
	} elseif ($current_page == 'cmsms-settings-color') {
		$default_tab = 'default';
	} elseif ($current_page == 'cmsms-settings-single') {
		$default_tab = 'post';
	} elseif ($current_page == 'cmsms-settings-demo') {
		$default_tab = 'import';
	} else {
		$default_tab = 'general';
	}
	
	return $default_tab;
}


function cmsms_get_the_tab() {
	global $pagenow;
	
	$default_tab = cmsms_default_tab();
	
	$current_tab = (isset($_GET['tab'])) ? $_GET['tab'] : $default_tab;
	
	if ($pagenow == 'options.php' && isset($_POST['_wp_http_referer'])) {
		$parts = explode('&tab=', $_POST['_wp_http_referer']);
		
		$partsNum = count($parts);
		
		if (isset($parts[1])) {
			$settings_updated = strpos($parts[1], '&');
			
			$tab_name = ($settings_updated !== false) ? substr($parts[1], 0, $settings_updated) : $parts[1];
			
			$current_tab = ($partsNum == 2) ? trim($tab_name) : $default_tab;
		}
	}
	
	return $current_tab;
}


function cmsms_settings_page_header() {
    $settings_output = cmsms_get_settings();
	$tabs = $settings_output['cmsms_page_tabs'];
	$current_tab = cmsms_get_the_tab();
	
	echo '<div id="icon-options-general" class="icon32">' . 
		'<br />' . 
	'</div>' . 
	'<h2 style="padding-top:12px;">' . $settings_output['cmsms_page_title'] . '</h2>';
    
	if ($tabs != '') {
		$links = array();
		
		foreach ($tabs as $tab => $name) {
			$class = (($tab == $current_tab) ? 'nav-tab nav-tab-active' : 'nav-tab');
			
			$page = $_GET['page'];
			
			$links[] = '<a class="' . $class . '" href="?page=' . $page . '&tab=' . $tab . '"' . (($tab == 'recaptcha') ? ' style="background-color:#fdffc6;' . (($class == 'nav-tab nav-tab-active') ? ' border-bottom-color:#fdffc6;' : '') . '"' : '') . '>' . $name . '</a>';
		}
		
		echo '<h2 class="nav-tab-wrapper">';
		
		foreach ($links as $link) {
			echo $link;
		}
		
		echo '</h2>';
	}
}

