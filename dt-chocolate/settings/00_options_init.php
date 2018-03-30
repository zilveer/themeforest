<?php

	global $dt_theme_defaults;

	$options = get_option(LANGUAGE_ZONE.'_theme_options');

	$dt_theme_defaults = array(
		"use_custom_cufon"				=> 0,
		"turn_off_responsivness"		=> 0,
		"hide_sidebar_in_mobile"		=> 0,
			"bg1_repeat_x" 					=> 1,
			"bg1_repeat_y" 					=> 1,
			"bg2_repeat_x" 					=> 1,
			"bg2_repeat_y" 					=> 1,
			"bgcolor1" 						=> "#c7bfac",
			"bg1" 							=> "/preset/bg1/default.png",
			"bg2" 							=> "/preset/bg2/default.png",
			"font" 							=> "crimson",
			"cufon_enabled" 				=> 1,
			"menu_cl" 						=> 1,
		"hide_post_formats"				=> 0,
		"hide_search"					=> 0,
		// captcha
		"captcha_hide_register"			=> 1,
		"captcha_math_action_minus"		=> 1,
		"captcha_math_action_increase"	=> 1,
		"captcha_difficulty_number"		=> 1,
		"captcha_difficulty_word"		=> 1,
		// like buttons page
		"enable_in_album"				=> 0,
		"enable_in_photos"				=> 0,
		"enable_in_blog"				=> 0,
		"enable_in_portfolio"			=> 0,
		"twitter_lb"					=> 0,
		"faceboock_lb"					=> 0,
		"google_plus_lb"				=> 0,
		"use_custom_likes"				=> 0
	);
	
	foreach ($dt_theme_defaults as $k=>$v)
	{
		if ( !isset($options[$k]) )
			$options[$k] = $v;
	}
	
	//$options = array();
	
	update_option(LANGUAGE_ZONE.'_theme_options', $options);
