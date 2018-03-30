<?php
/**
 * Single post
 */
get_header(); 

$single_style = morning_records_storage_get('single_style');
if (empty($single_style)) $single_style = morning_records_get_custom_option('single_style');

while ( have_posts() ) { the_post();
	morning_records_show_post_layout(
		array(
			'layout' => $single_style,
			'sidebar' => !morning_records_param_is_off(morning_records_get_custom_option('show_sidebar_main')),
			'content' => morning_records_get_template_property($single_style, 'need_content'),
			'terms_list' => morning_records_get_template_property($single_style, 'need_terms')
		)
	);
}

get_footer();
?>