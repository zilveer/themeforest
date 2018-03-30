<?php

add_action( 'admin_init', 'lp_rebuild_permalinks' );
function lp_rebuild_permalinks() {
	$activation_check = get_option( 'lp_activate_rewrite_check', 0 );

	if ( $activation_check ) {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
		update_option( 'lp_activate_rewrite_check', '0' );
	}
}

add_action( 'init', 'landing_page_register' );
function landing_page_register() {
	//echo 1;
	$slug = get_option( 'main-landing-page-permalink-prefix', 'go' );
	//echo $slug;exit;
	$labels = array(
		'name'               => _x( 'Landing Pages', 'post type general name', 'ch' ),
		'singular_name'      => _x( 'Landing Page', 'post type singular name', 'ch' ),
		'add_new'            => _x( 'Add New', 'Landing Page', 'ch' ),
		'add_new_item'       => __( 'Add New Landing Page', 'ch' ),
		'edit_item'          => __( 'Edit Landing Page', 'ch' ),
		'new_item'           => __( 'New Landing Page', 'ch' ),
		'view_item'          => __( 'View Landing Page', 'ch' ),
		'search_items'       => __( 'Search Landing Page', 'ch' ),
		'not_found'          =>  __( 'Nothing found', 'ch' ),
		'not_found_in_trash' => __( 'Nothing found in Trash', 'ch' ),
		'parent_item_colon'  => ''
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => true,
		'menu_icon'          => LANDINGPAGES_URLPATH . '/images/plus.gif',
		'rewrite'            => array( "slug" => "$slug" ),
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'excerpt' )
	);

	register_post_type( 'landing-page' , $args );
	//flush_rewrite_rules( false );
	register_taxonomy( 'landing_page_category', 'landing-page', array(
			'hierarchical'   => true,
			'label'          => "Categories",
			'singular_label' => "Landing Page Category",
			'show_ui'        => true,
			'query_var'      => true,
			"rewrite"        => true
		) );

}

add_action( 'init', 'lp_group_register' );
function lp_group_register() {
	//echo 1; exit;
	$slug = get_option( 'main-landing-page-group-permalink-prefix', 'group' );
	//echo $slug;exit;
	$labels = array(
		'name'               => _x( 'Split Test Groups', 'post type general name', 'ch' ),
		'singular_name'      => _x( 'Split Test Group', 'post type singular name', 'ch' ),
		'add_new'            => _x( 'Add New', 'Landing Page', 'ch' ),
		'add_new_item'       => __( 'Add New Split Test Group', 'ch' ),
		'edit_item'          => __( 'Edit Split Test Group', 'ch' ),
		'new_item'           => __( 'New Split Test Group', 'ch' ),
		'view_item'          => __( 'View Split Test Group', 'ch' ),
		'search_items'       => __( 'Search Split Test Group', 'ch' ),
		'not_found'          =>  __( 'Nothing found', 'ch' ),
		'not_found_in_trash' => __( 'Nothing found in Trash', 'ch' ),
		'parent_item_colon'  => ''
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => false,
		'query_var'           => true,
		'rewrite'             => array( "slug" => $slug ),
		'capability_type'     => 'post',
		'show_in_menu'        => false,
		'hierarchical'        => false,
		'menu_position'       => null,
		'exclude_from_search' => true,
		'supports'            => array( 'title' )
	);

	register_post_type( 'landing-page-group' , $args );

	$this_path = LANDINGPAGES_PATH;
	$this_path = explode( 'wp-content', $this_path );
	$this_path = "wp-content".$this_path[1];
	add_rewrite_rule( "$slug/([^/]*)?", $this_path.'modules/module.redirect.php?permalink_name=$1', 'top' );
	add_rewrite_rule( "langing-page-group=([^/]*)?", $this_path.'modules/module.redirect.php?permalink_name=$1', 'top' );
	//flush_rewrite_rules();
}

// Fix the_title on landing pages if the_title() is used in template
if ( !is_admin() ) {
	add_filter( 'the_title', 'lp_fix_lp_title', 10, 2 );
	add_filter( 'get_the_title', 'lp_fix_lp_title', 10, 2 );
}
function lp_fix_lp_title( $title ) {
	global $post;
	if ( isset( $post )&&'landing-page' == $post->post_type ) {

		$title = get_post_meta( $post->ID, 'lp-main-headline', true );
	}
	return $title;
}

/*********PREPARE COLUMNS FOR IMPRESSIONS AND CONVERSIONS***************/
/***********************************************************************/
/***********************************************************************/
/***********************************************************************/
/***********************************************************************/


if ( is_admin() ) {
	include_once LANDINGPAGES_PATH.'filters/filters.post-type.php';
	//add_filter('manage_edit-landing-page_sortable_columns', 'lp_column_register_sortable');
	add_filter( "manage_edit-landing-page_columns", 'lp_columns' );
	add_action( "manage_posts_custom_column", "lp_column" );
	add_filter( 'landing-page_orderby', 'lp_column_orderby', 10, 2 );
	// remove SEO filter not working for just landing pages add_filter( 'wpseo_use_page_analysis', '__return_false' );


	//define columns for landing pages
	function lp_columns( $columns ) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			//"ID" => "ID",
			//"thumbnail-lander" => "Preview",
			"title" => "Landing Page Title",
			//"impressions" => "Visits",
			//"actions" => "Actions",
			//"cr" => "Conversion Rate",
			"template" => "Template",
			"date" => "Date"
		);
		return $columns;
	}

	if ( is_admin() ) {
		$parts = explode( 'wp-content', WP_PLUGIN_DIR );
		$part = $parts[1];
		$plugin_path = "./../wp-content{$part}/landing-pages/";

	}

	//populate collumsn for landing pages
	function lp_column( $column ) {
		global $post;
		global $plugin_path;

		if ( "ID" == $column ) {
			echo $post->ID;
		}
		else if ( "title" == $column ) {
			}
		else if ( "author" == $column ) {
			}
		else if ( "date" == $column ) {
			}
		else if ( "thumbnail-lander" == $column ) {
				$template  = get_post_meta( $post->ID, 'lp-selected-template', true );
				$permalink = get_permalink( $post->ID );
				$datetime  = the_modified_date( 'YmjH', null, null, false );
				$permalink = lp_ready_screenshot_url( $permalink, $datetime );
				$thumbnail = urlencode( esc_url( $permalink ) );

				echo "<a href='$permalink' target='_blank' ><img src='$thumbnail' style='width:140px;height:100px;' title='$template'></a>";

			}
		else {
			$lp_impressions = lp_get_page_views( $post->ID );
			$lp_conversions = lp_get_conversions( $post->ID );
			if ( $lp_conversions>0 ) {
				$lp_cr = round( ( $lp_conversions/$lp_impressions ), 2 );
			} else {
				$lp_cr = "0.0";
			}
		}

		if ( "impressions" == $column ) {
			$lp_impressions =  lp_col_impressions_callback( array( 'id'=>$post->ID, 'content'=>$lp_impressions ), true );
			echo "<b>".$lp_impressions."</b> visits";
		}
		elseif ( "actions" == $column ) {
			$lp_conversions =  lp_col_conversions_callback( array( 'id'=>$post->ID, 'content'=>$lp_conversions ), true );
			echo "<b>".$lp_conversions."</b> actions";
		}
		elseif ( "cr" == $column ) {
			$lp_cr =  lp_col_conversion_rate_callback( array( 'id'=>$post->ID, 'content'=>$lp_cr ), true );
			echo  lp_make_percent( $lp_cr );
		}
		elseif ( "template" == $column ) {
			$template_used = get_post_meta( $post->ID, 'lp-selected-template', true );
			echo $template_used;
		}
	}

	//sorting of columns
	add_filter( 'manage_edit-landing-page_sortable_columns', 'lp_sortable_column' );
	function lp_sortable_column( $columns ) {
		$columns['impressions'] = 'impressions';
		$columns['actions'] = 'actions';
		$columns['cr'] = 'cr';
		$columns['template'] = 'template';

		return $columns;
	}

	add_action( 'pre_get_posts', 'lp_column_orderby' );
	function lp_column_orderby( $query ) {
		global $wpdb;
		global $wp_query;

		$wp_query->query = wp_parse_args( $wp_query->query );
		if ( !isset($wp_query->query['orderby']) ) {
			$wp_query->query['orderby'] = '';
		}

		// Sort Impressions
		if ( 'impressions' == @$wp_query->query['orderby'] )
			$query = "(SELECT CAST(meta_value as decimal) FROM $wpdb->postmeta WHERE post_id = $wpdb->posts.ID AND meta_key = 'lp_page_views_count') " . $wp_query->get( 'order' );

		// Sort Actions
		if ( 'actions' == @$wp_query->query['orderby'] )
			$query = "(SELECT CAST(meta_value as decimal) FROM $wpdb->postmeta WHERE post_id = $wpdb->posts.ID AND meta_key = 'lp_page_conversions_count') " . $wp_query->get( 'order' );

		// Sort CTR
		if ( 'cr' == @$wp_query->query['orderby'] )
			$query = "((SELECT CAST(meta_value as decimal) FROM $wpdb->postmeta WHERE post_id = $wpdb->posts.ID AND meta_key = 'lp_page_conversions_count')/(SELECT CAST(meta_value as decimal) FROM $wpdb->postmeta WHERE post_id = $wpdb->posts.ID AND meta_key = 'lp_page_views_count')) " . $wp_query->get( 'order' );

		// Sort Templates
		if ( 'template' == @$wp_query->query['orderby'] )
			$query = "(SELECT CAST(meta_value as text) FROM $wpdb->postmeta WHERE post_id = $wpdb->posts.ID AND meta_key = 'lp-selected-template')" . $wp_query->get( 'order' );

		//echo $query;
		return $query;

	}


	//START Custom styling of post state (eg: pretty highlighting of post_status on landing pages page
	add_filter( 'display_post_states', 'lp_custom_post_states' );
	function lp_custom_post_states( $post_states ) {
		foreach ( $post_states as &$state ) {
			$state = '<span class="'.strtolower( $state ).' states">' . str_replace( ' ', '-', $state ) . '</span>';
		}
		return $post_states;
	}


	add_action( 'admin_head', 'lp_custom_post_states_css' );
	function lp_custom_post_states_css() {
		echo '<style>
					.post-state .states{
							font-size:10px;
							padding:3px 8px 3px 8px;
							-moz-border-radius:2px;
							-webkit-border-radius:2px;
							border-radius:2px;
							}
					.post-state .password{background:#000;color:#fff;}
					.post-state .pending{background:#83CF21 !important;color:#fff;}
					.post-state .private{background:#E0A21B;color:#fff;}
					.post-state .draft{background:#006699;color:#fff;}
				  </style>';
	}


	//***********ADDS 'CLEAR STATS' BUTTON TO POSTS EDITING AREA******************/
	add_filter( 'post_row_actions', 'lp_add_clear_tracking', 10, 2 );

	function lp_add_clear_tracking( $actions, $post ) {

		if ( $post->post_type=='landing-page' ) {
			$actions['clear'] = '<a href="#clear-stats" id="lp_clear_'.$post->ID.'" class="clear_stats" title="'
				. esc_attr( __( "Clear impression and conversion records", 'inboundnow_clear_stats' ) )
				. '" >' .  __( 'Clear Stats', 'Clear impression and conversion records' ) . '</a>';
		}
		return $actions;
	}


}


?>
