<?php

class SGP_Modules_Module extends SGP_Module {

	const moduleName = 'Modules';

	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = NULL;

	private function __construct()
	{
		self::$_fields = array(
			'SEO' => array(
				'name' => __('Enable SEO module', SG_TDN),
				'type' => 'select',
				'options' => array(
					'yes' => __('Enable', SG_TDN),
					'no' => __('Disable', SG_TDN),
				),
				'default' => 'yes',
				'help' => __('Enable or Disable SEO module', SG_TDN),
			),
			'Theme' => array(
				'name' => __('Enable Style module', SG_TDN),
				'type' => 'select',
				'options' => array(
					'yes' => __('Enable', SG_TDN),
					'no' => __('Disable', SG_TDN),
				),
				'default' => 'yes',
				'help' => __('Enable or Disable Style module', SG_TDN),
			),
		);
	}

	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SGP_Modules_Module;
		}
		return self::$instance;
	}

	public function inited()
	{
		return !is_null(self::$_vars);
	}

	public function initVars($params, $defaults)
	{
		self::$_vars = self::_initVars(self::moduleName, self::$_params, self::$_fields, $params, $defaults);
		return TRUE;
	}

	public function setVars($post_data)
	{
		return self::_setVars(self::moduleName, self::$_fields, $post_data);
	}

	public function resetVars()
	{
		return self::_resetVars(self::moduleName);
	}

	public function getAdminContent($params, $defaults)
	{
		return self::_getAdminContent(self::moduleName, self::$_params, self::$_fields, self::$_description, $params, $defaults);
	}

	public function enabled($module_name) {
		return (isset(self::$_vars[$module_name]) ? (self::$_vars[$module_name] == 'yes') : TRUE);
	}

}