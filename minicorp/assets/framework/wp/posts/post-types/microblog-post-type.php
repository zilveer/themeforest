<?php

    /*******************************************************************************************************************
     * Create and register Microblog post type
     */
    if ( !function_exists( 'ishyoboy_microblog_post_type' ) ){
		function ishyoboy_microblog_post_type()
	    {
	        $labels = array(
	            'name'                  => __( 'Microblog', 'ishyoboy' ),
	            'singular_name'         => __( 'Microblog', 'ishyoboy' ),
	            'add_new'               => _x( 'Add Post', 'microblog-post', 'ishyoboy' ),
	            'edit_item'             => __( 'Edit Microblog Post', 'ishyoboy' ),
	            'new_item'              => __( 'New Microblog Post', 'ishyoboy' ),
	            'all_items'             => __( 'Microblog Posts', 'ishyoboy' ),
	            'view_item'             => __( 'View Post', 'ishyoboy' ),
	            'search_items'          => __( 'Search Microblog', 'ishyoboy' ),
	            'not_found'             => __( 'No Microblog Posts Found', 'ishyoboy' ),
	            'not_found_in_trash'    => __( 'No Microblog Posts Found In Trash', 'ishyoboy' ),
	            'parent_item_colon'     => ''
	        );
	        $taxonomies = array();
	        $supports = array('title', 'editor', 'thumbnail', 'post-formats', 'comments');
	        $args = array(
	            'labels'                => $labels,
	            'public'                => true,
	            'publicly_queryable'    => true,
	            'rewrite'               => array(
	                'slug'              => 'microblog',
	                'with_front'        => true,
	                'feed'              => true,
	                'pages'             => false
	            ),
	            'show_ui'               => true,
	            'query_var'             => true,
	            'capability_type'       => 'post',
	            'hierarchical'          => true,
	            'menu_position'         => null,
	            'has_archive'           => false,
	            'supports'              => $supports,
	            'taxonomies'            => $taxonomies
	        );

	        register_post_type('microblog-post', $args);

	    }
    }


    /*******************************************************************************************************************
     * Set Microblog post type's messages
     */
	if ( !function_exists( 'ishyoboy_microblog_messages' ) ){
		function ishyoboy_microblog_messages($messages)
	    {
	        global $post, $post_ID;

	        $messages['microblog-post'] =
	            array(
	                0 => '',
	                1 => sprintf(('Microblog Updated. <a href="%s">View microblog</a>'), esc_url(get_permalink($post_ID))),
	                2 => __('Custom Field Updated.', 'ishyoboy'),
	                3 => __('Custom Field Deleted.', 'ishyoboy'),
	                4 => __('Microblog Updated.', 'ishyoboy'),
	                5 => isset($_GET['revision']) ? sprintf( __('Microblog Restored To Revision From %s', 'ishyoboy'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
	                6 => sprintf(__('Microblog Published. <a href="%s">View Microblog</a>', 'ishyoboy'), esc_url(get_permalink($post_ID))),
	                7 => __('Microblog Saved.', 'ishyoboy'),
	                8 => sprintf(__('Microblog Submitted. <a target="_blank" href="%s">Preview Microblog</a>', 'ishyoboy'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
	                9 => sprintf(__('Microblog Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Microblog</a>', 'ishyoboy'), date_i18n( __( 'M j, Y @ G:i' , 'ishyoboy' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
	                10 => sprintf(__('Microblog Draft Updated. <a target="_blank" href="%s">Preview Microblog</a>', 'ishyoboy'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
	            );
	        return $messages;
	    }
	}

/*******************************************************************************************************************
 * Create Categories for Microblog post type
 */
if ( !function_exists( 'ishyoboy_microblog_category' ) ){
	function ishyoboy_microblog_category()
	{

	    $labels = array(
	        'name'                          => __( 'Categories', 'ishyoboy' ),
	        'singular_name'                 => __( 'Category', 'ishyoboy' ),
	        'search_items'                  => __( 'Search Categories', 'ishyoboy' ),
	        'popular_items'                 => __( 'Popular Categories', 'ishyoboy' ),
	        'all_items'                     => __( 'All Categories', 'ishyoboy' ),
	        'parent_item'                   => __( 'Parent Category', 'ishyoboy' ),
	        'edit_item'                     => __( 'Edit Category', 'ishyoboy' ),
	        'update_item'                   => __( 'Update Category', 'ishyoboy' ),
	        'add_new_item'                  => __( 'Add New Category', 'ishyoboy' ),
	        'new_item_name'                 => __( 'New Category', 'ishyoboy' ),
	        'separate_items_with_commas'    => __( 'Separate Categories with commas', 'ishyoboy' ),
	        'add_or_remove_items'           => __( 'Add or remove Category', 'ishyoboy' ),
	        'choose_from_most_used'         => __( 'Choose from most used Categories', 'ishyoboy' )
	    );

	    $args = array(
	        'labels'                        => $labels,
	        'public'                        => true,
	        'hierarchical'                  => true,
	        'show_ui'                       => true,
	        'show_in_nav_menus'             => true,
	        'query_var'                     => true,
	        "rewrite"                       => array(
	            'slug'          => 'microblog-category',
	            'hierarchical'  => true
	        )
	    );

	    register_taxonomy( 'microblog_category', 'microblog-post', $args );

	}
}

/*******************************************************************************************************************
 * Create Tags for Microblog post type
 */
if ( !function_exists( 'ishyoboy_microblog_tags' ) ){
	function ishyoboy_microblog_tags()
	{

	    $labels = array(
	        'name'                          => __( 'Tags', 'ishyoboy' ),
	        'singular_name'                 => __( 'Tag', 'ishyoboy' ),
	        'search_items'                  => __( 'Search Tags', 'ishyoboy' ),
	        'popular_items'                 => __( 'Popular Tags', 'ishyoboy' ),
	        'all_items'                     => __( 'All Tags', 'ishyoboy' ),
	        'parent_item'                   => __( 'Parent Tag', 'ishyoboy' ),
	        'edit_item'                     => __( 'Edit Tag', 'ishyoboy' ),
	        'update_item'                   => __( 'Update Tag', 'ishyoboy' ),
	        'add_new_item'                  => __( 'Add New Tag', 'ishyoboy' ),
	        'new_item_name'                 => __( 'New Tag', 'ishyoboy' ),
	        'separate_items_with_commas'    => __( 'Separate Tags with commas', 'ishyoboy' ),
	        'add_or_remove_items'           => __( 'Add or remove Tag', 'ishyoboy' ),
	        'choose_from_most_used'         => __( 'Choose from most used Tags', 'ishyoboy' )
	    );

	    $args = array(
	        'labels'                        => $labels,
	        'public'                        => true,
	        'hierarchical'                  => false,
	        'show_ui'                       => true,
	        'show_in_nav_menus'             => true,
	        'query_var'                     => true,
	        "rewrite"                       => array(
	            'slug'          => 'microblog-tag',
	            'hierarchical'  => true
	        )
	    );

	    register_taxonomy( 'microblog_tags', 'microblog-post', $args );

	}
}

/*******************************************************************************************************************
 * Backend columns
 */
if ( !function_exists( 'ishyoboy_microblog_edit_columns' ) ){
	function ishyoboy_microblog_edit_columns( $columns ){
	    $columns = array(
	        "cb" => "<input type=\"checkbox\" />",
	        "title" => __( 'Title', 'ishyoboy' ),
	        "category" => __( 'Categories', 'ishyoboy' ),
	        "tag" => __( 'Tags', 'ishyoboy' ),
	        "thumbnail" => __( 'Image', 'ishyoboy' ),
	        "author" => __( 'Author', 'ishyoboy' ),
	        "comments" => '', //__( '', 'ishyoboy' ),
	        "date" => __( 'Date', 'ishyoboy' )
	    );

	     $columns['comments'] = '<div class="vers"><img src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" alt="Comments" /></div>';

	    return $columns;
	}
}
add_filter("manage_edit-microblog-post_columns", "ishyoboy_microblog_edit_columns");

if ( !function_exists( 'ishyoboy_microblog_custom_columns' ) ){
	function ishyoboy_microblog_custom_columns($column){
	    global $post;

	    switch ($column)
	    {
	        case "thumbnail":
	            the_post_thumbnail('thumbnail');
	            break;
	        case "category":
	            echo get_the_term_list($post->ID, 'microblog_category', '', ', ','');
	            break;
	        case "tag":
	            echo get_the_term_list($post->ID, 'microblog_tags', '', ', ','');
	            break;
	    }
	}
}
add_action( 'manage_microblog-post_posts_custom_column' , 'ishyoboy_microblog_custom_columns', 10, 2 );


    /*******************************************************************************************************************
     * Initialize Microblog post type
     */
    add_action( 'init', 'ishyoboy_microblog_post_type' );
    add_action( 'init', 'ishyoboy_microblog_category', 0 );
    add_action( 'init', 'ishyoboy_microblog_tags', 0 );
    add_filter( 'post_updated_messages', 'ishyoboy_microblog_messages' );
