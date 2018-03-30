<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
    <?php global $smof_data, $post;?> 
    <!--[if lte IE 9]>
        <?php //wp_enqueue_style('ie-css', get_template_directory_uri()."/css/ie.css");?>
    <![endif]-->
    <?php wp_head(); ?>
</head>
<?php
/** value */
$c_pageID = empty($post->ID)? null : $post->ID;
$body_class = $wrapper_class = '';
/** header setting */
global $header_setings;
$header_setings = cshero_generetor_header_setting();
$body_class = $header_setings->body_class;
/** site id */
$header_select = cshero_getHeader();
/** render options */
$smof_data['header_content_widgets1'] = '1';
$smof_data['header_content_widgets2'] = '1';
if(is_page()){
    $bg_parallax = get_post_meta($post->ID, 'cs_header_bg_parallax', true);
    $background_image = get_post_meta($page_id, 'cs_header_bg_image', true);
    if(get_post_meta($c_pageID, 'cs_header_setting', true)){
        $smof_data['header_fixed_top'] = get_post_meta($c_pageID, 'cs_header_fixed_top', true);
    }
    if(get_post_meta($c_pageID, 'cs_body_custom_class', true)){
        $body_class .= ' '.get_post_meta($c_pageID, 'cs_body_custom_class', true);
    }
    /** bg */
    if ($background_image) {
        $attachment_image = wp_get_attachment_metadata($background_image, 'full');
        $smof_data['background-header']['media']['height'] = $attachment_image['height'];
        $smof_data['background-header']['media']['width'] = $attachment_image['width'];
    }
    if($bg_parallax != ''){
        $smof_data['header_bg_parallax'] = $bg_parallax;
    }

    /* Page loader */
    $page_loader = get_post_meta($c_pageID, 'cs_page_loader', true);
    if($page_loader !='' ){ $smof_data['page_loader'] = $page_loader; }

    /* Custom page logo */
    $logo = get_post_meta($c_pageID, 'cs_logo', true);
    if($logo != ''){ $smof_data['logo']['url'] = wp_get_attachment_url($logo);}

    /*$sticky_logo = get_post_meta($c_pageID, 'cs_logo', true);
    if($sticky_logo != ''){ $smof_data['logo_header_sticky']['url'] = wp_get_attachment_url($sticky_logo);}*/

    $logo_alignment = get_post_meta($c_pageID, 'cs_logo_alignment', true);
    if($logo_alignment != ''){ $smof_data['logo_alignment'] = $logo_alignment;}

    
    /** sidebar widgets */
    $header_top_widgets = get_post_meta($c_pageID, 'cs_header_top_widgets', true);
    if($header_top_widgets != ''){ $smof_data['header_top_widgets'] = $header_top_widgets;}

    $header_top2_widgets = get_post_meta($c_pageID, 'cs_header_top2_widgets', true);
    if($header_top2_widgets != ''){ $smof_data['header_top2_widgets'] = $header_top2_widgets;}

    $header_content_widgets = get_post_meta($c_pageID, 'cs_header_content_widgets', true);
    if($header_content_widgets != ''){ $smof_data['header_content_widgets'] = $header_content_widgets;}
    
    $smof_data['header_content_widgets1'] = get_post_meta($c_pageID, 'cs_header_content_widgets1', true);
    $smof_data['header_content_widgets2'] = get_post_meta($c_pageID, 'cs_header_content_widgets2', true);
    $smof_data['header_fixed_content_widgets'] = get_post_meta($c_pageID, 'cs_header_fixed_content_widgets', true);

    $enable_hidden_sidebar =  get_post_meta($c_pageID, 'cs_enable_hidden_sidebar', true);
    if($enable_hidden_sidebar != ''){ $smof_data['enable_hidden_sidebar'] = $enable_hidden_sidebar;}

    $menu_position =  get_post_meta($c_pageID, 'cs_menu_position', true);
    if($menu_position != ''){ $smof_data['menu_position'] = $menu_position; }

    $menu_item_button = get_post_meta($c_pageID, 'cs_menu_item_button', true);
    if($menu_item_button !='' ){ $smof_data['menu_item_button'] = $menu_item_button; }

    $arrow_parents_item_menu =  get_post_meta($c_pageID, 'cs_arrow_parents_item_menu', true);
    if($arrow_parents_item_menu != ''){ $smof_data['arrow_parents_item_menu'] = $arrow_parents_item_menu; }

    $header_full_width = get_post_meta($c_pageID, 'cs_header_full_width', true);
    if($header_full_width !='' ){ $smof_data['header_full_width'] = $header_full_width; }

    $header_position = get_post_meta($c_pageID, 'cs_header_position', true);
    if($header_position !='' ){ $smof_data['header_position'] = $header_position; }

    $sticky_header_full_width = get_post_meta($c_pageID, 'cs_sticky_header_full_width', true);
    if($sticky_header_full_width !='' ){ $smof_data['sticky_header_full_width'] = $sticky_header_full_width; }
}
if($smof_data['header_fixed_top']){ 
    $body_class .=' header-transparentFixed';
}
if($smof_data['header_position']){
    $body_class .= ' header-position-'.$smof_data['header_position'];
}
if($smof_data['menu_item_button']){
    $body_class .= ' menu-style-button';
}
if($smof_data['header_fixed_menu_appear']){
    $body_class .= ' menu-appear-'.$smof_data['header_fixed_menu_appear'];
}
$hidden_class='';
if(isset($smof_data['enable_hidden_sidebar']) && $smof_data['enable_hidden_sidebar']){
    $hidden_class = 'meny-'.$smof_data['hidden_sidebar_position'];
}


?>

<body <?php body_class($body_class.' '.$hidden_class.' header-'.$header_select .' '.cshero_getCSSite().' '); ?> id="wp-piero">
    <?php if($smof_data['page_loader']=='1'):?>
        <div id="cs_loader" class="<?php echo esc_attr($smof_data['page_loader_style']);?>">
            <?php 
                $page_loader_color = HexToRGB($smof_data['page_loader_color']['color'],$smof_data['page_loader_color']['alpha']);
                $page_loader_color2 = HexToRGB($smof_data['page_loader_color2']['color'],$smof_data['page_loader_color2']['alpha']);
                require_once 'framework/includes/loading/'.$smof_data['page_loader_style'].'.php'; ?>
        </div>
    <?php endif;?>
    <div id="wrapper"<?php if( $smof_data['page_loader'] == '1'):?> class="cs_hidden"<?php endif;?>>
        <div class="header-wrapper <?php echo (isset($post) && get_post_meta($post->ID, 'cs_layout', true)) ? 'no-container' : 'container nopaddingall'; ?>">
            <?php cshero_header(); ?>
        </div>
        <?php require_once 'framework/includes/page-title.php'; ?>

