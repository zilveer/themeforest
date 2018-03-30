<?php

$prefix = 'vivaco_';

$title_prefix = '_upt_';
$group = $prefix . 'metabox';

if( function_exists('acf_add_local_field_group') ) {

  acf_add_local_field_group(array(

    'key' => $prefix . 'theme_menu',
    'title' => __( 'Vivaco Page Settings', 'vivaco' ),

    'fields' => array (
	
	//Page title settings
    array(
        'key' => $group,
        'title' => __( 'Title', 'vivaco' ),
        'label' => __( 'Title', 'vivaco' ),
        'type' => 'tab',   
    ),                    

	array(
		'label' => __( 'Show Page title', 'vivaco' ),
		'instructions' => __( 'Enable/Disable displaying page title for this page', 'vivaco' ),

		'key' => '_key' . $title_prefix . 'enable_title',
		'name' => $title_prefix . 'enable_title',
		'type' => 'radio',
		'choices' => array(
			'1' => __('Yes', 'vivaco' ),
			'0' => __('No', 'vivaco' ),
		),
		'layout' => 'horizontal',
	),

	array(
		'label' => __( 'Show subtitle', 'vivaco' ),
		'instructions' => __( 'choose whether you need to add a sib-title', 'vivaco' ),

		'key' => '_key' . $title_prefix . 'enable_sub_title',
		'name' => $title_prefix . 'enable_sub_title',
		'type' => 'radio',
		'choices' => array(
			'1' => __('Yes', 'vivaco' ),
			'0' => __('No', 'vivaco' ),
		),
		'conditional_logic' => array(
			array(
				array(
					'field' => '_key' . $title_prefix . 'enable_title',
					'operator' => '==',
					'value' => 1
				)
			)
		),
		'default_value' => '0',
		'layout' => 'horizontal',
	),

	array(
		'label' => __( 'Page Sub-Title', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'page_sub_title',
		'name' => $title_prefix . 'page_sub_title',
		'type' => 'wysiwyg',
		'conditional_logic' => array(
			array(
				array(
					'field' => '_key' . $title_prefix . 'enable_sub_title',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),	
	
	array(
		'label' => __( 'Title uppercase', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'title_uppercase',
		'name' => $title_prefix . 'title_uppercase',
		'conditional_logic' => array(
			array(
				array(
					'field' => '_key' . $title_prefix . 'enable_sub_title',
					'operator' => '==',
					'value' => 1
				)
			)
		),
		'type' => 'radio',
		'choices' => array(
			'1' => __('Yes', 'vivaco' ),
			'0' => __('No', 'vivaco' ),
		),
		'layout' => 'horizontal',
		'default_value' => '1',
	),

	array(
		'label' => __( 'Override theme design settings', 'vivaco' ),
		'instructions' => __( 'Choose to override global theme design', 'vivaco' ),
		'key' => 'override_globals',
		'name' => 'override_globals',
		'type' => 'radio',
		'choices' => array(
			'1' => __('Yes', 'vivaco' ),
			'0' => __('No', 'vivaco' ),
		),
		'layout' => 'horizontal',
		'default_value' => '0',
	),
	
	array(
		'label' => __( 'Font', 'vivaco' ),
		'instructions' => __( 'Select Title Font', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'title_font',
		'name' => $title_prefix . 'title_font',
		'type' => 'select',
		'choices' => startuply_typography_get_google_fonts(),
		'conditional_logic' => array(
			array(
				array(
					'field' => 'override_globals',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),

	array(
		'label' => __( 'Font Size', 'vivaco' ),
		'instructions' => __( 'Set Title Font Size in pixels', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'title_font_size',
		'name' => $title_prefix . 'title_font_size',
		'type' => 'number',
		'min' => 0,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'override_globals',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),

	array(
		'label' => __( 'Text Color', 'vivaco' ),
		'instructions' => __( 'Select Title Text Color', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'title_font_color',
		'name' => $title_prefix . 'title_font_color',
		'type' => 'color_picker',
		'conditional_logic' => array(
			array(
				array(
					'field' => 'override_globals',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),

	array(
		'label' => __( 'Text Align', 'vivaco' ),
		'instructions' => __( 'Select Title Text Align', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'title_align',
		'name' => $title_prefix . 'title_align',
		'type' => 'radio',
		'choices' => array(
			'inherit' => __('Auto', 'vivaco' ),
			'left' => __('Left', 'vivaco' ),
			'center' => __('Center', 'vivaco' ),
			'right' => __('Right', 'vivaco' ),
		),
		'default_value' => 'center',
		'layout' => 'horizontal',
		'conditional_logic' => array(
			array(
				array(
					'field' => 'override_globals',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),

	array(
		'label' => __( 'Paddings', 'vivaco' ),
		'instructions' => __( 'Set Title Padding. ( 1em | 10px 15px | 5px 10px 10px | 5px 10px 15px 10px)', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'title_padding',
		'name' => $title_prefix . 'title_padding',
		'type' => 'text',
		'conditional_logic' => array(
			array(
				array(
					'field' => 'override_globals',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),

	array(
		'label' => __( 'Margins', 'vivaco' ),
		'instructions' => __( 'Set Title Margins. ( 1em | 10px 15px | 5px 10px 10px | 5px 10px 15px 10px)', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'title_margin',
		'name' => $title_prefix . 'title_margin',
		'type' => 'text',
		'conditional_logic' => array(
			array(
				array(
					'field' => 'override_globals',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),

	array(
		'label' => __( 'Title Width', 'vivaco' ),
		'instructions' => __( 'Select Title Width', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'title_width',
		'name' => $title_prefix . 'title_width',
		'type' => 'radio',
		'choices' => array(
			'stretch_row' => __('Stretch row (100% width)', 'vivaco' ),
			'' => __('Default (Boxed)', 'vivaco' ),
			//'stretch_row_content' => __('Stretch row and content', 'vivaco' ),
			//'stretch_row_content_no_spaces' => __('Stretch row and content without spaces', 'vivaco' ),
		),
		'default_value' => 'stretch_row',
		'layout' => 'horizontal',
		'conditional_logic' => array(
			array(
				array(
					'field' => 'override_globals',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),

	array(
		'label' => __( 'Background Color', 'vivaco' ),
		'instructions' => __( 'Select Title Background Color', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'bg_color',
		'name' => $title_prefix . 'bg_color',
		'type' => 'color_picker',
		'conditional_logic' => array(
			array(
				array(
					'field' => 'override_globals',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),

	array(
		'label' => __( 'Background Image', 'vivaco' ),
		'instructions' => __( 'Select Title Background Image', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'bg_image',
		'name' => $title_prefix . 'bg_image',
		'type' => 'image',
		'return_format' => 'id',
		'conditional_logic' => array(
			array(
				array(
					'field' => 'override_globals',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),

	array(
		'label' => __( 'Background Overlay', 'vivaco' ),
		'instructions' => __( 'Set Title Background Overlay', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'bg_overlay',
		'name' => $title_prefix . 'bg_overlay',
		'type' => 'color_picker',
		'conditional_logic' => array(
			array(
				array(
					'field' => 'override_globals',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),

	array(
		'label' => __( 'Background Overlay Opacity', 'vivaco' ),
		'instructions' => __( 'Set Title Background Overlay Opacity. Value from 0 to 100', 'vivaco' ),
		'key' => '_key' . $title_prefix . 'bg_overlay_opacity',
		'name' => $title_prefix . 'bg_overlay_opacity',
		'type' => 'number',
		'min' => '0',
		'max' => '100',
		'conditional_logic' => array(
			array(
				array(
					'field' => 'override_globals',
					'operator' => '==',
					'value' => 1
				)
			)
		),
	),

						//Page logo
                    array(
                      'key' => $prefix . 'page_logo',
                      'title' => __( 'Logotype', 'vivaco' ),
                      'label' => __( 'Logotype', 'vivaco' ),
                      'type' => 'tab',   
                    ),
                    array(
                      'key' => $prefix . 'main_logo',
                      'label' => __( 'Main logo', 'vivaco' ),
					  'instructions' => __( 'main menu logo', 'vivaco' ),
                      'name' => $prefix . 'main_logo',
                      'type' => 'image',
					  'layout' => 'horizontal',
					  'label_placement' => 'left',
                    ),
                    array(
                      'key' => $prefix . 'main_logo_retina',
                      'label' => __( 'Main logo retina', 'vivaco' ),
					  'instructions' => __( 'main menu logo retina', 'vivaco' ),
                      'name' => $prefix . 'main_logo_retina',
                      'type' => 'image',
					  'layout' => 'horizontal',
					  'label_placement' => 'left',
                    ),
                    array(
                      'key' => $prefix . 'sticky_logo',
                      'label' => __( 'Sticky logo', 'vivaco' ),
					  'instructions' => __( 'sticky menu logo', 'vivaco' ),
                      'name' => $prefix . 'sticky_logo',
                      'type' => 'image',
					  'layout' => 'horizontal',
					  'label_placement' => 'left',
                    ),
                    array(
                      'key' => $prefix . 'sticky_logo_retina',
                      'label' => __( 'Sticky logo retina', 'vivaco' ),
					  'instructions' => __( 'sticky menu logo retina', 'vivaco' ),
                      'name' => $prefix . 'sticky_logo_retina',
                      'type' => 'image',
					  'layout' => 'horizontal',
					  'label_placement' => 'left',
                    ),
					
					
					//Page menu
                    array(
                      'key' => $prefix . 'theme_menu',
                      'title' => __( 'Menu', 'vivaco' ),
                      'label' => __( 'Menu', 'vivaco' ),
                      'type' => 'tab',   
                    ),
					 array(
                      'key' => $prefix . 'menu_style',
                      'label' => 'Menu template',
					  'instructions' => __( 'menu template', 'vivaco' ),
                      'name' =>  $prefix . 'menu_style',
                      'type' => 'select',
                      'choices' => array(
                        'default' => __("Default", 'vivaco'),
                        'transparent' => __("Transparent", 'vivaco'),
                      ),
                      'default_value' => 'default',
                    ),
                    array(
                      'key' => $prefix . 'override',
                      'label' => __( 'Override theme design settings', 'vivaco' ),
					  'instructions' => __( 'choose to override global theme options', 'vivaco' ),
                      'name' => $prefix . 'override',
                      'type' => 'radio',
                      'choices' => array(
                        'false' =>  __( 'No', 'vivaco' ),
                        'true' =>  __( 'Yes', 'vivaco' ),
                      ),
                      'default_value' => 'false',
                      'layout' => 'horizontal',
                    ),
                    array(
                      'key' => $prefix . 'main_menu_height',
                      'label' => 'Custom menu height',
					  'instructions' => __( 'in pixels', 'vivaco' ),
                      'name' => $prefix . 'main_menu_height',
                      'type' => 'text',
                      'default_value' => '65',
                      'conditional_logic' => array (
                        array (
                          array (
                            'field' => $prefix . 'override',
                            'operator' => '==',
                            'value' => 'true',
                          ),
                        ),
                      ),
                    ),
                    array(
                      'key' => $prefix . 'main_menu_bg_color',
                      'label' => __( 'Background Color', 'vivaco' ),
                      'name' => $prefix . 'main_menu_bg_color',
                      'instructions' => 'Select backgound color',
                      'type' => 'color_picker',
                      'conditional_logic' => array (
                        array (
                          array (
                            'field' => $prefix . 'override',
                            'operator' => '==',
                            'value' => 'true',
                          ),

                          array (
                            'field' => $prefix . 'menu_style',
                            'operator' => '!=',
                            'value' => 'transparent',
                          ),
                        ),
                      ),
                    ),
                    array(
                      'key' => $prefix . 'main_menu_bg_img',
                      'label' => __( 'Background image', 'vivaco' ),
                      'instructions' => 'Select backgound image',
                      'name' => $prefix . 'main_menu_bg_img',
                      'type' => 'image',
                      'conditional_logic' => array (
                        array (
                          array (
                            'field' => $prefix . 'override',
                            'operator' => '==',
                            'value' => 'true',
                          ),

                          array (
                            'field' => $prefix . 'menu_style',
                            'operator' => '!=',
                            'value' => 'transparent',
                          ),
                        ),
                      )
                    ),
                    array(
                      'key' => $prefix . 'main_menu_bg_opacity',
                      'label' => __( 'Background Color Opacity', 'vivaco' ),
                      'instructions' => 'Set an opacity value for the color(values between 0-100). 0 means no color while 100 means solid color. Default: 100',
                      'name' => $prefix . 'main_menu_bg_opacity',
                      'type' => 'number',
					  'min' => '0',
					  'max' => '100',
                      'conditional_logic' => array (
                        array (
                          array (
                            'field' => $prefix . 'override',
                            'operator' => '==',
                            'value' => 'true',
                          ),
                          array (
                            'field' => $prefix . 'menu_style',
                            'operator' => '!=',
                            'value' => 'transparent',
                          ),          
                        ),
                      ),
                    ),
                    array(
                      'key' => $prefix . 'main_menu_bg_position',
                      'label' => 'Background position',
                      'name' =>  $prefix . 'main_menu_bg_position',
                      'type' => 'select',
                      'conditional_logic' => array (
                        array (
                          array (
                            'field' => $prefix . 'override',
                            'operator' => '==',
                            'value' => 'true',
                          ),
                          array (
                            'field' => $prefix . 'menu_style',
                            'operator' => '!=',
                            'value' => 'transparent',
                          ),          
                        ),
                      ),
                      'choices' => array(
                        'center center' => __("Center Center", 'vivaco'),
                        'center left' => __("Center Left", 'vivaco'),
                        'center right' => __("Center Right", 'vivaco'),
                        'top center' => __("Top Center", 'vivaco'),
                        'top left' => __('Top Left', 'vivaco'),
                        'top right' => __('Top Right', 'vivaco'),
                        'bottom center' => __('Bottom Center', 'vivaco'),
                        'bottom left' => __('Bottom Left', 'vivaco'),
                        'bottom right' => __('Bottom Right', 'vivaco')
                      ),
                      'default_value' => 'center center',
                    ),
                    array(
                      'key' => $prefix . 'main_menu_bg_repeat',
                      'label' => 'Background repeat',
                      'name' =>  $prefix . 'main_menu_bg_repeat',
                      'type' => 'select',
                      'conditional_logic' => array (
                        array (
                          array (
                            'field' => $prefix . 'override',
                            'operator' => '==',
                            'value' => 'true',
                          ),
                          array (
                            'field' => $prefix . 'menu_style',
                            'operator' => '!=',
                            'value' => 'transparent',
                          ),          
                        ),
                      ),
                      'choices' => array(
                        'no-repeat' =>  __('No Repeat', 'js_composer'),
                        'repeat' => __("Repeat", 'js_composer'),
                        'repeat-x' => __('Repeat-X', 'js_composer'),
                        'repeat-y' => __("Repeat-Y", 'js_composer')
                      ),
                      'default_value' => 'no-repeat',
                    ),
                    array(
                      'key' => $prefix . 'main_menu_bg_size',
                      'label' => 'Background size',
                      'name' =>  $prefix . 'main_menu_bg_size',
                      'type' => 'select',
                      'conditional_logic' => array (
                        array (
                          array (
                            'field' => $prefix . 'override',
                            'operator' => '==',
                            'value' => 'true',
                          ),
                          array (
                            'field' => $prefix . 'menu_style',
                            'operator' => '!=',
                            'value' => 'transparent',
                          ),          
                        ),
                      ),
                      'choices' => array(
						'cover' => __('Cover', 'vivaco'),
                        'auto' => __('Default', 'vivaco'),
                        'contain' => __('Contain', 'vivaco'),
                      ),
                      'default_value' => 'cover',
                    ),
                    array(
                      'key' => $prefix . 'menu_text_color',
                      'label' => __( 'Link Color', 'vivaco' ),
                      'name' => $prefix . 'menu_text_color',
                      'instructions' => 'Choose link color',
                      'type' => 'color_picker',
                      'conditional_logic' => array (
                        array (
                          array (
                            'field' => $prefix . 'override',
                            'operator' => '==',
                            'value' => 'true',
                          ),
                        ),
                      ),
                      'default_value' => '#ffffff',
                    ),
                    array(
                      'key' => $prefix . 'menu_active_color',
                      'label' => __( 'Hover/Active link color', 'vivaco' ),
					  'instructions' => __( 'Choose hover/active link color', 'vivaco' ),
                      'name' => $prefix . 'menu_active_color',
                      'type' => 'color_picker',
                      'conditional_logic' => array (
                        array (
                          array (
                            'field' => $prefix . 'override',
                            'operator' => '==',
                            'value' => 'true',
                          ),
                        ),
                      ),
                      'default_value' => '#1ac6ff',
                    )

    ),
    'menu_order' => 0,
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'page',
        ),
      ),
    ),
  'menu_order' => 0,
  'position' => 'normal',
  //'style' => 'default',
  'label_placement' => 'left',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  ));
}

/**
 * Page title settings
 *
 */

$enable_title = startuply_option('vivaco_vc_upt_enable_title', 1);
$utp_on = startuply_option('vivaco_vc_upt_on', 1);

function vivaco_get_image_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));

	return $attachment[0];
}

function vivaco_ultimate_title_get_options() {
	$theme_option_keys = array(
		//'enable_title', - not check. special case
		'enable_sub_title',
		'page_sub_title',
		'title_uppercase',
		'bg_color',
		'bg_image',
		'bg_overlay',
		'bg_overlay_opacity',
		'title_font',
		'title_font_size',
		'title_font_color',
		'title_align',
		'title_padding',
		'title_margin',
		'title_width'
	);

	$theme_prefix = 'vivaco_vc_upt_';
	$post_prefix = '_upt_';

	$theme_option = startuply_get_all_option();
	$post_options = get_post_meta(get_the_ID());

	// Theme defaults (for empty build)
	if (!isset($theme_option[ $theme_prefix . 'enable_title'])) {

    	$theme_option[ $theme_prefix . 'enable_title'] = 1;
	}
	if (!isset($theme_option[ $theme_prefix . 'on'])) {

    	$theme_option[ $theme_prefix . 'on'] = 1;
	}
	if (!isset($theme_option[ $theme_prefix . 'title_padding'])) {

    	$theme_option[ $theme_prefix . 'title_padding'] = '50px 0px 50px 0px';
    }
    if (!isset($theme_option[ $theme_prefix . 'bg_overlay_opacity'])) {

    	$theme_option[ $theme_prefix . 'bg_overlay_opacity'] = '100';
    }   
	if (!isset($theme_option[ $theme_prefix . 'title_font_color'])) {

    	$theme_option[ $theme_prefix . 'title_font_color'] = '#fff';
    }	
	if (!isset($theme_option[ $theme_prefix . 'bg_color'])) {

    	$theme_option[ $theme_prefix . 'bg_color'] = '#261F27';
    }	
	if (!isset($theme_option[ $theme_prefix . 'title_align'])) {

    	$theme_option[ $theme_prefix . 'title_align'] = 'center';
    }	
	if (!isset($theme_option[ $theme_prefix . 'title_width'])) {

    	$theme_option[ $theme_prefix . 'title_width'] = 'stretch_row';
    }	
	if (!isset($theme_option[ $theme_prefix . 'title_uppercase'])) {

    	$theme_option[ $theme_prefix . 'title_uppercase'] = 1;
    }

	//echo "<pre>";
	// error_log('Theme');
	// error_log(print_r($theme_option, 1));

	// error_log('Page');
	// error_log(print_r($post_options, 1));
	//print_r($post_options);
	//echo "</pre>";

	$options = array();

	$options['enable_title'] = !empty($theme_option[$theme_prefix . 'enable_title']) ? $theme_option[$theme_prefix . 'enable_title'] : 0; // theme enable title

	if ($options['enable_title'] == 1) {

		$options['on'] = empty($theme_option[ $theme_prefix . 'on']) ? 0 : $theme_option[ $theme_prefix . 'on'];

		if (isset($post_options[$post_prefix . 'enable_title'])) {

			$options['enable_title_local'] = $post_options[$post_prefix . 'enable_title'][0]; // post enable title. post option - high priority!
		} else {

			$options['enable_title_local'] = 1; // default true, if not set;
		}

		if ($options['enable_title_local'] == 1) {

			foreach ($theme_option_keys as $key) {

				if (isset($post_options[$post_prefix . $key])  ) { // fix for empty post values (array is not empty, but array[0] - empty)
					if (is_array($post_options[$post_prefix . $key])) {
						$post_options[$post_prefix . $key] = $post_options[$post_prefix . $key][0];
					}
				}

				if ($key == 'enable_sub_title' ) { // special case. post values cannot be empty

					if (isset($post_options[$post_prefix . 'enable_sub_title'])) {

						$options[$key] = $post_options[$post_prefix . $key];
						$options['page_sub_title'] = $post_options[$post_prefix . 'page_sub_title'][0];
						
					} else {

						$options[$key] = 0;
						$options['page_sub_title'] = '';
					}

				} else {

					if (!empty($post_options[$post_prefix . $key]) && $post_options['override_globals'][0] == 1) {

						$options[$key] = $post_options[$post_prefix . $key];

					} else {
						if (isset($theme_option[$theme_prefix . $key])) {
							$options[$key] = $theme_option[$theme_prefix . $key];
						}
					}
				}

			}

			if (isset($options['bg_image']) && $options['bg_image'] && !is_numeric($options['bg_image'])) {

				$options['bg_image'] = vivaco_get_image_id($options['bg_image']);
			}

		}

	} else {

		$options['on'] = 0;
	}

	return $options;
}

function random_class_name($len = 13) {
	return substr(str_shuffle(str_repeat("0123456789", $len)), 0, $len);
}

function vivaco_ultimate_title() {

	$post_id = get_the_ID();

	$options = vivaco_ultimate_title_get_options();

	if ($options['enable_title'] == 0 || empty($options['enable_title_local']) ) {
		echo '';
		return;
	}

	if ($options['on'] != 1) {
		echo the_title( '<h2 class="entry-title">', '</h2>' , false );
		return;
	}


	$output = array();

	$css = '';

	$custom_css = random_class_name();

	if (isset($options['bg_color']) && $options['bg_color']) {
		$css .= 'background-color: ' . $options['bg_color'] . ' !important;';
	}

	if (isset($options['title_padding']) && $options['title_padding']) {
		$css .= 'padding: ' . $options['title_padding'] . ' !important;';
	}

	if (isset($options['title_margin']) && $options['title_margin']) {
		$css .= 'margin: ' . $options['title_margin'] . ' !important;';
	}

	if (strlen($css) > 0) {
		$custom_css = '.vc_custom_'.$custom_css.'{' . $css . '}';

		$output['title_css'] = 'css="'.$custom_css.'"';
	} else {
		$custom_css = '';
		$output['title_css'] = '';
	}

	if (isset($options['bg_image']) && $options['bg_image']) {
		$output['bg_image'] = 'vsc_bg_image="' . $options['bg_image'] .'"';
	} else {
		$output['bg_image'] = '';
	}

	if (isset($options['bg_overlay']) && $options['bg_overlay']) {

		$colors = hex2rgb( $options['bg_overlay'] );

		if (isset($options['bg_overlay_opacity']) && $options['bg_overlay_opacity']) {

			$colors .= ', ' . round($options['bg_overlay_opacity'] / 100, 2);
			$output['bg_overlay'] = 'vsc_bg_color="rgba(' .$colors .')"';

		} else {

			$output['bg_overlay'] = 'vsc_bg_color="rgb(' .$colors .')"';
		}
	} else {
		$output['bg_overlay'] = '';
	}

	if (isset($options['title_font']) && $options['title_font']) {

		//error_log(print_r($options['title_font'],1));
		$font = explode(', ', $options['title_font']);

		$output['title_font'] = 'use_google_font="yes" title_google_fonts="font_family:'
			.rawurlencode($font[0].':regular,400'). '|font_style:' . rawurlencode('400 regular:400:normal').'"';
	} else {
		$output['title_font'] = '';
	}

	if (isset($options['title_font_size']) && $options['title_font_size']) {

		$output['title_font_size'] = 'title_font_size="' . $options['title_font_size'] .'"';
	} else {
		$output['title_font_size'] = '';
	}

	if (isset($options['title_font_color']) && $options['title_font_color']) {

		$output['title_font_color'] = 'title_color="' . $options['title_font_color'] .'"';
	} else {
		$output['title_font_color'] = '';
	}

	if (isset($options['title_align']) && $options['title_align']) {

		$output['title_align'] = 'align="' . $options['title_align'] .'"';
	} else {
		$output['title_align'] = '';
	}

	if (isset($options['title_width']) && $options['title_width']) {
		$output['title_width'] = 'full_width="' .$options['title_width'] .'"';
	} else {
		$output['title_width'] = '';
	}

	if (isset($options['enable_sub_title']) && $options['enable_sub_title'] != 0) {
		$output['page_sub_title'] = '' . $options['page_sub_title'] .'';
	} else {
		$output['page_sub_title'] = '';
	}

	$output_custom_css = '';
	if ( ! empty( $custom_css ) ) {
		$custom_css = strip_tags( $custom_css );
		$output_custom_css .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
		$output_custom_css .= $custom_css;
		$output_custom_css .= '</style>';
	}

	$shortcode = '
		[vc_row
			. el_class="page-title" .
			' . $output['title_width'] . '
			' . $output['bg_image'] . '
			' . $output['bg_overlay'] . '
			' . $output['title_css'] . '

			]
			[vc_column]
				[vsc-section-title
					' . $output['title_align'] . '
					' . $output['title_font'] . '

					title="'.get_the_title( $post_id ).'"

					' . $output['title_font_size'] . '
					' . $output['title_font_color'] . '

					]
						' . $output['page_sub_title'] . '
				[/vsc-section-title]
			[/vc_column]
		[/vc_row]
	';

	//error_log( print_r($shortcode, 1) );

	$title_output = $output_custom_css;
	$title_output .= do_shortcode( $shortcode );

	echo $title_output;
}