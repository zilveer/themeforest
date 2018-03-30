<?php

/*
 * this file does some less heavy work.
 * 
 * we have to check locally if:
 * 
 * - the post the data comes from exists
 * - check if all the fields are filled out and valid
 * 
 * submit form then.
 */

define('WP_USE_THEMES', false);
include_once '../../../../../wp-load.php';
include_once TEMPLATEPATH.'/functions.php';



foreach($_GET as $key => $value)
{
    $valid_data[esc_attr($key)] = esc_attr($value);
}

// naming is inverse. prev means we increase the limit, next decreases it

$page_event = $valid_data['page'];

$limit = $page_event*3;

$querystr = "
    SELECT * FROM $wpdb->posts
    LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
    WHERE $wpdb->posts.post_status = 'publish'
    AND $wpdb->posts.post_type = '".$bSettings->getPrefix()."_event'
    AND $wpdb->postmeta.meta_key = '".$bSettings->getPrefix()."_event_date'
    ORDER BY $wpdb->postmeta.meta_value ASC
    LIMIT $limit,100
";


$events_loop_footer = $wpdb->get_results($querystr, OBJECT);



$i = 0;
global $post;
foreach($events_loop_footer as $post)
{

    setup_postdata($post);
    
    
    
    if($i >= 3) break;
    
    $startdate  = strtotime(BebelUtils::getCustomMeta('event_registration_start', '', get_the_ID()));
    $enddate    = strtotime(BebelUtils::getCustomMeta('event_registration_end', '', get_the_ID()));
    $eventdate  = strtotime(BebelUtils::getCustomMeta('event_date', '', get_the_ID()));
    if($startdate <= time() && $enddate >= time())
    {
        // ok, we can use this one
        $i++;
        include '../footer_menu_bit.php';
    }
    
    
}


// count valid entries (upcoming events) for pagination
$j = 0;
foreach($events_loop_footer as $post)
{
    $startdate  = strtotime(BebelUtils::getCustomMeta('event_registration_start', '', get_the_ID()));
    $enddate    = strtotime(BebelUtils::getCustomMeta('event_registration_end', '', get_the_ID()));
    if($startdate <= time() && $enddate >= time()) 
    {
        $j++;
    }
}

if($j > 3 || $limit != 1)
{
    include '../footer_menu_navigation.php';
}