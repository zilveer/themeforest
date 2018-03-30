<?php

require_once SG_TEMPLATEPATH . '/functions/modules/module.php';

class SGP_Module extends SG_Module {
	
	public static function factory($module_name)
	{
		$file_name = ($module_name == 'GlobalSettings') ? 'Settings' : $module_name;
		if (include_once SG_TEMPLATEPATH . '/functions/sgpanel/modules/sgp-' . strtolower($file_name) . '.php') {
			return call_user_func(array('SGP_' . $module_name . '_Module', 'getInstance'));
		}
		return FALSE;
	}
	
	protected static function _getAdminContent($name, $_params, $_fields, $description, $params, $defaults)
	{
		$uniq = 'sgp_';
		$params = self::_getParams($params, $_params);
		$defaults = self::_getDefaults($defaults, $_fields, FALSE);
		$vars = self::_getVars($name, $uniq, $defaults);
		
		$content = '<div class="sgp-content sgp-' . $name . '">';
		$content .= (!empty($description)) ? '<p class="sg-metabox-description">' . $description . '</p>' : '';
		$content .= self::_getMetaboxFields($name, $uniq, $params, $_fields, $vars);
		$content .= '</div>';
		$content .= '<div style="height:1px;"></div>';
		
		return $content;
	}
	
	protected static function _getMetaboxFields($name, $uniq, $params, $fields, $vars)
	{
		$px = self::_getPx($uniq, $name);
		$c = '';
		
		foreach ($fields as $field => $field_params) {
			$show = isset($field_params['show']) ? $field_params['show'] : self::SHOW_GLOBAL;
			
			if ($show == self::SHOW_ALL OR $show == self::SHOW_GLOBAL) {
				$fn = '_get' . ucwords($field_params['type']) . 'Field';
				$value = $vars[$field];
				$class = isset($field_params['class']) ? $field_params['class'] : 'sg-metabox-field';
				
				$c .= '<div class="' . $class . '">';
					$c .= '<div class="sg-metabox-info">';
						$c .= SG_Form::label($px . '_' . $field, '<span>' . $field_params['name'] . '</span>', array('class' => 'sg-meta-lable'));
						$c .= '<div class="sg-metabox-help">' . (isset($field_params['help']) ? $field_params['help'] : ' ') . '</div>';
					$c .='</div>';
					$c .= '<div class="sg-metabox-input">';
						$c .= self::factory($name)->{$fn}($px . '_' . $field, $field_params, $value, FALSE, NULL);
					$c .='</div>';
				$c .='</div>';
			}
		}
		
		return $c;
	}
	
	protected static function _initVars($name, $_params, $_fields, $params, $defaults)
	{
		$uniq = 'sgp_';
		$params = self::_getParams($params, $_params);
		$defaults = self::_getDefaults($defaults, $_fields, FALSE);
		$vars = self::_getVars($name, $uniq, $defaults);
		
		return $vars;
	}
	
	protected static function _setVars($name, $fields, $post_data)
	{
		$uniq = 'sgp_';
		return parent::_setVars($name, $uniq, $fields, $post_data);
	}
	
	protected static function _resetVars($name)
	{
		$uniq = 'sgp_';
		return parent::_resetVars($name, $uniq);
	}

}