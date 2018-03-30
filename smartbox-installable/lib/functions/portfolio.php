<?php
/**
 * This file contains all the portfolio functionality.
 *
 */

/**
 * ADD THE ACTIONS
 */
add_action('init', 'designare_register_portfolio_category');  //functions/portfolio.php
add_action('init', 'designare_register_portfolio_post_type');  //functions/portfolio.php
add_action('manage_posts_custom_column',  'portfolio_show_columns'); //functions/portfolio.php
add_filter('manage_edit-portfolio_columns', 'portfolio_columns');

/**
 * Registers the portfolio category taxonomy.
 */
function designare_register_portfolio_category(){

	register_taxonomy("portfolio_category",
	array(DESIGNARE_PORTFOLIO_POST_TYPE),
	array(	"hierarchical" => true,
			"label" => "Categories", 
			"singular_label" => "Categories", 
			"rewrite" => true,
			"query_var" => true
	));
	
	register_taxonomy("portfolio_type",
	array(DESIGNARE_PORTFOLIO_POST_TYPE),
	array(	"hierarchical" => true,
			"label" => "Portfolios", 
			"singular_label" => "Portfolios", 
			"rewrite" => true,
			"query_var" => true
	));
}

/**
 * Registers the portfolio custom type.
 */
function designare_register_portfolio_post_type() {
	$portfolio_permalink = is_string(get_option(DESIGNARE_SHORTNAME."_portfolio_permalink")) && get_option(DESIGNARE_SHORTNAME."_portfolio_permalink") != "" ? get_option(DESIGNARE_SHORTNAME."_portfolio_permalink") : 'portfolio';
	if (!defined('DESIGNARE_PORTFOLIO_POST_TYPE')){
		if (is_string(get_option(DESIGNARE_SHORTNAME."_portfolio_permalink")) && get_option(DESIGNARE_SHORTNAME."_portfolio_permalink") != ""){
			define('DESIGNARE_PORTFOLIO_POST_TYPE',get_option(DESIGNARE_SHORTNAME."_portfolio_permalink"));
		} else {
			define('DESIGNARE_PORTFOLIO_POST_TYPE','portfolio');
		}
	}
	//the labels that will be used for the portfolio items
	$labels = array(
		    'name' => _x('Projects', 'portfolio name','smartbox'),
		    'singular_name' => _x('Project Item', 'portfolio type singular name','smartbox'),
		    'add_new' => __('Add New','smartbox'),
		    'add_new_item' => __('Add New Item','smartbox'),
		    'edit_item' => __('Edit Item','smartbox'),
		    'new_item' => __('New Project Item','smartbox'),
		    'view_item' => __('View Item','smartbox'),
		    'search_items' => __('Search Project Items','smartbox'),
		    'not_found' =>  __('No project items found','smartbox'),
		    'not_found_in_trash' => __('No project items found in Trash','smartbox'), 
		    'parent_item_colon' => ''
		    );

		    //register the custom post type
		    register_post_type( DESIGNARE_PORTFOLIO_POST_TYPE,
		    array( 'labels' => $labels,
	         'public' => true,  
	         'show_ui' => true,  
	         'capability_type' => 'post',
	         'menu_icon' => get_template_directory_uri() . '/img/designare_icons/projectsicon.png',    
	         'hierarchical' => false,  
	         		'rewrite' => array( 'with_front' => 'false', 'slug' => $portfolio_permalink ),
			 		'taxonomies' => array('portfolio_category'),
	         'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes') ) );


}


/* ------------------------------------------------------------------------*
 * SET THE DEFAULT IMAGE SIZES FOR THE PORTFOLIO ITEMS REGARDING THE
 * NUMBER OF COLUMNS
 * ------------------------------------------------------------------------*/


function portfolio_columns($columns) {
	$columns['category'] = 'Category';
	$columns['type'] = 'Portfolio';
	return $columns;
}

/**
 * Add category column to the portfolio items page
 * @param $name
 */
function portfolio_show_columns($name) {
	global $post;
	switch ($name) {
		case 'category':
			$cats = get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' );
			echo $cats;
			break;
		case 'type':
			$cats = get_the_term_list( $post->ID, 'portfolio_type', '', ', ', '' );
			echo $cats;
			break;
	}
}


/**
 * Gets a list of custom taxomomies by type
 * @param $type the type of the taxonomy
 */
function designare_get_taxonomies($type){
	$args = array(
		'type' => 'post',
		'orderby' => 'id',
		'order' => 'ASC',
		'taxonomy' => $type,
		'hide_empty' => 1,
		'pad_counts' => false );
	
	$categories = get_categories( $args );
	
	return $categories;
}

/**
 * Gets a list of custom taxomomies by slug
 * @param $term_id the slug
 */
function designare_get_taxonomy_slug($term_id){
	global $wpdb;

	$res = $wpdb->get_results($wpdb->prepare("SELECT slug FROM $wpdb->terms WHERE term_id=%s LIMIT 1;", $term_id));
	$res=$res[0];
	return $res->slug;
}

/**
 * Gets a list of custom taxomomy's children
 * @param $type the type of the taxonomy
 * @param $parent_id the slug of the parent taxonomy
 */
function designare_get_taxonomy_children($type, $parent_id){
	global $wpdb;

	if($parent_id!='-1'){
		$res = $wpdb->get_results($wpdb->prepare("SELECT t.term_id, t.name, t.slug FROM $wpdb->terms as t LEFT JOIN $wpdb->term_taxonomy tt ON t.term_id=tt.term_id WHERE tt.taxonomy=%s AND tt.parent=%s;", $type, $parent_id));
	}else{
		$res = $wpdb->get_results($wpdb->prepare("SELECT t.term_id, t.name, t.slug FROM $wpdb->terms as t LEFT JOIN $wpdb->term_taxonomy tt ON t.term_id=tt.term_id WHERE tt.taxonomy=%s;", $type));
	}
	return $res;
}


function designare_get_projects(){
	$proj = array();
	$args= array(
	     'posts_per_page' =>-1, 
			 'post_type' => DESIGNARE_PORTFOLIO_POST_TYPE
	);
	query_posts($args);
	
	if(have_posts()) {
		 while (have_posts()) {
		 	the_post();
		 	$proj[] = array("p_title"=>get_the_title(), "p_id"=>get_the_ID());
		 	//$ret .= get_the_title() . "|*|";
		 }
	}
				
	return $proj;
}