<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

$child_sections = array();
$tab_key = basename(__FILE__, '.php');
$pagepath = TMM_THEME_PATH . '/extensions/cardealer/views/admin/settings/sections/' . $tab_key . '/custom_html/';

$resize_image = array();
$resize_image[0] = __('Resize image', 'cardealer');
$resize_image[1] = __('Use placeholder', 'cardealer');

$flexslider_content_to_show = TMM_Ext_Sliders::get_list_of_groups();
$flexslider_content_to_show[0] = __('Cars', 'cardealer');

$content = array(
	'block0' => array(
		'type' => 'items_block',
		'title' => __('Display Slider on the Front Page', 'cardealer'),
		'items' => array(
			'display_front_page_slider' => array(
				'type' => 'checkbox',
				'default_value' => 1,
				'title' => __('Display Slider', 'cardealer'),
				'description' => __('Display / Hide slider', 'cardealer'),
				'css_class' => '',
				'show_title' => true
			),

		)
	),
    'block1' => array(
        'type' => 'items_block',
		'title' => __('Home Page Slider Layout', 'cardealer'),
        'items' => array(
            'show_slider_as' => array(
                'type' => 'select',
                'title' => __('Slider Layout', 'cardealer'),
                'default_value' => 1,
                'values' => array(
                    1 => __('With Sidebar', 'cardealer'),
                    0 => __('Without Sidebar', 'cardealer'),
                ),
                'description' => __('Choose slider layout for home page', 'cardealer'),
                'css_class' => '',
                'show_title' => false
            )
        )
    ),
     'block2' => array(
        'type' => 'items_block',
        'title' => __('Slider Size (width X height)', 'cardealer'),
        'items' => array(           
            'slider_with_sidebar_height' => array(
                'title' => __('740 x ', 'cardealer'),
                'type' => 'text',
                'default_value' => 420,
                'description' => __("Slider height with sidebar (px)", 'cardealer'),
                'css_class' => 'js_slider_with_sidebar',
                'show_title' => true,
	            'hide' => TMM::get_option('show_slider_as', TMM_APP_CARDEALER_PREFIX) == 1 ? 0 : 1,
            ),     
            'slider_without_sidebar_height' => array(
                'type' => 'text',
                'default_value' => 420,
                'title' => __('1130 x', 'cardealer'),
                'description' => __("Slider height without sidebar (px)", 'cardealer'),
                'css_class' => 'js_slider_without_sidebar',
                'show_title' => true,
                'hide' => TMM::get_option('show_slider_as', TMM_APP_CARDEALER_PREFIX) == 1 ? 1 : 0,
            ),
        )               
    ),
     'block4' => array(
        'type' => 'items_block',
		'title' => __('Crop Image', 'cardealer'),
        'items' => array(
           
            'crop_image' => array(
                'type' => 'checkbox',
                'default_value' => 1,
                'title' => __('Crop image', 'cardealer'),
                'description' => __('Enable / Disable Cropping Image', 'cardealer'),
                'css_class' => '',
                'show_title' => true
            ),
            
        )
    ),
     'block5' => array(
		'type' => 'items_block',
		'title' => __('Images Handler', 'cardealer'), 
        'items' => array(
          
            'flexslider_resize_image' => array(
                'type' => 'select',
                'default_value' => 0,
                'values' => $resize_image,
                'description' => __('Action with images, which smaller than slider sizes: resize image with quality losting or use image placeholder', 'cardealer'),
                'css_class' => '',
				'title' => __('Images Handler', 'cardealer'), 
                'show_title' => false
            ),
           
        )
    ),
     'block6' => array(
        'type' => 'items_block',
		'title' => __('Select Slider Content', 'cardealer'),
        'items' => array(
            
            'flexslider_content_to_show' => array(
                'type' => 'select',
                'default_value' => 0,
                'values' => $flexslider_content_to_show,
                'description' => __('Choose images to show: featured cars or existing slider group', 'cardealer'),
                'css_class' => '',
				'title' => __('Slider Content', 'cardealer'),
                'show_title' => false
            ),            
        )
    ),
     'block7' => array(
        'type' => 'items_block',
		'title' => __('Max Images Number', 'cardealer'), 
        'items' => array(
            
            'max_features_cars_count' => array(
                'type' => 'slider',
                'default_value' => 15,
                'min' => 1,
                'max' => 100,
                'title' => '',
                'description' => __("Max Images Number to show in slider", 'cardealer'),
                'css_class' => '',
                'show_title' => false
            ),            
        )
    ),
     'block8' => array(
        'type' => 'items_block',
		'title' => __('Enable Caption', 'cardealer'),
        'items' => array(
                      
            'flexslider_enable_caption' => array(
                'type' => 'checkbox',
                'default_value' => 1,
                'title' => __('Enable caption', 'cardealer'),
                'description' => __('Enable / Disable Caption', 'cardealer'),
                'css_class' => '',
				'show_title' => false
            )
        )
    ),
     'block9' => array(
        'type' => 'items_block',
		'title' => __('Loop Slides', 'cardealer'),
        'items' => array(
            
            'flexslider_animation_loop' => array(
                'type' => 'checkbox',
                'default_value' => 1,
                'title' => __('Loop Slides', 'cardealer'),
                'description' => __("Enable / Disable Loop Slides", 'cardealer'),
                'css_class' => '',
				'show_title' => false
            )
        )
    ),
     'block10' => array(
        'type' => 'items_block',
		'title' => __('Slideshow ', 'cardealer'),
        'items' => array(
            
            'flexslider_slideshow' => array(
                'type' => 'checkbox',
                'default_value' => 1,
                'title' => __('Slideshow ', 'cardealer'),
                'description' => __("Animate slider automatically", 'cardealer'),
                'css_class' => '',
				'show_title' => false
            )
        )
    ),
     'block11' => array(
        'type' => 'items_block',
		'title' => __('Randomize', 'cardealer'),
        'items' => array(
           
            'flexslider_randomize' => array(
                'type' => 'checkbox',
                'default_value' => 1,
                'title' => __('Randomize', 'cardealer'),
                'description' => __("Randomize slides order", 'cardealer'),
                'css_class' => '',
				'show_title' => false
            )
        )
    ),
     'block12' => array(
        'type' => 'items_block',
		'title' => __('Reverse', 'cardealer'),
        'items' => array(
            
            'flexslider_reverse' => array(
                'type' => 'checkbox',
                'default_value' => 0,
                'title' => __('Reverse', 'cardealer'),
                'description' => __("Reverse the animation direction", 'cardealer'),
                'css_class' => '',
				'show_title' => false
            )
        )
    ),
     'block13' => array(
        'type' => 'items_block',
		'title' => __('Init Delay', 'cardealer'),
        'items' => array(
            
            'flexslider_init_delay' => array(
                'type' => 'slider',
                'default_value' => 0,
                'min' => 0,
                'max' => 500,
                'title' => __('Init Delay', 'cardealer'),
                'description' => __("Integer: Set an initialization delay, in milliseconds", 'cardealer'),
                'css_class' => '',
                'show_title' => false
            )
        )
    ),
     'block14' => array(
        'type' => 'items_block',
		'title' => __('Slideshow Speed', 'cardealer'),
        'items' => array(
            
            'flexslider_slideshow_speed' => array(
                'type' => 'slider',
                'default_value' => 4000,
                'min' => 100,
                'max' => 10000,
                'title' => __('Slideshow Speed', 'cardealer'),
                'description' => __("Set the slideshow speed in milliseconds", 'cardealer'),
                'css_class' => '',
                'show_title' => false
            )
        )
    ),
     'block15' => array(
        'type' => 'items_block',
		'title' => __('Animation Speed', 'cardealer'),
        'items' => array(
            
            'flexslider_animation_speed' => array(
                'type' => 'slider',
                'default_value' => 800,
                'min' => 0,
                'max' => 2000,
                'title' => __('Animation Speed', 'cardealer'),
                'description' => __("Set the speed of animations, in milliseconds", 'cardealer'),
                'css_class' => '',
                'show_title' => false
            )
        )
    ),
     'block16' => array(
        'type' => 'items_block',
		'title' => __('Animation type', 'cardealer'),
        'items' => array(            
            'flexslider_slideshow_animation' => array(
                'type' => 'select',
                'title' => __('Animation type', 'cardealer'),
                'default_value' => 'fade',
                'values' => array(
                    'fade' => __('Fade', 'cardealer'),
                    'slide' => __('Slide', 'cardealer'),
                ),
                'description' => __('Select your animation type, "fade" or "slide"', 'cardealer'),
                'css_class' => '',
                'show_title' => false
            )
        )
    )
    
);

$sections = array(
    'name' => __("Front Page Slider", 'cardealer'),
    'css_class' => 'shortcut-options',
    'show_general_page' => true,
    'content' => $content,
    'child_sections' => $child_sections,
    'menu_icon' => 'dashicons-format-gallery'
);

TMM_CarSettingsHelper::$sections[$tab_key] = $sections;
