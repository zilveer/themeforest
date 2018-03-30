<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/theme-custom-post-type.php
 * @file	 	1.0
 *
 *	1. Portfolio
 *	1.1	Fields Taxonomy
 *	1.2 Custom columns
 *  1.3 Sort portfolio projects
 *
 */
?>
<?php 
 
/**
 * ------------------------------------------------------------------------
 * 1.	Portfolio
 * ------------------------------------------------------------------------
 */ 
 	if ( ! function_exists( 'portfolio_init' ) ) :
		add_action('init','portfolio_init');
		function portfolio_init()  {  
			$labels = array(  
				'name' => _x('Portfolios', 'post type general name','prostore-theme'),  
				'singular_name' => _x('Portfolio', 'post type singular name','prostore-theme'),  
				'add_new' => _x('Add New', 'portfolio','prostore-theme'),  
				'add_new_item' => __('Add New Portfolio', 'prostore-theme'),  
				'edit_item' => __('Edit Portfolio', 'prostore-theme' ),  
				'new_item' => __('New Portfolio', 'prostore-theme' ),  
				'view_item' => __('View Portfolio', 'prostore-theme' ),  
				'search_items' => __('Search Portfolios', 'prostore-theme' ),  
				'not_found' =>  __('No portfolios found', 'prostore-theme' ),  
				'not_found_in_trash' => __('No portfolios found in Trash', 'prostore-theme' ),  
				'parent_item_colon' => '',  
				'menu_name' => 'Portfolios'  
					  );  
			$args = array(  
				'labels' => $labels,  
				'public' => true,  
				'publicly_queryable' => true,  
				'show_ui' => true,  
				'show_in_menu' => true,  
				'query_var' => true,  
				'exclude_from_search' => false,
				'rewrite' => array( 'slug' => 'portfolio','with_front' => FALSE),
				'capability_type' => 'post',  
				'hierarchical' => false, 
				'menu_position' => 10,  
				'supports' => array('title','editor','thumbnail','comments')  
						);  
		 
		 
			register_post_type('portfolio',$args);  
			flush_rewrite_rules();
		} 
	endif;

	if ( ! function_exists( 'portfolio_updated_messages' ) ) :
		add_filter('post_updated_messages', 'portfolio_updated_messages');  
		function portfolio_updated_messages( $messages ) {  
			global $post, $post_ID;  
		  
			$messages['portfolio'] = array(  
				0 => '', // Unused. Messages start at index 1.  
				1 => sprintf( __('Portfolio updated. <a href="%s">View portfolio</a>','prostore-theme'), esc_url( get_permalink($post_ID) ) ),  
				2 => __('Custom field updated.', 'prostore-theme' ),  
				3 => __('Custom field deleted.', 'prostore-theme' ),  
				4 => __('Portfolio updated.', 'prostore-theme' ),  
				/* translators: %s: date and time of the revision */  
				5 => isset($_GET['revision']) ? sprintf( __('Portfolio restored to revision from %s','prostore-theme'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,  
				6 => sprintf( __('Portfolio published. <a href="%s">View portfolio</a>','prostore-theme'), esc_url( get_permalink($post_ID) ) ),  
				7 => __('Portfolio saved.','prostore-theme'),  
				8 => sprintf( __('Portfolio submitted. <a target="_blank" href="%s">Preview portfolio</a>','prostore-theme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),  
				9 => sprintf( __('Portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview portfolio</a>','prostore-theme'),  
				  // translators: Publish box date format, see http://php.net/date  
				  date_i18n( __( 'M j, Y @ G:i' ,'prostore-theme'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),  
				10 => sprintf( __('Portfolio draft updated. <a target="_blank" href="%s">Preview portfolio</a>','prostore-theme'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),  
					);  
		  
			return $messages;  
		}  
	endif;

    /*--------------------------------
    //  1.1	Fields Taxonomy
    ----------------------------------*/
	$labels = array(  
			'name' => _x( 'Fields', 'taxonomy general name','prostore-theme' ),  
			'singular_name' => _x( 'Field', 'taxonomy singular name','prostore-theme' ),  
			'search_items' =>  __( 'Search Fields', 'prostore-theme'  ),  
			'all_items' => __( 'All Fields', 'prostore-theme'  ),  
			'parent_item' => __( 'Parent Field', 'prostore-theme'  ),  
			'parent_item_colon' => __( 'Parent Fields:', 'prostore-theme'  ),  
			'edit_item' => __( 'Edit Fields', 'prostore-theme'  ),  
			'update_item' => __( 'Update Field', 'prostore-theme' ),  
			'add_new_item' => __( 'Add New Field', 'prostore-theme'  ),  
			'new_item_name' => __( 'New Field Name', 'prostore-theme'  ),  
	  			);  
	register_taxonomy('field',array('portfolio','client'), array(  
			'hierarchical' => false,  
			'labels' => $labels,  
			'public' => true,  
			'publicly_queryable' => true,  
			'show_ui' => true,  
			'query_var' => true,  
			'has_archive' => true,
			'rewrite' => array( 'slug' => 'field','with_front' => true ),  
	  ));  
	  flush_rewrite_rules();
	
    /*--------------------------------
    //  1.2 Custom columns
    ----------------------------------*/
	add_action("manage_posts_custom_column", "custom_portfolio_columns");
	add_filter("manage_edit-portfolio_columns", "portfolio_columns", 10, 1);

	function portfolio_columns($columns) {
		$columns = array(
			"cb" => "<input type='checkbox' />",
			'thumbnail' => 'Thumbnail',
			"title" => "Title",
			"field" => "Fields"
		);
		return $columns;
	}
	
	function custom_portfolio_columns($column)
	{
		global $post;
		if ("thumbnail"==$column) echo get_the_post_thumbnail( $post->ID, 'edit-screen-thumbnail' );
		elseif ("field" == $column) echo get_the_term_list($post->ID,'field','',', ');
	}
	
    /*--------------------------------
    //  1.3 Sort portfolio projects
    ----------------------------------*/
	function sorter_admin_scripts() {
		
		if ('edit.php' == basename($_SERVER['PHP_SELF'])) {
			$file_dir=get_template_directory_uri();
			wp_enqueue_style("styles", $file_dir ."/library/admin/assets/css/post-sorter.css", false, "1.0", "all");
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script("post-sorter", $file_dir."/library/admin/assets/js/post-sorter.js", array( 'jquery' ), "1.0");
			wp_enqueue_script("phtojkks", $file_dir."/library/admin/assets/js/jquery.tools.min.js", array( 'jquery' ), "1.0");
		}
		
	}
	add_action('admin_enqueue_scripts', 'sorter_admin_scripts');
	
	/* ************************************
	* Sort it for the Display List too
	*************************************** */
	add_filter( 'posts_orderby', 'theme_port_orderby');
	function theme_port_orderby($orderby){
	global $wpdb;
	
	if (is_admin())
	$orderby = "{$wpdb->posts}.menu_order, {$wpdb->posts}.post_date DESC";
	
	return($orderby);
	}
	
	
	
	/* ************************************
	* Ajax Sort for Portfolio
	*************************************** */
	
	function enable_portfolio_sort() {
	    add_submenu_page('edit.php?post_type=portfolio', 'Sort Portfolio', 'Sort Portfolio Projects', 'edit_posts', basename(__FILE__), 'sort_portfolio');
	}
	add_action('admin_menu' , 'enable_portfolio_sort');
	
	 
	/**
	 * Display Sort admin
	 *
	 * @return void
	 * @author Soul
	 **/
	function sort_portfolio() {
		$portfolio = new WP_Query('post_type=portfolio&posts_per_page=-1&orderby=menu_order&order=ASC');
	?>
		<div class="wrap">
		<h2>Sort portfolio projects<img src="<?php echo home_url(); ?>/wp-admin/images/loading.gif" id="loading-animation" /></h2>
		<div class="description">
		Drag and Drop the projects to order them
		</div>
		<ul id="portfolio-list">
		<?php while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>
			<li id="<?php the_id(); ?>">
			<div>
			<?php 
			$image_url=wp_get_attachment_thumb_url( get_post_thumbnail_id() );
			$custom = get_post_custom(get_the_ID());
			$portfolio_cats = get_the_terms( get_the_ID(), 'field' );
			
			?>
			<?php if ($image_url) { echo '<img class="theme_port_admin_sort_image" src="'.$image_url.'" width="30px" height="30px" alt="" />'; } ?>
			</div>
			<div class="theme_port_desc">
			<span class="theme_port_admin_sort_title"><?php the_title(); ?></span>
			<span class="theme_port_admin_sort_categories"><?php if($portfolio_cats) { foreach ($portfolio_cats as $taxonomy) { echo $taxonomy->name .',  '; } } ?></span>
			</div>
			<div class="clear"></div>
			</li>
		<?php endwhile; ?>
		</div><!-- End div#wrap //-->
	 
	<?php
	}
	
	/**
	 * Upadate the portfolio Sort order
	 *
	 * @return void
	 * @author Soul
	 **/
	function save_portfolio_order() {
		global $wpdb; // WordPress database class
	 
		$order = explode(',', $_POST['order']);
		$counter = 0;
	 
		foreach ($order as $sort_id) {
			$wpdb->update($wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $sort_id) );
			$counter++;
		}
		die(1);
	}
	add_action('wp_ajax_portfolio_sort', 'save_portfolio_order');