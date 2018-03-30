<?php
	function themeva_options_import_demo()
	{
			global $wpdb;
			
			set_time_limit(0);
			
			// Check AJAX Referer
			check_ajax_referer('_theme_options', '_ajax_nonce');
		
			if (!class_exists('WP_Import')) {
				if (!defined('WP_LOAD_IMPORTERS')) define('WP_LOAD_IMPORTERS', true);
				$wp_import = get_template_directory() . '/lib/adm/functions/wordpress-importer.php';
				require_once($wp_import);
			}
			
			class themevaImport extends WP_Import {}
		
			//instantiate prime-importer
			$wp_import = new themevaImport();
		
			//load demo.xml
			$wp_import->fetch_attachments = true;

			//load Woocommerce demo.xml
			if( class_exists( 'woocommerce' ) )
			{			
				$xml_path = get_template_directory() . '/demo/demo_woocommerce.xml';
			}
			else
			{
				$xml_path = get_template_directory() . '/demo/demo.xml';
			}
			
			ob_start();
			$wp_import->import($xml_path);
			ob_end_clean();

		
			//load menus
			// automatically create menus and set their locations
			// add all pages to the Primary Navigation
			//Parameterize with the menu to look for when assigning the theme location a menu
			$primary_nav = wp_get_nav_menu_object('Main Menu');
			
			$primary_nav_term_id = (int)$primary_nav->term_id;
			
			//actually set the menu values
			$locations = get_theme_mod('nav_menu_locations');
			$locations['mainnav'] = $primary_nav_term_id; //$foo is term_id of menu
		
			set_theme_mod('nav_menu_locations', $locations);

			//setup Reading Settings
			update_option('show_on_front', 'page');
			
			$home_page = get_page_by_title('Home');
			
			if ($home_page->post_type == 'page') update_option('page_on_front', $home_page->ID);
		
			$revslider_demo_dir = get_template_directory() . '/demo/plugins/revslider/';

			// Import Revslider
			if( class_exists('UniteFunctionsRev') ) { // if revslider is activated
				foreach( glob( $revslider_demo_dir . '*.zip' ) as $filename ) { // get all files from revsliders data dir
					$filename = basename($filename);
					$revslider_files[] = $revslider_demo_dir . $filename;
				}

				foreach( $revslider_files as $revslider_file ) { // finally import rev slider data files

						$filepath = $revslider_file;

						//check if zip file or fallback to old, if zip, check if all files exist
						$zip = new ZipArchive;
						$importZip = $zip->open($filepath, ZIPARCHIVE::CREATE);

						if($importZip === true){ //true or integer. If integer, its not a correct zip file

							//check if files all exist in zip
							$slider_export = $zip->getStream('slider_export.txt');
							$custom_animations = $zip->getStream('custom_animations.txt');
							$dynamic_captions = $zip->getStream('dynamic-captions.css');
							$static_captions = $zip->getStream('static-captions.css');

							$content = '';
							$animations = '';
							$dynamic = '';
							$static = '';

							while (!feof($slider_export)) $content .= fread($slider_export, 1024);
							if($custom_animations){ while (!feof($custom_animations)) $animations .= fread($custom_animations, 1024); }
							if($dynamic_captions){ while (!feof($dynamic_captions)) $dynamic .= fread($dynamic_captions, 1024); }
							if($static_captions){ while (!feof($static_captions)) $static .= fread($static_captions, 1024); }

							fclose($slider_export);
							if($custom_animations){ fclose($custom_animations); }
							if($dynamic_captions){ fclose($dynamic_captions); }
							if($static_captions){ fclose($static_captions); }

							//check for images!

						}else{ //check if fallback
							//get content array
							$content = @file_get_contents($filepath);
						}

						if($importZip === true){ //we have a zip
							$db = new UniteDBRev();

							//update/insert custom animations
							$animations = @unserialize($animations);
							if(!empty($animations)){
								foreach($animations as $key => $animation){ //$animation['id'], $animation['handle'], $animation['params']
									$exist = $db->fetch(GlobalsRevSlider::$table_layer_anims, "handle = '".$animation['handle']."'");
									if(!empty($exist)){ //update the animation, get the ID
										if($updateAnim == "true"){ //overwrite animation if exists
											$arrUpdate = array();
											$arrUpdate['params'] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));
											$db->update(GlobalsRevSlider::$table_layer_anims, $arrUpdate, array('handle' => $animation['handle']));

											$id = $exist['0']['id'];
										}else{ //insert with new handle
											$arrInsert = array();
											$arrInsert["handle"] = 'copy_'.$animation['handle'];
											$arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));

											$id = $db->insert(GlobalsRevSlider::$table_layer_anims, $arrInsert);
										}
									}else{ //insert the animation, get the ID
										$arrInsert = array();
										$arrInsert["handle"] = $animation['handle'];
										$arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));

										$id = $db->insert(GlobalsRevSlider::$table_layer_anims, $arrInsert);
									}

									//and set the current customin-oldID and customout-oldID in slider params to new ID from $id
									$content = str_replace(array('customin-'.$animation['id'], 'customout-'.$animation['id']), array('customin-'.$id, 'customout-'.$id), $content);
								}
							}else{
							}

							//overwrite/append static-captions.css
							if(!empty($static)){
								if(isset( $updateStatic ) && $updateStatic == "true"){ //overwrite file
									RevOperations::updateStaticCss($static);
								}else{ //append
									$static_cur = RevOperations::getStaticCss();
									$static = $static_cur."\n".$static;
									RevOperations::updateStaticCss($static);
								}
							}
							//overwrite/create dynamic-captions.css
							//parse css to classes
							$dynamicCss = UniteCssParserRev::parseCssToArray($dynamic);

							if(is_array($dynamicCss) && $dynamicCss !== false && count($dynamicCss) > 0){
								foreach($dynamicCss as $class => $styles){
									//check if static style or dynamic style
									$class = trim($class);

									if((strpos($class, ':hover') === false && strpos($class, ':') !== false) || //before, after
										strpos($class," ") !== false || // .tp-caption.imageclass img or .tp-caption .imageclass or .tp-caption.imageclass .img
										strpos($class,".tp-caption") === false || // everything that is not tp-caption
										(strpos($class,".") === false || strpos($class,"#") !== false) || // no class -> #ID or img
										strpos($class,">") !== false){ //.tp-caption>.imageclass or .tp-caption.imageclass>img or .tp-caption.imageclass .img
										continue;
									}

									//is a dynamic style
									if(strpos($class, ':hover') !== false){
										$class = trim(str_replace(':hover', '', $class));
										$arrInsert = array();
										$arrInsert["hover"] = json_encode($styles);
										$arrInsert["settings"] = json_encode(array('hover' => 'true'));
									}else{
										$arrInsert = array();
										$arrInsert["params"] = json_encode($styles);
									}
									//check if class exists
									$result = $db->fetch(GlobalsRevSlider::$table_css, "handle = '".$class."'");

									if(!empty($result)){ //update
										$db->update(GlobalsRevSlider::$table_css, $arrInsert, array('handle' => $class));
									}else{ //insert
										$arrInsert["handle"] = $class;
										$db->insert(GlobalsRevSlider::$table_css, $arrInsert);
									}
								}
							}else{
							}
						}

						$content = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $content); //clear errors in string

						$arrSlider = @unserialize($content);
						$sliderParams = $arrSlider["params"];

						if(isset($sliderParams["background_image"]))
							$sliderParams["background_image"] = UniteFunctionsWPRev::getImageUrlFromPath($sliderParams["background_image"]);

						$json_params = json_encode($sliderParams);

						//new slider
						$arrInsert = array();
						$arrInsert["params"] = $json_params;
						$arrInsert["title"] = UniteFunctionsRev::getVal($sliderParams, "title","Slider1");
						$arrInsert["alias"] = UniteFunctionsRev::getVal($sliderParams, "alias","slider1");
						$sliderID = $wpdb->insert(GlobalsRevSlider::$table_sliders,$arrInsert);
						$sliderID = $wpdb->insert_id;

						//-------- Slides Handle -----------

						//create all slides
						$arrSlides = $arrSlider["slides"];

						$alreadyImported = array();

						foreach($arrSlides as $slide){

							$params = $slide["params"];
							$layers = $slide["layers"];

							//convert params images:
							if(isset($params["image"])){
								//import if exists in zip folder
								if(trim($params["image"]) !== ''){
									if($importZip === true){ //we have a zip, check if exists
										$image = $zip->getStream('images/'.$params["image"]);
										if(!$image){
											echo $params["image"].' not found!<br>';
										}else{
											if(!isset($alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]])){
												$importImage = UniteFunctionsWPRev::import_media('zip://'.$filepath."#".'images/'.$params["image"], $sliderParams["alias"].'/');

												if($importImage !== false){
													$alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]] = $importImage['path'];

													$params["image"] = $importImage['path'];
												}
											}else{
												$params["image"] = $alreadyImported['zip://'.$filepath."#".'images/'.$params["image"]];
											}
										}
									}
								}
								$params["image"] = UniteFunctionsWPRev::getImageUrlFromPath($params["image"]);
							}

							//convert layers images:
							foreach($layers as $key=>$layer){
								if(isset($layer["image_url"])){
									//import if exists in zip folder
									if(trim($layer["image_url"]) !== ''){
										if($importZip === true){ //we have a zip, check if exists
											$image_url = $zip->getStream('images/'.$layer["image_url"]);
											if(!$image_url){
												echo $layer["image_url"].' not found!<br>';
											}else{
												if(!isset($alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]])){
													$importImage = UniteFunctionsWPRev::import_media('zip://'.$filepath."#".'images/'.$layer["image_url"], $sliderParams["alias"].'/');

													if($importImage !== false){
														$alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]] = $importImage['path'];

														$layer["image_url"] = $importImage['path'];
													}
												}else{
													$layer["image_url"] = $alreadyImported['zip://'.$filepath."#".'images/'.$layer["image_url"]];
												}
											}
										}
									}
									$layer["image_url"] = UniteFunctionsWPRev::getImageUrlFromPath($layer["image_url"]);
									$layers[$key] = $layer;
								}
							}

							//create new slide
							$arrCreate = array();
							$arrCreate["slider_id"] = $sliderID;
							$arrCreate["slide_order"] = $slide["slide_order"];
							$arrCreate["layers"] = json_encode($layers);
							$arrCreate["params"] = json_encode($params);

							$wpdb->insert(GlobalsRevSlider::$table_slides,$arrCreate);
						//}
					}
				}
			}				
		
			_e( '<strong>Import Complete.</strong> The Demo content has been imported, <strong>please wait for page reload.</strong>', 'themeva-admin' );
			die();
	}
		
	add_action( 'wp_ajax_themeva_options_import_demo', 'themeva_options_import_demo' );