<?php
/**
 * Create custom posts types
 *
 * @since  Collective 1.0
 */

if ( !function_exists('tfuse_create_custom_post_types') ) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_create_custom_post_types()
    {
		//Reservation_form
        $labels = array(
                'name' => __('Reservation', 'tfuse'),
                'singular_name' => __('Reservation', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Reservation', 'tfuse'),
                'edit_item' => __('Edit Reservation info', 'tfuse'),
                'new_item' => __('New Reservation', 'tfuse'),
                'all_items' => __('All Reservations', 'tfuse'),
                'view_item' => __('View Reservation info', 'tfuse'),
                'parent_item_colon' => ''
        );
        $reservationform_rewrite=apply_filters('tfuse_reservationform_rewrite','reservationform_list');
        $res_args = array(
                        'labels' => $labels,
                        'public' => true,
                        'publicly_queryable' => false,
                        'show_ui' => false,
                        'query_var' => true,
                        'exclude_from_search'=>true,
                        'has_archive' => true,
                        'rewrite' => array('slug'=> $reservationform_rewrite),
                        'menu_position' => 6,
                        'supports' => array(null)
                );
        register_taxonomy('reservations', array('reservations'), array(
                    'hierarchical' => true,
                    'labels' => array(
                        'name' => __('Reservation Forms', 'tfuse'),
                        'singular_name' => __('Reservation Form', 'tfuse'),
                        'add_new_item' => __('Add New Reservation Form', 'tfuse'),
                    ),
                    'show_ui' => false,
                    'query_var' => true,
                    'rewrite' => array('slug' => $reservationform_rewrite)
                ));
                register_post_type( 'reservations' , $res_args );
          
        // Portfolio
        $labels = array(
                'name' => __('Portfolio', 'tfuse'),
                'singular_name' => __('Portfolio', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Portfolio', 'tfuse'),
                'edit_item' => __('Edit Portfolio info', 'tfuse'),
                'new_item' => __('New Portfolio', 'tfuse'),
                'all_items' => __('All Works', 'tfuse'),
                'view_item' => __('View Portfolio info', 'tfuse'),
                'search_items' => __('Search Portfolio', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $portfoliolist_rewrite = apply_filters('tfuse_portfoliolist_rewrite','all-portfolio-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $portfoliolist_rewrite),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories','tfuse'),
            'singular_name' => __('Category','tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $portfoliolist_taxonomy_rewrite = apply_filters('tfuse_portfoliolist_taxonomy_rewrite','portfolio-group');
        register_taxonomy('group', array('portfolio'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $portfoliolist_taxonomy_rewrite)
        ));

        //Tags
        $labels = array(
            'name' => __('Tags','tfuse' ),
            'singular_name' => __('Tag','tfuse'),
            'search_items' => __('Search Tags','tfuse'),
            'popular_items' => __( 'Popular Tags','tfuse' ),
            'all_items' => __('All Tags','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Tagv','tfuse'),
            'update_item' => __('Update Tag','tfuse'),
            'add_new_item' => __('Add New Tag','tfuse'),
            'new_item_name' => __('New Tag Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate tags with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove tags','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used tags','tfuse' ),
        );

        register_taxonomy('tags', 'portfolio', array(
            'hierarchical' => false,
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => 'tags')
        ));

        register_post_type( 'portfolio' , $args );
        
        // Services
        $labels = array(
                'name' => __('Services', 'tfuse'),
                'singular_name' => __('Service', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Service info', 'tfuse'),
                'new_item' => __('New Service', 'tfuse'),
                'all_items' => __('All Services', 'tfuse'),
                'view_item' => __('View Service info', 'tfuse'),
                'search_items' => __('Search Service', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $servicelist_rewrite = apply_filters('tfuse_servicelist_rewrite','all-service-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $servicelist_rewrite),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories','tfuse'),
            'singular_name' => __('Category','tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $servicelist_taxonomy_rewrite = apply_filters('tfuse_servicelist_taxonomy_rewrite','portfolio-list');
        register_taxonomy('services', array('service'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $servicelist_taxonomy_rewrite)
        ));

        register_post_type( 'service' , $args );

        // TESTIMONIALS
        $labels = array(
                'name' => __('Testimonials', 'tfuse'),
                'singular_name' => __('Testimonial', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Testimonial', 'tfuse'),
                'edit_item' => __('Edit Testimonial', 'tfuse'),
                'new_item' => __('New Testimonial', 'tfuse'),
                'all_items' => __('All Testimonials', 'tfuse'),
                'view_item' => __('View Testimonial', 'tfuse'),
                'search_items' => __('Search Testimonials', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','editor')
        );
        register_post_type( 'testimonials' , $args );

        // Members
        $labels = array(
            'name' => __('Members', 'tfuse'),
            'singular_name' => __('Member', 'tfuse'),
            'add_new' => __('Add New', 'tfuse'),
            'add_new_item' => __('Add New Member', 'tfuse'),
            'edit_item' => __('Edit Member', 'tfuse'),
            'new_item' => __('New Member', 'tfuse'),
            'all_items' => __('All Members', 'tfuse'),
            'view_item' => __('View Member', 'tfuse'),
            'search_items' => __('Search Members', 'tfuse'),
            'not_found' =>  __('Nothing found', 'tfuse'),
            'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' => $labels,
            'public' => false,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'menu_position' => 6,
            'supports' => array('title','editor','excerpt')
        );
        register_post_type( 'members' , $args );


    }
    tfuse_create_custom_post_types();

endif;

add_action('category_add_form', 'taxonomy_redirect_note');
add_action('specialties_add_form', 'taxonomy_redirect_note');
function taxonomy_redirect_note($taxonomy){
    echo '<p><strong>Note:</strong> More options are available after you add the '.$taxonomy.'. <br />
        Click on the Edit button under the '.$taxonomy.' name.</p>';
}