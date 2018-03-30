<?php





////////////////////////////////////////////////////////////////////////////////
// SIDEBAR SETTINGS //
$sidebar_layout = ECF_Field::factory('imageradio', 'post_sidebar_layout', __('Sidebar Layout','espresso') );
$sidebar_layout->add_options(array(
		'right'=>get_template_directory_uri().'/_theme_settings/images/sidebar_right.png',
		'left'=>get_template_directory_uri().'/_theme_settings/images/sidebar_left.png',
		'no-sidebar'=>get_template_directory_uri().'/_theme_settings/images/sidebar_none.png',
	));

global $wp_registered_sidebars;
$sidebar_dropdown_elements = array();
foreach($wp_registered_sidebars as $sidebar_id => $sidebar){
	$sidebar_dropdown_elements[$sidebar['id']] = $sidebar['name'];	
}

// Sidebar Choice
$sidebar_choice = ECF_Field::factory('select', 'post_sidebar_choice', __('Choose a sidebar:','espresso'));
$sidebar_choice->add_options($sidebar_dropdown_elements);





////////////////////////////////////////////////////////////////////////////////
// POST CONTENT //

$post_options = ECF_Field::factory('set', 'post_options', __('Post Options','espresso') );
$post_options->add_options(array('hide_post_breadcrumbs' => __('Hide the breadcrumbs above the title.','espresso'), 'hide_post_title' => __('Hide the post title.','espresso')));





$post_option_sep_8 = ECF_Field::factory('sep', 'seperator58');





////////////////////////////////////////////////////////////////////////////////
// SET UP THE PANEL //
$post_settings_panel = new ECF_Panel('post_settings_panel', __('ESPRESSO: Post Settings','espresso'), 'post', 'normal', 'high');

$post_settings_panel->add_fields(
	array(
			
		// Post Options
		$post_options,
		$post_option_sep_8,
			
		// Sidebar Layout
		$sidebar_layout,
		$sidebar_choice,
		
	)
);





?>