<?php
    class options{
		static $menu;
		static $register;
		static $default;
		static $fields;

        static function menu(){
            if( is_array( self::$menu ) && !empty( self::$menu) ){
                foreach( self::$menu as $main => $items ){
                    foreach( $items as $slug => $item ){
                        if( isset( $item['type'] ) ){
                            if( $item['type'] == 'main' ){
                                add_menu_page( $item['main_label'] , $item['main_label'] , 'administrator' , $main . '__' . $slug  , array( 'options', 'render_panel' ) , get_template_directory_uri() . '/lib/images/icon.png' );
                                $main_slug =  $main . '__' . $slug;
                                //add_submenu_page( $main_slug, '', '', 'administrator', $main . '__' . $slug , array( 'options', 'render_panel' ) );
                            }else{
                                add_submenu_page( $main_slug , $item['label'] , $item['label'] , 'administrator' , $main . '__' . $slug , array( 'options', 'render_panel' ) );
                            }
                        }else{
                            add_submenu_page( $main_slug , $item['label'] , $item['label'] , 'administrator' , $main . '__' . $slug , array( 'options', 'render_panel' ) );
                        }
                    }
                }
            }
        }

        static function render_panel(){
            if( isset( $_GET[ 'page' ] ) && strlen( $page = $_GET[ 'page' ] ) ){
                if( method_exists( 'options', $page ) ){
                    call_user_func( array( 'options', $page ) );
                }else{
                    if( isset( $_GET[ 'tab' ] ) ){
                        $page .= '__' . $_GET[ 'tab' ];
                    }
                    self::CallMenu( $page );
                }
            }
        }

        static function cosmothemes__general(){
            get_template_part('lib/templates/welcome_ message');
        }

        static function cosmothemes__templates(){
            $builder = new LBTemplateBuilder();
            $builder -> render();
        }

        static function CallMenu( $name ) {
            $slug           = $name;
            $keys 			= explode( '__' , $slug );
            list( $menu, $submenu ) = $keys;
            if( !isset( $keys[ 2 ] ) ){
                $val = array_keys( self::$menu[ $menu ][ $submenu ][ 'contains' ] );
                $keys[ 2 ] = array_shift( $val );
            }
            list( ,, $tab ) = $keys;
            $slug = implode( '__', $keys );
            $label          = isset( self::$menu[ $menu ][ $submenu ][ 'contains' ][ $tab ]['label'] ) ? self::$menu[ $menu ][ $submenu ][ 'contains' ][ $tab ]['label'] : '';
            $title          = isset( self::$menu[ $menu ][ $submenu ][ 'contains' ][ $tab ]['title'] ) ? self::$menu[ $menu ][ $submenu ][ 'contains' ][ $tab ]['title'] : '';
            $description    = isset( self::$menu[ $menu ][ $submenu ][ 'contains' ][ $tab ]['description'] ) ? self::$menu[ $menu ][ $submenu ][ 'contains' ][ $tab ]['description'] : '';
            $update         = isset( self::$menu[ $menu ][ $submenu ][ 'contains' ][ $tab ]['update'] ) ? self::$menu[ $menu ][ $submenu ][ 'contains' ][ $tab ]['update'] : true;
            includes::load_css();
            includes::load_js();
            echo '<div class="admin-page ' . $menu . '_' . $submenu . '_' . $tab . '" id="' . $menu . '_' . $submenu . '_' . $tab . '">';
            self::get_header( $menu, $submenu, $tab );
            self::get_page( $title, $slug, $description, $update );
            echo '</div>';
        }

        static function register(){
            foreach( self::$menu as $menu_slug => $menu ){
                foreach( $menu as $submenu_slug => $submenu ){
                    if( isset( $submenu[ 'contains' ] ) && is_array( $submenu[ 'contains' ] ) ){
                        foreach( $submenu[ 'contains' ] as $tab_slug => $whatever ){
                            $page = implode( '__', array( $menu_slug, $submenu_slug, $tab_slug ) );
                            register_setting( $page, $tab_slug  );
                        }
                    }
                }
            }
            register_setting( 'cosmothemes__templates', 'templates' );
        }


        static function save_templates(){
            
            $current_template = get_option("templates");
            $_POST      = array_map( 'stripslashes_deep', $_POST );
            $new_template_id = '';
            foreach ($_POST['templates'] as $key => $template) {
                if ($key != 'last_selected') {
                    if(!strlen($new_template_id)){
                        $new_template_id = $key;
                    }
                    $ab = $_POST['templates'][$key];
                    $current_template[$key] = $ab;
                }
            }
            update_option('templates' ,$current_template);
            echo $new_template_id;
            exit();
        }

        static function delete_template($id){
            $id = $_POST['template_id'];
            $current_template = get_option("templates");
            if (isset($current_template[$id])) {
                unset($current_template[$id]);
            }
            
            update_option('templates' ,$current_template);
            exit();
        }

        static function box(){
            if( is_array( self::$menu ) && !empty( self::$menu ) ){
                foreach( self::$menu  as $key => $value ){
                    switch( count( $value )  ){
                        case 7 : {
                            $value[0]( $value[1] , $value[2] , $value[3] , $value[4] , $value[5] , $value[6] );
                            break;
                        }
                    }
                }
            }
        }

		static function get_header( $menu, $submenu, $current ){
			$result = '';
            if(isset($menu) && strlen($menu) && isset($submenu) && strlen($submenu) && isset($current) && strlen($current)){
                $_menu = self::$menu[ $menu ][ $submenu ][ 'contains' ];
            }    
    		
        	if(BRAND == ''){
				$brand_logo = get_template_directory_uri().'/images/freetotryme.png';
			}else{
				$brand_logo = get_template_directory_uri().'/images/cosmothemes.png';
			}
			
			$ct = wp_get_theme();
            
			$result .= '<div class="mythemes-intro">';
            $result .= '<img src="'.$brand_logo.'" />';
			$result .= '<span class="theme">'.$ct->title.' '.__('Version' , 'cosmotheme').': '.$ct->version.'</span>';
            $result .= '</div>';

            if(isset($menu) && strlen($menu) && isset($submenu) && strlen($submenu) && isset($current) && strlen($current)){
    			if( is_array( $_menu ) ){
    				$result .= '<div class="admin-menu">';
    				$result .= '<ul>';
    				foreach( $_menu as $slug => $info){
                        $result .= '<li '. self::get_class( $slug , $current ) .' id="'.$slug.'"><a href="' . self::get_path( $menu . '__' . $submenu, $slug ) . '">' . get_item_label( $info['label'] ) . '</a></li>';
    				}
    				$result .= '</ul>';
    				$result .= '</div>';
    			}
            }
            echo $result;
		}

        static function get_path( $slug, $tab ){
            $path = '?page=' . $slug . '&tab=' . $tab;
            return $path;
        }

        static function get_class( $slug , $current ){
            
            if( $current == $slug ){
                if( substr( $slug , 0 , 1 ) == '_' ){
                    $slug = substr( $slug , 1 , strlen( $slug ) );
                }
            
                $slug = str_replace( '_' , '-' , $slug  );
                
                return 'class="current ' . $slug . '"';
            }else{
                if( substr( $slug , 0 , 1 ) == '_' ){
                    $slug = substr( $slug , 1 , strlen( $slug ) );
                }
            
                $slug = str_replace( '_' , '-' , $slug  );
                
                return ' class="' . $slug . '"';
            }

        }

        static function get_page( $title , $slug ,  $description = '' , $update = true ){
?>
            <div class="admin-content">
<?php
                if(isset($_GET['settings-updated']) && $_GET['settings-updated'] = 'true'){
?>

                    <div id="message" class="updated">
                        <p><strong><?php _e('Settings saved.','cosmotheme') ?></strong></p>
                    </div>
<?php
                }
?>                    
                <div class="title">
                    <h2><?php echo $title; ?></h2>
                    <?php
                        if( strlen( $description ) ){
                    ?>
                            <p><?php echo $description; ?></p>
                    <?php
                        }
                    ?>
                </div>
            <?php
                if( $update ){
            ?>
                    <form action="options.php" method="post">
            <?php
                        
                }
                        settings_fields( $slug );
						$items = explode( '__' , $slug );

                        echo self::get_fields( $items[2] );
                if( $update ){
            ?>
                        <div class="standard-generic-field submit">
                            <div class="field">
                                <input type="submit" value="<?php _e( 'Update Settings' , 'cosmotheme' ); ?>"/>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </form>
            <?php
                }else{
            ?>
                    <div class="record submit"></div>
            <?php
                }
            ?>
			</div>
<?php
        }

        static function get_fields( $group ){
            $result = '';
            if( isset( self::$fields[ $group ] ) ){
                foreach( self::$fields[ $group ] as $side => $field ){
                    if(is_array($field)){
                        $field['topic'] = $side;
                        $field['group'] = $group;
                        if( !isset( $field['value'] ) ){
                            $field['value'] = self::get_value( $group , $side );
                        }

                        $field['ivalue'] = self::get_value( $group , $side );
                    }
                    /* special for upload-id*/
                    if( isset( $field['type'] ) ){
                        $type = explode( '--' , $field['type'] );
                        if( isset( $type[1] ) && $type[1] == 'upload-id' ){
							$option = self::get_value( $group );
                            $value_id = isset( $option[ $side .'_id' ] ) ? $option[ $side .'_id' ] : 0;
                            $field['value_id'] = $value_id;
                        }
                    }

                    $result .= fields::layout( $field );
                }
            }
			
            return $result;
        }

        

        static function get_digit_array( $to , $from = 0 , $twodigit = false ){
            $result = array();
            for( $i = $from; $i < $to + 1; $i ++ ){
                if( $twodigit ){
                    $i = (string)$i;
                    if( strlen( $i ) == 1 ){
                        $i = '0' . $i;
                    }
                    $result[$i] = $i;
                }else{
                    $result[$i] = $i;
                }
            }

            return $result;
        }

        static function get_value( $group , $side = null , $id = null){
            $g = $group;
            $s = $side;
            $i = $id;
            
            $v = @get_option( $g );
            if( is_array( $v ) ){
                if( strlen( $s ) ){
                    if( isset( $v[ $s ] ) ){
                        if( is_int( $i ) ){
                            if( isset( $v[ $s ][ $i ] ) ){
                                return $v[ $s ][ $i ];
                            }else{
                                if( isset( options::$default[ $g ][ $s ][ $i ] )){
                                    return options::$default[ $g ][ $s ][ $i ];
                                }else{
                                    return '';
                                }
                            }
                        }else{
                            return $v[ $s ];
                        }
                    }else{
                        if( isset( options::$default[ $g ][ $s ])){
                            return options::$default[ $g ][ $s ];
                        }else{
                            return '';
                        }
                    }
                }else{
                    return $v;
                }
            }else{
                if( strlen( $s ) ){
                    if( isset( options::$default[ $g ][ $s ] ) ){
                        if( is_int( $i ) ){
                            if( isset( options::$default[ $g ][ $s ][ $i ] ) ){
                                return options::$default[ $g ][ $s ][ $i ];
                            }else{
                                return '';
                            }
                        }else{
                            return options::$default[ $g ][ $s ];
                        }
                    }else{
                        return '';
                    }
                }else{
                    if( isset( options::$default[ $g ])){
                        return options::$default[ $g ];
                    }else{
                        return '';
                    }
                }
            }
        }

        static function logic( $group , $side = null , $id = null ){
 
            $values = self::get_value( $group , $side , $id );
            if( !is_array( $values ) ){
                if( $values == 'yes' ){
                    return  true;
                }

                if( $values == 'no' ){
                    return false;
                }
            }

            return $values;
        }
        
    	static function my_categories( $nr = -1  , $exclude = array() ){
            $categories = get_categories();

            $result = array();
            foreach($categories as $key => $category){
                if( $key == $nr ){
                    break;
                }
                if( $nr > 0 ){
                    if( !in_array( $category -> term_id , $exclude ) ){
                        $result[ $category -> term_id ] = $category -> term_id;
                    }
                }else{
                    if( !in_array( $category -> term_id , $exclude ) ){
                        $result[ $category -> term_id ] = $category -> cat_name;
                    }
                }
            }

            return $result;
        }

		static function set_cosmo_news(){
			if(isset($_POST['msg_id'])){
				update_option($_POST['msg_id'].'_closed', 'disabled');
			}
			exit;
		}
    }

	class api_call{

		static function getCosmoNews(){
			$key = 'cosmo_news_alert';

			$last_news = array();  
			// Let's see if we have a cached version
			$saved_cosmo_news_alert = get_transient($key);
			if ($saved_cosmo_news_alert !== false ){
				$last_news = $saved_cosmo_news_alert;
			}else{
				// If there's no cached version we ask is from Cosmothemes
				//$response = wp_remote_get("http://cosmothemes.com/api/news.php?key=D9a0ee79GEHdD");
				$response = wp_remote_get("http://dev.cosmothemes.com/tst/api/news.php?key=D9a0ee79GEHdD");
				
				if (is_wp_error($response))
				{
					// In case Cosmothemes is down we return the last successful info
					$saved_option = get_option($key);
					//var_dump($saved_option);
					if(is_array($saved_option) && sizeof($saved_option)){
						$last_news = get_option($key);
					}
				}
				else
				{
					// If everything's okay, parse the body and json_decode it

					$json = json_decode(wp_remote_retrieve_body($response));

					if(sizeof($json)){
						$responce_size = 0;
						foreach($json as $news ){
							$responce_size ++;
						}
						$counter = 0;	
						foreach($json as $index => $news ){
							$counter ++;
							if( $responce_size == $counter  ){
								$last_news[$index] = $news;
							}
						}
					}	
					
					if(sizeof($last_news) ){	
						
							// Store the result in a transient, expires after 1 day
							// Also store it as the last successful using update_option
							set_transient($key, $last_news, 60*60*24); //1 day cache
							update_option($key, $last_news);
						
					
					}

				}

				
			}

			if(sizeof($last_news) ){
				
				foreach($last_news as $ind => $msg){
					$msg_key = $ind;
					$message = $msg;
				}	
		
				if(get_option($msg_key.'_closed') == ''){  

					$fn = "closeCosmoMsg(\'".trim($msg_key)."\');";	  
					$alert_msg1 =  '<div id="cosmo_news" >'.$message;
					$alert_msg1 .= '<span class="close_msg" onclick="'.$fn.'" >'.__('Close','cosmotheme').'</span>';   
					$alert_msg1 .= '</div>'; 
					
					/*insert the notification message in wphead */
					$result = '<script type="text/javascript">
								  jQuery(document).ready(function() {    
											jQuery("#wphead").append(\''.$alert_msg1.'\');	
									
								});	
								jQuery(document).ready(function() {    
											jQuery("#wpcontent").prepend(\''.$alert_msg1.'\');	
									
								});
							  </script>';  
				}else{
					$result ='';	  
				}
				
			}else{
				$result ='';	
			}	  

			return $result;
		}
		
		static function getLastThemeVersion(){
			$key = ZIP_NAME . '__theme_version';

			// Let's see if we have a cached version
			$saved_theme_version = get_transient($key);
			if ($saved_theme_version !== false){
				return $saved_theme_version;
			}else{
				// If there's no cached version we ask Twitter
				$response = wp_remote_get("http://cosmothemes.com/api/versions.php?key=D9a0ee79GEHdD&tn=".ZIP_NAME);
				if (is_wp_error($response))
				{
					// In case cosmothemes.com is down we return the last successful count
					return get_option($key);
				}
				else
				{
					// If everything's okay, parse the body and json_decode it
					$json = json_decode(wp_remote_retrieve_body($response));
					
					if(isset($json->version)){	
						$available_theme_version = $json->version;
						
						if(is_numeric($available_theme_version)){   
							// Store the result in a transient, expires after 1 day
							// Also store it as the last successful using update_option
							set_transient($key, $available_theme_version, 60*60*24); /*1 day cache*/
							
							update_option($key, $available_theme_version);
						}
						return $available_theme_version;
					}else{
						return;
					}

				}
			}

		}

		/*if there is available a newer version then we will return some js code that will be appended to the head*/  
		static function compareVersions(){
			$last_version = false;
			
			$theme_data = wp_get_theme();    
            
			$this_theme_version = $theme_data['Version'];
		  
			if(is_numeric($last_version) && is_numeric($this_theme_version) && $this_theme_version < $last_version){
				$alert_msg =  '<div id="cosmo_new_version">'.$theme_data["Name"].' '.__("version","cosmotheme").' '.$last_version.' '.__("is available, please update now.","cosmotheme").'</div>'; 
				
				/*insert the notification message in wphead */
				$result = '<script type="text/javascript">
							  jQuery(document).ready(function() {    
										jQuery("#wphead").append(\''.$alert_msg.'\');	
								
							});	
								jQuery(document).ready(function() {    
									jQuery("#wpcontent").prepend(\''.$alert_msg.'\');	
									
								});
						  </script>';  
				return $result;
			}
		}
	}
?>