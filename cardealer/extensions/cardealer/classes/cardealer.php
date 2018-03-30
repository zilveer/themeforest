<?php

class TMM_Ext_Car_Dealer {

	public static $currencies_list = array();
	public static $default_currency = array();
	public static $opt_groups = array();

	public function __construct() {

	}

	public static function get_application_path() {
		return TMM_EXT_PATH . '/cardealer';
	}

	public static function get_application_uri() {
		return TMM_EXT_URI . '/cardealer';
	}

	public static function page_settings() {
		$data = array();
		echo TMM::draw_free_page(self::get_application_path() . '/views/admin/settings/settings.php', $data);
	}

	public static function init() {
		/* get options */
		$options = array();
		$def_options = TMM::get_option('default_options', TMM_APP_CARDEALER_PREFIX);
		self::$opt_groups = array(
			'transmission' => __('Transmission', 'cardealer'),
			'fuel_type' => __('Fuel Type', 'cardealer'),
			'body' => __('Car Bodies', 'cardealer'),
			'interior_color' => __('Interior Colors', 'cardealer'),
			'exterior_color' => __('Exterior Colors', 'cardealer'),
			'currency' => __('Currencies', 'cardealer'),
		);

		if (empty($def_options) || !is_array($def_options)) {
			include_once TMM_Ext_Car_Dealer::get_application_path() . "/options.php";
		} else {

			foreach (self::$opt_groups as $key => $value) {

				if (isset($def_options[$key])) {
					$options[$key] = $def_options[$key];
				} else {

					//compatibility
					if ($key === 'transmission' && !empty($def_options['transmissions'])) {
						$options[$key] = $def_options['transmissions'];
					} else if ($key === 'body' && !empty($def_options['car_bodies'])) {
						$options[$key] = $def_options['car_bodies'];
					} else if ($key === 'interior_color' && !empty($def_options['interior_colors'])) {
						$options[$key] = $def_options['interior_colors'];
					} else if ($key === 'exterior_color' && !empty($def_options['exterior_colors'])) {
						$options[$key] = $def_options['exterior_colors'];
					} else if ($key === 'currency' && !empty($def_options['currencies'])) {
						$options[$key] = $def_options['currencies'];
					}

				}

			}


			if (isset($options['currency']) && is_array($options['currency'])) {

				$temp_options = array();

				foreach ($options['currency'] as $value) {
					//todo: remove empty values
					$temp_options[$value['name']] = $value['symbol'];
				}

				$options['currency'] = $temp_options;

			}

		}

		$options['distance_units'] = array(
			'km' => __("Kilometres", 'cardealer'),
			'miles' => __("Miles", 'cardealer'),
		);

		$options['engine_capacity_units'] = array(
			'L' => __("Litres", 'cardealer'),
			'cm<sup>3</sup>' => __("Cubic Centimeters", 'cardealer'),
		);

		$options['min_doors_count'] = 2;
		$options['max_doors_count'] = 5;


		if (!empty($options)) {
			foreach ($options['currency'] as $key => $symb) {
				self::$currencies_list[$key]['name'] = $key;
				self::$currencies_list[$key]['symbol'] = $symb;
			}
		}

		self::$default_currency = self::get_default_currency();

		TMM_Ext_PostType_Car::register($options);
		TMM_Cardealer_Watermark::register();
		//set crones
		TMM_Ext_Car_Sheduler::init();

	}

	public static function admin_menu() {
		add_submenu_page('edit.php?post_type=' . TMM_Ext_PostType_Car::$slug, __("Locations", 'cardealer'), __("Locations", 'cardealer'), 'manage_options', 'tmm_cardealer_carlocation', array(__CLASS__, 'direct_to_carlocation'));
		add_submenu_page('edit.php?post_type=' . TMM_Ext_PostType_Car::$slug, __("Carproducers", 'cardealer'), __("Carproducers", 'cardealer'), 'manage_options', 'tmm_cardealer_carproducer', array(__CLASS__, 'direct_to_carproducer'));
		add_submenu_page('edit.php?post_type=' . TMM_Ext_PostType_Car::$slug, __("Car Dealer Settings", 'cardealer'), __("Settings", 'cardealer'), 'manage_options', 'tmm_cardealer_settings', array(__CLASS__, 'page_settings'));
	}

	public static function direct_to_carlocation() {
		$data = array();
		echo TMM::draw_free_page(self::get_application_path() . '/views/admin/carlocation.php', $data);
	}

	public static function direct_to_carproducer() {
		?>
		<script type="text/javascript">
			window.location.replace("<?php echo admin_url('edit-tags.php?post_type=' . TMM_Ext_PostType_Car::$slug . '&taxonomy=carproducer') ?>");
		</script>
	<?php
	}

	public static function admin_head() {
		wp_enqueue_script('tmm_cardealer_admin', TMM_EXT_URI . '/cardealer/js/admin/general.js');
		wp_enqueue_style('tmm_cardealer_admin', TMM_EXT_URI . '/cardealer/css/admin/styles.css');
		//*****
		TMM_Ext_PostType_Car::admin_head();
	}

	public static function admin_init() {
		TMM_Ext_PostType_Car::init_meta_boxes();
	}

	//ajax
	public static function save_settings() {

		$data = array();
		parse_str($_REQUEST['values'], $data);
		//test sending options using base64
//	    $t_values = base64_decode($_REQUEST['values']);
//      parse_str($t_values, $data);
		$data = TMM_Helper::db_quotes_shield($data);

		if (!empty($data)) {
			foreach ($data as $key => $value) {

				if ($key === 'default_options') {

					if (is_array($value)) {
						foreach ($value as $group_key => &$opts_list) {

							if (isset(TMM_Ext_PostType_Car::$car_options[$group_key]) && is_array($opts_list)) {
								$temp_list = array(); //for saving sort order of options

								foreach ($opts_list as $opt_key => $opt_value) {

									if (!isset(TMM_Ext_PostType_Car::$car_options[$group_key][$opt_key])) {
										$slug = sanitize_key($opt_value);

										if (!empty($slug)) {
											$slug = str_replace('-', '_', $slug);
										} else {
											$slug = $opt_key;
										}

										TMM_Ext_PostType_Car::$car_options[$group_key][$slug] = $opt_value;

									} else {
										$slug = $opt_key;
									}

									$temp_list[$slug] = $opt_value;

								}

								$opts_list = $temp_list;

							}

						}
					}

				}

				TMM::update_option($key, $value, TMM_APP_CARDEALER_PREFIX);
			}
		}

		TMM_Ext_Car_Sheduler::convert_curency_sheduler();

		ob_clean();
		_e('Options have been saved.', 'cardealer');
		exit;
	}

	public static function manage_users_custom_column($value, $column_name, $id) {
		if ($column_name == 'group') {
			$data = array();
			//$data['groups'] = self::get_users_groups();
			//$data['users_groups'] = self::user_get_groups($id);
			$data['user_id'] = $id;

			//return TMM::draw_free_page(self::get_application_path() . '/views/user_groups_form.php', $data);
		}
	}

	//add columns to User panel list page
	public static function manage_users_columns($defaults) {
		$defaults['cardealer_user_role'] = __('User Role', 'cardealer');
		return $defaults;
	}

	public static function get_default_currency() {
		$default_currency = TMM::get_option('default_currency', TMM_APP_CARDEALER_PREFIX);
		if (empty($default_currency)) {
			$default_currency = 'USD';
		}

		return self::$currencies_list[$default_currency];
	}

	public static function get_locations_max_level() {
		//$locations_max_level = TMM::get_option('locations_max_level', TMM_APP_CARDEALER_PREFIX);
		$locations_max_level=3;
		if (!$locations_max_level) {
			$locations_max_level = 2;
		}

		return $locations_max_level;
	}

	//ajax
	public static function base64_encode() {
		echo base64_encode($_REQUEST['params_string']);
		exit;
	}

	//ajax
	public static function draw_tax_select() {
		$vals = array();
		$req = false;

		if (isset($_REQUEST['vals'])) {
			$vals = $_REQUEST['vals'];
		}
		if (isset($_REQUEST['required'])) {
			$req = $_REQUEST['required'];
		}

		TMM_Helper::draw_tax_terms_select($_REQUEST['tax'], $_REQUEST['name'], $_REQUEST['id'], $_REQUEST['args'], $vals, $req);
		exit;
	}

	public static function draw_locations_select($data = array()) {

		if (isset($_REQUEST['parent_id'])) {
			$data = $_REQUEST;
		}
		$terms = TMM_Ext_PostType_Car::get_locations($data['parent_id']);
		?>

		<?php if( !isset($data['container']) || $data['container'] === true ) { ?>
			<label class="sel">
		<?php } ?>

		<?php
		$class = isset($data['class']) ? ' class="'.$data['class'].'"' : '';
		$id = isset($data['id']) ? ' id="'.$data['id'].'"' : '';
		if(!isset($data['selected']) || !$data['selected']){
			$data['selected'] = 0;
		}
		?>

		<select<?php echo $class ?><?php echo $id ?> name="<?php echo $data['name'] ?>" <?php echo (isset($data['required']) && $data['required']==1) ? ' data-required="1"' : ''; ?>>
			<option <?php selected($data['selected'], 0); ?> value=""><?php _e('None', 'cardealer'); ?></option>
			<?php foreach ($terms as $term): ?>
				<option value="<?php echo $term->id ?>" <?php selected($term->id, $data['selected']); ?>><?php _e($term->name, 'cardealer'); ?></option>
			<?php endforeach; ?>
		</select>

		<?php if( !isset($data['container']) || $data['container'] === true ) { ?>
			</label>
		<?php } ?>

		<?php
		//if ajax
		if (isset($_REQUEST['parent_id'])) {
			exit;
		}
	}

	//ajax
	public static function import_cardealer_settings() {
		$options = array(
			'car_adv_desc_signs_count' => 512,
			'show_button_details' => 1,
			'show_layout_switcher' => 1,
			'watchlist_is_for_loggedin' => 0,
			'show_car_viewing' => 1,
			'cardealer_max_images_size' => 5,
			'time_to_draft_sold_cars' => 7,
			'default_currency' => 'USD',
			'locations_max_level' => 3,
			'locations_captions_on_search_widget' => 'Location,Location 2,Location 3',
			'locations_show_empty_search_widget' => 0,
			'producers_show_empty_search_widget' => 0
		);

		foreach ($options as $key => $value) {
			TMM::update_option($key, $value, TMM_APP_CARDEALER_PREFIX);
		}

		//*** pages
		$pages = array(
			'welcome-to-car-dealer' => array(__('Welcome to CarDealer', 'cardealer'), 'user_login_page', 'template-car-user-login.php'),
			'user-profile' => array(__('User profile', 'cardealer'), 'user_profile_page', 'template-car-user-profile.php'),
			'users-cars' => array(__('Users cars', 'cardealer'), 'user_cars_page', 'template-car-user-cars.php'),
			'add-new-car' => array(__('Add new car', 'cardealer'), 'user_add_new_car', 'template-car-add-new.php'),
			'edit-car' => array(__('Edit car', 'cardealer'), 'edit_page', 'template-car-edit.php'),
			'dealer-page' => array(__('Dealer page', 'cardealer'), 'dealers_page', 'template-car-user-dealer.php'),
			'cars-listing' => array(__('Cars listing', 'cardealer'), 'searching_page', 'template-car-listing.php'),
			'status-upgrade' => array(__('Status upgrade', 'cardealer'), 'upgrade_status_page', 'template-car-user-status-up.php'),
			'compare' => array(__('Compare', 'cardealer'), '', 'template-car-compare.php'),
			'watch-list' => array(__('Watch list', 'cardealer'), '', 'template-car-watch-list.php'),
			'paypal-transaction-success' => array(__('PayPal Transaction Success', 'cardealer'), '', 'template-car-user-paypal-success.php'),
			'paypal-transaction-failed' => array(__('PayPal Transaction Failed', 'cardealer'), '', 'template-car-user-paypal-failed.php'),
		);

		foreach ($pages as $key => $post) {
			if (!is_page($key)) {
				$defaults = array('post_status' => 'publish', 'post_type' => 'page', 'post_name' => $key, 'post_title' => $post[0]);
				$post_ID = wp_insert_post($defaults);
				TMM::update_option($post[1], home_url() . '/' . $defaults['post_name'], TMM_APP_CARDEALER_PREFIX);
				update_post_meta($post_ID, '_wp_page_template', $post[2]);
				update_post_meta($post_ID, 'page_sidebar_position', 'no_sidebar');

				//***
				if ($key == 'paypal-transaction-success') {
					update_option('paypal_success_page', $post_ID);
				}

				if ($key == 'paypal-transaction-failed') {
					update_option('paypal_cancel_page', $post_ID);
				}
			}
		}
		//***
		TMM::update_option('distance_unit', 'km', TMM_APP_CARDEALER_PREFIX);
		TMM::update_option('engine_capacity_unit', 'L', TMM_APP_CARDEALER_PREFIX);


		//*** contact form on single car page
		$contact_form = array();
		$contact_form[1] = array();
		$contact_form[1]['inique_id'] = 1;
		$contact_form[1]['title'] = 'carcontacts';
		$contact_form[1]['has_capture'] = 1;
		$contact_form[1]['inputs'][1]['type'] = 'email';
		$contact_form[1]['inputs'][1]['label'] = 'Email';
		$contact_form[1]['inputs'][1]['is_required'] = 1;
		$contact_form[1]['inputs'][2]['type'] = 'messagebody';
		$contact_form[1]['inputs'][2]['label'] = __('Your message', 'cardealer');
		$contact_form[1]['inputs'][2]['is_required'] = 1;
		TMM::update_option('contact_form', $contact_form);

		//*** Default Packet
		$def_packet = array();
		$def_packet['cc6153'] = array();
		$def_packet['cc6153']['name'] = __('Default Dealer Type', 'cardealer');
		$def_packet['cc6153']['life_period'] = 0;
		$def_packet['cc6153']['packet_price'] = 0;
		$def_packet['cc6153']['max_cars'] = 2;
		$def_packet['cc6153']['max_images_size'] = 5;
		$def_packet['cc6153']['features_cars_count'] = 0;
		$def_packet['cc6153']['feature_car_life_time'] = 0;
		TMM::update_option('user_roles', $def_packet, TMM_APP_CARDEALER_PREFIX);
		TMM::update_option('default_user_role', 'cc6153', TMM_APP_CARDEALER_PREFIX);
		global $wpdb;
		$wpdb->query("UPDATE $wpdb->options SET option_value='cc6153' WHERE option_name = 'default_role'");

		//***
		TMM::update_option('import_cardealer_settings_done', 1, TMM_APP_CARDEALER_PREFIX);
		exit;
	}

}