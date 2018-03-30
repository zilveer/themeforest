<?php

/* Register Sidebars */

add_action('widgets_init', 'my_register_sidebars');

function my_register_sidebars()
{
    register_sidebar(array(
        'id' => 'sidebar',
        'name' => 'Sidebar Widget',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><div class="widget-line"></div>'
    ));		    		

	register_sidebar(array(        		
		'id' => 'sidebar_category',
		'name' => 'Sidebar Category Widget',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3><div class="widget-line"></div>'
		));

	register_sidebar(array(
		'id' => 'sidebar_category_top',
		'name' => 'Sidebar Category Top Widget',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
		));	
		
    register_sidebar(array(
        'id' => 'homepost',
        'name' => 'Home post Widget',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));		 

    register_sidebar(array(
        'id' => 'contact',
        'name' => 'Contact Widget',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    
    register_sidebar(array(
        'id' => 'footer1',
        'name' => 'Footer Widget 1',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    
    register_sidebar(array(
        'id' => 'footer2',
        'name' => 'Footer Widget 2',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
    

    



}

?>