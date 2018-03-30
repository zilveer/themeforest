<?php
if (!function_exists('g5plus_admin_enqueue_scripts')) {

	function g5plus_admin_enqueue_scripts() {
		// Enqueue Script
		wp_enqueue_script( 'admin-app-js', THEME_URL . '/admin/assets/js/admin.app.js',array(), '1.0.0', true );

		global $meta_boxes;
		$meta_box_id = '';
		foreach ($meta_boxes as $box) {
			if (!isset($box['tab'])) {
				continue;
			}
			if (!empty($meta_box_id)) {
				$meta_box_id .= ',';
			}
			$meta_box_id .= '#' . $box['id'];
		}

		wp_localize_script( 'admin-app-js' , 'meta_box_ids' , $meta_box_id);

		// Enqueue CSS
		wp_enqueue_style( 'admin-meta-box-css', THEME_URL . '/admin/assets/css/meta-box.css', false, '1.0.0' );
        wp_enqueue_style( 'admin-template-css', THEME_URL . '/admin/assets/css/template.css', false, '1.0.0' );
		wp_enqueue_style( 'admin-redux-css', THEME_URL . '/admin/assets/css/redux-admin.css', false, '1.0.0' );

		/*font-awesome*/
		$url_font_awesome = THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome.min.css';
		if (isset($g5plus_options['cdn_font_awesome']) && !empty($g5plus_options['cdn_font_awesome'])) {
			$url_font_awesome = $g5plus_options['cdn_font_awesome'];
		}
		wp_enqueue_style('g5plus_framework_font_awesome', $url_font_awesome, array());
		wp_enqueue_style('g5plus_framework_font_awesome_animation', THEME_URL . 'assets/plugins/fonts-awesome/css/font-awesome-animation.min.css', array());

	}
	add_action( 'admin_enqueue_scripts', 'g5plus_admin_enqueue_scripts' );
}