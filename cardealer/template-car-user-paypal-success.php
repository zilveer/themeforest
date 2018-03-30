<?php
if (!defined('ABSPATH')) exit();
/**
 * Template Name: PayPal Success
 */

get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();

		get_template_part('content', 'header');
        the_content();
		tmm_link_pages();
		tmm_layout_content(get_the_ID());

    endwhile;
endif;

get_footer();