<?php
/*
Plugin Name: Demo Tax meta class
Plugin URI: http://en.bainternet.info
Description: Tax meta class usage demo
Version: 1.2
Author: Bainternet, Ohad Raz
Author URI: http://en.bainternet.info
*/

include (get_template_directory().'/includes/tax-meta/tax-meta.php');
if (is_admin())
{
	$prefix = 'bd_';
	$config = array(
		'id' => 'demo_meta_box',					// meta box id, unique per meta box
		'title' => 'Demo Meta Box',					// meta box title
		'pages' => array('category'),				// taxonomy name, accept categories, post_tag and custom taxonomies
		'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
		'fields' => array(),						// list of meta fields (can be added by field arrays)
		'local_images' => false,					// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => true					//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
	$my_meta =  new Tax_Meta_Class($config);
	$my_meta->addCheckbox(
        $prefix.'featured_slider',
        array(
            'name'              => 'Enable Featured Slider'
        )
    );
	$my_meta->addSelect(
        $prefix.'blog_style',
        array(
            'blog-style-1'      =>'Blog Style 1',
            'blog-style-2'      =>'Blog Style 2',
            'blog-style-3'      =>'Blog Grid',
            'blog-style-4'      =>'Blog Grid Formats',
        ),
        array(
            'name'=> 'Category Layout Style',
            'std'=> array('blog-style-1')
        )
    );
	$my_meta->Finish();
}