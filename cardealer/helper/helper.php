<?php

class TMM_Helper {

	public static function login_check() {
		$login = $_REQUEST['login'];
		$pass = $_REQUEST['pass'];
		$user = get_user_by('login', $login);
		$result = 0;

		if(!empty($login) && !empty($pass)){
			if(!$user){
				$result = -1;
			}else if(!wp_check_password( $pass, $user->data->user_pass, $user->ID)){
				$result = -2;
			}else{
				$result = 1;
			}
		}
		ob_clean();
		echo $result;
		wp_die();
	}

	public static function get_permalink_by_lang($page_id, $params = array(), $rewrite = false) {

		if($page_id && defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != ''){
			$page_id = icl_object_id( $page_id, 'page', true, ICL_LANGUAGE_CODE );
		}

		$url = get_permalink($page_id);

		if (!$url) {
			return get_permalink();
		}

		if ($rewrite && get_option('permalink_structure')) {

			if ( strpos($url, '?') !== false ) {
				$query_string = '?' . parse_url( $url, PHP_URL_QUERY );
				$url    = current( explode( '?', $url ) );
			} else {
				$query_string = '';
			}

			$url = trailingslashit($url);

			if(is_array($params) && !empty($params)){

				foreach ($params as $key => $value){

					$url .= $key.'/';

					if ($value) {
						$url .= $value.'/';
					}

				}
			}

			$url = trailingslashit($url) . $query_string;

		}else{

			$url = add_query_arg( $params, $url );

		}

		return $url;
	}

	public static function is_front_lang_page() {
		$is_front_lang_page = false;
		if(is_page() && defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != ''){
			global $sitepress;
			$front_page_id = (int) get_option('page_on_front');
			$default_lang_page_id = (int) icl_object_id(get_the_ID(), 'page', true, $sitepress->get_default_language() );
			if($front_page_id === $default_lang_page_id){
				$is_front_lang_page = true;
			}
		}
		return $is_front_lang_page;
	}

	public static function get_filtered_user_cars($user_id, $filter, $return_query) {

		$args = array();
		$args['post_type'] = TMM_Ext_PostType_Car::$slug;
		$args['post_status'] = array('publish', 'draft');
		$args['author'] = $user_id;
		$args['post_count'] = -1;
		$args['posts_per_page'] = -1;

		switch ($filter) {
			case 'featured':
				$args['meta_query'] = array(
					array(
						'key' => 'car_is_featured',
						'value' => '1',
						'compare' => 'LIKE'
					));
				break;
			case 'sold':
				$args['meta_query'] = array(
					array(
						'key' => 'car_is_sold',
						'value' => '1',
						'compare' => 'LIKE'
					));
				break;
			case 'draft':
				$args['post_status'] = array('draft');
				break;
			case 'damaged':
				$args['meta_query'] = array(
					array(
						'key' => 'car_is_damaged',
						'value' => '1',
						'compare' => 'LIKE'
					));
				break;
			case 'new':
				$args['meta_query'] = array(
					array(
						'key' => 'car_is_new',
						'value' => '1',
						'compare' => 'LIKE'
					));
				break;
			case 'used':
				$args['meta_query'] = array(
					array(
						'key' => 'used_car',
						'value' => '1',
						'compare' => 'LIKE'
					),
				);
				break;
		}

		if(!defined('ICL_LANGUAGE_CODE')){
			$wpml_meta_query = array(
				'key' => '_icl_lang_duplicate_of',
				'value' => '',
				'compare' => 'NOT EXISTS'
			);
			$args['meta_query'][] = $wpml_meta_query;
		}

		$query = new WP_Query($args);

		if ($return_query == true) {
			$return = $query->posts;
		} else {
			$return = $query->found_posts;
		}

		wp_reset_postdata();

		return $return;
	}

	public static function filtered_cars() {
		$user_id = isset($_REQUEST['user']) ? $_REQUEST['user'] : '';
		$params = isset($_REQUEST['params']) ? $_REQUEST['params'] : '';
		$current = isset($_REQUEST['page']) ? (int) $_REQUEST['page'] : 0;
		$post_per_page = isset($_REQUEST['posts_per_page']) ? (int) $_REQUEST['posts_per_page'] : 10;
		$selected_posts = array();
		if (!empty($params)) {

			$type = 'all';

			foreach ($params as $param) {
				switch ($param) {
					case 'filt_all_cars':
						$type = 'all';
						break;
					case 'filt_featured_cars':
						$type = 'featured';
						break;
					case 'filt_sold_cars':
						$type = 'sold';
						break;
					case 'filt_draft_cars':
						$type = 'draft';
						break;
					case 'filt_damaged_cars':
						$type = 'damaged';
						break;
					case 'filt_new_cars':
						$type = 'new';
						break;
					case 'filt_used_cars':
						$type = 'used';
						break;
				}

				$filt_posts = TMM_Helper::get_filtered_user_cars($user_id, $type, true);

				foreach ($filt_posts as $key => $filt_post) {
					$filt_id = $filt_post->ID;
					if (count($selected_posts) != 0) {
						for ($i = 0; $i <= count($selected_posts); $i++) {
							if (!empty($selected_posts[$i])) {
								if ($selected_posts[$i]->ID == $filt_id) {
									unset($filt_posts[$key]);
								}
							}
						}
					}
				}

				$selected_posts = array_merge($selected_posts, $filt_posts);
			}

			$count_posts = count($selected_posts);
			$pages = ($count_posts / $post_per_page);
			$pages = ceil($pages);
			$response['pages'] = $pages;
			$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
			$a['total'] = $pages;
			$a['current'] = $current;

			$total = 1; //1 - display the text "Page N of N", 0 - not display
			$a['mid_size'] = 5; //how many links to show on the left and right of the current
			$a['end_size'] = 1; //how many links to show in the beginning and end
			$a['prev_text'] = ''; //text of the "Previous page" link
			$a['next_text'] = ''; //text of the "Next page" link

			ob_start();
			echo '' . paginate_links($a);
			$response['pagination'] = ob_get_contents();
			ob_end_clean();

			$response['items'] = '';

			for ($i = $post_per_page * ($current - 1); $i < $post_per_page * $current; $i++) {

				if (!empty($selected_posts[$i])) {
					$post = $selected_posts[$i];
					if($post->ID){
						ob_start();
						$GLOBALS['is_user_cars_page'] = !empty($_POST['template_user']) && $_POST['template_user'] == 'template_user_cars';
						$GLOBALS['post_id'] = $post->ID;
						get_template_part( 'article', 'car' );
						$response['items'] .= ob_get_clean();
					}
				}

			}

			echo json_encode($response);
		}

		exit;
	}

	public static function get_post_featured_image($post_id, $alias, $show_cap = true) {
		$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'single-post-thumbnail');
		if($img_src && isset($img_src[0])){
			$img_src = $img_src[0];
		}else{
			$img_src = '';
		}
		$url = self::get_image($img_src, $alias);
		return $url;
	}

	public static function resize_image($img_src, $alias, $show_cap = true) {
		return self::get_image($img_src, $alias);
	}

//IMAGES start *********************************************************

	public static function get_image($img_src, $alias, $show_cap = true) {

		if (empty($alias)) {
			return $img_src;
		}

		$al = explode('*', $alias);
		$new_img_src = aq_resize($img_src, $al[0], $al[1], true);

		if (!$new_img_src) {
			if ($show_cap) {
				return 'http://placehold.it/' . $al[0] . 'x' . $al[1] . '&amp;text=NO IMAGE';
			}
		}

		return $new_img_src;
	}

	/*     * *
	 * Get the directory size
	 * @param directory $directory
	 * @return integer
	 */

	public static function get_dir_size($directory) {
		$size = 0;
		foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file) {
			$size+=$file->getSize();
		}
		return $size;
	}

//Custom page navigation
	public static function pagenavi() {
		$a = array();
        //$a['base'] = esc_url_raw( str_replace(999999999, '%#%', get_pagenum_link(999999999)) );
		$a['mid_size'] = 5; //how many links to show on the left and right of the current
		$a['end_size'] = 1; //how many links to show in the beginning and end
		$a['prev_text'] = ''; //text of the "Previous page" link
		$a['next_text'] = ''; //text of the "Next page" link

		$result = paginate_links($a);
		//$result = str_replace( '/page/1/', '', $result );
		echo $result;
	}

	public function add_comment() {
		if (!empty($_REQUEST['comment_content'])) {
			$time = current_time('mysql');
			$user = get_userdata(get_current_user_id());
			$data = array(
				'comment_post_ID' => $_REQUEST['comment_post_ID'],
				'comment_author' => $user->data->user_nicename,
				'comment_author_email' => $user->data->user_email,
				'comment_author_url' => $user->data->user_url,
				'comment_content' => $_REQUEST['comment_content'],
				'comment_parent' => $_REQUEST['comment_parent'],
				'user_id' => $user->data->ID,
				'comment_date' => $time,
			);

			echo wp_insert_comment($data);
		}

		exit;
	}

	public static function cut_text($text, $charlength) {
		$charlength++;

		if (mb_strlen($text) > $charlength) {
			$subex = mb_substr($text, 0, $charlength);
			$exwords = explode(' ', $subex);
			$excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
			if ($excut < 0) {
				return mb_substr($subex, 0, $excut);
			} else {
				return $subex;
			}
		} else {
			return $text;
		}
	}

	public static function get_monts_names($num) {
		$monthes = array(
			0 => __('January', 'cardealer'),
			1 => __('February', 'cardealer'),
			2 => __('March', 'cardealer'),
			3 => __('April', 'cardealer'),
			4 => __('May', 'cardealer'),
			5 => __('June', 'cardealer'),
			6 => __('July', 'cardealer'),
			7 => __('August', 'cardealer'),
			8 => __('September', 'cardealer'),
			9 => __('October', 'cardealer'),
			10 => __('November', 'cardealer'),
			11 => __('December', 'cardealer'),
		);

		return $monthes[$num];
	}

	public static function get_short_monts_names($num) {
		$monthes = array(
			0 => __('jan', 'cardealer'),
			1 => __('feb', 'cardealer'),
			2 => __('mar', 'cardealer'),
			3 => __('apr', 'cardealer'),
			4 => __('may', 'cardealer'),
			5 => __('jun', 'cardealer'),
			6 => __('jul', 'cardealer'),
			7 => __('aug', 'cardealer'),
			8 => __('sep', 'cardealer'),
			9 => __('oct', 'cardealer'),
			10 => __('nov', 'cardealer'),
			11 => __('dec', 'cardealer'),
		);

		return $monthes[$num];
	}

	public static function get_days_of_week($num) {
		$days = array(
			0 => __('Sunday', 'cardealer'),
			1 => __('Monday', 'cardealer'),
			2 => __('Tuesday', 'cardealer'),
			3 => __('Wednesday', 'cardealer'),
			4 => __('Thursday', 'cardealer'),
			5 => __('Friday', 'cardealer'),
			6 => __('Saturday', 'cardealer'),
		);

		return $days[$num];
	}

	public static function db_quotes_shield($data) {
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				if (is_array($value)) {
					$data[$key] = self::db_quotes_shield($value);
				} else {
					$value = stripslashes($value);
					$value = str_replace('\"', '"', $value);
					$value = str_replace("\'", "'", $value);
					$data[$key] = $value;
				}
			}
		}

		return $data;
	}

	public static function get_post_sort_array() {
		return array('ID' => 'ID', 'date' => 'date', 'post_date' => 'post_date', 'title' => 'title',
		             'post_title' => 'post_title', 'name' => 'name', 'post_name' => 'post_name', 'modified' => 'modified',
		             'post_modified' => 'post_modified', 'modified_gmt' => 'modified_gmt', 'post_modified_gmt' => 'post_modified_gmt',
		             'menu_order' => 'menu_order', 'parent' => 'parent', 'post_parent' => 'post_parent',
		             'rand' => 'rand', 'comment_count' => 'comment_count', 'author' => 'author', 'post_author' => 'post_author');
	}

	public static function get_post_categories() {
		$post_categories_objects = get_categories(array(
			'orderby' => 'name',
			'order' => 'ASC',
			'style' => 'list',
			'show_count' => 0,
			'hide_empty' => 0,
			'use_desc_for_title' => 1,
			'child_of' => 0,
			'hierarchical' => true,
			'title_li' => '',
			'show_option_none' => '',
			'number' => NULL,
			'echo' => 0,
			'depth' => 0,
			'current_category' => 0,
			'pad_counts' => 0,
			'taxonomy' => 'category',
			'walker' => 'Walker_Category'));

		$post_categories = array();
		$post_categories[0] = __('All Categories', 'cardealer');
		foreach ($post_categories_objects as $value) {
			$post_categories[$value->term_id] = $value->name;
		}

		return $post_categories;
	}

	public static function draw_breadcrumbs() {
		$breadcrumbs = array();
		$is_page_for_posts = false;

		if (is_home() && get_option('page_for_posts')) {
			$is_page_for_posts = true;
		}

		if ( is_single() || is_page() || is_archive() || $is_page_for_posts || is_search() ) {
			global $post;

			/* replace breadcrumbs by custom breadcrumbs */
			$breadcrumbs_custom_items = apply_filters('tmm_breadcrumbs_custom_items', '');

			if ($breadcrumbs_custom_items) {
				echo $breadcrumbs_custom_items;
				return;
			}

			$breadcrumbs[] = array(
				'href' => esc_url( home_url('/') ),
				'text' => __("Home", 'cardealer'),
				'title' => '',
			);

			if (is_single()) {

				$categories = get_the_category($post->ID);

				if (!empty($categories)) {
					$categories = $categories[0];
					$cat_url = esc_url(get_category_link($categories->term_id));
					$text = $categories->name;

					$breadcrumbs[] = array(
						'href' => $cat_url,
						'text' => $text,
						'title' => esc_attr(sprintf(__("View all posts in %s", 'cardealer'), $text)),
					);
				}

				$breadcrumbs[] = array(
					'href' => '',
					'text' => get_the_title(),
					'title' => '',
				);

			}

			if (is_archive()) {

				$text = '';

				if (is_category() || is_tag() || is_tax()) {
					$text = single_term_title('', false);
				}

				if (is_post_type_archive()) {
					$text = post_type_archive_title('', false);
				}

				if (is_author()) {
					$queried_object = get_queried_object();

					if (is_object($queried_object)) {
						$text = $queried_object->display_name;
					}

				}

				if (is_date()) {
					if (is_day()) {
						$text = get_the_date();
					} else if (is_month()) {
						$text = get_the_date('F Y');
					} else {
						$text = get_the_date('Y');
					}
				}

				if ($text) {

					$breadcrumbs[] = array(
						'href' => '',
						'text' => $text,
						'title' => '',
					);

				}

			}

			if (is_page() || $is_page_for_posts) {

				if ($is_page_for_posts) {
					$post = get_post(get_option('page_for_posts'));
				}

				if ($post->post_parent) {
					$breadcrumbs[] = array(
						'href' => esc_url( get_permalink($post->post_parent) ),
						'text' => get_the_title($post->post_parent),
						'title' => '',
					);
				}

				$breadcrumbs[] = array(
					'href' => '',
					'text' => get_the_title(),
					'title' => '',
				);
			}

			if (is_search()) {
				$breadcrumbs[] = array(
					'href' => '',
					'text' => __('Search: ', 'cardealer') . get_search_query(),
					'title' => '',
				);
			}

			$breadcrumbs_count = count($breadcrumbs);

			foreach ($breadcrumbs as $key => $item) {

				$output = '';
				$is_link = true;

				if ( $key === ($breadcrumbs_count-1) ) {
					$is_link = false;
				}

				if (!empty($item['action'])) {
					do_action( $item['action'], $is_link );
				} else {
					if ($item['href'] && $is_link) {
						$output .= '<a href="' . esc_url($item['href']) . '" title="' . esc_attr($item['title']) . '">';
					}

					$output .= esc_html($item['text']);

					if ($item['href'] && $is_link) {
						$output .= '</a>';
					}

					$output .= ' ';
				}

				echo $output;

			}

		} else {
			wp_nav_menu(array(
				//'container' => '',
				'theme_location' => 'primary',
				'walker' => new SH_BreadCrumbWalker(),
				'items_wrap' => '<div id="breadcrumb-%1$s" class="%2$s">%3$s</div>'
			));
		}
	}

	public static function get_the_category_list($separator = '', $parents = '', $post_id = false) {
		global $wp_rewrite, $cat;
		if (!is_object_in_taxonomy(get_post_type($post_id), 'category'))
			return apply_filters('the_category', '', $separator, $parents);

		$categories = get_the_category($post_id);
		if (empty($categories))
			return apply_filters('the_category', __('Uncategorized', 'cardealer'), $separator, $parents);

		$rel = ( is_object($wp_rewrite) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

		$thelist = '';
		foreach ($categories as $category) {

			if ($cat == $category->term_id) {
				$thelist .= '&nbsp;' . $category->name;
				break;
			} else {
				$thelist .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_attr(sprintf(__("View all posts in %s", 'cardealer'), $category->name)) . '" ' . $rel . '>' . $category->name . '</a></li>';
			}
		}

		return apply_filters('the_category', $thelist, $separator, $parents);
	}

	/**
	 * Scale down an image to fit a particular size and save a new copy of the image.
	 *
	 * The PNG transparency will be preserved using the function, as well as the
	 * image type. If the file going in is PNG, then the resized image is going to
	 * be PNG. The only supported image types are PNG, GIF, and JPEG.
	 *
	 * Some functionality requires API to exist, so some PHP version may lose out
	 * support. This is not the fault of WordPress (where functionality is
	 * downgraded, not actual defects), but of your PHP version.
	 *
	 * @param string $file Image file path.
	 * @param int $max_w Maximum width to resize to.
	 * @param int $max_h Maximum height to resize to.
	 * @param bool $crop Optional. Whether to crop image or resize.
	 * @param string $suffix Optional. File suffix.
	 * @param string $dest_path Optional. New image file path.
	 * @param int $jpeg_quality Optional, default is 90. Image quality percentage.
	 * @return mixed WP_Error on failure. String with new destination path.
	 */
	public static function tmm_resize_image($file, $max_w, $max_h, $crop = false, $suffix = null, $dest_path = null, $jpeg_quality = 90, $upscale = false, $truecolor_to_palette = true) {

		$image = imagecreatefromstring(file_get_contents($file));


		if (!is_resource($image))
			return new WP_Error('error_loading_image', $image, $file);

		$size = @getimagesize($file);
		if (!$size)
			return new WP_Error('invalid_image', __('Could not read image size', 'cardealer'), $file);
		list($orig_w, $orig_h, $orig_type) = $size;

		$proportion = $max_w/$max_h;

		if ($orig_w < $max_w) {
			$max_w = $orig_w;
			$max_h = $orig_w/$proportion;
		}

		if ($upscale) {
			if ($orig_h < $max_h) {
				$max_w = $proportion*$orig_h;
				$max_h = $orig_h;
			}
		}

		$dims = image_resize_dimensions($orig_w, $orig_h, $max_w, $max_h, $crop);
		if (!$dims)
			return new WP_Error('error_getting_dimensions', __('Could not calculate resized image dimensions', 'cardealer'));
		list($dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) = $dims;

		$newimage = wp_imagecreatetruecolor($dst_w, $dst_h);
		imagecopyresampled($newimage, $image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

// convert from full colors to index colors, like original PNG.
		if ($truecolor_to_palette && IMAGETYPE_PNG == $orig_type && function_exists('imageistruecolor') && !imageistruecolor($image)) {
			imagetruecolortopalette($newimage, false, imagecolorstotal($image));
		}

// we don't need the original in memory anymore
		imagedestroy($image);

// $suffix will be appended to the destination filename, just before the extension
		/*
		  if (!$suffix)
		  $suffix = "{$dst_w}x{$dst_h}";
		 */

		$info = pathinfo($file);
		$dir = $info['dirname'];
		$ext = $info['extension'];
		$name = wp_basename($file, ".$ext");

		if (!is_null($dest_path) and $_dest_path = realpath($dest_path))
			$dir = $_dest_path;
//$destfilename = "{$dir}/{$name}-{$suffix}.{$ext}";
		$destfilename = "{$dir}/{$name}.{$ext}";

		if (IMAGETYPE_GIF == $orig_type) {
			if (!imagegif($newimage, $destfilename))
				return new WP_Error('resize_path_invalid', __('Resize path invalid', 'cardealer'));
		} elseif (IMAGETYPE_PNG == $orig_type) {
			if (!imagepng($newimage, $destfilename)) {
				return new WP_Error('resize_path_invalid', __('Resize path invalid', 'cardealer'));
			}
		} else {
// all other formats are converted to jpg
			if ('jpg' != $ext && 'jpeg' != $ext) {
//$destfilename = "{$dir}/{$name}-{$suffix}.jpg";
				$destfilename = "{$dir}/{$name}.jpg";
			}

			if (!imagejpeg($newimage, $destfilename, apply_filters('jpeg_quality', $jpeg_quality, 'image_resize')))
				return new WP_Error('resize_path_invalid', __('Resize path invalid', 'cardealer'));
		}

		imagedestroy($newimage);

// Set correct file permissions
		$stat = stat(dirname($destfilename));
		$perms = $stat['mode'] & 0000775; //same permissions as parent folder, strip off the executable bits
		@ chmod($destfilename, $perms);
//***** set watermarks

		return $destfilename;
	}

	public static function get_page_backround($page_id) {
		if ($page_id > 0) {
			$page_bg = TMM_Page::get_page_settings($page_id);

			if ($page_bg['pagebg_type'] == "image") {
				if (!empty($page_bg['pagebg_image'])) {

					if (!$page_bg['pagebg_type_image_option']) {
						$page_bg['pagebg_type_image_option'] = "repeat";
					}

					switch ($page_bg['pagebg_type_image_option']) {
						case "repeat-x":
							if (!empty($page_bg['pagebg_image'])) {
								return "background: url(" . $page_bg['pagebg_image'] . ") repeat-x 0 0";
							} else {
								return "";
							}
							break;

						case "fixed":
							if (!empty($page_bg['pagebg_image'])) {
								return "background: url(" . $page_bg['pagebg_image'] . ") no-repeat center top fixed;";
							} else {
								return "";
							}
							break;

						default:
							if (!empty($page_bg['pagebg_image'])) {
								return "background: url(" . $page_bg['pagebg_image'] . ") repeat 0 0";
							} else {
								return "";
							}
							break;
					}
				}
			}

			if ($page_bg['pagebg_type'] == "color") {
				if (!empty($page_bg['pagebg_color'])) {
					return "background: " . $page_bg['pagebg_color'];
				}else{
					return '';
				}
			}

			return self::draw_body_bg();
		} else {
			return self::draw_body_bg();
		}

		return "";
	}

	public static function draw_body_bg() {

		$disable_body_bg = TMM::get_option('disable_body_bg');
		if (!$disable_body_bg) {

			$body_pattern = TMM::get_option('body_pattern');
			$body_pattern_custom_color = TMM::get_option('body_pattern_custom_color');
			$body_bg_color_selected = ( !get_theme_mod( 'background_color' ) && !get_background_image() ) ? "background: " . TMM::get_option('body_bg_color') . ";" : '';
			$body_pattern_selected = (int) TMM::get_option('body_pattern_selected');

			switch ($body_pattern_selected) {
				case 0:
					return $body_bg_color_selected;
					break;
				case 1:
					return "background: url(" . $body_pattern . ") no-repeat 50% 0 fixed;";
					break;
				case 2:
					return "background: url(" . $body_pattern . ") repeat 0 0 " . $body_pattern_custom_color . ";";
					break;
				default:
					return "";
					break;
			}
		}

		return "";

	}

	public static function get_upload_folder() {
		$path = wp_upload_dir();
		$path = $path['basedir'];

		if (!file_exists($path)) {
			mkdir($path, 0775);
		}

		$path = $path . '/thememakers/';
		if (!file_exists($path)) {
			mkdir($path, 0775);
		}

		return $path;
	}

	public static function get_upload_folder_uri() {
		$link = wp_upload_dir();
		return $link['baseurl'] . '/thememakers/';
	}

	public static function delete_dir($path) {
		try {
			if (is_dir($path)) {
				$it = new RecursiveDirectoryIterator($path);
				$files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
				foreach ($files as $file) {
					if ($file->isDir()) {
						@rmdir($file->getRealPath());
					} else {
						try {
							@unlink($file->getRealPath());
						} catch (Exception $e) {
							echo $e->getCode();
						}
					}
				}
				try {
					@rmdir($path);
				} catch (Exception $e) {
					echo $e->getCode();
				}
			}
		} catch (Exception $e) {
			echo $e->getCode();
		}
	}

	//ajax
	public static function get_resized_image_url() {
		echo TMM_Helper::resize_image($_REQUEST['imgurl'], $_REQUEST['alias']);
		exit;
	}

	/*
	 * recursive copy of folders
	 */

	public static function recursive_copy($src, $dst) {
		if (!file_exists($src)) {
			return;
		}
		//***
		$dir = opendir($src);
		@mkdir($dst, 0755);
		while (false !== ( $file = readdir($dir))) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if (is_dir($src . '/' . $file)) {
					self::recursive_copy($src . '/' . $file, $dst . '/' . $file);
				} else {
					copy( $src.'/'.$file, $dst.'/'.$file );
					// Set correct file permissions.
					$stat = stat( dirname( $dst.'/'.$file ));
					$perms = $stat['mode'] & 0000755;
					@ chmod( $dst.'/'.$file, $perms );
				}
			}
		}
		closedir($dir);
	}

	public static function draw_tax_terms_select($tax, $name, $id, $args, $vals = array(), $required = 0) {
		$terms = get_terms($tax, $args);
		//***
		if (!empty($terms)):
			?>
			<label class="sel">
				<select name="<?php echo $name ?>" id="<?php echo $id ?>"<?php echo ($required == 1) ? ' data-required="1"' : ''; ?>>
					<option  value=""><?php _e('None', 'cardealer'); ?></option>
					<?php foreach ($terms as $term): ?>
						<option value="<?php echo $term->term_id ?>" <?php if (in_array($term->term_id, $vals)): ?>selected=""<?php endif; ?>><?php echo $term->name ?></option>
					<?php endforeach; ?>
				</select>
			</label>
		<?php
		endif;
	}

}

/**
 * Retrieve a post's terms as a list ordered by hierarchy.
 *
 * @param int $post_id Post ID.
 * @param string $taxonomy Taxonomy name.
 * @param string $term_divider Optional. Separate items using this.
 * @param string $reverse Optional. Reverse order of links in string.
 * @return string
 */
class GetTheTermList {

	public function get_the_term_list($post_id, $taxonomy, $term_divider = '/', $reverse = false) {
		$object_terms = wp_get_object_terms($post_id, $taxonomy);
		$parents_assembled_array = array();
		//***
		if (!empty($object_terms)) {
			foreach ($object_terms as $term) {
				if (isset($term->parent))
					$parents_assembled_array[$term->parent][] = $term;
			}
		}
		//***
		$sorting_array = $this->sort_taxonomies_by_parents($parents_assembled_array);

		$term_list = $this->get_the_term_list_links($taxonomy, $sorting_array);
		if ($reverse) {
			$term_list = array_reverse($term_list);
		}
		$string_name = implode($term_divider, $term_list);
		$result = array('string_name' => $string_name, 'data' => $sorting_array);
		return $result;
	}

	private function sort_taxonomies_by_parents($data, $parent_id = 0) {
		if (isset($data[$parent_id])) {
			if (!empty($data[$parent_id])) {
				foreach ($data[$parent_id] as $key => $taxonomy_object) {
					if (isset($data[$taxonomy_object->term_id])) {
						$data[$parent_id][$key]->childs = $this->sort_taxonomies_by_parents($data, $taxonomy_object->term_id);
					}
				}

				return $data[$parent_id];
			}
		}

		return array();
	}

	//only for taxonomies. returns array of term links
	private function get_the_term_list_links($taxonomy, $data, $result = array()) {
		if (!empty($data)) {
			foreach ($data as $term) {
				//$result[] = '<a rel="tag" href="' . get_term_link($term->slug, $taxonomy) . '">' . $term->name . '</a>';
				$result[] = $term->name;
				if (!empty($term->childs)) {
					//***
					$res = $this->get_the_term_list_links($taxonomy, $term->childs, array());
					if (!empty($res)) {
						//***
						foreach ($res as $val) {
							if (!is_array($val)) {
								$result[] = $val;
							}
						}
						//***
					}
					//***
				}
			}
		}

		return $result;
	}

}

class SH_BreadCrumbWalker extends Walker {

	/**
	 * @see Walker::$tree_type
	 * @var string
	 */
	var $tree_type = array('post_type', 'taxonomy', 'custom');

	/**
	 * @see Walker::$db_fields
	 * @var array
	 */
	var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

	/**
	 * delimiter for crumbs
	 * @var string
	 */
	var $delimiter = '';

	/**
	 * @see Walker::start_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {

		//Check if menu item is an ancestor of the current page
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$current_identifiers = array('current-menu-item', 'current-menu-parent', 'current-menu-ancestor');
		$ancestor_of_current = array_intersect($current_identifiers, $classes);


		if ($ancestor_of_current) {
			$title = apply_filters('the_title', $item->title, $item->ID);

			//Preceed with delimter for all but the first item.
			if (0 != $depth)
				$output .= $this->delimiter;

			//Link tag attributes
			$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
			$attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
			$attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
			$attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

			//Add to the HTML output
			$output .= '<a' . $attributes . '>' . $title . '</a>';
		}
	}

}
