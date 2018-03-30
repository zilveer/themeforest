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
	.td-newsmag-animals .td-module-comments,
	.td-newsmag-animals .td_module_mx1 .td-post-category,
	.td-newsmag-animals .td_video_playlist_title,
	.td-newsmag-animals .td-footer-container .block-title > a,
	.td-newsmag-animals .td-footer-container .block-title > span {
      background-color: @theme_color;
    }

	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('menu_text_color');

	return $td_demo_css_compiler->compile_css();
}
