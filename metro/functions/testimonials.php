<?php

/*************************************************************************************
 *	Add Testimonials Post Type
 *************************************************************************************/
 
function om_create_testimonials() 
{
	$labels = array(
		'name' => __( 'Testimonials','om_theme'),
		'singular_name' => __( 'Testimonial','om_theme' ),
		'add_new' => __('Add New','om_theme'),
		'add_new_item' => __('Add New Testimonial','om_theme'),
		'edit_item' => __('Edit Testimonial','om_theme'),
		'new_item' => __('New Testimonial','om_theme'),
		'view_item' => __('View Testimonial','om_theme'),
		'search_items' => __('Search Testimonials','om_theme'),
		'not_found' =>  __('No testimonials found','om_theme'),
		'not_found_in_trash' => __('No testimonials found in Trash','om_theme'), 
		'parent_item_colon' => ''
	);
	  
	register_post_type( 'testimonials', array(
		'labels' => $labels,
		'public' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('title','editor','thumbnail','custom-fields','page-attributes')
	));
	
	flush_rewrite_rules(false);
}
add_action( 'init', 'om_create_testimonials' );

/*************************************************************************************
 *	Add Testimonials Types
 *************************************************************************************/
 
function om_add_testimonials_taxonomies(){
	$labels = array(
		'name' => __( 'Testimonials Categories', 'om_theme' ),
		'singular_name' => __( 'Testimonials Category', 'om_theme' ),
		'search_items' =>  __( 'Search Testimonials Categories', 'om_theme' ),
		'popular_items' => __( 'Popular Testimonials Categories', 'om_theme' ),
		'all_items' => __( 'All Testimonials Categories', 'om_theme' ),
		'parent_item' => __( 'Parent Testimonials Category', 'om_theme' ),
		'parent_item_colon' => __( 'Parent Testimonials Category:', 'om_theme' ),
		'edit_item' => __( 'Edit Testimonials Category', 'om_theme' ), 
		'update_item' => __( 'Update Testimonials Category', 'om_theme' ),
		'add_new_item' => __( 'Add New Testimonials Category', 'om_theme' ),
		'new_item_name' => __( 'New Testimonials Category Name', 'om_theme' ),
		'separate_items_with_commas' => __( 'Separate testimonials categories with commas', 'om_theme' ),
		'add_or_remove_items' => __( 'Add or remove testimonials categories', 'om_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used testimonials categories', 'om_theme' ),
		'menu_name' => __( 'Testimonials Categories', 'om_theme' )
	);
	
	$args=array (
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array('slug' => 'testimonials-type', 'hierarchical' => true)
	);
	
	register_taxonomy(
		'testimonials-type', 
		'testimonials', 
		$args
	);
	flush_rewrite_rules(false);
}
add_action( 'init', 'om_add_testimonials_taxonomies' );

/*************************************************************************************
 *	Testimonials Sort Page
 *************************************************************************************/

function om_print_styles_testimonials_sort() {
	wp_enqueue_style('nav-menu');
}

function om_print_scripts_testimonials_sort() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-sortable');
	
	wp_register_script('om-testimonials-sort', TEMPLATE_DIR_URI.'/admin/js/items-sort.js', array('jquery','jquery-ui-sortable'));
	wp_enqueue_script('om-testimonials-sort');
}

function om_testimonials_sort_page_add() {
	$page = add_submenu_page('edit.php?post_type=testimonials', __('Sort Testimonials','om_theme'), __('Sort Testimonials','om_theme'), 'edit_posts', 'testimonials_sort', 'om_testimonials_sort_page');
	
	add_action('admin_print_styles-' . $page, 'om_print_styles_testimonials_sort');
	add_action('admin_print_scripts-' . $page, 'om_print_scripts_testimonials_sort');
}
add_action('admin_menu', 'om_testimonials_sort_page_add');

function om_testimonials_sort_page() {
	$query = new WP_Query('post_type=testimonials&posts_per_page=-1&orderby=menu_order&order=ASC');
	?>
	<div class="wrap">
		<div id="icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>
		<h2><?php _e('Sort Testimonials', 'om_theme'); ?></h2>
		<p><?php _e('Sort Testimonials by drag-n-drop. Items at the top will appear first.', 'om_theme'); ?></p>
	
		<ul id="testimonials_items">
			<?php while( $query->have_posts() ) : $query->the_post(); ?>
				<?php if( get_post_status() == 'publish' ) { ?>
					<li id="<?php the_id(); ?>" class="menu-item">
						<dl class="menu-item-bar">
							<dt class="menu-item-handle">
								<span class="menu-item-title"><?php the_title(); ?></span>
							</dt>
						</dl>
						<ul class="menu-item-transport"></ul>
					</li>
				<?php } ?>
			<?php endwhile; ?>
		</ul>
	</div>
	<script>
		jQuery(document).ready(function($) {
			om_items_sort('#testimonials_items','testimonials_apply_sort');
		});
	</script>
	<?php wp_reset_postdata(); ?>
	<?php
}

function om_testimonials_apply_sort() {
	global $wpdb;
	
	$order = explode(',', $_POST['order']);
	$counter = 0;
	
	foreach($order as $id) {
		$wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $id));
		$counter++;
	}
	exit();
}
add_action('wp_ajax_testimonials_apply_sort', 'om_testimonials_apply_sort');