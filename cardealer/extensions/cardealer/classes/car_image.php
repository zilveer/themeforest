<?php
/**
 * Allows upload and remove cars images
 */

class TMM_Car_Image {

	public static function get_car_image_upload_template($args) {
		self::enqueue_scripts();
		extract($args);
		include TMM_EXT_PATH . '/cardealer/js/jquery-file-upload/cars_upload.php';
	}

	public static function get_cardealer_logo_upload_template() {
		self::enqueue_scripts();
		include TMM_EXT_PATH . '/cardealer/js/jquery-file-upload/dealer_logo.php';
	}

	public static function upload_cardealer_logo() {
		include TMM_EXT_PATH . '/cardealer/js/jquery-file-upload/server/dealer_logo.php';
		exit;
	}

	public static function upload_car_image() {
		include TMM_EXT_PATH . '/cardealer/js/jquery-file-upload/server/cars_upload.php';
		exit;
	}

	public static function enqueue_scripts() {
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-widget');
		wp_enqueue_script('jquery-ui-button');
		wp_enqueue_script('jquery-ui-progressbar');
		/* The Templates plugin is included to render the upload/download listings */
		wp_enqueue_script('tmm_fileupload_tmpl', TMM_EXT_URI . '/cardealer/js/jquery-file-upload/js/tmpl.min.js', array('jquery'), false, 1);
		/* The Load Image plugin is included for the preview images and image resizing functionality */
		wp_enqueue_script('tmm_fileupload_load_image', TMM_EXT_URI . '/cardealer/js/jquery-file-upload/js/load-image.all.min.js', array('jquery'), false, 1);
		/* The Canvas to Blob plugin is included for image resizing functionality */
		wp_enqueue_script('tmm_fileupload_canvas', TMM_EXT_URI . '/cardealer/js/jquery-file-upload/js/canvas-to-blob.min.js', array('jquery'), false, 1);
		/* The Iframe Transport is required for browsers without support for XHR file uploads */
		wp_enqueue_script('tmm_fileupload_iframe_transport', TMM_EXT_URI . '/cardealer/js/jquery-file-upload/js/jquery.iframe-transport.js', array('jquery'), false, 1);
		/* The basic File Upload plugin */
		wp_enqueue_script('tmm_fileupload', TMM_EXT_URI . '/cardealer/js/jquery-file-upload/js/jquery.fileupload.js', array('jquery'), false, 1);
		/* The File Upload processing plugin */
		wp_enqueue_script('tmm_fileupload_process_js', TMM_EXT_URI . '/cardealer/js/jquery-file-upload/js/jquery.fileupload-process.js', array('jquery'), false, 1);
		/* The File Upload image preview & resize plugin */
		wp_enqueue_script('tmm_fileupload_image', TMM_EXT_URI . '/cardealer/js/jquery-file-upload/js/jquery.fileupload-image.js', array('jquery'), false, 1);
		/* The File Upload validation plugin */
		wp_enqueue_script('tmm_fileupload_validate', TMM_EXT_URI . '/cardealer/js/jquery-file-upload/js/jquery.fileupload-validate.js', array('jquery'), false, 1);
		/* The File Upload user interface plugin */
		wp_enqueue_script('tmm_fileupload_ui', TMM_EXT_URI . '/cardealer/js/jquery-file-upload/js/jquery.fileupload-ui.js', array('jquery'), false, 1);
		wp_enqueue_script('tmm_fileupload_jquery_ui', TMM_EXT_URI . '/cardealer/js/jquery-file-upload/js/jquery.fileupload-jquery-ui.js', array('jquery'), false, 1);
	}

	/**
	 * Set cover image
	 *
	 * @param mixed $post_id
	 * @param mixed $image_name
	 */
	public static function set_cover_image($post_id = false, $image_name = false) {

		if($post_id == false){
			$post_id = (int) $_REQUEST['post_id'];
		}

		if($image_name == false){
			$image_name = $_REQUEST['image_name'];
		}

		if (!$post_id || !$image_name) {
			return;
		}

		$post_id = apply_filters('tmm_wpml_original_postid', $post_id);

		update_post_meta($post_id, "car_cover_image", $image_name);

		//if ajax
		if($post_id === false){
			ob_clean();
			exit;
		}
	}

	/**
	 * Retrieve cover image of post
	 *
	 * @param $post_id
	 * @param string $folder
	 * @param bool $sidebar
	 *
	 * @return string
	 */
	public static function get_cover_image($post_id, $folder = 'main', $sidebar = true) {

		$post_id = apply_filters('tmm_wpml_original_postid', $post_id);
		$user_id = get_post_field('post_author', $post_id);
		$cover_image = get_post_meta($post_id, 'car_cover_image', true);
		$post_images_dir = TMM_Ext_PostType_Car::get_image_upload_folder() . $user_id . '/' . $post_id . '/';
		$images_dir = $post_images_dir . $folder . '/';

		/* $placeholder image */
		if ($folder == 'homeslide') {
			if (TMM::get_option('show_slider_as', TMM_APP_CARDEALER_PREFIX) == 0) {
				$placeholder_img = TMM_Ext_Car_Dealer::get_application_uri() . '/images/no-image-1130x420.png';
			} else {
				$placeholder_img = TMM_Ext_Car_Dealer::get_application_uri() . '/images/no-image-740x420.png';
			}
		} else if ($folder == 'main') {
			$placeholder_img = TMM_Ext_Car_Dealer::get_application_uri() . '/images/no-image-1130x420.png';
		} else if ($folder == 'thumb') {
			$placeholder_img = TMM_Ext_Car_Dealer::get_application_uri() . '/images/no-image-460x290.png';
		} else if ($folder == 'single_thumb_widget') {
			$placeholder_img = TMM_Ext_Car_Dealer::get_application_uri() . '/images/no-image-80x70.png';
		} else if ($folder == 'single') {
			$placeholder_img = TMM_Ext_Car_Dealer::get_application_uri() . '/images/no-image-710x530.png';
		} else {
			$placeholder_img = TMM_Ext_Car_Dealer::get_application_uri() . '/images/no-image-460x290.png';
		}

		/* retrieve cover image if not exists  */
		if (empty($cover_image) || !file_exists($images_dir.$cover_image)) {

			$images = TMM_Ext_PostType_Car::get_post_photos($post_id, $user_id, 'main');

			if (is_array($images) && !empty($images)) {
				$cover_image = basename($images[0]);
				self::set_cover_image($post_id, $cover_image);
			}

			if ( empty($cover_image) || !file_exists($images_dir.$cover_image) ) {
				return $placeholder_img;
			}

		}

		$img_path = $images_dir . $cover_image;

		/* check image size */
		$current_size = @getimagesize($img_path);

		if (!empty($current_size)) {

			if ($folder == 'homeslide') {
				$thumb_size = TMM_Ext_PostType_Car::slider_image_size($sidebar);
			} else {
				$thumb_size = TMM_Ext_PostType_Car::$image_sizes[$folder];
			}

			if ($current_size[0] != $thumb_size['width'] || $current_size[1] != $thumb_size['height']) {

				if (file_exists($post_images_dir . 'main/' . $cover_image)) {
					copy($post_images_dir . 'main/' . $cover_image, $img_path);
					TMM_Helper::tmm_resize_image($img_path, $thumb_size['width'], $thumb_size['height'], true, null, null, 100);
				} else {
					return $placeholder_img;
				}

			}
		}

		/* get cover image url */
		$img_url = TMM_Ext_PostType_Car::get_image_upload_folder_uri() . $user_id . '/' . $post_id . '/' . $folder . '/' . $cover_image;

		return $img_url;

	}

}