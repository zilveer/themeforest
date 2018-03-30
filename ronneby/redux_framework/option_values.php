<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function dfd_page_layouts() {
	//Must provide key => value(array:title|img) pairs for radio options
	//$images_folder = get_stylesheet_directory_uri() . '/redux_frameworks/ReduxCore/assets/';
	return array(
		'1col-fixed' => array(
			'title' => __('No sidebars','dfd'),
			'img' => ReduxFramework::$_url.'assets/img/1col.png'
		),
		'2c-l-fixed' => array(
			'title' => __('Sidebar on left','dfd'),
			'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
		),
		'2c-r-fixed' => array(
			'title' => __('Sidebar on right','dfd'),
			'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
		),
		'3c-l-fixed' => array(
			'title' => __('2 left sidebars','dfd'),
			'img' => ReduxFramework::$_url . 'assets/img/3cl.png'
		),
		'3c-fixed' => array(
			'title' => __('Both sidebars','dfd'),
			'img' => ReduxFramework::$_url . 'assets/img/3cc.png'
		),
		'3c-r-fixed' => array(
			'title' => __('2 right sidebars','dfd'),
			'img' => ReduxFramework::$_url . 'assets/img/3cr.png'
		),
	);
}

function dfd_headers_type() {
	return array(
		'1'			=> __('Header 1' , 'dfd'),
		'2'			=> __('Header 2' , 'dfd'),
		'3'			=> __('Header 3' , 'dfd'),
		'4'			=> __('Header 4' , 'dfd'),
		'5'			=> __('Header 5' , 'dfd'),
		'6'			=> __('Header 6' , 'dfd'),
		'7'			=> __('Header 7' , 'dfd'),
		'8'			=> __('Header 8' , 'dfd'),
		'9'			=> __('Header 9' , 'dfd'),
		'10'		=> __('Header 10' , 'dfd'),
		'11'		=> __('Header 11' , 'dfd'),
		'12'		=> __('Header 12' , 'dfd'),
		'13'		=> __('Header 13' , 'dfd'),
		'14'		=> __('Header 14' , 'dfd'),
		/*
		'15'		=> __('Header 15' , 'dfd'),
		'16'		=> __('Header 16' , 'dfd'),
		'17'		=> __('Header 17' , 'dfd'),
		'18'		=> __('Header 18' , 'dfd'),
		'19'		=> __('Header 19' , 'dfd'),
		'20'		=> __('Header 20' , 'dfd'),
		'21'		=> __('Header 21' , 'dfd'),
		'22'		=> __('Header 22' , 'dfd'),
		*/
		'none'		=> __('Disable header' , 'dfd'),
	);
}

function dfd_logo_position() {
	return array(
		'left' => 'Left',
		'right' => 'Right',
		'top-left' => 'Top left',
		'top-center' => 'Top center',
		'top-right' => 'Top right',
		'bottom-left' => 'Bottom left',
		'bottom-center' => 'Bottom center',
		'bottom-right' => 'Bottom right',
		'middle' => 'Middle of the screen',
	);
}

function dfd_menu_position() {
	return array(
		'top' => 'Top',
		'bottom' => 'Bottom',
	);
}

function dfd_alignment_options() {
	return array(
		'text-left' => __('Left', 'dfd'),
		'text-right' => __('Right', 'dfd'),
		'text-center' => __('Center', 'dfd'),
	);
}

function dfd_header_layouts() {
	return array(
		'boxed' => __('On', 'dfd'),
		'fullwidth' => __('Off', 'dfd'),
	);
}

function dfd_header_cart_style() {
	return array(
		'simple' => __('Simple', 'dfd'),
		'advanced' => __('Advanced', 'dfd'),
		'progressive' => __('Progressive', 'dfd'),
	);
}

function dfd_sticky_header_animations() {
	return array(
		'simple' => __('Simple', 'dfd'),
		'slide-up' => __('Slide up', 'dfd'),
		'fade' => __('Fade', 'dfd'),
	);
}

function dfd_footer_values() {
	return array(
		'1' => __('Compact footer', 'dfd'),
		'2' => __('Standard footer with widgets inside', 'dfd'),
		'3' => __('Standard footer with Visual Composer modules inside', 'dfd'),
		'4' => __('Disable footer', 'dfd'),
	);
}

function dfd_soc_icons_hover_style() {
	return array(
		'1' => __('Square top to bottom', 'dfd'),
		'2' => __('Circle colored style', 'dfd'),
		'3' => __('Square colored style', 'dfd'),
		'4' => __('Flying line', 'dfd'),
		'5' => __('Square black and white', 'dfd'),
		'6' => __('Circle black and white', 'dfd'),
		'7' => __('Circle icons with border 3px', 'dfd'),
		'8' => __('Square icons with border 3px', 'dfd'),
		'9' => __('Square icon on a dark background', 'dfd'),
		'10' => __('Circle icon on a light background', 'dfd'),
		'11' => __('Square icon on a light background', 'dfd'),
		'12' => __('Circle icons with border', 'dfd'),
		'13' => __('Square icons with border', 'dfd'),
		'14' => __('Change color', 'dfd'),
		'15' => __('In general border', 'dfd'),
		'16' => __('Retro Disco Style', 'dfd'),
		'17' => __('Circle from the center', 'dfd'),
		'18' => __('The circle in the center', 'dfd'),
		'19' => __('Round icons on gray background', 'dfd'),
		'20' => __('Square icon on a gray background', 'dfd'),
		'21' => __('Circle fade', 'dfd'),
		'22' => __('Square background from left to right', 'dfd'),
		'23' => __('Circle icon on a dark background', 'dfd'),
		'24' => __('Square icon scale background', 'dfd'),
		'25' => __('Circle icon scale background', 'dfd'),
		'26' => __('Square icon on a light background', 'dfd'),
	);
}

function dfd_get_bgposition() {
	return array(
		'' => __('Default', 'dfd'),
		'left top' => __('left top', 'dfd'),
		'left center' => __('left center','dfd'),
		'left bottom' => __('left bottom','dfd'),
		'right top' => __('right top','dfd'),
		'right center' => __('right center','dfd'),
		'right bottom' => __('right bottom','dfd'),
		'center top' => __('center top','dfd'),
		'center center' => __('center center','dfd'),
		'center bottom' => __('center bottom','dfd')
	);
}

function dfd_get_bgposition_redux() {
	$a = dfd_get_bgposition();
	$o = array();
	
	foreach($a as $value => $name) {
		$o[] = array(
			'name' => $name,
			'value' => $value,
		);
	}
	
	return $o;
}
if(!function_exists('dfd_preloader_animation_style')) {
	function dfd_preloader_animation_style() {
		return  array(
			'1' => __('CSS animation 1', 'dfd'),
			'2' => __('CSS animation 2', 'dfd'),
			'3' => __('CSS animation 3', 'dfd'),
			'4' => __('CSS animation 4', 'dfd'),
			'5' => __('CSS animation 5', 'dfd'),
			'6' => __('CSS animation 6', 'dfd'),
			'7' => __('CSS animation 7', 'dfd'),
			'8' => __('CSS animation 8', 'dfd'),
			'9' => __('CSS animation 9', 'dfd'),
			'10' => __('CSS animation 10', 'dfd'),
			'11' => __('CSS animation 11', 'dfd'),
			'12' => __('CSS animation 12', 'dfd'),
			'13' => __('CSS animation 13', 'dfd'),
			'14' => __('CSS animation 14', 'dfd'),
			'15' => __('CSS animation 15', 'dfd'),
			'16' => __('CSS animation 16', 'dfd'),
		);
	}
}

if(!function_exists('dfd_preloader_animation_style_cmb')) {
	function dfd_preloader_animation_style_cmb() {
		$a = dfd_preloader_animation_style();
		$o = array();

		foreach($a as $value => $name) {
			$o[] = array(
				'name' => $name,
				'value' => $value,
			);
		}

		return $o;
	}
}

if(!function_exists('dfd_portfolio_hover_variants')) {
	function dfd_portfolio_hover_variants() {
		return array(
			__('Style 1', 'dfd') => 'portfolio-hover-style-1',
			__('Style 2', 'dfd') => 'portfolio-hover-style-2',
			__('Style 3', 'dfd') => 'portfolio-hover-style-3',
			__('Style 4', 'dfd') => 'portfolio-hover-style-4',
			__('Style 5', 'dfd') => 'portfolio-hover-style-5',
			__('Style 6', 'dfd') => 'portfolio-hover-style-6',
			__('Style 7', 'dfd') => 'portfolio-hover-style-7',
			__('Style 8', 'dfd') => 'portfolio-hover-style-8',
			__('Style 9', 'dfd') => 'portfolio-hover-style-9',
			__('Style 10', 'dfd') => 'portfolio-hover-style-10',
			__('Style 11', 'dfd') => 'portfolio-hover-style-11',
			__('Style 12', 'dfd') => 'portfolio-hover-style-12',
			__('Style 13', 'dfd') => 'portfolio-hover-style-13',
			__('Style 14', 'dfd') => 'portfolio-hover-style-14',
			__('Style 15', 'dfd') => 'portfolio-hover-style-15',
			__('Style 16', 'dfd') => 'portfolio-hover-style-16',
			__('Style 17', 'dfd') => 'portfolio-hover-style-17',
			__('Style 18', 'dfd') => 'portfolio-hover-style-18',
			__('Style 19', 'dfd') => 'portfolio-hover-style-19',
			__('Style 20', 'dfd') => 'portfolio-hover-style-20',
			__('Style 21', 'dfd') => 'portfolio-hover-style-21',
			__('Style 22', 'dfd') => 'portfolio-hover-style-22',
			__('Style 23', 'dfd') => 'portfolio-hover-style-23',
			__('Style 24', 'dfd') => 'portfolio-hover-style-24',
		);
	}
}

if(!function_exists('dfd_module_animation_styles')) {
	function dfd_module_animation_styles($return_value = 'shortcodes') {
		$animations = array(
		   __( 'No Animation', 'dfd' )       => '',
		   __( 'FadeIn', 'dfd' )             => 'transition.fadeIn',
		   __( 'FlipXIn', 'dfd' )            => 'transition.flipXIn',
		   __( 'FlipYIn', 'dfd' )            => 'transition.flipYIn',
		   __( 'FlipBounceXIn', 'dfd' )      => 'transition.flipBounceXIn',
		   __( 'FlipBounceYIn', 'dfd' )      => 'transition.flipBounceYIn',
		   __( 'SwoopIn', 'dfd' )            => 'transition.swoopIn',
		   __( 'WhirlIn', 'dfd' )            => 'transition.whirlIn',
		   __( 'ShrinkIn', 'dfd' )           => 'transition.shrinkIn',
		   __( 'ExpandIn', 'dfd' )           => 'transition.expandIn',
		   __( 'BounceIn', 'dfd' )           => 'transition.bounceIn',
		   __( 'BounceUpIn', 'dfd' )         => 'transition.bounceUpIn',
		   __( 'BounceDownIn', 'dfd' )       => 'transition.bounceDownIn',
		   __( 'BounceLeftIn', 'dfd' )       => 'transition.bounceLeftIn',
		   __( 'BounceRightIn', 'dfd' )      => 'transition.bounceRightIn',
		   __( 'SlideUpIn', 'dfd' )          => 'transition.slideUpIn',
		   __( 'SlideDownIn', 'dfd' )        => 'transition.slideDownIn',
		   __( 'SlideLeftIn', 'dfd' )        => 'transition.slideLeftIn',
		   __( 'SlideRightIn', 'dfd' )       => 'transition.slideRightIn',
		   __( 'SlideUpBigIn', 'dfd' )       => 'transition.slideUpBigIn',
		   __( 'SlideDownBigIn', 'dfd' )     => 'transition.slideDownBigIn',
		   __( 'SlideLeftBigIn', 'dfd' )     => 'transition.slideLeftBigIn',
		   __( 'SlideRightBigIn', 'dfd' )    => 'transition.slideRightBigIn',
		   __( 'PerspectiveUpIn', 'dfd' )    => 'transition.perspectiveUpIn',
		   __( 'PerspectiveDownIn', 'dfd' )  => 'transition.perspectiveDownIn',
		   __( 'PerspectiveLeftIn', 'dfd' )  => 'transition.perspectiveLeftIn',
		   __( 'PerspectiveRightIn', 'dfd' ) => 'transition.perspectiveRightIn',
		);
		$animations_options = $animations_metaboxes = array();
		foreach($animations as $k => $v) {
			$metabox_array = array();
			$metabox_array['name'] = $k;
			$metabox_array['value'] = $v;
			$animations_metaboxes[] = $metabox_array;
			$animations_options[$v] = $k;
		}
		switch($return_value) {
			case 'options':
				return $animations_options;
				break;
			case 'metaboxes':
				return $animations_metaboxes;
				break;
			case 'shortcodes':
			default:
				return $animations;
		}
	}
}

if(!function_exists('dfd_get_bgsize')) {
	function dfd_get_bgsize($return_value = 'options') {
		$animations = array(
		   __( 'Initial', 'dfd' )           => 'initial',
		   __( 'Inherit', 'dfd' )			=> 'inherit',
		   __( 'Contain', 'dfd' )           => 'contain',
		   __( 'Cover', 'dfd' )				=> 'cover',
		);
		$animations_options = $animations_metaboxes = array();
		$animations_metaboxes[] = array(
			'name' => __('Inherit from theme options'),
			'value' => 'theme-default',
		);
		foreach($animations as $k => $v) {
			$metabox_array = array();
			$metabox_array['name'] = $k;
			$metabox_array['value'] = $v;
			$animations_metaboxes[] = $metabox_array;
			$animations_options[$v] = $k;
		}
		switch($return_value) {
			case 'metaboxes':
				return $animations_metaboxes;
				break;
			case 'shortcodes':
				return $animations;
				break;
			case 'options':
			default:
				return $animations_options;
		}
	}
}

if(!function_exists('dfd_hex2rgb')){
	function dfd_hex2rgb($hex,$opacity=1) {
	   $hex = str_replace("#", "", $hex);
	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgba = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgba; // returns an array with the rgb values
	}
}
if(!function_exists('dfdAdjustBrightness')){
	function dfdAdjustBrightness($hex, $steps) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = (int) $steps * 2.55;
		$steps = max(-255, min(255, $steps));

		// Normalize into a six character long hex string
		$hex = str_replace('#', '', $hex);
		if (strlen($hex) == 3) {
			$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
		}

		// Split into three parts: R, G and B
		$color_parts = str_split($hex, 2);
		$return = '#';

		foreach ($color_parts as $color) {
			$color   = hexdec($color); // Convert to decimal
			$color   = max(0,min(255,$color + $steps)); // Adjust color
			$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
		}

		return $return;
	}
}

if(!function_exists('dfd_header_style_to_string')) {
	function dfd_header_style_to_string($style = 1) {
		$styles_array = array(
			1 => 'first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth'
		);
		
		if(!isset($styles_array[$style])) return;
		
		return $styles_array[$style];
	}
}

if(!function_exists('dfd_header_seventh_appear_effects')) {
	function dfd_header_seventh_appear_effects() {
		return array(
			'default' => __('Scale', 'dfd'),
			'fade-out' => __('Fade out', 'dfd'),
			'scale-slide-up' => __('Scale and slide up', 'dfd'),
			'scale-slide-down' => __('Scale and slide down', 'dfd'),
			'scale-slide-left' => __('Scale and slide left', 'dfd'),
			'scale-slide-right' => __('Scale and slide right', 'dfd'),
			'scale-rotate' => __('Scale with rotation', 'dfd'),
		);
	}
}
if(!function_exists('dfd_post_thumb_size')) {
	function dfd_post_thumb_size($columns = 1, $sidebars = '1col-fixed') {
		$columns = (int) substr($sidebars, 0, 1) - 1 + (int)$columns;
		if($columns < 1) $columns = 1;
		$image_sizes = array(
			1 => array(
				'width' => 900,
				'height' => 600
			),
			2 => array(
				'width' => 640,
				'height' => 460
			),
			3 => array(
				'width' => 480,
				'height' => 320
			),
			4 => array(
				'width' => 360,
				'height' => 260
			),
			5 => array(
				'width' => 300,
				'height' => 200
			),
			6 => array(
				'width' => 240,
				'height' => 180
			),
			7 => array(
				'width' => 200,
				'height' => 160
			),
			8 => array(
				'width' => 180,
				'height' => 140
			),
		);
		
		return $image_sizes[$columns];
	}
}