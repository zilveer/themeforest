<?php
// Get template args
extract(morning_records_template_get_args('reviews-block'));

$reviews_markup = '';
if ($avg_author > 0 || $avg_users > 0) {
	$reviews_first_author = morning_records_get_theme_option('reviews_first')=='author';
	$reviews_second_hide = morning_records_get_theme_option('reviews_second')=='hide';
	$use_tabs = !$reviews_second_hide; // && $avg_author > 0 && $avg_users > 0;
	if ($use_tabs) morning_records_enqueue_script('jquery-ui-tabs', false, array('jquery','jquery-ui-core'), null, true);
	$max_level = max(5, (int) morning_records_get_custom_option('reviews_max_level'));
	$allow_user_marks = (!$reviews_first_author || !$reviews_second_hide) && (!isset($_COOKIE['morning_records_votes']) || morning_records_strpos($_COOKIE['morning_records_votes'], ','.($post_data['post_id']).',')===false) && (morning_records_get_theme_option('reviews_can_vote')=='all' || is_user_logged_in());
	$reviews_markup = '<div class="reviews_block'.($use_tabs ? ' sc_tabs sc_tabs_style_2' : '').'">';
	$output = $marks = $users = '';
	if ($use_tabs) {
		$author_tab = '<li class="sc_tabs_title"><a href="#author_marks" class="theme_button">'.esc_html__('Author', 'morning-records').'</a></li>';
		$users_tab = '<li class="sc_tabs_title"><a href="#users_marks" class="theme_button">'.esc_html__('Users', 'morning-records').'</a></li>';
		$output .= '<ul class="sc_tabs_titles">' . ($reviews_first_author ? ($author_tab) . ($users_tab) : ($users_tab) . ($author_tab)) . '</ul>';
	}
	// Criterias list
	$field = array(
		"options" => morning_records_get_theme_option('reviews_criterias')
	);
	if (!empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms) && is_array($post_data['post_terms'][$post_data['post_taxonomy']]->terms)) {
		foreach ($post_data['post_terms'][$post_data['post_taxonomy']]->terms as $cat) {
			$id = (int) $cat->term_id;
			$prop = morning_records_taxonomy_get_inherited_property($post_data['post_taxonomy'], $id, 'reviews_criterias');
			if (!empty($prop) && !morning_records_is_inherit_option($prop)) {
				$field['options'] = $prop;
				break;
			}
		}
	}
	// Author marks
	if ($reviews_first_author || !$reviews_second_hide) {
		$field["id"] = "reviews_marks_author";
		$field["descr"] = strip_tags($post_data['post_excerpt']);
		$field["accept"] = false;
		$marks = morning_records_reviews_marks_to_display(morning_records_reviews_marks_prepare(morning_records_get_custom_option('reviews_marks'), count($field['options'])));
		$output .= '<div id="author_marks" class="sc_tabs_content">' . trim(morning_records_reviews_get_markup($field, $marks, false, false, $reviews_first_author)) . '</div>';
	}
	// Users marks
	if (!$reviews_first_author || !$reviews_second_hide) {
		$marks = morning_records_reviews_marks_to_display(morning_records_reviews_marks_prepare(get_post_meta($post_data['post_id'], 'morning_records_reviews_marks2', true), count($field['options'])));
		$users = max(0, get_post_meta($post_data['post_id'], 'morning_records_reviews_users', true));
		$field["id"] = "reviews_marks_users";
		$field["descr"] = wp_kses_data( sprintf(__("Summary rating from <b>%s</b> user's marks.", 'morning-records'), $users) 
									. ' ' 
                                    . ( !isset($_COOKIE['morning_records_votes']) || morning_records_strpos($_COOKIE['morning_records_votes'], ','.($post_data['post_id']).',')===false
											? __('You can set own marks for this article - just click on stars above and press "Accept".', 'morning-records')
                                            : __('Thanks for your vote!', 'morning-records')
                                      ) );
		$field["accept"] = $allow_user_marks;
		$output .= '<div id="users_marks" class="sc_tabs_content"'.(!$output ? ' style="display: block;"' : '') . '>' . trim(morning_records_reviews_get_markup($field, $marks, $allow_user_marks, false, !$reviews_first_author)) . '</div>';
	}
	$reviews_markup .= $output . '</div>';
	if ($allow_user_marks) {
		morning_records_enqueue_script('jquery-ui-draggable', false, array('jquery', 'jquery-ui-core'), null, true);
		$reviews_markup .= '
			<script type="text/javascript">
				jQuery(document).ready(function() {
					MORNING_RECORDS_STORAGE["reviews_allow_user_marks"] = '.($allow_user_marks ? 'true' : 'false').';
					MORNING_RECORDS_STORAGE["reviews_max_level"] = '.($max_level).';
					MORNING_RECORDS_STORAGE["reviews_levels"] = "'.trim(morning_records_get_theme_option('reviews_criterias_levels')).'";
					MORNING_RECORDS_STORAGE["reviews_vote"] = "'.(isset($_COOKIE['morning_records_votes']) ? $_COOKIE['morning_records_votes'] : '').'";
					MORNING_RECORDS_STORAGE["reviews_marks"] = "'.($marks).'".split(",");
					MORNING_RECORDS_STORAGE["reviews_users"] = '.max(0, $users).';
					MORNING_RECORDS_STORAGE["post_id"] = '.($post_data['post_id']).';
				});
			</script>
		';
	}
}
morning_records_storage_set('reviews_markup', $reviews_markup);
?>