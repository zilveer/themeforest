<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Ext_Car_Sheduler {

	public static function init() {
		add_filter('cron_schedules', array(__CLASS__, 'cron_schedules'));

		/* Remove temp images */
		add_action('tmp_images_sheduler', array(__CLASS__, 'tmp_images_sheduler'));
		if (!wp_next_scheduled('tmp_images_sheduler')) {
			wp_schedule_event(time(), 'daily', 'tmp_images_sheduler');
		}

		/* Set sold cars as draft */
		add_action('sold_cars_sheduler', array(__CLASS__, 'sold_cars_sheduler'));
		$sold_cars_option = (int) TMM::get_option('time_to_draft_sold_cars', TMM_APP_CARDEALER_PREFIX);
		$schedules =  wp_get_schedules();
		$sold_cars_interval = (int) $schedules['time_to_draft_sold_cars']['interval'];
		if($sold_cars_option*86400 !== $sold_cars_interval){
			wp_clear_scheduled_hook('sold_cars_sheduler');
		}
		if (!wp_next_scheduled('sold_cars_sheduler')) {
			wp_schedule_event(time(), 'time_to_draft_sold_cars', 'sold_cars_sheduler');
		}

		/* Unfeature cars */
		add_action('unfeature_cars_sheduler', array(__CLASS__, 'unfeature_cars_sheduler'));
		if (!wp_next_scheduled('unfeature_cars_sheduler')) {
			wp_schedule_event(time(), 'time_to_unfeature_cars', 'unfeature_cars_sheduler');
		}

		/* Set user account to default */
		add_action('enduser_packet_cars_sheduler', array(__CLASS__, 'enduser_packet_cars_sheduler'));
		$enduser_packet_interval = wp_get_schedule('enduser_packet_cars_sheduler');
		if($enduser_packet_interval != 'hourly'){
			wp_clear_scheduled_hook('enduser_packet_cars_sheduler');
		}
		if (!wp_next_scheduled('enduser_packet_cars_sheduler')) {
			wp_schedule_event(time(), 'hourly', 'enduser_packet_cars_sheduler');
		}

		/* Update currencies rates */
		add_action('convert_curency_sheduler', array(__CLASS__, 'convert_curency_sheduler'));
		if (!wp_next_scheduled('convert_curency_sheduler')) {
			wp_schedule_event(time(), 'twicedaily', 'convert_curency_sheduler');
		}

		return true;
	}

	/*
	 * time_to_draft_sold_cars
	 * time_to_unfeature_cars
	 *
	 */

	//hook
	public static function cron_schedules($schedules) {
		$time_interval = (int) TMM::get_option('time_to_draft_sold_cars', TMM_APP_CARDEALER_PREFIX); //days
		if (!$time_interval) {
			$time_interval = 7; //1 week
		}
		$schedules['time_to_draft_sold_cars'] = array(
			'interval' => $time_interval * 86400,
			'display' => $time_interval . ' ' . __('days', 'cardealer')
		);
		//***
		$schedules['time_to_unfeature_cars'] = array(
			'interval' => 6 * 60, //six hours
			'display' => 6 . ' ' . __('hours', 'cardealer')
		);
		//***
		return $schedules;
	}

	//*****

	public static function tmp_images_sheduler() {
		array_map('unlink', glob(TMM_Ext_PostType_Car::get_image_upload_folder() . "tmp_watermark/*"));
		//***
		$res = scandir(TMM_Ext_PostType_Car::get_image_upload_folder());
		foreach ($res as $key => $value) {
			$tmp = (int) $value;
			if (!is_integer($tmp) OR $tmp == 0) {
				unset($res[$key]);
			}
		}
		//***
		if (!empty($res)) {
			foreach ($res as $folder_name) {
				TMM_Helper::delete_dir(TMM_Ext_PostType_Car::get_image_upload_folder() . $folder_name . "/tmp/");
			}
		}

		return true;
	}

	//*****

	public static function sold_cars_sheduler() {
		global $wpdb;
		$meta_query_array = array();

		$meta_query_array[] = array(
			'key' => 'car_is_sold',
			'value' => 1,
			'type' => 'numeric',
			'compare' => '='
		);


		$args = array(
			'post_type' => TMM_Ext_PostType_Car::$slug,
			'meta_query' => $meta_query_array,
			'post_status' => array('publish'),
			'posts_per_page' => -1,
		);
		$query = new WP_Query($args);
		$posts = $wpdb->get_results($query->request, ARRAY_A);

		if (!empty($posts)) {
			foreach ($posts as $post) {
				$wpdb->query("UPDATE {$wpdb->posts} SET post_status='draft' WHERE post_type='" . TMM_Ext_PostType_Car::$slug . "' AND ID=" . $post['ID']);
			}
		}

		wp_reset_postdata();

		return true;
	}

	public static function unfeature_cars_sheduler() {
		global $wpdb;
		$now = time();
		$res = $wpdb->get_results("SELECT id, car_id FROM tmm_cars_features WHERE exp_date > 0 AND exp_date < $now AND is_ended = 0");
		if (!empty($res)) {
			foreach ($res as $item) {
				$wpdb->query($wpdb->prepare("UPDATE tmm_cars_features SET is_ended = 1 WHERE id = %d", $item->id));
				update_post_meta($item->car_id, 'car_is_featured', 0);
			}
		}

		return true;
	}

	/**
	 * Check user accounts expiration
	 */
	public static function enduser_packet_cars_sheduler() {
		global $wpdb, $tmm_config;
		$roles = TMM_Cardealer_User::get_user_roles();
		$now = time();

		/*
		 * Check user accounts expiration before a week
		 */
		$before_week_max = $now + 7*24*60*60;
		$before_week_min = $now + 7*23*60*60;
		$res = $wpdb->get_results("SELECT id, user_id, packet_key FROM tmm_cars_packets WHERE exp_date != 0 AND exp_date < $before_week_max AND exp_date >= $before_week_min AND is_ended = 0");

		if (!empty($res)) {

			foreach ($res as $item) {
				/* Send email notification to user */
				$wp_user_object = new WP_User($item->user_id);

				if (tmm_allow_user_email($wp_user_object->ID, 'account_emails')) {
					$subject = __( TMM::get_option('reset_account_before_week_subject', TMM_APP_CARDEALER_PREFIX), 'cardealer' );
					$message = __( TMM::get_option('reset_account_before_week_message', TMM_APP_CARDEALER_PREFIX), 'cardealer' );

					if (empty($subject)) {
						$subject = $tmm_config['emails']['reset_account_before_week']['subject'];
					}

					if (empty($message)) {
						$message = $tmm_config['emails']['reset_account_before_week']['message'];
					}

					$message = str_replace(
						array('__USER__', '__PACKET_NAME__', '__SITENAME__'),
						array($wp_user_object->display_name, $roles[$item->packet_key]['name'], get_bloginfo('name')),
						$message );

					TMM_Cardealer_User::send_email($wp_user_object->user_email, $subject, $message);
				}

			}
		}

		/*
		 * Check user accounts expiration before one day
		 */
		$before_day_max = $now + 1*24*60*60;
		$before_day_min = $now + 1*23*60*60;
		$res = $wpdb->get_results("SELECT id, user_id, packet_key FROM tmm_cars_packets WHERE exp_date != 0 AND exp_date < $before_day_max AND exp_date >= $before_day_min AND is_ended = 0");

		if (!empty($res)) {

			foreach ($res as $item) {
				/* Send email notification to user */
				$wp_user_object = new WP_User($item->user_id);

				if (tmm_allow_user_email($wp_user_object->ID, 'account_emails')) {
					$subject = __( TMM::get_option('reset_account_before_day_subject', TMM_APP_CARDEALER_PREFIX), 'cardealer' );
					$message = __( TMM::get_option('reset_account_before_day_message', TMM_APP_CARDEALER_PREFIX), 'cardealer' );

					if (empty($subject)) {
						$subject = $tmm_config['emails']['reset_account_before_day']['subject'];
					}

					if (empty($message)) {
						$message = $tmm_config['emails']['reset_account_before_day']['message'];
					}

					$message = str_replace(
						array('__USER__', '__PACKET_NAME__', '__SITENAME__'),
						array($wp_user_object->display_name, $roles[$item->packet_key]['name'], get_bloginfo('name')),
						$message );

					TMM_Cardealer_User::send_email($wp_user_object->user_email, $subject, $message);
				}

			}
		}

		/*
		 * Check user accounts ending
		 */
		$res = $wpdb->get_results("SELECT id, user_id, packet_key FROM tmm_cars_packets WHERE exp_date != 0 AND exp_date < $now AND is_ended = 0");

		if (!empty($res)) {

			foreach ($res as $item) {

				if (user_can($item->user_id, 'manage_options')) {
					continue;
				}

				/* set user status as default */
				$wpdb->query($wpdb->prepare("UPDATE tmm_cars_packets SET is_ended = 1 WHERE id = %d", $item->id));
				$wp_user_object = new WP_User($item->user_id);
				$wp_user_object->set_role(TMM_Cardealer_User::get_default_user_role());

				$default_packet_options = TMM_Cardealer_User::get_default_user_role_options();
				$allowed_max_cars_count = (int) $default_packet_options['max_cars'];

				/* set user posts as drafts */
				$posts = $wpdb->get_results("SELECT `ID` FROM {$wpdb->posts} WHERE post_author = ". $item->user_id ." AND post_type='" . TMM_Ext_PostType_Car::$slug . "' ORDER BY post_modified DESC");
				$user_featured_cars = $wpdb->get_results("SELECT `car_id` FROM tmm_cars_features WHERE exp_date > $now AND user_id = ". $item->user_id ." ORDER BY exp_date DESC", ARRAY_A);
				$cars_ids = array();

				if (!empty($posts)) {
					if($allowed_max_cars_count < count($posts)){

						if ($allowed_max_cars_count > 0) {

							if(!empty($user_featured_cars)){
								for($i=0;$i<$allowed_max_cars_count;$i++) {
									$temp = (int) $user_featured_cars[$i]['car_id'];
									if($temp !== 0 && !in_array($temp,$cars_ids)){
										$cars_ids[] = $temp;
									}
								}
							}

							if(count($cars_ids) < $allowed_max_cars_count){
								$i = 0;
								$pc = count($posts);
								while($i<$pc){
									$temp = (int) $posts[$i]->ID;
									if(!in_array($temp,$cars_ids)){
										$cars_ids[] = $temp;
										if(count($cars_ids) == $allowed_max_cars_count){
											break;
										}
									}
									$i++;
								}
							}

						}

						$query = "UPDATE {$wpdb->posts} SET `post_status` = 'draft' WHERE `post_author` = ". (int) $item->user_id;

						if (!empty($cars_ids)) {
							$query .= " AND  `ID` NOT IN (". implode(',', $cars_ids) .")";
						}

						$wpdb->query($query);

					}
				}

				/* Send email notification to user */
				if (tmm_allow_user_email($wp_user_object->ID, 'account_emails')) {
					$subject = __( TMM::get_option('message_packet_reset_subject', TMM_APP_CARDEALER_PREFIX), 'cardealer' );
					$message = __( TMM::get_option('message_packet_reset', TMM_APP_CARDEALER_PREFIX), 'cardealer' );

					if (empty($subject)) {
						$subject = $tmm_config['emails']['reset_account']['subject'];
					}

					if (empty($message)) {
						$message = $tmm_config['emails']['reset_account']['message'];
					}

					$message = str_replace(
						array('__USER__', '__PACKET_NAME__', '__SITENAME__'),
						array($wp_user_object->display_name, $roles[$item->packet_key]['name'], get_bloginfo('name')),
						$message );

					TMM_Cardealer_User::send_email($wp_user_object->user_email, $subject, $message);
				}

			}
		}

		return true;
		//return $cars_ids;
	}

	public static function convert_curency_sheduler(){
		$result = array();
		$default_currency = TMM::get_option('default_currency', TMM_APP_CARDEALER_PREFIX);
		$convert_currencys_to = TMM::get_option('convert_currency_to', TMM_APP_CARDEALER_PREFIX);

		if (!empty($convert_currencys_to)) {
			foreach ($convert_currencys_to as $key => $convertable_currency) {
				if ($convertable_currency == '1') {
					$result[$key] = tmm_get_currency_rate(1000, strtoupper($default_currency), strtoupper($key));
				}
			}
		}

		TMM::update_option('actual_exchange_rates', $result, TMM_APP_CARDEALER_PREFIX);
	}

}
