<?php

if (!function_exists('qode_startit_register_footer_sidebar')) {

	function qode_startit_register_footer_sidebar() {

		register_sidebar(array(
			'name' => 'Footer Column 1',
			'id' => 'footer_column_1',
			'description' => 'Footer Column 1',
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-1 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name' => 'Footer Column 2',
			'id' => 'footer_column_2',
			'description' => 'Footer Column 2',
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-2 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name' => 'Footer Column 3',
			'id' => 'footer_column_3',
			'description' => 'Footer Column 3',
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-3 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name' => 'Footer Column 4',
			'id' => 'footer_column_4',
			'description' => 'Footer Column 4',
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-column-4 %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name' => 'Footer Bottom',
			'id' => 'footer_text',
			'description' => 'Footer Bottom',
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-text %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name' => 'Footer Bottom Left',
			'id' => 'footer_bottom_left',
			'description' => 'Footer Bottom Left',
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-bottom-left %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

		register_sidebar(array(
			'name' => 'Footer Bottom Right',
			'id' => 'footer_bottom_right',
			'description' => 'Footer Bottom Right',
			'before_widget' => '<div id="%1$s" class="widget qodef-footer-bottom-left %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="qodef-footer-widget-title">',
			'after_title' => '</h4>'
		));

	}

	add_action('widgets_init', 'qode_startit_register_footer_sidebar');

}

if (!function_exists('qode_startit_get_footer')) {
	/**
	 * Loads footer HTML
	 */
	function qode_startit_get_footer() {

		$parameters = array();
		$id = qode_startit_get_page_id();
		$parameters['footer_classes'] = qode_startit_get_footer_classes($id);
		$parameters['display_footer_top'] = (qode_startit_options()->getOptionValue('show_footer_top') == 'yes') ? true : false;
		$parameters['display_footer_bottom'] = (qode_startit_options()->getOptionValue('show_footer_bottom') == 'yes') ? true : false;

		qode_startit_get_module_template_part('templates/footer', 'footer', '', $parameters);

	}

}

if (!function_exists('qode_startit_get_content_bottom_area')) {
	/**
	 * Loads content bottom area HTML with all needed parameters
	 */
	function qode_startit_get_content_bottom_area() {

		$parameters = array();

		//Current page id
		$id = qode_startit_get_page_id();

		//is content bottom area enabled for current page?

        if( qode_startit_get_meta_field_intersect('qodef_enable_content_bottom_area', $id)) {
            $parameters['content_bottom_area'] = qode_startit_get_meta_field_intersect('qodef_enable_content_bottom_area', $id);
        }
        else {
            $parameters['content_bottom_area'] = qode_startit_options()->getOptionValue('enable_content_bottom_area');
        }
		if ($parameters['content_bottom_area'] == 'yes') {
			//Sidebar for content bottom area
            if( qode_startit_get_meta_field_intersect('qodef_content_bottom_sidebar_custom_display', $id)) {
                $parameters['content_bottom_area_sidebar'] = qode_startit_get_meta_field_intersect('qodef_content_bottom_sidebar_custom_display');
            }
			else {
                $parameters['content_bottom_area_sidebar'] = qode_startit_options()->getOptionValue('content_bottom_sidebar_custom_display');
            }
			//Content bottom area in grid
            if( qode_startit_get_meta_field_intersect('qodef_content_bottom_in_grid', $id)) {
                $parameters['content_bottom_area_in_grid'] = qode_startit_get_meta_field_intersect('qodef_content_bottom_in_grid');
            }
            else {
                $parameters['content_bottom_area_in_grid'] = qode_startit_options()->getOptionValue('content_bottom_in_grid');
            }
			//Content bottom area background color
            if( qode_startit_get_meta_field_intersect('qodef_content_bottom_background_color', $id)) {
                $parameters['content_bottom_background_color'] = 'background-color: '.qode_startit_get_meta_field_intersect('qodef_content_bottom_background_color');
            }
            else {
                $parameters['content_bottom_background_color'] =  'background-color: '.qode_startit_options()->getOptionValue('content_bottom_background_color');
            }
		}

		qode_startit_get_module_template_part('templates/parts/content-bottom-area', 'footer', '', $parameters);

	}

}

if (!function_exists('qode_startit_get_footer_top')) {
	/**
	 * Return footer top HTML
	 */
	function qode_startit_get_footer_top() {

		$parameters = array();

		$parameters['footer_top_border'] = qode_startit_get_footer_top_border();
		$parameters['footer_top_border_in_grid'] = (qode_startit_options()->getOptionValue('footer_top_border_in_grid') == 'yes') ? 'qodef-in-grid' : '';
		$parameters['footer_in_grid'] = (qode_startit_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
		$parameters['footer_top_classes'] = (qode_startit_options()->getOptionValue('footer_in_grid') == 'yes') ? '' : 'qodef-footer-top-full';
		$parameters['footer_top_columns'] = qode_startit_options()->getOptionValue('footer_top_columns');

		qode_startit_get_module_template_part('templates/parts/footer-top', 'footer', '', $parameters);

	}
	
}

if (!function_exists('qode_startit_get_footer_bottom')) {
	/**
	 * Return footer bottom HTML
	 */
	function qode_startit_get_footer_bottom() {

		$parameters = array();

		$parameters['footer_bottom_border'] = qode_startit_get_footer_bottom_border();
		$parameters['footer_bottom_border_in_grid'] = (qode_startit_options()->getOptionValue('footer_bottom_border_in_grid') == 'yes') ? 'qodef-in-grid' : '';
		$parameters['footer_in_grid'] = (qode_startit_options()->getOptionValue('footer_in_grid') == 'yes') ? true : false;
		$parameters['footer_bottom_columns'] = qode_startit_options()->getOptionValue('footer_bottom_columns');
		$parameters['footer_bottom_border_bottom'] = qode_startit_get_footer_bottom_bottom_border();

		qode_startit_get_module_template_part('templates/parts/footer-bottom', 'footer', '', $parameters);

	}

}

//Functions for loading sidebars

if (!function_exists('qode_startit_get_footer_sidebar_25_25_50')) {

	function qode_startit_get_footer_sidebar_25_25_50() {
		qode_startit_get_module_template_part('templates/sidebars/sidebar-three-columns-25-25-50', 'footer');
	}

}

if (!function_exists('qode_startit_get_footer_sidebar_50_25_25')) {

	function qode_startit_get_footer_sidebar_50_25_25() {
		qode_startit_get_module_template_part('templates/sidebars/sidebar-three-columns-50-25-25', 'footer');
	}

}

if (!function_exists('qode_startit_get_footer_sidebar_four_columns')) {

	function qode_startit_get_footer_sidebar_four_columns() {
		qode_startit_get_module_template_part('templates/sidebars/sidebar-four-columns', 'footer');
	}

}

if (!function_exists('qode_startit_get_footer_sidebar_three_columns')) {

	function qode_startit_get_footer_sidebar_three_columns() {
		qode_startit_get_module_template_part('templates/sidebars/sidebar-three-columns', 'footer');
	}

}

if (!function_exists('qode_startit_get_footer_sidebar_two_columns')) {

	function qode_startit_get_footer_sidebar_two_columns() {
		qode_startit_get_module_template_part('templates/sidebars/sidebar-two-columns', 'footer');
	}

}

if (!function_exists('qode_startit_get_footer_sidebar_one_column')) {

	function qode_startit_get_footer_sidebar_one_column() {
		qode_startit_get_module_template_part('templates/sidebars/sidebar-one-column', 'footer');
	}

}

if (!function_exists('qode_startit_get_footer_bottom_sidebar_three_columns')) {

	function qode_startit_get_footer_bottom_sidebar_three_columns() {
		qode_startit_get_module_template_part('templates/sidebars/sidebar-bottom-three-columns', 'footer');
	}

}

if (!function_exists('qode_startit_get_footer_bottom_sidebar_two_columns')) {

	function qode_startit_get_footer_bottom_sidebar_two_columns() {
		qode_startit_get_module_template_part('templates/sidebars/sidebar-bottom-two-columns', 'footer');
	}

}

if (!function_exists('qode_startit_get_footer_bottom_sidebar_one_column')) {

	function qode_startit_get_footer_bottom_sidebar_one_column() {
		qode_startit_get_module_template_part('templates/sidebars/sidebar-bottom-one-column', 'footer');
	}

}

