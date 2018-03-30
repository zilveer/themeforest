<?php

/* Events Manager Options
 ------------------------------------------------------------------------*/

global $pagenow, $r_option, $current_date, $events_cp;

/* Slug */
$event_slug = 'events';
$event_cat_slug = 'event-category';
if ( isset($r_option['events_slug']) && $r_option['events_slug'] != '' ) 
	$event_slug = $r_option['events_slug'];
if ( isset( $r_option['events_cat_slug'] ) && $r_option['events_cat_slug'] != '' ) 
	$event_cat_slug = $r_option['events_cat_slug'];

/* Class arguments */
$args = array( 
	'post_name' => 'wp_events_manager', 
	'sortable' => false,
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/custom_post',
	'textdomain' => SHORT_NAME
);

/* Post Labels */
$labels = array(
	'name' => _x( 'Events', 'Admin - Events Manager', SHORT_NAME ),
	'singular_name' => _x( 'Events Manager', 'Admin - Events Manager', SHORT_NAME ),
	'add_new' => _x( 'Add New', 'Admin - Events Manager', SHORT_NAME ),
	'add_new_item' => _x( 'Add New Event', 'Admin - Events Manager', SHORT_NAME ),
	'edit_item' => _x( 'Edit Event', 'Admin - Events Manager', SHORT_NAME ),
	'new_item' => _x( 'New Event', 'Admin - Events Manager', SHORT_NAME ),
	'view_item' => _x( 'View Event', 'Admin - Events Manager', SHORT_NAME ),
	'search_items' => _x( 'Search Items', 'Admin - Events Manager', SHORT_NAME ),
	'not_found' =>  _x( 'No events found', 'Admin - Events Manager', SHORT_NAME ),
	'not_found_in_trash' => _x( 'No events found in Trash', 'Admin - Events Manager', SHORT_NAME ), 
	'parent_item_colon' => ''
);

/* Post Options */
$options = array(
	'labels' => $labels,
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array(
		'slug' => $event_slug,
		'with_front' => true,
	),
	'supports' => array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'),
	'menu_icon' => 'dashicons-calendar',
	'show_in_nav_menus' => false
);

/* Add Taxonomy */
register_taxonomy('wp_event_type', array('wp_events_manager'), array(
	'hierarchical' => true,
	'label' => _x( 'Event Type', 'Admin - Events Manager', SHORT_NAME ),
	'singular_label' => _x( 'Event Type', 'Admin - Events Manager', SHORT_NAME ),
	'show_ui' => false,
	'query_var' => true,
	'capabilities' => array(
		'manage_terms' => 'manage_divisions',
		'edit_terms' => 'edit_divisions',
		'delete_terms' => 'delete_divisions',
		'assign_terms' => 'edit_posts'
	),
	'rewrite' => array('slug' => 'event-type'),
	'show_in_nav_menus' => false
));

/* Add Taxonomy */
register_taxonomy('wp_event_categories', array('wp_events_manager'), array(
	'hierarchical' => true,
	'label' => _x( 'Events Categories', 'Admin - Events Manager', SHORT_NAME ),
	'singular_label' => _x( 'Event Category', 'Admin - Events Manager', SHORT_NAME ),
	'query_var' => true,
	'rewrite' => array('slug' => $event_cat_slug)
));


/* Add class instance */
$events_cp = new R_Custom_Post( $args, $options );

/* Remove variables */
unset($args, $options);


/*-------------------------------------------------------------------------------------*/


/* Settings
------------------------------------------------------------------------*/
$time_zone = 'local_time'; /* local_time, server_time, UTC */

/* Timezone */
$current_date = array();
$current_date['local_time'] = date( 'Y-m-d', current_time( 'timestamp', 0 ) );
$current_date['server_time'] = date( 'Y-m-d', current_time( 'timestamp', 1 ) );
$current_date['UTC'] = date( 'Y-m-d' );
$current_date = $current_date[$time_zone];

/* Insert default taxonomy */
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
    r_insert_taxonomy('Future events', 0, '', 'wp_event_type');
    r_insert_taxonomy('Past events', 0, '', 'wp_event_type');
}


/* Column Layout
------------------------------------------------------------------------*/
add_filter( 'manage_edit-wp_events_manager_columns', 'event_manager_columns' );

function event_manager_columns( $columns ) {
	global $current_date;
	
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => _x( 'Event Title', 'Admin - Events Manager', SHORT_NAME ),
		'event_date' => _x( 'Event Date', 'Admin - Events Manager', SHORT_NAME ) . ' (' . $current_date . ')',
		'event_days' => _x( 'Days', 'Admin - Events Manager', SHORT_NAME ),
		'event_days_left' => _x( 'Days Left', 'Admin - Events Manager', SHORT_NAME ),
		'event_type' => _x( 'Event Type', 'Admin - Events Manager', SHORT_NAME ),
		'event_repeat' => _x( 'Event Repeat', 'Admin - Events Manager', SHORT_NAME ),
		'tax_events' => _x( 'Categories', 'Admin - Events Manager', SHORT_NAME ),
		'image_preview' => _x( 'Image Preview', 'Admin - Events Manager', SHORT_NAME )
	);

	return $columns;
}

add_action( 'manage_posts_custom_column', 'event_manager_display_columns' );

function event_manager_display_columns( $column ) {
	global $post, $current_date, $events_cp;
	
	$today = strtotime( $current_date );
	
	switch ($column) {
		case 'event_date':
			$event_date_start = get_post_custom();
			$event_date_end = get_post_custom();
			echo $event_date_start['_event_date_start'][0] . ' - ' . $event_date_end['_event_date_end'][0];
			break;
		case 'event_days' :
			$event_date_start = get_post_custom();
			$event_date_end = get_post_custom();
			echo r_days_left($event_date_start['_event_date_start'][0], $event_date_end['_event_date_end'][0], 'days');
			break;
		case 'event_days_left' :
			$event_date_start = get_post_custom();
			$event_date_end = get_post_custom();
			echo r_days_left($event_date_start['_event_date_start'][0], $event_date_end['_event_date_end'][0], 'days_left');
			break;
		case 'event_type' :
				$taxonomies = get_the_terms( $post->ID, 'wp_event_type' );
				$event_date_end = get_post_custom();
				if ( $taxonomies ) {
					foreach( $taxonomies as $taxonomy ) {
						if (strtotime( $event_date_end['_event_date_end'][0] ) >= $today && $taxonomy->name == 'Future events') 
						    echo '<strong>' . $taxonomy->name . '</strong>';
						else 
						    echo $taxonomy->name;
					}
				}
				break;
		case 'event_repeat' :
				$custom = get_post_custom();
				if ( isset( $custom['_repeat_event'][0]) && $custom['_repeat_event'][0] != 'none' )
					echo ucfirst( $custom['_repeat_event'][0] );
				
				break;
		case 'tax_events' :
			$taxonomies = get_the_terms( $post->ID, 'wp_event_categories' );
				if ( $taxonomies ) {
					foreach ( $taxonomies as $taxonomy ) {
						echo $taxonomy->name . ' ';
					}
				}
			break;
		case 'image_preview':
			$custom = get_post_custom();
			if ( isset( $custom['_event_image'][0]) && $events_cp->image_exists( $custom['_event_image'][0] ) )
				echo '<img src="' . $events_cp->image_resize('130', '60', $custom['_event_image'][0]) . '" alt="' . esc_attr( get_the_title() ) . '" style="padding:5px"/>';
			break;
	}
}


/* Menage Events
------------------------------------------------------------------------*/
function manage_events() {
	global $post, $current_date;
	
	$backup = $post;
	$today = strtotime( $current_date );
	$args = array(
		'post_type'     => 'wp_events_manager',
		'wp_event_type' => 'Future events',
		'post_status'   => 'publish, pending, draft, future, private, trash',
		'numberposts'   => '-1',
		'orderby'       => 'meta_value',  
		'meta_key'      => '_event_date_end',
		'order'         => 'ASC',
	  	'meta_query' 	 => array(array('key' => '_event_date_end', 'value' => date('Y-m-d'), 'compare' => '<', 'type' => 'DATE')),
	  );
	$events = get_posts( $args );
	
 	foreach( $events as $event ) {
		
		$event_date_start = get_post_meta( $event->ID, '_event_date_start', true );
		$event_date_end = get_post_meta( $event->ID, '_event_date_end', true );
		$repeat = get_post_meta( $event->ID, '_repeat_event', true );
		
		/* Move Events */

		// If is set repeat event
		if ( isset( $repeat ) && $repeat != 'none' ) {

			// Weekly
			if ( $repeat == 'weekly' ) {
				$every = get_post_meta( $event->ID, '_every', true );
				$weekly_days = get_post_meta( $event->ID, '_weekly_days', true );

				// Event length
				$start_date = strtotime( $event_date_start );
				$end_date = strtotime( $event_date_end );
				$date_diff = $end_date - $start_date;
				$event_length = floor( $date_diff / (60*60*24) );

				unset( $start_date, $end_date, $date_diff );
				//echo "Differernce is $event_length days";

				// Make dates array
				$weekly_dates  = array();
				$weekly_days_a = array();
				foreach ( $weekly_days as $key => $day ) {
					$start_date = strtotime( "+$every week $day $event_date_start" );
					$date_diff = $start_date - $today;
					$days = floor( $date_diff / (60*60*24) );
					$start_date = date( 'Y-m-d', $start_date );
					$end_date = strtotime( "+$event_length day $start_date" );
					$end_date = date( 'Y-m-d', $end_date );
					//echo $key . ' | ' . $day . ' | days: ' . $days . ' | start date: ' . $start_date . ' | end date: ' . $end_date . '<br>';
					$weekly_dates[$key]['day'] = $day;
					$weekly_dates[$key]['days'] = $days;
					$weekly_dates[$key]['start_date'] = $start_date;
					$weekly_dates[$key]['end_date'] = $end_date;
					$weekly_days_a[] = $days;
				}
				// Next event date
				$ne = array_search( min( $weekly_days_a ), $weekly_days_a );
				//print_r($ne);

				// Update event date
				update_post_meta( $event->ID, '_event_date_start', $weekly_dates[$ne]['start_date'] );
				update_post_meta( $event->ID, '_event_date_end', $weekly_dates[$ne]['end_date'] );

			}
		} else {
			wp_set_post_terms( $event->ID, r_get_taxonomy_id( 'Past events', 'wp_event_type' ), 'wp_event_type', false );
		}
	}
	$post = $backup; 
	wp_reset_query();
}

/* Shelude events */
if ( false === ( $event_task = get_transient( 'event_task' ) ) ) {
    $current_time = time();
	manage_events();
	set_transient( 'event_task', $current_time, 60*60 );
}
//delete_transient('event_task');

/* Save Events */

add_action('wp_insert_post', 'save_postdata_events');

function save_postdata_events() {
   global $current_date;
	
	if ( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
	else return; 

	// Inline editor
 	if ($_POST['action'] == 'inline-save') return;

    if ($_POST['post_type'] == 'wp_events_manager') {
			
        $today = strtotime( $current_date );
	    $event_date_start = strtotime(get_post_meta($post_id, '_event_date_start', true));
	    $event_date_end = strtotime(get_post_meta($post_id, '_event_date_end', true));
		
        /* Add Default Date */
	    if (!$event_date_start) {
	  	    add_post_meta($post_id, '_event_date_start', date('Y-m-d', $today));
	    }
	    if (!$event_date_end) {
		    add_post_meta($post_id, '_event_date_end', get_post_meta($post_id, '_event_date_start', true));
	    }
	    if ($event_date_end < $event_date_start) {
		    update_post_meta($post_id, '_event_date_end', get_post_meta($post_id, '_event_date_start', true));
	    }
		
		$event_date_start = strtotime(get_post_meta($post_id, '_event_date_start', true));
	    $event_date_end = strtotime(get_post_meta($post_id, '_event_date_end', true));
		
		/* Add Default Term */
		$taxonomies = get_the_terms( $post_id, 'wp_event_type' );
		if (!$taxonomies) {
			wp_set_post_terms($post_id, r_get_taxonomy_id('Future events', 'wp_event_type'), 'wp_event_type', false);	
		}
	    if ($event_date_end >= $today) {
	  	    if (is_object_in_term($post_id, 'wp_event_type', 'Past events'))
	        wp_set_post_terms($post_id, r_get_taxonomy_id('Future events', 'wp_event_type'), 'wp_event_type', false);	
	    } else {	
	        if (is_object_in_term($post_id, 'wp_event_type', 'Future events'))
		    wp_set_post_terms($post_id, r_get_taxonomy_id('Past events', 'wp_event_type'), 'wp_event_type', false);
	    }
		
    }
	
}

/* Custom Order */
add_filter( 'pre_get_posts', 'events_manager_order' );

function events_manager_order( $query ) {
	
	if ( is_admin() ) {
	    $post_type = $query->query['post_type'];
    	if ($post_type == 'wp_events_manager') {
		   	$events_order = '_event_date_start';
			$query->query_vars['meta_key'] = $events_order;
			$query->query_vars['orderby'] = 'meta_value';
			$query->query_vars['order'] = 'asc';
			$query->query_vars['meta_query'] = array( array( 'key' => $events_order, 'value' => '1900-01-01', 'compare' => '>', 'type' => 'NUMERIC') );
    	}
  	}
}


/* Column Filters
------------------------------------------------------------------------*/
 
/* Event Type Filter */
add_action('restrict_manage_posts', 'add_events_filter');

function add_events_filter() {

    global $typenow, $events_cp;

    if ($typenow == 'wp_events_manager') {
        $args = array( 'name' => 'wp_event_type' );
        $filters = get_taxonomies( $args );

        foreach ( $filters as $tax_slug ) {
            $tax_obj = get_taxonomy( $tax_slug );
            $tax_name = $tax_obj->labels->name;

            echo '<select name="' . $tax_slug. '" id="' . $tax_slug . '" class="postform">';
			echo '<option value="">' . _x( 'Show All', 'Admin - Events Manager', SHORT_NAME ) . '</option>';
            $events_cp->generate_taxonomy_options( $tax_slug, 0, 0);
            echo "</select>";
        }
    }
}

/* Add Filter - Request */
add_action('request', 'events_request');

function events_request( $request ) {
	if ( is_admin() && isset( $request['post_type'] ) && $request['post_type'] == 'wp_events_manager' && isset( $request['wp_event_type'] ) ) {
		$term = get_term( $request['wp_event_type'], 'wp_event_type' );
		if ( isset( $term->name ) && $term ) {
			$term = $term->name;
			$request['term'] = $term;
		}
	}
	return $request;
}


/* Event category filter */
add_action( 'restrict_manage_posts', 'add_event_tax_filter' );

function add_event_tax_filter() {

    global $typenow, $events_cp;

    if ( $typenow == 'wp_events_manager' ) {
       	$args = array( 'name' => 'wp_event_categories' );
		$filters = get_taxonomies( $args );
		
		foreach ( $filters as $tax_slug ) {
			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			
			echo '<select name="' . $tax_slug. '" id="' . $tax_slug . '" class="postform">';
			echo '<option value="">' . _x( 'Show All', 'Admin - Events Manager', SHORT_NAME ) . '</option>';
			$events_cp->generate_taxonomy_options( $tax_slug, 0, 0);
			echo "</select>";
		}
    }
}

/* Add Filter - Request */
add_action( 'request', 'event_tax_request' );
function event_tax_request( $request ) {
	if ( is_admin() && isset( $request['post_type'] ) && $request['post_type'] == 'wp_events_manager' && isset( $request['wp_event_categories'] ) ) {
		
	   $term = get_term( $request['wp_event_categories'], 'wp_event_categories' );
		if ( isset( $term->name ) && $term ) {
			$term = $term->name;
			$request['term'] = $term;
		}
		
	}
	return $request;
}


/* Helpers Functions
------------------------------------------------------------------------*/
 
/* Days left */
function r_days_left( $start_date, $end_date, $type ) {
	global $current_date;
	
	$now = strtotime( $current_date );
	$start_date = strtotime( $start_date );
	$end_date = strtotime( $end_date );
	
	/* Days left to start date */
	$hours_left_start = ( mktime(0, 0, 0, date( 'm', $start_date ), date( 'd', $start_date ), date( 'Y', $start_date ) ) - $now ) / 3600;
	$days_left_start = ceil( $hours_left_start / 24 );
	
	/* Days left to end date */
	$hours_left_end = ( mktime( 0, 0, 0, date( 'm', $end_date ), date( 'd', $end_date ), date( 'Y', $end_date ) ) - $now ) / 3600;
	$days_left_end = ceil( $hours_left_end / 24 );
	$days_number = ( $days_left_end - $days_left_start ) + 1;
	
	if ( $type == 'days' ) {
		return $days_number;
	}
	
	if ( $type == 'days_left' ) {
		
		/* If future events */
		if ( $days_left_end >= 0 ) {
		
			if ( $days_left_start == 0 ) {
				return '<span style="color:red;font-weight:bold">'. _x( 'Start Today', 'Admin - Events Manager', SHORT_NAME ) .'</span>';
			}
			elseif ( $days_left_start < 0 ) {
				return '<span style="color:red;font-weight:bold">' . _x( 'Continued', 'Admin - Events Manager', SHORT_NAME ) . '</span>';
			}
			elseif ( $days_left_start > 0 ) {
				return $days_left_start;
			}
		
		} else return '-- --';
	}
	
}


?>