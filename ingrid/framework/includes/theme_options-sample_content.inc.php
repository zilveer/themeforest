<?php

// THEME OPTIONS

// sample content
						


						
						
		
	//start import
	if(!empty($_POST) && !empty($_POST['tp_sc_step']) && $_POST['tp_sc_step'] == 'import' && !empty($_GET['page']) && $_GET['page'] == 'tp_theme_sample_content'){
			
		//self check first		
			$headerprefix = '';

		
			//test PHP ini setting for file read						
				if(ini_get('allow_url_fopen') != '1' && ini_get('allow_url_fopen') != 'On'){
					$headerprefix = '&error=ini';
				}			
			
			//test theme folder position
				if(empty($headerprefix)){
					$themedir = get_template_directory_uri();
					$themedir = explode('wp-content/themes/',$themedir);
					if(strstr($themedir[1],'/')){
						$headerprefix = '&error=1';
					}			
				}
			
					
			//test mkdir
				if(empty($headerprefix)){
					$uploads_dir = '../wp-content/uploads';
					if(!is_dir($uploads_dir)){
						if(!mkdir($uploads_dir)){
							$headerprefix = '&error=2';					
						}
					}
				}
			
			
			//test copy		
				if(empty($headerprefix)){			
					$themepath = '../wp-content/themes/'.$themedir[1];
					@mkdir($uploads_dir.'/2013/03', 0777, true);
					@mkdir($uploads_dir.'/2013/04', 0777, true);
					if(!copy($themepath.'/sample_content/media/03/1b-bg.png', '../wp-content/uploads/2013/03/1b-bg.png')){
						$headerprefix = '&error=3';				
					}
				}
			
						
			//test read data.imp file			
				$options = array(
				  'http'=>array(
					'method'=>"GET",
					'header'=>"Accept-language: en\r\n" .
							  "Cookie: foo=bar\r\n" . 
							  "User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n"
				  )
				);
				$context = stream_context_create($options);
			
				if(empty($headerprefix)){
					if(!@file_get_contents(get_template_directory_uri().'/sample_content/data.imp', false, $context)){
						$headerprefix = '&error=5';	
						print_r(error_get_last());
						die();						
					}
				}
				
			
	
			
			
			//if no error, begin import
			if(empty($headerprefix)){
								
				//copy all media files
					$alldemofiles = $themepath.'/sample_content/media/03';
					$files = glob($alldemofiles.'/*.*');
					foreach($files as $file){
						$file_to_go = str_replace($alldemofiles,'../wp-content/uploads/2013/03',$file);
						if(!copy($file, $file_to_go)){
							$headerprefix = '&error=4';	
						}
					}
					
					$alldemofiles = $themepath.'/sample_content/media/04';
					$files = glob($alldemofiles.'/*.*');
					foreach($files as $file){
						$file_to_go = str_replace($alldemofiles,'../wp-content/uploads/2013/04',$file);
						if(!copy($file, $file_to_go)){
							$headerprefix = '&error=4';	
						}
					}
					
					
				//import data to db
					global $wpdb;								
					
					
				
					//posts, pages, media library
						//read SQL file and query the lines one by one with correct table prefix
						//if table prefix is not the default one, replace tables in each query
					
						$tdir = get_template_directory_uri();
						
						global $wpdb;								
						
						$getimp = file_get_contents($tdir.'/sample_content/data.imp');
						$implines = explode('<ingrid_sep>',$getimp);
						
						
						
							//clear tables							
							$wpdb->query('TRUNCATE TABLE '.$wpdb->prefix.'comments');
							$wpdb->query('TRUNCATE TABLE '.$wpdb->prefix.'postmeta');
							$wpdb->query('TRUNCATE TABLE '.$wpdb->prefix.'posts');
							$wpdb->query('TRUNCATE TABLE '.$wpdb->prefix.'term_relationships');
							$wpdb->query('TRUNCATE TABLE '.$wpdb->prefix.'term_taxonomy');
							$wpdb->query('TRUNCATE TABLE '.$wpdb->prefix.'terms');
						
							//check-clear revslider tables
								if(!$wpdb->get_var("SHOW TABLES LIKE '%revslider_sliders'")) {
									//create table
									$charset_collate = '';

									if ( ! empty( $wpdb->charset ) ) {
									  $charset_collate = 'DEFAULT CHARACTER SET '.$wpdb->charset;
									}

									if ( ! empty( $wpdb->collate ) ) {
									  $charset_collate .= ' COLLATE '.$wpdb->collate;
									}
									
									$sql = "CREATE TABLE ".$wpdb->prefix."revslider_sliders (
									id int(9) NOT NULL AUTO_INCREMENT,
									title tinytext NOT NULL,
									alias tinytext,
									params text NOT NULL,
									PRIMARY KEY (id)
									) ".$charset_collate.";";
									
									require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
									dbDelta( $sql );
									
									
								}else{
									//clear table if exist
									$wpdb->query('TRUNCATE TABLE '.$wpdb->prefix.'revslider_sliders');
								}
								
								if(!$wpdb->get_var("SHOW TABLES LIKE '%revslider_slides'")) {
									//create table
									$charset_collate = '';

									if ( ! empty( $wpdb->charset ) ) {
									  $charset_collate = 'DEFAULT CHARACTER SET '.$wpdb->charset;
									}

									if ( ! empty( $wpdb->collate ) ) {
									  $charset_collate .= ' COLLATE '.$wpdb->collate;
									}
									
									$sql = "CREATE TABLE ".$wpdb->prefix."revslider_slides (
									id int(9) NOT NULL AUTO_INCREMENT,
									slider_id int(9) NOT NULL,
									slide_order int(11) NOT NULL,
									params text NOT NULL,
									layers text NOT NULL,
									PRIMARY KEY (id)
									) ".$charset_collate.";";
									
									require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
									dbDelta( $sql );
									
								}else{
									//clear table if exist
									$wpdb->query('TRUNCATE TABLE '.$wpdb->prefix.'revslider_slides');
								}
							
						
						
						
						
							//run each query
							foreach($implines as $line){
								if(!empty($line)){									
									//prefix check, replace										
									
										if(strstr($line,'wp_comments') && $wpdb->prefix != 'wp_'){
											$line = str_replace('wp_comments',$wpdb->prefix.'comments',$line);																				
										}
										
										if(strstr($line,'wp_postmeta')){
											if($wpdb->prefix != 'wp_'){
												$line = str_replace('wp_postmeta',$wpdb->prefix.'postmeta',$line);	
											}
																					
											//also replace my path to user path
											$currsiteurl = get_site_url();
											$line = str_replace('http://localhost/ingrid',$currsiteurl,$line);
										}
										
										if(strstr($line,'wp_posts')){
											if($wpdb->prefix != 'wp_'){
												$line = str_replace('wp_posts',$wpdb->prefix.'posts',$line);
											}
											
											//also replace my path to user path
											$currsiteurl = get_site_url();
											$line = str_replace('http://localhost/ingrid',$currsiteurl,$line);
										}
										
										if(strstr($line,'wp_term_relationships') && $wpdb->prefix != 'wp_'){
											$line = str_replace('wp_term_relationships',$wpdb->prefix.'term_relationships',$line);
										}
										
										if(strstr($line,'wp_term_taxonomy') && $wpdb->prefix != 'wp_'){
											$line = str_replace('wp_term_taxonomy',$wpdb->prefix.'term_taxonomy',$line);
										}
										
										if(strstr($line,'wp_terms') && $wpdb->prefix != 'wp_'){
											$line = str_replace('wp_terms',$wpdb->prefix.'terms',$line);
										}
										
										//revslider
										if(strstr($line,'wp_revslider_sliders')){
											if($wpdb->prefix != 'wp_'){
												$line = str_replace('wp_revslider_sliders',$wpdb->prefix.'revslider_sliders',$line);
											}																						
										}
										
										if(strstr($line,'wp_revslider_slides')){
											if($wpdb->prefix != 'wp_'){
												$line = str_replace('wp_revslider_slides',$wpdb->prefix.'revslider_slides',$line);
											}											
										}
										
										
										
										
										
										
										
									//process the line	
										if(!$wpdb->query($line)){
											$headerprefix = '&error=6';
										}

								}
							}
							
							
							
						
							//fix revslider paths
								$csurl = get_site_url();
								$csurl = str_replace('/','\\\/',$csurl);
								$wpdb->query("UPDATE ".$wpdb->prefix."revslider_slides SET params = REPLACE(params, 'replacethistp', '".$csurl."')");
								$wpdb->query("UPDATE ".$wpdb->prefix."revslider_slides SET layers = REPLACE(layers, 'replacethistp', '".$csurl."')");
								$wpdb->query("UPDATE ".$wpdb->prefix."revslider_sliders SET params = REPLACE(params, 'replacethistp', '".$csurl."')");
							
						
						
						
				
					
				
					//settings, options, widgets	
						if(empty($headerprefix)){					
							update_user_meta( '1', 'description', 'Phasellus augue arcu, accumsan in vulputate in, porttitor ac mauris. Mauris bibendum ornare rutrum. Duis suscipit lectus orci, eu laoreet lorem. Fusce varius, magna et auctor venenatis.');
							
							update_option('category_children',unserialize('a:1:{i:3;a:3:{i:0;i:4;i:1;i:10;i:2;i:13;}}'));	
							update_option('page_for_posts','211');	
							update_option('page_on_front','829');	
							update_option('permalink_structure','');
							update_option('posts_per_page','4');
							update_option('show_on_front','page');
							update_option('sidebars_widgets',unserialize('a:7:{s:19:"wp_inactive_widgets";a:0:{}s:19:"sidebar-widget-area";a:3:{i:0;s:10:"nav_menu-3";i:1;s:8:"search-2";i:2;s:16:"tp_widget_tabs-2";}s:24:"first-footer-widget-area";a:1:{i:0;s:6:"text-2";}s:25:"second-footer-widget-area";a:1:{i:0;s:6:"text-3";}s:24:"third-footer-widget-area";a:1:{i:0;s:24:"tp_widget_contact_info-2";}s:25:"fourth-footer-widget-area";a:1:{i:0;s:10:"nav_menu-2";}s:13:"array_version";i:3;}'));
							update_option('theme_mods_ingrid',unserialize('a:2:{i:0;b:0;s:18:"nav_menu_locations";a:1:{s:7:"primary";i:20;}}'));
							update_option('tp_posts_default_f1_widget_area','first-footer-widget-area');
							update_option('tp_posts_default_f2_widget_area','second-footer-widget-area');
							update_option('tp_posts_default_f3_widget_area','third-footer-widget-area');
							update_option('tp_posts_default_f4_widget_area','fourth-footer-widget-area');
							update_option('tp_posts_default_sb_widget_area','primary-widget-area');
							update_option('tp_widget_contact_info_address','Awesome Blvd.78, NY, USA');
							update_option('tp_widget_contact_info_email','info@coolcompany.com');
							update_option('tp_widget_contact_info_phone','+42 5355 6781');
							update_option('tp_widget_contact_info_title','CONTACT INFORMATION');
							update_option('tp_widget_contact_info_title','CONTACT INFORMATION');
							update_option('widget_nav_menu',unserialize('a:3:{i:2;a:2:{s:5:"title";s:14:"IMPORTANT MENU";s:8:"nav_menu";i:22;}i:3;a:2:{s:5:"title";s:14:"SUB NAVIGATION";s:8:"nav_menu";i:21;}s:12:"_multiwidget";i:1;}'));
							update_option('widget_search',unserialize('a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}'));
							
							$wtarr = unserialize('a:3:{i:2;a:3:{s:5:"title";s:0:"";s:4:"text";s:85:"<img src="http://localhost/ingrid/wp-content/themes/ingrid/images/footer_logo.png" />";s:6:"filter";b:0;}i:3;a:3:{s:5:"title";s:17:"ABOUT THE COMPANY";s:4:"text";s:274:"We are inGrid Ltd. and we create awesome stuff! Look around on our site and figure out why we are the best on the market!

[icon type="facebook" link="#"][icon type="twitter" link="#"][icon type="google+" link="#"][icon type="pinterest" link="#"][icon type="rss" link="#"]";s:6:"filter";b:1;}s:12:"_multiwidget";i:1;}');
							$wtarr[2]['text'] = str_replace('http://localhost/ingrid/wp-content/themes/ingrid',get_template_directory_uri(),$wtarr[2]['text']);							
							update_option('widget_text',$wtarr);
							update_option('widget_tp_widget_contact_info',unserialize('a:2:{i:2;a:4:{s:28:"tp_widget_contact_info_title";s:19:"CONTACT INFORMATION";s:30:"tp_widget_contact_info_address";s:24:"Awesome Blvd.78, NY, USA";s:28:"tp_widget_contact_info_phone";s:13:"+42 5355 6781";s:28:"tp_widget_contact_info_email";s:20:"info@coolcompany.com";}s:12:"_multiwidget";i:1;}'));
							update_option('widget_tp_widget_tabs',unserialize('a:2:{i:2;a:15:{s:17:"tp_w_tabs_1_title";s:6:"RECENT";s:17:"tp_w_tabs_2_title";s:10:"CATEGORIES";s:17:"tp_w_tabs_3_title";s:7:"POPULAR";s:19:"tp_w_tabs_1_content";s:6:"recent";s:19:"tp_w_tabs_2_content";s:4:"cats";s:19:"tp_w_tabs_3_content";s:7:"popular";s:18:"tp_w_tabs_1_custom";s:0:"";s:18:"tp_w_tabs_2_custom";s:0:"";s:18:"tp_w_tabs_3_custom";s:0:"";s:19:"tp_w_tabs_1_p_count";s:1:"3";s:19:"tp_w_tabs_2_p_count";s:0:"";s:19:"tp_w_tabs_3_p_count";s:1:"3";s:19:"tp_w_tabs_tab1_cats";a:1:{i:0;s:1:"2";}s:19:"tp_w_tabs_tab2_cats";N;s:19:"tp_w_tabs_tab3_cats";a:1:{i:0;s:1:"2";}}s:12:"_multiwidget";i:1;}'));
							
							
						}
				
				
				
				
				//if all went fine			
					if(empty($headerprefix)){
						$headerprefix = '&success=1';					
					}
			}
		
			
		header('Location: admin.php?page=tp_theme_sample_content'.$headerprefix);						
		
	}
	
	
		
	//display option layout	
	function tp_theme_sample_content(){
		global $framework_url;

		if(!empty($_GET['success']) && $_GET['success'] == '1'){
			print '<div id="message" class="updated"><p>'.__('Demo content has been imported successfully!','ingrid').'</p></div>';
		}
				
		
		
		print '<div class="wrap">	
			<h2>'.__( 'Sample Content Import', 'ingrid' ).'</h2>	
		
			<form method="post" action="" enctype="multipart/form-data">		
			';
			
			if(!empty($_GET['error'])){
				if($_GET['error'] == '1'){
					print '<p>'.__( '<strong>Error!</strong> Theme folder is not installed into the correct folder structure!<br /><br /><strong>Correct:</strong> yoursite.com/wp-content/themes/ingrid/<br /><strong>Wrong:</strong> yoursite.com/wp-content/themes/ingrid/ingrid/', 'ingrid' ).'</p>
					';
				}elseif($_GET['error'] == '2'){
					print '<p>'.__( '<strong>Error!</strong> Couldn\'t create/access <strong>wp-content/upload</strong> directory! Permission problem?','ingrid').'</p>
					';
				}elseif($_GET['error'] == '3'){
					print '<p>'.__( '<strong>Error!</strong> Couldn\'t copy a file into <strong>wp-content/upload</strong> directory! Permission problem?','ingrid').'</p>
					';
				}elseif($_GET['error'] == '4'){
					print '<p>'.__( '<strong>Error!</strong> Couldn\'t copy one or more files!','ingrid').'</p>
					';
				}elseif($_GET['error'] == '5'){
					print '<p>'.__( '<strong>Error!</strong> Couldn\'t read sample content data file!','ingrid').'</p>
					';
				}elseif($_GET['error'] == '6'){
					print '<p>'.__( '<strong>Error!</strong> One or more database query failed!','ingrid').'</p>
					';
				}elseif($_GET['error'] == 'ini'){
					print '<p>'.__( '<strong>Error!</strong> The PHP <b>allow_url_fopen</b> setting is disabled on your server! Please enable it (at least temporary)!','ingrid').'</p>
					';
				}
				
			}elseif(!empty($_POST) && $_POST['tp_sc_step'] == 'confirm'){
				
				print '<table class="form-table">			
					<tr valign="top">					
						<td><p>'.__('<strong>Warning! The importing process will remove your existing posts, pages and media library!<br />Are you sure you want to proceed?</strong>','ingrid').'<br />							
						</p></td>
					</tr>
				</table>
				
				<p class="submit">
					<input type="hidden" name="tp_sc_step" value="import" />
					<input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Yes! Import sample content!', 'ingrid' ).'"  />
				</p>';
			}elseif(!empty($_GET['success']) && $_GET['success'] == '1'){
				
				print '<table class="form-table">			
					<tr valign="top">					
						<td><p>'.__('<strong>Success!</strong> Please <a href="themes.php?page=install-required-plugins">install required plugins</a> in case you haven\'t already done so!','ingrid').'<br />							
						</p></td>
					</tr>
				</table>
				';
			}else{
				
				print '
				<table class="form-table">			
					<tr valign="top">					
						<td><p>'.__('Here you\'re able to import the contents of live preview with a single click. However you have to manually import the WooCommerce demo content in case you need it.
						<br /><strong>Please note:</strong> due to licenses all images and videos will be blurred!','ingrid').'<br /><br /><br />
						<strong>Warning! The importing process will remove your existing posts, pages and media library! It\'s recommended to use a fresh, clean WordPress install! </strong><br />							
						</p></td>
					</tr>
				</table>
				
				<p class="submit">
					<input type="hidden" name="tp_sc_step" value="confirm" />
					<input type="submit" name="submit" id="submit" class="button button-primary" value="'.__( 'Import sample content', 'ingrid' ).'"  />
				</p>	
				';
				
			}
			
			
		print '					
			</form>		
		</div>';
	}




?>