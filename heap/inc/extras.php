<?php

function heap_option( $option, $default = null ) {
	global $pagenow;
	global $pixcustomify_plugin;
	// if there is set an key in url force that value
	if ( isset( $_GET[ $option ] ) && ! empty( $option ) ) {
		return $_GET[ $option ];
	} elseif ( $pixcustomify_plugin !== null && $pixcustomify_plugin->has_option( $option ) ) {
		// if this is a customify value get it here
		return $pixcustomify_plugin->get_option( $option, $default );
	}

	return $default;
}

/**
 * Get the image src attribute.
 * Target should be a valid option accessible via HeapOptions interface.
 * @return string|false
 */
function heap_image_src( $target, $size = null ) {
	if ( isset( $_GET[ $target ] ) && ! empty( $target ) ) {
		return heap_get_attachment_image( $_GET[ $target ], $size );
	} else { // empty target, or no query
		$image = heap_option( $target );
		if ( is_numeric( $image ) ) {
			return heap_get_attachment_image( $image, $size );
		}
	}

	return false;
}

function heap_get_attachment_image( $id, $size = null ) {

	if ( empty( $id ) || ! is_numeric( $id ) ) {
		return false;
	}

	$array = wp_get_attachment_image_src( $id, $size );

	if ( isset( $array[0] ) ) {
		return $array[0];
	}

	return false;
}

//@todo CLEANUP refactor function
function heap_better_excerpt( $text = '' ) {
	global $post;
	$raw_excerpt = '';

	//if the post has a manual excerpt ignore the content given
	if ( $text == '' && function_exists( 'has_excerpt' ) && has_excerpt() ) {
		$text        = get_the_excerpt();
		$raw_excerpt = $text;

		$text = strip_shortcodes( $text );
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( ']]>', ']]&gt;', $text );

		// Removes any JavaScript in posts (between <script> and </script> tags)
		$text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $text );

		// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
		$allowed_tags = '<p><strong><i><br><h1><h2><h3><h4><h5><h6><blockquote><ul><li><ol>';
		$text         = strip_tags( $text, $allowed_tags );
//		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
//		$text .= $excerpt_more;

	} else {

		if ( empty( $text ) ) {
			//need to grab the content
			$text = get_the_content();
		}

		$raw_excerpt = $text;
		//strip all shortcodes, but leave their textual content
		$text = preg_replace( '/\[[^\]]+\]/', '', $text );

		// Set custom excerpt length - number of words to be shown in excerpts
		if ( heap_option( 'blog_excerpt_length' ) ) {
			$excerpt_length = absint( heap_option( 'blog_excerpt_length' ) );
		} else {
			$excerpt_length = 180;
		}

		$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[...]' );

		$options = array(
			'ending' => $excerpt_more,
			'exact'  => true,
			'html'   => true
		);
		//cur the text to size according to the length specified
		$text = truncate( $text, $excerpt_length, $options );

		//make sure we apply all the filters that are needed
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( ']]>', ']]&gt;', $text );

		// Removes any JavaScript in posts (between <script> and </script> tags)
		/*$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text); */

		// Enable formatting in excerpts - Add HTML tags that you want to be parsed in excerpts
		$allowed_tags = '<p><em><strong><i><br><h1><h2><h3><h4><h5><h6><blockquote><ul><li><ol><iframe><embed><object><script>';
		$text         = strip_tags( $text, $allowed_tags );
	}

	// IMPORTANT! Prevents tags cutoff by excerpt (i.e. unclosed tags) from breaking formatting
	$text = force_balance_tags( $text );

	return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
}

/** Limit words for a string */
function heap_limit_words( $string, $word_limit, $more_text = ' [&hellip;]' ) {
	$words  = explode( " ", $string );
	$output = implode( " ", array_splice( $words, 0, $word_limit ) );

	//check fi we actually cut something
	if ( count( $words ) > $word_limit ) {
		$output .= $more_text;
	}

	return $output;
}

/**
 * Checks if a post type object needs password aproval
 *
 * @return if the form was submited it returns an array with the success status and a message
 */
function heap_is_password_protected() {
	global $post;
	$private_post = array( 'allowed' => false, 'error' => '' );

	if ( isset( $_POST['submit_password'] ) ) { // when we have a submision check the password and its submision
		if ( isset( $_POST['submit_password_nonce'] ) && wp_verify_nonce( $_POST['submit_password_nonce'], 'password_protection' ) ) {
			if ( isset ( $_POST['post_password'] ) && ! empty( $_POST['post_password'] ) ) { // some simple checks on password
				// finally test if the password submitted is correct
				if ( $post->post_password === $_POST['post_password'] ) {
					$private_post['allowed'] = true;

					// ok if we have a correct password we should inform wordpress too
					// otherwise the mad dog will put the password form again in the_content() and other filters
					global $wp_hasher;
					if ( empty( $wp_hasher ) ) {
						require_once( ABSPATH . 'wp-includes/class-phpass.php' );
						$wp_hasher = new PasswordHash( 8, true );
					}
					setcookie( 'wp-postpass_' . COOKIEHASH, $wp_hasher->HashPassword( stripslashes( $_POST['post_password'] ) ), 0, COOKIEPATH );
				} else {
					$private_post['error'] = '<h4 class="text--error">' . esc_html__( 'Wrong Password', 'heap' ) . '</h4>';
				}
			}
		}
	}

	if ( isset( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] ) && get_permalink() == wp_get_referer() ) {
		$private_post['error'] = '<h4 class="text--error">' . esc_html__( 'Wrong Password', 'heap' ) . '</h4>';
	}

	return $private_post;
}

function heap_get_post_format_first_image_src() {
	global $post;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output    = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img = $matches[1][0];
	if ( ! empty( $matches[1][0] ) ) {
		return $first_img;
	}

	return false;
}

/**
 * Returns the URL from the post.
 *
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @return string The Link format URL.
 */
function heap_get_content_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}


// hooks

/**
 * Load custom javascript set by theme options
 * This method is invoked by heap_callback_themesetup
 * The function is executed on wp_enqueue_scripts
 */
function heap_callback_load_custom_js() {
	$custom_js = heap_option( 'custom_js' );
	if ( ! empty( $custom_js ) ) {
		//first lets test is the js code is clean or has <script> tags and such
		//if we have <script> tags than we will not enclose it in anything - raw output
		if ( strpos( $custom_js, '</script>' ) !== false ) {
			echo $custom_js . "\n";
		} else {
			echo "<script type=\"text/javascript\">\n;(function($){\n" . $custom_js . "\n})(jQuery);\n</script>\n";
		}
	}
}

// custom javascript handlers - make sure it is the last one added
add_action( 'wp_head', 'heap_callback_load_custom_js', 999 );

function heap_callback_load_custom_js_footer() {
	$custom_js = heap_option( 'custom_js_footer' );
	if ( ! empty( $custom_js ) ) {
		//first lets test is the js code is clean or has <script> tags and such
		//if we have <script> tags than we will not enclose it in anything - raw output
		if ( strpos( $custom_js, '</script>' ) !== false ) {
			echo $custom_js . "\n";
		} else {
			echo "<script type=\"text/javascript\">\n;(function($){\n" . $custom_js . "\n})(jQuery);\n</script>\n";
		}
	}
}

add_action( 'wp_footer', 'heap_callback_load_custom_js_footer', 999 );

function heap_callbacks_setup_shortcodes_plugin() {
	$current_options = get_option( 'wpgrade_shortcodes_list' );

	$shortcodes = array( 'Columns', 'Button', 'Icon', 'Tabs', 'Quote', 'Separator', 'Slider' );

	// create an array with shortcodes which are needed by the
	// current theme
	if ( $current_options ) {
		$diff_added   = array_diff( $shortcodes, $current_options );
		$diff_removed = array_diff( $current_options, $shortcodes );
		if ( ( ! empty( $diff_added ) || ! empty( $diff_removed ) ) && is_admin() ) {
			update_option( 'wpgrade_shortcodes_list', $shortcodes );
		}
	} else { // there is no current shortcodes list
		update_option( 'wpgrade_shortcodes_list', $shortcodes );
	}

	// we need to remember the prefix of the metaboxes so it can be used
	// by the shortcodes plugin
	$current_prefix = get_option( 'wpgrade_metaboxes_prefix' );
	if ( empty( $current_prefix ) ) {
		update_option( 'wpgrade_metaboxes_prefix', '_heap_' );
	}
}

add_action( 'admin_head', 'heap_callbacks_setup_shortcodes_plugin' );


// Media Handlers
// --------------

function heap_media_handlers() {
	// make sure that WordPress allows the upload of our used mime types
	add_filter( 'upload_mimes', 'heap_callback_custom_upload_mimes' );
	add_filter( 'the_content', 'heap_callback_gallery_slideshow_filter' );
}

add_action( 'after_heap_core', 'heap_media_handlers' );

function heap_callback_custom_upload_mimes( $existing_mimes = null ) {
	if ( $existing_mimes === null ) {
		$existing_mimes = array();
	}

	$existing_mimes['mp3']  = 'audio/mpeg3';
	$existing_mimes['oga']  = 'audio/ogg';
	$existing_mimes['ogv']  = 'video/ogg';
	$existing_mimes['mp4a'] = 'audio/mp4';
	$existing_mimes['mp4']  = 'video/mp4';
	$existing_mimes['weba'] = 'audio/webm';
	$existing_mimes['webm'] = 'video/webm';

	// this is safe for admin only
	if ( is_admin() ) {
		$existing_mimes['svg'] = 'image/svg+xml';
	}

	return $existing_mimes;
}

/**
 * Remove the first gallery shortcode from the content
 */
function heap_callback_gallery_slideshow_filter( $content ) {
	$gallery_ids = array();
	$gallery_ids = get_post_meta( get_the_ID(), '_heap_main_gallery', true );

	if ( get_post_format() == 'gallery' && empty( $gallery_ids ) ) {
		// search for the first gallery shortcode
		$gallery_matches = null;
		preg_match( "!\[gallery.+?\]!", $content, $gallery_matches );

		if ( ! empty( $gallery_matches ) ) {
			$content = str_replace( $gallery_matches[0], "", $content );
		}
	}

	return $content;
}

function heap_count_sidebar_widgets( $sidebar_id, $echo = true ) {
	$the_sidebars = wp_get_sidebars_widgets();
	if ( ! isset( $the_sidebars[ $sidebar_id ] ) ) {
		return __( 'Invalid sidebar ID', 'heap' );
	}
	if ( $echo ) {
		echo count( $the_sidebars[ $sidebar_id ] );
	} else {
		return count( $the_sidebars[ $sidebar_id ] );
	}
}


/*
* We would like to GetToKnowYourWorkBetter
*
* Invoked by heap_callback_themesetup
*/
function heap_callback_gtkywb() {
	$themedata = wpgrade::themedata();

	$response = wp_remote_post( REQUEST_PROTOCOL . '//pixelgrade.com/stats', array(
		'method' => 'POST',
		'body'   => array(
			'send_stats'    => true,
			'theme_name'    => 'heap',
			'theme_version' => $themedata->get( 'Version' ),
			'domain'        => $_SERVER['HTTP_HOST'],
			'permalink'     => get_permalink( 1 ),
			'is_child'      => is_child_theme(),
		)
	) );
}

// some info
add_action( 'after_switch_theme', 'heap_callback_gtkywb' );

/**
 * The following code is inspired by Yoast SEO.
 */
function heap_get_current_canonical_url() {
	global $wp_query;

	if ( $wp_query->is_404 || $wp_query->is_search ) {
		return false;
	}

	$haspost = count( $wp_query->posts ) > 0;

	if ( get_query_var( 'm' ) ) {
		$m = preg_replace( '/[^0-9]/', '', get_query_var( 'm' ) );
		switch ( strlen( $m ) ) {
			case 4:
				$link = get_year_link( $m );
				break;
			case 6:
				$link = get_month_link( substr( $m, 0, 4 ), substr( $m, 4, 2 ) );
				break;
			case 8:
				$link = get_day_link( substr( $m, 0, 4 ), substr( $m, 4, 2 ), substr( $m, 6, 2 ) );
				break;
			default:
				return false;
		}
	} elseif ( ( $wp_query->is_single || $wp_query->is_page ) && $haspost ) {
		$post = $wp_query->posts[0];
		$link = get_permalink( $post->ID );
	} elseif ( $wp_query->is_author && $haspost ) {
		$author = get_userdata( get_query_var( 'author' ) );
		if ( $author === false ) {
			return false;
		}
		$link = get_author_posts_url( $author->ID, $author->user_nicename );
	} elseif ( $wp_query->is_category && $haspost ) {
		$link = get_category_link( get_query_var( 'cat' ) );
	} elseif ( $wp_query->is_tag && $haspost ) {
		$tag = get_term_by( 'slug', get_query_var( 'tag' ), 'post_tag' );
		if ( ! empty( $tag->term_id ) ) {
			$link = get_tag_link( $tag->term_id );
		}
	} elseif ( $wp_query->is_day && $haspost ) {
		$link = get_day_link
		(
			get_query_var( 'year' ),
			get_query_var( 'monthnum' ),
			get_query_var( 'day' )
		);
	} elseif ( $wp_query->is_month && $haspost ) {
		$link = get_month_link
		(
			get_query_var( 'year' ),
			get_query_var( 'monthnum' )
		);
	} elseif ( $wp_query->is_year && $haspost ) {
		$link = get_year_link( get_query_var( 'year' ) );
	} elseif ( $wp_query->is_home ) {
		if ( ( get_option( 'show_on_front' ) == 'page' ) && ( $pageid = get_option( 'page_for_posts' ) ) ) {
			$link = get_permalink( $pageid );
		} else {
			if ( function_exists( 'icl_get_home_url' ) ) {
				$link = icl_get_home_url();
			} else { // icl_get_home_url does not exist
				$link = home_url();
			}
		}
	} elseif ( $wp_query->is_tax && $haspost ) {
		$taxonomy = get_query_var( 'taxonomy' );
		$term     = get_query_var( 'term' );
		$link     = get_term_link( $term, $taxonomy );
	} elseif ( $wp_query->is_archive && function_exists( 'get_post_type_archive_link' ) && ( $post_type = get_query_var( 'post_type' ) ) ) {
		$link = get_post_type_archive_link( $post_type );
	} else {
		return false;
	}

	//let's see about the page number
	$page = get_query_var( 'page' );
	if ( empty( $page ) ) {
		$page = get_query_var( 'paged' );
	}

	if ( ! empty( $page ) && $page > 1 ) {
		$link = trailingslashit( $link ) . "page/$page";
		$link = user_trailingslashit( $link, 'paged' );
	}

	return $link;
}

/**
 * Helper function for safely calculating cachebust string. The filemtime is
 * prone to failure.
 *
 * @param  string file path to test
 *
 * @return string cache bust based on filemtime or monthly
 */
function heap_cachebust_string( $filepath ) {
	$filemtime = @filemtime( $filepath );

	if ( $filemtime == null ) {
		$filemtime = @filemtime( utf8_decode( $filepath ) );
	}

	if ( $filemtime != null ) {
		return date( 'YmdHi', $filemtime );
	} else { // can't get filemtime, fallback to cachebust every month
		return date( 'Ym' );
	}
}

/*=========== SANITIZE UPLOADED FILE NAMES ==========*/

add_filter( 'sanitize_file_name', 'heap_sanitize_file_name', 10 );

/**
 * Clean up uploaded file names
 * @author toscho
 * @url    https://github.com/toscho/Germanix-WordPress-Plugin
 */
function heap_sanitize_file_name( $filename ) {
	$filename = html_entity_decode( $filename, ENT_QUOTES, 'utf-8' );
	$filename = heap_translit( $filename );
	$filename = heap_lower_ascii( $filename );
	$filename = heap_remove_doubles( $filename );

	return $filename;
}

function heap_lower_ascii( $str ) {
	$str   = strtolower( $str );
	$regex = array(
		'pattern'     => '~([^a-z\d_.-])~',
		'replacement' => ''
	);
	// Leave underscores, otherwise the taxonomy tag cloud in the
	// backend won’t work anymore.
	return preg_replace( $regex['pattern'], $regex['replacement'], $str );
}

/**
 * Reduces repeated meta characters (-=+.) to one.
 */
function heap_remove_doubles( $str ) {
	$regex = apply_filters( 'germanix_remove_doubles_regex', array(
		'pattern'     => '~([=+.-])\\1+~',
		'replacement' => "\\1"
	) );

	return preg_replace( $regex['pattern'], $regex['replacement'], $str );
}

/**
 * Replaces non ASCII chars.
 */
function heap_translit( $str ) {
	$utf8 = array(
		'Ä'  => 'Ae',
		'ä'  => 'ae',
		'Æ'  => 'Ae',
		'æ'  => 'ae',
		'À'  => 'A',
		'à'  => 'a',
		'Á'  => 'A',
		'á'  => 'a',
		'Â'  => 'A',
		'â'  => 'a',
		'Ã'  => 'A',
		'ã'  => 'a',
		'Å'  => 'A',
		'å'  => 'a',
		'ª'  => 'a',
		'ₐ'  => 'a',
		'ā'  => 'a',
		'Ć'  => 'C',
		'ć'  => 'c',
		'Ç'  => 'C',
		'ç'  => 'c',
		'Ð'  => 'D',
		'đ'  => 'd',
		'È'  => 'E',
		'è'  => 'e',
		'É'  => 'E',
		'é'  => 'e',
		'Ê'  => 'E',
		'ê'  => 'e',
		'Ë'  => 'E',
		'ë'  => 'e',
		'ₑ'  => 'e',
		'ƒ'  => 'f',
		'ğ'  => 'g',
		'Ğ'  => 'G',
		'Ì'  => 'I',
		'ì'  => 'i',
		'Í'  => 'I',
		'í'  => 'i',
		'Î'  => 'I',
		'î'  => 'i',
		'Ï'  => 'Ii',
		'ï'  => 'ii',
		'ī'  => 'i',
		'ı'  => 'i',
		'I'  => 'I' // turkish, correct?
	,
		'Ñ'  => 'N',
		'ñ'  => 'n',
		'ⁿ'  => 'n',
		'Ò'  => 'O',
		'ò'  => 'o',
		'Ó'  => 'O',
		'ó'  => 'o',
		'Ô'  => 'O',
		'ô'  => 'o',
		'Õ'  => 'O',
		'õ'  => 'o',
		'Ø'  => 'O',
		'ø'  => 'o',
		'ₒ'  => 'o',
		'Ö'  => 'Oe',
		'ö'  => 'oe',
		'Œ'  => 'Oe',
		'œ'  => 'oe',
		'ß'  => 'ss',
		'Š'  => 'S',
		'š'  => 's',
		'ş'  => 's',
		'Ş'  => 'S',
		'™'  => 'TM',
		'Ù'  => 'U',
		'ù'  => 'u',
		'Ú'  => 'U',
		'ú'  => 'u',
		'Û'  => 'U',
		'û'  => 'u',
		'Ü'  => 'Ue',
		'ü'  => 'ue',
		'Ý'  => 'Y',
		'ý'  => 'y',
		'ÿ'  => 'y',
		'Ž'  => 'Z',
		'ž'  => 'z' // misc
	,
		'¢'  => 'Cent',
		'€'  => 'Euro',
		'‰'  => 'promille',
		'№'  => 'Nr',
		'$'  => 'Dollar',
		'℃'  => 'Grad Celsius',
		'°C' => 'Grad Celsius',
		'℉'  => 'Grad Fahrenheit',
		'°F' => 'Grad Fahrenheit' // Superscripts
	,
		'⁰'  => '0',
		'¹'  => '1',
		'²'  => '2',
		'³'  => '3',
		'⁴'  => '4',
		'⁵'  => '5',
		'⁶'  => '6',
		'⁷'  => '7',
		'⁸'  => '8',
		'⁹'  => '9' // Subscripts
	,
		'₀'  => '0',
		'₁'  => '1',
		'₂'  => '2',
		'₃'  => '3',
		'₄'  => '4',
		'₅'  => '5',
		'₆'  => '6',
		'₇'  => '7',
		'₈'  => '8',
		'₉'  => '9' // Operators, punctuation
	,
		'±'  => 'plusminus',
		'×'  => 'x',
		'₊'  => 'plus',
		'₌'  => '=',
		'⁼'  => '=',
		'⁻'  => '-' // sup minus
	,
		'₋'  => '-' // sub minus
	,
		'–'  => '-' // ndash
	,
		'—'  => '-' // mdash
	,
		'‑'  => '-' // non breaking hyphen
	,
		'․'  => '.' // one dot leader
	,
		'‥'  => '..' // two dot leader
	,
		'…'  => '...' // ellipsis
	,
		'‧'  => '.' // hyphenation point
	,
		' '  => '-' // nobreak space
	,
		' '  => '-' // normal space
		// Russian
	,
		'А'  => 'A',
		'Б'  => 'B',
		'В'  => 'V',
		'Г'  => 'G',
		'Д'  => 'D',
		'Е'  => 'E',
		'Ё'  => 'YO',
		'Ж'  => 'ZH',
		'З'  => 'Z',
		'И'  => 'I',
		'Й'  => 'Y',
		'К'  => 'K',
		'Л'  => 'L',
		'М'  => 'M',
		'Н'  => 'N',
		'О'  => 'O',
		'П'  => 'P',
		'Р'  => 'R',
		'С'  => 'S',
		'Т'  => 'T',
		'У'  => 'U',
		'Ф'  => 'F',
		'Х'  => 'H',
		'Ц'  => 'TS',
		'Ч'  => 'CH',
		'Ш'  => 'SH',
		'Щ'  => 'SCH',
		'Ъ'  => '',
		'Ы'  => 'YI',
		'Ь'  => '',
		'Э'  => 'E',
		'Ю'  => 'YU',
		'Я'  => 'YA',
		'а'  => 'a',
		'б'  => 'b',
		'в'  => 'v',
		'г'  => 'g',
		'д'  => 'd',
		'е'  => 'e',
		'ё'  => 'yo',
		'ж'  => 'zh',
		'з'  => 'z',
		'и'  => 'i',
		'й'  => 'y',
		'к'  => 'k',
		'л'  => 'l',
		'м'  => 'm',
		'н'  => 'n',
		'о'  => 'o',
		'п'  => 'p',
		'р'  => 'r',
		'с'  => 's',
		'т'  => 't',
		'у'  => 'u',
		'ф'  => 'f',
		'х'  => 'h',
		'ц'  => 'ts',
		'ч'  => 'ch',
		'ш'  => 'sh',
		'щ'  => 'sch',
		'ъ'  => '',
		'ы'  => 'yi',
		'ь'  => '',
		'э'  => 'e',
		'ю'  => 'yu',
		'я'  => 'ya'
	);

	$str = strtr( $str, $utf8 );

	return trim( $str, '-' );
}


function heap_get_avatar_url( $email, $size = 32 ) {
	$get_avatar = get_avatar( $email, $size );

	preg_match( '/< *img[^>]*src *= *["\']?([^"\']*)/i', $get_avatar, $matches );
	if ( isset( $matches[1] ) ) {
		return $matches[1];
	} else {
		return '';
	}
}

function heap_pagination( $query = null, $target = null ) {
	if ( $query === null ) {
		global $wp_query;
		$query = $wp_query;
	}

	$pager = new HeapPaginationFormatter( $query );

	return $pager->render();
}

/**
 * Note: next_text and prev_text are already flipped as per sorted_paging
 * in the configuration passed to this function.
 *
 * The formatter is designed to generate the following structure:
 *
 *	<div class="heap_pagination">
 *		<a class="prev disabled page-numbers">Previous Page</a>
 *		<div class="pages">
 *			<span class="page">Page</span>
 *			<span class="page-numbers current">1</span>
 *			<span class="dots-of">of</span>
 *			<a class="page-numbers" href="/page/8/">8</a>
 *		</div>
 *		<a class="next page-numbers" href="/page/2/">Newer posts</a>
 *	</div>
 *
 * @param array pagination links
 * @param array pagination configuration
 * @return string
 */
function heap_callback_pagination_formatter($links, $conf) {
	$linkcount = count($links);

	//don't show anything when no pagination is needed
	if ($linkcount == 0) {
		return '';
	}
	$prefix = '';
	$suffix = '<!--';

	$current = $conf['current'];
	foreach ( $links as $key => &$link ) {

		//some SEO shit
		//prevent pagination parameters for the links to the first page
		if ($key == 0 && $current == 2 && strpos($link, 'prev')) {
			//the first link - should be prev and since we are on page 2 it will hold the link to the first page
			$link = preg_replace('/href=(["\'])(http:\/\/)?([^"\']+)(["\'])/', 'href="'.  get_pagenum_link(1) .'"', $link);
		}

		//change the link of the first page to be more SEO friendly
		$link_text = strip_tags($link);
		if ($current != 1 && $link_text == "1") {
			$link = preg_replace('/href=(["\'])(http:\/\/)?([^"\']+)(["\'])/', 'href="'.  get_pagenum_link(1) .'"', $link);
		}

		if ( $key == $linkcount - 1 ) {
			$suffix = '';
		}

		$link = $prefix .'<li>' . $link . '</li>' . $suffix;
		$prefix = "\n-->";
	}

	//if we are on the first page we should have a disabled prev text
	if ($current == 1) {
		array_unshift($links,'<li><span class="prev  page-numbers  disabled">'.$conf['prev_text'].'</span></li>');
	}
	//if we are on the last page we should have a disabled next text
	if ($current == $conf['total']) {
		array_push($links,'<li><span class="next page-numbers  disabled">'.$conf['next_text'].'</span></li>');
	}

	return '<ol class="nav nav--banner pagination">'.implode('', $links).'</ol>';
}

/** Do the same thing on single post pagination */

function heap_pagination_custom_markup($link, $key) {
	global $wp_query;
	$current = (get_query_var('page')) ? get_query_var('page') : '1';
	$class = '';
	$prefix = '-->';
	$suffix = '<!--';
	switch ( $key ) {
		case $current:
			$class .= 'class="pagination-item pagination-item--current"';
			$link = '<span>' . $link . '</span>';
			break;
		case 'prev':
			$class .= 'class="pagination-item pagination-item--prev"';
			break;
		case 'next':
			$class .= 'class="pagination-item pagination-item--next"';
			break;
		default:
			break;
	}

	$link = '<li '.$class.'>' . $link . '</li>';
	return $link;

}
add_filter('wp_link_pages_link', 'heap_pagination_custom_markup', 10, 2);

/**
 * @package        wpgrade
 * @category       core
 * @author         Pixel Grade Team
 * @copyright  (c) 2013, Pixel Grade Media
 */
class HeapPaginationFormatter {

	/** @var mixed query */
	protected $query = null;

	/** @var array configuration */
	protected $conf = null;

	/** @var string pagination type (paged, page) */
	protected $pager = null;

	/**
	 * You may set the pager configuration value to either page or paged to
	 * switch the pagination from showing post listings to showing post
	 * segments.
	 *
	 * @param mixed query
	 * @param array configuration
	 */
	function __construct( $query, $conf = null ) {
		if ( $conf === null ) {
			$conf = array(
				// formatter to process the links; null if none needed
				// the formatter should return a string and accept links and
				// the resulting configuration
				'formatter' => 'heap_callback_pagination_formatter',
				// show prev/next links?
				'prev_next' => true,
				// pagination text
				'prev_text' => __('Prev', 'heap'),
				'next_text' => __('Next', 'heap'),
				// are the terms used for paging relative to the sort order?
				// ie. older/newer instead of sorting agnostic previous/next
				'sorted_paging' => false,
				// the order of the posts (asc or desc); if asc is passed and
				// sorted_paging is true the values of prev_text and next_text
				// will be flipped
				'order' => 'desc',
				// show all pages? (ie. no cutoffs)
				'show_all' => false,
				// how many numbers on either the start and the end list edges
				'end_size' => 1,
				// how many numbers to either side of current page
				// not including current page
				'mid_size' => 2,
				// an array of query args to add
				'add_args' => false,
				// a string to append to each link
				'add_fragment' => null,
			);
		}

		$this->query = $query;

		// the pager determines what we're paginating (ie. "paged" for listing
		// of posts, and "page" for post parts)
		if ( isset( $conf['pager'] ) ) {
			$this->pager = $conf['pager'];
		} else if ( isset( $config_defaults['pager'] ) ) {
			$this->pager = $config_defaults['pager'];
		} else { // no pager configuration entry
			// fallback to listing pagination
			if ( is_front_page() && is_page() ) {
				$this->pager = 'page';
			} else {
				$this->pager = 'paged';
			}
		}
	}

	/**
	 * @param type $pager
	 */
	protected function pager_format( $pager ) {
		global $wp_rewrite;

		// are we using pretty permalinks?
		if ( $wp_rewrite->using_mod_rewrite_permalinks() ) {
			return "/$pager/%#%";
		} else { // not using pretty permalinks
			return "?$pager=%#%";
		}
	}

	protected function setup() {
		// the boring defaults that are ommited in the wpgrade-config.php
		// configuration for clarity and bravity, and also because some require
		// extensive logic handling

		$conf = array(
			// dynamically resolve to pretty or non-pretty base
			'base'          => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			// link format, "/$pager/%#%" or "?$pager=%#%"
			'format'        => $this->pager_format( $this->pager ),
			// current page
			'current'       => max( 1, get_query_var( $this->pager ) ),
			// total pages
			'total'         => $this->query->max_num_pages,
			// formatter to process the links; null if none needed
			// the formatter should return a string and accept links and
			// the resulting configuration
			'formatter' => 'heap_callback_pagination_formatter',
			// show prev/next links?
			'prev_next'     => true,
			// pagination text
			'prev_text' => __('Prev', 'heap'),
			'next_text' => __('Next', 'heap'),
			// are the terms used for paging relative to the sort order?
			// ie. older/newer instead of sorting agnostic previous/next
			'sorted_paging' => false,
			// the order of the posts (asc or desc); if asc is passed and
			// sorted_paging is true the values of prev_text and next_text
			// will be flipped
			'order'         => 'desc',
			// show all pages? (ie. no cutoffs)
			'show_all'      => false,
			// how many numbers on either the start and the end list edges
			'end_size'      => 1,
			// how many numbers to either side of current page
			// not including current page
			'mid_size'      => 2,
			// an array of query args to add
			'add_args'      => false,
			// a string to append to each link
			'add_fragment'  => null,

		);

		# we're filling in prev_text and next_text seperatly to avoid
		# requesting the translation when not required

		if ( empty( $conf['prev_text'] ) ) {
			$conf['prev_text'] = __( '&laquo; Previous', 'heap' );
		} else { // exists; translate
			$conf['prev_text'] = __( $conf['prev_text'], 'heap' );
		}

		if ( empty( $conf['next_text'] ) ) {
			$conf['next_text'] = __( 'Next &raquo;', 'heap' );
		} else { // exists; translate
			$conf['next_text'] = __( $conf['next_text'], 'heap' );
		}

		// is the pager sorted?
		if ( $conf['sorted_paging'] && $conf['order'] == 'asc' ) {
			$temp              = $conf['prev_text'];
			$conf['prev_text'] = $conf['next_text'];
			$conf['next_text'] = $temp;
		}

		return $conf;
	}

	/**
	 * @return string
	 */
	function render() {
		$conf = $this->setup();

		// processing return type
		$conf['type'] = 'array';

		$links = paginate_links( $conf );

		if ( empty( $links ) ) {
			$links = array();
		}

		if ( $conf['formatter'] !== null ) {
			return call_user_func( $conf['formatter'], $links, $conf );
		} else { // formatter === null
			return implode( '', $links );
		}
	}

} # class

/*
 * Get thumbnails
 * @param string $size Optional, default is 'full'.
 * @param string $class Class to put on img. Default is none.
 * @param bool $use_as_background Optional, default is false. Whether use the image as background on a div.
 * @return bool $force Force the function to return an image from theme options or from theme.
 */
//this function is no longer used
function heap_get_thumbnail( $size = 'full', $class = '', $use_as_background = false, $force = false ) {

	global $post;
	$post_id = $post->ID;

	$default_img = heap_option( "default_thumbnail_" . $size );
	$src         = '';
	if ( has_post_thumbnail( $post_id ) ) { // take only the featured-classic image src

		$thumbnail_id = get_post_thumbnail_id( $post_id );
		$src          = wp_get_attachment_image_src( $thumbnail_id, $size );
		$src          = $src[0];

	} elseif ( get_post_format() == 'image' ) { // take the first image from the content

		$thumbnail_id = heap_get_attachment_id_from_src( heap_get_post_first_image() );
		$src          = wp_get_attachment_image_src( $thumbnail_id, $size );
		$src          = $src[0];

	} elseif ( ! empty( $default_img ) && $force == true ) { // take the default image setted in theme options

		$src = $default_img;

	} elseif ( $force == true ) { // get the default thumbnail

		$src = get_template_directory_uri() . '/library/images/default_thumbnail_' . $size . '.png';

	}
	if ( ! empty( $src ) ) {

		if ( $use_as_background ) {

			$output = '<div class="' . $class . '"  style="background-image: url(\'' . $src . '\');" ></div>';

		} else {

			$output = '<img class="' . $class . '" src="' . $src . '" />';
		}

		echo $output;
	} else {
		return '';
	}

	return false;
}

function heap_get_post_first_image() {
	global $post, $posts;
	$first_img = '';
	preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img = $matches[1][0];

	// define a default image
	if ( empty( $first_img ) ) {
		$first_img = "";
	}

	return $first_img;
}

function heap_get_attachment_id_from_src ($url) {
	// Split the $url into two parts with the wp-content directory as the separator.
	$parse_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );

	// Get the host of the current site and the host of the $url, ignoring www.
	$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
	$file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );

	// Return nothing if there aren't any $url parts or if the current host and $url host do not match.
	if ( ! isset( $parse_url[1] ) || empty( $parse_url[1] ) || ( $this_host != $file_host ) ) {
		return;
	}

	// Now we're going to quickly search the DB for any attachment GUID with a partial path match.
	// Example: /uploads/2013/05/test-image.jpg
	global $wpdb;

	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parse_url[1] ) );

	// Returns null if no attachment is found.
	return $attachment[0];
}


/**
 * Get the Image - An advanced post image script for WordPress.
 *
 * Get the Image was created to be a highly-intuitive image script that displays post-specific images (an
 * image-based representation of a post).  The script handles old-style post images via custom fields for
 * backwards compatibility.  It also supports WordPress' built-in featured image functionality.  On top of
 * those things, it can automatically set attachment images as the post image or scan the post content for
 * the first image element used.  It can also fall back to a given default image.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package GetTheImage
 * @version 0.7.0
 * @author Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2008 - 2011, Justin Tadlock
 * @link http://justintadlock.com/archives/2008/05/27/get-the-image-wordpress-plugin
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Delete the cache when a post or post metadata is updated. */
add_action( 'save_post', array( 'Heap_Get_The_Image', 'get_the_image_delete_cache_by_post' ) );
add_action( 'deleted_post_meta', array( 'Heap_Get_The_Image', 'get_the_image_delete_cache_by_meta' ), 10, 2 );
add_action( 'updated_post_meta', array( 'Heap_Get_The_Image', 'get_the_image_delete_cache_by_meta' ), 10, 2 );
add_action( 'added_post_meta', array( 'Heap_Get_The_Image', 'get_the_image_delete_cache_by_meta' ), 10, 2 );

/**
 * The main image function for displaying an image.  It supports several arguments that allow developers to
 * customize how the script outputs the image.
 *
 * The image check order is important to note here.  If an image is found by any specific check, the script
 * will no longer look for images.  The check order is 'meta_key', 'the_post_thumbnail', 'attachment',
 * 'image_scan', 'callback', and 'default_image'.
 *
 * @since 0.1.0
 * @global $post The current post's database object.
 *
 * @param array $args Arguments for how to load and display the image.
 *
 * @return string|array The HTML for the image. | Image attributes in an array.
 */
function heap_get_the_image( $args = array(), $post_id = null ) {
	global $post;

	/* Set the default arguments. */
	$defaults = array(
		'meta_key'           => array( 'Thumbnail', 'thumbnail' ),
		'post_id'            => is_null( $post_id ) ? $post->ID : $post_id,
		'attachment'         => true,
		'the_post_thumbnail' => true, // WP 2.9+ image function
		'size'               => 'thumbnail',
		'default_image'      => false,
		'order_of_image'     => 1,
		'link_to_post'       => true,
		'image_class'        => false,
		'image_scan'         => false,
		'width'              => false,
		'height'             => false,
		'format'             => 'img',
		'meta_key_save'      => false,
		'callback'           => null,
		'cache'              => true,
		'echo'               => true,
		'custom_key'         => null, // @deprecated 0.6. Use 'meta_key'.
		'default_size'       => null, // @deprecated 0.5.  Use 'size'.
	);

	/* Allow plugins/themes to filter the arguments. */
	$args = apply_filters( 'heap_get_the_image_args', $args );

	/* Merge the input arguments and the defaults. */
	$args = wp_parse_args( $args, $defaults );

	/* If $default_size is given, overwrite $size. */
	if ( ! is_null( $args['default_size'] ) ) {
		$args['size'] = $args['default_size'];
	} // Deprecated 0.5 in favor of $size

	/* If $custom_key is set, overwrite $meta_key. */
	if ( ! is_null( $args['custom_key'] ) ) {
		$args['meta_key'] = $args['custom_key'];
	} // Deprecated 0.6 in favor of $meta_key

	/* If $format is set to 'array', don't link to the post. */
	if ( 'array' == $args['format'] ) {
		$args['link_to_post'] = false;
	}

	/* Extract the array to allow easy use of variables. */
	extract( $args );

	/* Get cache key based on $args. */
	$key = md5( serialize( compact( array_keys( $args ) ) ) );

	/* Check for a cached image. */
	$image_cache = wp_cache_get( $post_id, 'heap_get_the_image' );

	if ( ! is_array( $image_cache ) ) {
		$image_cache = array();
	}

	/* If there is no cached image, let's see if one exists. */
	if ( ! isset( $image_cache[ $key ] ) || empty( $cache ) ) {

		/* If a custom field key (array) is defined, check for images by custom field. */
		if ( ! empty( $meta_key ) ) {
			$image = Heap_Get_The_Image::get_the_image_by_meta_key( $args );
		}

		/* If no image found and $the_post_thumbnail is set to true, check for a post image (WP feature). */
		if ( empty( $image ) && ! empty( $the_post_thumbnail ) ) {
			$image = Heap_Get_The_Image::get_the_image_by_post_thumbnail( $args );
		}

		/* If no image found and $attachment is set to true, check for an image by attachment. */
		if ( empty( $image ) && ! empty( $attachment ) ) {
			$image = Heap_Get_The_Image::get_the_image_by_attachment( $args );
		}

		/* If no image found and $image_scan is set to true, scan the post for images. */
		if ( empty( $image ) && ! empty( $image_scan ) ) {
			$image = Heap_Get_The_Image::get_the_image_by_scan( $args );
		}

		/* If no image found and a callback function was given. Callback function must pass back array of <img> attributes. */
		if ( empty( $image ) && ! is_null( $callback ) && function_exists( $callback ) ) {
			$image = call_user_func( $callback, $args );
		}

		/* If no image found and a $default_image is set, get the default image. */
		if ( empty( $image ) && ! empty( $default_image ) ) {
			$image = Heap_Get_The_Image::get_the_image_by_default( $args );
		}

		/* If an image was found. */
		if ( ! empty( $image ) ) {

			/* If $meta_key_save was set, save the image to a custom field. */
			if ( ! empty( $meta_key_save ) ) {
				Heap_Get_The_Image::get_the_image_meta_key_save( $args, $image['src'] );
			}

			/* Format the image HTML. */
			$image = Heap_Get_The_Image::get_the_image_format( $args, $image );

			/* Set the image cache for the specific post. */
			$image_cache[ $key ] = $image;
			wp_cache_set( $post_id, $image_cache, 'heap_get_the_image' );
		}
	} /* If an image was already cached for the post and arguments, use it. */
	else {
		$image = $image_cache[ $key ];
	}

	/* Allow plugins/theme to override the final output. */
	$image = apply_filters( 'heap_get_the_image', $image );

	/* If $format is set to 'array', return an array of image attributes. */
	if ( 'array' == $format ) {

		/* Set up a default empty array. */
		$out = array();

		/* Get the image attributes. */
		$atts = wp_kses_hair( $image, array( 'http' ) );

		/* Loop through the image attributes and add them in key/value pairs for the return array. */
		foreach ( $atts as $att ) {
			$out[ $att['name'] ] = $att['value'];
		}

		//$out['url'] = $out['src']; // @deprecated 0.5 Use 'src' instead of 'url'.

		/* Return the array of attributes. */

		return $out;
	} /* Or, if $echo is set to false, return the formatted image. */
	elseif ( false === $echo ) {
		return $image;
	}

	/* Display the image if we get to this point. */
	echo $image;
}

class Heap_Get_The_Image {

	/* Internal Functions */

	/**
	 * Calls images by custom field key.  Script loops through multiple custom field keys.  If that particular key
	 * is found, $image is set and the loop breaks.  If an image is found, it is returned.
	 *
	 * @since 0.7.0
	 *
	 * @param array $args Arguments for how to load and display the image.
	 *
	 * @return array|bool Array of image attributes. | False if no image is found.
	 */
	static function get_the_image_by_meta_key( $args = array() ) {

		/* If $meta_key is not an array. */
		if ( ! is_array( $args['meta_key'] ) ) {

			/* Get the image URL by the single meta key. */
			$image = get_post_meta( $args['post_id'], $args['meta_key'], true );
		} /* If $meta_key is an array. */
		elseif ( is_array( $args['meta_key'] ) ) {

			/* Loop through each of the given meta keys. */
			foreach ( $args['meta_key'] as $meta_key ) {

				/* Get the image URL by the current meta key in the loop. */
				$image = get_post_meta( $args['post_id'], $meta_key, true );

				/* If an image was found, break out of the loop. */
				if ( ! empty( $image ) ) {
					break;
				}
			}
		}

		/* If a custom key value has been given for one of the keys, return the image URL. */
		if ( ! empty( $image ) ) {
			return array( 'src' => $image );
		}

		return false;
	}

	/**
	 * Checks for images using a custom version of the WordPress 2.9+ get_the_post_thumbnail() function.
	 * If an image is found, return it and the $post_thumbnail_id.  The WordPress function's other filters are
	 * later added in the self::display_the_image() function.
	 *
	 * @since 0.7.0
	 *
	 * @param array $args Arguments for how to load and display the image.
	 *
	 * @return array|bool Array of image attributes. | False if no image is found.
	 */
	static function get_the_image_by_post_thumbnail( $args = array() ) {

		/* Check for a post image ID (set by WP as a custom field). */
		$post_thumbnail_id = get_post_thumbnail_id( $args['post_id'] );

		/* If no post image ID is found, return false. */
		if ( empty( $post_thumbnail_id ) ) {
			return false;
		}

		/* Apply filters on post_thumbnail_size because this is a default WP filter used with its image feature. */
		$size = apply_filters( 'post_thumbnail_size', $args['size'] );

		/* Get the attachment image source.  This should return an array. */
		$image = wp_get_attachment_image_src( $post_thumbnail_id, $size );

		/* Get the attachment excerpt to use as alt text. */
		$alt = trim( strip_tags( get_post_field( 'post_excerpt', $post_thumbnail_id ) ) );

		/* Return both the image URL and the post thumbnail ID. */

		return array( 'src' => $image[0], 'post_thumbnail_id' => $post_thumbnail_id, 'alt' => $alt );
	}

	/**
	 * Check for attachment images.  Uses get_children() to check if the post has images attached.  If image
	 * attachments are found, loop through each.  The loop only breaks once $order_of_image is reached.
	 *
	 * @since 0.7.0
	 *
	 * @param array $args Arguments for how to load and display the image.
	 *
	 * @return array|bool Array of image attributes. | False if no image is found.
	 */
	static function get_the_image_by_attachment( $args = array() ) {

		/* Get attachments for the inputted $post_id. */
		$attachments = get_children( array( 'post_parent'    => $args['post_id'],
		                                    'post_status'    => 'inherit',
		                                    'post_type'      => 'attachment',
		                                    'post_mime_type' => 'image',
		                                    'order'          => 'ASC',
		                                    'orderby'        => 'menu_order ID'
		) );

		/* If no attachments are found, check if the post itself is an attachment and grab its image. */
		if ( empty( $attachments ) && $args['size'] ) {
			if ( 'attachment' == get_post_type( $args['post_id'] ) ) {
				$image = wp_get_attachment_image_src( $args['post_id'], $args['size'] );
				$alt   = trim( strip_tags( get_post_field( 'post_excerpt', $args['post_id'] ) ) );
			}
		}

		/* If no attachments or image is found, return false. */
		if ( empty( $attachments ) && empty( $image ) ) {
			return false;
		}

		/* Set the default iterator to 0. */
		$i = 0;

		/* Loop through each attachment. Once the $order_of_image (default is '1') is reached, break the loop. */
		foreach ( $attachments as $id => $attachment ) {
			if ( ++ $i == $args['order_of_image'] ) {
				$image = wp_get_attachment_image_src( $id, $args['size'] );
				$alt   = trim( strip_tags( get_post_field( 'post_excerpt', $id ) ) );
				break;
			}
		}

		/* Return the image URL. */

		return array( 'src' => $image[0], 'alt' => $alt );
	}

	/**
	 * Scans the post for images within the content.  Not called by default with self::get_the_image().  Shouldn't use
	 * if using large images within posts, better to use the other options.
	 *
	 * @since 0.7.0
	 *
	 * @param array $args Arguments for how to load and display the image.
	 *
	 * @return array|bool Array of image attributes. | False if no image is found.
	 */
	static function get_the_image_by_scan( $args = array() ) {

		/* Search the post's content for the <img /> tag and get its URL. */
		preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );

		/* If there is a match for the image, return its URL. */
		if ( isset( $matches ) && ! empty( $matches[1][0] ) ) {
			return array( 'src' => $matches[1][0] );
		}

		return false;
	}

	/**
	 * Used for setting a default image.  The function simply returns the image URL it was given in an array.
	 * Not used with self::get_the_image() by default.
	 *
	 * @since 0.7.0
	 *
	 * @param array $args Arguments for how to load and display the image.
	 *
	 * @return array|bool Array of image attributes. | False if no image is found.
	 */
	static function get_the_image_by_default( $args = array() ) {
		return array( 'src' => $args['default_image'] );
	}

	/**
	 * Formats an image with appropriate alt text and class.  Adds a link to the post if argument is set.  Should
	 * only be called if there is an image to display, but will handle it if not.
	 *
	 * @since 0.7.0
	 *
	 * @param array $args Arguments for how to load and display the image.
	 * @param array $image Array of image attributes ($image, $classes, $alt, $caption).
	 *
	 * @return string $image Formatted image (w/link to post if the option is set).
	 */
	static function get_the_image_format( $args = array(), $image = false ) {

		/* If there is no image URL, return false. */
		if ( empty( $image['src'] ) ) {
			return false;
		}

		/* Extract the arguments for easy-to-use variables. */
		extract( $args );

		/* If there is alt text, set it.  Otherwise, default to the post title. */
		$image_alt = ( ( ! empty( $image['alt'] ) ) ? $image['alt'] : apply_filters( 'the_title', get_post_field( 'post_title', $post_id ) ) );

		/* If there is a width or height, set them as HMTL-ready attributes. */
		$width  = ( ( $width ) ? ' width="' . esc_attr( $width ) . '"' : '' );
		$height = ( ( $height ) ? ' height="' . esc_attr( $height ) . '"' : '' );

		/* Loop through the custom field keys and add them as classes. */
		if ( is_array( $meta_key ) ) {
			foreach ( $meta_key as $key ) {
				$classes[] = str_replace( ' ', '-', strtolower( $key ) );
			}
		}

		/* Add the $size and any user-added $image_class to the class. */
		$classes[] = $size;
		$classes[] = $image_class;

		/* Join all the classes into a single string and make sure there are no duplicates. */
		$class = join( ' ', array_unique( $classes ) );

		/* If there is a $post_thumbnail_id, apply the WP filters normally associated with get_the_post_thumbnail(). */
		if ( ! empty( $image['post_thumbnail_id'] ) ) {
			do_action( 'begin_fetch_post_thumbnail_html', $post_id, $image['post_thumbnail_id'], $size );
		}

		/* Add the image attributes to the <img /> element. */
		$html = '<img src="' . $image['src'] . '" alt="' . esc_attr( strip_tags( $image_alt ) ) . '" class="' . esc_attr( $class ) . '"' . $width . $height . ' />';

		/* If $link_to_post is set to true, link the image to its post. */
		if ( $link_to_post ) {
			$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( apply_filters( 'the_title', get_post_field( 'post_title', $post_id ) ) ) . '">' . $html . '</a>';
		}

		/* If there is a $post_thumbnail_id, apply the WP filters normally associated with get_the_post_thumbnail(). */
		if ( ! empty( $image['post_thumbnail_id'] ) ) {
			do_action( 'end_fetch_post_thumbnail_html', $post_id, $image['post_thumbnail_id'], $size );
		}

		/* If there is a $post_thumbnail_id, apply the WP filters normally associated with get_the_post_thumbnail(). */
		if ( ! empty( $image['post_thumbnail_id'] ) ) {
			$html = apply_filters( 'post_thumbnail_html', $html, $post_id, $image['post_thumbnail_id'], $size, '' );
		}

		return $html;
	}

	/**
	 * Saves the image URL as the value of the meta key provided.  This allows users to set a custom meta key
	 * for their image.  By doing this, users can trim off database queries when grabbing attachments or get rid
	 * of expensive scans of the content when using the image scan feature.
	 *
	 * @since 0.6.0
	 *
	 * @param array $args Arguments for how to load and display the image.
	 * @param array $image Array of image attributes ($image, $classes, $alt, $caption).
	 */
	static function get_the_image_meta_key_save( $args = array(), $image = array() ) {

		/* If the $meta_key_save argument is empty or there is no image $url given, return. */
		if ( empty( $args['meta_key_save'] ) || empty( $image['src'] ) ) {
			return;
		}

		/* Get the current value of the meta key. */
		$meta = get_post_meta( $args['post_id'], $args['meta_key_save'], true );

		/* If there is no value for the meta key, set a new value with the image $url. */
		if ( empty( $meta ) ) {
			add_post_meta( $args['post_id'], $args['meta_key_save'], $image['src'] );
		} /* If the current value doesn't match the image $url, update it. */
		elseif ( $meta !== $image['src'] ) {
			update_post_meta( $args['post_id'], $args['meta_key_save'], $image['src'], $meta );
		}
	}

	/**
	 * Deletes the image cache for the specific post when the 'save_post' hook is fired.
	 *
	 * @since 0.7.0
	 */
	static function get_the_image_delete_cache_by_post( $post_id ) {
		wp_cache_delete( $post_id, 'heap_get_the_image' );
	}

	/**
	 * Deletes the image cache for a specific post when the 'added_post_meta', 'deleted_post_meta',
	 * or 'updated_post_meta' hooks are called.
	 *
	 * @since 0.7.0
	 */
	static function get_the_image_delete_cache_by_meta( $meta_id, $post_id ) {
		wp_cache_delete( $post_id, 'heap_get_the_image' );
	}

	/**
	 * @since 0.1.0
	 * @deprecated 0.3.0
	 */
	static function get_the_image_link( $deprecated = '', $deprecated_2 = '', $deprecated_3 = '' ) {
		self::get_the_image();
	}

	/**
	 * @since 0.3.0
	 * @deprecated 0.7.0
	 */
	static function image_by_custom_field( $args = array() ) {
		return self::get_the_image_by_meta_key( $args );
	}

	/**
	 * @since 0.4.0
	 * @deprecated 0.7.0
	 */
	static function image_by_the_post_thumbnail( $args = array() ) {
		return self::get_the_image_by_post_thumbnail( $args );
	}

	/**
	 * @since 0.3.0
	 * @deprecated 0.7.0
	 */
	static function image_by_attachment( $args = array() ) {
		return self::get_the_image_by_attachment( $args );
	}

	/**
	 * @since 0.3.0
	 * @deprecated 0.7.0
	 */
	static function image_by_scan( $args = array() ) {
		return self::get_the_image_by_scan( $args );
	}

	/**
	 * @since 0.3.0
	 * @deprecated 0.7.0
	 */
	static function image_by_default( $args = array() ) {
		return self::get_the_image_by_default( $args );
	}

	/**
	 * @since 0.1.0
	 * @deprecated 0.7.0
	 */
	static function display_the_image( $args = array(), $image = false ) {
		return self::get_the_image_format( $args, $image );
	}

	/**
	 * @since 0.5.0
	 * @deprecated 0.7.0 Replaced by cache delete functions specifically for the post ID.
	 */
	static function get_the_image_delete_cache() {
		return;
	}


	/**
	 * We check if there is a gallery shortcode in the content, extract it and
	 * display it in the form of a slideshow.
	 */
	static function gallery_slideshow( $current_post, $template = null ) {
		if ( $template === null ) {

			$image_scale_mode  = get_post_meta( $current_post->ID, '_heap_post_image_scale_mode', true );
			$slider_transition = get_post_meta( $current_post->ID, '_heap_post_slider_transition', true );
			$slider_autoplay   = get_post_meta( $current_post->ID, '_heap_post_slider_autoplay', true );
			if ( $slider_autoplay ) {
				$slider_delay = get_post_meta( $current_post->ID, '_heap_post_slider_delay', true );
			}

			$template = '<div class="wp-gallery" data-royalslider data-customarrows data-sliderpauseonhover data-slidertransition="' . $slider_transition . '" ';
			$template .= ' data-imagescale="' . $image_scale_mode . '" ';
			if ( $slider_autoplay ) {
				$template .= ' data-sliderautoplay="" ';
				$template .= ' data-sliderdelay="' . $slider_delay . '" ';
			}
			if ( $image_scale_mode != 'fill' ) {
				$template .= ' data-imagealigncenter ';
			}
			$template .= '>:gallery</div>';
		}

		// first check if we have a meta with a gallery
		$gallery_ids = array();
		$gallery_ids = get_post_meta( $current_post->ID, '_heap_main_gallery', true );

		if ( ! empty( $gallery_ids ) ) {
			//recreate the gallery shortcode
			$gallery = '[gallery ids="' . $gallery_ids . '"]';

			if ( strpos( $gallery, 'style' ) === false ) {
				$gallery = str_replace( "]", " style='big_thumb' size='blog-big' link='file']", $gallery );
			}

			$shrtcode = do_shortcode( $gallery );

			if ( ! empty( $shrtcode ) ) {
				return strtr( $template, array( ':gallery' => $shrtcode ) );
			} else {
				return null;
			}
		} else { // empty gallery_ids
			// search for the first gallery shortcode
			$gallery_matches = null;
			preg_match( "!\[gallery.+?\]!", $current_post->post_content, $gallery_matches );

			if ( ! empty( $gallery_matches ) ) {
				$gallery = $gallery_matches[0];

				if ( strpos( $gallery, 'style' ) === false ) {
					$gallery = str_replace( "]", " style='big_thumb' size='blog-big' link='file']", $gallery );
				}
				$shrtcode = do_shortcode( $gallery );

				if ( ! empty( $shrtcode ) ) {
					return strtr( $template, array( ':gallery' => $shrtcode ) );
				} else {
					return null;
				}
			} else { // gallery_matches is empty
				return null;
			}
		}
	}

}//Heap_Get_The_Image class
