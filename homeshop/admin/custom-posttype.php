<?php
/**
 * @package by Theme Record
 * @auther: MattMao
 * @Custom post types
*/

/*
*
Add the Sidebar post type
*
*/
add_action('init', 'theme_create_post_type_sidebar');

function theme_create_post_type_sidebar() 
{
	$labels = array(
		'name' => __( 'Sidebars','homeshop'),
		'singular_name' => __( 'Sidebar','homeshop' ),
		'add_new' => __('Add New','homeshop'),
		'add_new_item' => __('Add New Sidebar','homeshop'),
		'edit_item' => __('Edit Sidebar','homeshop'),
		'new_item' => __('New Sidebar','homeshop'),
		'view_item' => __('View Sidebar','homeshop'),
		'search_items' => __('Search Sidebar','homeshop'),
		'not_found' => __('No sidebar found','homeshop'),
		'not_found_in_trash' => __('No sidebar found in Trash','homeshop'), 
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => false,
		'can_export' => true,
		'rewrite' => false,
		'hierarchical' => false,
		'has_archive' => false,
		'show_in_nav_menus' => false,
		'supports' => array('title', 'excerpt')
	); 
	register_post_type( 'sidebar' , $args );
}


#
#Prod edit columns
#
function prod_edit_columns_sidebar($columns)
{
	$columns = array();
	$columns['cb'] = '<input type=\'checkbox\' />';
	$columns['sidebar_name'] = __('Name', 'homeshop');
	$columns['sidebar_shortcode'] = __('Shortcode', 'homeshop');
	$columns['sidebar_desc'] = __('Description', 'homeshop');
	$columns['sidebar_actions'] = __('Actions', 'homeshop');
	
	return $columns;
}



#
#Prod custom columns
#
function prod_custom_columns_sidebar($column)
{
	global $post;

	$name = get_the_title();
	$shortcode = '[sidebar id="'.$post->ID.'"]';
	$desc = get_the_excerpt();

	switch ($column)
	{
		case 'sidebar_name' :	
			echo '<p>'. $name .'</p>';	
		break;
		
		case 'sidebar_shortcode' :	
			echo '<p><span>'. $shortcode .'</span></p>';	
		break;
		
		case 'sidebar_desc' :	
			echo '<p>'. $desc .'</p>';	
		break;	

		case 'sidebar_actions' :	
			echo '<p><a href="'. admin_url('post.php?post='.$post->ID.'&action=edit'). '">'. __('Edit', 'homeshop'). '</a></p>';			
		break;		
	}
}



#
#Remove meta boxes
#
function theme_sidebar_meta_boxes() {
	remove_meta_box( 'slugdiv', 'sidebar' , 'normal' );
	
}












add_action('init', 'theme_create_post_type_slideshow');
add_filter('manage_edit-slideshow_columns', 'prod_edit_columns_slideshow');
add_action('manage_posts_custom_column',  'prod_custom_columns_slideshow');

function theme_create_post_type_slideshow() 
{
	$labels = array(
		'name' => __( 'Slides', 'homeshop'),
		'singular_name' => __( 'Slides', 'homeshop' ),
		'add_new' => __('Add New', 'homeshop'),
		'add_new_item' => __('Add New Slide', 'homeshop'),
		'edit_item' => __('Edit Slide', 'homeshop'),
		'new_item' => __('New Slide', 'homeshop'),
		'view_item' => __('View Slide', 'homeshop'),
		'search_items' => __('Search Slide', 'homeshop'),
		'not_found' => __('No slides found', 'homeshop'),
		'not_found_in_trash' => __('No slides found in Trash', 'homeshop')
	);

	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => false,
		'can_export' => true,
		'rewrite' => false,
		'hierarchical' => false,
		'has_archive' => false,
		'show_in_nav_menus' => false,
		'capability_type' => 'post',
		'menu_position' => 5, 
		'supports' => array('title', 'page-attributes', 'thumbnail', 'editor')
	); 

	register_post_type( 'slideshow' , $args );
}


function prod_edit_columns_slideshow($columns)
{
	$newcolumns = array(
		'cb' => '<input type=\"checkbox\" />',
		'slideshow_id' => __('ID',  'homeshop'),
		'slideshow_thumbnail' => __('Featured Image',  'homeshop'),
		'title' => __('Title',  'homeshop')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}


function prod_custom_columns_slideshow($column)
{
	
	global $post;

	$id = $post->ID;

	switch ($column)
	{
		case 'slideshow_id':
		echo '<p>'. $id .'</p>';	
		break;	

		case 'slideshow_thumbnail':
		if ( has_post_thumbnail() ) { the_post_thumbnail('archive-thumb'); } else { echo __('No featured image',  'homeshop'); }
		break;	
	}
	
}






////////banners//////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action('init', 'homeshop_create_post_type_banner');
add_filter('manage_edit-banners_columns', 'prod_edit_columns_banners');
add_action('manage_posts_custom_column',  'prod_custom_columns_banners');

function homeshop_create_post_type_banner() 
{
	$labels = array(
		'name' => __( 'Banners', 'homeshop'),
		'singular_name' => __( 'Banners', 'homeshop' ),
		'add_new' => __('Add New', 'homeshop'),
		'add_new_item' => __('Add New Banner', 'homeshop'),
		'edit_item' => __('Edit Banner', 'homeshop'),
		'new_item' => __('New Banner', 'homeshop'),
		'view_item' => __('View Banner', 'homeshop'),
		'search_items' => __('Search Banner', 'homeshop'),
		'not_found' => __('No Banners found', 'homeshop'),
		'not_found_in_trash' => __('No Banners found in Trash', 'homeshop')
	);

	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => false,
		'can_export' => true,
		'rewrite' => false,
		'hierarchical' => false,
		'has_archive' => false,
		'show_in_nav_menus' => false,
		'capability_type' => 'post',
		'menu_position' => 5, 
		'supports' => array('title', 'thumbnail', 'editor'),
	); 

	register_post_type( 'banners' , $args );
}

add_action( 'init', 'create_banners_taxonomies', 0 );
function create_banners_taxonomies() {
	$args = array(
	    'hierarchical' => true,
	    'labels' => array('name'=>'Categories'), 
	    'public' => true,
	    'query_var' => true,
	    'show_ui' => true,
	     'rewrite' => true,
		'show_in_nav_menus' => false
	    );
	register_taxonomy('banners-category', 'banners', $args);
}


function prod_edit_columns_banners($columns)
{
	$newcolumns = array(
		'cb' => '<input type=\"checkbox\" />',
		'banners_id' => __('ID',  'homeshop'),
		'banners_thumbnail' => __('Banner Image',  'homeshop'),
		'title' => __('Title',  'homeshop')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}


function prod_custom_columns_banners($column)
{
	
	global $post;

	$id = $post->ID;

	switch ($column)
	{
		case 'banners_id':
		echo '<p>'. $id .'</p>';	
		break;	

		case 'banners_thumbnail':
		if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail'); } else { echo __('No featured image',  'homeshop'); }
		break;	
	}
	
}



/*
*
Reorder Banners
*
*/

function get_banners_category2($id = null){
	$categories = get_the_terms( $id, 'banners-category' );
	$res = '';
	if(!empty($categories)){
		foreach ( $categories as $val ) {
			$res .= $val->slug;
			$res .= ', ';
		}
	}
	return  $res;
}

function homeshop_banners_print_scripts() {
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('homeshop_banners_reorder', get_template_directory_uri().'/admin/js/banner_reorder.js');
}

function homeshop_banners_reorder_page() {
	$add_submenu = 'add_submenu_page';
	$add_product_reorder = $add_submenu('edit.php?post_type=banners', 'Reorder', __('Reorder Banners',  'homeshop'), 'edit_posts', basename(__FILE__), 'homeshop_banners_reorder');
	add_action('admin_print_scripts-' . $add_product_reorder, 'homeshop_banners_print_scripts');
}

add_action('admin_menu', 'homeshop_banners_reorder_page');

function homeshop_banners_reorder() {
	$args = array( 
		'post_status' => 'publish',
		'post_type' => 'banners',
		'order' => 'ASC',
		'orderby' => 'menu_order',
		'posts_per_page' => -1
	);

	$portfolios = new WP_Query($args);
?>
	<div class="wrap">
		<div id="icon-tools" class="icon32"><br /></div>
		<h2><?php _e('Reorder Banners',  'homeshop'); ?></h2>
		<p class="wp-reorder-message"><?php _e('Drag the banner to reorder.',  'homeshop'); ?></p>
		<ul id="portfolio-reorder-lists" class="wp-reorder-lists clearfix">
		<?php while( $portfolios->have_posts() ) : $portfolios->the_post(); ?>
		<?php if( get_post_status() == 'publish' ) { 
		$category1 = get_banners_category2($post->ID);
		
		?>
			<li id="<?php the_id(); ?>" class="menu-item" style="overflow:hidden; color:#ccc; float:left;  cursor: move; width:150px; height:220px; text-align:center; margin:0 10px 10px 0; background:#1E1E1F; border:1px solid #ccc;">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail'); } else { echo __('No image',  'homeshop'); } ?>
				<h4 class="menu-item-title" style="margin:0; " ><?php the_title(); ?></h4>
				<div class="blog-data" style="font-size:12px;line-height:12px; margin:0; color:#ccc;">
					<?php the_time('d'); ?> <span style="color:#fafafa;"><?php  the_time('M'); ?></span>
				</div>
				<p class="blog-info" style="margin:0; font-size:10px; font-style:italic;">
					<?php 
						$cur_terms = get_the_terms($post->ID, 'banners-category' );
					foreach($cur_terms as $cur_term) {
						echo ''. $cur_term->name .' ';
					} ?>
				</p>
				
				<ul class="menu-item-transport"></ul>
			</li>
		<?php } ?>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
		</ul>
	</div>
<?php
}





function homeshop_save_banners_order() {
    global $wpdb;
    $order = explode(',', $_POST['order']);
    $counter = 0;
    
    foreach($order as $portfolio_id) {
        $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $portfolio_id));
        $counter++;
    }
    die(1);
}

add_action('wp_ajax_portfolio_reorder', 'homeshop_save_banners_order');

























?>