<?php

/*************************************************************************************
 *	Add Homepage Post Type
 *************************************************************************************/
 
function om_create_homepage() 
{
	$labels = array(
		'name' => __( 'Homepage','om_theme'),
		'singular_name' => __( 'Homepage','om_theme' ),
		'all_items' => __( 'Homepage Blocks','om_theme' ),
		'add_new' => __('Add New Block','om_theme'),
		'add_new_item' => __('Add New Block','om_theme'),
		'edit_item' => __('Edit Block','om_theme'),
		'new_item' => __('New Block','om_theme'),
		'view_item' => __('View Block','om_theme'),
		'search_items' => __('Search Homepage Block','om_theme'),
		'not_found' =>  __('No homepage block found','om_theme'),
		'not_found_in_trash' => __('No homepage block found in Trash','om_theme'), 
		'parent_item_colon' => ''
	);
	  
	register_post_type( 'homepage', array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => false,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => 20,
		'supports' => array('title','editor','page-attributes')
	));
	
	flush_rewrite_rules(false);
}
add_action( 'init', 'om_create_homepage' );


/*************************************************************************************
 *	Homepage Sort Page
 *************************************************************************************/

function om_print_styles_homepage_sort() {
	wp_enqueue_style('nav-menu');
}

function om_print_scripts_homepage_sort() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-sortable');
	
	wp_register_script('om-homepage-sort', TEMPLATE_DIR_URI.'/admin/js/items-sort.js', array('jquery','jquery-ui-sortable'));
	wp_enqueue_script('om-homepage-sort');
}

function om_homepage_sort_page_add() {
	$page = add_submenu_page('edit.php?post_type=homepage', __('Sort Blocks','om_theme'), __('Sort Blocks','om_theme'), 'edit_posts', 'homepage_sort', 'om_homepage_sort_page');
	
	add_action('admin_print_styles-' . $page, 'om_print_styles_homepage_sort');
	add_action('admin_print_scripts-' . $page, 'om_print_scripts_homepage_sort');
}
add_action('admin_menu', 'om_homepage_sort_page_add');

function om_homepage_sort_page() {
	$query = new WP_Query('post_type=homepage&posts_per_page=-1&orderby=menu_order&order=ASC');
	?>
	<div class="wrap">
		<div id="icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>
		<h2><?php _e('Sort Homepage Blocks', 'om_theme'); ?></h2>
		<p><?php _e('Sort blcks by drag-n-drop. Items at the top will appear first.', 'om_theme'); ?></p>
	
		<ul id="homepage_items">
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
			om_items_sort('#homepage_items','homepage_apply_sort');
		});
	</script>
	<?php wp_reset_postdata(); ?>
	<?php
}

function om_homepage_apply_sort() {
	global $wpdb;
	
	$order = explode(',', $_POST['order']);
	$counter = 0;
	
	foreach($order as $homepage_id) {
		$wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $homepage_id));
		$counter++;
	}
	exit();
}
add_action('wp_ajax_homepage_apply_sort', 'om_homepage_apply_sort');