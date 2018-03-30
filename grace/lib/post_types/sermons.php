<?php

add_action( 'init', 'register_cpt_sermon' );

function register_cpt_sermon() {

    $labels = array( 
        'name' => _x( 'Sermons', TB_SERMON_CPT ),
        'singular_name' => _x( 'Sermon', TB_SERMON_CPT ),
        'add_new' => _x( 'Add New', TB_SERMON_CPT ),
        'add_new_item' => _x( 'Add New Sermon', TB_SERMON_CPT ),
        'edit_item' => _x( 'Edit Sermon', TB_SERMON_CPT ),
        'new_item' => _x( 'New Sermon', TB_SERMON_CPT ),
        'view_item' => _x( 'View Sermon', TB_SERMON_CPT ),
        'search_items' => _x( 'Search Sermons', TB_SERMON_CPT ),
        'not_found' => _x( 'No sermons found', TB_SERMON_CPT ),
        'not_found_in_trash' => _x( 'No sermons found in Trash', TB_SERMON_CPT ),
        'parent_item_colon' => _x( 'Parent Sermon:', TB_SERMON_CPT ),
        'menu_name' => _x( 'Sermons', TB_SERMON_CPT ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies' => array( TB_SERMON_TAX_TOPIC, TB_SERMON_TAX_SCRIPTURE, TB_SERMON_TAX_OCCASION ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
		
		'menu_icon' => PARENT_URL . '/images/icons/sermon.png',
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( TB_SERMON_CPT, $args );
}

/*--------------------------TAXONOMY--------------------------*/
/*----------------------------TOPIC---------------------------*/
add_action( 'init', 'register_taxonomy_sermon_topic' );

function register_taxonomy_sermon_topic() {

    $labels = array( 
        'name' => _x( 'Sermon Topics', TB_SERMON_TAX_TOPIC ),
        'singular_name' => _x( 'Sermon Topic', TB_SERMON_TAX_TOPIC ),
        'search_items' => _x( 'Search Sermon Topics', TB_SERMON_TAX_TOPIC ),
        'popular_items' => _x( 'Popular Sermon Topics', TB_SERMON_TAX_TOPIC ),
        'all_items' => _x( 'All Sermon Topics', TB_SERMON_TAX_TOPIC ),
        'parent_item' => _x( 'Parent Sermon Topic', TB_SERMON_TAX_TOPIC ),
        'parent_item_colon' => _x( 'Parent Sermon Topic:', TB_SERMON_TAX_TOPIC ),
        'edit_item' => _x( 'Edit Sermon Topic', TB_SERMON_TAX_TOPIC ),
        'update_item' => _x( 'Update Sermon Topic', TB_SERMON_TAX_TOPIC ),
        'add_new_item' => _x( 'Add New Sermon Topic', TB_SERMON_TAX_TOPIC ),
        'new_item_name' => _x( 'New Sermon Topic', TB_SERMON_TAX_TOPIC ),
        'separate_items_with_commas' => _x( 'Separate sermon topics with commas', TB_SERMON_TAX_TOPIC ),
        'add_or_remove_items' => _x( 'Add or remove sermon topics', TB_SERMON_TAX_TOPIC ),
        'choose_from_most_used' => _x( 'Choose from the most used sermon topics', TB_SERMON_TAX_TOPIC ),
        'menu_name' => _x( 'Sermon Topics', TB_SERMON_TAX_TOPIC ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( TB_SERMON_TAX_TOPIC, array( TB_SERMON_CPT ), $args );
}

/*----------------------------SCRIPTURE---------------------------*/
add_action( 'init', 'register_taxonomy_sermon_scripture' );

function register_taxonomy_sermon_scripture() {

    $labels = array( 
        'name' => _x( 'Sermon Scriptures', TB_SERMON_TAX_SCRIPTURE ),
        'singular_name' => _x( 'Sermon Scripture', TB_SERMON_TAX_SCRIPTURE ),
        'search_items' => _x( 'Search Sermon Scriptures', TB_SERMON_TAX_SCRIPTURE ),
        'popular_items' => _x( 'Popular Sermon Scriptures', TB_SERMON_TAX_SCRIPTURE ),
        'all_items' => _x( 'All Sermon Scriptures', TB_SERMON_TAX_SCRIPTURE ),
        'parent_item' => _x( 'Parent Sermon Scripture', TB_SERMON_TAX_SCRIPTURE ),
        'parent_item_colon' => _x( 'Parent Sermon Scripture:', TB_SERMON_TAX_SCRIPTURE ),
        'edit_item' => _x( 'Edit Sermon Scripture', TB_SERMON_TAX_SCRIPTURE ),
        'update_item' => _x( 'Update Sermon Scripture', TB_SERMON_TAX_SCRIPTURE ),
        'add_new_item' => _x( 'Add New Sermon Scripture', TB_SERMON_TAX_SCRIPTURE ),
        'new_item_name' => _x( 'New Sermon Scripture', TB_SERMON_TAX_SCRIPTURE ),
        'separate_items_with_commas' => _x( 'Separate sermon scriptures with commas', TB_SERMON_TAX_SCRIPTURE ),
        'add_or_remove_items' => _x( 'Add or remove sermon scriptures', TB_SERMON_TAX_SCRIPTURE ),
        'choose_from_most_used' => _x( 'Choose from the most used sermon scriptures', TB_SERMON_TAX_SCRIPTURE ),
        'menu_name' => _x( 'Sermon Scriptures', TB_SERMON_TAX_SCRIPTURE ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( TB_SERMON_TAX_SCRIPTURE, array( TB_SERMON_CPT ), $args );
}

/*----------------------------OCCASION---------------------------*/
add_action( 'init', 'register_taxonomy_sermon_occasion' );

function register_taxonomy_sermon_occasion() {

    $labels = array( 
        'name' => _x( 'Sermon Occasions', TB_SERMON_TAX_OCCASION ),
        'singular_name' => _x( 'Sermon Occasion', TB_SERMON_TAX_OCCASION ),
        'search_items' => _x( 'Search Sermon Occasions', TB_SERMON_TAX_OCCASION ),
        'popular_items' => _x( 'Popular Sermon Occasions', TB_SERMON_TAX_OCCASION ),
        'all_items' => _x( 'All Sermon Occasions', TB_SERMON_TAX_OCCASION ),
        'parent_item' => _x( 'Parent Sermon Occasion', TB_SERMON_TAX_OCCASION ),
        'parent_item_colon' => _x( 'Parent Sermon Occasion:', TB_SERMON_TAX_OCCASION ),
        'edit_item' => _x( 'Edit Sermon Occasion', TB_SERMON_TAX_OCCASION ),
        'update_item' => _x( 'Update Sermon Occasion', TB_SERMON_TAX_OCCASION ),
        'add_new_item' => _x( 'Add New Sermon Occasion', TB_SERMON_TAX_OCCASION ),
        'new_item_name' => _x( 'New Sermon Occasion', TB_SERMON_TAX_OCCASION ),
        'separate_items_with_commas' => _x( 'Separate sermon occasions with commas', TB_SERMON_TAX_OCCASION ),
        'add_or_remove_items' => _x( 'Add or remove sermon occasions', TB_SERMON_TAX_OCCASION ),
        'choose_from_most_used' => _x( 'Choose from the most used sermon occasions', TB_SERMON_TAX_OCCASION ),
        'menu_name' => _x( 'Sermon Occasions', TB_SERMON_TAX_OCCASION ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( TB_SERMON_TAX_OCCASION, array( TB_SERMON_CPT ), $args );
}

/*-----------------------CUSTOM COLUMNS-----------------------*/
add_filter( 'manage_edit-' . TB_SERMON_CPT . '_columns', 'set_custom_edit_sermon_columns' );
add_action( 'manage_' . TB_SERMON_CPT . '_posts_custom_column' , 'custom_sermon_column', 10, 2 );

function set_custom_edit_sermon_columns($columns) {
	$columns = array(
		"cb"			=>	"<input type=\"checkbox\" />",
		"title"			=>	__("Name", 'grace'),
		"_tb_date"		=>	__("Date", 'grace'),
		"_tb_time"		=>	__("Time", 'grace'),
		"_tb_church"	=>	__("Church", 'grace'),
		"_tb_scripture"	=>	__("Scripture", 'grace'),
		"_tb_topic"		=>	__("Topic", 'grace'),
		"_tb_occasion"	=>	__("Occasion", 'grace'),
	);

	return $columns;
}

function custom_sermon_column( $column, $post_id ) {
	$postCustom = get_post_custom($post_id);

    switch ( $column ) {

        case '_tb_church' :
            if ($postCustom['_tb_church'][0]) echo get_the_title($postCustom['_tb_church'][0]);
            break;

        case '_tb_date' :
			$startDate = $postCustom['_tb_date'][0];
			if ($startDate) {
				echo date_i18n(get_option('date_format'), $startDate);
			}
            
            break;

        case '_tb_time' :
            echo $postCustom['_tb_time'][0];;
            break;

        case '_tb_scripture' :
			$scriptures = get_the_terms($post_id, TB_SERMON_TAX_SCRIPTURE);
			if (!empty($scriptures))
			{
				$scripturesArray = array();
				foreach ($scriptures as $scripture)	$scripturesArray[] = $scripture->name;

				echo implode($scripturesArray, ", ");
			}

            break;

        case '_tb_topic' :
			$topics = get_the_terms($post_id, TB_SERMON_TAX_TOPIC);
			if (!empty($topics))
			{
				$topicsArray = array();
				foreach ($topics as $topic)	$topicsArray[] = $topic->name;

				echo implode($topicsArray, ", ");
			}

            break;

        case '_tb_occasion' :
			$occasions = get_the_terms($post_id, TB_SERMON_TAX_OCCASION);
			if (!empty($occasions))
			{
				$occasionsArray = array();
				foreach ($occasions as $occasion) $occasionsArray[] = $occasion->name;

				echo implode($occasionsArray, ", ");
			}

            break;
			
    }
}

?>