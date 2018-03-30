<?php
/**
 *
 */

class mysiteSkinGenerator extends mysiteOptionGenerator {
	
	private $default;
	private $patterns;
	private $stylesheet;
	private $load_type;
	private $colorscheme;
	private $stylesdir;
	
	/**
	 *
	 */
	function __construct() {
		if ( !is_admin() ) return;
			
		add_action( 'admin_init', array( &$this, 'init' ) );
		
		$this->assign_patterns();
		$this->styles_dir();
		$this->activate_skin( ( defined( 'DEFAULT_SKIN' ) ? DEFAULT_SKIN : 'steelblue.css' ), $suppress_msg = true, $init = true );
		$this->default = '_create_new.css';
	}
	
	/**
	 *
	 */
	function assign_patterns() {
		$this->patterns = array();
		$this->patterns['background']['patterns'] = 'Background';
		$this->patterns['background_plus']['patterns'] = 'BG+';
		$this->patterns['link']['patterns'] = 'Link';
		$this->patterns['typography']['patterns'] = 'Font';
		$this->patterns['border']['patterns'] = 'Border';
		$this->patterns['color']['patterns'] = 'Color';
		$this->patterns['toggle_start']['patterns'] = ' ~';
		$this->patterns['toggle_end']['patterns'] = 'End ~';
	}
	
	/**
	 *
	 */
	function init() {
		
		if( ( mysite_ajax_request() ) && ( isset( $_POST['mysite_admin_wpnonce'] ) ) ) {
			check_ajax_referer( MYSITE_SETTINGS . '_wpnonce', 'mysite_admin_wpnonce' );
			
			# Load skin to edit
			if( isset( $_POST['_mysite_skin_ajax_load'] ) ) {
				
				if( $_POST['_mysite_skin_ajax_load'] == 'create' )
					$this->stylesheet = $this->default;
				else
					$this->stylesheet = $_POST['_mysite_skin_ajax_load'];
				
				$this->load_type = $_POST['skin_generator'];
				
				$data = array( 'success' => 'skin_edit', 'html' => $this->options_output() );
				$this->json_process( $data );
				
			# Save new skin
			} elseif( isset( $_POST['_mysite_save_custom_skin'] ) ) {
				if( isset( $_POST['_mysite_save_manage_skin'] ) )
					$this->stylesheet = $_POST['_mysite_save_manage_skin'];
				else
					$this->stylesheet = $this->default;
				
				$data = $this->file_write( $_POST['custom_skin_name'] );
				$this->json_process( $data );
				
			# Save existing skin
			} elseif( isset( $_POST['_mysite_save_existing_skin'] ) ) {
				$this->stylesheet = $_POST['_mysite_save_manage_skin'];
				$data = $this->file_write( $_POST['_mysite_save_manage_skin'], $overwrite = true );
				$this->json_process( $data );

			# Advanced Skin Edit
			} elseif( isset( $_POST['_mysite_advanced_skin_edit'] ) ) {
				$this->stylesheet = $_POST['_mysite_advanced_skin_edit'];
				$data = array( 'success' => 'skin_advanced', 'html' => $this->advanced_edit() );
				$this->json_process( $data );
				
			# Load skins to manage
			} elseif( isset( $_POST['_mysite_manage_custom_skin'] ) ) {
				$data = array( 'success' => 'skin_manage', 'html' => $this->manage_skin() );
				$this->json_process( $data );

			# Activate new skin
			} elseif ( isset( $_POST['_mysite_activate_skin'] ) ) {
				$data =  $this->activate_skin( $_POST['_mysite_activate_skin'], $suppress_msg = false );
				$this->json_process( $data );
				
			# Delete skin
			} elseif ( isset( $_POST['_mysite_delete_custom_skin'] ) ) {
				$data = $this->delete_skin( $_POST['_mysite_delete_custom_skin'] );
				$this->json_process( $data );
			
			# Export skin
			} elseif ( isset( $_POST['_mysite_export_custom_skin'] ) ) {
				$data = $this->file_export( $_POST['_mysite_export_custom_skin'] );
				$this->json_process( $data );
				
			# Upload skin	
			} elseif ( isset( $_POST['_mysite_upload_custom_skin'] ) ) {
				$data = $this->unzip_skin( $_POST['_mysite_upload_custom_skin'] );
				$this->json_process( $data );
			}
		}
		
	}
	
	/**
	 *
	 */
	function json_response( $args = array() ) {
		extract( $args );
		
		if( $type == 'skin_saved' )
			return sprintf( __( 'Custom skin &quot;%1$s&quot; saved.', MYSITE_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'skin_activated' )
			return sprintf( __( 'Custom skin &quot;%1$s&quot; has been activated.', MYSITE_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'not_activated' )
			return __( 'Error: Custom skin not activated, please try again.', MYSITE_ADMIN_TEXTDOMAIN );
			
		elseif( $type == 'skin_exists' )
			return sprintf( __( 'Custom skin &quot;%1$s&quot; already exists, please select a different name.', MYSITE_ADMIN_TEXTDOMAIN ), $name );
		
		elseif( $type == 'not_saved' )
			return sprintf( __( 'Error: Custom skin &quot;%1$s&quot; not saved, please try again.', MYSITE_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'unzipped' )
			return sprintf( _n( 'Upload Successful. The following skin was added: %1$s', 'Upload Successful. The following skins were added: %1$s', count( $cssfile ), MYSITE_ADMIN_TEXTDOMAIN ), join( ', ', $cssfile ) );
			
		elseif( $type == 'not_unzipped' )
			return __( 'Error: The skin you uploaded could not be unzipped.', MYSITE_ADMIN_TEXTDOMAIN );
			
		elseif( $type == 'unzipped_nocss' )
			return __( 'Error: No valid &quot;.css&quot; files were found.', MYSITE_ADMIN_TEXTDOMAIN );
			
		elseif( $type == 'skin_deleted' )
			return sprintf( __( 'Custom skin &quot;%1$s&quot; has been deleted.', MYSITE_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'not_deleted' )
			return sprintf( __( 'Error: Custom skin &quot;%1$s&quot; not deleted, please try again.', MYSITE_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'active_skin' )
			return sprintf( __( 'Error: Custom skin &quot;%1$s&quot; is currently the active skin, please deactivate it before deleting.', MYSITE_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'error_loading' )
			return sprintf( __( 'There was an error loading the following skin &quot;%1$s&quot;, please make sure the following folder is writable by your server: &quot;%2$s&quot;', MYSITE_ADMIN_TEXTDOMAIN ), $name, str_replace( $_SERVER['DOCUMENT_ROOT'] . '/', '', $this->stylesdir ) );
			
		elseif( $type == 'not_exported' )
			return sprintf( __( 'Error: The skin &quot;%1$s&quot; could not be exported, please make sure the following folder is writable by your server: &quot;%2$s&quot;', MYSITE_ADMIN_TEXTDOMAIN ), $name, str_replace( $_SERVER['DOCUMENT_ROOT'] . '/', '', $this->stylesdir ) );
			
		elseif( $type == 'not_exported_2' )
			return sprintf( __( 'Error: The skin &quot;%1$s&quot; could not be exported, please try again.', MYSITE_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'not_exported_img' )
			return sprintf( _n( 'The following image could not be add to your export, it will have to be added to your skin manually: %1$s', 'The following images could not be add to your export, they will have to be added to your skin manually: %1$s', count( $image_error ), MYSITE_ADMIN_TEXTDOMAIN ), join( ', ', $image_error ) );
			
		elseif( $type == 'upload_error' )
			return sprintf( __( 'Error: The skin %1$s could not be uploaded, unzip it manually and upload it to the following directory on your server: %2$s', MYSITE_ADMIN_TEXTDOMAIN ), $name, str_replace( $_SERVER['DOCUMENT_ROOT'] . '/', '', THEME_STYLES_DIR ) );
			
		elseif( $type == 'upload_exists' )
			return sprintf( __( 'The skin %1$s already exists.', MYSITE_ADMIN_TEXTDOMAIN ), $name );
			
		elseif( $type == 'invalid_ext' )
			return __( 'Error: File has an invalid extension, it should be .zip', MYSITE_ADMIN_TEXTDOMAIN );
	}
	
	/**
	 *
	 */
	function json_process( $data ) {
		$content = ( mysite_ajax_request() ) ? 'application/json;' : 'text/html;';
		$echo = json_encode( $data );
		@header( "Content-Type: {$content} charset=" . get_option( 'blog_charset' ) );
		echo $echo;
		exit();
	}
	
	/**
	 *
	 */
	function styles_dir() {
		if( is_multisite() ) {
			
			global $blog_id;
			if( is_main_site( $blog_id ) )
				$this->stylesdir = THEME_STYLES_DIR;
			else
				$this->stylesdir = mysite_upload_dir() . '/styles';
							
		} else {
			$this->stylesdir = THEME_STYLES_DIR;
		}
	}
	
	/**
	 *
	 */
	function image_filter( $image, $export = false ) {
		if( is_multisite() || $export == true || !mysite_is_styles_writable() ) {
			# check for relative image path
			if( strpos( $image, 'http' ) === false ) {

				$style_uri = explode( '/', THEME_URI . '/styles' );
				
				if( $export == true )
					$style_dir = explode( '/', $this->stylesdir );
				else
					$style_dir = explode( '/', THEME_DIR . '/styles' );

				$relative_img_path = explode( '/', $image );
				$relative_img_path_backup = $relative_img_path;

				for( $j=0; $j<count($relative_img_path_backup); $j++ ) {
					if( $relative_img_path_backup[$j] == '..' ) {
						array_pop($style_uri);
						array_pop($style_dir);
						array_shift($relative_img_path);
					}
				}
				
				if( $export ) {
					$images_dir = implode( '/', $style_dir ) . '/' . implode( '/', $relative_img_path );
					$images['directory'] = str_replace(str_replace( $_SERVER['DOCUMENT_ROOT'], '', THEME_DIR . '/styles//' ), '/', $images_dir );
					
					$images_url = implode( '/', $style_uri ) . '/' . implode( '/', $relative_img_path );
					$images['url'] = str_replace(str_replace( $_SERVER['DOCUMENT_ROOT'], '', THEME_DIR . '/styles//' ), '/', $images_url );
					return $images;
					
				} else {
					$path = str_replace( $_SERVER['DOCUMENT_ROOT'], '' ,implode( '/', $style_dir ) . '/' . implode( '/', $relative_img_path ) );
					return 'url(' . str_replace( '_patterns/_patterns', '_patterns', str_replace(str_replace( $_SERVER['DOCUMENT_ROOT'], '', THEME_DIR . '/styles//' ), '/', $path ) ) . ')';
				}

			} elseif ( strpos( $image, 'http' ) !== false ) {
				if( $export ) {
				 	$img['url'] = $image;
					return $img;
				} else {
					return 'url(' . $image . ')';
				}
			}
			
		} else {
			return 'url(' . $image . ')';
		}
	}
	
	/**
	 *
	 */
	function file_write( $name, $overwrite = false ) {
		$name = str_replace('.css', '', $name );

		$post_styles = $_POST;

		if( is_multisite() ) {
			global $blog_id;
			if( $blog_id != 1 ) {
				$is_mu = true;
				$new_stylesheet = $this->stylesdir . '/' . md5( THEME_NAME ) . 'muskin_' . $name . '.css';
			} else {
				$new_stylesheet = $this->stylesdir . '/' . $name . '.css';
			}

		} else {
			$new_stylesheet = $this->stylesdir . '/' . $name . '.css';
		}

		$saved_skins = ( get_option( MYSITE_SKINS ) ) ? get_option( MYSITE_SKINS ) : array();
		$skin_name = ( $overwrite ) ? false : $name . '.css';
		$activate_skin = $name . '.css';

		# Return error if file alread exists
		if( ( @is_file( $new_stylesheet ) ) && ( !$overwrite ) )
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'skin_exists', 'name' => $name ) ) );

		$old_stylesheet = $this->get_contents( $this->stylesheet );

		if( empty( $old_stylesheet ) )
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_saved', 'name' => $name ) ) );

		$patterns = "%(/\*:.*?)(.*?)(\*/?.*?)(\s*)([^}^~]*)(~?|}?.*?)%e";

		if( isset( $post_styles['advanced_edit'] ) )
			$write_new_stylesheet = stripslashes( $post_styles['advanced_edit'] );
		else
			$write_new_stylesheet = preg_replace( $patterns, "\$this->filter_results('\\1','\\2','\\3','\\4','\\5','\\6', \$post_styles)", $old_stylesheet );

		if( empty( $write_new_stylesheet ) )
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_saved', 'name' => $name ) ) );

		if( $this->sprite_gen( $name ) )
			$write_new_stylesheet = preg_replace( '/:Icon Sprite\s*\*\/\s*background-image:url\(([^\)]*)/', ":Icon Sprite*/\nbackground-image:url({$this->sprite_gen( $name )}", $write_new_stylesheet );

		$active_skin = get_option( MYSITE_ACTIVE_SKIN );
		if( ( !empty( $is_mu ) && !@is_file( $new_stylesheet ) ) || ( !mysite_is_styles_writable() && $activate_skin != $active_skin['style_variations'] ) )
			$write_new_stylesheet = preg_replace( '%url\(([^\)]*)\)%e', "\$this->image_filter('\\1')", $write_new_stylesheet );
		
		# Check for fullscreen background
		$write_new_stylesheet = $this->fullbg_option( $write_new_stylesheet, $post_styles );
		
		# Encode stylesheet & merge with saved skins in DB
		$add_skin[$name] = mysite_encode( $write_new_stylesheet );
		$update_skin = array_merge( (array)$saved_skins, (array)$add_skin );

		# If styles folder isn't writable save to database
		if( !mysite_is_styles_writable() ) {
			$nt_writable = ( get_option( MYSITE_SKIN_NT_WRITABLE ) ) ? get_option( MYSITE_SKIN_NT_WRITABLE ) : array();

			if( ( in_array( $name, $nt_writable ) ) && ( !$overwrite ) )
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'skin_exists', 'name' => $name ) ) );

			elseif( ( $this->update_skin( $saved_skins, $update_skin ) ) && ( $this->skin_nt_writable( $name, $nt_writable ) ) && ( $this->activate_skin( $activate_skin ) ) )
				return array( 'success' => 'skin_saved', 'skin_name' => $skin_name, 'message' => $this->json_response( $args = array( 'type' => 'skin_saved', 'name' => $name ) ) );
			else
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_saved', 'name' => $name ) ) );
		}

		# Write to file
		$is_writable = true;
		if ( !$fh = @fopen( $new_stylesheet, 'wb' ) ) $is_writable = false;
		if ( !@fwrite( $fh, $write_new_stylesheet ) ) $is_writable = false;
		if ( $fh ) fclose( $fh );

		# If we couldn't write to file save to database
		if( !$is_writable ) {
			$nt_writable = ( get_option( MYSITE_SKIN_NT_WRITABLE ) ) ? get_option( MYSITE_SKIN_NT_WRITABLE ) : array();

			if( ( in_array( $name, $nt_writable ) ) && ( !$overwrite ) )
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'skin_exists', 'name' => $name ) ) );

			elseif( ( $this->update_skin( $saved_skins, $update_skin ) ) && ( $this->skin_nt_writable( $name, $nt_writable ) ) && ( $this->activate_skin( $activate_skin ) ) )
				return array( 'success' => 'skin_saved', 'skin_name' => $skin_name, 'message' => $this->json_response( $args = array( 'type' => 'skin_saved', 'name' => $name ) ) );
			else
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_saved', 'name' => $name ) ) );

		# If write to file was successful
		} elseif( $is_writable ) {
			# Add skin to database for backup
			$this->update_skin( $saved_skins, $update_skin );

			# Remove skin from not writable if found
			$this->skin_writable( $name );

			# Reactivate the skin if needed
			$this->activate_skin( $activate_skin );

			@chmod( $new_stylesheet, 0000666 );

			return array( 'success' => 'skin_saved', 'skin_name' => $skin_name, 'message' => $this->json_response( $args = array( 'type' => 'skin_saved', 'name' => $name ) ) );
		}

		return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_saved', 'name' => $name ) ) );
	}
	
	/**
	 *
	 */
	function sprite_gen( $name ) {
		if( empty( $this->colorscheme ) || !function_exists('gd_info') || !mysite_is_sprite_writable() )
			return false;
			
		if( @is_file( THEME_STYLES_DIR . '/' . $name . '/' . 'custom_sprite.png' ) )
			return THEME_STYLES . '/' . $name . '/' . 'custom_sprite.png';
		
		$color = $this->colorscheme;
		
		if ( $color[0] == '#' )
	        $color = substr( $color, 1 );
	    if ( strlen( $color ) == 6 )
	        list( $r, $g, $b ) = array( $color[0].$color[1],$color[2].$color[3],$color[4].$color[5] );
	    elseif (strlen($color) == 3)
	        list( $r, $g, $b ) = array( $color[0].$color[0], $color[1].$color[1], $color[2].$color[2] );
	    else
	        return false;
	
		$r = hexdec( $r ) - 40;
		$g = hexdec( $g ) - 40;
		$b = hexdec( $b ) - 40;
		
		$img_sprite = THEME_SPRITES_DIR . "/custom_sprite_{$color}.png";
		
		if( @is_file( $img_sprite ) )
			return THEME_SPRITES . "/custom_sprite_{$color}.png";
		
		if( @is_file( THEME_IMAGES_DIR . "/shortcodes/sprites/custom_sprite_{$color}.png" ) )
			return THEME_IMAGES . "/shortcodes/sprites/custom_sprite_{$color}.png";
			
		if( !function_exists( 'imagefilter' ) )
			return THEME_IMAGES_ASSETS . '/sprite_template.png';
		
		# Colorize template sprite
		$im = @imagecreatefrompng( THEME_IMAGES_DIR . '/assets/sprite_template.png' );
		
		if( !$im )
			THEME_IMAGES_ASSETS . '/sprite_template.png';
		
		imagealphablending( $im, true );
		imagesavealpha( $im, true );
		imagefilter( $im, IMG_FILTER_COLORIZE, $r, $g, $b );
		$im_new = imagepng( $im, $img_sprite );
		imagedestroy( $im );
		
		if( $im_new ) {
			@chmod( $img_sprite, 0000666 );
			return THEME_SPRITES . "/custom_sprite_{$color}.png";
		} else {
			return THEME_IMAGES_ASSETS . '/sprite_template.png';
		}
	}
	
	/**
	 *
	 */
	function update_skin( $saved_skins, $update_skin ) {
		if( $saved_skins != $update_skin ) {
			if( update_option( MYSITE_SKINS, $update_skin ) )
				return true;
			else
				return false;
				
		} else {
			return true;
		}

		return false;
	}
	
	/**
	 *
	 */
	function skin_nt_writable( $name, $nt_writable ) {		
		array_push( $nt_writable, $name );
		
		if( update_option( MYSITE_SKIN_NT_WRITABLE, $nt_writable ) )
			return true;
		else
			return false;
	}
	
	/**
	 *
	 */
	function skin_writable( $name ) {
		$saved_skins = get_option( MYSITE_SKIN_NT_WRITABLE );
		
		if( empty( $saved_skins ) )
			return false;
		
		$found = false;
		foreach( $saved_skins as $key => $value ) {
			if( $value == $name ) {
				$found = true;
				unset( $saved_skins[$key] );
			}
		}
		
		if( $found ) {
			if( update_option( MYSITE_SKIN_NT_WRITABLE, $saved_skins ) )
				return true;
			else
				return false;
			
		} else {
			return false;
		}
	}
	
	/**
	 *
	 */
	function activate_skin( $name, $suppress_msg = true, $init = false ) {
		$saved_skins = ( get_option( MYSITE_ACTIVE_SKIN ) ) ? get_option( MYSITE_ACTIVE_SKIN ) : array();
		
		if( $init && !empty( $saved_skins ) )
			return true;
		
		if( $suppress_msg && !$init ) {
			if( !isset( $saved_skins['style_variations'] ) )
				return true;
			
			elseif( $saved_skins['style_variations'] != $name )
				return true;
		}
		
		$this->stylesheet = $name;
		$full_bg = array();
		$fonts = array();
		$cufon_gradients = array();
		$cufon_gradients_fonts = array();
		$cufon_gradients_write = '';
		$parse_options = $this->parse_options();
		foreach( $parse_options as $key => $value ) {
			if( !empty( $value['name'] ) )
				if( strpos( $value['name'], 'font' ) !== false ) {
					if( ( !empty( $value['properties'] ) ) && ( !empty( $value['declaration'] ) ) )
						foreach( $value['properties'] as $i => $properties )
							if( $properties == 'font-family' ) {
								$value['declaration'] = str_replace( array( "\r\n", "\r", "\n" ), '', $value['declaration'] );
								$fonts[$value['declaration']] = $value['value'][$i];
							}
								
								
				} elseif( strpos( $value['name'], 'cufon' ) !== false ) {
					$cufon_gradients[$value['declaration']] = $value['value'];
				}
		}
		
		foreach( $fonts as $declaration => $font ) {
			unset( $fonts['.jqueryslidemenu ul ul a'] );
			
			if( !array_key_exists( $font, mysite_cufon_fonts() ) )
				unset( $fonts[$declaration] );
				
			foreach( $cufon_gradients as $cufon_declaration => $cufon_font )
				if( $declaration == $cufon_declaration ) {
					$cufon_gradients_write .= "\nCufon.replace('{$cufon_declaration}',{\n";
					$cufon_gradients_write .= preg_replace( '/fontFamily\:(.*),/', "fontFamily: '{$font}',", $cufon_font );
					$cufon_gradients_write .= '});';
					$cufon_gradients_fonts[$cufon_declaration] = $font;
					unset( $fonts[$declaration] );
				}
		}
		
		# Check for fullscreen background option
		if( isset( $parse_options['body_bg']['value'] ) ) {
			$fullbg_options = $parse_options['body_bg']['value']['fullbg_options'];
			if( is_array( $fullbg_options ) && !empty( $fullbg_options ) ) {
				if ( in_array( 'fullbg', $fullbg_options ) ) {
					$full_bg = array_merge( (array)$full_bg, array( 'fullbg' ) );
					$full_bg = array_merge( (array)$full_bg, array( 'url' => $parse_options['body_bg']['value'][0] ) );

					if ( in_array( 'fadebg', $fullbg_options ) )
						$full_bg = array_merge( (array)$full_bg, array( 'fadebg' ) );
				}
			}
		}
		
		#print_r( $fonts ); exit;
		$update_skin = array( 'fonts' => $fonts, 'style_variations' =>  $name, 'cufon_gradients' => $cufon_gradients_write, 'cufon_gradients_fonts' => $cufon_gradients_fonts, 'full_bg' => $full_bg );
		
		if( array_key_exists( $name, mysite_wpmu_style_option() ) )
			$update_skin = array_merge( $update_skin, array( 'wpmu' => true ) );
		
		if( $suppress_msg ) {
			if( $saved_skins != $update_skin ) {
				if( update_option( MYSITE_ACTIVE_SKIN, $update_skin ) )
					return true;
				else
					return false;

			} else {
				return true;
			}

			return false;
		}
		
		
		if( $saved_skins != $update_skin ) {
			if( update_option( MYSITE_ACTIVE_SKIN, $update_skin ) )
				return array( 'success' => 'skin_activated', 'message' => $this->json_response( $args = array( 'type' => 'skin_activated', 'name' => $name ) ) );
			else
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_activated' ) ) );
				
		} else {
			return array( 'success' => 'skin_activated', 'message' => $this->json_response( $args = array( 'type' => 'skin_activated', 'name' => $name ) ) );
		}
		
		return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_activated' ) ) );
	}
	
	/**
	 *
	 */
	function fullbg_option( $stylesheet, $post_styles ) {
		
		if( isset( $post_styles['advanced_edit'] ) )
			return $stylesheet;
			
		preg_match_all( '%^\/\*(.*?)\*\/%', $stylesheet, $matches, PREG_SET_ORDER );
		if( !empty( $matches ) ) {

			$new_header = '';
			$explode_header = explode( ':', $matches[0][1] );
			if( isset( $explode_header[1] ) ) {
				$fullbg_strip = preg_replace('/\s*/', '', $explode_header[1] );
				$explode_fullbg = explode( ',', $fullbg_strip );
				if( is_array( $explode_fullbg ) ) {
					foreach( $explode_fullbg as $key => $bg_value ) {
						if( $bg_value == 'fullbg' && !isset( $post_styles['full_bg'] ) ) 
							unset( $explode_fullbg[$key] );

						if( $bg_value == 'fadebg' && ( !isset( $post_styles['full_bg'] ) || !isset( $post_styles['fade_bg'] ) ) )
							unset( $explode_fullbg[$key] );
					}
				}

				if( !in_array( 'fadebg', $explode_fullbg ) && isset( $post_styles['full_bg'] ) && isset( $post_styles['fade_bg'] ) )
					$explode_fullbg = array_merge( $explode_fullbg, array( 'fadebg' ) );

				$new_header = '/* ' . trim( $explode_header[0] ) . ( !empty( $explode_fullbg ) ? ' :' . join( ',', $explode_fullbg ) : '' ) . ' */';

			} else {
				$explode_header = explode( ' ', $matches[0][1] );
				$old_header = array();
				$fullbg_header = array();
				foreach( $explode_header as $header_value ) {
					if( !empty( $header_value ) )
						$old_header[] = $header_value;
				}

				if( isset( $post_styles['full_bg'] ) )
					$fullbg_header = array_merge( $fullbg_header, array( 'fullbg' ) );

				if( isset( $post_styles['full_bg'] ) && isset( $post_styles['fade_bg'] ) )
					$fullbg_header = array_merge( $fullbg_header, array( 'fadebg' ) );

				$new_header = '/* ' . join( ' ', $old_header ) . ( !empty( $fullbg_header ) ? ' :' . join( ',', $fullbg_header ) : '' ) . ' */';
			}

			return str_replace( $matches[0][0], $new_header, $stylesheet );
		}
		
		return $stylesheet;
	}
	
	/**
	 *
	 */
	function unzip_skin( $name ) {
		if( !class_exists( 'PclZip' ) )
			require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
		
		$zipfile = $this->stylesdir . '/' . $name;
		$archive = new PclZip( $zipfile );
		$extract = $archive->extract( PCLZIP_OPT_PATH, $this->stylesdir, PCLZIP_OPT_SET_CHMOD, 0666 );
		
		if ( $extract == 0 ) {
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_unzipped' ) ) );
		} else {
			@chmod( $this->stylesdir . '/' . str_replace('.zip', '', $name) , 0000777 );
			@unlink( $zipfile );
		}
			
			
		$cssfile = array();
		if( !empty( $extract ) ) {
			foreach( $extract as $file ) {
				$filepath = str_replace( $this->stylesdir, '', $file['filename'] );
				$explode_path = explode( '/', $filepath );

				if( !empty( $explode_path[1] ) )
					if( strpos( $explode_path[1], '.css' ) !== false )
						$cssfile[$explode_path[1]] = '&quot;' . str_replace('.css', '', $explode_path[1] ) . '&quot;';
			}
		}
		
		if( empty( $cssfile ) )
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'unzipped_nocss' ) ) );
			
		touch( $this->stylesdir . '/' . $explode_path[1] . '.css' );
		if( is_multisite() ) {
			global $blog_id;
			if( $blog_id != 1 )
				rename( $this->stylesdir . '/' . $explode_path[1] . '.css', $this->stylesdir . '/' . md5( THEME_NAME ) . 'muskin_' . $explode_path[1] . '.css' );
		}
			
		$loader = '<span class="ajax_feedback_manage_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></span>';
			
		foreach( $cssfile as $key => $value ) {
			$out = '<tr>';
			$out .= '<td>' . $key . '</td>';
			$out .= '<td><div class="mysite_skin_edit"><a href="#" rel="' . $key . '">' . __( 'Edit', MYSITE_ADMIN_TEXTDOMAIN ) . '</a></div></td>';
			$out .= '<td><div class="mysite_skin_export"><a href="#" rel="' . $key . '">' . __( 'Export', MYSITE_ADMIN_TEXTDOMAIN ) . '</a></div>' . $loader . '</td>';
			$out .= '<td><div class="mysite_skin_advanced"><a href="#" rel="' . $key . '">' . __( 'Advanced', MYSITE_ADMIN_TEXTDOMAIN ) . '</a></div></td>';
			$out .= '<td><div class="mysite_skin_delete"><a href="#" rel="' . $key . '">' . __( 'Delete', MYSITE_ADMIN_TEXTDOMAIN ) . '</a></div>' . $loader . '</td>';
			$out .= '</tr>';
		}
		
		return array( 'success' => 'unzip_skin', 'skin_name' => $cssfile, 'html' => $out, 'message' => $this->json_response( $args = array( 'type' => 'unzipped', 'cssfile' => $cssfile ) ) );
	}
	
	/**
	 *
	 */
	function delete_skin( $name ) {
		
		$stylesheet = str_replace('.css', '', $name );
		$active_skin = get_option( MYSITE_ACTIVE_SKIN );
		
		if( $name == $active_skin['style_variations'] )
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'active_skin', 'name' => $stylesheet ) ) );
		
		if( !mysite_is_styles_writable() ) {
			$nt_writable = get_option( MYSITE_SKIN_NT_WRITABLE );
			
			if( empty( $nt_writable ) )
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
				
			if( in_array( $stylesheet, $nt_writable ) ) {
				$saved_skins = get_option( MYSITE_SKINS );
				$update_skin = $saved_skins;
				unset( $update_skin[$stylesheet] );
				
				if( ( $this->update_skin( $saved_skins, $update_skin ) ) && ( $this->skin_writable( $stylesheet ) ) )
					return array( 'success' => true, 'message' => $this->json_response( $args = array( 'type' => 'skin_deleted', 'name' => $stylesheet ) ) );
				else
					return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
					
			} else {
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
			}
			 
		} else {
			
			if( is_multisite() ) {
				global $blog_id;
				if( $blog_id != 1 )
					$name = md5( THEME_NAME ) . 'muskin_' . $name;
			}
			
			if( @is_file( $this->stylesdir . '/' . $name ) ) {
				$saved_skins = get_option( MYSITE_SKINS );
				$update_skin = $saved_skins;
				unset( $update_skin[$stylesheet] );
				$this->update_skin( $saved_skins, $update_skin );
				$this->skin_writable( $stylesheet );
				
				if( @unlink( $this->stylesdir . '/' . $name ) )
					return array( 'success' => true, 'message' => $this->json_response( $args = array( 'type' => 'skin_deleted', 'name' => $stylesheet ) ) );
				else
					return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
				
			} else {
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
			}
		}
		
		return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_deleted', 'name' => $stylesheet ) ) );
	}
	
	/**
	 *
	 */
	function advanced_edit() {
		$out = '';
		
		$content = $this->get_contents( $this->stylesheet );
		
		if( empty( $content ) ) {
			$out .= '<div class="skin_generator_manage advanced_skin_option_set">';
			
			$out .= '<div class="mysite_option_set skin_generator_error">' . $this->json_response( $args = array( 'type' => 'error_loading', 'name' => $this->stylesheet ) );
			$out .= '<div class="edit_skin_button"><span class="button cancel_skin_edit">' . __( 'Return to Skin Manager', MYSITE_ADMIN_TEXTDOMAIN ) . '</span></div>';
			
			$out .= '</div>';
			$out .= '</div>';
			
			return $out;
		}
		
		$out .= '<div class="skin_generator_manage advanced_skin_option_set">';
		
		$out .= '<textarea tabindex="1" id="advanced_edit" name="advanced_edit" rows="35" cols="72">' . $content . '</textarea>';
		
		$out .= '<div class="mysite_option_set edit_skin_save">';
		
		$out .= '<input name="custom_skin_name" type="text" id="custom_skin_name" class="mysite_textfield" onkeyup="mysiteAdmin.fixField(this);">';
		
		$out .= '<div class="edit_skin_button"><span class="button save_custom_skin">' . __( 'Save As New Skin', MYSITE_ADMIN_TEXTDOMAIN ) . '</span></div>';
		
		$out .= '<div class="edit_skin_button"><span class="save_manage_skin">' . __( 'Save Skin', MYSITE_ADMIN_TEXTDOMAIN ) . '</span></div>';
		
		$out .= '<div class="edit_skin_button"><span class="cancel_skin_edit">' . __( 'Cancel Edit', MYSITE_ADMIN_TEXTDOMAIN ) . '</span></div>';
		
		$out .= '<div class="ajax_feedback_save_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></div>';
		
		$out .= '<input type="hidden" name="_mysite_save_manage_skin" value="' . $this->stylesheet . '" />';

		$out .= '</div>';
		
		$out .= '</div>';
		
		return $out;
	}
	
	/**
	 *
	 */
	function manage_skin() {
		$loader = '<span class="ajax_feedback_manage_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></span>';
		
		$out = '<div class="skin_generator_manage skins_option_set">';
		
		$out .= '<table>';
		$out .= '<tbody>';
		
		foreach( mysite_style_option() as $style ) {
			
			$out .= '<tr>';
			$out .= '<td>' . $style . '</td>';
			$out .= '<td><div class="mysite_skin_edit"><a href="#" rel="' . $style . '">' . __( 'Edit', MYSITE_ADMIN_TEXTDOMAIN ) . '</a></div></td>';
			$out .= '<td><div class="mysite_skin_export"><a href="#" rel="' . $style . '">' . __( 'Export', MYSITE_ADMIN_TEXTDOMAIN ) . '</a></div>' . $loader . '</td>';
			$out .= '<td><div class="mysite_skin_advanced"><a href="#" rel="' . $style . '">' . __( 'Advanced', MYSITE_ADMIN_TEXTDOMAIN ) . '</a></div></td>';
			$out .= '<td><div class="mysite_skin_delete"><a href="#" rel="' . $style . '">' . __( 'Delete', MYSITE_ADMIN_TEXTDOMAIN ) . '</a></div>' . $loader . '</td>';
			$out .= '</tr>';
		}
		
		$out .= '</tbody>';
		$out .= '</table>';
		
		$out .= '<div class="mysite_option_set import_skin">';
		$out .= '<div id="file-uploader"></div>';
		$out .= '<p class="upload_limit">( ' . sprintf( __( 'Maximum size limit is: %s', MYSITE_ADMIN_TEXTDOMAIN ), wp_convert_bytes_to_hr( wp_max_upload_size() ) ) . ' )</p>';
		$out .= '</div>';
		
		$out .= '</div>';
		
		return $out;
	}
		
	/**
	 *
	 */
	function filter_results( $m1,$m2,$m3,$m4,$m5,$m6,$post_styles ) {
		$post_key = str_replace( '-', '_', sanitize_title( $m2 ) );
		$post_styles[$post_key] = ( isset( $post_styles[$post_key] ) ) ? $post_styles[$post_key] : '';
		
		$replace_value = ( empty( $post_styles[$post_key] ) ) ? $m5 : '';
		
		$orginal_value = preg_split( '/(\s)*?(!important)?(\))?;([^:]*):*(\s)*(url\()*|^([^:]*):*(\s)*(url\()*/', $m5 );
		$properties = preg_split( '/:([^;]*);/', $m5 );

		if( is_array( $post_styles[$post_key] ) ) {
			$i=0;
			array_pop( $orginal_value );
			array_shift( $orginal_value );
			
			foreach( $post_styles[$post_key] as $key => $value ) {
				
				if( ( strpos( $orginal_value[$i], $value ) !== false ) && ( strpos( $orginal_value[$i], '@' ) !== false ) )
					$replace_value .= '/*' . $key . ':' . ( strpos( $key, 'image' ) !== false && strpos( $value, 'none' ) === false ? 'url(' . $value . ')' : $value ) . '@;*/';
				else
					$replace_value .= $key . ':' . ( strpos( $key, 'image' ) !== false && strpos( $value, 'none' ) === false ? 'url(' . $value . ')' : $value ) . ';';
				
				$i++;
			}
			
		} else {
			
			if( !empty( $post_styles[$post_key] ) ) {
				$properties[0] = str_replace( '/*', '', $properties[0] );
				
				if(  ( strpos( $orginal_value[1], $post_styles[$post_key] ) !== false ) && ( strpos( $orginal_value[1], '@' ) !== false ) )
					$replace_value = '/*' . $properties[0] . ':' . ( strpos( $properties[0], 'image' ) !== false && strpos( $post_styles[$post_key], 'none' ) === false ? 'url(' . $post_styles[$post_key] . ')' : $post_styles[$post_key] ) . '@;*/';
				else
					$replace_value = $properties[0] . ':' . ( strpos( $properties[0], 'image' ) !== false && strpos( $post_styles[$post_key], 'none' ) === false ? 'url(' . $post_styles[$post_key] . ')' : $post_styles[$post_key] ) . ';';
			}
		}
		
		if( $m2 == 'Color Scheme' )
			$this->colorscheme = $post_styles[$post_key];
		
		return $m1.$m2.$m3.$m4. stripslashes( $replace_value ) .$m6;
	}
	
	/**
	 *
	 */
	function options_output() {
		$out = '';
		
		$parse_options = $this->parse_options();
		
		if( empty( $parse_options ) ) {
			$out .= '<div class="skin_generator_' . $this->load_type . ' skin_generator_option_set">';
			
			$out .= '<div class="mysite_option_set skin_generator_error">' . $this->json_response( $args = array( 'type' => 'error_loading', 'name' => $this->stylesheet ) );
			$out .= '<div class="edit_skin_button"><span class="button cancel_skin_edit">' . __( 'Return to Skin Manager', MYSITE_ADMIN_TEXTDOMAIN ) . '</span></div>';
			
			$out .= '</div>';
			$out .= '</div>';
			
			return $out;
		}
		
		$out .= '<div class="skin_generator_' . $this->load_type . ' skin_generator_option_set">';
		
		foreach( $parse_options as $key => $value ) {
			
			if( !empty( $value['option'] ) ) {
				if( method_exists( $this, $value['option'] ) ) {
					$out .= $this->$value['option'](array(
						'name' => $value['title'],
						'id' => $value['name'],
						'default' => $value['value'],
						'target' => $value['option'],
						'properties' => $value['properties']
					));
				}
			}
		}
		
		if( $this->load_type == 'create' ) {
			$out .= '<div class="mysite_option_set create_skin_save">';
			
			$out .= '<div class="mysite_option_header">' . __( 'Save Skin As', MYSITE_ADMIN_TEXTDOMAIN ) . '</div>';
			
			$out .= '<div class="mysite_option">';
			
			$out .= '<input name="custom_skin_name" type="text" id="custom_skin_name" class="mysite_textfield" onkeyup="mysiteAdmin.fixField(this);">';
			
			$out .= '<div class="edit_skin_button"><span class="button save_custom_skin">' . __( 'Save Skin', MYSITE_ADMIN_TEXTDOMAIN ) . '</span></div>';
			
			$out .= '<div class="ajax_feedback_save_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></div>';
			
			$out .= '</div>';
			
			$out .= '</div>';
		}
		
		if( $this->load_type == 'manage' ) {
			$out .= '<div class="mysite_option_set edit_skin_save">';
			
			$out .= '<input name="custom_skin_name" type="text" id="custom_skin_name" class="mysite_textfield" onkeyup="mysiteAdmin.fixField(this);">';
			
			$out .= '<div class="edit_skin_button"><span class="button save_custom_skin">' . __( 'Save As New Skin', MYSITE_ADMIN_TEXTDOMAIN ) . '</span></div>';
			
			$out .= '<div class="edit_skin_button"><span class="save_manage_skin">' . __( 'Save Skin', MYSITE_ADMIN_TEXTDOMAIN ) . '</span></div>';
			
			$out .= '<div class="edit_skin_button"><span class="cancel_skin_edit">' . __( 'Cancel Edit', MYSITE_ADMIN_TEXTDOMAIN ) . '</span></div>';
			
			$out .= '<div class="ajax_feedback_save_skin"><img src="' . esc_url( admin_url( 'images/loading.gif' ) ) . '" alt="" /></div>';
			
			$out .= '<input type="hidden" name="_mysite_save_manage_skin" value="' . $this->stylesheet . '" />';

			$out .= '</div>';
		}
		
		$out .= '</div>';
		
		return $out;
	}
	
	/**
	 *
	 */
	function parse_options() {
		$input_data = $this->get_contents( $this->stylesheet );
		
		if( empty( $input_data ) )
			return false;

		# preg match css styles
		preg_match_all( '%(\n.*?)(/\*:.*?)(.*?)(\*/?.*?)(\s*)([^}^~]*)(~?|}?.*?)%is', $input_data, $matches );
		
		$names = $matches[3];
		$values = str_replace( '@', '', $matches[6] );
		$declaration = preg_replace( '/\n|\{/', '', $matches[1] );

		$css_options = array();
		
		for( $i=0; $i<count($matches[0]); $i++ ) {

			$key = str_replace( '-', '_', sanitize_title( $names[$i] ) );
			
			$css_options[$key]['name'] = $key;
			$css_options[$key]['title'] = $names[$i];
			$css_options[$key]['declaration'] = $declaration[$i];
			
			if( strpos( $key, 'cufon' ) !== false )
				$css_options[$key]['value'] = str_replace( '*/', '', str_replace( '/*', '', $values[$i] ) );
			else
				$css_options[$key]['value'] = preg_split( '/(\s)*?(!important)?(\))?;([^:]*):*(\s)*(url\()*|^([^:]*):*(\s)*(url\()*/', $values[$i] );
			
			$css_options[$key]['properties'] = preg_split( '/:([^;]*);/', preg_replace( '%/\*|\*/%', '', $values[$i] ) );
			
			if( is_array( $css_options[$key]['value'] ) )
				array_pop( $css_options[$key]['value'] );
				
			if( is_array( $css_options[$key]['properties'] ) )
				array_pop( $css_options[$key]['properties'] );
			
			if( is_array( $css_options[$key]['value'] ) ) {
				array_shift( $css_options[$key]['value'] );
				
				foreach( $css_options[$key]['value'] as $css_key => $css_value ) {
					if( strpos( $css_value, 'rgba(' ) !== false )
						$css_options[$key]['value'][$css_key] = $css_value . ')';
				}
				
			} else {
				if( strpos( $css_options[$key]['value'], 'rgba(' ) !== false && strpos( $css_options[$key]['name'], 'cufon' ) === false )
					$css_options[$key]['value'] = $css_value . ')';
			}
				
			foreach( $this->patterns as $option => $pattern ) {
				if( strpos( $names[$i], $pattern['patterns'] ) !== false )
					$css_options[$key]['option'] = $option;
			}
		}
		
		# preg match fullscreen background option
		if( isset( $css_options['body_bg']['value'] ) ) {
			$full_bg = array();
			preg_match_all( '%^\/\*(.*?)\*\/%', $input_data, $matches, PREG_SET_ORDER );
			if( isset( $matches[0][0] ) ) {
				if( strpos( $matches[0][0], 'fullbg' ) !== false ) {
					$full_bg = array_merge( (array)$full_bg, array( 'fullbg' => 'fullbg' ) );

					if( strpos( $matches[0][0], ',fadebg' ) !== false )
						$full_bg = array_merge( (array)$full_bg, array( 'fadebg' => 'fadebg' ) );
				}
			}
			
			$css_options['body_bg']['value'] = $css_options['body_bg']['value'] + array( 'fullbg_options' => $full_bg );
		}

		return $css_options;
	}
	
	/**
	 *
	 */
	public function get_contents( $filename ) {

	    if( array_key_exists( $filename, mysite_wpmu_style_option() ) ) {
	        global $blog_id;
	        $uri = mysite_upload_dir( $key = 'baseurl' ) . '/styles/' . md5( THEME_NAME ) . 'muskin_' . $filename;
			$dir = mysite_upload_dir() . '/styles/' . md5( THEME_NAME ) . 'muskin_' . $filename;
	    } else {
	        $uri = THEME_URI . '/styles/' . $filename;
	        $dir = THEME_DIR . '/styles/' . $filename;
	    }

	    # Use curl if it exists
	    if (function_exists('curl_init')) {

	        $ch = curl_init();
			if( defined( 'CURLOPT_USER' ) && defined( 'CURLOPT_PWD' ) )
				curl_setopt($ch, CURLOPT_USERPWD, CURLOPT_USER.':'.CURLOPT_PWD);
				
	        curl_setopt($ch, CURLOPT_URL, $uri);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-Type: text/css' , 'Cache-Control: no-cache', 'Pragma: no-cache' ) );

	        $contents = curl_exec($ch);
	        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	        curl_close($ch);

	        # Read from database if there is a bad response
	        $bad_responses = array( '400', '401', '403', '404', '0' );
	        if ( in_array( $http_code, $bad_responses ) ) {
	            $skin_name = str_replace('.css', '', $filename );
	            $content = get_option( MYSITE_SKINS );
	            if( !empty( $content[$skin_name] ) ) {
	                return mysite_decode( $content[$skin_name] );

	            # If we still don't have any content fopen css file and get contents
	            } elseif ( $fh_input = @fopen($dir, 'r') ) {

	                $input_data = fread($fh_input, filesize($dir));
	                fclose($fh_input);

	                # Return content if response is good
	                if ( $input_data )
	                    return $input_data;
	                else
	                    return false;
	            }

	        }

	        # Return content if response is good
	        if ( $contents ) {
	            return $contents;

	        } else {

	            # If we still don't have any content read from the database
	            $skin_name = str_replace('.css', '', $filename );
	            $content = get_option( MYSITE_SKINS );
	            if( !empty( $content[$skin_name] ) ) {
	                return mysite_decode( $content[$skin_name] );

	            # If we still don't have any content fopen css file and get contents
	            } elseif ( $fh_input = @fopen($dir, 'r') ) {

	                $input_data = fread($fh_input, filesize($dir));
	                fclose($fh_input);

	                # Return content if response is good
	                if ( $input_data )
	                    return $input_data;
	                else
	                    return false;
	            }

	        }

	    # If curl is not installed fopen css file and get contents
	    } elseif ( $fh_input = @fopen($dir, 'r') ) {
	        $input_data = fread($fh_input, filesize($dir));
	        fclose($fh_input);

	        # Return content if response is good
	        if ( $input_data ) {
	            return $input_data;

	        } else {

	            # If we still don't have any content read from the database
	            $skin_name = str_replace('.css', '', $filename );
	            $content = get_option( MYSITE_SKINS );
	            if( !empty( $content[$skin_name] ) )
	                return mysite_decode( $content[$skin_name] );
	            else
	                return false;
	        }

	    } else {
	        # Read from database
	        $skin_name = str_replace('.css', '', $filename );
	        $content = get_option( MYSITE_SKINS );
	        if( !empty( $content[$skin_name] ) )
	            return mysite_decode( $content[$skin_name] );
	        else
	            return false;
	    }
	}
	
	/**
	 *
	 */
	function file_export( $export_file ) {
		$skin_zip = $this->stylesdir . '/skin_zip/';
		
		# check if styles folder is writable
		if( !mysite_is_styles_writable() )
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported', 'name' => $export_file ) ) );
			
		# make skin_zip folder to create zip
		if ( !wp_mkdir_p( $skin_zip ) )
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported', 'name' => $export_file ) ) );
			
		# check if skin_zip folder is writable, if not try to chmod
		if( !mysite_is_writable_dir( $skin_zip ) ) {
			if( !@chmod( $skin_zip, 0777) )
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported', 'name' => $export_file ) ) );
		}
		
		# get stylesheet contents
		if( $this->get_contents( $export_file ) )
			$input_data = $this->get_contents( $export_file );
		else
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported_2', 'name' => $export_file ) ) );
		
		# Set artificially high memory_limit
		@ini_set('memory_limit', '256M');
		
		# preg match all image urls
		preg_match_all( '/url\(([^\)]*)\)/', $input_data, $matches );
		
		# loop through all matches and create $images path string array
		$images = array();
		for( $i=0; $i<count($matches[1]); $i++ ) {
			
			$image_filter = $this->image_filter( $matches[1][$i], $export = true );
			
			if( isset( $image_filter['directory'] ) )
				$images[$i]['directory'] = $image_filter['directory'];
				
			if( isset( $image_filter['url'] ) )
				$images[$i]['url'] = $image_filter['url'];
		}
		
		# if $images array !empty loop thourgh and move to skin_zip
		if( !empty( $images ) ) {
			require_once( THEME_ADMIN_CLASSES . '/get-image.php' );
			$get_image = new GetImage;
			$get_image_error = array();
			$images_to_zip = array();
			
			foreach( $images as $image ) {
				
				# if we have a dir path first try and copy image
				if( !empty( $image['directory'] ) ) {
					$path_parts = pathinfo( $image['directory'] );
					if( @copy( $image['directory'], $skin_zip . $path_parts['basename'] ) ) {
						$images_to_zip[$path_parts['basename']] = $skin_zip . $path_parts['basename'];
						@chmod( $skin_zip . $path_parts['basename'], 0000666 );
						unset( $image['url'] );
					}
				}
				
				# get image
				if( !empty( $image['url'] ) ) {
					
					$path_parts = pathinfo( $image['url'] );
					$get_image->source = $image['url'];
					$get_image->save_to = $skin_zip;
					
					# Use curl if it exists
					if ( (function_exists('curl_init')) && ( !ini_get( 'safe_mode' ) ) && ( !ini_get( 'open_basedir' ) ) ) {
						if( $get_image->download('curl') ) {
							$images_to_zip[$path_parts['basename']] = $skin_zip . $path_parts['basename'];
							unset( $image['url'] );
						}
						
					# Use gd if it exists
					} elseif ( function_exists('gd_info') ) {
						if( $get_image->download('gd') ) {
							$images_to_zip[$path_parts['basename']] = $skin_zip . $path_parts['basename'];
							unset( $image['url'] );
						}
						
					# Use fread
					} else {
						if( $get_image->download('fread') ) {
							$images_to_zip[$path_parts['basename']] = $skin_zip . $path_parts['basename'];
							unset( $image['url'] );
						}
					}
				}
				
				if( !empty( $image['url'] ) )
					$get_image_error[] = $image['url'];
			}
		}
		
		# zip file name
		$zip_name = str_replace( '.css', '', $export_file );
		
		# preg_replace new image path in stylesheet if $images_to_zip !empty
		if( !empty( $images_to_zip ) ) {
			foreach( $images_to_zip as $image => $val ) {
				$new_path = 'url(' . $zip_name . '/' . $image;
				$patterns = "/url\((.*\/)$image/";
				$input_data = @preg_replace( $patterns, $new_path, $input_data );
			}
		}
		
		# write new image paths to stylesheet
		$css_writable = true;
		if ( !$fh = @fopen($skin_zip . $export_file, 'wb' ) ) $css_writable = false;
		if ( !@fwrite( $fh, $input_data ) ) $css_writable = false;
		if ( $fh ) fclose( $fh );
		
		define( 'PCLZIP_TEMPORARY_DIR', $skin_zip );
		# create zip file
		if( $css_writable ) {
			if(!class_exists('PclZip'))
				require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
				
			
			$archive = new PclZip( $skin_zip . $zip_name . '.zip' );
			$v_list = $archive->create( $skin_zip . $export_file, PCLZIP_OPT_REMOVE_ALL_PATH );
			
			if( $v_list != 0 ) {
				# if $images_to_zip array !empty add images to zip
				if ( ( $v_list != 0 ) && ( !empty( $images_to_zip ) ) ) {
					$archive = new PclZip( $skin_zip . $zip_name . '.zip');
				  	$v_list = $archive->add( $images_to_zip, PCLZIP_OPT_REMOVE_ALL_PATH, PCLZIP_OPT_ADD_PATH, $zip_name );
				
					# error adding images to zip
					if ($v_list == 0) {
						die("Error : ".$archive->errorInfo(true));
						$get_image_error = array_merge( (array)$get_image_error, array_keys( $images_to_zip ) );
					}
				}
				
			# couldn't create zip file
			} else {
				return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported_2', 'name' => $export_file ) ) );
			}
			
		# couldn't write to css file
		} else {
			return array( 'success' => false, 'message' => $this->json_response( $args = array( 'type' => 'not_exported', 'name' => $export_file ) ) );
		}
		
		# if $get_image_error !empty
		if( !empty( $get_image_error ) ) {
			foreach( $get_image_error as $image ) {
				$path_parts = pathinfo( $image );
				
				if( $path_parts['basename'] != 'none' )
					$image_error[] = '&quot;' . $path_parts['basename'] . '&quot;';
			}
			
			if( !empty( $image_error ) )
				$return_zip['message'] = $this->json_response( $args = array( 'type' => 'not_exported_img', 'image_error' => $image_error ) );
				$return_zip['image_error'] = true;
		}
		
		$return_zip['dl_skin'] = THEME_JS . '/dl-skin.php';
		$return_zip['zip'] = $skin_zip . $zip_name . '.zip';
		$return_zip['rmdir'] = $skin_zip;
		$return_zip['success'] = true;
		$return_zip['wpnonce'] = $_POST['mysite_admin_wpnonce'];
		
		return $return_zip;
	}
	
	/**
	 * 
	 */
	public static function skin_upload() {
			
		$allowed_ext = array( 'zip' );
		$size_limit = 50 * 1024 * 1024;
		
		if( is_multisite() ) {
			global $blog_id;
			if( $blog_id != 1 )
				$stylesdir = mysite_upload_dir() . '/styles';
			else
				$stylesdir = THEME_STYLES_DIR;
				
		} else {
			$stylesdir = THEME_STYLES_DIR;
		}
		
		/**
		 * Handle file uploads via XMLHttpRequest
		 */
		if ( isset( $_GET['qqfile'] ) ) {
			
			if( !mysite_is_styles_writable() )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $_GET['qqfile'] ) ) ) );
			
			# Return error if there's no content length
			if( isset( $_SERVER["CONTENT_LENGTH"] ) )
				$filesize = (int)$_SERVER["CONTENT_LENGTH"];
			else
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $_GET['qqfile'] ) ) ) );
				
			# Return error if file is to large
			if ( $filesize > $size_limit )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $_GET['qqfile'] ) ) ) );
			
			$pathinfo = pathinfo( $_GET['qqfile'] );
	        $filename = $pathinfo['filename'];
	        $ext = $pathinfo['extension'];
			$path = $stylesdir . '/' . $filename . '.' . $ext;
			
			# Return error if file isn't a zip
			if( !in_array( strtolower( $ext ), $allowed_ext ) )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'invalid_ext' ) ) ) );
			
			# Return error if file already exists
			if( @is_file( $stylesdir . '/' . $filename . '.css' ) )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_exists', 'name' => $filename ) ) ) );
			
			$input = fopen( 'php://input', 'r' );
	        $temp = tmpfile();
	        $real_size = stream_copy_to_stream( $input, $temp );
	        fclose( $input );
			
			# Check that the file sizes match
	        if ( $real_size != $filesize )
	            self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $_GET['qqfile'] ) ) ) );
			
			# Write zip to styles folder
			$file_uploaded = true;
			if ( !$fh = @fopen( $path, 'w' ) ) $file_uploaded = false;
			fseek( $temp, 0, SEEK_SET );
			if ( !@stream_copy_to_stream( $temp, $fh ) ) $file_uploaded = false;
			if ( $fh ) fclose( $fh );
			
			if( $file_uploaded )
				self::json_process( array( 'success' => true ) );
			else
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $_GET['qqfile'] ) ) ) );
				

		/**
		 * Handle file uploads via regular form post (uses the $_FILES array)
		 */
        } elseif ( isset( $_FILES['qqfile'] ) ) {
	
			$filesize = $_FILES['qqfile']['size'];

			# Return error if file is to large
			if ( $filesize > $size_limit )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $filename ) ) ) );
			
			$pathinfo = pathinfo( $_FILES['qqfile']['name'] );
	        $filename = $pathinfo['filename'];
	        $ext = $pathinfo['extension'];
			$path = $stylesdir . '/' . $filename . '.' . $ext;
			
			# Return error if file isn't a zip
			if( !in_array( strtolower( $ext ), $allowed_ext ) )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'invalid_ext' ) ) ) );
			
			# Return error if file already exists
			if( @is_file( $stylesdir . '/' . $filename . '.css' ) )
				self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_exists', 'name' => $filename ) ) ) );
		    
			if( !@move_uploaded_file ($_FILES['qqfile']['tmp_name'], $path ) )
	            self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => $filename ) ) ) );
			else
				self::json_process( array( 'success' => true ) );
            
        } else {
	
            self::json_process( array( 'success' => false, 'message' => self::json_response( $args = array( 'type' => 'upload_error', 'name' => '' ) ) ) );

        }

	}
	
}

?>