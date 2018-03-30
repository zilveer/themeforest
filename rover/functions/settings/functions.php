<?php
/**
 * @package by Theme Record
 * @auther: MattMao
*/

#
#This function be used for load theme pages.
#
function load_theme_pages() 
{
	$page = include(FUNCTIONS_DIR . '/settings/' . $_GET['page']. '.php');

	if($page['auto'])
	{
		new theme_options_generator($page['name'],$page['options']);
	}
}


#
# Theme options class--loads the default theme options.
#
class theme_options
{
	function theme_init_options() {
		global $theme_options;
		$theme_options = array();
		$option_files = array(
			'theme-settings',
			'theme-colors',
			'theme-fonts',
			'theme-payment'
		);
		foreach($option_files as $file){
			$page = include (FUNCTIONS_DIR . '/settings/' . $file.'.php');
			$theme_options[$page['name']] = array();
			foreach($page['options'] as $option) {
				if (isset($option['std'])) {
					$theme_options[$page['name']][$option['id']] = $option['std'];
				}
			}
			$theme_options[$page['name']] = array_merge((array) $theme_options[$page['name']], (array) get_option('admin_' .THEME_SLUG . '_' . $page['name']));
		}
	}
}

$load_theme_options = new theme_options();
$load_theme_options->theme_init_options();



#
# This function be used for getting theme options.
#
function get_theme_option($page, $name = NULL) 
{
	global $theme_options;

	if ($name == NULL) {
		if (isset($theme_options[$page])) {
			return $theme_options[$page];
		} else {
			return false;
		}

	} else {
		if (isset($theme_options[$page][$name])) {
			return $theme_options[$page][$name];
		} else {
			return false;
		}
	}
}
?>