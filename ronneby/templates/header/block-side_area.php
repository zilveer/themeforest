<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $post, $dfd_ronneby;
if (!empty($post) && is_object($post)) {
	$page_id = $post->ID;
	$show_side_area = get_post_meta($page_id, 'dfd_headers_show_side_area', true);
	if(empty($show_side_area)) {
		$show_side_area = isset($dfd_ronneby['side_area_enable']) && !empty($dfd_ronneby['side_area_enable']) ? $dfd_ronneby['side_area_enable'] : 'on';
	}

	if (strcmp($show_side_area, 'off') !== 0) {
		?>
		<div class="side-area-controller-wrap">
			<a href="#" class="side-area-controller">
				<span class="icon-wrap dfd-middle-line"></span>
				<span class="icon-wrap dfd-top-line"></span>
				<span class="icon-wrap dfd-bottom-line"></span>
			</a>
		</div>
		<?php
	}
}
