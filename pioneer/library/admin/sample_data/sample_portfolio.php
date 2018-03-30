<?php

/**
 * This file creates sample posts 
 *
 */
 
global $user_ID;
 
$dummy_excerpt = 'Mauris porttitor lacus vitae?'; 

$dummy_content = 'Mauris porttitor lacus vitae lectus aliquam eget aliquet tortor vehicula. Morbi semper malesuada rhoncus. Integer sodales est a lorem molestie dignissim. Morbi accumsan justo eget orci sodales suscipit. Proin scelerisque malesuada felis, vel bibendum odio euismod vel. '; 


// CREATE PORTFOLIO MAIN PAGE
$portfolio_page = array(
    'post_title' => 'Portfolio',
    'post_type' => 'page',
    'post_content' => 'This is a page with page template Portfolio. It displays latest posts in post-type portfolio',
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$portfolio_page_id = wp_insert_post( $portfolio_page );

update_post_meta($portfolio_page_id, '_wp_page_template', 'template-portfolio.php');


// CREATE POST 1
$p_1 = array(
    'post_title' => 'Sample portfolio post 1',
    'post_type' => 'portfolio',
    'post_excerpt' => $dummy_excerpt,
    'post_content' => $dummy_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$p_1_id = wp_insert_post( $p_1 );

wp_set_object_terms($p_1_id,'Portfolio category 1','portfoliocategory',false);

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/sample-1.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $p_1_id, "Sample"); // Upload the image
add_post_meta($p_1_id, '_thumbnail_id', $upload, true); // Set image as featured image
  	
set_post_format( $p_1_id , 'image');
update_post_meta($p_1_id,'epic_selectsidebar','Default Sidebar');



// CREATE POST 2
$p_2 = array(
    'post_title' => 'Sample portfolio post 2',
    'post_type' => 'portfolio',
    'post_excerpt' => $dummy_excerpt,
    'post_content' => $dummy_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$p_2_id = wp_insert_post( $p_2 );

wp_set_object_terms($p_2_id,'Portfolio category 2','portfoliocategory',false);

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/sample-2.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $p_2_id, "Sample"); // Upload the image
add_post_meta($p_2_id, '_thumbnail_id', $upload, true); // Set image as featured image

set_post_format( $p_2_id , 'image');
update_post_meta($p_2_id,'epic_selectsidebar','Default Sidebar');

// CREATE POST 2
$p_3 = array(
    'post_title' => 'Sample portfolio post 2',
    'post_type' => 'portfolio',
    'post_excerpt' => $dummy_excerpt,
    'post_content' => $dummy_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$p_3_id = wp_insert_post( $p_3 );

wp_set_object_terms($p_3_id,'Portfolio category 3','portfoliocategory',false);

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/sample-3.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $p_3_id, "Sample"); // Upload the image
add_post_meta($p_3_id, '_thumbnail_id', $upload, true); // Set image as featured image

set_post_format( $p_3_id , 'image');
update_post_meta($p_3_id,'epic_selectsidebar','Default Sidebar');

?>