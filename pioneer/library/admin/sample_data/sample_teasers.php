<?php

/**
 * This file creates sample posts 
 *
 */
 
global $user_ID;
  

$dummy_content = '<h1>This is a teaser </h1> <p>Mauris porttitor lacus vitae lectus aliquam eget aliquet tortor vehicula. Morbi semper malesuada rhoncus</p>'; 


// CREATE TEASER-POST
$teaser_1 = array(
    'post_title' => 'This is a teaser!',
    'post_type' => 'teaser',
    'post_content' => '<h1>This is a teaser </h1> <p>Mauris porttitor lacus vitae lectus aliquam eget aliquet tortor vehicula. Morbi semper malesuada rhoncus</p>',
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$teaser_1_id = wp_insert_post( $teaser_1);
update_option('epic_home_teaser_1',$teaser_1_id, '', 'yes' );

// CREATE TEASER-POST
$teaser_2 = array(
    'post_title' => 'This is a teaser!',
    'post_type' => 'teaser',
    'post_content' => '<h1>This is another teaser </h1> <p>Mauris porttitor lacus vitae lectus aliquam eget aliquet tortor vehicula. Morbi semper malesuada rhoncus</p>',
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$teaser_2_id = wp_insert_post( $teaser_2 );
update_option('epic_home_teaser_2',$teaser_2_id,  '', 'yes' );




?>