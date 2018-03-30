<?php

// All scripts to be enqueued
function tb_enqueue() {

	global $post;
	$postTemplate = get_post_meta($post->ID, '_wp_page_template', true);

	if (!is_admin()) {
		
		// this script will be updated only if Twitter ID is set
		if (get_option('tb_twitter_id')) {
			wp_register_script('twitter', TEMPLATE_DIRECTORY . '/js/twitter.js');
			wp_enqueue_script('twitter');
		}
		
		
		wp_register_script('prettyPhoto', TEMPLATE_DIRECTORY . '/js/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'), '3.1.6', false);
		wp_enqueue_script('prettyPhoto');
		wp_register_style('prettyPhotoStyle', TEMPLATE_DIRECTORY . '/js/prettyPhoto/css/prettyPhoto.css');
		wp_enqueue_style('prettyPhotoStyle');
	
		wp_register_script('slides', TEMPLATE_DIRECTORY . '/js/slides.min.jquery.js', array('jquery'), '1.1.9', false);
		wp_enqueue_script('slides');
		
		wp_register_script('easing', TEMPLATE_DIRECTORY . '/js/jquery.easing.1.3.js', array('jquery'), '1.3', false);
		wp_enqueue_script('easing');
		
		if ($postTemplate == 'page-the-issues.php') {		
			wp_register_script('accordion2', TEMPLATE_DIRECTORY . '/js/jquery.elegantAccordion.js', array('jquery'), '0.3', false);
			wp_enqueue_script('accordion2');
		}
		
		if ($postTemplate == 'page-landing.php') {		
			wp_register_script('countdown', TEMPLATE_DIRECTORY . '/js/jquery.countdown.min.js', array('jquery'), '0.3', false);
			wp_enqueue_script('countdown');		
		}

		wp_register_script('uniform', TEMPLATE_DIRECTORY . '/js/jquery.uniform.min.js', array('jquery'), '1.1', false);
		wp_enqueue_script('uniform');
		wp_register_script('tbUniform', TEMPLATE_DIRECTORY . '/js/tbUniform.js', array('jquery'), '1.1', false);
		wp_enqueue_script('tbUniform');

		
		wp_register_script('themeblossom', TEMPLATE_DIRECTORY . '/js/themeblossom.js', array('jquery'), '1.0', false);
		wp_enqueue_script('themeblossom');
		
	}
}

add_action('wp_enqueue_scripts', 'tb_enqueue');

?>