<?php

class TMM {

	public static $options, $app_options;

	public static function init() {
		self::$options = get_option(TMM_THEME_PREFIX . 'theme_options');
		self::$app_options = get_option(TMM_THEME_PREFIX . 'theme_app_options');
	}

	public static function get_option($option, $prefix = TMM_THEME_PREFIX) {
		if ($prefix == TMM_THEME_PREFIX) {
			if (isset(self::$options[$option])) {
				return self::$options[$option];
			}
		} else {
			if (isset(self::$app_options[$prefix][$option])) {
				return self::$app_options[$prefix][$option];
			}
		}
	}

	public static function update_option($option, $data, $prefix = TMM_THEME_PREFIX) {
		if ($prefix == TMM_THEME_PREFIX) {
			self::$options[$option] = $data;
			update_option($prefix . 'theme_options', self::$options);
		} else {
			self::$app_options[$prefix][$option] = $data;
			update_option(TMM_THEME_PREFIX . 'theme_app_options', self::$app_options);
		}
	}

	//ajax
	public static function change_options() {

		$action_type = $_REQUEST['type'];
		$data = array();
		parse_str($_REQUEST['values'], $data);
		$data = TMM_Helper::db_quotes_shield($data);

		switch ($action_type) {
			case 'save':
				if (!empty($data)) {

					if (isset($data['copyright_text'])){
						$data['copyright_text'] = htmlentities($data['copyright_text']);
					}

					foreach ($data as $option => $newvalue) {

						if ($option == "sidebars") {
							unset($newvalue[0]);

							if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != '') {

								if (is_array($newvalue)) {

									foreach ($newvalue as $k => &$v) {

										if (!isset($v['lang'])) {
											$v['lang'] = ICL_LANGUAGE_CODE;
										}

									}

								}

							}

							TMM::update_option('sidebars', $newvalue);
							continue;
						}
						if ($option == "seo_group") {
							unset($newvalue[0]);
							TMM::update_option('seo_groups', $newvalue);
							continue;
						}
						if ($option == "contact_form") {
							if (!empty($newvalue)) {
								foreach ($newvalue as $key => $form) {
									if (!isset($newvalue[$key]['title'])) {
										unset($newvalue[$key]);
									}

									if (empty($newvalue[$key]['title'])) {
										unset($newvalue[$key]);
									}
								}
							}
							TMM_Contact_Form::save($newvalue);
							continue;
						}

						if (is_array($newvalue)) {
							self::update_option($option, $newvalue);
						} else {
							$newvalue = stripcslashes($newvalue);
							$newvalue = str_replace('\"', '"', $newvalue);
							$newvalue = str_replace("\'", "'", $newvalue);
							self::update_option($option, $newvalue);
						}
					}
				}
				esc_html_e('Options have been updated.', 'diplomat');
				break;


			case 'reset':
				if (!empty($data)) {
					foreach ($data as $option => $newvalue) {
						if ($option == "sidebars") {
							continue;
						}
						if ($option == "contact_form") {
							continue;
						}

						self::update_option($option, $newvalue);
					}
				}
				esc_html_e('Options have been reset.', 'diplomat');
				break;


			default:
				break;
		}


		//**** CSS REGENERATION

		$custon_vars = self::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/custom_vars.php');
		$handle = fopen(TMM_THEME_PATH . '/scss/_tmm_styling_options.scss', 'w');
		fwrite($handle, $custon_vars);
		fclose($handle);

		$custom_css1 = self::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/custom_css1.php');
		$custom_css2 = self::draw_free_page(TMM_THEME_PATH . '/admin/theme_options/custom_css2.php');
		$handle = fopen(TMM_THEME_PATH . '/css/styles.css', 'w');
		fwrite($handle, $custom_css1);
		fclose($handle);
		$handle = fopen(TMM_THEME_PATH . '/css/custom2.css', 'w');
		fwrite($handle, $custom_css2);
		fclose($handle);
		exit;
	}

	public static function draw_free_page($pagepath, $data = array()) {
		@extract($data);
		ob_start();
		include $pagepath;
		return ob_get_clean();		
	}

	/**
	 * This function is a proper replacement for realpath
	 * It will _only_ normalize the path and resolve indirections (.. and .)
	 * Normalization includes:
	 * - directiory separator is always /
	 * - there is never a trailing directory separator
	 * @param  $path
	 * @return String
	 */
	public static function normalize_path($path) {
		$parts = preg_split(":[\\\/]:", $path); // split on known directory separators
		// resolve relative paths
		for ($i = 0; $i < count($parts); $i +=1) {
			if ($parts[$i] === "..") {		  // resolve ..
				if ($i === 0) {
					throw new Exception("Cannot resolve path, path seems invalid: `" . $path . "`");
				}
				unset($parts[$i - 1]);
				unset($parts[$i]);
				$parts = array_values($parts);
				$i -= 2;
			} else if ($parts[$i] === ".") {	// resolve .
				unset($parts[$i]);
				$parts = array_values($parts);
				$i -= 1;
			}
			if ($i > 0 && $parts[$i] === "") {  // remove empty parts
				unset($parts[$i]);
				$parts = array_values($parts);
			}
		}
		
		return implode("/", $parts);
	}

	public static function draw_html($view, $data = array()) {
		@extract($data);
		ob_start();
		include(TMM_THEME_PATH . '/admin/views/' . $view . '.php' );
		return ob_get_clean();
	}
    
    public static function masonry_get_next_posts($data){
        @extract($data);
        $category =0;
        if ($category==0){
            $query = new WP_Query(array(
            'post_type' => 'post',
            'showposts' => '-1'    
                ));
        }else{
            $query = new WP_Query(array(
            'post_type' => 'post',
            'showposts' => '-1',
            'cat' => $category
                ));
        }

        $posts_array = $query->posts;

		$next_posts = "";
        if (count($posts_array) > ($posts_per_load * $page_load)) {

            for ($i = $posts_per_load * ($page_load); $i < ($posts_per_load * ($page_load + 1)); $i++) {

                if (isset($posts_array[$i])) {
                    $str = (string) $i;
                    $next_posts = $next_posts . $str . ",";               
                }
            }
        }
        ob_start();
        ?>        
        
			<a class='load-more button secondary middle' data-page-load="<?php echo esc_attr(++$page_load); ?>" data-posts-per-load="<?php echo esc_attr($posts_per_load) ?>" data-posts="<?php echo esc_attr($next_posts) ?>" href='#load-more'><?php esc_html_e('Load More', 'diplomat') ?></a>
		        
        <?php
        return ob_get_clean();        
    }
    
    public static function get_post_masonry_piece() {
		$data = array();
		$data['posts'] = $_REQUEST['posts'];
		$data['page_load'] =$_REQUEST['page_load'];
		$data['posts_per_load'] = $_REQUEST['posts_per_load'];
		$data['columns'] = $_REQUEST['columns'];

		$data['title_symbols'] = $_REQUEST['title_symbols'];
		$data['excerpt_symbols'] = $_REQUEST['excerpt_symbols'];
		$data['show_excerpt'] = $_REQUEST['show_excerpt'];

		$data['image_opacity'] = isset($_REQUEST['image_opacity']) ? $_REQUEST['image_opacity'] : '';
		$data['image_background'] = isset($_REQUEST['image_background']) ? $_REQUEST['image_background'] : '';

		$responce['article'] = array();
		$posts = explode(',', $data['posts']);
		foreach ($posts as $post){
			$post_key = $post;
			$data['post_key'] = $post_key;
			$responce['article'][$post] = TMM::draw_html('post/masonry_piece', $data);
		}

		$responce['key'] = $post_key;
		$responce['load_more'] = TMM::masonry_get_next_posts($data);
		echo json_encode($responce);

		exit;
	}

}