<?php

/**
 * Retrieve a car option
 * @param $type
 * @param string $post_id
 *
 * @return string|void
 */
if (!function_exists('tmm_get_car_option')) {

	function tmm_get_car_option($type, $post_id = '') {
		$value = '';

		if (!$post_id) {
			global $post;
			$post_id = $post->ID;

			if ($post->post_type !== TMM_Ext_PostType_Car::$slug) {
				return $value;
			}
		}

		if (empty($post_id)) {
			return $value;
		}

		$options = isset(TMM_Ext_PostType_Car::$car_options[$type]) ? TMM_Ext_PostType_Car::$car_options[$type] : array();

		if ($type === 'interior_color') { //quick fix for wrong meta name
			$type = 'interrior_color';
		}

		$post_meta = get_post_meta($post_id, 'car_'.$type, 1);

		if (isset($options[$post_meta])) {
			$value = __( $options[$post_meta], 'cardealer' );
		} else if ($post_meta) {
			$value = __( $post_meta, 'cardealer' );
		}

		return $value;
	}

}

/**
 * Retrieve a car condition
 *
 * @param $post_id
 * * @param string $placeholder
 *
 * @return string|void
 */
if (!function_exists('tmm_get_car_condition')) {

	function tmm_get_car_condition($post_id, $placeholder = '') {

		if (empty($post_id)) {
			return $placeholder;
		}

		$condition = tmm_get_car_option('condition', $post_id);

		/* compatibility with older version */
		if (empty($condition)) {

			if ( get_post_meta($post_id, 'car_is_new', 1) ) {
				$condition = __('new', 'cardealer');
			} else if ( get_post_meta($post_id, 'car_is_damaged', 1) ) {
				$condition = __('damaged', 'cardealer');
			} else if ( get_post_meta($post_id, 'used_car', 1) ) {
				$condition = __('used', 'cardealer');
			}

			if (empty($condition)) {
				$condition = $placeholder;
			}

		} else {

			if (empty($condition)) {
				$condition = $placeholder;
			} else {
				$condition = __($condition, 'cardealer');
			}

		}

		return $condition;
	}

}

/**
 * Retrieve a car mileage
 *
 * @param $post_id
 * @param $placeholder
 *
 * @return string
 */
if (!function_exists('tmm_get_car_mileage')) {

	function tmm_get_car_mileage($post_id, $placeholder = '') {

		if (empty($post_id)) {
			return $placeholder;
		}

		$mileage = (int) tmm_get_car_option('mileage', $post_id);

		if (!empty($mileage)) {
			$mileage = $mileage . ' ' . __( TMM::get_option('distance_unit', TMM_APP_CARDEALER_PREFIX), 'cardealer' );
		} else {
			return $placeholder;
		}

		return $mileage;
	}

}

/**
 * Retrieve a car engine
 *
 * @param $post_id
 * @param $additional
 *
 * @return string
 */
if (!function_exists('tmm_get_car_engine')) {

	function tmm_get_car_engine($post_id, $placeholder = '', $additional = false, $separator = ', ') {

		if (empty($post_id)) {
			return $placeholder;
		}

		$engine = esc_html( tmm_get_car_option('engine_size', $post_id) );

		if (!empty($engine)) {
			$unit = TMM::get_option('engine_capacity_unit', TMM_APP_CARDEALER_PREFIX);

			if ( $unit === 'L' && strpos($engine, '.') === false ) {
				$engine .= '.0';
			}

			$engine = $engine . $unit;

			if ($additional) {
				$additional_val = tmm_get_car_option('engine_additional', $post_id);

				if ($additional_val) {
					$engine .= $separator . esc_html__( $additional_val, 'cardealer' );
				}

			}
		} else {
			return $placeholder;
		}

		return $engine;
	}

}

/**
 * Retrieve a car title
 * @param $post_id
 * @param bool $echo
 *
 * @return mixed|string
 */
if (!function_exists('tmm_get_car_title')) {

	function tmm_get_car_title($post_id, $echo = false) {
		$title = get_the_title($post_id);
		$car_data   = TMM_Ext_PostType_Car::get_car_data($post_id);
		$truncate = (int) TMM::get_option( 'car_title_symbols_limit', TMM_APP_CARDEALER_PREFIX );
		$car_producer = explode( '/', $car_data['car_producer'] );
		$def_title = '';

		if (!empty($car_producer[0])) {
			$def_title .= $car_producer[0] . ' ';
		}

		if (!empty($car_producer[1])) {
			$def_title .= $car_producer[1] . ' ';
		}

		if (!empty($car_data['car_year'])) {
			$def_title .= (int) $car_data['car_year'];
		}

		if ( TMM::get_option( 'allow_custom_title', TMM_APP_CARDEALER_PREFIX ) !== '1' || !$title || $title === $def_title ) {
			$year = (int) $car_data['car_year'];
			$title = str_replace($year, '', $def_title);
			$title = rtrim($title, '\'') . ' \'' . $year;
		} else {
			$title = wp_kses_data($title);

			if ($truncate) {
				$title = mb_substr($title, 0, $truncate);
			}
		}

		if ($echo) {
			echo $title;
		} else {
			return $title;
		}
	}

}

/**
 * Retrieve a car price
 * @param $post_id
 * @param bool $echo
 *
 * @return float|mixed|string
 */
if (!function_exists('tmm_get_car_price')) {

	function tmm_get_car_price($post_id, $echo = false, $value_only = false) {
		$price = '';
		$currency_pos = TMM::get_option( 'car_price_symbol_pos', TMM_APP_CARDEALER_PREFIX );
		$thousand_sep = TMM::get_option( 'car_price_thousand_separator', TMM_APP_CARDEALER_PREFIX );
		$thousand_sep = $thousand_sep === 'dot' ? '.' : ',';
		$desimal_sep = '.';
		$price_val = get_post_meta($post_id, 'car_price', 1);

		if ($value_only) {
			$price = $price_val;
		} else {

			if (!empty($price_val)) {

				$price_val = doubleval($price_val);
				$price_val = number_format($price_val, 0, $desimal_sep, $thousand_sep);

				if ($currency_pos === 'right' || $currency_pos === 'right_space') {
					$price .= $price_val;

					if ($currency_pos === 'right_space') {
						$price .= ' ';
					}

					$price .= TMM_Ext_Car_Dealer::$default_currency['symbol'];
				} else {
					$price .= TMM_Ext_Car_Dealer::$default_currency['symbol'];

					if ($currency_pos === 'left_space') {
						$price .= ' ';
					}

					$price .= $price_val;
				}

			} else {
				$price = __('Negotiable', 'cardealer');
			}

		}

		if ($echo) {
			echo $price;
		} else {
			return $price;
		}
	}

}

/**
 * Retrieve car cover image,
 * depending on image folder and sidebar position (car slider)
 *
 * @param $post_id
 * @param string $folder
 * @param bool $sidebar
 *
 * @return string
 */
if (!function_exists('tmm_get_car_cover_image')) {

	function tmm_get_car_cover_image($post_id, $folder = 'main', $sidebar = true) {
		return TMM_Car_Image::get_cover_image($post_id, $folder, $sidebar);
	}

}

/**
 * Display a similar cars to current post
 * @param $current_post_id
 * @param int $count
 */
if (!function_exists('tmm_get_similar_cars')) {

	function tmm_get_similar_cars($current_post_id, $count = 3) {
		global $wp_query;
		$original_query = $wp_query;

		$args = array(
			'post_type'      => TMM_Ext_PostType_Car::$slug,
			'post_status'    => array( 'publish' ),
			'orderby'        => 'post_date',
			'order'          => 'DESC',
			'meta_query'     => array(),
		);

		$wpml_meta_query = array();
		if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
			$wpml_meta_query      = array(
				'key'     => '_icl_lang_duplicate_of',
				'value'   => '',
				'compare' => 'NOT EXISTS'
			);
		}

		$similar_cars_params = TMM::get_option( 'similar_cars_params', TMM_APP_CARDEALER_PREFIX );

		if ( ! empty( $similar_cars_params ) ) {
			$taken_ids = array( $current_post_id );
			$ids_left  = $count;
			$car_data   = TMM_Ext_PostType_Car::get_car_data($current_post_id);
			$user_id    = get_post_field( 'post_author', $current_post_id );

			foreach ( $similar_cars_params as $key => $param ) {

				if ( $ids_left <= 0 ) {
					break;
				}

				unset( $args['meta_query'] );
				unset( $args['carproducer'] );
				unset( $args['author'] );

				$args['posts_per_page'] = $ids_left;
				$args['post__not_in']   = $taken_ids;
				$args['meta_query'] = array( $wpml_meta_query );

				if ( $key === 'engine_size' ) {
					if ( empty( $car_data['car_engine_size'] ) ) {
						continue;
					}
					$args['meta_query'] = array(
						array(
							'key'   => 'car_engine_size',
							'value' => $car_data['car_engine_size'],
						)
					);
				} else if ( $key === 'year' ) {
					if ( empty( $car_data['car_year'] ) ) {
						continue;
					}
					$args['meta_query'] = array(
						array(
							'key'   => 'car_year',
							'value' => $car_data['car_year'],
						)
					);
				} else if ( $key === 'location' ) {
					if ( empty( $car_data['car_carlocation'] ) || empty( $car_data['car_carlocation'][0] ) ) {
						continue;
					}

					$args['meta_query']             = array();
					$args['meta_query']['relation'] = 'OR';

					if ( ! empty( $car_data['car_carlocation'][2] ) ) {
						$args['meta_query'][] =
							array(
								'key'   => 'car_carlocation_3',
								'value' => $car_data['car_carlocation'][2],
							);
					}

					if ( ! empty( $car_data['car_carlocation'][1] ) ) {
						$args['meta_query'][] = array(
							'key'   => 'car_carlocation_2',
							'value' => $car_data['car_carlocation'][1],
						);
					}

					$args['meta_query'][] = array(
						'key'   => 'car_carlocation_1',
						'value' => (int) $car_data['car_carlocation'][0],
					);

				} else if ( $key === 'dealer_cars' ) {
					$args['author'] = $user_id;
				} else if ( $key === 'make' ) {
					$args['carproducer'] = isset( $car_data['car_producer_data'][0] ) ? $car_data['car_producer_data'][0]->slug : '';
				}

				if ( ! defined( 'ICL_LANGUAGE_CODE' ) ) {
					$args['meta_query'][] = $wpml_meta_query;
				}

				$wp_query  = new WP_Query( $args );
				global $post;
				$posts_ids = array();

				if ( have_posts() ) {

					while ( have_posts() ) {
						the_post();
						$posts_ids[]        = $post->ID;
						$GLOBALS['post_id'] = $post->ID;
						get_template_part( 'article', 'car' );
					}

				}

				$taken_ids = array_merge( $taken_ids, $posts_ids );
				$ids_left -= count( $posts_ids );
			}

		}

		$wp_query = $original_query;
		wp_reset_postdata();

	}

}

/**
 * Check file existing in uploads folder by file url
 * @param $file_url
 *
 * @return bool
 */
if (!function_exists('tmm_uploads_file_exists')) {

	function tmm_uploads_file_exists($file_url) {
		$path = wp_upload_dir();
		$temp = explode('wp-content/uploads', $file_url);
		$file_path = $path['basedir'] . $temp[1];

		if (file_exists($file_path) && is_file($file_path)) {
			return true;
		}

		return false;
	}

}

/**
 * Check whether send email to user or not
 * @param $user_id
 * @param $type
 *
 * @return int
 */
if (!function_exists('tmm_allow_user_email')) {

	function tmm_allow_user_email($user_id, $type) {
		$check = get_user_meta($user_id, $type, true) !== '0' ? 1 : 0;
		return $check;
	}

}

/**
 * Convert amount from default to selected currencies.
 * Retrieves by ajax request.
 */
if (!function_exists('tmm_convert_curency')) {

	function tmm_convert_curency() {
		$response = array();
		$from = preg_replace('/(\D)+/', '', $_POST['from']);
		$currency_rates = TMM::get_option('actual_exchange_rates', TMM_APP_CARDEALER_PREFIX);

		foreach ($currency_rates as $key => $value){
			$response[$key] = round($value*$from/1000, 2);
			$response[$key] = number_format($response[$key], 0, '.', ',');
		}

		echo json_encode($response);
		exit;
	}

}

/**
 * Get currency exchange rate using online service
 * @param int $amount
 * @param string $from
 * @param string $to
 *
 * @return float|string
 */
if (!function_exists('tmm_get_currency_rate')) {

	function tmm_get_currency_rate($amount, $from, $to) {
		$amount = urlencode($amount);
		$from = urlencode($from);
		$to = urlencode($to);
		$url = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";

		if ($from === $to) {
			return $amount;
		}

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$rawdata = curl_exec($ch);
		curl_close($ch);

		$data = explode('bld>', $rawdata);

		if (!empty($data[1])) {
			$data[1] = (float) $data[1];
			return round($data[1], 2);
		}

		return "This application is temporarily over its serving quota";
	}

}

if (!function_exists('tmm_get_car_listing_layout_type')) {

	function tmm_get_car_listing_layout_type($post_id = 0) {

		if (!$post_id) {
			global $post;
			$post_id = $post->ID;
		}

		$layout_type = 'item-grid';

		if (TMM::get_option('show_layout_switcher', TMM_APP_CARDEALER_PREFIX)) {

			if ( isset( $_COOKIE['car_listing_layout_mode_' . $post_id] ) ) {
				$layout_type = $_COOKIE['car_listing_layout_mode_' . $post_id];
			}

		} else {

			if ( TMM::get_option('car_listing_layout_mode', TMM_APP_CARDEALER_PREFIX) === 'list' ) {
				$layout_type = 'item-list';
			}

		}

		return $layout_type;

	}

}