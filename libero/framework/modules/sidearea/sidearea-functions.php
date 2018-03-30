<?php
if (!function_exists('libero_mikado_register_side_area_sidebar')) {
	/**
	 * Register side area sidebar
	 */
	function libero_mikado_register_side_area_sidebar() {

		register_sidebar(array(
			'name' => 'Side Area',
			'id' => 'sidearea', //TODO Change name of sidebar
			'description' => 'Side Area',
			'before_widget' => '<div id="%1$s" class="widget mkd-sidearea %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="mkd-sidearea-widget-title">',
			'after_title' => '</h4>'
		));

	}

	add_action('widgets_init', 'libero_mikado_register_side_area_sidebar');

}

if(!function_exists('libero_mikado_side_menu_body_class')) {
    /**
     * Function that adds body classes for different side menu styles
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function libero_mikado_side_menu_body_class($classes) {

		if (is_active_widget( false, false, 'mkd_side_area_opener' )) {

			if (libero_mikado_options()->getOptionValue('side_area_type')) {

				$classes[] = 'mkd-' . libero_mikado_options()->getOptionValue('side_area_type');

				if (libero_mikado_options()->getOptionValue('side_area_type') === 'side-menu-slide-with-content') {

					$classes[] = 'mkd-' . libero_mikado_options()->getOptionValue('side_area_slide_with_content_width');

				}

        	}

		}

		return $classes;

    }

    add_filter('body_class', 'libero_mikado_side_menu_body_class');
}


if(!function_exists('libero_mikado_get_side_area')) {
	/**
	 * Loads side area HTML
	 */
	function libero_mikado_get_side_area() {
		if (is_active_widget( false, false, 'mkd_side_area_opener' )) {

			$parameters = array(
				'show_side_area_title' => libero_mikado_options()->getOptionValue('side_area_title') !== '' ? true : false, //Dont show title if empty
			);

			libero_mikado_get_module_template_part('templates/sidearea', 'sidearea', '', $parameters);

		}

	}

}

if (!function_exists('libero_mikado_get_side_area_title')) {
	/**
	 * Loads side area title HTML
	 */
	function libero_mikado_get_side_area_title() {

		$parameters = array(
			'side_area_title' => libero_mikado_options()->getOptionValue('side_area_title')
		);

		libero_mikado_get_module_template_part('templates/parts/title', 'sidearea', '', $parameters);

	}

}

if(!function_exists('libero_mikado_get_side_menu_icon_html')) {
    /**
     * Function that outputs html for side area icon opener.
     * Uses $libero_mikado_IconCollections global variable
     * @return string generated html
     */
    function libero_mikado_get_side_menu_icon_html() {

        $icon_html = '';

		if (libero_mikado_options()->getOptionValue('side_area_button_icon_pack') !== '') {
			$icon_pack = libero_mikado_options()->getOptionValue('side_area_button_icon_pack');

			$icons = libero_mikado_icon_collections()->getIconCollection($icon_pack);
			$icon_options_field = 'side_area_icon_' . $icons->param;

			if (libero_mikado_options()->getOptionValue($icon_options_field) !== '') {

				$icon = libero_mikado_options()->getOptionValue($icon_options_field);
				$icon_html = libero_mikado_icon_collections()->renderIcon($icon, $icon_pack);

			}

		}

        return $icon_html;
    }
}