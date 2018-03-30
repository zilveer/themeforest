<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/1/2015
 * Time: 5:50 PM
 */
/*================================================
BODY CLASS
================================================== */
if (!function_exists('g5plus_body_class_name')) {
	function g5plus_body_class_name($classes) {
		global $g5plus_options, $g5plus_header_layout;
		$prefix = 'g5plus_';
		$g5plus_header_layout = rwmb_meta($prefix . 'header_layout');

		if (($g5plus_header_layout === '') || ($g5plus_header_layout == '-1')) {
			$g5plus_header_layout = $g5plus_options['header_layout'];
		}


		$classes[] = 'footer-static';
		if ($g5plus_options['home_preloader'] != 'none' && !empty($g5plus_options['home_preloader'])) {
			$classes[] = 'site-loading';
		}

		$layout_style = rwmb_meta($prefix.'layout_style');
		if(!isset($layout_style) || $layout_style == '-1' || $layout_style == '') {
			$layout_style = $g5plus_options['layout_style'];
		}

		if ($layout_style != 'wide') {
			$classes[] =  $layout_style;
		}


		$page_class_extra =  rwmb_meta($prefix.'page_class_extra');
		if (!empty($page_class_extra)) {
			$classes[] = $page_class_extra;
		}

		$classes[] = $g5plus_header_layout;
		switch ($g5plus_header_layout) {
			case 'header-7':
				$classes[] = 'header-left';
				break;
		}

		$header_layout_float = rwmb_meta($prefix . 'header_layout_float');

		if (($header_layout_float === '') || ($header_layout_float == '-1')) {
			$header_layout_float = $g5plus_options['header_layout_float'];
		}
		if ($header_layout_float == '1') {
			$classes[] = 'header-float';
		}

		$action = isset($_GET['action']) ? $_GET['action'] : '';
		if ($action == 'yith-woocompare-view-table') {
			$classes[] = 'woocommerce-compare-page';
		}

		if (class_exists( 'WooCommerce' )) {
			$classes[] = 'woocommerce';
		}



		return $classes;
	}
	add_filter('body_class','g5plus_body_class_name');
}


/*================================================
SITE LOADING
================================================== */
if (!function_exists('g5plus_site_loading')) {
	function g5plus_site_loading(){
        g5plus_get_template('site-loading');
	}
	add_action('g5plus_before_page_wrapper','g5plus_site_loading',5);
}
/*================================================
PAGE HEADING
================================================== */
if (!function_exists('g5plus_page_heading')) {
	function g5plus_page_heading() {
		g5plus_get_template('page-heading');
	}
	add_action('g5plus_before_page','g5plus_page_heading',5);
}
/*================================================
ARCHIVE HEADING
================================================== */
if (!function_exists('g5plus_archive_heading')) {
	function g5plus_archive_heading() {
		g5plus_get_template('archive-heading');
	}
	add_action('g5plus_before_archive','g5plus_archive_heading',5);
}

if (!function_exists('g5plus_archive_product_heading')) {
    function g5plus_archive_product_heading() {
        g5plus_get_template('archive-product-heading');
    }
    add_action('g5plus_before_archive_product','g5plus_archive_product_heading',5);
}

/*================================================
ABOVE HEADER
================================================== */
if (!function_exists('g5plus_page_top_drawer')) {
	function g5plus_page_top_drawer() {
		g5plus_get_template('top-drawer-template');
	}
	add_action('g5plus_before_page_wrapper_content','g5plus_page_top_drawer',10);
}

/*================================================
TOP BAR
================================================== */
if (!function_exists('g5plus_page_top_bar')) {
	function g5plus_page_top_bar() {
		g5plus_get_template('top-bar-template');
	}
	add_action('g5plus_before_page_wrapper_content','g5plus_page_top_bar',10);
}

/*================================================
HEADER
================================================== */
if (!function_exists('g5plus_page_header')) {
	function g5plus_page_header() {
		g5plus_get_template('header-template');
	}
	add_action('g5plus_before_page_wrapper_content','g5plus_page_header',15);
}