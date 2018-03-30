<?php 
$body_bg_color = get_option('pix_style_body_bg_color');
$body_bg_img = 'url('.get_option('pix_style_body_img').')';
$body_bg_position = get_option('pix_style_body_position');
$body_bg_repeat = get_option('pix_style_body_repeat') == '0' ? 'no-repeat' : 'repeat';
$body_bg_size = get_option('pix_style_body_size');
$body_font_family = '"'.get_option('pix_style_body_fontfamily').'"';
$body_font_size = get_option('pix_style_body_fontsize').'px';
$body_font_variant = get_option('pix_style_body_fontvariant');
    $body_font_weight = str_replace('italic', '400', $body_font_variant);
    $body_font_weight = str_replace('regular', '400', $body_font_weight);
    $body_font_style = 'normal';
$get_page_margin_top = get_option('pix_style_page_margin_top');
$page_margin_top = $get_page_margin_top.'px';
$get_page_margin_right = get_option('pix_style_page_margin_right');
$page_margin_right = $get_page_margin_right.'px';
$get_page_margin_bottom = get_option('pix_style_page_margin_bottom');
$page_margin_bottom = $get_page_margin_bottom.'px';
$get_page_margin_left = get_option('pix_style_page_margin_left');
$page_margin_left =  $get_page_margin_left.'px';
$get_page_margin_right_1st_break = $get_page_margin_right > 40 ? 40 : $get_page_margin_right;
$get_page_margin_right_2st_break = $get_page_margin_right > 20 ? 20 : $get_page_margin_right;
$get_page_margin_left_1st_break = $get_page_margin_left > 40 ? 40 : $get_page_margin_left;
$get_page_margin_left_2st_break = $get_page_margin_left > 20 ? 20 : $get_page_margin_left;
$get_page_margin_top_1st_break = $get_page_margin_top > 40 ? 40 : $get_page_margin_top;
$get_page_margin_top_2st_break = $get_page_margin_top > 20 ? 20 : $get_page_margin_top;
$get_page_margin_bottom_1st_break = $get_page_margin_bottom > 40 ? 40 : $get_page_margin_bottom;
$get_page_margin_bottom_2st_break = $get_page_margin_bottom > 20 ? 20 : $get_page_margin_bottom;

/*if ( $get_page_margin_top==0 && $get_page_margin_bottom==0 && $get_page_margin_left==0 && $get_page_margin_right==0 ) {
    $body_bg_img = 'none';
}*/
$viewport = get_option('pix_style_layout_width') != '' ? get_option('pix_style_layout_width') : 1320;

$get_page_radius = get_option('pix_style_page_radius');
$page_radius = $get_page_radius.'px';
$page_shadow_size = get_option('pix_style_page_shadow_size').'px';
$page_shadow_color = pix_hex2rgbcompiled(get_option('pix_style_page_shadow_color'));
$page_shadow_opacity = get_option('pix_style_page_shadow_opacity');
$page_bg_color = get_option('pix_style_page_bg_color');
$display_topbar = get_option('pix_style_topbar_display');
$get_above_header_bg = get_option('pix_style_topbar_bgcolor');
$above_header_bg = pix_hex2rgbcompiled($get_above_header_bg);
$above_header_color = get_option('pix_style_topbar_color');
$above_header_opacity = get_option('pix_style_topbar_opacity');
$get_above_header_h = $display_topbar == 'true' ? get_option('pix_style_topbar_height') : '0';
$above_header_h = $display_topbar == 'true' ? get_option('pix_style_topbar_height').'px' : '0';
$above_header_fontsize = get_option('pix_style_topbar_fontsize').'rem';
$above_appended = $get_page_margin_top > 3 ? '-3px' : '1px';
$above_border = get_option('pix_style_topbar_border');
$get_header_top = $display_topbar=='true' ? $get_above_header_h : 0;
$get_header_bg = get_option('pix_style_header_bgcolor');
$header_bg = pix_hex2rgbcompiled($get_header_bg);
$header_opacity = get_option('pix_style_header_opacity');
$get_header_height = get_option('pix_style_header_height');
$header_height = $get_header_height.'px';
$get_header_height_scrolled = get_option('pix_style_header_height_scrolled');
$header_height_scrolled = $get_header_height_scrolled.'px';
$header_height_scrolled_scaled = $get_header_height_scrolled/$get_header_height;
$data_affix = get_option('pix_style_header_scroll') == 'true' ? (get_option('pix_style_header_height')-get_option('pix_style_header_height_scrolled')) : 0;
$data_affix = $data_affix + $get_above_header_h;
$get_sitetitle_size = get_option('pix_style_sitetitle_fontsize');
$sitetitle_size = $get_sitetitle_size.'px';
$sitedescription_size = get_option('pix_style_sitedescription_fontsize').'px';
$get_sitedescription_size = get_option('pix_style_sitedescription_fontsize');
$display_sitedescription = get_option('pix_style_sitetitle_display') != '0' ? 'block' : 'none';
$sitedescription_fromleft = get_option('pix_style_sitedescription_fromleft').'px';
$sitedescription_frombottom = get_option('pix_style_sitedescription_frombottom').'px';
$navbar_bg = get_option('pix_style_nav_background');
$navbar_border = get_option('pix_style_nav_border');
$navbar_font = '"'.get_option('pix_style_nav_fontfamily').'"';
$navbar_font_style = strpos(get_option('pix_style_nav_fontvariant'),'italic') !== false ? 'italic' : 'normal';
    $navbar_font_weight = str_replace('italic', '400', get_option('pix_style_nav_fontvariant'));
    $navbar_font_weight = str_replace('regular', '400', $navbar_font_weight);
$navbar_fontsize = get_option('pix_style_nav_fontsize').'px';
$get_navbar_fontsize = get_option('pix_style_nav_fontsize');
$navbar_lineheight = get_option('pix_style_nav_lineheight').'px';
$navbar_color = get_option('pix_style_nav_color');
$current_color = get_option('pix_style_current_border');
$navbar_hover_color = get_option('pix_style_nav_hover_color');
$navbar_hover_bg = get_option('pix_style_nav_hover_bg');
$get_navbar_h = get_option('pix_style_nav_lineheight');
$navbar_h = $get_navbar_h.'px';
$sitetitle_font = '"'.get_option('pix_style_sitetitle_fontfamily').'"';
$logo_bg = get_option('pix_style_logo_bg');
$logo_padding = get_option('pix_style_sitetitle_padding').'px';
$sitetitle_color = get_option('pix_style_sitetitle_color');
$sitetitle_font_style = strpos(get_option('pix_style_sitetitle_fontvariant'),'italic') !== false ? 'italic' : 'normal';
    $sitetitle_font_weight = str_replace('italic', '400', get_option('pix_style_sitetitle_fontvariant'));
    $sitetitle_font_weight = str_replace('regular', '400', $sitetitle_font_weight);
$sitetitle_font = '"'.get_option('pix_style_sitetitle_fontfamily').'"';
$logo_bg = get_option('pix_style_logo_bg');
$logo_padding = get_option('pix_style_sitetitle_padding').'px';
$sitetitle_color = get_option('pix_style_sitetitle_color');
$sitetitle_font_style = strpos(get_option('pix_style_sitetitle_fontvariant'),'italic') !== false ? 'italic' : 'normal';
    $sitetitle_font_weight = str_replace('italic', '400', get_option('pix_style_sitetitle_fontvariant'));
    $sitetitle_font_weight = str_replace('regular', '400', $sitetitle_font_weight);
$sitedescription_font = '"'.get_option('pix_style_sitedescription_fontfamily').'"';
$sitedescription_color = get_option('pix_style_sitedescription_color');
$sitedescription_font_style = strpos(get_option('pix_style_sitedescription_fontvariant'),'italic') !== false ? 'italic' : 'normal';
    $sitedescription_font_weight = str_replace('italic', '400', get_option('pix_style_sitedescription_fontvariant'));
    $sitedescription_font_weight = str_replace('regular', '400', $sitedescription_font_weight);
$cta_color = get_option('pix_style_nav_color_cta');
$cta_hover = get_option('pix_style_hover_color_cta');
$cta_radius = get_option('pix_style_radius_cta');
$cta_border = get_option('pix_style_border_w_cta');
$cta_bg = get_option('pix_style_bg_cta');
$cta_bg_hover = get_option('pix_style_bg_hover_cta');
$cta_border_color = get_option('pix_style_border_cta');
$cta_border_color_hover = get_option('pix_style_border_hover_cta');
$nav2nd_bg = get_option('pix_style_nav2nd_bg');
$nav2nd_border = get_option('pix_style_nav2nd_border');
$nav2nd_border2 = get_option('pix_style_nav2nd_border2');
$nav2nd_color = get_option('pix_style_nav2nd_color');
$nav2nd_hover_color = get_option('pix_style_nav2nd_hover_color');
$nav2nd_hover_bg = get_option('pix_style_nav2nd_hover_bg');
$nav2nd_font = '"'.get_option('pix_style_nav2nd_fontfamily').'"';
$nav2nd_font_style = strpos(get_option('pix_style_nav2nd_fontvariant'),'italic') !== false ? 'italic' : 'normal';
    $nav2nd_font_weight = str_replace('italic', '400', get_option('pix_style_nav2nd_fontvariant'));
    $nav2nd_font_weight = str_replace('regular', '400', $nav2nd_font_weight);
$nav2nd_fontsize = get_option('pix_style_nav2nd_fontsize').'px';
$body_color = get_option('pix_style_body_color');
$alternative_font = '"'.get_option('pix_style_alternative_fontfamily').'"';
$alternative_font_size = get_option('pix_style_alternative_fontsize').'em';
$alternative_font_variant = get_option('pix_style_alternative_fontvariant');
    $alternative_font_weight = str_replace('italic', '400', $alternative_font_variant);
    $alternative_font_weight = str_replace('regular', '400', $alternative_font_weight);
    $alternative_font_style = 'normal';
$border_color = get_option('pix_style_border_color');
$alternative_border = get_option('pix_style_alternative_border');
$input_bg = get_option('pix_style_input_bg');
$link_color = get_option('pix_style_link_color');
$link_hover = get_option('pix_style_link_hover');
$tiny_color = get_option('pix_style_tiny_color');
$error_color = get_option('pix_style_error_color');

$single_font = '"'.get_option('pix_style_single_fontfamily').'"';
$single_font_size = get_option('pix_style_single_fontsize').'em';
$single_font_variant = get_option('pix_style_single_fontvariant');
    $single_font_weight = str_replace('italic', '400', $single_font_variant);
    $single_font_weight = str_replace('regular', '400', $single_font_weight);
if (strpos($single_font_variant,'italic') !== false) {
    $single_font_style = 'italic';
} else {
    $single_font_style = 'normal';
}
$scroll_bg = pix_hex2rgbcompiled(get_option('pix_style_scroll_bg'));
$scroll_opacity = get_option('pix_style_scroll_bg_opacity');
$scroll_color = get_option('pix_style_scroll_color');
$featured_color = get_option('pix_style_featured_color');
$featured_color_alt = get_option('pix_style_featured_color_alt');
$title_color = get_option('pix_style_title_color');
$title_bgcolor = get_option('pix_style_title_bgcolor');
$cbox_overlay = get_option('pix_style_colorbox_overlay');
$cbox_content = get_option('pix_style_colorbox_content_bg');
$cbox_color = get_option('pix_style_colorbox_color');
$cbox_buttons = get_option('pix_style_colorbox_button');

$default_box_color = get_option('pix_style_box_default_color');
$default_box_bg = get_option('pix_style_box_default_background');
$default_box_radius = get_option('pix_style_box_default_borderradius');
$default_box_border_color = get_option('pix_style_box_default_bordercolor');
$default_box_border_w = get_option('pix_style_box_default_borderwidth');
$default_box_style = get_option('pix_style_box_default_style');
$success_box_color = get_option('pix_style_box_success_color');
$success_box_bg = get_option('pix_style_box_success_background');
$success_box_radius = get_option('pix_style_box_success_borderradius');
$success_box_border_color = get_option('pix_style_box_success_bordercolor');
$success_box_border_w = get_option('pix_style_box_success_borderwidth');
$success_box_style = get_option('pix_style_box_success_style');
$error_box_color = get_option('pix_style_box_error_color');
$error_box_bg = get_option('pix_style_box_error_background');
$error_box_radius = get_option('pix_style_box_error_borderradius');
$error_box_border_color = get_option('pix_style_box_error_bordercolor');
$error_box_border_w = get_option('pix_style_box_error_borderwidth');
$error_box_style = get_option('pix_style_box_error_style');

$css = "body {
    background-color: $body_bg_color;
    color: $body_color;
    font-family: $body_font_family;
    font-size: $body_font_size;
    font-style: $body_font_style;
    font-weight: $body_font_weight;
}
.alternative_font {
    font-family: $alternative_font;
    font-size: $alternative_font_size;
    font-style: $alternative_font_style;
    font-weight: $alternative_font_weight;
}

blockquote,
body:not(.search-results) .hentry.format-quote,
body:not(.search-results) .hentry.format-quote p {
    color: $tiny_color;
    font-family: $alternative_font;
    font-size: $alternative_font_size;
    font-style: $alternative_font_style;
    font-weight: $alternative_font_weight;
}
pre {
    background: $input_bg;
    background: -webkit-linear-gradient(top, $input_bg 50%, $page_bg_color 50%);
    background: -moz-linear-gradient(top, $input_bg 50%, $page_bg_color 50%);
    background: -ms-linear-gradient(top, $input_bg 50%, $page_bg_color 50%);
    background: -o-linear-gradient(top, $input_bg 50%, $page_bg_color 50%);
    background: linear-gradient(top, $input_bg 50%, $page_bg_color 50%);
    border: 1px solid $border_color;
    color: $tiny_color;
}
code {
    background: $input_bg;
    border: 1px solid $border_color;
    color: $tiny_color;
}
.small_underline::before {
    border-top-color: $border_color;
}
.small_underline::after {
    background-color: $page_bg_color;
    border-color: $border_color;
}
";
if ( get_option('pixgridder_css_break')!='' ) {
$css .= "
@media (max-width: ".get_option('pixgridder_css_break')."px) {
    .hide_small {
        display: none!important;
    }
}
@media (min-width: ".(get_option('pixgridder_css_break')+1)."px) {
    .show_small {
        display: none!important;
    }
}
";
}
if ( get_option('pixgridder_medium_break')!='' ) {
$css .= "
@media (max-width: ".get_option('pixgridder_medium_break')."px) {
    .hide_medium {
        display: none!important;
    }
}
@media (min-width: ".(get_option('pixgridder_medium_break')+1)."px) {
    .show_medium {
        display: none!important;
    }
}
";
}
if ( $body_bg_img!='' ) {
$css .= "
body {
    background-attachment: fixed;
    background-position: $body_bg_position;
    background-repeat: $body_bg_repeat;
    background-size: $body_bg_size;
}
#bgBody {
    background-image: $body_bg_img;
    background-position: $body_bg_position;
    background-repeat: $body_bg_repeat;
    background-size: $body_bg_size;
}";
}
$css .= "
#page {
    background-color: $page_bg_color;
    -webkit-border-radius: $page_radius;
    -moz-border-radius: $page_radius;
    border-radius: $page_radius;
    margin: $page_margin_top $page_margin_right $page_margin_bottom $page_margin_left;
}
#main .row {
    background-color: $page_bg_color;
}
@media (min-width: 1025px) {
    #main .entry-content .row[data-extra=\"fullscreen\"].first-slideshow.fixed,
    #main .entry-content .row[data-extra=\"fullwidth\"].first-slideshow.fixed {
        left: $page_margin_left;
        right: $page_margin_right;
    }
}
.pseudo-arrow {
    color: $page_bg_color;
}
.pixgridder .row.quote-section::before {
    border-color: $featured_color;
    color: $featured_color;
}";

if ( $page_shadow_size>0 && $page_shadow_opacity>0 ) {
$css .= "
body:not(.layout-noframed) #page::after {
    -webkit-box-shadow: 0px 0px $page_shadow_size rgba($page_shadow_color,$page_shadow_opacity);
    -moz-box-shadow: 0px 0px $page_shadow_size rgba($page_shadow_color,$page_shadow_opacity);
    -o-box-shadow: 0px 0px $page_shadow_size rgba($page_shadow_color,$page_shadow_opacity);
    box-shadow: 0px 0px $page_shadow_size rgba($page_shadow_color,$page_shadow_opacity);
    bottom: " . ($get_page_margin_bottom+$get_page_radius) . "px;
    content: '';
    display: block;
    left: " . ($get_page_margin_left+$get_page_radius) . "px;
    position: absolute;
    right: " . ($get_page_margin_right+$get_page_radius) . "px;
    top: " . ($get_page_margin_top+$get_page_radius) . "px;
    z-index: -1;
}
";
}
$css .= "
@media (min-width: 1025px) {
    #header_affix {
        left: $page_margin_left;
        right: $page_margin_right;
    }
}
@media (min-width: 801px) and (max-width: 1024px) {
    #page {
        margin-left: {$get_page_margin_left_1st_break}px;
        margin-right: {$get_page_margin_right_1st_break}px;
        margin-top: {$get_page_margin_top_1st_break}px;
        margin-bottom: {$get_page_margin_bottom_1st_break}px;
    }
    #header_affix {
        left: {$get_page_margin_left_1st_break}px;
        right: {$get_page_margin_right_1st_break}px;
    }
}
@media (min-width: 321px) and (max-width: 800px) {
    #page {
        margin-left: {$get_page_margin_left_2st_break}px;
        margin-right: {$get_page_margin_right_2st_break}px;
        margin-top: {$get_page_margin_top_2st_break}px;
        margin-bottom: {$get_page_margin_bottom_2st_break}px;
    }
    #header_affix {
        left: {$get_page_margin_left_2st_break}px;
        right: {$get_page_margin_right_2st_break}px;
    }
}
.pix-quick-view {
    background-color: $page_bg_color;
}
.wp-caption {
    border-bottom-color: $border_color;
}
.wp-caption-text {
    color: $tiny_color;
}

body.layout-boxed #header_affix,
.layout-boxed #page,
.layout-boxed #page::after,
.layout-boxed #above_header,
body.layout-boxed #wrap_header,
.grid-blog.wide-template #content,
.wide-template .row[data-extra=\"fullwidth\"] .sc-portfolio-filters,
.wide-template .row[data-extra=\"fullwidth\"] .geode_pagination,
#main .side-template,
#main .double-side-template,
#above_header .row-inside,
#wrap_header .row-inside,
.alternative_content_panel .row-inside,
#main .row-inside,
#ghost-layout {
    max-width: {$viewport}px;
}
#main .row[data-extra=\"text-box\"] .row-text-box {
    background: $input_bg;
    border-color: $border_color;
}
";

if ( get_option('pix_content_top_sliding_page') !='' ) {
$css .= "@media (max-width: 320px) {
    #above_header .row-inside {
        padding-right: 56px;
    }
}";
}
$css .= "#page #header_affix > :first-child,
#page #header_affix > :first-child .row:first-child,
#page #header_affix > :first-child .row-inside:first-child,
#page .entry-header,
#page .entry-header .pix_maps,
#page .entry-header #bgTitle,
body.page-template-templatesfront-page-php #main .entry-content .row[data-extra=\"fullscreen\"]:first-child,
body.page-template-templatesfront-page-php #main .entry-content .row[data-extra=\"fullwidth\"]:first-child {
    -webkit-border-top-left-radius: $page_radius;
    -webkit-border-top-right-radius: $page_radius;
    -moz-border-radius-topleft: $page_radius;
    -moz-border-radius-topright: $page_radius;
    border-top-left-radius: $page_radius;
    border-top-right-radius: $page_radius;
}
#page > :last-child,
#page > :last-child .row:last-child,
#page > :last-child .row-inside:last-child {
    -webkit-border-bottom-left-radius: $page_radius;
    -webkit-border-bottom-right-radius: $page_radius;
    -moz-border-radius-bottomleft: $page_radius;
    -moz-border-radius-bottomright: $page_radius;
    border-bottom-left-radius: $page_radius;
    border-bottom-right-radius: $page_radius;
}
#main .page-description.row > .row-inside > .row:last-child > .row-inside:last-child,
#main .term-description.row > .row-inside > .row:last-child > .row-inside:last-child {
    border-bottom: 1px solid $border_color;
}

";
$typography_ar = array ('h1','h2','h3','h4','h5','h6');
foreach ($typography_ar as $key => $tag) {
    $this_font_style = strpos(get_option('pix_style_'.$tag.'_fontvariant'),'italic') !== false ? 'italic' : 'normal';
    $this_font_weight = str_replace('italic', '400', get_option('pix_style_'.$tag.'_fontvariant'));
    $this_font_weight = str_replace('regular', '400', $this_font_weight);
    $this_color = get_option('pix_style_'.$tag.'_color') != '' ? get_option('pix_style_'.$tag.'_color') : 'inherit';
$css .= "$tag, .$tag, a.$tag, .{$tag}_font, a.$tag{$tag}_font {
    color: $this_color;
    font-family: ".get_option('pix_style_'.$tag.'_fontfamily').";
    font-size: ".get_option('pix_style_'.$tag.'_fontsize')."em;
    ".get_option('pix_style_'.$tag.'_css')."
}
$tag a {
    color: $this_color!important;
}
";
}
if ( $display_topbar=='true' ) {
$css .= "#above_header {
    background: rgba($above_header_bg,$above_header_opacity);
    color: $above_header_color;
    font-size: $above_header_fontsize;
    height: $above_header_h;
    line-height: $above_header_h;
}
#above_header .top_bar_drop_down a::before,
#above_header .top_bar_drop_down a::after {
    background: $above_header_color;
}
#above_header::after {
    background-color: $above_border;
}
#above_header .above_header_inside,
#above_header #lang_sel ul ul {
    -webkit-box-shadow: 0 3px 0 rgba(".pix_hex2rgbcompiled($body_color).",.2);
    box-shadow: 0 3px 0 rgba(".pix_hex2rgbcompiled($body_color).",.2);
}
@media (min-width: 1025px) {
    /*body.sticky-header.affix:not(.headerHover):not(.headerLetmebe) #above_header {
        -webkit-transform: translateY(-$above_header_h);
        -moz-transform: translateY(-$above_header_h);
        -ms-transform: translateY(-$above_header_h);
        -o-transform: translateY(-$above_header_h);
        transform: translateY(-$above_header_h);
    }*/
    body.sticky-header.headerHover:not(.headerLetmebe) #header_affix-sticky-wrapper.is-sticky #header_affix {
        -webkit-transform: translateY($above_header_h);
        -moz-transform: translateY($above_header_h);
        -ms-transform: translateY($above_header_h);
        -o-transform: translateY($above_header_h);
        transform: translateY($above_header_h);
    }
}
#above_header .top_bar.topped .above_header_inside,
#above_header li.topped ul {
    top: $above_header_h!important;
}
#above_header .top_bar .amount_appended {
    background: $current_color;
    border-color: $get_above_header_bg;
    color: $get_header_bg;
}
";
} else {
$css .= "#above_header {
    display: none;
}
#wrap_header {
    -webkit-border-top-left-radius: $page_radius;
    -webkit-border-top-right-radius: $page_radius;
    -moz-border-radius-topleft: $page_radius;
    -moz-border-radius-topright: $page_radius;
    border-top-left-radius: $page_radius;
    border-top-right-radius: $page_radius;
}
";
}
$css .= "
#expand-mobile-cart.topped .children {
    top: $header_height_scrolled!important;
}
#wrap_header {
    background: rgba($header_bg,$header_opacity);
    -webkit-box-shadow: 0 3px 0 rgba(".pix_hex2rgbcompiled($body_color).",.2);
    box-shadow: 0 3px 0 rgba(".pix_hex2rgbcompiled($body_color).",.2);
    height: $header_height;
    line-height: $header_height;
    margin-top: ".($get_header_top)."px;
}
#navbar .amount_appended {
    background: $current_color!important;
    border-color: $get_header_bg!important;
    color: $get_header_bg!important;
}
header#masthead .home-link {
    background-color: $logo_bg;
    padding: 0 $logo_padding;
}
header#masthead .home-link .site-title {
    color: $sitetitle_color!important;
    font-family: $sitetitle_font;
    font-size: $sitetitle_size;
    font-style: $sitetitle_font_style;
    font-weight: $sitetitle_font_weight;
}
header#masthead .home-link h2.site-description {
    bottom: $sitedescription_frombottom;
    color: $sitedescription_color;
    display: $display_sitedescription;
    font-family: $sitedescription_font;
    font-size: $sitedescription_size;
    font-style: $sitedescription_font_style;
    font-weight: $sitedescription_font_weight;
    margin-left: $sitedescription_fromleft;
}
body.header-centered header#masthead #navbar > nav > div > div[role=\"list\"],
body.header-centered header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] {
    height: $navbar_h;
}
body.header-centered header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > a {
    height: $navbar_h;
    line-height: $navbar_h;
}
header#masthead #navbar > nav > div > div[role=\"list\"] div[role=\"listitem\"] > div[role=\"list\"]::after,
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > div::after {
    background: $body_color;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > div:not([role=\"list\"]) div[role=\"list\"]::after {
    background-color: $nav2nd_border2;
}
body.header-centered header#masthead #navbar #expand-menu,
body.header-centered header#masthead #navbar #expand-mobile-cart {
    margin-top: ".($get_navbar_h/2)."px;
}
#navbar #expand-mobile-cart {
    color: $navbar_color;
}
#navbar #expand-menu .burger,
#navbar #expand-menu .burger::before,
#navbar #expand-menu .burger::after {
    background: $navbar_color;
}
#mobile-navigation div[role=\"listitem\"] * {
    color: $nav2nd_color;
}
#mobile-navigation div[role=\"listitem\"] > a,
#mobile-navigation div[role=\"listitem\"] > .pix-menu-no-link,
#mobile-navigation div[role=\"listitem\"] > .pix_widget {
    background: $nav2nd_bg;
    border-bottom: 1px solid $nav2nd_border2;
    color: $nav2nd_color;
    font-family: $nav2nd_font;
    font-size: $nav2nd_fontsize;
    font-style: $nav2nd_font_style;
    font-weight: $nav2nd_font_weight;
}
#mobile-navigation > div > div[role=\"list\"] div[role=\"listitem\"].current-menu-item > a,
#mobile-navigation > div > div[role=\"list\"] div[role=\"listitem\"].current_page_item > a,
#mobile-navigation > div > div[role=\"list\"] div[role=\"listitem\"].open > a {
    background: $nav2nd_hover_bg;
}
#mobile-navigation > div > div[role=\"list\"] > div[role=\"listitem\"].current-menu-item > a::before,
#mobile-navigation > div > div[role=\"list\"] > div[role=\"listitem\"].ccurrent_page_item > a::before {
    background: $current_color;
}
#mobile-navigation > div > div[role=\"list\"] div[role=\"listitem\"].hasUl > a > .after {
    background: rgba(".pix_hex2rgbcompiled($nav2nd_color).",.05);
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"].topped > div {
    top: $header_height;
}
body.header-centered header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"].topped > div {
    top: $navbar_lineheight;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > a {
    color: $navbar_color;
    font-family: $navbar_font;
    font-size: $navbar_fontsize;
    font-style: $navbar_font_style;
    font-weight: $navbar_font_weight;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"].pix-call-to-action > a {
    color: $cta_color;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"]:not(.menu-added-icon-item) div[role=\"list\"],
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"]:not(.menu-added-icon-item) div[role=\"list\"] div[role=\"listitem\"] > a {
    font-family: $nav2nd_font;
    font-size: $nav2nd_fontsize;
    font-style: $nav2nd_font_style;
    font-weight: $nav2nd_font_weight;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"]:hover > a {
    color: $navbar_hover_color;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"].pix-call-to-action:hover > a {
    color: $cta_hover;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > span::before {
    background-color: $navbar_hover_bg;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"].pix-call-to-action > span::before {
    -moz-border-radius: {$cta_radius}px;
    border-radius: {$cta_radius}px;
    background-color: $cta_bg;
    border: {$cta_border}px solid $cta_border_color
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"].pix-call-to-action:hover > span::before {
    background-color: $cta_bg_hover;
    border-color: $cta_border_color_hover;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"].current-menu-item > span::after,
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"].current_page_item > span::after {
    background: $current_color;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > span {
    margin: -".($get_navbar_h/2)."px 0;
}
@media (min-width: 1025px) {
    body.sticky-header:not(.headerHover):not(.header-centered):not(.headerLetmebe) #header_affix-sticky-wrapper.is-sticky #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > span {
        margin: -".floor(($get_navbar_h/2)*($header_height_scrolled_scaled/0.75))."px 0;
    }
}
@media (max-width: 800px) {
    header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > a,
    header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > a {
        font-size: ".floor($get_navbar_fontsize*($header_height_scrolled_scaled/0.75))."px;
        padding: 0 ".(floor(500*($header_height_scrolled_scaled))/1000)."em;
    }
    header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > span {
        margin: -".floor(($get_navbar_h/2)*($header_height_scrolled_scaled/0.75))."px 0;
    }
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] div[role=\"list\"] div[role=\"listitem\"] a,
header#masthead #navbar > div#expand-mobile-cart div[role=\"list\"] div[role=\"listitem\"] a,
header#masthead #navbar > nav .pix_widget {
    color: $nav2nd_color;
}
header#masthead #navbar .pix_desc_image img {
    border-color: $nav2nd_border2;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] div[role=\"list\"] div[role=\"listitem\"]:hover > a {
    color: $nav2nd_hover_color;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] div[role=\"list\"] div[role=\"listitem\"] > .pix-menu-no-link:not(.pix_mega_title) {
    background: $nav2nd_hover_bg;
    color: $nav2nd_color;
}
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] div[role=\"list\"] div[role=\"listitem\"] > .pix_mega_title {
    color: $nav2nd_color;
}
header#masthead #navbar > nav > div > div[role=\"list\"] div[role=\"listitem\"] > div[role=\"list\"],
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > div,
#expand-mobile-cart .children,
#above_header .above_header_inside,
#above_header #lang_sel ul ul {
    background: $nav2nd_bg;
    color: $nav2nd_color;
    border-left: 1px solid $nav2nd_border2;
    border-right: 1px solid $nav2nd_border2;
}
header#masthead #navbar > nav > div > div[role=\"list\"] div[role=\"listitem\"] > div[role=\"list\"]::before,
header#masthead #navbar > nav > div > div[role=\"list\"] > div[role=\"listitem\"] > div::before,
#expand-mobile-cart .children::before,
#above_header .above_header_inside::before,
#above_header #lang_sel ul ul::before {
    background: $nav2nd_border;
}
@media (min-width: 1025px) {
    body.sticky-header:not(.headerHover):not(.headerLetmebe) #header_affix-sticky-wrapper.is-sticky #wrap_header {
        height: $header_height_scrolled;
        line-height: $header_height_scrolled;
        /*-webkit-transform: translateY(-$above_header_h);
        -moz-transform: translateY(-$above_header_h);
        -ms-transform: translateY(-$above_header_h);
        -o-transform: translateY(-$above_header_h);
        transform: translateY(-$above_header_h);*/
    }
    body.sticky-header.header-centered:not(.headerHover):not(.headerLetmebe) #header_affix-sticky-wrapper.is-sticky #wrap_header {
        height: ".($get_header_height_scrolled+$get_navbar_h)."px;
    }
    /*body.sticky-header.affix:not(.headerHover):not(.headerLetmebe) #home-link-wrap {
      -webkit-transform: scale($header_height_scrolled_scaled);
      -moz-transform: scale($header_height_scrolled_scaled);
      -ms-transform: scale($header_height_scrolled_scaled);
      -o-transform: scale($header_height_scrolled_scaled);
      transform: scale($header_height_scrolled_scaled);
    }*/
}
@media (max-width: 800px) {
    #wrap_header {
        height: $header_height_scrolled;
        line-height: $header_height_scrolled;
    }
    header#masthead .home-link .site-title {
        font-size: ".floor($get_sitetitle_size*($header_height_scrolled_scaled))."px;
    }
    header#masthead .home-link h2.site-description {
        display: none;
    }
    header#masthead .home-link h1 img,
    header#masthead .home-link h1 svg {
        margin-right: 0;
        -webkit-transform: scale($header_height_scrolled_scaled);
        -moz-transform: scale($header_height_scrolled_scaled);
        -ms-transform: scale($header_height_scrolled_scaled);
        -o-transform: scale($header_height_scrolled_scaled);
        transform: scale($header_height_scrolled_scaled);
    }
}
@media (min-width: ".(get_option('pix_style_nav_mobile_size')+1)."px) {
    body.header-centered #wrap_header {
        height: ".($get_header_height+$get_navbar_h)."px;
    }
}
@media (max-width: ".get_option('pix_style_nav_mobile_size')."px) {
    #header_affix {
        position: absolute!important;
        z-index: 120;
    }
    #above_header .alignleft,
    #above_header .alignright:not(.above_mobile) {
        display: none;
    }
    #above_header .alignright.above_mobile {
        display: block;
    }
    #wrap_header {
        position: absolute;
    }
    body.header-centered #home-link-wrap {
        width: auto;
    }
    header#masthead .home-link h2.site-description {
        display: none;
    }
    #expand-menu,
    #expand-social,
    #expand-mobile-cart {
        display: block;
    }
    #navbar {
        float: none;
    }
    body.header-centered header#masthead #navbar {
        clear: none;
        height: 100%;
        left: auto;
        position: relative;
        right: 10px;
        width: auto;
    }
    body.header-centered header#masthead #navbar #expand-menu,
    body.header-centered header#masthead #navbar #expand-mobile-cart {
        margin-top: 0;
    }
    #navbar > nav {
        float: left;
    }
    #navbar > nav#site-navigation {
        display: none;
    }
    #page .entry-header #bgTitle {
        background-attachment: scroll!important;
        background-position: 50%!important;
    }
    .slideshine_prev, .slideshine_next, .slideshine_pie_bg {
        display: none;
    }
    .slideshine_play_pause,
    .slideshine_pie,
    .slideshine_waiter .spinner,
    .slideshine_pie_bg {
        bottom: 10px;
        opacity: 1;
        top: auto;
    }
    .slideshine_bullets {
        display: none!important;
    }
    .slideshine_waiter {
        bottom: 0;
        top: auto;
    }
    .slideshine_fontsized {
        font-size: 24px!important;
    }
}
body.header-centered header#masthead #navbar {
    border-top: 1px solid $navbar_border;
}
hr {
    background: $border_color;
}
hr.circled::after {
    background-color: $page_bg_color;
    border-color: $border_color;
}
input[type=\"text\"],
input[type=\"password\"],
input[type=\"email\"],
input[type=\"url\"],
input[type=\"datetime\"],
input[type=\"search\"],
input[type=\"tel\"],
input[type=\"url\"],
textarea,
select[multiple],
input.input-text,
#subscribe-email input,
.select2-container > a {
    background: $input_bg;
    border-color: $border_color;
    color: $body_color;
}
input[type=\"text\"]:focus,
input[type=\"password\"]:focus,
input[type=\"email\"]:focus,
input[type=\"url\"]:focus,
input[type=\"search\"]:focus,
input[type=\"datetime\"]:focus,
input[type=\"tel\"]:focus,
input[type=\"url\"]:focus,
select[multiple]:focus,
textarea:focus {
    border-color: $alternative_border;
}
input[type=\"text\"].wpcf7-not-valid,
input[type=\"password\"].wpcf7-not-valid,
input[type=\"email\"].wpcf7-not-valid,
input[type=\"url\"].wpcf7-not-valid,
input[type=\"search\"].wpcf7-not-valid,
input[type=\"datetime\"].wpcf7-not-valid,
input[type=\"search\"].wpcf7-not-valid,
input[type=\"tel\"].wpcf7-not-valid,
input[type=\"url\"].wpcf7-not-valid,
textarea.wpcf7-not-valid,
select[multiple].wpcf7-not-valid,
input.input-text.wpcf7-not-valid,
#subscribe-email input.wpcf7-not-valid {
    border-bottom-color: $error_color;
}
input[type=\"checkbox\"],
input[type=\"radio\"] {
    background: $page_bg_color;
    border-color: $alternative_border;
    -webkit-box-shadow: inset 0 1px 2px rgba(".pix_hex2rgbcompiled($body_color).",.1);
    box-shadow: inset 0 1px 2px rgba(".pix_hex2rgbcompiled($body_color).",.1);
    color: $body_color;
}
input[type=\"radio\"]:checked::before {
    background: $body_color;
}
.wpcf7-not-valid input[type=\"checkbox\"] {
    border-bottom-color: $error_color;
}
.slider_div .ui-slider-horizontal {
    background-color: rgba(".pix_hex2rgbcompiled($body_color).",.1);
}
.slider_div .ui-slider-horizontal a,
.slider_div .ui-slider-horizontal span {
    background-color: $page_bg_color;
    border-color: $border_color;
}
.slider_div .ui-slider-range {
    background-color: $featured_color;
}

.ui-widget {
    background: $body_color;
    box-shadow: 0 1px 3px rgba(".pix_hex2rgbcompiled($body_color).",.5);
    color: $page_bg_color;
}
.ui-datepicker-header {
    border-bottom: 1px solid $tiny_color;
}
.ui-datepicker th {
    color: $page_bg_color;
}
td .ui-state-default {
    color: $page_bg_color;
}
td .ui-state-active,
td .ui-state-hover {
    background: $tiny_color;
}
#page .bootstrap-filestyle label[for*=\"filestyle\"],
#page .bootstrap-filestyle .btn {
    background-color: $featured_color;
    color: $page_bg_color;
}
.wpcf7 img.wpcf7-captchac {
    border: 1px solid $border_color;
}

@media (max-width: 800px) {
    aside#secondary,
    aside#extra-secondary {
        background: $page_bg_color;
        border-color: $border_color;
        -moz-box-shadow: 0 0 20px rgba(".pix_hex2rgbcompiled($body_color).",.35);
        -webkit-box-shadow: 0 0 20px rgba(".pix_hex2rgbcompiled($body_color).",.35);
        box-shadow: 0 0 20px rgba(".pix_hex2rgbcompiled($body_color).",.35);
    }
    aside#secondary + a.toggle_aside,
    aside#extra-secondary + a.toggle_aside {
        background: rgba($scroll_bg,$scroll_opacity);
        color: $scroll_color;
    }
}
#primary a,
aside#secondary a,
aside#extra-secondary a,
#cboxLoadedContent a {
    color: $link_color;
}
#primary a:hover,
aside#secondary a:hover,
aside#extra-secondary a:hover,
#cboxLoadedContent a:hover {
    color: $link_hover;
}
aside#secondary .pix_widget li,
aside#extra-secondary .pix_widget li {
    border-bottom-color: $border_color;
}
.search .post-type {
    border-color: $border_color;
    color: $tiny_color;
}
.single-post .entry-content::after {
    background: $border_color;
}
@media (max-width: 568px) {
    .single-post .entry-content span.entry-date {
        border-bottom-color: $border_color;
    }
}
.single-post .entry-text {
    font-family: $single_font;
    font-size: $single_font_size;
    font-style: $single_font_style;
    font-weight: $single_font_weight;
}
.single .tag-links,
.single .cat-links {
    border-top-color: $border_color;
}
#primary .comment-list li .reply > a {
    background: rgba(".pix_hex2rgbcompiled($body_color).",.1);
    color: $tiny_color;
}
#primary .comment-reply-title small > a {
    background: rgba(".pix_hex2rgbcompiled($body_color).",.1);
    color: $tiny_color;
}
#primary .comment-metadata a {
    color: $tiny_color;
}
.comment-list li .comment-content {
    border-bottom-color: $border_color;
}
.form-allowed-tags {
    border-bottom-color: $border_color;
}
#scroll-down,
#scroll-up,
.post-navigation .alignleft,
.post-navigation .alignright {
    background: rgba($scroll_bg,$scroll_opacity);
    color: $scroll_color;
}
.post-navigation .alignleft::after,
.post-navigation .alignright::after {
    color: $scroll_color;
}
.slideshine_thumbs_scroller {
    background: $body_color;
}
body.page-template-templatesfront-page-php:not(.transparent-header) #main .entry-content .row[data-extra=\"fullscreen\"]:first-child > .row-inside:first-child > .column:first-child,
body.page-template-templatesfront-page-php:not(.transparent-header) #main .entry-content .row[data-extra=\"fullwidth\"]:first-child > .row-inside:first-child > .column:first-child {
    padding-top: ".($get_header_height+$get_header_top)."px;
}
@media (min-width: 1025px) {
    body.page-template-templatesfront-page-php #main .entry-content .row[data-extra=\"fullscreen\"].first-slideshow.fixed:first-child,
    body.page-template-templatesfront-page-php #main .entry-content .row[data-extra=\"fullwidth\"].first-slideshow.fixed:first-child {
        top: -".$data_affix."px;
    }
}
body.page-template-templatesfront-page-php.header-centered:not(.transparent-header) #main .entry-content .row[data-extra=\"fullscreen\"]:first-child > .row-inside:first-child > .column:first-child,
body.page-template-templatesfront-page-php.header-centered:not(.transparent-header) #main .entry-content .row[data-extra=\"fullwidth\"]:first-child > .row-inside:first-child > .column:first-child {
    padding-top: ".($get_header_height+$get_header_top+$get_navbar_h)."px;
}
/*@media (min-width: 1025px) {
    body.page-template-templatesfront-page-php.header-centered:not(.transparent-header) #main .entry-content .row[data-extra=\"fullscreen\"].first-slideshow.fixed:first-child,
    body.page-template-templatesfront-page-php.header-centered:not(.transparent-header) #main .entry-content .row[data-extra=\"fullwidth\"].first-slideshow.fixed:first-child {
        top: -".(($get_header_height+$get_navbar_h+$get_header_top)-$get_header_height_scrolled)."px;
    }
}*/
body.loaded #mobile-navigation {
    background-color: $nav2nd_bg;
    border-top: 3px solid $nav2nd_border2;
    top: ".($get_header_height+$get_header_top)."px;  
}
@media (max-width: ".get_option('pix_style_nav_mobile_size')."px) {
    body.page-template-templatesfront-page-php:not(.transparent-header) #main .entry-content .row[data-extra=\"fullscreen\"]:first-child > .row-inside:first-child > .column:first-child,
    body.page-template-templatesfront-page-php.header-centered:not(.transparent-header) #main .entry-content .row[data-extra=\"fullscreen\"]:first-child > .row-inside:first-child > .column:first-child,
    body.page-template-templatesfront-page-php:not(.transparent-header) #main .entry-content .row[data-extra=\"fullwidth\"]:first-child > .row-inside:first-child > .column:first-child,
    body.page-template-templatesfront-page-php.header-centered:not(.transparent-header) #main .entry-content .row[data-extra=\"fullwidth\"]:first-child > .row-inside:first-child > .column:first-child {
        padding-top: ".($get_header_height_scrolled+$get_header_top)."px;
    }
    body.loaded #mobile-navigation {
        top: ".($get_header_height_scrolled+$get_header_top)."px!important;
    }
}
body.loaded.header-centered #mobile-navigation {
    top: ".($get_header_height+$get_header_top+$get_navbar_h)."px;
}
body.single-format-aside #main .site-content,
body.single-format-status #main .site-content {
    margin-top: ".($get_header_height+$get_header_top)."px;
}
body.single-format-aside.header-centered #main .site-content,
body.single-format-status.header-centered #main .site-content {
    margin-top: ".($get_header_height+$get_header_top+$get_navbar_h)."px;
}
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .pix_slideshine .slideshine_slides,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .pix_slideshine .slideshine_slides {
    -moz-border-radius-topleft: $page_radius;
    -moz-border-radius-topright: $page_radius;
    border-top-left-radius: $page_radius;
    border-top-right-radius: $page_radius;
}
body.page-template-templatesfront-page-php:not(.transparent-header) #main .entry-content .row:not([data-extra=\"fullscreen\"]):not([data-extra=\"fullwidth\"]):first-child {
    padding-top: ".($get_header_height+$get_header_top)."px;
}
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .pix_slideshine .slideshine_slides .slideshineSlide,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .pix_slideshine .slideshine_slides .slideshineSlide {
    padding-top: ".($get_header_height+$get_header_top)."px;
}
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .pix_slideshine .slideshine_slides .slideshineSlide div[data-opts],
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .pix_slideshine .slideshine_slides .slideshineSlide div[data-opts] {
    margin-top: -".($get_header_height+$get_header_top)."px;
}
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_play_pause,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_pie_bg,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_pie,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_waiter .spinner,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_play_pause,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_pie_bg,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_pie,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_waiter .spinner {
    margin-top: ".($get_header_height+$get_header_top)."px;
}
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_next,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_prev,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_next,
body.page-template-templatesfront-page-php.transparent-header #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_prev {
    -webkit-transform: translateY(".(($get_header_height+$get_header_top)/3)."px);
    -moz-transform: translateY(".(($get_header_height+$get_header_top)/3)."px);
    -ms-transform: translateY(".(($get_header_height+$get_header_top)/3)."px);
    -o-transform: translateY(".(($get_header_height+$get_header_top)/3)."px);
    transform: translateY(".(($get_header_height+$get_header_top)/3)."px);
}
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_play_pause,
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_pie_bg,
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_pie,
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_waiter .spinner,
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_play_pause,
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_pie_bg,
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_pie,
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_waiter .spinner {
    margin-top: ".($get_header_height+$get_header_top+$get_navbar_h)."px;
}
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_next,
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullscreen\"]:first-child .slideshine_prev .spinner,
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_next,
body.page-template-templatesfront-page-php.transparent-header.header-centered #main .entry-content .row[data-extra=\"fullwidth\"]:first-child .slideshine_prev {
    -webkit-transform: translateY(".(($get_header_height+$get_header_top+$get_navbar_h)/3)."px);
    -moz-transform: translateY(".(($get_header_height+$get_header_top+$get_navbar_h)/3)."px);
    -ms-transform: translateY(".(($get_header_height+$get_header_top+$get_navbar_h)/3)."px);
    -o-transform: translateY(".(($get_header_height+$get_header_top+$get_navbar_h)/3)."px);
    transform: translateY(".(($get_header_height+$get_header_top+$get_navbar_h)/3)."px);
}
#main header.entry-header {
    background-color: $title_bgcolor;
    color: $title_color;
    padding-top: ".($get_header_height+$get_header_top)."px!important;
}
#main header.entry-header .pix_maps div.gm-style > div:not(:first-child) {
    margin-top: ".($get_header_height+$get_header_top)."px!important;
}
body.header-centered #main header.entry-header {
    padding-top: ".($get_header_height+$get_header_top+$get_navbar_h)."px!important;
}
body.header-centered #main header.entry-header .pix_maps div.gm-style > div:not(:first-child) {
    margin-top: ".($get_header_height+$get_header_top+$get_navbar_h)."px!important;
}
@media (max-width: ".get_option('pix_style_nav_mobile_size')."px) {
    header.entry-header,
    body.header-centered #main header.entry-header {
        height: ".($get_header_height_scrolled+$get_header_top+60)."px; 
        padding-top: ".($get_header_height_scrolled+$get_header_top)."px!important;
    }
    header.entry-header .pix_maps div.gm-style > div:not(:first-child),
    body.header-centered #main header.entry-header .pix_maps div.gm-style > div:not(:first-child) {
        margin-top: ".($get_header_height_scrolled+$get_header_top+5)."px!important;
    }
}
header.entry-header .entry-title {
    color: $title_color;
}
ul.page-numbers, .page-links {
    background: $page_bg_color;
    border-bottom-color: $border_color;
    border-top-color: $border_color;
}
ul.page-numbers .current, .page-links > span {
    background: rgba(".pix_hex2rgbcompiled($body_color).",.1);
}
.gallery .gallery-item .sc-bg-fancy {
    background: rgba(".pix_hex2rgbcompiled($page_bg_color).",.9);
}
.gallery .gallery-item .sc-bg-fancy::after {
    border-color: $body_color;
}
.customSelect {
    background: $page_bg_color;
    border-color: $border_color;
}
.customSelect.wpcf7-not-valid {
    border-bottom-color: $error_color;
}
.widget_calendar tbody td {
    border: 1px solid $page_bg_color
}
.widget_calendar tbody td a {
    background: $featured_color;
    color: $page_bg_color!important;
}
.widget_calendar tfoot td {
    border-top-color: $border_color;
}
.widget_calendar tbody td#today {
    color: $page_bg_color!important;
}
.widget_calendar tbody td#today::before {
    background: $featured_color_alt;
}
table.compare-list {
    border-color: $border_color;
}
table.compare-list td {
    background: $page_bg_color;
    border-color: $border_color;
}
.shop_table th, .shop_table td, .cart_totals {
    border-bottom-color: $border_color;
}
.cart_totals h2 {
    border-bottom-color: $border_color;
}
.cart_totals th,
.cart_totals td {
    border-bottom-color: $border_color;
}
.commentlist li .comment-text {
    border-bottom-color: $border_color;
}
#main .bx-wrapper .bx-controls-direction a,
#main #related-items-section .owl2-controls .owl2-nav > div {
    background: $border_color;
    color: $page_bg_color!important;
}
.bx-wrapper .bx-viewport::after,
.bx-wrapper .bx-viewport::before {
    background: $page_bg_color;
}
.bx-wrapper .bx-pager.bx-default-pager a {
    background: $border_color;
    border-color: $border_color;
}
.bx-wrapper .bx-controls-auto .bx-start, .bx-wrapper .bx-controls-auto .bx-stop {
    color: $border_color!important;
}
div[role=\"list\"].products div[role=\"listitem\"] > div,
.pixgridder div[role=\"list\"].products div[role=\"listitem\"].column > div {
    background: $page_bg_color;
}
@media (min-width: 1025px) {
    div[role=\"list\"].products div[role=\"listitem\"]:hover > div,
    .pixgridder div[role=\"list\"].products div[role=\"listitem\"].column:hover > div {
        -webkit-box-shadow: 0 0 10px rgba(".pix_hex2rgbcompiled($body_color).",.3);
        box-shadow: 0 0 10px rgba(".pix_hex2rgbcompiled($body_color).",.3);
    }
}
@media (max-width: 1024px) {
    div[role=\"list\"].products div[role=\"listitem\"] > div,
    .pixgridder div[role=\"list\"].products div[role=\"listitem\"].column > div {
        border-bottom: 1px solid $border_color;
    }
}
.woocommerce div[role=\"list\"].products div[role=\"listitem\"] .price,
table.compare-list td .price,
.woocommerce .summary.entry-summary .price {
    font-family: $alternative_font;
}
div[role=\"list\"].products div[role=\"listitem\"] .onsale {
    background: ".get_option('pix_style_shop_onsale_bg').";
    color: ".get_option('pix_style_shop_onsale_color').";
}
div[role=\"list\"].products div[role=\"listitem\"] .pix-woo-gallery-navig {
    background: $border_color;
    color: $body_color;
}
.star-rating, p.stars,
.fe_wrapp_stars div.unselected_star::before {
    color: $body_color;
}
div[role=\"list\"].products div[role=\"listitem\"] .pix-woo-gallery-prev {
    color: $body_color;
}
div[role=\"list\"].products div[role=\"listitem\"] .pix-woo-gallery-next {
    color: $body_color;
}
.shop_table td.product-remove a {
    color: $page_bg_color!important;
}
.chosen-container .chosen-drop {
    background-color: $page_bg_color;
    border-color: $border_color;
    color: $body_color;
}
table.compare-list td.odd {
    background: $input_bg;
}
.shop_table td.product-remove a {
    background: $tiny_color;
}
.woocommerce-checkout .form-row .chosen-container-single .chosen-single {
    background: $page_bg_color;
    border-color: $border_color;
}
.chosen-container .chosen-drop input[type=\"text\"] {
    background: $page_bg_color!important; 
}
form.checkout .payment_methods {
    border-bottom-color: $border_color;
}
form.checkout .payment_methods .payment_box {
    background: $input_bg;
}
form.checkout .payment_methods .payment_box::after {
    border-bottom-color: $input_bg;
}
.widget_price_filter .ui-slider-horizontal {
    background-color: rgba(".pix_hex2rgbcompiled($body_color).",.1);
}
.widget_price_filter .ui-slider-horizontal a,
.widget_price_filter .ui-slider-horizontal span {
    background-color: $page_bg_color;
    border-color: $border_color;
}
.widget_price_filter .ui-slider-range {
    background-color: $featured_color_alt;
}
.widget_top_rated_products li,
.widget_recent_reviews li,
.widget_recently_viewed_products li,
.widget_products li,
.widget_shopping_cart_content li {
    border-bottom-color: $border_color!important;
}
header#masthead #navbar .widget_top_rated_products li,
header#masthead #navbar .widget_recent_reviews li,
header#masthead #navbar .widget_recently_viewed_products li,
header#masthead #navbar .widget_products li,
header#masthead #navbar .widget_shopping_cart_content li {
    border-bottom-color: $nav2nd_border2!important;
}
.pix-quick-view #woocommerce-main-image-wrapper {
    border-color: $border_color;
}
.pix-quick-view .woocommerce-main-image.loading {
    background-color: $body_color;
}
.summary.entry-summary form.cart {
    border-bottom-color: $border_color;
    border-top-color: $border_color;
}
.quantity.buttons_added input[type=\"number\"] {
    background: $page_bg_color;
    border-color: $border_color;
}
.quantity.buttons_added input[type=\"button\"] {
    background: $page_bg_color;
    border-color: $border_color;
}
.thumbnails a {
    border-color: $border_color;
}
.thumbnails a.selected {
    border-color: $featured_color;
}
.placeholder-image {
    background-color: $body_color;
    opacity: .1;
}
.upsells.products > h2::after,
.related.products > h2::after,
.cross-sells > h2::after,
#related-items-title::after,
.title-line::before,
.title-line::after {
    background: $border_color;
}
#related-items-section article {
    border-color: $border_color;
}
#related-items-section .entry-summary {
    border-top-color: $border_color;
}
.category-list {
    color: $tiny_color;
}
div.sharedaddy div.sd-block {
    border-top-color: $border_color!important;
}
.sc-position-below .slideshine_prev,
.sc-position-below .slideshine_next {
    background: $page_bg_color!important;
    color: $body_color!important;
}
.sc-position-fancy .slideshine_prev,
.sc-position-fancy .slideshine_next {
    background: $body_color!important;
    color: $page_bg_color!important;
}
.sc-layout .sc-grid article.hentry .sc-bg-fancy {
    background: rgba(".pix_hex2rgbcompiled($page_bg_color).",.98);
    color: $body_color;
}
.sc-position-fancy a.sc-enlarge.sc-iconaction {
    background: $body_color;
    color: $page_bg_color!important;
}
.sc-position-below a.sc-enlarge.sc-iconaction {
    background: $page_bg_color;
    color: $body_color!important;
}
.sc-wrap-video-resp {
    background: $body_color;
}
.grid-blog article > .row {
    background: $page_bg_color;
    border-color: $border_color
}
article.post.sticky::before {
    background: $input_bg;
    border: 1px solid $border_color
}
#main .grid-blog article.post.sticky > .row {
    background-color: $input_bg;
}
.grid-blog article .entry-meta,
.sc-layout .sc-grid article.post-portfolio-below .entry-meta {
    border-top-color: $border_color
}
.single #primary .entry-meta a {
    color: $tiny_color;
}
.gallery-caption.sc-bg-hover {
    background: rgba(".pix_hex2rgbcompiled($body_color).",.95);
    color: $page_bg_color;
}
.archive-list .entry-meta {
    border-bottom-color: $border_color;
    color: $tiny_color;
}
.tagcloud a,
.sc-layout .sc-portfolio-filters a {
    background: $body_color;
    color: $page_bg_color!important;
}
.tagcloud a:hover,
.sc-layout .sc-portfolio-filters a:hover {
    background: $tiny_color;
}
.sc-layout .sc-portfolio-filters {
    color: $link_color;
}
.sc-layout .sc-portfolio-filters strong {
    color: $body_color;
}
.sc-layout .sc-portfolio-filters a.selected {
    background: transparent!important;
    color: $body_color!important;
}
.sc-layout .sc-portfolio-filters a.selected::after {
    background: $featured_color;
}
.gallery .gallery-item .sc-bg-fancy {
    color: $page_bg_color;
}
.gallery-slideshine .slideshine_caption,
.gallery-slideshine .pixlightfx {
    color: $page_bg_color;
}
.gallery-slideshine .pixlight {
    background-color: rgba(".pix_hex2rgbcompiled($body_color).",.8)!important;
    color: $page_bg_color;
}
.tabedelic.simple > .tabedelic-headers > .header-active::before {
    background: $featured_color;
}
.tabedelic > .tabedelic-headers > .tabedelic-header {
    background: $input_bg;
    border: 1px solid $border_color;
}
.tabedelic.simple > .tabedelic-headers > .header-active::after {
    background: $page_bg_color;
}
.tabedelic .tabedelic-panel,
.tabedelic > .tabedelic-headers > .header-active {
    background: $page_bg_color;
    color: $body_color;
}
.tabedelic .tabedelic-panel {
    border-color: $border_color;
}
#page .pix_progress_bar .chart-amount,
#page .pix_progress_bar .chart-label,
#page .pix_progress_pie .chart-label {
    background: $body_color;
    color: $page_bg_color;
}
.pix_progress_bar .chart-amount::after {
    border-top: 5px solid $body_color;
}
#page .testi-wrapper .quotes,
#page .testi-wrapper .testi-details .testi-text .testi-name,
#page .testi-wrapper .testi-details .testi-text .testi-job,
#page .testi-wrapper .testi-details .testi-text .testi-company {
    font-family: $body_font_family!important;
}
#page .testi-wrapper .testi-job,
#page .testi-wrapper .testi-job > a {
    color: $featured_color_alt!important;
}
#page .testi-wrapper .testi-details .testi-text .testi-name {
    color: $featured_color_alt!important;
}
#page .theme_1 .testi-wrapper .quotes {
    background-color: rgba(".pix_hex2rgbcompiled($body_color).",.1)!important;
    color: $body_color!important;
}
#page .theme_1 .testi-wrapper .quotes a,
#page .theme_1 .testi-wrapper .quotes a:hover {
    color: $body_color!important;
}
#page .theme_1 .testi-wrapper .testi-details::after {
    border-top-color: $body_color!important;
    opacity: .1;
}
#page .theme_2 .testi-wrapper .quotes,
#page .theme_3 .testi-wrapper .quotes {
    background-color: rgba(".pix_hex2rgbcompiled($body_color).",.85)!important;
    color: $input_bg!important;
}
#page .theme_2 .testi-wrapper .quotes a,
#page .theme_2 .testi-wrapper .quotes a:hover,
#page .theme_3 .testi-wrapper .quotes a,
#page .theme_3 .testi-wrapper .quotes a:hover {
    color: $input_bg!important;
}
#page .theme_2 .testi-wrapper .quotes::after {
    border-bottom-color: $body_color!important;
    opacity: .85!important;
}
#page .theme_3 .testi-wrapper .quotes::after {
    border-right-color: $body_color!important;
    opacity: .85!important;
}
#page .theme_4 .testi-wrapper .quotes a,
#page .theme_4 .testi-wrapper .quotes a:hover,
#page .theme_4 .fa-quote-right::before,
#page .theme_5 .testi-wrapper .quotes a,
#page .theme_5 .testi-wrapper .quotes a:hover,
#page .theme_6 .testi-wrapper .quotes a,
#page .theme_6 .testi-wrapper .quotes a:hover,
#page .theme_7 .testi-wrapper .quotes a,
#page .theme_7 .testi-wrapper .quotes a:hover {
    color: $body_color!important;
}
#page .member-skills-wrapper .skill-prog {
    background-color: $border_color!important;
}
#page .member-skills-wrapper .skill-prog .fill {
    background-color: $featured_color_alt!important;
}
#page .member-email,
#page .member-web,
#page .member-phone,
#page .member-location {
    color: $tiny_color!important;
}
#page .member-social a:not(:hover) i {
    color: $tiny_color!important;
}
#page .ict_wrapp ul li,
#page .member-name,
#page .member-name a,
#page .member-desc,
#page .member-skills-wrapper .skill-label {
    font-weight: $body_font_weight!important;
}
#page .theme_1 .member-name,
#page .theme_2 .member-name,
#page .theme_10 .member-name {
    background-color: $body_color!important;
    color: $page_bg_color!important;
}
#page .theme_1 .member-name span,
#page .theme_2 .member-name span,
#page .theme_10 .member-name span,
#page .theme_5 .member-job {
    background-color: $featured_color_alt!important;
    color: $page_bg_color!important;
}
#page .theme_3 .member-social {
    background: rgba(" . pix_hex2rgbcompiled($body_color) .",.8)!important;
}
#page .theme_3 .member-social a,
#page .theme_3 .member-social a i,
#page .theme_4 .member-job {
    color: $page_bg_color!important;
}
#page .theme_3 .member-job {
    color: $tiny_color!important;
}
#page .theme_3 .member-desc:before {
    background: $tiny_color!important;
    opacity: 1;
}
#page .theme_4 .member-social a i {
    color: $tiny_color!important;
}
#page .theme_4 .member-social a:hover i {
    color: $page_bg_color!important;
}
#page .theme_5 .member-desc {
    background: rgba(" . pix_hex2rgbcompiled($body_color) . ",.8)!important;
    color: $page_bg_color!important;
}
#page .theme_6 .ict_wrapp ul li:hover .member-content{
    background-color: $input_bg!important;
}
#page .theme_6 .ict_wrapp ul li:hover .member-content:before{
    border-bottom-color: $input_bg!important;
}
#page .theme_7 .member-desc:before {
    background-color: $featured_color_alt!important;
    filter: alpha(opacity=100);
    opacity: 1;
}
#page .theme_7 .member-content {
    background-color: $input_bg!important;
    border: 1px solid $border_color!important;
}
#page .theme_7 .ict_wrapp ul li:hover .member-content{
    background-color: $featured_color_alt!important;
}
#page .theme_8 .member-social a i {
    border: 1px solid $page_bg_color!important;
    color: $page_bg_color!important;
}
#page .theme_8 .member-social-wrapper {
    background: rgba(" . pix_hex2rgbcompiled($body_color) . ", .8);
}
#page .theme_8 .member-desc:before {
    background: $featured_color_alt!important;
}
#page .owl-theme .owl-controls .owl-page span {
    background: $tiny_color!important;
}
#page .owl-theme .owl-controls .owl-buttons div {
    background: $tiny_color!important;
    color: $page_bg_color!important;
}

.pix_box {
    border: {$default_box_border_w}px solid $default_box_border_color;
    -moz-border-radius: {$default_box_radius}px;
    border-radius: {$default_box_radius}px;
    background-color: $default_box_bg;
    color: $default_box_color;
    $default_box_style
}
.pix_box.success, .woocommerce-message {
    border: {$success_box_border_w}px solid $success_box_border_color;
    -moz-border-radius: {$success_box_radius}px;
    border-radius: {$success_box_radius}px;
    background-color: $success_box_bg;
    color: $success_box_color;
    $success_box_style
}
.pix_box.error, .woocommerce-error {
    border: {$error_box_border_w}px solid $error_box_border_color;
    -moz-border-radius: {$error_box_radius}px;
    border-radius: {$error_box_radius}px;
    background-color: $error_box_bg;
    color: $error_box_color;
    $error_box_style
}
.pix_box .close-box-sc {
    background: $page_bg_color;
    color: $body_color;
}
#page .imtst_msg-err {
    color: $$error_color;
}
#qLbar::after {
    box-shadow: 0 0 10px $featured_color, 0 0 5px $featured_color;
}
.spinloader {
    border-top-color: $featured_color;
}
.spinloader::before {
    background: $featured_color;
}
.spinloader::after {
    background: $featured_color;
}
.woocommerce .woocommerce_after_shop_loop_item_title {
    background-color: $input_bg;
    border-bottom: 1px solid $border_color;
    border-top: 1px solid $border_color;
}
.woocommerce .products .price ins,
.woocommerce .products .price > .amount,
.woocommerce .order-total .amount {
    color: $featured_color;
}
.woocommerce .product-type-grouped .h5 {
    border-color: $border_color;
}
.widget_shopping_cart_content .quantity .amount {
    color: $featured_color_alt;
}
.widget_shopping_cart_content .total {
    background-color: $input_bg;
}
#above_header .widget_shopping_cart_content .total,
#navbar .widget_shopping_cart_content .total {
    background-color: $nav2nd_hover_bg;
    color: $nav2nd_color;
}
.woocommerce .yith-wcwl-wishlistaddedbrowse > a,
.woocommerce .yith-wcwl-wishlistexistsbrowse > a {
    color: $featured_color;
}
.woocommerce .yith-wcwl-wishlistexistsbrowse > a {
    color: $featured_color!important;
}
.woocommerce .compare.button.added, .woocommerce .compare.added {
    color: $featured_color!important;
}
.reset_variations,
.product_meta a {
    color: $tiny_color;
}
.quantity.buttons_added input[type=\"button\"] {
    color: $body_color;
}
.sc-layout .sc-grid article.hentry .sc-bg-fancy .sc-title::after {
    border-top-color: $body_color;
}
#cboxOverlay{
    background: $cbox_overlay;
}
#cboxContent {
    background: $cbox_content;
}
.cBox-quick-view #cboxContent {
    background: $page_bg_color;
}
.cboxIframe {
    background: $page_bg_color;
}
#cboxTitle {
    color: $cbox_color;
}
#geode_cboxClose::before, #geode_cboxClose::after {
    background: $cbox_buttons;
}
#cboxPrevious, #cboxNext,
#geode_cboxPrevious, #geode_cboxNext {
    border-color: $cbox_buttons;
}
#geode-social-overlay {
    background: rgba(".pix_hex2rgbcompiled($cbox_overlay).",.85);
}
#geode-social-overlay .top_bar,
#geode-social-overlay .top_bar * {
    color: $cbox_color!important;
}

#geode-social-overlay .close-geode-overlay::before,
#geode-social-overlay .close-geode-overlay::after {
    background: $cbox_color;
}
.shortcodelic_font_list div.the-icons {
    background-color: $input_bg;
    border: 1px solid $featured_color_alt;
    color: $body_color;
}
.shortcodelic_font_list div.the-icons:hover {
    background-color: $page_bg_color;
}
";

    $css .= "body .pix_button, body .buttonelic, body button:not([aria-controls]), body input[type=\"submit\"], body #infinite-handle,
/*html.no-touch */body .buttonelic:hover, body .buttonelic:active, body .buttonelic:visited, #primary .cart_totals .button, #primary .cart .button {
    background-color: ".stripslashes(get_option('pix_style_button_default_bg')).";
    border: ".stripslashes(get_option('pix_style_button_default_borderwidth'))."px solid ".stripslashes(get_option('pix_style_button_default_bordercolor')).";
    color: ".stripslashes(get_option('pix_style_button_default_color')).";
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_default_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_default_borderradius'))."px;
    font-family: $body_font_family!important;
}
body .pix_button > span:first-child, body .buttonelic > span:first-child, body button:not([aria-controls]) > span:first-child, body #infinite-handle > span:first-child {
    color: ".stripslashes(get_option('pix_style_button_default_color')).";
}";

    if ( stripslashes(get_option('pix_style_button_default_icon')) == 'hover' ) {
    $css .= "/*html.no-touch */body .pix_button:hover > span:first-child, /*html.no-touch */body .buttonelic:hover > span:first-child, /*html.no-touch */body button:not([aria-controls]):hover > span:first-child, /*html.no-touch */body input[type=\"submit\"]:hover, /*html.no-touch */#primary .cart_totals .button:hover, /*html.no-touch */#primary .cart .button:hover {
    color: ".stripslashes(get_option('pix_style_button_default_bg')).";
    -webkit-transform: scale(0,0);
    transform: scale(0,0);
}
body .pix_button [class*=\"scicon-\"], body .buttonelic [class*=\"scicon-\"], body button:not([aria-controls]) [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_default_bg')).";
    display: block;
    height: 100%;
    left: 0;
    position: absolute;
    text-align: center;
    width: 100%;
    top: 2em;
    z-index: 1;
}
/*html.no-touch */body .pix_button:hover [class*=\"scicon-\"], /*html.no-touch */body .buttonelic:hover [class*=\"scicon-\"], /*html.no-touch */body button:not([aria-controls]):hover [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_default_texthover')).";
    top: 0;
}
"; } else {
    $css .= "/*html.no-touch */body .pix_button:hover > span:first-child, /*html.no-touch */body .buttonelic:hover > span:first-child, /*html.no-touch */body button:not([aria-controls]):hover > span:first-child, /*html.no-touch */body input[type=\"submit\"]:hover, /*html.no-touch */#primary .cart_totals .button:hover, /*html.no-touch */#primary .cart .button:hover, /*html.no-touch */body #infinite-handle:hover > span:first-child {
    color: ".stripslashes(get_option('pix_style_button_default_texthover')).";
}
";
    }

    if ( stripslashes(get_option('pix_style_button_default_fx')) == 'expand' ) {
    $css .= "body .pix_button > span:last-child, body .buttonelic > span:last-child, body button:not([aria-controls]) > span:last-child, body #infinite-handle > span:last-child {
    background-color: ".stripslashes(get_option('pix_style_button_default_bghover')).";
    bottom: 0;
    top: 0;
}
/*html.no-touch */body .pix_button:hover > span:last-child, /*html.no-touch */body .buttonelic:hover > span:last-child, /*html.no-touch */body button:not([aria-controls]):hover > span:last-child, /*html.no-touch */body #infinite-handle:hover > span:last-child {
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_default_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_default_borderradius'))."px;
    left: 0;
    opacity: 1;
    right: 0;
}
/*html.no-touch */body .pix_button:hover, body .buttonelic:hover, /*html.no-touch */body button:not([aria-controls]):hover, /*html.no-touch */body #infinite-handle:hover {
    border-color: ".stripslashes(get_option('pix_style_button_default_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_default_texthover'))."!important;
}
/*html.no-touch */body input[type=\"submit\"]:hover,
/*html.no-touch */#primary .cart_totals .button:hover,
/*html.no-touch */#primary .cart .button:hover {
    background-color: ".stripslashes(get_option('pix_style_button_default_bghover')).";
    border-color: ".stripslashes(get_option('pix_style_button_default_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_default_texthover'))."!important;
}
"; } else {
    $css .= "
/*html.no-touch */body .pix_button:hover, /*html.no-touch */body .buttonelic:hover, /*html.no-touch */body button:not([aria-controls]):hover, /*html.no-touch */body input[type=\"submit\"]:hover, /*html.no-touch */#primary .cart_totals .button:hover, /*html.no-touch */#primary .cart .button:hover, /*html.no-touch */body #infinite-handle:hover {
    background-color: ".stripslashes(get_option('pix_style_button_default_bghover')).";
    border-color: ".stripslashes(get_option('pix_style_button_default_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_default_texthover')).";
}
"; }

    $css .= "body .pix_button.pix_button_2, body .buttonelic.default2 {
    background-color: ".stripslashes(get_option('pix_style_button_default2_bg')).";
    border: ".stripslashes(get_option('pix_style_button_default2_borderwidth'))."px solid ".stripslashes(get_option('pix_style_button_default2_bordercolor')).";
    color: ".stripslashes(get_option('pix_style_button_default2_color')).";
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_default2_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_default2_borderradius'))."px;
}
body .pix_button.pix_button_2 > span:first-child, body .buttonelic.default2 > span:first-child {
    color: ".stripslashes(get_option('pix_style_button_default2_color')).";
}
".stripslashes(get_option('pix_style_button_default2_style'));

if ( stripslashes(get_option('pix_style_button_default2_icon')) == 'hover' ) {
    $css .= "/*html.no-touch */body .pix_button.pix_button_2:hover > span:first-child, /*html.no-touch */body .buttonelic.default2:hover > span:first-child {
    color: ".stripslashes(get_option('pix_style_button_default2_bg')).";
    -webkit-transform: scale(0,0);
    transform: scale(0,0);
}
body .pix_button.pix_button_2 [class*=\"scicon-\"], body buttonelic.default2 [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_default2_color')).";
    display: block;
    height: 100%;
    left: 0;
    position: absolute;
    text-align: center;
    width: 100%;
    top: 2em;
    z-index: 1;
}
/*html.no-touch */body .pix_button.pix_button_2:hover [class*=\"scicon-\"], /*html.no-touch */body .buttonelic.default2:hover [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_default2_texthover')).";
    top: 0;
}
"; } else {
    $css .= "/*html.no-touch */body .pix_button.pix_button_2:hover > span:first-child, /*html.no-touch */body .buttonelic.default2:hover > span:first-child {
    color: ".stripslashes(get_option('pix_style_button_default2_texthover')).";
}
";
    }

    if ( stripslashes(get_option('pix_style_button_default2_fx')) == 'expand' ) {
    $css .= "
/*html.no-touch */body .pix_button.pix_button_2 > span:last-child, /*html.no-touch */body .buttonelic.default2 > span:last-child {
    background-color: ".stripslashes(get_option('pix_style_button_default2_bghover')).";
    bottom: 0;
    top: 0;
}
/*html.no-touch */body .pix_button.pix_button_2:hover > span:last-child, /*html.no-touch */body .buttonelic.default2:hover > span:last-child {
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_default2_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_default2_borderradius'))."px;
    left: 0;
    opacity: 1;
    right: 0;
}
/*html.no-touch */body .pix_button.pix_button_2:hover, /*html.no-touch */body .buttonelic.default2:hover {
    border-color: ".stripslashes(get_option('pix_style_button_default2_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_default2_texthover')).";
}
"; } else {
    $css .= "
/*html.no-touch */body .pix_button.pix_button_2:hover, /*html.no-touch */body .buttonelic.default2:hover {
    background-color: ".stripslashes(get_option('pix_style_button_default2_bghover')).";
    border-color: ".stripslashes(get_option('pix_style_button_default2_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_default2_texthover')).";
}
"; }


$footer_bg = get_option('pix_style_footer_bg');
$footer_color = get_option('pix_style_footer_color');
$footer_color_alt = get_option('pix_style_footer_color_alt');
$footer_link = get_option('pix_style_footer_link');
$footer_link_hover = get_option('pix_style_footer_hover');
$featured_footer = get_option('pix_style_featured_footer');
$featured_footer_alt = get_option('pix_style_featured_footer_alt');
$footer_border = get_option('pix_style_footer_border');
$footer_alternative_border = get_option('pix_style_footer_alternative_border');
$footer_tiny = get_option('pix_style_footer_tiny');
$footer_input = get_option('pix_style_footer_input');
$footer_error = get_option('pix_style_footer_error');
$footer_default_box_color = get_option('pix_style_footer_box_default_color');
$footer_default_box_bg = get_option('pix_style_footer_box_default_background');
$footer_default_box_radius = get_option('pix_style_footer_box_default_borderradius');
$footer_default_box_border_color = get_option('pix_style_footer_box_default_bordercolor');
$footer_default_box_border_w = get_option('pix_style_footer_box_default_borderwidth');
$footer_default_box_style = get_option('pix_style_footer_box_default_style');
$footer_success_box_color = get_option('pix_style_footer_box_success_color');
$footer_success_box_bg = get_option('pix_style_footer_box_success_background');
$footer_success_box_radius = get_option('pix_style_footer_box_success_borderradius');
$footer_success_box_border_color = get_option('pix_style_footer_box_success_bordercolor');
$footer_success_box_border_w = get_option('pix_style_footer_box_success_borderwidth');
$footer_success_box_style = get_option('pix_style_footer_box_success_style');
$footer_error_box_color = get_option('pix_style_footer_box_error_color');
$footer_error_box_bg = get_option('pix_style_footer_box_error_background');
$footer_error_box_radius = get_option('pix_style_footer_box_error_borderradius');
$footer_error_box_border_color = get_option('pix_style_footer_box_error_bordercolor');
$footer_error_box_border_w = get_option('pix_style_footer_box_error_borderwidth');
$footer_error_box_style = get_option('pix_style_footer_box_error_style');


    $css .= "footer#colophon {
    background-color: $footer_bg;
    color: $footer_color;
}
footer#colophon .pseudo-arrow {
    color: $footer_bg;
}
footer#colophon blockquote > :first-child::before {
    color: $footer_tiny;
}
footer#colophon .wp-caption {
    border-bottom-color: $footer_border;
}
footer#colophon .wp-caption-text {
    color: $footer_tiny;
}
";
$typography_ar_footer = array ('h1','h2','h3','h4','h5','h6');
foreach ($typography_ar_footer as $key => $tag) {
$css .= "footer#colophon $tag {
    color: $footer_color;
}
";
}
    $css .= "footer#colophon input[type=\"text\"],
footer#colophon input[type=\"password\"],
footer#colophon input[type=\"email\"],
footer#colophon input[type=\"url\"],
footer#colophon input[type=\"search\"],
footer#colophon input[type=\"datetime\"],
footer#colophon input[type=\"search\"],
footer#colophon input[type=\"tel\"],
footer#colophon input[type=\"url\"],
footer#colophon textarea,
footer#colophon textarea,
footer#colophon input.input-text,
footer#colophon #subscribe-email input {
    background: $footer_input;
    border-color: $footer_border;
    color: $footer_color;
}
footer#colophon input[type=\"text\"]:focus,
footer#colophon input[type=\"password\"]:focus,
footer#colophon input[type=\"email\"]:focus,
footer#colophon input[type=\"url\"]:focus,
footer#colophon input[type=\"search\"]:focus,
footer#colophon input[type=\"datetime\"]:focus,
footer#colophon input[type=\"search\"]:focus,
footer#colophon input[type=\"tel\"]:focus,
footer#colophon input[type=\"url\"]:focus,
footer#colophon select[multiple]:focus,
footer#colophon textarea:focus {
    border-color: $footer_alternative_border;
}
footer#colophon input[type=\"checkbox\"],
footer#colophon input[type=\"radio\"] {
    background: $footer_bg;
    border-color: $footer_alternative_border;
    -webkit-box-shadow: inset 0 1px 2px rgba(".pix_hex2rgbcompiled($footer_color).",.1);
    box-shadow: inset 0 1px 2px rgba(".pix_hex2rgbcompiled($footer_color).",.1);
    color: $footer_color;
}
footer#colophon input[type=\"radio\"]:checked::before {
    background: $footer_color;
}
footer#colophon input[type=\"text\"].wpcf7-not-valid,
footer#colophon input[type=\"password\"].wpcf7-not-valid,
footer#colophon input[type=\"email\"].wpcf7-not-valid,
footer#colophon input[type=\"url\"].wpcf7-not-valid,
footer#colophon input[type=\"search\"].wpcf7-not-valid,
footer#colophon input[type=\"datetime\"].wpcf7-not-valid,
footer#colophon input[type=\"search\"].wpcf7-not-valid,
footer#colophon input[type=\"tel\"].wpcf7-not-valid,
footer#colophon input[type=\"url\"].wpcf7-not-valid,
footer#colophon textarea.wpcf7-not-valid,
footer#colophon select[multiple].wpcf7-not-valid,
footer#colophon input.input-text.wpcf7-not-valid,
footer#colophon #subscribe-email input.wpcf7-not-valid {
    border-bottom-color: $footer_error;
}
footer#colophon .wpcf7-not-valid input[type=\"checkbox\"] {
    border-bottom-color: $footer_error;
}
footer#colophon a {
    color: $footer_link;
}
footer#colophon a:hover {
    color: $footer_link_hover;
}
footer#colophon .slider_div .ui-slider-horizontal {
    background-color: rgba(".pix_hex2rgbcompiled($body_color).",.1);
}
footer#colophon .slider_div .ui-slider-horizontal a,
footer#colophon .slider_div .ui-slider-horizontal span {
    background-color: $page_bg_color;
    border-color: $border_color;
}
footer#colophon .slider_div .ui-slider-range {
    background-color: rgba(".pix_hex2rgbcompiled($body_color).",.1);
    background-image: -moz-linear-gradient(right, ".geode_darken_color($featured_color)." 0%, $featured_color 100%);
    background-image: -o-linear-gradient(right, ".geode_darken_color($featured_color)." 0%, $featured_color 100%);
    background-image: -webkit-linear-gradient(right, ".geode_darken_color($featured_color)." 0%, $featured_color 100%);
    background-image: linear-gradient(right, ".geode_darken_color($featured_color)." 0%, $featured_color 100%);
}
footer#colophon .slider_div .ui-slider-range {
    background-color: rgba(".pix_hex2rgbcompiled($footer_color).",.1);
    background-image: -moz-linear-gradient(right, ".geode_darken_color($featured_footer)." 0%, $featured_footer 100%);
    background-image: -o-linear-gradient(right, ".geode_darken_color($featured_footer)." 0%, $featured_footer 100%);
    background-image: -webkit-linear-gradient(right, ".geode_darken_color($featured_footer)." 0%, $featured_footer 100%);
    background-image: linear-gradient(right, ".geode_darken_color($featured_footer)." 0%, $featured_footer 100%);
    -moz-box-shadow: inset 0 1px 0 rgba(".pix_hex2rgbcompiled($footer_color).",.2);
    -webkit-box-shadow: inset 0 1px 0 rgba(".pix_hex2rgbcompiled($footer_color).",.2);
    box-shadow: inset 0 1px 0 rgba(".pix_hex2rgbcompiled($footer_color).",.2);
}
footer#colophon .ui-widget {
    background: $footer_color;
    box-shadow: 0 1px 3px rgba(".pix_hex2rgbcompiled($footer_color).",.5);
    color: $footer_bg;
}
footer#colophon .ui-datepicker-header {
    border-bottom: 1px solid $footer_tiny;
}
footer#colophon .ui-datepicker th {
    color: $footer_bg;
}
footer#colophon td .ui-state-default {
    color: $footer_bg;
}
footer#colophon td .ui-state-active,
footer#colophon td .ui-state-hover {
    background: $footer_tiny;
}
footer#colophon .bootstrap-filestyle label[for*=\"filestyle\"],
footer#colophon .bootstrap-filestyle .btn {
    background-color: $featured_footer!important;
    color: $footer_bg!important;
}
footer#colophon .wpcf7 img.wpcf7-captchac {
    border: 1px solid $footer_border;
}
footer#colophon .pix_widget li {
    border-bottom-color: $footer_border;
}
footer#colophon .search .post-type {
    border-top-color: $footer_border;
    color: $footer_tiny;
}
footer#colophon .single-post .entry-content::after {
    background: $footer_border;
}
footer#colophon .single .tag-links,
footer#colophon .single .cat-links {
    border-top-color: $footer_border;
}
footer#colophon .comment-list li .reply > a {
    background: rgba(".pix_hex2rgbcompiled($footer_color).",.1);
}
footer#colophon .comment-reply-title small > a {
    background: rgba(".pix_hex2rgbcompiled($footer_color).",.1);
}
footer#colophon .comment-list li .comment-content {
    border-bottom-color: $footer_border;
}
footer#colophon .form-allowed-tags {
    border-bottom-color: $footer_border;
}
footer#colophon .gallery-caption.sc-bg-hover {
    background: rgba(".pix_hex2rgbcompiled($featured_footer_alt).",.85);
}
footer#colophon .slideshine_thumbs_scroller {
    background: $footer_color;
}
footer#colophon .gallery .gallery-item .sc-bg-fancy {
    background: rgba(".pix_hex2rgbcompiled($footer_color).",.85);
}
footer#colophon .gallery .gallery-item .sc-bg-fancy::after {
    border-color: $footer_bg;
}
footer#colophon .customSelect {
    background: $footer_bg;
    border-color: $footer_border;
}
footer#colophon .widget_calendar tbody td {
    border: 1px solid $footer_bg
}
footer#colophon .widget_calendar tbody td a {
    background: $featured_footer;
    color: $footer_bg!important;
}
footer#colophon .widget_calendar tfoot td {
    border-top-color: $footer_border;
}
footer#colophon .widget_calendar tbody td#today {
    color: $footer_bg!important;
}
footer#colophon .widget_calendar tbody td#today::before {
    background: $featured_footer_alt;
}
footer#colophon table.compare-list {
    border-color: $footer_border;
}
footer#colophon table.compare-list td {
    background: $footer_bg;
    border-color: $footer_border;
}
footer#colophon .bx-wrapper .bx-controls-direction a {
    background: rgba(".pix_hex2rgbcompiled($footer_color).",.1);
    color: $footer_color!important;
}
footer#colophon .bx-wrapper .bx-viewport::after,
footer#colophon .bx-wrapper .bx-viewport::before {
    background: $footer_bg;
}
footer#colophon .bx-wrapper .bx-pager.bx-default-pager a {
    background: $footer_color;
    border-color: $footer_color;
}
footer#colophon .bx-wrapper .bx-controls-auto .bx-start, 
footer#colophon .bx-wrapper .bx-controls-auto .bx-stop {
    color: $footer_color!important;
}
footer#colophon div[role=\"list\"].products div[role=\"listitem\"] > div ,
.pixgridder footer#colophon div[role=\"list\"].products div[role=\"listitem\"].column > div {
    background: $footer_bg;
}
@media (min-width: 1025px) {
    footer#colophon div[role=\"list\"].products div[role=\"listitem\"]:hover > div,
    .pixgridder footer#colophon div[role=\"list\"].products div[role=\"listitem\"].column:hover > div {
        -webkit-box-shadow: 0 0 0 3px $footer_border;
        box-shadow: 0 0 0 3px $footer_border;
    }
}
.woocommerce footer#colophon div[role=\"list\"].products div[role=\"listitem\"] a.attachments-shop_catalog > div {
    background: $footer_bg;
}
.woocommerce footer#colophon div[role=\"list\"].products div[role=\"listitem\"] a.attachments-shop_catalog {
    border-color: rgba(".pix_hex2rgbcompiled($footer_color).",.1);
}
footer#colophon div[role=\"list\"].products div[role=\"listitem\"] .pix-woo-gallery-navig {
    background: $footer_color;
}
footer#colophon .star-rating, 
footer#colophon p.stars,
footer#colophon .fe_wrapp_stars div.unselected_star::before {
    color: $footer_color;
}
footer#colophon div[role=\"list\"].products div[role=\"listitem\"] .pix-woo-gallery-prev {
    color: $footer_bg;
}
footer#colophon div[role=\"list\"].products div[role=\"listitem\"] .pix-woo-gallery-next {
    color: $footer_bg;
}
footer#colophon .shop_table td.product-remove a {
    color: $footer_bg!important;
}
footer#colophon .chosen-container .chosen-drop {
    border-color: $footer_border;
}
footer#colophon table.compare-list td.odd {
    background: $footer_input;
}
footer#colophon .shop_table td.product-remove a {
    background: $footer_tiny;
}
footer#colophon .woocommerce-checkout .form-row .chosen-container-single .chosen-single {
    background: $footer_bg;
    border-color: $footer_border;
}
footer#colophon .chosen-container .chosen-drop input[type=\"text\"] {
    background: $footer_bg!important; 
}
footer#colophon form.checkout .payment_methods {
    border-bottom-color: $footer_border;
}
footer#colophon form.checkout .payment_methods .payment_box {
    background: $footer_bg;
}
footer#colophon form.checkout .payment_methods .payment_box::after {
    border-bottom-color: $footer_input;
}
footer#colophon .widget_price_filter .ui-slider-horizontal {
    background-color: rgba(".pix_hex2rgbcompiled($footer_color).",.1);
}
footer#colophon .widget_price_filter .ui-slider-horizontal a,
footer#colophon .widget_price_filter .ui-slider-horizontal span {
    background-color: $footer_bg;
    border-color: $footer_border;
}
footer#colophon .widget_price_filter .ui-slider-range {
    background-color: $featured_footer_alt;
}
footer#colophon .widget_top_rated_products li,
footer#colophon .widget_recent_reviews li,
footer#colophon .widget_recently_viewed_products li,
footer#colophon .widget_products li,
footer#colophon .widget_shopping_cart_content li {
    border-bottom-color: $footer_border!important;
}
footer#colophon .sc-layout .slideshine_next,
footer#colophon .sc-layout .slideshine_prev,
footer#colophon #related-items-section .slideshine_next,
footer#colophon #related-items-section .slideshine_prev,
footer#colophon .grid-blog .slideshine_prev,
footer#colophon .grid-blog .slideshine_next {
    color: $footer_bg!important;
}
footer#colophon .sc-layout .sc-grid article.hentry .sc-bg-fancy {
    background: $featured_footer_alt;
}
footer#colophon .sc-layout .sc-grid article.hentry .sc-bg-below {
    background: $featured_footer_alt;
}
footer#colophon .sc-layout .sc-grid article.hentry .sc-position-fancy {
    background: $featured_footer_alt;
}
footer#colophon .sc-wrap-video-resp {
    background: $footer_bg;
}
footer#colophon .sc-layout .sc-portfolio-filters a.selected::after {
    background: $featured_footer;
}
footer#colophon .grid-blog article > .row,
footer#colophon .sc-layout .sc-grid article.post-portfolio-below > .row {
    background: $page_bg_color;
    border-color: $footer_border
}
footer#colophon .grid-blog article .entry-meta,
footer#colophon .sc-layout .sc-grid article.post-portfolio-below .entry-meta {
    border-top-color: $footer_border;
    color: $footer_tiny;
}
footer#colophon .gallery-caption.sc-bg-hover {
    color: $footer_bg;
}
footer#colophon .archive-list .entry-meta {
    border-bottom-color: $border_color;
    color: $footer_tiny;
}
footer#colophon .tagcloud a {
    background: $footer_color;
    color: $footer_bg!important;
}
footer#colophon .tagcloud a:hover {
    background: $footer_tiny;
}
footer#colophon .gallery .gallery-item .sc-bg-fancy {
    color: $footer_bg;
}
footer#colophon .gallery-slideshine .slideshine_caption,
footer#colophon .gallery-slideshine .pixlightfx {
    color: $footer_bg;
}
footer#colophon .tabedelic.simple > .tabedelic-headers > .header-active::before {
    background: $featured_footer;
}
footer#colophon .woocommerce .price ins,
footer#colophon .woocommerce .price > .amount,
footer#colophon .woocommerce :not(.checkout) td > .amount,
footer#colophon .woocommerce .order-total .amount {
    color: $featured_footer_alt;
}
footer#colophon .widget_shopping_cart_content .quantity .amount {
    color: $featured_footer_alt;
}
footer#colophon .widget_shopping_cart_content .total .amount {
    color: $featured_footer_alt;
}
footer#colophon .woocommerce .yith-wcwl-wishlistaddedbrowse > a,
footer#colophon .woocommerce .yith-wcwl-wishlistexistsbrowse > a {
    color: $featured_footer;
}
footer#colophon .woocommerce .yith-wcwl-wishlistexistsbrowse > a {
    color: $featured_footer!important;
}
footer#colophon .woocommerce .compare.button.added, 
footer#colophon .woocommerce .compare.added {
    color: $featured_footer!important;
}
footer#colophon .quantity.buttons_added input[type=\"button\"] {
    color: $footer_color;
}
footer#colophon .sc-layout .sc-grid article.hentry .sc-bg-fancy {
    color: $footer_bg;
}
footer#colophon .sc-layout .sc-grid article.hentry .sc-bg-fancy .sc-title::after {
    border-top-color: $footer_bg;
}
footer#colophon .sc-layout .sc-portfolio-filters {
    color: $footer_link;
}
footer#colophon .sc-layout .sc-portfolio-filters strong {
    color: $footer_color;
}
footer#colophon .sc-layout .sc-portfolio-filters a.selected {
    color: $footer_color!important;
}
footer#colophon .pix_box, footer#colophon .woocommerce-info {
    border: {$footer_default_box_border_w}px solid $footer_default_box_border_color;
    -moz-border-radius: {$footer_default_box_radius}px;
    border-radius: {$footer_default_box_radius}px;
    background-color: $footer_default_box_bg;
    color: $footer_default_box_color;
    $footer_default_box_style
}
footer#colophon .pix_box.success, footer#colophon .woocommerce-message {
    border: {$footer_success_box_border_w}px solid $footer_success_box_border_color;
    -moz-border-radius: {$footer_success_box_radius}px;
    border-radius: {$footer_success_box_radius}px;
    background-color: $footer_success_box_bg;
    color: $footer_success_box_color;
    $footer_success_box_style
}
footer#colophon .pix_box.error, footer#colophon .woocommerce-error {
    border: {$footer_error_box_border_w}px solid $footer_error_box_border_color;
    -moz-border-radius: {$footer_error_box_radius}px;
    border-radius: {$footer_error_box_radius}px;
    background-color: $footer_error_box_bg;
    color: $footer_error_box_color;
    $footer_error_box_style
}
footer#colophon .imtst_msg-err {
    color: $footer_error;
}

";

    $css .= "footer#colophon .pix_button, body .buttonelic.footer, footer#colophon button:not([aria-controls]), footer#colophon input[type=\"submit\"], footer#colophon #infinite-handle {
    background-color: ".stripslashes(get_option('pix_style_button_footer_bg')).";
    border: ".stripslashes(get_option('pix_style_button_footer_borderwidth'))."px solid ".stripslashes(get_option('pix_style_button_footer_bordercolor')).";
    color: ".stripslashes(get_option('pix_style_button_footer_color')).";
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_footer_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_footer_borderradius'))."px;
}
footer#colophon .pix_button > span:first-child, body .buttonelic.footer > span:first-child, footer#colophon button:not([aria-controls]) > span:first-child, footer#colophon #infinite-handle > span:first-child {
    color: ".stripslashes(get_option('pix_style_button_footer_color')).";
}";

    if ( stripslashes(get_option('pix_style_button_footer_icon')) == 'hover' ) {
    $css .= "/*html.no-touch */footer#colophon .pix_button:hover > span:first-child, /*html.no-touch */body .buttonelic.footer:hover > span:first-child, /*html.no-touch */footer#colophon button:not([aria-controls]):hover > span:first-child, /*html.no-touch */footer#colophon input[type=\"submit\"]:hover {
    color: ".stripslashes(get_option('pix_style_button_footer_bg')).";
}
footer#colophon .pix_button [class*=\"scicon-\"], body .buttonelic.footer [class*=\"scicon-\"], footer#colophon button:not([aria-controls]) [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_footer_bg')).";
}
/*html.no-touch */footer#colophon .pix_button:hover [class*=\"scicon-\"], /*html.no-touch */body .buttonelic.footer:hover [class*=\"scicon-\"], /*html.no-touch */footer#colophon button:not([aria-controls]):hover [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_footer_texthover')).";
}
"; } else {
    $css .= "/*html.no-touch */footer#colophon .pix_button:hover > span:first-child, /*html.no-touch */body .buttonelic.footer:hover > span:first-child, /*html.no-touch */footer#colophon button:not([aria-controls]):hover > span:first-child, /*html.no-touch */footer#colophon input[type=\"submit\"]:hover, /*html.no-touch */footer#colophon #infinite-handle:hover > span:first-child {
    color: ".stripslashes(get_option('pix_style_button_footer_texthover')).";
}
";
    }

    if ( stripslashes(get_option('pix_style_button_footer_fx')) == 'expand' ) {
    $css .= "footer#colophon .pix_button > span:last-child, body .buttonelic.footer > span:last-child, footer#colophon button:not([aria-controls]) > span:last-child, footer#colophon #infinite-handle > span:last-child {
    background-color: ".stripslashes(get_option('pix_style_button_footer_bghover')).";
    bottom: 0;
    top: 0;
}
/*html.no-touch */footer#colophon .pix_button:hover > span:last-child, /*html.no-touch */body .buttonelic.footer:hover > span:last-child, /*html.no-touch */footer#colophon button:not([aria-controls]):hover > span:last-child, /*html.no-touch */footer#colophon #infinite-handle:hover > span:last-child {
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_footer_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_footer_borderradius'))."px;
    left: 0;
    right: 0;
}
/*html.no-touch */footer#colophon .pix_button:hover, /*html.no-touch */body .buttonelic.footer:hover, /*html.no-touch */footer#colophon button:not([aria-controls]):hover, /*html.no-touch */footer#colophon #infinite-handle:hover {
    border-color: ".stripslashes(get_option('pix_style_button_footer_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_footer_texthover'))."!important;
}
/*html.no-touch */footer#colophon input[type=\"submit\"]:hover {
    background-color: ".stripslashes(get_option('pix_style_button_footer_bghover')).";
    border-color: ".stripslashes(get_option('pix_style_button_footer_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_footer_texthover'))."!important;
}
"; } else {
    $css .= "
/*html.no-touch */footer#colophon .pix_button:hover, /*html.no-touch */body .buttonelic.footer:hover, /*html.no-touch */footer#colophon button:not([aria-controls]):hover, /*html.no-touch */footer#colophon input[type=\"submit\"]:hover, /*html.no-touch */footer#colophon #infinite-handle:hover {
    background-color: ".stripslashes(get_option('pix_style_button_footer_bghover')).";
    border-color: ".stripslashes(get_option('pix_style_button_footer_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_footer_texthover')).";
}
"; }

    $css .= "footer#colophon .pix_button.pix_button_2, body .buttonelic.footer2 {
    background-color: ".stripslashes(get_option('pix_style_button_footer2_bg')).";
    border: ".stripslashes(get_option('pix_style_button_footer2_borderwidth'))."px solid ".stripslashes(get_option('pix_style_button_footer2_bordercolor')).";
    color: ".stripslashes(get_option('pix_style_button_footer2_color')).";
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_footer2_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_footer2_borderradius'))."px;
}
".stripslashes(get_option('pix_style_button_footer2_style'));

    if ( stripslashes(get_option('pix_style_button_footer2_icon')) == 'hover' ) {
    $css .= "/*html.no-touch */.pix_button.pix_button_2:hover > span:first-child, /*html.no-touch */body .buttonelic.footer2:hover > span:first-child {
    color: ".stripslashes(get_option('pix_style_button_footer2_bghover')).";
}
footer#colophon .pix_button.pix_button_2 [class*=\"scicon-\"], body .buttonelic.footer2 [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_footer2_bg')).";
}
/*html.no-touch */footer#colophon .pix_button.pix_button_2:hover [class*=\"scicon-\"], /*html.no-touch */body .buttonelic.footer2:hover [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_footer2_texthover')).";
}
"; }

    if ( stripslashes(get_option('pix_style_button_footer2_fx')) == 'expand' ) {
    $css .= "
footer#colophon .pix_button.pix_button_2 > span:last-child, body .buttonelic.footer2 > span:last-child {
    background-color: ".stripslashes(get_option('pix_style_button_footer2_bghover')).";
    bottom: 0;
    top: 0;
}
/*html.no-touch */footer#colophon .pix_button.pix_button_2:hover > span:last-child, /*html.no-touch */body .buttonelic.footer2:hover > span:last-child {
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_footer2_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_footer2_borderradius'))."px;
    left: 0;
    right: 0;
}
/*html.no-touch */footer#colophon .pix_button.pix_button_2:hover, /*html.no-touch */body .buttonelic.footer2:hover {
    border-color: ".stripslashes(get_option('pix_style_button_footer2_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_footer2_texthover')).";
}
"; } else {
    $css .= "
/*html.no-touch */footer#colophon .pix_button.pix_button_2:hover, /*html.no-touch */body .buttonelic.footer2:hover {
    background-color: ".stripslashes(get_option('pix_style_button_footer2_bghover')).";
    border-color: ".stripslashes(get_option('pix_style_button_footer2_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_footer2_texthover')).";
}
"; }



$top_sliding_bg = get_option('pix_style_top_sliding_bg');
$top_sliding_bg_opacity = get_option('pix_style_top_sliding_bg_opacity');
$top_sliding_color = get_option('pix_style_top_sliding_color');
$top_sliding_link = get_option('pix_style_top_sliding_link');
$top_sliding_link_hover = get_option('pix_style_top_sliding_hover');
$featured_top_sliding = get_option('pix_style_featured_top_sliding');
$featured_top_sliding_alt = get_option('pix_style_featured_top_sliding_alt');
$top_sliding_border = get_option('pix_style_top_sliding_border');
$top_sliding_alternative_border = get_option('pix_style_top_sliding_alternative_border');
$top_sliding_tiny = get_option('pix_style_top_sliding_tiny');
$top_sliding_input = get_option('pix_style_top_sliding_input');
$top_sliding_error = get_option('pix_style_top_sliding_error');
$top_sliding_default_box_color = get_option('pix_style_topsliding_box_default_color');
$top_sliding_default_box_bg = get_option('pix_style_topsliding_box_default_background');
$top_sliding_default_box_radius = get_option('pix_style_topsliding_box_default_borderradius');
$top_sliding_default_box_border_color = get_option('pix_style_topsliding_box_default_bordercolor');
$top_sliding_default_box_border_w = get_option('pix_style_topsliding_box_default_borderwidth');
$top_sliding_default_box_style = get_option('pix_style_topsliding_box_default_style');
$top_sliding_success_box_color = get_option('pix_style_topsliding_box_success_color');
$top_sliding_success_box_bg = get_option('pix_style_topsliding_box_success_background');
$top_sliding_success_box_radius = get_option('pix_style_topsliding_box_success_borderradius');
$top_sliding_success_box_border_color = get_option('pix_style_topsliding_box_success_bordercolor');
$top_sliding_success_box_border_w = get_option('pix_style_topsliding_box_success_borderwidth');
$top_sliding_success_box_style = get_option('pix_style_topsliding_box_success_style');
$top_sliding_error_box_color = get_option('pix_style_topsliding_box_error_color');
$top_sliding_error_box_bg = get_option('pix_style_topsliding_box_error_background');
$top_sliding_error_box_radius = get_option('pix_style_topsliding_box_error_borderradius');
$top_sliding_error_box_border_color = get_option('pix_style_topsliding_box_error_bordercolor');
$top_sliding_error_box_border_w = get_option('pix_style_topsliding_box_error_borderwidth');
$top_sliding_error_box_style = get_option('pix_style_topsliding_box_error_style');


    $css .= "#top_sliding_bar {
    background-color: rgba(".pix_hex2rgbcompiled($top_sliding_bg).",$top_sliding_bg_opacity);
    color: $top_sliding_color;
}
#top_sliding_toggle {
    border-top-color: rgba(".pix_hex2rgbcompiled($top_sliding_bg).",$top_sliding_bg_opacity);
}
#top_sliding_toggle::after {
    color: $top_sliding_color;
}

#top_sliding_bar blockquote > :first-child::before {
    color: $top_sliding_tiny;
}
";
$typography_ar_top_sliding = array ('h1','h2','h3','h4','h5','h6');
foreach ($typography_ar_top_sliding as $key => $tag) {
$css .= "#top_sliding_bar $tag {
    color: $top_sliding_color;
}
";
}
    $css .= "#top_sliding_bar input[type=\"text\"],
#top_sliding_bar input[type=\"password\"],
#top_sliding_bar input[type=\"email\"],
#top_sliding_bar input[type=\"url\"],
#top_sliding_bar input[type=\"search\"],
#top_sliding_bar input[type=\"datetime\"],
#top_sliding_bar input[type=\"search\"],
#top_sliding_bar input[type=\"tel\"],
#top_sliding_bar input[type=\"url\"],
#top_sliding_bar textarea,
#top_sliding_bar input.input-text,
#top_sliding_bar #subscribe-email input {
    background: $top_sliding_input;
    border-color: $top_sliding_border;
    color: $top_sliding_color;
}
#top_sliding_bar input[type=\"text\"]:focus,
#top_sliding_bar input[type=\"password\"]:focus,
#top_sliding_bar input[type=\"email\"]:focus,
#top_sliding_bar input[type=\"url\"]:focus,
#top_sliding_bar input[type=\"search\"]:focus,
#top_sliding_bar input[type=\"datetime\"]:focus,
#top_sliding_bar input[type=\"search\"]:focus,
#top_sliding_bar input[type=\"tel\"]:focus,
#top_sliding_bar input[type=\"url\"]:focus,
#top_sliding_bar textarea:focus {
    border-color: $top_sliding_alternative_border;
}
#top_sliding_bar input[type=\"checkbox\"],
#top_sliding_bar input[type=\"radio\"] {
    background: $top_sliding_bg;
    border-color: $top_sliding_alternative_border;
    -webkit-box-shadow: inset 0 1px 2px rgba(".pix_hex2rgbcompiled($top_sliding_color).",.1);
    box-shadow: inset 0 1px 2px rgba(".pix_hex2rgbcompiled($top_sliding_color).",.1);
    color: $top_sliding_color;
}
#top_sliding_bar input[type=\"radio\"]:checked::before {
    background: $top_sliding_color;
}
#top_sliding_bar a {
    color: $top_sliding_link;
}
#top_sliding_bar a:hover {
    color: $top_sliding_link_hover;
}
#top_sliding_bar .pix_widget li {
    border-bottom-color: $top_sliding_border;
}
#top_sliding_bar .search .post-type {
    border-color: $top_sliding_border;
    color: $top_sliding_tiny;
}
#top_sliding_bar .single-post .entry-content::after {
    background: $top_sliding_border;
}
#top_sliding_bar .single .tag-links,
#top_sliding_bar .single .cat-links {
    border-top-color: $top_sliding_border;
}
#top_sliding_bar .comment-list li .reply > a {
    background: rgba(".pix_hex2rgbcompiled($top_sliding_color).",.1);
}
#top_sliding_bar .comment-reply-title small > a {
    background: rgba(".pix_hex2rgbcompiled($top_sliding_color).",.1);
}
#top_sliding_bar .comment-list li .comment-content {
    border-bottom-color: $top_sliding_border;
}
#top_sliding_bar .form-allowed-tags {
    border-bottom-color: $top_sliding_border;
}
#top_sliding_bar .gallery-caption.sc-bg-hover {
    background: rgba(".pix_hex2rgbcompiled($featured_top_sliding_alt).",.85);
}
#top_sliding_bar .slideshine_thumbs_scroller {
    background: $top_sliding_color;
}
#top_sliding_bar .gallery .gallery-item .sc-bg-fancy {
    background: rgba(".pix_hex2rgbcompiled($top_sliding_color).",.85);
}
#top_sliding_bar .gallery .gallery-item .sc-bg-fancy::after {
    border-color: $top_sliding_bg;
}
#top_sliding_bar .customSelect {
    background: $top_sliding_bg;
    border-color: $top_sliding_border;
}
#top_sliding_barn .widget_calendar tbody td {
    border: 1px solid $top_sliding_bg
}
#top_sliding_bar .widget_calendar tbody td a {
    background: $featured_top_sliding;
    color: $top_sliding_bg!important;
}
#top_sliding_bar .widget_calendar tfoot td {
    border-top-color: $top_sliding_border;
}
#top_sliding_bar .widget_calendar tbody td#today {
    color: $top_sliding_bg!important;
}
#top_sliding_bar .widget_calendar tbody td#today::before {
    background: $featured_top_sliding_alt;
}
#top_sliding_bar table.compare-list {
    border-color: $top_sliding_border;
}
#top_sliding_bar table.compare-list td {
    background: $top_sliding_bg;
    border-color: $top_sliding_border;
}
#top_sliding_bar .bx-wrapper .bx-controls-direction a {
    background: rgba(".pix_hex2rgbcompiled($top_sliding_color).",.1);
    color: $top_sliding_color!important;
}
#top_sliding_bar .bx-wrapper .bx-viewport::after,
#top_sliding_bar .bx-wrapper .bx-viewport::before {
    background: $top_sliding_bg;
}
#top_sliding_bar .bx-wrapper .bx-pager.bx-default-pager a {
    background: $top_sliding_color;
    border-color: $top_sliding_color;
}
#top_sliding_bar .bx-wrapper .bx-controls-auto .bx-start, 
#top_sliding_bar .bx-wrapper .bx-controls-auto .bx-stop {
    color: $top_sliding_color!important;
}
#top_sliding_bar div[role=\"list\"].products div[role=\"listitem\"] > div,
.pixgridder #top_sliding_bar div[role=\"list\"].products div[role=\"listitem\"].column > div {
    background: $top_sliding_bg;
}
@media (min-width: 1025px) {
    #top_sliding_bar div[role=\"list\"].products div[role=\"listitem\"]:hover > div,
    .pixgridder #top_sliding_bar div[role=\"list\"].products div[role=\"listitem\"].column:hover > div {
        -webkit-box-shadow: 0 0 0 3px $top_sliding_border;
        box-shadow: 0 0 0 3px $top_sliding_border;
    }
}
.woocommerce #top_sliding_bar div[role=\"list\"].products div[role=\"listitem\"] a.attachments-shop_catalog > div {
    background: $top_sliding_bg;
}
.woocommerce #top_sliding_bar div[role=\"list\"].products div[role=\"listitem\"] a.attachments-shop_catalog {
    border-color: rgba(".pix_hex2rgbcompiled($top_sliding_color).",.1);
}
#top_sliding_bar div[role=\"list\"].products div[role=\"listitem\"] .pix-woo-gallery-navig {
    background: $top_sliding_color;
}
#top_sliding_bar .star-rating, 
#top_sliding_bar p.stars,
#top_sliding_bar .fe_wrapp_stars div.unselected_star::before {
    color: $top_sliding_color;
}
#top_sliding_bar div[role=\"list\"].products div[role=\"listitem\"] .pix-woo-gallery-prev {
    color: $top_sliding_bg;
}
#top_sliding_bar div[role=\"list\"].products div[role=\"listitem\"] .pix-woo-gallery-next {
    color: $top_sliding_bg;
}
#top_sliding_bar .shop_table td.product-remove a {
    color: $top_sliding_bg!important;
}
#top_sliding_bar .chosen-container .chosen-drop {
    border-color: $top_sliding_border;
}
#top_sliding_bar table.compare-list td.odd {
    background: $top_sliding_input;
}
#top_sliding_bar .shop_table td.product-remove a {
    background: $top_sliding_tiny;
}
#top_sliding_bar .woocommerce-checkout .form-row .chosen-container-single .chosen-single {
    background: $top_sliding_bg;
    border-color: $top_sliding_border;
}
#top_sliding_bar .chosen-container .chosen-drop input[type=\"text\"] {
    background: $top_sliding_bg!important; 
}
#top_sliding_bar form.checkout .payment_methods {
    border-bottom-color: $top_sliding_border;
}
#top_sliding_bar form.checkout .payment_methods .payment_box {
    background: $top_sliding_bg;
}
#top_sliding_bar form.checkout .payment_methods .payment_box::after {
    border-bottom-color: $top_sliding_input;
}
#top_sliding_bar .widget_price_filter .ui-slider-horizontal {
    background-color: rgba(".pix_hex2rgbcompiled($top_sliding_color).",.1);
}
#top_sliding_bar .widget_price_filter .ui-slider-horizontal a,
#top_sliding_bar .widget_price_filter .ui-slider-horizontal span {
    background-color: $top_sliding_bg;
    border-color: $top_sliding_border;
}
#top_sliding_bar .widget_price_filter .ui-slider-range {
    background-color: $featured_top_sliding_alt;
}
#top_sliding_bar .widget_top_rated_products li,
#top_sliding_bar .widget_recent_reviews li,
#top_sliding_bar .widget_recently_viewed_products li,
#top_sliding_bar .widget_products li,
#top_sliding_bar .widget_shopping_cart_content li {
    border-bottom-color: $top_sliding_border!important;
}
#top_sliding_bar .sc-layout .slideshine_next,
#top_sliding_bar .sc-layout .slideshine_prev,
#top_sliding_bar #related-items-section .slideshine_next,
#top_sliding_bar #related-items-section .slideshine_prev,
#top_sliding_bar .grid-blog .slideshine_prev,
#top_sliding_bar .grid-blog .slideshine_next {
    color: $top_sliding_bg!important;
}
#top_sliding_bar .sc-layout .sc-grid article.hentry .sc-bg-fancy {
    background: $featured_top_sliding_alt;
}
#top_sliding_bar .sc-layout .sc-grid article.hentry .sc-bg-below {
    background: $featured_top_sliding_alt;
}
#top_sliding_bar .sc-layout .sc-grid article.hentry .sc-position-fancy {
    background: $featured_top_sliding_alt;
}
#top_sliding_bar .sc-wrap-video-resp {
    background: $top_sliding_bg;
}
#top_sliding_bar .sc-layout .sc-portfolio-filters a.selected::after {
    background: $featured_top_sliding;
}
#top_sliding_bar .grid-blog article > .row,
#top_sliding_bar .sc-layout .sc-grid article.post-portfolio-below > .row {
    background: $page_bg_color;
    border-color: $top_sliding_border
}
#top_sliding_bar .grid-blog article .entry-meta,
#top_sliding_bar .sc-layout .sc-grid article.post-portfolio-below .entry-meta {
    border-top-color: $top_sliding_border
}
#top_sliding_bar .gallery-caption.sc-bg-hover {
    color: $top_sliding_bg;
}
#top_sliding_bar .archive-list .entry-meta {
    border-bottom-color: $border_color;
    color: $top_sliding_tiny;
}
#top_sliding_bar .tagcloud a {
    background: $top_sliding_color;
    color: $top_sliding_bg!important;
}
#top_sliding_bar .tagcloud a:hover {
    background: $top_sliding_tiny;
}
#top_sliding_bar .gallery .gallery-item .sc-bg-fancy {
    color: $top_sliding_bg;
}
#top_sliding_bar .gallery-slideshine .slideshine_caption,
#top_sliding_bar .gallery-slideshine .pixlightfx {
    color: $top_sliding_bg;
}
#top_sliding_bar .tabedelic.simple > .tabedelic-headers > .header-active::before {
    background: $featured_top_sliding;
}
#top_sliding_bar .woocommerce .price ins,
#top_sliding_bar .woocommerce .price > .amount,
#top_sliding_bar .woocommerce :not(.checkout) td > .amount,
#top_sliding_bar .woocommerce .order-total .amount {
    color: $featured_top_sliding_alt;
}
#top_sliding_bar .widget_shopping_cart_content .quantity .amount {
    color: $featured_top_sliding_alt;
}
#top_sliding_bar .widget_shopping_cart_content .total .amount {
    color: $featured_top_sliding_alt;
}
#top_sliding_bar .woocommerce .yith-wcwl-wishlistaddedbrowse > a,
#top_sliding_bar .woocommerce .yith-wcwl-wishlistexistsbrowse > a {
    color: $featured_top_sliding;
}
#top_sliding_bar .woocommerce .yith-wcwl-wishlistexistsbrowse > a {
    color: $featured_top_sliding!important;
}
#top_sliding_bar .woocommerce .compare.button.added, 
#top_sliding_bar .woocommerce .compare.added {
    color: $featured_top_sliding!important;
}
#top_sliding_bar .quantity.buttons_added input[type=\"button\"] {
    color: $top_sliding_color;
}
#top_sliding_bar .sc-layout .sc-grid article.hentry .sc-bg-fancy {
    color: $top_sliding_bg;
}
#top_sliding_bar .sc-layout .sc-grid article.hentry .sc-bg-fancy .sc-title::after {
    border-top-color: $top_sliding_bg;
}
#top_sliding_bar .sc-layout .sc-portfolio-filters {
    color: $top_sliding_link;
}
#top_sliding_bar .sc-layout .sc-portfolio-filters strong {
    color: $top_sliding_color;
}
#top_sliding_bar .sc-layout .sc-portfolio-filters a.selected {
    color: $top_sliding_color!important;
}
#top_sliding_bar .pix_box, #top_sliding_bar .woocommerce-info {
    border: {$top_sliding_default_box_border_w}px solid $top_sliding_default_box_border_color;
    -moz-border-radius: {$top_sliding_default_box_radius}px;
    border-radius: {$top_sliding_default_box_radius}px;
    background-color: $top_sliding_default_box_bg;
    color: $top_sliding_default_box_color;
    $top_sliding_default_box_style
}
#top_sliding_bar .pix_box.success, #top_sliding_bar .woocommerce-message {
    border: {$top_sliding_success_box_border_w}px solid $top_sliding_success_box_border_color;
    -moz-border-radius: {$top_sliding_success_box_radius}px;
    border-radius: {$top_sliding_success_box_radius}px;
    background-color: $top_sliding_success_box_bg;
    color: $top_sliding_success_box_color;
    $top_sliding_success_box_style
}
#top_sliding_bar .pix_box.error, #top_sliding_bar .woocommerce-error {
    border: {$top_sliding_error_box_border_w}px solid $top_sliding_error_box_border_color;
    -moz-border-radius: {$top_sliding_error_box_radius}px;
    border-radius: {$top_sliding_error_box_radius}px;
    background-color: $top_sliding_error_box_bg;
    color: $top_sliding_error_box_color;
    $top_sliding_error_box_style
}
#top_sliding_bar .imtst_msg-err {
    color: $top_sliding_error;
}
";

    $css .= "#top_sliding_bar .pix_button, body .buttonelic.top_sliding, #top_sliding_bar button:not([aria-controls]), #top_sliding_bar input[type=\"submit\"], #top_sliding_bar #infinite-handle {
    background-color: ".stripslashes(get_option('pix_style_button_top_sliding_bg')).";
    border: ".stripslashes(get_option('pix_style_button_top_sliding_borderwidth'))."px solid ".stripslashes(get_option('pix_style_button_top_sliding_bordercolor')).";
    color: ".stripslashes(get_option('pix_style_button_top_sliding_color')).";
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_top_sliding_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_top_sliding_borderradius'))."px;
}
#top_sliding_bar .pix_button > span:first-child, body .buttonelic.top_sliding > span:first-child, #top_sliding_bar button:not([aria-controls]) > span:first-child, #top_sliding_bar #infinite-handle > span:first-child {
    color: ".stripslashes(get_option('pix_style_button_top_sliding_color')).";
}";

    if ( stripslashes(get_option('pix_style_button_top_sliding_icon')) == 'hover' ) {
    $css .= "/*html.no-touch */#top_sliding_bar .pix_button:hover > span:first-child, /*html.no-touch */body .buttonelic.top_sliding:hover > span:first-child, /*html.no-touch */#top_sliding_bar button:not([aria-controls]):hover > span:first-child, /*html.no-touch */#top_sliding_bar input[type=\"submit\"]:hover {
    color: ".stripslashes(get_option('pix_style_button_top_sliding_bg')).";
}
#top_sliding_bar .pix_button [class*=\"scicon-\"], body .buttonelic.top_sliding [class*=\"scicon-\"], #top_sliding_bar button:not([aria-controls]) [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_top_sliding_bg')).";
}
/*html.no-touch */#top_sliding_bar .pix_button:hover [class*=\"scicon-\"], /*html.no-touch */body .buttonelic.top_sliding:hover [class*=\"scicon-\"], /*html.no-touch */#top_sliding_bar button:not([aria-controls]):hover [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_top_sliding_texthover')).";
}
"; } else {
    $css .= "/*html.no-touch */#top_sliding_bar .pix_button:hover > span:first-child, /*html.no-touch */body .buttonelic.top_sliding:hover > span:first-child, /*html.no-touch */#top_sliding_bar button:not([aria-controls]):hover > span:first-child, /*html.no-touch */#top_sliding_bar input[type=\"submit\"]:hover, /*html.no-touch */#top_sliding_bar #infinite-handle:hover > span:first-child {
    color: ".stripslashes(get_option('pix_style_button_top_sliding_texthover')).";
}
";
    }

    if ( stripslashes(get_option('pix_style_button_top_sliding_fx')) == 'expand' ) {
    $css .= "#top_sliding_bar .pix_button > span:last-child, body .buttonelic.top_sliding > span:last-child, #top_sliding_bar button:not([aria-controls]) > span:last-child, #top_sliding_bar #infinite-handle > span:last-child {
    background-color: ".stripslashes(get_option('pix_style_button_top_sliding_bghover')).";
    bottom: 0;
    top: 0;
}
/*html.no-touch */#top_sliding_bar .pix_button:hover > span:last-child, /*html.no-touch */body .buttonelic.top_sliding:hover > span:last-child, /*html.no-touch */#top_sliding_bar button:not([aria-controls]):hover > span:last-child, /*html.no-touch */#top_sliding_bar #infinite-handle:hover > span:last-child {
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_top_sliding_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_top_sliding_borderradius'))."px;
    left: 0;
    right: 0;
}
/*html.no-touch */#top_sliding_bar .pix_button:hover, /*html.no-touch */body .buttonelic.top_sliding:hover, /*html.no-touch */#top_sliding_bar button:not([aria-controls]):hover, /*html.no-touch */#top_sliding_bar #infinite-handle:hover {
    border-color: ".stripslashes(get_option('pix_style_button_top_sliding_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_top_sliding_texthover'))."!important;
}
/*html.no-touch */#top_sliding_bar input[type=\"submit\"]:hover {
    background-color: ".stripslashes(get_option('pix_style_button_top_sliding_bghover')).";
    border-color: ".stripslashes(get_option('pix_style_button_top_sliding_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_top_sliding_texthover'))."!important;
}
"; } else {
    $css .= "
/*html.no-touch */#top_sliding_bar .pix_button:hover, /*html.no-touch */body .buttonelic.top_sliding:hover, /*html.no-touch */#top_sliding_bar button:not([aria-controls]):hover, /*html.no-touch */#top_sliding_bar input[type=\"submit\"]:hover, /*html.no-touch */#top_sliding_bar #infinite-handle:hover {
    background-color: ".stripslashes(get_option('pix_style_button_top_sliding_bghover')).";
    border-color: ".stripslashes(get_option('pix_style_button_top_sliding_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_top_sliding_texthover')).";
}
"; }

    $css .= "#top_sliding_bar .pix_button.pix_button_2, body .buttonelic.top_sliding2 {
    background-color: ".stripslashes(get_option('pix_style_button_top_sliding2_bg')).";
    border: ".stripslashes(get_option('pix_style_button_top_sliding2_borderwidth'))."px solid ".stripslashes(get_option('pix_style_button_top_sliding2_bordercolor')).";
    color: ".stripslashes(get_option('pix_style_button_top_sliding2_color')).";
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_top_sliding2_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_top_sliding2_borderradius'))."px;
}
".stripslashes(get_option('pix_style_button_top_sliding2_style'));

    if ( stripslashes(get_option('pix_style_button_top_sliding2_icon')) == 'hover' ) {
    $css .= "/*html.no-touch */.pix_button.pix_button_2:hover > span:first-child, /*html.no-touch */body .buttonelic.top_sliding2:hover > span:first-child {
    color: ".stripslashes(get_option('pix_style_button_top_sliding2_bghover')).";
}
#top_sliding_bar .pix_button.pix_button_2 [class*=\"scicon-\"], body .buttonelic.top_sliding2 [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_top_sliding2_bg')).";
}
/*html.no-touch */#top_sliding_bar .pix_button.pix_button_2:hover [class*=\"scicon-\"], /*html.no-touch */body .buttonelic.top_sliding2:hover [class*=\"scicon-\"] {
    color: ".stripslashes(get_option('pix_style_button_top_sliding2_texthover')).";
}
"; }

    if ( stripslashes(get_option('pix_style_button_top_sliding2_fx')) == 'expand' ) {
    $css .= "
#top_sliding_bar .pix_button.pix_button_2 > span:last-child, body .buttonelic.top_sliding2 > span:last-child {
    background-color: ".stripslashes(get_option('pix_style_button_top_sliding2_bghover')).";
    bottom: 0;
    top: 0;
}
/*html.no-touch */#top_sliding_bar .pix_button.pix_button_2:hover > span:last-child, /*html.no-touch */body .buttonelic.top_sliding2:hover > span:last-child {
    -moz-border-radius: ".stripslashes(get_option('pix_style_button_top_sliding2_borderradius'))."px;
    border-radius: ".stripslashes(get_option('pix_style_button_top_sliding2_borderradius'))."px;
    left: 0;
    right: 0;
}
/*html.no-touch */#top_sliding_bar .pix_button.pix_button_2:hover, /*html.no-touch */body .buttonelic.top_sliding2:hover {
    border-color: ".stripslashes(get_option('pix_style_button_top_sliding2_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_top_sliding2_texthover')).";
}
"; } else {
    $css .= "
/*html.no-touch */#top_sliding_bar .pix_button.pix_button_2:hover, /*html.no-touch */body .buttonelic.top_sliding2:hover {
    background-color: ".stripslashes(get_option('pix_style_button_top_sliding2_bghover')).";
    border-color: ".stripslashes(get_option('pix_style_button_top_sliding2_bordercolorhover')).";
    color: ".stripslashes(get_option('pix_style_button_top_sliding2_texthover')).";
}
"; }


$css .= stripslashes(get_option('pix_style_custom_css'));

$css = geode_min_css($css);

echo $css;
