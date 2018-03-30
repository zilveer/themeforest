<?php
/* Property Custom Post Type */
if( !function_exists( 'create_partners_post_type' ) ){
    function create_partners_post_type(){

      $labels = array(
        'name' => __( 'Partners','framework'),
        'singular_name' => __( 'Partner','framework' ),
        'add_new' => __('Add New','framework'),
        'add_new_item' => __('Add New Partner','framework'),
        'edit_item' => __('Edit Partner','framework'),
        'new_item' => __('New Partner','framework'),
        'view_item' => __('View Partner','framework'),
        'search_items' => __('Search Partner','framework'),
        'not_found' =>  __('No Partner found','framework'),
        'not_found_in_trash' => __('No Partner found in Trash','framework'),
        'parent_item_colon' => ''
      );

      $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-groups',
        'menu_position' => 5,
        'exclude_from_search' => true,
        'supports' => array('title','thumbnail'),
        'rewrite' => array( 'slug' => __('partners', 'framework') )
      );

      register_post_type('partners',$args);
    }
}
add_action('init', 'create_partners_post_type');


/* Add Custom Columns */
if( !function_exists( 'partners_edit_columns' ) ){
    function partners_edit_columns($columns){
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __('Partner','framework'),
            "partner-thumb" => __('Logo','framework'),
            "date" => __('Publish Time', 'framework')
        );
        return $columns;
    }
}
add_filter("manage_edit-partners_columns", "partners_edit_columns");


if( !function_exists( 'partners_custom_columns' ) ){
    function partners_custom_columns($column){
        global $post;
        switch ($column){
            case 'partner-thumb':
                if(has_post_thumbnail($post->ID)){
                    the_post_thumbnail( 'partners-logo' );
                }
                else{
                    _e('No logo provided','framework');
                }
                break;
        }
    }
}

add_action("manage_posts_custom_column",  "partners_custom_columns");

?>