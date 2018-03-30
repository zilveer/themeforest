<?php
/**
 * Mental Theme Functions
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/**
 * General page description for meta tag
 *
 * @return mixed|string
 */
function get_mental_seo_description()
{
	global $post;
	if ( is_home() || is_front_page() ) {
		return get_bloginfo( 'description' );
	}

	if ( ! empty( $post->post_excerpt ) ) {
		$meta = $post->post_excerpt;
	} elseif ( ! empty( $post->post_content ) ) {
		$meta = $post->post_content;
	} else {
		$meta = get_bloginfo( 'description' );
	}
	$meta = strip_tags( $meta );
	$meta = strip_shortcodes( $meta );
	$meta = str_replace( array( "\n", "\r", "\t" ), ' ', $meta );
	$meta = preg_replace( '/&#?[a-z0-9]{2,8};/i', '', $meta ); // Remove codes like: &nbsp; &amp; &copy;          1                           2      3
	$meta = preg_replace( '/[a-zA-Z]*[:\/\/]*[A-Za-z0-9\-_]+\.+[A-Za-z0-9\.\/%&=\?\-_]+/i', '', $meta ); // Remove links

	if ( strlen( $meta ) > 150 ) {
		$ellipsis = '...';
	} else {
		$ellipsis = '';
	}
	$meta = substr( $meta, 0, 150 );

	$meta = trim( $meta ) . $ellipsis;

	return $meta;
}


/**
 * Mental Pagination
 */
function the_mental_pagination()
{
	global $wp_query;
	$big   = 999999999; // need an unlikely integer
	$pages = paginate_links( array(
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $wp_query->max_num_pages,
		'prev_next' => false,
		'type'      => 'array',
		'prev_next' => true,
		'prev_text' => __( '&#171;', 'mental' ),
		'next_text' => __( '&#187;', 'mental' ),
	) );
	if ( is_array( $pages ) ) {
		//$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
		echo '<ul class="pagination">';
		foreach ( $pages as $page ) {
			echo "<li" . ( strstr( $page, 'current' ) ? ' class="active"' : '' ) . ">$page</li>";
		}
		echo '</ul>';
	}
}


/**
 * Mental Excerpt
 *
 * @param string $length_callback
 * @param string $more_callback
 *
 * @return mixed|string|void
 */
function get_mental_excerpt( $length_callback = '', $more_callback = '' )
{
	if ( function_exists( $length_callback ) ) {
		add_filter( 'excerpt_length', $length_callback );
	}
	if ( function_exists( $more_callback ) ) {
		add_filter( 'excerpt_more', $more_callback );
	}
	$output = get_the_excerpt();
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );

	return $output;
}

function mental_excerpt_length_20() { return 20; }

function mental_excerpt_length_10() { return 10; }

function mental_excerpt_length_5() { return 5; }

function the_mental_excerpt( $length_callback = '', $more_callback = '' )
{
	echo get_mental_excerpt( $length_callback, $more_callback );
}


/**
 * Custom exerpt for audio format posts with [audio] shortcodes
 */
function the_mental_audio_excerpt( $class = 'wp-audio-shortcode' )
{
	$content = get_the_content();

	preg_match_all( '/(\[audio.*?\])/is', $content, $matches );

	$result = do_shortcode( implode( ' ', $matches[0] ) );

	echo str_replace( 'wp-audio-shortcode', $class, $result );

}

/**
 * Custom exerpt for audio format posts with [playlist] shortcodes
 */
function the_mental_playlist_excerpt( $class = 'wp-playlist' )
{
	$content = get_the_content();
	preg_match_all( '/(\[playlist.*?\])/is', $content, $matches );
	$result = do_shortcode( implode( ' ', $matches[0] ) );
	echo str_replace( 'wp-playlist ', $class . ' ', $result );

}

/**
 * Removes gallery shortcode from content
 *
 * @param $content
 *
 * @return mixed
 */
function strip_shortcode_gallery( $content )
{
	preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
	if ( ! empty( $matches ) ) {
		foreach ( $matches as $shortcode ) {
			if ( 'gallery' === $shortcode[2] ) {
				$pos = strpos( $content, $shortcode[0] );
				if ( $pos !== false ) {
					return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
				}
			}
		}
	}

	return $content;
}

/**
 * Searches for video embeds in content and returns first occurrence
 *
 * @param $content
 * @param string $class class to replace 'wp-video-shortcode'
 *
 * @return bool|mixed
 */
function get_post_video( $content, $class = 'wp-video-shortcode' )
{
	if ( isset( $GLOBALS['wp_embed'] ) ) {
		$content = $GLOBALS['wp_embed']->autoembed( $content );
	}
	preg_match_all( '/(\<iframe.*\<\/iframe\>)/is', $content, $matches );
	if ( isset( $matches[0][0] ) ) {
		return $matches[0][0];
	}

	preg_match_all( '/(\[video.*\[\/video\])/is', $content, $matches );
	if ( isset( $matches[0][0] ) ) {
		return str_replace( 'wp-video-shortcode', $class, do_shortcode( $matches[0][0] ) );
	}

	return false;
}

/**
 * Removes embeds and video shortcode from content
 *
 * @param $content
 *
 * @return mixed
 */
function strip_embed_content( $content )
{
	$content = preg_replace( '|^\s*(https?://[^\s"]+)\s*$|im', '', $content );
	$content = preg_replace( '/(\<iframe.*\<\/iframe\>)/is', '', $content );
	$content = preg_replace( '/(\[video.*\[\/video\])/is', '', $content );

	return $content;
}

/**
 * Removes audio shortcodes from content
 *
 * @param $content
 *
 * @return mixed
 */
function azl_strip_audio_shortcodes( $content )
{
	$content = preg_replace( '/(\[audio.*?\])/is', '', $content );
	$content = preg_replace( '/(\[playlist.*?\])/is', '', $content );

	return $content;
}

/**
 * Searches for image in content and return first occurrence
 *
 * @return string
 */
function get_first_image_url($content) {
	preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
	$first_img = isset($matches[1][0]) ? $matches[1][0] : '';
	return $first_img;
}

/**
 * Get posts before and after current post (including current post)
 *
 * @param string $post_type
 * @param string $category
 * @param int $count count posts before and after current
 *
 * @return array
 */
function mental_get_posts_around( $post_type = 'gallery', $category = '', $count = 5 )
{
	// Can work with or ID or Slug
	if ( intval( $category ) ) {
		$tax_field = "term_id";
	} else {
		$tax_field = "slug";
	}

	if ( ! empty( $category ) ) {
		$tax_query = array(
			array(
				'taxonomy' => 'gallery_category',
				'terms'    => $category,
				'field'    => $tax_field,
			)
		);
	} else {
		$tax_query = '';
	}

	// Add before/afret posts WHERE condition
	add_filter( 'posts_where', 'filter_where_before_after' );

	$GLOBALS['before_after'] = 'before';
	$posts_before            = new WP_Query( array(
		'post_type'      => $post_type,
		'tax_query'      => $tax_query,
		'posts_per_page' => $count,
		'paged'          => 0,
		'meta_query'     => array(
			array(
				'key'     => '_thumbnail_id',
				'compare' => 'EXISTS'
			),
		)
	) );
	$posts_before_arr        = $posts_before->get_posts();

	$GLOBALS['before_after'] = 'after';
	$posts_after             = new WP_Query( array(
		'post_type'      => $post_type,
		'tax_query'      => $tax_query,
		'posts_per_page' => $count,
		'paged'          => 0,
		'order'          => 'ASC',
		'meta_query'     => array(
			array(
				'key'     => '_thumbnail_id',
				'compare' => 'EXISTS'
			),
		)
	) );
	$posts_after_arr         = $posts_after->get_posts();
	$posts_after_arr         = array_reverse( $posts_after_arr );

	// Remove before/afret posts WHERE condition
	remove_filter( 'posts_where', 'filter_where_before_after' );

	$current_post = get_post();
	$current_post->current_post = true;

	$posts = array_merge( $posts_after_arr, array( $current_post ), $posts_before_arr );

	return $posts;
}

/**
 * Function to alter WHERE contitions in DB query,
 * for pulling posts after or before current post
 *
 * @param string $where
 *
 * @return string
 */
function filter_where_before_after( $where = '' )
{
	global $post, $before_after, $wpdb;
	$where .= " AND " . $wpdb->prefix . "posts.post_date ";
	$where .= ( $before_after == 'before' ) ? "< '$post->post_date'" : "> '$post->post_date'";

	return $where;
}

/**
 * Get slides before and after current post (including current post)
 *
 * @param string $post_type
 * @param string $category
 * @param int $count count posts before and after current
 *
 * @return array
 */
function mental_get_slides_around($post_type = 'gallery', $category = '', $count = 5)
{
	$slides_posts = mental_get_posts_around($post_type, $category, $count);

	$slides = array();
	foreach ( $slides_posts as $post ) {
		$slide = array();
		$slide['title'] = isset( $post->post_title ) ? $post->post_title : '';
		$slide['description'] = wp_trim_excerpt($post->post_excerpt);

		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
		$slide['image_large'] = $large_image_url[0];
		if ( get_post_format($post) == 'video' ){
			$slide['embed'] = get_post_video( $post->post_content );
		}
		$slide['current_post'] = empty($post->current_post) ? false : true;

		$slides[] = $slide;
	}

	return $slides;
}

/**
 * This function searches through post content for
 * any media data for slider (images, videos)
 *
 * @param null $post
 *
 * @return array
 */
function mental_get_post_slides( $post = null )
{
	if ( ! $post = get_post( $post ) )
		return false;

	$content = $post->post_content;

	if ( isset( $GLOBALS['wp_embed'] ) ) {
		$content = $GLOBALS['wp_embed']->autoembed( $content );
	}

	$slides = array();

	// Add post featured image
	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id ($post->ID ), 'large' );
	if( $large_image_url ) {
		$slides[] = array('title' => $post->post_title, 'image_large' => $large_image_url[0], 'embed' => '', 'type' => 'featured');
	}
	$regex = '/(\<iframe.*?\<\/iframe\>)|(\[video[^\]]+?])|(\[gallery[^\]]+?\])|(\<img[^\>]+>)/is';
	preg_match_all( $regex , $content, $matches );

	foreach( $matches[0] as $match )
	{
		// If img tag
		if( strpos($match, '<img') !== false ) {
			$slide = array('title' => '', 'image_large' => '', 'embed' => '', 'type' => 'img');

			preg_match('/src=["\'](.+?)["\']/i', $match, $res);
			if( !empty($res[1]) ) {
				$slide['image_large'] = $res[1];
			}

			preg_match('/title=["\'](.+?)["\']/i', $match, $res);
			if( !empty($res[1]) ) {
				$slide['title'] = $res[1];
			}

		// If iframe tag
		} elseif( strpos($match, '<iframe') !== false  ) {
			$slide = array('title' => '', 'image_large' => '', 'embed' => '', 'type' => 'iframe');

			$slide['embed'] = $match;

			preg_match('/title=["\'](.+?)["\']/i', $match, $res);
			if( !empty($res[1]) ) {
				$slide['title'] = $res[1];
			}

		// If video shortcode
		} elseif( strpos($match, '[video') !== false  ) {
			$slide = array('title' => '', 'image_large' => '', 'embed' => '', 'type' => 'video');

			$slide['embed'] = do_shortcode( $match );

			preg_match('/title=["\'](.+?)["\']/i', $match, $res);
			if( !empty($res[1]) ) {
				$slide['title'] = $res[1];
			}

		// If gallery shortcode
		} elseif( strpos($match, '[gallery') !== false ) {

			preg_match_all( '#ids=([\'"])(.+?)\1#is', $match, $ids, PREG_SET_ORDER );
			if ( ! empty( $ids ) ) {
				$idss = '';
				foreach ( $ids as $s ) $idss .= ','.$s[2]; // If multiple src attributes

				if( !empty( $idss ) ) {
					$idss = explode( ',', $idss );
				}
				if( !empty( $idss ) && is_array( $idss ) ) {
					foreach ( $idss as $img_id ) {
						$img_id    = trim( $img_id );
						if( empty( $img_id ) ) continue;
						$slide_sub = array( 'title' => '', 'image_large' => '', 'embed' => '' , 'type' => 'gallery');

						$attachment = get_post( $img_id );
						if( false == $attachment ) continue;

						$large_image_url = wp_get_attachment_image_src( $img_id, 'large' );

						$slide_sub['title'] = $attachment->post_title;
						$slide_sub['image_large'] = $large_image_url[0];
						$slides[] = $slide_sub;
					}
				}
			}

		}
		if( isset( $slide ) ) $slides[] = $slide;
		unset( $slide );
	}

	return $slides;
}


/**
 * Convert HEX to RGB
 *
 * @param $color
 * @param bool $opacity
 *
 * @return string
 */
function hex2rgba( $color, $opacity = false )
{
	$default = 'rgb(0,0,0)';
	//Return default if no color provided
	if ( empty( $color ) ) {
		return $default;
	}
	//Sanitize $color if "#" is provided
	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}
	//Check if color has 6 or 3 characters and get values
	if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}
	//Convert hexadec to rgb
	$rgb = array_map( 'hexdec', $hex );
	//Check if opacity is set(rgba or rgb)
	if ( $opacity ) {
		return array(
			'r' => $rgb[0],
			'g' => $rgb[1],
			'b' => $rgb[2],
			'a' => $opacity
		);
	} else {
		return array(
			'r' => $rgb[0],
			'g' => $rgb[1],
			'b' => $rgb[2],
		);
	}
}

/**
 * Get color Brightness from 0 to 255
 *
 * @param string $hex Color
 *
 * @return float
 */
function get_brightness( $hex )
{
	$rgb = hex2rgba( $hex );

	return ( $rgb['r'] * 299 + $rgb['g'] * 587 + $rgb['b'] * 114 ) / 1000;
}

/**
 * Generate google font params string
 *
 * @param $font
 *
 * @return string
 */
function get_google_font_params( $font )
{
	$params = array();

	if(!empty($font['weight'])) $params[] = $font['weight'];
	if(!empty($font['style']) && $font['style'] != 'normal') $params[] = $font['style'];
        if (isset($font['subset']) && !empty($font['subset'])){
            return $font['name_google'] . ':' . implode( '', $params ) . ':' . implode (',', array_keys($font['subset']));
        }
	return $font['name_google'] . ':' . implode( '', $params );
}


/**
 * Get the attributes of a wrapped shortcodes
 *
 * @param $str
 * @param null $att
 *
 * @return array
 */
function mental_attribute_map( $str, $att = null )
{
	$res    = array();
	$return = array();
	$reg    = get_shortcode_regex();
	preg_match_all( '~' . $reg . '~', $str, $matches );
	foreach ( $matches[2] as $key => $name ) {
		$parsed = shortcode_parse_atts( $matches[3][ $key ] );
		$parsed = is_array( $parsed ) ? $parsed : array();

		$res[ $name ] = $parsed;
		$return[]     = $res;
	}

	return $return;
}


/**
 * Checks hex color, returns color or null
 *
 * @param $color
 *
 * @return null|string
 */
function mental_hex_color( $color ) {
	if ( '' === $color )
		return '';

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;

	return null;
}


/**
 * Escape iframe
 *
 * @param $iframe
 *
 * @return null|string
 */
function mental_escape_iframe( $iframe ) {
	if ( '' === $iframe )
		return '';

	$allowed_html = array(

		// Embed video

		'iframe' => array(
			'src' => array (),
			'frameborder' => array(),
			'title' => array(),
			'allowfullscreen' => array(),
			'webkitallowfullscreen' => array(),
			'mozallowfullscreen' => array(),
		),

		// Native video

		'div' => array(
			'style' => array(),
			'class' => array(),
			'script' => array(),
		),

		'video' => array(
			'style' => array(),
			'class' => array(),
			'id' => array(),
			'preload' => array(),
			'controls' => array(),
		),

		'source' => array(
			'type' => array(),
			'src' => array(),
			'id' => array(),
			'preload' => array(),
			'controls' => array(),
		),

		'a' => array(
			'href' => array(),
		),
	);

	return wp_kses( $iframe, $allowed_html );
}

/**
 * Get allowed tags for paragraphs
 *
 * @return array
 */
function mental_allowed_tags()
{
	global $allowedtags;

	$additional = array(
		'p' => array(),
		'ins' => array()
	);

	return array_merge( $allowedtags, $additional );
}

/**
 * Converts attributes array into form for
 * one html attribute (like data-options="")
 *
 * @param $atts
 *
 * @return string
 */
function azl_serialize_atts($atts)
{
	$result = '';
	foreach( $atts as $name => $att ){
		$result .= $name . ': ' . str_replace( array('"',"'",';'), '', $att) . '; ';
	}
	return $result;
}

/**
 * Get list of categories for specified taxonomy
 *
 * @param $separator
 * @param string $taxonomy
 *
 * @return string
 */
function azl_get_categories($separator = ', ', $taxonomy = 'gallery_category')
{
	if( ! $id = get_the_ID() ) return '';
	$tax_terms = wp_get_post_terms(get_the_ID(), $taxonomy);
	$i = 1;
	$cats_count = count($tax_terms);
	$output = '';
	foreach ($tax_terms as $tax_term) {
		$output .= '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a>';
		if($i < $cats_count) $output .= $separator;
		$i++;
	}

	return $output;
}

/**
 * Get back to ballery link based on theme options
 *
 * @return bool|string
 */
function mental_get_back_to_gallery_link()
{
	if( ! get_mental_option( 'gallery_single_full_back2gal_show' ) ) return '';

	if( $custom_link = get_mental_option( 'gallery_single_full_back2gal_link' ) )
		return $custom_link;

	$ref_url = wp_get_referer();
	$ref_parse = parse_url($ref_url);
	$my_parse = parse_url(get_permalink());

	if( ! isset($ref_parse['host']) || ! isset($my_parse['host']) || $ref_parse['host'] != $my_parse['host'] ) return '';

	return $ref_url;
}

/**
 * Get tags list only for specified category ID
 * (works with custom taxonomies)
 *
 * @param $tag_tax
 * @param $category_tax
 * @param int|string $categories can by multiple categories separated by comma
 *
 * @return mixed
 */
function azl_get_category_tags($categories, $tag_tax = 'post_tag', $category_tax = 'category')
{
	global $wpdb;

	$db_prepare = $wpdb->prepare(
		"
		SELECT DISTINCT terms2.term_id, terms2.name, terms2.slug, terms2.term_group
		FROM
			{$wpdb->prefix}posts as p1
			LEFT JOIN {$wpdb->prefix}term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN {$wpdb->prefix}term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN {$wpdb->prefix}terms as terms1 ON t1.term_id = terms1.term_id,

			{$wpdb->prefix}posts as p2
			LEFT JOIN {$wpdb->prefix}term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN {$wpdb->prefix}term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN {$wpdb->prefix}terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = '%s' AND p1.post_status = 'publish' AND terms1.term_id IN (%s) AND
			t2.taxonomy = '%s' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
		ORDER by name
		",
		$category_tax, $categories, $tag_tax
	);

	$tags = $wpdb->get_results($db_prepare);

	return $tags;
}

/**
 * Another variant of get_template_part function
 * with additional params support
 *
 * @param $slug
 * @param $name
 * @param array $params
 */
function azl_get_template_part($slug, $name = null, array $params = array())
{
	global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

	do_action( "get_template_part_{$slug}", $slug, $name );

	$templates = array();
	$name = (string) $name;
	if ( '' !== $name )
		$templates[] = "{$slug}-{$name}.php";

	$templates[] = "{$slug}.php";

	$_template_file = locate_template($templates, false, false);

	if ( is_array( $wp_query->query_vars ) )
		extract( $wp_query->query_vars, EXTR_SKIP );

	extract($params, EXTR_SKIP);

	require( $_template_file );
}

/*
  * Get cart contents count
  */
function nm_get_cart_contents_count() {
    $cart_count = apply_filters( 'nm_cart_count', WC()->cart->cart_contents_count );
    $count_class = ( $cart_count > 0 ) ? '' : ' nm-count-zero';

    return '<span class="nm-menu-cart-count count' . $count_class . '">' . $cart_count . '</span>';
}