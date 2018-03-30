<?php

/**
 * Function that checks if option has value from theme options.
 * It first checks global $qode_options variable and if option does'nt exists there
 * it checks default theme options
 *
 * @param $name string name of the option to retrieve
 * @return bool
 */
function qodef_option_has_value($name) {
	global $qode_options;
	global $qodeFramework;

	if (array_key_exists($name, $qodeFramework->qodeOptions->options)) {
		if(isset($qode_options[$name])) {
			return true;
		} else {
			return false;
		}
	} else {
		global $post;

		$value = get_post_meta( $post->ID, $name, true );

		if (isset($value) && $value !== "") {
			return true;
		} else {
			return false;
		}

	}
}

/**
 * Function that gets option by it's name.
 * It first checks if option exists in $qode_options global array and if it does'nt exists there
 * it checks default theme options array.
 *
 * @param $name string name of the option to retrieve
 * @return mixed|void
 */
function qodef_option_get_value($name) {
	global $qode_options;
	global $qodeFramework;

	if (array_key_exists($name, $qodeFramework->qodeOptions->options)) {
		if(isset($qode_options[$name])){
			return $qode_options[$name];
		} else {
			return $qodeFramework->qodeOptions->getOption($name);
		}
	} else {
		global $post;

		$value = get_post_meta( $post->ID, $name, true );
		if (isset($value) && $value !== "") {
			return $value;
		} else {
			return $qodeFramework->qodeMetaBoxes->getOption($name);
		}

	}
}

/**
 * Function that generates thumbnail filename based on original filename and given dimensions
 * @param $file string original filename
 * @param $w int width of thumbnail
 * @param $h int height of thumbnail
 * @return string generated thumbnail filename
 */
function qodef_generate_filename( $file, $w, $h ){
	$info         = pathinfo( $file );
	$dir = "";
	if(!empty($info['dirname'])){
		$dir          = $info['dirname'];	
	}
	$ext = "";
	$name = "";
	if(!empty($info['extension'])){
		$ext          = $info['extension'];
		$name         = wp_basename( $file, ".$ext" );
	}
	
	$suffix       = "{$w}x{$h}";

	if (qodef_url_exists("{$dir}/{$name}-{$suffix}.{$ext}"))
		return "{$dir}/{$name}-{$suffix}.{$ext}";
	else
		return $file;
}

/**
 * Function that checks if url exists
 * @param $url string url to check
 * @return bool
 */
function qodef_url_exists($url){
    $url = str_replace("http://", "", $url);
    if (strstr($url, "/")) {
        $url = explode("/", $url, 2);
        $url[1] = "/".$url[1];
    } else {
        $url = array($url, "/");
    }

    $fh = fsockopen($url[0], 80);
    if ($fh) {
        fputs($fh,"GET ".$url[1]." HTTP/1.1\nHost:".$url[0]."\n\n");
        if (fread($fh, 22) == "HTTP/1.1 404 Not Found") { return FALSE; }
        else { return TRUE;    }

    } else { return FALSE;}
}

/**
 * Function that gets attachment thumbnail url from attachment url
 * @param $attachment_url string url of the attachment
 * @return bool|string
 *
 * @see qode_get_attachment_id_from_url()
 */
function qodef_get_attachment_thumb_url($attachment_url) {
	$attachment_id = qode_get_attachment_id_from_url($attachment_url);

	if(!empty($attachment_id)) {
		return wp_get_attachment_thumb_url($attachment_id);
	} else {
		return $attachment_url;
	}
}

/**
 * Function that enqueue skin style. Wrapper around wp_enqueue_style function,
 * it prepends $src with skin path
 * @param $handle string unique key for style
 * @param $src string path inside skin folder
 * @param array $deps array of handles that style will depend on
 * @param bool|string $ver whether to add version string or not.
 * @param string $media media for which to add style. Defaults to 'all'
 *
 * @see wp_enqueue_style()
 */
function qode_enqueue_skin_style($handle, $src, $deps = array(), $ver = false, $media = 'all') {
	global $qodeFramework;

	$src = get_template_directory_uri().'/framework/admin/skins/'.$qodeFramework->getSkin().'/'.$src;
	wp_enqueue_style($handle, $src, $deps, $ver, $media);
}

/**
 * Function that registers skin style. Wrapper around wp_register_style function,
 * it prepends $src with skin path
 * @param $handle string unique key for style
 * @param $src string path inside skin folder
 * @param array $deps array of handles that style will depend on
 * @param bool|string $ver whether to add version string or not.
 * @param string $media media for which to add style. Defaults to 'all'
 *
 * @see wp_register_style()
 */
function qode_register_skin_style($handle, $src, $deps = array(), $ver = false, $media = 'all') {
	global $qodeFramework;

	$src = get_template_directory_uri().'/framework/admin/skins/'.$qodeFramework->getSkin().'/'.$src;
	wp_register_style($handle, $src, $deps = array(), $ver = false, $media = 'all');
}

/**
 * Function that enqueue skin script. Wrapper around wp_enqueue_script function,
 * it prepends $src with skin path
 * @param $handle string unique key for style
 * @param $src string path inside skin folder
 * @param array $deps array of handles that style will depend on
 * @param bool|string $ver whether to add version string or not.
 * @param bool $in_footer whether to include script in footer or not.
 *
 * @see wp_enqueue_script()
 */
function qode_enqueue_skin_script($handle, $src, $deps = array(), $ver = false, $in_footer = false) {
	global $qodeFramework;

	$src = get_template_directory_uri().'/framework/admin/skins/'.$qodeFramework->getSkin().'/'.$src;
	wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
}

/**
 * Function that registers skin script. Wrapper around wp_register_script function,
 * it prepends $src with skin path
 * @param $handle string unique key for style
 * @param $src string path inside skin folder
 * @param array $deps array of handles that style will depend on
 * @param bool|string $ver whether to add version string or not.
 * @param bool $in_footer whether to include script in footer or not.
 *
 * @see wp_register_script()
 */
function qode_register_skin_script($handle, $src, $deps = array(), $ver = false, $in_footer = false) {
	global $qodeFramework;

	$src = get_template_directory_uri().'/framework/admin/skins/'.$qodeFramework->getSkin().'/'.$src;
	wp_register_script($handle, $src, $deps, $ver, $in_footer);
}

if (!function_exists('qode_generate_dynamic_css_and_js')){
	/**
	 * Function that gets content of dynamic assets files and puts that in static ones
	 */
	function qode_generate_dynamic_css_and_js() {

		$qode_options = get_option('qode_options_brick');
		if(qode_is_css_folder_writable()) {
			$css_dir = get_template_directory().'/css/';

			ob_start();
			include_once($css_dir.'style_dynamic.php');
			$css = ob_get_clean();
			file_put_contents($css_dir.'style_dynamic.css', $css, LOCK_EX);

			ob_start();
			include_once($css_dir.'style_dynamic_responsive.php');
			$css = ob_get_clean();
			file_put_contents($css_dir.'style_dynamic_responsive.css', $css, LOCK_EX);

			ob_start();
			include_once($css_dir.'custom_css.php');
			$css = ob_get_clean();
			file_put_contents($css_dir.'custom_css.css', $css, LOCK_EX);
		}

		if(qode_is_js_folder_writable()) {
			$js_dir = get_template_directory().'/js/';

			ob_start();
			include_once($js_dir.'default_dynamic.php');
			$js = ob_get_clean();
			file_put_contents($js_dir.'default_dynamic.js', $js, LOCK_EX);

			ob_start();
			include_once($js_dir.'custom_js.php');
			$js = ob_get_clean();
			file_put_contents($js_dir.'custom_js.js', $js, LOCK_EX);
		}
	}

	if(!is_multisite()) {
		add_action('qode_after_theme_option_save', 'qode_generate_dynamic_css_and_js');
	}
}

if (!function_exists('qode_gallery_upload_get_images')) {
	/**
	 * Function that outputs single image html that is used in multiple image upload field
	 * Hooked to wp_ajax_qode_gallery_upload_get_images action
	 */
	function qode_gallery_upload_get_images(){
		$ids=$_POST['ids'];
		$ids=explode(",",$ids);
		foreach($ids as $id):
			$image = wp_get_attachment_image_src($id,'thumbnail', true);
			echo '<li class="qode-gallery-image-holder"><img src="'.esc_url($image[0]).'"/></li>';
		endforeach;
		exit;
	}

	add_action( 'wp_ajax_qode_gallery_upload_get_images', 'qode_gallery_upload_get_images');
}

if (!function_exists('qode_hex2rgb')) {
	/**
	 * Function that transforms hex color to rgb color
	 * @param $hex string original hex string
	 * @return array array containing three elements (r, g, b)
	 */
	function qode_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}
}

if(!function_exists('qode_addslashes')) {
	/**
	 * Function that checks if magic quotes are turned on (for older versions of php) and returns escaped string
	 * @param $str string string to be escaped
	 * @return string escaped string
	 */
	function qode_addslashes($str) {
		//is magic quotes turned off in php.ini?
		if(!get_magic_quotes_gpc()) {
			//apply addslashes
			$str = addslashes($str);
		}

		//return escaped string
		return $str;
	}
}

if(!function_exists('qode_get_attachment_meta')) {
	/**
	 * Function that returns attachment meta data from attachment id
	 * @param $attachment_id
	 * @param array $keys sub array of attachment meta
	 * @return array|mixed
	 */
	function qode_get_attachment_meta($attachment_id, $keys = array()) {
		$meta_data = array();

		//is attachment id set?
		if(!empty($attachment_id)) {
			//get all post meta for given attachment id
			$meta_data = get_post_meta($attachment_id, '_wp_attachment_metadata', true);

			//is subarray of meta array keys set?
			if(is_array($keys) && count($keys)) {
				$sub_array = array();

				//for each defined key
				foreach($keys as $key) {
					//check if that key exists in all meta array
					if(array_key_exists($key, $meta_data)) {
						//assign key from meta array for current key to meta subarray
						$sub_array[$key] = $meta_data[$key];
					}
				}

				//we want meta array to be subarray because that is what used whants to get
				$meta_data = $sub_array;
			}
		}

		//return meta array
		return $meta_data;
	}
}

if(!function_exists('qode_get_attachment_id_from_url')) {
	/**
	 * Function that retrieves attachment id for passed attachment url
	 * @param $attachment_url
	 * @return null|string
	 */
	function qode_get_attachment_id_from_url($attachment_url) {
		global $wpdb;
		$attachment_id = '';

		//is attachment url set?
		if($attachment_url !== '') {
			//prepare query

			$query = $wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid=%s", $attachment_url);

			//get attachment id
			$attachment_id = $wpdb->get_var($query);
		}

		//return id
		return $attachment_id;
	}
}

if(!function_exists('qode_get_attachment_meta_from_url')) {
	/**
	 * Function that returns meta array for give attachment url
	 * @param $attachment_url
	 * @param array $keys sub array of attachment meta
	 * @return array|mixed
	 *
	 * @see qode_get_attachment_id_from_url()
	 * @see qode_get_attachment_meta()
	 *
	 * @version 0.1
	 */
	function qode_get_attachment_meta_from_url($attachment_url, $keys = array()) {
		$attachment_meta = array();

		//get attachment id for attachment url
		$attachment_id 	= qode_get_attachment_id_from_url($attachment_url);

		//is attachment id set?
		if(!empty($attachment_id)) {
			//get post meta
			$attachment_meta = qode_get_attachment_meta($attachment_id, $keys);
		}

		//return post meta
		return $attachment_meta;
	}
}

if(!function_exists('qode_get_image_dimensions')) {
	/**
	 * Function that returns image sizes array. First looks in post_meta table if attachment exists in the database,
	 * if it doesn't than it uses getimagesize PHP function to get image sizes
	 * @param $url string url of the image
	 * @return array array of image sizes that containes height and width
	 *
	 * @see qode_get_attachment_meta_from_url()
	 * @uses getimagesize
	 *
	 * @version 0.1
	 */
	function qode_get_image_dimensions($url) {
		$image_sizes = array();

		//is url passed?
		if($url !== '') {
			//get image sizes from posts meta if attachment exists
			$image_sizes = qode_get_attachment_meta_from_url($url, array('width', 'height'));

			//image does not exists in post table, we have to use PHP way of getting image size
			if(!count($image_sizes)) {
				//can we open file by url?
				if(ini_get('allow_url_fopen') == 1 && file_exists($url)) {
					list($width, $height, $type, $attr) = getimagesize($url);
				} else {
					//we can't open file directly, have to locate it with relative path.
					$image_obj = parse_url($url);
					$image_relative_path = $_SERVER['DOCUMENT_ROOT'].$image_obj['path'];

					if(file_exists($image_relative_path)) {
						list($width, $height, $type, $attr) = getimagesize($image_relative_path);
					}
				}

				//did we get width and height from some of above methods?
				if(isset($width) && isset($height)) {
					//set them to our image sizes array
					$image_sizes = array(
						'width' => $width,
						'height' => $height
					);
				}
			}
		}

		return $image_sizes;
	}
}

if(!function_exists('qode_get_native_fonts_list')) {
	/**
	 * Function that returns array of native fonts
	 * @return array
	 */
	function qode_get_native_fonts_list(){

		return array(
			'Arial',
			'Arial Black',
			'Comic Sans MS',
			'Courier New',
			'Georgia',
			'Impact',
			'Lucida Console',
			'Lucida Sans Unicode',
			'Palatino Linotype',
			'Tahoma',
			'Times New Roman',
			'Trebuchet MS',
			'Verdana');

	}
}

if(!function_exists('qode_get_native_fonts_array')) {
	/**
	 * Function that returns formatted array of native fonts
	 *
	 * @uses qode_get_native_fonts_list()
	 * @return array
	 */
	function qode_get_native_fonts_array(){
		$native_fonts_list = qode_get_native_fonts_list();
		$native_font_index = 0;
		$native_fonts_array = array();

		foreach($native_fonts_list as $native_font){
			$native_fonts_array[$native_font_index] = array('family' => $native_font);
			$native_font_index++;
		}

		return $native_fonts_array;
	}
}

if(!function_exists('qode_is_native_font')) {
	/**
	 * Function that checks if given font is native font
	 * @param $font_family string
	 * @return bool
	 */
	function qode_is_native_font($font_family) {
		return  in_array(str_replace('+', ' ', $font_family), qode_get_native_fonts_list());
	}
}


if(!function_exists('qode_merge_fonts')) {
	/**
	 * Function that merge google and native fonts
	 *
	 * @uses qode_get_native_fonts_array()
	 * @return array
	 */
	function qode_merge_fonts() {
		global $qode_fonts_array;
		$native_fonts = qode_get_native_fonts_array();

		if(is_array($native_fonts) && count($native_fonts)){
			$qode_fonts_array = array_merge($native_fonts, $qode_fonts_array);
		}
	}

	add_action('admin_init', 'qode_merge_fonts');
}

if(!function_exists('qode_is_css_folder_writable')) {
	/**
	 * Function that checks if css folder is writable
	 * @return bool
	 *
	 * @version 0.1
	 * @uses is_writable()
	 */
	function qode_is_css_folder_writable() {
		$css_dir = get_template_directory().'/css';

		return is_writable($css_dir);
	}
}

if(!function_exists('qode_is_js_folder_writable')) {
	/**
	 * Function that checks if js folder is writable
	 * @return bool
	 *
	 * @version 0.1
	 * @uses is_writable()
	 */
	function qode_is_js_folder_writable() {
		$js_dir = get_template_directory().'/js';

		return is_writable($js_dir);
	}
}

if(!function_exists('qode_assets_folders_writable')) {
	/**
	 * Function that if css and js folders are writable
	 * @return bool
	 *
	 * @version 0.1
	 * @see qode_is_css_folder_writable()
	 * @see qode_is_js_folder_writable()
	 */
	function qode_assets_folders_writable() {
		return qode_is_css_folder_writable() && qode_is_js_folder_writable();
	}
}

if(!function_exists('qode_writable_assets_folders_notice')) {
	/**
	 * Function that prints notice that css and js folders aren't writable. Hooks to admin_notices action
	 *
	 * @version 0.1
	 * @link http://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
	 */
	function qode_writable_assets_folders_notice() {
		global $pagenow;

		$is_theme_options_page = isset($_GET['page']) && strstr($_GET['page'], 'qode_theme_menu');

		if($pagenow === 'admin.php' && $is_theme_options_page) {
			if(!qode_assets_folders_writable()) { ?>
				<div class="error">
					<p><?php _e('Note that writing permissions aren\'t set for folders containing css and js files on your server.
					We recommend setting writing permissions in order to optimize your site performance.
					For further instructions, please refer to our documentation.', 'qode'); ?></p>
				</div>
			<?php }
		}
	}

	add_action('admin_notices', 'qode_writable_assets_folders_notice');
}

if(!function_exists('qode_inline_style')) {
	/**
	 * Function that echoes generated style attribute
	 * @param $value string | array attribute value
	 *
	 * @see qode_get_inline_style()
	 */
	function qode_inline_style($value) {
		echo qode_get_inline_style($value);
	}
}

if(!function_exists('qode_get_inline_style')) {
	/**
	 * Function that generates style attribute and returns generated string
	 * @param $value string | array value of style attribute
	 * @return string generated style attribute
	 *
	 * @see qode_get_inline_style()
	 */
	function qode_get_inline_style($value) {
		return qode_get_inline_attr($value, 'style', ';');
	}
}

if(!function_exists('qode_class_attribute')) {
	/**
	 * Function that echoes class attribute
	 * @param $value string value of class attribute
	 *
	 * @see qode_get_class_attribute()
	 */
	function qode_class_attribute($value) {
		echo qode_get_class_attribute($value);
	}
}

if(!function_exists('qode_get_class_attribute')) {
	/**
	 * Function that returns generated class attribute
	 * @param $value string value of class attribute
	 * @return string generated class attribute
	 *
	 * @see qode_get_inline_attr()
	 */
	function qode_get_class_attribute($value) {
		return qode_get_inline_attr($value, 'class');
	}
}

if(!function_exists('qode_get_inline_attr')) {
	/**
	 * Function that generates html attribute
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 * @return string generated html attribute
	 */
	function qode_get_inline_attr($value, $attr, $glue = '') {
		if(!empty($value)) {

			if(is_array($value) && count($value)) {
				$properties = implode($glue, $value);
			} elseif($value !== '') {
				$properties = $value;
			}

			return $attr.'="'.esc_attr($properties).'"';
		}

		return '';
	}
}

if(!function_exists('qode_get_skin_uri')) {
    /**
     * Returns current skin URI
     * @return mixed
     */
    function qode_get_skin_uri() {
		global $qodeFramework;

		$current_skin = $qodeFramework->getSkin();

		return $current_skin->getSkinURI();
	}
}

if(!function_exists('qode_core_installed')) {
    /**
     * Checks if core plugin is installed
     * @return bool
     */
    function qode_core_installed() {
        return defined('QODE_CORE_VERSION');
    }
}

if(!function_exists('qode_core_plugin_message')) {
    /**
     * Function that prints a mesasge in the admin if user hides TGMPA plugin activation message
     */
    function qode_core_plugin_message() {
        if(get_user_meta(get_current_user_id(), 'tgmpa_dismissed_notice', true) && !qode_core_installed()) {
            echo apply_filters('qode_core_plugin_message', '<div class="update-nag">'.__('Installation of the "Qode
            Core" plugin is
            essential for
            proper
            theme functioning. Please <a href="'.admin_url('themes.php?page=install-required-plugins')
                    .'">install</a> this
            plugin and activate it', 'qode').'</div>');
        }
    }

    add_action('admin_notices', 'qode_core_plugin_message');
}
