<?php
/**
 * Vamtam Post Format Options
 *
 * @package wpv
 * @subpackage health-center
 */

return array(

array(
	'name' => __('Standard', 'health-center'),
	'type' => 'separator',
	'tab_class' => 'wpv-post-format-0',
),

array(
	'name' => __('How do I use standard post format?', 'health-center'),
	'desc' => __('Just use the editor below.', 'health-center'),
	'type' => 'info',
	'visible' => true,
),

// --

array(
	'name' => __('Aside', 'health-center'),
	'type' => 'separator',
	'tab_class' => 'wpv-post-format-aside',
),

array(
	'name' => __('How do I use aside post format?', 'health-center'),
	'desc' => __('Just use the editor below. The post title will not be shown publicly.', 'health-center'),
	'type' => 'info',
	'visible' => true,
),

// --

array(
	'name' => __('Link', 'health-center'),
	'type' => 'separator',
	'tab_class' => 'wpv-post-format-link',
),

array(
	'name' => __('How do I use link post format?', 'health-center'),
	'desc' => __('Use the editor below for the post body, put the link in the option below.', 'health-center'),
	'type' => 'info',
	'visible' => true,
),

array(
	'name' => __('Link', 'health-center'),
	'id' => 'wpv-post-format-link',
	'type' => 'text',
),

// --

array(
	'name' => __('Image', 'health-center'),
	'type' => 'separator',
	'tab_class' => 'wpv-post-format-image',
),

array(
	'name' => __('How do I use image post format?', 'health-center'),
	'desc' => __('Use the standard Featured Image option.', 'health-center'),
	'type' => 'info',
	'visible' => true,
),

// --

array(
	'name' => __('Video', 'health-center'),
	'type' => 'separator',
	'tab_class' => 'wpv-post-format-video',
),

array(
	'name' => __('How do I use video post format?', 'health-center'),
	'desc' => __('Put the url of the video below. You must use an oEmbed provider supported by WordPress or a file supported by the [video] shortcode which comes with WordPress.', 'health-center'),
	'type' => 'info',
	'visible' => true,
),

array(
	'name' => __('Link', 'health-center'),
	'id' => 'wpv-post-format-video-link',
	'type' => 'text',
),

// --

array(
	'name' => __('Audio', 'health-center'),
	'type' => 'separator',
	'tab_class' => 'wpv-post-format-audio',
),

array(
	'name' => __('How do I use auido post format?', 'health-center'),
	'desc' => __('Put the url of the audio below. You must use an oEmbed provider supported by WordPress or a file supported by the [audio] shortcode which comes with WordPress.', 'health-center'),
	'type' => 'info',
	'visible' => true,
),

array(
	'name' => __('Link', 'health-center'),
	'id' => 'wpv-post-format-audio-link',
	'type' => 'text',
),

// --

array(
	'name' => __('Quote', 'health-center'),
	'type' => 'separator',
	'tab_class' => 'wpv-post-format-quote',
),

array(
	'name' => __('How do I use quote post format?', 'health-center'),
	'desc' => __('Simply fill in author and link fields', 'health-center'),
	'type' => 'info',
	'visible' => true,
),

array(
	'name' => __('Author', 'health-center'),
	'id' => 'wpv-post-format-quote-author',
	'type' => 'text',
),

array(
	'name' => __('Link', 'health-center'),
	'id' => 'wpv-post-format-quote-link',
	'type' => 'text',
),

// --

array(
	'name' => __('Gallery', 'health-center'),
	'type' => 'separator',
	'tab_class' => 'wpv-post-format-gallery',
),

array(
	'name' => __('How do I use gallery post format?', 'health-center'),
	'desc' => __('Use the "Add Media" in a text/image block element to create a gallery.This button is also found in the top left side of the visual and text editors.', 'health-center'),
	'type' => 'info',
	'visible' => true,
),

// --

array(
	'name' => __('Status', 'health-center'),
	'type' => 'separator',
	'tab_class' => 'wpv-post-format-status',
),

array(
	'name' => __('How do I use this post format?', 'health-center'),
	'desc' => __('...', 'health-center'),
	'type' => 'info',
	'visible' => true,
),

);
