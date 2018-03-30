<?php

class SG_Page_Module extends SG_Module {

	const moduleName = 'Page';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'bottom_module' => array(
				'name' => __('Module at bottom', SG_TDN),
				'type' => 'select',
				'options' => array(
					self::USE_NONE => __('Hidden', SG_TDN),
					'team' => __('Our Team', SG_TDN),
					'extra' => __('Extras', SG_TDN),
				),
				'default' => self::USE_NONE,
				'change' => array(
					'team' => '["team"]',
					'extras' => '["extra"]',
				),
				'help' => __('Show or hide the theme modules (available Our team or Extras)', SG_TDN),
			),
			'team_title' => array(
				'name' => __('Title for "Our Team" module', SG_TDN),
				'type' => 'input',
				'default' => '',
				'group' => 'team',
				'help' => __('Enter a title of "Our Team" module', SG_TDN),
			),
			'team_category' => array(
				'name' => __('Category of "Our Team" module', SG_TDN),
				'type' => 'select',
				'options' => array(),
				'default' => 0,
				'group' => 'team',
				'help' => __('Select categories of "Our Team" module will be choosen from', SG_TDN),
			),
			'extras_title' => array(
				'name' => __('Title for "Extras" module', SG_TDN),
				'type' => 'input',
				'default' => '',
				'group' => 'extras',
				'help' => __('Enter a title of "Extras" module', SG_TDN),
			),
			'extras_category' => array(
				'name' => __('Category for "Extras" module', SG_TDN),
				'type' => 'select',
				'options' => array(),
				'default' => 0,
				'group' => 'extras',
				'help' => __('Select categories for "Extras" module', SG_TDN),
			),
		);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_Page_Module;
		}
		return self::$instance;
	}

	public function inited()
	{
		return !is_null(self::$_vars);
	}

	public function initVars($uniq, $params, $defaults, $global, $post_id)
	{
		self::$_vars = self::_initVars(self::moduleName, $uniq, self::$_params, self::$_fields, $params, $defaults, $global, $post_id);
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
		return __('Content', SG_TDN);
	}

	public function getAdminContent($uniq, $params, $defaults, $global = NULL, $post_id = NULL)
	{
		$fields = self::$_fields;

		$categories = get_terms('extra_category', array('hide_empty' => FALSE));
		$ec = array(0 => __('All', SG_TDN));

		foreach ($categories as $category) {
			$ec[$category->term_id] = $category->name;
		}

		$categories = get_terms('our-team_category', array('hide_empty' => FALSE));
		$tc = array(0 => __('All', SG_TDN));

		foreach ($categories as $category) {
			$tc[$category->term_id] = $category->name;
		}

		$fields['extras_category']['options'] = $ec;
		$fields['team_category']['options'] = $tc;

		return self::_getAdminContent(self::moduleName, $uniq, self::$_params, $fields, self::$_description, $params, $defaults, $global, $post_id);
	}

	public function getBottomType()
	{
		return self::$_vars['bottom_module'];
	}

	public function showExtrasTitle()
	{
		return !empty(self::$_vars['extras_title']);
	}

	public function eExtrasTitle()
	{
		echo __(self::$_vars['extras_title']);
	}

	public function getExtrasCategory()
	{
		return self::$_vars['extras_category'];
	}

	public function showTeamTitle()
	{
		return !empty(self::$_vars['team_title']);
	}

	public function eTeamTitle()
	{
		echo __(self::$_vars['team_title']);
	}

	public function getTeamCategory()
	{
		return self::$_vars['team_category'];
	}
}