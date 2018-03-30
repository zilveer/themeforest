<?php

function wpgrade_callback_custom_theme_features() {
	add_theme_support('automatic-feed-links');

	//load editor-style.css if present in parent and/or child theme
	add_editor_style(array('theme-content/css/editor-style.css', 'editor-style.css'));
}

add_action('after_setup_theme', 'wpgrade_callback_custom_theme_features');


function wpgrade_custom_backgrounds_suport(){

	$background_args = array(
		'default-color'          => '1a1717',
		'wp-head-callback'       => '_custom_background_cb',
	);

	add_theme_support( 'custom-background', $background_args );
}

// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', 'wpgrade_custom_backgrounds_suport' );

//function wpgrade_callback_sort_query_by_post_in( $sortby, $thequery ) {
//	if ( !empty($thequery->query['post__in']) && isset($thequery->query['orderby']) && $thequery->query['orderby'] == 'post__in' )
//		$sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";
//
//	return $sortby;
//}
//add_filter( 'posts_orderby', 'wpgrade_callback_sort_query_by_post_in', 10, 2 );

function wpgrade_add_desktop_icons(){

	if ( wpgrade::image_src( 'favicon' ) ) {
		echo "<link rel='icon' href=\"".wpgrade::image_src( 'favicon' )."\" >\n";
	}

	if ( wpgrade::image_src( 'apple_touch_icon' ) ) {
		echo "<link rel=\"apple-touch-icon\" href=\"".wpgrade::image_src( 'apple_touch_icon' )."\" >\n";
	}

	if ( wpgrade::image_src( 'metro_icon' ) ) {
		echo "<meta name=\"msapplication-TileColor\" content=\"#f01d4f\">\n";
		echo "<meta name=\"msapplication-TileImage\" content=\"".wpgrade::image_src( 'metro_icon' )."\" >\n";
	}

}
add_action('wp_head', 'wpgrade_add_desktop_icons');


add_action('admin_head', 'wpgrade_add_admin_favicon');
function wpgrade_add_admin_favicon() {
	if ( wpgrade::image_src( 'favicon' ) ) {
		echo "<link rel='icon' href=\"" . wpgrade::image_src( 'favicon' ) . "\" >\n";
	}
}

function wpgrade_prepare_password_for_custom_post_types(){

	global $wpgrade_private_post;
	$wpgrade_private_post = bucket::is_password_protected();

}

add_action('wp', 'wpgrade_prepare_password_for_custom_post_types');

//Fix the URL Yoast uses when using our builder since it has no way of knowing it can be paginated
function wpgrade_callback_fix_yoast_canonical() {
	if ( is_page() && get_page_template_slug() == 'page-builder.php' ) {
		//fix the canonical url of YOAST because on the front page it ignores the pagination
		add_filter( 'wpseo_canonical', 'wpgrade_get_current_canonical_url' );
		//fix the canonical url of AIOSEOP because on the front page it breaks the pagination
		add_filter( 'aioseop_canonical_url', 'wpgrade_get_current_canonical_url' );
	}
}

add_action('wp', 'wpgrade_callback_fix_yoast_canonical');

// Add "Next page" button to TinyMCE
function add_next_page_button( $mce_buttons ) {
	$pos = array_search( 'wp_more', $mce_buttons, true );
	if ( $pos !== false ) {
		$tmp_buttons = array_slice( $mce_buttons, 0, $pos+1 );
		$tmp_buttons[] = 'wp_page';
		$mce_buttons = array_merge( $tmp_buttons, array_slice( $mce_buttons, $pos+1 ) );
	}
	return $mce_buttons;
}
add_filter( 'mce_buttons', 'add_next_page_button' );

// Customize the "wp_link_pages()" to be able to display both numbers and prev/next links
function add_next_and_number( $args ) {
	if ( $args['next_or_number'] == 'next_and_number' ) {
		global $page, $numpages, $multipage, $more, $pagenow;
		$args['next_or_number'] = 'number';
		$prev = '';
		$next = '';
		if ( $multipage and $more ) {
			$i = $page-1;
			if ( $i and $more ) {
				$prev .= _wp_link_page( $i );
				$prev .= $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
				$prev = apply_filters( 'wp_link_pages_link', $prev, 'prev' );
			}
			$i = $page+1;
			if ( $i <= $numpages and $more ) {
				$next .= _wp_link_page( $i );
				$next .= $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>';
				$next = apply_filters( 'wp_link_pages_link', $next, 'next' );
			}
		}
		$args['before'] = $args['before'] . $prev;
		$args['after'] = $next . $args['after'];
	}
	return $args;
}
add_filter( 'wp_link_pages_args', 'add_next_and_number' );


function wpgrade_register_attachments(){

	// add video support for attachments
	if ( !function_exists( 'add_video_url_field_to_attachments' ) ) {
		function add_video_url_field_to_attachments($form_fields, $post){
			if ( !isset($form_fields["video_url"]) ) {
				$form_fields["video_url"] = array(
					"label" => __("Video URL", 'pixtypes_txtd'),
					"input" => "text", // this is default if "input" is omitted
					"value" => esc_url( get_post_meta($post->ID, "_video_url", true) ),
					"helps" => __("<p>Here you can link a video.</p><small>Only YouTube or Vimeo!</small>", 'pixtypes_txtd'),
				);
			}
			return $form_fields;
		}
		add_filter("attachment_fields_to_edit", "add_video_url_field_to_attachments", 1, 2);
	}

	/**
	 * Save custom media metadata fields
	 *
	 * Be sure to validate your data before saving it
	 * http://codex.wordpress.org/Data_Validation
	 *
	 * @param $post The $post data for the attachment
	 * @param $attachment The $attachment part of the form $_POST ($_POST[attachments][postID])
	 * @return $post
	 */

	if ( !function_exists( 'add_image_attachment_fields_to_save' ) ) {
		add_filter("attachment_fields_to_save", "add_image_attachment_fields_to_save", 9999 , 2);
		function add_image_attachment_fields_to_save( $post, $attachment ) {
			if ( isset( $attachment['video_url'] ) )
				update_post_meta( $post['ID'], '_video_url', esc_url($attachment['video_url']) );

			return $post;
		}
	}
}

add_action('init', 'wpgrade_register_attachments');
