<?php

class SG_Module {

	const USE_GLOBAL = 'sg_use_global';
	const USE_CUSTOM = 'sg_use_custom';
	const USE_DEFAULT = 'sg_use_default';
	const USE_NONE = 'sg_use_none';
	const USE_ALL = 'sg_use_all';

	const SHOW_ALL = 'show_all';
	const SHOW_NONE = 'show_none';
	const SHOW_GLOBAL = 'show_global';
	const SHOW_ENTITY = 'show_entity';

	public static function factory($module_name)
	{
		if (include_once SG_TEMPLATEPATH . '/functions/modules/' . strtolower($module_name) . '.php') {
			return call_user_func(array('SG_' . $module_name . '_Module', 'getInstance'));
		}
		return FALSE;
	}

	protected static function _getPx($uniq, $name)
	{
		return $uniq . $name;
	}

	protected static function _getParams($params, $self)
	{
		$params = array_merge($self, is_array($params) ? $params : array());
		if (isset($params['fields'])) unset($params['fields']);

		return $params;
	}

	protected static function _getFields($fields, $params)
	{
		if (isset($params['fields'])) {
			foreach ($params['fields'] as $name => $options) {
				$fields[$name] = array_merge($fields[$name], $options);
			}
		}

		return $fields;
	}

	protected static function _getDefaults($defaults, $fields, $ug)
	{
		$ds = array();

		foreach ($fields as $field => $options) {
			$show = isset($options['show']) ? $options['show'] : self::SHOW_ENTITY;
			$show_in_global = ($show == self::SHOW_ALL OR $show == self::SHOW_GLOBAL);

			if ($ug AND $show_in_global) {
				if (is_array($options['default'])) {
					$default = array_merge($options['default'], array('value' => self::USE_GLOBAL));
					$ds[$field] = isset($options['default2']) ? $options['default2'] : $default;
				} else {
					$ds[$field] = isset($options['default2']) ? $options['default2'] : self::USE_GLOBAL;
				}
			} else {
				$ds[$field] = isset($defaults[$field]) ? $defaults[$field] : $options['default'];
			}
		}

		return $ds;
	}

	protected static function _getVars($name, $uniq, $defaults, $post_id = NULL)
	{
		$demo = (SG_DEMO_MODE) ? sg_demo_init($name, $uniq, $post_id) : array();

		if (is_null($post_id)) {
			$loaded_vars = get_option(SG_SLUG . $uniq . $name);
			if (!empty($uniq)) {
				$loaded_vars2 = get_option(SG_SLUG . 'sg_' . $name);
				if (!empty($loaded_vars) OR !empty($loaded_vars2)) {
					$loaded_vars = empty($loaded_vars) ? array() : $loaded_vars;
					$loaded_vars2 = empty($loaded_vars2) ? array() : $loaded_vars2;
					$loaded_vars = array_merge($loaded_vars2, $loaded_vars);
				}
			}
			if (!empty($loaded_vars)) {
				return array_merge((array)$defaults, (array)stripSlashesIfNeed($loaded_vars), (array)$demo);
			}
		} else {
			$loaded_vars = get_post_meta($post_id, SG_SLUG . $uniq . $name);
			if (!empty($loaded_vars)) {
				return array_merge((array)$defaults, (array)stripSlashesIfNeed($loaded_vars[0]), (array)$demo);
			}
		}

		return array_merge((array)$defaults, (array)$demo);
	}

	protected static function _setVars($name, $uniq, $fields, $post_data, $post_id = NULL)
	{
		$px = self::_getPx($uniq, $name);
		$is_post = !is_null($post_id);
		$fields_list = array();
		$fields_list_px = array();

		foreach ($fields as $field => $field_params) {
			$fields_list[] = $field;
			$fields_list_px[] = $px . '_' . $field;
		}

		$aki = array_intersect(array_keys($post_data), $fields_list_px);

		if (!empty($aki)) {
			$vars = array();

			foreach ($fields_list as $field) {
				if (isset($post_data[$px . '_' . $field])) $vars[$field] = $post_data[$px . '_' . $field];
			}

			if (is_null($post_id)) {
				update_option(SG_SLUG . $uniq . $name, $vars);
			} else {
				update_post_meta($post_id, SG_SLUG . $uniq . $name, $vars);
			}

			return TRUE;
		}

		return FALSE;
	}

	protected static function _resetVars($name, $uniq, $post_id = NULL)
	{
		if (is_null($post_id)) {
			delete_option(SG_SLUG . $uniq . $name);
		} else {
			delete_post_meta($post_id, SG_SLUG . $uniq . $name);
		}

		return TRUE;
	}

	protected static function _initVars($name, $uniq, $_params, $_fields, $params, $defaults, $global, $post_id)
	{
		$ug = !is_null($global);
		$fields = self::_getFields($_fields, $params);
		$params = self::_getParams($params, $_params);
		$defaults = self::_getDefaults($defaults, $fields, $ug);
		$vars = self::_getVars($name, $uniq, $defaults, $post_id);
		$global = self::_getDefaults($global, $fields, FALSE);
		$gvars = self::_getVars($name, $uniq, $global);
		$vars = array_merge($gvars, $vars);

		foreach ($fields as $field => $opt) {
			if (isset($vars[$field]) AND is_array($vars[$field]) AND array_key_exists('value', $vars[$field])) {
				if ($vars[$field]['value'] == self::USE_GLOBAL) {
					$vars[$field] = $gvars[$field];
				}
			} elseif (isset($vars[$field])) {
				if ($vars[$field] == self::USE_GLOBAL) {
					$vars[$field] = $gvars[$field];
				}
			} else {
				$vars[$field] = self::USE_NONE;
			}
		}

		return $vars;
	}

	protected static function _getAdminContent($name, $uniq, $_params, $_fields, $description, $params, $defaults, $global = NULL, $post_id = NULL)
	{
		$ug = !is_null($global);
		$fields = self::_getFields($_fields, $params);
		$params = self::_getParams($params, $_params);
		$defaults = self::_getDefaults($defaults, $fields, $ug);
		$vars = self::_getVars($name, $uniq, $defaults, $post_id);
		$global = self::_getDefaults($global, $fields, FALSE);
		$gvars = !$ug ? NULL : self::_getVars($name, $uniq, $global);

		$content = (!empty($description)) ? '<p class="sg-metabox-description">' . $description . '</p>' : '';
		$content .= self::_getMetaboxFields($name, $uniq, $params, $fields, $vars, $gvars, $post_id);

		return $content;
	}

	protected static function _getMetaboxFields($name, $uniq, $params, $fields, $vars, $global = NULL, $post_id = NULL)
	{
		$px = self::_getPx($uniq, $name);
		$ug = !is_null($global);
		$is_post = !is_null($post_id);
		$c = '';
		$js = '';
		$group = '';
		$ogroup = FALSE;

		foreach ($fields as $field => $field_params) {
			$show = isset($field_params['show']) ? $field_params['show'] : self::SHOW_ENTITY;
			$show_in_global = ($show == self::SHOW_ALL OR $show == self::SHOW_GLOBAL);
			$show_in_entity = ($show == self::SHOW_ALL OR $show == self::SHOW_ENTITY);

			$fug = ($ug AND $show_in_global);

			if (($show_in_global AND !$is_post) OR ($show_in_entity AND $is_post)) {
				$fn = '_get' . ucwords($field_params['type']) . 'Field';
				$value = $vars[$field];
				$default = (!is_null($global) AND array_key_exists($field, $global)) ? $global[$field] : NULL;
				$class = isset($field_params['class']) ? $field_params['class'] : 'sg-metabox-field';

				$cgroup = isset($field_params['group']) ? $field_params['group'] : '';
				if ($cgroup != $group AND $ogroup) {
					$c .= '</div>';
					$ogroup = FALSE;
				}
				if ($cgroup != '' AND !$ogroup) {
					$c .= '<div class="sg-metabox-group ' . $px . '_' . $cgroup . '-group">';
					$ogroup = TRUE;
					$group = $cgroup;
				}

				if (isset($field_params['change']) AND !empty($field_params['change'])) {
					foreach ($field_params['change'] as $egroup => $sgroup) {
						$js .= '
	function ' . $px . '_' . $field . '_change_' . $egroup . '(){
		if ($.inArray($("select[name=' . $px . '_' . $field . ']").val(), ' . $sgroup . ') + 1) {
			$(".' . $px . '_' . $egroup . '-group").show();
		} else {
			$(".' . $px . '_' . $egroup . '-group").hide();
		}
	}
	' . $px . '_' . $field . '_change_' . $egroup . '();
	$("select[name=' . $px . '_' . $field . ']").change(' . $px . '_' . $field . '_change_' . $egroup . ');' . "\n";
					}
				}

				$c .= '<div class="' . $class . '">';
					$c .= '<div class="sg-metabox-info">';
						$c .= SG_Form::label($px . '_' . $field, '<span>' . $field_params['name'] . '</span>', array('class' => 'sg-meta-lable'));
						$c .= '<div class="sg-metabox-help">' . (isset($field_params['help']) ? $field_params['help'] : ' ') . '</div>';
					$c .='</div>';
					$c .= '<div class="sg-metabox-input">';
						$c .= self::factory($name)->{$fn}($px . '_' . $field, $field_params, $value, $default, $fug);
					$c .='</div>';
				$c .='</div>';
			}
		}

		$c .= $ogroup ? '</div>' : '';

		if (!empty($js)) {
			$c .= '<script type="text/javascript">';
			$c .= '
//<![CDATA[
jQuery(document).ready(function($){' . $js . '});
//]]>
				';
			$c .= '</script>';
		}

		return $c;
	}

	protected function _getInputField($uid, $params, $value, $default, $ug)
	{
		$attr = isset($params['attr']) ? $params['attr'] : NULL;

		$c = SG_Form::input($uid, $value, $attr);

		return $c;
	}

	protected function _getTextField($uid, $params, $value, $default, $ug)
	{
		$attr = isset($params['attr']) ? $params['attr'] : NULL;

		$c = SG_Form::textarea($uid, $value, $attr);

		return $c;
	}

	protected function _getSelectField($uid, $params, $value, $default, $ug)
	{
		if ($ug) $params['options'][self::USE_GLOBAL] = __('Global', SG_TDN) . ' (' . $params['options'][$default] . ')';
		$attr = isset($params['attr']) ? $params['attr'] : NULL;

		$c = SG_Form::select($uid, $params['options'], $value, $attr);

		return $c;
	}

	protected function _getSelect2Field($uid, $params, $value, $default, $ug)
	{
		$c = '';

		if (!isset($params['show_all']) OR $params['show_all']) {
			$attr = array('onclick' => 'sg_allselections("' . $uid . '");');
			$radio = SG_Form::radio($uid . '[value]', self::USE_ALL, self::USE_ALL == $value['value'], $attr);
			$c .= SG_Form::label(NULL, $radio . ' <span>' . __('Use All', SG_TDN) . '</span>') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

			if (self::USE_ALL == $value['value']) $value['custom'] = array_keys($params['options']);
		}

		if (!isset($params['show_none']) OR $params['show_none']) {
			$attr = array('onclick' => 'sg_disableselections("' . $uid . '");');
			$radio = SG_Form::radio($uid . '[value]', self::USE_NONE, self::USE_NONE == $value['value'], $attr);
			$c .= SG_Form::label(NULL, $radio . ' <span>' . __('Use None', SG_TDN) . '</span>') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		}

		$attr = array('onclick' => 'sg_enableselections("' . $uid . '");');
		$radio = SG_Form::radio($uid . '[value]', self::USE_CUSTOM, self::USE_CUSTOM == $value['value'], $attr);
		$c .= SG_Form::label(NULL, $radio . ' <span>' . __('Select', SG_TDN) . '</span>') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

		if ($ug) {
			$attr = array('onclick' => 'sg_globalselections("' . $uid . '", "' . implode('|||', $default['custom']) . '");');
			$radio = SG_Form::radio($uid . '[value]', self::USE_GLOBAL, self::USE_GLOBAL == $value['value'], $attr);
			$c .= SG_Form::label(NULL, $radio . ' <span>' . __('Global', SG_TDN) . '</span>') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

			if (self::USE_GLOBAL == $value['value']) $value['custom'] = $default['custom'];
		}

		$c .= '<br /><br />';

		$attr = array('multiple' => 'multiple', 'id' => $uid);
		$c .= SG_Form::select($uid . '[custom][]', $params['options'], $value['custom'], $attr);

		$c .= '<script type="text/javascript">';
		$c .= '
//<![CDATA[
function sg_allselections(id) {
	var e = document.getElementById(id);
		e.disabled = true;
	var i = 0;
	var n = e.options.length;
	for (i = 0; i < n; i++) {
		e.options[i].disabled = true;
		e.options[i].selected = true;
	}
}
function sg_disableselections(id) {
	var e = document.getElementById(id);
		e.disabled = true;
	var i = 0;
	var n = e.options.length;
	for (i = 0; i < n; i++) {
		e.options[i].disabled = true;
		e.options[i].selected = false;
	}
}
function sg_enableselections(id) {
	var e = document.getElementById(id);
		e.disabled = false;
	var i = 0;
	var n = e.options.length;
	for (i = 0; i < n; i++) {
		e.options[i].disabled = false;
	}
}
function sg_globalselections(id, opts) {
	function sg_in_array(value, array) {
		for(var i = 0; i < array.length; i++) {
			if(array[i] == value) return true;
		}
		return false;
	}
	var e = document.getElementById(id);
		e.disabled = true;
	var	array_opts = opts.split("|||");
	var i = 0;
	var n = e.options.length;
	for (i = 0; i < n; i++) {
		e.options[i].disabled = true;
		if (sg_in_array(e.options[i].value, array_opts)) {
			e.options[i].selected = true;
		} else {
			e.options[i].selected = false;
		}
	}
}
' . (self::USE_ALL == $value['value'] ? 'sg_allselections("' . $uid . '")' : '') . ';
//]]>
			';
		$c .= '</script>';

		return $c;
	}

	protected function _getRadioField($uid, $params, $value, $default, $ug)
	{
		if ($ug) $params['options'][self::USE_GLOBAL] = __('Global', SG_TDN) . ' (' . $params['options'][$default] . ')';
		$nl = (isset($params['inline']) AND $params['inline'] == TRUE) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '<br />';

		$c = '<div class="sg-meta-group">';
		foreach ($params['options'] as $oval => $oname) {
			$attr = ($oval == self::USE_GLOBAL) ? array('rel' => $default) : NULL;
			$radio = SG_Form::radio($uid, $oval, $oval == $value, $attr);
			$c .= SG_Form::label(NULL, $radio . ' <span>' . $oname  . '</span>') . $nl;
		}
		$c .= '</div>';

		return $c;
	}

	protected function _getRadio2Field($uid, $params, $value, $default, $ug)
	{
		$params['options'][self::USE_CUSTOM] = __('Custom', SG_TDN);
		if ($ug) {
			$dt = ($default['value'] == self::USE_CUSTOM) ? $default['custom'] : $params['options'][$default['value']];
			$dtv = ($default['value'] == self::USE_CUSTOM) ? $default['custom'] : $default['value'];
			$params['options'][self::USE_GLOBAL] = __('Global', SG_TDN) . ' (' . $dt . ')';
		}
		$attr = isset($params['attr']) ? $params['attr'] : NULL;

		$c = '<div class="sg-meta-group">';
		foreach ($params['options'] as $oval => $oname) {
			$attr = ($oval == self::USE_GLOBAL) ? array('rel' => $dtv) : NULL;
			$radio = SG_Form::radio($uid . '[value]', $oval, $oval == $value['value']);
			$c2 = ($oval == self::USE_CUSTOM) ? ' ' . SG_Form::input($uid . '[custom]', $value['custom'], $attr) : '';
			$c .= SG_Form::label(NULL, $radio . ' <span>' . $oname  . '</span>') . $c2 . '<br />';
		}
		$c .= '</div>';

		return $c;
	}

	protected function _getCheckboxField($uid, $params, $value, $default, $ug)
	{
		$nl = (isset($params['inline']) AND $params['inline'] == TRUE) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : '<br />';
		$value = is_array($value) ? $value : array($value);

		$c = '<div class="sg-meta-group">';
		foreach ($params['options'] as $oval => $oname) {
			$radio = SG_Form::checkbox($uid . '[]', $oval, in_array($oval, $value));
			$c .= SG_Form::label(NULL, $radio . ' <span>' . $oname  . '</span>') . $nl;
		}
		$c .= '</div>';

		return $c;
	}

}