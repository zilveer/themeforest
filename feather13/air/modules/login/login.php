<?php

/**
	Login Module :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package air_login
		@version 1.1
**/

// air_login
class air_login extends Air {

	protected static
		// Option name
		$option_name = 'air-login',
		// Options
		$options;

	/**
		Initialize module
			@public
	**/
	static function init() {
		// Get options
		self::$options = get_option(self::$option_name);
		
		// Set default options, if necessary
		if ( self::$options == FALSE ) {
			update_option(self::$option_name,'');
		}
		
		// Admin init
		add_action('admin_init',__CLASS__.'::admin_init');

		// Enable custom login page
		if ( ('wp-login.php' == self::$vars['PAGENOW']) && 
				self::get_option('login-custom-enable') ) {
			//Login head action
			add_action('login_head',__CLASS__.'::login_head');
			
			// Login logo URL
			if ( self::get_option('login-logo-url') ) {
				add_filter('login_headerurl',__CLASS__.'::login_headerurl');
			}
		}
	}

	/**
		Get module option
			@public
	**/
	static function get_option($key,$default=FALSE) {
		if ( isset(self::$options[$key]) && self::$options[$key] )
			return self::$options[$key];
		else
			return $default;
	}

	/**
		Admin init
			@public
	**/
	static function admin_init() {
		// Register settings
		register_setting(self::$option_name.'-settings', self::$option_name,
			'AirValidate::init_module');
	}

	/**
		Login head
			@public
	**/
	static function login_head() {
		// Get options
		$logo = self::get_option('login-logo');
		$bg_color = self::get_option('login-bg-color');
		$link_color = self::get_option('login-link-color');
		$link_color_hover = self::get_option('login-link-hover-color');
		$login_css = self::get_option('login-css');

		// Test if allow_url_fopen is enabled
		$fopen = ini_get('allow_url_fopen');

		// Build CSS
		$output = '<style type="text/css">'."\n";
		
		// Background
		if ( $bg_color ) {
			$output .= 'html, body.login { background-color: #'.$bg_color.'!important; }'."\n";
			$output .= '.login #nav, .login #backtoblog { text-shadow: none }'."\n";
		}

		// Logo
		if ( $logo ) {
			// Get image size
			if ( $fopen ) {
				$size = getimagesize($logo);
			} else {
				$size = self::getimagesize($logo);
			}

			// Set width if greather than 326px default
			if( $size[0] > 326 ) {
				$width = $size?'width:'.$size[0].'px;':'';
				$output .= '.login h1 a {' . $width . '}';
			}
			
			// Set height
			$height = $size?'height:'.$size[1].'px':'';
			
			// Logo CSS
			$output .= '.login h1 a { background:url('.$logo.') no-repeat top center; background-size:auto; '.$height.' }'."\n";
		}

		// Link Color
		if ( $link_color ) {
			$output .= '.login #nav a, .login #backtoblog a { color:#'.$link_color.'!important; }'."\n";
		}

		// Link Color Hover
		if ( $link_color_hover ) {
			$output .= '.login #nav a:hover, .login #backtoblog a:hover { color:#'.$link_color_hover.'!important; }'."\n";
		}

		// Custom CSS
		if ( $login_css ) {
			$output .= $login_css."\n";
		}

		$output .= '</style>'."\n";

		// Print CSS
		echo $output;
	}

	/**
		Login Logo URL
			@return string
			@param $url string
			@public
	**/
	static function login_headerurl($url) {
		return self::$options['login-logo-url'];
	}

	/**
		Get image size via curl
			@return $string
			@public
	**/
	static function getimagesize($url) {
		$headers = array(
			"Range: bytes=0-32768"
		);

		// Get image via curl
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($curl);
		curl_close($curl);

		// Create image from stream
		$image = imagecreatefromstring($data);

		// Get width and height
		$width = imagesx($image);
		$height = imagesy($image);
		
		// Return image size
		return array($width, $height);
	}

}

// Initialize module
air_login::init();
