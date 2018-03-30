<?php
global $mk_options;

function mk_build_content_backgrounds($atts) {
    extract($atts);
    $output = '';
          
    $global_color = isset($global_color) ? 'background-color:' . $global_color . ';' : '';
    
    $output.= !empty($color) ? 'background-color:' . $color . ';' : $global_color;
    $output.= $url ? 'background-image:url(' . $url . ');' : '';
    $output.= $repeat ? 'background-repeat:' . $repeat . ';' : '';
    $output.= isset($position) && !empty($position) ? 'background-position:' . $position . ';' : '';
    $output.= isset($attachment) && !empty($attachment) ? 'background-attachment:' . $attachment . ';' : '';
    $output.= ($cover == 1) ? 'background-size: cover;background-repeat: no-repeat;-moz-background-size: cover;-webkit-background-size: cover;-o-background-size: cover;' : '';


    return $output;
}




$body_bg = mk_build_content_backgrounds(array(
    'color' => $mk_settings['body-bg']['color'],
    'url' => $mk_settings['body-bg']['url'],
    'position' => $mk_settings['body-bg']['position'],
    'attachment' => $mk_settings['body-bg']['attachment'],
    'repeat' => $mk_settings['body-bg']['repeat'],
    'cover' => $mk_settings['body-bg']['cover'],
));


$header_bg_color = $mk_settings['header-bg']['color'] ? 'background-color:' . $mk_settings['header-bg']['color'] . ';' : '';
$header_bg = mk_build_content_backgrounds(array(
    'color' => $mk_settings['header-bg']['color'],
    'url' => $mk_settings['header-bg']['url'],
    'position' => $mk_settings['header-bg']['position'],
    'attachment' => $mk_settings['header-bg']['attachment'],
    'repeat' => $mk_settings['header-bg']['repeat'],
    'cover' => $mk_settings['header-bg']['cover'],
));


$toolbar_bg = mk_build_content_backgrounds(array(
    'color' => $mk_settings['toolbar-bg']['color'],
    'url' => $mk_settings['toolbar-bg']['url'],
    'position' => $mk_settings['toolbar-bg']['position'],
    'attachment' => $mk_settings['toolbar-bg']['attachment'],
    'repeat' => $mk_settings['toolbar-bg']['repeat'],
    'cover' => $mk_settings['toolbar-bg']['cover'],
));


$page_title_bg = mk_build_content_backgrounds(array(
    'color' => $mk_settings['page-title-bg']['color'],
    'url' => $mk_settings['page-title-bg']['url'],
    'position' => $mk_settings['page-title-bg']['position'],
    'repeat' => $mk_settings['page-title-bg']['repeat'],
    'cover' => $mk_settings['page-title-bg']['cover'],
));


$page_bg_position = ($mk_settings['page-bg']['attachment']  && $mk_settings['page-bg']['attachment'] == 'fixed') ? 'fixed' : 'absolute';

$page_bg = mk_build_content_backgrounds(array(
    'color' => $mk_settings['page-bg']['color'],
    'url' => $mk_settings['page-bg']['url'],
    'position' => $mk_settings['page-bg']['position'],
    'repeat' => $mk_settings['page-bg']['repeat'],
    'cover' => $mk_settings['page-bg']['cover'],
));




$footer_bg = mk_build_content_backgrounds(array(
    'color' => $mk_settings['footer-bg']['color'],
    'url' => $mk_settings['footer-bg']['url'],
    'position' => $mk_settings['footer-bg']['position'],
    'attachment' => $mk_settings['footer-bg']['attachment'],
    'repeat' => $mk_settings['footer-bg']['repeat'],
    'cover' => $mk_settings['footer-bg']['cover'],
));



$page_title_color = $mk_settings['page-title-color'];
$page_title_size = $mk_settings['page-title-size'];
$page_title_padding = 40;
$page_title_weight = '';
$page_title_letter_spacing = '';
$view_toolbar_local = '';


if (global_get_post_id()) {


        $post_id = global_get_post_id();

        $view_toolbar_local = get_post_meta( $post_id, '_header_toolbar', true );

        $intro = get_post_meta($post_id, '_page_title_intro', true);

        if($intro != 'none') {
            $attach = 'background-attachment: scroll;';
        }

        $enable = get_post_meta($post_id, '_custom_bg', true);

        if ($enable == 'true') {

            $body_bg = mk_build_content_backgrounds(array(
                'color' => get_post_meta($post_id, 'body_color', true),
                'url' => get_post_meta($post_id, 'body_image', true),
                'position' => get_post_meta($post_id, 'body_position', true),
                'attachment' => get_post_meta($post_id, 'body_attachment', true),
                'repeat' => get_post_meta($post_id, 'body_repeat', true),
                'cover' => (get_post_meta($post_id, 'body_cover', true) == 'true' ? 1 : 0),
            ));

            $header_bg_color = get_post_meta($post_id, 'header_color', true) ? 'background-color: ' . get_post_meta($post_id, 'header_color', true) . ';' : '';
            $header_bg = mk_build_content_backgrounds(array(
                'color' => get_post_meta($post_id, 'header_color', true),
                'url' => get_post_meta($post_id, 'header_image', true),
                'position' => get_post_meta($post_id, 'header_position', true),
                'attachment' => get_post_meta($post_id, 'header_attachment', true),
                'repeat' => get_post_meta($post_id, 'header_repeat', true),
                'cover' => (get_post_meta($post_id, 'header_cover', true) == 'true' ? 1 : 0),
            ));


            $page_title_bg = mk_build_content_backgrounds(array(
                'color' => get_post_meta($post_id, 'banner_color', true),
                'url' => get_post_meta($post_id, 'banner_image', true),
                'position' => get_post_meta($post_id, 'banner_position', true),
                //'attachment' => get_post_meta($post_id, 'banner_attachment', true),
                'repeat' => get_post_meta($post_id, 'banner_repeat', true),
                'cover' => (get_post_meta($post_id, 'banner_cover', true) == 'true' ? 1 : 0),
            ));

            $page_bg_position = (get_post_meta($post_id, 'page_attachment', true)  && get_post_meta($post_id, 'page_attachment', true) == 'fixed') ? 'fixed' : 'absolute';
            $page_bg = mk_build_content_backgrounds(array(
                'color' => get_post_meta($post_id, 'page_color', true),
                'url' => get_post_meta($post_id, 'page_image', true),
                'position' => get_post_meta($post_id, 'page_position', true),
                //'attachment' => get_post_meta($post_id, 'page_attachment', true),
                'repeat' => get_post_meta($post_id, 'page_repeat', true),
                'cover' => (get_post_meta($post_id, 'page_cover', true) == 'true' ? 1 : 0),
            ));


            $footer_bg = mk_build_content_backgrounds(array(
                'color' => get_post_meta($post_id, 'footer_color', true),
                'url' => get_post_meta($post_id, 'footer_image', true),
                'position' => get_post_meta($post_id, 'footer_position', true),
                'attachment' => get_post_meta($post_id, 'footer_attachment', true),
                'repeat' => get_post_meta($post_id, 'footer_repeat', true),
                'cover' => (get_post_meta($post_id, 'footer_cover', true) == 'true' ? 1 : 0),
            ));

            $page_title_color = get_post_meta($post_id, '_page_title_color', true) ? get_post_meta($post_id, '_page_title_color', true) : $mk_settings['page-title-color'];
            $page_title_weight = get_post_meta($post_id, '_page_title_weight', true) ? ('font-weight:' . get_post_meta($post_id, '_page_title_weight', true)) : '';
            $page_title_letter_spacing = get_post_meta($post_id, '_page_title_letter_spacing', true) ? ('letter-spacing:' . get_post_meta($post_id, '_page_title_letter_spacing', true) . 'px;') : '';

            $page_title_size = get_post_meta($post_id, '_page_title_size', true) ? get_post_meta($post_id, '_page_title_size', true) : $mk_settings['page-title-size'];
            $page_title_padding = get_post_meta($post_id, '_page_title_padding', true) ? get_post_meta($post_id, '_page_title_padding', true) : 40;
        }

        /*** custom breadcrumb coloring ***/
        $custom_breadcrumb_page = get_post_meta($post_id, '_breadcrumb_skin', true) ? 1 : 0;
        $custom_breadcrumb_color = get_post_meta($post_id, '_breadcrumb_custom_color', true) ? get_post_meta($post_id, '_breadcrumb_custom_color', true) : '';
        $custom_breadcrumb_hover_color = get_post_meta($post_id, '_breadcrumb_custom_hover_color', true) ? get_post_meta($post_id, '_breadcrumb_custom_hover_color', true) : '';

}


$view_toolbar_global = $mk_settings['header-toolbar'];

$toolbar_gap = 0;
if($view_toolbar_global) {
    if($view_toolbar_local != 'false') {
        $toolbar_gap = 35;
    }
}


$logo_height = (!empty($mk_settings['logo']['height'])) ? $mk_settings['logo']['height'] : 50;
$header_height = $logo_height+($mk_settings['header-padding'] * 2);
$header_sticky_padding = ($header_height + $toolbar_gap);



$header_bottom_border = (isset($mk_settings['header-bottom-border']) && !empty($mk_settings['header-bottom-border'])) ? ('border-bottom:1px solid' . $mk_settings['header-bottom-border'] . ';') : '';


Mk_Static_Files::addLocalStyle("

    body,.theme-main-wrapper {
        
        {$body_bg}
    }

    .mk-header-toolbar{
        {$toolbar_bg}
    }

    #mk-header, .mk-secondary-header {
        {$header_bg}
    }

    .theme-main-wrapper:not(.vertical-header) #mk-header.transparent-header.light-header-skin,
    .theme-main-wrapper:not(.vertical-header) #mk-header.transparent-header.dark-header-skin{
        border-top: none !important;
        background: transparent !important;
    }

    .theme-main-wrapper:not(.vertical-header) .sticky-header.sticky-header-padding {
        padding-top:{$header_sticky_padding}px;
    }

    .sticky-header-padding {

        {$header_bg_color}

    }

    #mk-header.transparent-header-sticky,
    #mk-header.sticky-header:not(.transparent-header) {

        {$header_bottom_border}

    }

    #mk-page-title
    {
        padding:{$page_title_padding}px 0;
    }

    #mk-page-title .mk-page-heading{
        font-size:{$page_title_size}px;
        color:{$page_title_color};
        {$page_title_weight};
        {$page_title_letter_spacing};
    }
    #mk-breadcrumbs {
        line-height:{$page_title_size}px;
    }


    #mk-page-title .mk-page-title-bg {
        {$page_title_bg};
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        transform: translateZ(0);
        -webkit-transform: translateZ(0);
    }

    .page-master-holder {
        position:relative;
    }

    .background-img--page {
        {$page_bg}
        height: 100%;
        width: 100%;
        position: {$page_bg_position};
        top: 0;
        left: 0;
        transform: translateZ(0);
        -webkit-transform: translateZ(0);
        z-index:-1;
    }

    #mk-footer{

        {$footer_bg}
        
    }

    

");






