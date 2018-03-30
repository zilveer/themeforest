<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Cardealer_Watermark {

	public static $watermark_positions = array();

	public static function register() {
		self::$watermark_positions = array(
			'left_top' => __("Left top", 'cardealer'),
			'right_top' => __("Right top", 'cardealer'),
			'left_bottom' => __("Left bottom", 'cardealer'),
			'right_bottom' => __("Right bottom", 'cardealer'),
			'center_middle' => __("Center", 'cardealer'),
			'center_top' => __("Center top", 'cardealer'),
			'center_bottom' => __("Center bottom", 'cardealer'),
		);
	}

	public static function get_watermark_image_path() {
		if (isset($_POST['watermark_src'])) {
			$watermark_img_url = $_POST['watermark_src'];
		} else {
			$watermark_img_url = TMM::get_option('watermark_image', TMM_APP_CARDEALER_PREFIX);
		}

		if (empty($watermark_img_url)) {
			return TMM_Ext_Car_Dealer::get_application_path() . '/images/default_watermark.png';
		}

		$parse_uri = explode('wp-content/uploads', $watermark_img_url);
		$img_path_part = $parse_uri[1];

		$path = wp_upload_dir();
		$watermark_img_url = $path['basedir'] . $img_path_part;

		if (!file_exists($watermark_img_url)) {
			return TMM_Ext_Car_Dealer::get_application_path() . '/images/default_watermark.png';
		}

		return $watermark_img_url;
	}

	public function create_tmp_watermark_image($main_image_size/* w+h */, $watermark_size_percent = 0) {
		$watermark = self::get_watermark_image_path();

		$file_info = pathinfo($watermark);

		if($file_info['extension'] === 'jpg'){
			$ext = '.jpg';
		}else if($file_info['extension'] === 'png'){
			$ext = '.png';
		}else{
			return false;
		}

		@mkdir(TMM_Ext_PostType_Car::get_image_upload_folder() . 'tmp_watermark/', 0755);
		$watermark_tmp_path = TMM_Ext_PostType_Car::get_image_upload_folder() . 'tmp_watermark/' . uniqid() . $ext;

		if (!file_exists($watermark)) {
			return false;
		}

		copy($watermark, $watermark_tmp_path);

		if ($watermark_size_percent == 0) {
			$watermark_size_percent = (float) (TMM::get_option('watermark_size_percent', TMM_APP_CARDEALER_PREFIX) / 100);
		}else{
			$watermark_size_percent = (float) ($watermark_size_percent / 100);
		}

		TMM_Helper::tmm_resize_image($watermark_tmp_path, $main_image_size[0] * $watermark_size_percent, $main_image_size[1] * $watermark_size_percent, FALSE, null, null, 100, false, false);

		return $watermark_tmp_path;
	}

	# given two images, return a blended watermarked image

	public function place_watermark($targetFile, $alpha_level = 100, $watermark_position = array(), $watermark_size_percent = 0) {

		$tmp_watermark = $this->create_tmp_watermark_image(getimagesize($targetFile), $watermark_size_percent);

		if (empty($tmp_watermark) OR !file_exists($tmp_watermark)) {
			return false;
		}

		$file_info = pathinfo($targetFile);

		if($file_info['extension'] === 'jpg'){
			$main_img_obj = imagecreatefromjpeg($targetFile);
		}else if($file_info['extension'] === 'png'){
			$main_img_obj = imagecreatefrompng($targetFile);
		}else{
			return false;
		}

		$tmp_file_info = pathinfo($tmp_watermark);

		if($tmp_file_info['extension'] === 'jpg'){
			$watermark_img_obj = imagecreatefromjpeg($tmp_watermark);
		}else if($tmp_file_info['extension'] === 'png'){
			$watermark_img_obj = imagecreatefrompng($tmp_watermark);
		}else{
			return false;
		}

		$alpha_level /= 100; # convert 0-100 (%) alpha to decimal
		# calculate our images dimensions
		$main_img_obj_w = imagesx($main_img_obj);
		$main_img_obj_h = imagesy($main_img_obj);
		$watermark_img_obj_w = imagesx($watermark_img_obj);
		$watermark_img_obj_h = imagesy($watermark_img_obj);

		/* determine center position coordinates */
		$main_img_obj_min_x = 0;
		$main_img_obj_max_x = 0;
		$main_img_obj_min_y = 0;
		$main_img_obj_max_y = 0;


		//$img_folder
		if (empty($watermark_position)) {
			$watermark_position = TMM::get_option('watermark_position', TMM_APP_CARDEALER_PREFIX);
		}

		switch ($watermark_position) {
			case 'left_top':
				$main_img_obj_min_x = 0;
				$main_img_obj_max_x = $watermark_img_obj_w;
				$main_img_obj_min_y = 0;
				$main_img_obj_max_y = $watermark_img_obj_h;
				break;
			case 'right_top':
				$main_img_obj_min_x = $main_img_obj_w - $watermark_img_obj_w;
				$main_img_obj_max_x = $main_img_obj_w;
				$main_img_obj_min_y = 0;
				$main_img_obj_max_y = $watermark_img_obj_h;
				break;
			case 'left_bottom':
				$main_img_obj_min_x = 0;
				$main_img_obj_max_x = $watermark_img_obj_w;
				$main_img_obj_min_y = $main_img_obj_h - $watermark_img_obj_h;
				$main_img_obj_max_y = $main_img_obj_h;
				break;
			case 'right_bottom':
				$main_img_obj_min_x = $main_img_obj_w - $watermark_img_obj_w;
				$main_img_obj_max_x = $main_img_obj_w;
				$main_img_obj_min_y = $main_img_obj_h - $watermark_img_obj_h;
				$main_img_obj_max_y = $main_img_obj_h;
				break;
			case 'center_top':
				$main_img_obj_min_x = floor(( $main_img_obj_w / 2 ) - ( $watermark_img_obj_w / 2 ));
				$main_img_obj_max_x = ceil(( $main_img_obj_w / 2 ) + ( $watermark_img_obj_w / 2 ));
				$main_img_obj_min_y = 0;
				$main_img_obj_max_y = $watermark_img_obj_h;
				break;
			case 'center_bottom':
				$main_img_obj_min_x = floor(( $main_img_obj_w / 2 ) - ( $watermark_img_obj_w / 2 ));
				$main_img_obj_max_x = ceil(( $main_img_obj_w / 2 ) + ( $watermark_img_obj_w / 2 ));
				$main_img_obj_min_y = $main_img_obj_h - $watermark_img_obj_h;
				$main_img_obj_max_y = $main_img_obj_h;
				break;
			default:
				$main_img_obj_min_x = floor(( $main_img_obj_w / 2 ) - ( $watermark_img_obj_w / 2 ));
				$main_img_obj_max_x = ceil(( $main_img_obj_w / 2 ) + ( $watermark_img_obj_w / 2 ));
				$main_img_obj_min_y = floor(( $main_img_obj_h / 2 ) - ( $watermark_img_obj_h / 2 ));
				$main_img_obj_max_y = ceil(( $main_img_obj_h / 2 ) + ( $watermark_img_obj_h / 2 ));
				break;
		}

		# create new image to hold merged changes
		$return_img = imagecreatetruecolor($main_img_obj_w, $main_img_obj_h);

		# walk through main image
		for ($y = 0; $y < $main_img_obj_h; $y++) {
			for ($x = 0; $x < $main_img_obj_w; $x++) {
				$return_color = NULL;

				# determine the correct pixel location within our watermark
				$watermark_x = $x - $main_img_obj_min_x;
				$watermark_y = $y - $main_img_obj_min_y;

				# fetch color information for both of our images
				$main_rgb = imagecolorsforindex($main_img_obj, imagecolorat($main_img_obj, $x, $y));

				# if our watermark has a non-transparent value at this pixel intersection
				# and we're still within the bounds of the watermark image
				if ($watermark_x >= 0 && $watermark_x < $watermark_img_obj_w &&
					$watermark_y >= 0 && $watermark_y < $watermark_img_obj_h) {
					$watermark_rbg = imagecolorsforindex($watermark_img_obj, imagecolorat($watermark_img_obj, $watermark_x, $watermark_y));

					# using image alpha, and user specified alpha, calculate average
					$watermark_alpha = round(( ( 127 - $watermark_rbg['alpha'] ) / 127), 2);
					$watermark_alpha = $watermark_alpha * $alpha_level;

					# calculate the color 'average' between the two - taking into account the specified alpha level
					$avg_red = $this->_get_ave_color($main_rgb['red'], $watermark_rbg['red'], $watermark_alpha);
					$avg_green = $this->_get_ave_color($main_rgb['green'], $watermark_rbg['green'], $watermark_alpha);
					$avg_blue = $this->_get_ave_color($main_rgb['blue'], $watermark_rbg['blue'], $watermark_alpha);

					# calculate a color index value using the average RGB values we've determined
					$return_color = $this->_get_image_color($return_img, $avg_red, $avg_green, $avg_blue);

					# if we're not dealing with an average color here, then let's just copy over the main color
				} else {
					$return_color = imagecolorat($main_img_obj, $x, $y);
				} # END if watermark
				# draw the appropriate color onto the return image
				imagesetpixel($return_img, $x, $y, $return_color);
			} # END for each X pixel
		} # END for each Y pixel
		# return the resulting, watermarked image for display

		if($file_info['extension'] === 'jpg'){
			imagejpeg($return_img, $targetFile);
		}else if($file_info['extension'] === 'png'){
			imagepng($return_img, $targetFile);
		}

		unlink($tmp_watermark);
		return $return_img;
	}

	# average two colors given an alpha

	private function _get_ave_color($color_a, $color_b, $alpha_level) {
		return round(( ( $color_a * ( 1 - $alpha_level ) ) + ( $color_b * $alpha_level )));
	}

	# return closest pallette-color match for RGB values

	private function _get_image_color($im, $r, $g, $b) {
		$c = imagecolorexact($im, $r, $g, $b);
		if ($c != -1)
			return $c;
		$c = imagecolorallocate($im, $r, $g, $b);
		if ($c != -1)
			return $c;
		return imagecolorclosest($im, $r, $g, $b);
	}

	public function add_watermark_to_cars_images() {
		$folders = TMM_Ext_PostType_Car::$image_sizes;
		$user_ID = get_current_user_id();
		$user_folder = TMM_Ext_PostType_Car::get_image_upload_folder() . $user_ID;
		$user_posts_folders = scandir($user_folder);
		$allowed_file_types = array('png');
		$alpha_level = TMM::get_option('alpha_level', TMM_APP_CARDEALER_PREFIX);

		if (!$alpha_level) {
			$alpha_level = 70;
		}

		$watermark= new TMM_Cardealer_Watermark();

		foreach($user_posts_folders as $post_folder){
			if(is_dir($user_folder.'/'.$post_folder)){

				foreach ($folders as $folder_key => $folder) {
					if (is_dir($user_folder.'/'.$post_folder . '/' . $folder_key)) {
						$current_folder = $user_folder.'/'.$post_folder . '/' . $folder_key;
						$files = scandir($current_folder);

						foreach ($files as $image_name) {
							$file_info = pathinfo($current_folder.'/'.$image_name);
							if (in_array(strtolower($file_info['extension']), $allowed_file_types) && TMM::get_option('watermark_on_image', TMM_APP_CARDEALER_PREFIX)) {
								print($file_info['extension']);
								@$watermark->place_watermark($current_folder.'/'.$image_name, $alpha_level);
							}

						}

					}
				}

			}
		}

	}

}

