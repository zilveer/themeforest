<?php

	/*
	*
	*	Swift Page Builder - Abstract Class
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/

	abstract class SFPageBuilderAbstract {
	
	    public static $version;
	    public static $config;
	
	    public function __construct() {
	    }
	
	    public function init( $settings ) {
	        self::$config = (array)$settings;
	    }
	
	    public function addAction($action, $method, $priority = 10) {
	        add_action($action, array($this, $method), $priority);
	    }
	
	    public function addFilter($filter, $method, $priority = 10) {
	        add_action($filter, array($this, $method), $priority);
	    }
	    /* Shortcode methods */
	    public function addShortCode($tag, $func) {
	        add_shortcode($tag,$func);
	    }
	
	    public function doShortCode($content) {
	        do_shortcode($content);
	    }
	
	    public function removeShortCode($tag) {
	        remove_shortcode($tag);
	    }
	
	    public function post($param) {
	        return isset($_POST[$param]) ? $_POST[$param] : null;
	    }
	
	    public function get($param) {
	        return isset($_GET[$param]) ? $_GET[$param] : null;
	    }
	    public function assetURL($asset) {
	        return get_template_directory_uri() . '/includes/swift-framework/page-builder/' . self::$config['SPB_ASSETS'] . $asset;
	    }
	}
	
	
	interface SPBTemplateInterface {
	
	    public function output($post = null);
	
	}

?>