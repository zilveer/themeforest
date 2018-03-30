<?php

add_action( 'admin_init' , 'ubermenu_migration_check' , 100 );
function ubermenu_migration_check(){

	if( isset( $_GET['page'] ) && $_GET['page'] == 'ubermenu-settings' ){
		if( isset( $_GET['do'] ) ){

			if( $_GET['do'] == 'migration-check' || 
				$_GET['do'] == 'migrate' ||
				$_GET['do'] == 'reset-styles' ) {
				//If we're doing the migration check now, don't show this message
				return;
			}
			else if( $_GET['do'] == 'no-migrate' ){
				update_option( UBERMENU_PREFIX.'migration_status' , 'do-not-migrate' );
			}
			else if( $_GET['do'] == 'reset-migration-check' ){
				update_option( UBERMENU_PREFIX.'migration_status' , false );
			}

		}
	}

	$migration_status = get_option( UBERMENU_PREFIX.'migration_status' , false );

	//Have we already migrated, or determined we don't need to?
	if( $migration_status == 'complete' || $migration_status == 'n/a' || $migration_status == 'do-not-migrate' ){
		return;
	}

	//We may need to migrate - do the old setting exist?
	$old_ops = get_option( 'wp-mega-menu-settings' , false ); // 'sparkops_ubermenu' );
	
	//There are some old setting, offer migration
	if( is_array( $old_ops ) ){

		if( $migration_status == false ){

			$notice = __( 'Looks like you\'ve updated to UberMenu 3.  Awesome!  Would you like to migrate your settings?' , 'ubermenu' );
			$notice.= ' <a class="button button-primary" href="'.admin_url('themes.php?page=ubermenu-settings&do=migration-check').'">'.__( 'Begin Migration' ).'</a>';
			$notice.= ' <a class="button" href="'.admin_url('themes.php?page=ubermenu-settings&do=no-migrate').'">'.__( 'No, thanks' , 'ubermenu' ).'</a>';

			$add = true;

			//Avoid duplication
			$errors = get_settings_errors();
			if( is_array( $errors ) ){
				foreach( $errors as $er ){
					if( is_array( $er ) ){
						if( $er['code'] == 'migration-notice' ){
							$add = false;
							break;
						}
					}
				}
			}
			if( $add ) add_settings_error( 'menu-migration' , 'migration-notice' , $notice , 'updated' );
		}
		else if( $migration_status == 'in_progress' ){
			$notice = __( 'Migration did not complete successfully' , 'ubermenu' );
			add_settings_error( 'menu-migration' , 'migration-notice-incomplete' , $notice , 'error' );
			update_option( UBERMENU_PREFIX.'migration_status' , false );
		}

	}
	//Migration not necessary, update flag so we don't bother checking again
	else{
		update_option( UBERMENU_PREFIX.'migration_status' , 'n/a' );
	}
}

add_action( 'admin_init' , 'ubermenu_migrate_settings' , 100 );
function ubermenu_migrate_settings(){
	
	if( isset( $_GET['page'] ) && $_GET['page'] == 'ubermenu-settings' ){

		if( !current_user_can( 'manage_options' ) ){
			die( 'You need to be an admin to do that' );
		}

		if( isset( $_GET['do'] ) && $_GET['do'] == 'migrate' ){

			update_option( UBERMENU_PREFIX.'migration_status' , 'in_progress' );
			
			//MENU SETTINGS
			ubermenu_migrate_menu_settings();
			
			//MENU ITEM SETTINGS
			ubermenu_migrate_item_settings();

			//set flag
			update_option( UBERMENU_PREFIX.'migration_status' , 'complete' );			

		}
	}

	
}

function ubermenu_migrate_item_settings(){

	if( isset( $_GET['migrate_menu_ids'] ) ){

		$menus = wp_get_nav_menus( array('orderby' => 'name') );
		$_defined_settings = ubermenu_menu_item_settings();

		//up( $_GET['migrate_menu_ids'] );

		$map = array(	//new => old
			'custom_content' 		=> 'menu-item-shortcode',
    		//'widget_area' => 'menu-item-sidebars',
    		'highlight'				=> 'menu-item-highlight',
    		'disable_text'			=> 'menu-item-notext',
    		'disable_link'			=> 'menu-item-nolink',
    		//'menu-item-isheader',
    		'clear_row'				=> 'menu-item-verticaldivision',
    		'new_column'			=> 'menu-item-newcol',
    		//'menu-item-isMega',
    		//'menu-item-alignSubmenu',
    		//'menu-item-floatRight',
    		//'menu-item-fullWidth',
    		//'submenu_column_default'=> 'menu-item-numCols',
    		'icon'					=> 'menu-item-icon',

    		//TODO
    		'condition_1' 			=> 'menu-item-condition',
    		'condition_parameter_1'	=> 'menu-item-condition_parameter',
    		
		);



		//Find the selected menus to migrate
		$menu_ids = $_GET['migrate_menu_ids'];

		//For each menu
		foreach( $menu_ids as $menu_id ){

			//Get the menu items
			$items = wp_get_nav_menu_items( $menu_id );
			
			//For each item
			foreach( $items as $item ){

				$top_level = false;
				if( $item->menu_item_parent === '0' ||
						$item->menu_item_parent === 0 ){
					$top_level = true;
				}

				//up( $item );
				
				//Find the old options
				$old_key = '_uber_options';
				$old_meta = get_post_meta( $item->ID , $old_key , true );

				//up( $old_meta );

				//Migrate options
				$new_meta = ubermenu_menu_item_setting_defaults(); // todo

				foreach( $map as $new_id => $old_id ){
					if( isset( $old_meta[$old_id] ) ){
						$new_meta[$new_id] = $old_meta[$old_id];
					}
				}
				
				//Special//
				
				

				//Header //'menu-item-isheader',
				if( isset( $old_meta['menu-item-isheader'] ) && ( $old_meta['menu-item-isheader'] == 'on' ) ){
					if( !$top_level ){
						$new_meta['item_display'] = 'header';
					}
				}

				//Submenu Type //'menu-item-isMega',
				if( isset( $old_meta['menu-item-isMega'] ) ){
					//Only for top level!!
					if( $top_level ){
						if( $old_meta['menu-item-isMega'] == 'on' ){
							$new_meta['submenu_type'] = 'mega';
						}
						else{
							$new_meta['submenu_type'] = 'flyout';
						}
					}
				}

				//Submenu Column Default 'submenu_column_default'=> 'menu-item-numCols',
				if( $top_level ){
					if( isset( $old_meta['menu-item-numCols'] ) ){
						$new_meta['submenu_column_default'] = '1-'.$old_meta['menu-item-numCols'];
					}
				}
				
				//Align Submenu  //submenu_position
					//Ignore flyout
					//'menu-item-fullWidth', //'menu-item-alignSubmenu',
				if( $top_level ){
					if( isset( $old_meta['menu-item-fullWidth'] ) && ( $old_meta['menu-item-fullWidth'] == 'on' ) ){
						$new_meta['submenu_position'] = 'full_width';
					}
					else if( isset( $old_meta['menu-item-alignSubmenu'] ) ){
						switch( $old_meta['menu-item-alignSubmenu'] ){
							case 'center':
								$new_meta['submenu_position'] = 'center';
								break;
							case 'left':
								$new_meta['submenu_position'] = 'left_edge_bar';
								break;
							case 'right':
								$new_meta['submenu_position'] = 'right_edge_bar';
								break;
							default:
								$new_meta['submenu_position'] = 'center';
								break;
						}
					}
				}


				//Item Alignment //'menu-item-floatRight',
				if( $top_level ){
					if( isset( $old_meta['menu-item-floatRight'] ) ){
						if( $old_meta['menu-item-floatRight'] == 'on' ){
							$new_meta['item_align'] = 'right';
						}
					}
				}


				//Featured Image
				$thumb_id = get_post_thumbnail_id( $item->ID );
				if( $thumb_id ){
					$new_meta['item_image'] = $thumb_id;
				}


				//Sidebars
				if( isset( $old_meta['menu-item-sidebars'] ) && $old_meta['menu-item-sidebars'] ){

					$sidebar_id = $old_meta['menu-item-sidebars'];
					if( $sidebar_id == 'wpmega-sidebar' ){
						$sidebar_id = 'ubermenu-sidebar-1';
					}
					else $sidebar_id = str_replace( 'wpmega-sidebar-' , 'ubermenu-sidebar-' , $sidebar_id );
					$new_meta['widget_area'] = $sidebar_id;

					//Widget areas are full width
					$new_meta['columns'] = 'full';
				}
				
				
				//Update options
				update_post_meta( $item->ID , UBERMENU_MENU_ITEM_META_KEY , $new_meta );

				//Run Callbacks
				foreach( $_defined_settings as $panel => $panel_settings ){
					foreach( $panel_settings as $_priority => $_setting ){
						if( isset( $_setting['on_save'] ) ){
							$callback = 'ubermenu_item_save_'.$_setting['on_save'];
							if( function_exists( $callback ) ){
								//echo "$callback( $item->ID );<br/>";
								$callback( $item->ID , $_setting , $new_meta[$_setting['id']] , $new_meta );
							}
						}
					}
				}

				do_action( 'ubermenu_after_menu_item_save' );


			}

			//$m = $menus[$menu_id];
			foreach( $menus as $m ){
				if( $m->term_id == $menu_id ){
					$notice = __( 'Successfully migrated Menu Item Settings for Menu: ' , 'ubermenu' ) . $m->name;
					add_settings_error( 'menu-migration' , 'migration-notice-item-complete-'.$menu_id , $notice , 'updated' );
				}
			}

		}

		//up( $items , 2 );
	}

}

function ubermenu_migrate_menu_settings(){


	if( !isset( $_GET['migrate_control_panel'] ) || $_GET['migrate_control_panel'] != 'on' ){
		//Don't migrate control panel
		return;
	}


	

	$main_ops = ubermenu_get_instance_options( 'main' );
	$gen_ops = get_option( UBERMENU_PREFIX.'general' );

	//up( $main_ops , 2 );
	//up( $gen_ops , 2 );



	//Check for old settings
	$old_ops = get_option( 'wp-mega-menu-settings' , false ); // 'sparkops_ubermenu' );
	
	//Settings Don't Exist 
	if( !$old_ops ){
		//TODO: MSG: No Settings to migrate
		return;
	}

	
	
	//Settings Exist -> CONFIRM: This will overwrite existing settings, are you sure you wish to proceed?
	//This will merge your UberMenu 2 settings into UberMenu3, giving precedence to UberMenu 2 settings


	//Get NEW settings
	//Keep in mind Extensions - Sticky, Icons || [Not:Flat, Conditionals]
	//$new_fields = ubermenu_get_settings_fields();
	//up( $new_fields  , 2 );

	//echo 'main:';
	$config_id = 'main';
	$instance_ops = ubermenu_get_instance_options( $config_id );
	//up( $main_ops );

	//echo 'gen:';
	$gen_ops = ubermenu_get_instance_options( 'general' ); //get_option( UBERMENU_PREFIX.'general' );
	//up( $gen_ops );




	//Create a SIMPLE MIGRATE array where values are just copied 1:1


	/////////////////////
	// MENU INSTANCE
	/////////////////////

	$map_instance = array(	//NEW => OLD

		//Instance
		
		'skin'						=> 'wpmega-style-preset',
		'orientation'				=> 'wpmega-orientation',
		'vertical_submenu_width'	=> 'vertical-submenu-w',
		//'trigger'					=> ''
		'transition'				=> 'wpmega-transition',
		//'transition_duration'		=> 'wpmega-animation-time',
		'bar_width'					=> 'wpmega-container-w',
		'bar_inner_center'			=> 'center-inner-menu',
		'bar_inner_width'			=> 'inner-menu-width',
		'descriptions_top_level'	=> 'wpmega-description-0',
		'descriptions_headers'		=> 'wpmega-description-1',
		'descriptions_normal'		=> 'wpmega-description-2',
		'image_title_attribute'		=> 'wpmega-disable-img-tooltips',
		'responsive'				=> 'responsive-menu',
		'responsive_toggle'			=> 'responsive-menu-toggle',
		'responsive_toggle_content'	=> 'responsive-menu-toggle-text',
		'responsive_collapse'		=> 'responsive-menu-toggle',
		'allow_shortcodes_in_labels'=> 'title-shortcodes',
		'theme_location_instance'	=> 'theme-loc-instance',


		//ICONS
		'icon_top_level_color'		=> 'umicons-color' ,
		'icon_top_level_color_hover'=> 'umicons-color-hover',
		'icon_top_level_size'		=> 'umicons-font-size',
		//icon_top_level_position is custom
		'icon_top_level_padding_v'	=> 'umicons-padding-vertical',
		'icon_top_level_padding_h'	=> 'umicons-padding-horizontal',

		'icon_header_color'			=> 'umicons-color-2' ,
		'icon_header_color_hover'	=> 'umicons-color-hover-2',
		'icon_header_size'			=> 'umicons-font-size-2',
		'icon_header_padding_v'		=> 'umicons-padding-vertical-2',
		'icon_header_padding_h'		=> 'umicons-padding-horizontal-2',

		'icon_normal_color'			=> 'umicons-color-3',
		'icon_normal_color_hover'	=> 'umicons-color-hover-3',
		'icon_normal_size'			=> 'umicons-font-size-3',
		'icon_normal_padding_v'		=> 'umicons-padding-vertical-3',
		'icon_normal_padding_h'		=> 'umicons-padding-horizontal-3',



		//STICKY
		'sticky_offset'				=> 'ubersticky-top-spacing',
		'sticky_full_width'			=> 'ubersticky-expand-menu-bar',
		'sticky_clearfix'			=> 'ubersticky-clear',
		'sticky_center_inner_width'	=> 'ubersticky-center-inner',
		//sticky_background_color'	=> 'ubersticky-background-color', //Style Gen
		'sticky_mobile'				=> 'ubersticky-mobile',
		'sticky_permanent'			=> 'ubersticky-permanent',
		'sticky_apply_to'			=> 'ubersticky-apply-to',
	);

	//Could Filter to allow flexibility

	foreach( $map_instance as $new_id => $old_id ){
		if( isset( $old_ops[$old_id] ) ){
			$instance_ops[$new_id] = $old_ops[$old_id];
		}
	}


	//Handle more complex settings for Instance

	//Theme Location Activation
	$active = get_option( 'wp-mega-menu-nav-locations' , array() );
	if( is_array( $active ) ){
		$instance_ops['auto_theme_location'] = array();
		foreach( $active as $loc ){
			$instance_ops['auto_theme_location'][$loc] = $loc;
		}
	}

	//Trigger (hover_intent is different)
	if( isset( $old_ops['wpmega-trigger'] ) ){
		if( $old_ops['wpmega-trigger'] == 'hoverIntent'){
			$instance_ops['trigger'] = 'hover_intent';
		}
		else{
			$instance_ops['trigger'] = $old_ops['wpmega-trigger'];
		}
	}

	//Transition duration (ms to s)  'transition_duration'		=> 'wpmega-animation-time',
	if( isset( $old_ops['wpmega-animation-time'] ) ){
		if( is_numeric( $old_ops['wpmega-animation-time'] ) ){
			$instance_ops['transition_duration'] = $old_ops['wpmega-animation-time'].'ms';
		}
	}
	
	//Menu Bar Alignment - bar_align (center-menubar, wpmega-menubar-full)
	if( isset( $old_ops['wpmega-menubar-full'] ) && ( $old_ops['wpmega-menubar-full'] == 'on' ) ){
		//Align Full Width
		$instance_ops['bar_align'] = 'full';
	}
	else if( isset( $old_ops['center-menubar'] ) && ( $old_ops['center-menubar'] == 'on' ) ) {
		//Align Center
		$instance_ops['bar_align'] = 'center';
	}

	//Center Menu Items
	if( isset( $old_ops['center-menuitems'] ) && ( $old_ops['center-menuitems'] == 'on' ) ){
		$instance_ops['items_align'] = 'center';
	}

	//Image Sizing - 'image_width' - 'wpmega-image-width' (only set if wpmega-resizeimages == 'on' )
	if( isset( $old_ops['wpmega-resizeimages'] ) && ( $old_ops['wpmega-resizeimages'] == 'on' ) ){
		if( isset( $old_ops['wpmega-image-width'] ) && $old_ops['wpmega-image-width'] ){
			$instance_ops['image_width'] = $old_ops['wpmega-image-width'];
		}
		if( isset( $old_ops['wpmega-image-height'] ) && $old_ops['wpmega-image-height'] ){
			$instance_ops['image_height'] = $old_ops['wpmega-image-height'];
		}
	}
	

	//HTML5 Nav Tag 'container_tag' => wpmega-html5
	if( isset( $old_ops['wpmega-html5'] ) ){
		if( $old_ops['wpmega-html5'] == 'on' ){
			$instance_ops['container_tag'] = 'nav';
		}
		else{
			$instance_ops['container_tag'] = 'div';
		}
	}

	//Icons Extension
	if( isset( $old_ops['umicons-position'] ) ){
		$instance_ops['icon_top_level_position'] = 'icon_'.$old_ops['umicons-position'];
		$instance_ops['icon_header_position'] = 'icon_'.$old_ops['umicons-position-2'];
		$instance_ops['icon_normal_position'] = 'icon_'.$old_ops['umicons-position-3'];
	}


	//Sticky Extension
	$instance_ops['sticky_enabled'] = 'on';


	//If Style Generator, map styles -- 'wpmega-style' = 'inline'
	if( /*true || */ $old_ops['wpmega-style'] == 'inline' ){
		

		//NON COLOR SETTINGS
		$style_map = array(	//new => old
			
			'style_menu_bar_radius' 					=> 'menu-bar-border-radius',
			'style_top_level_font_size' 				=> 'top-level-item-font-size',
			'style_top_level_text_transform' 			=> 'top-level-text-transform',
			'style_top_level_font_weight' 				=> 'top-level-text-weight',
			
			//'style_top_level_font_color_highlight' 	=> '',
			
			//'style_top_level_background_current' 		=> '',
			//'style_top_level_background_highlight' 	=> '',
			
			'style_top_level_item_glow_opacity' 		=> 'top-level-item-glow-opacity',
			'style_top_level_item_glow_opacity_hover' 	=> 'top-level-item-glow-opacity-hover',
			'style_top_level_padding' 					=> 'top-level-item-padding-y',
			'style_top_level_horiz_padding' 			=> 'top-level-item-padding-x',
			'style_extra_submenu_indicator_padding'		=>	'on',
			//'style_align_submenu_indicator' 			=> '',
			//'style_top_level_item_height' 				=> '',
			
			'style_submenu_minimum_column_width' 		=> 'sub-level-column-width',
			
			//'style_submenu_item_padding' 				=> '',
			'style_header_font_size' 					=> 'sub-level-header-font-size',
			
			//'style_header_font_color_current' 			=> '',
			'style_header_font_weight' 					=> 'sub-level-header-font-weight',
			
			//'display_header_border_color'				=> 'on',
			
			//'style_normal_font_color_current' 			=> '',
			'style_normal_font_size' 					=> 'sub-level-link-font-size',
			
			'style_description_font_size' 				=> 'menu-description-size',
			
			'style_description_text_transform' 			=> 'description-transform',
			
			//'style_hr' 									=> '',
			//'style_toggle_background' 					=> '',
			//'style_toggle_color' 						=> '',
			//'style_toggle_background_hover' 			=> '',
			//'style_toggle_color_hover' 					=> '',
		);


		foreach( $style_map as $new_id => $old_id ){
			if( isset( $old_ops[$old_id] ) ){
				$val = $old_ops[$old_id];
				$instance_ops[$new_id] = $val;
			}
		}


		//COLOR SETTINGS
		$style_map_colors = array(
			'style_menu_bar_background' 				=> array( 'menu-bar-background', 'menu-bar-background-color2' ),
			'style_menu_bar_border' 					=> 'menu-bar-border-color',

			'style_top_level_font_color' 				=> 'top-level-item-font-color',
			'style_top_level_font_color_hover' 			=> 'top-level-item-font-color-hover',
			'style_top_level_font_color_current' 		=> 'top-level-item-font-color-current',

			'style_top_level_background_hover' 			=> array( 'top-level-item-background-hover', 'top-level-item-background-hover-color2' ),

			'style_top_level_item_divider_color' 		=> 'top-level-item-border',

			'style_submenu_background_color' 			=> 'sub-level-background',
			'style_submenu_border_color' 				=> 'sub-menu-border',
			'style_submenu_fallback_font_color' 		=> 'sub-level-item-font-color',

			'style_submenu_highlight_font_color' 		=> 'sub-level-highlight-color',

			'style_header_font_color' 					=> 'sub-level-header-font-color',
			'style_header_font_color_hover' 			=> 'sub-level-header-font-color-hover',

			'style_header_border_color' 				=> 'sub-level-header-border-color',

			'style_normal_font_color' 					=> 'sub-level-link-font-color',
			'style_normal_font_color_hover' 			=> 'sub-level-link-font-color-hover',

			'style_normal_background_hover' 			=> 'sub-level-link-background-hover',

			'style_description_font_color' 				=> 'menu-description-color',

			'style_top_level_arrow_color' 				=> 'top-level-arrow-color',
			'style_submenu_arrow_color' 				=> 'sub-level-arrow-color',
			'style_search_color'						=> 'search-submit-text-color',
			'style_search_placeholder_color'			=> 'search-submit-text-color',
			'style_search_icon_color'					=> 'search-submit-text-color',
			'style_search_background'					=> 'search-text-background',

			//Sticky
			'sticky_background_color'					=> 'ubersticky-background-color',

		);

		foreach( $style_map_colors as $new_id => $old_id ){

			//Color Gradient, concatenate if necessary
			if( is_array( $old_id ) ){
				$color0 = $color1 = false;
				if( isset( $old_id[0] ) ){
					if( isset( $old_ops[$old_id[0]] ) ){
						$color0 = $old_ops[$old_id[0]];
					}
				}
				if( isset( $old_id[1] ) ){
					if( isset( $old_ops[$old_id[1]] ) ){
						$color1 = $old_ops[$old_id[1]];
					}
				}

				if( $color0[0] != '#' ){
					$color0 = '#'.$color0;
				}

				$color = $color0;
				if( $color1 ){
					if( $color1[0] != '#' ){
						$color1 = '#'.$color1;
					}
					$color.= ','.$color1;
				}
				$instance_ops[$new_id] = $color;
			}
			//Non-gradient
			else{
				if( isset( $old_ops[$old_id] ) ){

					$val = $old_ops[$old_id];

					//It's a color/hex val
					if( strlen( $val ) == 6 ){
						$color = $val;
						if( $color[0] != '#' ){
							$color = '#'.$color;
						}
						$instance_ops[$new_id] = $color;
					}
					//Not a color
					else{
						$instance_ops[$new_id] = $val;
					}
				}
			}
		}

	}

	update_option( UBERMENU_PREFIX.$config_id , $instance_ops );
	ubermenu_save_all_menu_styles();
	
	
	/////////////////////
	// GENERAL SETTINGS
	/////////////////////

	$map_general = array(
		'custom_tweaks'				=> 'wpmega-css-tweaks',
		'load_custom_js'			=> 'custom-js',
		'load_ubermenu_css'			=> 'include-basic-css',
		'load_fontawesome'			=> 'umicons-load-fontawesome',
		'load_google_maps'			=> 'load-google-maps',
		'num_widget_areas'			=> 'wpmega-sidebars',
		'widget_area_names'			=> 'sidebar-names',
		'allow_top_level_widgets'	=> 'wpmega-top-level-widgets',
		'reposition_on_load'		=> 'reposition-on-load',
		'intent_delay'				=> 'wpmega-hover-timeout',
		'intent_interval'			=> 'wpmega-hover-interval',
		'remove_conflicts'			=> 'wpmega-remove-conflicts',
		'strict_mode'				=> 'wpmega-strict',
		'ubermenu_theme_location'	=> 'wpmega-easyintegrate',

		//Sticky
		'sticky_toolbar_footer' 	=> 'ubersticky-wpadmin-bottom',
		'sticky_disable_css'		=> 'ubersticky-disable-css',
	);

	foreach( $map_general as $new_id => $old_id ){
		if( isset( $old_ops[$old_id] ) ){
			$gen_ops[$new_id] = $old_ops[$old_id];
		}
	}

	//Handle more complex settings
	
		//GENERAL
			//'load_custom_css'			'wpmega-style' = custom

	if( isset( $old_ops['wpmega-style'] ) ){
		if( $old_ops['wpmega-style'] == 'custom' ){
			$gen_ops['load_custom_css'] = 'on';	//Load custom CSS
			//$gen_ops['skin'] = 'none';		//Disable skin
		}
	}

	update_option( UBERMENU_PREFIX.'general' , $gen_ops );
	
	//Regenerate Style Settings
	//ubermenu_generate_custom_styles();
	delete_transient( UBERMENU_GENERATED_STYLE_TRANSIENT );

	$notice = __( 'Successfully migrated Control Panel Menu Settings' , 'ubermenu' );
	add_settings_error( 'menu-migration' , 'migration-notice-menu-complete' , $notice , 'updated' );


}
//add_action( 'wp_head' , 'ubermenu_migrate_menu_settings' );
//ubermenu_migrate_menu_settings();