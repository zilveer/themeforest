<?php


// WP Native Scripts
wp_enqueue_script('jquery');
wp_enqueue_script('common');
wp_enqueue_script( 'jquery-form' );
if( is_single() ) {
	wp_enqueue_script( 'comment' );
	wp_enqueue_script( 'comment-reply' );
}


// Support IE
if( is_ie() && is_ie() <= 8 ) {
	wp_enqueue_script('html5', THEME_URI . '/js/html5.js', null, THEME_VERSION, false );
	wp_enqueue_script('respond', THEME_URI . '/js/respond.min.js', false, THEME_VERSION, false );
}

// Form
wp_enqueue_script('form-meta', THEME_URI . '/js/jquery.metadata.js', false, THEME_VERSION, true );
wp_enqueue_script('validate', THEME_URI . '/js/jquery.validate.min.js', false, THEME_VERSION, true );

// Responsive Image
wp_enqueue_script('matchmedia', THEME_URI . '/js/matchMedia.js', false, THEME_VERSION, false );
wp_enqueue_script('picturefill', THEME_URI . '/js/picturefill.js', false, THEME_VERSION, false );

// Map
wp_enqueue_script('gmap-api', 'http://maps.google.com/maps/api/js?sensor=false', false, THEME_VERSION, true );
wp_enqueue_script('gmaps', THEME_URI . '/js/gmaps.js', false, THEME_VERSION, true );

// Fancybox
wp_enqueue_script('fancybox', THEME_URI . '/js/fancybox/jquery.fancybox-1.3.4.js', false, THEME_VERSION, true );

// ETC
wp_enqueue_script('tinynav', THEME_URI . '/js/tinynav.min.js', false, THEME_VERSION, true );
wp_enqueue_script('lettering', THEME_URI . '/js/jquery.lettering.min.js', false, THEME_VERSION, true );
wp_enqueue_script('isotop', THEME_URI . '/js/jquery.isotope.min.js', false, THEME_VERSION, true );
wp_enqueue_script('nt-masonry', THEME_URI . '/js/jquery.masonry.min.js', false, THEME_VERSION, true );
wp_enqueue_script('carousel', THEME_URI . '/js/carousel.js', false, THEME_VERSION, true );
wp_enqueue_script('slides', THEME_URI . '/js/jquery.slides.min.js', false, THEME_VERSION, true );
wp_enqueue_script('fitvids', THEME_URI . '/js/jquery.fitvids.js', false, THEME_VERSION, true );
wp_enqueue_script('tweet', THEME_URI . '/js/jquery.tweet.min.js', false, THEME_VERSION, true );


// Customize Box
if( theme_options('advance', 'show_customize') == 'on' )
wp_enqueue_script('iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), THEME_VERSION, true );

// THEME
wp_enqueue_script('theme', THEME_URI . '/js/theme.js', false, THEME_VERSION, true );

?>