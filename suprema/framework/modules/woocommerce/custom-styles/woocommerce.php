<?php

if (!function_exists('suprema_qodef_standard_product_list_title_style')) {

    function suprema_qodef_standard_product_list_title_style()
    {
        $text_styles = array();

        if (suprema_qodef_options()->getOptionValue('product_list_standard_text_color') !== '') {
            $text_styles['color'] = suprema_qodef_options()->getOptionValue('product_list_standard_text_color');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_standard_text_fontsize') !== '') {
            $text_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('product_list_standard_text_fontsize')) . 'px';
        }
        if (suprema_qodef_options()->getOptionValue('product_list_standard_text_texttransform') !== '') {
            $text_styles['text-transform'] = suprema_qodef_options()->getOptionValue('product_list_standard_text_texttransform');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_standard_text_google_fonts') !== '-1') {
            $text_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('product_list_standard_text_google_fonts')) . ', sans-serif';
        }
        if (suprema_qodef_options()->getOptionValue('product_list_standard_text_fontstyle') !== '') {
            $text_styles['font-style'] = suprema_qodef_options()->getOptionValue('product_list_standard_text_fontstyle');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_standard_text_fontweight') !== '') {
            $text_styles['font-weight'] = suprema_qodef_options()->getOptionValue('product_list_standard_text_fontweight');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_standard_text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('product_list_standard_text_letterspacing')) . 'px';
        }

        if (!empty($text_styles)) {
            echo suprema_qodef_dynamic_css('.woocommerce .products.standard .product .qodef-product-list-product-title, .qodef-woocommerce-page .products.standard .product .qodef-product-list-product-title', $text_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_standard_product_list_title_style');
}


if (!function_exists('suprema_qodef_boxed_product_list_title_style')) {

    function suprema_qodef_boxed_product_list_title_style()
    {
        $text_styles = array();

        if (suprema_qodef_options()->getOptionValue('product_list_boxed_text_color') !== '') {
            $text_styles['color'] = suprema_qodef_options()->getOptionValue('product_list_boxed_text_color');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_boxed_text_fontsize') !== '') {
            $text_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('product_list_boxed_text_fontsize')) . 'px';
        }
        if (suprema_qodef_options()->getOptionValue('product_list_boxed_text_texttransform') !== '') {
            $text_styles['text-transform'] = suprema_qodef_options()->getOptionValue('product_list_boxed_text_texttransform');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_boxed_text_google_fonts') !== '-1') {
            $text_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('product_list_boxed_text_google_fonts')) . ', sans-serif';
        }
        if (suprema_qodef_options()->getOptionValue('product_list_boxed_text_fontstyle') !== '') {
            $text_styles['font-style'] = suprema_qodef_options()->getOptionValue('product_list_boxed_text_fontstyle');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_boxed_text_fontweight') !== '') {
            $text_styles['font-weight'] = suprema_qodef_options()->getOptionValue('product_list_boxed_text_fontweight');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_boxed_text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('product_list_boxed_text_letterspacing')) . 'px';
        }

        if (!empty($text_styles)) {
            echo suprema_qodef_dynamic_css('.woocommerce .products.boxed .product .qodef-product-list-product-title, .qodef-woocommerce-page .products.boxed .product .qodef-product-list-product-title', $text_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_boxed_product_list_title_style');
}


if (!function_exists('suprema_qodef_simple_product_list_title_style')) {

    function suprema_qodef_simple_product_list_title_style()
    {
        $text_styles = array();

        if (suprema_qodef_options()->getOptionValue('product_list_simple_text_color') !== '') {
            $text_styles['color'] = suprema_qodef_options()->getOptionValue('product_list_simple_text_color');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_simple_text_fontsize') !== '') {
            $text_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('product_list_simple_text_fontsize')) . 'px';
        }
        if (suprema_qodef_options()->getOptionValue('product_list_simple_text_texttransform') !== '') {
            $text_styles['text-transform'] = suprema_qodef_options()->getOptionValue('product_list_simple_text_texttransform');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_simple_text_google_fonts') !== '-1') {
            $text_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('product_list_simple_text_google_fonts')) . ', sans-serif';
        }
        if (suprema_qodef_options()->getOptionValue('product_list_simple_text_fontstyle') !== '') {
            $text_styles['font-style'] = suprema_qodef_options()->getOptionValue('product_list_simple_text_fontstyle');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_simple_text_fontweight') !== '') {
            $text_styles['font-weight'] = suprema_qodef_options()->getOptionValue('product_list_simple_text_fontweight');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_simple_text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('product_list_simple_text_letterspacing')) . 'px';
        }

        if (!empty($text_styles)) {
            echo suprema_qodef_dynamic_css('.woocommerce .products.simple .product .qodef-product-list-product-title, .qodef-woocommerce-page .products.simple .product .qodef-product-list-product-title', $text_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_simple_product_list_title_style');
}



if (!function_exists('suprema_qodef_masonry_product_list_title_style')) {

    function suprema_qodef_masonry_product_list_title_style()
    {
        $text_styles = array();

        if (suprema_qodef_options()->getOptionValue('product_list_masonry_text_color') !== '') {
            $text_styles['color'] = suprema_qodef_options()->getOptionValue('product_list_masonry_text_color');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_masonry_text_fontsize') !== '') {
            $text_styles['font-size'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('product_list_masonry_text_fontsize')) . 'px';
        }
        if (suprema_qodef_options()->getOptionValue('product_list_masonry_text_texttransform') !== '') {
            $text_styles['text-transform'] = suprema_qodef_options()->getOptionValue('product_list_masonry_text_texttransform');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_masonry_text_google_fonts') !== '-1') {
            $text_styles['font-family'] = suprema_qodef_get_formatted_font_family(suprema_qodef_options()->getOptionValue('product_list_masonry_text_google_fonts')) . ', sans-serif';
        }
        if (suprema_qodef_options()->getOptionValue('product_list_masonry_text_fontstyle') !== '') {
            $text_styles['font-style'] = suprema_qodef_options()->getOptionValue('product_list_masonry_text_fontstyle');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_masonry_text_fontweight') !== '') {
            $text_styles['font-weight'] = suprema_qodef_options()->getOptionValue('product_list_masonry_text_fontweight');
        }
        if (suprema_qodef_options()->getOptionValue('product_list_masonry_text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = suprema_qodef_filter_px(suprema_qodef_options()->getOptionValue('product_list_masonry_text_letterspacing')) . 'px';
        }

        if (!empty($text_styles)) {
            echo suprema_qodef_dynamic_css('.qodef-shop-masonry .qodef-shop-product .qodef-masonry-product-overlay-outer .qodef-product-list-product-title', $text_styles);
        }
    }

    add_action('suprema_qodef_style_dynamic', 'suprema_qodef_masonry_product_list_title_style');
}



?>