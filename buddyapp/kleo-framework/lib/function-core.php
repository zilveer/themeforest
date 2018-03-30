<?php

//Theme options
if ( ! function_exists( 'sq_options' ) ) {
	if (is_customize_preview()) {
		function sq_option( $option = false, $default = false )
		{
			return get_theme_mod($option, $default);
		}
	}
}

//array with theme options
global $kleo_options;
$kleo_options = get_theme_mods();

if ( ! function_exists( 'sq_options' ) ) {

	function sq_options() {
		global $kleo_options;

		$output = apply_filters( 'kleo_options', $kleo_options );

		return $output;
	}

}

if ( ! function_exists( 'sq_option' ) ) {

    /**
     * Function to get options in front-end
     * @param string|bool $option The option we need from the DB
     * @param string|bool $default If $option doesn't exist in DB return $default value
     * @return string|array
     */
    function sq_option( $option = false, $default = false, $filters = false )
    {
        if ( $option === FALSE ) {
			return  FALSE;
        }
        global $kleo_options;

        if (isset($kleo_options[$option]) && $kleo_options[$option] !== '') {
			$output_data = $kleo_options[$option];
        } else {
			$output_data = $default;
        }

		if ( $filters === true ) {
			$output_data = apply_filters( 'sq_option', $output_data, $option );
		}

		return $output_data;
    }

}


/**
 * Function to get url options in front-end
 * @param int $option The option we need from the DB
 * @param string $default If $option doesn't exist in DB return $default value
 * @return string
 */
function sq_option_url( $option = false, $default = false )
{
    if( $option === FALSE )
    {
        return FALSE;
    }
    global $kleo_options;

    if(isset($kleo_options[$option]) && is_array($kleo_options[$option]) && isset($kleo_options[$option]['url']) && $kleo_options[$option]['url'] !== '')
    {
        return $kleo_options[$option]['url'];
    }
    elseif( isset($kleo_options[$option]) && $kleo_options[$option] !== '' ) {
		return $kleo_options[$option];
	} else {
        return $default;
    }
}



/*
 * Retrieve custom field
 */
if( ! function_exists( 'get_cfield' ) ) {

	function get_cfield( $meta = NULL, $id = NULL ) {
		if( $meta === NULL ) {
			return false;
		}

		if ( ! $id && ! in_the_loop() && is_home() && get_option( 'page_for_posts' ) ) {
			$id = get_option( 'page_for_posts' );
		}

		if ( $id === NULL ) {
			$id = get_the_ID();
		}

		if ( ! $id && is_page() && function_exists('is_buddypress') && is_buddypress() ) {
			$id = get_queried_object_id();
		}

		if ( ! $id ) {
			return false;
		}

		return get_post_meta( $id, '_kleo_' . $meta, true );
	}
}

/*
 * Echo the custom field
 */
if( ! function_exists('the_cfield')) {
	function the_cfield( $meta = NULL, $id = NULL ) {
		echo get_cfield( $meta, $id );
	}
}


/*
 * Get POST value
 */
if( ! function_exists('get_postval')) {
	function get_postval($val) {
		global $_POST;
		if (isset($_POST[$val]) && !empty($_POST[$val])) {
			return $_POST[$val];
		} else {
			return false;
		}
	}
}

/**
 * Set selected attribute in select form
 * @param string $request
 * @param string $val
 */
if( ! function_exists('set_selected')) {
	function set_selected($request, $val) {
		global $_REQUEST;
		if (isset($_REQUEST[$request]) && $_REQUEST[$request] == $val) {
			echo 'selected="selected"';
		} else {
			echo '';
		}
	}
}
/**
 * Returns selected attribute in select form
 * @param string $request $_REQUEST value
 * @param string $val value to check uppon
 * @param string $default default value if no $_REQUEST is set
 * @return string
 */
if( ! function_exists('get_selected')) {
	function get_selected($request, $val, $default = false) {
		global $_REQUEST;
		if (isset($_REQUEST[$request]) && $_REQUEST[$request] == $val) {
			return 'selected="selected"';
		} elseif (isset($default) && $default == $val)
			return 'selected="selected"';
		else {
			return '';
		}
	}
}


//TRIM WORD
if( ! function_exists('word_trim')) {
	function word_trim($string, $count, $ellipsis = FALSE)
	{
		$words = explode(' ', $string);
		if (count($words) > $count) {
			array_splice($words, $count);
			$string = implode(' ', $words);
			if (is_string($ellipsis)) {
				$string .= $ellipsis;
			} elseif ($ellipsis) {
				$string .= '&hellip;';
			}
		}
		return $string;
	}
}
//TRIM by characters
if( ! function_exists('char_trim')) {
	function char_trim($string, $count = 50, $ellipsis = FALSE)
	{
		$trimstring = substr($string, 0, $count);
		if (strlen($string) > $count) {
			if (is_string($ellipsis)) {
				$trimstring .= $ellipsis;
			} elseif ($ellipsis) {
				$trimstring .= '&hellip;';
			}
		}
		return $trimstring;
	}
}

//GET THE LINK FOR AN ARCHIVE
if ( ! function_exists( 'get_archive_link' ) ) {

  function get_archive_link( $post_type ) {
    global $wp_post_types;
    $archive_link = false;
    if (isset($wp_post_types[$post_type])) {
      $wp_post_type = $wp_post_types[$post_type];
      if ($wp_post_type->publicly_queryable)
        if ($wp_post_type->has_archive && $wp_post_type->has_archive!==true)
          $slug = $wp_post_type->has_archive;
        else if (isset($wp_post_type->rewrite['slug']))
          $slug = $wp_post_type->rewrite['slug'];
        else
          $slug = $post_type;
      $archive_link = get_option( 'siteurl' ) . "/{$slug}/";
    }
    return apply_filters( 'archive_link', $archive_link, $post_type );
  }
}



if ( ! function_exists( 'kleo_pagination' ) ) :
/**
 * Displays pagination where if is required
 *
 * @param string $class - Class for the ul element
 * @since KLEO Framework 1.0
*/
function kleo_pagination( $class = 'pagination' ) {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 3,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => esc_html__( '&laquo;', 'buddyapp' ),
		'next_text' => esc_html__( '&raquo;', 'buddyapp' ),
		'type' => 'array'
	) );

	if ( $links ) :
	?>
	<nav class="pagination-nav clearfix">
		<ul class="<?php echo esc_attr( $class ); ?>">
			<?php
			foreach ($links as $link) {
				echo '<li>' . $link . '</li>';
			}
			?>
		</ul>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;



function get_attachment_id_from_url($url) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$url'";
    return $wpdb->get_var($query);
}


if ( ! function_exists( 'kleo_title' ) ):
	/**
	 *  Return the Page title string
	 */

	function kleo_title()
	{
		/* Allows to override the default theme title */
		$override_title = apply_filters( 'kleo_title_override', '' );

		if ( $override_title && $override_title != '' ) {
			return $override_title;
		}

		$output = "";

		if (is_tag()) {
			$output = __('Tag Archive for:','buddyapp')." ".single_tag_title('',false);
		}
		elseif(is_tax()) {
			$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
			$output = $term->name;
		}
		elseif ( is_category() ) {
			$output = __('Archive for category:', 'buddyapp') . " " . single_cat_title('', false);
		}
		elseif (is_day())
		{
			$output = __('Archive for date:','buddyapp')." ".get_the_time('F jS, Y');
		}
		elseif (is_month())
		{
			$output = __('Archive for month:','buddyapp')." ".get_the_time('F, Y');
		}
		elseif (is_year())
		{
			$output = __('Archive for year:','buddyapp')." ".get_the_time('Y');
		}
		elseif (is_author())  {
			$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			$output = __('Author Archive','buddyapp')." ";

			if( isset( $curauth->nickname ) ) {
				$output .= __('for:','buddyapp')." ".$curauth->nickname;
			}
		}
		elseif ( is_archive() )  {
			$output = post_type_archive_title( '', false );
		}
		elseif (is_search())
		{
			global $wp_query;
			if(!empty($wp_query->found_posts))
			{
				if($wp_query->found_posts > 1)
				{
					$output =  $wp_query->found_posts ." ". __('search results for:','buddyapp')." ".esc_attr( get_search_query() );
				}
				else
				{
					$output =  $wp_query->found_posts ." ". __('search result for:','buddyapp')." ".esc_attr( get_search_query() );
				}
			}
			else
			{
				if( ! empty($_GET['s']) )
				{
					$output = __('Search results for:','buddyapp')." ".esc_attr( get_search_query() );
				}
				else
				{
					$output = __('To search the site please enter a valid term','buddyapp');
				}
			}

		}
		elseif ( is_front_page() && !is_home() ) {
			$output = get_the_title(get_option('page_on_front'));

		} elseif ( is_home() ) {
			if (get_option('page_for_posts')) {
				$output = get_the_title(get_option('page_for_posts'));
			} else {
				$output = __( 'Blog', 'buddyapp' );
			}

		} elseif ( is_404() ) {
			$output = __('Error 404 - Page not found','buddyapp');
		}
		else {
			$output = get_the_title();
		}

		if (isset($_GET['paged']) && !empty($_GET['paged']))
		{
			$output .= " (".__('Page','buddyapp')." ".$_GET['paged'].")";
		}

		$output = apply_filters( 'kleo_title', $output );

		return $output;
	}
endif;


function kleo_compress($buffer) {
	/* remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	/* remove tabs, spaces, newlines, etc. */
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	return $buffer;
}


/**
 * Get the current page url
 * @return string
 */
function kleo_full_url()
{
	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
	$protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")) . $s;
	$port = ($_SERVER["SERVER_PORT"] == "80" || $_SERVER["SERVER_PORT"] == "443") ? "" : (":".$_SERVER["SERVER_PORT"]);
	$uri = $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
	$segments = explode('?', $uri, 2);
	$url = $segments[0];
	$url = str_replace( "www.","",$url );
	return $url;
}


/**
 * Load a template part into a template
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialised template.
 * @param string $vars Variables to pass to the template
 */
function kleo_get_template_part( $slug, $name = null, $vars = null ) {

	/**
	 * Fires before the specified template part file is loaded.
	 *
	 * The dynamic portion of the hook name, `$slug`, refers to the slug name
	 * for the generic template part.
	 *
	 * @since 3.0.0
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialized template.
	 */
    do_action( "get_template_part_{$slug}", $slug, $name );

	$continue = apply_filters( "get_template_part_{$slug}", true );
	if ( ! $continue ) {
		return false;
	}

	if ( is_array( $vars ) ) {
		extract( $vars, EXTR_SKIP );
	}

    $name = (string) $name;
    if ( '' !== $name ) {
        $template = "{$slug}-{$name}.php";
    } else {
        $template = "{$slug}.php";
    }

	$template_path = locate_template( $template );
	if ( $template_path != '' ) {
		include( $template_path );
	}
}

/***************************************************
:: Post type helpers
 ***************************************************/

/**
 * Generate post type labels
 * @param $token
 * @param $singular
 * @param $plural
 * @param $menu
 * @return array|mixed|void
 */
if ( ! function_exists( 'kleo_generate_post_type_labels' ) ) {
	function kleo_generate_post_type_labels( $token = 'context', $singular, $plural, $menu )
	{
		$labels = array(
			'name' => sprintf( _x('%s', 'post type general name', 'buddyapp'), $plural ),
			'singular_name' => sprintf( _x('%s', 'post type singular name', 'buddyapp'), $singular ),
			'add_new' => sprintf( esc_html__( 'Add New %s', 'add new button post', 'buddyapp' ), $singular),
			'add_new_item' => sprintf(esc_html__('Add New %s', 'buddyapp'), $singular),
			'edit_item' => sprintf(esc_html__('Edit %s', 'buddyapp'), $singular),
			'new_item' => sprintf(esc_html__('New %s', 'buddyapp'), $singular),
			'all_items' => sprintf(esc_html__('All %s', 'buddyapp'), $plural),
			'view_item' => sprintf(esc_html__('View %s', 'buddyapp'), $singular),
			'search_items' => sprintf(esc_html__('Search %s', 'buddyapp'), $plural),
			'not_found' => sprintf(esc_html__('No %s found', 'buddyapp'), strtolower($plural)),
			'not_found_in_trash' => sprintf(esc_html__('No %s found in Trash', 'buddyapp'), strtolower($plural)),
			'parent_item_colon' => '',
			'menu_name' => sprintf(esc_html__('%s', 'buddyapp'), $menu)
		);
		$labels = apply_filters( 'kleo_generate_post_type_labels_' . $token, $labels );
		return $labels;
	}
}


/**
 * Get an array of registered post types with different options
 *
 * @param array $args
 * @return array
 */
if ( ! function_exists( 'kleo_post_types' )) {
    function kleo_post_types( $args = array() ) {
        $kleo_post_types = array();

        if (isset($args['extra'])) {
            $kleo_post_types = $args['extra'];
        }

        $post_args = array(
            'public' => true,
            '_builtin' => false
        );

        $types_return = 'objects'; // names or objects, note names is the default
        $post_types = get_post_types($post_args, $types_return);

        if (isset($args['exclude'])) {
            $except_post_types = array( 'topic', 'reply' );
        }

        foreach ($post_types as $post_type) {
            if (isset($except_post_types) && in_array($post_type->name, $except_post_types)) {
                continue;
            }
            $kleo_post_types[$post_type->name] = $post_type->labels->name;
        }

        return $kleo_post_types;
    }
}


/**
 * Return the URL as requested on the current page load by the user agent.
 *
 * @since KLEO (2.4)
 *
 * @return string Requested URL string.
 */
function kleo_get_requested_url() {
	$url  = is_ssl() ? 'https://' : 'http://';
	$url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	return apply_filters( 'kleo_get_requested_url', esc_url($url) );
}



if(!function_exists('kleo_calc_perceived_brightness'))
{
	/**
	 *  calculates if a color is dark or light,
	 *  if a second parameter is passed it will return true or false based on the comparison of the calculated and passed value
	 *  @param string $color hex color code
	 *  @return array $color
	 */
	function kleo_calc_perceived_brightness($color, $compare = false)
	{
		if ( ! $color ) {
			return false;
		}

		$rgba = kleo_hex_to_rgb($color);

		$brightness = sqrt(
			$rgba['r'] * $rgba['r'] * 0.241 +
			$rgba['g'] * $rgba['g'] * 0.691 +
			$rgba['b'] * $rgba['b'] * 0.068);

		if($compare)
		{
			$brightness = $brightness < $compare ? true : false;
		}

		return $brightness;
	}
}

function kleo_hex_to_rgb($hex) {
	$hex = str_replace("#", "", $hex);
	$color = array();

	if(strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex, 0, 1) . $r);
		$color['g'] = hexdec(substr($hex, 1, 1) . $g);
		$color['b'] = hexdec(substr($hex, 2, 1) . $b);
	}
	else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}

	return $color;
}

function kleo_rgb_to_hex($r, $g, $b) {
	$hex = "#";
	$hex.= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
	$hex.= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
	$hex.= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);

	return $hex;
}



/***************************************************
:: CUSTOM EXCERPT
 ***************************************************/

if ( ! function_exists( 'kleo_new_excerpt_length' ) ) {
	function kleo_new_excerpt_length($length) {
		return 60;
	}
	add_filter('excerpt_length', 'kleo_new_excerpt_length');
}

if ( ! function_exists( 'kleo_excerpt' ) ) {
	function kleo_excerpt( $limit = 20 ) {
		$excerpt = explode( ' ', get_the_excerpt(), $limit );
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$excerpt = implode( " ", $excerpt ) . '...';
		} else {
			$excerpt = implode( " ", $excerpt ) . '';
		}
		$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
		return $excerpt ;
	}
}


if ( ! function_exists( 'kleo_has_shortcode' ) ) {
	function kleo_has_shortcode( $shortcode = '', $post_id = null ) {

		if ( ! $post_id ) {
			if ( ! is_singular() ) {
				return false;
			}
			$post_id = get_the_ID();
		}

		if ( is_page() || is_single() ) {
			$current_post = get_post( $post_id );
			$post_content  = $current_post->post_content;
			$found         = false;

			if ( ! $shortcode ) {
				return $found;
			}

			if ( stripos( $post_content, '[' . $shortcode ) !== false ) {
				$found = true;
			}

			return $found;
		} else {
			return false;
		}
	}
}


if (! function_exists('kleo_get_post_thumbnail_url')) {
	/**
	 * Get the Featured image URL of a post
	 * @global object $post
	 * @param int $post_id
	 * @return string
	 */
	function kleo_get_post_thumbnail_url($post_id = null)
	{
		$image_url = '';

		$thumb = get_post_thumbnail_id($post_id);
		//all good. we have a featured image
		$featured_image_url = wp_get_attachment_url($thumb);
		if ($featured_image_url) {
			$image_url = $featured_image_url;
		} elseif (sq_option('blog_get_image', 1) == 1) {
			global $post;
			if (!is_object($post) && $post_id != NULL) {
				$post = setup_postdata(get_post($post_id));
			}
			ob_start();
			ob_end_clean();
			if (isset($post->post_content)) {
				$output = preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>|i', $post->post_content, $matches);
				$image_url = isset($matches[1][0]) ? $matches[1][0] : null;
			}
		}

		//Defines a default image
		if (empty($image_url)) {
			$image_url = sq_option_url('blog_default_image', '');
		}

		return $image_url;
	}
}

/**
 * If the search query has results
 * @return bool
 */
function sq_search_has_results() {
	global $wp_query;

	$result = ( 0 != $wp_query->found_posts ) ? true : false;

	return $result;
}

/**
 * Try to write a file using WP File system API
 *
 * @param string $file_path
 * @param string $contents
 * @param int $mode
 * @return bool
 */
function sq_fs_put_contents( $file_path, $contents, $mode = '' ) {

	/* Frontend or customizer fallback */
	if ( ! function_exists( 'get_filesystem_method' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
	}

	if ( $mode == '' ) {
		if (defined('FS_CHMOD_FILE')) {
			$mode = FS_CHMOD_FILE;
		} else {
			$mode = 0644;
		}
	}

	$context = Kleo::get_config('custom_style_path');
	$allow_relaxed_file_ownership = true;

	if( function_exists( 'get_filesystem_method' ) && get_filesystem_method( array(), $context , $allow_relaxed_file_ownership ) === 'direct' ) {
		/* you can safely run request_filesystem_credentials() without any issues and don't need to worry about passing in a URL */
		$creds = request_filesystem_credentials( site_url() . '/wp-admin/', '', false, $context, null, $allow_relaxed_file_ownership );

		/* initialize the API */
		if ( ! WP_Filesystem( $creds, $context, $allow_relaxed_file_ownership ) ) {
			/* any problems and we exit */
			return false;
		}

		global $wp_filesystem;
		/* do our file manipulations below */

		$wp_filesystem->put_contents( $file_path, $contents, $mode );

		return true;

	} else {
		return false;
	}
}


/**
 * Try to get a file content using WP File system API
 * @param $file_path
 * @return bool
 */
function sq_fs_get_contents( $file_path ) {

	/* Frontend or customizer fallback */
	if ( ! function_exists( 'get_filesystem_method' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
	}

	$context = Kleo::get_config('custom_style_path');
	$allow_relaxed_file_ownership = true;

	if( function_exists( 'get_filesystem_method' ) && get_filesystem_method( array(), $context , $allow_relaxed_file_ownership ) === 'direct' ) {
		/* you can safely run request_filesystem_credentials() without any issues and don't need to worry about passing in a URL */
		$creds = request_filesystem_credentials( site_url() . '/wp-admin/', '', false, $context, null, $allow_relaxed_file_ownership );

		/* initialize the API */
		if ( ! WP_Filesystem( $creds, $context, $allow_relaxed_file_ownership ) ) {
			/* any problems and we exit */
			return false;
		}

		global $wp_filesystem;
		/* do our file manipulations below */

		return $wp_filesystem->get_contents( $file_path );

	} else {
		return false;
	}
}