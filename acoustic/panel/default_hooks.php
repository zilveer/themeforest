<?php
	add_action( 'after_setup_theme', 'ci_register_default_hooks' );

	if ( ! function_exists( 'ci_register_default_hooks' ) ):
	function ci_register_default_hooks() {
		/*
		 * Back-end
		 */
		// Make custom image sizes, selectable in the media manager.
		add_filter( 'image_size_names_choose', 'ci_make_custom_image_sizes_selectable' );

		// Check for updates. Intercept theme update data before they are written into a transient.
		add_action('pre_set_site_transient_update_themes', 'ci_theme_update_check_admin_handler');

		// Automatic thumbnails for video posts. They don't do anything if
		// there is nothing returned by 'ci_automatic_video_thumbnail_field' filter.
		add_action( 'save_post', 'ci_save_video_thumbnail', 10, 1 );
		add_action( 'wp_insert_post', 'ci_save_video_thumbnail');

		// Ajax update of featured galleries.
		add_action('wp_ajax_ci_featgal_AJAXPreview', 'ci_featgal_AJAXPreview');

		/*
		 * Front-end
		 */
		// Add theme-related classes in the body tag.
		add_filter('body_class','ci_body_class_names');

		// Wraps post counts in span.ci-count
		// Needed for the default widgets, however more appropriate filters don't exist.
		add_filter( 'get_archives_link', 'ci_theme_wrap_archive_widget_post_counts_in_span', 10, 2 );
		add_filter( 'wp_list_categories', 'ci_theme_wrap_category_widget_post_counts_in_span', 10, 2 );

		// Prints a meta generator tag specifying the theme name.
		add_action( 'get_the_generator_html', 'ci_generator_tag', 10, 2 );
		add_action( 'get_the_generator_xhtml', 'ci_generator_tag', 10, 2 );

		// Prints the inline JS scripts that are registered for printing, and removes them from the queue.
		add_action('admin_footer', 'ci_print_inline_js');
		add_action('wp_footer', 'ci_print_inline_js');

	}
	endif;

	if ( ! function_exists( 'ci_theme_wrap_archive_widget_post_counts_in_span' ) ):
	function ci_theme_wrap_archive_widget_post_counts_in_span( $output ) {
		$output = preg_replace_callback( '#(<li>.*?<a.*?>.*?</a>.*&nbsp;)(\(.*?\))(.*?</li>)#', 'ci_theme_replace_archive_widget_post_counts_in_span', $output );

		return $output;
	}
	endif;

	if ( ! function_exists( 'ci_theme_replace_archive_widget_post_counts_in_span' ) ):
	function ci_theme_replace_archive_widget_post_counts_in_span( $matches ) {
		return sprintf( '%s<span class="ci-count">%s</span>%s',
			$matches[1],
			$matches[2],
			$matches[3]
		);
	}
	endif;


	if ( ! function_exists( 'ci_theme_wrap_category_widget_post_counts_in_span' ) ):
	function ci_theme_wrap_category_widget_post_counts_in_span( $output, $args ) {
		if ( ! isset( $args['show_count'] ) || $args['show_count'] == 0 ) {
			return $output;
		}
		$output = preg_replace_callback( '#(<a.*?>\s*)(\(.*?\))#', 'ci_theme_replace_category_widget_post_counts_in_span', $output );

		return $output;
	}
	endif;

	if ( ! function_exists( 'ci_theme_replace_category_widget_post_counts_in_span' ) ):
	function ci_theme_replace_category_widget_post_counts_in_span( $matches ) {
		return sprintf( '%s<span class="ci-count">%s</span>',
			$matches[1],
			$matches[2]
		);
	}
	endif;
