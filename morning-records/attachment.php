<?php
/**
 * Attachment page
 */
get_header(); 

while ( have_posts() ) { the_post();

	// Move morning_records_set_post_views to the javascript - counter will work under cache system
	if (morning_records_get_custom_option('use_ajax_views_counter')=='no') {
		morning_records_set_post_views(get_the_ID());
	}

	morning_records_show_post_layout(
		array(
			'layout' => 'attachment',
			'sidebar' => !morning_records_param_is_off(morning_records_get_custom_option('show_sidebar_main'))
		)
	);

}

get_footer();
?>