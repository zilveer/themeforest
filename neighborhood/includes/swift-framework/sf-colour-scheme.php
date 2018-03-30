<?php
	
	/*
	*
	*	Theme Colour Scheme Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	// create an array to contain current values in the theme customizer
	
	$sf_customize_item_array = array(
		'accent_color',
		'accent_alt_color',
		'secondary_accent_color',
		'secondary_accent_alt_color',
		'page_bg_color',
		'inner_page_bg_color',
		'section_divide_color',
		'alt_bg_color',
		'topbar_bg_color',
		'topbar_text_color',
		'topbar_link_color',
		'topbar_link_hover_color',
		'topbar_divider_color',
		'header_bg_color1',
		'header_bg_color2',	
		'nav_text_color',	
		'nav_text_hover_color',	
		'nav_selected_text_color',	
		'nav_pointer_color',	
		'nav_sm_bg_color',	
		'nav_sm_text_color',
		'nav_sm_bg_hover_color',	
		'nav_sm_text_hover_color',	
		'nav_sm_selected_text_color',	
		'nav_divider',	
		'nav_divider_color',
		'promo_bar_bg_color',
		'promo_bar_text_color',
		'page_heading_bg_color',	
		'page_heading_text_color',	
		'breadcrumb_text_color',	
		'breadcrumb_link_color',	
		'body_color',	
		'link_color',	
		'h1_color',
		'h2_color',
		'h3_color',
		'h4_color',
		'h5_color',
		'h6_color',
		'impact_text_color',
		'pt_primary_bg_color',		
		'pt_secondary_bg_color',		
		'pt_tertiary_bg_color',		
		'lpt_primary_row_color',		
		'lpt_secondary_row_color',		
		'lpt_default_pricing_header',		
		'lpt_default_package_header',			
		'lpt_default_footer',		
		'icon_container_bg_color',		
		'sf_icon_color',		
		'boxed_content_color',		
		'footer_bg_color',		
		'footer_text_color',		
		'footer_border_color',				
		'copyright_bg_color',		
		'copyright_text_color',			
		'copyright_link_color'
		);	
		
	
	
	$sf_customize_item_array = array(
			array ( 'accent_color' => 'Accent Color' ),
			array ( 'accent_alt_color' => 'Accent Alt Color' ),
			array ( 'secondary_accent_color' => 'Secondary Accent Color' ),
			array ( 'secondary_accent_alt_color' => 'Secondary Accent Alt Color' ),
			array ( 'page_bg_color' => 'Page Background Color' ),
			array ( 'inner_page_bg_color' => 'Inner Page Background Color' ),
			array ( 'section_divide_color' => 'Section Divide Color' ),
			array ( 'alt_bg_color' => 'Alt Background Color' ),
			array ( 'topbar_bg_color' => 'Top Bar Background Color' ),
			array ( 'topbar_text_color' => 'Top Bar Text Color' ),
			array ( 'topbar_link_color' => 'Top Bar Link Color' ),
			array ( 'topbar_link_hover_color' => 'Top Bar Link Hover Color' ),
			array ( 'topbar_divider_color' => 'Top Bar Divider Color' ),
			array ( 'header_bg_color1' => 'Header BG Color' ),
			array ( 'header_bg_color2' => 'Header BG Color2' ),	
			array ( 'nav_text_color' => 'Nav Text Color' ),	
			array ( 'nav_text_hover_color' => 'Nav Text Hover Color' ),	
			array ( 'nav_selected_text_color' => 'Nav Selected Text Color' ),	
			array ( 'nav_pointer_color' => 'Nav Pointer Color' ),	
			array ( 'nav_sm_bg_color' => 'Nav Sub Menu BG Color' ),	
			array ( 'nav_sm_text_color' => 'Nav Sub Menu Text Color' ),	
			array ( 'nav_sm_bg_hover_color' => 'Nav Sub Menu BG Hover Color' ),
			array ( 'nav_sm_text_hover_color' => 'Nav Sub Menu Text Hover Color' ),
			array ( 'nav_sm_selected_text_color' => 'Nav Sub Menu Selected Text Color' ),	
			array ( 'nav_divider' => 'Nav Divider' ),	
			array ( 'nav_divider_color' => 'Nav Divider Color' ),	
			array ( 'promo_bar_bg_color' => 'Promo Bar BG Color' ),	
			array ( 'promo_bar_text_color' => 'Promo Bar Text Color' ),
			array ( 'page_heading_bg_color' => 'Page Heading BG Color' ),	
			array ( 'page_heading_text_color' => 'Page Heading Text Color' ),	
			array ( 'breadcrumb_text_color' => 'Breadcrumb Text Color' ),	
			array ( 'breadcrumb_link_color' => 'Breadcrumb Link Color' ),		
			array ( 'body_color' => 'Body Color' ),
			array ( 'link_color' => 'Link Color' ),	
			array ( 'h1_color' => 'H1 Color' ),
			array ( 'h2_color' => 'H2 Color' ),
			array ( 'h3_color' => 'H3 Color' ),
			array ( 'h4_color' => 'H4 Color' ),
			array ( 'h5_color' => 'H5 Color' ),
			array ( 'h6_color' => 'H6 Color' ),
			array ( 'impact_text_color' => 'Impact Txt Color' ),
			array ( 'pt_primary_bg_color' => 'Primary BG Color' ),		
			array ( 'pt_secondary_bg_color' => 'Secondary BG Color' ),		
			array ( 'pt_tertiary_bg_color' => 'Tertiary BG Color' ),		
			array ( 'lpt_primary_row_color' => 'Primary Row Color' ),		
			array ( 'lpt_secondary_row_color' => 'Secondary Row Color' ),		
			array ( 'lpt_default_pricing_header' => 'Default Pricing Header' ),		
			array ( 'lpt_default_package_header' => 'Default Package Header' ),			
			array ( 'lpt_default_footer' => 'Default Footer' ),		
			array ( 'icon_container_bg_color' => 'Icon BG Color' ),		
			array ( 'sf_icon_color' => 'Icon Color' ),		
			array ( 'boxed_content_color' => 'Boxed Content Color' ),		
			array ( 'footer_bg_color' => 'Footer BG Color' ),		
			array ( 'footer_text_color' => 'Footer Text Color' ),		
			array ( 'footer_border_color' => 'Footer Border Color' ),				
			array ( 'copyright_bg_color' => '&copy; BG Color' ),		
			array ( 'copyright_text_color' => '&copy; Text Color' ),			
			array ( 'copyright_link_color' => '&copy; Link Color' )
		);	
		

	function sf_get_current_color_scheme_id() {
			
		$sf_neighborhood_options = get_option ( 'sf_neighborhood_options' );
		
		if ( isset( $sf_neighborhood_options['colour_scheme_select_scheme'] ) ) {
			return $sf_neighborhood_options['colour_scheme_select_scheme'];
		} else {
			return 0;
		}
		
	}
	
	function sf_get_schema_info ( $schema_id ) {
	
		global $sf_customize_item_array;
		
		if ( $schema_id ) {
		
			$schemas = get_option ( 'sf_neighborhood_schemes_saved' );
			
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

		$schemas = get_option ( 'sf_neighborhood_schemes_saved' );
		
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
		
			$dropdown_values = array('' => '--- Current Values ---') + $dropdown_values; 
//			$dropdown_values = array('' => '') + $dropdown_values; 
			
		}
		
								
		return $dropdown_values;

	}
	
	function sf_add_schema ( $schema_array = array () ) {
			
		global $sf_customize_item_array;
				
		$newSchema = array();
		
		if (!empty($schema_array)) {
			
			foreach ($schema_array as $schema ) {
										
				if ( strtolower($schema['Setting Name']) == "color scheme name") {
				
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
			
		$schemas = get_option ( 'sf_neighborhood_schemes_saved' ); // get list of schemas
		
		if ( $newSchema && !empty($newSchema) ) {
		
			$schemas[$newSchemaName] = $newSchema; // add new schema that list
		
		}
		
		update_option ( 'sf_neighborhood_schemes_saved', $schemas );
					
		}
		
	} // sf_add_schema
	
	function sf_delete_schema_ajax() {
		
		$schema_id = $_REQUEST['schema_id'];
		
		if ( $schema_id ) {
			
			$schemas = get_option ( 'sf_neighborhood_schemes_saved' ); // get list of schemas
			
			if ( isset ( $schemas[$schema_id] ) ) {
			
				unset ( $schemas[$schema_id] );
				
				update_option ( 'sf_neighborhood_schemes_saved', $schemas );
			
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
			
			require_once (SF_INCLUDES_PATH . '/swift-framework/sf-colour-scheme/File_CSV_DataSource/DataSource.php');	
			
		    $time_start = microtime(true);
		    $csv = new File_CSV_DataSource;

		    sf_stripBOM($file_path);
		    		
		    if (!$csv->load($file_path)) {
		        echo 'Failed to load file, aborting.';
		        // $this->print_messages();
		        die();
		    }
		    
			$skipped = 0;
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
			
			
			if ( !empty($schema_info) ) {
			
				foreach ($schema_info as $key => $value) {
													
					// don't update or add the name, or any element not in the official array
					
					// print_r($sf_customize_item_array);
					
					foreach ( $sf_customize_item_array as $item) {
						
						if ( isset($item[$key]) ) {

							update_option ( $key, $value );
							$success = true;
							
						}
					}

					
				}
				
				if ( $success) { echo "success"; }
				
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
		
		$schema_name = $_REQUEST['schema_name'];
		$new_schema = array();
		
		if ( $schema_name ) {
			
			// ok, so let's loop through all the saved values and add them to an array
			
			$new_schema['color_scheme_name'] = $schema_name;
			
			foreach ( $sf_customize_item_array as $item) {
			
				$new_schema[key($item)] = get_option ( key($item) );
			
			}
			
//			print_r ($new_schema);
			
			// let's save this array, similar to importing
			
			$schemas = get_option ( 'sf_neighborhood_schemes_saved' ); // get list of schemas
			
//			print_r ($schemas);
					
			$schemas[$schema_name] = $new_schema; // add new schema that list
			
//			print_r ($schemas); exit;
			
			update_option ( 'sf_neighborhood_schemes_saved', $schemas );
			
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
				
		$schemas_array = get_option ( 'sf_neighborhood_schemes_saved' );
		
		$html = '<select name="sf_neighborhood_options[colour_scheme_select_scheme]" id="colour_scheme_select_scheme"> ';
		
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
		
		echo $html;
		
		die();
		
	}
	add_action("wp_ajax_sf_get_schema_html_ajax", "sf_get_schema_html_ajax");
	add_action("wp_ajax_nopriv_sf_get_schema_html_ajax", "sf_get_schema_html_ajax");
	
	
	function sf_is_current_color_settings_empty () {

		global $sf_customize_item_array;	
		
		$values = 0;
				
		foreach ( $sf_customize_item_array as $setting ) {
		
			if ( get_option(key($setting)) ) {
						
				$values++;
			
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
				
		$schemas_array = get_option ( 'sf_neighborhood_schemes_saved' );
				
		$html = "<ul id=\"neighborhood-color-list\" class=\"color-list\">";
				
		if ( !$schema_id || $schema_id == "0" ) {
				
			// a scheme has not been selected, so we take from current values
			
			$values = 0;
					
			foreach ( $sf_customize_item_array as $setting ) {
			
				if ( get_option(key($setting)) ) {
							
				$html .= '<li style="width: 50px; line-height: 11px; text-align: center; float: left; margin: 5px; height: 95px; ">';
												
				$html .= '<div style="width: 40px; height: 40px; margin: 0 auto 10px auto; background-color:'.get_option(key($setting)).'"></div>';
				
				$html .= '<label style="font-size: 10px; text-align: center;">'.reset($setting).'</label>';
				
				$html .= '</li>';
				
				$values++;
				
				}
			
		    }
		    
		    if ( $values == 0) {
			    
			    $html .= '<li><strong>No saved values exist yet.</strong><br/>Go to the theme customizer and save some settings. </li>';
			    
		    }

	    } else {
	    
			//echo sf_get_current_color_scheme_id();
			
			if ( is_array($schemas_array) || is_object($schemas_array) ) {	
				foreach ($schemas_array as $key => $schema) {
																
					if ( $key == $schema_id ) {
										
						foreach ( $sf_customize_item_array as $setting ) {
														
							$html .= '<li style="width: 50px; line-height: 11px; text-align: center; float: left; margin: 5px;  height: 95px; ">';
															
							$html .= '<div style="width: 40px; height: 40px; margin: 0 auto 10px auto; background-color:'.$schema[key($setting)].'"></div>';
							
							$html .= '<label style="font-size: 10px; text-align: center;">'.reset($setting).'</label>';
							
							$html .= '</li>';
							
						}
						
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
	
	    if (! wp_verify_nonce($_REQUEST['nonce'], 'neighborhood_schema_action') ) 
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
		    $exportable_options[$key] = get_option( $key );
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
	    
		$sf_neighborhood_options = get_option ( 'sf_neighborhood_options' );
	    	    
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
	        'neighborhood_schema_action' => 'export_schema',
	        'nonce' => wp_create_nonce('neighborhood_schema_action')
	    );
	    $export_url = esc_url(add_query_arg($args, $site_url));
	    if ($echo === true)
	        echo $export_url;
	    elseif ($echo == 'url')
	        return $export_url;
	}

	
	function add_query_var_vars() {
	    global $wp;
	    $wp->add_query_var('neighborhood_schema_action');
	}
	
	//then add a template redirect which looks for that query var and if found calls the download function

	function admin_redirect_download_files(){
	    global $wp;
	    global $wp_query;
	    //download theme export
	    if (array_key_exists('neighborhood_schema_action', $wp->query_vars) && $wp->query_vars['neighborhood_schema_action'] == 'export_schema') {
	        sf_download_file();
	        die();
	    } else if (array_key_exists('neighborhood_schema_action', $wp->query_vars) && $wp->query_vars['neighborhood_schema_action'] == 'import_scheme') {
	    	// db_import_scheme();
	    	die();
	    }
	}
	
	
	//add hooks for these functions
	
	add_action('template_redirect', 'admin_redirect_download_files');
	add_filter('init', 'add_query_var_vars');	
