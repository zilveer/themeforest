<?php

class SG_Portfolio_Module extends SG_Module {

	const moduleName = 'Portfolio';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'filter' => array(
				'name' => __('Projects Filter', SG_TDN),
				'type' => 'select',
				'options' => array(
					'filter' => __('Chess Filter', SG_TDN),
					'isotope' => __('Isotope Filter', SG_TDN),
				),
				'default' => 'isotope',
				'help' => __('Select filter type for the Portfolio', SG_TDN),
			),
			'required_categories' => array(
				'name' => __('Select Required categories', SG_TDN),
				'type' => 'select2',
				'options' => array(),
				'default' => array(
					'value' => self::USE_ALL,
					'custom' => NULL,
				),
				'show_none' => FALSE,
				'help' => __('Projects from selected categories will be displayed on the Portfolio page. If nothing was selected, it will display all works', SG_TDN),
			),
			'text' => array(
				'name' => __('Text Before Portfolio', SG_TDN),
				'type' => 'text',
				'default' => '',
				'help' => __('Enter a text here', SG_TDN),
			),
		);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_Portfolio_Module;
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

		$tags = get_terms('portfolio_category', array('hide_empty' => FALSE));
		$topt = array();

		foreach ($tags as $tag) {
			$topt[$tag->term_id] = $tag->name;
		}

		$fields['required_categories']['options'] = $topt;

		return self::_getAdminContent(self::moduleName, $uniq, self::$_params, $fields, self::$_description, $params, $defaults, $global, $post_id);;
	}

	public function getFilter()
	{
		return self::$_vars['filter'];
	}

	public function getRequiredCategories()
	{
		if (self::$_vars['required_categories']['value'] == self::USE_ALL) return '';
		return self::$_vars['required_categories']['custom'];
	}

	public function eText()
	{
		self::$_vars['text'] = trim(self::$_vars['text']);
		echo !empty(self::$_vars['text']) ? '<p class="first-paragraph">' . str_replace('<p>', '', str_replace('</p>', '<br />', wpautop(__(self::$_vars['text'])))) . '</p><hr class="ef-blank" />' : '';
	}

}