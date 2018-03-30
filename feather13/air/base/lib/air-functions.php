<?php

/*---------------------------------------------------------------------------*/
/* WPBandit :: Air Framework Functions
/*---------------------------------------------------------------------------*/

/**
	Compiles an array of HTML attributes into an attribute string
**/
function air_attrs(array $attrs) {
	if ( !empty($attrs) ) {
		$result = '';
		foreach ( $attrs as $key=>$val )
			$result .= ' '.$key.'="'.$val.'"';
		return $result;
	}
}

/**
	Creates range, removing first key
**/
function air_range($start,$stop,$step=1) {
	$range = range($start,$stop,$step);
	unset($range[0]);
	return $range;
}

/**
	Air framework version
	- Displays framework name and version
**/
function air_framework_version() {
	echo Air::TEXT_Name . ' ' . Air::TEXT_Version;
}

/**
	Air theme version
	- Displays theme name and version
**/
function air_theme_version() {
	echo Air::get('theme-name') . ' <span>' . Air::get('theme-version') . '</span>';
}

/**
	Admin bar menu
	- Action : admin_bar_menu
	- Adds items to admin bar menu
**/
function air_admin_bar_menu($admin_bar) {
	if (!is_super_admin() || !is_admin_bar_showing())  
        return;

	// Theme name menu item
	$admin_bar->add_node(
		array(
			'id'	=> 'wpbandit',
			'title'	=> '<span class="ab-icon"></span>'.
				'<span class="ab-label">'.Air::get('theme-name').'</span>',
			'href'	=> admin_url('/admin.php?page=theme-options')
		)
	);

	// Theme options submenu item
	$admin_bar->add_node(
		array(
			'id'		=> 'wpbandit-options',
			'title'		=> 'Theme Options',
			'href'		=> admin_url('/admin.php?page=theme-options'),
			'parent'	=> 'wpbandit'
		)
	);

	// Theme modules submenu item
	$admin_bar->add_node(
		array(
			'id'		=> 'wpbandit-modules',
			'title'		=> 'Theme Modules',
			'href'		=> admin_url('/admin.php?page=theme-modules'),
			'parent'	=> 'wpbandit'
		)
	);
}

/**
	Admin bar
	- Action: admin_head
	- Adds CSS to support icon in admin bar
	- Adds CSS to move admin bar to bottom of page
**/
function air_admin_bar() {
	// Do not display if admin bar not showing
	if ( !is_admin_bar_showing() )
		return;

	// Start style output
	$output = '<style>';
 
	// Move admin bar to bottom
	if ( Air::get('admin-bar-bottom') && !is_admin() )
		$output .= '
* html body { margin-top: 0 !important; }
body.admin-bar { margin-top: -28px; padding-bottom: 28px; }
body.wp-admin #footer { padding-bottom: 28px; }
#wpadminbar { top: auto !important; bottom: 0; }
#wpadminbar .quicklinks .ab-sub-wrapper { bottom: 28px; }
#wpadminbar .quicklinks .ab-sub-wrapper ul .ab-sub-wrapper { bottom: -7px; }
';

	// Set admin bar icon style
	$output .= '
#wpadminbar #wp-admin-bar-wpbandit .ab-icon { background: url(' . AIR_ASSETS . '/img/adminbar-icon.png); }
#wpadminbar #wp-admin-bar-wpbandit.menupop.hover .ab-icon { background-position: 0 -16px; }
';
 
	// End style output
	$output .= '</style>'."\n";
 
	// Print styles
	echo $output;
}

/**
	Air theme options menu
	- Displays theme options menu
**/
function air_theme_options_menu() {
	$menu = Air::get_options_menu();
	if( $menu ) {
		// Set current item
		$current = isset($_GET['section'])?esc_attr($_GET['section']):key($menu);

		// Build menu
		$output = '';
		foreach ( $menu as $key=>$value ) {
			// Set menu item url
			$url = admin_url('/admin.php?page=theme-options&section='.$key);
			// Set current class ?
			$output .= ($current === $key)?'<li class="current">':'<li>'; 
			// Create menu item
			$output .= '<a href="'.$url.'"><i class="air-icon air-icon-'.$key.'"></i>'.$value.'<span><i class="air-arrow"></i></span></a></li>';
		}

		// Print menu
		echo $output;
	}
}

/**
	Air modules menu
	- Displays modules menu
**/
function air_theme_modules_menu() {
	$menu = Air::get_modules();
	if( $menu ) {
		// Set current item
		$current = isset($_GET['module'])?esc_attr($_GET['module']):key($menu);

		// Build menu
		$output = '';
		foreach ( $menu as $key=>$value ) {
			// Set menu item url
			$url = admin_url('/admin.php?page=theme-modules&module='.$key);
			// Set current class ?
			$output .= ($current === $key)?'<li class="current">':'<li>'; 
			// Create menu item
			$output .= '<a href="'.$url.'"><i class="air-icon air-icon-'.$key.'"></i>'.$value.'<span><i class="air-arrow"></i></span></a></li>';
		}

		// Print menu
		echo $output;
	}
}

/**
	Air settings saved notice
	- Shows notice stating settings saved
**/
function air_settings_saved_notice() {
	if( isset($_GET['settings-updated']) &&
		('true' === $_GET['settings-updated']) ) {
		echo '<div id="air-save-notice"><p>Settings saved.</p></div>';
	}				
}

/**
	Theme styles
	- Populate theme styles into an array
**/
function air_get_theme_styles() {
	// Styles directory
	$styles_dir = get_template_directory().'/styles';

	// Default style
	$default = array( '0'=>'Default' );

	// Loop through styles
	if ( is_dir($styles_dir) && $handle = opendir($styles_dir) ) {
		while ( false !== ($file = readdir($handle)) ) {
			if ( $file != "." && $file != ".." &&
					is_file($styles_dir.'/'.$file) ) {
				$tmp = new SplFileObject($styles_dir.'/'.$file);
				$tmp->seek(1);
				$name = substr(esc_html($tmp->current()), 7);
				$styles[$file] = $name;
			}
		}
		closedir($handle);

		// Combine arrays
		if ( isset($styles) ) {
			asort($styles);
			$styles = $default + $styles;
		}
	}

	// Return styles
	return isset($styles)?$styles:$default;
}

/**
	Single post templates
	- Populate single post templates into an array
**/
function air_get_post_templates() {
	// Template directory
	$template_dir = get_template_directory();

	// Default style
	$default = array( '0'=>'Default' );

	// Loop through styles
	if ( $handle = opendir($template_dir) ) {
		while ( false !== ($file = readdir($handle)) ) {
			// Check that object is file
			if ( $file != "." && $file != ".." &&
					is_file($template_dir.'/'.$file) ) {
				// Limit to single template
				if ( substr($file,0,7) === 'single-' ) {
					$tmp = new SplFileObject($template_dir.'/'.$file);
					$tmp->seek(2);
					// Check for template name
					if ( strpos($tmp->current(),'Post Template') !== false ) {
						$name = substr(esc_html($tmp->current()), 15);
						$templates[$file] = $name;
					}
				}
			}
		}
		closedir($handle);

		// Combine arrays
		if ( isset($templates) ) {
			asort($templates);
			$templates = $default + $templates;
		}
	}

	// Return templates
	return isset($templates)?$templates:$default;
}
