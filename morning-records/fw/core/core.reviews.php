<?php
/**
 * Morning records Framework: Reviews support
 *
 * @package	morning_records
 * @since	morning_records 1.0
 */

// Theme init
if (!function_exists('morning_records_reviews_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_reviews_theme_setup' );
	function morning_records_reviews_theme_setup() {
		// Get reviews criterias list from categories list (ids)
		add_action('wp_ajax_check_reviews_criterias',			'morning_records_reviews_check_criterias');
		add_action('wp_ajax_nopriv_check_reviews_criterias',	'morning_records_reviews_check_criterias');

		// Accept user's votes
		add_action('wp_ajax_reviews_users_accept',				'morning_records_reviews_accept_user_marks');
		add_action('wp_ajax_nopriv_reviews_users_accept',		'morning_records_reviews_accept_user_marks');
	}
}

// Get reviews criterias list from categories list (ids)
if ( !function_exists( 'morning_records_reviews_check_criterias' ) ) {
	//add_action('wp_ajax_check_reviews_criterias', 'morning_records_reviews_check_criterias');
	//add_action('wp_ajax_nopriv_check_reviews_criterias', 'morning_records_reviews_check_criterias');
	function morning_records_reviews_check_criterias() {
		if ( !wp_verify_nonce( morning_records_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();
	
		$response = array('error'=>'', 'criterias' => '');
		
		$ids = explode(',', $_REQUEST['ids']);
		if (is_array($ids) && count($ids) > 0) {
			foreach ($ids as $id) {
				$id = (int) $id;
				$prop = morning_records_taxonomy_get_inherited_property('category', $id, 'reviews_criterias');
				if (!empty($prop) && !morning_records_is_inherit_option($prop)) {
					$response['criterias'] = implode(',', $prop);
					break;
				}
			}
		}
		
		echo json_encode($response);
		die();
	}
}

// Accept user's votes
if ( !function_exists( 'morning_records_reviews_accept_user_marks' ) ) {
	//add_action('wp_ajax_reviews_users_accept', 'morning_records_reviews_accept_user_marks');
	//add_action('wp_ajax_nopriv_reviews_users_accept', 'morning_records_reviews_accept_user_marks');
	function morning_records_reviews_accept_user_marks() {
		if ( !wp_verify_nonce( morning_records_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();
	
		$response = array('error'=>'');
		
		$post_id = $_REQUEST['post_id'];
		if ($post_id > 0) {
			$marks = $_REQUEST['marks'];
			$users = $_REQUEST['users'];
			$avg = morning_records_reviews_get_average_rating($marks);
			update_post_meta($post_id, 'morning_records_reviews_marks2', morning_records_reviews_marks_to_save($marks));
			update_post_meta($post_id, 'morning_records_reviews_avg2', morning_records_reviews_marks_to_save($avg));
			update_post_meta($post_id, 'morning_records_reviews_users', $users);
		} else {
			$response['error'] = esc_html__('Bad post ID', 'morning-records');
		}
		
		echo json_encode($response);
		die();
	}
}

// Get average review rating
if ( !function_exists( 'morning_records_reviews_get_average_rating' ) ) {
	function morning_records_reviews_get_average_rating($marks) {
		$r = explode(',', $marks);
		$rez = 0;
		$cnt = 0;
		if (is_array($r) && count($r) > 0) {
			foreach ($r as $v) {
				$rez += $v;
				$cnt++;
			}
		}
		return $cnt > 0 ? round($rez / $cnt, 1) : 0;
	}
}

// Get word-value review rating
if ( !function_exists( 'morning_records_reviews_get_word_value' ) ) {
	function morning_records_reviews_get_word_value($r, $words = '') {
		$max_level = max(5, (int) morning_records_get_custom_option('reviews_max_level'));
		if (trim($words) == '') $words = morning_records_get_theme_option('reviews_criterias_levels');
		$words = explode(',', $words);
		$k = $max_level / count($words);
		$r = max(0, min(count($words)-1, floor($r/$k)));
		return isset($words[$r]) ? trim($words[$r]) : esc_html__('no rated', 'morning-records');
	}
}

// Return Reviews markup html-block
if ( !function_exists( 'morning_records_reviews_get_markup' ) ) {
	function morning_records_reviews_get_markup($field, $value, $editable=false, $clear=false, $snippets=false) {
		$max_level = max(5, (int) morning_records_get_custom_option('reviews_max_level'));
		$step = $max_level < 100 ? 0.1 : 1;
		$prec = pow(10, morning_records_strpos($step, '.') === false ? 0 : morning_records_strlen($step) - morning_records_strpos($step, '.') - 1);
		$output = '<div class="reviews_editor">';
		$criterias = $field['options'];
		$marks = explode(',', $value);
		if (is_array($criterias) && count($criterias) > 0) {
			$i=0;
			foreach ($criterias as $num=>$sb) { 
				if (empty($sb)) continue;
				if ($clear || !isset($marks[$i]) || $marks[$i]=='' || morning_records_is_inherit_option($marks[$i])) $marks[$i] = 0;
				$marks[$i] = min($max_level, max(0, round($marks[$i] * $prec) / $prec + 0));
				$output .= '<div class="reviews_item reviews_max_level_'.esc_attr($max_level).'" data-max-level="'.esc_attr($max_level).'" data-step="'.esc_attr($step).'">'
					. '<div class="reviews_criteria">'.($sb).'</div>'
					. trim(morning_records_reviews_get_summary_stars($marks[$i], $editable))
					.'</div>';
				$i++;
			}
		}
		$output .= '</div>';
		$output .= isset($field['accept']) && $field['accept'] ? '<div class="reviews_accept">'.morning_records_sc_button(array(), esc_html__('Accept your votes', 'morning-records')).'</div>' : '';
		$avg = morning_records_reviews_get_average_rating($value);
		$avg = min($max_level, max(0, round($avg * $prec) / $prec + 0));		
		$output .= '<div class="reviews_summary">'
					. '<div class="reviews_item reviews_max_level_'.esc_attr($max_level).'" data-step="'.esc_attr($step).'">'
						. '<div class="reviews_criteria">'.(isset($field['descr']) ? $field['descr'] : esc_html__('Summary', 'morning-records')).'</div>'
						. trim(morning_records_reviews_get_summary_stars($avg, false, $snippets))
					. '</div>'
				. '</div>';
		return $output;
	}
}

// Return Reviews summary stars html-block
if ( !function_exists( 'morning_records_reviews_get_summary_stars' ) ) {
	function morning_records_reviews_get_summary_stars($avg, $editable=false, $snippets=false, $stars_show=0) {
		$max_level = max(5, (int) morning_records_get_custom_option('reviews_max_level'));
		$stars_count = min(10, $stars_show ? $stars_show : $max_level);
		$style = morning_records_get_theme_option('reviews_style');
		$output = '<div class="reviews_stars reviews_style_' . esc_attr($style) . ($editable ? ' reviews_editable' : '') . '"'
			. ' data-mark="'.esc_attr($avg).'"'
			. ($snippets ? ' itemscope itemprop="reviewRating" itemtype="'.esc_attr(morning_records_get_protocol()).'://schema.org/Rating"' : '')
			. '>'
			. ($snippets ? '<meta itemprop="worstRating" content="0"><meta itemprop="bestRating" content="'.esc_attr($max_level).'"><meta itemprop="ratingValue" content="'.esc_attr($avg).'">' : '');
		if (!$editable && $style=='text') {
			$output .= sprintf($max_level<100 ? esc_html__('%s / %s', 'morning-records') : esc_html__('%s', 'morning-records'), number_format($avg, 1) . ($max_level < 100 ? '' : '%'), $max_level . ($max_level < 100 ? '' : '%'));
		} else {
			$stars = morning_records_strrepeat('<span class="reviews_star"></span>', $stars_count);
			$output .= '<div class="reviews_stars_wrap">'
						.'<div class="reviews_stars_bg">'.($max_level < 100 || $stars_show ? $stars : '').'</div>'
						.'<div class="reviews_stars_hover" style="width:'.round($avg/$max_level*100).'%">'.($max_level < 100 || $stars_show ? $stars : '').'</div>'
						.($editable ? '<div class="reviews_slider"></div>' : '')
					.'</div>'
					.'<div class="reviews_value">'.($avg).'</div>';
		}
		if ($editable) {
			$output .= '<input type="hidden" name="reviews_marks[]" value="'.esc_attr($avg).'" />';
		}
		$output .= '</div>';
		return $output;
	}
}


// Prepare rating marks before first using
if ( !function_exists( 'morning_records_reviews_marks_prepare' ) ) {
	function morning_records_reviews_marks_prepare($marks, $cnt) {
		$m = explode(',', $marks);
		for ($i=0; $i < $cnt; $i++) {
			if (!isset($m[$i]))
				$m[$i] = 0;
			else
				$m[$i] = max(0, $m[$i]);
		}
		return implode(',', $m);
	}
}


// Prepare rating marks to save
if ( !function_exists( 'morning_records_reviews_marks_to_save' ) ) {
	function morning_records_reviews_marks_to_save($marks) {
		$max_level = max(5, (int) morning_records_get_custom_option('reviews_max_level'));
		if ($max_level == 100) return $marks;
		$m = explode(',', $marks);
		$kol = count($m);
		for ($i=0; $i < $kol; $i++) {
			$m[$i] = round($m[$i] * 100 / $max_level, 1);
		}
		return implode(',', $m);
	}
}


// Prepare rating marks to display
if ( !function_exists( 'morning_records_reviews_marks_to_display' ) ) {
	function morning_records_reviews_marks_to_display($marks) {
		$max_level = max(5, (int) morning_records_get_custom_option('reviews_max_level'));
		if ($max_level == 100) return $marks;
		$m = explode(',', $marks);
		$kol = count($m);
		for ($i=0; $i < $kol; $i++) {
			$m[$i] = round($m[$i] / 100 * $max_level, 1);
		}
		return implode(',', $m);
	}
}

// Return placeholder for reviews block
if ( !function_exists( 'morning_records_get_reviews_placeholder' ) ) {
	function morning_records_get_reviews_placeholder() {
		return '<!-- #TRX_REVIEWS_PLACEHOLDER# -->';
	}
}
	
// Replace placeholder with the reviews block
if ( !function_exists( 'morning_records_reviews_wrapper' ) ) {
	function morning_records_reviews_wrapper($str) {
		$placeholder = morning_records_get_reviews_placeholder();
		if (morning_records_strpos($str, $placeholder)!==false) {
			if (($reviews_markup=morning_records_storage_get('reviews_markup'))!='') {
				$str = str_replace($placeholder, $reviews_markup, $str);
				morning_records_storage_set('reviews_markup', '');
			}
		}
		return $str;
	}
}
?>