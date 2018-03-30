<?php
/**
 * @template name: Contact form
 * @package        WordPress
 * @subpackage     Website
 * @since          1.0
 */

add_filter('the_content', function($content) {
	return $content.Website::getContactForm('template');
});

get_template_part('index', 'contact-form');