<?php
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'mars_home_v5_1col_left_sidebar_v2' ) ){
	function mars_home_v5_1col_left_sidebar_v2($data) {
		$template               = array();
		$template['name']       = __( 'Homepage V5 - 1Col - Left Sidebar - V2', 'mars' );
		$template['image_path'] = get_template_directory_uri() .'/img/home_v5_1col_lefts_sidebar_v2.png'; // always use preg replace to be sure that "space" will not break logic
		$template['custom_class'] = 'mars_home_v5_1col_left_sidebar_v2';
		$template['content']    = <<<CONTENT
[vc_row][vc_column width="1/1"][vc_row_inner][vc_column_inner width="4/12" el_class="sidebar"][mars_vc_socialsbox title="Socials Box"][videotube type="widget" show="3" id="video-widget-3338" rows="1" columns="1" title="Latest Videos" orderby="ID" order="DESC"][vc_wp_text title="ABOUT VIDEOTUBE"]Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean which is great.

A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences.[/vc_wp_text][videotube type="widget" show="4" id="video-widget-2003" rows="1" columns="2" title="Top Videos Comment" orderby="comment_count" order="DESC"][videotube type="widget" show="4" id="video-widget-3338" rows="1" columns="2" title="Random Videos" orderby="ID" order="DESC"][vc_wp_text title="LIKE US ON FACEBOOK"]<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FFacebookDevelopers&amp;width=360&amp;height=290&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=false" width="360" height="260"></iframe>[/vc_wp_text][/vc_column_inner][vc_column_inner width="8/12" css=".vc_custom_1405954490755{padding-left: 0px !important;}"][videotube type="widget" carousel="on" show="10" id="video-widget-8784" rows="1" columns="3" title="Featured Videos" tag="231" orderby="ID" order="DESC"][videotube type="widget" carousel="on" show="8" id="video-widget-1532" rows="1" columns="2" title="Popular Videos (Top Comment Videos)" orderby="comment_count" order="DESC"][videotube type="main" show="10" id="video-widget-3911" rows="1" columns="1" navigation="on" title="Recent Videos" thumbnail_size=" blog-large-thumb" orderby="ID" order="DESC"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]
CONTENT;
		array_unshift($data, $template);
		return $data;
	}
	add_filter( 'vc_load_default_templates', 'mars_home_v5_1col_left_sidebar_v2', 70, 1 );
}

