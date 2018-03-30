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
	.td-newsmag-cars .block-title > a, .block-title > span,
	.td-newsmag-cars .block-title > span,
	.td-newsmag-cars .td-car-videos .td_video_playlist_title,
	.td-newsmag-cars .td-search-form-widget .wpb_button,
	.td-newsmag-cars.td_category_template_3 .td-scrumb-holder .td-pb-span12 {
      background-color: @theme_color;
    }

	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('menu_text_color');

	return $td_demo_css_compiler->compile_css();
}
