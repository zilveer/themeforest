<?php
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'mars_home_v2_fullwidth_3cols' ) ){
	function mars_home_v2_fullwidth_3cols($data) {
		$template               = array();
		$template['name']       = __( 'Homepage V2 - Fullwidth - 3 Cols', 'mars' );
		$template['image_path'] = get_template_directory_uri() .'/img/home_v2_fullwidth_3cols.png'; // always use preg replace to be sure that "space" will not break logic
		$template['custom_class'] = 'mars_home_v2_fullwidth_3cols';
		$template['content']    = <<<CONTENT
		[vc_row][vc_column width="1/1"][videotube type="main" show="12" id="video-widget-5228" rows="1" columns="3" navigation="on" title="Recent Videos" orderby="ID" order="DESC"][/vc_column][/vc_row]
CONTENT;
		array_unshift($data, $template);
		return $data;
	}
	add_filter( 'vc_load_default_templates', 'mars_home_v2_fullwidth_3cols', 40, 1 );
}
