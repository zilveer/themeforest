<?php

/* ---------------------------------------------------------------------- */
/*	Portfolio
/* ---------------------------------------------------------------------- */

// Add portfolio post type
function post_type_portfolio()
{
	$labels = 
	array(
		'name' 			=> __( 'Portfolio', 'qs_framework'), 
		'singular_name' 	=> __('Portfolio', 'qs_framework'),
		'rewrite' 		=> array('slug' => __( 'portfolio', 'qs_framework' )),
		'add_new' 		=> __('Add Item', 'qs_framework'), 
		'edit_item' 		=> __('Edit Portfolio Item', 'qs_framework'),
		'new_item' 		=> __('New Portfolio Item', 'qs_framework'), 
		'view_item' 		=> __('View Portfolio', 'qs_framework'),
		'search_items'	 	=> __('Search Portfolio', 'qs_framework'), 
		'not_found'		=>  __('No Portfolio Items Found', 'qs_framework'),
		'not_found_in_trash'    => __('No Portfolio Items Found In Trash', 'qs_framework'),
		'parent_item_colon'     => '' 
	);
	
	$args = 
	array(
		'labels' 			=> $labels, 
		'public' 			=> true, 
		'publicly_queryable'=> true, 
		'show_ui' 			=> true, 
		'query_var' 		=> true, 
		'rewrite' 			=> true, 
		'capability_type' 	=> 'post', 
		'hierarchical'		=> false, 
		'menu_position' 	=> null, 
		'supports' 			=> array( 'title', 'editor', 'thumbnail', 'page-attributes') 
	);
	
	register_post_type(__( 'portfolio', 'qs_framework' ),$args);
	
	
}


// Add category filter for portfolio
function portfolio_filter()
{
	register_taxonomy(__( "filter", 'qs_framework' ), 

	array(__( "portfolio", 'qs_framework' )), 
	
	array(
		"hierarchical" => true, 
		"label" => __( "Filter", 'qs_framework' ), 
		"singular_label" => __( "Filter", 'qs_framework' ), 
		"rewrite" => array(
				'slug' => 'filter', 
				'hierarchical' => true
				)
		)
	); 
} 

// Custom colums for 'Team'
function qs_edit_portfolio_columns() {

	$columns = array(
		'cb'          => '<input type="checkbox" />',
		'title'       => __( 'Name', 'qs_framework' ),
		'thumbnail'   => __( 'Photo', 'qs_framework' ),
		'menu_order'   => __( 'Order', 'qs_framework' ),
	);

	return $columns;

}


// Custom colums content for 'Team'
function qs_manage_portfolio_columns( $column, $post_id ) {

	global $post;

	switch ( $column ) {

		case 'thumbnail':

			echo '<a href="' . get_edit_post_link( $post_id ) . '">' . get_the_post_thumbnail( $post_id, array(50, 50), array( 'title' => get_the_title( $post_id ) ) ) . '</a>';

			break;

		case 'menu_order':
			
			$order = $post->menu_order;
      		echo $order;

			break;
		
		default:
			break;
	}

}


// Sortable custom columns for 'Team'
function qs_sortable_portfolio_columns( $columns ) {

	$columns['menu_order'] = 'menu_order';

	return $columns;

}


function restrict_portfolio_posts() {
	global $typenow;
	$taxonomy = 'filter';
	if( $typenow != "page" && $typenow != "post" ){
		$filters = array($taxonomy);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Show All ".$tax_name."s</option>";
                        if(isset($_GET[$tax_slug])) $slug_request = $_GET[$tax_slug];
                        else { $slug_request = ''; }
			foreach ($terms as $term) { echo '<option value='. $term->slug, $slug_request == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; }
			echo "</select>";
		}
	}
}

add_action( 'restrict_manage_posts', 'restrict_portfolio_posts' );
add_action('init', 'post_type_portfolio');
add_action('init', 'portfolio_filter', 0 );
add_action('manage_edit-portfolio_columns', 'qs_edit_portfolio_columns');
add_action('manage_portfolio_posts_custom_column', 'qs_manage_portfolio_columns', 10, 2);
add_action('manage_edit-portfolio_sortable_columns', 'qs_sortable_portfolio_columns');


/* ---------------------------------------------------------------------- */
/*	Team Members
/* ---------------------------------------------------------------------- */

// Add team post type
function qs_register_post_type_team() {

	$labels = array(
		'name'               => __( 'Team', 'qs_framework' ),
		'singular_name'      => __( 'Member', 'qs_framework' ),
		'add_new'            => __( 'Add New', 'qs_framework' ),
		'add_new_item'       => __( 'Add New Member', 'qs_framework' ),
		'edit_item'          => __( 'Edit Member', 'qs_framework' ),
		'new_item'           => __( 'New Member', 'qs_framework' ),
		'view_item'          => __( 'View Member', 'qs_framework' ),
		'search_items'       => __( 'Search Members', 'qs_framework' ),
		'not_found'          => __( 'No members found', 'qs_framework' ),
		'not_found_in_trash' => __( 'No members found in Trash', 'qs_framework' ),
		'parent_item_colon'  => __( 'Parent Member:', 'qs_framework' ),
		'menu_name'          => __( 'Team', 'qs_framework' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'taxonomies'          => array(''),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array( 'slug' => 'team-member' ),
		'capability_type'     => 'post',
		'menu_position'       => null,
		'menu_icon'           => QS_BASE_URL . 'library/admin/images/team.png'
	);

	register_post_type( 'team', apply_filters( 'qs_register_post_type_team', $args ) );

} 


// Custom colums for 'Team'
function qs_edit_team_columns() {

	$columns = array(
		'cb'          => '<input type="checkbox" />',
		'title'       => __( 'Name', 'qs_framework' ),
		'thumbnail'   => __( 'Photo', 'qs_framework' ),
		'job_title'   => __( 'Job Title', 'qs_framework' ),
		'menu_order'  => __( 'Order', 'qs_framework')
	);

	return $columns;

}


// Custom colums content for 'Team'
function qs_manage_team_columns( $column, $post_id ) {

	global $post;

	switch ( $column ) {

		case 'thumbnail':

			echo '<a href="' . get_edit_post_link( $post_id ) . '">' . get_the_post_thumbnail( $post_id, array(50, 50), array( 'title' => get_the_title( $post_id ) ) ) . '</a>';

			break;

		case 'job_title':
			
			echo qs_get_meta( 'qs_job_title', $post_id );

			break;
		
		case 'menu_order':
		
		    $order = $post->menu_order;
      		echo $order;
			
			break;
			
		default:
			break;
	}

}


// Sortable custom columns for 'Team'
function qs_sortable_team_columns( $columns ) {

	$columns['job_title'] = 'job_title';
	$columns['menu_order'] = 'menu_order';

	return $columns;

}

add_action('init', 'qs_register_post_type_team');
add_action('manage_edit-team_columns', 'qs_edit_team_columns');
add_action('manage_team_posts_custom_column', 'qs_manage_team_columns', 10, 2);
add_action('manage_edit-team_sortable_columns', 'qs_sortable_team_columns');

/* ---------------------------------------------------------------------- */
/*	Features
/* ---------------------------------------------------------------------- */

// Add team post type
function qs_post_type_features() {

	$labels = array(
		'name'               => __( 'Features', 'qs_framework' ),
		'singular_name'      => __( 'Feature Box', 'qs_framework' ),
		'add_new'            => __( 'Add New', 'qs_framework' ),
		'add_new_item'       => __( 'Add New Feature Box', 'qs_framework' ),
		'edit_item'          => __( 'Edit Feature', 'qs_framework' ),
		'new_item'           => __( 'New Feature', 'qs_framework' ),
		'view_item'          => __( 'View Feature', 'qs_framework' ),
		'search_items'       => __( 'Search Features', 'qs_framework' ),
		'not_found'          => __( 'No features found', 'qs_framework' ),
		'not_found_in_trash' => __( 'No features found in Trash', 'qs_framework' ),
		'parent_item_colon'  => __( 'Parent Member:', 'qs_framework' ),
		'menu_name'          => __( 'Features', 'qs_framework' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'          => array(''),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array( 'slug' => 'feature' ),
		'capability_type'     => 'post',
		'menu_position'       => null,
		'menu_icon'           => QS_BASE_URL . 'library/admin/images/features.png'
	);

	register_post_type( 'features', apply_filters( 'qs_register_post_type_team', $args ) );

} 


// Custom colums for 'Team'
function qs_edit_features() {

	$columns = array(
		'cb'          => '<input type="checkbox" />',
		'title'       => __( 'Name', 'qs_framework' ),
		'thumbnail'   => __( 'Photo', 'qs_framework' ),
		'shortcode'   => __( 'Shortcode', 'qs_framework' ),
	);

	return $columns;

}


// Custom colums content for 'Team'
function qs_manage_features( $column, $post_id ) {

	global $post;

	switch ( $column ) {

		case 'thumbnail':

			echo '<a href="' . get_edit_post_link( $post_id ) . '">' . get_the_post_thumbnail( $post_id, array(50, 50), array( 'title' => get_the_title( $post_id ) ) ) . '</a>';

			break;

		case 'shortcode':
			
			echo '<span class="shortcode-field">[feature id="'. $post->post_name . '"]</span>';

			break;
		
		default:
			break;
	}

}




add_action('init', 'qs_post_type_features');
add_action('manage_edit-features_columns', 'qs_edit_features');
add_action('manage_features_posts_custom_column', 'qs_manage_features', 10, 2);



/* ---------------------------------------------------------------------- */
/*	Flex Slider
/* ---------------------------------------------------------------------- */

// Register Custom Post Type: 'Slider'
function qs_register_post_type_slider() {

	$labels = array(
		'name'               => __( 'Sliders', 'qs_framework' ),
		'singular_name'      => __( 'Slider', 'qs_framework' ),
		'add_new'            => __( 'Add New', 'qs_framework' ),
		'add_new_item'       => __( 'Add New Slider', 'qs_framework' ),
		'edit_item'          => __( 'Edit Slider', 'qs_framework' ),
		'new_item'           => __( 'New Slider', 'qs_framework' ),
		'view_item'          => __( 'View Slider', 'qs_framework' ),
		'search_items'       => __( 'Search Sliders', 'qs_framework' ),
		'not_found'          => __( 'No sliders found', 'qs_framework' ),
		'not_found_in_trash' => __( 'No sliders found in Trash', 'qs_framework' ),
		'parent_item_colon'  => __( 'Parent Slider:', 'qs_framework' ),
		'menu_name'          => __( 'Sliders', 'qs_framework' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array('title'),
		'taxonomies'          => array(''),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array( 'slug' => 'slider' ),
		'capability_type'     => 'post',
		'menu_position'       => null,
		'menu_icon'           => QS_BASE_URL . 'library/admin/images/sliders.png'
	);

	register_post_type( 'slider', apply_filters( 'qs_register_post_type_slider', $args ) );

} 
add_action('init', 'qs_register_post_type_slider');

// Custom colums for 'Slider'
function qs_edit_slider_columns() {

	$columns = array(
		'cb'          => '<input type="checkbox" />',
		'title'       => __( 'Name', 'qs_framework' ),
		'shortcode'   => __( 'Shortcode', 'qs_framework' )
	);

	return $columns;

}
add_action('manage_edit-slider_columns', 'qs_edit_slider_columns');

// Custom colums content for 'Slider'
function qs_manage_slider_columns( $column, $post_id ) {

	global $post;

	switch ( $column ) {

		case 'shortcode':
			
			echo '<span class="shortcode-field">[slider id="'. $post->post_name . '"]</span>';

			break;
		
		default:
			break;
	}

}
add_action('manage_slider_posts_custom_column', 'qs_manage_slider_columns', 10, 2);


// Change default title for 'Slider'
function qs_change_slider_title( $title ){

	$screen = get_current_screen();

	if ( $screen->post_type == 'slider' )
		$title = __('Enter slider name here', 'qs_framework');

	return $title;

}

add_filter('enter_title_here', 'qs_change_slider_title');

?>