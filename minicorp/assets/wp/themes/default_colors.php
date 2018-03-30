<?php

$page_width = IYB_PAGE_WIDTH;

if ( isset( $newdata['use_predefined_page_width'] ) && '1' == $newdata['use_predefined_page_width'] ){
    if ( isset( $newdata['predefined_page_width'] ) && '' != $newdata['predefined_page_width'] ){
        $page_width = $newdata['predefined_page_width'];
    }
}else{
    if ( isset( $newdata['custom_page_width'] ) && '' != $newdata['custom_page_width'] ){
        $page_width = $newdata['custom_page_width'];
    }
}

$responsive_layout_breakingpoint = IYB_BREAKINGPOINT;

if ( isset( $newdata['responsive_layout_breakingpoint'] ) && '' != $newdata['responsive_layout_breakingpoint'] ){
    $responsive_layout_breakingpoint = $newdata['responsive_layout_breakingpoint'];
}

$c1 = ( isset( $newdata['color1'] ) && '' != $newdata['color1'] ) ? $newdata['color1'] : ISH_COLOR_1;
$c2 = ( isset( $newdata['color2'] ) && '' != $newdata['color2'] ) ? $newdata['color2'] : ISH_COLOR_2;
$c3 = ( isset( $newdata['color3'] ) && '' != $newdata['color3'] ) ? $newdata['color3'] : ISH_COLOR_3;
$c4 = ( isset( $newdata['color4'] ) && '' != $newdata['color4'] ) ? $newdata['color4'] : ISH_COLOR_4;

$c_text = ( isset( $newdata['text_color'] ) && '' != $newdata['text_color'] ) ? $newdata['text_color'] : ISH_TEXT_COLOR;
$c_body = ( isset( $newdata['body_color'] ) && '' != $newdata['body_color'] ) ? $newdata['body_color'] : '#ffffff';
$c_background = ( isset( $newdata['background_color'] ) && '' != $newdata['background_color'] ) ? $newdata['background_color'] : '#ffffff';

$c1_rgb = ishyoboy_hex2rgb($c1);
$c2_rgb = ishyoboy_hex2rgb($c2);
$c3_rgb = ishyoboy_hex2rgb($c3);
$c4_rgb = ishyoboy_hex2rgb($c4);
$c_body_rgb = ishyoboy_hex2rgb($c_body);

$c_text_rgb = ishyoboy_hex2rgb($c_text);

global $ish_fonts;

// FONT SETTINGS
ishyoboy_load_font_settings('body_font', $newdata);
ishyoboy_load_font_settings('header_font', $newdata);
ishyoboy_load_font_settings('h1_font', $newdata);
ishyoboy_load_font_settings('h2_font', $newdata);
ishyoboy_load_font_settings('h3_font', $newdata);
ishyoboy_load_font_settings('h4_font', $newdata);
ishyoboy_load_font_settings('h5_font', $newdata);
ishyoboy_load_font_settings('h6_font', $newdata);


foreach ( $ish_fonts as $key => $val){

    switch ( $val['variant'] ){
        case '100' :
            $ish_fonts[$key]['variant'] = '100';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '100italic' :
            $ish_fonts[$key]['variant'] = '100';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '200' :
            $ish_fonts[$key]['variant'] = '200';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '200italic' :
            $ish_fonts[$key]['variant'] = '200';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '300' :
            $ish_fonts[$key]['variant'] = '300';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '300italic' :
            $ish_fonts[$key]['variant'] = '300';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case 'regular' :
            $ish_fonts[$key]['variant'] = '400';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case 'italic' :
            $ish_fonts[$key]['variant'] = '400';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '500' :
            $ish_fonts[$key]['variant'] = '500';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '500italic' :
            $ish_fonts[$key]['variant'] = '500';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '600' :
            $ish_fonts[$key]['variant'] = '600';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '600italic' :
            $ish_fonts[$key]['variant'] = '600';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '700' :
            $ish_fonts[$key]['variant'] = '700';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '700italic' :
            $ish_fonts[$key]['variant'] = '700';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '800' :
            $ish_fonts[$key]['variant'] = '800';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '800italic' :
            $ish_fonts[$key]['variant'] = '800';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '900' :
            $ish_fonts[$key]['variant'] = '900';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '900italic' :
            $ish_fonts[$key]['variant'] = '900';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
    }
}

$images_path = str_replace('http://', '//', IYB_HTML_URI . '/core/images');
$images_path = str_replace('https://', '//', $images_path );

?>
/* *********************************************************************************************************************

7. Skin
7.0 Content width
7.1 Font family
7.2 Font size
7.3 Color
7.4 Shadows
7.5 Images

*/



/* Content width ******************************************************************************************************/
.ish-slider .slide-content > .row,
.boxed .wrapper-all,
.boxed .part-pagebreak,
.unboxed .part-expandable > .row,
.unboxed .part-top-navigation > .row,
.unboxed .part-header > .row,
.unboxed .part-lead > .row,
.unboxed .part-content > .row,
.unboxed .part-fullsection > .row,
.unboxed .part-footer > .row,
.unboxed .part-footer-legals > .row,
.unboxed .part-pagebreak > .row,
#lang_sel_footer {
<?php if ( isset( $newdata['use_responsive_layout'] ) && '0' == $newdata['use_responsive_layout'] ) { ?>
width: <?php echo $page_width;  ?>px;
<?php } else { ?>
max-width: <?php echo $page_width;  ?>px;
<?php } ?>
}
.part-header.sticky-nav .row .grid12 {
<?php if ( isset( $newdata['use_responsive_layout'] ) && '0' == $newdata['use_responsive_layout'] ) { ?>
width: <?php echo ($page_width) - 120;  ?>px !important;
<?php } else { ?>
max-width: <?php echo ($page_width) - 120;  ?>px !important;
<?php } ?>
}
.boxed .part-header.sticky-nav .row .grid12 {
	<?php if ( isset( $newdata['use_responsive_layout'] ) && '0' == $newdata['use_responsive_layout'] ) { ?>
	width: <?php echo ($page_width) - 100;  ?>px !important;
	<?php } else { ?>
	max-width: <?php echo ($page_width) - 100;  ?>px !important;
	<?php } ?>
}

.part-pagebreak.full-width > .row, .part-pagebreak.full-width {
	<?php if ( isset( $newdata['use_responsive_layout'] ) && '0' == $newdata['use_responsive_layout'] ) { ?>
	min-width: <?php echo $page_width;  ?>px !important;
	<?php } ?>
}



/* 7.1 Font family ****************************************************************************************************/

/*
* Font Open Sans
*/
body,
ol li:before,
.wpcf7-not-valid-tip ,
.wpcf7-validation-errors,
.wpcf7-mail-sent-ok {
font-family: <?php echo $ish_fonts['body_font']['name'];  ?>, sans-serif !important;
font-weight: <?php echo $ish_fonts['body_font']['variant']; ?>;
}

p, ul, ol, div {
font-size: <?php echo $ish_fonts['body_font']['size'];  ?>px;
font-style: <?php echo $ish_fonts['body_font']['font-style'];  ?>;
line-height: <?php echo $ish_fonts['body_font']['line_height'];  ?>px;
}

.part-header p, .part-header  ul, .part-header  ol, .part-header  div {
font-family: <?php echo $ish_fonts['header_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['header_font']['size'];  ?>px;
font-style: <?php echo $ish_fonts['header_font']['font-style'];  ?>;
line-height: normal;
}


.main-nav a,
.tinynav{
    font-weight: <?php echo $ish_fonts['header_font']['variant']; ?>;
}

.part-top-navigation p, .part-top-navigation ul, .part-top-navigation ol, .part-top-navigation div {
font-size: 11px;
line-height: normal;
}


/* 7.2 Font size ******************************************************************************************************/

/*
* 50px
*/
.dropcap {
font-size: 50px;
line-height: 48px;
}

/*
* 40px
*/
.logo a {
font-size: 40px;
font-weight: 700;
letter-spacing: -3px;
}

/*
* 30px
*/
.dropcap.bg-dropcap {
font-size: 30px;
line-height: 41px;
}

/*
* 18
*/
.part-top-navigation [class*="icon-"] {
font-size: 18px;
}

/*
* 16px
*/
.hover-links a,
.box.close [class*="icon-cancel"] {
font-size: 16px;
}

/*
* 14px
*/
blockquote,
blockquote p, .pt-link,
.pullquote,
.wpcf7-validation-errors,
.wpcf7-mail-sent-ok {
font-size: 14px !important;
}

/*
* 13px - the same style for accordion / toggle title no matter which tag (h*) is used
*/
.toggle .tgg-title, .accordion .acc-title {
font-size: 13px;
letter-spacing: 0;
font-weight: 400;
line-height: 18px;
}

/*
* 12px
*/
body,
.addForm form,
.main-nav a[href="#search"] + form input[type="submit"] + label,
.main-nav a[href="#search"] + form input[type="submit"] + label input,
.part-header .tinynav {
font-size: 12px;
}

.tagcloud a,
.categories a,
.tooltipster-default .tooltipster-content {
font-size: 12px !important;
}


/*
* 11px
*/
.blog-post-details,
.search-details,
.hover-overlay ul li,
.list-breadcrumbs,
.part-top-navigation {
font-size: 11px;
}



/*
 * Text logo in sticky-nav
*/
.part-header.sticky-nav .row .grid12 .logo a {
font-size: 26px;
line-height: normal;
}


.wpcf7-not-valid-tip {
font-size: 11px !important;
}

/*
* Semibold
*/
ol li:before,
.wpcf7-validation-errors,
.wpcf7-mail-sent-ok {
font-weight: 700;
}

.tinynav option,
.main-nav > ul > li > ul li a {
font-weight: 400;
}

/*
* Italic
*/
blockquote,
blockquote p,
.pullquote {
font-style: italic;
}

/*
* Headlines
*/
h1, .h1, .tp-caption[class*="minicorp_big_"] {
font-family: <?php echo $ish_fonts['h1_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h1_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h1_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h1_font']['font-style'];  ?>;
letter-spacing: -1px;
line-height: <?php echo $ish_fonts['h1_font']['line_height'];  ?>px;
}

h2, .h2,  .tp-caption[class*="minicorp_medium_"] {
font-family: <?php echo $ish_fonts['h2_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h2_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h2_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h2_font']['font-style'];  ?>;
letter-spacing: -1px;
line-height: <?php echo $ish_fonts['h2_font']['line_height'];  ?>px;
}

h3, .h3,  .tp-caption[class*="minicorp_small_"] {
font-family: <?php echo $ish_fonts['h3_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h3_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h3_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h3_font']['font-style'];  ?>;
letter-spacing: -1px;
line-height: <?php echo $ish_fonts['h3_font']['line_height'];  ?>px;
}

h4, .h4 {
font-family: <?php echo $ish_fonts['h4_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h4_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h4_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h4_font']['font-style'];  ?>;
line-height: <?php echo $ish_fonts['h4_font']['line_height'];  ?>px;
}

h5, .h5 {
font-family: <?php echo $ish_fonts['h5_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h5_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h5_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h5_font']['font-style'];  ?>;
line-height: <?php echo $ish_fonts['h5_font']['line_height'];  ?>px;
}

h6, .h6 {
font-family: <?php echo $ish_fonts['h6_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h6_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h6_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h6_font']['font-style'];  ?>;
line-height: <?php echo $ish_fonts['h6_font']['line_height'];  ?>px;
}



/* 7.3 Color **********************************************************************************************************/

/*
* Color example
*/
.color1 .colex:after { content: ".color1 = <?php echo $c1; ?> (orange)"; }
.color2 .colex:after { content: ".color2 = <?php echo $c2; ?> (dark grey)"; }
.color3 .colex:after { content: ".color3 = <?php echo $c3; ?> (light grey)"; }
.color4 .colex:after { content: ".color4 = <?php echo $c4; ?> (white)"; }



/*
* 1.
*/
a,
.logo a:hover,
h1.color1, h2.color1, h3.color1, h4.color1, h5.color1, h6.color1,
.h1.color1, .h2.color1, .h3.color1, .h4.color1, .h5.color1, .h6.color1,
.tp-caption[class*="_color1"],
/*.main-nav ul li.current-menu-ancestor > a,*/
.main-nav ul li.current_page_ancestor > a,
.main-nav ul li.current_page_item > a,
.main-nav ul li.current_page_parent > a,
.main-nav ul li a:hover,
.main-nav ul li a.active,
.main-nav > ul > li.active > a,
.main-nav > ul > li > ul > li:hover > a,
.main-nav > ul > li > ul > li.active > a,
.main-nav > ul > li:hover > a,
.main-nav a[href="#search"]+form input[type="submit"]:hover,
.addForm form input[type="submit"]:hover,
ul.list-square li:before,
ul.list-square-empty li:before,
ul.list-circle li:before,
ul.list-circle-empty li:before,
ul.list-tick li:before,
ul.list-cancel li:before,
ul.list-minus li:before,
ul.list-plus li:before,
ul.list-pointer li:before,
ul.list-square.color1 li:before,
ul.list-square-empty.color1 li:before,
ul.list-circle.color1 li:before,
ul.list-circle-empty.color1 li:before,
ul.list-tick.color1 li:before,
ul.list-cancel.color1 li:before,
ul.list-minus.color1 li:before,
ul.list-plus.color1 li:before,
ul.list-pointer.color1 li:before,
ol li:before,
ol.color4 li:before,
ol li:before,
.dropcap.color1,
.pullquote.color1,
.tooltip-text.color1,
ul li:before,
ul.color1 li:before,
#searchform input[type="submit"]:hover,
.wpcf7-not-valid-tip,
.ish-icon.color1 span,
.part-top-navigation a:hover,
.part-top-navigation ul li ul li a:hover,
.part-top-navigation .top-nav ul li.active > a,
.part-top-navigation [class*="icon-"]:hover,
.part-header .addForm form input[type="submit"]:hover,
blockquote.color1,
pre.color1, code.color1,
.part-expandable .sc-nav-menu.color1 li a,
.part-expandable .sc-nav-menu.color1 li a:hover,
.part-footer .sc-nav-menu.color1 li a,
.part-footer .sc-nav-menu.color1 li a:hover,
.part-expandable .sc-nav-menu li a,
.part-expandable .sc-nav-menu li a:hover,
.part-footer .sc-nav-menu li a,
.part-footer .sc-nav-menu li a:hover{
color: <?php echo $c1; ?>;
}

.part-expandable,
.part-header,
.part-footer,
.part-footer-legals,
.part-top-navigation,
.part-header.sticky-nav .row, .unboxed .part-header.sticky-nav .row {
border-top: 3px solid <?php echo $c1; ?>;
}

/*.main-nav ul li.current-menu-ancestor > a,*/
.main-nav ul li.current_page_ancestor > a,
.main-nav ul li.current_page_item > a,
.main-nav ul li.current_page_parent > a,
.main-nav > ul > li > a:hover,
.main-nav > ul > li > a.active,
.main-nav > ul > li:hover > a,
.main-nav > ul > li.active > a,
.main-nav > ul > li > ul li a:hover,
.main-nav > ul > li > ul li a.active,
.main-nav > ul > li > ul li:hover > a,
.main-nav > ul > li > ul li.active > a {
border-bottom: 3px solid <?php echo $c1; ?>;
}

i.tinynav,
[class*="lined"] span:before,
.box.color1,
blockquote.quote-boxed.color1,
[class*="ish-button-"].color1,
.list-button li a:hover, .list-button li a.active, .list-button li.active a,
.list-skills.color1 div div span,
.list-skills.color1 div div.color1 span,
.list-skills.color2 div div.color1 span,
.list-skills.color3 div div.color1 span,
.list-skills.color4 div div.color1 span,
mark.color1,
.accordion .active .acc-title,
.accordion .acc-title:hover,
.toggle .active .tgg-title,
.toggle .tgg-title:hover,
.tooltip-color1.tooltipster-default,
.tabs-navigation li a:hover,
.tabs-navigation li.active a,
#expandable,
.pagination .current,
.pagination a:hover,
.pullquote.color1.bg-pullquote,
.dropcap.color1.bg-dropcap,
.table-content .highlight.color1,
.table-content .highlight-col.color1,
.timeline > div:after,
.timeline-border.timeline-color1 > div > div,
.audiojs .progress,
#sidebar .widget_nav_menu li a,
.sc-nav-menu.color1 li a,
.ish-icon-square.color1 span,
.ish-icon-circle.color1 span,
.demo_store,
.wpcf7 input[type="submit"],
#sidebar .widget_nav_menu li.current_page_item a,
.sc-nav-menu li.current_page_item a,
.sc-nav-menu.color2 li.current_page_item a,
.sc-nav-menu.color3 li.current_page_item a,
.sc-nav-menu.color4 li.current_page_item a,
.tabs-navigation.color1 li a,
.tabs-navigation.color3 li.active a,
.tabs-navigation.color3 li a:hover,
.tabs-navigation.color4 li.active a,
.tabs-navigation.color4 li a:hover {
background: <?php echo $c1; ?> !important;
}

#commentform input[type="submit"] {
background: <?php echo $c1; ?>;
}

.table-content .highlight-col.color1.even,
.table-content tr:nth-child(even) .highlight.color1,
.table-content tr:nth-child(even).highlight.color1 {
background: <?php echo $c1; ?> !important;
background: rgba(<?php echo $c1_rgb; ?>, 0.9) !important;
}

::-moz-selection { background: <?php echo $c1; ?>; }
::selection { background: <?php echo $c1; ?>; }

.ish-slider .slide-image img+.caption *,
.tp-caption[class*="color1_with_bg"],
.hover-overlay {
background: <?php echo $c1; ?>;
background: rgba(<?php echo $c1_rgb; ?>, 0.95);
}

.ish-slider .flex-control-nav li a.flex-active, .ish-slider .flex-control-nav li a:hover {
border-color: <?php echo $c1; ?>;
border-color: rgba(<?php echo $c1_rgb; ?>, 0.8) !important;
}

.tooltip-color1 .tooltipster-arrow span {
border-top-color: <?php echo $c1; ?> !important;
}

.tooltip-text.color1,
.rounded-image.color1 > div {
border-color: <?php echo $c1; ?>;
}

.timeline .timeline-border.timeline-color1:first-child > div > div:after {
border-left-color: <?php echo $c1; ?>;
}


<?php if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) { ?>
@media all and (max-width: 480px) {
    .timeline .timeline-border.timeline-color1:first-child > div > div:after {
        border-right-color: <?php echo $c1; ?> !important;
    }
}
<?php } ?>


.timeline .timeline-border.timeline-color1:last-child > div > div:after {
border-right-color: <?php echo $c1; ?>;
}

.part-fullsection.bg-color1 {
background-color: <?php echo $c1; ?>;
background-color: rgba(<?php echo $c1_rgb; ?>, 1);
}

.rounded-image.ri-arrow.color1:after,
.rounded-image.ri-arrow.ri-arrow-bottom.color1:after {
border-top-color: <?php echo $c1; ?>;
}
.rounded-image.ri-arrow.ri-arrow-top.color1:after {
border-color: transparent;
border-bottom-color: <?php echo $c1; ?>;
}
.rounded-image.ri-arrow.ri-arrow-left.color1:after {
border-color: transparent;
border-right-color: <?php echo $c1; ?>;
}
.rounded-image.ri-arrow.ri-arrow-right.color1:after {
border-color: transparent;
border-left-color: <?php echo $c1; ?>;
}

<?php if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) { ?>
@media all and (max-width: <?php echo $responsive_layout_breakingpoint; ?>px) {
    .rounded-image.ri-arrow.ri-arrow-left.color1:after,
    .rounded-image.ri-arrow.ri-arrow-right.color1:after {
        border-color: transparent !important;
        border-top-color: <?php echo $c1; ?> !important;
    }
}
<?php } ?>


/*
* 2.
*/

body,
.logo a,
.main-nav ul li a,
.main-nav a[href="#search"]+form input[type="submit"],
[class*="ish-button-"].color3,
[class*="ish-button-"].color4,
[class*="ish-button-"]:hover,
[class*="ish-button-"].color3 [class*="ish-icon"] span,
[class*="ish-button-"].color4 [class*="ish-icon"] span,
[class*="ish-button-"]:hover [class*="ish-icon"] span,
.box.color3,
.box.color4,
blockquote,
blockquote.quote-boxed.color3,
blockquote.quote-boxed.color4,
blockquote.quote-boxed.color3 cite a,
blockquote.quote-boxed.color4 cite a,
ul.categories a,
.tagcloud a,
.list-button li a,
.list-skills.color3 div div span,
.list-skills.color4 div div span,
mark.color3,
mark.color4,
.dropcap,
.pullquote,
.tooltip-color3.tooltipster-default,
.tooltip-color4.tooltipster-default,
.tabs-navigation li a,
#expandable:hover,
.pagination a,
.pullquote.color3.bg-pullquote,
.pullquote.color4.bg-pullquote,
.dropcap.color3.bg-dropcap,
.dropcap.color4.bg-dropcap,
.tooltip-text,
.rounded-image a,
input, textarea,
#searchform input[type="submit"],
#sidebar .widget_nav_menu li a:hover,
.sc-nav-menu li a:hover,
.sc-nav-menu.color3 li a,
.sc-nav-menu.color4 li a,
.sc-nav-menu.color3 li.current_page_item a:hover,
.sc-nav-menu.color4 li.current_page_item a:hover,
.ish-icon span,
.ish-icon-square.color3 span,
.ish-icon-square.color4 span,
.ish-icon-square.color1 a:hover span,
.ish-icon-square a:hover span,
.ish-icon-circle.color3 span,
.ish-icon-circle.color4 span,
.ish-icon-circle.color1 a:hover span,
.ish-icon-circle a:hover span,
.part-top-navigation ul ul a:hover,
.part-top-navigation,
.part-top-navigation a,
.part-header .addForm form input[type="submit"],
.woocommerce .product-categories a,
#commentform input[type="submit"]:hover,
.wpcf7 input[type="submit"]:hover,
pre, code,
.tabs-navigation.color3 li a,
.tabs-navigation.color4 li a,
.timeline-border.timeline-color3 > div > div,
.timeline-border.timeline-color4 > div > div,
.tinynav,
.list-skills.color1 div div.color3 span,
.list-skills.color2 div div.color3 span,
.list-skills.color3 div div.color3 span,
.list-skills.color4 div div.color3 span,
.list-skills.color1 div div.color4 span,
.list-skills.color2 div div.color4 span,
.list-skills.color3 div div.color4 span,
.list-skills.color4 div div.color4 span,
.about_paypal
{
color: <?php echo $c_text; ?>;
}

h1.color2, h2.color2, h3.color2, h4.color2, h5.color2, h6.color2,
.h1.color2, .h2.color2, .h3.color2, .h4.color2, .h5.color2, .h6.color2,
.tp-caption[class*="_color2"],
blockquote.color2,
.dropcap.color2,
.pullquote.color2,
.tooltip-text.color2,
ul.list-square.color2 li:before,
ul.list-square-empty.color2 li:before,
ul.list-circle.color2 li:before,
ul.list-circle-empty.color2 li:before,
ul.list-tick.color2 li:before,
ul.list-cancel.color2 li:before,
ul.list-minus.color2 li:before,
ul.list-plus.color2 li:before,
ul.list-pointer.color2 li:before,
ol.color2 li:before,
ul.color2 li:before,
.ish-icon.color2 span,
.ish-icon-square.color2 a:hover span,
.ish-icon-circle.color2 a:hover span,
.part-expandable .sc-nav-menu.color2 li a,
.part-expandable .sc-nav-menu.color2 li a:hover,
.part-footer .sc-nav-menu.color2 li a,
.part-footer .sc-nav-menu.color2 li a:hover{
color: <?php echo $c2; ?>;
}

.tp-caption[class*="color3_with_bg"], .tp-caption[class*="color4_with_bg"]{
color: <?php echo $c_text; ?>!important;
}

pre.color2, code.color2 {
color: <?php echo $c2; ?>;
}

.part-footer,
.part-footer-legals,
h1[class*="icon-"]:before, h2[class*="icon-"]:before, h3[class*="icon-"]:before, h4[class*="icon-"]:before, h5[class*="icon-"]:before, h6[class*="icon-"]:before,
.h1[class*="icon-"]:before, .h2[class*="icon-"]:before, .h3[class*="icon-"]:before, .h4[class*="icon-"]:before, .h5[class*="icon-"]:before, .h6[class*="icon-"]:before,
.box,
.box.color2,
blockquote.quote-boxed,
blockquote.quote-boxed.color2,
[class*="ish-button-"],
[class*="ish-button-"].color2,
.list-skills div div span,
.list-skills.color2 div div span,
.list-skills.color1 div div.color2 span,
.list-skills.color2 div div.color2 span,
.list-skills.color3 div div.color2 span,
.list-skills.color4 div div.color2 span,
mark,
mark.color2,
.tooltipster-default,
.tooltip-color2.tooltipster-default,
.part-expandable,
.pullquote.bg-pullquote,
.pullquote.color2.bg-pullquote,
.dropcap.bg-dropcap,
.table-content .highlight-col,
.table-content .highlight-col.color2,
.table-content .highlight,
.table-content .highlight.color2,
.timeline-border.timeline-color2 > div > div,
.sc-nav-menu li a,
.sc-nav-menu.color2 li a,
.ish-icon-square span,
.ish-icon-square.color2 span,
.ish-icon-circle span,
#sidebar .widget_nav_menu li a,
.ish-icon-circle.color2 span,
.sc-nav-menu.color1 li.current_page_item a,
.tabs-navigation li a,
.tabs-navigation.color2 li a,
.tabs-navigation.color1 li.active a,
.tabs-navigation.color1 li a:hover {
background-color: <?php echo $c2; ?> !important;
}

.table-content .highlight-col.even,
.table-content .highlight-col.color2.even,
.table-content tr:nth-child(even) .highlight,
.table-content tr:nth-child(even).highlight,
.table-content tr:nth-child(even) .highlight.color2,
.table-content tr:nth-child(even).highlight.color2 {
background: <?php echo $c2; ?> !important;
background: rgba(<?php echo $c2_rgb; ?>, 0.9) !important;
}

.slidable .flex-control-nav li a.flex-active, .slidable .flex-control-nav li a:hover {
border-color: <?php echo $c2; ?>;
border-color: rgba(<?php echo $c2_rgb; ?>, 0.5);
border-color: rgba(<?php echo $c2_rgb; ?>, 0.5);
}

.part-top-navigation .top-nav a[href="#top-nav-separator"] {
border-color: <?php echo $c2; ?>;
border-color: rgba(<?php echo $c2_rgb; ?>, 0.25);
}

.tooltipster-arrow span,
.tooltip-color2 .tooltipster-arrow span {
border-top-color: <?php echo $c2; ?>;
}

/* Blog & Search results tags */
.blog-post-details span[class*="icon-"],
.blog-post-details a,
.search-details span[class*="icon-"],
.search-details span a,
.part-top-navigation [class*="icon-"],
.portfolio-style-2 .portfolio-item ul, .portfolio-style-3 .portfolio-item ul, .portfolio-style-4 .portfolio-item ul,
.portfolio-style-2 .portfolio-item ul a, .portfolio-style-3 .portfolio-item ul a, .portfolio-style-4 .portfolio-item ul a
{
color: <?php echo $c_text; ?>;
color: rgba(<?php echo $c_text_rgb; ?>, 0.5);
}

/*
* Placeholder
*/
:-moz-placeholder {
color: <?php echo $c_text; ?>;
color: rgba(<?php echo $c_text_rgb; ?>, 0.5);
}
::-webkit-input-placeholder {
color: <?php echo $c_text; ?>;
color: rgba(<?php echo $c_text_rgb; ?>, 0.5);
}
.placeholder {
color: <?php echo $c_text; ?>;
color: rgba(<?php echo $c_text_rgb; ?>, 0.5);
}

pre, code {
color: <?php echo $c_text; ?>;
color: rgba(<?php echo $c_text_rgb; ?>, 0.75);
}

pre, code {
background: <?php echo $c2; ?>;
background: rgba(<?php echo $c2_rgb; ?>, 0.05);
}

.tooltip-text,
.tooltip-text.color2,
.rounded-image > div,
.rounded-image.color2 > div {
border-color: <?php echo $c2; ?>;
}

.timeline .timeline-border.timeline-color2:first-child > div > div:after {
border-left-color: <?php echo $c2; ?>;
}

<?php if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) { ?>
@media all and (max-width: 480px) {
    .timeline .timeline-border.timeline-color2:first-child > div > div:after {
        border-right-color: <?php echo $c2; ?> !important;
    }
}
<?php } ?>

.timeline .timeline-border.timeline-color2:last-child > div > div:after {
border-right-color: <?php echo $c2; ?>;
}

.part-fullsection.bg-color2 {
background-color: <?php echo $c2; ?>;
background-color: rgba(<?php echo $c2_rgb; ?>, 1);
}

.tp-caption[class*="color2_with_bg"]{
background: <?php echo $c2; ?>;
background: rgba(<?php echo $c2_rgb; ?>, 0.95);
}

.rounded-image.ri-arrow.ri-arrow-bottom:after,
.rounded-image.ri-arrow.ri-arrow-bottom.color2:after {
border-top-color: <?php echo $c2; ?>;
}
.rounded-image.ri-arrow.ri-arrow-top.color2:after {
border-color: transparent;
border-bottom-color: <?php echo $c2; ?>;
}
.rounded-image.ri-arrow.ri-arrow-left.color2:after {
border-color: transparent;
border-right-color: <?php echo $c2; ?>;
}
.rounded-image.ri-arrow.ri-arrow-right.color2:after {
border-color: transparent;
border-left-color: <?php echo $c2; ?>;
}

<?php if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) { ?>
@media all and (max-width: <?php echo $responsive_layout_breakingpoint; ?>px) {
    .rounded-image.ri-arrow.ri-arrow-left:after,
    .rounded-image.ri-arrow.ri-arrow-right:after,
    .rounded-image.ri-arrow.ri-arrow-left.color2:after,
    .rounded-image.ri-arrow.ri-arrow-right.color2:after {
        border-color: transparent !important;
        border-top-color: <?php echo $c2; ?> !important;
    }
}
<?php } ?>


/*
* 3.
*/
h1.color3, h2.color3, h3.color3, h4.color3, h5.color3, h6.color3,
.h1.color3, .h2.color3, .h3.color3, .h4.color3, .h5.color3, .h6.color3,
.tp-caption[class*="_color3"],
.part-footer, .part-footer-legals,
.part-expandable,
.widget_ishyoboy-social-widget ul.social a:hover,
.dropcap.color3,
.pullquote.color3,
.box.close [class*="icon-cancel"]:hover,
.tooltip-text.color3,
ul.list-square.color3 li:before,
ul.list-square-empty.color3 li:before,
ul.list-circle.color3 li:before,
ul.list-circle-empty.color3 li:before,
ul.list-tick.color3 li:before,
ul.list-cancel.color3 li:before,
ul.list-minus.color3 li:before,
ul.list-plus.color3 li:before,
ul.list-pointer.color3 li:before,
ol.color3 li:before,
ul.color3 li:before,
.ish-icon.color3 span,
.ish-icon.color1 a:hover span,
.ish-icon a:hover span ,
.ish-icon.color2 a:hover span,
.ish-icon.color4 a:hover span,
blockquote.color3,
pre.color3, code.color3,
.part-expandable .sc-nav-menu.color3 li a,
.part-expandable .sc-nav-menu.color3 li a:hover,
.part-footer .sc-nav-menu.color3 li a,
.part-footer .sc-nav-menu.color3 li a:hover,
.part-footer .sc-nav-menu.color3 li.current_page_item a,
.part-footer .sc-nav-menu.color3 li.current_page_item a:hover,
.woocommerce #searchform input[type="submit"] {
color: <?php echo $c3; ?>;
}

.tinynav,
.addForm,
[class*="lined"] span:after,
.box.color3,
blockquote.quote-boxed.color3,
[class*="ish-button-"].color3,
[class*="ish-button-"]:hover,
[class*="ish-button-"].color4:hover,
.list-button li a,
.list-skills div div,
.list-skills.color3 div div span,
.list-skills.color1 div div.color3 span,
.list-skills.color2 div div.color3 span,
.list-skills.color3 div div.color3 span,
.list-skills.color4 div div.color3 span,
mark.color3,
.accordion .acc-title,
.toggle .tgg-title,
.tooltip-color3.tooltipster-default,
.pullquote.color3.bg-pullquote,
.dropcap.color3.bg-dropcap,
#sidebar .widget_nav_menu li a:hover,
.sc-nav-menu.color3 li a,
.sc-nav-menu li a:hover,
.sc-nav-menu.color4 li a:hover,
.ish-icon-square.color3 span,
.ish-icon-square.color1 a:hover span,
.ish-icon-square a:hover span,
.ish-icon-square.color2 a:hover span,
.ish-icon-square.color4 a:hover span,
.ish-icon-circle.color3 span,
.ish-icon-circle.color1 a:hover span,
.ish-icon-circle a:hover span,
.ish-icon-circle.color2 a:hover span,
.ish-icon-circle.color4 a:hover span,
.part-top-navigation,
.part-top-navigation a,
.woocommerce select,
.woocommerce .product-categories a,
#commentform input[type="submit"]:hover,
.wpcf7 input[type="submit"]:hover,
.tabs-navigation.color3 li a,
.part-expandable    .widget_archive select,
.right-sidebar      .widget_archive select,
.left-sidebar       .widget_archive select,
.part-footer        .widget_archive select,
.part-footer-legals .widget_archive select,
.part-expandable    .widget_categories select,
.right-sidebar      .widget_categories select,
.left-sidebar       .widget_categories select,
.part-footer        .widget_categories select,
.part-footer-legals .widget_categories select {
background: <?php echo $c3; ?> !important;
}

ul.categories a,
.tagcloud a,
.pagination a, .pagination .current,
.timeline-border.timeline-color3 > div > div,
input, textarea{
background: <?php echo $c3; ?>;
}

.lined span:after {
/*border-bottom: 1px solid <?php echo $c3; ?>;*/
}

.slidable .flex-control-nav li a {
border: 5px solid <?php echo $c3; ?>;
}

.ish-slider .flex-control-nav li a,
pre, code,
.tabs-content > div {
border-color: <?php echo $c3; ?>;
border-color: rgba(<?php echo $c3_rgb; ?>, 0.8);
}


.main-nav > ul > li > ul li a,
.part-top-navigation .top-nav ul li ul li a
{
border-top-color: <?php echo $c3; ?>;
border-top-color: rgba(<?php echo $c3_rgb; ?>, 0.5);
}

.tp-caption[class*="color3_with_bg"]{
background: <?php echo $c3; ?>;
background: rgba(<?php echo $c3_rgb; ?>, 0.95);
}

select.tinynav {
border: 1px solid <?php echo $c3; ?>;
}

.tooltip-color3 .tooltipster-arrow span {
border-top-color: <?php echo $c3; ?> !important;
}

.tooltip-text.color3,
.table-content th, .table-content tr, .table-content td,
.timeline > div:before,
.timeline-border > div > div,
.rounded-image.color3 > div,
.woocommerce .woocommerce-tabs .panel {
border-color: <?php echo $c3; ?>;
}

.table-striped tr:nth-child(even),
.table-bg tr:nth-child(even) {
background: <?php echo $c3; ?>;
background: rgba(<?php echo $c3_rgb; ?>, 0.5);
}

.table-bg tr:nth-child(odd) {
background: <?php echo $c3; ?>;
background: rgba(<?php echo $c3_rgb; ?>, 0.75);
}

.timeline .timeline-border.timeline-color3:first-child > div > div:after {
border-left-color: <?php echo $c3; ?>;
}

<?php if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) { ?>
@media all and (max-width: 480px) {
    .timeline .timeline-border.timeline-color3:first-child > div > div:after {
        border-right-color: <?php echo $c3; ?> !important;
    }
}
<?php } ?>

.timeline .timeline-border.timeline-color3:last-child > div > div:after {
border-right-color: <?php echo $c3; ?>;
}

.timeline .timeline-border:first-child > div > div:after {
border-left-color: <?php echo $c3; ?>;
}

<?php if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) { ?>
@media all and (max-width: 480px) {
    .timeline .timeline-border:first-child > div > div:after {
        border-right-color: <?php echo $c3; ?> !important;
    }
}
<?php } ?>

.timeline .timeline-border:last-child > div > div:after {
border-right-color: <?php echo $c3; ?>;
}

.part-fullsection.bg-color3 {
background-color: <?php echo $c3; ?>;
background-color: rgba(<?php echo $c3_rgb; ?>, 1);
}

.rounded-image.ri-arrow.color3:after,
.rounded-image.ri-arrow.ri-arrow-bottom.color3:after {
border-top-color: <?php echo $c3; ?>;
}
.rounded-image.ri-arrow.ri-arrow-top.color3:after {
border-color: transparent;
border-bottom-color: <?php echo $c3; ?>;
}
.rounded-image.ri-arrow.ri-arrow-left.color3:after {
border-color: transparent;
border-right-color: <?php echo $c3; ?>;
}
.rounded-image.ri-arrow.ri-arrow-right.color3:after {
border-color: transparent;
border-left-color: <?php echo $c3; ?>;
}

<?php if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) { ?>
@media all and (max-width: <?php echo $responsive_layout_breakingpoint; ?>px) {
    .rounded-image.ri-arrow.ri-arrow-left.color3:after,
    .rounded-image.ri-arrow.ri-arrow-right.color3:after {
        border-color: transparent !important;
        border-top-color: <?php echo $c3; ?> !important;
    }
}
<?php } ?>


/*
* 4.
*/
i.tinynav,
h1.color4, h2.color4, h3.color4, h4.color4, h5.color4, h6.color4,
.h1.color4, .h2.color4, .h3.color4, .h4.color4, .h5.color4, .h6.color4,
h1[class*="icon-"]:before, h2[class*="icon-"]:before, h3[class*="icon-"]:before, h4[class*="icon-"]:before, h5[class*="icon-"]:before, h6[class*="icon-"]:before,
.h1[class*="icon-"]:before, .h2[class*="icon-"]:before, .h3[class*="icon-"]:before, .h4[class*="icon-"]:before, .h5[class*="icon-"]:before, .h6[class*="icon-"]:before,
.tp-caption[class*="_color4"], .tp-caption[class*="color1_with_bg"], .tp-caption[class*="color2_with_bg"],
.box.success, .box.warning, .box.info, .box.error,
.box,
.box.success a, .box.warning a, .box.info a, .box.error a,
blockquote.color4,
blockquote.quote-boxed,
blockquote.quote-boxed.color2,
blockquote.quote-boxed cite a,
blockquote.quote-boxed.color2 cite a,
[class*="ish-button-"],
[class*="ish-button-"] [class*="ish-icon"] span,
.ish-slider .slide-image img+.caption *,
.hover-overlay,
.hover-overlay a,
.list-button li a:hover, .list-button li a.active, .list-button li.active a,
.list-skills div div span,
mark,
.dropcap.color4,
.pullquote.color4,
.accordion .active .acc-title,
.accordion .acc-title:hover,
.toggle .active .tgg-title,
.toggle .tgg-title:hover,
.box.close [class*="icon-cancel"],
.tooltipster-default,
.tabs-navigation li a:hover,
.tabs-navigation li.active a,
.tabs-navigation li a,
.tabs-navigation.color2 li a,
#expandable,
.pagination .current,
.pagination a:hover,
.pullquote.color1.bg-pullquote,
.pullquote.bg-pullquote,
.pullquote.color2.bg-pullquote,
.dropcap.bg-dropcap,
.tooltip-text.color4,
.table-content .highlight,
.table-content .highlight-col,
.timeline-border.timeline-color1 > div > div,
.timeline-border.timeline-color2 > div > div,
.part-fullsection.bg-color1,
.part-fullsection.bg-color2,
ul.list-square.color4 li:before,
ul.list-square-empty.color4 li:before,
ul.list-circle.color4 li:before,
ul.list-circle-empty.color4 li:before,
ul.list-tick.color4 li:before,
ul.list-cancel.color4 li:before,
ul.list-minus.color4 li:before,
ul.list-plus.color4 li:before,
ul.list-pointer.color4 li:before,
ol.color4 li:before,
ul.color4 li:before,
.wpcf7-validation-errors,
.wpcf7-mail-sent-ok,
#sidebar .widget_nav_menu li a,
.sc-nav-menu li a,
.sc-nav-menu.color3 li.current_page_item a,
.sc-nav-menu.color4 li.current_page_item a,
.ish-icon.color4 span,
.ish-icon.color3 a:hover span,
.ish-icon-square.color1 span,
.ish-icon-square span,
.ish-icon-square.color2 span,
.ish-icon-circle.color1 span,
.ish-icon-circle span,
.ish-icon-circle.color2 span,
#commentform input[type="submit"],
.wpcf7 input[type="submit"],
pre.color4, code.color4,
.part-expandable .sc-nav-menu.color4 li a,
.part-expandable .sc-nav-menu.color4 li a:hover,
.part-footer .sc-nav-menu.color4 li a,
.part-footer .sc-nav-menu.color4 li a:hover,
.part-footer .sc-nav-menu.color4 li.current_page_item a,
.part-footer .sc-nav-menu.color4 li.current_page_item a:hover {
color: <?php echo $c4; ?>;
}

::-moz-selection { color: <?php echo $c4; ?>; }
::selection { color: <?php echo $c4; ?>; }

.box.color4,
blockquote.quote-boxed.color4,
[class*="ish-button-"].color4,
[class*="ish-button-"].color3:hover,
.box.color3 [class*="ish-button-"]:hover,
.slidable .flex-control-nav li a,
.list-skills.color3 div div,
.list-skills.color4 div div span,
.list-skills.color1 div div.color3,
.list-skills.color2 div div.color3,
.list-skills.color3 div div.color3,
.list-skills.color4 div div.color3,
.list-skills.color1 div div.color4 span,
.list-skills.color2 div div.color4 span,
.list-skills.color3 div div.color4 span,
.list-skills.color4 div div.color4 span,
.fixed-top:hover,
mark.color4,
.tooltip-color4.tooltipster-default,
.pullquote.color4.bg-pullquote,
.dropcap.color4.bg-dropcap,
.timeline-border.timeline-color4 > div > div,
.sc-nav-menu.color4 li a,
.sc-nav-menu.color3 li a:hover,
.ish-icon-square.color4 span,
.ish-icon-square.color3 a:hover span,
.ish-icon-circle.color4 span,
.ish-icon-circle.color3 a:hover span,
.tabs-navigation.color4 li a {
background: <?php echo $c4; ?> !important;
}

.woocommerce .product-categories a:hover, .woocommerce .product-categories .current-cat a {
background-color: <?php echo $c4; ?> !important;
}

ul.categories a:hover,
.tagcloud a:hover{
background-color: <?php echo $c4; ?>;
}

.tp-caption[class*="color4_with_bg"] {
background: <?php echo $c4; ?>;
background: rgba(<?php echo $c4_rgb; ?>, 0.95);
}

.part-header.sticky-nav .row {
background: <?php echo $c_body; ?>;
background: rgba(<?php echo $c_body_rgb; ?>, 0.98);
}

.fixed-top {
background: <?php echo $c4; ?>;
background: rgba(<?php echo $c4_rgb; ?>, 0.5);
}

.tooltip-color4 .tooltipster-arrow span {
border-top-color: <?php echo $c4; ?> !important;
}

.tooltip-text.color4,
.rounded-image.color4 > div {
border-color: <?php echo $c4; ?>;
}

.timeline .timeline-border.timeline-color4:first-child > div > div:after {
border-left-color: <?php echo $c4; ?>;
}

<?php if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) { ?>
@media all and (max-width: 480px) {
    .timeline .timeline-border.timeline-color4:first-child > div > div:after {
        border-right-color: <?php echo $c4; ?> !important;
    }
}
<?php } ?>

.timeline .timeline-border.timeline-color4:last-child > div > div:after {
border-right-color: <?php echo $c4; ?>;
}

.part-fullsection.bg-color4 {
background-color: <?php echo $c4; ?>;
background-color: rgba(<?php echo $c4_rgb; ?>, 1);
}

.rounded-image.ri-arrow.color4:after,
.rounded-image.ri-arrow.ri-arrow-bottom.color4:after {
border-top-color: <?php echo $c4; ?>;
}
.rounded-image.ri-arrow.ri-arrow-top.color4:after {
border-color: transparent;
border-bottom-color: <?php echo $c4; ?>;
}
.rounded-image.ri-arrow.ri-arrow-left.color4:after {
border-color: transparent;
border-right-color: <?php echo $c4; ?>;
}
.rounded-image.ri-arrow.ri-arrow-right.color4:after {
border-color: transparent;
border-left-color: <?php echo $c4; ?>;
}

<?php if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) { ?>
@media all and (max-width: <?php echo $responsive_layout_breakingpoint; ?>px) {
    .rounded-image.ri-arrow.ri-arrow-left.color4:after,
    .rounded-image.ri-arrow.ri-arrow-right.color4:after {
        border-color: transparent !important;
        border-top-color: <?php echo $c4; ?> !important;
    }
}
<?php } ?>

/*
* 5. Body
*/
.wrapper-all,
.main-nav > ul > li > ul li,
.main-nav a[href="#search"]+form,
.part-top-navigation ul ul a:hover,
.part-top-navigation ul li ul li a,
.part-top-navigation .tinynav{
background-color: <?php echo $c_body; ?> !important;
}

.ish-slider .slide-content > .row {
background-color: <?php echo $c_body; ?>;
background-color: rgba(<?php echo $c_body_rgb; ?>, 0.85);
}

<?php if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) { ?>
/* iPhone [portrait + landscape] */
@media only screen and (max-device-width: 480px) {
    .part-header select.tinynav {
        border-color: <?php echo $c_body; ?> !important;
        height: 27px !important;
        margin-top: 1px;
    }
}
<?php } ?>

/*
* 6. Background
*/
.boxed{
background-color: <?php echo $c_background; ?>;
}


/*
* Success, warning, info, error
*/
.box.success, .wpcf7-mail-sent-ok { background: #8ec017 !important; }
.box.warning { background: #f8c102 !important; }
.box.info { background: #38a3cf !important; }
.box.error, .wpcf7-validation-errors { background: #e53512 !important; }



/*
* transparent
*/
.main-nav > ul > li > a,
.main-nav > ul > li > ul li a {
border-bottom: 3px solid transparent;
}

/*
* None
*/
.slidable .flex-control-nav li a {
background: none !important;
}



/* 7.4 Shadows ********************************************************************************************************/

/*
* Header and content part
*/
.part-header , .part-content,
.main-nav > ul > li ul,
.timeline-border > div > div {
-moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.09);
-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.0.9);
box-shadow: 0 0 10px rgba(0, 0, 0, 0.09);
}

/*
* Boxed version whole page
*/
.boxed .wrapper-all,
.part-header.sticky-nav .row {
-moz-box-shadow: 0 0 30px rgba(0, 0, 0, 0.35);
-webkit-box-shadow: 0 0 30px rgba(0, 0, 0, 0.35);
box-shadow: 0 0 30px rgba(0, 0, 0, 0.35);
}

/*
* Navigation
*/
.part-top-navigation .top-nav ul li ul {
-moz-box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
-webkit-box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

/*
* Ish slider / Slidable - circle navigation
*/
.flex-control-nav li a {
-moz-box-shadow: 0 0 10px rgba(<?php echo $c3_rgb; ?>, 0.5);
-webkit-box-shadow: 0 0 10px rgba(<?php echo $c3_rgb; ?>, 0.5);
box-shadow: 0 0 10px rgba(<?php echo $c3_rgb; ?>, 0.5);
}

/* IE8 border replacement for shadows */
.ie8 .part-header {
border-bottom: 1px solid <?php echo $c3; ?> !important;
}
.ie8 .part-content, .ie8 .part-fullsection {
border-top: 1px solid <?php echo $c3; ?> !important;
}



/* 7.5 Images *********************************************************************************************************/

/*
* Main stripes pattern
*/
.wrapper-all,
.ish-slider .slide-content > .row,
.part-fullsection.bg-pattern {
background-position: 0 0;
background-repeat: repeat;
}

.part-expandable, .part-footer,
.part-fullsection.bg-color2.bg-pattern {
background-position: top center;
background-repeat: repeat;
}

<?php
// EXPANDABLE PATTERN
$pattern = '';
$id = 'expandable';
if ( isset($newdata['use_' . $id . '_pattern'] ) && ( '1' == $newdata['use_' . $id . '_pattern'] ) && ( '' != $newdata[ $id . '_bg_pattern'] ) ) {
    $pattern = $images_path . '/bg-patterns/' . $newdata[ $id . '_bg_pattern'];
} else{
    if ( isset($newdata[$id . '_bg_image'] ) && ( '' != $newdata[$id . '_bg_image'] ) ) {
        $pattern = $newdata[ $id . '_bg_image'];
    }
}
if ( '' != $pattern ){
    echo '.part-' . $id . ' { background-image: url(\'' . $pattern . '\') !important; }';
}
?>

<?php
// HEADER PATTERN
$pattern = '';
$id = 'header';
if ( isset($newdata['use_' . $id . '_pattern'] ) && ( '1' == $newdata['use_' . $id . '_pattern'] ) && ( '' != $newdata[ $id . '_bg_pattern'] ) ) {
    $pattern = $images_path . '/bg-patterns/' . $newdata[ $id . '_bg_pattern'];
} else{
    if ( isset($newdata[$id . '_bg_image'] ) && ( '' != $newdata[$id . '_bg_image'] ) ) {
        $pattern = $newdata[ $id . '_bg_image'];
    }
}
if ( '' != $pattern ){
    echo '.part-' . $id . ', .part-' . $id . '.sticky-nav .row { background-image: url(\'' . $pattern . '\') !important; }';
}
?>

<?php
// LEAD PATTERN
$pattern = '';
$id = 'lead';
if ( isset($newdata['use_' . $id . '_pattern'] ) && ( '1' == $newdata['use_' . $id . '_pattern'] ) && ( '' != $newdata[ $id . '_bg_pattern'] ) ) {
    $pattern = $images_path . '/bg-patterns/' . $newdata[ $id . '_bg_pattern'];
} else{
    if ( isset($newdata[$id . '_bg_image'] ) && ( '' != $newdata[$id . '_bg_image'] ) ) {
        $pattern = $newdata[ $id . '_bg_image'];
    }
}
if ( '' != $pattern ){
    echo '.part-' . $id . ' { background-image: url(\'' . $pattern . '\') !important; }';
}
?>

<?php
// CONTENT PATTERN
$pattern = '';
$id = 'content';
if ( isset($newdata['use_' . $id . '_pattern'] ) && ( '1' == $newdata['use_' . $id . '_pattern'] ) && ( '' != $newdata[ $id . '_bg_pattern'] ) ) {
    $pattern = $images_path . '/bg-patterns/' . $newdata[ $id . '_bg_pattern'];
} else{
    if ( isset($newdata[$id . '_bg_image'] ) && ( '' != $newdata[$id . '_bg_image'] ) ) {
        $pattern = $newdata[ $id . '_bg_image'];
    }
}
if ( '' != $pattern ){
    echo '.part-' . $id . ', .ish-slider .slide-content > .row, .part-fullsection.bg-pattern { background-image: url(\'' . $pattern . '\') !important; }';
}
?>


<?php
// FOOTER PATTERN
$pattern = '';
$id = 'footer';
if ( isset($newdata['use_' . $id . '_pattern'] ) && ( '1' == $newdata['use_' . $id . '_pattern'] ) && ( '' != $newdata[ $id . '_bg_pattern'] ) ) {
    $pattern = $images_path . '/bg-patterns/' . $newdata[ $id . '_bg_pattern'];
} else{
    if ( isset($newdata[$id . '_bg_image'] ) && ( '' != $newdata[$id . '_bg_image'] ) ) {
        $pattern = $newdata[ $id . '_bg_image'];
    }
}
if ( '' != $pattern ){
    echo '.part-' . $id . ', .part-fullsection.bg-color2.bg-pattern { background-image: url(\'' . $pattern . '\') !important; }';
}
?>

/*
* Backgrounds
*/

.boxed {
background-position: top center;
background-repeat: repeat;
}

<?php
$pattern = '';
$image_styles = '';
if ( isset($newdata['use_background_pattern'] ) && ( '1' == $newdata['use_background_pattern'] ) && ( '' != $newdata['background_bg_pattern'] ) ) {
    $pattern = $images_path . '/bg-patterns/' . $newdata['background_bg_pattern'];
} else{
    if ( isset($newdata['background_bg_image'] ) && ( '' != $newdata['background_bg_image'] ) ) {
        $pattern = $newdata['background_bg_image'];

        if ( isset($newdata['background_bg_image_cover'] ) && ( '1' == $newdata['background_bg_image_cover'] ) ) {
            $image_styles = 'background-attachment: fixed; background-size: cover;';
        }
        else{
            $image_styles = 'background-attachment: scroll; background-size: auto;';
        }

    }
}
if ( '' != $pattern ){
    echo '.boxed { background-image: url(\'' . $pattern . '\'); ' . $image_styles . '}';
}
?>





/* 7.6 Transitions ****************************************************************************************************/
.logo a,
.main-nav ul li a,
.main-nav a[href="#search"]+form input[type="submit"],
.addForm form input[type="submit"],
[class*="ish-button-"],
.slidable .flex-control-nav li a,
.flickr_badge_image img,
.dribbble-widget img,
.recent-projects-widget img,
.widget_ishyoboy-social-widget ul.social a,
.categories a,
.tagcloud a,
.hover-cont .hover-overlay,
.list-button li a,
.blog-post a img,
.accordion .active .acc-title,
.toggle .active .tgg-title,
.box.close [class*="icon-cancel"],
.tabs-navigation li a,
#expandable,
.pagination a, .pagination .current,
.logo a img,
.timeline > div,
a .rounded-image,
input[type="submit"],
#sidebar .widget_nav_menu li a,
.sc-nav-menu li a,
.ish-icon a span,
.ish-icon-circle a span,
.ish-icon-square a span,
.part-top-navigation a,
[class*="ish-button-"] [class*="ish-icon"] span,
.accordion .acc-title,
.toggle .tgg-title,
.woocommerce .product-categories a,
.rounded-image a img {
-webkit-transition-duration: .25s;
-moz-transition-duration: .25s;
-ms-transition-duration: .25s;
-o-transition-duration: .25s;
transition-duration: .25s;
}

.part-expandable ul.menu li a,
.part-footer ul.menu li a,
.pp_woocommerce #commentform input[type="submit"] {
    -webkit-transition-duration: 0;
    -moz-transition-duration: 0;
    -ms-transition-duration: 0;
    -o-transition-duration: 0;
    transition-duration: 0;
}



/* Rounded corners ****************************************************************************************************/
.tinynav,
.addForm,
h1[class*="icon-"]:before, h2[class*="icon-"]:before, h3[class*="icon-"]:before, h4[class*="icon-"]:before, h5[class*="icon-"]:before, h6[class*="icon-"]:before,
.h1[class*="icon-"]:before, .h2[class*="icon-"]:before, .h3[class*="icon-"]:before, .h4[class*="icon-"]:before, .h5[class*="icon-"]:before, .h6[class*="icon-"]:before,
.box,
blockquote.quote-boxed,
[class*="ish-button-"],
.main-nav a[href="#search"]+form,
ul.categories a,
.tagcloud a,
.ish-slider .slide-image img+.caption *,
.tp-caption[class*="with_bg"],
.list-button li a,
.list-skills div div,
.list-skills div div span,
.fixed-top,
.accordion .acc-title,
.toggle .tgg-title,
.tooltipster-default,
pre, code,
.tabs-navigation li a,
.tabs-content > div,
#expandable,
.pagination a, .pagination .current,
.pullquote.bg-pullquote,
.dropcap.bg-dropcap,
.timeline-border > div > div,
input, textarea,
.wpcf7-validation-errors,
.wpcf7-mail-sent-ok,
#sidebar .widget_nav_menu li a,
.sc-nav-menu li a,
.ish-icon-square span,
.woocommerce select,
.woocommerce .woocommerce-tabs .panel,
.woocommerce .product-categories a,
.part-expandable    .widget_archive select,
.right-sidebar      .widget_archive select,
.left-sidebar       .widget_archive select,
.part-footer        .widget_archive select,
.part-footer-legals .widget_archive select,
.part-expandable    .widget_categories select,
.right-sidebar      .widget_categories select,
.left-sidebar       .widget_categories select,
.part-footer        .widget_categories select,
.part-footer-legals .widget_categories select {
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
}


<?php if ( isset($newdata['logo_as_image']) && '1' == $newdata['logo_as_image'] ) { ?>
    <?php if ( ( isset( $newdata['logo_retina_image'] ) && '' != $newdata['logo_retina_image'] ) && ( isset( $newdata['logo_image'] ) && '' != $newdata['logo_image'] ) ) { ?>
/* Retina logo */
@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2) {

    .logo.retina-yes a img {
        visibility: hidden;
    }

    .logo.retina-yes a {
		<?php $retina_logo = is_ssl() ? str_replace( 'http:', 'https:', $newdata['logo_retina_image'] ) : $newdata['logo_retina_image']; ?>
        background: url('<?php echo $retina_logo; ?>') center center no-repeat;
        background-size: 100% auto;
    }

}
/* Retina logo END */
    <?php } ?>
<?php } ?>

/* *********************************************************************************************************************
* CSS3 Media Queries
*/
<?php
if ( !isset( $newdata['use_responsive_layout'] ) || '1' == $newdata['use_responsive_layout'] ) {
?>


@media (max-width: <?php echo $responsive_layout_breakingpoint; ?>px) {
    [class*="grid"] {
        float: none;
        width: 100%;
        margin-left: 0;
        margin-bottom: 30px;
    }

    [class*="grid"]:last-child {
        margin-bottom: 0;
    }

    .portfoliog .grid6 {
        max-width: 98%;
    }
}

@media all and (max-width: 480px) {
    [class*="grid"] {
        margin-bottom: 20px;
    }

    .portfoliog .grid3, .portfoliog .grid4, .portfoliog .grid6 {
        max-width: 98%;
    }
}

@media all and (max-width: 320px) {
    [class*="grid"] {
        margin-bottom: 10px;
    }
}



/* 1290px */
<?php
if ( $page_width < 1290 ) {
    $cur_pwidth = $page_width;
} else{
    $cur_pwidth = 1290;
}
?>
@media all and (max-width: <?php echo $cur_pwidth; ?>px) {
	.portfoliog.portfolio-fluid .grid3     /* 4col */
	{ width: 31.3% !important; }

    .portfoliog.portfolio-fluid.nomasonry .grid3     /* 4col */
    { width: 31.1% !important; }

    .portfoliog.portfolio-fluid.masonry .grid3 { width: 31.2% !important; }
}

/* 960px */
<?php
if ( $page_width < 960 ) {
    $cur_pwidth = $page_width;
} else{
    $cur_pwidth = 960;
}
?>
@media all and (max-width: <?php echo $cur_pwidth; ?>px) {
	.portfoliog.portfolio-fluid .grid3,     /* 4col */
	.portfoliog.portfolio-fluid .grid4      /* 3col */
	{ width: 48% !important; }

    .portfoliog.portfolio-fluid.nomasonry .grid3,     /* 4col */
    .portfoliog.portfolio-fluid.nomasonry .grid4      /* 3col */
    { width: 47.8% !important; }

    .portfoliog.portfolio-fluid.masonry .grid3, .portfoliog.portfolio-fluid.masonry .grid4 { width: 47.9% !important; }
}

/* 650px */
<?php
if ( $page_width < 650 ) {
    $cur_pwidth = $page_width;
} else{
    $cur_pwidth = 650;
}
?>
@media all and (max-width: <?php echo $cur_pwidth; ?>px) {
	.portfoliog.portfolio-fluid .grid3,     /* 4col */
	.portfoliog.portfolio-fluid .grid4,      /* 3col */
	.portfoliog.portfolio-fluid .grid6      /* 2col */
	{ width: 98% !important; }

    .portfoliog.portfolio-fluid.nomasonry .grid3,     /* 4col */
    .portfoliog.portfolio-fluid.nomasonry .grid4,      /* 3col */
    .portfoliog.portfolio-fluid.nomasonry .grid6      /* 2col */
    { width: 97.8% !important; }

    .portfoliog.portfolio-fluid.masonry .grid3, .portfoliog.portfolio-fluid.masonry .grid4, .portfoliog.portfolio-fluid.masonry .grid6 { width: 98% !important; }
}




@media all and (max-width: 1310px) {

}



@media all and (max-width: 1290px) {

}


/* 1024px */
<?php
if ( $page_width < 1024 ) {
    $cur_pwidth = $page_width;
} else{
    $cur_pwidth = 1024;
}
?>
@media all and (max-width: <?php echo $cur_pwidth; ?>px) {
    .boxed {
        padding: 40px 0;
    }

    .part-expandable > .row,
    .part-top-navigation > .row,
    .part-header > .row,
    .part-lead > .row,
    .part-content > .row,
    .part-fullsection > .row,
    .part-footer > .row,
    .part-footer-legals > .row,
    .part-pagebreak > .row {
        padding: 0 40px;
    }

    .ish-slider [class*="slide-"] > .row {
        padding: 0 40px;
    }

    .ish-slider .slide-image img + .caption {
        bottom: 62px;
        left: 10px;
        margin-right: 10px;
    }

    .ish-slider .slide-content > .row {
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .ish-slider .flex-control-nav {
        right: 40px;
        width: auto;
        text-align: left;
    }
}


@media all and (max-width: <?php echo $responsive_layout_breakingpoint; ?>px) {
    .part-top-navigation .tinynav { display: block }
    .part-top-navigation .top-nav ul { display: none }

    .boxed {
        padding: 30px 0;
    }

    .part-expandable,
    .part-lead,
    .part-fullsection,
    .part-footer,
    .part-footer-legals,
    .part-pagebreak {
        padding: 30px 0;
    }

    .part-expandable > .row,
    .part-top-navigation > .row,
    .part-header > .row,
    .part-lead > .row,
    .part-content > .row,
    .part-fullsection > .row,
    .part-footer > .row,
    .part-footer-legals > .row,
    .part-pagebreak > .row {
        padding: 0 30px;
    }

    .part-content {
        padding-bottom: 0;
    }

    .ish-slider [class*="slide-"] > .row {
        padding: 0 30px;
    }

    .part-expandable, .part-footer {
        padding-top: 0;
    }

    .part-expandable .widget, .part-footer .widget {
        margin-top: 30px;
    }

    .part-top-navigation > div > div, .part-top-navigation > div > div {
        width: 100%;
        float: none;
        text-align: center;
    }

    [class*="lined-section"] {
        margin: 30px 0;
    }

    .space {
        margin-bottom: 30px;
    }

    .ish-slider .flex-control-nav {
        bottom: 15px;
    }

    .ish-slider .slide-image img + .caption {
        bottom: 37px;
        left: 5px;
        margin-right: 5px;
    }

    .ish-slider .slide-content > .row {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .ish-slider .flex-control-nav {
        bottom: 5px;
        right: 30px;
    }

    .ish-slider .slide-image img + .caption h1, .ish-slider .slide-image img + .caption .h1 { font-size: 30px; line-height: 40px; }
    .ish-slider .slide-image img + .caption h2, .ish-slider .slide-image img + .caption .h2 { font-size: 24px; line-height: 30px; }
    .ish-slider .slide-image img + .caption h3, .ish-slider .slide-image img + .caption .h3 { font-size: 14px; line-height: 18px; letter-spacing: 0; }

    .resp-nav .main-nav {
        left: 0 !important;
    }

    .table-content th, .table-content tr, .table-content td {
        word-break: break-all;
    }

    .main-nav ul {
        display: none;
    }

    .woocommerce h3 {
        font-size: 1em !important;
    }

    .widget_search #searchform, .widget_nav_menu .menu-theme-options-container {
        margin-top: 0 !important;
    }

    .fontello-features .span3 {
        width: 50%;
    }

    .portfolio_images .portfolio_image img {
        margin-top: 30px;
    }

    .portfolio_images .portfolio_image:first-child img {
        margin-top: 0;
    }

    .part-footer-legals{
        padding: 20px 0;
    }

    .part-footer-legals .widget {
        /*text-align: center;*/
        float: none;
        margin-bottom: 0;
    }

    .rounded-image.ri-arrow.ri-arrow-left:after,
    .rounded-image.ri-arrow.ri-arrow-right:after {
        top: 100%;
        left: 50%;
        margin: -1px 0 0 -10px;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid;
    }

    .rounded-image {
        display: inline-block;
        max-width: 100% !important;
    }

	.part-header.sticky-nav .row .grid12 .logo,
	.part-header.sticky-nav .row .grid12 .tagline {
		display: none;
	}

	.part-header.sticky-nav .row .grid12 .main-nav {
		margin: 10px 0;
		padding: 0 !important;
	}

	.part-header.sticky-nav.sticky-hide-responsive .row {
		display: none !important;
	}

	.woocommerce .cart-collaterals .cart_totals table,
	.woocommerce .cart-collaterals .cart_totals,
	.woocommerce .cart-collaterals .shipping_calculator {
		width: 100% !important;
	}
}



@media all and (max-width: 480px) {
    .boxed {
        padding: 20px 0;
    }

    .part-expandable,
    .part-lead,
    .part-fullsection,
    .part-footer,
    .part-footer-legals,
    .part-pagebreak {
        padding: 20px 0;
    }
    .part-expandable > .row,
    .part-top-navigation > .row,
    .part-header > .row,
    .part-lead > .row,
    .part-content > .row,
    .part-fullsection > .row,
    .part-footer > .row,
    .part-footer-legals > .row,
    .part-pagebreak > .row {
        padding: 0 20px;
    }

    .part-content {
        padding-bottom: 0;
    }

    .ish-slider [class*="slide-"] > .row {
        padding: 0 20px;
    }

    .part-expandable, .part-footer {
        padding-top: 0;
    }

    .part-expandable .widget, .part-footer .widget {
        margin-top: 20px;
    }

    [class*="lined-section"] {
        margin: 20px 0;
    }

    .slidable-container .flex-control-nav {
        top: -42px;
    }

    .space {
        margin-bottom: 20px;
    }

    .ish-slider .flex-control-nav {
        bottom: 0;
        right: 20px;
    }

    .ish-slider .slide-image img + .caption {
        bottom: 28px;
    }

    .ish-slider .slide-content > .row {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .ish-slider .slide-image img + .caption * { padding: 3px 5px !important; }
    .ish-slider .slide-image img + .caption h1, .ish-slider .slide-image img + .caption .h1 { font-size: 22px; line-height: 30px; }
    .ish-slider .slide-image img + .caption h2, .ish-slider .slide-image img + .caption .h2 { font-size: 16px; line-height: 20px; letter-spacing: 0; }
    .ish-slider .slide-image img + .caption h3, .ish-slider .slide-image img + .caption .h3 { font-size: 12px; line-height: 14px; letter-spacing: 0; }
    .ish-slider .slide-image img + .caption h4, .ish-slider .slide-image img + .caption .h4 { font-size: 12px; line-height: 14px; letter-spacing: 0; font-weight: 400; }
    .ish-slider .slide-image img + .caption h5, .ish-slider .slide-image img + .caption .h5 { font-size: 12px; line-height: 14px; letter-spacing: 0; }
    .ish-slider .slide-image img + .caption h6, .ish-slider .slide-image img + .caption .h6 { font-size: 12px; line-height: 14px; letter-spacing: 0; }
    .ish-slider .slide-image img + .caption p { font-size: 12px; line-height: 14px; letter-spacing: 0; }

    .resp-nav {
        height: 134px !important;
    }

    .resp-nav .logo, .resp-nav .tagline {
        height: 90px;
    }

    .resp-nav .main-nav {
        padding-bottom: 20px !important;
    }

    .timeline .timeline-date {
        width: 25%;
    }

    .timeline .timeline-date > div {
        text-align: right !important;
        padding: 10px 20px 10px 0 !important;
    }

    .timeline .timeline-content {
        float: right;
        width: 75%;
    }

    .timeline .timeline-content > div {
        text-align: left !important;
        padding: 10px 0 10px 20px !important;
    }

    .timeline > div:after, .timeline > div:before {
        left: 25%;
    }

    .timeline .timeline-border:first-child > div > div:after {
        border-right: 6px solid !important;
        border-left: none;
        left: -6px;
    }

    .blog-post-details span[class*="icon-"] {
        display: block !important;
        margin: 2px 0 !important;
    }

    .fontello-features .span3 {
        width: 100%;
        float: none;
    }

    .portfolio_images .portfolio_image img {
        margin-top: 20px;
    }

    .portfolio_images .portfolio_image:first-child img {
        margin-top: 0;
    }

	.woocommerce .products li.product,
	.woocommerce-page div.product div.images, .woocommerce-page div.product div.summary,
	.woocommerce-page .col2-set .col-1, .woocommerce-page .col2-set .col-2,
	.woocommerce-page form .form-row-first, .woocommerce-page form .form-row-last {
		width: 100% !important;
		float: none !important;
	}

	.woocommerce table.shop_table th,
	.woocommerce table.shop_table tr,
	.woocommerce table.shop_table td {
		word-wrap: break-word !important;
		padding: 3px !important;
		min-width: 0 !important;
	}

	.woocommerce table.shop_table .quantity input[type="number"] {
		width: 25px;
	}

	.woocommerce .quantity {
		width: 45px !important;
		float: left;
	}
}



@media all and (max-width: 320px) {
    .boxed {
        padding: 10px 0;
    }

    .part-expandable,
    .part-lead,
    .part-fullsection,
    .part-footer,
    .part-footer-legals,
    .part-pagebreak {
        padding: 10px 0;
    }

    .part-expandable > .row,
    .part-top-navigation > .row,
    .part-header > .row,
    .part-lead > .row,
    .part-content > .row,
    .part-fullsection > .row,
    .part-footer > .row,
    .part-footer-legals > .row,
    .part-pagebreak > .row {
        padding: 0 10px;
    }

    .part-content {
        /*padding-bottom: 10px;*/
        padding-bottom: 0;
    }

    .ish-slider [class*="slide-"] > .row {
        padding: 0 10px;
    }

    .part-expandable, .part-footer {
        padding-top: 0;
    }

    .part-expandable .widget, .part-footer .widget {
        margin-top: 10px;
    }

    [class*="lined-section"] {
        margin: 10px 0;
    }

    .slidable-container .flex-control-nav {
        top: -32px;
    }

    .space {
        margin-bottom: 10px;
    }

    h1, .h1 {
        font-size: 35px;
        line-height: 45px;
    }

    .ish-slider .flex-control-nav {
        bottom: 0;
        right: 10px;
    }

    .ish-slider .slide-content > .row {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .resp-nav .logo, .resp-nav .tagline {
        height: 70px;
    }

    .resp-nav .main-nav {
        padding-bottom: 10px !important;
    }

    .resp-nav-small .logo {
        margin-bottom: -25px;
    }

    .portfolio_images .portfolio_image img {
        margin-top: 10px;
    }

    .portfolio_images .portfolio_image:first-child img {
        margin-top: 0;
    }
}

<?php } ?>