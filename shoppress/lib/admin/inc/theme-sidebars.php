<?php

/////////////////////////////////////// Default Sidebars ///////////////////////////////////////
	
register_sidebar(array(
	'name' => __('Standard Sidebar', 'gp_lang'),
	'id'=> 'gp-default',
	'description' => 'Displayed on posts, pages and post categories.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>')
);

register_sidebar(array(
	'name' => __('Product Sidebar', 'gp_lang'),
	'id'=> 'gp-product',
	'description' => 'Displayed on product pages.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>')
);
	
register_sidebar(array(
	'name' => __('Product Category Sidebar', 'gp_lang'),
	'id'=> 'gp-product-cat',
	'description' => 'Displayed on product categories.',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>')
);

register_sidebar(array(
	'name' => __('Bottom Content 1', 'gp_lang'),
	'id'=> 'gp-bottom-content-1',
	'description' => 'Displayed at the bottom of the main content and sidebar.',
	'before_widget' => '<div id="%1$s" class="widget content-widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>')
);

register_sidebar(array('name' => __('Bottom Content 2', 'gp_lang'), 'id'=> 'gp-bottom-content-2', 'description' => 'Displayed at the bottom of the main content and sidebar.',
	'before_widget' => '<div id="%1$s" class="widget content-widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>')
);

register_sidebar(array(
	'name' => __('Bottom Content 3', 'gp_lang'),
	'id'=> 'gp-bottom-content-3',
	'description' => 'Displayed at the bottom of the main content and sidebar.',
	'before_widget' => '<div id="%1$s" class="widget content-widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>')
);

register_sidebar(array(
	'name' => __('Bottom Content 4', 'gp_lang'),
	'id'=> 'gp-bottom-content-4',
	'description' => 'Displayed at the bottom of the main content and sidebar.',
	'before_widget' => '<div id="%1$s" class="widget content-widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>')
);	
					   
register_sidebar(array(
	'name' => __('Footer 1', 'gp_lang'),
	'id' => 'gp-footer-1',
	'description' => 'Displayed in the footer.',
	'before_widget' => '<div id="%1$s" class="footer-widget-inner %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>')
);        

register_sidebar(array(
'name' => __('Footer 2', 'gp_lang'),
	'id' => 'gp-footer-2', 
	'description' => 'Displayed in the footer.',
	'before_widget' => '<div id="%1$s" class="footer-widget-inner %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>')
);   
	
register_sidebar(array(
	'name' => __('Footer 3', 'gp_lang'),
	'id' => 'gp-footer-3',
	'description' => 'Displayed in the footer.',
	'before_widget' => '<div id="%1$s" class="footer-widget-inner %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>')
);   
	
register_sidebar(array(
	'name' => __('Footer 4', 'gp_lang'),
	'id' => 'gp-footer-4',
	'description' => 'Displayed in the footer.',
	'before_widget' => '<div id="%1$s" class="footer-widget-inner %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h2 class="widgettitle">',
	'after_title' => '</h2>')
);   

?>