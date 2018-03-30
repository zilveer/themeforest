<?php 
if ( ! class_exists( 'Portfolio_Post_Type' ) ) :

class Portfolio_Post_Type {

	// Current plugin version
	var $version = 0.4;

	function __construct() {

		// Adds the portfolio post type and taxonomies
		add_action( 'init', array( &$this, 'portfolio_init' ) );

		// Thumbnail support for portfolio posts
		add_theme_support( 'post-thumbnails', array( 'portfolio' ) );

		// Adds columns in the admin view for thumbnail and taxonomies
		add_filter( 'manage_edit-portfolio_columns', array( &$this, 'portfolio_edit_columns' ) );
		add_action( 'manage_posts_custom_column', array( &$this, 'portfolio_column_display' ), 10, 2 );

		// Allows filtering of posts by taxonomy in the admin view
		add_action( 'restrict_manage_posts', array( &$this, 'portfolio_add_taxonomy_filters' ) );

		// Show portfolio post counts in the dashboard
		add_action( 'right_now_content_table_end', array( &$this, 'add_portfolio_counts' ) );
	}

	/**
	 * Flushes rewrite rules on plugin activation to ensure portfolio posts don't 404
	 * http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
	 */

	function plugin_activation() {
		$this->portfolio_init();
		flush_rewrite_rules();
	}

	function portfolio_init() {

		/**
		 * Enable the Portfolio custom post type
		 * http://codex.wordpress.org/Function_Reference/register_post_type
		 */

		$labels = array(
			'name' => __( 'Portfolio', 'okthemes' ),
			'singular_name' => __( 'Portfolio Item', 'okthemes' ),
			'add_new' => __( 'Add New Item', 'okthemes' ),
			'add_new_item' => __( 'Add New Portfolio Item', 'okthemes' ),
			'edit_item' => __( 'Edit Portfolio Item', 'okthemes' ),
			'new_item' => __( 'Add New Portfolio Item', 'okthemes' ),
			'view_item' => __( 'View Item', 'okthemes' ),
			'search_items' => __( 'Search Portfolio', 'okthemes' ),
			'not_found' => __( 'No portfolio items found', 'okthemes' ),
			'not_found_in_trash' => __( 'No portfolio items found in trash', 'okthemes' )
		);

		$args = array(
	    	'labels' => $labels,
	    	'public' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "portfolio"), // Permalinks format
			'menu_position' => 5,
			'has_archive' => true
		); 

		register_post_type( 'portfolio', $args );

		/**
		 * Register a taxonomy for Portfolio Tags
		 * http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */

		$taxonomy_portfolio_tag_labels = array(
			'name' => __( 'Portfolio Tags', 'okthemes' ),
			'singular_name' => __( 'Portfolio Tag', 'okthemes' ),
			'search_items' => __( 'Search Portfolio Tags', 'okthemes' ),
			'popular_items' => __( 'Popular Portfolio Tags', 'okthemes' ),
			'all_items' => __( 'All Portfolio Tags', 'okthemes' ),
			'parent_item' => __( 'Parent Portfolio Tag', 'okthemes' ),
			'parent_item_colon' => __( 'Parent Portfolio Tag:', 'okthemes' ),
			'edit_item' => __( 'Edit Portfolio Tag', 'okthemes' ),
			'update_item' => __( 'Update Portfolio Tag', 'okthemes' ),
			'add_new_item' => __( 'Add New Portfolio Tag', 'okthemes' ),
			'new_item_name' => __( 'New Portfolio Tag Name', 'okthemes' ),
			'separate_items_with_commas' => __( 'Separate portfolio tags with commas', 'okthemes' ),
			'add_or_remove_items' => __( 'Add or remove portfolio tags', 'okthemes' ),
			'choose_from_most_used' => __( 'Choose from the most used portfolio tags', 'okthemes' ),
			'menu_name' => __( 'Portfolio Tags', 'okthemes' )
		);

		$taxonomy_portfolio_tag_args = array(
			'labels' => $taxonomy_portfolio_tag_labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'portfolio_tag' ),
			'query_var' => true
		);

		register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $taxonomy_portfolio_tag_args );

		/**
		 * Register a taxonomy for Portfolio Categories
		 * http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */

	    $taxonomy_portfolio_category_labels = array(
			'name' => __( 'Portfolio Categories', 'okthemes' ),
			'singular_name' => __( 'Portfolio Category', 'okthemes' ),
			'search_items' => __( 'Search Portfolio Categories', 'okthemes' ),
			'popular_items' => __( 'Popular Portfolio Categories', 'okthemes' ),
			'all_items' => __( 'All Portfolio Categories', 'okthemes' ),
			'parent_item' => __( 'Parent Portfolio Category', 'okthemes' ),
			'parent_item_colon' => __( 'Parent Portfolio Category:', 'okthemes' ),
			'edit_item' => __( 'Edit Portfolio Category', 'okthemes' ),
			'update_item' => __( 'Update Portfolio Category', 'okthemes' ),
			'add_new_item' => __( 'Add New Portfolio Category', 'okthemes' ),
			'new_item_name' => __( 'New Portfolio Category Name', 'okthemes' ),
			'separate_items_with_commas' => __( 'Separate portfolio categories with commas', 'okthemes' ),
			'add_or_remove_items' => __( 'Add or remove portfolio categories', 'okthemes' ),
			'choose_from_most_used' => __( 'Choose from the most used portfolio categories', 'okthemes' ),
			'menu_name' => __('Portfolio Categories', 'okthemes' ),
	    );

	    $taxonomy_portfolio_category_args = array(
			'labels' => $taxonomy_portfolio_category_labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'portfolio_category' ),
			'query_var' => true
	    );

	    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $taxonomy_portfolio_category_args );

	}

	/**
	 * Add Columns to Portfolio Edit Screen
	 * http://wptheming.com/2010/07/column-edit-pages/
	 */

	function portfolio_edit_columns( $portfolio_columns ) {
		$portfolio_columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __('Title', 'okthemes'),
			"thumbnail" => __('Thumbnail', 'okthemes'),
			"portfolio_category" => __('Category', 'okthemes'),
			"portfolio_tag" => __('Tags', 'okthemes'),
			"author" => __('Author', 'okthemes'),
			"comments" => __('Comments', 'okthemes'),
			"date" => __('Date', 'okthemes'),
		);
		$portfolio_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
		return $portfolio_columns;
	}

	function portfolio_column_display( $portfolio_columns, $post_id ) {

		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview

		switch ( $portfolio_columns ) {

			// Display the portfolio tags in the column view
			case "portfolio_category":

			if ( $category_list = get_the_term_list( $post_id, 'portfolio_category', '', ', ', '' ) ) {
				echo $category_list;
			} else {
				echo __('None', 'okthemes');
			}
			break;	

			// Display the portfolio tags in the column view
			case "portfolio_tag":

			if ( $tag_list = get_the_term_list( $post_id, 'portfolio_tag', '', ', ', '' ) ) {
				echo $tag_list;
			} else {
				echo __('None', 'okthemes');
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
		$taxonomies = array( 'portfolio_category', 'portfolio_tag' );

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
	 * Add Portfolio count to "Right Now" Dashboard Widget
	 */

	function add_portfolio_counts() {
	        if ( ! post_type_exists( 'portfolio' ) ) {
	             return;
	        }

	        $num_posts = wp_count_posts( 'portfolio' );
	        $num = number_format_i18n( $num_posts->publish );
	        $text = _n( 'Portfolio Item', 'Portfolio Items', intval($num_posts->publish) );
	        if ( current_user_can( 'edit_posts' ) ) {
	            $num = "<a href='edit.php?post_type=portfolio'>$num</a>";
	            $text = "<a href='edit.php?post_type=portfolio'>$text</a>";
	        }
	        echo '<td class="first b b-portfolio">' . $num . '</td>';
	        echo '<td class="t portfolio">' . $text . '</td>';
	        echo '</tr>';

	        if ($num_posts->pending > 0) {
	            $num = number_format_i18n( $num_posts->pending );
	            $text = _n( 'Portfolio Item Pending', 'Portfolio Items Pending', intval($num_posts->pending) );
	            if ( current_user_can( 'edit_posts' ) ) {
	                $num = "<a href='edit.php?post_status=pending&post_type=portfolio'>$num</a>";
	                $text = "<a href='edit.php?post_status=pending&post_type=portfolio'>$text</a>";
	            }
	            echo '<td class="first b b-portfolio">' . $num . '</td>';
	            echo '<td class="t portfolio">' . $text . '</td>';

	            echo '</tr>';
	        }
	}

}

new Portfolio_Post_Type;

endif;

if ( ! class_exists( 'Slideshow_Post_Type' ) ) :

class Slideshow_Post_Type {

	// Current plugin version
	var $version = 0.4;

	function __construct() {


		// Adds the Slideshow post type and taxonomies
		add_action( 'init', array( &$this, 'slideshow_init' ) );

		// Thumbnail support for Slideshow posts
		add_theme_support( 'post-thumbnails', array( 'slideshow' ) );

		// Adds columns in the admin view for thumbnail and taxonomies
		add_filter( 'manage_edit-slideshow_columns', array( &$this, 'slideshow_edit_columns' ) );
		add_action( 'manage_posts_custom_column', array( &$this, 'slideshow_column_display' ), 10, 2 );

		// Show Slideshow post counts in the dashboard
		add_action( 'right_now_content_table_end', array( &$this, 'add_slideshow_counts' ) );

	}

	/**
	 * Flushes rewrite rules on plugin activation to ensure Slideshow posts don't 404
	 * http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
	 */

	function plugin_activation() {
		$this->slideshow_init();
		flush_rewrite_rules();
	}

	function slideshow_init() {

		/**
		 * Enable the Slideshow custom post type
		 * http://codex.wordpress.org/Function_Reference/register_post_type
		 */

		$labels = array(
			'name' => __( 'Slideshow', 'okthemes' ),
			'singular_name' => __( 'Slideshow Item', 'okthemes' ),
			'add_new' => __( 'Add New Item', 'okthemes' ),
			'add_new_item' => __( 'Add New Slideshow Item', 'okthemes' ),
			'edit_item' => __( 'Edit Slideshow Item', 'okthemes' ),
			'new_item' => __( 'Add New Slideshow Item', 'okthemes' ),
			'view_item' => __( 'View Item', 'okthemes' ),
			'search_items' => __( 'Search Slideshow', 'okthemes' ),
			'not_found' => __( 'No slideshow items found', 'okthemes' ),
			'not_found_in_trash' => __( 'No slideshow items found in trash', 'okthemes' )
		);

		$args = array(
	    	'labels' => $labels,
	    	'public' => true,
			'supports' => array( 'title', 'thumbnail' ),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "slideshow"), // Permalinks format
			'menu_position' => 5,
			'has_archive' => true
		); 

		register_post_type( 'slideshow', $args );
		
		/**
		 * Register a taxonomy for Slideshow Categories
		 * http://codex.wordpress.org/Function_Reference/register_taxonomy
		 */

	    $taxonomy_slideshow_category_labels = array(
			'name' => __( 'Slideshow Categories', 'okthemes' ),
			'singular_name' => __( 'Slideshow Category', 'okthemes' ),
			'search_items' => __( 'Search Slideshow Categories', 'okthemes' ),
			'popular_items' => __( 'Popular Slideshow Categories', 'okthemes' ),
			'all_items' => __( 'All Slideshow Categories', 'okthemes' ),
			'parent_item' => __( 'Parent Slideshow Category', 'okthemes' ),
			'parent_item_colon' => __( 'Parent Slideshow Category:', 'okthemes' ),
			'edit_item' => __( 'Edit Slideshow Category', 'okthemes' ),
			'update_item' => __( 'Update Slideshow Category', 'okthemes' ),
			'add_new_item' => __( 'Add New Slideshow Category', 'okthemes' ),
			'new_item_name' => __( 'New Slideshow Category Name', 'okthemes' ),
			'separate_items_with_commas' => __( 'Separate Slideshow categories with commas', 'okthemes' ),
			'add_or_remove_items' => __( 'Add or remove Slideshow categories', 'okthemes' ),
			'choose_from_most_used' => __( 'Choose from the most used Slideshow categories', 'okthemes' ),
			'menu_name' => __( 'Slideshow Categories', 'okthemes' ),
	    );

	    $taxonomy_slideshow_category_args = array(
			'labels' => $taxonomy_slideshow_category_labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'rewrite' => array( 'slug' => 'slideshow_category' ),
			'query_var' => true
	    );

	    register_taxonomy( 'slideshow_category', array( 'slideshow' ), $taxonomy_slideshow_category_args );
	}
	
	function slideshow_edit_columns( $slideshow_columns ) {
		$slideshow_columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __('Title', 'okthemes'),
			"thumbnail" => __('Thumbnail', 'okthemes'),
			"slideshow_category" => __('Category', 'okthemes'),
			"date" => __('Date', 'okthemes'),
		);
		return $slideshow_columns;
	}

	function slideshow_column_display( $slideshow_columns, $post_id ) {

		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview

		switch ( $slideshow_columns ) {

			// Display the Slideshow categories in the column view
			case "slideshow_category":

			if ( $category_list = get_the_term_list( $post_id, 'slideshow_category', '', ', ', '' ) ) {
				echo $category_list;
			} else {
				echo __('None', 'okthemes');
			}
			break;	
		}
	}

	/**
	 * Adds taxonomy filters to the Slideshow admin page
	 * Code artfully lifed from http://pippinsplugins.com
	 */

	function slideshow_add_taxonomy_filters() {
		global $typenow;

		// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
		$taxonomies = array( 'slideshow_category');

		// must set this to the post type you want the filter(s) displayed on
		if ( $typenow == 'slideshow' ) {

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
	 * Add Slideshow count to "Right Now" Dashboard Widget
	 */

	function add_slideshow_counts() {
	        if ( ! post_type_exists( 'slideshow' ) ) {
	             return;
	        }

	        $num_posts = wp_count_posts( 'slideshow' );
	        $num = number_format_i18n( $num_posts->publish );
	        $text = _n( 'Slideshow Item', 'Slideshow Items', intval($num_posts->publish) );
	        if ( current_user_can( 'edit_posts' ) ) {
	            $num = "<a href='edit.php?post_type=slideshow'>$num</a>";
	            $text = "<a href='edit.php?post_type=slideshow'>$text</a>";
	        }
	        echo '<td class="first b b-slideshow">' . $num . '</td>';
	        echo '<td class="t slideshow">' . $text . '</td>';
	        echo '</tr>';

	        if ($num_posts->pending > 0) {
	            $num = number_format_i18n( $num_posts->pending );
	            $text = _n( 'Slideshow Item Pending', 'Slideshow Items Pending', intval($num_posts->pending) );
	            if ( current_user_can( 'edit_posts' ) ) {
	                $num = "<a href='edit.php?post_status=pending&post_type=slideshow'>$num</a>";
	                $text = "<a href='edit.php?post_status=pending&post_type=slideshow'>$text</a>";
	            }
	            echo '<td class="first b b-slideshow">' . $num . '</td>';
	            echo '<td class="t slideshow">' . $text . '</td>';

	            echo '</tr>';
	        }
	}

}

new Slideshow_Post_Type;

endif;

if ( ! class_exists( 'Sponsors_Post_Type' ) ) :

class Sponsors_Post_Type {

	// Current plugin version
	var $version = 0.4;

	function __construct() {


		// Adds the Sponsors post type and taxonomies
		add_action( 'init', array( &$this, 'sponsors_init' ) );

		// Thumbnail support for Sponsors posts
		add_theme_support( 'post-thumbnails', array( 'sponsors' ) );

		// Adds columns in the admin view for thumbnail and taxonomies
		add_filter( 'manage_edit-sponsors_columns', array( &$this, 'sponsors_edit_columns' ) );
		add_action( 'manage_posts_custom_column', array( &$this, 'sponsors_column_display' ), 10, 2 );

		// Show Sponsors post counts in the dashboard
		add_action( 'right_now_content_table_end', array( &$this, 'add_sponsors_counts' ) );

	}

	/**
	 * Flushes rewrite rules on plugin activation to ensure Sponsors posts don't 404
	 * http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
	 */

	function plugin_activation() {
		$this->sponsors_init();
		flush_rewrite_rules();
	}

	function sponsors_init() {

		/**
		 * Enable the Sponsors custom post type
		 * http://codex.wordpress.org/Function_Reference/register_post_type
		 */

		$labels = array(
			'name' => __( 'Sponsors', 'okthemes' ),
			'singular_name' => __( 'Sponsors Item', 'okthemes' ),
			'add_new' => __( 'Add New Item', 'okthemes' ),
			'add_new_item' => __( 'Add New Sponsors Item', 'okthemes' ),
			'edit_item' => __( 'Edit Sponsors Item', 'okthemes' ),
			'new_item' => __( 'Add New Sponsors Item', 'okthemes' ),
			'view_item' => __( 'View Item', 'okthemes' ),
			'search_items' => __( 'Search Sponsors', 'okthemes' ),
			'not_found' => __( 'No sponsors items found', 'okthemes' ),
			'not_found_in_trash' => __( 'No sponsors items found in trash', 'okthemes' )
		);

		$args = array(
	    	'labels' => $labels,
	    	'public' => true,
			'supports' => array( 'title', 'thumbnail' ),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "sponsors"), // Permalinks format
			'menu_position' => 5,
			'has_archive' => true
		); 

		register_post_type( 'sponsors', $args );
	}

	/**
	 * Add Columns to Sponsors Edit Screen
	 * http://wptheming.com/2010/07/column-edit-pages/
	 */

	function sponsors_edit_columns( $sponsors_columns ) {
		$sponsors_columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __('Title', 'okthemes'),
			"thumbnail" => __('Thumbnail', 'okthemes'),
			"author" => __('Author', 'okthemes'),
			"date" => __('Date', 'okthemes'),
		);
		return $sponsors_columns;
	}

	function sponsors_column_display( $sponsors_columns, $post_id ) {

		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview

		switch ( $sponsors_columns ) {

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
					echo __('None', 'okthemes');
				}
				break;	
		
		}
	}

	/**
	 * Add Sponsors count to "Right Now" Dashboard Widget
	 */

	function add_sponsors_counts() {
	        if ( ! post_type_exists( 'sponsors' ) ) {
	             return;
	        }

	        $num_posts = wp_count_posts( 'sponsors' );
	        $num = number_format_i18n( $num_posts->publish );
	        $text = _n( 'Sponsors Item', 'Sponsors Items', intval($num_posts->publish) );
	        if ( current_user_can( 'edit_posts' ) ) {
	            $num = "<a href='edit.php?post_type=sponsors'>$num</a>";
	            $text = "<a href='edit.php?post_type=sponsors'>$text</a>";
	        }
	        echo '<td class="first b b-sponsors">' . $num . '</td>';
	        echo '<td class="t sponsors">' . $text . '</td>';
	        echo '</tr>';

	        if ($num_posts->pending > 0) {
	            $num = number_format_i18n( $num_posts->pending );
	            $text = _n( 'Sponsors Item Pending', 'Sponsors Items Pending', intval($num_posts->pending) );
	            if ( current_user_can( 'edit_posts' ) ) {
	                $num = "<a href='edit.php?post_status=pending&post_type=sponsors'>$num</a>";
	                $text = "<a href='edit.php?post_status=pending&post_type=sponsors'>$text</a>";
	            }
	            echo '<td class="first b b-sponsors">' . $num . '</td>';
	            echo '<td class="t sponsors">' . $text . '</td>';

	            echo '</tr>';
	        }
	}

}

new Sponsors_Post_Type;

endif;