<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
$page_show_top_panel = $top_inner_page_style = '';
$show_header_top_panel = false;
if (!empty($post) && is_object($post)) {
	$page_id = $post->ID;
	$page_show_top_panel = get_post_meta($page_id,'dfd_headers_show_top_inner_apge', true);
	$show_header_top_panel = strcmp($page_show_top_panel, 'on') === 0;
}
$top_inner_page_style = isset($dfd_ronneby['top_panel_inner_style']) ? $dfd_ronneby['top_panel_inner_style'] : '';
$top_panel_inner_page_select = isset($dfd_ronneby['top_panel_inner_page_select']) ? $dfd_ronneby['top_panel_inner_page_select'] : '';
if (!empty($top_panel_inner_page_select) && $show_header_top_panel && $top_inner_page_style != ''):
	$top_inner_page_id = intval($top_panel_inner_page_select);
	$page_data = get_page($top_inner_page_id);
	
	if (!empty($page_data) && isset($page_data->post_status) && strcmp($page_data->post_status,'publish')===0):
	?>
		<a class="top-inner-page mobile-hide" href="#"><span></span></a>
	<?php
	endif;
endif;
