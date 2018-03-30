<?php 
if ( ! function_exists( 'ci_generator_tag' ) ):
function ci_generator_tag( $gen, $type ) {
	if ( apply_filters( 'ci_show_generator_tag', true ) && // Should not be shown if the filter evaluates to false
	     ! CI_WHITELABEL                                && // Should not be shown if the theme is white-labeled
	     ci_setting( 'ci_show_generator_tag' ) == 'on'     // Should not be shown if not enabled by the Panel
	) {
		if ( 'html' == $type ) {
			$gen .= PHP_EOL . '<meta name="generator" content="' . esc_attr( 'CSSIgniter - ' . CI_THEME_NICENAME ) . '">';
		} elseif ( 'xhtml' == $type ) {
			$gen .= PHP_EOL . '<meta name="generator" content="' . esc_attr( 'CSSIgniter - ' . CI_THEME_NICENAME ) . '" />';
		}
	}

	return $gen;
}
endif;


if( !function_exists('array_insert') ):
/**
 * Inserts array elements into a specific position.
 *
 * @param array $array The array to add elements to.
 * @param array $elements An array with the elements that you want to insert.
 * @param string $position 'before' or 'after' to add the elements before or after $key respectively.
 * @param string|int $key The key of the array that you want to insert elements at.
 * @param string $default_position If $key is not found in $array, $elements will be appended on 'start' or 'end' of the array. Default 'end'.
 */
function array_insert( &$array, $elements, $position, $key, $default_position = 'end' ) {
	$found = array_search( $key, array_keys( $array ) );
	if( $found === false ) {
		if( 'end' == $default_position ) {
			$array = array_merge( $array, $elements );
		} else {
			$array = array_merge( $elements, $array );
		}
	} else {
		$position = $position == 'before' ? 0 : 1;

//		$a1 = array_slice( $array, 0, $found + $position, true );
//		$a2 = array_slice( $array, $found + $position, null, true );
//		$array = array_merge( $a1, $elements, $a2 );
		// The lines above are the same (expanded) as the one below. Left for debugging purposes.
		$array = array_merge( array_slice( $array, 0, $found + $position, true ), $elements, array_slice( $array, $found + $position, null, true ) );
	}
}
endif;



if( !function_exists('ci_get_image_sizes') ):
/**
 * Returns an array of currently declared image sizes.
 *
 * @global $_wp_additional_image_sizes
 *
 * @return array An associative array where the key is the image size name and the value is an array of attributes.
 */
function ci_get_image_sizes() {
	/*
	 * Returns the following format:
	 *
	 * array(
	 *      'sizename' => array(
	 *          'width'  => int,
	 *          'height' => int,
	 *          'crop'   => boolean
	 *      )
	 * )
	 */
	global $_wp_additional_image_sizes;
	return $_wp_additional_image_sizes;
}
endif;


if( !function_exists('ci_get_related_posts') ):
/**
 * Returns a set of related posts, or the arguments needed for such a query.
 *
 * @uses wp_parse_args()
 * @uses get_post_type()
 * @uses get_post()
 * @uses get_object_taxonomies()
 * @uses get_the_terms()
 * @uses wp_list_pluck()
 *
 * @param int $post_id A post ID to get related posts for.
 * @param int $related_count The number of related posts to return.
 * @param array $args Array of arguments to change the default behavior.
 * @return object|array A WP_Query object with the results, or an array with the query arguments.
 */
function ci_get_related_posts( $post_id, $related_count, $args = array() ) {
	$args = wp_parse_args( (array) $args, array(
		'orderby' => 'rand',
		'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
	) );

	$post_type = get_post_type( $post_id );
	$post = get_post( $post_id );

	$term_list = array();
	$query_args = array();
	$tax_query = array();
	$taxonomies = get_object_taxonomies( $post, 'names' );

	foreach( $taxonomies as $taxonomy ) {
		$terms = get_the_terms( $post_id, $taxonomy );
		if ( is_array($terms) and count($terms) > 0 ) {
			$term_list = wp_list_pluck( $terms, 'slug' );
			$term_list = array_values( $term_list );
			if ( !empty($term_list) ) {
				$tax_query['tax_query'][] = array(
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $term_list
				);
			}
		}
	}

	if( count( $taxonomies ) > 1 ) {
		$tax_query['tax_query']['relation'] = 'OR';
	}


	$query_args = array(
		'post_type'      => $post_type,
		'posts_per_page' => $related_count,
		'post_status'    => 'publish',
		'post__not_in'   => array( $post_id ),
		'orderby'        => $args['orderby']
	);

	if( $args['return'] == 'query' ) {
		return new WP_Query( array_merge( $query_args, $tax_query ) );
	} else {
		return array_merge( $query_args, $tax_query );
	}
}
endif;

if( !function_exists('ci_get_page_var') ):
/**
 * Returns the appropriate page(d) query variable to use in custom loops (needed for pagination).
 *
 * @uses get_query_var()
 *
 * @param int $default_return The default page number to return, if no query vars are set.
 * @return int The appropriate paged value if found, else 0.
 */
function ci_get_page_var( $default_return = 0 )
{
	$paged = get_query_var('paged', false);
	$page = get_query_var('page', false);

	if($paged === false && $page === false){
		return $default_return;
	}

	return max($paged, $page);
}
endif;

if( !function_exists('ci_get_template_part') ):
/**
 * Load a template part into a template, optionally passing an associative array
 * that will be available as variables.
 *
 * Makes it easy for a theme to reuse sections of code in a easy to overload way
 * for child themes.
 *
 * Includes the named template part for a theme or if a name is specified then a
 * specialised part will be included. If the theme contains no {slug}.php file
 * then no template will be included.
 *
 * The template is included using require, not require_once, so you may include the
 * same template part multiple times.
 *
 * For the $name parameter, if the file is called "{slug}-special.php" then specify
 * "special".
 *
 * When $data is an array, the key of each value becomes the name of the variable,
 * and the value becomes the variable's value.
 *
 * $data_overwrite should be one of the extract() flags, as described in http://www.php.net/extract
 *
 * @uses locate_template()
 * @uses do_action() Calls 'get_template_part_{$slug}' action.
 * @uses do_action() Calls 'ci_get_template_part_{$slug}' action.
 *
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialised template.
 * @param array $data A key-value array of data to be available as variables.
 * @param int $data_overwrite The EXTR_* constant to pass to extract( $data ).
 */
function ci_get_template_part($slug, $name = null, $data = array(), $data_overwrite = EXTR_PREFIX_SAME)
{
	// Code similar to get_template_part() as of WP v3.8.1

	// Retain the same action hook, so that calls to our function respond to the same hooked functions.
	do_action( "get_template_part_{$slug}", $slug, $name );

	// Add our own action hook, so that we can hook using $data also.
	do_action( "ci_get_template_part_{$slug}", $slug, $name, $data );

	$templates = array();
	$name = (string) $name;
	if ( '' !== $name )
		$templates[] = "{$slug}-{$name}.php";

	$templates[] = "{$slug}.php";

	// Don't load the template ( it would normally call load_template() )
	$_template_file = locate_template($templates, false, false);

	// Code similar to load_template()
	global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

	if ( is_array( $wp_query->query_vars ) )
		extract( $wp_query->query_vars, EXTR_SKIP );

	if ( is_array( $data ) and (count( $data ) > 0) )
		extract( $data, $data_overwrite, 'imp' );

	require( $_template_file );
}
endif;

if ( ! function_exists( 'ci_human_time_diff' ) ):
function ci_human_time_diff( $from, $to = '' ) {
	if ( empty( $to ) ) {
		$to = date_i18n( 'U' );
	}

	$since = '';
	$diff  = (int) abs( $to - $from );

	if ( $diff < MINUTE_IN_SECONDS ) {
		$since = __( 'Less than a minute ago', 'ci_theme' );
	} elseif ( $diff <= HOUR_IN_SECONDS ) {
		$mins = round( $diff / 60 );
		if ( $mins <= 1 ) {
			$mins = 1;
		}
		$since = sprintf( _n( '%s minute ago', '%s minutes ago', $mins, 'ci_theme' ), $mins );
	} elseif ( ( $diff < DAY_IN_SECONDS ) && ( $diff > HOUR_IN_SECONDS ) ) {
		$hours = round( $diff / HOUR_IN_SECONDS );
		if ( $hours <= 1 ) {
			$hours = 1;
		}
		$since = sprintf( _n( '%s hour ago', '%s hours ago', $hours, 'ci_theme' ), $hours );
	} elseif ( $diff >= DAY_IN_SECONDS && $diff < ( DAY_IN_SECONDS * 30 ) ) {
		$days = round( $diff / DAY_IN_SECONDS );
		if ( $days <= 1 ) {
			$days = 1;
		}
		$since = sprintf( _n( '%s day ago', '%s days ago', $days, 'ci_theme' ), $days );
	} elseif ( $diff >= ( DAY_IN_SECONDS * 30 ) ) {
		$months = round( $diff / ( DAY_IN_SECONDS * 30 ) );
		if ( $months <= 1 ) {
			$months = 1;
		}
		$since = sprintf( _n( '%s month ago', '%s months ago', $months, 'ci_theme' ), $months );
	}

	return $since;
	
}
endif;


if( !function_exists('get_child_or_parent_file_uri')):
function get_child_or_parent_file_uri($path)
{
	if(file_exists(get_stylesheet_directory().$path))
		return get_stylesheet_directory_uri().$path;
	else
		return get_template_directory_uri().$path;
}
endif;

if( !function_exists('get_child_or_parent_file_path')):
function get_child_or_parent_file_path($path)
{
	if(file_exists(get_stylesheet_directory().'/'.$path))
		return get_stylesheet_directory().'/'.$path;
	elseif(file_exists(get_template_directory().'/'.$path))
		return get_template_directory().'/'.$path;
	else
		return '';
}
endif;

if( !function_exists('ci_column_classes') ):
/**
 * Returns a list of class names as a string, depending on the values of $cols_number and $parent_cols.
 * Can't be used nested or recursively.
 * 
 * @access public
 * @param int|string $cols_number Valid values are 1 through 16 and '1-1-1', '1-1', '1-2' and '2-1'
 * @param int $parent_cols Valid values are 1 through 16
 * @param bool $reset Reset the internal counter. Should be called with $reset=true at least once, before looping.
 * @return string List of space-separated class names.
 */
function ci_column_classes($cols_number, $parent_cols=16, $reset=false) 
{
	// Temporary until I fix all references.
	if($parent_cols===true or $parent_cols===false)
	{
		$reset = $parent_cols;
		$parent_cols = 16;
	}

	static $i = 1;

	if($reset) {
		$i = 1;
		return;
	}


	if(is_integer($parent_cols) and !is_string($parent_cols))
	{ 
		$defined_classes = array( 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen', 16 => 'sixteen');
	
		if($cols_number == 3 and $parent_cols == 16)
		{
			$classes[] = 'one-third';
		}
		else
		{
			// if parent_cols = 10 and cols_number = 2, 10/2=5='five'
			// if parent_cols = 9 and cols_number = 3, 9/3=5='three'
			$classes[] = $defined_classes[intval($parent_cols / $cols_number)];
		}

	}
	elseif(is_string($parent_cols))
	{
		$combinations = array( '1-1-1', '1-2', '2-1', '1-1' );
		$thirds = array( 1 => 'one-third', 2 => 'two-thirds' );
		
		if( !in_array($parent_cols, $combinations) ) return '';
		$cols = explode('-', $parent_cols);

		$classes[] = $thirds[ intval($cols[$i-1]) ];
	}
	else
	{
		return '';
	}

	if($i == 1) 
	{
		$classes[] = ' alpha';
	}
	
	if($i == $cols_number)
	{ 
		$classes[] = ' omega';
		$i = 0;
	}
	
	$i++;
	
	$classes = apply_filters('ci_column_classes', $classes);
	return implode(' ', $classes);
}
endif;



if( !function_exists('ci_theme_classes')):
/**
 * Returns an associative array of theme-dependend strings, that can be used as class names.
 * 
 * @access public
 * @return array
 */
function ci_theme_classes()
{
	$version = str_replace('.', '-', CI_THEME_VERSION);
	$classes['theme'] = "ci-" . CI_THEME_NAME;
	$classes['theme_version'] = "ci-" . CI_THEME_NAME . '-' . $version;

	$scheme = ci_setting('stylesheet');
	if( !empty($scheme) )
	{
		if( substr_right($scheme, 4) == '.css' )
			$name = basename($scheme, '.css');
		else
			$name = basename($scheme);

		$classes['theme_color_scheme'] = sanitize_html_class('ci-scheme-'.$name);
	}

	return $classes;
}
endif;

if( !function_exists('ci_body_class_names')):
function ci_body_class_names($classes) {
	$ci_classes = ci_theme_classes();
	return array_merge($classes, $ci_classes);
}	
endif;

if ( ! function_exists( 'ci_e_content' ) ):
/**
 * Echoes the content or the excerpt, depending on user preferences.
 * 
 * @access public
 * @return void
 */
function ci_e_content( $more_link_text = null, $stripteaser = false ) {
	if ( is_singular() ) {
		if ( is_main_query() ) {
			the_content();
		} else {
			the_excerpt();
		}
	} elseif ( is_home() || is_archive() ) {
		if ( ci_setting( 'preview_content' ) == 'enabled' ) {
			the_content( $more_link_text, $stripteaser );
		} else {
			the_excerpt();
		}
	} else {
		the_excerpt();
	}
}
endif;

if( !function_exists('ci_inflect')):
/**
 * Returns a string depending on the value of $num.
 * 
 * When $num equals zero, string $none is returned.
 * When $num equals one, string $one is returned.
 * When $num is any other number, string $many is returned.
 * 
 * @access public
 * @param int $num
 * @param string $none
 * @param string $one
 * @param string $many
 * @return string
 */
function ci_inflect($num, $none, $one, $many){
	if ( $num == 0 ) {
		return $none;
	} elseif ( $num == 1 ) {
		return $one;
	} else {
		return $many;
	}
}
endif;

if( !function_exists('ci_e_inflect')):
/**
 * Echoes a string depending on the value of $num.
 * 
 * When $num equals zero, string $none is echoed.
 * When $num equals one, string $one is echoed.
 * When $num is any other number, string $many is echoed.
 * 
 * @access public
 * @param int $num
 * @param string $none
 * @param string $one
 * @param string $many
 * @return void
 */
function ci_e_inflect($num, $none, $one, $many){
	echo ci_inflect($num, $none, $one, $many);
}
endif;


if( !function_exists('ci_list_cat_tag_tax')):
/**
 * Returns a string of all the categories, tags and taxonomies the current post is under.
 * 
 * @access public
 * @param string $separator
 * @return string
 */
function ci_list_cat_tag_tax($separator=', ')
{
	global $post;

	$taxonomies = get_post_taxonomies();

	$i = 0;
	$the_terms = array();
	$the_terms_temp = array();
	$the_terms_list = '';
	foreach($taxonomies as $taxonomy)
	{
		$the_terms_temp[] = get_the_term_list($post->ID, $taxonomy, '', $separator, '');
	}

	foreach($the_terms_temp as $term)
	{
		if(!empty($term))
			$the_terms[] = $term;
	}
	
	$terms_count = count($the_terms);
	for($i=0; $i < $terms_count; $i++)
	{
		$the_terms_list .= $the_terms[$i];
		if ($i < ($terms_count-1))
			$the_terms_list .= $separator;
	}
	
	if (!empty($the_terms_list))
		return $the_terms_list;	
	else
		return __('Uncategorized', 'ci_theme');
}
endif;

if( !function_exists('ci_e_list_cat_tag_tax')):
/**
 * Echoes a string of all the categories, tags and taxonomies the current post is under.
 * 
 * @access public
 * @param string $separator
 * @return void
 */
function ci_e_list_cat_tag_tax($separator=', ')
{
	echo ci_list_cat_tag_tax($separator);
}
endif;



if( !function_exists('ci_pagination')):
/**
 * Echoes pagination links if applicable. Output depends on pagination method selected from the panel.
 * 
 * @param array $args An array of arguments to change default behavior.
 * @param object|bool $query A WP_Query object to paginate. Defaults to boolean false and uses the global $wp_query
 * @return void
 */
function ci_pagination($args = array(), $query = false)
{ 
	global $wp_query;
	$defaults = apply_filters('ci_pagination_default_args', array(
		'container_id' => 'paging',
		'container_class' => 'navigation group',
		'prev_link_class' => 'nav-prev alignleft shadow',
		'next_link_class' => 'nav-next alignright shadow',
		'prev_text' => __('Older posts', 'ci_theme'),
		'next_text' => __('Newer posts', 'ci_theme'),
		'wp_pagenavi_params' => array(),
		'paginate_links_params' => array()
	));
	$args = wp_parse_args( $args, $defaults );

	// Let's handle the $query first, as all pagination methods depend on it.
	if( 'object' == gettype($query) and 'WP_Query' == get_class($query) )
	{
		$args['wp_pagenavi_params']['query'] = $query;
	}
	else
	{
		$query = $wp_query;
	}

	// Set things up for paginate_links()
	$unreal_pagenum = 999999999;
	$permastruct = get_option('permalink_structure');
	$paginate_links_defaults = array(
		'base' => str_replace( $unreal_pagenum, '%#%', esc_url( get_pagenum_link( $unreal_pagenum ) ) ),
		'format' => empty( $permastruct ) ? '&page=%#%' : 'page/%#%/',
		'total' => $query->max_num_pages,
		'current' => max( 1, get_query_var('paged'), get_query_var('page') ),
	);
	$paginate_links_args = wp_parse_args($args['paginate_links_params'], $paginate_links_defaults);
	
	$pagenavi_exists = function_exists('wp_pagenavi');
	$method = ci_setting('pagination_method');
	$use_pagination = 'prevnext';

	// Let's determine what to use.
	if( 'paginate_links' == $method )
	{
		$use_pagination = 'paginate_links';
	}
	else
	{
		// If WP-PageNavi is enabled and is explicitly selected, then it executes.
		// It also executes if enabled, and no pagination method is selected (as it
		// worked before introduction of paginate_links() support)
		if( ($pagenavi_exists and 'wp_pagenavi' == $method) or
			($pagenavi_exists and empty($method)) )
		{
			$use_pagination = 'wp_pagenavi';
		}
		// If WP-PageNavi is not availabe, or it wasn't selected (and paginate_links is not selected)
		// fall back to PrevNext links. Also handles implied $use_pagination == 'prevnext'.
		else
		{
			$use_pagination = 'prevnext';
		}
	}

	if ($query->max_num_pages > 1): ?>
		<div 
			<?php echo (empty($args['container_id']) ? '' : 'id="'.$args['container_id'].'"'); ?> 
			<?php echo (empty($args['container_class']) ? '' : 'class="'.$args['container_class'].'"'); ?>
		>
			<?php
				switch( $use_pagination ){
					case 'paginate_links':
						echo paginate_links($paginate_links_args);
						break;

					case 'wp_pagenavi':
						wp_pagenavi($args['wp_pagenavi_params']);
						break;

					case 'prevnext':
					default:
						?>
						<div <?php echo (empty($args['prev_link_class']) ? '' : 'class="'.$args['prev_link_class'].'"'); ?>><?php next_posts_link( '<span class="nav-prev-symbol nav-symbol">&laquo;</span> ' . $args['prev_text'], $query->max_num_pages ); ?></div>
						<div <?php echo (empty($args['next_link_class']) ? '' : 'class="'.$args['next_link_class'].'"'); ?>><?php previous_posts_link( $args['next_text'] . ' <span class="nav-next-symbol nav-symbol">&raquo;</span>', $query->max_num_pages ); ?></div>
						<?php
						break;
				}
			?>
		</div>
	<?php endif;
}
endif;


if( !function_exists('ci_e_setting')):
/**
 * Echoes a CSSIgniter setting.
 * 
 * @access public
 * @param string $setting
 * @return void
 */
function ci_e_setting( $setting ) {
	echo ci_setting( $setting );
}
endif;

if( !function_exists('ci_setting')):
/**
 * Returns a CSSIgniter setting, or boolean FALSE on failure.
 * 
 * @access public
 * @param string $setting
 * @return mixed|false
 */
function ci_setting( $setting ) {
	global $ci;

	$value = false;

	if ( isset( $ci[ $setting ] ) and ( ! empty( $ci[ $setting ] ) ) ) {
		$value = $ci[ $setting ];
	}

	return apply_filters( 'ci_setting', $value, $setting );
}
endif;


if( !function_exists('ci_logo')):
/**
 * Returns the CSSIgniter logo snippet, either text or image if available.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return string
 */
function ci_logo($before="", $after=""){ 
	$snippet = $before;
		
    $snippet .= '<a href="'.home_url().'">';

    if(ci_setting('logo')){
		$snippet .= '<img src="'.ci_setting('logo').'" alt="'.get_bloginfo('name').'" />';
	} 
	else{
		$snippet .= get_bloginfo('name');
	}

    $snippet .= '</a>';
    
    $snippet .= $after;

    return $snippet;
}
endif;

if( !function_exists('ci_e_logo')):
/**
 * Echoes the CSSIgniter logo snippet, either text or image if available.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return void
 */
function ci_e_logo($before="", $after=""){ 
	echo ci_logo($before, $after);
}
endif;


if( !function_exists('ci_slogan')):
/**
 * Returns the CSSIgniter slogan snippet, surrounded by optional strings.
 * When slogan is empty, false is returned.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return string
 */
function ci_slogan( $before = '', $after = '' ) {
	$slogan  = get_bloginfo( 'description' );
	$snippet = $before . $slogan . $after;
	if ( ! empty( $slogan ) ) {
		return $snippet;
	} else {
		return false;
	}
}
endif;

if( !function_exists('ci_e_slogan')):
/**
 * Echoes the CSSIgniter slogan snippet, surrounded by optional strings.
 * When slogan is empty, or 'show_site_slogan' option is not 'on', nothing is echoed.
 * 
 * @access public
 * @param string $before Text or tag before the snippet.
 * @param string $after Text or tag after the snippet.
 * @return void
 */
function ci_e_slogan( $before = '', $after = '' ) {
	$slogan = get_bloginfo( 'description' );
	if ( ! empty( $slogan ) && 'off' != ci_setting( 'show_site_slogan' ) ) {
		echo $before . $slogan . $after;
	}
}
endif;

if( !function_exists('ci_footer')):
/**
 * Returns the footer text, set from the CSSIgniter panel.
 * 
 * @access public
 * @param string $location Specify a different footer location to return the text for (currently, only 'scondary' is valid).
 * @return string
 */
function ci_footer($location = false){ 
	$setting = 'ci_footer_credits';
	if(!empty($location))
	{
		$setting .= '_' . $location;
	}
	
	$allowed_tags = implode('', apply_filters('ci_footer_allowed_tags', array('<a>','<b>','<strong>','<i>','<em>','<span>')));

	$text = ci_setting($setting);
	$text = html_entity_decode($text);
	$text = strip_tags($text, $allowed_tags);

	// Parse "variables"
	$text = preg_replace('/:year:/', date('Y'), $text);
	
	return $text;
}
endif;


if( !function_exists('logo_class')):
function logo_class() {
	echo get_logo_class();
}
endif;

if( !function_exists('get_logo_class')):
function get_logo_class() {
	return ci_setting('logo') != '' ? 'imglogo' : 'textual';
}
endif;


if( !function_exists('ci_last_update')):
/**
 * Returns the date and time of the last posted post.
 * 
 * @access public
 * @return array
 */
function ci_last_update()
{
	global $post;
	$old_post = $post;
	$data = array();
	$posts = get_posts('posts_per_page=1&order=DESC&orderby=date');
	foreach ($posts as $post)
	{
		setup_postdata($post);	
		$data['date'] = get_the_date();
		$data['time'] = get_the_time();
	}
	$post = $old_post;
	setup_postdata($post);
	return $data;
}
endif;


if( !function_exists('has_readmore')):
/**
 * Checks whether the current post has a Read More tag. Must be used inside the loop.
 * 
 * @access public
 * @return true|false
 */
function has_readmore()
{
	global $post;
	if(strpos(get_the_content(), "#more-")===FALSE)
		return FALSE;
	else
		return TRUE;
}
endif;

if( !function_exists('has_page_template')):
/**
 * Checks whether a page uses a specific page template.
 * 
 * @access public
 * @param string $page_template The page template you want to check if it's used.
 * @param int $pageid (Optional) The post id of the page you want to check. If null, checks the global post id.
 * @return true|false
 */
function has_page_template($page_template, $pageid=null)
{
	$template = get_template_of_page($pageid);
	if($template == $page_template)
	{
		return TRUE;
	}
	return FALSE;
}
endif;

if( !function_exists('get_template_of_page')):
/**
 * Returns the page template that is used on a specific page.
 * 
 * @access public
 * @param int $pageid (Optional) The post id of the page you want to check. If null, checks the global post id.
 * @return true|false
 */
function get_template_of_page($pageid=null)
{
	if ($pageid===null)
	{
		global $post;
		$pageid = $post->ID;
	}
	return get_post_meta($pageid, '_wp_page_template', true);
}
endif;


if( !function_exists('absint_or_empty')):
/**
 * Return a positive integer value, or an empty string instead of zero.
 *
 * @uses absint()
 *
 * @param mixed $value A value to convert to integer.
 * @return Empty string on zero, or a positive integer.
 */
function absint_or_empty($value)
{
	$value = absint($value);
	if($value == 0)
		return '';
	else
		return $value;
}
endif;


if( !function_exists('wp_dropdown_posts')):
/**
 * Retrieve or display list of posts as a dropdown (select list).
 *
 * @since 2.1.0
 *
 * @param array|string $args Optional. Override default arguments.
 * @param string $name Optional. Name of the select box.
 * @return string HTML content, if not displaying.
 */
function wp_dropdown_posts($args = '', $name='post_id') {
	$defaults = array(
		'depth'                 => 0,
		'post_parent'           => 0,
		'selected'              => 0,
		'echo'                  => 1,
		//'name'                  => 'page_id', // With this line, get_posts() doesn't work properly.
		'id'                    => '',
		'class'                 => '',
		'show_option_none'      => '',
		'show_option_no_change' => '',
		'option_none_value'     => '',
		'post_type'             => 'post',
		'post_status'           => 'publish',
		'suppress_filters'      => false,
		'numberposts'           => -1,
		'select_even_if_empty'  => false, // If no posts are found, an empty <select> will be returned/echoed.
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	$hierarchical_post_types = get_post_types( array( 'hierarchical' => true ) );
	if ( in_array( $r['post_type'], $hierarchical_post_types ) ) {
		$pages = get_pages($r);
	} else {
		$pages = get_posts($r);
	}

	$output = '';
	// Back-compat with old system where both id and name were based on $name argument
	if ( empty($id) )
		$id = $name;

	if ( ! empty($pages) || $select_even_if_empty == true ) {
		$output = "<select name='" . esc_attr( $name ) . "' id='" . esc_attr( $id ) . "' class='" . esc_attr( $class ) . "'>\n";
		if ( $show_option_no_change ) {
			$output .= "\t<option value=\"-1\">$show_option_no_change</option>";
		}
		if ( $show_option_none ) {
			$output .= "\t<option value=\"" . esc_attr( $option_none_value ) . "\">$show_option_none</option>\n";
		}
		if ( ! empty($pages) ) {
			$output .= walk_page_dropdown_tree($pages, $depth, $r);
		}
		$output .= "</select>\n";
	}

	$output = apply_filters('wp_dropdown_posts', $output, $name, $r);

	if ( $echo )
		echo $output;

	return $output;
}
endif;

if( !function_exists('woocommerce_enabled')):
/**
 * Determine if the WooCommerce plugin is enabled.
 *
 * @return bool True if enabled, false otherwise.
 */
function woocommerce_enabled()
{
	if(class_exists('Woocommerce'))
		return true;
	else
		return false;
}
endif;


if( !function_exists('mb_str_replace')):
/**
 * Multi-byte version of str_replace.
 *
 * @param string $needle The value being searched.
 * @param string $replacement The value that replaces the found needle.
 * @param string $haystack The string being searched and replaced on.
 * @return string
 */
function mb_str_replace($needle, $replacement, $haystack)
{
	return implode($replacement, mb_split($needle, $haystack));
}
endif;


if( !function_exists('substr_left')):
/**
 * Returns the n-th first characters of a string.
 * Uses substr() so return values are the same.
 *
 * @param string $string The string to get the characters from.
 * @param string $length The number of characters to return.
 * @return string
 */
function substr_left($string, $length)
{
	return substr($string, 0, $length);
}
endif;

if( !function_exists('substr_right')):
/**
 * Returns the n-th last characters of a string.
 * Uses substr() so return values are the same.
 *
 * @param string $string The string to get the characters from.
 * @param string $length The number of characters to return.
 * @return string
 */
function substr_right($string, $length)
{
	return substr($string, -$length, $length);
}
endif;


if( !function_exists('merge_wp_queries') ):
/**
 * Merges multiple WP_Queries by accepting any number of valid, discreet parameter arrays.
 * It runs each query individually, merges the (unique) post IDs, and re-queries the DB for those IDs, respecting their order.
 * Uses WP_Query() so parameters and return values are the same.
 * Depends on sort_query_by_post_in() hooked to 'posts_orderby' in order to preserve the order of the IDs.
 *
 * @param array $arr_1 A valid WP_Query() parameters' array.
 * @param array $arr_2 A valid WP_Query() parameters' array.
 * @param array $arr_n A valid WP_Query() parameters' array.
 * @return WP_Query object
 */
function merge_wp_queries()
{
	global $post;
	$args = func_get_args();

	if($args < 2)
		return new WP_Query();

	$merged = array();
	
	$post_types = array();
	$all_post_types = array(); // Will not be reset on iterations, so that there is a record of all post types needed.
	// Let's handle each query.
	foreach($args as $arg)
	{
		// How many posts to get
		$numberposts = -1;
		if(!empty($arg['posts_per_page']))
			$numberposts = $arg['posts_per_page'];
		elseif(!empty($arg['numberposts']))
			$numberposts = $arg['numberposts'];
		elseif(!empty($arg['showposts']))
			$numberposts = $arg['showposts'];
		
		$arg['posts_per_page'] = $numberposts;
		
		// Make sure only IDs will be returned. We want the query to be lightweight.
		$arg['fields'] = 'ids';

		// What post types to retrieve
		if(!empty($arg['post_type']))
		{
			$post_types = $arg['post_type'];
			
			// Keep the post type(s) for later use.
			if(is_array($post_types))
				$all_post_types = array_merge($all_post_types, $post_types);
			else
				$all_post_types[] = $post_types;
		}
		
		$this_posts = new WP_Query($arg);

		foreach($this_posts->posts as $p)
		{
			$merged[] = $p;
		}

		wp_reset_postdata();
		
	}
	$all_post_types = array_unique($all_post_types);

	$merged = array_unique($merged);

	if(count($merged==0))
		$merged[]=0;

	$params = array(
		'post__in' => $merged,
		'post_type' => $all_post_types,
		'posts_per_page' => -1,
		'suppress_filter' => false,
		'orderby' => 'post__in'
	);

	$params = apply_filters('merge_wp_queries', $params, $args);

	$merged_query = new WP_Query( $params );

	return $merged_query;
}
endif;



if( !function_exists('is_curl_installed') ):
function is_curl_installed()
{
	if( in_array('curl', get_loaded_extensions()) )
		return true;
	else
		return false;
}
endif;


if( !function_exists('ci_get_image_src') ):
/**
 * Returns just the URL of an image attachment.
 *
 * @param int $image_id The Attachment ID of the desired image.
 * @param string $size The size of the image to return.
 * @return bool|string False on failure, image URL on success.
 */
function ci_get_image_src( $image_id, $size = 'full' )
{
	$img_attr = wp_get_attachment_image_src( intval($image_id), $size );
	if(!empty($img_attr[0]))
	{
		return $img_attr[0];
	}
}
endif;

if( !function_exists('ci_get_featured_image_src') ):
/**
 * Returns just the URL of the featured image.
 *
 * @param string $size The size of the image to return.
 * @param int|bool $post_id The post's ID of which to get the featured image. Default to false, to get the current post ID if in the loop.
 * @return bool|string False on failure, image URL on success.
 */
function ci_get_featured_image_src( $size, $post_id = false )
{
	if($post_id===false)
	{
		global $post;
		$post_id = $post->ID;
	}

	if( has_post_thumbnail( $post_id ) )
	{
		return ci_get_image_src( get_post_thumbnail_id($post_id), $size );
	}
	
	return false;
}
endif;


if ( !function_exists('ci_the_month') ):
/**
 * Returns a textual representation of a month.
 *
 * @param int $m The number of a month, e.g. 1 for January
 * @param string $format The desired format to return. E.g. 'M' for Jan, 'F' for January
 * @return string Textual representation of the passed month.
 */
function ci_the_month($m, $format = 'M') {
	$t = mktime(0, 0, 0, $m, 1, 2000);
	return date_i18n($format, $t);
}
endif;


if ( !function_exists('ci_sanitize_hex_color') ):
/**
 * Returns a sanitized hex color code.
 *
 * @param string $str The color string to be sanitized.
 * @param bool $return_hash Whether to return the color code prepended by a hash.
 * @param string $return_fail The value to return on failure.
 * @return string A valid hex color code on success, an empty string on failure.
 */
function ci_sanitize_hex_color($str, $return_hash = true, $return_fail = '')
{

	// Include the hash if not there.
	// The regex below depends on in.
	if(substr($str, 0, 1)!='#')
	{
		$str = '#' . $str;
	}

	$matches = array();
	/*
	 * Example on success:
	 * $matches = array(
	 * 		[0] => #1a2b3c
	 * 		[1] => #
	 * 		[2] => 1a2b3c
	 * )
	 *
	 */
	preg_match('/(#)([0-9a-fA-F]{6})/', $str, $matches);

	if(count($matches) == 3)
	{
		if($return_hash)
			return $matches[1] . $matches[2];
		else
			return $matches[2];
	}
	else
	{
		return $return_fail;
	}
}
endif;

if( !function_exists('ci_sanitize_checkbox')):
/**
 * Sanitizes a checkbox value, by comparing $input with $allowed_value
 *
 * @param string $input The checkbox value that was sent through the form.
 * @param string $allowed_value The only value that the checkbox can have (default 'on').
 * @return string The $allowed_value on success, or an empty string on failure.
 */
function ci_sanitize_checkbox(&$input, $allowed_value = 'on')
{
	if(isset($input) and $input == $allowed_value)
		return $allowed_value;
	else
		return '';
}
endif;


/**
 * Return a list of allowed tags and attributes for a given context.
 *
 * @param string $context The context for which to retrieve tags.
 *                        Currently available contexts: guide
 * @return array List of allowed tags and their allowed attributes.
 */
function ci_theme_get_allowed_tags( $context = '' ) {
	$allowed = array(
		'a'       => array(
			'href'   => true,
			'title'  => true,
			'class'  => true,
			'target' => true,
		),
		'abbr'    => array( 'title' => true, ),
		'acronym' => array( 'title' => true, ),
		'b'       => array( 'class' => true, ),
		'br'      => array(),
		'code'    => array( 'class' => true, ),
		'em'      => array( 'class' => true, ),
		'i'       => array( 'class' => true, ),
		'img'     => array(
			'alt'    => true,
			'class'  => true,
			'src'    => true,
			'width'  => true,
			'height' => true,
		),
		'li'      => array( 'class' => true, ),
		'ol'      => array( 'class' => true, ),
		'p'       => array( 'class' => true, ),
		'pre'     => array( 'class' => true, ),
		'span'    => array( 'class' => true, ),
		'strong'  => array( 'class' => true, ),
		'ul'      => array( 'class' => true, ),
	);

	switch ( $context ) {
		case 'guide':
			unset( $allowed['p'] );
			break;
		default:
			break;
	}

	return apply_filters( 'ci_theme_get_allowed_tags', $allowed, $context );
}


if( !function_exists('ci_theme_update_check')):
function ci_theme_update_check()
{
	if( CI_THEME_UPDATES === false ) return;

	$versions_url = apply_filters('ci_theme_update_url', 'http://www.cssigniter.com/theme_versions.json');
	$update_period = apply_filters('ci_theme_update_period', 24*60*60);
	$error_update_period = apply_filters('ci_theme_update_period_after_error', 8*60*60);
	$transient_name = CI_THEME_NAME.'_latest_version';
	$themes_versions = '';

	if( false === ( $latest_version = get_transient($transient_name) ) )
	{
		$response = wp_remote_get( $versions_url );
		if( is_wp_error( $response ) ) 
		{
			set_transient( $transient_name, -1, $error_update_period );
			return false;
		} 
		else 
		{
			if($response['response']['code']==200)
			{
				$themes_versions = $response['body'];
			}
			else
			{
				set_transient( $transient_name, -1, $error_update_period );
				return false;
			}
		}

		if(empty($themes_versions)) {
			set_transient( $transient_name, -1, $error_update_period );
			return false;
		}
		
		$themes_versions = json_decode($themes_versions, true);

		if($themes_versions === NULL or $themes_versions === FALSE) {
			set_transient( $transient_name, -1, $error_update_period );
			return false;
		}

		if(!isset($themes_versions[CI_THEME_NAME])) {
			set_transient( $transient_name, -1, $error_update_period );
			return false;
		}

		$latest_version = $themes_versions[CI_THEME_NAME];
		
		set_transient( $transient_name, $latest_version, $update_period );
	}
	
	return $latest_version;
}
endif;

if( !function_exists('ci_theme_update_check_admin_handler') ):
/**
 * Action hook handler for theme updates checks. Intercepts theme update data before they are written into a transient.
 * Don't use directly.
 * 
 * Hooked on 'pre_set_site_transient_update_themes' action hook.
 *
 * @param object $transient An object containing the theme-update information returned by WordPress.org API.
 * @return object
 */
function ci_theme_update_check_admin_handler($transient)
{
	if(CI_THEME_UPDATES === true)
	{
		$latest_version = ci_theme_update_check();
		if(($latest_version !== false) and version_compare($latest_version, CI_THEME_VERSION, '>'))
		{
			$theme_slug = 'wp_'.CI_THEME_NAME.'5';
			
			$transient->checked[ CI_THEME_NAME ] = CI_THEME_VERSION;
			$transient->response[ $theme_slug ] = array(
				'new_version' => $latest_version,
				'url' => 'http://www.cssigniter.com/ignite/themes/'.CI_THEME_NAME,
				'package' => ''
			);
		}
	}

	return $transient;
}
endif;

if( !function_exists('ci_save_video_thumbnail') ):
/*
 * Automatic thumbnails for video posts.
 * You need to hook to the 'ci_automatic_video_thumbnail_field' filter and return a custom field name.
 * For example:

	add_filter('ci_automatic_video_thumbnail_field', 'ci_theme_add_auto_thumb_video_field');
	function ci_theme_add_auto_thumb_video_field($field)
	{
		return 'ci_format_video_url';
	}

 */
function ci_save_video_thumbnail($post_id)
{
	// Check if the post has a featured image, if it does already there's no need to continue
	if ( !has_post_thumbnail($post_id) )
	{
		// You need to provide a custom field name, by filtering the 'ci_automatic_video_thumbnail_field' filter.
		$custom_field = apply_filters('ci_automatic_video_thumbnail_field', false);
		if( !empty($custom_field) )
		{
			// Check to see if the custom field provided exists and is populated
			$video_val = esc_url( get_post_meta($post_id, $custom_field, true) );
			if( !empty( $video_val ) ) {
				$video_thumb_url = ci_get_video_thumbnail_url($video_val);

				$img_id = ci_media_sideload_image($video_thumb_url, $post_id);

				if(!empty($img_id))
					update_post_meta($post_id, '_thumbnail_id', $img_id);
			}
		}
	}

} // ci_save_video_thumbnail()
endif;

if( !function_exists('ci_get_video_thumbnail_url') ):
function ci_get_video_thumbnail_url($video_val)
{
	// YouTube id getter from http://stackoverflow.com/questions/5830387/how-to-find-all-youtube-video-ids-in-a-string-using-a-regex
	if (
	preg_match('~
		# Match non-linked youtube URL in the wild. (Rev:20111012)
		https?://         # Required scheme. Either http or https.
		(?:[0-9A-Z-]+\.)? # Optional subdomain.
		(?:               # Group host alternatives.
		  youtu\.be/      # Either youtu.be,
		| youtube\.com    # or youtube.com followed by
		  \S*             # Allow anything up to VIDEO_ID,
		  [^\w\-\s]       # but char before ID is non-ID char.
		)                 # End host alternatives.
		([\w\-]{11})      # $1: VIDEO_ID is exactly 11 chars.
		(?=[^\w\-]|$)     # Assert next char is non-ID or EOS.
		(?!               # Assert URL is not pre-linked.
		  [?=&+%\w]*      # Allow URL (query) remainder.
		  (?:             # Group pre-linked alternatives.
			[\'"][^<>]*>  # Either inside a start tag,
		  | </a>          # or inside <a> element text contents.
		  )               # End recognized pre-linked alts.
		)                 # End negative lookahead assertion.
		[?=&+%\w-]*        # Consume any URL (query) remainder.
		~ix',
		$video_val,
		$video_id)
	) {
		$path = 'https://img.youtube.com/vi/' . $video_id[1] . '/';

		$response = wp_remote_head($path.'maxresdefault.jpg', array('sslverify' => false));

		if( !is_wp_error($response) and $response['response']['code'] == 200) {
			return $path . 'maxresdefault.jpg';
		} else {
			return $path . 'hqdefault.jpg';
		}
	} elseif (
		// Check for Vimeo
		preg_match( '#(?:https?://)?(?:www\.)?vimeo\.com/([A-Za-z0-9\-_]+)#', $video_val, $video_id)
	) {
		$response = wp_remote_get('https://vimeo.com/api/v2/video/' . $video_id[1] . '.php', array('sslverify' => false));
		if( !is_wp_error($response) and $response['response']['code'] == 200) {
			$video_data = unserialize($response['body']);
			return $video_data[0]['thumbnail_large'];
		} else {
			return false;
		}
	} else {
		return false;
	}

}
endif;



$ci_glob_inline_js = array();
if( !function_exists('ci_add_inline_js') ):
/**
 * Registers an inline JS script.
 * The script will be printed on the footer of the current request's page, either on the front or the back end.
 * Inline scripts are printed inside a jQuery's ready() event handler, and $ is available.
 * Passing a $handle allows to reference and/or overwrite specific inline scripts.
 *
 * @param string $script A JS script to be printed.
 * @param string $handle An optional handle by which the script is referenced.
 */
function ci_add_inline_js($script, $handle = false)
{
	global $ci_glob_inline_js;
	
	$handle = sanitize_key($handle);

	if( ($handle !== false) and ($handle != '') )
	{
		$ci_glob_inline_js[$handle] = "\n" . $script . "\n";
	}
	else
	{
		$ci_glob_inline_js[] = "\n" . $script . "\n";
	}
}
endif;

if( !function_exists('ci_get_inline_js') ):
/**
 * Retrieves the inline JS scripts that are registered for printing.
 *
 * @return array The inline JS scripts queued for printing.
 */
function ci_get_inline_js()
{
	global $ci_glob_inline_js;
	return $ci_glob_inline_js;	
}
endif;

if( !function_exists('ci_print_inline_js') ):
/**
 * Prints the inline JS scripts that are registered for printing, and removes them from the queue.
 */
function ci_print_inline_js()
{
	global $ci_glob_inline_js;
	
	if( empty($ci_glob_inline_js) )
		return;

	$sanitized = array();
	
	foreach($ci_glob_inline_js as $handle => $script)
	{
		$sanitized[$handle] = wp_check_invalid_utf8($script);
	}

	echo '<script type="text/javascript">' . "\n";
	echo "\t" . 'jQuery(document).ready(function($){' . "\n";

	foreach($sanitized as $handle => $script)
	{
		echo "\n/* --- CI Theme Inline script ($handle) --- */\n";
		echo $script;
	}

	echo "\t" . '});' . "\n";
	echo '</script>' . "\n";
	
	$ci_glob_inline_js = array();
}
endif;


//
// Theme features functions, similar to add_theme_support() etc.
//
if( !function_exists('add_ci_theme_support') ):
function add_ci_theme_support( $feature, $options=null )
{
	global $_ci_theme_features;
	
	if(is_null($options))
		$_ci_theme_features[$feature] = true;
	elseif(!is_null($options) and is_array($options))
		$_ci_theme_features[$feature] = $options;
	else
		trigger_error('Argument 2 of add_ci_theme_support() should be an array.', E_USER_NOTICE);
}
endif;

if( !function_exists('get_ci_theme_support') ):
function get_ci_theme_support( $feature ) {
	global $_ci_theme_features;
	if ( !isset( $_ci_theme_features[$feature] ) )
		return false;
	else
		return $_ci_theme_features[$feature];
}
endif;

if( !function_exists('remove_ci_theme_support') ):
function remove_ci_theme_support( $feature ) {
	global $_ci_theme_features;

	if ( ! isset( $_ci_theme_features[$feature] ) )
		return false;
	unset( $_ci_theme_features[$feature] );
	return true;
}
endif;



if( !function_exists('ci_enqueue_modernizr') ):
function ci_enqueue_modernizr()
{	
	wp_enqueue_script('modernizr', get_template_directory_uri().'/panel/scripts/modernizr-2.6.2.js', array(), false, false);
}
endif;

if( !function_exists('ci_print_html5shim') ):
function ci_print_html5shim()
{	
	?>
	<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<?php
}
endif;

if( !function_exists('ci_print_selectivizr') ):
function ci_print_selectivizr()
{	
	?>
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/panel/scripts/selectivizr-min.js"></script>
	<![endif]-->
	<?php
}
endif;



if ( ! function_exists( '_ci_pre_r' ) ):
/**
 * Does a print_r() on the passed array, surrounding it in <pre></pre> tags. Only use this for debugging purposes.
 *
 * @param array $arr
 */
function _ci_pre_r( $arr ) {
	echo '<pre>';
	print_r( $arr );
	echo '</pre>';
}
endif;

if ( ! function_exists( '_ci_var_dump' ) ):
/**
 * Does a var_dump() on the passed variable, surrounding it in <pre></pre> tags. Only use this for debugging purposes.
 *
 * @param mixed $var
 */
function _ci_var_dump( $var ) {
	echo '<pre>';
	var_dump( $var );
	echo '</pre>';
}
endif;

//if ( ! function_exists( '_ci_print_sidebars_and_widgets' ) ):
//function _ci_print_sidebars_and_widgets() {
//	$sidebars = wp_get_sidebars_widgets();
//	unset( $sidebars['wp_inactive_widgets'] );
//	_ci_pre_r( $sidebars );
//
//	foreach ( $sidebars['sidebar-right'] as $widget ) {
//		echo '<h3>' . $widget . '</h3>';
//		$name = substr( $widget, 0, strrpos( $widget, '-' ) );
//		_ci_pre_r( get_option( 'widget_' . $name ) );
//	}
//
//}
//endif;
