<?php
/**
 * Template Name: Test
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/10/16
 * Time: 2:53 AM
 */
get_header();

/*$qry = "SELECT *
FROM  `wp_pmzd_postmeta`
WHERE  `meta_key` =  'fave_property_location'";
$lat_long = $wpdb->get_results( $qry );

foreach( $lat_long as $row ) {
    $lat_lng = explode(',', $row->meta_value);
    $lat = $lat_lng[0];
    $long = $lat_lng[1];

    $qry = "INSERT INTO `wp_pmzd_postmeta`(`post_id`, `meta_key`, `meta_value`) VALUES ($row->post_id,'houzez_geolocation_lat',$lat);".'<br/>';
    $qry .= "INSERT INTO `wp_pmzd_postmeta`(`post_id`, `meta_key`, `meta_value`) VALUES ($row->post_id,'houzez_geolocation_long',$long);".'<br/>';
    echo $qry;
}*/

global $wpdb;
$use_radius = 'on';//isset( $params[ 'use_search_radius' ] ) && 'on' == $params[ 'use_search_radius' ];
$lat = 31.5546;//isset( $params[ 'search_lat' ] ) ? (float) $params[ 'search_lat' ] : false;
$lng = 74.3572;//isset( $params[ 'search_lng' ] ) ? (float) $params[ 'search_lng' ] : false;
$radius = 5; //isset( $params[ 'search_radius' ] ) ? (int) $params[ 'search_radius' ] : false;
$location = 'lahore';//isset( $params[ 'search_location' ] ) ? esc_attr( $params[ 'search_location' ] ) : false;

//$earth_radius =  3959 : 6371;
$earth_radius = 6371;

$sql = $wpdb->prepare( "
			SELECT $wpdb->posts.ID,
				( %s * acos(
					cos( radians(%s) ) *
					cos( radians( latitude.meta_value ) ) *
					cos( radians( longitude.meta_value ) - radians(%s) ) +
					sin( radians(%s) ) *
					sin( radians( latitude.meta_value ) )
				) )
				AS distance, latitude.meta_value AS latitude, longitude.meta_value AS longitude
				FROM $wpdb->posts
				INNER JOIN $wpdb->postmeta
					AS latitude
					ON $wpdb->posts.ID = latitude.post_id
				INNER JOIN $wpdb->postmeta
					AS longitude
					ON $wpdb->posts.ID = longitude.post_id
				WHERE 1=1
					AND ($wpdb->posts.post_status = 'publish' )
					AND latitude.meta_key='houzez_geolocation_lat'
					AND longitude.meta_key='houzez_geolocation_long'
				HAVING distance < %s
				ORDER BY $wpdb->posts.menu_order ASC, distance ASC",
    $earth_radius,
    $lat,
    $lng,
    $lat,
    $radius
);
//echo $sql;
/*$post_ids = $wpdb->get_results( $sql, OBJECT_K );

if ( empty( $post_ids ) || ! $post_ids ) {
    $post_ids = array(0);
}*/

/*if ( $wp_query ) {
    $wp_query->locations = $post_ids;
}*/

//$query_args[ 'post__in' ] = array_keys( (array) $post_ids );

//$query_args = $this->remove_location_meta_query( $query_args );
//print_r($query_args);
//return $query_args;



// Filters test
// Our filter callback function
/*function example_callback( $string, $arg1, $arg2 ) {
	return $string.' '.$arg1;
}
add_filter( 'example_filter', 'example_callback', 10, 3 );

$arg1 = 'arg1';
$arg2 = 'arg2';

$value = apply_filters( 'example_filter', 'filter me', $arg1, $arg2 );*/


$search_lat = '31.5546';
$search_long = '74.3572';
$search_radius = '5';

if( !function_exists('houzez_radius_filter_callback') ) {
	function houzez_radius_filter_callback($query_args, $search_lat, $search_long, $search_radius)
	{
		return $query_args.' '.$search_lat.' '.$search_long.' '.$search_radius;
	}
}
add_filter('houzez_radius_filter', 'houzez_radius_filter_callback', 10, 4);


$value = apply_filters( 'houzez_radius_filter', 'query', $search_lat, $search_long, $search_radius );
echo $value;
/*
 * Apply the filters by calling the 'example_callback' function we
 * "hooked" to 'example_filter' using the add_filter() function above.
 * - 'example_filter' is the filter hook $tag
 * - 'filter me' is the value being filtered
 * - $arg1 and $arg2 are the additional arguments passed to the callback.
*/


get_footer(); ?>