<?php

$GLOBALS['omImportTool'] = array(
	'version' => '1.1',
	'path' => plugin_dir_path( __FILE__ ), // with trailing slash
	'path_url' => TEMPLATE_DIR_URI . '/libraries/om-import-tool/',
	'wordpress_xml' => 'demo_content/wordpress.xml',
	'theme_options_dat' => 'demo_content/theme_options.dat',
	'widgets_dat' => 'demo_content/widgets.wie',
	'layer_slider_dat' => false, //'demo_content/LayerSlider.json',
	'layer_slider_uploads_replace' => array(
	),
	'rev_slider_dat' => array(
	),
	'uploads_replace_dir' => 'http://demo.olevmedia.net/amax/wp-content/uploads',
	'menus' => array( // pair "Menu Name" => "Location"
		'Primary Menu' => 'primary-menu',
		'↓ Downloads' => 'secondary-menu',
	),
	'reading' => array(
		'front_page_title' => 'Homepage',
		'posts_page_title' => 'News & Events',
	),
	'menu_add_meta' => array(
	),
);

function om_add_import_page() {
	
  add_management_page(__('Demo Content', 'om_theme'), __('Demo Content', 'om_theme'), 'manage_options', 'om_import_tool','om_import_page');
	
}
add_action('admin_menu', 'om_add_import_page');

function om_import_page() {

	?>
	<div class="wrap">
		<h2><?php _e('One Click Demo Content Import', 'om_theme'); ?></h2>
	<?php if(isset($_GET['import_completed'])) { ?>
		<br/><div class="updated"><p style="font-size:130%"><em><b><?php _e('Import of demo content completed! Enjoy!','om_theme') ?></b></em></p></div>
	<?php } else { ?>
		<div class="updated"><p><em><?php _e('Please, note, that all settings which were made under "Theme Options" will be reverted to "Demo". So, if you have already made any changes under "Theme Options" and want to save them, navigate to <a href="admin.php?page=om_options">Theme Options</a> and export current settings.', 'om_theme'); ?></em></p></div>
		<table class="form-table">
			<col width="1%" /><col />
			<tbody>
				<tr>
					<td><input type="button" class="button button-primary om_import_tool_start" data-import-attachments="0" value="<?php _e('Import demo content WITHOUT media files','om_theme')?>" /></td>
					<td><?php _e('This is a quick import, which will import all pages, posts, menus, etc. without demo images.', 'om_theme') ?></td>
				</tr>
				<tr>
					<td><input type="button" class="button button-primary om_import_tool_start" data-import-attachments="1" value="<?php _e('Import demo content WITH media files','om_theme')?>" /></td>
					<td><?php _e('This will import all demo images, but it can take much time to complete an import.', 'om_theme') ?></td>
				</tr>
			</tbody>
		</table>
		
		<div id="om_import_status" style="margin:20px 0;display:none"><span class="spinner is-active" id="om_import_spinner" style="display:inline-block;float:none;margin-top:0;position:relative;top:-2px"></span><span id="om_import_status_text"></span></div>
		<div id="om_import_progress" style="margin:20px 0;display:none;height:30px;line-height:30px;text-align:center;color:#fff;background:#aaa;position:relative;"><div id="om_import_progress_bar" style="width:0;position:absolute;top:0;left:0;bottom:0;background:#2fc600"></div><div id="om_import_progress_text" style="position:relative"></div></div>
	<?php } ?>	
	</div>
	<?php	
	
	echo '<div id="om_status"></div>';
	
}

/*******************************************************/

function om_import_page_scripts($hook) {
	if( 'tools_page_om_import_tool' != $hook )
		return;
	wp_enqueue_script( 'om_import_tool_core', $GLOBALS['omImportTool']['path_url'] . 'assets/js/core.js' );
}
add_action( 'admin_enqueue_scripts', 'om_import_page_scripts' );


/*******************************************************/

add_action('wp_ajax_om_import_tool', 'om_ajax_import_tool');

function om_ajax_import_tool() {

	if ( ! current_user_can( 'manage_options' ) )
		die();

	if ( get_magic_quotes_gpc() ) {
		$_POST = stripslashes_deep( $_POST );
	}
	
	if(!isset($_POST['om_action']))
		die();
		
	switch($_POST['om_action']) {
		
		case 'start':

			$data=array('error' => 0);
			
			if(!file_exists($GLOBALS['omImportTool']['path'] . $GLOBALS['omImportTool']['wordpress_xml'])) {
				$data['error'] = 1;
				wp_send_json($data);
			}
					
			if(!class_exists('WXR_Parser'))
				require $GLOBALS['omImportTool']['path'] . 'includes/parsers.php';
		
			$parser = new WXR_Parser();
			$import_data = $parser->parse( $GLOBALS['omImportTool']['path'] . $GLOBALS['omImportTool']['wordpress_xml'] );
			unset($parser);

			if ( is_wp_error( $import_data ) ) {
				$data['error'] = 1;
				wp_send_json($data);
			}
			
			$data['common']=array(
				'base_url' => esc_url( $import_data['base_url'] ),
			);
			$data['attachments']=array();
			
			$author = (int) get_current_user_id();
			
			foreach($import_data['posts'] as $post) {
				if('attachment' == $post['post_type']) {
					
					$post_parent = (int) $post['post_parent'];
					
					$postdata = array(
						'import_id' => $post['post_id'], 'post_author' => $author, 'post_date' => $post['post_date'],
						'post_date_gmt' => $post['post_date_gmt'], 'post_content' => $post['post_content'],
						'post_excerpt' => $post['post_excerpt'], 'post_title' => $post['post_title'],
						'post_status' => $post['status'], 'post_name' => $post['post_name'],
						'comment_status' => $post['comment_status'], 'ping_status' => $post['ping_status'],
						'guid' => $post['guid'], 'post_parent' => $post_parent, 'menu_order' => $post['menu_order'],
						'post_type' => $post['post_type'], 'post_password' => $post['post_password']
					);
					
					$remote_url = ! empty($post['attachment_url']) ? $post['attachment_url'] : $post['guid'];
					
					// try to use _wp_attached file for upload folder placement to ensure the same location as the export site
					// e.g. location is 2003/05/image.jpg but the attachment post_date is 2010/09, see media_handle_upload()
					$postdata['upload_date'] = $post['post_date'];
					if ( isset( $post['postmeta'] ) ) {
						foreach( $post['postmeta'] as $meta ) {
							if ( $meta['key'] == '_wp_attached_file' ) {
								if ( preg_match( '%^[0-9]{4}/[0-9]{2}%', $meta['value'], $matches ) )
									$postdata['upload_date'] = $matches[0];
								break;
							}
						}
					}
					
					$postdata['postmeta']=$post['postmeta'];
					
					$data['attachments'][]=array(
						'data' => $postdata,
						'remote_url' => $remote_url,
					);
					
				}
			}
			
			$data['last_attachment_index'] = -1;
			$variables_dump=get_option(OM_THEME_PREFIX . 'import_process_data');
			if(!empty($variables_dump) && is_array($variables_dump)) {
				if(isset($variables_dump['last_attachment_index']))
					$data['last_attachment_index']=$variables_dump['last_attachment_index'];
			}
			
			wp_send_json($data);
		
		break;
		
		case 'process_attachments':
		
			$ret=array('error' => 0);
			
			if(isset($_POST['data']['attachments'])) {
				
				if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
				
				if ( ! class_exists('WP_Import') ) { // if WP importer doesn't exist
					$wp_import = $GLOBALS['omImportTool']['path'] . 'includes/wordpress-importer.php';
					include $wp_import;
				}

        if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) { // check for main import class and wp import class

					$importer = new WP_Import();
					$importer->base_url = $_POST['data']['common']['base_url'];
					$importer->fetch_attachments = true;
					
					$variables_dump=get_option(OM_THEME_PREFIX . 'import_process_data');
					if(!empty($variables_dump) && is_array($variables_dump)) {
						$importer->post_orphans = $variables_dump['post_orphans'];
						$importer->processed_posts = $variables_dump['processed_posts'];
						$importer->url_remap = $variables_dump['url_remap'];
					}
					
					$last_attachment_index=$_POST['data']['first_attachment_index'];

					foreach($_POST['data']['attachments'] as $attachment) {
						
						$post=$attachment['data'];
	
						$importer->post_orphans[intval($post['import_id'])] = (int) $post['post_parent'];
						$post['post_parent'] = 0;
				
						$post_id = $importer->process_attachment( $post, $attachment['remote_url'] );
						
						if ( is_wp_error( $post_id ) ) {
							continue;
						}
						
						$importer->processed_posts[intval($post['import_id'])] = (int) $post_id;

						// add/update post meta
						if ( ! empty( $post['postmeta'] ) ) {
							foreach ( $post['postmeta'] as $meta ) {
								$key = $meta['key'];
								$value = false;
			
								if ( '_edit_last' == $key ) {
									continue;
								}
			
								if ( $key ) {
									// export gets meta straight from the DB so could have a serialized string
									if ( ! $value )
										$value = maybe_unserialize( $meta['value'] );
			
									add_post_meta( $post_id, $key, $value );
								}
							}
						}
												
						$variables_dump['last_attachment_index']=$last_attachment_index;
						$last_attachment_index++;
						
					}

					$variables_dump['post_orphans'] = $importer->post_orphans;
					$variables_dump['processed_posts'] = $importer->processed_posts;
					$variables_dump['url_remap'] = $importer->url_remap;
					update_option(OM_THEME_PREFIX . 'import_process_data', $variables_dump);
						
					
				}
			}
			
			wp_send_json($ret);
			
		break;
		
		case 'process_other':
		
			$ret=array('error' => 0);
			
			if(!file_exists($GLOBALS['omImportTool']['path'] . $GLOBALS['omImportTool']['wordpress_xml'])) {
				$ret['error'] = 1;
				wp_send_json($ret);
			}
			
			if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
			
			if ( ! class_exists('WP_Import') ) { // if WP importer doesn't exist
				$wp_import = $GLOBALS['omImportTool']['path'] . 'includes/wordpress-importer.php';
				include $wp_import;
			}

      if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) { // check for main import class and wp import class

				// Content
	
				$importer = new WP_Import();
				$importer->fetch_attachments = false;

				$variables_dump=get_option(OM_THEME_PREFIX . 'import_process_data');
				if(!empty($variables_dump) && is_array($variables_dump)) {
					$importer->post_orphans = $variables_dump['post_orphans'];
					$importer->processed_posts = $variables_dump['processed_posts'];
					$importer->url_remap = $variables_dump['url_remap'];
				}
				
				add_filter('wp_import_post_meta', 'om_import_modify_meta');
								
        ob_start();
        $importer->import($GLOBALS['omImportTool']['path'] . $GLOBALS['omImportTool']['wordpress_xml']);
        ob_end_clean();
        
        om_import_menu_meta($importer->processed_menu_items);
				
				update_option(OM_THEME_PREFIX . 'import_process_data', false);



	      // Menus to locations
	      $locations = get_theme_mod( 'nav_menu_locations' );
	      $menus = wp_get_nav_menus();
				if($menus) {
					foreach($menus as $menu) {
						if(isset($GLOBALS['omImportTool']['menus'][$menu->name])) {
							$locations[$GLOBALS['omImportTool']['menus'][$menu->name]] = $menu->term_id;
						}
					}
				}
	      set_theme_mod( 'nav_menu_locations', $locations ); // set menus to locations


				// Import Theme Options
				if(file_exists($GLOBALS['omImportTool']['path'] . $GLOBALS['omImportTool']['theme_options_dat'])) {
					$s=trim(file_get_contents($GLOBALS['omImportTool']['path'] . $GLOBALS['omImportTool']['theme_options_dat']));
					$options=@unserialize($s);
					if(is_array($options)) {
						$wp_upload_dir=wp_upload_dir();
						
						if(isset($options['options'][OM_THEME_PREFIX."default_title_bg_img"])) {
							$options['options'][OM_THEME_PREFIX.'default_title_bg_img']=str_replace($GLOBALS['omImportTool']['uploads_replace_dir'],$wp_upload_dir['baseurl'],$options['options'][OM_THEME_PREFIX.'default_title_bg_img']);
						}

						om_options_do_import_data($options);
					}
				}

				// Widgets
				if(file_exists($GLOBALS['omImportTool']['path'] . $GLOBALS['omImportTool']['widgets_dat'])) {
					
					if(!function_exists('wie_available_widgets')) {
						require $GLOBALS['omImportTool']['path'] . 'includes/widgets-widgets.php';
					}
					if(!function_exists('wie_import_data')) {
						require $GLOBALS['omImportTool']['path'] . 'includes/widgets-import.php';
					}
					
					$data = json_decode( file_get_contents( $GLOBALS['omImportTool']['path'] . $GLOBALS['omImportTool']['widgets_dat'] ) );
					wie_import_data( $data );
					
				}
		
				// Layer Slider
				if( isset($GLOBALS['lsPluginVersion']) || defined('LS_PLUGIN_VERSION') ) {
					if($GLOBALS['omImportTool']['layer_slider_dat'])
						om_ls_import_sliders($GLOBALS['omImportTool']['path'] . $GLOBALS['omImportTool']['layer_slider_dat']);
				}
				
				// RevSlider
				if( class_exists('RevSlider') ) {
					if( !empty($GLOBALS['omImportTool']['rev_slider_dat']) ) {
						foreach($GLOBALS['omImportTool']['rev_slider_dat'] as $file) {
							if($file)
								om_rev_import_slider($GLOBALS['omImportTool']['path'] . $file);
						}
					}
				}


        // Set reading options
        $front_page = $GLOBALS['omImportTool']['reading']['front_page_title'] ? get_page_by_title( $GLOBALS['omImportTool']['reading']['front_page_title'] ) : false;
        $posts_page = $GLOBALS['omImportTool']['reading']['posts_page_title'] ? get_page_by_title( $GLOBALS['omImportTool']['reading']['posts_page_title'] ) : false;
        if($front_page || $posts_page) {
					update_option('show_on_front', 'page');
					if($front_page)
						update_option('page_on_front', $front_page->ID);
					if($posts_page)
						update_option('page_for_posts', $posts_page->ID);
        }

			}
		
			wp_send_json($ret);
			
		break;
		
		
	}
}


/*********************************/

function om_import_modify_meta($postmeta) {
	
	foreach ( $postmeta as $k=>$meta ) {
		
		if($meta['key'] == OM_THEME_SHORT_PREFIX.'gallery' || $meta['key'] == 'ompf_gallery' ) {
			$value = maybe_unserialize( $meta['value'] );
			if(isset($value['images']) && $value['images']) {
				
				$variables_dump=get_option(OM_THEME_PREFIX . 'import_process_data');
				
				$ids=explode(',',$value['images']);
				$ids_=array();
				foreach($ids as $id) {
					$id=intval($id);
					if( isset($variables_dump['processed_posts'][$id]) )
						$ids_[]=$variables_dump['processed_posts'][$id];
				}
				$value['images']=implode(',',$ids_);
				
			}
			$postmeta[$k]['value']=$value;
		}
		
	}
	
	return $postmeta;
	
}

/**********************************/

function om_ls_import_sliders($file) {

	if(!file_exists($file))
		return false;

	// Get decoded file data
	$data = base64_decode(file_get_contents($file));

	// Parsing JSON or PHP object
	if(!$parsed = json_decode($data, true)) {
		$parsed = unserialize($data);
	}

	// Iterate over imported sliders
	if(is_array($parsed)) {

		$wp_upload_dir=wp_upload_dir();

		// Iterate over the sliders
		foreach($parsed as $sliderkey => $slider) {
	
			// Iterate over the layers
			foreach($parsed[$sliderkey]['layers'] as $layerkey => $layer) {
	
				// Change background images if any
				$parsed[$sliderkey]['layers'][$layerkey]['properties']['backgroundId'] = ''; 
				if(!empty($parsed[$sliderkey]['layers'][$layerkey]['properties']['background'])) {
					foreach($GLOBALS['omImportTool']['layer_slider_uploads_replace'] as $str=>$r ) {
						if($r == 'LS')
							$r = LS_ROOT_URL;
						else
							$r = $wp_upload_dir['baseurl'];
						$layer['properties']['background']=str_replace($str, $r, $layer['properties']['background']);
					}
					$parsed[$sliderkey]['layers'][$layerkey]['properties']['background'] = $layer['properties']['background'];
				}
	
				// Change thumbnail images if any
				$parsed[$sliderkey]['layers'][$layerkey]['properties']['thumbnailId'] = '';
				if(!empty($parsed[$sliderkey]['layers'][$layerkey]['properties']['thumbnail'])) {
					foreach($GLOBALS['omImportTool']['layer_slider_uploads_replace'] as $str=>$r ) {
						if($r == 'LS')
							$r = LS_ROOT_URL;
						else
							$r = $wp_upload_dir['baseurl'];
						$layer['properties']['thumbnail']=str_replace($str, $r, $layer['properties']['thumbnail']);
					}
					$parsed[$sliderkey]['layers'][$layerkey]['properties']['thumbnail'] = $layer['properties']['thumbnail'];
				}
	
				// Iterate over the sublayers
				if(isset($layer['sublayers']) && !empty($layer['sublayers'])) {
					foreach($layer['sublayers'] as $sublayerkey => $sublayer) {
	
						// Only IMG sublayers
						$parsed[$sliderkey]['layers'][$layerkey]['sublayers'][$sublayerkey]['imageId'] = '';
						if($sublayer['type'] == 'img' || ( isset($sublayer['media']) && $sublayer['media'] == 'img')) {
							foreach($GLOBALS['omImportTool']['layer_slider_uploads_replace'] as $str=>$r ) {
								if($r == 'LS')
									$r = LS_ROOT_URL;
								else
									$r = $wp_upload_dir['baseurl'];
								$sublayer['image']=str_replace($str, $r, $sublayer['image']);
							}
							$parsed[$sliderkey]['layers'][$layerkey]['sublayers'][$sublayerkey]['image'] = $sublayer['image'];
						}
					}
				}
			}
		}

		//  DB stuff
		global $wpdb;
		$table_name = $wpdb->prefix . "layerslider";

		// Import sliders
		foreach($parsed as $item) {

			// Fix for export issue in v4.6.4
			if(is_string($item)) { $item = json_decode($item, true); }

			// Add to DB
			$wpdb->query(
				$wpdb->prepare("INSERT INTO $table_name (name, data, date_c, date_m)
								VALUES (%s, %s, %d, %d)",
				$item['properties']['title'], json_encode($item), time(), time()
				)
			);
		}

	}
	
}

/****************************************/

function om_rev_import_slider($file) {

	if(!file_exists($file) || !class_exists('RevSlider'))
		return false;

	ob_start();
	$slider = new RevSlider();
	$response = $slider->importSliderFromPost(true, true, $file);
	ob_end_clean();

}

/****************************************/

function om_import_menu_meta($processed_menu_items) {
	
	if(empty($GLOBALS['omImportTool']['menu_add_meta']))
		return false;
		
	$add_meta_list=$GLOBALS['omImportTool']['menu_add_meta'];
			
	if(!class_exists('WXR_Parser'))
		require $GLOBALS['omImportTool']['path'] . 'includes/parsers.php';

	$parser = new WXR_Parser();
	$import_data = $parser->parse( $GLOBALS['omImportTool']['path'] . $GLOBALS['omImportTool']['wordpress_xml'] );
	unset($parser);

	if ( is_wp_error( $import_data ) ) {
		return false;
	}

	foreach($import_data['posts'] as $post) {
		if('nav_menu_item' == $post['post_type']) {
			$post_id=$post['post_id'];
			if(isset($processed_menu_items[$post_id])) {

				foreach($add_meta_list as $meta_name) {
					foreach($post['postmeta'] as $postmeta) {
						if($postmeta['key'] == $meta_name) {
							update_post_meta( $processed_menu_items[$post_id], $meta_name, $postmeta['value'] );
							break;
						}
					}
				}

			}
		}
	}
	
}