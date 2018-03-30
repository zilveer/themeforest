<?php

require_once SG_TEMPLATEPATH . '/functions/sgpanel/options.php';

/* Actions */
add_action('admin_menu', 'sgp_add_panel_menu');
add_action('admin_init', 'sgp_init_scripts_and_styles');

/* CBS functions */
function sgp_init_scripts_and_styles()
{
	if(basename($_SERVER['PHP_SELF']) == 'admin.php') {	
		add_thickbox();
		wp_enqueue_script('media-upload');
		sgp_include_admin_css();
		sgp_include_admin_js();
	}
}

function sgp_include_admin_css()
{
	wp_register_style('sgp_admin_modules_style', get_template_directory_uri() . '/functions/sgpanel/sgpanel.css');
	wp_enqueue_style('sgp_admin_modules_style');
	wp_enqueue_style('farbtastic');
}

function sgp_include_admin_js()
{
	wp_register_script('sgp_js_admin_custom', get_template_directory_uri() . '/functions/sgpanel/sgpanel.js', false);
	wp_enqueue_script('sgp_js_admin_custom');
	wp_enqueue_script('farbtastic');
}

/* CB functions */
function sgp_add_panel_menu()
{	
	$options = sgp_options();
	if (isset($_GET['page']) && $_GET['page'] == 'sgpanel') {
		if (isset($_REQUEST['action']) AND $_REQUEST['action'] == 'save') {
			$sgp_options = sgp_options();

			foreach ($sgp_options as $tab => $tab_options) {
				foreach ($tab_options['modules'] as $module => $module_options) {
					SGP_Module::factory($module)->setVars($_POST);
				}
			}
			
			header("Location: admin.php?page=sgpanel&saved=true");
			die();
		} else if (isset($_REQUEST['action']) AND $_REQUEST['action'] == 'reset') {
			$sgp_options = sgp_options();

			foreach ($sgp_options as $tab => $tab_options) {
				foreach ($tab_options['modules'] as $module => $module_options) {
					SGP_Module::factory($module)->resetVars();
				}
			}
			header("Location: admin.php?page=sgpanel&reset=true");
			die();
		}
	}
	add_menu_page(__('Theme Options', SG_TDN), __('Theme Options', SG_TDN), 'edit_themes', 'sgpanel', 'sgp_admin_page', false, 30);
}

function sgp_admin_page()
{
	$sgp_options = sgp_options();
	$content = '';
	$menu = '';

	foreach ($sgp_options as $tab => $tab_options) {
		$tab_content = '';

		foreach ($tab_options['modules'] as $module => $module_options) {
			$params = (isset($module_options['params']) AND !empty($module_options['params'])) ? $module_options['params'] : NULL;
			$defaults = (isset($module_options['default']) AND !empty($module_options['default'])) ? $module_options['default'] : NULL;
			$tab_content .= SGP_Module::factory($module)->getAdminContent($params, $defaults);
		}

		$menu .= '<li><a href="#sgp-' . $tab_options['name'] . '-content" id="sgp-' . $tab_options['name'] . '">' . $tab_options['name'] . '</a></li>';
		$content .= '<div id="sgp-' . $tab_options['name'] . '-content" class="sgp-options-section">' . $tab_content . '</div>';
	}
	
	$content .= '<p>
					<input type="hidden" value="" name="action">
					<input type="submit" value="' . __('Save All Changes', SG_TDN) . '" class="button-primary" id="submit" name="submit">
					<input type="submit" value="' . __('Reset to Default', SG_TDN) . '" class="button button-highlighted" id="reset" name="reset">
				</p>';
	
	$content = '<div id="sgp-options-container">
					<div id="sg-logo"></div>
					<div id="sgp-options-sidebar"><ul>' . $menu . '</ul></div>
					<div id="sgp-options-content">' . $content . '</div>
				</div>';
	
	$content = '<form method="post">' . $content . '</form>';
	
	if (isset($_GET['saved']) AND $_GET['saved']) {
		$content = '<div class="updated settings-error" id="setting-error-settings_updated"> 
						<p><strong>' . __('Settings saved', SG_TDN) . '.</strong></p>
					</div>' . $content;
	}
	if (isset($_GET['reset']) AND $_GET['reset']) {
		$content = '<div class="updated settings-error" id="setting-error-settings_updated"> 
						<p><strong>' . __('Settings reseted to default', SG_TDN) . '.</strong></p>
					</div>' . $content;
	}
	
	$content = '<div class="icon32" id="icon-themes"><br></div><h2>' . __('Theme Options', SG_TDN) . '</h2>' . $content;
	
	echo '<div class="wrap">' . $content . '</div>';
}