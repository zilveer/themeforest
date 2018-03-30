<?php

/**
 * This file creates sample posts 
 *
 */
 
global $user_ID;
 
$dummy_excerpt = 'Mauris porttitor lacus vitae lectus aliquam eget aliquet tortor vehicula.'; 

$dummy_content = 'Mauris porttitor lacus vitae lectus aliquam eget aliquet tortor vehicula. Morbi semper malesuada rhoncus. Integer sodales est a lorem molestie dignissim. Morbi accumsan justo eget orci sodales suscipit.<!--more-->Proin scelerisque malesuada felis, vel bibendum odio euismod vel. Curabitur neque orci, porttitor nec semper at, porttitor id quam. Vestibulum vestibulum cursus lectus, eget imperdiet nibh porta et. Fusce sit amet mi velit. Etiam ut mauris libero, ac dictum purus. Proin at massa vehicula nibh ornare placerat non eget elit. Nunc eget purus nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non commodo eros. Aliquam erat volutpat. Integer et dolor velit. Nam gravida iaculis imperdiet.'; 

$dummy_content_video = '
<p>Mauris porttitor lacus vitae lectus aliquam eget aliquet tortor vehicula. Morbi semper malesuada rhoncus. Integer sodales est a lorem molestie dignissim. Morbi accumsan justo eget orci sodales suscipit.<!--more--> Proin scelerisque malesuada felis, vel bibendum odio euismod vel. Curabitur neque orci, porttitor nec semper at, porttitor id quam. Vestibulum vestibulum cursus lectus, eget imperdiet nibh porta et.</p>

<p>Fusce sit amet mi velit. Etiam ut mauris libero, ac dictum purus. Proin at massa vehicula nibh ornare placerat non eget elit. Nunc eget purus nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non commodo eros. Aliquam erat volutpat. Integer et dolor velit. Nam gravida iaculis imperdiet.</p>'; 




  	
// CREATE GALLERY-POST
$post_3 = array(
    'post_title' => 'Sample post - Gallery post format',
    'post_type' => 'post',
    'post_excerpt' => 'This is a post excerpt',
    'post_content' => $dummy_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$post_3_id = wp_insert_post( $post_3 );

set_post_format( $post_3_id , 'gallery');
			
// Upload images to the post
$filesrc_1 = 'http://epicthemes.net/misc/samples/images/sample-1.jpg'; // Image src
$upload = epic_sideload_image($filesrc_1, $post_3_id, "Sample"); // Upload the image

$filesrc_2 = 'http://epicthemes.net/misc/samples/images/sample-2.jpg'; // Image src
$upload = epic_sideload_image($filesrc_2, $post_3_id, "Sample"); // Upload the image

$filesrc_3 = 'http://epicthemes.net/misc/samples/images/sample-3.jpg'; // Image src
$upload = epic_sideload_image($filesrc_3, $post_3_id, "Sample"); // Upload the image

$filesrc_4 = 'http://epicthemes.net/misc/samples/images/sample-4.jpg'; // Image src
$upload = epic_sideload_image($filesrc_4, $post_3_id, "Sample"); // Upload the image

$filesrc_5 = 'http://epicthemes.net/misc/samples/images/sample-5.jpg'; // Image src
$upload = epic_sideload_image($filesrc_5, $post_3_id, "Sample"); // Upload the image

$filesrc_6 = 'http://epicthemes.net/misc/samples/images/sample-6.jpg'; // Image src
$upload = epic_sideload_image($filesrc_6, $post_3_id, "Sample"); // Upload the image 

update_post_meta($post_3_id,'epic_media_size','regular');

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/sample-3.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $post_3_id, "Sample"); // Upload the image
add_post_meta($post_3_id, '_thumbnail_id', $upload, true); // Set image as featured image

  	
// CREATE VIDEO-POST
$post_2 = array(
    'post_title' => 'Sample post - Video post format',
    'post_type' => 'post',
    'post_content' => $dummy_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$post_2_id = wp_insert_post( $post_2 );

set_post_format( $post_2_id , 'video');

update_post_meta($post_2_id,'epic_media_size','regular');
update_post_meta($post_2_id,'epic_video_host','self');
update_post_meta($post_2_id,'epic_video_preview','http://www.jplayer.org/video/poster/Big_Buck_Bunny_Trailer_480x270.png');
update_post_meta($post_2_id,'epic_video_url_m4v','http://www.jplayer.org/video/m4v/Big_Buck_Bunny_Trailer.m4v');
update_post_meta($post_2_id,'epic_video_url_ogv','http://www.jplayer.org/video/ogv/Big_Buck_Bunny_Trailer.ogv');
update_post_meta($post_2_id,'epic_video_url_webmv','http://www.jplayer.org/video/webm/Big_Buck_Bunny_Trailer.webm');
update_post_meta($post_2_id,'epic_video_width','640');
update_post_meta($post_2_id,'epic_video_height','410');

update_post_meta($post_2_id,'epic_selectsidebar','Default Sidebar');
			
// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/sample-2.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $post_2_id, "Sample"); // Upload the image
add_post_meta($post_2_id, '_thumbnail_id', $upload, true); // Set image as featured image



// CREATE IMAGE-POST
$post_1 = array(
    'post_title' => 'Sample post - Image post format',
    'post_type' => 'post',
    'post_content' => $dummy_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$post_1_id = wp_insert_post( $post_1 );

update_post_meta($post_1_id,'epic_media_size','regular');
			
// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/sample-1.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $post_1_id, "Sample"); // Upload the image
add_post_meta($post_1_id, '_thumbnail_id', $upload, true); // Set image as featured image
set_post_format( $post_1_id , 'image');


	
?>