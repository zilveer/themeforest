<?php
add_theme_support('post-thumbnails', array(
    'post',
    'page',
    'slide',
    'event',
    'photo',
    'video',
    'audio',
	'artist',
	'mix'
));
add_post_type_support('page', 'excerpt');
set_post_thumbnail_size(50, 50, true);
/* Image resize for slides */
add_image_size('slider-large', 985, 430, true);
add_image_size('slider-small', 665, 350, true);
/* Image resize for blog */
add_image_size('blog-preview', 665, 250, true);
add_image_size('blog-home', 250, 200, true);
add_image_size('blog-home-half', 315, 160, true);
/* Image resize for photos */
add_image_size('photo-shortcode', 212, 140, true);
add_image_size('photo-style1', 235, 155, true);
add_image_size('photo-style2', 318, 210, true);
add_image_size('photo-gallery', 185, 185, true);
add_image_size('photo-widget', 87, 87, true);
add_image_size('photo-large', 950, 9999);
/* Image resize for events */
add_image_size('event-style1', 150, 200, true);
add_image_size('event-style2', 166, 166, true);
add_image_size('event-home', 315, 180, true);
add_image_size('event-cover-max', 320, 200, true);
add_image_size('event-single', 180, 240, true);
/* Image resize for audio */
add_image_size('audio-shortcode', 212, 212, true);
add_image_size('audio-style1', 235, 235, true);
add_image_size('audio-style2', 318, 318, true);
add_image_size('audio-single', 275, 275, true);
add_image_size('audio-widget', 97, 97, true);
/* Image resize for videos */
add_image_size('video-shortcode', 212, 140, true);
add_image_size('video-widgets', 270, 160, true);
add_image_size('video-style1', 235, 155, true);
add_image_size('video-style2', 318, 210, true);
/* Image resize for artists */
add_image_size('artist-single', 360, 238, true);
add_image_size('artist-style1', 235, 155, true);
add_image_size('artist-style2', 318, 210, true);
/* Image resize for mixes */
add_image_size('mix-page', 66, 66, true);
if ( ! isset( $content_width ) ) 
    $content_width = 1055;
add_theme_support( 'automatic-feed-links' )
?>