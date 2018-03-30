<?php

 if ( function_exists('register_sidebar') ) {   
	register_sidebar( array(
	'name' => __('Blog Sidebar', 'swmtranslate'),
	'id' => 'blog-sidebar',
	'description' => 'Sidebar for blog section',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="swm_widget_box"><div class="swm_widget_content">',
	'after_widget' => '<div class="clear"></div></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));

	register_sidebar( array(
	'name' => __('Portfolio Single Page Sidebar', 'swmtranslate'),
	'id' => 'swm-portfolio-single-page-sidebar',
	'description' => 'Sidebar for portfolio single page',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="swm_widget_box"><div class="swm_widget_content">',
	'after_widget' => '<div class="clear"></div></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));	
	
	register_sidebar(array(
	'name' => __('Footer Column 1', 'swmtranslate'),
	'id' => 'swm-footer-1',
	'description' => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer_widget"><div class="swm_widget_content">',
	'after_widget' => '<div class="clear"></div></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));

	register_sidebar(array(
	'name' => __('Footer Column 2', 'swmtranslate'),
	'id' => 'swm-footer-2',
	'description' => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer_widget"><div class="swm_widget_content">',
	'after_widget' => '<div class="clear"></div></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));

	register_sidebar(array(
	'name' => __('Footer Column 3', 'swmtranslate'),
	'id' => 'swm-footer-3',
	'description' => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer_widget"><div class="swm_widget_content">',
	'after_widget' => '<div class="clear"></div></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));

	register_sidebar(array(
	'name' => __('Footer Column 4', 'swmtranslate'),
	'id' => 'swm-footer-4',
	'description' => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer_widget"><div class="swm_widget_content">',
	'after_widget' => '<div class="clear"></div></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));

	register_sidebar(array(
	'name' => __('Footer Column 5', 'swmtranslate'),
	'id' => 'swm-footer-5',
	'description' => '',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer_widget"><div class="swm_widget_content">',
	'after_widget' => '<div class="clear"></div></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));	

	register_sidebar( array(
	'name' => __('Shop Page Sidebar', 'swmtranslate'),
	'id' => 'swm-shop-page-sidebar',
	'description' => 'Sidebar for shop page',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="swm_widget_box"><div class="swm_widget_content">',
	'after_widget' => '<div class="clear"></div></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));	

	register_sidebar( array(
	'name' => __('Product Single Page Sidebar', 'swmtranslate'),
	'id' => 'product-single-page-sidebar',
	'description' => 'Sidebar for product single (product overview) page',
	'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="swm_widget_box"><div class="swm_widget_content">',
	'after_widget' => '<div class="clear"></div></div></div></div>',
	'before_title' => '<h3>',
	'after_title' => '</h3><div class="clear"></div>'
	));		

 }
	
?>