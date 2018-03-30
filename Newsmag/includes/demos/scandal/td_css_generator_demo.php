<?php
/**
 * Created by ra.
 * Date: 9/2/2015
 * CSS generator for this specific demo
 */


function td_css_demo_gen() {
	$td_demo_custom_css = "
	<style>

	/*@theme_color */
	.td-scandal .td-header-style-10 .sf-menu > li > a,
	.td-scandal .td-scandal-instagram .td-instagram-button:hover {
	  color: @theme_color !important;
	}


	.td-scandal .td-grid-style-2 .td-big-grid-meta,
	.td-scandal .td-scandal-videos,
	.td-scandal .td-scandal-videos .td_video_playlist_title,
	.td-scandal .td-scandal-instagram,
	.td-scandal .td_module_11 .td-read-more:hover a,
	.td-scandal .td-post-template-4 header {
      background-color: @theme_color !important;
    }

	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('menu_text_color');

	return $td_demo_css_compiler->compile_css();
}
