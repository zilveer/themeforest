<?php

/*************************************************************************************
 *	Add Portfolio Post Type
 *************************************************************************************/
 
function om_create_portfolio() 
{
	$labels = array(
		'name' => __( 'Portfolio','om_theme'),
		'singular_name' => __( 'Portfolio','om_theme' ),
		'add_new' => __('Add New','om_theme'),
		'add_new_item' => __('Add New Portfolio','om_theme'),
		'edit_item' => __('Edit Portfolio','om_theme'),
		'new_item' => __('New Portfolio','om_theme'),
		'view_item' => __('View Portfolio','om_theme'),
		'search_items' => __('Search Portfolio','om_theme'),
		'not_found' =>  __('No portfolio found','om_theme'),
		'not_found_in_trash' => __('No portfolio found in Trash','om_theme'), 
		'parent_item_colon' => ''
	);
	
	$args=array(
		'labels' => $labels,
		'public' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 20,
		'supports' => array('title','editor','thumbnail','custom-fields','page-attributes','comments')
	);

	$pagination=intval(get_option(OM_THEME_PREFIX . 'portfolio_per_page'));
	if($pagination) {
		$args['rewrite'] = array('slug'=>'portfolio-item');
		$args['has_archive'] = 'true';
	}

	$portfolio_slug=get_option(OM_THEME_PREFIX . 'portfolio_slug');
	$portfolio_slug=sanitize_title_with_dashes($portfolio_slug);
	if( $portfolio_slug ) {
		$args['rewrite']=array('slug'=>$portfolio_slug);
	}

	register_post_type( 'portfolio', $args );
	
	flush_rewrite_rules(false);
}
add_action( 'init', 'om_create_portfolio' );

/*************************************************************************************
 *	Add Portfolio Types
 *************************************************************************************/
 
function om_add_portfolio_taxonomies(){
	$labels = array(
		'name' => __( 'Portfolio Categories', 'om_theme' ),
		'singular_name' => __( 'Portfolio Category', 'om_theme' ),
		'search_items' =>  __( 'Search Portfolio Categories', 'om_theme' ),
		'popular_items' => __( 'Popular Portfolio Categories', 'om_theme' ),
		'all_items' => __( 'All Portfolio Categories', 'om_theme' ),
		'parent_item' => __( 'Parent Portfolio Category', 'om_theme' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'om_theme' ),
		'edit_item' => __( 'Edit Portfolio Category', 'om_theme' ), 
		'update_item' => __( 'Update Portfolio Category', 'om_theme' ),
		'add_new_item' => __( 'Add New Portfolio Category', 'om_theme' ),
		'new_item_name' => __( 'New Portfolio Category Name', 'om_theme' ),
		'separate_items_with_commas' => __( 'Separate portfolio categories with commas', 'om_theme' ),
		'add_or_remove_items' => __( 'Add or remove portfolio categories', 'om_theme' ),
		'choose_from_most_used' => __( 'Choose from the most used portfolio categories', 'om_theme' ),
		'menu_name' => __( 'Portfolio Categories', 'om_theme' )
	);
	
	$args=array (
		'hierarchical' => true, 
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array('slug' => 'portfolio-type', 'hierarchical' => true)
	);
	
	$portfolio_cat_slug=get_option(OM_THEME_PREFIX . 'portfolio_cat_slug');
	$portfolio_cat_slug=sanitize_title_with_dashes($portfolio_cat_slug);
	if( $portfolio_cat_slug ) {
		$args['rewrite']['slug']=$portfolio_cat_slug;
	}
    
	register_taxonomy(
		'portfolio-type', 
		'portfolio', 
		$args
	);
	flush_rewrite_rules(false);
}
add_action( 'init', 'om_add_portfolio_taxonomies' );


/* Applying custom tax posts per page for portfolio */

function om_modify_taxportfolioposts_per_page() {
	add_filter( 'option_posts_per_page', 'om_option_taxportfolioposts_per_page' );
}
add_action( 'init', 'om_modify_taxportfolioposts_per_page' );

function om_option_taxportfolioposts_per_page( $value ) {

	$pagination=intval(get_option(OM_THEME_PREFIX . 'portfolio_per_page'));
	if($pagination && is_tax( 'portfolio-type') ) {
		return $pagination;
	} else {
		return $value;
	}
}

/*************************************************************************************
 *	Portfolio Sort Page
 *************************************************************************************/

function om_print_styles_portfolio_sort() {
	wp_enqueue_style('nav-menu');
}

function om_print_scripts_portfolio_sort() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-sortable');
	
	wp_register_script('om-portfolio-sort', TEMPLATE_DIR_URI.'/admin/js/items-sort.js', array('jquery','jquery-ui-sortable'));
	wp_enqueue_script('om-portfolio-sort');
}

function om_portfolio_sort_page_add() {
	$page = add_submenu_page('edit.php?post_type=portfolio', __('Sort Portfolio','om_theme'), __('Sort Portfolio','om_theme'), 'edit_posts', 'portfolio_sort', 'om_portfolio_sort_page');
	
	add_action('admin_print_styles-' . $page, 'om_print_styles_portfolio_sort');
	add_action('admin_print_scripts-' . $page, 'om_print_scripts_portfolio_sort');
}
add_action('admin_menu', 'om_portfolio_sort_page_add');

function om_portfolio_sort_page() {
	$query = new WP_Query('post_type=portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');
	?>
	<div class="wrap">
		<div id="icon-edit-pages" class="icon32 icon32-posts-page"><br /></div>
		<h2><?php _e('Sort Portfolio', 'om_theme'); ?></h2>
		<p><?php _e('Sort portfolio by drag-n-drop. Items at the top will appear first.', 'om_theme'); ?></p>
	
		<ul id="portfolio_items">
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
			om_items_sort('#portfolio_items','portfolio_apply_sort');
		});
	</script>
	<?php wp_reset_postdata(); ?>
	<?php
}

function om_portfolio_apply_sort() {
	global $wpdb;
	
	$order = explode(',', $_POST['order']);
	$counter = 0;
	
	foreach($order as $portfolio_id) {
		$wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $portfolio_id));
		$counter++;
	}
	exit();
}
add_action('wp_ajax_portfolio_apply_sort', 'om_portfolio_apply_sort');