<?php

add_action( 'init', 'create_post_type' );
function create_post_type() {
	
	//Register Portfolio Post Type
	register_post_type( 'theme_portfolio',
		array(
			'labels' => array(
				'name' => __( 'Portfolio', 'framework' ),
				'singular_name' => __( 'Portfolio', 'framework' ),
				'add_new' => _x('Add New', 'Portfolio Item', 'framework'),  
  				'add_new_item' => __('Add New Portfolio Item', 'framework'),  
   				'edit_item' => __('Edit Portfolio Item', 'framework'),  
   				'new_item' => __('New Portfolio Item', 'framework'),  
   				'view_item' => __('View Portfolio', 'framework'),  
   				'search_items' => __('Search Portfolio Items', 'framework'),  
   				'not_found' =>  __('No Portfolio items found', 'framework'),  
   				'not_found_in_trash' => __('No Portfolio items found in Trash', 'framework')
			),
		'public' => true,
        'menu_position' => 5,
        'rewrite' => array('slug' => 'portfolio'),
		'supports' => array(
		'title',
		'excerpt',
		'editor',
		'custom-fields',
		'comments',
		'page-attributes',
		'thumbnail'),
	'taxonomies' => array('post_tag', 'portfolio_category'),
		)
	);

}

register_taxonomy_for_object_type('post_tag', 'theme_portfolio');
register_taxonomy("portfolio_category", 
			    	array("portfolio"), 
			    	array( "hierarchical" => true, 
			    			"label" => __('Portfolio Categories', 'framework'), 
			    			"singular_label" => __('Portfolio Categories', 'framework'), 
			    			"rewrite" => true,
			    			"query_var" => true,
                "rewrite" => array(
                  "slug" => "portfolio_category"
                )
			    		));  
						
					
?>