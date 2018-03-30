<?php
/**********************************
 REGISTER WIDGETS
**********************************/

$primary_footer_sidebar_count = count_sidebar_widgets( 'primary_footer', false );
$secondary_footer_sidebar_count = count_sidebar_widgets( 'secondary_footer', false );

if($primary_footer_sidebar_count <= 1){ $primary_widgetwrapper = 'one-full-fixed';}
if($primary_footer_sidebar_count == 2){ $primary_widgetwrapper = 'one-half-fixed';}
if($primary_footer_sidebar_count == 3){ $primary_widgetwrapper = 'one-third-fixed';}
if($primary_footer_sidebar_count == 4){ $primary_widgetwrapper = 'one-fourth-fixed';}
if($primary_footer_sidebar_count == 5){ $primary_widgetwrapper = 'one-fifth-fixed';}
if($primary_footer_sidebar_count == 6){ $primary_widgetwrapper = 'one-sixth-fixed';}


if($secondary_footer_sidebar_count <= 1){ $secondary_widgetwrapper = 'one-full-fixed';}
if($secondary_footer_sidebar_count == 2){ $secondary_widgetwrapper = 'one-half-fixed';}
if($secondary_footer_sidebar_count == 3){ $secondary_widgetwrapper = 'one-third-fixed';}
if($secondary_footer_sidebar_count == 4){ $secondary_widgetwrapper = 'one-fourth-fixed';}
if($secondary_footer_sidebar_count == 5){ $secondary_widgetwrapper = 'one-fifth-fixed';}
if($secondary_footer_sidebar_count == 6){ $secondary_widgetwrapper = 'one-sixth-fixed';}

register_sidebar(array(
'name' => 'Default Sidebar',
'id' => 'default_sidebar',
'before_title' => '<div class="widget-header"><h4>',
'after_title' => '</h4></div>',
'before_widget' => '<div class="widget %2$s">',
'after_widget' => '</div>'
));

register_sidebar(array(
'name' => 'Primary Footer',
'id' => 'primary_footer',
'before_title' => '<div class="widget-header"><h4>',
'after_title' => '</h4></div>',
'before_widget' => '<div class="widget footer-widget %2$s '.$primary_widgetwrapper.' ">',
'after_widget' => '</div>'
));

register_sidebar(array(
'name' => 'Secondary Footer',
'id' => 'secondary_footer',
'before_title' => '<div class="widget-header"><h4>',
'after_title' => '</h4></div>',
'before_widget' => '<div class="widget footer-widget %2$s '.$secondary_widgetwrapper.'">',
'after_widget' => '</div>'
));

add_filter('widget_text', 'do_shortcode'); // Makes it possible to use shortcodes inside text widgets	
?>