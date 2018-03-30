<?php

class SG_Layout_Module extends SG_Module {

	const moduleName = 'Layout';

	protected static $instance;
	protected static $_vars = NULL;

	protected static $_params = array(
		'show_description' => TRUE,
		'used_layouts' => array('page_l', 'page_r', 'page_n', 'page_d'),
		'default_layout' => 'page_n',
	);

	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'layout' => array(
				'name' => __('Layout', SG_TDN),
				'type' => 'layout',
				'options' => array(
					'page_l' => __('Sidebar at left', SG_TDN),
					'page_r' => __('Sidebar at right', SG_TDN),
					'page_d' => __('Sidebars at left and right', SG_TDN),
					'page_t' => __('Sidebar at top', SG_TDN),
					'page_n' => __('No Sidebar', SG_TDN),
					'blog_grid_l' => __('Blog Grid and left sidebar', SG_TDN),
					'blog_grid_r' => __('Blog Grid and right sidebar', SG_TDN),
					'portfolio_2' => __('2 Colum Portfolio', SG_TDN),
					'portfolio_3' => __('3 Colum Portfolio', SG_TDN),
					'portfolio_4' => __('4 Colum Portfolio', SG_TDN),
					'portfolio_s' => __('Portfolio as Gallery', SG_TDN),
					'portfolio_2a' => __('2 Colum Portfolio and Ajax', SG_TDN),
					'portfolio_3a' => __('3 Colum Portfolio and Ajax', SG_TDN),
					'portfolio_4a' => __('4 Colum Portfolio and Ajax', SG_TDN),
					'portfolio_a' => __('Portfolio accordion', SG_TDN),
				),
				'default' => '',
				'show' => self::SHOW_ALL,
				'help' => __('Select a layout type', SG_TDN),
			),
		);

		self::$_description = __('Layout Setup', SG_TDN);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_Layout_Module;
		}
		return self::$instance;
	}

	public function inited()
	{
		return !is_null(self::$_vars);
	}

	public function initVars($uniq, $params, $defaults, $global, $post_id)
	{
		$p = self::_getParams($params, self::$_params);
		$fields = self::$_fields;
		$fields['layout']['default'] = $p['default_layout'];

		self::$_vars = self::_initVars(self::moduleName, $uniq, self::$_params, $fields, $params, $defaults, $global, $post_id);
		return TRUE;
	}

	public function setVars($uniq, $post_data, $post_id = NULL)
	{
		return self::_setVars(self::moduleName, $uniq, self::$_fields, $post_data, $post_id);
	}

	public function resetVars($uniq, $post_id = NULL)
	{
		return self::_resetVars(self::moduleName, $uniq, $post_id);
	}

	public function getMenuItem()
	{
		return __('Layout', SG_TDN);
	}

	protected function _getLayoutField($uid, $params, $value, $default, $ug)
	{
		if ($ug) $params['options'][self::USE_GLOBAL] = __('Global', SG_TDN) . ' (' . $params['options'][$default] . ')';

		$c = '<div class="sg-layout-group" align="center">';
			foreach ($params['options'] as $oval => $oname) {
				$radio = SG_Form::radio($uid, $oval, $oval == $value);
				$global = ($oval == self::USE_GLOBAL) ? __('GLOBAL', SG_TDN) : '';
				$class = ($oval == self::USE_GLOBAL) ? $default : $oval;
				$item = '<span class="sg-layout-' . $class . '">' . $global  . '</span>' . $radio;
				$c .= SG_Form::label(NULL, $item, array('class' => 'sg-layout-item', 'title' => $oname));
			}
			$c .= '<div class="clear"></div>';
		$c .= '</div>';

		return $c;
	}

	public function getAdminContent($uniq, $params, $defaults, $global = NULL, $post_id = NULL)
	{
		$p = self::_getParams($params, self::$_params);
		$description = ($p['show_description']) ? self::$_description : NULL;
		$fields = self::$_fields;
		$fields['layout']['default'] = $p['default_layout'];

		foreach (self::$_fields['layout']['options'] as $layout => $name) {
			if (!in_array($layout, $p['used_layouts'])) unset($fields['layout']['options'][$layout]);
		}

		return self::_getAdminContent(self::moduleName, $uniq, self::$_params, $fields, $description, $params, $defaults, $global, $post_id);
	}

	public function getLayout()
	{
		return self::$_vars['layout'];
	}

}