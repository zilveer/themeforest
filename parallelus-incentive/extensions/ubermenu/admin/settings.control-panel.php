<?php

function ubermenu_get_settings_fields_instance( $config_id ){	

	$settings = array(

		//Integration


		//Basic

		60 => array(
			'name'	=> 'header_basic',
			'label'	=> __( 'Basic Configuration' , 'ubermenu' ),
			'type'	=> 'header',
			'group'	=> 'basic',
		),



		70 => /* SKIN */
		array(
			'name'	=> 'skin',
			'label'	=> __( 'Skin' , 'ubermenu' ),
			'type'	=> 'select',
			//'options'	=> array(),
			'options' => 'ubermenu_get_skin_ops',
			'default' => 'black-white-2',
			'group'	=> 'basic',
			'customizer' => true,
		),

		80 => array(
			'name'	=> 'orientation',
			'label'	=> __( 'Orientation' , 'ubermenu' ),
			'type'	=> 'radio',
			'desc'	=> __( 'Orient the menu vertically or horizontally' , 'ubermenu' ) . '<br/><a target="_blank" href="http://goo.gl/UaAb2z">Vertical Menu Demo</a>',
			'options'=> array(
				//'auto'		=> __( 'Automatic' , 'ubermenu' ),
				
				'horizontal'	=> __( 'Horizontal', 'ubermenu' ),
				'vertical'	 	=> __( 'Vertical', 'ubermenu' ),
			),
			'default'=> 'horizontal',
			'group'	=> 'basic',
		),

		90 => array(
			'name'	=> 'vertical_submenu_width',
			'label'	=> __( 'Vertical Menu Mega Submenu Width' , 'ubermenu' ),
			'type'	=> 'text',
			'default'=> '',
			'desc'	=> __( '600px by default.  Can be overridden on a per submenu basis in the Menu Item Settings.' , 'ubermenu' ),
			'group'	=> 'basic',
			'custom_style' => 'vertical_submenu_width',
		),


		/* TRIGGER */
		100 => array( 
			'name'	=> 'trigger_header',
			'label'	=> __( 'Trigger' , 'ubermenu' ),
			'type'	=> 'header',
			'group'	=> 'basic',
		),

		110 => array(
			'name'	=> 'trigger',
			'label'	=> __( 'Trigger' , 'ubermenu' ),
			'type'	=> 'radio',
			'desc'	=> __( 'Open the submenu via this trigger' , 'ubermenu' ),
			'options'=> array(
				//'auto'		=> __( 'Automatic' , 'ubermenu' ),
				
				'hover' 		=> __( 'Hover', 'ubermenu' ),
				'hover_intent' 	=> __( 'Hover Intent', 'ubermenu' ),
				'click'			=> __( 'Click', 'ubermenu' ),
			),
			'default'=> 'hover_intent',
			'group'	=> 'basic',
		),






		/* TRANSITION */
		120 => array( 
			'name'	=> 'transition_header',
			'label'	=> __( 'Dropdown Transitions' , 'ubermenu' ),
			'type'	=> 'header',
			'group'	=> 'basic',
		),

		130 => array(
			'name'	=> 'transition',
			'label'	=> __( 'Transition' , 'ubermenu' ),
			'desc'	=> __( 'Transitions supported in Chrome, Safari, Firefox, IE10+', 'ubermenu' ),
			'type'	=> 'radio',
			'options'=> array(
				'none'		=> __( 'None' , 'ubermenu' ),
				'slide' 	=> __( 'Slide Reveal', 'ubermenu' ),
				'fade'		=> __( 'Fade', 'ubermenu' ),
				'shift' 	=> __( 'Shift Up', 'ubermenu' ),
			),
			'default'=> 'shift',
			'group'	=> 'basic',
		),


		140 => array(
			'name'	=> 'transition_duration',
			'label'	=> __( 'Transition Duration' , 'ubermenu' ),
			'type'	=> 'text',
			'default'=> '',
			'desc'	=> __( 'You can use <code>.5s</code> or <code>500ms</code>.  Defaults to .3s' , 'ubermenu' ),
			'group'	=> 'basic',
			'custom_style' => 'transition_duration',
		),
			


		//Position & Layout

		//Menu Items Alignment

			





		/* DESCRIPTIONS */
		240 => array(
			'name'	=> 'header_descriptions',
			'label'	=> __( 'Descriptions' , 'ubermenu' ),
			'type'	=> 'header',
			'group'	=> 'descriptions',
		),


		250 => array(
			'name'		=> 'descriptions_top_level',
			'label'		=> __( 'Top Level Descriptions' , 'ubermenu' ),
			'desc'		=> __( 'Allow descriptions on top level menu items.' , 'ubermenu' ),
			'type'		=> 'checkbox',
			'default' 	=> 'on',
			'group'	=> 'descriptions',
		),

		260 => array(
			'name'		=> 'descriptions_headers',
			'label'		=> __( 'Header Item Descriptions' , 'ubermenu' ),
			'desc'		=> __( 'Allow descriptions on header menu items.' , 'ubermenu' ),
			'type'		=> 'checkbox',
			'default' 	=> 'on',
			'group'	=> 'descriptions',
		),

		270 => array(
			'name'		=> 'descriptions_normal',
			'label'		=> __( 'Normal Item Descriptions' , 'ubermenu' ),
			'desc'		=> __( 'Allow descriptions on normal menu items.' , 'ubermenu' ),
			'type'		=> 'checkbox',
			'default' 	=> 'on',
			'group'	=> 'descriptions',
		),

		280 => array(
			'name'		=> 'target_divider',
			'label'		=> __( 'Target Divider' , 'ubermenu' ),
			'desc'		=> __( 'The character(s) separating the title from the description.  This will not be visible, but is useful for screen readers.' , 'ubermenu' ),
			'type'		=> 'text',
			'default' 	=> ' &ndash; ',
			'group'	=> 'descriptions',
			'sanitize_callback' => 'ubermenu_allow_html'
		),





			
		//Submenus

		//Images
		
		//Background Images


		



		/** RESPONSIVE **/

		400 => array(
			'name'	=> 'header_responsive',
			'label'	=> __( 'Responsive &amp; Mobile' , 'ubermenu' ),
			'type'	=> 'header',
			'desc'	=> __( 'Settings for responsiveness &amp; mobile devices' ),
			'group'	=> 'responsive',
		),

		410 => array(
			'name' 		=> 'responsive',
			'label' 	=> __( 'Responsive Menu', 'ubermenu' ),
			'desc' 		=> __( 'Uncheck this if you do not want a responsive menu.', 'ubermenu' ),
			'type' 		=> 'checkbox',
			'default' 	=> 'on',
			'group'		=> 'responsive',
		),


		420 => array(
			'name' 		=> 'responsive_toggle',
			'label' 	=> __( 'Responsive Toggle', 'ubermenu' ),
			'desc' 		=> __( 'Automatically display a responsive toggle for this menu.', 'ubermenu' ),
			'type' 		=> 'checkbox',
			'default' 	=> 'on',
			'group'		=> 'responsive',
		),

		422 => array(
			'name' 		=> 'responsive_toggle_tag',
			'label' 	=> __( 'Responsive Toggle Tag', 'ubermenu' ),
			'desc' 		=> __( 'Anchor by default.', 'ubermenu' ),
			'type' 		=> 'radio',
			'default' 	=> 'a',
			'options'		=> array(
				'a'		=> '&lt;a&gt;',
				'div'	=> '&lt;div&gt;',
				'span'	=> '&lt;span&gt;',
				'button'=> '&lt;button&gt;',
			),
			'group'		=> 'responsive',
		),

		430 => array(
			'name' 		=> 'responsive_toggle_content',
			'label' 	=> __( 'Responsive Toggle Content', 'ubermenu' ),
			'desc' 		=> __( 'The text to display on the responsive toggle.', 'ubermenu' ),
			'type' 		=> 'text',
			'default' 	=> 'Menu',
			'group'		=> 'responsive',
			'sanitize_callback' => 'ubermenu_allow_html',
		),

		440 => array(
			'name' 		=> 'responsive_collapse',
			'label' 	=> __( 'Collapse by default', 'ubermenu' ),
			'desc' 		=> __( 'Uncheck this if you do not want a responsive toggle, but just want to see all top level menu items on mobile.', 'ubermenu' ),
			'type' 		=> 'checkbox',
			'default' 	=> 'on',
			'group'		=> 'responsive',
		),

		450 => array(
			'name'	=> 'responsive_max_height',
			'label'	=> __( 'Responsive Max Height (px)' , 'ubermenu' ),
			'type'	=> 'text',
			'desc'	=> __( 'Adjusting this to the height of your responsive menu can make the transition smoother.  500 by default', 'ubermenu' ),
			'group'	=> 'responsive',
			'custom_style'	=> 'responsive_max_height',
		),

		460 => array(
			'name' 		=> 'display_retractor_top',
			'label' 	=> __( 'Display Submenu Retractor [Top]', 'ubermenu' ),
			'desc' 		=> __( 'Display a "Close" button at the top of the submenu on mobile devices.', 'ubermenu' ),
			'type' 		=> 'checkbox',
			'default' 	=> 'off',
			'group'		=> 'responsive',
		),

		465 => array(
			'name' 		=> 'display_retractor_bottom',
			'label' 	=> __( 'Display Submenu Retractor [Bottom]', 'ubermenu' ),
			'desc' 		=> __( 'Display a "Close" button at the bottom of the submenu on mobile devices.', 'ubermenu' ),
			'type' 		=> 'checkbox',
			'default' 	=> 'on',
			'group'		=> 'responsive',
		),

		470 => array(
			'name' 		=> 'retractor_label',
			'label' 	=> __( 'Submenu Retractor Text', 'ubermenu' ),
			'desc' 		=> __( 'By default, the retractor will read "Close", and will be translatable.  You can override it here but it will no longer be translatable.', 'ubermenu' ),
			'type' 		=> 'text',
			'default' 	=> '',
			'group'		=> 'responsive',
		),

		

/*
		array(
			'name'	=> 'responsive_breakpoint',
			'label'	=> __( 'Responsive Breakpoint' , 'ubermenu' ),
			'type'	=> 'text',
			'desc'	=> __( '959 by default', 'ubermenu' ),
			'group'	=> 'responsive',
		),
*/


			
		);

	return apply_filters( 'ubermenu_instance_settings' , $settings , $config_id );
}


function ubermenu_get_settings_fields(){

	$prefix = UBERMENU_PREFIX;

	$settings_fields = _UBERMENU()->get_settings_fields();
	if( $settings_fields ) return $settings_fields;



	$main_assigned = '';
	if(!has_nav_menu('ubermenu')){
		$main_assigned = 'No Menu Assigned';
	}
	else{
    	$menus = get_nav_menu_locations();
    	$menu_title = wp_get_nav_menu_object($menus['ubermenu'])->name;
    	$main_assigned = $menu_title;
    }

    $main_assigned = '<span class="ubermenu-main-assigned">'.$main_assigned.'</span>  <p class="ubermenu-desc-understated">The menu assigned to the <strong>UberMenu [Main]</strong> theme location will be displayed.  <a href="'.admin_url( 'nav-menus.php?action=locations' ).'">Assign a menu</a></p>';
	
	$config_id = 'main';

	$fields = array(
		$prefix.$config_id => ubermenu_get_settings_fields_instance( $config_id )
	);
	

	$fields = apply_filters( 'ubermenu_settings_panel_fields' , $fields );


	//Allow ordering
	foreach( $fields as $section_id => $section_fields ){
		ksort( $fields[$section_id] );
		$fields[$section_id] = array_values( $fields[$section_id] );
	}

	_UBERMENU()->set_settings_fields( $fields );
	
	// up( $fields , 2 );
	
//up( $fields );
	return $fields;
}

function ubermenu_get_settings_defaults(){

	$pro_defaults = false;
	if( !ubermenu_is_pro() ){
		//Setup pro defaults
		$pro_defaults = array(
			'auto_theme_location'	=> '',
			'nav_menu_id'			=> '_none',
			'bar_align'				=> 'full',
			'bar_width'				=> '',
			'items_align'			=> 'left',
			'items_align_vertical'	=> 'bottom',
			'bar_inner_center'		=> 'off',
			'bar_inner_width'		=> '',
			'bound_submenus'		=> 'on',
			'submenu_inner_width'	=> '',
			'submenu_max_height'	=> '',
			'image_size'			=> 'full',
			'image_width'			=> '',
			'image_height'			=> '',
			'image_set_dimensions'	=> 'on',
			'image_title_attribute'	=> 'off',
			'submenu_background_image_reponsive_hide' => 'off',

			'google_font'			=> '',
			'google_font_style'		=> '',
			'custom_font_property'	=> '',

			'container_tag'			=> 'nav',
			'allow_shortcodes_in_labels' => 'off',
			'display_submenu_indicators' => 'on',
			'display_submenu_close_button' => 'off',
			'theme_location_instance'	=> 0,
		);
	}

	$fields = ubermenu_get_settings_fields();

	$settings_defaults = array();

	foreach( $fields as $section_id => $ops ){
		$section_defaults = array();

		foreach( $ops as $op ){
			if( $op['type'] == 'header' ) continue;
			$section_defaults[$op['name']] = isset( $op['default'] ) ? $op['default'] : '';
		}

		if( $pro_defaults !== false ){	
			$section_defaults = array_merge( $section_defaults , $pro_defaults );
		}

		$settings_defaults[$section_id] = $section_defaults;
	}

	return apply_filters( 'ubermenu_settings_defaults' , $settings_defaults );
}

add_filter( 'ubermenu_settings_panel_fields' , 'ubermenu_settings_panel_fields_general' );
function ubermenu_settings_panel_fields_general( $fields ){


	$fields[UBERMENU_PREFIX.'general'] = array(
		
		/* Custom Styles */
		10 => array(
			'name'	=> 'header_custom_styles',
			'label'	=> __( 'Custom Styles' , 'ubermenu' ),
			'type'	=> 'header',
			'group'	=> 'custom_css',
		),

		20 => array(
			'name'	=> 'custom_tweaks',
			'label'	=> __( 'Custom CSS Tweaks' , 'ubermenu' ),
			'type'	=> 'textarea',
			'group'	=> 'custom_css',
			'sanitize_callback' => 'ubermenu_allow_html',
		),

		30 => array(
			'name'	=> 'custom_tweaks_mobile',
			'label'	=> __( 'Custom CSS Tweaks - Mobile' , 'ubermenu' ),
			'desc'	=> __( 'Styles to apply below the responsive breakpoint only.' , 'ubermenu' ),
			'type'	=> 'textarea',
			'group'	=> 'custom_css',
			'sanitize_callback' => 'ubermenu_allow_html',
		),

		40 => array(
			'name'	=> 'custom_tweaks_desktop',
			'label'	=> __( 'Custom CSS Tweaks - Desktop' , 'ubermenu' ),
			'desc'	=> __( 'Styles to apply above the responsive breakpoint only.' , 'ubermenu' ),
			'type'	=> 'textarea',
			'group'	=> 'custom_css',
			'sanitize_callback' => 'ubermenu_allow_html',
		),





		

		

		/** Script Configuration **/
		170 => array(
			'name'	=> 'header_script_config',
			'label'	=> __( 'Script Configuration' , 'ubermenu' ),
			'type'	=> 'header',
			'group'	=> 'script_config',
		),


		180 => array(
			'name'	=> 'reposition_on_load',
			'label' => __( 'Reposition Submenus on window.load' , 'ubermenu' ),
			'desc'	=> __( 'Reposition the Submenus after other assets have loaded.  Useful if using @font-face fonts in the menu.', 'ubermenu' ),
			'type'	=> 'checkbox',
			'default'=> 'off',
			'group'	=> 'script_config',
		),


		190 => array(
			'name'	=> 'intent_delay',
			'label'	=> __( 'Hover Intent Delay' , 'ubermenu' ),
			'desc'	=> __( 'Time to wait until closing the submenu after hover-out (ms)' , 'ubermenu' ),
			'type'	=> 'text',
			'default'	=> 300,
			'group'	=> 'script_config',
		),

		195 => array(
			'name'	=> 'intent_interval',
			'label'	=> __( 'Hover Intent Interval' , 'ubermenu' ),
			'desc'	=> __( 'Polling interval for mouse comparisons (ms)' , 'ubermenu' ),
			'type'	=> 'text',
			'default'	=> 100,
			'group'	=> 'script_config',
		),

		200 => array(
			'name'	=> 'intent_threshold',
			'label'	=> __( 'Hover Intent Threshold' , 'ubermenu' ),
			'desc'	=> __( 'Maximum number of pixels over the target that the mouse can move (since the last poll) to be considered an intentional hover' , 'ubermenu' ),
			'type'	=> 'text',
			'default'	=> 7,
			'group'	=> 'script_config',
		),

		210 => array(
			'name'	=> 'scrollto_offset',
			'label' => __( 'ScrollTo Offset' , 'ubermenu' ),
			'desc'	=> __( 'Pixel offset to leave when scrolling.', 'ubermenu' ),
			'type'	=> 'text',
			'default'=> 50,
			'group'	=> 'script_config',
		),

		220 => array(
			'name'	=> 'remove_conflicts',
			'label' => __( 'Remove JS Conflicts' , 'ubermenu' ),
			'desc'	=> __( 'This will disable any event bindings added with jQuery unbind() or off() before the UberMenu script runs.  If you wish to bind your own events, or have other scripts act on the menu, you may need to disable this.', 'ubermenu' ),
			'type'	=> 'checkbox',
			'default'=> 'on',
			'group'	=> 'script_config',
		),

		



		





		/** Admin Notices **/

		
		270 => array(
			'name'	=> 'header_misc',
			'label'	=> __( 'Miscellaneous' , 'ubermenu' ),
			'type'	=> 'header',
			'group'	=> 'misc',
		),


		280 => array(
			'name'	=> 'admin_notices',
			'label'	=> __( 'Show Admin Notices' , 'ubermenu' ),
			'type'	=> 'checkbox',
			'default'	=> 'on',
			'desc'	=> __( 'Display helpful notices - only to admins', 'ubermenu' ),
			'group'	=> 'misc',
		),

		282 => array(
			'name'	=> 'accessible',
			'label'	=> __( 'Enable Accessibility Features' , 'ubermenu' ),
			'type'	=> 'checkbox',
			'default'	=> 'on',
			'desc'	=> __( 'Allow users to tab through the menu and highlight focused elements', 'ubermenu' ),
			'group'	=> 'misc',
		),



		


		/** MAINTAINENCE **/
		330 => array(
			'name'	=> 'header_maintenance',
			'label'	=> __( 'Maintenance' , 'ubermenu' ),
			'desc'	=> '<i class="fa fa-warning"></i> '. __( 'You should only adjust settings in this section if you are certain of what you are doing.'  , 'ubermenu' ),
			'type'	=> 'header',
			'group'	=> 'maintenance',
		),

		340 => array(
			'name'	=> 'migration',
			'label'	=> __( 'Migrate Settings' , 'ubermenu' ),
			'desc'	=> '<a class="button button-primary" href="'.admin_url('themes.php?page=ubermenu-settings&do=migration-check').'">'.__( 'Migrate Settings' , 'ubermenu' ).'</a><br/><p>'.__( 'Migrate UberMenu 2 Settings to UberMenu 3', 'ubermenu' ).'</p>',
			'type'	=> 'html',
			'group'	=> 'maintenance',
		),

		350 => array(
			'name'	=> 'reset_all',
			'label'	=> __( 'Reset ALL Settings' , 'ubermenu' ),
			'desc'	=> '<a class="button button-primary" href="'.admin_url('themes.php?page=ubermenu-settings&do=reset-all-check').'">'.__( 'Reset Settings' , 'ubermenu' ).'</a><br/><p>'.__( 'Reset ALL Control Panel settings to the factory defaults.', 'ubermenu' ).'</p>',
			'type'	=> 'html',
			'group'	=> 'maintenance',
		),
	);


	if( UBERMENU_PRO ){
		$fields[UBERMENU_PREFIX.'general'][400] = array(
			'name'	=> 'lite_mode',
			'label'	=> __( 'Lite Mode' , 'ubermenu' ),
			'desc'	=> __( 'Use only the basic UberMenu options.  Note that you will lose all non-lite settings if you switch this on.' , 'ubermenu' ),
			'type'	=> 'checkbox',
			'default' => 'off',
			'group'	=> 'misc'
		);
	}


	return $fields;
}

add_action( 'admin_init' , 'ubermenu_reset_settings' , 100 );
function ubermenu_reset_settings(){

	if( isset( $_GET['page'] ) && $_GET['page'] == 'ubermenu-settings' ){
		
		if( !current_user_can( 'manage_options' ) ){
			die( 'You need to be an admin to do that' );
		}

		if( isset( $_GET['do'] ) && $_GET['do'] == 'reset-all' ){
			
			$instances = ubermenu_get_menu_instances( true );
			foreach( $instances as $config_id ){
				delete_option( UBERMENU_PREFIX.$config_id );
			}
			delete_option( UBERMENU_PREFIX.'general' );
			ubermenu_save_all_menu_styles();

		}
		else if( isset( $_GET['do'] ) && $_GET['do'] == 'reset-styles' ){
			
			$instances = ubermenu_get_menu_instances( true );
			$all_fields = ubermenu_get_settings_fields();
			foreach( $instances as $config_id ){
				$ops = ubermenu_get_instance_options( $config_id );
				$fields = $all_fields[UBERMENU_PREFIX.$config_id];
				//up( $fields , 2 );
				foreach( $fields as $field ){
					if( $field['group'] == 'style_customizations' && $field['type'] != 'header' ){
						$ops[$field['name']] = isset( $field['default'] ) ? $field['default'] : '';
					}
				}
				//up( $ops );
				update_option( UBERMENU_PREFIX.$config_id , $ops );
				ubermenu_save_all_menu_styles();

			}

		}
	}	
}

function ubermenu_get_settings_sections(){

	$prefix = UBERMENU_PREFIX;

	$sections = array(

		array(
			'id' => $prefix.'main',
			'title' => __( 'Main UberMenu Configuration', 'ubermenu' ),
			'sub_sections'	=> ubermenu_get_settings_subsections( 'main' ),
		),

	);

	$sections = apply_filters( 'ubermenu_settings_panel_sections' , $sections );

	return $sections;

}

add_filter( 'ubermenu_settings_panel_sections' , 'ubermenu_general_settings_tab' , 80 );
function ubermenu_general_settings_tab( $sections ){
	$prefix = UBERMENU_PREFIX;
	$section = array(
		'id'	=> $prefix.'general',
		'title'	=> __( 'General Settings' , 'ubermenu' ),
		'sub_sections'	=> array(

			'custom_css'=> array(
				'title'	=> __( 'Custom CSS' , 'ubermenu' ),
			),
			'script_config'=> array(
				'title'	=> __( 'Script Configuration' , 'ubermenu' ),
			),
			
			'misc'=> array(
				'title'	=> __( 'Miscellaneous' , 'ubermenu' ),
			),
			'maintenance'=> array(
				'title'	=> __( 'Maintenance', 'ubermenu' ),
			),

		),
	);

	$section = apply_filters( 'ubermenu_general_settings_sections' , $section );

	$sections[] = $section;

	return $sections;
}

function ubermenu_get_settings_subsections( $config_id ){
	return apply_filters( 'ubermenu_settings_subsections' , 
		array(
			'basic' => array(
				'title' => __( 'Basic Configuration' , 'ubermenu' ),
			),			
			'descriptions'	=> array(
				'title'	=> __( 'Descriptions' , 'ubermenu' ),
			),
			'responsive'	=> array(
				'title'	=> __( 'Responsive & Mobile' , 'ubermenu' ),
			),
		),
		$config_id 
	);
}

/**
 * Registers settings section and fields
 */
function ubermenu_admin_init() {

	$prefix = UBERMENU_PREFIX;
 
 	$sections = ubermenu_get_settings_sections();
 	$fields = ubermenu_get_settings_fields();

 	//set up defaults so they are accessible
	_UBERMENU()->set_defaults();

	
	$settings_api = _UBERMENU()->settings_api();

	//set sections and fields
	$settings_api->set_sections( $sections );
	$settings_api->set_fields( $fields );

	//initialize them
	$settings_api->admin_init();

}
add_action( 'admin_init', 'ubermenu_admin_init' );

function ubermenu_init_frontend_defaults(){
	if( !is_admin() ){
		_UBERMENU()->set_defaults();
	}
}
add_action( 'init', 'ubermenu_init_frontend_defaults' );

/**
 * Register the plugin page
 */
function ubermenu_admin_menu() {
	add_submenu_page(
		'themes.php',
		'UberMenu Settings',
		'UberMenu',
		'manage_options',
		'ubermenu-settings',
		'ubermenu_control_panel' //'ubermenu_settings_panel'
	);
}
 
add_action( 'admin_menu', 'ubermenu_admin_menu' );





/**
 * Display the plugin settings options page
 */
function ubermenu_control_panel() {

	if( !isset( $_GET['do'] ) ){
		ubermenu_settings_panel();
	}
	else{
		switch( $_GET['do'] ){
			case 'widget-manager':
				ubermenu_widget_manager_panel();
				break;
			case 'migration-check':
				ubermenu_migration_panel();
				break;
			case 'migrate':
				ubermenu_migration_complete_panel();
				break;
			case 'reset-all-check':
				ubermenu_reset_all_check_panel();
				break;
			case 'reset-all':
				ubermenu_reset_all_complete_panel();
				break;

			case 'reset-styles-check':
				ubermenu_reset_styles_check_panel();
				break;
			case 'reset-styles':
				ubermenu_reset_styles_complete_panel();
				break;

			case 'no-migrate':
				//

			case 'reset-migration-check':
				//

			default:
				ubermenu_settings_panel();
				break;
		}
	}
}

function ubermenu_migration_complete_panel(){

	?>
	<div class="wrap ubermenu-wrap">


	
		<h2><strong>UberMenu</strong> Migration <span class="ubermenu-version">v<?php echo UBERMENU_VERSION; ?></span></h2>

		<?php settings_errors(); ?>

		<?php 

			$migration_status = get_option( UBERMENU_PREFIX.'migration_status' , false );
	
			//Settings Don't Exist 
			if( $migration_status == 'complete' ){
				echo '<div class="updated"><p>'.__( 'Migration completed successfully!' , 'ubermenu' ).'</p></div>';
			}
			else if( $migration_status == 'in_progress' ){
				echo '<div class="error"><p>'.__( 'Migration error.  You may need to disable safe_mode to complete the migration.' , 'ubermenu' ).'</p></div>';
			}
			else{
				echo 'Ruh-roh, Reorge. Something\'s not right.';
				echo '<br/>migration_status: '.$migration_status;
			}

		?>
		<br/><br/>
		<?php ubermenu_admin_back_to_settings_button(); ?>
	</div>
	<?php
}

function ubermenu_migration_panel(){
	
	//ubermenu_migrate_item_settings();

	?>
	<div class="wrap ubermenu-wrap">
	
		<h2><strong>UberMenu</strong> Migration <span class="ubermenu-version">v<?php echo UBERMENU_VERSION; ?></span></h2>

		<?php 
			$old_ops = get_option( 'wp-mega-menu-settings' , false ); // 'sparkops_ubermenu' );
		
			//Settings Don't Exist 
			if( !$old_ops ){
				echo '<div class="error"><p>'.__( 'Sorry, couldn\'t find any UberMenu 2 settings to migrate' , 'ubermenu' ).'</p></div>';
				return;
			}
			else{
				echo '<div class="updated"><p>'.__( 'UberMenu 2 Settings Found' , 'ubermenu' ).'</p></div>';
				//uberp( $old_ops );

				echo '<div class="error"><p>'.__( 'Migrating will merge your UberMenu 2 settings into UberMenu 3, giving precedence to UberMenu 2 settings. This may overwrite existing UberMenu 3 settings.  Please be sure you wish to proceed, as this process is cannot be undone.  The process can take some time to complete.' , 'ubermenu' ).'</p></div>';


				?>
				<form action="<?php echo admin_url( 'themes.php' ); ?>" method="GET">
					<input type="hidden" name="page" value="ubermenu-settings" />
					<input type="hidden" name="do" value="migrate" />

					<!-- <h4>Style Generator</h4> -->

					<br/>
					<h3>Migrate Control Panel Settings</h3>

					<label><input type="checkbox" checked="checked" value="on" name="migrate_control_panel" /> Migrate Control Panel</label>

					<p>This will migrate the settings from the UberMenu Control Panel, including the Style Generator settings if you had your Style Application set to the Style Generator.</p>

					<br/>
					<h3>Migrate Menu Item Settings</h3>

					<h4>Which Menus do you wish to migrate?</h4>

					<?php
						$menus = wp_get_nav_menus( array('orderby' => 'name') );
						foreach( $menus as $menu ): ?>
							<label><input type="checkbox" checked="checked" name="migrate_menu_ids[]" value="<?php echo $menu->term_id; ?>" /> <?php echo $menu->name; ?></label><br/>
						<?php endforeach; ?>

					<br/>
					<input type="submit" class="button button-primary" value="<?php _e( 'Confirm &amp; Migrate Settings' , 'ubermenu' ); ?>" />
				</form>

				<br/><br/>
				<?php
			}

			ubermenu_admin_back_to_settings_button();

		?>

	
 
	</div>
	<?php
}



function ubermenu_admin_back_to_settings_button(){
	?>
	<a class="button" href="<?php echo admin_url('themes.php?page=ubermenu-settings'); ?>">&laquo; Back to Control Panel</a>
	<?php
}



function ubermenu_reset_styles_complete_panel(){

	//ubermenu_migrate_item_settings();

	?>
	<div class="wrap ubermenu-wrap">


	
		<h2><strong>UberMenu</strong> Style Customization Settings Reset <span class="ubermenu-version">v<?php echo UBERMENU_VERSION; ?></span></h2>

		<?php settings_errors(); ?>

		<?php 

			echo '<div class="updated"><p>'.__( 'Style Customizations reset complete!' , 'ubermenu' ).'</p></div>';

		?>
		<br/><br/>
		<?php ubermenu_admin_back_to_settings_button(); ?>
	</div>
	<?php
}



function ubermenu_reset_styles_check_panel(){
	
	//ubermenu_migrate_item_settings();

	?>
	<div class="wrap ubermenu-wrap">
	
		<h2><strong>UberMenu</strong> Style Customization Settings Reset <span class="ubermenu-version">v<?php echo UBERMENU_VERSION; ?></span></h2>

		<?php 
			echo '<div class="error"><p>'.__( 'Please be sure you wish to proceed.  This will delete all Style Customizations (though not your custom CSS).  This cannot be undone.' , 'ubermenu' ).'</p></div>';


			?>
			<form action="<?php echo admin_url( 'themes.php' ); ?>" method="GET">
				<input type="hidden" name="page" value="ubermenu-settings" />
				<input type="hidden" name="do" value="reset-styles" />

				<br/>
				<input type="submit" class="button button-primary" value="<?php _e( 'Confirm &amp; Reset Style Customizations' , 'ubermenu' ); ?>" />
			</form>
			<?php

		?>
		<br/><br/>
		<?php ubermenu_admin_back_to_settings_button(); ?>
 
	</div>
	<?php
}

function ubermenu_reset_all_complete_panel(){

	//ubermenu_migrate_item_settings();

	?>
	<div class="wrap ubermenu-wrap">


	
		<h2><strong>UberMenu</strong> Settings Reset <span class="ubermenu-version">v<?php echo UBERMENU_VERSION; ?></span></h2>

		<?php settings_errors(); ?>

		<?php 

			echo '<div class="updated"><p>'.__( 'Settings reset complete!' , 'ubermenu' ).'</p></div>';

		?>
		<br/><br/>
		<?php ubermenu_admin_back_to_settings_button(); ?>
	</div>
	<?php
}



function ubermenu_reset_all_check_panel(){
	
	//ubermenu_migrate_item_settings();

	?>
	<div class="wrap ubermenu-wrap">
	
		<h2><strong>UberMenu</strong> Settings Reset <span class="ubermenu-version">v<?php echo UBERMENU_VERSION; ?></span></h2>

		<?php 
			echo '<div class="error"><p>'.__( 'Please be sure you wish to proceed.  This will delete all Menu Settings, including Custom Styles, Instance Settings and General Settings.  This cannot be undone.' , 'ubermenu' ).'</p></div>';


			?>
			<form action="<?php echo admin_url( 'themes.php' ); ?>" method="GET">
				<input type="hidden" name="page" value="ubermenu-settings" />
				<input type="hidden" name="do" value="reset-all" />

				<br/>
				<input type="submit" class="button button-primary" value="<?php _e( 'Confirm &amp; Reset Settings' , 'ubermenu' ); ?>" />
			</form>
			<?php

		?>
		<br/><br/>
		<?php ubermenu_admin_back_to_settings_button(); ?>
 
	</div>
	<?php
}

function ubermenu_settings_panel(){
	if( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' ){
		do_action( 'ubermenu_settings_panel_updated' );
	}

	$settings_api = _UBERMENU()->settings_api();
 
	echo '<div class="wrap ubermenu-wrap">';
	settings_errors();

	?>
	<div class="ubermenu-settings-links">
		<?php do_action( 'ubermenu_settings_before_title' ); ?>
	</div>
	<?php

	echo '<h2><strong>UberMenu</strong> Control Panel <span class="ubermenu-version">v'.UBERMENU_VERSION.'</span></h2>';

	do_action( 'ubermenu_settings_before' );	
 
	$settings_api->show_navigation();
	$settings_api->show_forms();

	do_action( 'ubermenu_settings_after' );
 
	echo '</div>';
}

function ubermenu_settings_links(){
	if( ubermenu_is_pro() ) echo '<a class="button button-quickstart" href="#"><i class="fa fa-bolt"></i> QuickStart</a> ';
	echo '<a target="_blank" class="button button-primary" href="'.UBERMENU_KB_URL.'"><i class="fa fa-book"></i> Knowledgebase</a> ';
	echo '<a target="_blank" class="button button-tertiary" href="'.UBERMENU_VIDEOS_URL.'"><i class="fa fa-video-camera"></i> Video Tutorials</a> ';
	if( ubermenu_is_pro() ) echo '<a target="_blank" class="button button-secondary" href="'.UBERMENU_SUPPORT_URL.'"><i class="fa fa-user-md"></i> Support Forum</a> ';
}
add_action( 'ubermenu_settings_before_title' , 'ubermenu_settings_links' );




/**
 * Get the value of a settings field
 *
 * @param string $option settings field name
 * @param string $section the section name this field belongs to
 * @param string $default default text if it's not found
 * @return mixed
 */
function ubermenu_op( $option, $section, $default = null ) {
 
	$options = get_option( UBERMENU_PREFIX.$section , array() );		//cached by WP

	//Value from settings
	if ( isset( $options[$option] ) ) {
		$val = $options[$option];
		//return $val;
	}
	//Default Fallback
	else{
		//No default passed
		if( $default == null ){
			//$default = _UBERMENU()->settings_api()->get_default( $option, UBERMENU_PREFIX.$section );
			$val = _UBERMENU()->get_default( $option, UBERMENU_PREFIX.$section );
		}
		//Use passed default
		else{
			$val = $default;
		}
	}

	$val = apply_filters( 'ubermenu_op' , $val , $option , $section );

	return $val;
}
function ubermenu_get_instance_options( $instance ){
	//echo UBERMENU_PREFIX.$instance;
	$defaults = _UBERMENU()->get_defaults( UBERMENU_PREFIX.$instance );
	$options = get_option( UBERMENU_PREFIX.$instance , $defaults );
	if( !is_array( $options ) || count( $options ) == 0 ) return $defaults;
	return $options;
}

function ubermenu_admin_panel_assets( $hook ){

	if( $hook == 'appearance_page_ubermenu-settings' ){
		wp_enqueue_script( 'ubermenu' , UBERMENU_URL . 'admin/assets/admin.settings.js' );
		wp_enqueue_style( 'ubermenu-settings-styles' , UBERMENU_URL.'admin/assets/admin.settings.css' );
		wp_enqueue_style( 'ubermenu-font-awesome' , UBERMENU_URL.'assets/css/fontawesome/css/font-awesome.min.css' );
	}
}
add_action( 'admin_enqueue_scripts' , 'ubermenu_admin_panel_assets' );



function ubermenu_check_menu_assignment(){
	$display = ubermenu_op(  'display_main' , 'ubermenu-main' );

	if( $display == 'on' ){
		if( !has_nav_menu( 'ubermenu' ) ){
			?>
			<div class="update-nag"><strong>Important!</strong> There is no menu assigned to the <strong>UberMenu [Main]</strong> Menu Location.  <a href="<?php echo admin_url( 'nav-menus.php?action=locations' ); ?>">Assign a menu</a></div>
			<br/><br/>
			<?php
		}
	}
}
add_action( 'ubermenu_settings_before' , 'ubermenu_check_menu_assignment' );

function ubermenu_allow_html( $str ){
	return $str;
}






add_filter( 'ubermenu_settings_panel_sections' , 'ubermenu_settings_panel_go_pro' , 1000 );
function ubermenu_settings_panel_go_pro( $sections = array() ){

	if( ! defined( 'UBERMENU_UPGRADE' ) )
			define( 'UBERMENU_UPGRADE' , true );

	if( !UBERMENU_UPGRADE || UBERMENU_PRO ) return $sections;

	$sections[] = array(
		'id'	=> UBERMENU_PREFIX.'go_pro',
		'title' => __( 'Go Pro' , 'ubermenu' ) . ' <i class="fa fa-rocket"></i>',
		'sub_sections'	=> array(
			'compare'	=> array(
				'title'	=> __( 'Compare', 'ubermenu' ),
			),
			// 'pro_demo'	=> array(
			// 	'title'	=> __( 'Demo', 'ubermenu' ),
			// ),
		),
	);
	
	return $sections;
}

add_filter( 'ubermenu_settings_panel_fields' , 'ubermenu_settings_panel_fields_go_pro' );
function ubermenu_settings_panel_fields_go_pro( $fields ){

	if( ! defined( 'UBERMENU_UPGRADE' ) )
			define( 'UBERMENU_UPGRADE' , true );

	if( !UBERMENU_UPGRADE || UBERMENU_PRO ) return $fields;

	$compare = '

	<h2>Turn your menu up a notch with UberMenu Pro</h2>

	<p>
	Your theme includes the lite version of UberMenu, which allows you to create awesome basic mega menus. Upgrade to the full UberMenu MegaMenu Plugin to get even more advanced features, like images, widgets, shortcodes, and more!
	</p>

	<div class="spark-action-button">
		<a href="http://wpmegamenu.com" target="_blank" class="">Learn More <i class="fa fa-chevron-right"></i></a>
	</div>
	<table class="ss-table-compare">
			<tbody><tr>
				<th></th>
				<th>UberMenu Lite					<span class="desc">Included with theme</span>
				</th>
				<th>UberMenu					<span class="desc">Full plugin upgrade</span>
				</th>
			</tr>
			<tr>
				<td class="ss-feature">Click or Hover Trigger</td>
				<td><i class="fa fa-check"></i></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">Slide or Fade Effects</td>
				<td><i class="fa fa-check"></i></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">Responsive</td>
				<td><i class="fa fa-check"></i></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">Mega Menus</td>
				<td><i class="fa fa-check"></i></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">Descriptions</td>
				<td><i class="fa fa-check"></i></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">Images
					<span class="desc">Insert images for each menu item based on the post\'s featured image, or upload your own.</span>
				</td>
				<td></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">Dynamic Menu Items					<span class="desc">Automatically generate menu items from your site content</span></td>
				<td></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">Tabbed Submenus					<span class="desc">Organize your submenus into tabs to display even more content</span></td>
				<td></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">Custom Content &amp; Widgets					<span class="desc">Add any custom HTML or widget content to your menu</span></td>
				<td></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">Google Maps					<span class="desc">Easily add Google Maps to your menu with a shortcode</span></td>
				<td></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			
			<tr>
				<td class="ss-feature">Contact Forms &amp; Shortcodes					<span class="desc">Display a Contact Form 7 form or any shortcode in your menu</span></td>
				<td></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">20+ Skins					<span class="desc">Choose from over 20 preset styles</span></td>
				<td></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">Style Customizer					<span class="desc">Tweak over 50 settings in the Customizer</span></td>
				<td></td>
				<td><i class="fa fa-check"></i></td>
			</tr>

			<tr>
				<td class="ss-feature">Fonts
					<span class="desc">Choose from 30 of the most popular Google Fonts</span>
				</td>
				<td></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
			<tr>
				<td class="ss-feature">Compatible with UberMenu Extensions					<span class="desc">Extend the functionality of your menu with great extensions like <a href="http://wpmegamenu.com/icons">Icons</a>, <a href="http://goo.gl/0LrTj">Conditionals</a> and <a href="wpmegamenu.com/sticky">Sticky</a></span></td>
				<td></td>
				<td><i class="fa fa-check"></i></td>
			</tr>
		</tbody></table>

		<div class="spark-action-button">
			<a href="http://wpmegamenu.com" target="_blank" class="">Get UberMenu Pro <i class="fa fa-chevron-right"></i></a>
		</div>

		<div style="font-size:11px; color:#999; border-top:1px dotted #ccc; margin-top:80px;">
			<p>If you would like to hide this panel, you can do so by adding the following code to your functions.php file: </p>

			<pre>define( \'UBERMENU_UPGRADE\' , false );</pre>
		
		<div id="container-ubermenu-pro-upgrade" class="spark-admin-op container-type-custom sub-container sub-container-wpmega-desc-header "></div>								
								
															</div>
';

	$fields[UBERMENU_PREFIX.'go_pro'] = array(
		
		10 => array(
			'name'	=> 'go_pro_compare',
			'label'	=> __( 'Compare', 'ubermenu' ),
			'type'	=> 'html',
			'desc'	=> $compare,
			'group'	=> 'compare',
		)

	);

	return $fields;
}

