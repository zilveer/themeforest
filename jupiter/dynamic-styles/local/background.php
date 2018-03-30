<?php
global $mk_options;

function mk_build_content_backgrounds($atts) {
    extract($atts);
    
    $gradient = isset($gradient) && !empty($gradient) ? $gradient : 'single';
    $output = '';
    
    if ($gradient == 'single') {
        
        $global_color = isset($global_color) ? 'background-color:' . $global_color . ';' : '';
        
        $output.= !empty($color) ? 'background-color:' . $color . ';' : $global_color;
        $output.= $image ? 'background-image:url(' . $image . ');' : '';
        $output.= $repeat ? 'background-repeat:' . $repeat . ';' : '';
        $output.= $position ? 'background-position:' . $position . ';' : '';
        $output.= $attachment ? 'background-attachment:' . $attachment . ';' : '';
        if ($stretch == 'true') {
            $output.= 'background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;';
        }
    } 
    else {
        
        $body_gradient_parser = mk_gradient_option_parser($gradient_style, $gradient_angle);
        if (!empty($body_gradient_parser)) {
            $output.= 'background: -webkit-' . $body_gradient_parser['type'] . '-gradient(' . $body_gradient_parser['angle_1'] . '' . $color . ' 0%, ' . $color_2 . ' 100%);';
            $output.= 'background: ' . $body_gradient_parser['type'] . '-gradient(' . $body_gradient_parser['angle_2'] . '' . $color . ' 0%, ' . $color_2 . ' 100%)';
        }
    }
    
    return $output;
}

$body_bg = mk_build_content_backgrounds(array(
    'gradient' => $mk_options['body_color_gradient'],
    'gradient_style' => $mk_options['body_color_gradient_style'],
    'gradient_angle' => $mk_options['body_color_gradient_angle'],
    'color' => $mk_options['body_color'],
    'color_2' => $mk_options['body_color_2'],
    'image' => $mk_options['body_image'],
    'stretch' => $mk_options['body_size'],
    'repeat' => $mk_options['body_repeat'],
    'position' => $mk_options['body_position'],
    'attachment' => $mk_options['body_attachment'],
));

/**
 * Header background
 */

$header_bg = mk_build_content_backgrounds(array(
    'gradient' => $mk_options['header_color_gradient'],
    'gradient_style' => $mk_options['header_color_gradient_style'],
    'gradient_angle' => $mk_options['header_color_gradient_angle'],
    'color' => $mk_options['header_color'],
    'color_2' => $mk_options['header_color_2'],
    'image' => $mk_options['header_image'],
    'stretch' => $mk_options['header_size'],
    'repeat' => $mk_options['header_repeat'],
    'position' => $mk_options['header_position'],
    'attachment' => $mk_options['header_attachment'],
));

/**
 * Page Title background
 */

$banner_bg = mk_build_content_backgrounds(array(
    'gradient' => $mk_options['banner_color_gradient'],
    'gradient_style' => $mk_options['banner_color_gradient_style'],
    'gradient_angle' => $mk_options['banner_color_gradient_angle'],
    'color' => $mk_options['banner_color'],
    'color_2' => $mk_options['banner_color_2'],
    'stretch' => $mk_options['banner_size'],
    'image' => $mk_options['banner_image'],
    'repeat' => $mk_options['banner_repeat'],
    'position' => $mk_options['banner_position'],
    'attachment' => $mk_options['banner_attachment'],
));

/**
 * Page background
 */

$page_bg = mk_build_content_backgrounds(array(
    'gradient' => $mk_options['page_color_gradient'],
    'gradient_style' => $mk_options['page_color_gradient_style'],
    'gradient_angle' => $mk_options['page_color_gradient_angle'],
    'color' => $mk_options['page_color'],
    'color_2' => $mk_options['page_color_2'],
    'image' => $mk_options['page_image'],
    'stretch' => $mk_options['page_size'],
    'repeat' => $mk_options['page_repeat'],
    'position' => $mk_options['page_position'],
    'attachment' => $mk_options['page_attachment'],
));

/**
 * Footer background
 */

$footer_bg = mk_build_content_backgrounds(array(
    'gradient' => $mk_options['footer_color_gradient'],
    'gradient_style' => $mk_options['footer_color_gradient_style'],
    'gradient_angle' => $mk_options['footer_color_gradient_angle'],
    'color' => $mk_options['footer_color'],
    'color_2' => $mk_options['footer_color_2'],
    'image' => $mk_options['footer_image'],
    'stretch' => $mk_options['footer_size'],
    'repeat' => $mk_options['footer_repeat'],
    'position' => $mk_options['footer_position'],
    'attachment' => $mk_options['footer_attachment'],
));

$page_title_color = $mk_options['page_title_color'];
$page_subtitle_color = $mk_options['page_subtitle_color'];
$banner_border_color = $mk_options['banner_border_color'];
$banner_sticky_border_color = $mk_options['sticky_header_border_color'];
$boxed_layout_shadow_size = $mk_options['boxed_layout_shadow_size'];
$boxed_layout_shadow_intensity = $mk_options['boxed_layout_shadow_intensity'];
$page_title_padding = 15;
$trans_header_border_color = '';

$page_color = $mk_options['page_color'];

if (global_get_post_id()) {
    
    $post_id = global_get_post_id();
    
    $enable = get_post_meta($post_id, '_enable_local_backgrounds', true);
    
    if ($enable == 'true') {
        
        $body_bg = mk_build_content_backgrounds(array(
            'gradient' => get_post_meta($post_id, 'body_color_gradient', true) ,
            'gradient_style' => get_post_meta($post_id, 'body_color_gradient_style', true) ,
            'gradient_angle' => get_post_meta($post_id, 'body_color_gradient_angle', true) ,
            'color' => get_post_meta($post_id, 'body_color', true) ,
            'global_color' => $mk_options['body_color'],
            'color_2' => get_post_meta($post_id, 'body_color_2', true) ,
            'image' => get_post_meta($post_id, 'body_image', true) ,
            'stretch' => get_post_meta($post_id, 'body_size', true),
            'repeat' => get_post_meta($post_id, 'body_repeat', true) ,
            'position' => get_post_meta($post_id, 'body_position', true) ,
            'attachment' => get_post_meta($post_id, 'body_attachment', true) ,
        ));
        
        $header_bg = mk_build_content_backgrounds(array(
            'gradient' => get_post_meta($post_id, 'header_color_gradient', true) ,
            'gradient_style' => get_post_meta($post_id, 'header_color_gradient_style', true) ,
            'gradient_angle' => get_post_meta($post_id, 'header_color_gradient_angle', true) ,
            'color' => get_post_meta($post_id, 'header_color', true) ,
            'global_color' => $mk_options['header_color'],
            'color_2' => get_post_meta($post_id, 'header_color_2', true) ,
            'image' => get_post_meta($post_id, 'header_image', true) ,
            'stretch' => get_post_meta($post_id, 'header_size', true),
            'repeat' => get_post_meta($post_id, 'header_repeat', true) ,
            'position' => get_post_meta($post_id, 'header_position', true) ,
            'attachment' => get_post_meta($post_id, 'header_attachment', true) ,
        ));
        
        $banner_bg = mk_build_content_backgrounds(array(
            'gradient' => get_post_meta($post_id, 'banner_color_gradient', true) ,
            'gradient_style' => get_post_meta($post_id, 'banner_color_gradient_style', true) ,
            'gradient_angle' => get_post_meta($post_id, 'banner_color_gradient_angle', true) ,
            'color' => get_post_meta($post_id, 'banner_color', true) ,
            'global_color' => $mk_options['banner_color'],
            'color_2' => get_post_meta($post_id, 'banner_color_2', true) ,
            'image' => get_post_meta($post_id, 'banner_image', true) ,
            'stretch' => get_post_meta($post_id, 'banner_size', true) ,
            'repeat' => get_post_meta($post_id, 'banner_repeat', true) ,
            'position' => get_post_meta($post_id, 'banner_position', true) ,
            'attachment' => get_post_meta($post_id, 'banner_attachment', true) ,
        ));
        
        $page_bg = mk_build_content_backgrounds(array(
            'gradient' => get_post_meta($post_id, 'page_color_gradient', true) ,
            'gradient_style' => get_post_meta($post_id, 'page_color_gradient_style', true) ,
            'gradient_angle' => get_post_meta($post_id, 'page_color_gradient_angle', true) ,
            'color' => get_post_meta($post_id, 'page_color', true) ,
            'global_color' => $mk_options['page_color'],
            'color_2' => get_post_meta($post_id, 'page_color_2', true) ,
            'image' => get_post_meta($post_id, 'page_image', true) ,
            'stretch' => get_post_meta($post_id, 'page_size', true),
            'repeat' => get_post_meta($post_id, 'page_repeat', true) ,
            'position' => get_post_meta($post_id, 'page_position', true) ,
            'attachment' => get_post_meta($post_id, 'page_attachment', true) ,
        ));
        
        $footer_bg = mk_build_content_backgrounds(array(
            'gradient' => get_post_meta($post_id, 'footer_color_gradient', true) ,
            'gradient_style' => get_post_meta($post_id, 'footer_color_gradient_style', true) ,
            'gradient_angle' => get_post_meta($post_id, 'footer_color_gradient_angle', true) ,
            'color' => get_post_meta($post_id, 'footer_color', true) ,
            'global_color' => $mk_options['footer_color'],
            'color_2' => get_post_meta($post_id, 'footer_color_2', true) ,
            'image' => get_post_meta($post_id, 'footer_image', true) ,
            'stretch' => get_post_meta($post_id, 'footer_size', true),
            'repeat' => get_post_meta($post_id, 'footer_repeat', true) ,
            'position' => get_post_meta($post_id, 'footer_position', true) ,
            'attachment' => get_post_meta($post_id, 'footer_attachment', true) ,
        ));
        
        $page_title_color = get_post_meta($post_id, '_page_title_color', true) ? get_post_meta($post_id, '_page_title_color', true) : '';
        $page_subtitle_color = get_post_meta($post_id, '_page_subtitle_color', true) ? get_post_meta($post_id, '_page_subtitle_color', true) : '';
        $banner_border_color = get_post_meta($post_id, '_banner_border_color', true) ? get_post_meta($post_id, '_banner_border_color', true) : '';
        $trans_header_border_color = get_post_meta($post_id, '_trans_header_border_bottom', true) ? get_post_meta($post_id, '_trans_header_border_bottom', true) : '';
        
        $boxed_layout_shadow_size = get_post_meta($post_id, 'boxed_layout_shadow_size', true);
        $boxed_layout_shadow_intensity = get_post_meta($post_id, 'boxed_layout_shadow_intensity', true);
        $page_color = get_post_meta($post_id, 'page_color', true) ? get_post_meta($post_id, 'page_color', true) : $page_color;
    }
}

$classic_nav_bg = empty($mk_options['main_nav_bg_color']) ? $header_bg : 'background-color:' . $mk_options['main_nav_bg_color'] . ';';


Mk_Static_Files::addLocalStyle("
body
{
    {$body_bg}
}
.mk-header
{
    {$banner_bg}
}

.mk-header-bg
{
    {$header_bg}
}

.mk-classic-nav-bg
{
    {$classic_nav_bg}
}

#theme-page
{
    {$page_bg}
}

#mk-footer
{
    {$footer_bg}
}

#mk-boxed-layout
{
  -webkit-box-shadow: 0 0 {$boxed_layout_shadow_size}px rgba(0, 0, 0, {$boxed_layout_shadow_intensity});
  -moz-box-shadow: 0 0 {$boxed_layout_shadow_size}px rgba(0, 0, 0, {$boxed_layout_shadow_intensity});
  box-shadow: 0 0 {$boxed_layout_shadow_size}px rgba(0, 0, 0, {$boxed_layout_shadow_intensity});
}

.mk-news-tab .mk-tabs-tabs .is-active a,
.mk-fancy-title.pattern-style span,
.mk-fancy-title.pattern-style.color-gradient span:after,
.page-bg-color
{
    background-color: {$page_color};
}

.page-title
{
    font-size: {$mk_options['page_introduce_title_size']}px;
    color: {$page_title_color};
    text-transform: {$mk_options['page_title_transform']};
    font-weight: {$mk_options['page_introduce_weight']};
    letter-spacing: {$mk_options['page_introduce_title_letter_spacing']}px;
}

.page-subtitle
{
    font-size: {$mk_options['page_introduce_subtitle_size']}px;
    line-height: 100%;
    color: {$page_subtitle_color};
    font-size: {$mk_options['page_introduce_subtitle_size']}px;
    text-transform: {$mk_options['page_introduce_subtitle_transform']};
}

");



if (!empty($banner_border_color) && is_page_title_show()) {
    Mk_Static_Files::addLocalStyle("

    .mk-header
    {
        border-bottom:1px solid {$banner_border_color};
    }

    ");
}

if (!empty($banner_sticky_border_color)) {
    Mk_Static_Files::addLocalStyle("
        .mk-header.sticky-style-fixed.a-sticky .mk-header-holder{
            border-bottom:1px solid {$banner_sticky_border_color};
        }
    ");
}


if (!empty($trans_header_border_color)) {
    Mk_Static_Files::addLocalStyle("
    
    .mk-header.transparent-header:not(.a-sticky) .mk-header-holder
    {
        border-bottom:1px solid {$trans_header_border_color};
    }

    ");
}



