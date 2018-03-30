<?php
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'mars_home_v4_fullwidth_6cols' ) ){
	function mars_home_v4_fullwidth_6cols($data) {
		$template               = array();
		$template['name']       = __( 'Homepage V4 - Fullwidth - 6 Cols', 'mars' );
		$template['image_path'] = get_template_directory_uri() .'/img/home_v4_fullwidth_6cols.png'; // always use preg replace to be sure that "space" will not break logic
		$template['custom_class'] = 'mars_home_v4_fullwidth_6cols';
		$template['content']    = <<<CONTENT
		[vc_row][vc_column width="1/1"][videotube type="main" show="18" id="video-widget-8372" rows="1" columns="6" navigation="on" orderby="ID" order="DESC" title="Recent videos"][/vc_column][/vc_row]
CONTENT;
		array_unshift($data, $template);
		return $data;
	}
	add_filter( 'vc_load_default_templates', 'mars_home_v4_fullwidth_6cols', 60, 1 );
}
