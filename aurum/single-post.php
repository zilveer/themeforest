<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if(comments_open())
	wp_enqueue_script('comment-reply');

# Nivo Lightbox
wp_enqueue_script('nivo-lightbox');
wp_enqueue_style('nivo-lightbox-default');

# Owl Carousel
wp_enqueue_script('owl-carousel');
wp_enqueue_style('owl-carousel');

get_template_part('archive');