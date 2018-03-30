<?php
/**
 * Ancora Framework: file system manipulations, styles and scripts usage, etc.
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* File system utils
------------------------------------------------------------------------------------- */

// Return list folders inside specified folder in the child theme dir (if exists) or main theme dir
if (!function_exists('ancora_get_list_folders')) {
	function ancora_get_list_folders($folder, $only_names=true) {
		$dir = ancora_get_folder_dir($folder);
		$url = ancora_get_folder_url($folder);
		$list = array();
		if ( is_dir($dir) ) {
			$hdir = @opendir( $dir );
			if ( $hdir ) {
				while (($file = readdir( $hdir ) ) !== false ) {
					if ( substr($file, 0, 1) == '.' || !is_dir( ($dir) . '/' . ($file) ) )
						continue;
					$key = $file;
					$list[$key] = $only_names ? ancora_strtoproper($key) : ($url) . '/' . ($file);
				}
				@closedir( $hdir );
			}
		}
		return $list;
	}
}

// Return list files in folder
if (!function_exists('ancora_get_list_files')) {
	function ancora_get_list_files($folder, $ext='', $only_names=false) {
		$dir = ancora_get_folder_dir($folder);
		$url = ancora_get_folder_url($folder);
		$list = array();
		if ( is_dir($dir) ) {
			$hdir = @opendir( $dir );
			if ( $hdir ) {
				while (($file = readdir( $hdir ) ) !== false ) {
					$pi = pathinfo( ($dir) . '/' . ($file) );
					if ( substr($file, 0, 1) == '.' || is_dir( ($dir) . '/' . ($file) ) || (!empty($ext) && $pi['extension'] != $ext) )
						continue;
					$key = ancora_substr($file, 0, ancora_strrpos($file, '.'));
					if (ancora_substr($key, -4)=='.min') $key = ancora_substr($file, 0, ancora_strrpos($key, '.'));
					$list[$key] = $only_names ? ancora_strtoproper(str_replace('_', ' ', $key)) : ($url) . '/' . ($file);
				}
				@closedir( $hdir );
			}
		}
		return $list;
	}
}

// Return list files in subfolders
if (!function_exists('ancora_collect_files')) {
	function ancora_collect_files($dir, $ext=array()) {
		if (!is_array($ext)) $ext = array($ext);
		if (ancora_substr($dir, -1)=='/') $dir = ancora_substr($dir, 0, ancora_strlen($dir)-1);
		$list = array();
		if ( is_dir($dir) ) {
			$hdir = @opendir( $dir );
			if ( $hdir ) {
				while (($file = readdir( $hdir ) ) !== false ) {
					$pi = pathinfo( $dir . '/' . $file );
					if ( substr($file, 0, 1) == '.' )
						continue;
					if ( is_dir( $dir . '/' . $file ))
						$list = array_merge($list, ancora_collect_files($dir . '/' . $file, $ext));
					else if (empty($ext) || in_array($pi['extension'], $ext))
						$list[] = $dir . '/' . $file;
				}
				@closedir( $hdir );
			}
		}
		return $list;
	}
}

// Return path to directory with uploaded images
if (!function_exists('ancora_get_uploads_dir_from_url')) {
	function ancora_get_uploads_dir_from_url($url) {
		$upload_info = wp_upload_dir();
		$upload_dir = $upload_info['basedir'];
		$upload_url = $upload_info['baseurl'];
		
		$http_prefix = "http://";
		$https_prefix = "https://";
		
		if (!strncmp($url, $https_prefix, ancora_strlen($https_prefix)))			//if url begins with https:// make $upload_url begin with https:// as well
			$upload_url = str_replace($http_prefix, $https_prefix, $upload_url);
		else if (!strncmp($url, $http_prefix, ancora_strlen($http_prefix)))		//if url begins with http:// make $upload_url begin with http:// as well
			$upload_url = str_replace($https_prefix, $http_prefix, $upload_url);		
	
		// Check if $img_url is local.
		if ( false === ancora_strpos( $url, $upload_url ) ) return false;
	
		// Define path of image.
		$rel_path = str_replace( $upload_url, '', $url );
		$img_path = ($upload_dir) . ($rel_path);
		
		return $img_path;
	}
}

// Replace uploads url to current site uploads url
if (!function_exists('ancora_replace_uploads_url')) {
	function ancora_replace_uploads_url($str, $uploads_folder='uploads') {
		static $uploads_url = '';
		if (empty($uploads_url)) {
			$uploads_info = wp_upload_dir();
			$uploads_url = $uploads_info['baseurl'];
		}
		if (is_array($str)) {
			foreach ($str as $k=>$v) {
				$str[$k] = ancora_replace_uploads_url($v, $uploads_folder);
			}
		} else if (is_string($str)) {
			while (($pos = ancora_strpos($str, "/{$uploads_folder}/"))!==false) {
				$pos0 = $pos;
				while ($pos0) {
					if (ancora_substr($str, $pos0, 5)=='http:' || ancora_substr($str, $pos0, 6)=='https:')
						break;
					$pos0--;
				}
				$str = ($pos0 > 0 ? ancora_substr($str, 0, $pos0) : '') . ($uploads_url) . ancora_substr($str, $pos+ancora_strlen($uploads_folder)+1);
			}
		}
		return $str;
	}
}


// Autoload templates, widgets, etc.
// Scan subfolders and require() file with same name in each folder
if (!function_exists('ancora_autoload_folder')) {
	function ancora_autoload_folder($folder, $from_subfolders=true, $from_skin=true) {
		static $skin_dir = '';
		if ($folder[0]=='/') $folder = ancora_substr($file, 1);
		if ($from_skin && empty($skin_dir) && function_exists('ancora_get_custom_option')) {
			$skin_dir = ancora_esc(ancora_get_custom_option('theme_skin'));
			if ($skin_dir) $skin_dir  = 'skins/'.($skin_dir);
		} else
			$skin_dir = '-no-skins-';
		$theme_dir = get_template_directory();
		$child_dir = get_stylesheet_directory();
		$dirs = array(
			($child_dir).'/'.($skin_dir).'/'.($folder),
			($child_dir).'/'.($folder),
			($child_dir).(ANCORA_FW_DIR).($folder),
			($theme_dir).'/'.($skin_dir).'/'.($folder),
			($theme_dir).'/'.($folder),
			($theme_dir).(ANCORA_FW_DIR).($folder)
		);
		$loaded = array();
		foreach($dirs as $dir) {
			if ( is_dir($dir) ) {
				$hdir = @opendir( $dir );
				if ( $hdir ) {
					while ( ($file = readdir($hdir)) !== false ) {
						if (substr($file, 0, 1) == '.' || in_array($file, $loaded))
							continue;
						if ( is_dir( ($dir) . '/' . ($file) ) ) {
							if ($from_subfolders && file_exists( ($dir) . '/' . ($file) . '/' . ($file) . '.php' ) ) {
								$loaded[] = $file;
								require_once( ($dir) . '/' . ($file) . '/' . ($file) . '.php' );
							}
						} else {
							$loaded[] = $file;
							require_once( ($dir) . '/' . ($file) );
						}
					}
					@closedir( $hdir );
				}
			}
		}
	}
}



/* File system utils
------------------------------------------------------------------------------------- */

// Put text into specified file
if (!function_exists('ancora_fpc')) {
	function ancora_fpc($file, $content, $flag=0) {
		$fn = join('_', array('file', 'put', 'contents'));
		return @$fn($file, $content, $flag);
	}
}

// Get text from specified file
if (!function_exists('ancora_fgc')) {
	function ancora_fgc($file) {
		$fn = join('_', array('file', 'get', 'contents'));
		return @$fn($file);
	}
}

// Get array with rows from specified file
if (!function_exists('ancora_fga')) {
	function ancora_fga($file) {
		return @file($file);
	}
}

// Remove unsafe characters from file/folder path
if (!function_exists('ancora_esc')) {
	function ancora_esc($file) {
		//return function_exists('escapeshellcmd') ? @escapeshellcmd($file) : str_replace(array('~', '>', '<', '|'), '', $file);
		return str_replace(array('\\'), array('/'), $file);
		//return str_replace(array('~', '>', '<', '|', '"', "'", '`', "\xFF", "\x0A", '#', '&', ';', '*', '?', '^', '(', ')', '[', ']', '{', '}', '$'), '', $file);
	}
}

// Create folder
if (!function_exists('ancora_mkdir')) {
	function ancora_mkdir($folder, $addindex = true) {
		if (is_dir($folder) && $addindex == false) return true;
		$created = wp_mkdir_p(trailingslashit($folder));
		@chmod($folder, 0777);
		if ($addindex == false) return $created;
		$index_file = trailingslashit($folder) . 'index.php';
		if (file_exists($index_file)) return $created;
		ancora_fpc($index_file, "<?php\n// Silence is golden.\n");
		return $created;
	}
}


/* Enqueue scripts and styles from child or main theme directory and use .min version
------------------------------------------------------------------------------------- */

// Enqueue .min.css (if exists and filetime .min.css > filetime .css) instead .css
if (!function_exists('ancora_enqueue_style')) {
	function ancora_enqueue_style($handle, $src=false, $depts=array(), $ver=null, $media='all') {
		$load = true;
		if (!is_array($src) && $src !== false && $src !== '') {
			$debug_mode = ancora_get_theme_option('debug_mode');
			$theme_dir = get_template_directory();
			$theme_url = get_template_directory_uri();
			$child_dir = get_stylesheet_directory();
			$child_url = get_stylesheet_directory_uri();
			$dir = $url = '';
			if (ancora_strpos($src, $child_url)===0) {
				$dir = $child_dir;
				$url = $child_url;
			} else if (ancora_strpos($src, $theme_url)===0) {
				$dir = $theme_dir;
				$url = $theme_url;
			}
			if ($dir != '') {
				if ($debug_mode == 'no') {
					if (ancora_substr($src, -4)=='.css') {
						if (ancora_substr($src, -8)!='.min.css') {
							$src_min = ancora_substr($src, 0, ancora_strlen($src)-4).'.min.css';
							$file_src = $dir . ancora_substr($src, ancora_strlen($url));
							$file_min = $dir . ancora_substr($src_min, ancora_strlen($url));
							if (file_exists($file_min) && filemtime($file_src) <= filemtime($file_min)) $src = $src_min;
						}
					}
				}
				$file_src = $dir . ancora_substr($src, ancora_strlen($url));
				$load = file_exists($file_src) && filesize($file_src) > 0;
			}
		}
		if ($load) {
			if (is_array($src))
				wp_enqueue_style( $handle, $depts, $ver, $media );
			else
				wp_enqueue_style( $handle, $src, $depts, $ver, $media );
		}
	}
}

// Enqueue .min.js (if exists and filetime .min.js > filetime .js) instead .js
if (!function_exists('ancora_enqueue_script')) {
	function ancora_enqueue_script($handle, $src=false, $depts=array(), $ver=null, $in_footer=false) {
		$load = true;
		if (!is_array($src) && $src !== false && $src !== '') {
			$debug_mode = ancora_get_theme_option('debug_mode');
			$theme_dir = get_template_directory();
			$theme_url = get_template_directory_uri();
			$child_dir = get_stylesheet_directory();
			$child_url = get_stylesheet_directory_uri();
			$dir = $url = '';
			if (ancora_strpos($src, $child_url)===0) {
				$dir = $child_dir;
				$url = $child_url;
			} else if (ancora_strpos($src, $theme_url)===0) {
				$dir = $theme_dir;
				$url = $theme_url;
			}
			if ($dir != '') {
				if ($debug_mode == 'no') {
					if (ancora_substr($src, -3)=='.js') {
						if (ancora_substr($src, -7)!='.min.js') {
							$src_min  = ancora_substr($src, 0, ancora_strlen($src)-3).'.min.js';
							$file_src = $dir . ancora_substr($src, ancora_strlen($url));
							$file_min = $dir . ancora_substr($src_min, ancora_strlen($url));
							if (file_exists($file_min) && filemtime($file_src) <= filemtime($file_min)) $src = $src_min;
						}
					}
				}
				$file_src = $dir . ancora_substr($src, ancora_strlen($url));
				$load = file_exists($file_src) && filesize($file_src) > 0;
			}
		}
		if ($load) {
			if (is_array($src))
				wp_enqueue_script( $handle, $depts, $ver, $in_footer );
			else
				wp_enqueue_script( $handle, $src, $depts, $ver, $in_footer );
		}
	}
}


/* Check if file/folder present in the child theme and return path (url) to it. 
   Else - path (url) to file in the main theme dir
------------------------------------------------------------------------------------- */

// Detect file location with next algorithm:
// 1) check in the skin folder in the child theme folder (optional, if $from_skin==true)
// 2) check in the child theme folder
// 3) check in the framework folder in the child theme folder
// 4) check in the skin folder in the main theme folder (optional, if $from_skin==true)
// 5) check in the main theme folder
// 6) check in the framework folder in the main theme folder
if (!function_exists('ancora_get_file_dir')) {
	function ancora_get_file_dir($file, $return_url=false, $from_skin=true) {
		static $skin_dir = '';
		if ($file[0]=='/') $file = ancora_substr($file, 1);
		if ($from_skin && empty($skin_dir) && function_exists('ancora_get_custom_option')) {
			$skin_dir = ancora_esc(ancora_get_custom_option('theme_skin'));
			if ($skin_dir) $skin_dir  = 'skins/' . ($skin_dir);
		}
		$theme_dir = get_template_directory();
		$theme_url = get_template_directory_uri();
		$child_dir = get_stylesheet_directory();
		$child_url = get_stylesheet_directory_uri();
		$dir = '';
		if ($from_skin && !empty($skin_dir) && file_exists(($child_dir).'/'.($skin_dir).'/'.($file)))
			$dir = ($return_url ? $child_url : $child_dir).'/'.($skin_dir).'/'.($file);
		else if (file_exists(($child_dir).'/'.($file)))
			$dir = ($return_url ? $child_url : $child_dir).'/'.($file);
		else if (file_exists(($child_dir).(ANCORA_FW_DIR).($file)))
			$dir = ($return_url ? $child_url : $child_dir).(ANCORA_FW_DIR).($file);
		else if ($from_skin && !empty($skin_dir) && file_exists(($theme_dir).'/'.($skin_dir).'/'.($file)))
			$dir = ($return_url ? $theme_url : $theme_dir).'/'.($skin_dir).'/'.($file);
		else if (file_exists(($theme_dir).'/'.($file)))
			$dir = ($return_url ? $theme_url : $theme_dir).'/'.($file);
		else if (file_exists(($theme_dir).(ANCORA_FW_DIR).($file)))
			$dir = ($return_url ? $theme_url : $theme_dir).(ANCORA_FW_DIR).($file);
		return $dir;
	}
}

if (!function_exists('ancora_get_file_url')) {
	function ancora_get_file_url($file) {
		return ancora_get_file_dir($file, true);
	}
}

// Detect file location in the skin/theme/framework folders
if (!function_exists('ancora_get_skin_file_dir')) {
	function ancora_get_skin_file_dir($file) {
		return ancora_get_skin_file_dir($file, false, true);
	}
}

if (!function_exists('ancora_get_skin_file_url')) {
	function ancora_get_skin_file_url($file) {
		return ancora_get_skin_file_dir($file, true, true);
	}
}

// Detect folder location with same algorithm as file (see above)
if (!function_exists('ancora_get_folder_dir')) {
	function ancora_get_folder_dir($folder, $return_url=false, $from_skin=false) {
		static $skin_dir = '';
		if ($folder[0]=='/') $folder = ancora_substr($folder, 1);
		if ($from_skin && empty($skin_dir) && function_exists('ancora_get_custom_option')) {
			$skin_dir = ancora_esc(ancora_get_custom_option('theme_skin'));
			if ($skin_dir) $skin_dir  = 'skins/'.($skin_dir);
		}
		$theme_dir = get_template_directory();
		$theme_url = get_template_directory_uri();
		$child_dir = get_stylesheet_directory();
		$child_url = get_stylesheet_directory_uri();
		$dir = '';
		if (!empty($skin_dir) && file_exists(($child_dir).'/'.($skin_dir).'/'.($folder)))
			$dir = ($return_url ? $child_url : $child_dir).'/'.($skin_dir).'/'.($folder);
		else if (is_dir(($child_dir).'/'.($folder)))
			$dir = ($return_url ? $child_url : $child_dir).'/'.($folder);
		else if (is_dir(($child_dir).(ANCORA_FW_DIR).($folder)))
			$dir = ($return_url ? $child_url : $child_dir).(ANCORA_FW_DIR).($folder);
		else if (!empty($skin_dir) && file_exists(($theme_dir).'/'.($skin_dir).'/'.($folder)))
			$dir = ($return_url ? $theme_url : $theme_dir).'/'.($skin_dir).'/'.($folder);
		else if (file_exists(($theme_dir).'/'.($folder)))
			$dir = ($return_url ? $theme_url : $theme_dir).'/'.($folder);
		else if (file_exists(($theme_dir).(ANCORA_FW_DIR).($folder)))
			$dir = ($return_url ? $theme_url : $theme_dir).(ANCORA_FW_DIR).($folder);
		return $dir;
	}
}

if (!function_exists('ancora_get_folder_url')) {
	function ancora_get_folder_url($folder) {
		return ancora_get_folder_dir($folder, true);
	}
}

// Detect skin version of the social icon (if exists), else return it from template images directory
if (!function_exists('ancora_get_socials_dir')) {
	function ancora_get_socials_dir($soc, $return_url=false) {
		return ancora_get_file_dir('images/socials/' . ancora_esc($soc) . (ancora_strpos($soc, '.')===false ? '.png' : ''), $return_url, true);
	}
}

if (!function_exists('ancora_get_socials_url')) {
	function ancora_get_socials_url($soc) {
		return ancora_get_socials_dir($soc, true);
	}
}

// Detect theme version of the template (if exists), else return it from fw templates directory
if (!function_exists('ancora_get_template_dir')) {
	function ancora_get_template_dir($tpl) {
		return ancora_get_file_dir('templates/' . ancora_esc($tpl) . (ancora_strpos($tpl, '.php')===false ? '.php' : ''));
	}
}
?>