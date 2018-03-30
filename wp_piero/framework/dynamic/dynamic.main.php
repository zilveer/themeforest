<?php 
global $smof_data, $overlay_page_title;
/*
 * Convert HEX to GRBA
 */
if(!function_exists('HexToRGB')){
    function HexToRGB($hex,$opacity = 1) {
        $hex = str_replace("#",null, $hex);
        $color = array();
        if(strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex,0,1).substr($hex,0,1));
            $color['g'] = hexdec(substr($hex,1,1).substr($hex,1,1));
            $color['b'] = hexdec(substr($hex,2,1).substr($hex,2,1));
            $color['a'] = $opacity;
        }
        else if(strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
            $color['a'] = $opacity;
        }
        $color = "rgba(".implode(', ', $color).")";
        return $color;
    }
}
?>
/* =========================================================        Reset Body    ========================================================= */

.container{
	max-width: <?php echo esc_attr($smof_data['container_width']);?>;
}
#primary.no_breadcrumb_page > .container {
	margin-top: <?php echo esc_attr($smof_data['main_content_margin_top']); ?>;
	margin-bottom: <?php echo esc_attr($smof_data['main_content_margin_bottom']); ?>;
}
.csbody:not(.home) #primary > .container,
.csbody:not(.home) #primary > .no-container{
	 background-color:  <?php echo esc_attr($smof_data['content_bg_color']); ?>;
}
.csbody a {
    color: <?php echo esc_attr($smof_data['link_color']); ?>;
}
.csbody a:hover,
.csbody a:focus,
.csbody a:active,
.csbody a.active {
    color: <?php echo esc_attr($smof_data['link_color_hover']); ?>;
}
.color-primary,
.primary-color,
.primary-color *,
.custom-heading-wrap.title-primary-color h2,
.custom-heading-wrap.title-primary-color h3,
.custom-heading-wrap.title-primary-color h4,
.custom-heading-wrap.title-primary-color h5,
.custom-heading-wrap.title-primary-color h6{
    color: <?php echo esc_attr($smof_data['primary_color']); ?>;
}
.color-secondary,
.custom-heading-wrap.title-secondary-color h2,
.custom-heading-wrap.title-secondary-color h3,
.custom-heading-wrap.title-secondary-color h4,
.custom-heading-wrap.title-secondary-color h5,
.custom-heading-wrap.title-secondary-color h6{
    color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}

.bg-primary-color,
ul.cs_list_circle li:before, 
ul.cs_list_circleNumber li:before{
    background-color:<?php echo esc_attr($smof_data['primary_color']); ?>;
}


/* =========================================================        Start Typo    ========================================================= */
body.csbody h1 > a {
    color:<?php echo esc_attr($smof_data['typography_h1']['color']); ?>;
}
body.csbody h2 > a {
    color: <?php echo esc_attr($smof_data['typography_h2']['color']); ?>;
}
body.csbody h3 > a  {
    color:<?php echo esc_attr($smof_data['typography_h3']['color']); ?>;
}
body.csbody h4 > a {
   color: <?php echo esc_attr($smof_data['typography_h4']['color']); ?>;
}
body.csbody h5 > a {
   color: <?php echo esc_attr($smof_data['typography_h5']['color']); ?>;
}
body.csbody h6 > a {
   color:<?php echo esc_attr($smof_data['typography_h6']['color']); ?>;
}

/* ========================================    Start Header   ================================ */

/* Header Top Color Option */
    #header-top {
        background: <?php echo esc_attr($smof_data['header_top_bg_color']); ?> ;
        color:<?php echo esc_attr($smof_data['header_top_text_color']); ?> ;
    }
    #header-top h1,#header-top h2,#header-top h3,
    #header-top h4,#header-top h5,#header-top h6{
        color: <?php echo esc_attr($smof_data['header_top_headings_color']); ?>;
    }
    #header-top a{
        color: <?php echo esc_attr($smof_data['header_top_link_color']); ?>;
    }
    #header-top a:hover,
    #header-top a:focus,
    #header-top a:active{
        color: <?php echo esc_attr($smof_data['header_top_link_hover_color']); ?>;
    }

/* Header Top 2 Color Option */
    #header-top2 {
        background: <?php echo esc_attr($smof_data['header_top2_bg_color']); ?> ;
        color:<?php echo esc_attr($smof_data['header_top2_text_color']); ?> ;
    }

    #header-top2 h1,#header-top2 h2,#header-top2 h3,
    #header-top2 h4,#header-top2 h5,#header-top2 h6{
        color: <?php echo esc_attr($smof_data['header_top2_headings_color']); ?>;
    }
    
    #header-top2 a{
        color: <?php echo esc_attr($smof_data['header_top2_link_color']); ?>;
    }
    #header-top2 a:hover,
    #header-top2 a:focus,
    #header-top2 a:active{
        color: <?php echo esc_attr($smof_data['header_top2_link_hover_color']); ?>;
    }

/* Default Main Navigation Header Widget */
    #cshero-header .cshero-header-content-widget{
        position: relative;
        color:<?php echo esc_attr($smof_data['header_text_color']); ?> ;
    }
    #cshero-header .cshero-header-content-widget a:not(.btn) {
        padding:<?php echo esc_attr($smof_data['default_search_padding']); ?>;
        color: <?php echo esc_attr($smof_data['header_link_color']); ?>;
        display:inline-block;
    }
    #cshero-header .cshero-header-content-widget .cshero-hidden-sidebar-btn > a{
        padding:<?php echo esc_attr($smof_data['default_hidden_sidebar_padding']); ?>;
    }
    #cshero-header .cshero-header-content-widget a:not(.btn):hover,
    #cshero-header .cshero-header-content-widget a:not(.btn):focus,
    #cshero-header .cshero-header-content-widget a:not(.btn):active{
        color: <?php echo esc_attr($smof_data['header_link_hover_color']); ?>;
    }
/* End Default Main Navigation Header Widget */

#cshero-header{
    padding:<?php echo esc_attr($smof_data['header_padding']); ?>;
    margin:<?php echo esc_attr($smof_data['header_margin']); ?>;
    border-bottom:<?php echo esc_attr($smof_data['header_border_bottom_height']); ?> <?php echo esc_attr($smof_data['header_border_bottom_style']); ?> <?php echo HexToRGB($smof_data['header_border_bottom_color']['color'],$smof_data['header_border_bottom_color']['alpha']);?>;
}
.logo > a {
    padding: <?php echo esc_attr($smof_data['padding_logo']); ?>;
    margin:<?php echo esc_attr($smof_data['margin_logo']); ?>; 
}
    /*** Special style for each header ***/
    /* Header V2 */
    .header-v2 #cshero-header .logo > a{
        min-height: 0;
        line-height: normal;
        <?php if  ($smof_data['padding_logo']) { ?>
            padding: <?php echo esc_attr($smof_data['padding_logo']); ?>;
        <?php } else {?>
            padding-top:30px;
        <?php } ?>
        margin:<?php echo esc_attr($smof_data['margin_logo']); ?>;
    }

    /* Header V4 Fixed on Left / Right*/
    
    @media (min-width: 993px) {
        <?php if($smof_data['menu_sub_sep_color']): ?>
        .header-v4 .main-menu-left > ul > li > a {
            /* border-bottom: 1px solid <?php echo esc_attr($smof_data['menu_sub_sep_color']); ?> ; */
        }
        <?php endif; ?>
        
        .header-v4 .header-wrapper, .header-v4 #cshero-header,
        .header-v4 .cshero-header-fixed-content-widget {
            width: <?php echo esc_attr($smof_data['header_width']); ?>;
        }
        <?php if($smof_data['header_position']=='right'): ?>
        .csbody.header-v4 .cs-sticky.fixed {
            left: inherit;
            right: 0;
        }
        .csbody.header-v4 .sticky-wrapper,
        .csbody.header-v4 #cshero-header {
            right: 0;
        }
        <?php endif; ?>
        .header-left .main-menu > li:hover:before,
        .header-left .main-menu > li:hover:after,
        .header-left .main-menu > li.current-menu-item:before,
        .header-left .main-menu > li.current-menu-item:after,
        .header-left .main-menu > li.current-menu-parent:before,
        .header-left .main-menu > li.current-menu-parent:after {
            background-color:  <?php echo HexToRGB($smof_data['menu_bg_hover_color_first']['color'], $smof_data['menu_bg_hover_color_first']['alpha']); ?>;
        }
        .header-v4 #cshero-header ul.cshero-dropdown > li > a{
            line-height: normal;
            padding-top: 10px;
            padding-bottom: 10px;
        }
    }
    
    <?php if($smof_data['arrow_parents_item_menu']) {?>
        .header-v4 .cshero-menu-left .cshero-dropdown li.menu-item-has-children > a:before{
            content:"\f067";
            font-family:"FontAwesome";
            font-size:10px;
        }
        .header-v4 .cshero-menu-left .cshero-dropdown li.menu-item-has-children > a:hover:before{
            content:"\f068";
        }
    <?php } ?>

/* Sticky Header */
    #header-sticky {
        background-color: <?php echo HexToRGB($smof_data['header_sticky_bg_color']['color'], $smof_data['header_sticky_bg_color']['alpha']); ?>;
        <?php if (!empty($smof_data['header_sticky_border_color']['color'])) { ?>
        border-bottom:1px solid  <?php echo HexToRGB($smof_data['header_sticky_border_color']['color'], $smof_data['header_sticky_border_color']['alpha']); ?>
        <?php } ?>
    }
    #sticky-nav-wrap .menu-item-cart-search .header-cart-search .widget_searchform_content,
    #sticky-nav-wrap .menu-item-cart-search .header-cart-search .shopping_cart_dropdown {
        top: <?php echo esc_attr($smof_data['header_sticky_height']); ?>;
    }
    .sticky-header .cshero-logo > a{
        line-height: <?php echo esc_attr($smof_data['header_sticky_height']); ?>;
        min-height: <?php echo esc_attr($smof_data['header_sticky_height']); ?>;
        padding:<?php echo esc_attr($smof_data['sticky_padding_logo']); ?>;
        margin:<?php echo esc_attr($smof_data['sticky_margin_logo']); ?>;
    }

    /* Sticky Header Main Navigation Widget */
        #header-sticky .cshero-header-content-widget{
            height:<?php echo esc_attr($smof_data['header_sticky_height']); ?>;
            position: relative;
        }
        #header-sticky .cshero-header-content-widget a{
            padding:<?php echo esc_attr($smof_data['default_search_padding']); ?>;
        }
        #header-sticky .cshero-header-content-widget .cshero-hidden-sidebar-btn > a{
            padding:<?php echo esc_attr($smof_data['default_hidden_sidebar_padding']); ?>;
        }
        #header-sticky .cshero-header-content-widget{
            height:<?php echo esc_attr($smof_data['header_sticky_height']); ?>;
            position: relative;
            color:<?php echo esc_attr($smof_data['header_text_color']); ?> ;
        }
        #header-sticky .cshero-header-content-widget a{
            padding:<?php echo esc_attr($smof_data['default_search_padding']); ?>;
            color: <?php echo esc_attr($smof_data['header_link_color']); ?>;
        }
        #header-sticky .cshero-header-content-widget .cshero-hidden-sidebar-btn > a{
            padding:<?php echo esc_attr($smof_data['default_hidden_sidebar_padding']); ?>;
        }
        #header-sticky .cshero-header-content-widget a:hover,
        #header-sticky .cshero-header-content-widget a:focus,
        #header-sticky .cshero-header-content-widget a:active{
            color: <?php echo esc_attr($smof_data['header_top_link_hover_color']); ?>;
        }
    /* End Sticky Header Navigation Widget */


    <?php if (!$smof_data['header_sticky_tablet']): ?>
        @media (max-width: 992px) and (min-width: 768px) {
            #header-sticky{
                display: none;
            }
        }
    <?php endif; ?>
    <?php if (!$smof_data['header_sticky_mobile']): ?>
        @media (max-width: 767px) {
            #header-sticky{
                display: none;
            }
        }
    <?php endif; ?>
/*** Start Main Menu ***/
    /* General Option */
    .cshero-menu-dropdown > ul > li > a{
        <?php if(isset($smof_data['menu_first_level_text_uppecase']) && $smof_data['menu_first_level_text_uppecase']=='1'): ?>
            text-transform: uppercase;
        <?php endif; ?>
    }
    <?php if ($smof_data['enable_menu_border']) { ?>
    .cshero-menu-dropdown > ul > li > a > span{
        padding-right:5px;
    }
    .cshero-menu-dropdown > ul > li > a:after {
        content: "|";
        position: absolute;
        right: 0;
        top:-1px;
        color:<?php echo esc_attr($smof_data['menu_border_color']); ?>;
    }
    .cshero-menu-dropdown > ul > li:last-child > a:after{
        content:"";
    }
    <?php } ?>
       
    /* Sub level */
    .cshero-menu-dropdown ul li ul {
        min-width: <?php echo esc_attr($smof_data['dropdown_menu_width']); ?>;
    }
    .cshero-dropdown ul li  a{
        <?php if(isset($smof_data['menu_second_level_text_uppecase']) && $smof_data['menu_second_level_text_uppecase']=='1'): ?>
            text-transform: uppercase;
        <?php endif; ?>
        line-height:<?php echo esc_attr($smof_data['menu_second_level_line_height']);?>;
    }
    
    /* End General Option */

    /* Default Menu */
    #cshero-header .main-menu-content,
    #cshero-header .full-menu-background   {
        background-color: <?php echo esc_attr($smof_data['menu_bg_color']); ?> ;
    }

    /* First Level */
    #cshero-header ul.cshero-dropdown > li > a,
    #cshero-header .menu-pages .menu > ul > li > a{
        font-size:<?php echo esc_attr($smof_data['menu_fontsize_first_level']);?>;
        padding: <?php echo esc_attr($smof_data['nav_padding']); ?>;
        margin:<?php echo esc_attr($smof_data['nav_margin']); ?>;
    }
    #cshero-header ul.cshero-dropdown > li > a:hover,
    #cshero-header .menu-pages .menu > ul > li > a:hover,
    #cshero-header ul.cshero-dropdown > li > a:focus,
    #cshero-header ul.cshero-dropdown > li:hover > a,
    #cshero-header ul.cshero-dropdown > li:focus > a,
    #cshero-header ul.cshero-dropdown > li:active > a{
        background-color:<?php echo HexToRGB($smof_data['menu_bg_hover_color_first']['color'],$smof_data['menu_bg_hover_color_first']['alpha']);?>;
    }
    #cshero-header ul.cshero-dropdown > li.current-menu-item > a,
    #cshero-header ul.cshero-dropdown > li.current-menu-ancestor > a,
    #cshero-header ul.cshero-dropdown > li > a.active,
    #cshero-header ul.cshero-dropdown > li > a:active{
        background-color:<?php echo HexToRGB($smof_data['menu_bg_actived_color_first']['color'],$smof_data['menu_bg_actived_color_first']['alpha']);?>;
    }
    /* Sub Level */
    #cshero-header #menu ul.cshero-dropdown .sub-menu{
        background-color:<?php echo esc_attr($smof_data['menu_sub_bg_color']);?>;
    }
    #cshero-header #menu ul.cshero-dropdown ul.standar-dropdown.sub-menu > .no_group,
    #cshero-header #menu ul.cshero-dropdown ul.standar-dropdown.sub-menu .standard.sub-menu> .no_group {
        border-top:1px solid <?php echo esc_attr($smof_data['menu_sub_sep_color']);?>;
    }
    #cshero-header #menu ul.cshero-dropdown ul.sub-menu .group > a {
        border-top:1px solid <?php echo esc_attr($smof_data['menu_sub_sep_color']);?>;
        border-bottom:1px solid <?php echo esc_attr($smof_data['menu_sub_sep_color']);?>;
    }
    #cshero-header #menu ul.sub-menu .group > a{
        color:<?php echo esc_attr($smof_data['menu_first_color']);?>;
    }
    #cshero-header #menu ul.cshero-dropdown ul > li > a{
        font-size:<?php echo esc_attr($smof_data['menu_fontsize_sub_level']);?>;
        color:<?php echo esc_attr($smof_data['menu_sub_color']);?>;
    }
    /* Hover state */
    #cshero-header #menu ul.cshero-dropdown ul > li > a:hover,
    #cshero-header #menu ul.cshero-dropdown ul > li > a:focus,
    #cshero-header #menu ul.cshero-dropdown ul > li:not(.group):hover > a,
    #cshero-header #menu ul.cshero-dropdown ul > li:not(.group):focus > a,
    #cshero-header #menu ul.cshero-dropdown ul > li:not(.group):active > a,
    #cshero-header #menu ul.cshero-dropdown ul > li:not(.group):visited > a{
        color:<?php echo esc_attr($smof_data['menu_sub_hover_color']);?>;
        background-color:<?php echo esc_attr($smof_data['menu_bg_hover_color']);?>;
    }
    /* Active state */
    #cshero-header #menu ul.cshero-dropdown ul > li.current-menu-item > a,
    #cshero-header #menu ul.cshero-dropdown ul > li.current-menu-ancestor > a,
    #cshero-header #menu ul.cshero-dropdown ul > li > a:active,
    #cshero-header #menu ul.cshero-dropdown ul > li > a.active{
        color:<?php echo esc_attr($smof_data['menu_sub_active_color']);?>;
        background-color:<?php echo esc_attr($smof_data['menu_bg_hover_color']);?>;
    }
    /* End Default Menu*/
    /* Sticky Menu */
    .sticky-menu{
        background-color: <?php echo esc_attr($smof_data['sticky_menu_bg_color']); ?> ;
    }
    /* First Level */
    #header-sticky ul.cshero-dropdown > li > a,
    #header-sticky .menu-pages .menu > ul > li > a {
        font-size:<?php echo esc_attr($smof_data['sticky_menu_fontsize_first_level']);?>; 
        color:<?php echo esc_attr($smof_data['sticky_menu_first_color']);?>;
        line-height: <?php echo esc_attr($smof_data['header_sticky_height']); ?>;
        padding: <?php echo esc_attr($smof_data['sticky_nav_padding']); ?>;
        margin:<?php echo esc_attr($smof_data['sticky_nav_margin']); ?>;
    }
    #header-sticky ul.cshero-dropdown > li > a:hover,
    #header-sticky ul.cshero-dropdown > li > a:focus,
    #header-sticky ul.cshero-dropdown > li:hover > a,
    #header-sticky .menu-pages .menu > ul > li:hover > a,
    #header-sticky ul.cshero-dropdown > li:focus > a,
    #header-sticky ul.cshero-dropdown > li:active > a{
        color:<?php echo esc_attr($smof_data['sticky_menu_hover_first_color']);?>;
        background-color:<?php echo HexToRGB($smof_data['sticky_menu_bg_hover_color_first']['color'],$smof_data['sticky_menu_bg_hover_color_first']['alpha']);?>;
    }
    #header-sticky ul.cshero-dropdown > li.current-menu-item > a,
    #header-sticky ul.cshero-dropdown > li.current-menu-ancestor > a,
    #header-sticky ul.cshero-dropdown > li > a.active,
    #header-sticky ul.cshero-dropdown > li > a:active{
        color:<?php echo esc_attr($smof_data['sticky_menu_active_first_color']);?>;
        background-color:<?php echo HexToRGB($smof_data['sticky_menu_bg_actived_color_first']['color'],$smof_data['sticky_menu_bg_actived_color_first']['alpha']);?>;
    }
    /* Sub Level */

    #header-sticky ul.cshero-dropdown .sub-menu{
        background-color:<?php echo esc_attr($smof_data['sticky_menu_sub_bg_color']);?>;
    }
    #header-sticky ul.cshero-dropdown ul.standar-dropdown.sub-menu > .no_group,
    #header-sticky ul.cshero-dropdown ul.standar-dropdown.sub-menu .standard.sub-menu > .no_group {
        border-top:1px solid <?php echo esc_attr($smof_data['sticky_menu_sub_sep_color']);?>;
    }
    #header-sticky ul.cshero-dropdown ul.sub-menu .group > a {
        border-top:1px solid <?php echo esc_attr($smof_data['sticky_menu_sub_sep_color']);?>;
        border-bottom:1px solid <?php echo esc_attr($smof_data['sticky_menu_sub_sep_color']);?>;
    }
    #header-sticky ul.sub-menu .group > a {
        color:<?php echo esc_attr($smof_data['sticky_menu_first_color']);?>;
    }
    #header-sticky ul.cshero-dropdown ul > li > a{
        font-size:<?php echo esc_attr($smof_data['sticky_menu_fontsize_sub_level']);?>;
        color:<?php echo esc_attr($smof_data['sticky_menu_sub_color']);?>;
    }
    /* Hover state */
    #header-sticky ul.cshero-dropdown ul > li > a:hover,
    #header-sticky ul.cshero-dropdown ul > li > a:focus,
    #header-sticky ul.cshero-dropdown ul > li:not(.group):hover > a,
    #header-sticky ul.cshero-dropdown ul > li:not(.group):focus > a,
    #header-sticky ul.cshero-dropdown ul > li:not(.group):active > a,
    #header-sticky ul.cshero-dropdown ul > li:not(.group):visited > a{
        color:<?php echo esc_attr($smof_data['sticky_menu_sub_hover_color']);?>;
        background-color:<?php echo esc_attr($smof_data['sticky_menu_bg_hover_color']);?>;
    }
    /* Active state */
    #header-sticky ul.cshero-dropdown ul > li.current-menu-item > a,
    #header-sticky ul.cshero-dropdown ul > li.current-menu-ancestor > a
    #header-sticky ul.cshero-dropdown ul > li > a:active,
    #header-sticky ul.cshero-dropdown ul > li > a.active{
        color:<?php echo esc_attr($smof_data['sticky_menu_sub_active_color']);?>;
        background-color:<?php echo esc_attr($smof_data['sticky_menu_bg_hover_color']);?>;
    }
    /* End Sticky Menu*/

    /* Main header  sidebar icon */
    #cshero-header  ul.cs-hidden-sidebar > li > a{
        line-height: <?php echo esc_attr($smof_data['nav_height']); ?>;
        padding:<?php echo esc_attr($smof_data['default_hidden_sidebar_padding']); ?>;

    }
    #cshero-header  ul.cs-item-cart-search > li .header a{
        line-height: <?php echo esc_attr($smof_data['nav_height']); ?>;
        padding:<?php echo esc_attr($smof_data['default_search_padding']); ?>;
    }
    
    /* Sticky sidebar icon */
    #header-sticky  ul.cs-hidden-sidebar > li > a{
        line-height: <?php echo esc_attr($smof_data['header_sticky_height']); ?>;
        padding:<?php echo esc_attr($smof_data['sticky_hidden_sidebar_padding']); ?>;
    }
    #header-sticky  ul.cs-item-cart-search > li .header a{
        line-height: <?php echo esc_attr($smof_data['header_sticky_height']); ?>;
        padding:<?php echo esc_attr($smof_data['sticky_search_padding']); ?>;
    }
        
/* Custom Menu Header */
.cs_custom_header_menu{}
    /* Fix Social Widget */
    .cs_custom_header_menu ul.cs-social li a,
    .cs_custom_header_menu li.cshero-hidden-sidebar a{
        padding:<?php echo esc_attr($smof_data['default_search_padding']); ?> !important;
        color: <?php echo esc_attr($smof_data['header_link_color']); ?> !important;
        display:inline-block !important;
    }
    .cs_custom_header_menu ul.cs-social li a:hover,
    .cs_custom_header_menu ul.cs-social li a:focus,
    .cs_custom_header_menu ul.cs-social li a:active,
    .cs_custom_header_menu li.cshero-hidden-sidebar a:hover,
    .cs_custom_header_menu li.cshero-hidden-sidebar a:focus,
    .cs_custom_header_menu li.cshero-hidden-sidebar a:active{
        color: <?php echo esc_attr($smof_data['header_top_link_hover_color']); ?> !important;
    }
/* End Custom Menu Header */
#menu.menu-up .main-menu > li > ul{
    bottom: <?php echo esc_attr($smof_data['nav_height']); ?>; /* for menu fixed bottm */
}

/* Mobile Tablet Menu */
    #cshero-main-menu-mobile { 
        background-color:<?php echo esc_attr($smof_data['mobile_menu_bg_color']); ?>;
    }
    /* First Level */
    #cshero-main-menu-mobile ul.cshero-dropdown > li > a { 
        color:<?php echo esc_attr($smof_data['mobile_menu_first_color']); ?>;
    }
    #cshero-main-menu-mobile ul.cshero-dropdown > li > a:hover { 
        color:<?php echo esc_attr($smof_data['mobile_menu_hover_first_color']); ?>;
    }
    /* Level 2+ */
    #cshero-main-menu-mobile ul.sub-menu > li > a{
        border-bottom:1px solid <?php echo esc_attr($smof_data['mobile_menu_sub_sep_color']); ?>;
    }
    #cshero-main-menu-mobile ul.sub-menu > li > a{
        color:<?php echo esc_attr($smof_data['mobile_menu_sub_color']); ?>;
    }
    #cshero-main-menu-mobile ul.sub-menu > li > a:hover{
        color:<?php echo esc_attr($smof_data['mobile_menu_sub_hover_color']); ?>;
    }

/* =========================================================        Start Primary    =========================================================*/
    /* Page title */
    #cs-page-title-wrapper .title_bar:after{ background-color:<?php echo esc_attr($smof_data['secondary_color']);?>}
    /* Form Style */
        form {
            background-color: <?php echo esc_attr($smof_data['form_bg_color']); ?>;
        }

        form,
        form label,
        form input,
        form button,
        form select,
        form textarea,
        input::-moz-placeholder, 
        textarea::-moz-placeholder {
            color: <?php echo esc_attr($smof_data['form_text_color']); ?>;
        }

        form input,
        form select,
        form textarea,
        form button {
            color: <?php echo esc_attr($smof_data['form_text_color']); ?>;
            background-color: <?php echo esc_attr($smof_data['form_field_bg_color']); ?>;
            border-style:<?php echo esc_attr($smof_data['form_border_style']); ?>;
            border-width: <?php echo esc_attr($smof_data['form_border_width']); ?>;
            border-color: <?php echo esc_attr($smof_data['form_border_color']); ?>;
            -webkit-border-radius: <?php echo esc_attr($smof_data['form_border_radius']);?>; 
            -ms-border-radius: <?php echo esc_attr($smof_data['form_border_radius']);?>;
            -moz-border-radius: <?php echo esc_attr($smof_data['form_border_radius']);?>;
            -o-border-radius: <?php echo esc_attr($smof_data['form_border_radius']);?>;
            border-radius: <?php echo esc_attr($smof_data['form_border_radius']);?>;
            box-shadow: <?php echo esc_attr($smof_data['form_shadow']); ?>;
            -moz-box-shadow: <?php echo esc_attr($smof_data['form_shadow']); ?>;
            -webkit-box-shadow: <?php echo esc_attr($smof_data['form_shadow']); ?>;
            -ms-box-shadow: <?php echo esc_attr($smof_data['form_shadow']); ?>;
            -o-box-shadow: <?php echo esc_attr($smof_data['form_shadow']); ?>;
        }

        form input:hover,
        form select:hover,
        form textarea:hover,
        form button:hover,
        form input:active,
        form select:active,
        form textarea:active,
        form button:active,
        form input:focus,
        form select:focus,
        form textarea:focus,
        form button:focus {
            background-color: <?php echo esc_attr($smof_data['form_field_bg_color_hover']); ?>;
            border-color: <?php echo esc_attr($smof_data['form_border_color_hover']); ?>;
            box-shadow: <?php echo esc_attr($smof_data['form_shadow_hover']); ?>;
            -moz-box-shadow: <?php echo esc_attr($smof_data['form_shadow_hover']); ?>;
            -webkit-box-shadow: <?php echo esc_attr($smof_data['form_shadow_hover']); ?>;
            -ms-box-shadow: <?php echo esc_attr($smof_data['form_shadow_hover']); ?>;
            -o-box-shadow: <?php echo esc_attr($smof_data['form_shadow_hover']); ?>;
        }
/* Style for FORM in Parallax section
NOTE: you need add extra class name called parallax-form to row or column or shortcode setting
*/
.content-area .parallax-form input[type="text"]:hover,
.content-area .parallax-form input[type="password"]:hover,
.content-area .parallax-form input[type="datetime"]:hover,
.content-area .parallax-form input[type="datetime-local"]:hover,
.content-area .parallax-form input[type="date"]:hover,
.content-area .parallax-form input[type="month"]:hover,
.content-area .parallax-form input[type="time"]:hover,
.content-area .parallax-form input[type="week"]:hover,
.content-area .parallax-form input[type="number"]:hover,
.content-area .parallax-form input[type="email"]:hover,
.content-area .parallax-form input[type="url"]:hover,
.content-area .parallax-form input[type="search"]:hover,
.content-area .parallax-form input[type="tel"]:hover,
.content-area .parallax-form input[type="color"]:hover,
.content-area .parallax-form input[type="submit"]:hover,
.content-area .parallax-form textarea:hover,
.content-area .parallax-form label:hover,
.content-area .parallax-form select:hover{
    border-color: <?php echo esc_attr($smof_data['primary_color']); ?>;
}

/* =========================================================        Start Sidebar    =========================================================*/
.widget_calendar td:hover {
    background: <?php echo esc_attr($smof_data['primary_color']); ?>;
}
/* =========================================================        Start Title and Module    =========================================================*/
.title-preset2 h3 {
    color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.title-preset1 h3, .title-style-colorprimary-retro h3, .title-style-colorprimary-retro2 h3,
.title-style-colorprimary-retro2 h3 + p,.tagline  {
    color: <?php echo esc_attr($smof_data['primary_color']); ?> ;
}
.title-restaurant .wpb_wrapper > h1,
.title-restaurant .wpb_wrapper > h3 {
    background: <?php echo esc_attr($smof_data['primary_color']); ?>;
}
.title-restaurant2 .wpb_wrapper > h3,
.title-restaurant2 .wpb_wrapper > h1 {
    color: <?php echo esc_attr($smof_data['primary_color']); ?>;
}

/* =========================================================        Start Button Style    =========================================================*/

.csbody .btn, .csbody .btn-default, .csbody button, .csbody .button, .csbody input[type="button"] {
    font-size: <?php echo esc_attr($smof_data['button_font_size']); ?> ;
    <?php if($smof_data['button_uppercase'] == '1'): ?>
        text-transform: uppercase;
    <?php endif; ?>
    letter-spacing: <?php echo esc_attr($smof_data['button_letter_spacing']); ?>;
    font-weight:<?php echo substr($smof_data['button_font_style'],0,3); ?>;
    font-style:<?php echo substr($smof_data['button_font_style'],3); ?>;
    background-color: <?php echo HexToRGB($smof_data['button_gradient_top_color']['color'],$smof_data['button_gradient_top_color']['alpha']);?>;
    color: <?php echo esc_attr($smof_data['button_gradient_text_color']); ?>;
    border-style: <?php echo esc_attr($smof_data['button_border_style']); ?>;
    border-color: <?php echo esc_attr($smof_data['button_border_color']); ?>;
    border-width: <?php echo esc_attr($smof_data['button_border_width']); ?>;

    border-radius: <?php echo esc_attr($smof_data['button_border_radius']); ?>;
    -webkit-border-radius: <?php echo esc_attr($smof_data['button_border_radius']); ?>;
    -moz-border-radius: <?php echo esc_attr($smof_data['button_border_radius']); ?>;
    -ms-border-radius: <?php echo esc_attr($smof_data['button_border_radius']); ?>;
    -o-border-radius: <?php echo esc_attr($smof_data['button_border_radius']); ?>;
   
    padding-top: <?php echo esc_attr($smof_data['button_padding_top']); ?>;
    padding-right: <?php echo esc_attr($smof_data['button_padding_right']); ?>;
    padding-bottom: <?php echo esc_attr($smof_data['button_padding_bottom']); ?>;
    padding-left: <?php echo esc_attr($smof_data['button_padding_left']); ?>;

    margin: <?php echo esc_attr($smof_data['button_margin']); ?>;
}
.csbody .btn:hover,
.csbody .btn:focus,
.csbody .button:hover,
.csbody .button:focus,
.csbody  button:hover,
.csbody  button:focus {
    background-color: <?php echo HexToRGB($smof_data['button_gradient_top_color_hover']['color'],$smof_data['button_gradient_top_color_hover']['alpha']);?>;
    color: <?php echo esc_attr($smof_data['button_gradient_text_color_hover']); ?>;
    border-color: <?php echo esc_attr($smof_data['button_border_color_hover']); ?>;
}

/* btn Default Hover */
.csbody .btn-default:hover {
    border-color: <?php echo esc_attr($smof_data['button_border_color_hover']); ?>;
    color: <?php echo esc_attr($smof_data['button_gradient_text_color_hover']); ?>;
    background: <?php echo HexToRGB($smof_data['button_gradient_top_color_hover']['color'],$smof_data['button_gradient_top_color_hover']['alpha']);?>;
}
/* btn Default Alt */
.csbody .btn-default-alt {
    background:transparent;
    color: <?php echo esc_attr($smof_data['button_border_color']); ?>;
}
.csbody .btn-default-alt:hover,
.csbody .btn-default-alt:focus {
    background-color: <?php echo HexToRGB($smof_data['button_primary_background_color']['color'],$smof_data['button_primary_background_color']['alpha']); ?>;
}

/* btn primary */
.csbody  input[type="submit"],
.csbody .btn-primary,
.woocommerce #respond input#submit{
    font-size: <?php echo esc_attr($smof_data['button_primary_font_size']); ?>;
    <?php if($smof_data['button_uppercase'] == '1'): ?>
        text-transform: uppercase;
    <?php endif; ?>
    background-color: <?php echo HexToRGB($smof_data['button_primary_background_color']['color'],$smof_data['button_primary_background_color']['alpha']); ?>;
    color: <?php echo esc_attr($smof_data['button_primary_text_color']); ?>;
    border-style: <?php echo esc_attr($smof_data['button_primary_border_style']); ?>;
    border-color: <?php echo esc_attr($smof_data['button_primary_border_color']); ?>;
    border-width: <?php echo esc_attr($smof_data['button_primary_border_width']); ?>;    
    border-radius: <?php echo esc_attr($smof_data['button_primary_border_radius']); ?>;
    -webkit-border-radius: <?php echo esc_attr($smof_data['button_primary_border_radius']); ?>;
    -moz-border-radius: <?php echo esc_attr($smof_data['button_primary_border_radius']); ?>;
    -ms-border-radius: <?php echo esc_attr($smof_data['button_primary_border_radius']); ?>;
    -o-border-radius: <?php echo esc_attr($smof_data['button_primary_border_radius']); ?>;
}

.csbody  input[type="submit"]:hover,
.csbody  input[type="submit"]:focus,
.csbody  input#submit:hover,
.csbody  input#submit:focus,
.csbody .btn-primary:hover,
.csbody .btn-primary:active,
.csbody .btn-primary:focus,
.woocommerce #respond input#submit:hover {
    background-color: <?php echo HexToRGB($smof_data['button_primary_background_color_hover']['color'],$smof_data['button_primary_background_color_hover']['alpha']); ?>;
    color: <?php echo esc_attr($smof_data['button_primary_text_color_hover']); ?>;
    border-color: <?php echo esc_attr($smof_data['button_primary_border_color_hover']); ?>;  
}

.csbody .btn-primary-alt {
    border-color: <?php echo esc_attr($smof_data['button_primary_border_color']); ?>;
    color: <?php echo esc_attr($smof_data['button_primary_border_color']); ?>;
}
.csbody .btn-primary-alt:hover,
.csbody .btn-primary-alt:focus {
     background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
     color: <?php echo esc_attr($smof_data['button_primary_text_color_hover']); ?> !important;
}
/*** Size Button ***/
.csbody .btn-large,
.csbody .btn-lg{
    font-size: <?php echo esc_attr($smof_data['button_font_size']) ?>px; 
    padding-right: <?php echo esc_attr($smof_data['button_padding_right'] * '2.5'); ?>px;
    padding-left: <?php echo esc_attr($smof_data['button_padding_left'] * '2.5'); ?>px;
}
.csbody .btn-medium,
.csbody .btn-md {
    font-size: <?php echo esc_attr($smof_data['button_font_size']) ?>px; 
    padding-right: <?php echo esc_attr($smof_data['button_padding_right'] * '1.5'); ?>px;
    padding-left: <?php echo esc_attr($smof_data['button_padding_left'] * '1.5'); ?>px;
}
.csbody .btn-small,
.csbody .btn-sm {
    font-size: <?php echo esc_attr($smof_data['button_font_size']*'0.7'); ?>px; 
    padding-top: <?php echo esc_attr($smof_data['button_padding_top']*'0.7'); ?>px;
    padding-right: <?php echo esc_attr($smof_data['button_padding_right']*'0.7'); ?>px;
    padding-left: <?php echo esc_attr($smof_data['button_padding_left']*'0.7'); ?>px;
    padding-bottom: <?php echo esc_attr($smof_data['button_padding_bottom']*'0.7'); ?>px;
}
.csbody .btn-mini,
.csbody .btn-xs {
    font-size: <?php echo esc_attr($smof_data['button_font_size'] *'0.5')?>px; 
    padding-top: <?php echo esc_attr($smof_data['button_padding_top'] *'0.5'); ?>px;
    padding-right: <?php echo esc_attr($smof_data['button_padding_right']*'0.5'); ?>px;
    padding-left: <?php echo esc_attr($smof_data['button_padding_left']*'0.5'); ?>px;
    padding-bottom: <?php echo esc_attr($smof_data['button_padding_bottom']*'0.5'); ?>px;
}
/* =========================================================
    End Button Style
=========================================================*/
/* =========================================================
    Start Short Code
=========================================================*/
/*** High light ***/
.cs-highlight-style-1 {
     background: <?php echo esc_attr($smof_data['primary_color']); ?>;
}


/*** EDITOR QUOTE ***/
.cs-quote-style-1 {
    border-color: <?php echo esc_attr($smof_data['primary_color']); ?>;
}

.cs-quote-style-2 {
    border-color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}

/*---- Start Accordion ----*/
.wpb_accordion.style1 .wpb_accordion_section .wpb_accordion_header a {
    background: <?php echo esc_attr($smof_data['primary_color']); ?>;
}
.wpb_accordion.style1 .wpb_accordion_section .ui-accordion-header-active.wpb_accordion_header a {
	background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
/*---- End Accordion ----*/

/* Start Highlight */
.cs-highlight-style-1 {
    background-color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.cs-highlight-style-2 {
    background-color: <?php echo esc_attr($smof_data['primary_color']); ?>;
}
.cs-highlight-style-3 {
    background-color: <?php echo esc_attr($smof_data['link_color']); ?>;
}

/* =========================================================
    End Short Code
=========================================================*/
/*Start All Style Widget WP*/
/* Default widget */

/* =========================================================
    Start Bottom
=========================================================*/
#cs-bottom-wrap {
    color: <?php echo esc_attr($smof_data['bottom_1_text_color']); ?> ;
	padding:<?php echo esc_attr($smof_data['bottom_1_padding']); ?>;
	margin:<?php echo esc_attr($smof_data['bottom_1_margin']); ?>;
}
#cs-bottom-wrap h3,#cs-bottom-wrap h1,#cs-bottom-wrap h2,#cs-bottom-wrap h4
,#cs-bottom-wrap h5,#cs-bottom-wrap h6 {
    color: <?php echo esc_attr($smof_data['bottom_1_headings_color']); ?> ;
}
#cs-bottom-wrap a {
    color: <?php echo esc_attr($smof_data['bottom_1_link_color']); ?> ;
}
#cs-bottom-wrap a:hover {
    color: <?php echo esc_attr($smof_data['bottom_1_link_hover_color']); ?> ;
}
/* =========================================================
    Start Footer
=========================================================*/
#footer-top {
    color: <?php echo esc_attr($smof_data['footer_text_color']); ?>;
    <?php if($smof_data['footer_top_border_style']!='none'): ?>
        border-style:<?php echo esc_attr($smof_data['footer_top_border_style']);?>;
        border-color:<?php echo esc_attr($smof_data['footer_top_border_color']);?>;
        border-width:<?php echo esc_attr($smof_data['footer_top_border_width']);?>;
    <?php endif;?>
}
#footer-top form input:hover,
#footer-top form input:focus,
#footer-top form select:hover,
#footer-top form select:focus,
#footer-top form textarea:hover,
#footer-top form textarea:focus,
#footer-top form button:hover,
#footer-top form button:focus{
    color: <?php echo esc_attr($smof_data['footer_text_color']); ?>;
}
#footer-top h3.wg-title {
    color: <?php echo esc_attr($smof_data['footer_headings_color']); ?>;
    font-size: <?php echo esc_attr($smof_data['footer_top_heading_font_size']); ?>;
}

<?php if($smof_data['footer_top_heading_style']=='Style Heading Button'): ?>
    #footer-top h3.wg-title > span {
        border: 2px solid #6c6c6c;
        display: inline-block;
        padding: 10px;
    }
<?php endif; ?>

#footer-top h3.wg-title {
    <?php if($smof_data['footer_top_heading_uppercase']=='1') { ?>
        text-transform: uppercase;
    <?php } else { ?>
        text-transform: capitalize;
    <?php } ?>
}
#footer-top a {
    color: <?php echo esc_attr($smof_data['footer_link_color']); ?>;
}
#footer-top a:hover {
    color: <?php echo esc_attr($smof_data['footer_link_hover_color']); ?>;
}
#footer-top .cs-social a i {
    color:<?php echo esc_attr($smof_data['footer_social_color']); ?>;
}
#footer-top .cs-social a:hover i {
    color: <?php echo esc_attr($smof_data['footer_social_hover_color']); ?>;
}
#footer-top .cs-social.style-4 li a:hover i {
    border-color: <?php echo esc_attr($smof_data['footer_social_hover_color']); ?>;
}
#footer-bottom {
    background-color: <?php echo esc_attr($smof_data['footer_bottom_bg_color']); ?> ;
    color: <?php echo esc_attr($smof_data['footer_bottom_text_color']); ?>;
	margin: <?php echo esc_attr($smof_data['footer_bottom_margin']); ?>;
}
#footer-bottom .container{
	<?php if($smof_data['footer_bottom_border_style']!='none'): ?>
		border-style:<?php echo esc_attr($smof_data['footer_bottom_border_style']);?>;
		border-color:<?php echo esc_attr($smof_data['footer_bottom_border_color']);?>;
		border-width:<?php echo esc_attr($smof_data['footer_bottom_border_width']);?>;
	<?php endif;?>
	<?php if($smof_data['footer_bottom_padding'] || $smof_data['footer_bottom_margin']) : ?>
		padding: <?php echo esc_attr($smof_data['footer_bottom_padding']); ?>;	
	<?php endif; ?>
}
#footer-bottom h3.wg-title {
    color: <?php echo esc_attr($smof_data['footer_bottom_headings_color']); ?>;
}
#footer-bottom a {
    color: <?php echo esc_attr($smof_data['footer_bottom_link_color']); ?>;
}
#footer-bottom a:hover {
    color: <?php echo esc_attr($smof_data['footer_bottom_link_hover_color']); ?>;
}
<?php if($smof_data['footer_top_padding'] || $smof_data['footer_top_padding']) : ?>
#footer-top {
    padding: <?php echo esc_attr($smof_data['footer_top_padding']); ?>;
    margin: <?php echo esc_attr($smof_data['footer_top_margin']); ?>;
}
<?php endif; ?>

#footer-top .widget_cs_social_widget.style2 ul li a{
	background-color:  <?php echo esc_attr($smof_data['footer_link_color']); ?>;
	color:<?php echo esc_attr($smof_data['footer_social_color']); ?>;
}
#footer-top .widget_cs_social_widget.style2 ul li a:hover{
	background-color:  <?php echo esc_attr($smof_data['footer_link_hover_color']); ?>;
	color:<?php echo esc_attr($smof_data['footer_social_hover_color']); ?>;
}
<?php if($smof_data['text_align_footer_bottom_widgets_1'] != 'none') : ?>
.footer-bottom-1{
    text-align: <?php echo esc_attr($smof_data['text_align_footer_bottom_widgets_1']); ?>;
}
<?php endif; ?>
<?php if($smof_data['text_align_footer_bottom_widgets_2'] != 'none') : ?>
.footer-bottom-2{
    text-align: <?php echo esc_attr($smof_data['text_align_footer_bottom_widgets_2']); ?>;
}
<?php endif; ?>

/* ==========================================================================
   Hidden Menu Sidebar
========================================================================== */
.meny-sidebar {
    width: <?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>;
}
.right_sidebar_opened .meny-sidebar {
    right: -<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>;
}
.left_sidebar_opened .meny-sidebar {
    left: -<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>;
}
.meny-sidebar ul li a:hover, .meny-sidebar ul li a:focus {
    color: <?php echo esc_attr($smof_data['primary_color']); ?>;
}
.meny-top .meny-sidebar {
    height: <?php echo esc_attr($smof_data['hidden_sidebar_height']); ?> ;
}
.meny-top.meny-active #wrapper {
-webkit-transform: translateY(<?php echo esc_attr($smof_data['hidden_sidebar_height']); ?>) rotateX(-15deg);
   -moz-transform: translateY(<?php echo esc_attr($smof_data['hidden_sidebar_height']); ?>) rotateX(-15deg);
    -ms-transform: translateY(<?php echo esc_attr($smof_data['hidden_sidebar_height']); ?>) rotateX(-15deg);
     -o-transform: translateY(<?php echo esc_attr($smof_data['hidden_sidebar_height']); ?>) rotateX(-15deg);
        transform: translateY(<?php echo esc_attr($smof_data['hidden_sidebar_height']); ?>) rotateX(-15deg);
}
body.left_sidebar_opened {
-webkit-transform:translateX(<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>);
   -moz-transform:translateX(<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>);
    -ms-transform:translateX(<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>);
     -o-transform:translateX(<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>);
        transform:translateX(<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>);
}
body.right_sidebar_opened {
    -webkit-transform:translateX(-<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>);
       -moz-transform:translateX(-<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>);
        -ms-transform:translateX(-<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>);
         -o-transform:translateX(-<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>);
            transform:translateX(-<?php echo esc_attr($smof_data['hidden_sidebar_width']); ?>);
}

.cs-navigation .page-numbers:hover, .cs-navigation .page-numbers.current {
    background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
    border-color:<?php echo esc_attr($smof_data['secondary_color']); ?>;
}

/*============================================                Start Post Blog Style    ============================================*/
.cs-blog .cs-blog-share i{
    background-color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.cs-blog .cs-blog-share i:hover,
.cs-blog .cs-blog-share i:active,
.cs-blog .cs-blog-share i:focus{
    background-color: <?php echo esc_attr($smof_data['primary_color']); ?>;
}
.blog-multiple-columns-style2  .cs-blog .cs-blog-media .readmore{
    background: <?php echo HexToRGB($smof_data['primary_color'],0.8); ?>;
}
.blog-multiple-columns-style2  .cs-blog:hover .cs-blog-title a,
.blog-multiple-columns-style2  .cs-blog:active .cs-blog-title a,
.blog-multiple-columns-style2  .cs-blog:focus .cs-blog-title a{
    color: <?php echo esc_attr($smof_data['primary_color']); ?>;
}

/*============================================                Shortcode heading style    ============================================*/

.cs-blog .cs-blog-content .readmore a:hover {
    color: <?php echo esc_attr($smof_data['secondary_color']); ?>
}

#cs-breadcrumb-wrapper a {
    color: <?php echo esc_attr($smof_data['typography_0']['color']); ?>;
}

/* Custom Home */
.csbody .testimonial-layout2 .cshero-nav.icon ul li a:hover,
.home-4 .cshero-nav.icon ul li a:hover,
.home-5 .cshero-nav.icon ul li a:hover {
    color: <?php echo esc_attr($smof_data['secondary_color']); ?>
}

.csbody .wpcf7-form.contact-style-1 textarea,
.csbody .wpcf7-form.contact-style-1 input[type="text"],
.csbody .wpcf7-form.contact-style-1 input[type="email"] {
    boder-color: <?php echo esc_attr($smof_data['secondary_color']); ?>
}

/*======================================*/
/*        Shortcode                     */
/*======================================*/
<?php echo esc_attr($smof_data["custom_css"]); ?>

/* ==========================================================================
   [Start] All Style Woocommorce
========================================================================== */
/*
================> [Start] Product Details
*/
.woocommerce .cshero-woo-meta .cshero-woo-meta-bottom .cshero-add-to-cart a:hover {
    background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.woocommerce .cshero-product-wrap button.single_add_to_cart_button,
.woocommerce .cshero-product-wrap #review_form .form-submit .submit {
    background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
    border-color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.woocommerce .cshero-product-wrap button.single_add_to_cart_button:hover,
.woocommerce .cshero-product-wrap #review_form .form-submit .submit:hover {
    background: <?php echo esc_attr($smof_data['primary_color']); ?>;
    border-color: <?php echo esc_attr($smof_data['primary_color']); ?>;
}
.cshero-product-wrap .cs-panel-tab .panel-heading .panel-title a:hover,
.cshero-product-wrap .cs-panel-tab .panel-heading .panel-title a:focus {
    background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.woocommerce .cshero-product-wrap .amount {
    color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.woocommerce .cshero-product-images-wrap a.zoom:hover{
    background-color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.woocommerce .widget_shopping_cart .cart_list li a.remove,
.woocommerce .woocommerce-message:before,
.woocommerce .woocommerce-info:before,
.woocommerce .woocommerce-error:before {
    color: <?php echo esc_attr($smof_data['secondary_color']); ?> !important;
}
.woocommerce .woocommerce-error, 
.woocommerce .woocommerce-info, 
.woocommerce .woocommerce-message {
    border-top: 4px solid <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.woocommerce .woocommerce-error a.button, 
.woocommerce .woocommerce-info a.button, 
.woocommerce .woocommerce-message a.button {
    background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
    color: #fff;
    border: 1px solid <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.woocommerce .woocommerce-error a.button:hover, 
.woocommerce .woocommerce-info a.button:hover, 
.woocommerce .woocommerce-message a.button:hover {
    background: #111;
    color: #fff;
    border: 1px solid #111;
}
.woocommerce .cshero-product-wrap #review_form .form-submit .submit {
    background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.woocommerce ul.products li.product .onsale,
.woocommerce ul.products li.product .onsale,
.woocommerce span.onsale {
    background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.woocommerce #cs-breadcrumb-wrapper .cs-breadcrumbs a:hover,
.woocommerce-checkout.woocommerce-page .order-total td,
.woocommerce-checkout.woocommerce-page .order-total .amount {
    color: <?php echo esc_attr($smof_data['secondary_color']); ?> !important;
}
/*
================> [End] Product Details
*/

/*
================> [Start] Page Cart
*/

/*
================> [End] Page Cart
*/

/*** Sidebar ***/
.csbody.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range {
    background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.csbody.woocommerce-page .widget_price_filter .price_slider_amount .button {
    background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}
.woocommerce-page .widget_product_categories ul li.current-cat a {
    color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
}   
/* ==========================================================================
   [End] All Style Woocommorce
========================================================================== */