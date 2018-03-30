<?php

/**
 * This file creates sample SLIDE 
 *
 */
 
global $user_ID;


//$dummy_excerpt = 'Mauris porttitor lacus vitae?'; 

$dummy_excerpt = 'Mauris porttitor lacus vitae lectus aliquam eget aliquet tortor vehicula. <!--more-->Morbi semper malesuada rhoncus. Integer sodales est a lorem molestie dignissim. Morbi accumsan justo eget orci sodales suscipit. Proin scelerisque malesuada felis, vel bibendum odio euismod vel. '; 



// SLIDE 1

$slide_1 = array(
    'post_title' => 'Sample slide 1',
    'post_type' => 'slide',
    'post_excerpt' => $dummy_excerpt,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$slide_1_id = wp_insert_post( $slide_1 );

wp_set_object_terms($slide_1_id,'Sample category 1','slideshow',false);

$filesrc = 'http://epicthemes.net/misc/samples/images/sample-1.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $slide_1_id, "Sample"); // Upload the image
add_post_meta($slide_1_id, '_thumbnail_id', $upload, true); // Set image as featured image


// SLIDE 2

$slide_2 = array(
    'post_title' => 'Sample slide 2',
    'post_type' => 'slide',
    'post_excerpt' => $dummy_excerpt,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$slide_2_id = wp_insert_post( $slide_2 );

wp_set_object_terms($slide_2_id,'Sample category 1','slideshow',false);

$filesrc = 'http://epicthemes.net/misc/samples/images/sample-2.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $slide_2_id, "Sample"); // Upload the image
add_post_meta($slide_2_id, '_thumbnail_id', $upload, true); // Set image as featured image

update_post_meta($slide_2_id,'epic_slideinfo', true);


// SLIDE 3

$slide_3 = array(
    'post_title' => 'Sample slide 3',
    'post_type' => 'slide',
    'post_excerpt' => $dummy_excerpt,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$slide_3_id = wp_insert_post( $slide_3 );

wp_set_object_terms($slide_3_id,'Sample category 1','slideshow',false);

$filesrc = 'http://epicthemes.net/misc/samples/images/sample-3.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $slide_3_id, "Sample"); // Upload the image
add_post_meta($slide_3_id, '_thumbnail_id', $upload, true); // Set image as featured image


// SLIDE 4

$slide_4 = array(
    'post_title' => 'Sample slide 4',
    'post_type' => 'slide',
    'post_excerpt' => '',
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$slide_4_id = wp_insert_post( $slide_4 );

wp_set_object_terms($slide_4_id,'Sample category 1','slideshow',false);

$filesrc = 'http://epicthemes.net/misc/samples/images/sample-4.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $slide_4_id, "Sample"); // Upload the image
add_post_meta($slide_4_id, '_thumbnail_id', $upload, true); // Set image as featured image

update_post_meta($slide_4_id,'epic_slideinfo', true);


?>