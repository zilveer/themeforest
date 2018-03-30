<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/admin/theme-customizer.php
 * @file	 	1.2
 *
 */
?>
<?php

/**
 *
 * @desc registers a theme activation hook
 * @param string $code : Code of the theme. This can be the base folder of your theme. Eg if your theme is in folder 'mytheme' then code will be 'mytheme'
 * @param callback $function : Function to call when theme gets activated.
 */
function wp_register_theme_activation_hook($code, $function) {
    $optionKey="theme_is_activated_" . $code;
    if(!get_option($optionKey)) {
        call_user_func($function);
        update_option($optionKey , 1);
    }
}
 
/**
 * @desc registers deactivation hook
 * @param string $code : Code of the theme. This must match the value you provided in wp_register_theme_activation_hook function as $code
 * @param callback $function : Function to call when theme gets deactivated.
 */
function wp_register_theme_deactivation_hook($code, $function) {
    // store function in code specific global
    $GLOBALS["wp_register_theme_deactivation_hook_function" . $code]=$function;
 
    // create a runtime function which will delete the option set while activation of this theme and will call deactivation function provided in $function
    $fn=create_function('$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');
 
    // add above created function to switch_theme action hook. This hook gets called when admin changes the theme.
    // Due to wordpress core implementation this hook can only be received by currently active theme (which is going to be deactivated as admin has chosen another one.
    // Your theme can perceive this hook as a deactivation hook.)
    add_action("switch_theme", $fn);
}

function my_theme_activate() {
    // code to execute on theme activation
  	global $data;
  	$options = get_option('prostore_options');
  	if(empty($options)) { 
		global $data;
  		$defaults = array (
		'logo_image' => isset($data['prostore_body_logo_image']) ? $data['prostore_body_logo_image']: '',
		'logo_spacing' => isset($data['prostore_body_logo_spacing']) ? $data['prostore_body_logo_spacing'] : '0',
		'accent_primary' => isset($data['prostore_accent_primary'])? $data['prostore_accent_primary'] : '#00afd8',
		'accent_secondary' => isset($data['prostore_accent_secondary']) ? $data['prostore_accent_secondary'] : '#e9e9e9',
		'accent_tertiary' => isset($data['prostore_accent_tertiary']) ? $data['prostore_accent_tertiary'] : '#33CC9F',
		'accent_alert' => isset($data['prostore_accent_alert']) ? $data['prostore_accent_alert'] : '#fc5703',
		'accent_success' => isset($data['prostore_accent_success']) ? $data['prostore_accent_success'] : '#8DC63F',
		'accent_warning' => isset($data['prostore_accent_warning']) ? $data['prostore_accent_warning'] : '#F8A534',
		'accent_info' => isset($data['prostore_accent_info']) ? $data['prostore_accent_info'] : '#FFE58F',
		'accent_inverse' => isset($data['prostore_accent_inverse']) ? $data['prostore_accent_inverse'] : '#313131',
		'bg_helper' => isset($data['prostore_bg_helper_bar']) ? $data['prostore_bg_helper_bar'] : get_template_directory_uri() . '/img/top-nav-bg.png',
		'bg_helper_repeat' => isset($data['prostore_bg_helper_bar_repeat']) ? $data['prostore_bg_helper_bar_repeat'] : 'repeat-x',
		'bg_helper_position' => isset($data['prostore_bg_helper_bar_position']) ? $data['prostore_bg_helper_bar_position'] : 'top left',
		'bg_helper_attachment' => isset($data['prostore_bg_helper_bar_attachment']) ? $data['prostore_bg_helper_bar_attachment'] : 'fixed',
		'bg_helper_color' => isset($data['prostore_bg_helper_bar_color']) ? $data['prostore_bg_helper_bar_color'] : '#222222',
		'helper_content_color' => isset($data['prostore_helper_bar_content_color']) ? $data['prostore_helper_bar_content_color'] : '',
		'helper_content_color_link' => isset($data['prostore_helper_bar_content_color_link']) ? $data['prostore_helper_bar_content_color_link'] : '#ffffff',
		'bg_header' => isset($data['prostore_bg_header']) ? $data['prostore_bg_header'] : get_template_directory_uri() . '/img/top-nav-bg2.png',
		'bg_header_repeat' => isset($data['prostore_bg_header_repeat']) ? $data['prostore_bg_header_repeat'] : 'repeat',
		'bg_header_position' => isset($data['prostore_bg_header_position']) ? $data['prostore_bg_header_position'] : 'top left',
		'bg_header_attachment' => isset($data['prostore_bg_header_attachment']) ? $data['prostore_bg_header_attachment'] : 'fixed',
		'bg_header_color' => isset($data['prostore_bg_header_color']) ? $data['prostore_bg_header_color'] : '',
		'header_content_color' => isset($data['prostore_header_content_color']) ? $data['prostore_header_content_color'] : '',
		'header_content_color_link' => isset($data['prostore_header_content_color_link']) ? $data['prostore_header_content_color_link'] : '#ffffff',
		'bg_body' => isset($data['prostore_bg_body']) ? $data['prostore_bg_body'] : '',
		'bg_body_repeat' => isset($data['prostore_bg_body_repeat']) ? $data['prostore_bg_body_repeat'] : 'no-repeat',
		'bg_body_position' => isset($data['prostore_bg_body_position']) ? $data['prostore_bg_body_position'] : 'top left',
		'bg_body_attachment' => isset($data['prostore_bg_body_attachment']) ? $data['prostore_bg_body_attachment'] : 'fixed',
		'bg_body_color' => isset($data['prostore_bg_body_color']) ? $data['prostore_bg_body_color'] : '#f8f8f8',
		'bg_body_alt_one' => isset($data['prostore_bg_body_alt_one']) ? $data['prostore_bg_body_alt_one'] : '',
		'bg_body_alt_one_repeat' => isset($data['prostore_bg_body_alt_one_repeat']) ? $data['prostore_bg_body_alt_one_repeat'] : 'no-repeat',
		'bg_body_alt_one_position' => isset($data['prostore_bg_body_alt_one_position']) ? $data['prostore_bg_body_alt_one_position'] : 'top left',
		'bg_body_alt_one_attachment' => isset($data['prostore_bg_body_alt_one_attachment']) ? $data['prostore_bg_body_alt_one_attachment'] : 'fixed',
		'bg_body_alt_one_color' => isset($data['prostore_bg_body_alt_one_color']) ? $data['prostore_bg_body_alt_one_color'] : '#ffffff',
		'bg_body_alt_two' => isset($data['prostore_bg_body_alt_two']) ? $data['prostore_bg_body_alt_two'] : '',
		'bg_body_alt_two_repeat' => isset($data['prostore_bg_body_alt_two_repeat']) ? $data['prostore_bg_body_alt_two_repeat'] : 'no-repeat',
		'bg_body_alt_two_position' => isset($data['prostore_bg_body_alt_two_position']) ? $data['prostore_bg_body_alt_two_position'] : 'top left',
		'bg_body_alt_two_attachment' => isset($data['prostore_bg_body_alt_two_attachment']) ? $data['prostore_bg_body_alt_two_attachment'] : 'fixed',
		'bg_body_alt_two_color' => isset($data['prostore_bg_body_alt_two_color']) ? $data['prostore_bg_body_alt_two_color'] : '#313131',
		'body_alt_two_content_color' => isset($data['prostore_body_alt_two_content_color']) ? $data['prostore_body_alt_two_content_color'] : '#ffffff',
		'body_alt_two_content_color_link' => isset($data['prostore_body_alt_two_content_color_link']) ? $data['prostore_body_alt_two_content_color_link'] : '#ffffff',
		'bg_body_alt_three' => isset($data['prostore_bg_body_alt_three']) ? $data['prostore_bg_body_alt_three'] : '',
		'bg_body_alt_three_repeat' => isset($data['prostore_bg_body_alt_three_repeat']) ? $data['prostore_bg_body_alt_three_repeat'] : 'no-repeat',
		'bg_body_alt_three_position' => isset($data['prostore_bg_body_alt_three_position']) ? $data['prostore_bg_body_alt_three_position'] : 'top left',
		'bg_body_alt_three_attachment' => isset($data['prostore_bg_body_alt_three_attachment']) ? $data['prostore_bg_body_alt_three_attachment'] : 'fixed',
		'bg_body_alt_three_color' => isset($data['prostore_bg_body_alt_three_color']) ? $data['prostore_bg_body_alt_three_color'] : '#ECEFF3',
		'bg_footer' => isset($data['prostore_bg_footer']) ? $data['prostore_bg_footer'] : '',
		'bg_footer_repeat' => isset($data['prostore_bg_footer_repeat']) ? $data['prostore_bg_footer_repeat'] : 'no-repeat',
		'bg_footer_position' => isset($data['prostore_bg_footer_position']) ? $data['prostore_bg_footer_position'] : 'top left',
		'bg_footer_attachment' => isset($data['prostore_bg_footer_attachment']) ? $data['prostore_bg_footer_attachment'] : 'fixed',
		'bg_footer_color' => isset($data['prostore_bg_footer_color']) ? $data['prostore_bg_footer_color'] : '#252525',
		'footer_content_color' => isset($data['prostore_footer_content_color']) ? $data['prostore_footer_content_color'] : '#ffffff',
		'footer_content_color_link' => isset($data['prostore_footer_content_color_link']) ? $data['prostore_footer_content_color_link'] :'#ffffff' 
			);
  		update_option('prostore_options',$defaults);
  	}
}
wp_register_theme_activation_hook('mytheme', 'my_theme_activate');

function my_theme_deactivate() {
    // code to execute on theme deactivation
}
wp_register_theme_deactivation_hook('mytheme', 'my_theme_deactivate');

add_action('customize_register', 'prostore_customize');
function prostore_customize($wp_customize) {

	global $data;
	$number_50 = array();
	for ($i=1; $i <= 50; $i++) {
		$number_50[$i]=$i;
	}

	$bg_repeat = array(
				'no-repeat'  	=> __('No Repeat'),
				'repeat'     	=> __('Tile'),
				'repeat-x'   	=> __('Tile Horizontally'),
				'repeat-y'   	=> __('Tile Vertically'),
				);
	$bg_position = array(
				'top left'  	=> __('Top Left'),
				'top center'   	=> __('Top Center'),
				'top right'   	=> __('Top Right'),
				'middle left'  	=> __('Middle Left'),
				'middle center'	=> __('Middle Center'),
				'middle right' 	=> __('Middle Right'),
				'bottom left'  	=> __('Bottom Left'),
				'bottom center'	=> __('Bottom Center'),
				'bottom right' 	=> __('Bottom Right'),
				);
	$bg_attachment = array(
				'fixed'      	=> __('Fixed'),
				'scroll'     	=> __('Scroll'),
				);

	$wp_customize->remove_section( 'colors');
	$wp_customize->remove_section( 'background_image');

	/* -------------------------------------------------------
	   Logo
	   -------------------------------------------------------*/

	    $wp_customize->add_section( 'prostore_header_logo', array(
	        'title'          => 'Logo',
	        'priority'       => 35,
	        'description'    => 'If there is no logo image, the title and description of your website will be used.',
	    ) );

		    $wp_customize->add_setting( 'prostore_options[logo_image]', array(
		        'default'        => $data['prostore_header_logo_image'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_image', array(
			        'label'   		=> 'Image upload',
			        'section' 		=> 'prostore_header_logo',
			        'settings'   	=> 'prostore_options[logo_image]',
			        'priority'       => 10,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[logo_spacing]', array(
		        'default'        => $data['prostore_header_logo_spacing'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( 'logo_spacing', array(
			        'label'   		=> 'Logo spacing (in pixels)',
			        'section' 		=> 'prostore_header_logo',
			        'settings'   	=> 'prostore_options[logo_spacing]',
			        'type'			=> 'select',
			        'choices'		=> $number_50,
			        'priority'       => 20,
			    ) );

	/* -------------------------------------------------------
	   Accent colors
	   -------------------------------------------------------*/

	    $wp_customize->add_section( 'prostore_accent_colors', array(
	        'title'          => 'Accent colors',
	        'priority'       => 45,
	        'description'    => '',
		    ) );

		    $wp_customize->add_setting( 'prostore_options[accent_primary]', array(
		        'default'        => $data['prostore_accent_primary'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_primary', array(
			        'label'   		=> 'Primary',
			        'section' 		=> 'prostore_accent_colors',
			        'settings'   	=> 'prostore_options[accent_primary]',
			        'priority'       => 10,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[accent_secondary]', array(
		        'default'        => $data['prostore_accent_secondary'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_secondary', array(
			        'label'   		=> 'secondary',
			        'section' 		=> 'prostore_accent_colors',
			        'settings'   	=> 'prostore_options[accent_secondary]',
			        'priority'       => 20,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[accent_tertiary]', array(
		        'default'        => $data['prostore_accent_tertiary'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_tertiary', array(
			        'label'   		=> 'tertiary',
			        'section' 		=> 'prostore_accent_colors',
			        'settings'   	=> 'prostore_options[accent_tertiary]',
			        'priority'       => 30,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[accent_alert]', array(
		        'default'        => $data['prostore_accent_alert'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_alert', array(
			        'label'   		=> 'alert',
			        'section' 		=> 'prostore_accent_colors',
			        'settings'   	=> 'prostore_options[accent_alert]',
			        'priority'       => 40,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[accent_success]', array(
		        'default'        => $data['prostore_accent_success'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_success', array(
			        'label'   		=> 'success',
			        'section' 		=> 'prostore_accent_colors',
			        'settings'   	=> 'prostore_options[accent_success]',
			        'priority'       => 50,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[accent_warning]', array(
		        'default'        => $data['prostore_accent_warning'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_warning', array(
			        'label'   		=> 'warning',
			        'section' 		=> 'prostore_accent_colors',
			        'settings'   	=> 'prostore_options[accent_warning]',
			        'priority'       => 60,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[accent_info]', array(
		        'default'        => $data['prostore_accent_info'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_info', array(
			        'label'   		=> 'info',
			        'section' 		=> 'prostore_accent_colors',
			        'settings'   	=> 'prostore_options[accent_info]',
			        'priority'       => 70,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[accent_inverse]', array(
		        'default'        => $data['prostore_accent_inverse'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_inverse', array(
			        'label'   		=> 'inverse',
			        'section' 		=> 'prostore_accent_colors',
			        'settings'   	=> 'prostore_options[accent_inverse]',
			        'priority'       => 80,
			    ) ) );

	/* -------------------------------------------------------
	   Section : helper bar
	   -------------------------------------------------------*/

	    $wp_customize->add_section( 'prostore_section_helper', array(
	        'title'          => 'Section : Helper bar',
	        'priority'       => 55,
	        'description'    => '',
		    ) );

		    $wp_customize->add_setting( 'prostore_options[bg_helper]', array(
		        'default'        => $data['prostore_bg_helper_bar'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bg_helper', array(
			        'label'   		=> 'Background image',
			        'section' 		=> 'prostore_section_helper',
			        'settings'   	=> 'prostore_options[bg_helper]',
			        'priority'       => 10,
			    ) ) );

			$wp_customize->add_setting('prostore_options[bg_helper_repeat]', array(
			    'default'        => $data['prostore_bg_helper_bar_repeat'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_helper_repeat', array(
			        'settings'=> 'prostore_options[bg_helper_repeat]',
				    'label'   => 'Background repeat',
			        'section' => 'prostore_section_helper',
				    'type'    => 'select',
				    'choices'    => $bg_repeat,
			        'priority'       => 20,
				));

			$wp_customize->add_setting('prostore_options[bg_helper_position]', array(
			    'default'        => $data['prostore_bg_helper_bar_position'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_helper_position', array(
			        'settings'=> 'prostore_options[bg_helper_position]',
				    'label'   => 'Background position',
			        'section' => 'prostore_section_helper',
				    'type'    => 'select',
				    'choices'    => $bg_position,
			        'priority'       => 30,
				));

			$wp_customize->add_setting('prostore_options[bg_helper_attachment]', array(
			    'default'        => $data['prostore_bg_helper_bar_attachment'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_helper_attachment', array(
			        'settings'=> 'prostore_options[bg_helper_attachment]',
				    'label'   => 'Background attachment',
			        'section' => 'prostore_section_helper',
				    'type'    => 'select',
				    'choices'    => $bg_attachment,
			        'priority'       => 40,
				));

		    $wp_customize->add_setting( 'prostore_options[bg_helper_color]', array(
		        'default'        => $data['prostore_bg_helper_bar_color'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bg_helper_color', array(
			        'label'   		=> 'Background color',
			        'section' 		=> 'prostore_section_helper',
			        'settings'   	=> 'prostore_options[bg_helper_color]',
			        'priority'       => 50,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[helper_content_color]', array(
		        'default'        => $data['prostore_helper_bar_content_color'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'helper_content_color', array(
			        'label'   		=> 'Heading and text color',
			        'section' 		=> 'prostore_section_helper',
			        'settings'   	=> 'prostore_options[helper_content_color]',
			        'priority'       => 60,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[helper_content_color_link]', array(
		        'default'        => $data['prostore_helper_bar_content_color_link'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'helper_content_color_color', array(
			        'label'   		=> 'Links color',
			        'section' 		=> 'prostore_section_helper',
			        'settings'   	=> 'prostore_options[helper_content_color_link]',
			        'priority'       => 70,
			    ) ) );

	/* -------------------------------------------------------
	   Section : Header
	   -------------------------------------------------------*/

	    $wp_customize->add_section( 'prostore_section_header', array(
	        'title'          => 'Section : Header',
	        'priority'       => 56,
	        'description'    => '',
		    ) );

		    $wp_customize->add_setting( 'prostore_options[bg_header]', array(
		        'default'        => $data['prostore_bg_header'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bg_header', array(
			        'label'   		=> 'Background image',
			        'section' 		=> 'prostore_section_header',
			        'settings'   	=> 'prostore_options[bg_header]',
			        'priority'       => 10,
			    ) ) );

			$wp_customize->add_setting('prostore_options[bg_header_repeat]', array(
			    'default'        => $data['prostore_bg_header_repeat'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_header_repeat', array(
			        'settings'=> 'prostore_options[bg_header_repeat]',
				    'label'   => 'Background repeat',
			        'section' => 'prostore_section_header',
				    'type'    => 'select',
				    'choices'    => $bg_repeat,
			        'priority'       => 20,
				));

			$wp_customize->add_setting('prostore_options[bg_header_position]', array(
			    'default'        => $data['prostore_bg_header_position'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_header_position', array(
			        'settings'=> 'prostore_options[bg_header_position]',
				    'label'   => 'Background position',
			        'section' => 'prostore_section_header',
				    'type'    => 'select',
				    'choices'    => $bg_position,
			        'priority'       => 30,
				));

			$wp_customize->add_setting('prostore_options[bg_header_attachment]', array(
			    'default'        => $data['prostore_bg_header_attachment'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_header_attachment', array(
			        'settings'=> 'prostore_options[bg_header_attachment]',
				    'label'   => 'Background attachment',
			        'section' => 'prostore_section_header',
				    'type'    => 'select',
				    'choices'    => $bg_attachment,
			        'priority'       => 40,
				));

		    $wp_customize->add_setting( 'prostore_options[bg_header_color]', array(
		        'default'        => '#000000',
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bg_header_color', array(
			        'label'   		=> 'Background color',
			        'section' 		=> 'prostore_section_header',
			        'settings'   	=> 'prostore_options[bg_header_color]',
			        'priority'       => 50,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[header_content_color]', array(
		        'default'        => $data['prostore_header_content_color'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_content_color', array(
			        'label'   		=> 'Heading and text color',
			        'section' 		=> 'prostore_section_header',
			        'settings'   	=> 'prostore_options[header_content_color]',
			        'priority'       => 60,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[header_content_color_link]', array(
		        'default'        => $data['prostore_header_content_color_link'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_content_color_color', array(
			        'label'   		=> 'Links color',
			        'section' 		=> 'prostore_section_header',
			        'settings'   	=> 'prostore_options[header_content_color_link]',
			        'priority'       => 70,
			    ) ) );

	/* -------------------------------------------------------
	   Section : Body
	   -------------------------------------------------------*/

	    $wp_customize->add_section( 'prostore_section_body', array(
	        'title'          => 'Section : Body',
	        'priority'       => 57,
	        'description'    => '',
		    ) );

		    $wp_customize->add_setting( 'prostore_options[bg_body]', array(
		        'default'        => $data['prostore_bg_body'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bg_body', array(
			        'label'   		=> 'Background image',
			        'section' 		=> 'prostore_section_body',
			        'settings'   	=> 'prostore_options[bg_body]',
			        'priority'       => 10,
			    ) ) );

			$wp_customize->add_setting('prostore_options[bg_body_repeat]', array(
			    'default'        => $data['prostore_bg_body_repeat'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_repeat', array(
			        'settings'=> 'prostore_options[bg_body_repeat]',
				    'label'   => 'Background repeat',
			        'section' => 'prostore_section_body',
				    'type'    => 'select',
				    'choices'    => $bg_repeat,
			        'priority'       => 20,
				));

			$wp_customize->add_setting('prostore_options[bg_body_position]', array(
			    'default'        => $data['prostore_bg_body_position'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_position', array(
			        'settings'=> 'prostore_options[bg_body_position]',
				    'label'   => 'Background position',
			        'section' => 'prostore_section_body',
				    'type'    => 'select',
				    'choices'    => $bg_position,
			        'priority'       => 30,
				));

			$wp_customize->add_setting('prostore_options[bg_body_attachment]', array(
			    'default'        => $data['prostore_bg_body_attachment'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_attachment', array(
			        'settings'=> 'prostore_options[bg_body_attachment]',
				    'label'   => 'Background attachment',
			        'section' => 'prostore_section_body',
				    'type'    => 'select',
				    'choices'    => $bg_attachment,
			        'priority'       => 40,
				));

		    $wp_customize->add_setting( 'prostore_options[bg_body_color]', array(
		        'default'        => $data['prostore_bg_body_color'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bg_body_color', array(
			        'label'   		=> 'Background color',
			        'section' 		=> 'prostore_section_body',
			        'settings'   	=> 'prostore_options[bg_body_color]',
			        'priority'       => 50,
			    ) ) );

	/* -------------------------------------------------------
	   Section : Body (alt 1)
	   -------------------------------------------------------*/

	    $wp_customize->add_section( 'prostore_section_body_alt_one', array(
	        'title'          => 'Section : Body (type 1)',
	        'priority'       => 58,
	        'description'    => '',
		    ) );

		    $wp_customize->add_setting( 'prostore_options[bg_body_alt_one]', array(
		        'default'        => $data['prostore_bg_body_alt_one'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bg_body_alt_one', array(
			        'label'   		=> 'Background image',
			        'section' 		=> 'prostore_section_body_alt_one',
			        'settings'   	=> 'prostore_options[bg_body_alt_one]',
			        'priority'       => 10,
			    ) ) );

			$wp_customize->add_setting('prostore_options[bg_body_alt_one_repeat]', array(
			    'default'        => $data['prostore_bg_body_alt_one_repeat'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_alt_one_repeat', array(
			        'settings'=> 'prostore_options[bg_body_alt_one_repeat]',
				    'label'   => 'Background repeat',
			        'section' => 'prostore_section_body_alt_one',
				    'type'    => 'select',
				    'choices'    => $bg_repeat,
			        'priority'       => 20,
				));

			$wp_customize->add_setting('prostore_options[bg_body_alt_one_position]', array(
			    'default'        => $data['prostore_bg_body_alt_one_position'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_alt_one_position', array(
			        'settings'=> 'prostore_options[bg_body_alt_one_position]',
				    'label'   => 'Background position',
			        'section' => 'prostore_section_body_alt_one',
				    'type'    => 'select',
				    'choices'    => $bg_position,
			        'priority'       => 30,
				));

			$wp_customize->add_setting('prostore_options[bg_body_alt_one_attachment]', array(
			    'default'        => $data['prostore_bg_body_alt_one_attachment'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_alt_one_attachment', array(
			        'settings'=> 'prostore_options[bg_body_alt_one_attachment]',
				    'label'   => 'Background attachment',
			        'section' => 'prostore_section_body_alt_one',
				    'type'    => 'select',
				    'choices'    => $bg_attachment,
			        'priority'       => 40,
				));

		    $wp_customize->add_setting( 'prostore_options[bg_body_alt_one_color]', array(
		        'default'        => $data['prostore_bg_body_alt_one_color'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bg_body_alt_one_color', array(
			        'label'   		=> 'Background color',
			        'section' 		=> 'prostore_section_body_alt_one',
			        'settings'   	=> 'prostore_options[bg_body_alt_one_color]',
			        'priority'       => 50,
			    ) ) );

	/* -------------------------------------------------------
	   Section : Body (alt 2)
	   -------------------------------------------------------*/

	    $wp_customize->add_section( 'prostore_section_body_alt_two', array(
	        'title'          => 'Section : Body (type 2)',
	        'priority'       => 59,
	        'description'    => '',
		    ) );

		    $wp_customize->add_setting( 'prostore_options[bg_body_alt_two]', array(
		        'default'        => $data['prostore_bg_body_alt_two'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bg_body_alt_two', array(
			        'label'   		=> 'Background image',
			        'section' 		=> 'prostore_section_body_alt_two',
			        'settings'   	=> 'prostore_options[bg_body_alt_two]',
			        'priority'       => 10,
			    ) ) );

			$wp_customize->add_setting('prostore_options[bg_body_alt_two_repeat]', array(
			    'default'        => $data['prostore_bg_body_alt_two_repeat'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_alt_two_repeat', array(
			        'settings'=> 'prostore_options[bg_body_alt_two_repeat]',
				    'label'   => 'Background repeat',
			        'section' => 'prostore_section_body_alt_two',
				    'type'    => 'select',
				    'choices'    => $bg_repeat,
			        'priority'       => 20,
				));

			$wp_customize->add_setting('prostore_options[bg_body_alt_two_position]', array(
			    'default'        => $data['prostore_bg_body_alt_two_position'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_alt_two_position', array(
			        'settings'=> 'prostore_options[bg_body_alt_two_position]',
				    'label'   => 'Background position',
			        'section' => 'prostore_section_body_alt_two',
				    'type'    => 'select',
				    'choices'    => $bg_position,
			        'priority'       => 30,
				));

			$wp_customize->add_setting('prostore_options[bg_body_alt_two_attachment]', array(
			    'default'        => $data['prostore_bg_body_alt_two_attachment'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_alt_two_attachment', array(
			        'settings'=> 'prostore_options[bg_body_alt_two_attachment]',
				    'label'   => 'Background attachment',
			        'section' => 'prostore_section_body_alt_two',
				    'type'    => 'select',
				    'choices'    => $bg_attachment,
			        'priority'       => 40,
				));

		    $wp_customize->add_setting( 'prostore_options[bg_body_alt_two_color]', array(
		        'default'        => $data['prostore_bg_body_alt_two_color'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bg_body_alt_two_color', array(
			        'label'   		=> 'Background color',
			        'section' 		=> 'prostore_section_body_alt_two',
			        'settings'   	=> 'prostore_options[bg_body_alt_two_color]',
			        'priority'       => 50,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[body_alt_two_content_color]', array(
		        'default'        => $data['prostore_body_alt_two_content_color'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_alt_two_content_color', array(
			        'label'   		=> 'Heading and text color',
			        'section' 		=> 'prostore_section_body_alt_two',
			        'settings'   	=> 'prostore_options[body_alt_two_content_color]',
			        'priority'       => 60,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[body_alt_two_content_color_link]', array(
		        'default'        => $data['prostore_body_alt_two_content_color_link'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_alt_two_content_color_color', array(
			        'label'   		=> 'Links color',
			        'section' 		=> 'prostore_section_body_alt_two',
			        'settings'   	=> 'prostore_options[body_alt_two_content_color_link]',
			        'priority'       => 70,
			    ) ) );

	/* -------------------------------------------------------
	   Section : Body (alt 3)
	   -------------------------------------------------------*/

	    $wp_customize->add_section( 'prostore_section_body_alt_three', array(
	        'title'          => 'Section : Body (type 3)',
	        'priority'       => 60,
	        'description'    => '',
		    ) );

		    $wp_customize->add_setting( 'prostore_options[bg_body_alt_three]', array(
		        'default'        => $data['prostore_bg_body_alt_three'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bg_body_alt_three', array(
			        'label'   		=> 'Background image',
			        'section' 		=> 'prostore_section_body_alt_three',
			        'settings'   	=> 'prostore_options[bg_body_alt_three]',
			        'priority'       => 10,
			    ) ) );

			$wp_customize->add_setting('prostore_options[bg_body_alt_three_repeat]', array(
			    'default'        => $data['prostore_bg_body_alt_three_repeat'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_alt_three_repeat', array(
			        'settings'=> 'prostore_options[bg_body_alt_three_repeat]',
				    'label'   => 'Background repeat',
			        'section' => 'prostore_section_body_alt_three',
				    'type'    => 'select',
				    'choices'    => $bg_repeat,
			        'priority'       => 20,
				));

			$wp_customize->add_setting('prostore_options[bg_body_alt_three_position]', array(
			    'default'        => $data['prostore_bg_body_alt_three_position'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_alt_three_position', array(
			        'settings'=> 'prostore_options[bg_body_alt_three_position]',
				    'label'   => 'Background position',
			        'section' => 'prostore_section_body_alt_three',
				    'type'    => 'select',
				    'choices'    => $bg_position,
			        'priority'       => 30,
				));

			$wp_customize->add_setting('prostore_options[bg_body_alt_three_attachment]', array(
			    'default'        => $data['prostore_bg_body_alt_three_attachment'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_body_alt_three_attachment', array(
			        'settings'=> 'prostore_options[bg_body_alt_three_attachment]',
				    'label'   => 'Background attachment',
			        'section' => 'prostore_section_body_alt_three',
				    'type'    => 'select',
				    'choices'    => $bg_attachment,
			        'priority'       => 40,
				));

		    $wp_customize->add_setting( 'prostore_options[bg_body_alt_three_color]', array(
		        'default'        => $data['prostore_bg_body_alt_three_color'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bg_body_alt_three_color', array(
			        'label'   		=> 'Background color',
			        'section' 		=> 'prostore_section_body_alt_three',
			        'settings'   	=> 'prostore_options[bg_body_alt_three_color]',
			        'priority'       => 50,
			    ) ) );

	 /* -------------------------------------------------------
	   Section : Footer widget area
	   -------------------------------------------------------*/

	    $wp_customize->add_section( 'prostore_section_footer', array(
	        'title'          => 'Section : Footer widget area',
	        'priority'       => 61,
	        'description'    => '',
		    ) );

		    $wp_customize->add_setting( 'prostore_options[bg_footer]', array(
		        'default'        => $data['prostore_bg_footer'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bg_footer', array(
			        'label'   		=> 'Background image',
			        'section' 		=> 'prostore_section_footer',
			        'settings'   	=> 'prostore_options[bg_footer]',
			        'priority'       => 10,
			    ) ) );

			$wp_customize->add_setting('prostore_options[bg_footer_repeat]', array(
			    'default'        => $data['prostore_bg_footer_repeat'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_footer_repeat', array(
			        'settings'=> 'prostore_options[bg_footer_repeat]',
				    'label'   => 'Background repeat',
			        'section' => 'prostore_section_footer',
				    'type'    => 'select',
				    'choices'    => $bg_repeat,
			        'priority'       => 20,
				));

			$wp_customize->add_setting('prostore_options[bg_footer_position]', array(
			    'default'        => $data['prostore_bg_footer_position'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_footer_position', array(
			        'settings'=> 'prostore_options[bg_footer_position]',
				    'label'   => 'Background position',
			        'section' => 'prostore_section_footer',
				    'type'    => 'select',
				    'choices'    => $bg_position,
			        'priority'       => 30,
				));

			$wp_customize->add_setting('prostore_options[bg_footer_attachment]', array(
			    'default'        => $data['prostore_bg_footer_attachment'],
			    'capability'     => 'edit_theme_options',
			    'type'           => 'option',

			));

				$wp_customize->add_control( 'bg_footer_attachment', array(
			        'settings'=> 'prostore_options[bg_footer_attachment]',
				    'label'   => 'Background attachment',
			        'section' => 'prostore_section_footer',
				    'type'    => 'select',
				    'choices'    => $bg_attachment,
			        'priority'       => 40,
				));

		    $wp_customize->add_setting( 'prostore_options[bg_footer_color]', array(
		        'default'        => $data['prostore_bg_footer_color'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bg_footer_color', array(
			        'label'   		=> 'Background color',
			        'section' 		=> 'prostore_section_footer',
			        'settings'   	=> 'prostore_options[bg_footer_color]',
			        'priority'       => 50,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[footer_content_color]', array(
		        'default'        => $data['prostore_footer_content_color'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_content_color', array(
			        'label'   		=> 'Heading and text color',
			        'section' 		=> 'prostore_section_footer',
			        'settings'   	=> 'prostore_options[footer_content_color]',
			        'priority'       => 60,
			    ) ) );

		    $wp_customize->add_setting( 'prostore_options[footer_content_color_link]', array(
		        'default'        => $data['prostore_footer_content_color_link'],
		        'type'			 => 'option',
		        'capability'     => 'edit_theme_options',
		    ) );

			    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_content_color_color', array(
			        'label'   		=> 'Links color',
			        'section' 		=> 'prostore_section_footer',
			        'settings'   	=> 'prostore_options[footer_content_color_link]',
			        'priority'       => 70,
			    ) ) );

}