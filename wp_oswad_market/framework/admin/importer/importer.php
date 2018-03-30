<?php 
class WD_Importer{

	function __construct(){
		add_action( 'wp_ajax_import_demo_content', array($this, 'import') );
	}
	
	/* Include Classes If not Exists */
	function include_import_classes(){
		if ( ! class_exists( 'WP_Importer' ) ) {
            include ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        }

        if ( ! class_exists('WP_Import') ) {
            include get_template_directory() . '/framework/admin/importer/wordpress-importer.php';
        }
	}
	
	/* Import XML */
	function import_xml(){
		$xml_file = get_template_directory() .'/framework/admin/importer/data/sample-data.xml.gz';
		if( file_exists($xml_file) ){
			$importer = new WP_Import();
			$importer->fetch_attachments = true;
			ob_start();
			$importer->import($xml_file);
			ob_end_clean();
		}
	}
	
	/* Config WooCommerce Page */
	function config_woocommerce_page(){
		$woopages = array(
			'woocommerce_shop_page_id' 			=> 'Shop'
			,'woocommerce_cart_page_id' 		=> 'Cart'
			,'woocommerce_checkout_page_id' 	=> 'Checkout'
			,'woocommerce_myaccount_page_id' 	=> 'My Account'
		);
		foreach( $woopages as $woo_page_name => $woo_page_title ) {
			$woopage = get_page_by_title( $woo_page_title );
			if( isset( $woopage->ID ) && $woopage->ID ) {
				update_option($woo_page_name, $woopage->ID);
			}
		}

		delete_option( '_wc_needs_pages' );
		delete_transient( '_wc_activation_redirect' );
		
		flush_rewrite_rules();
	}
	
	/* Config Menu Locations */
	function config_menu_locations(){
		$locations = get_theme_mod( 'nav_menu_locations' );
		$menus = wp_get_nav_menus();

		if( $menus ) {
			foreach($menus as $menu) {
				if( $menu->name == 'Menu PC' ) {
					$locations['primary'] = $menu->term_id;
				}
				if( $menu->name == 'Menu mobile' ) {
					$locations['mobile'] = $menu->term_id;
				}
			}
		}
		set_theme_mod( 'nav_menu_locations', $locations );
	}
	
	/* Import Theme Options */
	function import_theme_options(){
		$theme_options_txt = get_template_directory_uri() . '/framework/admin/importer/data/theme_options.txt'; // theme options data file
		$theme_options_txt = wp_remote_get( $theme_options_txt );
		$smof_data = unserialize( base64_decode( $theme_options_txt['body'])  );
		of_save_options($smof_data);
	}
	
	/* import Sidebar Content */
	function import_sidebar_content( $action ){
		$file_url = get_template_directory_uri(). '/framework/admin/importer/data/widget_data.json';
		$widget_json = wp_remote_get( $file_url );
		$widget_data = $widget_json['body'];
		$widget_data = json_decode( $widget_data, true);
		unset($widget_data[0]['wp_inactive_widgets']);
		
		$sidebar_data = $widget_data[0];
		$widget_data = $widget_data[1];

		foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
			$widgets[ $widget_data_title ] = '';
			foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
				if( is_int( $widget_data_key ) ) {
					$widgets[$widget_data_title][$widget_data_key] = 'on';
				}
			}
		}
		unset($widgets[""]);

		foreach ( $sidebar_data as $title => $sidebar ) {
			$count = count( $sidebar );
			for ( $i = 0; $i < $count; $i++ ) {
				$widget = array( );
				$widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
				$widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
				if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
					unset( $sidebar_data[$title][$i] );
				}
			}
			$sidebar_data[$title] = array_values( $sidebar_data[$title] );
		}

		foreach ( $widgets as $widget_title => $widget_value ) {
			foreach ( $widget_value as $widget_key => $widget_value ) {
				$widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
			}
		}

		$sidebar_data = array( array_filter( $sidebar_data ), $widgets );
		
		/* Parse data */
		global $wp_registered_sidebars;
		$sidebars_data = $sidebar_data[0];
		$widget_data = $sidebar_data[1];
		if( $action == 'override' ){
			$current_sidebars = array();
		}
		else{ /* Append */
			$current_sidebars = get_option( 'sidebars_widgets' );
		}
		
		$new_widgets = array( );

		foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

			foreach ( $import_widgets as $import_widget ) :
			
				if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
					$title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
					$index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
					if( $action == 'override' ){
						$current_widget_data = array();
					}
					else{ /* Append */
						$current_widget_data = get_option( 'widget_' . $title );
					}
					$new_widget_name = $this->get_new_widget_name( $title, $index );
					$new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

					if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
						while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
							$new_index++;
						}
					}
					$current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
					if ( array_key_exists( $title, $new_widgets ) ) {
						$new_widgets[$title][$new_index] = $widget_data[$title][$index];
						$multiwidget = $new_widgets[$title]['_multiwidget'];
						unset( $new_widgets[$title]['_multiwidget'] );
						$new_widgets[$title]['_multiwidget'] = $multiwidget;
					} else {
						$current_widget_data[$new_index] = $widget_data[$title][$index];
						$current_multiwidget = isset($current_widget_data['_multiwidget']) ? $current_widget_data['_multiwidget'] : false;
						$new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
						$multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
						unset( $current_widget_data['_multiwidget'] );
						$current_widget_data['_multiwidget'] = $multiwidget;
						$new_widgets[$title] = $current_widget_data;
					}

				endif;
			endforeach;
		endforeach;

		if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
			update_option( 'sidebars_widgets', $current_sidebars );

			foreach ( $new_widgets as $title => $content ){
				update_option( 'widget_' . $title, $content );
			}
			
			return true;
		}

		return false;
		
	}
	
	function get_new_widget_name( $widget_name, $widget_index ){
		$current_sidebars = get_option( 'sidebars_widgets' );
		$all_widget_array = array( );
		foreach ( $current_sidebars as $sidebar => $widgets ) {
			if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
				foreach ( $widgets as $widget ) {
					$all_widget_array[] = $widget;
				}
			}
		}
		while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
			$widget_index++;
		}
		$new_widget_name = $widget_name . '-' . $widget_index;
		return $new_widget_name;
	}
	
	/* Import Revolution Slider */
	function import_revolution_slider(){
		if( class_exists('UniteFunctionsRev') && class_exists('ZipArchive') ) {
			global $wpdb;
			$updateAnim = true;
			$updateStatic= true;
			
			$rev_directory = get_template_directory() . '/framework/admin/importer/data/revsliders/';

			foreach( glob( $rev_directory . '*.zip' ) as $filename ) {
				$filename = basename($filename);
				$rev_files[] = get_template_directory() . '/framework/admin/importer/data/revsliders/' . $filename ;
			}

			foreach( $rev_files as $rev_file ) {

					$filepath = $rev_file;

					$zip = new ZipArchive;
					$importZip = $zip->open($filepath, ZIPARCHIVE::CREATE);

					if( $importZip === true ){

						$slider_export = $zip->getStream('slider_export.txt');
						$custom_animations = $zip->getStream('custom_animations.txt');
						$dynamic_captions = $zip->getStream('dynamic-captions.css');
						$static_captions = $zip->getStream('static-captions.css');

						$content = '';
						$animations = '';
						$dynamic = '';
						$static = '';

						while ( !feof($slider_export) ) $content .= fread($slider_export, 1024);
						if($custom_animations){ while (!feof($custom_animations)) $animations .= fread($custom_animations, 1024); }
						if($dynamic_captions){ while (!feof($dynamic_captions)) $dynamic .= fread($dynamic_captions, 1024); }
						if($static_captions){ while (!feof($static_captions)) $static .= fread($static_captions, 1024); }

						fclose($slider_export);
						if($custom_animations){ fclose($custom_animations); }
						if($dynamic_captions){ fclose($dynamic_captions); }
						if($static_captions){ fclose($static_captions); }

					}else{
						$content = @file_get_contents($filepath);
					}

					if($importZip === true){
						$db = new UniteDBRev();

						$animations = @unserialize($animations);
						if( !empty($animations) ){
							foreach($animations as $key => $animation){
								$exist = $db->fetch(GlobalsRevSlider::$table_layer_anims, "handle = '".$animation['handle']."'");
								if( !empty($exist) ){
									if( $updateAnim == 'true' ){
										$arrUpdate = array();
										$arrUpdate['params'] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));
										$db->update(GlobalsRevSlider::$table_layer_anims, $arrUpdate, array('handle' => $animation['handle']));

										$id = $exist['0']['id'];
									}else{
										$arrInsert = array();
										$arrInsert["handle"] = 'copy_'.$animation['handle'];
										$arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));

										$id = $db->insert(GlobalsRevSlider::$table_layer_anims, $arrInsert);
									}
								}else{
									$arrInsert = array();
									$arrInsert["handle"] = $animation['handle'];
									$arrInsert["params"] = stripslashes(json_encode(str_replace("'", '"', $animation['params'])));

									$id = $db->insert(GlobalsRevSlider::$table_layer_anims, $arrInsert);
								}

								$content = str_replace(array('customin-'.$animation['id'], 'customout-'.$animation['id']), array('customin-'.$id, 'customout-'.$id), $content);
							}
						}else{

						}

						if( !empty($static) ){
							if( isset( $updateStatic ) && $updateStatic == 'true' ){
								RevOperations::updateStaticCss($static);
							}else{
								$static_cur = RevOperations::getStaticCss();
								$static = $static_cur."\n".$static;
								RevOperations::updateStaticCss($static);
							}
						}
						
						$dynamicCss = UniteCssParserRev::parseCssToArray($dynamic);

						if(is_array($dynamicCss) && $dynamicCss !== false && count($dynamicCss) > 0){
							foreach($dynamicCss as $class => $styles){
								$class = trim($class);

								if((strpos($class, ':hover') === false && strpos($class, ':') !== false) || 
									strpos($class," ") !== false || 
									strpos($class,".tp-caption") === false || 
									(strpos($class,".") === false || strpos($class,"#") !== false) || 
									strpos($class,">") !== false){ 
									continue;
								}

								
								if(strpos($class, ':hover') !== false){
									$class = trim(str_replace(':hover', '', $class));
									$arrInsert = array();
									$arrInsert["hover"] = json_encode($styles);
									$arrInsert["settings"] = json_encode(array('hover' => 'true'));
								}else{
									$arrInsert = array();
									$arrInsert["params"] = json_encode($styles);
								}
								
								$result = $db->fetch(GlobalsRevSlider::$table_css, "handle = '".$class."'");

								if(!empty($result)){
									$db->update(GlobalsRevSlider::$table_css, $arrInsert, array('handle' => $class));
								}else{
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

					
					$arrInsert = array();
					$arrInsert["params"] = $json_params;
					$arrInsert["title"] = UniteFunctionsRev::getVal($sliderParams, "title","Slider1");
					$arrInsert["alias"] = UniteFunctionsRev::getVal($sliderParams, "alias","slider1");
					$sliderID = $wpdb->insert(GlobalsRevSlider::$table_sliders,$arrInsert);
					$sliderID = $wpdb->insert_id;

					

					/* create all slides */
					$arrSlides = $arrSlider["slides"];

					$alreadyImported = array();

					foreach($arrSlides as $slide){

						$params = $slide["params"];
						$layers = $slide["layers"];

						if(isset($params["image"])){
							if(trim($params["image"]) !== ''){
								if($importZip === true){
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

						foreach($layers as $key=>$layer){
							if(isset($layer["image_url"])){
								if(trim($layer["image_url"]) !== ''){
									if($importZip === true){
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

						/* create new slide */
						$arrCreate = array();
						$arrCreate["slider_id"] = $sliderID;
						$arrCreate["slide_order"] = $slide["slide_order"];
						$arrCreate["layers"] = json_encode($layers);
						$arrCreate["params"] = json_encode($params);

						$wpdb->insert(GlobalsRevSlider::$table_slides,$arrCreate);
				}
			}
		}
	}
	
	/* Update Options */
	function update_options(){
		$homepage = get_page_by_title( 'Home' );
		if( isset( $homepage ) && $homepage->ID ){
			update_option('show_on_front', 'page');
			update_option('page_on_front', $homepage->ID);
		}
		update_option('yith_woocompare_compare_button_in_products_list', 'yes');
	}
	
	/* Import */
	function import(){
		set_time_limit(0);
		
		if ( current_user_can( 'manage_options' ) ) {
			if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
		
			$this->include_import_classes();
			
			if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) {
				
				$import_pages_posts_menu 	= isset($_POST['import_pages_posts_menu'])?$_POST['import_pages_posts_menu']:'yes';
				$import_revsliders 			= isset($_POST['import_revsliders'])?$_POST['import_revsliders']:'yes';
				$import_widgets 			= isset($_POST['import_widgets'])?$_POST['import_widgets']:'override';
				$import_theme_options 		= isset($_POST['import_theme_options'])?$_POST['import_theme_options']:'yes';
				
				if( $import_theme_options == 'yes' ){
					$this->import_theme_options();
				}
				
				if( $import_widgets != 'no' ){
					$this->import_sidebar_content($import_widgets);
				}
				
				if( $import_revsliders == 'yes' ){
					$this->import_revolution_slider();
				}
				
				if( $import_pages_posts_menu == 'yes' ){
					$this->import_xml();
					$this->config_menu_locations();
					$this->update_options();
					$this->config_woocommerce_page();
				}
				
				die('1');
			}
			else{
				die('0');
			}
		}
		else{
			die('0');
		}
	}
	
}
new WD_Importer();
?>