<?php
/**
 *
 */
function mysite_options_init() {
	register_setting( MYSITE_SETTINGS, MYSITE_SETTINGS );
	
	# Add default options if they don't exist
	add_option( MYSITE_SETTINGS, mysite_default_options( 'settings' ) );
	add_option( MYSITE_INTERNAL_SETTINGS, mysite_default_options( 'internal' ) );
	# delete_option(MYSITE_SETTINGS);
	# delete_option(MYSITE_INTERNAL_SETTINGS);
	
	if( mysite_ajax_request() ) {
		# Ajax option save
		if( isset( $_POST['mysite_option_save'] ) ) {
			mysite_ajax_option_save();
			
		# Sidebar option save
		} elseif( isset( $_POST['mysite_sidebar_save'] ) ) {
			mysite_sidebar_option_save();
			
		} elseif( isset( $_POST['mysite_sidebar_delete'] ) ) {
			mysite_sidebar_option_delete();
			
		} elseif( isset( $_POST['action'] ) && $_POST['action'] == 'add-menu-item' ) {
			add_filter( 'nav_menu_description', create_function('','return "";') );
		}
	}
	
	# Option import
	if( ( !mysite_ajax_request() ) && ( isset( $_POST['mysite_import_options'] ) ) ) {
		mysite_import_options( $_POST[MYSITE_SETTINGS]['import_options'] );

	# Reset options
	} elseif( ( !mysite_ajax_request() ) && ( isset( $_POST[MYSITE_SETTINGS]['reset'] ) ) ) {
		update_option( MYSITE_SETTINGS, mysite_default_options( 'settings' ) );
		delete_option( MYSITE_SIDEBARS );
		wp_redirect( admin_url( 'admin.php?page=mysite-options&reset=true' ) );
		exit;
		
	# $_POST option save
	} elseif( ( !mysite_ajax_request() ) && ( isset( $_POST['mysite_admin_wpnonce'] ) ) ) {
		unset(  $_POST[MYSITE_SETTINGS]['export_options'] );
	}
	
}

/**
 *
 */
function mysite_sidebar_option_delete() {
	check_ajax_referer( MYSITE_SETTINGS . '_wpnonce', 'mysite_admin_wpnonce' );
	
	$data = $_POST;
	
	$saved_sidebars = get_option( MYSITE_SIDEBARS );
	
	$msg = array( 'success' => false, 'sidebar_id' => $data['sidebar_id'], 'message' => sprintf( __( 'Error: Sidebar &quot;%1$s&quot; not deleted, please try again.', MYSITE_ADMIN_TEXTDOMAIN ), $data['mysite_sidebar_delete'] ) );
	
	unset( $saved_sidebars[$data['sidebar_id']] );
	
	if( update_option( MYSITE_SIDEBARS, $saved_sidebars ) ) {
		$msg = array( 'success' => 'deleted_sidebar', 'sidebar_id' => $data['sidebar_id'], 'message' => sprintf( __( 'Sidebar &quot;%1$s&quot; Deleted.', MYSITE_ADMIN_TEXTDOMAIN ), $data['mysite_sidebar_delete'] ) );
	}
	
	$echo = json_encode( $msg );

	@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
	echo $echo;
	exit;
}

/**
 *
 */
function mysite_sidebar_option_save() {
	check_ajax_referer( MYSITE_SETTINGS . '_wpnonce', 'mysite_admin_wpnonce' );
	
	$data = $_POST;
	
	$saved_sidebars = get_option( MYSITE_SIDEBARS );
	
	$msg = array( 'success' => false, 'sidebar' => $data['custom_sidebars'], 'message' => sprintf( __( 'Error: Sidebar &quot;%1$s&quot; not saved, please try again.', MYSITE_ADMIN_TEXTDOMAIN ), $data['custom_sidebars'] ) );
	
	if( empty( $saved_sidebars ) ) {
		$update_sidebar[$data['mysite_sidebar_id']] = $data['custom_sidebars'];
		
		if( update_option( MYSITE_SIDEBARS, $update_sidebar ) )
			$msg = array( 'success' => 'saved_sidebar', 'sidebar' => $data['custom_sidebars'], 'sidebar_id' => $data['mysite_sidebar_id'], 'message' => sprintf( __( 'Sidebar &quot;%1$s&quot; Added.', MYSITE_ADMIN_TEXTDOMAIN ), $data['custom_sidebars'] ) );
		
	} elseif( is_array( $saved_sidebars ) ) {
		
		if( in_array( $data['custom_sidebars'], $saved_sidebars ) ) {
			$msg = array( 'success' => false, 'sidebar' => $data['custom_sidebars'], 'message' => sprintf( __( 'Sidebar &quot;%1$s&quot; Already Exists.', MYSITE_ADMIN_TEXTDOMAIN ), $data['custom_sidebars'] ) );
			
		} elseif( !in_array( $data['custom_sidebars'], $saved_sidebars ) ) {
			$sidebar[$data['mysite_sidebar_id']] = $data['custom_sidebars'];
			$update_sidebar = $saved_sidebars + $sidebar;
			
			if( update_option( MYSITE_SIDEBARS, $update_sidebar ) )
				$msg = array( 'success' => 'saved_sidebar', 'sidebar' => $data['custom_sidebars'], 'sidebar_id' => $data['mysite_sidebar_id'], 'message' => sprintf( __( 'Sidebar &quot;%1$s&quot; Added.', MYSITE_ADMIN_TEXTDOMAIN ), $data['custom_sidebars'] ) );
			
		}
	}
		
	$echo = json_encode( $msg );

	@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
	echo $echo;
	exit;
}

/**
 *
 */
function mysite_ajax_option_save() {
	check_ajax_referer( MYSITE_SETTINGS . '_wpnonce', 'mysite_admin_wpnonce' );
	
	$data = $_POST;
	
	unset( $data['_wp_http_referer'], $data['_wpnonce'], $data['action'], $data['mysite_full_submit'], $data[MYSITE_SETTINGS]['export_options'] );
	unset( $data['mysite_admin_wpnonce'], $data['mysite_option_save'], $data['option_page'] );
	
	// TinyMCE editor IDs cannot have brackets.
	// This is the fix for now.
	foreach( $data as $key => $value ) {
		if( strpos( $key, '-bracket-' ) !== false ) {
			$option_name = explode( '-bracket-', $key );
			$data[MYSITE_SETTINGS][$option_name[1]] = $value;
			unset( $data[$key] );
		}
	}
	
	$msg = array( 'success' => false, 'message' => __( 'Error: Options not saved, please try again.', MYSITE_ADMIN_TEXTDOMAIN ) );
	
	$twitter_verify_api = Mysitemyway_Twitter::get_instance()->verify_api( $data[MYSITE_SETTINGS] );
	
	if( get_option( MYSITE_SETTINGS ) != $data[MYSITE_SETTINGS] ) {
		
		if( update_option( MYSITE_SETTINGS, $data[MYSITE_SETTINGS] ) ) {
			
			if( $twitter_verify_api ) {
				$msg = array( 'success' => 'options_saved', 'message' => __( 'Options Saved.', MYSITE_ADMIN_TEXTDOMAIN ) );
			} else {
				$msg = array( 'success' => 'options_saved', 'message' => __( 'Options Saved, but your Twitter API settings are invalid, please verify these settings are correct.', MYSITE_ADMIN_TEXTDOMAIN ), 'image_error' => true );
			}
		}
			
	} else {
		
		if( $twitter_verify_api ) {
			$msg = array( 'success' => true, 'message' => __( 'Options Saved.', MYSITE_ADMIN_TEXTDOMAIN ) );
		} else {
			$msg = array( 'success' => true, 'message' => __( 'Options Saved, but your Twitter API settings are invalid, please verify these settings are correct.', MYSITE_ADMIN_TEXTDOMAIN ), 'image_error' => true );
		}
	}
	
	$echo = json_encode( $msg );

	@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) );
	echo $echo;
	exit;
}

/**
 * 
 */
function mysite_shortcode_generator() {
	global $mysite;
	
	$shortcodes = mysite_shortcodes();
	
	$options = array();
	
	foreach( $shortcodes as $shortcode ) {
		$shortcode = str_replace( '.php', '',$shortcode );
		$shortcode = preg_replace( '/[0-9-]/', '', $shortcode );
		
		if( $shortcode[0] != '_' ) {
			$class = 'mysite' . ucwords( $shortcode );
			$options[] = call_user_func( array( &$class, '_options' ), $class );
		}
	}
	
	return $options;
}

/**
 *
 */
function mysite_check_wp_version(){
	global $wp_version;
	
	$check_WP = '3.0';
	$is_ok = version_compare($wp_version, $check_WP, '>=');
	
	if ( ($is_ok == FALSE) ) {
		return false;
	}
	
	return true;
}

/**
 * 
 */
function mysite_wpmu_style_option() {
	$styles = array();
	if( is_multisite() ) {
		global $blog_id;
		$wpmu_styles_path = mysite_upload_dir() . '/styles/';
		if(is_dir( $wpmu_styles_path ) ) {
			if($open_dirs = opendir( $wpmu_styles_path ) ) {
				while(($style = readdir($open_dirs)) !== false) {
					if(stristr($style, '.css') !== false) {
						$theme_name = md5( THEME_NAME ) . 'muskin_';
						$style_mu = str_replace( $theme_name, '', $style );
						$styles[$style_mu] = @filemtime( $wpmu_styles_path . $style);
						
						if( stristr($style, 'muskin_') !== false && stristr($style, $theme_name) === false )
							unset($styles[$style_mu]);
						
					}
				}
			}
		}
	}
	
	return $styles;
}

/**
 * 
 */
function mysite_style_option() {
	$styles = array();
	$sort_styles = array();
	
	if(is_dir(TEMPLATEPATH . '/styles/')) {
		if($open_dirs = opendir(TEMPLATEPATH . '/styles/')) {
			while(($style = readdir($open_dirs)) !== false) {
				if(stristr($style, '.css') !== false) {
					$styles[$style] = @filemtime(TEMPLATEPATH . '/styles/' . $style);
				}
			}
		}
	}
	
	$styles = array_merge( $styles, mysite_wpmu_style_option() );
	
	arsort($styles);
	
	$nt_writable = get_option( MYSITE_SKIN_NT_WRITABLE );
	if( !empty( $nt_writable ) ) {
		foreach ( $nt_writable as $key => $val ) {
			$val = $val . '.css';
			$sort_styles[$val] = $val;
		}
	}
	
	foreach ($styles as $key => $val) {
	    $sort_styles[$key] = $key;
	}
	
	unset( $sort_styles['_create_new.css'] );
	
	return $sort_styles;
}

/**
 * 
 */
function mysite_sociable_option() {
	$sociables = array();
	$styles = array();
	
	$pic_types = array('jpg', 'jpeg', 'gif', 'png');

	if( is_dir( THEME_DIR . '/images/sociables/default/' ) ) {
		if( $open_dirs = opendir( THEME_DIR . '/images/sociables/default/' ) ) {
			while( ( $sociable = readdir( $open_dirs ) ) !== false ) {
				$parts = explode( '.', $sociable );
				$ext = strtolower( $parts[count($parts) - 1] );
				
				if( in_array( $ext, $pic_types ) ) {
					$option = str_replace( '_',' ', $parts[count($parts) - 2] );
					$option = ucwords( $option );
					$sociables[$sociable] = str_replace( ' ','', $option );
				}
			}
		}
	}
	
	if( is_dir( THEME_DIR . '/images/sociables/' ) ) {
		if( $open_dirs = opendir( THEME_DIR . '/images/sociables/' ) ) {
			while( ( $style = readdir( $open_dirs ) ) !== false ) {
				
				$styles[$style] = ucwords( str_replace( '_',' ', $style ) );
				
				while(($ix = array_search('.',$styles)) > -1)
					unset($styles[$ix]);
			        while(($ix = array_search('..',$styles)) > -1)
			         	unset($styles[$ix]);
			}
			
		}
	}
	
	return array( 'styles' => $styles, 'sociables' => $sociables );
}

/**
 * 
 */
function mysite_pattern_presets() {
	$patterns = array();
	$pic_types = array( 'jpg', 'jpeg', 'gif', 'png' );

	if( is_dir( THEME_PATTERNS_DIR ) ) {
		if( $open_dirs = opendir( THEME_PATTERNS_DIR ) ) {
			while( ( $pattern = readdir( $open_dirs ) ) !== false ) {
				$parts = explode( '.', $pattern );
				$ext = strtolower( $parts[count($parts) - 1] );
				
				if( in_array( $ext, $pic_types ) ) {
					$patterns[$pattern] = $parts[count($parts) - 2];
				}
			}
		}
	}
	
	asort( $patterns );
	
	return $patterns;
}

/**
 * 
 */
function mysite_cufon_fonts() {
	$cufon = array();
	if(is_dir(THEME_FONTS)) {
		if($open_dirs = opendir(THEME_FONTS)) {
			while(($font = readdir($open_dirs)) !== false) {
				if(stristr($font, '.js') !== false) {
					$font =  str_replace( '.js', '', $font );
					$cufon[$font] = ucfirst( $font );
				}
			}
		}
	}
	
	asort( $cufon );
	
	return $cufon;
}

/**
 * 
 */
function mysite_typography_options() {
	$font = array(
		'Web' => 'Web',
		'Arial, Helvetica, sans-serif' => 'Arial',
		'"Copperplate Light", "Copperplate Gothic Light", serif' => 'Copperplate Light',
		'"Courier New", Courier, monospace' => 'Courier New',
		'Futura, "Century Gothic", AppleGothic, sans-serif' => 'Futura',
		'Georgia, Times, "Times New Roman", serif' => 'Georgia',
		'"Gill Sans", Calibri, "Trebuchet MS", sans-serif' => 'Gill Sans',
		'Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif' => 'Impact',
		'"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif' => 'Lucida',
		'Palatino, "Palatino Linotype", Georgia, Times, "Times New Roman", serif' => 'Palatino',
		'Tahoma, Geneva, Verdana, sans-serif' => 'Tahoma',
		'"Times New Roman", Times, Georgia, serif' => 'Times New Roman',
		'"Trebuchet MS", Tahoma, Arial, sans-serif' => 'Trebuchet',
		'Verdana, Geneva, Tahoma, sans-serif' => 'Verdana',
		'inherit' =>'Inherit',
		'optgroup' => 'optgroup');
		
	$cufon = mysite_cufon_fonts();
		
	if( !empty( $cufon ) ) {
		array_unshift( $cufon, 'Cufon' );
		array_push( $cufon, 'optgroup' );

		$font = array_merge( $font, $cufon );
	}
	
	$size = range( 1,100 );
	$weight = array( 'normal', 'bold' );
	$style = array( 'normal', 'italic', 'oblique' );
		
	$options = array( 'font-size' => $size, 'font-weight' => $weight,  'font-style' => $style, 'font-family' => $font );
	
	return $options;
}

/**
 *
 */
function mysite_dependencies( $post_id ) {
	global $mysite, $post_type;
	
	if( !is_admin() ) return;
	
	  if ( empty( $mysite->dependencies ) && !empty( $_POST[MYSITE_SETTINGS] ) ) {
	    $post = $_POST;
	
		if( isset( $post_type ) && ( $post_type == 'testimonial' ) )
			return;
		
		$dependencies = array();
		
		if( preg_match( '/\[portfolio_grid (.*)fancy_layout(\s)?=(\s)?\\\"(\s)?true(\s)?\\\"/', $post['post_content'] ) ||
		    preg_match( '/\[portfolio_grid (.*)fancy_layout(\s)?=(\s)?\\\"(\s)?true(\s)?\\\"/', $post[MYSITE_SETTINGS]['_intro_custom_html'] ) ||
		    preg_match( '/\[portfolio_grid (.*)fancy_layout(\s)?=(\s)?\\\"(\s)?true(\s)?\\\"/', $post[MYSITE_SETTINGS]['_intro_custom_text'] ) ) { $dependencies[] = 'fancy_portfolio'; }
		
		if( strpos( $post['post_content'], '[nivo' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_html'], '[nivo' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_text'], '[nivo' ) !== false ) { $dependencies[] = 'nivo'; }
		
		if( strpos( $post['post_content'], '[galleria' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_html'], '[galleria' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_text'], '[galleria' ) !== false ) { $dependencies[] = 'galleria'; }
		
		if( strpos( $post['post_content'], '[tab' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_html'], '[tab' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_text'], '[tab' ) !== false ) { $dependencies[] = 'tabs'; }
		
		if( strpos( $post['post_content'], '[tooltip' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_html'], '[tooltip' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_text'], '[tooltip' ) !== false ) { $dependencies[] = 'tooltip'; }
		
		if( strpos( $post['post_content'], '[jcarousel' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_html'], '[jcarousel' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_text'], '[jcarousel' ) !== false ) { $dependencies[] = 'jcarousel'; }
		
		if( strpos( $post['post_content'], '[contactform' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_html'], '[contactform' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_text'], '[contactform' ) !== false ) { $dependencies[] = 'contactform'; }
		
		if( strpos( $post['post_content'], 'post_content=\"full' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_html'], 'post_content=\"full' ) !== false ||
		    strpos( $post[MYSITE_SETTINGS]['_intro_custom_text'], 'post_content=\"full' ) !== false ) { $dependencies[] = 'all_scripts'; }
		
		$dependencies = serialize( $dependencies );
		update_post_meta( $post_id, '_dependencies', $dependencies );
	  }
	
	$mysite->dependencies = true;
}

/**
 * 
 */
function mysite_tinymce_init_size() {
	global $wp_version;
	
	if( isset( $_GET['page'] ) ) {
		if( $_GET['page'] == 'mysite-options' ) {
			
			if( version_compare( $wp_version, '3.3', '>=' ) )
				$tinymce = 'TinyMCE_' . MYSITE_SETTINGS . '[content]_size';
			else
				$tinymce = 'TinyMCE_' . MYSITE_SETTINGS . '_content_size';
				
			if( !isset( $_COOKIE[$tinymce] ) )
				setcookie($tinymce, 'cw=577&ch=251');
		}
	}
}

/**
 *
 */
function mysite_import_options( $import ) {
	
	$imported_options = mysite_decode( $import, $serialize = true );
	
	if( is_array( $imported_options ) ) {
		
		if( array_key_exists( 'mysitemyway_options_export', $imported_options ) ) {
			if( get_option( MYSITE_SETTINGS ) != $imported_options ) {
				
				# Run options filter
				$imported_options = mysite_options_filter( $imported_options );
				
				# Update our options with imported options
				if( update_option( MYSITE_SETTINGS, $imported_options ) )
					wp_redirect( admin_url( 'admin.php?page=mysite-options&import=true' ) );
				else
					wp_redirect( admin_url( 'admin.php?page=mysite-options&import=false' ) );

			} else {
				wp_redirect( admin_url( 'admin.php?page=mysite-options&import=true' ) );
			}
			
		} else {
			wp_redirect( admin_url( 'admin.php?page=mysite-options&import=false' ) );
		}
		
	} else {
		wp_redirect( admin_url( 'admin.php?page=mysite-options&import=false' ) );
	}
	
	exit;
}

/**
 *
 */
function mysite_default_options( $type ) {
	global $mysite;
	
	$options = '';
	
	$default_options = '7Vvbjtw2Ev0VAkH8NDt9H9tt5CHIQ16ChYEA-2IEQrXIbjGWSJmXHncC__sW1aJEXUcTW70bx4BhyyKLRZ46PCRVbNiv1sv9nxr_2b_4YKV5Q7nOU7hEqTzJ65s3er8tC42yrHr5qnzpakZWpVXBsiyoXqxW5ZsjnHksxRO1N-UbLoySkcwNl0LXxb6nhpuURYaBZqprHFttZNYufvAj-Q_Thh9sajMCwjDCc42PueIZ14QLcgQbY7kmUsWcpDY2-MwMyaW2TLH72uGrPodRYrIpgORwYhHCLa3pDkHxU2IizSk7QDBC35p55MagK05HHHmw2EejIEoY0ACNTvW1f3NQWDNWNjtElKUIigkxList6jceVhCQXgyPdRRLykb6tWyiFms9XPl1s-7vI1VXu_JNIjPWC643Odo0jR45NUl39JVxGUyD6NW09wH_RSqWlcShMpWKaG4IZMzcESS5ZrFhxioClOdcx1yckF_McKxulQDywSLVjFT4p1G_S62yGwdrDE6eRm8qJv2M5PzVgDKMdpnUaKCeDA1cn3LrAJnAnKZRq-lNhbAx-X6xyC4IGcsuj3C5j2W20DbPEZCq_kvfQ4lzVISjfvDEficFi47SKpP89iJ1zCWLFyfsWes5eXBPbxPsXZriXEZ3maTSFS2uZUPW76iSeQz56rfVu0X1_JMCFAQMIbZCVCIFDpUYLmJOrTD35EcmGAiS2_TMBSiSJ4DBV0BQeO6cwiRMUMUUUoYpMI4BlGc4SKSHkOKe_IQPWsYcSSLAyA-WkZzhU6FKGOwMTgLLUK9JjmG3iqMxyRxS-g5NdFywSXHKY-tGnFl9_24xAa5bQrr-BumXhnTzj4MURV6b2XHdflW4lphViuoXgwy4KNa-tuZ2JX_dXi6PUppiuWxuyZafsWLi5sNMWzZZXc8Z1e79IsIz10fFNP8DV_ZL3t3JGp6ZBPc89RD9dsLhFkvcLeI6iK6PMuUycluIsirs18Uuuqz-OLJD8aANVfkUuDWP8pZuPVImUeym4_Xkc9T8X_itfWkkHZ4qit3hfH6XXVod8Bh1A48Bo2b2uO4j08w-Vz08uhGwOgOkDB4PTZRy_Gv-QWaMotjdxKV_lYJCCb2FRz8zgVLuzv9wxVZHJ1zSZvS7HRP8Az_N67VX72fz-jAu97P53Y2q_exu-8V-Lrer1wNaP7vDttTPBuxqUOlnc7kcEvrZUW3r_OxD7Mj87ENsq_zsM7Jf5GfXvV6NL-I7s972qfyMfl-N6_yMnl-OKv0NHPdr_YyOVwNqfwOXbb2f0eVmUPFndLoe0vwbYNtW_RsMs6P7NxhmW_lvMEP7tX8-x90MkU457csgHoGiZnSKvRPBzzJixyOLzYREX1Ebm4rZlOxVURsEzyKdMzYlv3ftZau6P1Zsl8tl93tYaYLDZAN2OpWP3cxZaSfg3DGg0uhuHqkYDeUKkcJANwyr_pf5okSe-0JRumxlk4byVw8tKzAoF3bsU-br0EIn1ahh_3L_J9-v8OGh4GALgzCPXU2i711OyxV9v9AGCUbvf89PnW-NkJoIjBlJxlb5dS7ej2fMd2FGfApZXLfa3G2W0ivvu0RGfGLFi5z84Czj-_UUxDa7LmLuYzZHLQg78aXxqz9c92Yhvyys6zrV3x3ZL9PwXS99V94qyQU54-JncjDkyFSZNMitsppoRskZFLf6nvwbdzqQES4MUxRrZKA1ECApPzAl8b_G8CKVAHFsMw2CUA5ZlbKochjU8mvW4sjsiaNTwWKi4cQLe4sFqTzgNstlKqQgpkiwoHvnm16zG-gUXIKkskK0cWdW02UziS4vh-lyUijWiMTXQJh1izDNsU1ljC99i_FgLivkUkgJHLiBIlGkDpwYhYs8dwUaY-2vuAhmfI4pZdoCBXKEjGkkCjFW5Y41J2QEYJSDazTVjZkiKfPBYtyvXChoca4q3pM6DVemcTJ-V5v7lBAp-BtLlTPlOFezZTtJjjddthxTCQbX9L-JIPtV1Xf78yR5NwW16htAiBoG4m-CWONyz2egVW8lv6t2Ak9iNzj6r3mpD6qXkLxnF91ta3W3vtvcbe92d9_Vpp5sxSlu_H5R1VBRt32pa90tXPVctivONc-7bPfQsOXvWZRJagPoq6MwHLqzqLBydw0K-TaXNNj99xpWo8TwFncwuXh613qtDDkfga_SkmuK_np81p2T00PPMej_Mqm_avcuuBO388C8gCx_E8v88oa4Kx1AEsWOPzy9lLt7H-0Cd1MEissh7UnrrmnAoaJE67haC8jOvfZxcNdgu1i7u5Yxl7h_ysWpM-djh27X6ICbq_dRzFUc0mvgcNRhxjaQnuFam1rKRqTAt9WUgBYQnwI2aiYjdw6PnpCzOsvqDSZoU3jU9WbYs0ep6MgZPDSJQVTRW7mD4LL_LnTjSxHaFdP-ej35KBXutEdG1rAr7pxOs9s1-mnYSarLVNsQflBxws-T3YaBwMVjqtkmMNPM-ZxquQ4sg6A_r6fb5Xaiv_rjQRkP-rRJGAomnBTEjgFTqVOnlkrquLtJTYEGnICtNgIP7gNFUFCvo-4cXi8T1bfwnsSzc201cyHVEej2PHlyDJsQbXoRkPH4-j2v4PRzm2sEr2K3wLMvZR__Eq6e5s9tY93oSO46o_-SMftY0Gns69-rtoTgGgpFSKYaOayfa1To4hSj6o5_CWVrJzU8db1BeX-_vcca1raW4QHXuZOSVtDmmurFZfxXJX5i1638q7mgDi8fgYliOQvEwDfael2pemCJJwCIkyy8UllpTaxk2nMIC6yRD7yx2FVHBnbEg7bMA9rVYlsI7ZNxWjXrTw7TttfuW5SmRWkbprNwfZo8nbzBs6dTy_BboJ4XKKAZF9GEX7tVe3z3kdN0fsDWDVB197o-c3grXDeCX8QccKX_9F8';
	
	
	$widgets = '7VnbbuM2EH1Ov2KKIvsURXHsxLsO-rCby2KLpOs2affRoCVaYsKLwksctyjQ3-jv9UtK6mJTjupNglhGg77Z54zIMyPOcEihQX_wuxp0eoM3t0boo9N7xDKK4QuJE6wL7Mjy_U6_tHhD9ZGhEFGk1PcFlAmlR5QoDYohSkfz_-UTiT76Zmtryz1JSfOTIyZiQ_HiAWcck7t_sSYMJUvGCDTRFJemPyIGXHCgONJGAYlBYQZ2AINl-SCkEk9K8-_qYxGWwJTEOi3pg73qEUySVC-jiFZQCTxViZJRab2tiMYjI-l2mHurU8PGuxlPSks_HKm4w3I0QTEeXau6AyGa_7JB_Ho8I8E15ro-SPbQOHfs5eMOEtMSGQtxw5C8WUyyesi6s9kK7QxrVJeuMsRrds5kFCO95CJm7tfQDoJjEHwA-VwF-jAEl4bHaLYDPxiO4UCnO7C_1-nsQH_Q60LGVi6-vcPgIHDmS345pQ-d9N9tSEmeZ20n2qkm9v1kmFK7frC6NRgwJwxsKI1qNdEeo-T1JNrz4r4y0VYP-Z9KtP3Xl2hDKQgHZCItJFAhbQ3EZiM72mOUvJ5Ee17cVyba6iH_T7QHiZb_NTRnqpb0bdmPnmGkjcRqThz2D2qtar39XHjo6U21zgZhqFPMsNplM7dk2WyKZruRYOF2jo84Yng7nJTThcxQTWyrHChKYixVuPD5wlCiXRd9WVBLrpd-vbwkimbCaF_JeY7A50wTwVvToWeZSCTK0pkn5WoOtiUDxYzwwK4zTANRRMDT896xMHRs2_FRqZA6EjEOEsyxRLYMeMIuKxY-Vmxrwm5swBo1WeLrcprS9F2Zix_twRBL4uXpu8O9NeZpUs1ndx2pJ4ISEXSCSFDDuOfYsCKhA8c5ueZYN-naL3WpRmH7pTC1AWXdlcq6G1TWW6ms17qyqZBxZnNIBTGeILs3eLq-WG7ouL___EvBScG3pqz8hQKv7OSQX53L9EQwrz6t6ZsgHs2CvP_1X-aZg-FTDremZb6pL6Datp6TsKhlTyiEVVMyzB2aNytve2ssglkeUzS2PUBgapufg-CXdQe2mD-TJCI8CcbivhbPYYHDB4e3okRheUeimojLEmplfnuq1oQJThD1NVx58Jp1uGMRivzidFwg7cTfGaDMD3-BrHn23l4vwFIKGTgd3vSWgFNHgEvLp6Rzp2pe5gVTeVy3u8asntdxFV7f2iPjLNBo7K-n658cClcWXXNgG6QI4apkk5ySaU_SNP-IEXiItyfnHHhvrzVZd_ZQKJpV_eqojYhSIrLlJ2A4JsjPzxyGCwe3KCY_NzeHqDhTbyRGYyqSwN28qGZpHywP7lJFbUTeojluVLfojl9E3LKqWEQqJDzG97tZmoVnhtLRfKLRee1r4HseAzNRCkxI_O1Tym71FbK42FiU3N7hYRuXPtUNy8R6F-T3qX7HakH34VSnbV_4UDyxZc7mxRj5p_ZzC8NlAbctSbpr5QZNPzt8U6KKI2Pw8J6sOC1CtaqesCCr9v2CqGgBdvvPXI3L_iiTubT261-BwJmQhq0vfy8Q4aNh7ZvEZ04Jx3AiIsOwbRrdndm629UU8QTbsuq_qwpbn_PHRmnByG-Fi4uZffgla6e7d_O-d5yIKacCxXl5hIJ89JL84x8';
	
	
	if ( function_exists( 'mysite_override_default_options' ) )
		$default_options = mysite_override_default_options();
		
	if ( function_exists( 'mysite_override_default_widgets' ) )
		$widgets = mysite_override_default_widgets();
		
	
	# Default theme settings
	if( $type == 'settings' ) {
		# Set to "false" to create initial export
		$include_images = true;
		
		# Decode options and unserialize
		$default_options = mysite_decode( $default_options, $serialize = true );
		
		# Run options filter
		$default_options = mysite_options_filter( $default_options );
		
		if( $include_images ) {
			# Add default image sizes to options array 
			foreach( $mysite->layout['images'] as $img_key_full => $image_full ) {
				$image_sizes_full['w'] = $image_full[0];
				$image_sizes_full['h'] = $image_full[1];
				$images_full["${img_key_full}_full"] = $image_sizes_full;
			}

			foreach( $mysite->layout['big_sidebar_images'] as $img_key_big => $image_big ) {
				$image_sizes_big['w'] = $image_big[0];
				$image_sizes_big['h'] = $image_big[1];
				$images_big["${img_key_big}_big"] = $image_sizes_big;
			}

			foreach( $mysite->layout['small_sidebar_images'] as $img_key_small => $image_small ) {
				$image_sizes_small['w'] = $image_small[0];
				$image_sizes_small['h'] = $image_small[1];
				$images_small["${img_key_small}_small"] = $image_sizes_small;
			}

			# Merge default options & images sizes 
			$image_merge1 = array_merge( $default_options, $images_full );
			$image_merge2 = array_merge( $image_merge1, $images_big );
			$options = array_merge( $image_merge2, $images_small );
			
		} else {
			$options = $default_options;
		}
	}
	
	# Interanl framework settings
	if( $type == 'internal' ) {
		$options = array();
		
		if( defined( 'FRAMEWORK_VERSION' ) )
			$options['framework_version'] = FRAMEWORK_VERSION;
			
		if( defined( 'DOCUMENTATION_URL' ) )
			$options['documentation_url'] = DOCUMENTATION_URL;
			
		if( defined( 'SUPPORT_URL' ) )
			$options['support_url'] = SUPPORT_URL;
	}
	
	# Default activation widgets
	if( $type == 'widgets' ) {
		
		$widget_text = array();
		
		$widgets = mysite_decode( $widgets, $serialize = true );
		$i=2;
		foreach( $widgets as $key => $value ) {
			$text = str_replace( '%theme_name%', strtolower( THEME_NAME ), str_replace( '%site_url%', THEME_IMAGES . '/assets', str_replace( '%site_url_img%', THEME_IMAGES . '/activation', $value ) ) );
			$widget_text[$i] = array( 'title' => $key, 'text' => $text, 'filter' => array() );
			$i++;
		}
		
		update_option( 'widget_text', $widget_text + array( '_multiwidget' => (int) count( $widget_text ) ) );
		
		$sidebars_widgets = array(
			'primary' => array( 'text-2' ),
			'home' 	  => array(),
			'footer1' => array( 'text-3' ),
			'footer2' => array( 'text-4' ),
			'footer3' => array( 'text-5' ),
			'footer4' => array( 'text-6' ),
			'footer5' => array( 'text-7' ),
			'footer6' => array( 'text-8' )
		);
		
		if ( function_exists( 'mysite_override_sidebars_widgets' ) )
			$sidebars_widgets = mysite_override_sidebars_widgets();
		
		update_option( 'sidebars_widgets', $sidebars_widgets );
		
		return;
	}
		
	
	return $options;
}

/**
 *
 */
function mysite_options_filter( $options ) {
	
	# Check for %site_url% macro and replace with theme image activation url path
	foreach( $options as $key => $value )
		if( is_array( $value ) )
			foreach( $value as $key2 => $value2 )
				$options[$key][$key2] = str_replace( '%site_url%', THEME_IMAGES . '/activation', $value2 );

	if( isset( $options['content'] ) && !empty( $options['content'] ) )
		$options['content'] = str_replace( '%site_url%', THEME_IMAGES . '/activation', $options['content'] );
		
	return $options;
}

/**
 *
 */
function delete_mysite_postspage_keywords() {
	delete_transient( 'mysite_postspage_keywords' );
}

?>