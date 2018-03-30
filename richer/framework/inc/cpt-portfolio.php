<?php
/* ----------------------------------------------------- */
/* portfolio Custom Post Type */
/* ----------------------------------------------------- */

/*
 * Function creates post duplicate as a draft and redirects then to the edit post screen
 */
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
 
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * duplicate all post meta
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
 
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="'.__('Duplicate this item','richer-framework').'" rel="permalink">'.__('Duplicate','richer-framework').'</a>';
	}
	return $actions;
}
 
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);
add_filter('portfolio_row_actions', 'rd_duplicate_post_link', 10, 2);
/*---------------------------------------------------------------------------*/

// Adds Custom Post Type
add_action('init', 'portfolio_register'); 

// Adds columns in the admin view for thumbnail and taxonomies
add_filter( 'manage_edit-portfolio_columns', 'portfolio_edit_columns' );
add_action( 'manage_posts_custom_column', 'portfolio_column_display', 10, 2 );

// Allows filtering of posts by taxonomy in the admin view
add_action( 'restrict_manage_posts', 'portfolio_add_taxonomy_filters' ); 

// Add Icons
add_action( 'admin_head', 'portfolio_icon' );

function portfolio_register() {  

	global $options_data;
	$singularName = (isset($options_data['text_portfolio_singular']) && $options_data['text_portfolio_singular'] != '') ? $options_data['text_portfolio_singular'] : 'Portfolio Item';
	$labels = array(
		'name' => __( 'Portfolio', 'richer-framework' ),
		'singular_name' => __( $singularName, 'richer' ),
		'add_new' => __( 'Add New Item', 'richer-framework' ),
		'add_new_item' => __( 'Add New Portfolio Item', 'richer-framework' ),
		'edit_item' => __( 'Edit Portfolio Item', 'richer-framework' ),
		'new_item' => __( 'Add New Portfolio Item', 'richer-framework' ),
		'view_item' => __( 'View Item', 'richer-framework' ),
		'search_items' => __( 'Search Portfolio', 'richer-framework' ),
		'not_found' => __( 'No portfolio items found', 'richer-framework' ),
		'not_found_in_trash' => __( 'No portfolio items found in trash', 'richer-framework' )
	);
	if(!isset($options_data['text_portfolioslug'])) $options_data['text_portfolioslug'] = 'portfolio-item';
    $args = array(  
    	'menu_icon'=>'',
        'labels' => $labels,
        //'singular_label' => __('Project'),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => array('slug' => _x( $options_data['text_portfolioslug'], 'URL slug', 'richer' )), // Permalinks format
        'supports' => array('title', 'editor', 'thumbnail', 'comments')  
       );  
  
    register_post_type( 'portfolio' , $args );  
}  
add_action( 'init', 'add_portfolio_filters', 0 );
function add_portfolio_filters(){
	$labels = array(
		'name'              => __("Filters",'richer-framework'),
		'singular_name'     => __("filter",'richer-framework'),
		'search_items'      => __( 'Search Filters','richer-framework'),
		'all_items'         => __( 'All Filters','richer-framework'),
		'parent_item'       => __( 'Parent Filter','richer-framework' ),
		'parent_item_colon' => __( 'Parent Filter:','richer-framework' ),
		'edit_item'         => __( 'Edit Filter','richer-framework' ),
		'update_item'       => __( 'Update Filter','richer-framework' ),
		'add_new_item'      => __( 'Add New Filter','richer-framework' ),
		'new_item_name'     => __( 'New Filter Name','richer-framework' ),
		'menu_name'         => __( 'Filter','richer-framework' )
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'rewrite'           => true
	);
	register_taxonomy("portfolio_filter", array("portfolio"), $args);
}

/**
 * Add Columns to Portfolio Edit Screen
 */
 
function portfolio_edit_columns( $portfolio_columns ) {
	$portfolio_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('Title', 'richer-framework'),
		"thumbnail" => __('Thumbnail', 'richer-framework'),
		"portfolio_filter" => __('Filter', 'richer-framework'),
		"author" => __('Author', 'richer-framework'),
		"comments" => __('Comments', 'richer-framework'),
		"date" => __('Date', 'richer-framework'),
	);
	$portfolio_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
	return $portfolio_columns;
}

function portfolio_column_display( $portfolio_columns, $post_id ) {

	// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
	
	switch ( $portfolio_columns ) {

		// Display the thumbnail in the column view
		case "thumbnail":
			$width = (int) 35;
			$height = (int) 35;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			
			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset( $thumb ) ) {
				echo $thumb;
			} else {
				echo __('None', 'richer-framework');
			}
			break;		
		// Display the portfolio tags in the column view
		case "portfolio_filter":
		
		if ( $category_list = get_the_term_list( $post_id, 'portfolio_filter', '', ', ', '' ) ) {
			echo $category_list;
		} else {
			echo __('None', 'richer-framework');
		}
		break;			
	}
}

/**
 * Adds taxonomy filters to the portfolio admin page
 * Code artfully lifed from http://pippinsplugins.com
 */
 
function portfolio_add_taxonomy_filters() {
	global $typenow;
	
	// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array( 'portfolio_filter' );
 
	// must set this to the post type you want the filter(s) displayed on
	if ( $typenow == 'portfolio' ) {
 
		foreach ( $taxonomies as $tax_slug ) {
			$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if ( count( $terms ) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>$tax_name</option>";
				foreach ( $terms as $term ) {
					echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
				}
				echo "</select>";
			}
		}
	}
}

/**
 * Displays the custom post type icon in the dashboard
 */
	 
function portfolio_icon() { ?>
	    <style type="text/css" media="screen">
	        #adminmenu .menu-icon-portfolio div.wp-menu-image:before {
			  content: "\f322";
			}
	    </style>
	<?php } 

/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */

?>