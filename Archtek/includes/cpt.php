<?php

// Register Custom Post Type: Home Slider
if( ! function_exists('uxbarn_register_cpt_homeslider')) {
	
    function uxbarn_register_cpt_homeslider() {
        $args = array(
            'label' => __('Home Slider', 'uxbarn'),
            'labels' => array(
                        'singular_name'=> __('Slide', 'uxbarn'),
                        'add_new' => __('Add New Slide', 'uxbarn'),
                        'add_new_item' => __('Add New Slide', 'uxbarn'),
                        'new_item' => __('New Slide', 'uxbarn'),
                        'edit_item' => __('Edit Slide', 'uxbarn'),
                        'all_items' => __('All Slides', 'uxbarn'),
                        'view_item' => __('View Slide', 'uxbarn'),
                        'search_items' => __('Search Slides', 'uxbarn'),
                        'not_found' =>  __('Nothing found', 'uxbarn'),
                        'not_found_in_trash' => __('Nothing found in Trash', 'uxbarn'),
                        ),
            'menu_icon' => IMAGE_PATH . '/admin/uxbarn-admin-s.jpg',
            'description' => __('Slides that will be displayed on homepage.', 'uxbarn'),
            'public' => false,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'has_archive' => false,
            'supports' => array('title', 'thumbnail'),
            'rewrite' => false,
                        );
        
        register_post_type('homeslider', $args);
        
        add_filter('manage_homeslider_posts_columns', 'uxbarn_create_homeslider_columns_header');  
        add_action('manage_homeslider_posts_custom_column', 'uxbarn_create_homeslider_columns_content');  
        
    }

}

if( ! function_exists('uxbarn_create_homeslider_columns_header')) {
	
    function uxbarn_create_homeslider_columns_header($defaults) {
        $custom_columns = array(
            'cb' => '<input type=\"checkbox\" />',
            'slide_order' => __('Order', 'uxbarn'),
            'title' => __('Title', 'uxbarn'),
            'cover_image' => __('Thumbnail', 'uxbarn'),
        );

        $defaults= array_merge($custom_columns, $defaults);
        return $defaults;
    }
    
}

if( ! function_exists('uxbarn_create_homeslider_columns_content')) {
	
    function uxbarn_create_homeslider_columns_content($column) {
        global $post;
        switch ($column)
        {
            case "cover_image":
                the_post_thumbnail('medium');
                break;
			case "slide_order":
                echo uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_homeslider_slide_order'), 0);
                break;
        }
         
    }
	
}
    
    
// Register Custom Post Type: Portfolio
if( ! function_exists('uxbarn_register_cpt_portfolio')) {
	    
    function uxbarn_register_cpt_portfolio() {
        $args = array(
            'label' => __('Portfolio', 'uxbarn'),
            'labels' => array(
                        'singular_name'=> __('Portfolio', 'uxbarn'),
                        'add_new' => __('Add New Portfolio Item', 'uxbarn'),
                        'add_new_item' => __('Add New Portfolio Item', 'uxbarn'),
                        'new_item' => __('New Portfolio Item', 'uxbarn'),
                        'edit_item' => __('Edit Portfolio Item', 'uxbarn'),
                        'all_items' => __('All Portfolio Items', 'uxbarn'),
                        'view_item' => __('View Portfolio', 'uxbarn'),
                        'search_items' => __('Search Portfolio', 'uxbarn'),
                        'not_found' => __('Nothing found', 'uxbarn'),
                        'not_found_in_trash' => __('Nothing found in Trash', 'uxbarn'),
                        ),
            'menu_icon' => IMAGE_PATH . '/admin/uxbarn-admin-s.jpg',
            'description' => __('Portfolio of your business', 'uxbarn'),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
            'rewrite' => array('slug' => __('portfolio', 'uxbarn'), 'with_front' => false)
            );
        
        register_post_type('portfolio', $args);
        
        $labels = array(
            'singular_name' => __('Portfolio Category', 'uxbarn'),
            'search_items' =>  __('Search Categories', 'uxbarn'),
            'all_items' => __('All Categories', 'uxbarn'),
            'edit_item' => __('Edit Category', 'uxbarn'), 
            'update_item' => __('Update Category', 'uxbarn'),
            'add_new_item' => __('Add New Category', 'uxbarn'),
        ); 
        
        register_taxonomy('portfolio-category', array('portfolio'),
            array(
                'hierarchical' => true, 
                'labels' => $labels,
                'label' => __('Portfolio Categories', 'uxbarn'), 
                'singular_label' => __('Portfolio Category', 'uxbarn'),
                'rewrite' => array('slug' => __('portfolio-category', 'uxbarn')),
            )
        );
        
        add_filter('manage_portfolio_posts_columns', 'uxbarn_create_portfolio_columns_header');  
        add_action('manage_portfolio_posts_custom_column', 'uxbarn_create_portfolio_columns_content');  
    }

}

if( ! function_exists('uxbarn_create_portfolio_columns_header')) {
	
    function uxbarn_create_portfolio_columns_header($defaults) {
        $custom_columns = array(
            'cb' => '<input type=\"checkbox\" />',
            'title' => __('Title', 'uxbarn'),
            'cover_image' => __('Thumbnail', 'uxbarn'),
            'item_format' => __('Item Format', 'uxbarn'),
            'terms' => __('Categories', 'uxbarn')
        );

        $defaults= array_merge($custom_columns, $defaults);
        return $defaults;
    }
    
}

if( ! function_exists('uxbarn_create_portfolio_columns_content')) {
	
    function uxbarn_create_portfolio_columns_content($column) {
        global $post;
        switch ($column)
        {
            case 'cover_image':
                the_post_thumbnail('thumbnail');
                break;
            case 'item_format':
                echo ucwords(uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_portfolio_item_format'), 0));
                break;
            case 'terms':
                $terms = get_the_terms($post->ID, 'portfolio-category');
                //if($terms && !is_wp_error($terms)) {
                if(!empty( $terms)) {
                    $out = array();
                    foreach ( $terms as $term )
                        $out[] = '<a href="' .get_term_link($term->slug, 'portfolio-category') .'">'.$term->name.'</a>';
                        $return = join( ', ', $out );
                        echo $return;
                
                } else {
                    echo ' ';
                }
                break;
        }
    }
	
}
    
    
// Register Custom Post Type: Team
if( ! function_exists('uxbarn_register_cpt_team')) {
	
    function uxbarn_register_cpt_team() {
        $args = array(
            'label' => __('Team', 'uxbarn'),
            'labels' => array(
                        'singular_name'=> __('Team Member', 'uxbarn'),
                        'add_new' => __('Add New Member', 'uxbarn'),
                        'add_new_item' => __('Add New Member', 'uxbarn'),
                        'new_item' => __('New Member', 'uxbarn'),
                        'edit_item' => __('Edit Member', 'uxbarn'),
                        'all_items' => __('All Members', 'uxbarn'),
                        'view_item' => __('View', 'uxbarn'),
                        'search_items' => __('Search Member', 'uxbarn'),
                        'not_found' => __('Nothing found', 'uxbarn'),
                        'not_found_in_trash' => __('Nothing found in Trash', 'uxbarn'),
                        ),
            'menu_icon' => IMAGE_PATH . '/admin/uxbarn-admin-s.jpg',
            'description' => __('Team', 'uxbarn'),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'has_archive' => false,
            'supports' => array('title', 'editor', 'thumbnail'),
            'rewrite' => array('slug' => __('team', 'uxbarn'), 'with_front' => false));
        
        register_post_type('team', $args);
        
        add_filter('manage_team_posts_columns', 'uxbarn_create_team_columns_header');  
        add_action('manage_team_posts_custom_column', 'uxbarn_create_team_columns_content');  
    }

}

if( ! function_exists('uxbarn_create_team_columns_header')) {
	
    function uxbarn_create_team_columns_header($defaults) {
        $custom_columns = array(
            'cb' => '<input type=\"checkbox\" />',
            'title' => __('Title', 'uxbarn'),
            'cover_image' => __('Thumbnail', 'uxbarn'),
            'position' => __('Position', 'uxbarn'),
        );

        $defaults= array_merge($custom_columns, $defaults);
        return $defaults;
    }
    
}

if( ! function_exists('uxbarn_create_team_columns_content')) {
	
    function uxbarn_create_team_columns_content($column) {
        global $post;
        switch ($column)
        {
            case "cover_image":
                the_post_thumbnail('thumbnail');
                break;
            case "position":
                echo uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_team_meta_info_position'), 0);
                break;
        }
    }
    
}



// Register Custom Post Type: Testimonials
if( ! function_exists('uxbarn_register_cpt_testimonials')) {
	
    function uxbarn_register_cpt_testimonials() {
        $args = array(
            'label' => __('Testimonials', 'uxbarn'),
            'labels' => array(
                        'singular_name'=> __('Testimonial', 'uxbarn'),
                        'add_new' => __('Add New Testimonial', 'uxbarn'),
                        'add_new_item' => __('Add New Testimonial', 'uxbarn'),
                        'new_item' => __('New Testimonial', 'uxbarn'),
                        'edit_item' => __('Edit Testimonial', 'uxbarn'),
                        'all_items' => __('All Testimonials', 'uxbarn'),
                        'view_item' => __('View Testimonials', 'uxbarn'),
                        'search_items' => __('Search Testimonials', 'uxbarn'),
                        'not_found' =>  __('Nothing found', 'uxbarn'),
                        'not_found_in_trash' => __('Nothing found in Trash', 'uxbarn'),
                        ),
            'menu_icon' => IMAGE_PATH . '/admin/uxbarn-admin-s.jpg',
            'description' => __('Testimonials of your business', 'uxbarn'),
            'public' => false,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'has_archive' => false,
            'supports' => array('title', 'thumbnail'),
            'rewrite' => false
            );
        
        register_post_type('testimonials', $args);
        
        add_filter('manage_testimonials_posts_columns', 'uxbarn_create_testimonial_columns_header');  
        add_action('manage_testimonials_posts_custom_column', 'uxbarn_create_testimonial_columns_content');  
    }

}

if( ! function_exists('uxbarn_create_testimonial_columns_header')) {
	   
    function uxbarn_create_testimonial_columns_header($defaults) {
        $custom_columns = array(
            'cb' => '<input type=\"checkbox\" />',
            'title' => __('Title', 'uxbarn'),
            'text' => __('Testimonial', 'uxbarn'),
            'cover_image' => __('Thumbnail', 'uxbarn'),
        );

        $defaults= array_merge($custom_columns, $defaults);
        return $defaults;
    }
	
}

if( ! function_exists('uxbarn_create_testimonial_columns_content')) {
	
    function uxbarn_create_testimonial_columns_content($column) {
        global $post;
        switch ($column)
        {
            case "text":
                //the_content();
                echo uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_testimonial_text'), 0);
                break;
            case "cover_image":
                the_post_thumbnail('thumbnail');
                break;
        }
    }
	
}