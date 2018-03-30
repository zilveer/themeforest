<?php
/**
 * Mental Theme Miscellaneous
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

// Revrite prev and next links
add_filter( 'next_post_link', 'mental_next_post_link' );
function mental_next_post_link( $output )
{
	$code = 'class="ft-next-post"';

	return str_replace( '<a href=', '<a ' . $code . ' href=', $output );
}

add_filter( 'previous_post_link', 'mental_previous_post_link' );
function mental_previous_post_link( $output )
{
	$code = 'class="ft-prev-post"';

	return str_replace( '<a href=', '<a ' . $code . ' href=', $output );
}

// Hide parent selector in gallery filters page
add_action( 'admin_head', 'mental_admin_styles' );
function mental_admin_styles()
{
	echo '<style type="text/css">
           .taxonomy-gallery_filter [for="parent"]{display: none;}
           .taxonomy-gallery_filter #parent{display: none;}
         </style>';
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter( $var )
{
	return is_array( $var ) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
add_filter( 'the_category', 'remove_category_rel_from_category_list' );
function remove_category_rel_from_category_list( $thelist )
{
	return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

// Add page slug to body class
add_filter( 'body_class', 'add_slug_to_body_class' );
function add_slug_to_body_class( $classes )
{
	global $post;
	if ( is_home() ) {
		$key = array_search( 'blog', $classes );
		if ( $key > - 1 ) {
			unset( $classes[ $key ] );
		}
	} elseif ( is_page() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif ( is_singular() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	}

	return $classes;
}

// Remove wp_head() injected Recent Comment styles
add_action( 'widgets_init', 'my_remove_recent_comments_style' );
function my_remove_recent_comments_style()
{
	global $wp_widget_factory;
	remove_action( 'wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	) );
}

// Custom View Article link to Post
add_filter( 'excerpt_more', 'mental_view_article' );
function mental_view_article( $more )
{
	global $post;
	//   return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'mental') . '</a>';
	return '...';
}

// Remove 'text/css' from our enqueued stylesheet
add_filter( 'style_loader_tag', 'mental_style_remove' );
function mental_style_remove( $tag )
{
	return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to thumbnails
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 ); // Remove width and height dynamic attributes to post images
add_filter( 'wp_get_attachment_link', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html )
{
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );

	return $html;
}

// Custom Gravatar in Settings > Discussion
add_filter( 'avatar_defaults', 'mentalgravatar' );
function mentalgravatar( $avatar_defaults )
{
	$myavatar                     = get_template_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[ $myavatar ] = "Custom Gravatar";

	return $avatar_defaults;
}

// Threaded Comments
add_action( 'get_header', 'enable_threaded_comments' );
function enable_threaded_comments()
{
	if ( ! is_admin() ) {
		if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

// Responsive wrapper for embed video
add_filter( 'embed_oembed_html', 'azl_embed_oembed_html', 99, 4 );
function azl_embed_oembed_html( $html, $url, $attr, $post_id )
{
	return '<div class="responsive-embed">' . $html . '</div>';
}

// Custom content more link
add_filter( 'the_content_more_link', 'mental_content_more_link' );
function mental_content_more_link()
{
	global $post;
	return '<a class="more-link" href="' . get_permalink() . '">Read more ...</a>';
}

/**
 * Removes the width and height attributes of <img> tags for SVG
 *
 * Without this filter, the width and height are set to "1" since
 * WordPress core can't seem to figure out an SVG file's dimensions.
 *
 * For SVG:s, returns an array with file url, width and height set
 * to null, and false for 'is_intermediate'.
 *
 * @wp-hook image_downsize
 * @param mixed $out Value to be filtered
 * @param int $id Attachment ID for image.
 * @return bool|array False if not in admin or not SVG. Array otherwise.
 */
add_filter( 'image_downsize', 'mental_fix_svg_size_attributes', 10, 2 );
function mental_fix_svg_size_attributes( $out, $id )
{
	$image_url  = wp_get_attachment_url( $id );
	$file_ext   = pathinfo( $image_url, PATHINFO_EXTENSION );

	if ( ! is_admin() || 'svg' !== $file_ext )
	{
		return false;
	}

	return array( $image_url, null, null, false );
}

/**
 * Custom Read more link
 */
add_filter( 'the_content_more_link', 'mental_read_more_link' );
function mental_read_more_link() {
	return '<a href="'.get_permalink().'" class="btn btn-default blog-readmore">'.__( 'Read more', 'mental' ).'</a>';
}

/**
 * Jetpack support
 */
if ( defined( 'JETPACK__VERSION' ) ) {

	// Remove Jetpacks *_embed_to_shortcode filters,
	// it breaks wp_kses escaping with vimeo iframe
	remove_filter( 'pre_kses', 'vimeo_embed_to_shortcode' );
	remove_filter( 'pre_kses', 'youtube_embed_to_short_code' );
	remove_filter( 'pre_kses', 'jetpack_soundcloud_embed_reversal' );

	// Add responsive container
	add_filter( 'video_embed_html', 'azl_video_embed_html' );
	function azl_video_embed_html( $html )
	{
		return '<div class="responsive-embed">' . $html . '</div>';
	}

}

/*
 * Allow shortcodes in widgets and excerpts
 */
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)


