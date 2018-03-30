<?php

require_once SG_TEMPLATEPATH . '/functions/modules/metaboxes-list.php';

/* Actions */
add_action('admin_print_styles', 'sg_include_admin_css');
add_action('admin_print_scripts', 'sg_include_admin_js');
add_action('admin_init', 'sg_metabox_add', 1);
add_action('save_post', 'sg_metabox_save');


/* CBS functions */
function sg_include_admin_css()
{
	wp_register_style('sg_admin_modules_style', get_template_directory_uri() . '/functions/modules/admin-modules.css');
	wp_enqueue_style('sg_admin_modules_style');
}

function sg_include_admin_js()
{
	wp_register_script('sg_js_admin_custom', get_template_directory_uri() . '/functions/modules/admin-modules.js', false);
	wp_enqueue_script('sg_js_admin_custom');
}


/* CBC functions */
function sg_metabox_add()
{
	$sg_meta_boxes = sg_modules_list();

	foreach ($sg_meta_boxes as $page => $template) {
		if ($page == 'global') continue;
		foreach ($template as $template_name => $meta_box) {
			foreach ($meta_box as $meta_box_id => $params) {
				$options = array(
					'tpl' => $template_name,
					'uniq' => $params['unique'],
					'mods' => $params['modules'],
					'params' => isset($params['params']) ? $params['params'] : array(),
					'global' => isset($sg_meta_boxes['global']) ? $sg_meta_boxes['global'] : array(),
				);
				add_meta_box($meta_box_id, $params['title'], 'sg_metabox_content', $page, $params['position'], $params['priority'], $options);
			}
		}
	}
}

function sg_metabox_content($post, $params)
{
	$args = $params['args'];
	$content = '';
	$menu = '';
	$count = 0;

	foreach ($args['mods'] as $module => $module_options) {
		if (!_sg('Modules')->enabled($module)) continue;
		if (isset($module_options['hidden'])) continue;
		$count++;

		$m_params = (isset($module_options['params']) AND !empty($module_options['params'])) ? $module_options['params'] : NULL;
		$m_defaults = (isset($module_options['default']) AND !empty($module_options['default'])) ? $module_options['default'] : NULL;
		$m_uniq = $args['uniq'];

		$ug = (isset($module_options['global']) OR isset($args['global'][$module]));
		$m_global = (isset($module_options['global']) AND is_array($module_options['global'])) ? $module_options['global'] : array();
		$s_global = (isset($args['global'][$module]) AND isset($args['global'][$module]['default'])) ? $args['global'][$module]['default'] : array();
		$global = array_merge($s_global, $m_global);
		$global = empty($global) ? ($ug ? TRUE : NULL) : $global;

		$mc = SG_Module::factory($module)->getAdminContent('sg_' . $m_uniq, $m_params, $m_defaults, $global, $post->ID);
		$content .= '<div id="sg-' . $m_uniq . $module . '-content" class="sg-meta-section">' . $mc . '</div>';

		$name = (isset($module_options['menu_item']) AND !empty($module_options['menu_item'])) ? $module_options['menu_item'] : SG_Module::factory($module)->getMenuItem();
		$menu .= '<li><a href="#sg-' . $m_uniq . $module . '-content" id="sg-' . $m_uniq . $module . '" class="sg-' . $module . '">' . $name . '</a></li>';
	}

	$class = isset($args['params']['class']) ? ' ' . $args['params']['class'] : '';
	$content = '<div class="hidden ' . $args['tpl'] . $class . '"></div>' .
			'<div class="sg-meta-container">' .
			($count > 1 ? '<div class="sg-meta-sidebar"><ul>' . $menu . '</ul></div><div class="sg-meta-content">' :
					'<div class="sg-meta-content">') .
			$content . '</div></div>';

	echo $content;
}

function sg_metabox_save($post_id)
{
	$sg_meta_boxes = sg_modules_list();

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;

	foreach ($sg_meta_boxes as $page => $template) {
		if ($page == 'global') continue;
		foreach ($template as $template_name => $meta_box) {
			foreach ($meta_box as $meta_box_id => $params) {
				foreach ($params['modules'] as $module => $module_options) {
					if (!_sg('Modules')->enabled($module)) continue;
					if (isset($module_options['hidden'])) continue;
					$c = SG_Module::factory($module)->setVars('sg_' . $params['unique'], $_POST, $post_id);
					if (!$c) break;
				}
				if (!$c) break;
			}
			if (!$c) break;
		}
	}
}