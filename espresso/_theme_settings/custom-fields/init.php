<?php

function add_espresso_custom_fields(){
	// Include the custom field options
	include('pages.php');
	include('posts.php');
}

add_action( 'init', 'add_espresso_custom_fields' );

function espresso_save_event_list_for_dropdown(){
	if (class_exists('Tribe__Events__Main')){
		$events_for_dropdown = tribe_get_events(array(
			'eventDisplay'=>'list',
			'posts_per_page'=>100
		));
		update_option('espresso_event_list',$events_for_dropdown);
	} else {
		update_option('espresso_event_list',false);
	}
}

if (class_exists('Tribe__Events__Main')){
	add_action('admin_init', 'espresso_save_event_list_for_dropdown');
}