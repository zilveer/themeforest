<?php
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'mars_home_v3_fullwidth_4cols' ) ){
	function mars_home_v3_fullwidth_4cols($data) {
		$template               = array();
		$template['name']       = __( 'Homepage V3 - Fullwidth - 4 Cols', 'mars' );
		$template['image_path'] = get_template_directory_uri() .'/img/home_v3_fullwidth_4cols.png'; // always use preg replace to be sure that "space" will not break logic
		$template['custom_class'] = 'mars_home_v3_fullwidth_4cols';
		$template['content']    = <<<CONTENT
		[vc_row][vc_column width="1/1"][videotube type="main" show="16" id="video-widget-3016" rows="1" columns="4" navigation="on" title="Recent Videos" orderby="ID" order="DESC"][/vc_column][/vc_row]
CONTENT;
		array_unshift($data, $template);
		return $data;
	}
	add_filter( 'vc_load_default_templates', 'mars_home_v3_fullwidth_4cols', 50, 1 );
}

