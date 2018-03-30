<?php

// more widgets in the (near) future...

// Register widgetized locations
if(  !function_exists('clapat_widgets_init') ){

    function clapat_widgets_init(){

		// uncomment if we need sidebar
        /*if(function_exists('register_sidebar')) {

                register_sidebar(array(
                'id' => 'blog-sidebar',
                'name' => __('Blog Sidebar', THEME_LANGUAGE_DOMAIN),
                'description'   => __('Sidebar displayed in the blog and single post pages', THEME_LANGUAGE_DOMAIN),
                'before_widget' => '<div class="widget %2$s clearfix">',
                'after_widget' => '</div>',
                'before_title' => '<div class="heading"><h6>',
                'after_title' => '</h6></div>',
            ));

        }*/

    }
}

add_action( 'widgets_init', 'clapat_widgets_init' );

?>