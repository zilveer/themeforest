<?php

function register_portfolio_post_type(){

	global $mk_settings;

	if(isset($mk_settings['portfolio-slug']) && !empty($mk_settings['portfolio-slug'])) {
		$portfolo_slug = $mk_settings['portfolio-slug'];
	} else {
		$portfolo_slug = 'portfolio-posts';
	}

	register_post_type('portfolio', array(
		'labels' => array(
			'name' => __('Portfolios', 'mk_framework' ),
			'singular_name' => __('Portfolio', 'mk_framework' ),
			'add_new' => __('Add New', 'mk_framework' ),
			'add_new_item' => __('Add New Portfolio', 'mk_framework' ),
			'edit_item' => __('Edit Portfolio', 'mk_framework' ),
			'new_item' => __('New Portfolio', 'mk_framework' ),
			'view_item' => __('View Portfolio', 'mk_framework' ),
			'search_items' => __('Search Portfolios', 'mk_framework' ),
			'not_found' =>  __('No portfolios found', 'mk_framework' ),
			'not_found_in_trash' => __('No portfolios found in Trash', 'mk_framework' ), 
			'parent_item_colon' => '',
		),
		'singular_label' => __('portfolio', 'mk_framework' ),
		'public' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'menu_icon'=> 'dashicons-portfolio',
		'capability_type' => 'post',
		'menu_position' => 100,
		'hierarchical' => false,
		'rewrite' => array('slug' => $portfolo_slug, 'with_front' => FALSE),
		'query_var' => $portfolo_slug,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'page-attributes', 'post-formats', 'revisions'),
	));

	//register taxonomy for portfolio
	register_taxonomy('portfolio_category','portfolio',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => __( 'Portfolio Categories', 'mk_framework' ),
			'singular_name' => __( 'Portfolio Category', 'mk_framework' ),
			'search_items' =>  __( 'Search Categories', 'mk_framework' ),
			'popular_items' => __( 'Popular Categories', 'mk_framework' ),
			'all_items' => __( 'All Categories', 'mk_framework' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Portfolio Category', 'mk_framework' ), 
			'update_item' => __( 'Update Portfolio Category', 'mk_framework' ),
			'add_new_item' => __( 'Add New Portfolio Category', 'mk_framework' ),
			'new_item_name' => __( 'New Portfolio Category Name', 'mk_framework' ),
			'separate_items_with_commas' => __( 'Separate Portfolio category with commas', 'mk_framework' ),
			'add_or_remove_items' => __( 'Add or remove portfolio category', 'mk_framework' ),
			'choose_from_most_used' => __( 'Choose from the most used portfolio category', 'mk_framework' ),
			
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => false,
		'show_in_nav_menus' => true,
	));
}
add_action('init','register_portfolio_post_type');

/*-----------------------------------------------------------------------------------*/
/* Manage portfolio's columns */
/*-----------------------------------------------------------------------------------*/
function edit_portfolio_columns($portfolio_columns) {
	$portfolio_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => _x('Portfolio Name', 'column name', 'mk_framework' ),
		"portfolio_categories" => __('Categories', 'mk_framework' ),
		"thumbnail" => __('Thumbnail', 'mk_framework' )
	);

	return $portfolio_columns;
}
add_filter('manage_edit-portfolio_columns', 'edit_portfolio_columns');

function manage_portfolio_columns($column) {
	global $post;
	
	if ($post->post_type == "portfolio") {
		switch($column){
			case "portfolio_categories":
				$terms = get_the_terms($post->ID, 'portfolio_category');
				
				if (! empty($terms)) {
					foreach($terms as $t)
						$output[] = "<a href='edit.php?post_type=portfolio&portfolio_tag=$t->slug'> " . esc_html(sanitize_term_field('name', $t->name, $t->term_id, 'portfolio_tag', 'display')) . "</a>";
					$output = implode(', ', $output);
				} else {
					$t = get_taxonomy('portfolio_category');
					$output = "No $t->label";
				}
				
				echo $output;
				break;
			
			case 'thumbnail':
				echo the_post_thumbnail('thumbnail');
				break;
		}
	}
}
add_action('manage_posts_custom_column', 'manage_portfolio_columns', 10, 2);


?>