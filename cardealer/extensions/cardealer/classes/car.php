<?php

/**
 * Class TMM_Ext_PostType_Car
 */
class TMM_Ext_PostType_Car {

    public static $slug = 'car';
    public static $specifications_array = array();
    public static $image_sizes = array();
    public static $max_image_width = 1130;
    public static $max_image_height = 732;
    public static $car_options = array();
    public static $allowed_car_data_options = array(); //for security

	public static function register($options) {

		self::init_options($options);

		//filter cars by id
		add_filter('before_delete_post', array(__CLASS__, 'before_delete_post'), 1, 1);
		add_filter('parse_query', array(__CLASS__, 'admin_posts_filter'));
		add_action('restrict_manage_posts', array(__CLASS__, 'filter_restrict_manage_posts'));

		add_filter("manage_" . self::$slug . "_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_" . self::$slug . "_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));
		add_filter("manage_edit-" . self::$slug . "_sortable_columns", array(__CLASS__, "show_edit_sortable_columns"));
		add_action('load-edit.php', array(__CLASS__, "show_edit_sortable_columns_act"));
		add_action('save_post_' . self::$slug, array(__CLASS__, 'save'), 10, 3);

		/* ajax callbacks */
		add_action('wp_ajax_app_cardealer_admin_set_car_as_featured', array(__CLASS__, 'set_as_featured'));
	}

    public static function init_options($cars_options) {

	    self::$car_options = $cars_options;

        //image sizes
        $slider_size = self::slider_image_size();
        self::$image_sizes = array(
            'homeslide' => array('width' => $slider_size['width'], 'height' => $slider_size['height'], 'description' => __('Image of home slider', 'cardealer')),
            'main' => array('width' => self::$max_image_width, 'height' => self::$max_image_height, 'description' => __('Full image', 'cardealer')),
            'single_thumb_widget' => array('width' => 80, 'height' => 70, 'description' => __('Single page image thumb', 'cardealer')),
            'thumb' => array('width' => 460, 'height' => 290, 'description' => __('Thumb of image', 'cardealer')),
        );

        $data_groups = TMM_Cardealer_DataConstructor::get_data_groups();
        if (!empty($data_groups)) {
            if (is_array($data_groups)) {
                foreach ($data_groups as $key => $value) {
                    self::$specifications_array[$key] = $value['name'];
                }
            }
        }

        self::$allowed_car_data_options = array(
            'car_is_new',
            'car_is_damaged',
            'car_is_used',
            'car_price',
            'car_year',
            'car_mileage',
            'car_transmission',
            'car_fuel_type',
            'car_body',
            'car_vin',
            'car_doors_count',
            'car_interrior_color',
            'car_interior_color',
            'car_exterior_color',
            'car_engine_size',
            'car_engine_additional',
            'car_owner_number',
            'car_cover_image',
            'advanced'
        );


        self::$allowed_car_data_options = array_merge(self::$allowed_car_data_options, array_keys(self::$specifications_array));
    }

	/**
	 * Add car (ajax request)
	 */
	public static function add_car() {
		$user_ID = get_current_user_id();
		$data = array();
		parse_str($_REQUEST['data'], $data);

		$args = array(
			'ID' => 0,
			'post_author' => $user_ID,
			'post_status' => 'draft',
			'post_excerpt' => mb_substr($data['description']['desc'], 0, (int) TMM::get_option('car_adv_desc_signs_count', TMM_APP_CARDEALER_PREFIX)),
			'post_type' => self::$slug
		);

		do_action('tmm_wpml_switch_lang_to_default');

		$post_ID = wp_insert_post($args);

		if (!empty($data)) {

			foreach ($data as $key => $value) {

				if ($key == 'description') {
					continue;
				}

				if ($key == 'car_cover_image' && !empty($value)) {
					self::set_car_cover_image($post_ID, $value);
				}

				if ($key == 'car_carlocation') {
					update_post_meta($post_ID, "car_carlocation", $value);

					foreach ($value as $k => $loc) {
						if ($k == 0) {
							update_post_meta($post_ID, "car_carlocation_1", $loc);
						}
						if ($k == 1) {
							update_post_meta($post_ID, "car_carlocation_2", $loc);
						}
						if ($k == 2) {
							update_post_meta($post_ID, "car_carlocation_3", $loc);
						}
					}
				}

				if ($key == 'cars_videos') {
					update_post_meta($post_ID, "cars_videos", $value);
				}

				if ($key == 'photo_set_hash') {
					continue;
				}
				if ($key=='car_state'){
					update_post_meta($post_ID, $value, '1');
				}

				if ($key == 'car_taxonomies') {

					foreach ($value as $tax => $tax_ids) {
						if (!empty($tax_ids)) {
							foreach ($tax_ids as $tax_id) {
								if (term_exists(intval($tax_id), $tax)) {
									wp_set_object_terms($post_ID, intval($tax_id), $tax, true);
								}
							}
						}
					}

					continue;
				}

				if ($key === 'tmm_advanced') {
					update_post_meta($post_ID, "advanced", $value);
				}

				if (empty($key)) {
					continue;
				}

				if (in_array($key, self::$allowed_car_data_options)) {
					add_post_meta($post_ID, $key, $value);
				}
			}
		}

		//important, for listing
		update_post_meta($post_ID, "car_is_featured", 0);

		//update post title
		$car_data = TMM_Ext_PostType_Car::get_car_data($post_ID);
		$car_producer = explode('/', $car_data['car_producer']);
		$def_title = @$car_producer[0] . " " . @$car_producer[1] . ' ' . $car_data['car_year'];
		$title = !empty($data['post_title']) ? trim( $data['post_title'] ) : '';

		$args = array(
			'ID' => $post_ID,
			'post_status' => 'publish',
			'post_title' => !empty($title) ? $title : $def_title,
		);

		if (TMM::get_option('approve_new_car', TMM_APP_CARDEALER_PREFIX)) {
			update_post_meta($post_ID, 'unapproved', 1);
			$args['post_status'] = 'draft';
		}

		if (TMM::get_option('allow_custom_title', TMM_APP_CARDEALER_PREFIX ) === '1' && TMM::get_option('car_link_type', TMM_APP_CARDEALER_PREFIX ) === 'custom' && !empty($title)) {
			$slug =  $title;
		} else {
			$slug = $def_title;
		}

		$slug = sanitize_title( $slug, $post_ID );
		$slug = wp_unique_post_slug($slug, 0, 'publish', TMM_Ext_PostType_Car::$slug, 0);

		$args['post_name'] = $slug;

		if(isset($_POST['description']['desc'])){
			$args['post_excerpt'] = mb_substr($_POST['description']['desc'], 0, (int) TMM::get_option('car_adv_desc_signs_count', TMM_APP_CARDEALER_PREFIX));
		}

		wp_update_post($args);

		//copy photo folder of the post
		$targetFolder = self::get_image_upload_folder() . $user_ID;
		if (!file_exists($targetFolder)) {
			@mkdir($targetFolder, 0755);
		}

		$targetFolder = self::get_image_upload_folder() . $user_ID . '/' . $post_ID;
		@mkdir($targetFolder, 0755);

		$oldFolder = self::get_image_upload_folder() . $user_ID . '/tmp/' . $data['photo_set_hash'];
		TMM_Helper::recursive_copy($oldFolder, $targetFolder);
		TMM_Helper::delete_dir($oldFolder);

		do_action('tmm_wpml_duplicate_posts', $post_ID);
		do_action('tmm_wpml_switch_lang_to_current');

		$rel_post_ID = apply_filters('tmm_current_lang_postid', $post_ID);
		$permalink = get_post_permalink($rel_post_ID, true);
		$user_obj = get_userdata($user_ID);

		if (get_option('permalink_structure') == '') {
			$permalink = str_replace('='.$rel_post_ID, '='.$slug, $permalink);
		} else {
			$permalink = str_replace('%'.self::$slug.'%', $slug, $permalink);
		}

		/* Send notification to user by email */
		if (tmm_allow_user_email($user_ID, 'user_posts_emails')) {
			global $tmm_config;

			$email = $user_obj->user_email;
			$user_cars_page = TMM_Helper::get_permalink_by_lang( TMM::get_option('user_cars_page', TMM_APP_CARDEALER_PREFIX) );

			if (!empty($user_cars_page)){
				$user_cars_page_link = '<a href="' . $user_cars_page . '">' . __("My Cars", 'cardealer') . '</a>';
			}else{
				$user_cars_page_link = __("My Cars", 'cardealer');
			}

			$subject = __( TMM::get_option('new_car_email_subject', TMM_APP_CARDEALER_PREFIX), 'cardealer' );
			$message = __( TMM::get_option('new_car_email', TMM_APP_CARDEALER_PREFIX), 'cardealer' );

			if (empty($subject)) {
				$subject = $tmm_config['emails']['create_car']['subject'];
			}

			if (empty($message)) {
				$message = $tmm_config['emails']['create_car']['message'];
			}

			$message = str_replace(
				array('__USER__', '__BR__', '__CARLINK__', '__USERCARSLINK__', '__SITENAME__'),
				array($user_obj->display_name, "<br>", '<a href="'.$permalink.'">'.$permalink.'</a>', $user_cars_page_link, get_bloginfo('name')),
				$message );

			TMM_Cardealer_User::send_email($email, $subject, $message);
		}

		if (TMM::get_option('approve_new_car', TMM_APP_CARDEALER_PREFIX) && TMM::get_option('approve_new_car_email', TMM_APP_CARDEALER_PREFIX)) {
			$args = array(
				'preview' => true,
				//'_wpnonce' => wp_create_nonce('tmm'),
			);

			$car_title = tmm_get_car_title($rel_post_ID);
			$subject = sprintf( __('[%1$s] Please moderate: "%2$s"', 'cardealer'), wp_specialchars_decode(get_option('blogname'), ENT_QUOTES), $car_title );

			$message  = sprintf( __('A new car ad "%s" is waiting for your approval', 'cardealer'), $car_title ) . "\r\n";
			$message .= add_query_arg($args, $permalink) . "\r\n\r\n";
			$message .= sprintf( __('Dealer: %s', 'cardealer' ), $user_obj->display_name) . "\r\n";
			$message .= sprintf( __('E-mail: %s', 'cardealer' ), $user_obj->user_email) . "\r\n";

			$message .= __('Please visit the moderation panel:', 'cardealer') . "\r\n";
			$message .= admin_url("edit.php?post_status=draft&post_type=car") . "\r\n";

			$admin_email = get_option('admin_email');

			if (!$admin_email) {
				$admin_email = get_bloginfo('admin_email');
			}

			wp_mail($admin_email, $subject, $message);

		}

		wp_die($post_ID);
	}

	/**
	 * Save car post metadata when a post is saved.
	 *
	 * @param int $post_id The post ID.
	 * @param post $post The post object.
	 * @param bool $update Whether this is an existing post being updated or not.
	 */
	public static function save($post_id, $post = null, $update = false) {

		if (!empty($_POST) && isset($_POST['tmm_meta_saving'])) {
			wp_set_post_terms($post_id, @$_POST['car_taxonomies']['carproducer'], 'carproducer', false);

			update_post_meta($post_id, "car_carlocation", $_POST["car_carlocation"]);
			update_post_meta($post_id, "car_carlocation_1", $_POST["car_carlocation"][0]);
			if(!empty($_POST["car_carlocation"][1])){
				update_post_meta($post_id, "car_carlocation_2", $_POST["car_carlocation"][1]);
			}
			if(!empty($_POST["car_carlocation"][2])){
				update_post_meta($post_id, "car_carlocation_3", $_POST["car_carlocation"][2]);
			}

			$car_is_used = 0;
			$car_is_new = 0;
			$car_is_damaged = 0;

			if($_POST["car_state"] === 'used_car'){
				$car_is_used = 1;
			}else if($_POST["car_state"] === 'car_is_new'){
				$car_is_new = 1;
			}else if($_POST["car_state"] === 'car_is_damaged'){
				$car_is_damaged = 1;
			}

			update_post_meta($post_id, "used_car", $car_is_used);
			update_post_meta($post_id, "car_is_new", $car_is_new);
			update_post_meta($post_id, "car_is_damaged", $car_is_damaged);

			update_post_meta($post_id, "car_vin", $_POST["car_vin"]);
			update_post_meta($post_id, "car_price", $_POST["car_price"]);
			update_post_meta($post_id, "car_year", $_POST["car_year"]);
			update_post_meta($post_id, "car_body", $_POST["car_body"]);
			update_post_meta($post_id, "car_doors_count", $_POST["car_doors_count"]);
			update_post_meta($post_id, "car_transmission", $_POST["car_transmission"]);
			update_post_meta($post_id, "car_fuel_type", $_POST["car_fuel_type"]);
			update_post_meta($post_id, "car_interrior_color", $_POST["car_interrior_color"]);
			update_post_meta($post_id, "car_exterior_color", $_POST["car_exterior_color"]);
			update_post_meta($post_id, "car_mileage", $_POST["car_mileage"]);
			update_post_meta($post_id, "car_engine_size", str_replace(",", ".", $_POST["car_engine_size"]));
			update_post_meta($post_id, "car_engine_additional", $_POST["car_engine_additional"]);
			update_post_meta($post_id, "car_owner_number", (int) $_POST["car_owner_number"]);
			update_post_meta($post_id, "cars_videos", $_POST["cars_videos"]);

			//important for car listing!!
			$car_is_featured = get_post_meta($post_id, 'car_is_featured', true);
			if (empty($car_is_featured)) {
				update_post_meta($post_id, "car_is_featured", 0);
			}

			if (isset($_POST["tmm_advanced"])) {
				update_post_meta($post_id, "advanced", $_POST["tmm_advanced"]);
			}

			//update post title
			$car_data = TMM_Ext_PostType_Car::get_car_data($post_id);
			$car_producer = explode('/', $car_data['car_producer']);
			$def_title = @$car_producer[0] . " " . @$car_producer[1] . ' ' . $car_data['car_year'];
			$title = !empty($_POST['post_title']) ? trim( $_POST['post_title'] ) : '';

			$args = array(
				'ID' => $post_id,
				'post_title' => !empty($title) ? $title : $def_title,
			);

			if( is_admin() && isset($_POST['tmm_new_post_saving']) && $_POST['tmm_new_post_saving'] ){

				if (TMM::get_option('allow_custom_title', TMM_APP_CARDEALER_PREFIX ) === '1' && TMM::get_option('car_link_type', TMM_APP_CARDEALER_PREFIX ) === 'custom' && !empty($title)) {
					$slug =  $title;
				} else {
					$slug = $def_title;
				}

				$slug = sanitize_title( $slug, $post_id );
				$slug = wp_unique_post_slug($slug, 0, 'publish', TMM_Ext_PostType_Car::$slug, 0);
				$args['post_name'] = $slug;
			}

			if(isset($_POST['description']['desc'])){
				$args['post_excerpt'] = mb_substr($_POST['description']['desc'], 0, (int) TMM::get_option('car_adv_desc_signs_count', TMM_APP_CARDEALER_PREFIX));
			}

			global $wpdb;
			$where = array( 'ID' => $post_id );
			$wpdb->update( $wpdb->posts, $args, $where );
		}

	}

	/**
	 * Delete car (ajax request)
	 */
	public static function delete_car() {
		$post_id = (int) $_REQUEST['post_id'];
		$current_user_id = get_current_user_id();
		$post_user_id = get_post_field('post_author', $post_id);
		if ($current_user_id == $post_user_id OR current_user_can('delete_posts')) {
			$dir = self::get_image_upload_folder() . $post_user_id . '/' . $post_id;
			if (file_exists($dir)) {
				TMM_Helper::delete_dir($dir);
			}
			wp_delete_post($post_id);
		} else {
			$response = array();
			$response['error'] = __('Error!', 'cardealer');
			echo json_encode($response);
		}

		exit;
	}

	/**
	 * Get featured cars
	 * @param $count
	 * @param string $orderby (rand, post_date)
	 *
	 * @return array
	 */
	public static function get_featured_cars($count, $orderby = 'rand') {
		$meta_query_array = array();
		$meta_query_array[] = array(
			'key' => 'car_is_featured',
			'value' => 1,
			'type' => 'numeric',
			'compare' => '='
		);

		if(!defined('ICL_LANGUAGE_CODE')){
			$meta_query_array[] = array(
				'key' => '_icl_lang_duplicate_of',
				'value' => '',
				'compare' => 'NOT EXISTS'
			);
		}

		$args = array(
			'post_type' => self::$slug,
			'meta_query' => $meta_query_array,
			'post_status' => array('publish'),
			'posts_per_page' => $count,
			'orderby' => $orderby,
			'order' => 'DESC'
		);

		$results = array();
		$query = new WP_Query($args);

		if (!empty($query->posts)) {
			foreach ($query->posts as $key => $value) {
				$results[$value->ID] = array(
					'ID' => $value->ID,
					'post_title' => $value->post_title,
					'post_excerpt' => $value->post_excerpt,
					'data' => self::get_car_data($value->ID)
				);
			}
		}

		wp_reset_postdata();

		return $results;
	}

	/**
	 * Set post as featured (ajax)
	 *
	 * @param int $post_id
	 * @param int $value
	 * @return int
	 */
	public static function set_as_featured($post_id = 0, $value = 1) {
		$by_ajax = false;

		if (!empty($_POST['post_id']) && isset($_POST['value'])) {
			$post_id = (int) $_POST['post_id'];
			$value = (int) $_POST['value'];
			$by_ajax = true;
		}

		if ($post_id) {
			global $wpdb;
			$modified_date = date('Y-m-d', time());

			update_post_meta($post_id, 'car_is_featured', $value);

			$wpdb->update(
				$wpdb->posts,
				array(
					'post_modified' => $modified_date,
					'post_modified_gmt' => $modified_date
				),
				array(
					'ID' => $post_id,
					'post_type' => self::$slug
				),
				null,
				array( '%d', '%s' )
			);
		}

		if ($by_ajax) {
			ob_clean();
			wp_die($value);
		} else {
			return $value;
		}

	}

//ajax
	public static function sold_car() {
		$post_id = (int) $_REQUEST['post_id'];
		$current_user_id = get_current_user_id();
		$post_user_id = get_post_field('post_author', $post_id);
		if ($current_user_id == $post_user_id OR current_user_can('delete_posts')) {
			$is_car_sold = (int) $_REQUEST['car_is_sold'];
			update_post_meta($post_id, 'car_is_sold', $is_car_sold);
			if($is_car_sold === 1){
				self::set_as_featured($post_id, 0);
			}
		} else {
			$response = array();
			$response['error'] = __('Error!', 'cardealer');
			echo json_encode($response);
		}

		exit;
	}

//ajax
	public static function draft_car() {

		$post_id = (int) $_REQUEST['post_id'];
		$current_user_id = get_current_user_id();
		$post_user_id = get_post_field('post_author', $post_id);
		$post_status = 'draft';
		if ($_REQUEST['car_is_draft'] == 0) {
			$post_status = 'publish';
		}

		if ($current_user_id == $post_user_id OR current_user_can('delete_posts')) {
			global $wpdb;
			//*** check is user can publish car (how cars can be public in current packet)
			if ($post_status == 'publish' AND !current_user_can('delete_posts')) {
				$options = TMM_Cardealer_User::get_default_user_role_options($current_user_id);
				$count = TMM_Cardealer_User::count_users_cars($post_user_id);
				if ($count >= $options['max_cars']) {
					$response = array();
					$response['error'] = sprintf(__('You can not publish more than %d cars', 'cardealer'), $options['max_cars']);
					wp_die(json_encode($response));
				}
			}

			$modified_date = date('Y-m-d', time());
			$wpdb->update(
				$wpdb->posts,
				array(
					'post_status' => $post_status,
					'post_modified' => $modified_date,
					'post_modified_gmt' => $modified_date
				),
				array(
					'ID' => $post_id,
					'post_type' => self::$slug
				),
				null,
				array( '%d', '%s' )
			);

		} else {
			$response = array();
			$response['error'] = __('Error!', 'cardealer');
			echo json_encode($response);
		}

		exit;
	}

    public static function admin_posts_filter($query) {
        global $pagenow;
        if (is_admin() && $pagenow == 'edit.php') {

	        if(isset($_GET['car_ids'])) {
		        $_GET['car_ids'] = trim($_GET['car_ids']);

		        if (!empty($_GET['car_ids'])) {
			        $query->query_vars['post__in'] = explode(',', $_GET['car_ids']);
		        }
	        }

	        if(isset($_GET['author_ids'])) {
		        $author_ids = explode(',' , $_GET['author_ids']);
		        $author_ids = array_map('intval', $author_ids);

		        if (!empty($_GET['author_ids'])) {
			        $query->query_vars['author'] = implode(',' , $author_ids);
		        }
	        }

        }
    }

    public static function filter_restrict_manage_posts() {
        if (isset($_GET['post_type'])) {
            if ($_GET['post_type'] == TMM_Ext_PostType_Car::$slug) {
                echo '<input placeholder="' . __('Cars id\'s', 'cardealer') . '" type = "text" name = "car_ids" value = "' . (isset($_GET['car_ids']) ? $_GET['car_ids'] : '') . '" />';
                echo '<input placeholder="' . __('Users id\'s', 'cardealer') . '" type = "text" name = "author_ids" value = "' . (isset($_GET['author_ids']) ? $_GET['author_ids'] : '') . '" />';
            }
        }
    }

    public static function admin_head() {
        ?>
        <script type="text/javascript">
            var lang_thememakers_cardealer_featured_car_set = "<?php _e("You have marked this car as featured", 'cardealer') ?>";
            var lang_thememakers_cardealer_featured_car_unset = "<?php _e("You have unmarked this car as featured", 'cardealer') ?>";
            var lang_tmm_cardealer_draft_car_set = "<?php _e("You have marked this car as draft", 'cardealer') ?>";
            var lang_tmm_cardealer_sold_car_set = "<?php _e("You have marked this car as sold", 'cardealer') ?>";
            var lang_tmm_cardealer_draft_car_unset = "<?php _e("You have unmarked this car as draft", 'cardealer') ?>";
            var lang_tmm_cardealer_sold_car_unset = "<?php _e("You have unmarked this car as sold", 'cardealer') ?>";
            var lang_tmm_enter_data_right = "<?php _e("Please enter the correct data accordingly!", 'cardealer') ?>";
            var lang_have_data_saved = "<?php _e("Pleae make sure you saved the data!", 'cardealer') ?>";
            var lang_sure2 = "<?php _e("You do not need this. Right?", 'cardealer') ?>";
        </script>
        <?php
    }

    public static function get_location_string($ids) {
        $res = "";
        if (!empty($ids)) {
            if (is_array($ids)) {
                foreach ($ids as $key => $id) {
                    if(!empty($id)){
						$name = self::get_location_name($id);
						if($name == ''){
							break;
						}
                        if ($key > 0) {
                            $res .= ' / ';
                        }
                        $res .= __($name, 'cardealer');
                    }
                }
            }
        }
        return $res;
    }

    public static function get_location_name($id) {
        global $wpdb;
        return $wpdb->get_var("SELECT name FROM tmm_cars_locations WHERE id=" . (int) $id);
    }

    public static function get_locations($parent_id = 0) {
        global $wpdb;
        $res = $wpdb->get_results("SELECT * FROM tmm_cars_locations WHERE parent_id=" . (int) $parent_id . " ORDER BY `name`");
        return $res;
    }

    //work with tmm_cars_locations END

    public static function get_car_data($post_id, $term_divider = '/') {
        $data = array();
        $meta = get_post_meta($post_id);

        $data['car_is_featured'] = isset($meta["car_is_featured"][0]) ? $meta["car_is_featured"][0] : '';
        $data['car_carlocation'] = isset($meta["car_carlocation"][0]) ? $meta["car_carlocation"][0] : '';
        if (!empty($data['car_carlocation'])) {
            if (is_serialized($data['car_carlocation'])) {
                $data['car_carlocation'] = @unserialize($data['car_carlocation']);
            }
        }

        if(isset($meta["used_car"]) && is_array($meta["used_car"])){
            $data['car_is_used'] = $meta["used_car"][0];
        }else{
            $data['car_is_used'] = '';
        }

        $data['car_is_new'] = isset($meta["car_is_new"][0]) ? $meta["car_is_new"][0] : '';

        if(isset($meta["car_is_damaged"]) && is_array($meta["car_is_damaged"])){
            $data['car_is_damaged'] = $meta["car_is_damaged"][0];
        }else{
            $data['car_is_damaged'] = '';
        }

        $data['car_vin'] = @$meta["car_vin"][0];
        $data['car_price'] = @$meta["car_price"][0];
        $data['car_year'] = @$meta["car_year"][0];
        $data['car_mileage'] = !empty($meta["car_mileage"]) ? $meta["car_mileage"][0] : 0;
        $data['car_body'] = @$meta["car_body"][0];
        $data['car_doors_count'] = @$meta["car_doors_count"][0];
        $data['car_transmission'] = @$meta["car_transmission"][0];
        $data['car_fuel_type'] = @$meta["car_fuel_type"][0];
        $data['car_interior_color'] = @$meta["car_interrior_color"][0];
        $data['car_exterior_color'] = @$meta["car_exterior_color"][0];
        $data['car_engine_size'] = @$meta["car_engine_size"][0];
        $data['car_engine_additional'] = @$meta["car_engine_additional"][0];
        $data['car_owner_number'] = @$meta["car_owner_number"][0];

        if(isset($meta["car_cover_image"]) && is_array($meta["car_cover_image"])){
            $data['car_cover_image'] = $meta["car_cover_image"][0];
        }else{
            $data['car_cover_image'] = '';
        }

        if(isset($meta["car_is_sold"]) && is_array($meta["car_is_sold"])){
            $data['car_is_sold'] = $meta["car_is_sold"][0];
        }else{
            $data['car_is_sold'] = '';
        }

        if (isset($meta["cars_videos"]) && is_array($meta["cars_videos"])) {
			$data['cars_videos'] = @unserialize($meta["cars_videos"][0]);
        }else{
            $data['cars_videos'] = '';
        }

        if(isset($meta["advanced"]) && is_array($meta["advanced"])){
            $data['advanced'] = @unserialize($meta["advanced"][0]);
        }else{
            $data['advanced'] = '';
        }

        $term_list_object = new GetTheTermList();
		
		if(defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != ''){
			global $sitepress;
			$default_lang_post_id = icl_object_id( $post_id, self::$slug, true, $sitepress->get_default_language() );
		}else{
			$default_lang_post_id = $post_id;
		}
		
        $car_producer = $term_list_object->get_the_term_list($default_lang_post_id, 'carproducer', $term_divider);

		if(defined('ICL_LANGUAGE_CODE')){
			$data['car_producer'] = str_replace('@'.ICL_LANGUAGE_CODE, '', $car_producer['string_name']);
		}else{
			$data['car_producer'] = $car_producer['string_name'];
		}
        
        $data['car_producer_data'] = $car_producer['data'];

        $data_group_indexes = array_keys(self::$specifications_array);
        if (!empty($data_group_indexes)) {
            foreach ($data_group_indexes as $value) {
				if(isset($meta[$value]) && is_array($meta[$value]) && isset($meta[$value][0])){
					$data[$value] = @unserialize($meta[$value][0]);
				}
            }
        }

        return $data;
    }

    public static function init_meta_boxes() {
        add_meta_box("car_photos", __("Car photos", 'cardealer'), array(__CLASS__, 'car_photos'), self::$slug, "normal", "low");
        add_meta_box("car_attributes", __("Car attributes", 'cardealer'), array(__CLASS__, 'car_attributes'), self::$slug, "normal", "low");
    }

    /*
     * Folder where cars images live
     */

    public static function get_image_upload_folder() {
        $path = TMM_Helper::get_upload_folder();

        $path = $path . 'cardealer/';
        if (!file_exists($path)) {
            @mkdir($path, 0775);
        }

        return $path;
    }

    public static function get_image_upload_folder_uri() {
        $link = TMM_Helper::get_upload_folder_uri();
        return $link . 'cardealer/';
    }

    public static function car_attributes() {
        global $post;
        $data = self::get_car_data($post->ID);
        echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/admin/car_attributes.php', $data);
    }

    public static function show_edit_columns_content($column) {
        global $post;

        switch ($column) {
            case "image":
                $image_url = tmm_get_car_cover_image($post->ID, 'thumb');
                if (!empty($image_url)) {
                    echo '<img width="178" src = "' . $image_url . '" alt = "" style="max-width:100%" />';
                }
                break;
            case "car_price":
                echo '<font color = "red">' . esc_html( tmm_get_car_price($post->ID) ) . '</font>';
                break;
            case "car_year":
                echo get_post_meta($post->ID, 'car_year', true);
                break;
            case "car_mileage":
                echo "<i>" . get_post_meta($post->ID, 'car_mileage', true) . " " . TMM::get_option('distance_unit', TMM_APP_CARDEALER_PREFIX) . "</i>";
                break;
            case "car_engine_size":
                echo "<b>" . get_post_meta($post->ID, 'car_engine_size', true) . "</b> " . TMM::get_option('engine_capacity_unit', TMM_APP_CARDEALER_PREFIX);
                break;
            case "car_is_featured":
                $is_featured = (int) get_post_meta($post->ID, 'car_is_featured', true);
                echo '<input type = "checkbox" class = "js_car_is_featured" value = "' . $post->ID . '" ' . ($is_featured ? 'checked' : '') . ' />';
                break;
            case "car_is_sold":
                $is_sold = (int) get_post_meta($post->ID, 'car_is_sold', true);
                echo '<input type = "checkbox" class = "js_car_is_sold" value = "' . $post->ID . '" ' . ($is_sold ? 'checked' : '') . ' />';
                break;
            case "car_is_draft":
                $is_draft = get_post_field('post_status', $post);
	            $unapproved = get_post_meta($post->ID, 'unapproved', 1);
	            $approve_nonce = esc_html( '_wpnonce=' . wp_create_nonce( "approve-car_$post->ID" ) );

	            $approve_url = admin_url("edit.php?post={$post->ID}&approved=true&$approve_nonce");
	            $unapprove_url = admin_url("edit.php?post={$post->ID}&approved=false&$approve_nonce");

	            echo '<input type = "checkbox" class = "js_car_is_draft" value = "' . $post->ID . '" ' . ($is_draft != 'publish' ? 'checked' : '') . ' />';
				echo '<div class="' . ($unapproved ? 'unapproved' : 'approved') . '"><br>
						<span class="approve">
							<a href="'.$approve_url.'" style="color:#006505">'. __('Approve', 'cardealer') .'</a>
						</span>
						<span class="unapprove">
							<a href="'.$unapprove_url.'" style="color:#d98500">'. __('Unapprove', 'cardealer') .'</a>
						</span>
						</div>';
                break;
	        case "user":
		        $user_info = get_userdata($post->post_author);
				echo ($user_info ? $user_info->display_name : '') . " (#{$post->post_author})";
		        break;
        }
    }

    public static function show_edit_columns($columns) {
        $columns = array(
            "cb" => '<input type="checkbox" />',
            "title" => __("Title", 'cardealer'),
            "image" => __("Main Photo", 'cardealer'),
            "car_price" => __("Price", 'cardealer'),
            "car_year" => __("Year", 'cardealer'),
            "car_mileage" => __("Mileage", 'cardealer'),
            "car_engine_size" => __("Engine Size", 'cardealer'),
            "car_is_featured" => __("Featured", 'cardealer'),
            "car_is_sold" => __("Sold", 'cardealer'),
            "car_is_draft" => __("Draft", 'cardealer'),
            "user" => __("User", 'cardealer'),
            "date" => __("Date", 'cardealer'),
        );

        return $columns;
    }

    public static function show_edit_sortable_columns($columns) {

        $columns["car_price"] = "car_price";
        $columns["car_year"] = "car_year";
        $columns["car_mileage"] = "car_mileage";
        $columns["car_engine_size"] = "car_engine_size";
        $columns["car_is_featured"] = "car_is_featured";
        $columns["car_is_sold"] = "car_is_sold";
        $columns["car_is_draft"] = "car_is_draft";
        $columns["user"] = "post_author";

        return $columns;
    }

    public static function show_edit_sortable_columns_act() {
        add_filter('request', array(__CLASS__, 'sequence_col_sort_logic'));

	    if (!empty($_GET['approved']) && !empty($_GET['post'])) {
		    $post_id = (int) $_GET['post'];
		    $approved = $_GET['approved'] === 'true' ? 1 : 0;

		    if (get_post_type($post_id) === 'car') {

			    if (check_admin_referer( 'approve-car_' . $post_id )) {
				    update_post_meta($post_id, 'unapproved', ($approved ? 0 : 1));

				    $args = array(
					    'ID'           => $post_id,
					    'post_status'   => $approved ? 'publish' : 'draft',
				    );

				    wp_update_post( $args );
			    }

			    wp_redirect( wp_get_referer() );
			    die;
		    }

	    }
    }

    public static function sequence_col_sort_logic($vars) {
        $columns = array();
        $columns["car_price"] = "car_price";
        $columns["car_year"] = "car_year";
        $columns["car_mileage"] = "car_mileage";
        $columns["car_engine_size"] = "car_engine_size";
        $columns["car_is_featured"] = "car_is_featured";
        $columns["car_is_sold"] = "car_is_sold";
        $columns["car_is_draft"] = "car_is_draft";

        if (isset($vars['post_type']) && self::$slug == $vars['post_type']) {
            if (isset($vars['orderby']) && in_array($vars['orderby'], $columns)) {
                $vars = array_merge($vars, array('meta_key' => $vars['orderby'], 'orderby' => 'meta_value_num'));
            }
        }

        return $vars;
    }

//ajax
	/**
	 * Deprecated: only for compatibility
	 * todo: remove
	 */
    public static function set_car_cover_image($post_id = false, $image_name = false) {
	    if($post_id == false){
			$post_id = $_REQUEST['post_id'];
	    }

	    if($image_name == false){
			$image_name = $_REQUEST['image_name'];
	    }

		if($post_id && defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != ''){
			global $sitepress;
			$post_id = icl_object_id( $post_id, self::$slug, true, $sitepress->get_default_language() );
		}
        update_post_meta($post_id, "car_cover_image", $image_name);

	    if($post_id === false){
            exit;
	    }
    }

	/**
	 * Deprecated: only for compatibility
	 * todo: remove
	 * @param $post_id
	 * @param string $folder
	 * @param bool $sidebar
	 *
	 * @return string
	 */
    public static function get_car_cover_image($post_id, $folder = 'main', $sidebar = true) {
	    return TMM_Car_Image::get_cover_image($post_id, $folder, $sidebar);
    }

//for meta box in admin panel
    public static function car_photos() {
        global $post;
		$post_id = $post->ID;
		if($post_id && defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != ''){
			global $sitepress;
			$post_id = icl_object_id( $post_id, self::$slug, true, $sitepress->get_default_language() );
		}
        $data = array();
        $data['post_id'] = $post_id;
        $data['photo_set_hash'] = $post_id;
        $data['car_cover_image'] = get_post_meta($post_id, 'car_cover_image', true);
        echo TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/admin/car_photos.php', $data);
    }

    public static function delete_post_photo($user_id, $post_id, $image_name, $is_new_car = false) {
        $folders = array_keys(self::$image_sizes);
        foreach ($folders as $folder) {
            if (!$is_new_car) {
                $file = self::get_image_upload_folder() . $user_id . '/' . $post_id . '/' . $folder . '/' . $image_name;
                @unlink( apply_filters( 'wp_delete_file', $file ) );
            } else {
                $file = self::get_image_upload_folder() . $user_id . '/tmp/' . $post_id . '/' . $folder . '/' . $image_name;
                @unlink( apply_filters( 'wp_delete_file', $file ) );
            }
        }
    }

    public static function get_post_photos($post_id, $user_ID, $folder = 'main', $is_new_car = false) {
		if(!$is_new_car && $post_id && defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != ''){
			global $sitepress;
			$post_id = icl_object_id( $post_id, self::$slug, true, $sitepress->get_default_language() );
		}
        $targetFolder = self::get_image_upload_folder() . $user_ID;
        if (!file_exists($targetFolder)) {
            @mkdir($targetFolder, 0755);
        }

        if (!$is_new_car) {
            $targetFolder = self::get_image_upload_folder() . $user_ID . '/' . $post_id;
        } else {
            $targetFolder = self::get_image_upload_folder() . $user_ID . '/tmp/' . $post_id;
        }

        if (!file_exists($targetFolder)) {
            @mkdir($targetFolder, 0755);
            $folders = array_keys(self::$image_sizes);
            foreach ($folders as $folder) {
                @mkdir($targetFolder . '/' . $folder . '/', 0755);
            }
        }
        return self::get_user_photo_set($user_ID, $post_id, $folder, $is_new_car);
    }

//return array of images links of the user of the post_id
    public static function get_user_photo_set($user_ID, $post_id, $folder = 'main', $is_new_car = false) {
        if (!$is_new_car) {
            $targetFolder = self::get_image_upload_folder() . $user_ID . '/' . $post_id . '/' . $folder . '/';
        } else {
            $targetFolder = self::get_image_upload_folder() . $user_ID . '/tmp/' . $post_id . '/' . $folder . '/';
        }

        if (!file_exists($targetFolder)) {
            return array();
        }

	    $images = array();
	    $files = glob($targetFolder.'*.*');

	    if (is_array($files)) {
		    foreach ($files as $file) {
			    $file = basename($file);
			    if ($file != '.' && $file != '..') {
				    if (!$is_new_car) {
					    $images[] = self::get_image_upload_folder_uri() . $user_ID . '/' . $post_id . '/' . $folder . '/' . $file;
				    } else {
					    $images[] = self::get_image_upload_folder_uri() . $user_ID . '/tmp/' . $post_id . '/' . $folder . '/' . $file;
				    }
			    }
		    }
	    }

	    return $images;
    }

	//ajax
    public static function draw_quicksearch_locations($is_ajax = true, $selected_region = 0) {//params is for quicksearch.php only
        global $wpdb;
		$parent_id = isset($_REQUEST['parent_id']) ? (int) $_REQUEST['parent_id'] : 0;
        $level = isset($_REQUEST['level']) ? (int) $_REQUEST['level'] : 0;
        $locations = TMM_Ext_PostType_Car::get_locations($parent_id);
		
        if (!empty($locations)) {
            if (is_array($locations)) {
                foreach ($locations as $key => $option) {
					$meta_key = 'car_carlocation_' . ($level + 1);
					$meta_value = $option->id;
					$sql = "SELECT count(DISTINCT pm.post_id)
								FROM $wpdb->postmeta pm
								JOIN $wpdb->posts p ON (p.ID = pm.post_id)
								WHERE pm.meta_key = '$meta_key'
								AND pm.meta_value = '$meta_value'
								AND p.post_type = '" . self::$slug . "'
								AND p.post_status = 'publish'
								";
					$count = $wpdb->get_var($sql);

					if (!TMM::get_option('locations_show_empty_search_widget', TMM_APP_CARDEALER_PREFIX)) {
						if ($count != 0) {
							echo '<option value="' . $option->id . '" ' . ($selected_region == $option->id ? 'selected' : '') . '>' . __($option->name, 'cardealer') . ' (' . $count . ')</option>';
						}
					}else{
						echo '<option value="' . $option->id . '" ' . ($selected_region == $option->id ? 'selected' : '') . '>' . __($option->name, 'cardealer') . ' (' . $count . ')</option>';
					}
                }
            }
        }

        if ($is_ajax) {
            exit;
        }
    }

    public static function draw_quicksearch_models($is_ajax = true) {
        $producer_id = (int) $_REQUEST['producer_id'];
        $location_id = (int) $_REQUEST['location_id'];
        $level = (int) $_REQUEST['level'];
		$models = array();
		$meta_query_array = array();
		
        $selected_region_id = 0;
        if (isset($_REQUEST['selected_region_id'])) {
            $selected_region_id = (int) $_REQUEST['selected_region_id'];
        }
        
		if (isset($_REQUEST['selected_model'])) {
			$selected_model_id = (int) $_REQUEST['selected_model'];
        }else{
			$selected_model_id = $producer_id;
		}
		
		
        
        /* get all terms (car models) by producer id */
		$args = array(
            'orderby' => 'name',
            'order' => 'ASC',
            'hierarchical' => 1,
            'show_count' => 1,
            'parent' => $producer_id,
            'hide_empty' => false,
			//'fields' => 'ids'
        );
        $terms = get_terms('carproducer', $args);
		
        foreach ($terms as $term) {
            $models[$term->term_id] = $term;
        }
        
		/* get car posts by terms ids and locations */
		if ($location_id > 0) {
			if ($selected_region_id > 0) {
				$meta_query_array[] = array(
					'key' => 'car_carlocation_' . $level,
					'value' => $selected_region_id,
					'type' => '=',
				);
			}else{
				$meta_query_array[] = array(
					'key' => 'car_carlocation_1',
					'value' => $location_id,
					'type' => '=',
				);
			}
		}

		$args = array(
			'post_type' => self::$slug,
			'tax_query' => array(),
			'meta_query' => $meta_query_array,
			'post_status' => array('publish'),
			'posts_per_page' => -1
		);
		
		foreach($models as $key=>$model){
			$args['tax_query'][0] = array(
				'taxonomy' => 'carproducer',
				'field' => 'term_id',
				'terms' => array($model->term_id),
			);
			$query = new WP_Query($args);
			$model->count = $query->post_count;
		}

	    wp_reset_postdata();

        echo self::draw_terms_dropdown(array(0 => $models), 0, $selected_model_id, 0);

        if ($is_ajax) {
            exit;
        }
    }

    public static function draw_quicksearch_producers($is_ajax = true, $selected_producer_id = 0) {
        $location_id = isset($_REQUEST['location_id']) ? (int) $_REQUEST['location_id'] : 0;
        $level = (int) $_REQUEST['level'];
        $selected_region_id = (int) $_REQUEST['selected_region_id'];

        $buffer = array();
        $args = array(
            'orderby' => 'title',
            'order' => 'ASC',
            'hierarchical' => 1,
            'show_count' => 1,
            'parent' => 0,
            'hide_empty' => false
        );

        $cars_prodmod_array = get_terms('carproducer', $args);
        foreach ($cars_prodmod_array as $carproducer_term_object) {
            $buffer[$carproducer_term_object->term_id] = $carproducer_term_object;
        }
        $cars_prodmod_array = $buffer;
        $included_producers = array();

        foreach ($cars_prodmod_array as $carproducer_term_object) {
            $tax_query_array = array();
            $meta_query_array = array();
            //***
            if ($location_id > 0) {
                if ($selected_region_id > 0) {
                    $meta_query_array[] = array(
                        'key' => 'car_carlocation_' . $level,
                        'value' => $selected_region_id,
                        'type' => 'numeric',
                    );
                }

                $meta_query_array[] = array(
                    'key' => 'car_carlocation_1',
                    'value' => $location_id,
                    'type' => 'numeric',
                );
            }


            $tax_query_array[] = array(
                'taxonomy' => 'carproducer',
                'field' => 'term_id',
                'terms' => array($carproducer_term_object->term_id),
            );
            
            $args = array(
                'post_type' => self::$slug,
                'meta_query' => $meta_query_array,
                'tax_query' => $tax_query_array,
                'post_status' => array('publish'),
                'posts_per_page' => -1
            );

            $query = new WP_Query($args);
            $included_producers[$carproducer_term_object->term_id] = $query->post_count;
        }

	    wp_reset_postdata();

//***** COUNT OF PRODUCERS CHANGING WHICH IN SELECTED LOCATION PLACED ****************************
        foreach ($cars_prodmod_array as $carproducer_term_object) {
            $cars_prodmod_array[$carproducer_term_object->term_id]->count = $included_producers[$carproducer_term_object->term_id];
        }

        echo self::draw_terms_dropdown(array(0 => $cars_prodmod_array), 0, $selected_producer_id, 0);

        if ($is_ajax) {
            exit;
        }
    }

    public static function draw_terms_dropdown($terms, $parent_id, $selected_model_id, $level) {//$level is for function itself, when recursion doing
        $margin = "";
        if ($level > 0) {
            for ($i = 0; $i < $level; $i++) {
                $margin.="&nbsp;&nbsp;&nbsp;";
            }
        }

//*****
        $output = "";
        if (!empty($terms[$parent_id])) {
            if (!TMM::get_option('producers_show_empty_search_widget', TMM_APP_CARDEALER_PREFIX)) {
                foreach ($terms[$parent_id] as $term) {
                    if ($term->count != 0) {
                        $output.="<option " . ($term->count == 0 ? 'disabled' : '') . " " . ($selected_model_id == $term->term_id ? "selected" : "") . " value='" . $term->term_id . "'>" . $margin . $term->name . "&nbsp;&nbsp;(" . $term->count . ")</option>";
                        $output.=self::draw_terms_dropdown($terms, $term->term_id, $selected_model_id, $level + 1);
                    }
                }
            } else {
                
                foreach ($terms[$parent_id] as $term) {
                    $output.="<option " . ($term->count == 0 ? 'disabled' : '') . " " . ($selected_model_id == $term->term_id ? "selected" : "") . " value='" . $term->term_id . "'>" . $margin . $term->name . "&nbsp;&nbsp;(" . $term->count . ")</option>";
                    $output.=self::draw_terms_dropdown($terms, $term->term_id, $selected_model_id, $level + 1);
                }
            }
        }
       return $output;
    }

    public static function process_advanced_search_params() {
        $data = array();
        parse_str($_REQUEST['advanced_search_params'], $data);

        if (isset($data['advanced']) && !empty($data['advanced'])) {
			foreach ($data as $key => $value) {
				if (is_array($value)) {
					foreach ($value as $key2 => $v) {
						if ($v <= 0) {
							unset($data[$key][$key2]);
						}
					}
				} else {

//if ($value <= 0) {
					unset($data[$key]);
//}

					continue;
				}
			}
//*****
			foreach ($data as $key => $value) {
				if (is_array($value)) {
					if (empty($value)) {
						unset($data[$key]);
					}
				}
			}
        }

	    $params = base64_encode(serialize($data));
	    /* fix bug with base64 ending in query string */
//	    $params = str_replace('=', '', $params );
//	    $params = str_replace('=', '', $params );
	    echo $params;
        exit;
    }

//draw taxonomies while adding or editing cars on front
    public static function wp_list_categories($args = '') {
        $defaults = array(
            'show_option_all' => '', 'show_option_none' => __('No categories', 'cardealer'),
            'orderby' => 'name', 'order' => 'ASC',
            'style' => 'list',
            'show_count' => 0, 'hide_empty' => 0,
            'use_desc_for_title' => 1, 'child_of' => 0,
            'feed' => '', 'feed_type' => '',
            'feed_image' => '', 'exclude' => '',
            'exclude_tree' => '', 'current_category' => 0,
            'hierarchical' => true, 'title_li' => '',
            'echo' => 1, 'depth' => 0,
            'taxonomy' => 'category'
        );

        $r = wp_parse_args($args, $defaults);

        if (!isset($r['pad_counts']) && $r['show_count'] && $r['hierarchical'])
            $r['pad_counts'] = true;

        if (true == $r['hierarchical']) {
            $r['exclude_tree'] = $r['exclude'];
            $r['exclude'] = '';
        }

        if (!isset($r['class']))
            $r['class'] = ( 'category' == $r['taxonomy'] ) ? 'categories' : $r['taxonomy'];

        extract($r);

        if (!taxonomy_exists($taxonomy))
            return false;

        $categories = get_categories($r);

        $output = '';
        if ($title_li && 'list' == $style)
            $output = '<li class = "' . esc_attr($class) . '">' . $title_li . '<ul>';

        if (empty($categories)) {
            if (!empty($show_option_none)) {
                if ('list' == $style)
                    $output .= '<li>' . $show_option_none . '</li>';
                else
                    $output .= $show_option_none;
            }
        } else {
            if (!empty($show_option_all)) {
                $posts_page = ( 'page' == get_option('show_on_front') && get_option('page_for_posts') ) ? get_permalink(get_option('page_for_posts')) : home_url('/');
                $posts_page = esc_url($posts_page);
                if ('list' == $style)
                    $output .= "<li><input type='checkbox' />&nbsp;<a href='$posts_page'>$show_option_all</a></li>";
                else
                    $output .= "<a href='$posts_page'>$show_option_all</a>";
            }

            if (empty($r['current_category']) && ( is_category() || is_tax() || is_tag() )) {
                $current_term_object = get_queried_object();
                if ($r['taxonomy'] == $current_term_object->taxonomy)
                    $r['current_category'] = get_queried_object_id();
            }

            if ($hierarchical)
                $depth = $r['depth'];
            else
                $depth = -1; // Flat.

            $r['checkbox_name'] = $checkbox_name;
            $output .= self::walk_category_tree($categories, $depth, $r);
        }

        if ($title_li && 'list' == $style)
            $output .= '</ul></li>';

        $output = apply_filters('wp_list_categories', $output, $args);

        if ($echo)
            echo $output;
        else
            return $output;
    }

    private static function walk_category_tree() {
        $args = func_get_args();
// the user's options are the third parameter
        if (empty($args[2]['walker']) || !is_a($args[2]['walker'], 'Walker'))
            $walker = new TMM_Ext_PostType_Car_Walker_Category;
        else
            $walker = $args[2]['walker'];

        return call_user_func_array(array(&$walker, 'walk'), $args);
    }

//car specifications fields
    public static function get_attribute_constructors($data_group_index) {
        $block = array();
        $data_groups = TMM_Cardealer_DataConstructor::get_data_groups();
        $data = $data_groups[$data_group_index];

        if (!empty($data['data'])) {
            foreach ($data['data'] as $opt_key => $value) {
                $key = TMM_Cardealer_DataConstructor::sanitize_string($value['name']);

	            if (!$key) {
		            $key = $opt_key;
	            }

                $block[$key]['name'] = $value['name'];
                $block[$key]['type'] = $value['type'];
                $block[$key]['description'] = $value['description'];
                switch ($block[$key]['type']) {
                    case 'textinput':
                        $block[$key]['values'] = $value['textinput'];
                        break;
                    case 'checkbox':
                        $block[$key]['values'] = $value['checkbox'];
                        break;
                    case 'select':
                        $select_data = array();

						if (!empty($value['select'])) {
	                        foreach ($value['select'] as $k => $option) {
	                            $is_range = false;
	                            $option_string_array = explode('^', $option);
								//**** range of integers Ex.:(1^40)
	                            if (count($option_string_array) == 2) {
	                                if (isset($option_string_array[0]) AND isset($option_string_array[1])) {
	                                    $option_string_array[0] = (int) $option_string_array[0];
	                                    $option_string_array[1] = (int) $option_string_array[1];
	                                    if (is_integer($option_string_array[0]) AND is_integer($option_string_array[1])) {
	                                        if ($option_string_array[1] > $option_string_array[0]) {
	                                            $is_range = true;
	                                        }
	                                    }
	                                }
	                            }

	                            if ($is_range) {
	                                for ($i = $option_string_array[0]; $i <= $option_string_array[1]; $i++) {
	                                    $select_data[$i] = $i;
	                                }
	                            } else {
		                            $option_key = TMM_Cardealer_DataConstructor::sanitize_string($option);

		                            if (!$option_key) {
			                            $option_key = 'opt_' . $k;
		                            }

	                                $select_data[$option_key] = $option;
	                            }
	                        }
						}
                        $block[$key]['values'] = $select_data;


                        break;

                    default:
                        break;
                }
            }
        }

        return $block;
    }

//for settings page
    public static function explode_option($option) {
        $data = explode(',', TMM::get_option($option, TMM_APP_CARDEALER_PREFIX));
        $result = array();
        if (!empty($data)) {
            foreach ($data as $value) {
                $result[trim(TMM_Cardealer_DataConstructor::sanitize_string($value))] = trim($value);
            }
        }
        return $result;
    }

    public static function slider_image_size($with_sidebar = true, $crop = true) {
        $width = 0;
        $height = 0;

	    if (is_front_page() || TMM_Helper::is_front_lang_page()) {
		    $with_sidebar = (int) TMM::get_option('show_slider_as', TMM_APP_CARDEALER_PREFIX);
		    $crop = (int) TMM::get_option('crop_image', TMM_APP_CARDEALER_PREFIX);
	    }

        if (!$with_sidebar) {
            $width = 1130;
	        if (is_front_page() || TMM_Helper::is_front_lang_page()) {
                $height = (int) TMM::get_option('slider_without_sidebar_height', TMM_APP_CARDEALER_PREFIX);
	        }
            if (!$height) {
                $height = 640;
            }
        } else {
            $width = 740;
	        if (is_front_page() || TMM_Helper::is_front_lang_page()) {
                $height = (int) TMM::get_option('slider_with_sidebar_height', TMM_APP_CARDEALER_PREFIX);
	        }
            if (!$height) {
                $height = 420;
            }
        }

        $size = array();
        $size['name'] = $width . '*' . $height;
        $size['width'] = $width;
        $size['height'] = $height;
        $size['crop'] = $crop;

        return $size;
    }

    public static function slider_image_sizes($sizes) {
        $slider_size = self::slider_image_size();
        $sizes[$slider_size['name']] = $slider_size;
        return $sizes;
    }

//ajax - for watermark preview in settings
    public static function get_sample_watermark() {
        $destination = self::get_image_upload_folder() . '/sample.jpg';
        @unlink($destination);
        copy(TMM_Ext_Car_Dealer::get_application_path() . '/images/sample.jpg', $destination);
        $watermark = new TMM_Cardealer_Watermark();
//***
        $watermark->place_watermark($destination, (int) $_REQUEST['alpha_level'], $_REQUEST['watermark_position'], $_REQUEST['watermark_size_percent']);
        echo self::get_image_upload_folder_uri() . 'sample.jpg?watermark=' . uniqid();
        exit;
    }

    public static function before_delete_post($post_id) {
        $post_type = get_post_field('post_type', $post_id);
        if ($post_type == self::$slug) {
            $post_user_id = get_post_field('post_author', $post_id);
            $dir = self::get_image_upload_folder() . $post_user_id . '/' . $post_id;
            if (file_exists($dir)) {
                TMM_Helper::delete_dir($dir);
            }
        }
    }

    public static function get_compare_list() {
        if (isset($_COOKIE['car_compare_list'])) {
            $car_compare_list = explode(',', $_COOKIE['car_compare_list']);
            if (isset($car_compare_list[0])) {
                if (empty($car_compare_list[0])) {
                    $car_compare_list = array();
                }
            }

            return $car_compare_list;
        }

        return array();
    }

    public static function get_watch_list() {
        if (isset($_COOKIE['car_watch_list'])) {
            $car_compare_list = explode(',', $_COOKIE['car_watch_list']);
            if (isset($car_compare_list[0])) {
                if (empty($car_compare_list[0])) {
                    $car_compare_list = array();
                }
            }

            return $car_compare_list;
        }

        return array();
    }

    public static function get_user_max_images_uploads_size($user_id) {
        $size = get_user_meta($user_id, 'cardealer_max_images_size', true);

        if (!$size) {
            $options = TMM_Cardealer_User::get_default_user_role_options($user_id);
            $size = isset($options['max_images_size']) ? $options['max_images_size'] : 0;
        }

        if (!$size) {
            $size = TMM::get_option('cardealer_max_images_size', TMM_APP_CARDEALER_PREFIX);
        }

        if (!$size) {
            $size = 5;
        }

        return $size * 1000000.00;
    }

//users images weight in megabytes
    public static function get_user_uploads_weight($user_ID) {
        $targetFolder = self::get_image_upload_folder() . $user_ID;
        if (!file_exists($targetFolder)) {
            @mkdir($targetFolder, 0755);
        }
        //***
        return TMM_Helper::get_dir_size($targetFolder);
    }

    public static function get_user_file_space($user_ID) {
        $data = array();
        $data['user_file_space'] = self::get_user_uploads_weight($user_ID);
        $data['user_file_max_space'] = self::get_user_max_images_uploads_size($user_ID);
        $data['size_left'] = $data['user_file_max_space'] - $data['user_file_space'];

        return $data;
    }

    public static function update_post_view_count($post_id) {
        $views = (int) get_post_meta($post_id, 'car_views_count', true);
        update_post_meta($post_id, 'car_views_count', ++$views);
        return $views;
    }
	
	public static function get_cars_count_by_locationid($locationid = 0, $level = 0) {
        global $wpdb;
		$count = 0;
		
        if ($locationid > 0 && $level > 0) {
			$meta_key = 'car_carlocation_' . (int) $level;
			$meta_value = (int) $locationid;
			$sql = "SELECT count(DISTINCT p.post_name)
						FROM $wpdb->postmeta pm
						JOIN $wpdb->posts p ON (p.ID = pm.post_id)
						WHERE pm.meta_key = '$meta_key'
						AND pm.meta_value = $meta_value
						AND p.post_type = '" . self::$slug . "'
						AND p.post_status = 'publish'
						";
			$count = $wpdb->get_var($sql);
        }
		return $count;
    }
	
	/* return array with terms objects of 'carproducer' taxonomy */
	public static function get_carproducers($only_makes = false){
		$args = array(
			'parent' => '0',
			'hide_empty' => 0,
		);
		$terms = get_terms('carproducer', $args);
		if(!$only_makes){
			foreach($terms as $term){
				$args['parent'] = $term->term_id;
				$childs = get_terms('carproducer', $args);
				if(is_array($childs) && count($childs)){
					$term->childs = $childs;
				}
			}
		}
		//file_put_contents(TMM_THEME_PATH . '/install/carproducer.dat', serialize($terms));
		return $terms;
	}

	/*
	 *  Create car thumbs with right sizes from main image
	 *  Example: TMM_Ext_PostType_Car::generate_car_thumbs('thumb');
	 *           TMM_Ext_PostType_Car::generate_car_thumbs('single_thumb_widget');
	 *
	 */
	public static function generate_car_thumbs($folder){
        $folders = TMM_Ext_PostType_Car::$image_sizes;
        $result = array();
        if(isset($folders[$folder])){
            $width = $folders[$folder]['width'];
            $height = $folders[$folder]['height'];
            $allowed_file_types = array('jpg', 'jpeg', 'png');
            $user_ID = get_current_user_id();
            $user_folder = TMM_Ext_PostType_Car::get_image_upload_folder() . $user_ID;
            $user_posts_folders = scandir($user_folder);

            foreach($user_posts_folders as $post_folder){
                if(is_dir($user_folder.'/'.$post_folder) && is_dir($user_folder.'/'.$post_folder.'/main')){
                    $post_main_folder = scandir($user_folder.'/'.$post_folder.'/main');
                    $result[$user_folder.'/'.$post_folder] = array();

                    foreach($post_main_folder as $image_name){
                        $file_info = pathinfo($user_folder.'/'.$post_folder.'/main/'.$image_name);
                        if (in_array(strtolower($file_info['extension']), $allowed_file_types)) {
                            if (@copy($user_folder.'/'.$post_folder.'/main/'.$image_name, $user_folder.'/'.$post_folder.'/'.$folder.'/'.$image_name)) {
                                TMM_Helper::tmm_resize_image($user_folder.'/'.$post_folder.'/'.$folder.'/'.$image_name, $width, $height, true, null, null, 90);
                                $result[$user_folder.'/'.$post_folder][] = $file_info;
                            }
                        }
                    }

                }
            }
        }
        return $result;
    }

}



class TMM_Ext_PostType_Car_Walker_Category extends Walker {

    var $tree_type = 'category';
    var $db_fields = array('parent' => 'parent', 'id' => 'term_id');

    function start_lvl(&$output, $depth = 0, $args = array()) {
        if ('list' != $args['style'])
            return;

        $indent = str_repeat("\t", $depth);
        $output .= "$indent<ul class='children'>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        if ('list' != $args['style'])
            return;

        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0) {
        extract($args);

        $cat_name = esc_attr($category->name);
        $cat_name = apply_filters('list_cats', $cat_name, $category);
        $link = '<input class="option_checkbox" type="checkbox" name="' . $checkbox_name . '" value="' . $category->term_id . '" />&nbsp;';

        $link .= $cat_name;

        if ('list' == $args['style']) {
            $output .= "\t<li";
            $class = 'cat-item cat-item-' . $category->term_id;
            if (!empty($current_category)) {
                $_current_category = get_term($current_category, $category->taxonomy);
                if ($category->term_id == $current_category)
                    $class .= ' current-cat';
                elseif ($category->term_id == $_current_category->parent)
                    $class .= ' current-cat-parent';
            }
            $output .= ' class="' . $class . '"';
            $output .= "><label>$link</label>\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }

    function end_el(&$output, $page, $depth = 0, $args = array()) {
        if ('list' != $args['style'])
            return;

        $output .= "</li>\n";
    }

}
