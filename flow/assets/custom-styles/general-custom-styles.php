<?php
if(!function_exists('flow_elated_design_styles')) {
    /**
     * Generates general custom styles
     */
    function flow_elated_design_styles() {

        $preload_background_styles = array();

        if(flow_elated_options()->getOptionValue('preload_pattern_image') !== ""){
            $preload_background_styles['background-image'] = 'url('.flow_elated_options()->getOptionValue('preload_pattern_image').') !important';
        }else{
            $preload_background_styles['background-image'] = 'url('.esc_url(ELATED_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo flow_elated_dynamic_css('.eltd-preload-background', $preload_background_styles);

		if (flow_elated_options()->getOptionValue('google_fonts')){
			$font_family = flow_elated_options()->getOptionValue('google_fonts');
			if(flow_elated_is_font_option_valid($font_family)) {
				echo flow_elated_dynamic_css('body', array('font-family' => flow_elated_get_font_option_val($font_family)));
			}
		}

        if(flow_elated_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
				'.eltd-blog-holder article .eltd-post-info > div.eltd-post-info-category',
				'.eltd-blog-holder article.sticky .eltd-post-title a',
				'.eltd-blog-holder article .eltd-post-info > div:not(.eltd-post-info-category):not(.eltd-blog-share) a:hover',
				'.eltd-blog-holder.eltd-blog-single article .eltd-post-info.eltd-post-info-author',
				'.eltd-blog-holder.eltd-blog-single article .eltd-post-info.eltd-post-info-author a',
				'.eltd-filter-blog-holder li.eltd-active',
				'.eltd-single-tags-holder .eltd-tags a:hover span',
				'.eltd-blog-single-navigation .eltd-blog-navigation-info-holder a.eltd-animating span',
				'.eltd-author-description .eltd-author-social-holder a:hover',			
				'.eltd-related-posts-holder .eltd-related-post > a:hover ~ .eltd-related-post-title > a > h6',
				'.eltd-related-posts-holder .eltd-related-post .eltd-related-post-title a:hover h6',
				'.eltd-blog-list-holder.eltd-image-in-box .eltd-item-info-section.eltd-category a',
				'.eltd-blog-slide-item .eltd-blog-slide-categories',
				'.eltd-blog-carousel-item .eltd-blog-carousel-categories',
				'.eltd-blog-carousel.eltd-slider .eltd-blog-slide-arrow .eltd-next-icon-holder span',
				'.eltd-blog-carousel.eltd-slider .eltd-blog-slide-arrow .eltd-prev-icon-holder span',
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h4 a:hover',
				'h5 a:hover',
				'h6 a:hover',
				'a',
				'p a',
				'.eltd-blog-list-holder.eltd-image-in-box .eltd-item-info-section.eltd-category a',
				'.eltd-blog-slide-item .eltd-blog-slide-categories',
				'.eltd-blog-carousel-item .eltd-blog-carousel-categories',
				'.eltd-comment .eltd-comment-info > span:hover > span',
				'.eltd-comment .eltd-comment-info > span:hover > a',
				'.eltd-owl-slider .owl-buttons .eltd-prev-icon-holder span',
				'.eltd-owl-slider .owl-buttons .eltd-next-icon-holder span',
				'.eltd-drop-down .second .inner > ul > li:hover > a',
				'.eltd-drop-down .second .inner ul li.sub ul li:hover > a',
				'.eltd-drop-down .wide .second .inner > ul > li > a:hover',
				'.eltd-drop-down .wide .second .inner ul li.sub .flexslider ul li a:hover',
				'.eltd-drop-down .wide .second ul li .flexslider ul li a:hover',
				'.eltd-drop-down .wide .second .inner ul li.sub .flexslider.widget_flexslider .menu_recent_post_text a:hover',
				'.eltd-header-vertical .eltd-vertical-dropdown-float .second .inner ul li a:hover',
				'.eltd-mobile-header .eltd-mobile-nav ul > li:hover > a',
				'.eltd-header-vertical .eltd-vertical-menu ul li.eltd-active-item a',
				'.eltd-header-vertical .eltd-vertical-menu ul li:hover a',
				'.eltd-mobile-header .eltd-mobile-nav ul > li.current-menu-item > a',
				'.eltd-mobile-header .eltd-mobile-nav ul > li:hover > .mobile_arrow',
				'.eltd-mobile-header .eltd-mobile-nav ul > li.current-menu-item > .mobile_arrow',
				'.eltd-mobile-header .eltd-mobile-menu-opener a:hover',
				'.eltd-message .eltd-message-inner a.eltd-close i:hover',
				'.eltd-ordered-list ol > li:before',
				'.eltd-icon-list-item .eltd-icon-list-icon-holder-inner i',
				'.eltd-icon-list-item .eltd-icon-list-icon-holder-inner .font_elegant',
				'.eltd-blog-list-holder .eltd-item-info-section > div a',
				'.eltd-blog-list-holder .eltd-item-info-section > div:before',
				'.eltd-blog-list-holder .eltd-item-info-section span',
				'.eltd-btn.eltd-btn-outline',
				'.eltd-dropcaps',
				'.eltd-social-share-holder.eltd-list li a:hover',
				'.eltd-section-title-outer-holder .eltd-section-title',
				'aside.eltd-sidebar .widget ul li a:hover',
				'footer .widget ul li a:hover',
				'aside.eltd-sidebar .widget.widget_rss a.rsswidget',
				'footer .widget.widget_rss a.rsswidget',
				'aside.eltd-sidebar .widget.widget_rss li .rss-date',
				'footer .widget.widget_rss li .rss-date',
				'aside.eltd-sidebar .widget.widget_recent_entries span.post-date',
				'footer .widget.widget_recent_entries span.post-date',
				'aside.eltd-sidebar .eltd-instagram-feed.carousel .owl-buttons .eltd-prev-icon-holder span',
				'.eltd-content-bottom .eltd-instagram-feed.carousel .owl-buttons .eltd-prev-icon-holder span',
				'.eltd-content-bottom .eltd-instagram-feed.carousel .owl-buttons .eltd-next-icon-holder span',
				'footer .eltd-instagram-feed.carousel .owl-buttons .eltd-prev-icon-holder span',
				'footer .eltd-instagram-feed.carousel .owl-buttons .eltd-next-icon-holder span',
				'.eltd-social-icon-widget-holder a:hover',
				'.eltd-footer-inner #lang_sel a:hover',
				'.eltd-side-menu #lang_sel a:hover',
				'.eltd-main-menu .menu-item-language .submenu-languages a:hover',
				'.eltd-position-right #lang_sel ul ul a:hover',
				'.eltd-menu-area #lang_sel ul ul a:hover'
            );


            $background_color_selector = array(
				'.eltd-blog-holder:not(.eltd-blog-single) .eltd-single-post-preload-holder:not(.eltd-read-more-preload) .eltd-preload-square:before',
				'.eltd-blog-holder:not(.eltd-blog-single) .eltd-single-post-preload-holder.eltd-read-more-preload',
				'.eltd-blog-holder:not(.eltd-blog-single) .eltd-single-post-preload-holder.eltd-read-more-preload:before',
				'.eltd-blog-holder:not(.eltd-blog-single) .eltd-single-post-preload-holder.eltd-read-more-preload:after',
				'.eltd-blog-holder:not(.eltd-blog-single) .eltd-category-preload-holder',
				'.eltd-blog-holder:not(.eltd-blog-single) .eltd-tag-preload-holder',
				'.eltd-blog-holder:not(.eltd-blog-single) .eltd-category-preload-holder:before',
				'.eltd-blog-holder:not(.eltd-blog-single) .eltd-tag-preload-holder:before',
				'.eltd-blog-holder:not(.eltd-blog-single) .eltd-category-preload-holder:after',
				'.eltd-blog-holder:not(.eltd-blog-single) .eltd-tag-preload-holder:after',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item.eltd-blei-h-1 .eltd-blog-audio-holder .mejs-container',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item.eltd-blei-h-1 .eltd-blog-audio-holder .mejs-controls',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item.eltd-blei-h-1 .eltd-post-mark',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-blei-upper-wrapper .eltd-blei-page-title-holder',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .slides-cover',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-blei-link .eltd-play-button',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-blei-link .eltd-play-button.eltd-preloading ~ .eltd-video-post-preloading',
				'.eltd-list-loading .eltd-blog-list-preload-holder .eltd-preload-square:before',
				'.eltd-diamond-spinner .eltd-preload-square:before',
				'.eltd-st-loader .pulse',
				'.eltd-st-loader .double_pulse .double-bounce1',
				'.eltd-st-loader .double_pulse .double-bounce2',
				'.eltd-st-loader .cube',
				'.eltd-st-loader .rotating_cubes .cube1',
				'.eltd-st-loader .rotating_cubes .cube2',
				'.eltd-st-loader .wave > div',
				'.eltd-st-loader .two_rotating_circles .dot1',
				'.eltd-st-loader .two_rotating_circles .dot2',
				'.eltd-st-loader .five_rotating_circles .container1 > div',
				'.eltd-st-loader .five_rotating_circles .container2 > div',
				'.eltd-st-loader .five_rotating_circles .container3 > div',
				'.eltd-st-loader .lines .line1',
				'.eltd-st-loader .lines .line2',
				'.eltd-st-loader .lines .line3',
				'.eltd-st-loader .lines .line4',
				'#submit_comment',
				'.post-password-form input[type="submit"]',
				'input.wpcf7-form-control.wpcf7-submit',
				'.eltd-main-menu ul li:hover, .eltd-main-menu ul li.eltd-active-item',
				'.eltd-header-vertical .eltd-vertical-dropdown-toggle .second',
				'.eltd-header-vertical .eltd-vertical-menu > ul > li > a:before',
				'.eltd-header-vertical .eltd-vertical-menu > ul > li > a:after',
				'.eltd-mobile-header .eltd-mobile-nav ul ul',
				'.eltd-title',
				'.eltd-icon-shortcode.circle, .eltd-icon-shortcode.square',
				'.eltd-btn.eltd-btn-solid',
				'.eltd-load-more-btn-holder .eltd-btn-load-more',
				'.eltd-dropcaps.eltd-square, .eltd-dropcaps.eltd-circle',
				'.widget_eltd_search .eltd-search-holder.eltd-search-open'
            );
			
			
			$background_selector = array(
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-blei-collapse:before',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .owl-controls .owl-pagination .owl-page',
				'.eltd-st-loader .atom .ball-1:before',
				'.eltd-st-loader .atom .ball-2:before',
				'.eltd-st-loader .atom .ball-3:before',
				'.eltd-st-loader .atom .ball-4:before',
				'.eltd-st-loader .clock .ball:before',
				'.eltd-st-loader .mitosis .ball',
				'.eltd-st-loader .fussion .ball',
				'.eltd-st-loader .fussion .ball-1',
				'.eltd-st-loader .fussion .ball-2',
				'.eltd-st-loader .fussion .ball-3',
				'.eltd-st-loader .fussion .ball-4',
				'.eltd-st-loader .wave_circles .ball',
				'.eltd-st-loader .pulse_circles .ball',
				'#eltd-back-to-top .eltd-icon-stack',
				'.eltd-blog-carousel .slick-dots li button',
				'.eltd-load-more-btn-holder .eltd-btn-load-more:hover',
				'#submit_comment:hover',
				'.post-password-form input[type=submit]:hover',
				'input.wpcf7-form-control.wpcf7-submit:hover',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-blei-upper-wrapper .eltd-blei-link .eltd-play-button',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-blei-upper-wrapper .eltd-blei-link .eltd-play-button.eltd-preloading~.eltd-video-post-preloading',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-blei-upper-wrapper .slides-cover',
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-blei-upper-wrapper .owl-controls .owl-pagination .owl-page'
            );
			
            $background_color_important_selector = array(
				'.eltd-btn.eltd-btn-outline:not(.eltd-btn-custom-hover-bg):hover',
				'.eltd-btn.eltd-btn-outline:not(.eltd-btn-custom-border-hover):hover'
            );			

            $border_color_selector = array(
				'.eltd-blog-holder.eltd-blog-type-expanding-tiles .eltd-blog-list-expandable-item .eltd-blei-upper-wrapper.odd .eltd-featured-triangle-holder .eltd-featured-triangle ',
				'.eltd-st-loader .pulse_circles .ball',
				'.wpcf7-form-control.wpcf7-text:focus',
				'.wpcf7-form-control.wpcf7-number:focus',
				'.wpcf7-form-control.wpcf7-date:focus',
				'.wpcf7-form-control.wpcf7-textarea:focus',
				'.wpcf7-form-control.wpcf7-select:focus',
				'.wpcf7-form-control.wpcf7-quiz:focus',
				'#respond textarea:focus',
				'#respond input[type="text"]:focus',
				'#submit_comment',
				'.post-password-form input[type="submit"]',
				'input.wpcf7-form-control.wpcf7-submit',
				'#submit_comment:focus',
				'.post-password-form input[type="submit"]:focus',
				'input.wpcf7-form-control.wpcf7-submit:focus',
				'.eltd-btn.eltd-btn-outline'
            );
			
			
			$background_rgba_color_selector = array(
				'.eltd-blog-holder article.format-quote .eltd-post-text',
				'.eltd-blog-holder article.format-link .eltd-post-text'
			);
			
			$rgb_color_array = flow_elated_hex2rgb(flow_elated_options()->getOptionValue('first_color'));			
            $rgba_color = 'rgba('.implode(', ', $rgb_color_array).', 0.9)';

            echo flow_elated_dynamic_css($color_selector, array('color' => flow_elated_options()->getOptionValue('first_color')));
            echo flow_elated_dynamic_css('::selection', array('background' => flow_elated_options()->getOptionValue('first_color')));
            echo flow_elated_dynamic_css('::-moz-selection', array('background' => flow_elated_options()->getOptionValue('first_color')));
            echo flow_elated_dynamic_css($background_color_selector, array('background-color' => flow_elated_options()->getOptionValue('first_color')));
			echo flow_elated_dynamic_css($background_selector, array('background' => flow_elated_options()->getOptionValue('first_color')));
            echo flow_elated_dynamic_css($background_color_important_selector, array('background-color' => flow_elated_options()->getOptionValue('first_color').'!important'));
            echo flow_elated_dynamic_css($border_color_selector, array('border-color' => flow_elated_options()->getOptionValue('first_color')));
			echo flow_elated_dynamic_css($background_rgba_color_selector, array('background-color' => $rgba_color));
	        echo flow_elated_dynamic_css( '.eltd-blog-holder article .eltd-featured-triangle-holder .eltd-featured-triangle', array(
		        'border-right-color' => flow_elated_options()->getOptionValue('first_color'),
	        ) );
        }

		if (flow_elated_options()->getOptionValue('page_background_color')) {
			$background_color_selector = array(
				'.eltd-wrapper-inner',
				'.eltd-content'
			);
			echo flow_elated_dynamic_css($background_color_selector, array('background-color' => flow_elated_options()->getOptionValue('page_background_color')));
		}

		if (flow_elated_options()->getOptionValue('selection_color')) {
			echo flow_elated_dynamic_css('::selection', array('background' => flow_elated_options()->getOptionValue('selection_color')));
			echo flow_elated_dynamic_css('::-moz-selection', array('background' => flow_elated_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (flow_elated_options()->getOptionValue('page_background_color_in_box')) {
			$boxed_background_style['background-color'] = flow_elated_options()->getOptionValue('page_background_color_in_box');
		}

		if (flow_elated_options()->getOptionValue('boxed_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(flow_elated_options()->getOptionValue('boxed_background_image')).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}

		if (flow_elated_options()->getOptionValue('boxed_pattern_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(flow_elated_options()->getOptionValue('boxed_pattern_background_image')).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}

		if (flow_elated_options()->getOptionValue('boxed_background_image_attachment')) {
			$boxed_background_style['background-attachment'] = (flow_elated_options()->getOptionValue('boxed_background_image_attachment'));
		}

		echo flow_elated_dynamic_css('.eltd-boxed .eltd-wrapper', $boxed_background_style);
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_design_styles');
}

if (!function_exists('flow_elated_h1_styles')) {

    function flow_elated_h1_styles() {

        $h1_styles = array();

        if(flow_elated_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = flow_elated_options()->getOptionValue('h1_color');
        }
        if(flow_elated_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = flow_elated_get_formatted_font_family(flow_elated_options()->getOptionValue('h1_google_fonts'));
        }
        if(flow_elated_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(flow_elated_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(flow_elated_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = flow_elated_options()->getOptionValue('h1_texttransform');
        }
        if(flow_elated_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = flow_elated_options()->getOptionValue('h1_fontstyle');
        }
        if(flow_elated_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = flow_elated_options()->getOptionValue('h1_fontweight');
        }
        if(flow_elated_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo flow_elated_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_h1_styles');
}

if (!function_exists('flow_elated_h2_styles')) {

    function flow_elated_h2_styles() {

        $h2_styles = array();

        if(flow_elated_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = flow_elated_options()->getOptionValue('h2_color');
        }
        if(flow_elated_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = flow_elated_get_formatted_font_family(flow_elated_options()->getOptionValue('h2_google_fonts'));
        }
        if(flow_elated_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(flow_elated_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(flow_elated_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = flow_elated_options()->getOptionValue('h2_texttransform');
        }
        if(flow_elated_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = flow_elated_options()->getOptionValue('h2_fontstyle');
        }
        if(flow_elated_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = flow_elated_options()->getOptionValue('h2_fontweight');
        }
        if(flow_elated_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo flow_elated_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_h2_styles');
}

if (!function_exists('flow_elated_h3_styles')) {

    function flow_elated_h3_styles() {

        $h3_styles = array();

        if(flow_elated_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = flow_elated_options()->getOptionValue('h3_color');
        }
        if(flow_elated_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = flow_elated_get_formatted_font_family(flow_elated_options()->getOptionValue('h3_google_fonts'));
        }
        if(flow_elated_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(flow_elated_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(flow_elated_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = flow_elated_options()->getOptionValue('h3_texttransform');
        }
        if(flow_elated_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = flow_elated_options()->getOptionValue('h3_fontstyle');
        }
        if(flow_elated_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = flow_elated_options()->getOptionValue('h3_fontweight');
        }
        if(flow_elated_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo flow_elated_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_h3_styles');
}

if (!function_exists('flow_elated_h4_styles')) {

    function flow_elated_h4_styles() {

        $h4_styles = array();

        if(flow_elated_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = flow_elated_options()->getOptionValue('h4_color');
        }
        if(flow_elated_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = flow_elated_get_formatted_font_family(flow_elated_options()->getOptionValue('h4_google_fonts'));
        }
        if(flow_elated_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(flow_elated_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(flow_elated_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = flow_elated_options()->getOptionValue('h4_texttransform');
        }
        if(flow_elated_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = flow_elated_options()->getOptionValue('h4_fontstyle');
        }
        if(flow_elated_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = flow_elated_options()->getOptionValue('h4_fontweight');
        }
        if(flow_elated_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo flow_elated_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_h4_styles');
}

if (!function_exists('flow_elated_h5_styles')) {

    function flow_elated_h5_styles() {

        $h5_styles = array();

        if(flow_elated_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = flow_elated_options()->getOptionValue('h5_color');
        }
        if(flow_elated_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = flow_elated_get_formatted_font_family(flow_elated_options()->getOptionValue('h5_google_fonts'));
        }
        if(flow_elated_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(flow_elated_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(flow_elated_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = flow_elated_options()->getOptionValue('h5_texttransform');
        }
        if(flow_elated_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = flow_elated_options()->getOptionValue('h5_fontstyle');
        }
        if(flow_elated_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = flow_elated_options()->getOptionValue('h5_fontweight');
        }
        if(flow_elated_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo flow_elated_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_h5_styles');
}

if (!function_exists('flow_elated_h6_styles')) {

    function flow_elated_h6_styles() {

        $h6_styles = array();

        if(flow_elated_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = flow_elated_options()->getOptionValue('h6_color');
        }
        if(flow_elated_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = flow_elated_get_formatted_font_family(flow_elated_options()->getOptionValue('h6_google_fonts'));
        }
        if(flow_elated_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(flow_elated_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(flow_elated_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = flow_elated_options()->getOptionValue('h6_texttransform');
        }
        if(flow_elated_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = flow_elated_options()->getOptionValue('h6_fontstyle');
        }
        if(flow_elated_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = flow_elated_options()->getOptionValue('h6_fontweight');
        }
        if(flow_elated_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo flow_elated_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_h6_styles');
}

if (!function_exists('flow_elated_text_styles')) {

    function flow_elated_text_styles() {

        $text_styles = array();

        if(flow_elated_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = flow_elated_options()->getOptionValue('text_color');
        }
        if(flow_elated_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = flow_elated_get_formatted_font_family(flow_elated_options()->getOptionValue('text_google_fonts'));
        }
        if(flow_elated_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('text_fontsize')).'px';
        }
        if(flow_elated_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('text_lineheight')).'px';
        }
        if(flow_elated_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = flow_elated_options()->getOptionValue('text_texttransform');
        }
        if(flow_elated_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = flow_elated_options()->getOptionValue('text_fontstyle');
        }
        if(flow_elated_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = flow_elated_options()->getOptionValue('text_fontweight');
        }
        if(flow_elated_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = flow_elated_filter_px(flow_elated_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo flow_elated_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_text_styles');
}

if (!function_exists('flow_elated_link_styles')) {

    function flow_elated_link_styles() {

        $link_styles = array();

        if(flow_elated_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = flow_elated_options()->getOptionValue('link_color');
        }
        if(flow_elated_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = flow_elated_options()->getOptionValue('link_fontstyle');
        }
        if(flow_elated_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = flow_elated_options()->getOptionValue('link_fontweight');
        }
        if(flow_elated_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = flow_elated_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo flow_elated_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_link_styles');
}

if (!function_exists('flow_elated_link_hover_styles')) {

    function flow_elated_link_hover_styles() {

        $link_hover_styles = array();

        if(flow_elated_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = flow_elated_options()->getOptionValue('link_hovercolor');
        }
        if(flow_elated_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = flow_elated_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo flow_elated_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(flow_elated_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = flow_elated_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo flow_elated_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_link_hover_styles');
}

if (!function_exists('flow_elated_smooth_page_transition_styles')) {

    function flow_elated_smooth_page_transition_styles() {
        
        $loader_style = array();

        if(flow_elated_options()->getOptionValue('smooth_pt_bgnd_color') !== '') {
            $loader_style['background-color'] = flow_elated_options()->getOptionValue('smooth_pt_bgnd_color');
        }

        $loader_selector = array('.eltd-smooth-transition-loader');

        if (!empty($loader_style)) {
            echo flow_elated_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();

        if(flow_elated_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $spinner_style['background-color'] = flow_elated_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $spinner_selectors = array(
            '.eltd-st-loader .eltd-diamond-spinner .eltd-preload-square:before',
            '.eltd-st-loader .pulse',
            '.eltd-st-loader .double_pulse .double-bounce1',
            '.eltd-st-loader .double_pulse .double-bounce2',
            '.eltd-st-loader .cube',
            '.eltd-st-loader .rotating_cubes .cube1',
            '.eltd-st-loader .rotating_cubes .cube2',
            '.eltd-st-loader .stripes > div',
            '.eltd-st-loader .wave > div',
            '.eltd-st-loader .two_rotating_circles .dot1',
            '.eltd-st-loader .two_rotating_circles .dot2',
            '.eltd-st-loader .five_rotating_circles .container1 > div',
            '.eltd-st-loader .five_rotating_circles .container2 > div',
            '.eltd-st-loader .five_rotating_circles .container3 > div',
            '.eltd-st-loader .atom .ball-1:before',
            '.eltd-st-loader .atom .ball-2:before',
            '.eltd-st-loader .atom .ball-3:before',
            '.eltd-st-loader .atom .ball-4:before',
            '.eltd-st-loader .clock .ball:before',
            '.eltd-st-loader .mitosis .ball',
            '.eltd-st-loader .lines .line1',
            '.eltd-st-loader .lines .line2',
            '.eltd-st-loader .lines .line3',
            '.eltd-st-loader .lines .line4',
            '.eltd-st-loader .fussion .ball',
            '.eltd-st-loader .fussion .ball-1',
            '.eltd-st-loader .fussion .ball-2',
            '.eltd-st-loader .fussion .ball-3',
            '.eltd-st-loader .fussion .ball-4',
            '.eltd-st-loader .wave_circles .ball',
            '.eltd-st-loader .pulse_circles .ball'
        );

        if (!empty($spinner_style)) {
            echo flow_elated_dynamic_css($spinner_selectors, $spinner_style);
        }
    }

    add_action('flow_elated_style_dynamic', 'flow_elated_smooth_page_transition_styles');
}