<?php
/*
 * Custom theme styles
 */
add_action('wp_enqueue_scripts', 'crum_custom_styles',99 );

function crum_custom_styles(){

	$custom_css = '';

	$custom_accent_color = cs_get_customize_option( 'custom_scheme_color' );
	$custom_color_scheme = cs_get_customize_option( 'predefined_color_schemes' );

	if(isset($custom_accent_color) && !($custom_accent_color == '') && !($custom_accent_color == '#fbc011') && ('custom' === $custom_color_scheme)){

		$custom_css .= 'a, #main-wrapper .tweet-entry i, #main-wrapper .styled-list i, #main-wrapper .widget-entry ul li span, #main-wrapper .numbers .num,
		#main-wrapper .comments-link a,  #main-wrapper .logged-in-as a, #main-wrapper .share-post a,
		#main-wrapper .default-arrow:hover span, #main-wrapper .new-block.type-18 .tabs-switch.active, #main-wrapper .new-block.type-18 .tabs-switch:hover,
		#main-wrapper .compare-column-entry .price, #main-wrapper .blog-entry .post-data, #main-wrapper .blog-entry .post-data a, #main-wrapper .blog-entry .title:hover,
		#main-wrapper .banner-tabs span.title, #main-wrapper .banner-tabs .entry:hover span.description, #main-wrapper .new-block.color-background,
		#main-wrapper .new-block.type-14 .tabs-switch.active span, #main-wrapper .new-block.type-10 .position, #main-wrapper .popular-post-entry .content .date,
		#main-wrapper .popular-post-entry .content .title:hover, #main-wrapper .categories-wrapper .entry:hover, #main-wrapper .categories-wrapper .entry .number,
		#main-wrapper .blog-post .title a:hover, #main-wrapper blockquote cite, #main-wrapper .categories-wrapper .sub-wrapper a span, #main-wrapper .button.type-1,
		#main-wrapper .categories-wrapper .entry.toggle .glyphicon:before, #main-wrapper .latest-comment-entry .date .glyphicon, #main-wrapper .button.black,
		#main-wrapper .latest-comment-entry .title .name, #main-wrapper .latest-comment-entry .title .post-title:hover, #main-wrapper .arrow-button:hover,
		#main-wrapper .footer-bottom .footer-linck a:hover, #main-wrapper .accordeon .entry .title span, #main-wrapper .accordeon .entry .title:hover,
		#main-wrapper .author-text > a, #main-wrapper .author-entry .glyphicon, #main-wrapper .titel-left span, #main-wrapper .comment-content .name .reply,
		#main-wrapper .comment-content .date .glyphicon, #main-wrapper .posts-navigation .data .glyphicon, #main-wrapper .author-text .category, #main-wrapper
		.posts-navigation .data .category, #main-wrapper .posts-navigation .data .category, #main-wrapper .search-form .search-submit, #main-wrapper .tweet-entry a,
		#main-wrapper .widget-entry .tabs-switch.active, #main-wrapper .default-arrow.black span, #main-wrapper .message-box-entry.style-3, #main-wrapper .blockquote-icon,
		#main-wrapper .responsive-filtration-title .glyphicon, #main-wrapper .posts-navigation .title:hover, #main-wrapper.teaser .teaser-date .date-square p,
		#main-wrapper .teaser-copyright .copyright a, #main-wrapper .content-404 .title, #main-wrapper .content-404 .description a, #main-wrapper .submit-wrapper-icon,
		#main-wrapper .phone-icons-description .entry:hover .title, #main-wrapper .team-member__paddings-container .team-member__position, #main-wrapper .subscribe .form-icon,
		#main-wrapper .widget-testimonial .testimonial-icon, body.page-template-coming-soon #main-wrapper .teaser-date .date-square p, #main-wrapper .footer-bottom .media-icon a';
        $custom_css .= '{color: ' . $custom_accent_color . ';}';

		$custom_css .= '#main-wrapper .btn, #main-wrapper .paginator ul li .current, #main-wrapper .paginator ul li a:hover, #main-wrapper #nav a.act, #main-wrapper #nav a:hover,
		#main-wrapper #nav .submeny:hover .submeny-top, #main-wrapper #header.act #nav a:hover, #main-wrapper #header.act #nav a.act,
		#main-wrapper .titel-left:after, #main-wrapper .titel-top:after, #main-wrapper .swiper-active-switch, #main-wrapper ul li:after, #main-wrapper .block.type-6,
		#main-wrapper .video-popup a:hover, #main-wrapper .play:hover, #main-wrapper .mob-icon span, #main-wrapper .mob-icon span:before, #main-wrapper .mob-icon span:after,
		#main-wrapper .default-arrow, #main-wrapper .page-tagline .title:before, #main-wrapper .accordeon .entry.active, #main-wrapper .new-block.color-background,
		#main-wrapper .sorting-menu a.active, #main-wrapper .sorting-menu a:hover, #main-wrapper .banner-tabs span.title:before, #main-wrapper table thead td,
		#main-wrapper .new-block.type-10 .image-socials-box, #main-wrapper .tags-container a:hover, #main-wrapper .tagcloud a:hover, #main-wrapper .paginator ul li a.active,
		#main-wrapper .paginator ul li a:hover, #main-wrapper .blog-post.style-2 .date, #main-wrapper .share-post a:hover,  #main-wrapper .button.default-color,
		#main-wrapper .blog-post .thumbnail-entry blockquote.style-2:before, #main-wrapper .small-button, #main-wrapper .widget-entry .social-icons a, #main-wrapper .form-submit .button,
		#main-wrapper .button.type-1:hover, #main-wrapper .checkbox-entry.active.radio label:after, #main-wrapper .typography-article ol li:before,#main-wrapper .button.back-button,
		#main-wrapper .typography-article ul.list-style-3 li:before, #main-wrapper .message-box-entry.style-1, #main-wrapper .typography-article table th,
		#main-wrapper .mouse-icon:before, #main-wrapper .back-to-top, #main-wrapper .team-member__image-socials-box, #main-wrapper .styled-form .submit-wrapper:hover,
		#main-wrapper .styled-form .submit-wrapper:hover, #main-wrapper .titel-top .titel-line, #main-wrapper .titel-right span,
		#main-wrapper .titel-left .titel-line, #main-wrapper .blog-post .text .button, #main-wrapper .compare-column-entry .button';
		$custom_css .= '{background:'.$custom_accent_color.';}';

		$custom_css .= '#main-wrapper #loader-wrapper span, #main-wrapper .play:hover, #main-wrapper .blog-post .date, #main-wrapper blockquote, #main-wrapper .button.type-1:after,
		#main-wrapper .checkbox-entry.active label:before, #main-wrapper .checkbox-entry.active label:after, #main-wrapper .message-box-entry.style-3,
		#main-wrapper .responsive-filtration-title, #main-wrapper .button.type-1, #main-wrapper .blog-post .thumbnail-entry blockquote, #main-wrapper #loader-wrapper span  ';
		$custom_css .= '{border-color:'.$custom_accent_color.';}';
        
        $custom_css .= '#main-wrapper .vc_toggle.vc_toggle_default .vc_toggle_icon,
        #main-wrapper .vc_toggle.vc_toggle_default .vc_toggle_title .vc_toggle_icon:before,
        #main-wrapper .vc_toggle.vc_toggle_default .vc_toggle_title .vc_toggle_icon:after,
        #main-wrapper .vc_tta.vc_general.vc_tta-accordion .vc_tta-panel-title .vc_tta-controls-icon:before,
        #main-wrapper .vc_tta.vc_general.vc_tta-accordion .vc_tta-panel-title .vc_tta-controls-icon:after ';
		$custom_css .= '{border-color:'.$custom_accent_color.' !important;}';

        $custom_css .= '#main-wrapper .vc_tta.vc_tta-tabs .vc_tta-tab.vc_active a,
        #main-wrapper .vc_toggle.vc_toggle_default .vc_toggle_title:hover h4,
        #main-wrapper .vc_tta.vc_general.vc_tta-accordion .vc_tta-panel-heading:hover a,
        #main-wrapper .accordeon .entry .title:hover  ';
        $custom_css .= '{color:'.$custom_accent_color.' !important;}';
        
        $custom_css .= '#main-wrapper .vc_toggle.vc_toggle_default.vc_toggle_active .vc_toggle_title,
        #main-wrapper .vc_toggle.vc_toggle_default.vc_toggle_active .vc_toggle_content,
        #main-wrapper .vc_tta.vc_general.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading a,
        #main-wrapper .vc_tta.vc_general.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-heading,
        #main-wrapper .vc_tta.vc_general.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-body  ';
        $custom_css .= '{background-color:'.$custom_accent_color.' !important;}';

        $custom_css .= '#main-wrapper #nav .submeny a:after';
        $custom_css .= '{border-top-color:'.$custom_accent_color.';}';

        $custom_css .= '#main-wrapper .blog-post.style-2 .date:before';
        $custom_css .= '{border-left-color:'.$custom_accent_color.';}';

		$custom_css .= '::selection';
		$custom_css .= '{background: '.$custom_accent_color.';}';

		$custom_css .= '::-moz-selection';
		$custom_css .= '{background: '.$custom_accent_color.';}';

		$custom_css .= '::-webkit-scrollbar-thumb';
		$custom_css .= '{background-color: '.$custom_accent_color.';}';

        $custom_css .= '#main-wrapper .default-arrow.right';
        $custom_css .= '{box-shadow: -4px 3px 10px rgba(0, 0, 0, .1), inset 3px 0 '.adjustBrightness($custom_accent_color, -20).';}';

        $custom_css .= '#main-wrapper .default-arrow.left';
        $custom_css .= '{box-shadow: 3px 4px 10px rgba(0, 0, 0, .1), inset -3px 0 '.adjustBrightness($custom_accent_color, -20).';}';

        $custom_css .= '#main-wrapper .message-box-entry.style-1 .alert-shadow';
        $custom_css .= '{background: '.adjustBrightness($custom_accent_color, -20).';}';

        $custom_css .= '#main-wrapper .blog-post.style-2 .date';
        $custom_css .= '{box-shadow: 3px 0 '.adjustBrightness($custom_accent_color, -20).' inset;}';

        $custom_css .= '#main-wrapper .sorting-item .tagline';
        $custom_css .= '{background-color:'.crum_ultimate_hex2rgb($custom_accent_color,0.8).'}';

		$custom_css .= '.play::after{border-left-color:'.$custom_accent_color.'}';

	}

	$custom_footer_bg_image =  cs_get_customize_option( 'footer_bg_image' );
	$custom_footer_bg_color =  cs_get_customize_option( 'footer_bg_color' );
	$custom_footer_text_color =  cs_get_customize_option( 'footer_text_color' );

	if(isset($custom_footer_bg_image) && !empty($custom_footer_bg_image)){
		$footer_bg_image = wp_get_attachment_image_src( $custom_footer_bg_image, 'full' );
		if ( isset($footer_bg_image[0]) && !empty($footer_bg_image[0]) ) {
			$custom_css .= '#site-footer';
			$custom_css .= '{background-image:url(' . $footer_bg_image[0] . ')}';
		}
	}

	if(isset($custom_footer_bg_color) && !empty($custom_footer_bg_color)){
		$custom_css .= '#site-footer';
		$custom_css .= '{background-color:'.$custom_footer_bg_color.'}';
	}

	if(isset($custom_footer_text_color) && !empty($custom_footer_text_color)){
		$custom_css .= '#site-footer, .footer-linck';
		$custom_css .= '{color:'.$custom_footer_text_color.'}';
		$custom_css .= '#site-footer .widget-entry ul li, #site-footer .widget_calendar a, #site-footer .subscribe .form-icon, #site-footer .widget-entry p,
		#site-footer .widget-entry > ul > li span, #site-footer .tweet-entry i, #site-footer .tweet-entry a, #site-footer .latest-comment-entry .title .name,
		#site-footer .popular-post-entry .content .date, #site-footer .latest-comment-entry .date .glyphicon, #site-footer .latest-comment-entry .title .post-title,
		#site-footer .popular-post-entry .content .title, #site-footer .widget-entry .tabs-switch.active, #site-footer .widget-testimonial .testimonial-icon,
		#site-footer .widget-testimonial .person .description, #site-footer .widget-testimonial .person .description span, #site-footer .tagcloud a,
		#site-footer .widget_calendar caption, #site-footer .search-form .search-submit, #site-footer .submit-wrapper-icon, #site-footer .media-icon a';
	    $custom_css .= '{color:'.adjustBrightness($custom_footer_text_color,-40).'}';

        $custom_css .= '#site-footer table th, #site-footer table thead td, #site-footer .widget-entry .social-icons a, #site-footer .swiper-active-switch,
        #site-footer .tagcloud a:hover, #site-footer .sml_subscribe_widget_display .sml_submitbtn, #site-footer .styled-form .submit-wrapper:hover';
        $custom_css .= '{background-color:'.adjustBrightness($custom_footer_text_color,-40).'}';

        $custom_css .= '#site-footer .widget_calendar table, table tbody th, table td';
        $custom_css .= '{border-color:'.adjustBrightness($custom_footer_text_color,-40).'}';
	}


	$custom_css .= 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h4 ';
	$custom_css .= ',h1.title, h2.title, h3.title, h4.title, h5.title, h6.title,.team-member__name, .blog-detail-article h3, .widget-title, .tags-title, .comment-content .name, .author-title';
	$custom_css .= crumina_font_customization('heading');

	$custom_css .= crumina_font_size('h1');
	$custom_css .= crumina_font_size('h2');
	$custom_css .= crumina_font_size('h3');
	$custom_css .= crumina_font_size('h4');
	$custom_css .= crumina_font_size('h5');
	$custom_css .= crumina_font_size('h6');

	$custom_css .= 'body, p';
	$custom_css .=  crumina_font_customization('body');

	//custom css
	$custom_css_code = cs_get_customize_option( 'css-code' );

	if(isset($custom_css_code) && !($custom_css_code == '')){
		$custom_css .= ' '.$custom_css_code;
	}

	wp_add_inline_style('style', $custom_css );

}