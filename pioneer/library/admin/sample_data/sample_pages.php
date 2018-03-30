<?php

/* Sample content text */
$sampletext_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed turpis nunc, dictum ac commodo eget, elementum non erat. Aenean mollis dapibus ante nec pellentesque. Quisque vitae malesuada justo. Suspendisse vestibulum nisl nec nibh molestie cursus. Sed sollicitudin dapibus purus at venenatis. Phasellus sagittis dapibus ultrices. Suspendisse potenti. Mauris augue nisi, posuere quis blandit a, blandit sit amet arcu. Ut sit amet turpis in metus tempus dignissim id eu risus. Cras et est ut dolor porta varius vel sed tortor.

Nullam tincidunt facilisis adipiscing. Praesent consectetur condimentum nunc id porta. Quisque sodales ligula vel leo dictum nec cursus nunc malesuada. Proin suscipit, lorem vel feugiat adipiscing, risus justo posuere lacus, malesuada pellentesque sem tellus at urna. Aliquam vestibulum, lectus ac suscipit elementum, dolor massa varius nisl, ut vehicula nunc dolor vitae ligula. Integer imperdiet eros ac libero rhoncus id rutrum mi sollicitudin. Praesent nibh massa, suscipit et posuere elementum, elementum ut eros. Sed scelerisque justo id nibh dapibus fringilla. Integer quis tincidunt lorem. Nullam aliquam neque sed odio euismod porta ut a nulla. Duis elementum purus vel magna lacinia eu varius metus malesuada. Aliquam erat volutpat. Phasellus eget metus ligula, ac varius sem. Integer tincidunt gravida orci interdum condimentum.';

$sampletext_excerpt = 'Duis elementum purus vel magna lacinia eu varius metus malesuada.';


/**
 * This file creates sample pages 
 *
 */

global $user_ID;






	




// CREATE USER PROFILE PAGE
			
$user_profile_content = '
Mauris porttitor lacus vitae lectus aliquam eget aliquet tortor vehicula. Morbi semper malesuada rhoncus. Integer sodales est a lorem molestie dignissim. Morbi accumsan justo eget orci sodales suscipit. Proin scelerisque malesuada felis, vel bibendum odio euismod vel. Curabitur neque orci, porttitor nec semper at, porttitor id quam. Vestibulum vestibulum cursus lectus, eget imperdiet nibh porta et. Fusce sit amet mi velit. Etiam ut mauris libero, ac dictum purus. Proin at massa vehicula nibh ornare placerat non eget elit. Nunc eget purus nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non commodo eros. Aliquam erat volutpat. Integer et dolor velit. Nam gravida iaculis imperdiet.';

$user_profile_page = array(
	'post_title' => 'My profile',
	'post_type' => 'page',
	'post_content' => $user_profile_content,
	'post_status' => 'publish',
	'post_author' => $user_ID
 );

$user_profile_page_id = wp_insert_post( $user_profile_page );
update_post_meta($user_profile_page_id, '_wp_page_template', 'template-user-profile.php');
update_option('epic_user_profile_page', $user_profile_page_id);




/* ========================================= */
/*	Create teaser-pages */
/* ========================================= */

// CREATE TEASER-PAGE 1
$teaser_1 = array(
    'post_title' => 'Great theme admin',
    'post_type' => 'page',
    'post_excerpt' => $sampletext_excerpt,
    'post_content' => $sampletext_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$teaser_1_id = wp_insert_post( $teaser_1);

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/cogwheel.png'; // Image src
$upload = epic_sideload_image($filesrc, $teaser_1_id, "Sample"); // Upload the image
add_post_meta($teaser_1_id, '_thumbnail_id', $upload, true); // Set image as featured image
set_post_format( $teaser_1_id , 'image');

// CREATE TEASER-PAGE 2
$teaser_2 = array(
    'post_title' => 'Great customization options',
    'post_type' => 'page',
    'post_excerpt' => $sampletext_excerpt,
    'post_content' => $sampletext_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$teaser_2_id = wp_insert_post( $teaser_2 );

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/paint.png'; // Image src
$upload = epic_sideload_image($filesrc, $teaser_2_id, "Sample"); // Upload the image
add_post_meta($teaser_2_id, '_thumbnail_id', $upload, true); // Set image as featured image
set_post_format( $teaser_2_id , 'image');




// CREATE TEASER-PAGE 3
$teaser_3 = array(
    'post_title' => 'Drag and drop',
    'post_type' => 'page',
    'post_excerpt' => $sampletext_excerpt,
    'post_content' => $sampletext_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$teaser_3_id = wp_insert_post( $teaser_3);

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/shuffle.png'; // Image src
$upload = epic_sideload_image($filesrc, $teaser_3_id, "Sample"); // Upload the image
add_post_meta($teaser_3_id, '_thumbnail_id', $upload, true); // Set image as featured image
set_post_format( $teaser_3_id , 'image');



// CREATE TEASER-PAGE 4
$teaser_4 = array(
    'post_title' => 'Unlimited sidebars',
    'post_type' => 'page',
    'post_excerpt' => $sampletext_excerpt,
    'post_content' => $sampletext_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);
$teaser_4_id = wp_insert_post( $teaser_4 );

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/sidebars.png'; // Image src
$upload = epic_sideload_image($filesrc, $teaser_4_id, "Sample"); // Upload the image
add_post_meta($teaser_4_id, '_thumbnail_id', $upload, true); // Set image as featured image
set_post_format( $teaser_4_id , 'image');



// CREATE TEASER-PAGE 5
$teaser_5 = array(
    'post_title' => 'Self-hosted video',
    'post_type' => 'page',
    'post_excerpt' => $sampletext_excerpt,
    'post_content' => $sampletext_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$teaser_5_id = wp_insert_post( $teaser_5 );

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/movie_film.png'; // Image src
$upload = epic_sideload_image($filesrc, $teaser_5_id, "Sample"); // Upload the image
add_post_meta($teaser_5_id, '_thumbnail_id', $upload, true); // Set image as featured image
set_post_format( $teaser_5_id , 'image');


// CREATE TEASER-PAGE 6
$teaser_5 = array(
    'post_title' => 'Update notifier',
    'post_type' => 'page',
    'post_excerpt' => $sampletext_excerpt,
    'post_content' => $sampletext_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$teaser_6_id = wp_insert_post( $teaser_6 );

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/clock.png'; // Image src
$upload = epic_sideload_image($filesrc, $teaser_6_id, "Sample"); // Upload the image
add_post_meta($teaser_6_id, '_thumbnail_id', $upload, true); // Set image as featured image
set_post_format( $teaser_6_id , 'image');



/* ========================================= */
/*	CREATE FEATURED-PAGES */
/* ========================================= */

// CREATE FEATURED-PAGE 1
$featured_1 = array(
    'post_title' => 'Featured page 1',
    'post_type' => 'page',
    'post_excerpt' => $sampletext_excerpt,
    'post_content' => $sampletext_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$featured_1_id = wp_insert_post( $featured_1);

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/sample-1.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $featured_1_id, "Sample"); // Upload the image
add_post_meta($featured_1_id, '_thumbnail_id', $upload, true); // Set image as featured image
set_post_format( $featured_1_id , 'image');


// CREATE FEATURED-PAGE 2
$featured_2 = array(
    'post_title' => 'Featured page 2',
    'post_type' => 'page',
    'post_excerpt' => $sampletext_excerpt,
    'post_content' => $sampletext_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$featured_2_id = wp_insert_post( $featured_2 );

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/sample-2.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $featured_2_id, "Sample"); // Upload the image
add_post_meta($featured_2_id, '_thumbnail_id', $upload, true); // Set image as featured image
set_post_format( $featured_2_id , 'image');



// CREATE FEATURED-PAGE 3
$featured_3 = array(
    'post_title' => 'Featured page 3',
    'post_type' => 'page',
    'post_excerpt' => $sampletext_excerpt,
    'post_content' => $sampletext_content,
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$featured_3_id = wp_insert_post( $featured_3 );

// Give the page a featured image
$filesrc = 'http://epicthemes.net/misc/samples/images/sample-3.jpg'; // Image src
$upload = epic_sideload_image($filesrc, $featured_3_id, "Sample"); // Upload the image
add_post_meta($featured_3_id, '_thumbnail_id', $upload, true); // Set image as featured image
set_post_format( $featured_3_id , 'image');




/* Create the home page 
============================================ */

$homepage = array(
    'post_title' => 'Home',
    'post_type' => 'page',
    'post_content' => '',
    'post_status' => 'publish',
    'post_author' => $user_ID
  	);

$homepage_id = wp_insert_post( $homepage );


/* Update page meta */

$pageorder = array('module-slider','module-teaser-1','module-featured-pages','module-teaser-pages','module-portfolio','module-blog');

update_post_meta($homepage_id, 'epic_pageorder', $pageorder); // Update page modules

	/* Update teaser-pages-module */
	update_post_meta($homepage_id,'epic_home_teasers_header','Teaser pages');
	update_post_meta($homepage_id,'epic_home_teasers_description','This is a module description');
	update_post_meta($homepage_id,'epic_home_teasers_pages', array($teaser_1_id, $teaser_2_id, $teaser_3_id, $teaser_4_id, $teaser_5_id, $teaser_6_id) );
	update_post_meta($homepage_id,'epic_home_teaserpages_style', 'light' );
	
	/* Update featured-pages-module */
	update_post_meta($homepage_id,'epic_home_featured_header','Teaser pages');
	update_post_meta($homepage_id,'epic_home_featured_description','This is a module description');
	update_post_meta($homepage_id,'epic_home_featured_pages', array($featured_1_id, $featured_2_id, $featured_3_id) );
	update_post_meta($homepage_id,'epic_home_featuredpages_style', 'light' );
	
	/* Update blog-module */
	update_post_meta($homepage_id,'epic_blogmodule_header','Teaser pages');
	update_post_meta($homepage_id,'epic_blogmodule_description','This is a module description');
	update_post_meta($homepage_id,'epic_blogmodule_categories', array() );
	update_post_meta($homepage_id,'epic_blogmodule_style', 'light' );
	update_post_meta($homepage_id,'epic_blogmodule_perpage', '6' );
	
	/* Update portfolio-module */
	update_post_meta($homepage_id,'epic_home_portfolio_header','Teaser pages');
	update_post_meta($homepage_id,'epic_home_portfolio_description','This is a module description');
	update_post_meta($homepage_id,'epic_home_portfolio_categories', array() );
	update_post_meta($homepage_id,'epic_home_portfolio_style', 'light' );


?>