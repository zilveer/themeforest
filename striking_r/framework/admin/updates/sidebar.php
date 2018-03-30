<?php
if(!get_option(THEME_SLUG.'_sidebar_widgets_fixed')){
	$sidebar_mapping = array(
		'sidebar-1' => 'sidebar-home',
		'sidebar-2' => 'sidebar-page',
		'sidebar-3' => 'sidebar-blog',
		'sidebar-4' => 'sidebar-portfolio',
	);

	$footer_sidebar_mapping = array(
		'sidebar-5' => 'sidebar-footer-first',
		'sidebar-6' => 'sidebar-footer-second',
		'sidebar-7' => 'sidebar-footer-third',
		'sidebar-8' => 'sidebar-footer-fourth',
		'sidebar-9' => 'sidebar-footer-fifth',
		'sidebar-10' => 'sidebar-footer-sixth',
	);

	$option_sidebar_mapping = array();
	$i = 10;

	$top_area_type = theme_get_option_from_db('general','top_area_type');

	if($top_area_type == 'widget'){
		$i++;
		$option_sidebar_mapping['sidebar-'.$i] = 'sidebar-top-area';
	}

	$footer_right_area_type = theme_get_option_from_db('footer','footer_right_area_type');
	if($footer_right_area_type == 'widget'){
		$i++;
		$option_sidebar_mapping['sidebar-'.$i] = 'sidebar-footer-right-area';
	}

	$custom_sidebar_mapping = array();
	$custom_sidebars = theme_get_option_from_db('sidebar','sidebars');
	if(!empty($custom_sidebars)){
		$custom_sidebar_names = explode(',',$custom_sidebars);
		foreach ($custom_sidebar_names as $name){
			$slug = strtolower(preg_replace('/[^a-zA-Z0-9-]/', '-', $name));
			$i++;
			$custom_sidebar_mapping['sidebar-'.$i] = 'sidebar-custom-'.$slug;
		}
	}

	function theme_update_sidebar_ids($mapping){
		$sidebars_widgets = get_option('sidebars_widgets');

		$new_sidebars_widgets = array();

		foreach ($sidebars_widgets as $key => $value) {
			if(array_key_exists($key, $mapping)){
				$new_sidebars_widgets[$mapping[$key]] = $value;
			} else {
				$new_sidebars_widgets[$key] = $value;
			}
		}

		update_option( 'sidebars_widgets', $new_sidebars_widgets );
	}

	theme_update_sidebar_ids($sidebar_mapping);
	theme_update_sidebar_ids($footer_sidebar_mapping);
	theme_update_sidebar_ids($option_sidebar_mapping);
	theme_update_sidebar_ids($custom_sidebar_mapping);
	update_option(THEME_SLUG.'_sidebar_widgets_fixed', true);
}