<?php
	
	/*
	*
	*	Theme Colour Scheme Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*/
	
	// create an array to contain current values in the theme customizer
	$sf_customize_items = array(
		'accent_color',
		'accent_alt_color',
		'secondary_accent_color',
		'secondary_accent_alt_color',
		'page_bg_color',
		'inner_page_bg_transparent',
		'inner_page_bg_color',
		'section_divide_color',
		'alt_bg_color',
		'topbar_bg_color',
		'topbar_text_color',
		'topbar_link_color',
		'topbar_link_hover_color',
		'topbar_divider_color',
		'header_bg_color',
		'header_bg_transparent',
		'header_border_color',
		'header_text_color',
		'header_link_color',
		'header_link_hover_color',
		'header_divider_style',
		'mobile_menu_bg_color',
		'mobile_menu_divider_color',
		'mobile_menu_text_color',
		'mobile_menu_link_color',
		'mobile_menu_link_hover_color',
		'slideout_menu_bg_color',
		'slideout_menu_link_color',
		'slideout_menu_link_hover_color',
		'slideout_menu_divider_color',
		'newsletter_bar_bg_color',
		'newsletter_bar_text_color',
		'newsletter_bar_link_hover_color',
		'nav_hover_style',
		'nav_bg_color',
		'nav_hover_style',
		'nav_text_color',	
		'nav_bg_hover_color',	
		'nav_text_hover_color',
		'nav_selected_bg_color',
		'nav_selected_text_color',	
		'nav_sm_bg_color',	
		'nav_sm_text_color',
		'nav_sm_bg_hover_color',	
		'nav_sm_text_hover_color',	
		'nav_sm_selected_text_color',	
		'nav_divider',	
		'nav_divider_color',
		'overlay_menu_bg_color',
		'overlay_menu_link_color',
		'overlay_menu_link_hover_color',
		'overlay_menu_link_hover_bg_color',
		'promo_bar_bg_color',
		'promo_bar_text_color',
		'breadcrumb_bg_color',
		'breadcrumb_text_color',
		'breadcrumb_link_color',
		'page_heading_bg_color',
		'page_heading_text_color',
		'page_heading_text_align',
		'body_color',
		'body_alt_color',	
		'link_color',
		'link_hover_color',
		'h1_color',
		'h2_color',
		'h3_color',
		'h4_color',
		'h5_color',
		'h6_color',
		'overlay_bg_color',
		'overlay_text_color',
		'article_review_bar_alt_color',
		'article_review_bar_color',
		'article_review_bar_text_color',
		'article_extras_bg_color',
		'article_np_bg_color',
		'article_np_text_color',
		'input_bg_color',
		'input_text_color',
		'sale_tag_color',
		'new_tag_color',
		'oos_tag_color',
		'icon_container_bg_color',		
		'sf_icon_color',
		'icon_container_hover_bg_color',
		'sf_icon_alt_color',
		'share_button_bg',
		'share_button_text',
		'bold_rp_bg',
		'bold_rp_text',
		'bold_rp_hover_bg',
		'bold_rp_hover_text',
		'tweet_slider_bg',
		'tweet_slider_text',
		'tweet_slider_link',
		'tweet_slider_link_hover',
		'footer_bg_color',		
		'footer_text_color',		
		'footer_link_color',		
		'footer_link_hover_color',		
		'footer_border_color',				
		'copyright_bg_color',		
		'copyright_text_color',			
		'copyright_link_color',
		'copyright_link_hover_color',
		);	
					
	$sf_customize_item_array = array();	
	
	foreach ($sf_customize_items as $option) {
		$sf_customize_item_array[] = array($option => str_replace('_', ' ', $option));
	}			

	function sf_get_current_color_scheme_id() {
			
		$sf_atelier_options = get_option ( 'sf_atelier_options' );
		
		if ( isset( $sf_atelier_options['colour_scheme_select_scheme'] ) ) {
			return $sf_atelier_options['colour_scheme_select_scheme'];
		} else {
			return 0;
		}
		
	}
	
	function sf_get_schema_info($schema_id) {
	
		global $sf_customize_item_array;
		
		if ( $schema_id ) {
		
			$schemas = get_option ( 'sf_atelier_options_schemes_saved' );
			
			if ($schemas) {
				foreach ($schemas as $schema) {
					if ( $schema['color_scheme_name'] == $schema_id ) { // found the right schema
						return $schema;
					}
				}
			} // schemas
			
			
		}
		
	}
				
	function sf_get_color_scheme_list( $extra = true ) {

		$schemas = get_option ( 'sf_atelier_options_schemes_saved' );
		
		$dropdown_values = array();
		
		if ($schemas) {
			foreach ($schemas as $schema) {
				if ( isset($schema['color_scheme_name']) ) {
					$dropdown_values[$schema['color_scheme_name']] = $schema['color_scheme_name'];
				}
			}
		}
		
		if ( !empty($dropdown_values) ) {
		
			asort($dropdown_values); // sort by ABC
			
		}
		
		if ( $extra ) { 
		
			$dropdown_values = array('default' => '--- Current Values ---') + $dropdown_values; 
//			$dropdown_values = array('' => '') + $dropdown_values; 
			
		}
		
								
		return $dropdown_values;

	}
	
	function sf_add_schema($schema_array = array()) {
			
		global $sf_customize_item_array;
				
		$newSchema = array();
				
		if (!empty($schema_array)) {
			
			foreach ($schema_array as $schema ) {
								
				if (strtolower($schema['Setting Name']) == "color scheme name") {
									
					if ( isset($schema['Setting Value'])) { 
						
						$newSchema['color_scheme_name'] = $schema['Setting Value'];
					
						$newSchemaName = $schema['Setting Value'];

					}
					
				} else {
					
					// cycle throught the items
					
					foreach ( $sf_customize_item_array as $sf_customize_id => $sf_customize_data ) {
											
						if ( $schema['Setting Name'] == key($sf_customize_data) && isset($schema['Setting Value']) ) {
							
							$newSchema[key($sf_customize_data)] = $schema['Setting Value'];	
							
						}
						
					}
					
				}	
								
			}
			
		$schemas = get_option ( 'sf_atelier_options_schemes_saved' ); // get list of schemas
				
		if ( $newSchema && !empty($newSchema) ) {
		
			$schemas[$newSchemaName] = $newSchema; // add new schema that list
		
		}
		
		update_option ( 'sf_atelier_options_schemes_saved', $schemas );
					
		}
		
	} // sf_add_schema
	
	function sf_delete_schema_ajax() {
		
		$schema_id = $_REQUEST['schema_id'];
		
		if ( $schema_id ) {
			
			$schemas = get_option ( 'sf_atelier_options_schemes_saved' ); // get list of schemas
			
			if ( isset ( $schemas[$schema_id] ) ) {
			
				unset ( $schemas[$schema_id] );
				
				update_option ( 'sf_atelier_options_schemes_saved', $schemas );
			
				echo "success";
				
			} else {
				
				echo "failed";
			}
			
			
		} else {
			
			echo "failed";
			
		}
		
		die();
		
	}
	add_action("wp_ajax_sf_delete_schema_ajax", "sf_delete_schema_ajax");
	add_action("wp_ajax_nopriv_sf_delete_schema_ajax", "sf_delete_schema_ajax");
	
	
	function sf_add_schema_ajax() {
				
		$file_url = $_REQUEST['file_url'];
		$file_id = $_REQUEST['file_id'];
				
		if ($file_id) {
		
			$url = wp_get_attachment_url( $file_id );
			$uploads = wp_upload_dir();
			$file_path = str_replace( $uploads['baseurl'], $uploads['basedir'], $url );
			
			require_once (SF_INCLUDES_PATH . '/sf-colour-scheme/File_CSV_DataSource/DataSource.php');	
			
		    $time_start = microtime(true);
		    $csv = new File_CSV_DataSource;

		    sf_stripBOM($file_path);
		    		
		    if (!$csv->load($file_path)) {
		        echo 'Failed to load file, aborting.';
		        // $this->print_messages();
		        die();
		    }
		    
			$skipped = 0;
			$csv_array = array();
						
			foreach ($csv->connect() as $csv_data) {
			    $csv_array[] = $csv_data;
			}
	
			// add new schema from csv data
			
			sf_add_schema ( $csv_array );
			
			// return back a list of schemes to populate the select box via ajax
			
			echo sf_get_schema_select_html();
			
			die();
						
		}
		
		die();
		
	}
	add_action("wp_ajax_sf_add_schema_ajax", "sf_add_schema_ajax");
	add_action("wp_ajax_nopriv_sf_add_schema_ajax", "sf_add_schema_ajax");
	
	
	function sf_use_schema_ajax() {
	
		global $sf_customize_item_array;
		
		$schema_id = $_REQUEST['schema_id'];
		
		if ( $schema_id ) {
		
			$schema_info = sf_get_schema_info ( $schema_id );
			
//			if ( !empty($schema_info) ) {
//			
//				foreach ($schema_info as $key => $value) {
//													
//					// don't update or add the name, or any element not in the official array
//										
//					foreach ( $sf_customize_item_array as $item) {
//						
//						if ( isset($item[$key]) ) {
//													
//							update_option ( $key , $value );
//							$success = true;
//							
//						}
//					}
//
//					
//				}
//				
//				if ( $success) { echo "success"; }
//				
//			}

			if ( !empty($schema_info) ) {
				
				update_option( 'sf_customizer', $schema_info);
				
				echo "success";
			}
			
//			print_r ($schema_info);
						
			
		} else {
			
			echo "failed";
			
		}
		
		die();
		
	}
	add_action("wp_ajax_sf_use_schema_ajax", "sf_use_schema_ajax");
	add_action("wp_ajax_nopriv_sf_use_schema_ajax", "sf_use_schema_ajax");
	
	
	function sf_save_schema_ajax() {
	
		global $sf_customize_item_array;
		
		$schema_name = esc_url( $_REQUEST['schema_name'] );
		$new_schema = array();
		
		if ( $schema_name ) {
			
			// ok, so let's loop through all the saved values and add them to an array
			
			$new_schema['color_scheme_name'] = $schema_name;
			
			foreach ( $sf_customize_item_array as $item) {
			
				$new_schema[key($item)] = sf_get_option ( key($item) );
			
			}
			
//			print_r ($new_schema);
			
			// let's save this array, similar to importing
			
			$schemas = get_option ( 'sf_atelier_options_schemes_saved' ); // get list of schemas
			
//			print_r ($schemas);
					
			$schemas[$schema_name] = $new_schema; // add new schema that list
			
//			print_r ($schemas); exit;
			
			update_option ( 'sf_atelier_options_schemes_saved', $schemas );
			
			// return back a list of schemes to populate the select box via ajax
			
			echo sf_get_schema_select_html();
			
		}
		
		
		die();
	}
	add_action("wp_ajax_sf_save_schema_ajax", "sf_save_schema_ajax");
	add_action("wp_ajax_nopriv_sf_save_schema_ajax", "sf_save_schema_ajax");
	
	
	
    // delete BOM from UTF-8 file
    function sf_stripBOM($fname) {
    
        $res = fopen($fname, 'rb');
        
        if (false !== $res) {
        
            $bytes = fread($res, 3);
            
            if ($bytes == pack('CCC', 0xef, 0xbb, 0xbf)) {
                $this->log['notice'][] = 'Getting rid of byte order mark...';
                fclose($res);

                $contents = file_get_contents($fname);
                if (false === $contents) {
                    trigger_error('Failed to get file contents.', E_USER_WARNING);
                }
                $contents = substr($contents, 3);
                $success = file_put_contents($fname, $contents);
                if (false === $success) {
                    trigger_error('Failed to put file contents.', E_USER_WARNING);
                }
            } else {
                fclose($res);
            }
            
        } else {
        
            $this->log['error'][] = 'Failed to open file, aborting.';
            
        }
        
    }
    
	
	function sf_get_schema_select_html() {

		global $sf_customize_item_array;
				
		$schemas_array = get_option ( 'sf_atelier_options_schemes_saved' );
		
		$html = '<select name="sf_atelier_options[colour_scheme_select_scheme]" id="colour_scheme_select_scheme"> ';
		
		$dropdown_values = sf_get_color_scheme_list();
		
		foreach  ( $dropdown_values as $dropdown_key => $dropdown_value ) {
		
			$html .= '<option value="'.$dropdown_key.'">'.$dropdown_value.'</option>';
			
		}
		
		$html .= '</select>';
				
		return $html;
		
	} // sf_get_schema_select_html
	
	
	function sf_get_schema_html_ajax() {
		
		$schema_id = $_POST['schema_id'];
		
		$html = sf_get_current_color_scheme_html_preview ( $schema_id );
		
		echo esc_html($html);
		
		die();
		
	}
	add_action("wp_ajax_sf_get_schema_html_ajax", "sf_get_schema_html_ajax");
	add_action("wp_ajax_nopriv_sf_get_schema_html_ajax", "sf_get_schema_html_ajax");
	
	
	function sf_is_current_color_settings_empty () {

		global $sf_customize_item_array;	
		
		$values = 0;
		
		if (!empty($sf_customize_item_array)) {
			foreach ( $sf_customize_item_array as $setting ) {
			
				if ( sf_get_option(key($setting)) ) {
							
					$values++;
				
				}
			
		    }
	    }
	    
	    if ( $values == 0) {
		    
		    return true;
		    
	    } else {
		    
		    return false;
	    }
		
	}
	
	
	function sf_get_current_color_scheme_html_preview( $schema_id = false ) {
	
		global $sf_customize_item_array;
		
//		echo "++++".$schema_id;
				
		if ( !$schema_id ) {
			$schema_id = sf_get_current_color_scheme_id();
		}
		
		if ($schema_id == "default") {
			$schema_id = "0";
		}
				
		$schemas_array = get_option ( 'sf_atelier_options_schemes_saved' );
			
		$html = "<ul id=\"sf_atelier_options-color-list\" class=\"color-list\">";
				
		if ( !$schema_id || $schema_id == "0" || !$schemas_array ) {
				
			// a scheme has not been selected, so we take from current values
			$values = 0;
			
			
					
			if (!empty($sf_customize_item_array)) {
				foreach ( $sf_customize_item_array as $setting ) {
				
					if ( sf_get_option(key($setting)) ) {
								
					$html .= '<li style="width: 80px; line-height: 11px; text-align: center; float: left; margin: 5px; height: 95px; ">';
													
					$html .= '<div style="width: 70px; height: 40px; margin: 0 auto 10px auto; background-color:'.sf_get_option(key($setting)).';border:1px solid #e3e3e3;"></div>';
					
					$html .= '<label style="font-size: 10px; text-align: center;">'.reset($setting).'</label>';
					
					$html .= '</li>';
					
					$values++;
					
					}
				
			    }
		    }
		    
		    if ( $values == 0) {
			    
			    $html .= '<li><strong>'.__('No saved values exist yet', 'swiftframework').'</strong><br/>'.__('Go to the theme customizer to save your colour options.', 'swiftframework').'</li>';
			    
		    }

	    } else {
	    
			//echo sf_get_current_color_scheme_id();
		
			foreach ($schemas_array as $key => $schema) {
															
				if ( $key == $schema_id ) {
									
					foreach ( $sf_customize_item_array as $setting ) {

						$html .= '<li style="width: 80px; line-height: 11px; text-align: center; float: left; margin: 5px;  height: 95px; ">';
						if (isset($schema[key($setting)])) {							
						$html .= '<div style="width: 70px; height: 40px; margin: 0 auto 10px auto; background-color:'.$schema[key($setting)].';border:1px solid #e3e3e3;"></div>';
						}
						$html .= '<label style="font-size: 10px; text-align: center;">'.reset($setting).'</label>';
						
						$html .= '</li>';
						
					}
					
				}
				
			}

		}
		
		$html .= "</ul>";

		
		if (!empty($html)) { return $html; }
		
		
	}
	
	function sf_export_color_scheme_html() {
		
		global $sf_customize_item_array;
		
		$html = '<p><input type="text" maxlength="20" name="sf-export-scheme-name" id="sf-export-scheme-name" placeholder="Name The Schema" />';
		
		$export_link = sf_create_export_download_link('url');
		
		$html .= '<a class="button-primary" id="sf-export-scheme-dl" href="'.$export_link.'">Download CSV</a></p>';
		
		return $html;
		
	}
	
	function sf_download_file($content = null, $file_name = null) {
	
		global $sf_customize_item_array;
	
	    if (! wp_verify_nonce($_REQUEST['nonce'], 'sf_atelier_options_schema_action') ) 
	        wp_die('Security check'); 
	
	    // here you get the options to export and set it as content, ex:
	    
	    // Establish color scheme name and filename
	    
	    if ( isset($_REQUEST['file_name']) ) {
		    $file_name = $_REQUEST['file_name'].'.csv';
		    $scheme_name = $_REQUEST['file_name'];
		} else {
		    $file_name = 'schema.csv';			
		    $scheme_name = "schema";
		}
		
	    $content = "Setting Name,Setting Value"."\r\n";
	    $content .= "Color Scheme Name,".$scheme_name."\r\n";
	    
		foreach ( $sf_customize_item_array as $item ) {
			$key = key($item);
		    $exportable_options[$key] = sf_get_option( $key );
	    }
	    	    
	    foreach ( $exportable_options as $option_label => $option_value ) {
		    
		    $content .= $option_label.",".$option_value."\r\n";
		    
	    }
		
	    header('HTTP/1.1 200 OK');
	
	    if ( !current_user_can('edit_theme_options') ) {
	        wp_die('<p>'.__('You do not have sufficient permissions to edit templates for this site.').'</p>');
	    }
	    if ($content === null || $file_name === null){
	        wp_die('<p>'.__('Error Downloading file.').'</p>');     
	    }
	    
		$sf_atelier_options = get_option ( 'sf_atelier_options' );
	    	    
	    $fsize = strlen($content);
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header('Content-Description: File Transfer');
	    header("Content-Disposition: attachment; filename=" . $file_name);
	    header("Content-Length: ".$fsize);
	    header("Expires: 0");
	    header("Pragma: public");
	    echo $content;
	    exit;
	    
	}


	function sf_create_export_download_link($echo = false){
	    $site_url = home_url();
	    $args = array(
	        'sf_atelier_options_schema_action' => 'export_schema',
	        'nonce' => wp_create_nonce('sf_atelier_options_schema_action')
	    );
	    $export_url = esc_url(add_query_arg($args, $site_url));
	    if ($echo === true)
	        echo esc_url($export_url);
	    elseif ($echo == 'url')
	        return $export_url;
	}

	
	function sf_add_query_var_vars() {
	    global $wp;
	    $wp->add_query_var('sf_atelier_options_schema_action');
	}
	
	//then add a template redirect which looks for that query var and if found calls the download function

	function sf_admin_redirect_download_files(){
	    global $wp;
	    global $wp_query;
	    //download theme export
	    if (array_key_exists('sf_atelier_options_schema_action', $wp->query_vars) && $wp->query_vars['sf_atelier_options_schema_action'] == 'export_schema') {
	        sf_download_file();
	        die();
	    } else if (array_key_exists('sf_atelier_options_schema_action', $wp->query_vars) && $wp->query_vars['sf_atelier_options_schema_action'] == 'import_scheme') {
	    	// db_import_scheme();
	    	die();
	    }
	}
	
	
	//add hooks for these functions
	
	add_action('template_redirect', 'sf_admin_redirect_download_files');
	add_filter('init', 'sf_add_query_var_vars');	

