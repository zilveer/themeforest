<?php

/**
	Penguin Framework

	Copyright (c) 2009-2015 ThemeFocus

	@url http://penguin.themefocus.co
	@package Penguin
	@version 5.0.2
**/
require_once("modules/penguin-megamenu.php");
require_once("modules/penguin-option.php");
require_once("modules/penguin-meta.php");
require_once("modules/penguin-post.php");
require_once("modules/penguin-post-columns.php");

class Penguin {
	
	static $FRAMEWORK_PATH = "";
	static $FRAMEWORK_VERSION = "6.1";
	static $THEME_NAME = "";
	
	static $FRAMEWORK_MSG = array();
	
	private static $INIT = false;


	/**
	 * @$FRAMEWORK_PATH		penguin framework files path 
	 * @$options			add your option for admin panel
	 * @$posts				add your post page for admin panel
	 * @$update 			check theme version for update
	 */
	static function start($options = array(),$metas = array(), $posts = array(), $posts_columns = array(),$megamenu = true){
		
		//when framework had start then will don't run again.
		if(Penguin::$INIT){	return;	}
		
		Penguin::$INIT = true;
		
		Penguin::$FRAMEWORK_MSG = array(0=>'Please input your username, purchase code as first!',
										1=>'Your username or purchase code error!',
										2=>'You used too more site with the same purchase code!',
										3=>'Penguin Framework',
										4=>'version',
										5=>__('You had back all setting to default value complete!',Penguin::$THEME_NAME),
										6=>__('Setting Complete!',Penguin::$THEME_NAME),
										7=>__('Reset to default',Penguin::$THEME_NAME),
										8=>__('Save Changes',Penguin::$THEME_NAME),
										9=>__('Notice: you had select back all setting to default value!',Penguin::$THEME_NAME),
										10=>__('have no any php file for show',Penguin::$THEME_NAME),
										11=>__('have no any content for this page',Penguin::$THEME_NAME),
										12=>__('Paste the export code into the import text area field in your new site option and press "Import" button.',Penguin::$THEME_NAME),
										13=>__('Import Options',Penguin::$THEME_NAME),
										14=>__('Export Options',Penguin::$THEME_NAME),
										15=>__('Upload',Penguin::$THEME_NAME),
										16=>__('You have no add any element for meta',Penguin::$THEME_NAME),
										17=>__('Add Field',Penguin::$THEME_NAME),
										18=>__('Delete All',Penguin::$THEME_NAME),
										19=>__('Custom Field Config Error',Penguin::$THEME_NAME),
										20=>__('Add Image',Penguin::$THEME_NAME),
									);
								
		if(count($options) > 0) {new PenguinOption($options);}
		if(count($metas) > 0) {new PenguinMeta($metas);}
		if(count($posts) > 0) {new PenguinPost($posts);}
		if(count($posts_columns) > 0) {new PenguinPostColumns($posts_columns);}
		if($megamenu) { new PenguinMegaMenu();}
	}
	
	/* 
	 * Check key value in array
	 */
	static function check_key_value($key,$array,$default=''){
		if(isset($array[$key])){
			return $array[$key];
		}
		return $default;
	}
}

?>