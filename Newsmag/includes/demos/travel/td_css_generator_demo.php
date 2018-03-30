<?php
/**
 * Created by ra.
 * Date: 9/2/2015
 * CSS generator for this specific demo
 */


function td_css_demo_gen() {
	$td_demo_custom_css = "
	<style>

	/* @theme_color */
	.td-newsmag-travel .td-header-style-3 .sf-menu > li > a:hover,
	.td-newsmag-travel .td-header-style-3 .sf-menu > .sfHover > a,
	.td-newsmag-travel .td-header-style-3 .sf-menu > .current-menu-item > a,
	.td-newsmag-travel .td-header-style-3 .sf-menu > .current-menu-ancestor > a,
	.td-newsmag-travel .td-header-style-3 .sf-menu > .current-category-ancestor > a {
		color: @theme_color;
	}
	.td-newsmag-travel .block-title > a,
	.td-newsmag-travel .block-title > span,
	.td-newsmag-travel .td-module-comments,
	.td-newsmag-travel .td-search-form-widget .wpb_button,
	.td-newsmag-travel .td-related-title .td-cur-simple-item,
	.td-newsmag-travel .td-subcategory-header .td-category a:hover,
	.td-newsmag-travel .td-subcategory-header a.td-current-sub-category,
	.td-newsmag-travel .td-read-more a,
	.td-newsmag-travel .td-category-header .entry-title span,
	.td-newsmag-travel .td_module_15 .td-category a:hover,
	.td-newsmag-travel .td-footer-container .td-post-category {
		background-color: @theme_color;
	}
	.td-newsmag-travel .td-related-title .td-cur-simple-item {
		border-color: @theme_color;
	}
	.td-newsmag-travel .td-module-comments a:after {
		border-color: @theme_color transparent transparent transparent;
	}

	 /* @menu_text_color */
    .td-newsmag-travel .td-header-style-3 .sf-menu > li > a,
    .td-newsmag-travel .td-header-style-3 .header-search-wrap .td-icon-search,
    .td-newsmag-travel .td-header-style-3 #td-top-mobile-toggle i {
        color: @menu_text_color;
    }

	</style>
	";

	$td_demo_css_compiler = new td_css_compiler($td_demo_custom_css);

	$td_demo_css_compiler->load_setting('theme_color');
	$td_demo_css_compiler->load_setting('menu_text_color');

	return $td_demo_css_compiler->compile_css();
}
