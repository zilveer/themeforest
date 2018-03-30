<?php

/* Load Modules List */
require_once SG_TEMPLATEPATH . '/functions/modules/metaboxes-list.php';

class SGP_GlobalSettings_Module {
	
	const moduleName = 'GlobalSettings';
	
	protected static $instance;
	
	protected static $_params = array(
		'show_global_options' => TRUE,
		'show_entity_options' => TRUE,
	);
	
	private function __construct() {}
	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SGP_GlobalSettings_Module;
		}
		return self::$instance;
	}
	
	public function inited()
	{
		return TRUE;
	}
	
	public function setVars($post_data)
	{
		$defaults = sg_modules_list();
		
		foreach ($defaults as $page => $template) {
			if ($page == 'global') {
				foreach ($template as $module => $module_options) {
					SG_Module::factory($module)->setVars('sg_', $post_data);
				}
				continue;
			}
			foreach ($template as $template_name => $meta_box) {
				foreach ($meta_box as $meta_box_id => $meta_box_params) {
					foreach ($meta_box_params['modules'] as $module => $module_options) {
						if (isset($module_options['global'])) {
							$m_uniq = $meta_box_params['unique'];
							SG_Module::factory($module)->setVars('sg_' . $m_uniq, $post_data);
						}
					}
				}
			}
		}

		return TRUE;
	}
	
	public function resetVars()
	{
		$defaults = sg_modules_list();
		
		foreach ($defaults as $page => $template) {
			if ($page == 'global') {
				foreach ($template as $module => $module_options) {
					SG_Module::factory($module)->resetVars('sg_');
				}
				continue;
			}
			foreach ($template as $template_name => $meta_box) {
				foreach ($meta_box as $meta_box_id => $meta_box_params) {
					foreach ($meta_box_params['modules'] as $module => $module_options) {
						if (isset($module_options['global'])) {
							$m_uniq = $meta_box_params['unique'];
							SG_Module::factory($module)->resetVars('sg_' . $m_uniq);
						}
					}
				}
			}
		}

		return TRUE;
	}
	
	public function getAdminContent($params, $defaults)
	{
		$params = array_merge(self::$_params, is_array($params) ? $params : array());
		$defaults = sg_modules_list();
		
		$content = '';
		$menu = '';

		if ($params['show_global_options'] AND isset($defaults['global'])) {
			$tab_name = 'global';
			$tab_menu = '';
			foreach ($defaults['global'] as $module => $module_options) {
				$m_params = (isset($module_options['params']) AND !empty($module_options['params'])) ? $module_options['params'] : NULL;
				$m_defaults = (isset($module_options['default']) AND !empty($module_options['default'])) ? $module_options['default'] : NULL;
				
				$m_content = SG_Module::factory($module)->getAdminContent('sg_', $m_params, $m_defaults);
				$content .= '<div id="sg-' . $module . '-content" class="sg-meta-section">' . $m_content . '</div>';

				if (isset($module_options['menu_item']) AND !empty($module_options['menu_item'])) {
					$m_menu = $module_options['menu_item'];
				} else {
					$m_menu = SG_Module::factory($module)->getMenuItem();
				}
				$tab_menu .= '<li><a href="#sg-' . $module . '-content" id="sg-' . $module . '" class="sg-' . $module . '">' . $m_menu . '</a></li>';
			}
			if (!empty($tab_menu)) {
				$menu .= '<li class="sg-meta-tab">' . ucwords($tab_name) . '</li>' . $tab_menu;
			}
		}
		
		if ($params['show_entity_options']) {
			foreach ($defaults as $page => $template) {
				if ($page == 'global') continue;
				foreach ($template as $template_name => $meta_box) {
					$tab_name = ($template_name == 'default') ? $page : $template_name;
					$tab_menu = '';
					foreach ($meta_box as $meta_box_id => $meta_box_params) {
						foreach ($meta_box_params['modules'] as $module => $module_options) {
							if (isset($module_options['global'])) {
								if (!is_array($module_options['global'])) $module_options['global'] = NULL;
								$m_params = (isset($module_options['params']) AND !empty($module_options['params'])) ? $module_options['params'] : NULL;
								$m_defaults = (isset($module_options['global']) AND !empty($module_options['global'])) ? $module_options['global'] : NULL;
								$m_uniq = $meta_box_params['unique'];

								$m_content = SG_Module::factory($module)->getAdminContent('sg_' . $m_uniq, $m_params, $m_defaults);
								$content .= '<div id="sg-' . $m_uniq . $module . '-content" class="sg-meta-section">' . $m_content . '</div>';

								if (isset($module_options['menu_item']) AND !empty($module_options['menu_item'])) {
									$m_menu = $module_options['menu_item'];
								} else {
									$m_menu = SG_Module::factory($module)->getMenuItem();
								}
								$tab_menu .= '<li><a href="#sg-' . $m_uniq . $module . '-content" id="sg-' . $m_uniq . $module . '" class="sg-' . $module . '">' . $m_menu . '</a></li>';
							}
						}
					}
					if (!empty($tab_menu)) {
						$menu .= '<li class="sg-meta-tab">' . ucwords($tab_name) . '</li>' . $tab_menu;
					}
				}
			}
		}
		
		$content = '<div class="sg-meta-container">
						<div class="sg-meta-sidebar"><ul>' . $menu . '</ul></div>
						<div class="sg-meta-content">' . $content . '</div>
					</div>';

		return $content;
	}
	
}