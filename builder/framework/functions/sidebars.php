<?php
/*=======================================
	Register Sidebar UNLIMITED 
=======================================*/
$kk = 4;

if ( function_exists('register_sidebar') ){
	global $oi_options;
	if (!isset($oi_options['oi_footer_widget_count'])){
		$oi_footer_widget_count= 'col-md-4';
	}else{
		$oi_footer_widget_count = $oi_options['oi_footer_widget_count'];
	};
	if (!isset($oi_options['oi_footer-ii_widget_count'])){
		$oi_footer_ii_widget_count= 'col-md-4';
	}else{
		$oi_footer_ii_widget_count = $oi_options['oi_footer-ii_widget_count'];
	}
	
	register_sidebar(array(
		'id' => 'oi_blog_sidebar',
		'name' => 'Blog Sidebar',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="oi_widget_title"><span>',
        'after_title' => '</span></h6>'
    ));
	register_sidebar(array(
		'id' => 'oi_footer_sidebar',
		'name' => 'I Footer Widgets',
        'before_widget' => '<div class="'.$oi_footer_widget_count.'"><div class="oi_footer_widget">',
        'after_widget' => '</div></div>',
        'before_title' => '<h6 class="io_footer_widget_title"><span>',
        'after_title' => '</span></h6>'
    ));
	
	register_sidebar(array(
		'id' => 'oi_footer-ii_sidebar',
		'name' => 'II Footer Widgets',
        'before_widget' => '<div class="'.$oi_footer_ii_widget_count.'"><div class="oi_footer-ii_widget">',
        'after_widget' => '</div></div>',
        'before_title' => '<h6 class="io_footer-ii_widget_title"><span>',
        'after_title' => '</span></h6>'
    ));
	register_sidebar(array(
		'id' => 'oi_shop_sidebar',
		'name' => 'Shop Sidebar',
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="oi_widget_title"><span>',
        'after_title' => '</span></h6>'
    ));
	
	for($i=1; $i<=$kk ;$i++){
	register_sidebar(array(
		'id' => 'oi_page_sidebar_'.$i,
		'name' => 'Page Sidebar #'.$i,
        'before_widget' => '<div class="oi_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="oi_widget_title"><span>',
        'after_title' => '</span></h6>'
	));
	};
	

};

?>