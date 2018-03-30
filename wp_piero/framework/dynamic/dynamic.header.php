<?php
/**
 * Title: auto render
 * Author: Fox
 */
/**
 * edit options from page
 */
global $page_id,$smof_data, $overlay_page_title;
cshero_re_render_options();
/**
 * google fonts
 */
for ($i = 2; $i <= 12; $i ++) {
    if ($smof_data["typography_selector_$i"]) {
        echo cshero_typography_render($smof_data["typography_$i"], $smof_data["typography_selector_$i"]);
    } elseif ($i > 3) {
        break;
    }
}
/**
 * body background
 */
if ($smof_data['background-body']) {
    echo cshero_backgrounds_render($smof_data["background-body"], 'body');
}
/**
 * header background
 */
if ($smof_data['background-header']) {
    echo cshero_backgrounds_render($smof_data["background-header"], 'body #cshero-header');
    echo cshero_backgrounds_render($smof_data["background-header"], 'body #header-top2');
}

/**
 * page title $ bc
 */
if ($smof_data['background-page-title']) {
    echo cshero_backgrounds_render($smof_data["background-page-title"], '#cs-page-title-wrapper');
    echo cshero_backgrounds_render($smof_data["background-page-title"]['background-color'], '#cs-page-title-wrapper:before');
}
/**
 * bottom background
 */
if ($smof_data['background-bottom']) {
    echo cshero_backgrounds_render($smof_data["background-bottom"], '#cs-bottom-wrap');
}
/**
 * footer background
 */
if ($smof_data['background-footer-top']) {
    echo cshero_backgrounds_render($smof_data["background-footer-top"], '#footer-top');
}
?>

/**
* Header Top 2 
*/
#header-top2 {
    border-bottom:1px solid <?php echo esc_attr($smof_data['header_top2_widgets_border_color']);?>; 
}

#cshero-header .cshero-header-content-widget{
    height:<?php echo esc_attr($smof_data['nav_height']); ?>;
}
#cshero-header .logo > a {
    min-height:<?php echo esc_attr($smof_data['nav_height']); ?> ;
    line-height:<?php echo esc_attr($smof_data['nav_height']); ?> ;
    
}
#cshero-header .logo > a img{
    margin:<?php echo esc_attr($smof_data['margin_logo']);?>;
    padding:<?php echo esc_attr($smof_data['padding_logo']);?>;
}

@media (min-width:992px){
    #cshero-header ul.cshero-dropdown > li > a,
    #cshero-header .menu-pages .menu > ul > li > a{
        line-height: <?php echo esc_attr($smof_data['nav_height']); ?>;
    }
}

#cshero-header.transparentFixed{
    color:<?php if(isset($smof_data['header_fixed_menu_color'])) echo esc_attr($smof_data['header_fixed_menu_color']);?>;
    border-bottom:<?php echo esc_attr($smof_data['header_border_bottom_style']); ?> <?php echo esc_attr($smof_data['header_border_bottom_height']); ?> <?php echo HexToRGB($smof_data['header_border_bottom_color']['color'],$smof_data['header_border_bottom_color']['alpha']);?>;
}

#cshero-header.transparentFixed h1,
#cshero-header.transparentFixed h2,
#cshero-header.transparentFixed h3,
#cshero-header.transparentFixed h4,
#cshero-header.transparentFixed h5,
#cshero-header.transparentFixed h6,
#cshero-header.transparentFixed ul.cshero-dropdown > li > a,
#cshero-header.transparentFixed .cshero-header-content-widget a,
#cshero-header.transparentFixed .header-top-widget2-col a,
#cshero-header.transparentFixed .widget_cart_search_wrap a.icon_search_wrap{
    color:<?php if(isset($smof_data['header_fixed_menu_color'])) echo esc_attr($smof_data['header_fixed_menu_color']);?>;
}
#cshero-header.transparentFixed ul.cshero-dropdown > li > a:hover,
#cshero-header.transparentFixed .cshero-header-content-widget a:hover,
#cshero-header.transparentFixed .header-top-widget2-col a:hover,
#cshero-header.transparentFixed .widget_cart_search_wrap a.icon_search_wrap:hover{
    color:<?php if(isset($smof_data['header_fixed_menu_color_hover'])) echo esc_attr($smof_data['header_fixed_menu_color_hover']);?>;
}
#cshero-header.transparentFixed #header-top2{
    color:<?php if(isset($smof_data['header_fixed_menu_color'])) echo esc_attr($smof_data['header_fixed_menu_color']);?>;    
}

/* Menu */
<?php if ($smof_data['enable_menu_border']) { ?>
    ul.cshero-dropdown > li > a > span{
        padding-right:10px;
    }
    ul.cshero-dropdown > li > a:after {
        content: "|";
        position: absolute;
        right: 0;
        top:-1px;
        color:<?php echo esc_attr($smof_data['menu_border_color']); ?>;
    }
    ul.cshero-dropdown > li:last-child > a:after{
        content:"";
    }
<?php } ?>

/* First Level */
#cshero-header ul.cshero-dropdown > li > a,
#cshero-header .menu-pages .menu > ul > li > a{
    color:<?php echo esc_attr($smof_data['menu_first_color']);?>;
}
#cshero-header ul.cshero-dropdown > li > a:hover,
#cshero-header .menu-pages .menu > ul > li > a:hover,
#cshero-header ul.cshero-dropdown > li > a:focus,
#cshero-header ul.cshero-dropdown > li:hover > a,
#cshero-header ul.cshero-dropdown > li:focus > a,
#cshero-header ul.cshero-dropdown > li:active > a{
    color:<?php echo esc_attr($smof_data['menu_hover_first_color']);?>;
}
#cshero-header ul.cshero-dropdown > li.current-menu-item > a,
#cshero-header ul.cshero-dropdown > li.current-menu-ancestor > a,
#cshero-header ul.cshero-dropdown > li > a.active,
#cshero-header ul.cshero-dropdown > li > a:active{
    color:<?php echo esc_attr($smof_data['menu_active_first_color']);?>;
}


/* Header fixed Left/Right */
<?php if($smof_data['arrow_parents_item_menu']) {?>
    .header-v4 .cshero-menu-left .cshero-dropdown li.menu-item-has-children > a {padding-<?php echo esc_attr($smof_data['header_position']); ?>: 20px !important;}
    .header-v4 .cshero-menu-left .cshero-dropdown li.menu-item-has-children > a:before{
        <?php echo esc_attr($smof_data['header_position']); ?>: 5px;
    }

<?php } ?>
@media (min-width: 993px) {
    body.header-v4 > div{
        padding-<?php echo esc_attr($smof_data['header_position']); ?>:<?php echo esc_attr($smof_data['header_width']); ?>;
    }
    body.header-v4 .header-wrapper{
        <?php echo esc_attr($smof_data['header_position']); ?>:0;
    }
    body.header-v4 .cshero-header-fixed-content-widget{
        <?php echo esc_attr($smof_data['header_position']); ?>:0;
    }
}

/**** Start Page Title ****/
#cs-page-title-wrapper{
    padding: <?php echo esc_attr($smof_data['page_title_padding']); ?>;
    margin: <?php echo esc_attr($smof_data['page_title_margin']); ?>;
    <?php if($smof_data['page_title_border_top'] == '1'): ?>
        border-top: 1px solid <?php echo esc_attr($smof_data['page_title_border_color']); ?>;
    <?php endif; ?>
    <?php if($smof_data['page_title_border_bottom'] == '1'): ?>
        border-bottom: 1px solid <?php echo esc_attr($smof_data['page_title_border_color']); ?>;
    <?php endif; ?>
}

#cs-page-title-wrapper .title_bar .page-title{
    color: <?php echo esc_attr($smof_data['page_title_color']); ?>;
    font-size: <?php echo esc_attr($smof_data['title_bar_size']); ?>;
}
#cs-page-title-wrapper .title_bar, #cs-page-title-wrapper .title_bar .sub_header_text{
<?php $title_sub_color = get_post_meta($page_id, 'cs_page_title_custom_subheader_text_color', true); ?>
    text-align: <?php echo esc_attr($smof_data['page_title_bar_align']); ?>;
    color: <?php echo esc_attr($title_sub_color ? $title_sub_color : $smof_data['page_title_color']);?>; 
}
/**** End Page Title ****/
/**** Start Breadcrumb ****/
#cs-breadcrumb-wrapper{
    text-align: <?php echo esc_attr($smof_data['breadcrumb_text_align']); ?>;
}
#cs-breadcrumb-wrapper, #cs-breadcrumb-wrapper span, #cs-breadcrumb-wrapper a{
    color: <?php echo esc_attr($smof_data['breadcrumbs_text_color']); ?>;
}
<?php if($smof_data['breadcrumbs_item_padding']): ?>
    .csbody #cs-breadcrumb-wrapper .cs-breadcrumbs a,
    .csbody #cs-breadcrumb-wrapper .cs-breadcrumbs span {
        padding: <?php echo esc_attr($smof_data['breadcrumbs_item_padding']); ?>;
    }
<?php endif; ?>
<?php if($smof_data['breadcrumbs_separator']): ?>
    .csbody #cs-breadcrumb-wrapper .cs-breadcrumbs a:after {
        content: "\<?php echo esc_attr($smof_data['breadcrumbs_separator']); ?>";
    }
<?php endif; ?>
/**** End Breadcrumb ****/