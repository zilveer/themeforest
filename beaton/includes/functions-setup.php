<?php

/*** IMAGE
 ****************************************************************/
 
add_image_size('Bl1PhVd', 360, 300, true); // blog style 1 | photo | video 
add_image_size('Bl2Sng', 720, 430, true); // blog style 2 | single
add_image_size('AdMx', 360, 360, true); // audio | mix
add_image_size('Ev', 360, 490, true); // event
add_image_size('SldFull', 1300, 580, true); // slider full
add_image_size('SldLR', 750, 580, true); // slider box
add_image_size('WdLike', 364, 122, true); // widget like
add_image_size('full', 9999, 9999); // photo full
add_theme_support('post-thumbnails', array(
    'post',
    'slide',
    'event',
    'photo',
    'video',
    'audio',
	'artist',
	'mix',
    'product'
));

/*** OTHER
 ****************************************************************/
 
add_post_type_support('page', 'excerpt');

set_post_thumbnail_size(50, 50, true);

function wize_set_section($columns = 3) {
    apply_filters("debug", "setSection : " . $columns);
}

function wize_set_zone($width = 370) {
    apply_filters("debug", "setZone : " . $width);
}

$content_width = 1190;
if (!isset($content_width))
	
add_theme_support('automatic-feed-links');
add_theme_support('title-tag');