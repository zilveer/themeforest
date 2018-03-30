<?php
if (!defined('ABSPATH')) exit();
/**
 * Template Name: PayPal Failed
 */

get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();

		get_template_part('content', 'header');
		the_content();
		tmm_link_pages();

		if (isset($_GET['errorcode']) && isset($_GET['errorcode']) == 10444) {
	        echo '<strong color="red">' . __('Payment failed! Please check transaction details in your paypal account in history section and make sure you have an appropriate currency in your account.', 'cardealer') . '</strong>';
	    }

		tmm_layout_content(get_the_ID());

    endwhile;
endif;

get_footer();