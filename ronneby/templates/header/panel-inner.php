<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $post, $dfd_ronneby;
$top_panel_inner_page_select = isset($dfd_ronneby['top_panel_inner_page_select']) ? $dfd_ronneby['top_panel_inner_page_select'] : '';
$top_panel_inner_class = (isset($dfd_ronneby['top_panel_inner_style']) && !empty($dfd_ronneby['top_panel_inner_style'])) ? $dfd_ronneby['top_panel_inner_style'] : 'dfd-header-responsive-hide';
$page_show_top_panel = '';

if(!empty($post) && is_object($post)) {
	$page_show_top_panel = get_post_meta($post->ID,'dfd_headers_show_top_inner_apge', true);
}
if (!empty($top_panel_inner_page_select) && strcmp($page_show_top_panel, 'on') === 0) {
	$top_inner_page_id = intval($top_panel_inner_page_select);
	$page_data = get_page($top_inner_page_id);
	
	if (!empty($page_data) && isset($page_data->post_status) && strcmp($page_data->post_status,'publish')===0) {
		global $wp_the_query;

		$wp_the_query_backup = $wp_the_query;
		
		$wp_the_query = new WP_Query(array(
			'page_id' => $top_inner_page_id,
		));

		if ($wp_the_query->have_posts()) {
			$wp_the_query->the_post();
			?>

			<div id="top-panel-inner" class="<?php echo esc_attr($top_panel_inner_class); ?>">
				<div class="top-panel-inner-wrapper">
					<?php the_content(); ?>
					<?php if (function_exists('mvb_the_content')) { mvb_the_content(); } ?>
					
					<a class="top-inner-page-close mobile-hide" href="#"><span></span></a>
				</div>
			</div>

			<?php 	
			$wp_the_query = $wp_the_query_backup;
			wp_reset_postdata();
		}
	}
}
