<?php
// Function parses header styles

/*
 * Backgrounds
 */
global $dfd_ronneby;
if (isset($dfd_ronneby['wrapper_bg_color']) && $dfd_ronneby['wrapper_bg_color']) {
    echo '#change_wrap_div{ background-color: '.esc_attr($dfd_ronneby['wrapper_bg_color']).' !important; }';
}
if (isset($dfd_ronneby['wrapper_bg_image']['url']) && $dfd_ronneby['wrapper_bg_image']['url']) {
    echo '#change_wrap_div{ background-image: url("'.esc_url($dfd_ronneby['wrapper_bg_image']['url']).'") !important; } ';
}
if (isset($dfd_ronneby['wrapper_custom_repeat']) && $dfd_ronneby['wrapper_custom_repeat']) {
    echo '#change_wrap_div{ background-repeat: '.esc_attr($dfd_ronneby['wrapper_custom_repeat']).' !important; }';
}

// body
if (isset($dfd_ronneby['body_bg_color']) && $dfd_ronneby['body_bg_color']) {
    echo 'body{ background-color: '.esc_attr($dfd_ronneby['body_bg_color']).' !important; }';
}
if (isset($dfd_ronneby['body_bg_image']['url']) && $dfd_ronneby['body_bg_image']['url']) {
    echo 'body{ background-image: url("'.esc_url($dfd_ronneby['body_bg_image']['url']).'") !important; }';
}
if (isset($dfd_ronneby['body_custom_repeat']) && $dfd_ronneby['body_custom_repeat']) {
    echo 'body{ background-repeat: '.esc_attr($dfd_ronneby['body_custom_repeat']).' !important; }';
}
if (isset($dfd_ronneby['body_bg_fixed']) && $dfd_ronneby['body_bg_fixed']) {
    echo 'body{ background-attachment: fixed !important; } ';
}

// footer
if (isset($dfd_ronneby['footer_bg_color']) && $dfd_ronneby['footer_bg_color']) {
    echo '#footer{ background-color: '.esc_attr($dfd_ronneby['footer_bg_color']).'} ';
}
if (isset($dfd_ronneby['footer_bg_image']['url']) && $dfd_ronneby['footer_bg_image']['url']) {
    echo '#footer{ background-image: url("'.esc_url($dfd_ronneby['footer_bg_image']['url']).'")} ';
}
if (isset($dfd_ronneby['footer_custom_repeat']) && $dfd_ronneby['footer_custom_repeat']) {
    echo '#footer{ background-repeat: '.esc_attr($dfd_ronneby['footer_custom_repeat']).'} ';
}

// sub footer
if (isset($dfd_ronneby['sub_footer_bg_color']) && $dfd_ronneby['sub_footer_bg_color']){
    echo '#sub-footer { background-color: '.esc_attr($dfd_ronneby['sub_footer_bg_color']).' !important; } ';
}
if (isset($dfd_ronneby['sub_footer_bg_image']['url']) && $dfd_ronneby['sub_footer_bg_image']['url']){
    echo '#sub-footer { background-image: url("'.esc_url($dfd_ronneby['sub_footer_bg_image']['url']).'") !important; } ';
}

if (isset($dfd_ronneby['sub_footer_custom_repeat']) && $dfd_ronneby['sub_footer_custom_repeat']){
    echo '#sub-footer { background-repeat: '.esc_attr($dfd_ronneby['sub_footer_custom_repeat']).' !important; } ';
}

if (isset($dfd_ronneby['enable_lightbox_counter']) && strcmp($dfd_ronneby['enable_lightbox_counter'],'off') === 0){
    echo 'div.pp_default .pp_nav { display: none !important; } ';
}

if (isset($dfd_ronneby['enable_lightbox_share']) && strcmp($dfd_ronneby['enable_lightbox_share'],'off') === 0){
    echo 'div.pp_default .pp_social { display: none !important; } ';
}

if (isset($dfd_ronneby['enable_lightbox_arrows']) && strcmp($dfd_ronneby['enable_lightbox_arrows'],'off') === 0){
    echo 'div.pp_default .pp_next > span, a.pp_previous > span { display: none !important; } ';
}

if (isset($dfd_ronneby['enable_zoom_button']) && strcmp($dfd_ronneby['enable_zoom_button'],'off') === 0){
    echo 'a.pp_expand, a.pp_contract { display: none !important; } ';
}

if (isset($dfd_ronneby['lightbox_elements_color']) && $dfd_ronneby['lightbox_elements_color']){
	$fade_color = $desc_color = 'transparent';
	if(function_exists('dfd_hex2rgb')) {
		$fade_color = dfd_hex2rgb($dfd_ronneby['lightbox_elements_color'], .15);
		$desc_color = dfd_hex2rgb($dfd_ronneby['lightbox_elements_color'], .5);
	}
    echo 'a.pp_next > span > span, a.pp_previous > span > span, div.pp_default .pp_nav .pp_play:before,div.pp_default .pp_nav .pp_pause:before, .pp_social .dfd-share-cover .dfd-blog-share-popup-wrap .dfd-share-title,'
		  .'div.pp_default a.pp_arrow_previous:before,div.pp_default a.pp_arrow_next:before, div.pp_default .pp_nav .currentTextHolder,'
		  .'div.ppt,div.pp_default .pp_expand:after,div.pp_default .pp_contract:after { color: '.esc_attr($dfd_ronneby['lightbox_elements_color']).' !important; } ';
	//echo 'div.pp_default .pp_close{ background: '.esc_attr($dfd_ronneby['lightbox_overley_bg_color']).' !important; }';
	echo 'div.pp_default .pp_description {color: '.esc_attr($desc_color).' !important;}';
	echo 'a.pp_next > span, a.pp_previous > span, .pp_social .dfd-share-cover .dfd-blog-share-popup-wrap .dfd-share-title {background: '.esc_attr($fade_color).' !important;}';
	echo 'div.pp_default .pp_gallery ul li a:hover, div.pp_default .pp_gallery ul li.selected a, .pp_gallery ul a:hover, .pp_gallery li.selected a {border-color: '.esc_attr($fade_color).' !important;}';
}

if (isset($dfd_ronneby['lightbox_overlay_style']) && strcmp($dfd_ronneby['lightbox_overlay_style'],'simple') === 0 && isset($dfd_ronneby['lightbox_overley_bg_color']) && $dfd_ronneby['lightbox_overley_bg_color']){
    echo 'div.pp_overlay, .dfd-fullscreen-video-container:before { background: '.esc_attr($dfd_ronneby['lightbox_overley_bg_color']).' !important; } ';
}

if (
	isset($dfd_ronneby['lightbox_overlay_style']) &&
	strcmp($dfd_ronneby['lightbox_overlay_style'],'gradient') === 0 &&
	isset($dfd_ronneby['lightbox_overley_color_gradient']) &&
	$dfd_ronneby['lightbox_overley_color_gradient']
){
    echo 'div.pp_overlay, .dfd-fullscreen-video-container:before {'
		. 'background: -webkit-linear-gradient(left, '.esc_attr($dfd_ronneby['lightbox_overley_color_gradient']['from']).','.esc_attr($dfd_ronneby['lightbox_overley_color_gradient']['to']).') !important;'
		. 'background: -moz-linear-gradient(left, '.esc_attr($dfd_ronneby['lightbox_overley_color_gradient']['from']).','.esc_attr($dfd_ronneby['lightbox_overley_color_gradient']['to']).') !important;'
		. 'background: -o-linear-gradient(left, '.esc_attr($dfd_ronneby['lightbox_overley_color_gradient']['from']).','.esc_attr($dfd_ronneby['lightbox_overley_color_gradient']['to']).') !important;'
		. 'background: -ms-linear-gradient(left, '.esc_attr($dfd_ronneby['lightbox_overley_color_gradient']['from']).','.esc_attr($dfd_ronneby['lightbox_overley_color_gradient']['to']).') !important;'
		. 'background: linear-gradient(left, '.esc_attr($dfd_ronneby['lightbox_overley_color_gradient']['from']).','.esc_attr($dfd_ronneby['lightbox_overley_color_gradient']['to']).') !important;'
		. '} ';
}

if (isset($dfd_ronneby['lightbox_overley_bg_opacity']) && $dfd_ronneby['lightbox_overley_bg_opacity']){
    echo 'div.pp_overlay, .dfd-fullscreen-video-container:before  { opacity: '.esc_attr($dfd_ronneby['lightbox_overley_bg_opacity']/100).' !important; } ';
}

if (
	isset($dfd_ronneby['folio_hover_mask_style']) &&
	strcmp($dfd_ronneby['folio_hover_mask_style'],'gradient') === 0 &&
	isset($dfd_ronneby['folio_hover_bg_gradient']) &&
	$dfd_ronneby['folio_hover_bg_gradient']
){
	$opacity_css = '';
	if(isset($dfd_ronneby['folio_hover_bg_opacity']) && !empty($dfd_ronneby['folio_hover_bg_opacity'])) {
		$opacity_css .= 'opacity:'.esc_attr($dfd_ronneby['folio_hover_bg_opacity']/100).';';
	}
    echo '.project .entry-thumb .portfolio-custom-hover:before {'
			. 'content: "";'
			. 'display: block;'
			. 'position: absolute;'
			. 'top: 0;'
			. 'bottom: 0;'
			. 'left: 0;'
			. 'right: 0;'
			. $opacity_css
			. 'background: -webkit-linear-gradient(left, '.esc_attr($dfd_ronneby['folio_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['folio_hover_bg_gradient']['to']).');'
			. 'background: -moz-linear-gradient(left, '.esc_attr($dfd_ronneby['folio_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['folio_hover_bg_gradient']['to']).');'
			. 'background: -o-linear-gradient(left, '.esc_attr($dfd_ronneby['folio_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['folio_hover_bg_gradient']['to']).');'
			. 'background: -ms-linear-gradient(left, '.esc_attr($dfd_ronneby['folio_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['folio_hover_bg_gradient']['to']).');'
			. 'background: linear-gradient(left, '.esc_attr($dfd_ronneby['folio_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['folio_hover_bg_gradient']['to']).');'
		. '} '
		. '.project .entry-thumb .portfolio-custom-hover {background: transparent;} ';
}

if (
	isset($dfd_ronneby['blog_smart_hover_mask_style']) &&
	strcmp($dfd_ronneby['blog_smart_hover_mask_style'],'gradient') === 0 &&
	isset($dfd_ronneby['blog_smart_hover_bg_gradient']) &&
	$dfd_ronneby['blog_smart_hover_bg_gradient']
){
	$opacity_css = '';
	if(isset($dfd_ronneby['blog_smart_hover_bg_opacity']) && !empty($dfd_ronneby['blog_smart_hover_bg_opacity'])) {
		$opacity_css .= 'opacity:'.esc_attr($dfd_ronneby['blog_smart_hover_bg_opacity']/100).';';
	}
    echo '#layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-masonry.dfd-smart-grid .post .entry-media:before,'
		. '#layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-fitRows.dfd-smart-grid .post .entry-media:before {'
			. 'background: -webkit-linear-gradient(left, '.esc_attr($dfd_ronneby['blog_smart_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['blog_smart_hover_bg_gradient']['to']).') !important;'
			. 'background: -moz-linear-gradient(left, '.esc_attr($dfd_ronneby['blog_smart_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['blog_smart_hover_bg_gradient']['to']).') !important;'
			. 'background: -o-linear-gradient(left, '.esc_attr($dfd_ronneby['blog_smart_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['blog_smart_hover_bg_gradient']['to']).') !important;'
			. 'background: -ms-linear-gradient(left, '.esc_attr($dfd_ronneby['blog_smart_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['blog_smart_hover_bg_gradient']['to']).') !important;'
			. 'background: linear-gradient(left, '.esc_attr($dfd_ronneby['blog_smart_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['blog_smart_hover_bg_gradient']['to']).') !important;'
		. '} ';
    echo '#layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-masonry.dfd-smart-grid .post:hover .entry-media:before,'
		. '#layout.dfd-blog-loop .dfd-blog-wrap .dfd-blog-fitRows.dfd-smart-grid .post:hover .entry-media:before {'
			. $opacity_css
		. '} ';
}

if (
	isset($dfd_ronneby['dfd_gallery_hover_mask_style']) &&
	strcmp($dfd_ronneby['dfd_gallery_hover_mask_style'],'gradient') === 0 &&
	isset($dfd_ronneby['dfd_gallery_hover_bg_gradient']) &&
	$dfd_ronneby['dfd_gallery_hover_bg_gradient']
){
	$opacity_css = '';
	if(isset($dfd_ronneby['dfd_gallery_hover_bg_opacity']) && !empty($dfd_ronneby['dfd_gallery_hover_bg_opacity'])) {
		$opacity_css .= 'opacity:'.esc_attr($dfd_ronneby['dfd_gallery_hover_bg_opacity']/100).';';
	}
    echo '.dfd-gallery-single-item .entry-thumb .portfolio-custom-hover:before {'
			. 'content: "";'
			. 'display: block;'
			. 'position: absolute;'
			. 'top: 0;'
			. 'bottom: 0;'
			. 'left: 0;'
			. 'right: 0;'
			. $opacity_css
			. 'background: -webkit-linear-gradient(left, '.esc_attr($dfd_ronneby['dfd_gallery_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['dfd_gallery_hover_bg_gradient']['to']).') !important;'
			. 'background: -moz-linear-gradient(left, '.esc_attr($dfd_ronneby['dfd_gallery_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['dfd_gallery_hover_bg_gradient']['to']).') !important;'
			. 'background: -o-linear-gradient(left, '.esc_attr($dfd_ronneby['dfd_gallery_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['dfd_gallery_hover_bg_gradient']['to']).') !important;'
			. 'background: -ms-linear-gradient(left, '.esc_attr($dfd_ronneby['dfd_gallery_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['dfd_gallery_hover_bg_gradient']['to']).') !important;'
			. 'background: linear-gradient(left, '.esc_attr($dfd_ronneby['dfd_gallery_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['dfd_gallery_hover_bg_gradient']['to']).') !important;'
		. '} '
		. '.dfd-gallery-single-item .entry-thumb .portfolio-custom-hover {background: transparent;} ';
}

if (
	isset($dfd_ronneby['woo_products_hover_mask_style']) &&
	strcmp($dfd_ronneby['woo_products_hover_mask_style'],'gradient') === 0 &&
	isset($dfd_ronneby['woo_products_hover_bg_gradient']) &&
	$dfd_ronneby['woo_products_hover_bg_gradient']
){
	$opacity_css = '';
	if(isset($dfd_ronneby['woo_products_hover_bg_opacity']) && !empty($dfd_ronneby['woo_products_hover_bg_opacity'])) {
		$opacity_css .= 'opacity:'.esc_attr($dfd_ronneby['woo_products_hover_bg_opacity']/100).';';
	}
    echo '.products .product.style-2 .woo-cover a.link, .products .product.style-3 .woo-cover a.link {'
			. $opacity_css
			. 'background: -webkit-linear-gradient(left, '.esc_attr($dfd_ronneby['woo_products_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['woo_products_hover_bg_gradient']['to']).') !important;'
			. 'background: -moz-linear-gradient(left, '.esc_attr($dfd_ronneby['woo_products_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['woo_products_hover_bg_gradient']['to']).') !important;'
			. 'background: -o-linear-gradient(left, '.esc_attr($dfd_ronneby['woo_products_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['woo_products_hover_bg_gradient']['to']).') !important;'
			. 'background: -ms-linear-gradient(left, '.esc_attr($dfd_ronneby['woo_products_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['woo_products_hover_bg_gradient']['to']).') !important;'
			. 'background: linear-gradient(left, '.esc_attr($dfd_ronneby['woo_products_hover_bg_gradient']['from']).','.esc_attr($dfd_ronneby['woo_products_hover_bg_gradient']['to']).') !important;'
		. '} '
		. '.dfd-gallery-single-item .entry-thumb .portfolio-custom-hover {background: transparent;} ';
}

/*
 * Custom CSS
 */
echo isset($dfd_ronneby['custom_css']) ? $dfd_ronneby['custom_css'] : '';