<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = 'vmax_project';

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'vivaco'),
		'two' => __('Two', 'vivaco'),
		'three' => __('Three', 'vivaco'),
		'four' => __('Four', 'vivaco'),
		'five' => __('Five', 'vivaco')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'vivaco'),
		'two' => __('Pancake', 'vivaco'),
		'three' => __('Omelette', 'vivaco'),
		'four' => __('Crepe', 'vivaco'),
		'five' => __('Waffle', 'vivaco')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();


	// Basic Settings
	$options[] = array(
		'name' => __('General Settings', 'vivaco'),
		'type' => 'heading'
	);

		/* CONTROLS GROUPING JS TRIGGER*/
		$options[] = array(
			'name' => __('LOGO&FAVICON', 'vivaco'),
			'desc' => __('upload a custom logo and favicon here', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);

			//Favicon
			$options[] = array(
				'name' => __('Favicon', 'vivaco'),
				'desc' => __('Upload a favicon on your theme, size must be 16px by 16px or 32px by 32px', 'vivaco'),
				'id' => 'vivaco_favicon',
				'type' => 'upload'
			);

			$options[] = array(
				'name' => __('Logo', 'vivaco'),
				'desc' => __('Upload your logo here.', 'vivaco'),
				'id'   => 'site_logo',
				'type' => 'upload'
			);

			$options[] = array(
				'name' => __('Logo @2x for retina', 'vivaco'),
				'desc' => __('Logo for retina displays 2x larger then original one.', 'vivaco'),
				'id'   => 'retina_site_logo',
				'type' => 'upload'
			);

		/* CONTROLS GROUPING JS TRIGGER*/
		$options[] = array(
			'name' => __('PRELOADER', 'vivaco'),
			'desc' => __('preloader settings', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$options[] = array(
				"type" => "checkbox",
				"name" => __('Disable page preloading', 'js_composer'),
				"id" => "loading_gif_on",
			);

			$options[] = array(
				'name' => __('Custom preloader animation', 'vivaco'),
				'desc' => __('Upload custom loading animation.', 'vivaco'),
				'class' => 'depend-on-prev-checkbox invert',
				'id'   => 'loading_gif',
				'type' => 'upload'
			);

		/* CONTROLS GROUPING JS TRIGGER */
		$options[] = array(
			'name' => __('GENERAL', 'vivaco'),
			'desc' => __('General settings', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$options[] = array(
				'name' => __('Base Color', 'vivaco'),
				'desc' => __('You can set a base color.', 'vivaco' ),
				'id' => 'vivaco_base_color',
				'std' => '#1ac6ff',
				'type' => 'color'
			);

			$options[] = array(
				"type" => "checkbox",
				"name" => __('Disable right menu "My Account/Logout" links', 'js_composer'),
				'desc' => __('Default menu for right menu area will be displayed instead', 'vivaco' ),
				"id" => "registration_instead_right_menu_on",
			);

			$options[] = array(
				"type" => "checkbox",
				"name" => __('Theme Animations', 'vivaco'),
				"id" => "vivaco_vc_animations_on",
				"std" => 1
			);

			$options[] = array(
				"type" => "checkbox",
				"name" => __('Theme Smooth scroll', 'js_composer'),
				"id" => "smooth_scroll_on",
			);

			$options[] = array(
				"type" => "text",
				"name" => __('Smooth scroll speed', 'js_composer'),
				'class' => 'depend-on-prev-checkbox',
				"id" => "smooth_scroll_speed",
				"std" => "800"
				
			);

			$options[] = array(
				'name' => __('Use 960px grid (1200px by default)', 'vivaco'),
				'id' => 'boxed_width',
				"type" => "checkbox"
			);

			$options[] = array(
				"type" => "checkbox",
				"name" => __('Disable responsiveness', 'js_composer'),
				"id" => "responsive_on",
			);

			$options[] = array(
				"type" => "checkbox",
				"name" => __('Force Boxed layout on all pages', 'js_composer'),
				"id" => "fullscreen_on",
			);

			$options[] = array(
				'name' => __('Boxed layout background', 'vivaco'),
				'id' => 'boxed_background',
				'type' => 'upload',
				'class' => 'depend-on-prev-checkbox'
			);

			$options[] = array(
				"type" => "select",
				"name" => __('Background position', 'js_composer'),
				"id" => "boxed_background_position",
				"class" => "inline-block-section depend-on-prev-checkbox",
				"options" => array(
					'center center' => __("Center Center", 'js_composer'),
					'center left' => __("Center Left", 'js_composer'),
					'center right' => __("Center Right", 'js_composer'),
					'top center' => __("Top Center", 'js_composer'),
					'top left' => __('Top Left', 'js_composer'),
					'top right' => __('Top Right', 'js_composer'),
					'bottom center' => __('Bottom Center', 'js_composer'),
					'bottom left' => __('Bottom Left', 'js_composer'),
					'bottom right' => __('Bottom Right', 'js_composer')
				)
			);

			$options[] = array(
				"type" => "select",
				"name" => __('Background repeat', 'js_composer'),
				"id" => "boxed_background_repeat",
				"class" => "inline-block-section depend-on-prev-checkbox",
				"options" => array(
					'no-repeat' =>  __('No Repeat', 'js_composer'),
					'repeat' => __("Repeat", 'js_composer'),
					'repeat-x' => __('Repeat-X', 'js_composer'),
					'repeat-y' => __("Repeat-Y", 'js_composer')
				)
			);

			$options[] = array(
				"type" => "select",
				"name" => __('Background size', 'js_composer'),
				"id" => "boxed_background_size",
				"class" => "inline-block-section depend-on-prev-checkbox",
				"options" => array(
					'auto' => __("Default", 'js_composer'),
					'contain' => __("Contain", 'js_composer'),
					'cover' => __("Cover", 'js_composer')
				)
			);

		$options[] = array(
			'name' => __('Forms', 'vivaco'),
			'desc' => __('Forms settings', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$options[] = array(
				"type" => "checkbox",
				'name' => __('Disable left border on input fields', 'vivaco'),
				'id' => 'disable_border_color'
			);

	$google_faces = startuply_typography_get_google_fonts();

		//Theme menu
		$options[] = array(
			'name' => __('Navigation', 'vivaco'),
			'type' => 'heading_parent'
		);

		/* CONTROLS GROUPING JS TRIGGER*/
		$options[] = array(
			'name' => __('Main menu', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);

			$options[] = array(
				"type" => "select",
				"name" => __('Menu template', 'js_composer'),
				"id" => "menu_style",
				"class" => "inline-block-section",
				"options" => array(
					'default' => __("Default", 'js_composer'),
					'transparent' => __("Transparent", 'js_composer'),
				),
				'std' => 'default'
			);
		
			$options[] = array(
				"type" => "checkbox",
				"name" => __('Use Uber like menu', 'js_composer'),
				"id" => "mobile_main_menu_mod_on"
			);

			$options[] = array(
				'name' => __('Custom menu height', 'vivaco'),
				'id' => 'main_menu_height',
				'type' => 'text',
				'std' => '65'
			);

			$options[] = array(
				'name' => __('Background Color', 'vivaco'),
				'desc' => __('You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: transparent', 'vivaco'),
				'id' => 'main_menu_bg_color',
				'type' => 'color',
				'std'=> '#ffffff'
			);

			$options[] = array(
				'name' => __('Background image', 'vivaco'),
				'desc' => __('Select backgound color', 'vivaco'),
				'id' => 'main_menu_bg_image',
				'type' => 'upload',
				'std' => '',
			);

			$options[] = array(
				'type' => 'text',
				'name' => __('Background Color Opacity', 'vivaco'),
				'desc' => __('Set an opacity value for the color(values between 0-100). 0 means no color while 100 means solid color. Default: 100', 'vivaco'),
				'id' => 'main_menu_color_opacity',
				'class' => 'percent-slider',
				'std' => '100'
			);

			$options[] = array(
				"type" => "select",
				"name" => __('Background position', 'js_composer'),
				"id" => "main_menu_bg_position",
				"class" => "inline-block-section",
				"options" => array(
					'center center' => __("Center Center", 'js_composer'),
					'center left' => __("Center Left", 'js_composer'),
					'center right' => __("Center Right", 'js_composer'),
					'top center' => __("Top Center", 'js_composer'),
					'top left' => __('Top Left', 'js_composer'),
					'top right' => __('Top Right', 'js_composer'),
					'bottom center' => __('Bottom Center', 'js_composer'),
					'bottom left' => __('Bottom Left', 'js_composer'),
					'bottom right' => __('Bottom Right', 'js_composer')
				),
				'std' => 'center center'
			);

			$options[] = array(
				"type" => "select",
				"name" => __('Background repeat', 'js_composer'),
				"id" => "main_menu_bg_repeat",
				"class" => "inline-block-section",
				"options" => array(
					'no-repeat' =>  __('No Repeat', 'js_composer'),
					'repeat' => __("Repeat", 'js_composer'),
					'repeat-x' => __('Repeat-X', 'js_composer'),
					'repeat-y' => __("Repeat-Y", 'js_composer')
				),
				'std' => 'no-repeat'
			);

			$options[] = array(
				"type" => "select",
				"name" => __('Background size', 'js_composer'),
				"id" => "main_menu_bg_size",
				"class" => "inline-block-section",
				"options" => array(
					'auto' => __("Default", 'js_composer'),
					'contain' => __("Contain", 'js_composer'),
					'cover' => __("Cover", 'js_composer')
				),
				'std' => 'auto'

			);

			$options[] = array(
				'type' => 'color',
				'name' => __('Link color', 'vivaco'),
				'id' => 'main_menu_text_color',
				'desc' => __('Choose link color', 'vivaco'),
				'std' => '#333333'
			);

			$options[] = array(
				'type' => 'color',
				'name' => __('Hover/Active link color', 'vivaco'),
				'id' => 'main_menu_active_color',
				'std' => '#1ac6ff'
			);

		// Inner pages menu
			$options[] = array(
				'name' => __('Sub menu', 'vivaco'),
				'type' => 'heading_second'
			);
			$options[] = array(
				'name' => __('Sub menu', 'vivaco'),
				'class' => 'parent',
				'type' => 'info'
			);
			
			$options[] = array(
				"type" => "checkbox",
				"name" => __('Show Sub menu', 'js_composer'),
				"id" => "sub_menu_on",
				"std" => 0
			);
						$options[] = array(
							'name' => __('Background Color (Overlay)', 'vivaco'),
							'id' => 'subheader_bg_color',
							'type' => 'color',
							'class' => 'depend-on-prev-checkbox',
							'std' => '#1AC6FF'
						);

						$options[] = array(
							'name' => __('Background Color Opacity', 'vivaco'),
							'id' => 'subheader_color_opacity',
							'class' => 'percent-slider depend-on-prev-checkbox',
							'type' => 'text',
							'std' =>'100'
						);

						$options[] = array(
							'name' => __('Text color', 'vivaco'),
							'desc' => __('You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: white', 'vivaco'),
							'id' => 'subheader_text_color',
							'class' => 'depend-on-prev-checkbox',
							'type' => 'color',
							'std' => '#ffffff'
						);

						$options[] = array(
							'name' => __('Link color', 'vivaco'),
							'desc' => __('You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: white', 'vivaco'),
							'id' => 'subheader_link_color',
							'type' => 'color',
							'class' => 'depend-on-prev-checkbox',
							'std' => '#ffffff'
						);

						$options[] = array(
							'name' => __('Link hover color', 'vivaco'),
							'desc' => __('You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: white', 'vivaco'),
							'id' => 'subheader_linkhover_color',
							'type' => 'color',
							'class' => 'depend-on-prev-checkbox',
							'std' => '#ffffff'
						);


		// Inner pages menu
		// Deprecated since v2.5
		/*
			$options[] = array(
				'name' => __('Default menu', 'vivaco'),
				'type' => 'heading_second'
			);
			$options[] = array(
				'name' => __('Default menu', 'vivaco'),
				'class' => 'parent',
				'type' => 'info'
			);

				$options[] = array(
					"type" => "checkbox",
					"name" => __('Use Uber like menu (all pages)', 'js_composer'),
					"id" => "mobile_menu_mod_on"
				);

				$options[] = array(
					'name' => __('Custom default menu height', 'vivaco'),
					'id' => 'menu_height',
					'type' => 'text',
					'std' => '65'
				);

				$options[] = array(
					'name' => __('Background image', 'vivaco'),
					'desc' => __('Select backgound color', 'vivaco'),
					'id' => 'menu_bg_image',
					'type' => 'upload'
				);

				$options[] = array(
					'name' => __('Background Color (Overlay)', 'vivaco'),
					'desc' => __('You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: white', 'vivaco'),
					'id' => 'menu_bg_color',
					'type' => 'color'
				);

				$options[] = array(
					'type' => 'text',
					'name' => __('Background Color Opacity', 'vivaco'),
					'desc' => __('Set an opacity value for the color(values between 0-100). 0 means no color while 100 means solid color. Default: 100', 'vivaco'),
					'id' => 'menu_color_opacity',
					'class' => 'percent-slider',
					'std' => '100',
				);

				$options[] = array(
					"type" => "select",
					"name" => __('Background position', 'js_composer'),
					"class" => "inline-block-section",
					"id" => "menu_bg_position",
					"options" => array(
						'center center' => __("Center Center", 'js_composer'),
						'center left' => __("Center Left", 'js_composer'),
						'center right' => __("Center Right", 'js_composer'),
						'top center' => __("Top Center", 'js_composer'),
						'top left' => __('Top Left', 'js_composer'),
						'top right' => __('Top Right', 'js_composer'),
						'bottom center' => __('Bottom Center', 'js_composer'),
						'bottom left' => __('Bottom Left', 'js_composer'),
						'bottom right' => __('Bottom Right', 'js_composer')
					),
					'std' => 'center center'
				);

				$options[] = array(
					"type" => "select",
					"name" => __('Background repeat', 'js_composer'),
					"class" => "inline-block-section",
					"id" => "menu_bg_repeat",
					"options" => array(
						'no-repeat' =>  __('No Repeat', 'js_composer'),
						'repeat' => __("Repeat", 'js_composer'),
						'repeat-x' => __('Repeat-X', 'js_composer'),
						'repeat-y' => __("Repeat-Y", 'js_composer')
					),
					'std' => 'no-repeat'
				);

				$options[] = array(
					"type" => "select",
					"name" => __('Background size', 'js_composer'),
					"class" => "inline-block-section",
					"id" => "menu_bg_size",
					"options" => array(
						'auto' => __("Default", 'js_composer'),
						'contain' => __("Contain", 'js_composer'),
						'cover' => __("Cover", 'js_composer')
					),
					'std' => 'auto'
				);

				$options[] = array(
					'type' => 'color',
					'name' => __('Link color', 'vivaco'),
					'desc' => __('Choose link color', 'vivaco'),
					'id' => 'menu_text_color'
				);

				$options[] = array(
					'type' => 'color',
					'name' => __('Hover/Active link color', 'vivaco'),
					'id' => 'menu_active_color'
				);
			*/
			
			//Sticky menu
			$options[] = array(
				'name' => __(' Sticky menu', 'vivaco'),
				'type' => 'heading_second'
			);
			$options[] = array(
				'name' => __('Sticky menu', 'vivaco'),
				'class' => 'parent',
				'type' => 'info'
			);
			
			$options[] = array(
				"type" => "select",
				"name" => __('Sticky menu display', 'js_composer'),
				"id" => "sticky_menu_display",
				"options" => array(
					'all_pages' => __("All pages", 'js_composer'),
					'home' => __("Homepage only", 'js_composer'),
					'disable' => __("Disable", 'js_composer')
				)
			);

			$options[] = array(
					'name' => __('Sticky logo', 'vivaco'),
					'desc' => __('Upload your sticky logo here.', 'vivaco'),
					'id'   => 'site_sticky_logo',
					'type' => 'upload'
				);

				$options[] = array(
					'name' => __('Sticky logo @2x for retina', 'vivaco'),
					'desc' => __('Sticky logo for retina displays 2x larger then original one.', 'vivaco'),
					'id'   => 'retina_site_sticky_logo',
					'type' => 'upload'
				);

				$options[] = array(
					'name' => __('Menu appear position', 'vivaco'),
					'desc' => __('Default: 600px', 'vivaco'),
					'std' => '600',
					'id' => 'sticky_menu_position',
					'type' => 'text'
				);

				$options[] = array(
					'name' => __('Custom sticky menu height', 'vivaco'),
					'id' => 'sticky_menu_height',
					'type' => 'text',
					'std' => '65'
				);

				$options[] = array(
					'name' => __('Background Color', 'vivaco'),
					'desc' => __('You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: white', 'vivaco'),
					'id' => 'sticky_menu_bgcolor',
					'type' => 'color',
					'std' => '#ffffff'
				);

				$options[] = array(
					'type' => 'text',
					'name' => __('Background Color Opacity', 'vivaco'),
					'class' => 'percent-slider',
					'desc' => __('Set an opacity value for the color(values between 0-100). 0 means no color while 100 means solid color. Default: 100', 'vivaco'),
					'id' => 'sticky_menu_color_opacity',
					'std' => '100',
				);

				$options[] = array(
					'type' => 'color',
					'name' => __('Link color', 'vivaco'),
					'desc' => __('Choose link color', 'vivaco'),
					'id' => 'sticky_menu_text_color',
					'type' => 'color',
					'std' => '#000000'
				);

				$options[] = array(
					'type' => 'color',
					'name' => __('Hover/Active link color', 'vivaco'),
					'id' => 'sticky_menu_active_color',
				);

            //Dropdown menu
            $options[] = array(
                'name' => __(' Dropdown menu', 'vivaco'),
                'type' => 'heading_second'
            );
            $options[] = array(
                'name' => __('Dropdown menu', 'vivaco'),
                'class' => 'parent',
                'type' => 'info'
            );

                $options[] = array(
                    'type' => 'checkbox',
                    'name' => __('Dropdown Color', 'vivaco'),
                    'class' => 'menu-color-switch',
                    'id' => 'dropdown_bg_light'
                );

                $options[] = array(
                    'type' => 'text',
                    'name' => __('Dropdown Color Opacity', 'vivaco'),
                    'class' => 'percent-slider',
                    'id' => 'dropdown_bg_opacity',
                    'std' => '100',
                );

                $options[] = array(
                    'type' => 'color',
                    'name' => __('Link color', 'vivaco'),
                    'id' => 'dropdown_text_color',
										'std' => '#ffffff'
                );

                $options[] = array(
                    'type' => 'color',
                    'name' => __('Hover/Active link color', 'vivaco'),
                    'id' => 'dropdown_active_color'
                );

	// Page titles
	$options[] = array(
		'name' => __('PAGE TITLES', 'vivaco'),
		'type' => 'heading'
	);

		/* CONTROLS GROUPING JS TRIGGER*/
		$options[] = array(
			'name' => __('PAGE TITLES', 'vivaco'),
			'desc' => __('config Page Titles here', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);

			$prefix  = 'vivaco_vc_upt_';

			$options[] = array(
				"type" => "checkbox",
				"name" => __('Show Page Titles', 'vivaco'),
				"id" => $prefix . "enable_title",
				'desc' => __('choose to show page titles on all pages', 'vivaco'),
				"std" => 1
			);

			$options[] = array(
				"type" => "checkbox",
				"name" => __('Custom Page title options', 'vivaco'),
				"id" => $prefix . "on",
				'desc' => __('choose to enable custom page title layout & options', 'vivaco'),
				'class' => 'depend-on-prev-checkbox',
				"std" => 1
			);

			$options[] = array(
				'name' => __('Title Width', 'js_composer'),
				'desc' => 'Select Title Width',
				'id' => $prefix . 'title_width',
				'class' => 'depend-on-prev-checkbox',
			    'options' => array(
					"stretch_row" => __('Stretch (100% width)', 'vivaco' ),
					"" => __('Default (Boxed)', 'vivaco' ),
					//"stretch_row_content" => __('Stretch row and content', 'vivaco' ),
					//"stretch_row_content_no_spaces" => __('Stretch row and content without spaces', 'vivaco' ),
				),
				'type' => 'select',
				'std' => 'stretch_row',
			);

			$options[] = array(
				'name' => __('Font', 'js_composer'),
				'desc' => 'Select Title Font',
				'id' => $prefix . 'title_font',
				'class' => 'percent-slider depend-on-prev-checkbox',
				'options' => $google_faces,
				'type' => 'select',
			);

			$options[] = array(
				'type' => 'text',
				'name' => __('Title Font Size', 'vivaco'),
				'desc' => __('Set Font Size in pixel', 'vivaco'),
				'id' => $prefix . 'title_font_size',
				'class' => 'depend-on-prev-checkbox',
			);

			$options[] = array(
				'name' => __('Font Color', 'vivaco'),
				'desc' => __('Set Title Font Color', 'vivaco'),
				'id' => $prefix . 'title_font_color',
				'class' => 'depend-on-prev-checkbox',
				'type' => 'color',
				'std' => '#ffffff'
			);

			$options[] = array(
				'name' => __('Text Align', 'js_composer'),
				'desc' => 'Select Title Text Align',
				'id' => $prefix . 'title_align',
				'class' => 'percent-slider depend-on-prev-checkbox',
			    'options' => array(
					'center' => __('Center', 'vivaco' ),
			    	'inherit' => __('Auto', 'vivaco' ),
			    	'left' => __('Left', 'vivaco' ),
			    	'right' => __('Right', 'vivaco' ),
			    ),
				'type' => 'select',
			);

			$options[] = array(
				'name' => __('Paddings', 'vivaco'),
				'desc' => __('Set Title Paddings as top-right-bottom-left ( 1em | 10px 15px | 5px 10px 10px | 5px 10px 15px 10px)', 'vivaco'),
				'id' => $prefix . 'title_padding',
				'class' => 'depend-on-prev-checkbox',
				'type' => 'text',
				'std'  => '50px 0px 50px 0px',
			);

			$options[] = array(
				'name' => __('Margins', 'vivaco'),
				'desc' => __('Set Title Margins as top-right-bottom-left ( 1em | 10px 15px | 5px 10px 10px | 5px 10px 15px 10px)', 'vivaco'),
				'id' => $prefix . 'title_margin',
				'class' => 'depend-on-prev-checkbox',
				'type' => 'text',
			);

			$options[] = array(
				'name' => __('Background Color', 'vivaco'),
				'desc' => __('You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: transparent', 'vivaco'),
				'id' => $prefix . 'bg_color',
				'class' => 'depend-on-prev-checkbox',
				'type' => 'color',
				'std' => "#261F27"
			);

			$options[] = array(
				'name' => __('Background image', 'vivaco'),
				'desc' => __('Select backgound image', 'vivaco'),
				'class' => 'depend-on-prev-checkbox',
				'id' => $prefix . 'bg_image',
				'type' => 'upload'
			);

			$options[] = array(
				'name' => __('Background Overlay', 'vivaco'),
				'desc' => __('You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: transparent', 'vivaco'),
				'class' => 'depend-on-prev-checkbox',
				'id' => $prefix . 'bg_overlay',
				'type' => 'color'
			);

			$options[] = array(
				'name' => __('Background Overlay Opacity', 'vivaco'),
				'desc' => __('Set an opacity value for the color(values between 0-100). 0 means no color while 100 means solid color. Default: 100', 'vivaco'),
				'id' => $prefix . 'bg_overlay_opacity',
				'class' => 'percent-slider depend-on-prev-checkbox',
				'std' => '100',
				'type' => 'text',
			);
				
	// Typography
	$options[] = array(
		'name' => __('Typography', 'vivaco'),
		'type' => 'heading'
	);

	/* CONTROLS GROUPING JS TRIGGER*/
		$options[] = array(
			'name' => __('GENERAL', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$options[] = array(
				'name' => __('Headers fonts', 'js_composer'),
				'desc' => 'Custom font for h1-h6',
				'type' => 'select',
				'id' => 'custom_fonts_h16',
				'options' => $google_faces,
			);

			$options[] = array(
				'name' => __('Content font', 'js_composer'),
				'desc' => 'Custom font for content',
				'type' => 'select',
				'id' => 'custom_fonts_content',
				'options' => $google_faces,
			);

			$options[] = array(
				'name' => __('Menu items font', 'js_composer'),
				'desc' => 'Custom font for menu items',
				'type' => 'select',
				'id' => 'custom_fonts_menu_item',
				'options' => $google_faces,
			);

	// Blog
	$options[] = array(
		'name' => __('Blog', 'vivaco'),
		'type' => 'heading'
	);

	/* CONTROLS GROUPING JS TRIGGER*/
		$options[] = array(
			'name' => __('GENERAL', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$options[] = array(
				'name' => __('Blog layout', 'js_composer'),
				'desc' => 'Choose the blog post images size',
				'type' => 'select',
				'id' => 'blog_img_tpl',
				"options" => array(
						'' => __("Default", 'js_composer'),
						'big_img' => __("Big images", 'js_composer'),
						'small_img' => __("Small images", 'js_composer')
					)
			);

			$options[] = array(
				'name' => __('Post content type', 'js_composer'),
				'desc' => 'Show full posts/excerpts',
				'type' => 'select',
				'id' => 'blog_content_type',
				"options" => array(
						'excerpt' => __("Excerpt", 'js_composer'),
						'full' => __("Full post", 'js_composer')
					)
			);

			$options[] = array(
				'name' => __('Post title length', 'js_composer'),
				'desc' => 'Choose the blog post title length (characters)',
				'type' => 'text',
				'std' => 50,
				'id' => 'blog_title_len'
			);

			$options[] = array(
				'name' => __('Post excerpt length', 'js_composer'),
				'desc' => 'Choose the blog post except length (words)',
				'type' => 'text',
				'std' => 38,
				'id' => 'blog_excr_len'
			);

			$options[] = array(
				'name' => __('Hide read more link', 'js_composer'),
				'desc' => 'Choose to show or not read more links',
				"class" => "inline-block-section",
				'type' => 'checkbox',
				'id' => 'blog_readmr',
				'std' => ''
			);

			$options[] = array(
				'name' => __('Hide post dates', 'js_composer'),
				'desc' => 'Choose to show or not dates',
				"class" => "inline-block-section",
				'type' => 'checkbox',
				'id' => 'blog_dates',
				'std' => ''
			);

			$options[] = array(
				'name' => __('Hide post meta', 'js_composer'),
				'desc' => 'Choose to hide author, category, etc fields',
				"class" => "inline-block-section",
				"type" => "checkbox",
				'id' => 'blog_meta',
				'std' => ''
			);

	// Footer
	$options[] = array(
		'name' => __('Footer', 'vivaco'),
		'type' => 'heading_parent'
	);

	/* CONTROLS GROUPING JS TRIGGER*/
		$options[] = array(
			'name' => __('GENERAL', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);

		$options[] = array(
				"type" => "checkbox",
				"name" => __('Enable footer', 'js_composer'),
				"id" => "footer_on",
				"std" => 1
			);

			 $imagepath = get_template_directory_uri() . '/engine/lib/options-framework/inc/images/';

			$options[] = array(
				'name' => "Footer Widgets",
				'desc' => "",
				'class' => 'depend-on-prev-checkbox',
				'id' => "footer_widgets",
				'std' => "3_widget",
				'type' => "images", 
				'options' => array(
				'1_widget' => $imagepath . '1_widget.png',
				'2_widget' => $imagepath . '2_widget.png',
				'3_widget' => $imagepath . '3_widget.png',
				'4_widget' => $imagepath . '4_widget.png',
				'3x1_big_widget' => $imagepath . '3x1_big_widget.png',
				'3x2_big_widget' => $imagepath . '3x2_big_widget.png',
				'3x3_big_widget' => $imagepath . '3x3_big_widget.png',
				'4x1_big_widget' => $imagepath . '4x1_big_widget.png',
				'4x4_big_widget' => $imagepath . '4x4_big_widget.png',
			)
			);
			$options[] = array(
				'name' => __('Background Color (Overlay)', 'vivaco'),
				'desc' => __('You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: #1b1b1b', 'vivaco'),
				'id' => 'footer_bg_color',
				'type' => 'color',
				'class' => 'depend-on-prev-checkbox',
				'std' => '#1b1b1b'
			);

			$options[] = array(
				'name' => __('Background Color Opacity', 'vivaco'),
				'desc' => __('Set an opacity value for the color(values between 0-100). 0 means no color while 100 means solid color. Default: 70', 'vivaco'),
				'id' => 'footer_color_opacity',
				'class' => 'percent-slider depend-on-prev-checkbox',
				'type' => 'text',
				'std'=>'100'
			);

			$options[] = array(
				'name' => __('Background image', 'vivaco'),
				'desc' => __('Select backgound image', 'vivaco'),
				'id' => 'footer_bg_image',
				'class' => 'depend-on-prev-checkbox',
				'type' => 'upload'
			);

			$options[] = array(
				"type" => "select",
				"name" => __('Background position', 'js_composer'),
				"id" => "footer_bg_position",
				"class" => "inline-block-section depend-on-prev-checkbox",
				"options" => array(
					'center center' => __("Center Center", 'js_composer'),
					'center left' => __("Center Left", 'js_composer'),
					'center right' => __("Center Right", 'js_composer'),
					'top center' => __("Top Center", 'js_composer'),
					'top left' => __('Top Left', 'js_composer'),
					'top right' => __('Top Right', 'js_composer'),
					'bottom center' => __('Bottom Center', 'js_composer'),
					'bottom left' => __('Bottom Left', 'js_composer'),
					'bottom right' => __('Bottom Right', 'js_composer')
				),
				'std'=>'center center'
			);

			$options[] = array(
				"type" => "select",
				"name" => __('Background repeat', 'js_composer'),
				"id" => "footer_bg_repeat",
				"class" => "inline-block-section depend-on-prev-checkbox",
				"options" => array(
					'no-repeat' =>  __('No Repeat', 'js_composer'),
					'repeat' => __("Repeat", 'js_composer'),
					'repeat-x' => __('Repeat-X', 'js_composer'),
					'repeat-y' => __("Repeat-Y", 'js_composer')
				),
				'std'=>'no-repeat'
			);

			$options[] = array(
				"type" => "select",
				"name" => __('Background size', 'js_composer'),
				"id" => "footer_bg_size",
				"class" => "inline-block-section depend-on-prev-checkbox",
				"options" => array(
					'auto' => __("Default", 'js_composer'),
					'contain' => __("Contain", 'js_composer'),
					'cover' => __("Cover", 'js_composer')
				),
				'std' => 'auto'

			);
			
			
			$options[] = array(
				'name' => __('Footer copyrights (DEPRECATED)', 'vivaco'),
				'desc' => __('Bottom copyrights notice. This block is now controlled through Sub footer setting. The option will be removed in next theme update', 'vivaco'),
				'id' => 'footer_copy',
				'type' => 'textarea',
				'std' => 'StartuplyWP.com &copy; All rights reserved.'
			);
			

// Inner pages menu
	$options[] = array(
		'name' => __('Sub Footer', 'vivaco'),
		'type' => 'heading_second'
	);

		$options[] = array(
			'name' => __('Sub Footer', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);

		$options[] = array(
			"type" => "checkbox",
			"name" => __('Sub footer Widgets', 'js_composer'),
			"id" => "sub_footer_on",
			"std" => 1
		);

			$options[] = array(
				'name' => __('Background Color (Overlay)', 'vivaco'),
				'id' => 'subfooter_bg_color',
				'type' => 'color',
				'class' => 'depend-on-prev-checkbox',
				'std' => '#000000'
			);

			$options[] = array(
				'name' => __('Background Color Opacity', 'vivaco'),
				'id' => 'subfooter_color_opacity',
				'class' => 'percent-slider depend-on-prev-checkbox',
				'type' => 'text',
				'std'=>'100'
			);

			$options[] = array(
				'name' => __('Text color', 'vivaco'),
				'id' => 'subfooter_text_color',
				'class' => 'depend-on-prev-checkbox',
				'type' => 'color',
				'std' => '#B3B3B3'
			);

			$options[] = array(
				'name' => __('Link color', 'vivaco'),
				'id' => 'subfooter_link_color',
				'class' => 'depend-on-prev-checkbox',
				'type' => 'color',
				'std' => '#B3B3B3'
			);

			$options[] = array(
				'name' => __('Link hover color', 'vivaco'),
				'id' => 'subfooter_linkhover_color',
				'class' => 'depend-on-prev-checkbox',
				'type' => 'color',
				'std' => '#ffffff'
			);

	// Custom CSS & JS
	$options[] = array(
		'name' => __('Custom CSS &amp; JS', 'vivaco'),
		'type' => 'heading'
	);

	/* CONTROLS GROUPING JS TRIGGER*/
		$options[] = array(
			'name' => __('JS', 'vivaco'),
			'desc' => __('custom JS', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$options[] = array(
				'name' => __('Custom JS', 'vivaco'),
				'desc' => __('Enter your custom Javascript here', 'vivaco'),
				'id' => 'custom_js',
				'type' => 'textarea',
				'settings' => array('rows' => 15)
			);

	/* CONTROLS GROUPING JS TRIGGER*/
		$options[] = array(
			'name' => __('CSS', 'vivaco'),
			'desc' => __('Custom CSS', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);

			$options[] = array(
				'name' => __('Custom CSS styles', 'vivaco'),
				'desc' => __('Enter your custom CSS here', 'vivaco'),
				'id' => 'custom_css',
				'type' => 'textarea',
				'settings' => array('rows' => 15),
				'std' => ''
			);

			$options[] = array(
				'name' => __('Extra small devices Phones (<768px)', 'vivaco'),
				'desc' => __('Enter your custom CSS here', 'vivaco'),
				'id' => 'custom_css_xs',
				'type' => 'textarea',
				'settings' => array('rows' => 10),
				'std' => ''
			);
			$options[] = array(
				'name' => __('Small devices Tablets (>768px)', 'vivaco'),
				'desc' => __('Enter your custom CSS here', 'vivaco'),
				'id' => 'custom_css_sm',
				'type' => 'textarea',
				'settings' => array('rows' => 10),
				'std' => ''
			);
			$options[] = array(
				'name' => __('Medium devices Desktops (>992px)', 'vivaco'),
				'desc' => __('Enter your custom CSS here', 'vivaco'),
				'id' => 'custom_css_md',
				'type' => 'textarea',
				'settings' => array('rows' => 10),
				'std' => ''
			);
			$options[] = array(
				'name' => __('Large devices Desktops (>1200px)', 'vivaco'),
				'desc' => __('Enter your custom CSS here', 'vivaco'),
				'id' => 'custom_css_lg',
				'type' => 'textarea',
				'settings' => array('rows' => 10),
				'std' => ''
			);


	//Main menu
	$options[] = array( 
		'name' => __('INTEGRATIONS', 'vivaco'),
		'type' => 'heading_parent'
	);

 
		$options[] = array(
			'name' => __('GOOGLE SERVICES', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);

		$options[] = array(
			"type" => "checkbox",
			"name" => __('Use google tag manager', 'vivaco'),
			"id" => "google_gtm_on",
			"std" => 0
		);

		$options[] = array(
			'name' => __('Google tag manager', 'vivaco'),
			'desc' => __('Please add your container ID in `GTM-XXXX` format <a href="https://developers.google.com/tag-manager/quickstart">Google Tag Manager for Web Tracking</a>', 'vivaco'),
			'id' => 'google_gtm',
			'class' => 'depend-on-prev-checkbox',
			'type' => 'text'
		);

		$options[] = array(
			'name' => __('Google Analytics', 'vivaco'),
			'desc' => __('Please add your GA tracking code in `UA-XXXXX-X` format <a href="https://support.google.com/analytics/answer/1032385?hl=en">Where can i find my tracking code?</a>', 'vivaco'),
			'id' => 'google_analytics',
			'class' => 'depend-off-prev-checkbox',
			'type' => 'text'
		);

		$options[] = array(
			"type" => "checkbox",
			"name" => __('Use google alternative async tracking snippet', 'vivaco'),
			"id" => "google_alternative_on",
			'class' => 'depend-off-prev-checkbox',
			"std" => 0
		);


		$options[] = array(
			'name' => __('NEWSLETTER API PROVIDERS', 'vivaco'),
			'type' => 'heading'
		);
		$options[] = array(
			'name' => __('Mailchimp', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$options[] = array(
				'name' => __('Mailchimp Api Key', 'vivaco'),
				'desc' => __('Please set "Mailchimp Api key" to enable this API <a href="http://kb.mailchimp.com/accounts/management/about-api-keys">Where can i find my API key?</a>', 'vivaco'),
				'id' => 'vivaco_mailchimp_api_key',
				'type' => 'text'
			);


		$options[] = array(
			'name' => __('AWeber', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$aweber_config_url = get_template_directory_uri() . '/engine/mailing-list/aweber/aweber-connect-account.php';
			$options[] = array(
				'name' => __('AWeber App ID', 'vivaco'),
				'desc' => __('Please set "AWeber App ID" to enable this API <a href="">Where can i find my App ID?</a>', 'vivaco'),
				'id' => 'vivaco_aweber_api_key',
				'type' => 'text'
			);
			$options[] = array(
				'name' => __('AWeber Consumer Key', 'vivaco'),
				'desc' => __('Please set "AWeber Consumer Key" to enable this API <a href="">Where can i find my Consumer Key?</a>', 'vivaco'),
				'id' => 'vivaco_aweber_consumer_key',
				'type' => 'text'
			);
			$options[] = array(
				'name' => __('AWeber Consumer Secret', 'vivaco'),
				'desc' => __('Please set "AWeber Consumer Secret" to enable this API <a href="">Where can i find my Consumer Secret?</a>', 'vivaco'),
				'id' => 'vivaco_aweber_consumer_secret',
				'type' => 'text'
			);
			$options[] = array(
				'name' => __('AWeber Access Key', 'vivaco'),
				'desc' => __('Please set "AWeber Access Key" to enable this API <a target="_blank" href="'.$aweber_config_url.'" >Get It!</a>', 'vivaco'),
				'id' => 'vivaco_aweber_access_key',
				'type' => 'text'
			);
			$options[] = array(
				'name' => __('AWeber Access Secret', 'vivaco'),
				'desc' => __('Please set "AWeber Access Secret" to enable this API <a target="_blank" href="'.$aweber_config_url.'">Get It!</a>', 'vivaco'),
				'id' => 'vivaco_aweber_access_secret',
				'type' => 'text'
			);


		$options[] = array(
			'name' => __('MadMimi', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$options[] = array(
				'name' => __('MadMimi Api Key', 'vivaco'),
				'desc' => __('Please set "MadMimi Api Key" to enable this API <a href="">Where can i find my API key?</a>', 'vivaco'),
				'id' => 'vivaco_madmimi_api_key',
				'type' => 'text'
			);

		$options[] = array(
			'name' => __('CampaignMonitor', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$options[] = array(
				'name' => __('CampaignMonitor Api Key', 'vivaco'),
				'desc' => __('Please set "CampaignMonitor Api Key" to enable this API <a href="">Where can i find my API key?</a>', 'vivaco'),
				'id' => 'vivaco_campaign_monitor_api_key',
				'type' => 'text'
			);

		$options[] = array(
			'name' => __('GetResponse', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$options[] = array(
				'name' => __('GetResponse Api Key', 'vivaco'),
				'desc' => __('Please set "GetResponse Api Key" to enable this API <a href="">Where can i find my API key?</a>', 'vivaco'),
				'id' => 'vivaco_get_response_api_key',
				'type' => 'text'
			);

		//Google
		$options[] = array(
			'name' => __('OTHER', 'vivaco'),
			'type' => 'heading'
		);
		$options[] = array(
			'name' => __('EASY DIGITAL DOWNLOADS', 'vivaco'),
			'class' => 'parent',
			'type' => 'info'
		);
			$options[] = array(
				"type" => "checkbox",
				"name" => __('Show cart icon in top menu', 'vivaco'),
				"id" => "vivaco_edd_menu_cart_on",
				'desc' => __('cart icon that is displayed next to the menu', 'vivaco'),
				"std" => 1
			);

			$options[] = array(
				'name' => __('EXTENSIONS', 'vivaco'),
				'desc' => __('theme extras', 'vivaco'),
				'class' => 'parent',
				'type' => 'info'
			);

			$options[] = array(
				"type" => "checkbox",
				"name" => __('Clone Page Feature', 'vivaco'),
				'desc' => __('additional options that allows you to clone pages from page list', 'vivaco'),
				"id" => "vivaco_vc_clone_post_on",
				"std" => 1
			);

			$options[] = array(
				"type" => "checkbox",
				"name" => __('Vivaco Modals', 'vivaco'),
				'desc' => __('choose to disable Vivaco Modal boxes', 'vivaco'),
				"id" => "modal_box_on",
				"std" => 1
			);



	return $options;
}
