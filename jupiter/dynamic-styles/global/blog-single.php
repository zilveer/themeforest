<?php

global $mk_options;

$blogBodySize = ($mk_options['blog_body_font_size'] != '0') ? "font-size:{$mk_options['blog_body_font_size']}px; " : '' ;
$blogBodyLineHeight = ($mk_options['blog_body_line_height'] != '0') ? "line-height:{$mk_options['blog_body_line_height']}em; " : '' ;
$blogBodyWeight = ($mk_options['blog_body_weight'] != '') ? "font-weight:{$mk_options['blog_body_weight']}; " : '' ;
$blogHeadingSize = ($mk_options['blog_heading_size'] != '0') ? "font-size:{$mk_options['blog_heading_size']}px !important; " : '' ;
$blogHeadingWeight = ($mk_options['blog_heading_weight'] != '') ? "font-weight:{$mk_options['blog_heading_weight']} !important; " : '' ;
$blogHeadingTransform = ($mk_options['blog_heading_transform'] != '') ? "text-transform:{$mk_options['blog_heading_transform']} !important; " : '' ;

$blogBodyColor = ($mk_options['blog_body_color'] != '') ? "color:{$mk_options['blog_body_color']} !important; " : '' ;
$blogBodyAColor = ($mk_options['blog_body_a_color'] != '') ? ".mk-single-content p a, .mk-single-content a {color:{$mk_options['blog_body_a_color']} !important;}" : '' ;
$blogBodyAHoverColor = ($mk_options['blog_body_a_color_hover'] != '') ? ".mk-single-content p a:hover, .mk-single-content a:hover {color:{$mk_options['blog_body_a_color_hover']} !important;}" : '' ;
$blogBodyStrongColor = ($mk_options['blog_body_strong_tag_color'] != '') ? ".mk-single-content p strong,.mk-single-content strong {color:{$mk_options['blog_body_strong_tag_color']} !important;}" : '' ;
$blogHeadingColor = ($mk_options['blog_heading_color'] != '') ? "color:{$mk_options['blog_heading_color']} !important; " : '' ;

$blogBodyHeading1Color = ($mk_options['blog_body_h1_color'] != '') ? "color:{$mk_options['blog_body_h1_color']} !important; " : '' ;
$blogBodyHeading2Color = ($mk_options['blog_body_h2_color'] != '') ? "color:{$mk_options['blog_body_h2_color']} !important; " : '' ;
$blogBodyHeading3Color = ($mk_options['blog_body_h3_color'] != '') ? "color:{$mk_options['blog_body_h3_color']} !important; " : '' ;
$blogBodyHeading4Color = ($mk_options['blog_body_h4_color'] != '') ? "color:{$mk_options['blog_body_h4_color']} !important; " : '' ;
$blogBodyHeading5Color = ($mk_options['blog_body_h5_color'] != '') ? "color:{$mk_options['blog_body_h5_color']} !important; " : '' ;
$blogBodyHeading6Color = ($mk_options['blog_body_h6_color'] != '') ? "color:{$mk_options['blog_body_h6_color']} !important; " : '' ;

Mk_Static_Files::addGlobalStyle("

.mk-single-content p{
    {$blogBodySize}
    {$blogBodyLineHeight}
    {$blogBodyWeight}
    {$blogBodyColor}
}
.mk-single-content h1 {
    {$blogBodyHeading1Color}
}
.mk-single-content h2 {
    {$blogBodyHeading2Color}
}
.mk-single-content h3 {
    {$blogBodyHeading3Color}
}
.mk-single-content h4 {
    {$blogBodyHeading4Color}
}
.mk-single-content h5 {
    {$blogBodyHeading5Color}
}
.mk-single-content h6 {
    {$blogBodyHeading6Color}
}

{$blogBodyAColor}
{$blogBodyAHoverColor}
{$blogBodyStrongColor}

.mk-blog-single .blog-single-title, 
.mk-blog-hero .content-holder .the-title{
    {$blogHeadingSize}
    {$blogHeadingTransform}
    {$blogHeadingWeight}
    {$blogHeadingColor}
}
");