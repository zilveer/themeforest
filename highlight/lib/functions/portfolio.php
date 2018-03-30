<?php
/**
 * This file contains all the portfolio functionality.
 *
 * @author Pexeto
 */

/**
 * ADD THE ACTIONS
 */
add_action('init', 'pexeto_register_portfolio_category');  //functions/portfolio.php
add_action('init', 'pexeto_register_portfolio_post_type');  //functions/portfolio.php
add_action('manage_posts_custom_column',  'portfolio_show_columns'); //functions/portfolio.php
add_filter('manage_edit-portfolio_columns', 'portfolio_columns');

/**
 * Registers the portfolio category taxonomy.
 */
function pexeto_register_portfolio_category(){

	register_taxonomy("portfolio_category",
	array(PEXETO_PORTFOLIO_POST_TYPE),
	array(	"hierarchical" => true,
			"label" => "Portfolio Categories", 
			"singular_label" => "Portfolio Categories", 
			"rewrite" => true,
			"query_var" => true
	));
}

/**
 * Registers the portfolio custom type.
 */
function pexeto_register_portfolio_post_type() {

	//the labels that will be used for the portfolio items
	$labels = array(
		    'name' => _x('Portfolio', 'portfolio name'),
		    'singular_name' => _x('Portfolio Item', 'portfolio type singular name'),
		    'add_new' => _x('Add New', 'portfolio'),
		    'add_new_item' => __('Add New Item'),
		    'edit_item' => __('Edit Item'),
		    'new_item' => __('New Portfolio Item'),
		    'view_item' => __('View Item'),
		    'search_items' => __('Search Portfolio Items'),
		    'not_found' =>  __('No portfolio items found'),
		    'not_found_in_trash' => __('No portfolio items found in Trash'), 
		    'parent_item_colon' => ''
		    );

		    //register the custom post type
		    register_post_type( PEXETO_PORTFOLIO_POST_TYPE,
		    array( 'labels' => $labels,
	         'public' => true,  
	         'show_ui' => true,  
	         'capability_type' => 'post',  
	         'hierarchical' => false,  
			 'rewrite' => array('slug'=>'portfolio'),
			 'taxonomies' => array('portfolio_category', 'post_tag'),
	         'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes') ) );


}


/* ------------------------------------------------------------------------*
 * SET THE DEFAULT IMAGE SIZES FOR THE PORTFOLIO ITEMS REGARDING THE
 * NUMBER OF COLUMNS
 * ------------------------------------------------------------------------*/


function portfolio_columns($columns) {
	$columns['category'] = 'Portfolio Category';
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
	}
}


/**
 * Gets a list of custom taxomomies by type
 * @param $type the type of the taxonomy
 */
function pexeto_get_taxonomies($type){
	global $wpdb;

	$res = $wpdb->get_results($wpdb->prepare("SELECT t.term_id, t.name, t.slug FROM $wpdb->terms as t LEFT JOIN $wpdb->term_taxonomy tt ON t.term_id=tt.term_id WHERE tt.taxonomy=%s;", $type));
	return $res;
}

/**
 * Gets a list of custom taxomomies by slug
 * @param $term_id the slug
 */
function pexeto_get_taxonomy_slug($term_id){
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
function pexeto_get_taxonomy_children($type, $parent_id){
	global $wpdb;

	if($parent_id!='-1'){
		$res = $wpdb->get_results($wpdb->prepare("SELECT t.term_id, t.name, t.slug FROM $wpdb->terms as t LEFT JOIN $wpdb->term_taxonomy tt ON t.term_id=tt.term_id WHERE tt.taxonomy=%s AND tt.parent=%s;", $type, $parent_id));
	}else{
		$res = $wpdb->get_results($wpdb->prepare("SELECT t.term_id, t.name, t.slug FROM $wpdb->terms as t LEFT JOIN $wpdb->term_taxonomy tt ON t.term_id=tt.term_id WHERE tt.taxonomy=%s;", $type));
	}
	return $res;
}