<?php

/**
 * Various template helpers
 */

add_filter('get_previous_post_join', 'wpv_post_siblings_join', 10, 3);
add_filter('get_next_post_join', 'wpv_post_siblings_join', 10, 3);
function wpv_post_siblings_join($join, $in_same_cat, $excluded_categories) {
	global $post;

	if($post->post_type == 'portfolio') {
		$join = str_replace("'category'", "'portfolio_category'", $join);
		$cat_array = wp_get_object_terms($post->ID, 'portfolio_category', array('fields' => 'ids'));
		$cat_in = "tt.term_id IN (" . implode(',', $cat_array) . ")";
		$join = preg_replace('#tt\.term_id IN \([^)]*\)#', $cat_in, $join);
	}

	return $join;
}

add_filter('get_previous_post_where', 'wpv_post_siblings_where', 10, 3);
add_filter('get_next_post_where', 'wpv_post_siblings_where', 10, 3);
function wpv_post_siblings_where($where, $in_same_cat, $excluded_categories) {
	global $post;

	if($post->post_type == 'portfolio') {
		$where = str_replace("'category'", "'portfolio_category'", $where);
	}

	return $where;
}

function wpv_get_header_sidebars($title=null) {
	$result = false;
	global $wpv_has_header_sidebars;
	if( $wpv_has_header_sidebars) {?>
		<div class="pane">
			<div class="row">
			<?php
				$result = true;
				WpvTemplates::page_header(false, $title);
				WpvTemplates::header_sidebars();
			?>
			</div>
		</div>
		<?php
	}

	return $result;
}

function theme_version_check() {
	$last_version = (int)wpv_get_option('theme_installed_version');

	if(empty($last_version))
		$last_version = 1;

	if($last_version < (int)WpvFramework::get_version()) {
		wpv_update_option('theme_installed_version', (int)WpvFramework::get_version());
	}
}
add_action('admin_init', 'theme_version_check');

function theme_background_styles() {
	global $post;

	$post_id = wpv_get_the_ID();

	if(is_null($post_id)) return;

	$bgcolor = wpv_sanitize_accent(wpv_post_meta($post_id, 'background-color', true));
	$bgimage = wpv_post_meta($post_id, 'background-image', true);
	$bgrepeat = wpv_post_meta($post_id, 'background-repeat', true);
	$bgsize = wpv_post_meta($post_id, 'background-size', true);
	$bgattachment = wpv_post_meta($post_id, 'background-attachment', true);
	$bgposition = wpv_post_meta($post_id, 'background-position', true);

	$page_style = '';
	if(!empty($bgcolor))
		$page_style .= "background-color:$bgcolor;";
	if(!empty($bgimage)) {
		$page_style .= "background-image:url('$bgimage');";
		if(!empty($bgrepeat))
			$page_style .= "background-repeat:$bgrepeat;";
		if(!empty($bgattachment))
			$page_style .= "background-attachment:$bgattachment;";
		if(!empty($bgsize))
			$page_style .= "background-size:$bgsize;";
	}

	if(!empty($page_style) && (is_single() || is_page())) {
		echo "<style>html{ $page_style }</style>";
	}
}
add_action('wp_head', 'theme_background_styles');

function theme_body_classes($body_class) {
	global $wpv_has_header_sidebars, $post, $wpv_is_shortcode_preview;

	$is_blank_page = is_page_template('page-blank.php');
	$has_header_slider = WpvTemplates::has_header_slider();
	$wpv_has_header_sidebars = wpv_post_meta_default('show_header_sidebars', 'has-header-sidebars');
	$has_page_header = (WpvTemplates::has_page_header() || WpvTemplates::has_post_siblings_buttons()) && !is_404();

	$body_class[] = $is_blank_page ? 'full' : wpv_get_option('site-layout-type');
	$body_class[] = 'pagination-'.wpv_get_option('pagination-type');
	$body_class[] = is_singular( WpvFramework::$complex_layout ) ? 'sticky-header-type-'.wpv_post_meta(null, 'sticky-header-type', true) : '';
	$body_class[] = 'wpv-not-scrolled';

	$body_class_conditions = array(
		'no-page-header' => !$has_page_header,
		'has-page-header' => $has_page_header,
		'cbox-share-twitter' => wpv_get_optionb('share-lightbox-twitter'),
		'cbox-share-facebook' => wpv_get_optionb('share-lightbox-facebook'),
		'cbox-share-googleplus' => wpv_get_optionb('share-lightbox-googleplus'),
		'cbox-share-pinterest' => wpv_get_optionb('share-lightbox-pinterest'),
		'fixed-header' => wpv_get_optionb('fixed-header'),
		'has-header-slider' => $has_header_slider,
		'has-header-sidebars' => $wpv_has_header_sidebars,
		'no-header-slider' => !$has_header_slider,
		'no-header-sidebars' => !$wpv_has_header_sidebars,
		'no-footer-sidebars' => !wpv_get_optionb('has-footer-sidebars'),
		'responsive-layout' => WPV_RESPONSIVE,
		'fixed-layout' => !WPV_RESPONSIVE,
		'has-breadcrumbs' => wpv_get_optionb('enable-breadcrumbs'),
		'no-breadcrumbs' => !wpv_get_optionb('enable-breadcrumbs'),
		'no-slider-button-thumbnails' => !wpv_get_optionb('header-slider-button-thumbnails'),
		'sticky-header' => wpv_get_optionb('sticky-header'),
		'no-page-bottom-padding' => is_singular() && wpv_post_meta(null, 'use-page-bottom-padding', true) == 'false',
		'vamtam-shortcode-tooltip-preview' => $wpv_is_shortcode_preview && strpos($GLOBALS['wpv_current_shortcode'], '[tooltip') !== false,
	);

	foreach($body_class_conditions as $class=>$cond) {
		if($cond) {
			$body_class[] = $class;
		}
	}

	if(is_archive() || is_search() || get_query_var('format_filter'))
		define('WPV_ARCHIVE_TEMPLATE', true);

	return $body_class;
}
add_filter('body_class', 'theme_body_classes');