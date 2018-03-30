<?php

class SG_Empty_Module extends SG_Module {
	
	const moduleName = 'Empty';
	
	protected static $instance;
	protected static $_vars = NULL;
	protected static $_params = array();
	protected static $_fields = array();
	protected static $_description = 'Here could be your advertisement!!! :)';
	
	private function __construct() {}
	private function __clone() {}

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new SG_Empty_Module;
		}
		return self::$instance;
	}
	
	public function inited()
	{
		return TRUE;
	}
	
	public function initVars($uniq, $params, $defaults, $global, $post_id)
	{
		return TRUE;
	}
	
	public function setVars($uniq, $post_data, $post_id = NULL)
	{
		return TRUE;
	}
	
	public function resetVars($uniq, $post_id = NULL)
	{
		return TRUE;
	}

	public function getMenuItem()
	{
		return __('Empty', SG_TDN);
	}
	
	public function getAdminContent($uniq, $params, $defaults, $global = NULL, $post_id = NULL)
	{
		return '<p class="sg-metabox-description">' . self::$_description . '</p>';
	}

}