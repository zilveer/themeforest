<?php
add_action('wp_head', 'mom_custom_styles', 160);
function mom_custom_styles() { ?>
<style type="text/css">
<?php if (mom_option('body_bg', 'background-color') != '' && mom_option('body_bg', 'background-image') == '') { ?>
body, body.layout-boxed {
    background-image: none;
}
<?php } ?>    
<?php if (mom_option('header_height') != '') { ?>
.header > .inner, .header .logo {
line-height: <?php echo mom_option('header_height'); ?>px;
height: <?php echo mom_option('header_height'); ?>px;
}
<?php } ?>
<?php if (mom_option('main_color') != '') { ?>
.news-box .nb-item-meta a:hover {
    color: <?php echo mom_option('main_color'); ?> !important;
}
<?php } ?>
<?php if (mom_option('selection_color') != '') { ?>
::selection {
background:<?php echo mom_option('selection_color') ; ?>;
}
::-moz-selection {
background:<?php echo mom_option('selection_color') ; ?>;
}
<?php } ?>
<?php if (mom_option('topbar_s_cl') != '') { ?>
.topbar ::-webkit-input-placeholder {
color:<?php echo mom_option('topbar_s_cl'); ?>;
}
.topbar  :-moz-placeholder { /* Firefox 18- */
color:<?php echo mom_option('topbar_s_cl'); ?>;  
}
.topbar ::-moz-placeholder {  /* Firefox 19+ */
color:<?php echo mom_option('topbar_s_cl'); ?>;  
}
.topbar :-ms-input-placeholder {  
color:<?php echo mom_option('topbar_s_cl'); ?>;  
}
<?php } ?>
<?php if (mom_option('navigation_links', 'color') != '') { ?>
.show_all_results a i, .search-wrap ul.s-results .s-img .post_format {
color: <?php echo mom_option('navigation_links', 'color'); ?>;
}
<?php } ?>
<?php if (mom_option('inputs_txt') != '') { ?>
::-webkit-input-placeholder {
color:<?php echo mom_option('inputs_txt'); ?>;
}
 :-moz-placeholder { /* Firefox 18- */
color:<?php echo mom_option('inputs_txt'); ?>;  
}
::-moz-placeholder {  /* Firefox 19+ */
color:<?php echo mom_option('inputs_txt'); ?>;  
}
:-ms-input-placeholder {  
color:<?php echo mom_option('inputs_txt'); ?>;  
}
.asf-el .mom-select select, .asf-el .mom-select select:focus {
text-shadow:0 0 0 <?php echo mom_option('inputs_txt'); ?>;  
}
<?php } ?>
<?php if (mom_option('bbox-head-dots', 'url') != '') { ?>
.news-box .nb-header .nb-title, .sidebar .widget .widget-title {
    background-image: url(<?php echo mom_option('bbox-head-dots', 'url'); ?>);
}
<?php } ?>
<?php if (mom_option('footer_inputs_txt') != '') { ?>
#footer ::-webkit-input-placeholder {
color:<?php echo mom_option('footer_inputs_txt'); ?>;  
}

#footer  :-moz-placeholder { /* Firefox 18- */
color:<?php echo mom_option('footer_inputs_txt'); ?>;  
}

#footer ::-moz-placeholder {  /* Firefox 19+ */
color:<?php echo mom_option('footer_inputs_txt'); ?>;  
}

#footer :-ms-input-placeholder {  
color:<?php echo mom_option('footer_inputs_txt'); ?>;  
}
<?php } ?>
<?php echo mom_option('custom_css'); ?>
<?php if (is_singular()) {
    global $post;
    //custom page/post background
    $page_bg = get_post_meta($post->ID, 'mom_custom_bg', true);
    $page_bg_img = get_post_meta($post->ID, 'mom_custom_bg_img', true);
    $page_bg_pos = get_post_meta($post->ID, 'mom_custom_bg_pos', true);
    $page_bg_repeat = get_post_meta($post->ID, 'mom_custom_bg_repeat', true);
    $page_bg_attach = get_post_meta($post->ID, 'mom_custom_bg_attach', true);
    $page_bg_size = get_post_meta($post->ID, 'mom_custom_bg_size', true);
?>
<?php if ($page_bg != '') { ?>
body {
    background: <?php echo $page_bg; ?>;
<?php if ($page_bg_img != '') { ?>
    background-image: url(<?php echo $page_bg_img; ?>);
<?php } ?>
<?php if ($page_bg_pos != '') { ?>
    background-position:<?php echo $page_bg_pos; ?>;
<?php } ?>
<?php if ($page_bg_repeat != '') { ?>
    background-repeat:<?php echo $page_bg_repeat; ?>;
<?php } ?>
<?php if ($page_bg_attach != '') { ?>
    background-attachment:<?php echo $page_bg_attach; ?>;
<?php } ?>
<?php if ($page_bg_size != '') { ?>
    background-size:<?php echo $page_bg_size; ?>;
<?php } ?>
}
<?php } ?>
<?php } ?>
</style>
<?php }