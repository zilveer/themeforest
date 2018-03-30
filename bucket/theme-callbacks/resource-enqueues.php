<?php

	/**
	 * Invoked in wpgrade-config.php
	 */
	function wpgrade_callback_contact_script() {
		if (is_page_template('template-contact.php')) {
			wp_enqueue_script('contact-scripts');
		}
	}

	/**
	 * Invoked in wpgrade-config.php
	 */
	function wpgrade_callback_thread_comments_scripts() {
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
