<?php
add_theme_support('post-thumbnails', array(
    'post',
    'page',
    'slide',
    'event',
    'photo',
    'video',
    'audio'
));
add_post_type_support('page', 'excerpt');
set_post_thumbnail_size(50, 50, true);
add_action('init', 'loadSetupReference');
/* Image resize for slides */
add_image_size('slider-full', 980, 400, true);
/* Image resize for blog */
add_image_size('blog-preview', 630, 200, true);
add_image_size('blog-home', 220, 166, true);
/* Image resize for photos */
add_image_size('photo-home', 200, 130, true);
add_image_size('photo-archive', 226, 140, true);
add_image_size('photo-gallery', 178, 178, true);
add_image_size('photo-widget', 80, 80, true);
add_image_size('photo-large', 950, 9999);
/* Image resize for events */
add_image_size('event-home', 315, 180, true);
add_image_size('event-cover-max', 320, 200, true);
add_image_size('event-cover-arc', 166, 166, true);
/* Image resize for audio */
add_image_size('audio-home', 200, 200, true);
add_image_size('audio-archive', 226, 226, true);
add_image_size('audio-single', 240, 240, true);
add_image_size('audio-widget', 103, 103, true);
/* Image resize for videos */
add_image_size('video-home', 200, 130, true);
add_image_size('video-widgets', 270, 160, true);
add_image_size('video-archive', 226, 140, true);
function loadSetupReference() {
    if (is_admin()) {
        wp_enqueue_style('setup', get_template_directory_uri() . '/admin/post/css/options-panel.css');
        wp_enqueue_style('datepicker', get_template_directory_uri() . '/admin/post/css/datepicker.css');
        wp_enqueue_script('setup-js', get_template_directory_uri() . '/admin/post/js/setup.js');
        wp_enqueue_script('ui-custom-js', get_template_directory_uri() . '/admin/post/js/ui-custom.js');
		wp_enqueue_script('upload', get_template_directory_uri() . '/admin/post/js/upload.js');
        wp_enqueue_script('datepicker-js', get_template_directory_uri() . '/admin/post/js/datepicker.js');
    } else {

        wp_enqueue_script('jquery');

        wp_enqueue_script('cycle', get_template_directory_uri() . '/js/cycle.js', array(
            'jquery'
        ));
		$autoplay = of_get_option('audio_auto');
		switch ($autoplay ) {
		case "off_play":
        wp_enqueue_script('audio', get_template_directory_uri() . '/js/audio.js', array(
            'jquery'
        ));
		}
		switch ($autoplay ) {
		case "on_play":
        wp_enqueue_script('audioauto', get_template_directory_uri() . '/js/audioauto.js', array(
            'jquery'
        ));
		}
        wp_enqueue_script('mosaic', get_template_directory_uri() . '/js/mosaic.js', array(
            'jquery'
        ));
        wp_enqueue_script('prettyPhoto', get_template_directory_uri() . '/js/p.prettyPhoto.js', array(
            'jquery'
        ));
        wp_enqueue_script('backstretch', get_template_directory_uri() . '/js/backstretch.js', array(
            'jquery'
        ));
        wp_enqueue_script('gmap', get_template_directory_uri() . '/js/gmap.js', array(
            'jquery'
        ));
        wp_enqueue_script('idTabs', get_template_directory_uri() . '/js/idTabs.js', array(
            'jquery'
        ));

        wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array(
            'jquery'
        ));
        $style_type = of_get_option('style_pred');	
		switch ($style_type ) {
		case "dark_style":
        wp_enqueue_script('dark', get_template_directory_uri() . '/js/dark.js', array(
            'jquery'
        ));	
        }
		switch ($style_type ) {
		case "light_style":
        wp_enqueue_script('light', get_template_directory_uri() . '/js/light.js', array(
            'jquery'
        ));	
        }		
        wp_enqueue_script('map', 'http://maps.googleapis.com/maps/api/js?sensor=false', array(
            'jquery'
        ));		
        wp_enqueue_style('prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');
        wp_enqueue_style('shortcodes', get_template_directory_uri() . '/css/shortcodes.css');
		if (of_get_option('active_resp', '1') == '1') {
		wp_enqueue_style('responsive', get_template_directory_uri() . '/css/responsive.css');
		}
    }
}
?>