<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*-----------------------------------------------------------------------------------*/
/* Featured Slider: Post Type */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'woo_featured_slider_post_type' ) ) {
function woo_featured_slider_post_type () {
	$labels = array(
		'name' => __( 'Slides', 'woothemes' ),
		'singular_name' => __( 'Slide', 'woothemes' ),
		'add_new' => __( 'Add New', 'woothemes' ),
		'add_new_item' => __( 'Add New Slide', 'woothemes' ),
		'edit_item' => __( 'Edit Slide', 'woothemes' ),
		'new_item' => __( 'New Slide', 'woothemes' ),
		'view_item' => __( 'View Slide', 'woothemes' ),
		'search_items' => __( 'Search Slides', 'woothemes' ),
		'not_found' =>  __( 'No slides found', 'woothemes' ),
		'not_found_in_trash' => __( 'No slides found in Trash', 'woothemes' ),
		'parent_item_colon' => __( 'Parent slide:', 'woothemes' )
	);
	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'taxonomies' => array( 'slide-page' ),
		'menu_icon' => esc_url( get_template_directory_uri() . '/includes/assets/images/slides.png' ),
		'menu_position' => 5,
		'supports' => array('title','editor','thumbnail', /*'author','thumbnail','excerpt','comments'*/)
	);

	register_post_type( 'slide', $args );

	// "Slide Pages" Custom Taxonomy
	$labels = array(
		'name' => _x( 'Slide Groups', 'taxonomy general name', 'woothemes' ),
		'singular_name' => _x( 'Slide Groups', 'taxonomy singular name', 'woothemes' ),
		'search_items' =>  __( 'Search Slide Groups', 'woothemes' ),
		'all_items' => __( 'All Slide Groups', 'woothemes' ),
		'parent_item' => __( 'Parent Slide Group', 'woothemes' ),
		'parent_item_colon' => __( 'Parent Slide Group:', 'woothemes' ),
		'edit_item' => __( 'Edit Slide Group', 'woothemes' ),
		'update_item' => __( 'Update Slide Group', 'woothemes' ),
		'add_new_item' => __( 'Add New Slide Group', 'woothemes' ),
		'new_item_name' => __( 'New Slide Group Name', 'woothemes' ),
		'menu_name' => __( 'Slide Groups', 'woothemes' )
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'slide-page' )
	);

	register_taxonomy( 'slide-page', array( 'slide' ), $args );
} // End woo_featured_slider_post_type()
}

add_action( 'init', 'woo_featured_slider_post_type' );

/*-----------------------------------------------------------------------------------*/
// Custome Recipe Post Type
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'woo_fnc_create_recipe' );

function woo_fnc_create_recipe() {
	  
	  $labels = array(
			'name' => __('Recipes', 'woothemes'),
			'singular_name' => __('Recipe', 'woothemes'),
			'add_new' => __('Add New', 'woothemes'),
			'add_new_item' => __('Recipe', 'woothemes'),
			'edit_item' => __('Edit Recipe', 'woothemes'),
			'new_item' => __('New Recipe', 'woothemes'),
			'view_item' => __('View Recipe', 'woothemes'),
			'search_items' => __('Search Recipes', 'woothemes'),
			'not_found' =>  __('No Recipes found', 'woothemes'),
			'not_found_in_trash' => __('No Recipes found in Trash', 'woothemes'),
			'parent_item_colon' => ''
	  );

	  $supports = array(
				 'title',
				 'editor',
				 'thumbnail',
				 'categories',
				 'comments',
				 'excerpt',
				 'author'
				 );
	  
	  register_post_type( 'recipe',
			array(
				  'labels' => $labels,
				  'public' => true,
				  'menu_position' => 6,
				  'menu_icon' => esc_url( get_template_directory_uri() . '/includes/assets/images/recipes.png' ),
				  'hierarchical' => false,
				  'supports' => $supports,
				  'taxonomies' => array('recipe-type'),
				  'rewrite' => array( 'slug' => __('recipe-items', 'woothemes') )
			)
	  );
	
}
	
	
// Custom Texonomy Recipe Types for Recipe
add_action( 'init', 'woo_fnc_build_taxonomies', 0 );  

function woo_fnc_build_taxonomies() {
		
	// Recipe Type Custom Taxonomy
	$recipe_type_labels = array(
			    'name' => __('Recipe Types', 'woothemes'),
			    'singular_name' => __('Recipe Type', 'woothemes'),
			    'search_items' => __('Search Recipe Types', 'woothemes'),
			    'all_items' => __('All Recipe Types', 'woothemes'),
			    'parent_item' => __('Parent Recipe Type', 'woothemes'),
			    'parent_item_colon' =>__('Parent Recipe Type:', 'woothemes'),
			    'edit_item' => __('Edit Recipe Type', 'woothemes'), 
			    'update_item' => __('Update Recipe Type', 'woothemes'),
			    'add_new_item' => __('Add New Recipe Type', 'woothemes'),
			    'new_item_name' => __('Recipe Type Name', 'woothemes'),
			    'menu_name' => __('Recipe Types', 'woothemes')
			  ); 

	
	register_taxonomy(
	    'recipe_type',
	    'recipe',
	    array(
			  'hierarchical' => true,
			  'labels' => $recipe_type_labels,
			  'query_var' => true,
			  'rewrite' => array( 'slug' => __('recipe-type', 'woothemes') )
	    )
  	);
	
	// Cuisine Custom Taxonomy
	$cuisines_labels = array(
			    'name' => __('Cuisines', 'woothemes'),
			    'singular_name' => __('Cuisine', 'woothemes'),
			    'search_items' => __('Search Cuisines', 'woothemes'),
			    'all_items' => __('All Cuisines', 'woothemes'),
			    'parent_item' => __('Parent Cuisine', 'woothemes'),
			    'parent_item_colon' =>__('Parent Cuisine:', 'woothemes'),
			    'edit_item' => __('Edit Cuisine', 'woothemes'), 
			    'update_item' => __('Update Cuisine', 'woothemes'),
			    'add_new_item' => __('Add New Cuisine', 'woothemes'),
			    'new_item_name' => __('Cuisine Name', 'woothemes'),
			    'menu_name' => __('Cuisines', 'woothemes')
			  ); 
			  
	register_taxonomy(
	    'cuisine',
	    'recipe',
	    array(
			  'hierarchical' => true,
			  'labels' => $cuisines_labels,
			  'query_var' => true,
			  'rewrite' => array( 'slug' => __('cuisine', 'woothemes') )
	    )
  	);
	
	// Courses Custom Taxonomy
	$courses_labels = array(
			    'name' => __('Courses', 'woothemes'),
			    'singular_name' => __('Course', 'woothemes'),
			    'search_items' => __('Search Courses', 'woothemes'),
			    'all_items' => __('All Courses', 'woothemes'),
			    'parent_item' => __('Parent Course', 'woothemes'),
			    'parent_item_colon' =>__('Parent Course:', 'woothemes'),
			    'edit_item' => __('Edit Course', 'woothemes'), 
			    'update_item' => __('Update Course', 'woothemes'),
			    'add_new_item' => __('Add New Course', 'woothemes'),
			    'new_item_name' => __('Course Name', 'woothemes'),
			    'menu_name' => __('Courses', 'woothemes')
			  ); 
			  
	register_taxonomy(
	    'course',
	    'recipe',
	    array(
			  'hierarchical' => true,
			  'labels' => $courses_labels,
			  'query_var' => true,
			  'rewrite' => array( 'slug' => __('course', 'woothemes') )
	    )
  	);
	
	// Ingredients Custom Taxonomy
	$ingredients_labels = array(
			    'name' => __('Ingredients', 'woothemes'),
			    'singular_name' => __('Ingredient', 'woothemes'),
			    'search_items' => __('Search Ingredients', 'woothemes'),
			    'all_items' => __('All Ingredients', 'woothemes'),
			    'parent_item' => __('Parent Ingredient', 'woothemes'),
			    'parent_item_colon' =>__('Parent Ingredient:', 'woothemes'),
			    'edit_item' => __('Edit Ingredient', 'woothemes'), 
			    'update_item' => __('Update Ingredient', 'woothemes'),
			    'add_new_item' => __('Add New Ingredient', 'woothemes'),
			    'new_item_name' => __('Ingredient Name', 'woothemes'),
			    'menu_name' => __('Ingredients', 'woothemes')
			  ); 
			  
	register_taxonomy(
	    'ingredient',
	    'recipe',
	    array(
			  'hierarchical' => true,
			  'labels' => $ingredients_labels,
			  'query_var' => true,
			  'rewrite' => array( 'slug' => __('ingredient', 'woothemes') )
	    )
  	);
	
	// Skill Level
	$skill_levels_labels = array(
			    'name' => __('Skill Levels', 'woothemes'),
			    'singular_name' => __('Skill Level', 'woothemes'),
			    'search_items' => __('Search Skill Levels', 'woothemes'),
			    'all_items' => __('All Skill Levels', 'woothemes'),
			    'parent_item' => __('Parent Skill Level', 'woothemes'),
			    'parent_item_colon' =>__('Parent Skill Level:', 'woothemes'),
			    'edit_item' => __('Edit Skill Level', 'woothemes'), 
			    'update_item' => __('Update Skill Level', 'woothemes'),
			    'add_new_item' => __('Add New Skill Level', 'woothemes'),
			    'new_item_name' => __('Skill Level Name', 'woothemes'),
			    'menu_name' => __('Skill Levels', 'woothemes')
			  ); 
			  
	register_taxonomy(
	    'skill_level',
	    'recipe',
	    array(
			  'hierarchical' => true,
			  'labels' => $skill_levels_labels,
			  'query_var' => true,
			  'rewrite' => array( 'slug' => __('skill-level', 'woothemes') )
	    )
  	);
	
	// calories
	$skill_levels_labels = array(
			    'name' => __('Calories', 'woothemes'),
			    'singular_name' => __('Calorie', 'woothemes'),
			    'search_items' => __('Search Calories', 'woothemes'),
			    'all_items' => __('All Calories', 'woothemes'),
			    'parent_item' => __('Parent Calories', 'woothemes'),
			    'parent_item_colon' =>__('Parent Calories:', 'woothemes'),
			    'edit_item' => __('Edit Calories', 'woothemes'), 
			    'update_item' => __('Update Calories', 'woothemes'),
			    'add_new_item' => __('Add New Calories', 'woothemes'),
			    'new_item_name' => __('Calories Name', 'woothemes'),
			    'menu_name' => __('Calories', 'woothemes')
			  ); 
			  
	register_taxonomy(
	    'calories',
	    'recipe',
	    array(
			  'hierarchical' => true,
			  'labels' => $skill_levels_labels,
			  'query_var' => true,
			  'rewrite' => array( 'slug' => __('Calories', 'woothemes') )
	    )
  	);
		
}
