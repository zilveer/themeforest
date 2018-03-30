<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Cardealer_User {

	public static function register() {
		add_filter('manage_users_columns', array(__CLASS__, 'manage_users_columns'), 15, 1);
		add_action('manage_users_custom_column', array(__CLASS__, 'manage_users_custom_column'), 15, 3);
		add_action('delete_user', array(__CLASS__, 'delete_user'), 15, 2);
		//add user roles
		$user_roles = self::get_user_roles();
		if (is_array($user_roles)) {
			if (!empty($user_roles)) {
				foreach ($user_roles as $key => $role) {
					add_role($key, $role['name'], array('read'));
					//remove_role($key);
				}
			}
		}

		add_action( 'set_user_role', array('TMM_Cardealer_User', 'set_user_account'), 10, 3 );
		add_action( 'send_email_changed_user_role', array('TMM_Cardealer_User', 'send_email_changed_user_role'), 10, 2 );
	}

	//add columns to User panel list page
	public function manage_users_columns($defaults) {            
		unset($defaults['posts']);
		//$defaults['cars'] = __('Cars', 'cardealer');
		$defaults['cardealer_max_images_size'] = __('Max uploaded files size (MB)', 'cardealer');
		return $defaults;
	}

	public static function manage_users_custom_column($value, $column_name, $user_id) {
		if ($column_name == 'cardealer_max_images_size') {
			if (user_can($user_id, 'manage_options')) {
				return __('Unlimited', 'cardealer');
			} else {
				$size = get_user_meta($user_id, 'cardealer_max_images_size', true);

				if (!$size) {
					$options = self::get_default_user_role_options($user_id);
					$size = @$options['max_images_size'];
				}

				if (!$size) {
					$size = TMM::get_option('cardealer_max_images_size', TMM_APP_CARDEALER_PREFIX);
				}

				if (!$size) {
					$size = 5;
				}

				return '<input type="text" class="cardealer_max_images_size" data-user-id="' . $user_id . '" value="' . $size . '" />';
			}
		}
		//***
		echo $column_name;
		if ($column_name == 'cars') {
			return '<a href="' . admin_url("edit.php?author=$user_id&post_type=" . TMM_Ext_PostType_Car::$slug) . '">' . TMM_Cardealer_User::count_users_cars($user_id) . '</a>';
		}
	}

	//ajax
	public static function get_user_file_space() {
		global $wpdb;
		$user_pass = base64_decode($_POST['hash']);
		$user_ID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users WHERE user_pass = %s", $user_pass));
		$res = TMM_Ext_PostType_Car::get_user_file_space($user_ID);
		$res['user_file_space'] = number_format($res['user_file_space'] / 1000000, 2);
		$res['user_file_max_space'] = number_format($res['user_file_max_space'] / 1000000, 2);
		$res['size_left'] = number_format($res['size_left'] / 1000000, 2);
		wp_die(json_encode($res));
	}

	public static function admin_head() {
		
	}

	public static function init_meta_boxes() {
		
	}

	public static function new_contact_fields($contactmethods) {
		$contactmethods['phone'] = __('Phone', 'cardealer');
		$contactmethods['mobile'] = __('Mobile', 'cardealer');
		$contactmethods['fax'] = __('Fax', 'cardealer');
		$contactmethods['skype'] = __('Skype', 'cardealer');
		$contactmethods['address'] = __('Address', 'cardealer');
		return $contactmethods;
	}

	public static function update_user_profile() {
		$data = array();
		parse_str($_POST['values'], $data);
		$user_id = get_current_user_id();

		if (!current_user_can('edit_user', $user_id))
			wp_die(__('You do not have permission to edit this user.', 'cardealer'));

		if (!is_email($data['user_email'])) {
			wp_die(__('Wrong email!', 'cardealer'));
		}

		$curr_user_data = wp_get_current_user();

		if ($curr_user_data->data->user_email != $data['user_email']) {
			if (email_exists($data['user_email'])) {
				wp_die(__('User with such email already exists!', 'cardealer'));
			}
		}

		/*
		 * update user info
		 */
		$userdata = array();
		$userdata['ID'] = $user_id;
		$userdata['user_email'] = $data['user_email'];
		$userdata['user_url'] = $data['user_url'];
		$userdata['first_name'] = $data['first_name'];
		$userdata['last_name'] = $data['last_name'];
		$userdata['nickname'] = $data['nickname'];
		$userdata['phone'] = $data['phone'];
		$userdata['mobile'] = $data['mobile'];
		$userdata['fax'] = $data['fax'];
		$userdata['skype'] = $data['skype'];
		$userdata['address'] = $data['address'];
		$userdata['description'] = mb_substr($data['description'], 0, 2000);

		/* display name */
		$public_display = array();
		$public_display['display_nickname'] = $curr_user_data->nickname;
		$public_display['display_username'] = $curr_user_data->user_login;

		if (!empty($curr_user_data->first_name))
			$public_display['display_firstname'] = $curr_user_data->first_name;

		if (!empty($curr_user_data->last_name))
			$public_display['display_lastname'] = $curr_user_data->last_name;

		if (!empty($curr_user_data->first_name) && !empty($curr_user_data->last_name)) {
			$public_display['display_firstlast'] = $curr_user_data->first_name . ' ' . $curr_user_data->last_name;
			$public_display['display_lastfirst'] = $curr_user_data->last_name . ' ' . $curr_user_data->first_name;
		}

		if (!in_array($curr_user_data->display_name, $public_display)) // Only add this if it isn't duplicated elsewhere
			$public_display = array('display_displayname' => $curr_user_data->display_name) + $public_display;

		$public_display = array_map('trim', $public_display);
		$public_display = array_unique($public_display);

		if (in_array($data['display_name'], $public_display)) {
			$userdata['display_name'] = $data['display_name'];
		} else {
			$userdata['display_name'] = $public_display['display_nickname'];
		}

		/* user password */
		if (!empty($data['password2']) OR !empty($data['password1'])) {
			if ($data['password2'] == $data['password1']) {
				$userdata['user_pass'] = $data['password2'];
			} else {
				wp_die(__('Passwords don\'t match!', 'cardealer'));
			}
		}

		wp_update_user($userdata);

		/*
		 * update user meta
		 */

		/* location info */
		if(!isset($data['show_map_to_visitors'])){
			$data['show_map_to_visitors'] = 0;
		}

		update_user_meta($user_id, 'show_map_to_visitors', (int) $data['show_map_to_visitors']);
		update_user_meta($user_id, 'location_address', $data['location_address']);
		update_user_meta($user_id, 'map_zoom', $data['map_zoom']);
		update_user_meta($user_id, 'map_latitude', $data['map_latitude']);
		update_user_meta($user_id, 'map_longitude', $data['map_longitude']);

		/* email notifications */
		if(!isset($data['account_emails'])){
			$data['account_emails'] = 0;
		}

		update_user_meta($user_id, 'account_emails', (int) $data['account_emails']);

		if(!isset($data['user_posts_emails'])){
			$data['user_posts_emails'] = 0;
		}

		update_user_meta($user_id, 'user_posts_emails', (int) $data['user_posts_emails']);

		echo 1; exit;
	}

	public static function set_dealer_loan_rate() {
		$user_id = get_current_user_id();
		$rate = str_replace(',', '.', $_POST['rate']);
		$rate = (float) $rate;
		if($rate === 0){
			$rate = '';
		}
		update_user_meta($user_id, 'cardealer_loan_rate', $rate);
		echo $rate;
		exit;
	}

	public static function get_user_logo_url($user_id) {
		$targetFolder = TMM_Ext_PostType_Car::get_image_upload_folder() . $user_id;
		if (!file_exists($targetFolder)) {
			mkdir($targetFolder, 0755);
		}

		$targetFolder = TMM_Ext_PostType_Car::get_image_upload_folder() . $user_id . '/logo/';
		if (!file_exists($targetFolder)) {
			mkdir($targetFolder, 0755);
		}

		//***
		$img = "";
		$handler = opendir($targetFolder);
		while ($file = readdir($handler)) {
			if ($file != "." AND $file != "..") {
				$img = $file;
				break;
			}
		}

		if (!empty($img)) {
			return TMM_Ext_PostType_Car::get_image_upload_folder_uri() . $user_id . '/logo/' . $img;
		}


		return '';
	}

	//ajax
	public static function ajax_get_user_logo_url() {
		global $wpdb;
		$user_pass = base64_decode($_POST['hash']);
		$user_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->users WHERE user_pass = %s", $user_pass));
		echo self::get_user_logo_url($user_id);
		exit;
	}

	//ajax
	public static function set_user_max_images_size() {
		update_user_meta(intval($_REQUEST['user_id']), 'cardealer_max_images_size', intval($_REQUEST['value']));
		exit;
	}

	public static function get_user_map_data($user_id) {
		$data = array();

		$data['show_map_to_visitors'] = get_user_meta($user_id, 'show_map_to_visitors', true);
		$data['location_address'] = get_user_meta($user_id, 'location_address', true);
		$data['map_zoom'] = get_user_meta($user_id, 'map_zoom', true);
		$data['map_latitude'] = get_user_meta($user_id, 'map_latitude', true);
		$data['map_longitude'] = get_user_meta($user_id, 'map_longitude', true);
		if (!$data['map_zoom']) {
			$data['map_zoom'] = 12;
		}
		if (empty($data['map_zoom'])) {
			$data['map_latitude'] = 40.714623;
			$data['map_longitude'] = -74.006605;
		}

		return $data;
	}

	public static function delete_user($user_id, $reassign) {

		$args = array(
			'post_type' => TMM_Ext_PostType_Car::$slug,
			'orderby' => 'title',
			'order' => 'ASC',
			'post_status' => 'any',
			'numberposts' => -1,
			'author' => $user_id
		);
		$posts = get_posts($args);

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$dir = TMM_Ext_PostType_Car::get_image_upload_folder() . $user_id . '/' . $post->ID;

				if (file_exists($dir)) {
					if ($reassign !== null) {
						$dest_dir = TMM_Ext_PostType_Car::get_image_upload_folder() . $reassign . '/' . $post->ID;
						rename($dir, $dest_dir);
					}else{
						TMM_Helper::delete_dir($dir);
					}
				}

			}
		}

		$dir = TMM_Ext_PostType_Car::get_image_upload_folder() . $user_id;
		TMM_Helper::delete_dir($dir);

		/* Send email notification */
		global $tmm_config;
		$user_obj = get_userdata($user_id);
		$email = $user_obj->user_email;

		$subject = __( TMM::get_option('delete_user_email_subject', TMM_APP_CARDEALER_PREFIX), 'cardealer' );
		$message = __( TMM::get_option('delete_user_email', TMM_APP_CARDEALER_PREFIX), 'cardealer' );

		if (empty($subject)) {
			$subject = $tmm_config['emails']['delete_user']['subject'];
		}

		if (empty($message)) {
			$message = $tmm_config['emails']['delete_user']['message'];
		}

		$message = str_replace(
			array('__USER__', '__SITENAME__'),
			array($user_obj->display_name, get_bloginfo("name")),
			$message );

		self::send_email($email, $subject, $message);
	}

	//ajax
	public static function add_user_role() {
		$user_role = array();
		$user_role_id = uniqid(); //not integer!!
		$user_role['name'] = $_REQUEST['user_role_name'];
		$user_role['max_cars'] = 2;
		$user_role['max_images_size'] = 5;
		$user_role['features_cars_count'] = 0;
		$user_role['life_period'] = 0;
		$user_role['packet_price'] = 0;
		$user_role['feature_car_life_time'] = 7;

		//***

		$res = array();
		$res['html'] = TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/admin/user_role.php', array('user_role' => $user_role, 'user_role_id' => $user_role_id));
		$res['user_role_id'] = $user_role_id;
		wp_die(json_encode($res));
	}

	public static function get_user_roles() {
		$user_roles = TMM::get_option('user_roles', TMM_APP_CARDEALER_PREFIX);
		if(!empty($user_roles) && is_array($user_roles)){
			unset($user_roles[0]);
		}else{
			$user_roles = array();
		}
		return $user_roles;
	}

	public static function get_users_by_role() {
		$role = $_POST['role'];
		$dealers = array();
		$args = array();

		if (!empty($role) && $role != '1') {
			$args['role'] = $role;
		}
		$users = get_users($args);

		foreach ($users as $value) {
			if ($role === '1' && !empty($value->caps['administrator'])) {
				continue;
			}
			$dealers[] = array(
				'ID' => $value->ID,
				'user_nicename' => $value->user_nicename,
			);
		}

		wp_die(json_encode($dealers));
	}

	public static function get_default_user_role() {
		$default_user_role = TMM::get_option('default_user_role', TMM_APP_CARDEALER_PREFIX);
		if (empty($default_user_role)) {
			$default_user_role = 'subscriber';
		}
		return $default_user_role;
	}

	public static function get_default_user_role_options($user_id = 0) {
		if ($user_id == 0) {
			$user_role = self::get_default_user_role();
		} else {
			$user = new WP_User($user_id);
			if (!empty($user->roles)) {
				$user_role = array_shift($user->roles);
			} else {
				$user_role = self::get_default_user_role();
			}
		}

		$user_roles = self::get_user_roles();
		if ($user_role == 'subscriber') {
			$user_roles['subscriber'] = array();
			$user_roles['subscriber'] = $user_roles[self::get_default_user_role()];
		}

		if(!isset($user_roles[$user_role])){
			$user_roles[$user_role] = array();
		}else if(!is_array($user_roles[$user_role])){
			$user_roles[$user_role] = (array) $user_roles[$user_role];
		}
		return @array_merge($user_roles[$user_role], array('key' => $user_role));
	}

	public static function count_users_cars($user_id) {
		$args                   = array();
		$args['post_type']      = TMM_Ext_PostType_Car::$slug;
		$args['post_status']    = array( 'publish' );
		$args['author']         = $user_id;
		$args['posts_per_page'] = -1;

		if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
			$wpml_meta_query      = array(
				'key'     => '_icl_lang_duplicate_of',
				'value'   => '',
				'compare' => 'NOT EXISTS'
			);
			$args['meta_query'][] = $wpml_meta_query;
		}

		$query = new WP_Query( $args );
		$count = $query->found_posts;
		wp_reset_postdata();
		return $count;
	}

	public static function user_paid_money($paypal_data) {
		$message_num = 1;
		$key = $paypal_data['PAYMENTREQUEST_0_CUSTOM'];
		//check is packet was buy
		$roles = self::get_user_roles();
		if (!isset($roles[$key])) {
			$message_num = self::buy_features($paypal_data);
		} else {
			/* set user role */
			$packet_key = $paypal_data['PAYMENTREQUEST_0_CUSTOM'];
			$user_id = get_current_user_id();
			$wp_user_object = new WP_User($user_id);
			$wp_user_object->set_role($packet_key);
			$message_num = 1;
		}

		return $message_num;
	}

	public static function set_user_account($user_id, $packet_key, $old_roles) {
		$message_num = 1;
		$roles = self::get_user_roles();

		if (!$user_id) {
			$user_id = get_current_user_id();
		}

		/* check is packet key exists */
		if (!isset($roles[$packet_key])) {
			return 2;
		}

		global $wpdb;
		$now = time();
		$exp_date = $roles[$packet_key]['life_period'] != 0 ? floatval($roles[$packet_key]['life_period']) * 86400 + $now : 0;

		/* reset all user packets */
		$wpdb->query($wpdb->prepare("UPDATE tmm_cars_packets SET is_ended = %d WHERE user_id = %d", 1, $user_id));
		/* apply new packet to user */
		$wpdb->query($wpdb->prepare("INSERT INTO tmm_cars_packets (`user_id`, `packet_key`, `start_date`, `exp_date`) VALUES (%d, %s, %d, %d)", $user_id, $packet_key, $now, $exp_date));

		/* add packet features for user */
		$features_cars_count = intval($roles[$packet_key]['features_cars_count']);
		$time_length = intval($roles[$packet_key]['feature_car_life_time']) * 86400;
		if ($features_cars_count > 0) {
			for ($i = 0; $i < $features_cars_count; $i++) {
				$wpdb->query($wpdb->prepare("INSERT INTO tmm_cars_features (`user_id`, `time_length`) VALUES (%d, %d)", $user_id, $time_length));
			}
		}

		do_action( 'send_email_changed_user_role', $user_id, $roles[$packet_key]['name'] );

		return $message_num;
	}

	public static function send_email_changed_user_role($user_id, $packet_name) {

		/* Send email notification */
		if (tmm_allow_user_email($user_id, 'account_emails')) {

			global $tmm_config;
			$wp_user_object = new WP_User($user_id);
			$subject = __( TMM::get_option('paypal_email_packet_succ_subject', TMM_APP_CARDEALER_PREFIX), 'cardealer' );
			$message = __( TMM::get_option('paypal_email_packet_succ_message', TMM_APP_CARDEALER_PREFIX), 'cardealer' );

			if (empty($subject)) {
				$subject = $tmm_config['emails']['update_account']['subject'];
			}

			if (empty($message)) {
				$message = $tmm_config['emails']['update_account']['message'];
			}

			$message = str_replace(
				array('__USER__', '__PACKET_NAME__', '__SITENAME__'),
				array($wp_user_object->display_name, $packet_name, get_bloginfo('name')),
				$message );

			self::send_email($wp_user_object->user_email, $subject, $message);

		}

	}

	//user buy features adv for self
	public static function buy_features($paypal_data) {
		$message_num = 1;
		$packets = self::get_features_packets();
		$packet_key = $paypal_data['PAYMENTREQUEST_0_CUSTOM'];
		if (!isset($packets[$packet_key])) {
			$message_num = 2;
			return $message_num;
		}
		//*** check is user paid full price or wrong price
//		if ((float) $paypal_data['AMT'] !== (float) $packets[$packet_key]['packet_price']) {
//			$message_num = 3;
//			return $message_num;
//		}
		//***
		//***
		global $wpdb;
		$user_id = get_current_user_id();
		$time_length = intval($packets[$packet_key]['life_period']);
		if($time_length != 0){
			$time_length =  $time_length * 86400;
		}
		if ($packets[$packet_key]['count'] > 0) {
			for ($i = 0; $i < $packets[$packet_key]['count']; $i++) {
				$wpdb->query($wpdb->prepare("INSERT INTO tmm_cars_features (`user_id`, `time_length`) VALUES (%d, %d)", $user_id, $time_length));
			}
		}

		/* Send email notification */
		if (tmm_allow_user_email($user_id, 'account_emails')) {
			global $tmm_config;
			$user_obj = get_userdata($user_id);
			$email = $user_obj->user_email;

			$subject = __( TMM::get_option('purchase_bundle_subject', TMM_APP_CARDEALER_PREFIX), 'cardealer' );
			$message = __( TMM::get_option('purchase_bundle_message', TMM_APP_CARDEALER_PREFIX), 'cardealer' );

			if (empty($subject)) {
				$subject = $tmm_config['emails']['purchase_bundle']['subject'];
			}

			if (empty($message)) {
				$message = $tmm_config['emails']['purchase_bundle']['message'];
			}

			$message = str_replace(
				array('__USER__', '__BR__', '__FEATURES_NUM__', '__SITENAME__'),
				array($user_obj->display_name, "<br>", self::get_user_free_features_count($user_id), get_bloginfo('name')),
				$message );

			self::send_email($email, $subject, $message);
		}

		return $message_num;
	}

	public static function send_email($to, $subject, $message, $from = '') {
		$sended = false;

		if (!$from) {
			$from = get_bloginfo("admin_email");
		}
		/* set headers */
		$headers = 'From: '. $from . "\r\n";

		add_filter('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));
		add_filter('wp_mail_from_name', array(__CLASS__, 'set_mail_from_name'));

		if (wp_mail($to, $subject, $message, $headers)) {
			$sended = true;
		}

		remove_filter('wp_mail_content_type', array(__CLASS__, 'set_html_content_type'));
		remove_filter('wp_mail_from_name', array(__CLASS__, 'set_mail_from_name'));

		return $sended;
	}

	public static function set_mail_from_name($name) {
		return get_option('blogname');
	}

	public static function set_html_content_type() {
		return 'text/html';
	}

	//count how many times user can set car feature
	public static function get_user_free_features_count($user_id) {
		global $wpdb;
		$user_id = (int) $user_id;
		$count = $wpdb->get_var("SELECT COUNT( * ) FROM tmm_cars_features WHERE is_ended = 0 AND car_id = 0 AND user_id = $user_id");
		return $count;
	}

	public static function get_user_activated_features_count($user_id) {
		global $wpdb;
		$user_id = (int) $user_id;
		$count = $wpdb->get_var(
				"SELECT COUNT(*) 
					FROM $wpdb->posts p
					LEFT JOIN $wpdb->postmeta pm
						ON p.`ID` = pm.`post_id`
					WHERE p.post_author = ". $user_id ." AND p.post_type = '". TMM_Ext_PostType_Car::$slug ."' AND pm.meta_key = 'car_is_featured' AND pm.meta_value = '1' 
				");
		return $count;
	}
	
	public static function get_featured_packet_life_period() {
		global $wpdb;
		$user_id = (int) get_current_user_id();
		$res = $wpdb->get_var("SELECT `time_length` FROM `tmm_cars_features` WHERE `exp_date` = 0 AND car_id = 0 AND is_ended = 0 AND `user_id` = $user_id LIMIT 1");
		if($res){
			return $res;
		}
		return 0;
	}

	//ajax for admin only
	public static function set_user_car_as_featured() {
		$post_id = (int) $_POST['post_id'];
		$user_id = (int) get_current_user_id();
        $value = (int) $_POST['value'];

		if (!current_user_can('delete_posts')) {

			//check if user have free featured points
			if($value === 1 && self::get_user_free_features_count($user_id) > 0){

				global $wpdb;
				$res = $wpdb->get_results("SELECT * FROM tmm_cars_features WHERE exp_date = 0 AND car_id = 0 AND user_id = $user_id LIMIT 1");
				$res = $res[0];
				if($res->time_length != 0){
					$exp_date = $res->time_length  + time();
				}else{
					$exp_date = 0;
				}
				$wpdb->query($wpdb->prepare("UPDATE tmm_cars_features SET car_id = %d, exp_date = %d WHERE id = %d", $post_id, $exp_date, $res->id));

			}else{

				ob_clean();
				wp_die(-1);

			}
		}

		$result = TMM_Ext_PostType_Car::set_as_featured($post_id, $value);

		ob_clean();
		wp_die($result);
	}
	
	//Featured
	public static function get_features_packets() {
		$packets = TMM::get_option('features_packets', TMM_APP_CARDEALER_PREFIX);
		unset($packets[0]);
		return $packets;
	}

	//ajax
	/*
	 * Admin add new packet of featureds
	 */
	public static function add_features_packet() {
		$features_packet = array();
		$features_packet_id = uniqid(); //not integer!!
		$features_packet['name'] = $_REQUEST['name'];
		$features_packet['featured'] = 0;
		$features_packet['count'] = 1;
		$features_packet['life_period'] = 7;
		$features_packet['packet_price'] = 1;

		//***

		$res = array();
		$res['html'] = TMM::draw_free_page(TMM_Ext_Car_Dealer::get_application_path() . '/views/admin/features_packet.php', array('features_packet' => $features_packet, 'features_packet_id' => $features_packet_id));
		$res['packet_id'] = $features_packet_id;
		wp_die(json_encode($res));
	}

	public static function get_user_packet_exp_date($user_id) {
		global $wpdb;
		$exp_date = $wpdb->get_var($wpdb->prepare("SELECT exp_date FROM tmm_cars_packets WHERE exp_date != 0 AND is_ended = 0 AND user_id = %d LIMIT 1", $user_id));
		return $exp_date;
	}

}

//***
add_action('init', array('TMM_Cardealer_User', 'register'));
add_filter('user_contactmethods', array('TMM_Cardealer_User', 'new_contact_fields'), 10, 1);

