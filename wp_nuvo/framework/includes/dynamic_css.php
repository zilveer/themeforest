<?php global $smof_data,$post;
    $c_pageID = null;
    if($post){
        $c_pageID = $post->ID;
    }
?>
<style type="text/css">
    /* =========================================================
        Reset Body
    ========================================================= */
    body.csbody {
        color: <?php echo esc_attr($smof_data['body_text_color']); ?>;
        font-size: <?php echo esc_attr($smof_data['body_font_size']); ?>;
    }
    #header-top .shopping_cart_dropdown,
    #header-top .shopping_cart_dropdown a {
        color: <?php echo esc_attr($smof_data['body_text_color']); ?> !important;
    }
    <?php
    $body_padding = $smof_data['main_content_padding'];
    if(is_page() && get_post_meta($c_pageID, 'cs_body_padding', true)){
       $body_padding = get_post_meta($c_pageID, 'cs_body_padding', true);
    }
    if($body_padding): ?>
        .csbody:not(.home) #primary {
            padding: <?php echo esc_attr($body_padding); ?>;
        }
    <?php endif; ?>
    <?php if($smof_data['main_content_margin']): ?>
        .csbody:not(.home) #primary {
            margin: <?php echo esc_attr($smof_data['main_content_margin']); ?>;
        }
    <?php endif; ?>
    .csbody a {
        color: <?php echo esc_attr($smof_data['link_color']); ?>;
    }
    .csbody a:hover, .csbody a:focus {
        color: <?php echo esc_attr($smof_data['link_color_hover']); ?>;
    }
    .csbody a.read-more-link, .csbody th a {
        color: <?php echo esc_attr($smof_data['link_color_hover']); ?>;
    }
    .csbody a.read-more-link:hover, .csbody th a:hover {
        color: <?php echo esc_attr($smof_data['link_color']); ?> !important;
    }
    .color-primary,
    .fc-toolbar .fc-left button:hover,
    .fc-toolbar .fc-right button:hover {
        color: <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .cs-introlist .cs-introlist-image:hover .cs-introlist-title h3 {
        background: <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    /* =========================================================
        End Reset Body
    ========================================================= */
    /* =========================================================
        Start Typo
    ========================================================= */
    body h1 {
       font-size: <?php echo esc_attr($smof_data['heading_font_size_h1']); ?>;
       color: <?php echo esc_attr($smof_data['h1_color']); ?>;
    }
    body h2 {
       font-size: <?php echo esc_attr($smof_data['heading_font_size_h2']); ?>;
       color: <?php echo esc_attr($smof_data['h2_color']); ?>;
    }
    body h3  {
        font-size: <?php echo esc_attr($smof_data['heading_font_size_h3']); ?>;
        color: <?php echo esc_attr($smof_data['h3_color']); ?>;
    }
    body h4 {
       font-size: <?php echo esc_attr($smof_data['heading_font_size_h4']); ?>;
       color: <?php echo esc_attr($smof_data['h4_color']); ?>;
    }
    body h5 {
       font-size: <?php echo esc_attr($smof_data['heading_font_size_h5']); ?>;
       color: <?php echo esc_attr($smof_data['h5_color']); ?>;
    }
    body h6 {
       font-size: <?php echo esc_attr($smof_data['heading_font_size_h6']); ?>;
       color: <?php echo esc_attr($smof_data['h6_color']); ?>;
    }
    .page-title{
        color: <?php echo esc_attr($smof_data['page_title_color']); ?>;
        font-size: <?php echo esc_attr($smof_data['title_bar_size']); ?>;
    }
    .page-title-style .page-title {
        color: <?php echo get_post_meta($c_pageID, 'cs_title_bar_color', true); ?>;
    }
    #cs-breadcrumb-wrapper .cs-breadcrumbs {
        line-height: <?php echo esc_attr($smof_data['title_bar_size']); ?>;
    }
    .cs-breadcrumbs, .cs-breadcrumbs a {
        color: <?php echo esc_attr($smof_data['breadcrumbs_text_color']); ?> !important;
    }
    .page-title-style .cs-breadcrumbs, .page-title-style .cs-breadcrumbs a {
        color: <?php echo get_post_meta($c_pageID, 'cs_breadcrumb_color', true); ?> !important;
    }
    .cs-breadcrumbs a:hover {
        color: <?php echo esc_attr($smof_data['primary_color']); ?>; !important;
    }
    .title-unblemished h3:before {
        background: <?php echo esc_attr($smof_data['h3_color']); ?>;
    }
    /* =========================================================
        End Typo
    ========================================================= */
    /* =========================================================
        Start Header
    ========================================================= */
    /* Header Color Option */
    #header-top {
        background: <?php echo esc_attr($smof_data['header_top_bg_color']); ?> !important;
        color: <?php echo esc_attr($smof_data['header_top_font_color']); ?> !important;
    }
    #header-top a {
        color: <?php echo esc_attr($smof_data['header_top_link_color']); ?> !important;
    }
    #header-top a:hover {
        color: <?php echo esc_attr($smof_data['header_top_link_hover_color']); ?> !important;
    }
    #header-sticky, #sticky-nav-wrap .main-menu > li.menu-item-has-children > a:after {
        background-color: <?php echo HexToRGB($smof_data['header_sticky_bg_color'], $smof_data['header_sticky_opacity']/100); ?>;
    }
    .sticky-header.fixed .cshero-logo img,
    .csbody #cs-header-custom-bottom.fixed-top .cs-logo img {
        height: <?php echo esc_attr($smof_data['header_sticky_logo_max_height']); ?> !important;
    }
    /*** Logo ***/
    .header-wrapper .logo a {
        padding: <?php echo esc_attr($smof_data['padding_logo']); ?>;
    }
    #cshero-header .logo a img {
        max-height: <?php echo esc_attr($smof_data['logo_width']); ?>;
    }
    .menu-pages .menu > ul > li > a {
        line-height: <?php echo esc_attr($smof_data['nav_height']); ?>;
    }
    #cs-header-custom-bottom {
        height: <?php echo esc_attr($smof_data['nav_height']); ?>;
    }
    /*** End logo ***/
    /*** Start Main Menu ***/
    <?php if(get_post_meta($c_pageID, 'cs_header_fixed_top', true) == "yes"):
        $menu_opacity = 0; $menu_bg_color = $smof_data['header_top_bg_color'];
        if(get_post_meta($c_pageID, 'cs_header_bg_opacity', true)){
            $menu_opacity = get_post_meta($c_pageID, 'cs_header_bg_opacity', true);
        }
        if(get_post_meta($c_pageID, 'cs_header_bg_color', true)){
            $menu_bg_color = get_post_meta($c_pageID, 'cs_header_bg_color', true);
        }
    ?>
    #cshero-header.transparentFixed{
        position: absolute;
        top: 0;
        width: 100%;
        background: <?php echo HexToRGB($menu_bg_color,$menu_opacity); ?> !important;
        border: none;
    }
    <?php endif; ?>
    <?php if($smof_data['nav_height']):
        $nav_height = (int)str_replace('px', '', $smof_data['nav_height']);
        $menu_fontsize_first_level = (int)str_replace('px', '', $smof_data['menu_fontsize_first_level']);
    ?>
    .main-menu > li:not(.menu-item-has-children):hover > a:before,
    .menu-pages .menu > ul > li:hover > a:before,
    .main-menu > li.current-menu-item > a:before,
    .main-menu > li.current-menu-parent > a:before,
    .main-menu > li.current_page_item > a:before,
    .main-menu > li.current-menu-ancestor > a:before
     {
        border-color: transparent transparent <?php echo esc_attr($smof_data['primary_color']); ?>;
        bottom: <?php echo (($nav_height / 2 ) - ($menu_fontsize_first_level + 6)); ?>px;
    }
    .main-menu > li.menu-item-has-children:hover > a:before {
        border-color: <?php echo esc_attr($smof_data['primary_color']); ?> transparent transparent;
        bottom: <?php echo (($nav_height / 2 ) - ($menu_fontsize_first_level + 6)); ?>px;
    }
    .main-menu > li:not(.menu-item-has-children):hover > a:after,
    .menu-pages .menu > ul > li >:hover a:after,
    .main-menu > li.current-menu-item > a:after,
    .main-menu > li.current-menu-parent > a:after,
    .main-menu > li.current_page_item > a:after,
    .main-menu > li.current-menu-ancestor > a:after {
        background: <?php echo esc_attr($smof_data['primary_color']); ?>;
        bottom: <?php echo (($nav_height / 2 ) - ($menu_fontsize_first_level + 8)); ?>px;
    }
    .main-menu > li.current-menu-item.menu-item-has-children > a:after,
    .main-menu > li.current-menu-parent.menu-item-has-children > a:after {
        background: <?php echo esc_attr($smof_data['primary_color']); ?> !important;
        bottom: <?php echo (($nav_height / 2 ) - ($menu_fontsize_first_level + 8)); ?>px;
    }
    <?php endif ?>
    <?php if($smof_data['header_sticky_height']):
        $header_sticky_height = (int)str_replace('px', '', $smof_data['header_sticky_height']);
        $header_sticky_nav_font_size = (int)str_replace('px', '', $smof_data['header_sticky_nav_font_size']);
    ?>
    #sticky-nav-wrap .main-menu > li:not(.menu-item-has-children):hover > a:before,
    #sticky-nav-wrap .main-menu > li.current-menu-item > a:before,
    #sticky-nav-wrap .main-menu > li.current-menu-parent > a:before,
    #sticky-nav-wrap .main-menu > li.current-menu-ancestor > a:before,
    #sticky-nav-wrap .main-menu > li.current_page_item > a:before,
    #cs-header-custom-bottom.fixed-top .main-menu > li:not(.menu-item-has-children):hover > a:before,
    #cs-header-custom-bottom.fixed-top .main-menu > li.current-menu-item > a:before,
    #cs-header-custom-bottom.fixed-top .main-menu > li.current-menu-parent > a:before,
    #cs-header-custom-bottom.fixed-top .main-menu > li.current_page_item > a:before,
    #cs-header-custom-bottom.fixed-top .main-menu > li.current-menu-ancestor > a:before {
        border-color: transparent transparent <?php echo esc_attr($smof_data['primary_color']); ?>;
        bottom: <?php echo (($header_sticky_height / 2 ) - ($header_sticky_nav_font_size + 6)); ?>px;
    }
    #sticky-nav-wrap .main-menu > li.menu-item-has-children:hover > a:before,
    #cs-header-custom-bottom.fixed-top .main-menu > li.menu-item-has-children:hover > a:before {
        border-color: <?php echo esc_attr($smof_data['primary_color']); ?> transparent transparent;
        bottom: <?php echo (($header_sticky_height / 2 ) - ($header_sticky_nav_font_size + 6)); ?>px;
    }
    #sticky-nav-wrap .main-menu > li:not(.menu-item-has-children):hover > a:after,
    #sticky-nav-wrap .main-menu > li.current-menu-item > a:after,
    #sticky-nav-wrap .main-menu > li.current-menu-parent > a:after,
    #sticky-nav-wrap .main-menu > li.current-menu-ancestor > a:after,
    #sticky-nav-wrap .main-menu > li.current_page_item > a:after,
    #cs-header-custom-bottom.fixed-top .main-menu > li:not(.menu-item-has-children):hover > a:after,
    #cs-header-custom-bottom.fixed-top .main-menu > li.current-menu-item > a:after,
    #cs-header-custom-bottom.fixed-top .main-menu > li.current-menu-parent > a:after,
    #cs-header-custom-bottom.fixed-top .main-menu > li.current-menu-ancestor > a:after,
    #cs-header-custom-bottom.fixed-top .main-menu > li.current_page_item > a:after {
        background: <?php echo esc_attr($smof_data['primary_color']); ?>;
        bottom: <?php echo (($header_sticky_height / 2 ) - ($header_sticky_nav_font_size + 8)); ?>px;
        top: inherit;
    }
    <?php endif ?>
    <?php if($smof_data['menu_uppercase_first_level']): ?>
    .cshero-menu-dropdown > ul > li > a {
        text-transform: uppercase;
    }
    <?php endif; ?>
    .cshero-menu-dropdown > ul > li > a,
    .menu-pages .menu > ul > li > a {
        padding: <?php echo esc_attr($smof_data['nav_padding']); ?> !important;
        font-size: <?php echo esc_attr($smof_data['menu_fontsize_first_level']); ?>;
    }
    .cshero-menu-dropdown > ul > li.menu-item-has-children:hover,
    .menu-pages .menu > ul > li.menu-item-has-children:hover {
        background: <?php echo esc_attr($smof_data['menu_bg_hover_color_first']); ?>;
    }
    .cshero-menu-dropdown > ul > li:after,
    .menu-pages .menu > ul > li > a:after {
        height: <?php echo esc_attr($smof_data['menu_fontsize_first_level']); ?>;
    }

    .btn-navbar.navbar-toggle i:before {
        font-size: <?php echo esc_attr($smof_data['menu_fontsize_first_level']); ?>;
    }
    .main-menu-left ul ul li a{
        color: <?php echo esc_attr($smof_data['menu_sub_color']); ?> !important;
    }
    .main-menu-left ul ul li a:hover{
        color: <?php echo esc_attr($smof_data['menu_sub_hover_color']); ?> !important;
    }
    <?php if(is_rtl()){ ?>
        .cshero-menu-dropdown > ul ul{
            right: 0;
            left: auto;
        }
    <?php } ?>
    .cshero-menu-dropdown > ul > li.mega-menu-item > ul > li > ul > li ul {
      border-left: 3px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    <?php if($smof_data['menu_bg_color']): ?>
    .main-menu-content, .main-menu > li.menu-item-has-children > a:after,
    .main-menu > li.current_page_item.menu-item-has-children:before,
    .main-menu > li.current-menu-item.menu-item-has-children:before {
        background: <?php echo esc_attr($smof_data['menu_bg_color']); ?> !important;
    }

    <?php endif; ?>
    <?php if($smof_data['menu_first_color']): ?>
    ul.main-menu > li > a, #sticky-nav-wrap ul > li > a,
    .menu-pages .menu > ul > li > a,
    .btn-navbar.navbar-toggle i:before {
        color: <?php echo esc_attr($smof_data['menu_first_color']); ?>;
    }
    <?php endif; ?>

    <?php
    $cs_header_fixed_menu_color = '#ffffff';
    $cs_header_fixed_menu_color_hover = '#ffffff';
    if(get_post_meta($c_pageID, 'cs_header_setting', true) == 'custom' && get_post_meta($c_pageID, 'cs_header_fixed_top', true) == '1'){
        $cs_header_fixed_menu_color = get_post_meta($c_pageID, 'cs_header_fixed_menu_color', true);
        $cs_header_fixed_menu_color_hover = get_post_meta($c_pageID, 'cs_header_fixed_menu_color_hover', true);
    } else {
        if($smof_data['header_fixed_top'] == '1'){
            $cs_header_fixed_menu_color = $smof_data['header_fixed_menu_color'];
            $cs_header_fixed_menu_color_hover = $smof_data['header_fixed_menu_color_hover'];
        }
    }
    ?>
    <?php if($cs_header_fixed_menu_color): ?>
    #cshero-header.transparentFixed .main-menu > li > a {
        color:<?php echo esc_attr($cs_header_fixed_menu_color); ?> !important;
    }
    <?php endif; ?>

    <?php if($cs_header_fixed_menu_color_hover): ?>
    #cshero-header.transparentFixed .main-menu > li:hover > a {
        color:<?php echo esc_attr($cs_header_fixed_menu_color_hover); ?> !important;
    }
    <?php endif; ?>
    <?php if($smof_data['menu_hover_first_color']): ?>
    .main-menu > li:hover > a,
    .menu-pages .menu > ul > li:hover > a,
    .main-menu > li.current-menu-item > a,
    .main-menu > li.current-menu-ancestor > a,
    .main-menu > li.current-menu-parent > a,
    .main-menu > li.current_page_item > a,
    #sticky-nav-wrap ul > li.current_page_item > a,
    .btn-navbar.navbar-toggle:hover i:before {
        color: <?php echo esc_attr($smof_data['menu_hover_first_color']); ?>;
    }
    .main-menu > li.menu-item-has-children > a:hover,
    .menu-pages .menu > ul > li.menu-item-has-children > a:hover,
    .main-menu > li.current-menu-item.menu-item-has-children > a,
    .main-menu > li.current-menu-parent.menu-item-has-children > a,
    .main-menu > li.current_page_item.menu-item-has-children > a {
        border-bottom: none;
    }
    .main-menu > li > a:hover:before,
    .menu-pages .menu > ul > li > a:hover:before,
    .main-menu > li.current-menu-item > a:before,
    .main-menu > li.current-menu-parent > a:before,
    .main-menu > li.current_page_item > a:before {
      border-color: transparent transparent <?php echo esc_attr($smof_data['menu_hover_first_color']); ?>;
    }
    <?php endif; ?>
    <?php if($smof_data['menu_sub_bg_color']): ?>
    .cshero-menu-dropdown > ul > li ul li,
    .cshero-menu-dropdown > ul > li.mega-menu-item > ul {
        background-color: <?php echo esc_attr($smof_data['menu_sub_bg_color']); ?>;
    }
    .cshero-menu-dropdown > ul > li > ul.mega-bg-image,
    .cshero-menu-dropdown > ul > li > ul.mega-bg-image ul {
        background-color: transparent;
    }
    <?php endif; ?>
    <?php if($smof_data['menu_bg_hover_color']): ?>
    .cshero-menu-dropdown > ul > li > ul li:hover,
    .cshero-menu-dropdown > ul > li.mega-menu-item > ul > li > ul > li ul {
        background-color: <?php echo esc_attr($smof_data['menu_bg_hover_color']); ?>;
    }
    .cshero-menu-dropdown > ul > li > ul.mega-bg-image li:hover {
        /*background-color: transparent;*/
    }
    <?php endif; ?>
    <?php if($smof_data['menu_sub_color']): ?>
    .cshero-menu-dropdown ul ul li a {
        color: <?php echo esc_attr($smof_data['menu_sub_color']); ?>;
        font-size: <?php echo esc_attr($smof_data['menu_fontsize_sub_level']); ?>;
    }
    <?php endif; ?>
    <?php if($smof_data['menu_sub_sep_color']): ?>
    .cshero-menu-dropdown li.nomega-menu-item ul li {
        border-bottom: none;
    }
    .cshero-menu-dropdown li.mega-menu-item ul li {
        /*border-bottom: 1px dashed <?php echo esc_attr($smof_data['menu_sub_sep_color']); ?>;*/
        border-bottom: none;
    }
    <?php endif; ?>
    .cshero-menu-dropdown li.nomega-menu-item ul li a {
        border-bottom: 1px solid <?php echo esc_attr($smof_data['menu_sub_sep_color']); ?>;
    }
    .cshero-menu-dropdown > ul > li.mega-menu-item > ul.colimdi > li > a {
        color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
    }
    .cshero-menu-dropdown > ul > li ul li a:before {
      border-color: transparent transparent transparent <?php echo esc_attr($smof_data['menu_hover_first_color']); ?>;
    }

    /*** End Main Menu ***/
    /*** Start Main Menu Sticky ***/
    .sticky-header-left .main-menu-left ul ul li a{
        color: <?php echo esc_attr($smof_data['sticky_menu_sub_color']); ?> !important;
    }
    .sticky-header.fixed .cshero-menu-dropdown > ul > li > a,
    .sticky-header.fixed .menu-pages .menu > ul > li > a,
    .csbody #cs-header-custom-bottom.fixed-top .main-menu > li > a,
    #cs-header-custom-bottom.fixed-top {
        height: <?php echo esc_attr($smof_data['header_sticky_height']); ?>;
        line-height: <?php echo esc_attr($smof_data['header_sticky_height']); ?>;
    }
    .csbody #cs-header-custom-bottom.fixed-top .cs-logo a {
        line-height: <?php echo esc_attr($smof_data['header_sticky_height']); ?> !important;
        padding: 0 !important;
    }
    #sticky-nav-wrap ul > li.current-menu-item > a,
    #sticky-nav-wrap ul > li.current_page_item > a,
    #sticky-nav-wrap ul > li:hover > a {
        color: <?php echo esc_attr($smof_data['sticky_menu_hover_first_color']); ?> !important;
    }
    #sticky-nav-wrap ul > li.menu-item-has-children:hover {
        background: <?php echo esc_attr($smof_data['sticky_menu_bg_hover_color_first']); ?>;
    }
    #sticky-nav-wrap ul > li > a {
        color: <?php echo esc_attr($smof_data['sticky_menu_first_color']); ?> ;
    }
    .sticky-menu .cshero-menu-dropdown ul ul li:hover,
    .sticky-menu .cshero-menu-dropdown > ul > li.mega-menu-item > ul > li > ul > li ul {
        background-color: <?php echo esc_attr($smof_data['sticky_menu_bg_hover_color']); ?> !important;
    }
    .sticky-menu .cshero-menu-dropdown li.nomega-menu-item ul li {
        border-bottom: none;
    }
    .sticky-menu .cshero-menu-dropdown ul ul li a {
        color: <?php echo esc_attr($smof_data['sticky_menu_sub_color']); ?>;
    }
    /*** End Main Menu Sticky ***/
    /***** Mega Menu ****/
    .cshero-menu-dropdown > ul > li ul {
        border-bottom: 5px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    #cs-header-custom-bottom.menu-up .cshero-menu-dropdown > ul > li ul {
        border-bottom: none;
        border-top: 5px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .cs_mega_menu li.mega-menu-item > ul {
        border-bottom: 9px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    #wp-consilium.meny-top .control .cs_close {
        border-bottom: 1px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    /* =========================================================
        End Header
    =========================================================*/

    /* =========================================================
        Start Primary
    =========================================================*/
    <?php if($smof_data['form_bg_color']): ?>
    .content-area form {
        background-color: <?php echo esc_attr($smof_data['form_bg_color']); ?>;
    }
    <?php endif; ?>
    <?php if($smof_data['form_text_color']): ?>
    .content-area form {
        color: <?php echo esc_attr($smof_data['form_text_color']); ?>;
    }
    <?php endif; ?>
    <?php if($smof_data['form_border_color']): ?>
    .content-area form {
        border-color: <?php echo esc_attr($smof_data['form_border_color']); ?>;
    }
    <?php endif; ?>
    /* Content Area */
    .content-area {
        background: <?php echo esc_attr($smof_data['content_bg_color']); ?> !important;
        padding: <?php echo esc_attr($smof_data['main_content_padding']); ?> !important;
        margin: <?php echo esc_attr($smof_data['main_content_margin']); ?> !important;
    }
    /* =========================================================
        End Primary
    =========================================================*/
    /* =========================================================
        Blog Post
    =========================================================*/
    .cs-blog-info {
        background: <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .cs-blog-title h3, .cs-blog-info li a:hover {
        color: <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .tag-sticky .cs-blog .cs-blog-header .cs-blog-thumbnail:before,
    .sticky .cs-blog .cs-blog-header .cs-blog-thumbnail:before {
        border-color: <?php echo esc_attr($smof_data['primary_color']); ?> transparent transparent <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .rtl .tag-sticky .cs-blog .cs-blog-header .cs-blog-thumbnail:before,
    .rtl .sticky .cs-blog .cs-blog-header .cs-blog-thumbnail:before {
        border-color: <?php echo esc_attr($smof_data['primary_color']); ?> <?php echo esc_attr($smof_data['primary_color']); ?> transparent transparent;
    }
    .rtl .cs-blog .cs-blog-info li + li {
        border-left: none;
        border-right: 1px solid <?php echo esc_attr($smof_data['secondary_color']); ?>;
    }
    /* =========================================================
        End Blog Post
    =========================================================*/
    /* =========================================================
        Start Title and Module
    =========================================================*/
    .title-preset2 h3 {
        color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
    }
    .title-preset1 h3, .title-style-colorprimary-retro h3,
    .title-style-colorprimary-retro2 h3,  {
        color: <?php echo esc_attr($smof_data['primary_color']); ?> !important;
    }
    /* =========================================================
        End Title Module
    =========================================================*/
    /* ==========================================================================
    Start Sidebar Styles
    ========================================================================== */
    h3.comments-title span, .cs-menuFood .cs-menuFood-header h3.cs-post-title a,
    #primary-sidebar .wg-title .title-line, h3.comment-reply-title span,
    .cs-menuFood.cs-menuFood-images .cs-menuFood-header h3.cs-post-title {
        border-bottom: 2px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    /* ==========================================================================
    End Sidebar Styles
    ========================================================================== */

    /* =========================================================
        Start Page Inner Primary
    =========================================================*/
    article.team, .single-portfolio .cs-portfolio-meta, .cs-pricing .cs-pricing-item h3.cs-pricing-title{
        background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
    }

    /* =========================================================
        End Page Inner Primary
    =========================================================*/
    /**** RGBA ****/
    .cs-portfolio .cs-portfolio-item:hover .cs-portfolio-details,
    .cs-portfolio.cs-portfolio-style3 .cs-mainpage:hover:before {
        background: <?php echo HexToRGB($smof_data['primary_color'],0.8); ?>;
    }
    .cs-recent-post.style-3 .cs-recent-post-title a {
       background: <?php echo HexToRGB($smof_data['secondary_color'],0.6); ?>;
    }
    .wpb_row.vc_row-fluid.bg-overlay-preset:before {
        background: <?php echo HexToRGB($smof_data['link_color_hover'],0.9); ?>;
    }
    /**** End RGBA ****/
    /* =========================================================
        Start Button Style
    =========================================================*/
    .csbody  button, .csbody .button, .csbody .btn,
    .csbody input[type="submit"],
    .csbody #submit,
    .csbody .added_to_cart,
    a.comment-reply-link {
        <?php if($smof_data['button_gradient_top_color']): ?>
            background-color: <?php echo esc_attr($smof_data['button_gradient_top_color']); ?>;
        <?php endif; ?>
        <?php if($smof_data['button_gradient_text_color']): ?>
            color: <?php echo esc_attr($smof_data['button_gradient_text_color']); ?>;
        <?php endif; ?>
        <?php if($smof_data['button_border_color']): ?>
            border-color: <?php echo esc_attr($smof_data['button_border_color']); ?>;
        <?php endif; ?>
        <?php if($smof_data['button_border_width']): ?>
            border-width: <?php echo esc_attr($smof_data['button_border_width']); ?>;
        <?php endif; ?>
        <?php if($smof_data['button_border_style']): ?>
            border-style: <?php echo esc_attr($smof_data['button_border_style']); ?>;
        <?php endif; ?>
        <?php if($smof_data['button_border_radius']): ?>
            border-radius: <?php echo esc_attr($smof_data['button_border_radius']); ?>;
            -webkit-border-radius: <?php echo esc_attr($smof_data['button_border_radius']); ?>;
            -moz-border-radius: <?php echo esc_attr($smof_data['button_border_radius']); ?>;
            -ms-border-radius: <?php echo esc_attr($smof_data['button_border_radius']); ?>;
            -o-border-radius: <?php echo esc_attr($smof_data['button_border_radius']); ?>;
        <?php endif; ?>
        <?php if($smof_data['button_border_top'] == '0'): ?>
            border-top: none!important;
        <?php endif; ?>
        <?php if($smof_data['button_border_left'] == '0'): ?>
            border-left: none!important;
        <?php endif; ?>
        <?php if($smof_data['button_border_bottom'] == '0'): ?>
            border-bottom: none!important;
        <?php endif; ?>
        <?php if($smof_data['button_border_right'] == '0'): ?>
            border-right: none!important;
        <?php endif; ?>
        <?php if($smof_data['button_margin']): ?>
            margin: <?php echo esc_attr($smof_data['button_margin']); ?>;
        <?php endif; ?>
        <?php if($smof_data['button_padding']): ?>
            padding: <?php echo esc_attr($smof_data['button_padding']); ?>;
        <?php endif; ?>
    }
    .csbody .btn:hover,
    .csbody .btn:focus,
    .csbody .button:hover,
    .csbody button:hover,
    .csbody .button:focus,
    .csbody button:focus,
    .csbody input[type="submit"]:hover,
    .csbody input[type="submit"]:focus,
    .csbody #submit:hover,
    .csbody #submit:focus,
    .csbody .added_to_cart:hover,
    .csbody .added_to_cart:focus,
    a.comment-reply-link:hover,
    a.comment-reply-link:focus {
        <?php if($smof_data['button_gradient_top_color_hover']): ?>
            background-color: <?php echo esc_attr($smof_data['button_gradient_top_color_hover']); ?>;
        <?php endif; ?>
        <?php if($smof_data['button_gradient_text_color_hover']): ?>
            color: <?php echo esc_attr($smof_data['button_gradient_text_color_hover']); ?>;
        <?php endif; ?>
        <?php if($smof_data['button_border_color_hover']): ?>
            border-color: <?php echo esc_attr($smof_data['button_border_color_hover']); ?>;
        <?php endif; ?>
    }
    .csbody .btn.btn-readmore {
        <?php if($smof_data['button_border_color']): ?>
            border-left: 3px solid <?php echo esc_attr($smof_data['button_border_color']); ?> !important;
        <?php endif; ?>
        border-bottom: none;
    }
    .csbody .btn.btn-readmore:hover {
        background: <?php echo esc_attr($smof_data['button_gradient_top_color']); ?>;
    }
    .csbody .btn.btn-default {
        border-color: <?php echo esc_attr($smof_data['button_border_color']); ?>;
    }
    .csbody .btn.btn-default-alt {
        background: transparent;
        border: 2px solid <?php echo esc_attr($smof_data['button_border_color']); ?> !important;
        color: <?php echo esc_attr($smof_data['button_border_color']); ?>;
    }
    .csbody .btn.btn-default-alt:hover,
    .csbody .btn.btn-default-alt:focus {
        color: <?php echo esc_attr($smof_data['button_border_color']); ?>;
        background: <?php echo HexToRGB($smof_data['button_gradient_top_color_hover'],0.3); ?>;
    }
    .csbody .btn.btn-primary {
        border-color: <?php echo esc_attr($smof_data['button_primary_border_color']); ?>;
        background: <?php echo esc_attr($smof_data['button_primary_background_color']); ?>;
        color: <?php echo esc_attr($smof_data['button_primary_text_color']); ?>;
    }
    .csbody .btn.btn-primary:hover,
    .csbody .btn.btn-primary:focus {
        border-color: <?php echo esc_attr($smof_data['button_primary_border_color_hover']); ?>;
        background: <?php echo esc_attr($smof_data['button_primary_background_color_hover']); ?>;
        color: <?php echo esc_attr($smof_data['button_primary_text_color_hover']); ?>;
    }
    .csbody .btn-primary-alt, .csbody input[type="submit"].btn-primary-alt {
        background: transparent;
        border: 2px solid <?php echo esc_attr($smof_data['button_primary_border_color']); ?> !important;
        color: <?php echo esc_attr($smof_data['button_primary_border_color']); ?>;
    }
    .csbody .btn-primary-alt:hover,
    .csbody .btn-primary-alt:focus,
    .csbody .btn-primary-alt-style2:hover,
    .csbody .btn-primary-alt-style2:focus {
        color: <?php echo esc_attr($smof_data['button_primary_border_color']); ?>!important;
        background: <?php echo HexToRGB($smof_data['button_primary_background_color_hover'],0.3); ?>!important;
    }
    .csbody .btn.btn-trans:hover,
    .csbody .btn.btn-trans:focus {
        background: <?php echo HexToRGB($smof_data['button_gradient_top_color'],0.3); ?>;
    }
    .csbody .btn.btn-trans:hover,
    .csbody .btn.btn-trans:focus,
    .csbody .cs-latest-twitter .bx-controls-direction a:hover {
        background: <?php echo esc_attr($smof_data['button_gradient_top_color']); ?>;
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
    .cs-highlight-style-2 {
        background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
    }
    /**** Drop Caps ****/
    .cs-carousel-post-read-more a,
    .readmore.main-color {
        color: <?php echo esc_attr($smof_data['secondary_color']); ?> !important;
    }
    .readmore.main-color:hover {
        color: <?php echo esc_attr($smof_data['primary_color']); ?> !important;
    }
    /* ==========================================================================
      Start Comment
    ========================================================================== */
    #comments .comment-list .comment-meta a,
    .cs-navigation .page-numbers {
        color: <?php echo esc_attr($smof_data['body_text_color']); ?>;
    }
    .widget_categories ul li.cat-item a,
    .widget_meta ul li a,
    .widget_archive ul li a,
    .widget_meta ul li a,
    .widget_calendar #wp-calendar tbody td a,
    .widget_pages ul li a {
        color: <?php echo esc_attr($smof_data['body_text_color']); ?>;
    }
    .widget_calendar #wp-calendar tbody td:hover,
    .widget_meta .heading + ul > li:hover,
    .widget_meta .wg-title  + ul > li:hover,
    .widget_categories .heading + ul > li.cat-item:hover,
    .widget_categories .wg-title + ul > li.cat-item:hover,
    .widget_meta .heading + ul ul li:hover,
    .widget_meta .wg-title + ul ul li:hover,
    .widget_categories .heading + ul ul li:hover,
    .widget_categories .wg-title + ul ul li:hover {
        background: <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .widget_calendar #wp-calendar tbody td.pad {
        background: transparent;
    }
    /** update category woo **/
    /* ==========================================================================
      End Comment
    ========================================================================== */
    /* ==========================================================================
      Block Quotes
    ========================================================================== */
    blockquote {
        border-left: 3px solid <?php echo esc_attr($smof_data['primary_color']); ?> !important;
    }
    .rtl blockquote {
        border-left: none;
        border-right: 3px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .cs-quote-style-1:before, .cs-quote-style-3:before,
    .cs-quote-style-1:after, .cs-quote-style-3:after {
        color: <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .cs-quote-style-3, .cs-quote-style-2 {
        border-left: 10px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .rtl .cs-quote-style-3, .rtl .cs-quote-style-2 {
        border-left: none;
        border-right: 10px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    /* =========================================================
        End Short Code
    =========================================================*/

    /*Start All Style Widget WP*/
    .tagcloud a:hover {
        background: <?php echo esc_attr($smof_data['primary_color']); ?>;;
    }
    .primary-sidebar [class*="widget_"],
    .primary-sidebar [class^="widget_"],
    .primary-sidebar .widget {
        border-bottom: 4px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
     }
    /*End All Style Widget WP*/

    .cs-blog-header h3.cs-blog-title a:hover, .cs-blog .cs-blog-info li,
    .cs-team-content .cs-team-social a:hover i, .connect-width li a:hover i,
    a.twitter_time, .cs-latest-twitter .cs-desc a,
    .title-preset2 h3.ww-title, .title-preset2 h3.cs-title {
        color: <?php echo esc_attr($smof_data['link_color_hover']); ?> !important;
    }
    .cs-carousel-style-3 .cs-carousel-post-icon:hover:before {
        background: <?php echo esc_attr($smof_data['link_color_hover']); ?> !important;
    }
    /* =========================================================
        Start Reset Input
    =========================================================*/
    input[type='text']:active,
    input[type='text']:focus,
    input[type="password"]:active,
    input[type="password"]:focus,
    input[type="datetime"]:active,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:active,
    input[type="datetime-local"]:focus,
    input[type="date"]:active,
    input[type="date"]:focus,
    input[type="month"]:active,
    input[type="month"]:focus,
    input[type="time"]:active,
    input[type="time"]:focus,
    input[type="week"]:active,
    input[type="week"]:focus,
    input[type="number"]:active,
    input[type="number"]:focus,
    input[type="email"]:active,
    input[type="email"]:focus,
    input[type="url"]:active,
    input[type="url"]:focus,
    input[type="search"]:active,
    input[type="search"]:focus,
    input[type="tel"]:active,
    input[type="tel"]:focus,
    input[type="color"]:active,
    input[type="color"]:focus,
    textarea:focus {
        border: 1px solid <?php echo esc_attr($smof_data['link_color']); ?> !important;
    }
    .navbar-toggle, .cs-team .cs-team-featured-img:hover .circle-border {
        border: 1px solid <?php echo esc_attr($smof_data['link_color_hover']); ?> !important;
    }
    .wpb_tabs li.ui-tabs-active a.ui-tabs-anchor {
        border: 1px solid <?php echo esc_attr($smof_data['link_color']); ?> !important;
    }
    .tagcloud a:hover,
    .post .cs-post-meta, .post .cs-post-header .date-type .date-box,
    .cs-carousel-container .cs-carousel-header .cs-carousel-post-date,
    .cs-carousel-style-2 .cs-carousel-post-icon,
    .cs-carousel-style-2.cs-carousel-style-3 .cs-carousel-post-icon:before, .bg-preset,
    .cs-carousel .carousel-control, .box-2, #cs_portfolio_filters ul li:hover a,
    #cs_portfolio_filters ul li.active a, .gallery-filters a:hover, .gallery-filters a.active,
    ul.cs_list_circle li:before, ul.cs_list_circleNumber li:before,
    .cs-pricing .cs-pricing-item .cs-pricing-button:hover a,
    .cs-blog .mejs-controls .mejs-time-rail .mejs-time-current, ins,
    .cs-blog .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
    .cs-navigation .page-numbers:hover, .cs-navigation .page-numbers.current,
   .cs-portfolio.cs-portfolio-style2 .cs-portfolio-header:hover .cs-portfolio-meta,
    #wrapper .woocommerce .woocommerce-info:before, #wrapper .woocommerce-page .woocommerce-info:before,
    .cs-recent-post.style-3 .cs-title, .title-line-bottom .wpb_wrapper > h3:before,
    .cs-carousel-events-date, .cs-carousel-style-3 .cs-carousel-post-icon:before,
    .cs-latestEvents .cs-eventHeader:before, .cs-transformEvents .cs-eventHeader:before,
    .cs-latestEvents .cs-eventHeader:after, .cs-transformEvents .cs-eventHeader:after,
    .cs-latestEvents .cs-eventHeader, .cs-transformEvents .cs-eventHeader,
    input[type="radio"] + span:after, .cs-blog .date-box,
    .csbody .xdsoft_datetimepicker .xdsoft_calendar td:hover,
    .csbody .xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box > div > div:hover,
    .modal-header .close span:hover,
    .xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_default, .xdsoft_datetimepicker .xdsoft_calendar td.xdsoft_current,
    .xdsoft_datetimepicker .xdsoft_timepicker .xdsoft_time_box > div > div.xdsoft_current, .cs-contact-social li:hover i  {
        background: <?php echo esc_attr($smof_data['primary_color']); ?> !important;
    }
    .cs-transformEvents:hover .cs-eventHeader:before,
    .cs-transformEvents:hover .cs-eventHeader:after,
    .cs-transformEvents:hover .cs-eventHeader {
        background: <?php echo esc_attr($smof_data['secondary_color']); ?> !important;
    }
    .cs-blog .mejs-controls .mejs-time-rail .mejs-time-loaded,
    .cs-blog .mejs-controls .mejs-time-rail .mejs-time-total,
    .cs-blog .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
        background: <?php echo esc_attr($smof_data['secondary_color']); ?>;
    }
    .sh-list-comment .post-holder a:hover,
    .post .cs-post-header .cs-post-title a:hover,
    .cs-breadcrumbs ul.breadcrumbs li a:hover,
    .logo-text strong:nth-child(1),
    #cs_portfolio_filters ul li.active a,
    .cs-carousel-body .cs-carousel-post-title h2.entry-title a:hover,
    .cs-carousel-post .cs-nav a:hover i:before,
    .cs-carousel-events .cs-nav a:hover i:before,
    .cs-carousel-container .cs-carousel-details a i,
    #footer-bottom ul.menu li a:hover, #footer-bottom ul.obtheme_mega_menu li a:hover,
    ul.cs_list_number li:before,
    .back-to-demo a:hover, .back-to-demo a:focus,
    .cs-portfolio-item .cs-portfolio-details .cs-portfolio-meta h3, .cs-portfolio-item .cs-portfolio-list-details li a:hover,
    .single-portfolio .cs-portfolio-item h5.title-pt, .cs-nav ul li:hover i,
    .tools-menu i, .back-to-demo i, .tools-menu:hover, .back-to-demo:hover
    .header-v7 #header-top h3.wg-title, .cs-eventCount-content #event_countdown span:nth-child(1),
    input[type="checkbox"] + span:after, .cs-blog .cs-blog-quote .icon-left:before,
    .cs-blog .cs-blog-quote .icon-right:after, .cs-menuFood.cs-menuFood-images.layout2 .price-food span  {
        color: <?php echo esc_attr($smof_data['primary_color']); ?> !important;
    }
    .single-portfolio .cs-portfolio-item .cs-portfolio-list-details li h5,
    h1.entry-title, h3.wg-title, .cs-title,
    .comment-body .fn, span.star, span.Selectoptions:after,
    .cs-blog-media .carousel-control.left:hover,
    .cs-blog-media .carousel-control.right:hover,
    .single-team .cs-item-team .cs-team-social li:hover a,
    blockquote > p:before, blockquote > p:after,
    .meny-top .meny-sidebar .cs_close:before,
    .meny-top .meny-sidebar .cs_close:hover:after,
    .cs-carousel-event-style1 .cs-event-meta .cs-event-time i,
    .cs-carousel-style-3 .cs-carousel-header-feature h3,
    .cs-blog .cs-blog-header .cs-blog-title a:hover,
    .cs-menuFood .cs-menuFood-header h3.cs-post-title a:hover {
        color: <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .cs-blog .mejs-container .mejs-controls .mejs-time span,
    .cs-navigation .prev.page-numbers:before,
    .cs-navigation .next.page-numbers:after,
    .tweets-container ul li:before,
    .cs-team .cs-title,
    .cs-team.cs-team-style-1 .cs-team-title a {
        color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
    }
    .cs-testimonial .cs-testimonial-header h3.cs-title {
        color: <?php echo esc_attr($smof_data['secondary_color']); ?> !important;
    }
    /* =========================================================
        Start Reset Input
    =========================================================*/
    /* ==========================================================================
    Start carousel latest work style1
    ========================================================================== */
    .title-line .ww-title .line, .title-line .wg-title span,
    .cs-carousel-post h3.cs-title span.line,
    .cs-carousel-portfolio h3.cs-title span.line,
    .cs-title .line {
        -webkit-box-shadow: 0 1px 0 <?php echo esc_attr($smof_data['primary_color']); ?>;
           -moz-box-shadow: 0 1px 0 <?php echo esc_attr($smof_data['primary_color']); ?>;
            -ms-box-shadow: 0 1px 0 <?php echo esc_attr($smof_data['primary_color']); ?>;
             -o-box-shadow: 0 1px 0 <?php echo esc_attr($smof_data['primary_color']); ?>;
                box-shadow: 0 1px 0 <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .cs-carousel-post .cs-carousel-header:hover:before,
    .cs-carousel-portfolio .cs-carousel-header:hover:before {
        background: <?php echo HexToRGB($smof_data['primary_color'],0.7); ?>;
    }
    .cs-carousel-post .cs-carousel-body h3.cs-carousel-title a,
    .cs-carousel-post.cs-carousel-post-default2 h3.cs-carousel-title a,
    .cs-carousel-post .cs-header .cs-title,
    .cs-carousel-portfolio .cs-carousel-body h3.cs-carousel-title a,
    .cs-carousel-portfolio.cs-carousel-post-default2 h3.cs-carousel-title a,
    .cs-carousel-portfolio .cs-header .cs-title, .search .page-header .page-title,
    .error404 .page-header .page-title {
        color: <?php echo esc_attr($smof_data['secondary_color']); ?>;
    }
    .cs-carousel-post.cs-carousel-post-default2.cs-style-retro h3.cs-carousel-title a,
    .tp-leftarrow .tp-arr-allwrapper:before, .tp-rightarrow .tp-arr-allwrapper:before{
        color: <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    ul.product-categories li a:hover {
        color: <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    /* ==========================================================================
    End carousel latest work style1
    ========================================================================== */
    /* =========================================================
      Portfolio Details
    =========================================================*/
    .single-portfolio .cs-portfolio-item .cs-portfolio-details .cs-portfolio-meta ul.cs-social i:hover,
    .cs-social li a:hover i,  {
        color: <?php echo esc_attr($smof_data['link_color_hover']); ?>;
    }
    /* =========================================================
      Menu Food
    =========================================================*/

    /* =========================================================
        Start Footer
    =========================================================*/
    #footer-top {
        background-color: <?php echo esc_attr($smof_data['footer_top_bg_color']); ?>;
        color: <?php echo esc_attr($smof_data['footer_text_color']); ?>;
    }
    #footer-top h3.wg-title {
        color: <?php echo esc_attr($smof_data['footer_headings_color']); ?> !important;
    }
    #footer-top a {
        color: <?php echo esc_attr($smof_data['footer_link_color']); ?> !important;
    }
    #footer-top a:hover {
        color: <?php echo esc_attr($smof_data['footer_link_hover_color']); ?> !important;
    }

    #footer-bottom {
        background-color: <?php echo esc_attr($smof_data['footer_bottom_bg_color']); ?>;
        color: <?php echo esc_attr($smof_data['footer_bottom_text_color']); ?>;
    }
    #footer-bottom h3.wg-title {
        color: <?php echo esc_attr($smof_data['footer_bottom_headings_color']); ?> !important;
    }
    #footer-bottom a {
        color: <?php echo esc_attr($smof_data['footer_bottom_link_color']); ?> !important;
    }
    #footer-bottom a:hover {
        color: <?php echo esc_attr($smof_data['footer_bottom_link_hover_color']); ?> !important;
    }

    <?php if($smof_data['footer_top_padding'] || $smof_data['footer_top_padding']) : ?>
    #footer-top {
        padding: <?php echo esc_attr($smof_data['footer_top_padding']); ?>;
        margin: <?php echo esc_attr($smof_data['footer_top_margin']); ?>;
    }
    <?php endif; ?>
    <?php if($smof_data['footer_bottom_padding'] || $smof_data['footer_bottom_margin']) : ?>
    #footer-bottom {
        padding: <?php echo esc_attr($smof_data['footer_bottom_padding']); ?>;
        margin: <?php echo esc_attr($smof_data['footer_bottom_margin']); ?>;
    }
    <?php endif; ?>
    /* =========================================================
        End Footer Top
    =========================================================*/

    /* ==========================================================================
      Start Carousel For NUVO
    ========================================================================== */
    .cs-carousel-container .cs-carousel-details .cs-zoom-images a,
    .cs-carousel-container .cs-carousel-details .cs-read-more a {
        border: 1px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .cs-carousel-container .cs-carousel-details .cs-zoom-images a:hover,
    .cs-carousel-container .cs-carousel-details .cs-read-more a:hover {
        background: <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .cs-menuFood-footer .feature-icon span {
        border-color: transparent transparent <?php echo esc_attr($smof_data['primary_color'].' '.$smof_data['primary_color']); ?>;
    }
    .rtl .cs-menuFood-footer .feature-icon span {
        border-color: transparent <?php echo esc_attr($smof_data['primary_color'].' '.$smof_data['primary_color']); ?> transparent;
    }
    #header-top .shopping_cart_dropdown {
        border-bottom: 5px solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .widget_price_filter .price_slider_wrapper .button {
        border: 2px solid <?php echo esc_attr($smof_data['primary_color']); ?> !important;
        color: <?php echo esc_attr($smof_data['primary_color']); ?> !important;
    }
    .widget_price_filter .price_slider_wrapper .button:hover {
        background: <?php echo HexToRGB($smof_data['primary_color'],0.3); ?> !important;
    }
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
    .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
    .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range {
        background: <?php echo esc_attr($smof_data['primary_color']); ?> !important;
    }
    /* ==========================================================================
      End Carousel For NUVO
    ========================================================================== */
    .csbody .picker__day--today::before {
        border-top: 0.5em solid <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .csbody .picker__day--selected, .picker__day--selected:hover, 
    .csbody .picker--focused .picker__day--selected {
        background: <?php echo esc_attr($smof_data['primary_color']); ?> !important;
    }
    .csbody .picker__day--highlighted {
        border-color: <?php echo esc_attr($smof_data['primary_color']); ?>;
    }
    .csbody .picker__day--infocus:hover, .csbody .picker__day--outfocus:hover {
        background: <?php echo HexToRGB($smof_data['primary_color'],0.8); ?> !important;
    }
</style>
<!--End Preset -->