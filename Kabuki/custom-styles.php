<?php { ?>


<style type="text/css">

<?php if ( function_exists( 'get_option_tree' ) ) { if (is_string(get_option_tree( 'logo' ))) { echo '#logo a { background: url("'.get_option_tree( 'logo' ).'") no-repeat center center; }'; } else { echo '#logo a { background: url("'.get_stylesheet_directory_uri().'/images/nologo.png") no-repeat center center; }'; } } ?> 

.normal, body, input, blockquote { font: 12px '<?php if ( function_exists( 'get_option_tree' ) ) { if ( is_string( get_option_tree( 'font_body' ) )) { echo get_option_tree( 'font_body' ); } else { echo "Open Sans"; } } ?>', Arial, sans-serif; }

#menu-label, #sec-info, .serif, cite, h1, h2, h3, h4, h5, h6 { font-family: '<?php if ( function_exists( 'get_option_tree' ) ) { if ( is_string( get_option_tree( 'font_header' ) )) { echo get_option_tree( 'font_header' ); } else { echo "Open Sans"; } } ?>', Arial, sans-serif; }

body { background-image: url('<?php if ( function_exists( 'get_option_tree' ) ) { if (get_option_tree( 'background' ) == "Repeated texture" && is_string(get_option_tree( 'background_texture' )) )  { echo get_option_tree( 'background_texture' ); }} ?>'); background-color: <?php if ( function_exists( 'get_option_tree' ) ) { if (get_option_tree( 'background' ) == "Solid color" && is_string(get_option_tree( 'background_color' )))  { echo get_option_tree( 'background_color' ); } else { echo '#555555'; } } ?>; }

#nav-primary li a, #nav-primary li li a { <?php if ( function_exists( 'get_option_tree' ) && is_string( get_option_tree('sec_menu_text'))) { echo "color: ".get_option_tree('sec_menu_text').";"; } ?>}

#nav-primary li a { <?php if ( function_exists( 'get_option_tree' )) { echo "font-size: ".get_option_tree('sec_menu_text_size')."px;"; } ?> }

#menu-main-menu > li > a { <?php if ( function_exists( 'get_option_tree' )) { echo "line-height: ".get_option_tree('sec_menu_text_size')."px;"; } ?> }

#nav-primary ul ul a { <?php if ( function_exists( 'get_option_tree' )) { echo "font-size: ".get_option_tree('sec_menu_sub_size')."px;"; } ?> }

#logo-wrap #logo a, #menu-label, #top-line, #nav-primary li a, #nav-primary li li a { <?php if ( function_exists( 'get_option_tree' ) && is_string( get_option_tree('sec_menu_background')) ) { echo "background-color: ".get_option_tree('sec_menu_background').";"; } ?> }

#menu-label { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('sec_menu_label_background')."; color: ".get_option_tree('sec_menu_label_text').";"; } ?> }

#nav-primary li a:hover, #nav-primary li a:active, #nav-primary li li a:hover { <?php if ( function_exists( 'get_option_tree' ) && is_string(get_option_tree('sec_menu_hover_text'))) { echo "color: ".get_option_tree('sec_menu_hover_text'); } ?>;  <?php if ( function_exists( 'get_option_tree' ) && is_string (get_option_tree('sec_menu_hover'))) { echo "background-color: ".get_option_tree('sec_menu_hover').";"; } ?> }

#main #main-body { <?php if ( function_exists( 'get_option_tree' )) { if ( is_string(get_option_tree('body_transparency'))) { $trans1 = get_option_tree('body_transparency'); } else { $trans1 = 0.9; }  $rgb1 = hex2rgb(get_option_tree('body_background')); $iehexh1 = str_replace ("#", "", get_option_tree('body_background')); if (is_string(get_option_tree('body_background'))) { echo "background: transparent\9; zoom:1; filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#77".$iehexh1.", endColorstr=#77".$iehexh1."); -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#77".$iehexh1.", endColorstr=#77".$iehexh1.")'; background: rgba(".$rgb1[0].",".$rgb1[1].",".$rgb1[2].", ".$trans1."); "; } } ?> }

.normal, body, input, blockquote { <?php if ( function_exists( 'get_option_tree' )) { if ( is_string(get_option_tree('body_text_size'))) { echo "font-size: ".get_option_tree('body_text_size')."px;"; } } ?>  }

.normal, body, input, blockquote { <?php if ( function_exists( 'get_option_tree' )) { if ( is_string( get_option_tree('body_line_height'))) { echo "line-height: ".get_option_tree('body_line_height')."px;"; } } ?>  }

#content h1 a, #content h2 a, #content h3 a, #content h4 a, .page-content h1, .post-content h1, h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, .serif, cite, h1, h2, h3, h4, h5, h6, .post-header, .page h1, #rps h4.post-title a span { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('body_headings')."; ";  echo "font-weight: ".get_option_tree('body_headings_thickness').";"; } ?>  }

#content .post-header h2 a, #content .post-header h2 a:visited, .widget-sidebar h3, .pagerbox a.current, .pagerbox a:hover, .tagcloud a:hover, .error404 .post-header h1, .post-header { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('box_header_text'); } ?>; }

a:link, a:visited, #shortcode-postlist .post-meta { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('body_links'); } ?>; }

a:hover, .widget-area input#searchsubmit:hover, #portfolio-filter a:hover, #portfolio-filter li a:hover, #portfolio-filter li.active a { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('body_links_hover'); } ?>; }

body, .comment-author a { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('body_color'); } ?>; }

.post-wrapper, .container #content #post-wrapper, .post-header-title, #content #page-wrapper, .widget-sidebar, .pagerbox a, #post-meta .post-tags a, #portfolio-filter a, .tag-desc, .cat-desc, #portfolio-wrapper, #portfolio-filter, .post-header-title h4, #blog-header, .post-meta, .top-border, #post-author, #comments-top { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('box_border_color'); } ?> !important; }

#sidebar .widget-sidebar ul li, #sidebar .widget-sidebar ul ul li, #sidebar .widget-area .recentcomments, #comments article, .page-template-page_portfolio-one-column-php #portfolio-list .portfolio-item, #sidebar ul#twitter_update_list li { <?php if ( function_exists( 'get_option_tree') ) { echo "border-bottom-color: ".get_option_tree('box_border_color').";"; } ?> }

#comments, #respond, #comments article { <?php if ( function_exists( 'get_option_tree') ) { echo "border-top-color: ".get_option_tree('box_border_color').";"; } ?> } 

.tagcloud a { <?php if ( function_exists( 'get_option_tree') ) { echo "background-color: ".get_option_tree('tag_background').";"; } ?> } 

.tagcloud a:hover { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tag_hover'); } ?>; }

#respond input#submit:hover, .contact-submit input:hover, .back-button input:hover { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('meta_color'); } ?>; }
input:hover, textarea:hover, input:focus, textarea:focus { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('meta_color'); } ?>; }

.tagcloud a { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('tag_color'); } ?>; }

.wp-caption-text { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('caption_color'); } ?>; }

.comment-date, .widget_pippin_recent_posts ul li .time { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('date_color'); } ?>; }

.su-tabs-style-1 .su-tabs-pane { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('tabs_one_background'); } ?>; }
.su-tabs-style-1 .su-tabs-nav { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tabs_one_background'); } ?>; }

.su-tabs-style-3 { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('tabs_three_background'); } ?>; }
.su-tabs-style-3 .su-tabs-nav span { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tabs_three_background'); } ?>; }

.su-tabs-style-2 .su-tabs-pane { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('tabs_two_background'); } ?>; }
.su-tabs-style-2 .su-tabs-nav { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tabs_two_background'); } ?>; }

.su-tabs-style-1 .su-tabs-nav span { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tabs_one_inactive_background'); } ?>; }

.su-tabs-style-2 .su-tabs-nav span { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tabs_two_inactive_background'); } ?>; }
.su-tabs-style-2 .su-tabs-nav span { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('tabs_two_inactive_background'); } ?>; }

.su-tabs-style-1 .su-tabs-nav span.su-tabs-current, .su-tabs-style-1 .su-tabs-pane { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tabs_one_bck'); } ?>; }
.su-tabs-style-1 .su-tabs-nav span.su-tabs-current { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('tabs_one_bck'); } ?>; }

.su-tabs-style-2 .su-tabs-nav span.su-tabs-current, .su-tabs-style-2 .su-tabs-pane { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tabs_two_bck'); } ?>; }
.su-tabs-style-2 .su-tabs-nav span.su-tabs-current { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('tabs_two_bck'); } ?>; }

.su-tabs-style-3 .su-tabs-nav span.su-tabs-current, .su-tabs-style-3 { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tabs_three_bck'); } ?>; }
.su-tabs-style-3 .su-tabs-nav span.su-tabs-current { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('tabs_three_bck'); } ?>; }

.su-tabs-style-1 .su-tabs-nav span:hover { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tabs_one_hover'); } ?>; }
.su-tabs-style-2 .su-tabs-nav span:hover { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tabs_two_hover'); } ?>; }
.su-tabs-style-2 .su-tabs-nav span:hover { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('tabs_two_hover'); } ?>; }
.su-tabs-style-3 .su-tabs-nav span:hover { <?php if ( function_exists( 'get_option_tree' )) { echo "background: ".get_option_tree('tabs_three_hover'); } ?>; }

.su-spoiler-style-2 > .su-spoiler-title, .su-spoiler-style-2.su-spoiler-open > .su-spoiler-title { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('spoiler_two'); } ?>; }
.su-spoiler-style-2, .su-spoiler-style-2 > .su-spoiler-title, .su-spoiler-style-2.su-spoiler-open > .su-spoiler-title {  <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('spoiler_two'); } ?>; }

.su-table-style-1 table { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('tables_one_outer'); } ?>; }

.su-table-style-2 table tbody th { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tables_two_outer'); } ?>; <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('tables_two_font_header'); } ?>;}

.su-table-style-2 table { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('tables_two_outer'); } ?>; }

.su-table-style-1 td { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tables_one_odd'); } ?>; <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('tables_one_font'); } ?>;}

.su-table-style-1 .su-even td { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tables_one_even'); } ?>; }

.su-table-style-2 td { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tables_two_odd'); } ?>; <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('tables_two_font'); } ?>;}

.su-table-style-2 .su-even td { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('tables_two_even'); } ?>; }

.su-table-style-1 td, .su-table-style-1 th { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('tables_one_border'); } ?>; }
.su-table-style-1 th { <?php if ( function_exists( 'get_option_tree' )) { echo "background: ".get_option_tree('tables_one_border'); } ?>;  <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('tables_one_font_header'); } ?>; }

input[type="text"], textarea { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('input_border'); } ?>; }

#respond input#submit, .contact-submit input, .back-button input, .error404 #searchsubmit, .widget-area input#searchsubmit { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('content_background'); } ?>; }

input[type="text"], textarea { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('input_background'); } ?>; }

#post-author { <?php if ( function_exists( 'get_option_tree' ) &&  get_option_tree('author') == 'Display author information in posts') { echo "display: block;"; } else { echo  "display: none"; } ?> }

#respond input#submit, .contact-submit input, .back-button input { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('button_background'); } ?>;  }

.portfolio-item h3 a, #comments h3, #comments h4, #post-author h3, #author h3, .error404 #content h4 { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('subheading_color'); } ?> !important; }

.pagerbox a.active, .pagerbox a:hover { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('subheading_color'); } ?> !important; }

.pagerbox a { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('body_color'); } ?>; <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('body_links'); } ?>; }

#sidebar .widget-area .recentcomments { <?php if ( function_exists( 'get_option_tree' ) && is_string(get_option_tree( 'widget_comments_icon' ))) { echo "background-image: url('".get_option_tree( 'widget_comments_icon' )."');"; } ?> }

#sidebar .widget_categories ul li { <?php if ( function_exists( 'get_option_tree' ) && is_string(get_option_tree( 'widget_categories_icon' ))) { echo "background-image: url('".get_option_tree( 'widget_categories_icon' )."');"; } ?> }

#sidebar .widget_archive ul li { <?php if ( function_exists( 'get_option_tree' ) && is_string(get_option_tree( 'widget_archives_icon' ))) { echo "background-image: url('".get_option_tree( 'widget_archives_icon' )."');"; } ?> }

#sidebar .widget_pages ul li { <?php if ( function_exists( 'get_option_tree' ) && is_string(get_option_tree( 'widget_pages_icon' ))) { echo "background-image: url('".get_option_tree( 'widget_pages_icon' )."');"; } ?> }

#sidebar .widget_links ul li { <?php if ( function_exists( 'get_option_tree' ) && is_string(get_option_tree( 'widget_links_icon' ))) { echo "background-image: url('".get_option_tree( 'widget_links_icon' )."');"; } ?> }

#sidebar ul#twitter_update_list li { <?php if ( function_exists( 'get_option_tree' ) && is_string(get_option_tree( 'widget_twitter_icon' ))) { echo "background-image: url('".get_option_tree( 'widget_twitter_icon' )."');"; } ?> }

#footer { <?php if ( is_string(get_option_tree('footer_background_transparency'))) { $trans2 = get_option_tree('footer_background_transparency'); } else { $trans2 = 0.9; }  $rgb2 = hex2rgb(get_option_tree('footer_background_color')); $iehexh2 = str_replace ("#", "", get_option_tree('footer_background_color')); } if (function_exists( 'get_option_tree' )) { if ( is_string(get_option_tree('footer_background_image'))) { echo "background-image: url('".get_option_tree('footer_background_image')."');"; } elseif (is_string(get_option_tree('footer_background_color'))) { echo "background: transparent\9; zoom:1; filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#77".$iehexh2.", endColorstr=#77".$iehexh2."); -ms-filter:'progid:DXImageTransform.Microsoft.gradient(startColorstr=#77".$iehexh2.", endColorstr=#77".$iehexh2.")'; background: rgba(".$rgb2[0].",".$rgb2[1].",".$rgb2[2].", ".$trans2."); "; } } ?>  }

#footer .widget-footer ul li { <?php if ( function_exists( 'get_option_tree' )) { echo "border-color: ".get_option_tree('footer_border_bottom'); } ?>;  }

#footer .tagcloud a { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('footer_tag_background'); } ?>;  }

#footer #copyright { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('copyright_background'); } ?>; }

#footer, #footer .widget-footer ul { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('footer_widget_text'); } ?>; }

#footer .tagcloud a { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('footer_tag_text'); } ?>; }

#footer h4 { <?php if ( function_exists( 'get_option_tree' ) && is_string( get_option_tree('footer_widget_heading'))) { echo "color: ".get_option_tree('footer_widget_heading').";"; } ?> }

#footer a, .orbit-slider a { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('footer_links'); } ?>; }

#footer a:hover { <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('footer_links_hover'); } ?>; }

#footer .tagcloud a:hover { <?php if ( function_exists( 'get_option_tree' )) { echo "background-color: ".get_option_tree('footer_tag_background_hover'); } ?>; <?php if ( function_exists( 'get_option_tree' )) { echo "color: ".get_option_tree('footer_tag_text_hover'); } ?>; }

#footer #copyright { <?php if ( function_exists( 'get_option_tree' ) ) { echo "color: ".get_option_tree('copyright_color'); } ?>; }

#footer #copyright a { <?php if ( function_exists( 'get_option_tree' ) ) { echo "color: ".get_option_tree('copyright_link'); } ?>; }

</style>

<style type="text/css">
<?php  

if (function_exists( 'get_option_tree' ) && get_option_tree('menu_alt') == "Fixed width") {
echo "#nav-primary li { 
position: relative;
}

#nav-primary li a { width: 98px; font-size: 16px; padding: 7px 9px; }

#nav-primary li li a {
padding: 7px 9px !important;
line-height: 22px !important;
float: left;
background-image: none !important;
} 

#nav-primary li li {
float: left !important;
margin-top: 1px !important;
}

#nav-primary li li:first-child {
margin-top: 0 !important;
margin-left: -3px !important;
}

#nav-primary li li:first-child a {
width: 101px !important;
}

#nav-primary ul li ul {
position: absolute !important;
left: 121px !important;
top: 0;
}";	
}

if (function_exists( 'get_option_tree' ) && get_option_tree('menu_show') == "Always display the menu") {
echo "#nav-primary li { display: block !important; }";
echo "#menu-label { display: none; } #logo a, #logo { height: 128px !important; }";
if(get_option_tree('menu_alt') == "Fixed width") {
echo "#nav-primary ul li ul li { display: list-item !important; }";
}
else {
echo "#nav-primary ul li ul li { display: inline-table !important; }";
}
}

?>

</style>