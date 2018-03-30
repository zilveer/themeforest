<?php
/**
 * Add a ThemeZilla specific option
 *
 * @param string $name The option name
 * @param string $value The option value
 */
function zilla_add_option( $name, $value ){
    zilla_update_option( $name, $value );
}

/**
 * Remove a ThemeZilla specific option
 *
 * @param string $name The option name
 */
function zilla_remove_option( $name ){
    $zilla_values = get_option( 'zilla_framework_values' );
    unset( $zilla_values[$name] ); 
    update_option( 'zilla_framework_values', $zilla_values );
}

/**
 * Get a ThemeZilla specific option
 *
 * @param string $name The option name
 * @return object|bool Option value on success, false if no value exists
 */
function zilla_get_option( $name ){
    $zilla_values = get_option( 'zilla_framework_values' );
    if( array_key_exists( $name, $zilla_values ) ) return $zilla_values[$name];
    return false;
}


/**
 * Update a ThemeZilla specific option
 *
 * @param string $name The option name
 * @param string $value The new option value
 */
function zilla_update_option( $name, $value ){
    $zilla_values = get_option( 'zilla_framework_values' );
    $zilla_values[$name] = $value; 
    update_option( 'zilla_framework_values', $zilla_values );
}


/**
 * Create a custom hook definitions
 *
 * @since 0.1
 */
/* header.php -----------------------------------------------------------------*/
function zilla_meta_head() { zilla_do_contextual_hook('zilla_meta_head'); }
function zilla_head() { zilla_do_contextual_hook('zilla_head'); }
function zilla_body_start() { zilla_do_contextual_hook('zilla_body_start'); }
function zilla_header_before() { zilla_do_contextual_hook('zilla_header_before'); }
function zilla_header_after() { zilla_do_contextual_hook('zilla_header_after'); }
function zilla_header_start() { zilla_do_contextual_hook('zilla_header_start'); }
function zilla_header_end() { zilla_do_contextual_hook('zilla_header_end'); }
function zilla_nav_before() { zilla_do_contextual_hook('zilla_nav_before'); }
function zilla_nav_after() { zilla_do_contextual_hook('zilla_nav_after'); }
function zilla_content_start() { zilla_do_contextual_hook('zilla_content_start'); }

/* index.php, single.php, search.php, archive.php -----------------------------*/
function zilla_post_before() { zilla_do_contextual_hook('zilla_post_before'); }
function zilla_post_after() { zilla_do_contextual_hook('zilla_post_after'); }
function zilla_post_start() { zilla_do_contextual_hook('zilla_post_start'); }
function zilla_post_end() { zilla_do_contextual_hook('zilla_post_end'); }

/* page.php -------------------------------------------------------------------*/
function zilla_page_before() { zilla_do_contextual_hook('zilla_page_before'); }
function zilla_page_after() { zilla_do_contextual_hook('zilla_page_after'); }
function zilla_page_start() { zilla_do_contextual_hook('zilla_page_start'); }
function zilla_page_end() { zilla_do_contextual_hook('zilla_page_end'); }

/* single.php, page.php, templates with comments ------------------------------*/
function zilla_comments_before() { zilla_do_contextual_hook('zilla_comments_before'); }
function zilla_comments_after() { zilla_do_contextual_hook('zilla_comments_after'); }

/* sidebar.php ----------------------------------------------------------------*/
function zilla_sidebar_before() { zilla_do_contextual_hook('zilla_sidebar_before'); }
function zilla_sidebar_after() { zilla_do_contextual_hook('zilla_sidebar_after'); }
function zilla_sidebar_start() { zilla_do_contextual_hook('zilla_sidebar_start'); }
function zilla_sidebar_end() { zilla_do_contextual_hook('zilla_sidebar_end'); }

/* footer.php -----------------------------------------------------------------*/
function zilla_content_end() { zilla_do_contextual_hook('zilla_content_end'); }
function zilla_footer_before() { zilla_do_contextual_hook('zilla_footer_before'); }
function zilla_footer_after() { zilla_do_contextual_hook('zilla_footer_after'); }
function zilla_footer_start() { zilla_do_contextual_hook('zilla_footer_start'); }
function zilla_footer_end() { zilla_do_contextual_hook('zilla_footer_end'); }
function zilla_body_end() { zilla_do_contextual_hook('zilla_body_end'); }


/**
 * Adds contextual action hooks. Users do not need to use WordPress conditional tags
 * because this function handles the logic.
 * 
 * Basic hook would be 'zilla_head'. zilla_do_contextual_hook() function extends
 * the hook with context (i.e., 'zilla_head_singular' or 'zilla_head_home')
 * 
 * Thanks to Ptah Dunbar for this function
 * @link https://twitter.com/ptahdunbar
 * 
 * @since 0.1
 * @uses zilla_get_query_context() Gets the context of the current page
 * @param string $tag Usually the location of the hook but defines the base hook
 */
if ( !function_exists( 'zilla_do_contextual_hook' ) ) {
    function zilla_do_contextual_hook( $tag = '', $args = '' ) {
        if ( !$tag ) { return false; }
        
        do_action( $tag, $args );
        
        foreach( (array) zilla_get_query_context() as $context ) {
            do_action( "{$tag}_{$context}", $args );
        }
    }
}


/**
 * Retrieve the context of the queried template
 * 
 * @since 0.1
 * @return array $query_context
 */

if ( ! function_exists( 'zilla_get_query_context' ) ) {
	function zilla_get_query_context() {
		global $wp_query, $query_context;
		
		/* Return query_context if set -------------------------------------------*/
		if ( isset( $query_context->context ) && is_array( $query_context->context ) ) {
			return $query_context->context;
		} else {
        	$query_context = new stdClass;
        }
		
		/* Figure out the context ------------------------------------------------*/
		$query_context->context = array();
	
		/* Front page */
		if ( is_front_page() ) { 
		    $query_context->context[] = 'home'; 
		} 
	
		/* Blog page */
		if ( is_home() && ! is_front_page() ) {
			$query_context->context[] = 'blog';
			
        /* Singular views. */
		} elseif ( is_singular() ) { 

			$query_context->context[] = 'singular';
			$query_context->context[] = "singular-{$wp_query->post->post_type}";
		
			/* Page Templates. */
			if ( is_page_template() ) {
				$to_skip = array( 'page', 'post' );
			
				$page_template = basename( get_page_template() );
				$page_template = str_replace( '.php', '', $page_template );
				$page_template = str_replace( '.', '-', $page_template );
			
				if ( $page_template && ! in_array( $page_template, $to_skip ) ) {
					$query_context->context[] = $page_template;
				}
			}
			
			$query_context->context[] = "singular-{$wp_query->post->post_type}-{$wp_query->post->ID}";
		}
	
		/* Archive views. */
		elseif ( is_archive() ) {
			$query_context->context[] = 'archive';
	
			/* Taxonomy archives. */
			if ( is_tax() || is_category() || is_tag() ) {
				$term = $wp_query->get_queried_object();
				$query_context->context[] = 'taxonomy';
				$query_context->context[] = $term->taxonomy;
				$query_context->context[] = "{$term->taxonomy}-" . sanitize_html_class( $term->slug, $term->term_id );
			}
	
			/* User/author archives. */
			elseif ( is_author() ) {
				$query_context->context[] = 'user';
				$query_context->context[] = 'user-' . sanitize_html_class( get_the_author_meta( 'user_nicename', get_query_var( 'author' ) ), $wp_query->get_queried_object_id() );
			}
	
			/* Time/Date archives. */
			else {
				if ( is_date() ) {
					$query_context->context[] = 'date';
					if ( is_year() )
						$query_context->context[] = 'year';
					if ( is_month() )
						$query_context->context[] = 'month';
					if ( get_query_var( 'w' ) )
						$query_context->context[] = 'week';
					if ( is_day() )
						$query_context->context[] = 'day';
				}
				if ( is_time() ) {
					$query_context->context[] = 'time';
					if ( get_query_var( 'hour' ) )
						$query_context->context[] = 'hour';
					if ( get_query_var( 'minute' ) )
						$query_context->context[] = 'minute';
				}
			}
		}
	
		/* Search results. */
		elseif ( is_search() ) {
			$query_context->context[] = 'search';
			
		/* Error 404 pages. */
		} elseif ( is_404() ) {
			$query_context->context[] = 'error-404';
		}
		
		return $query_context->context;
	} 
}


/**
 * Add metatags with Theme and Framework Versions
 * 
 * @since 0.1
 */
function zilla_add_version_meta() {
    $theme_data = get_option('zilla_framework_options');
    $theme_name = $theme_data['theme_name'];
    $theme_version = $theme_data['theme_version'];

    echo '<meta name="generator" content="' . $theme_name . ' ' . $theme_version .'" />' . "\n";
	echo '<meta name="generator" content="ZillaFramework ' . ZILLA_FRAMEWORK_VERSION . '" />' . "\n";
}
add_action('zilla_meta_head', 'zilla_add_version_meta');


/**
 * Add browser detection and post name to body class
 * Add post title to body class on single pages
 *
 * @link http://www.wprecipes.com/wordpress-hack-automatically-add-post-name-to-the-body-class
 * @param array $classes The current body classes
 * @return array The new body classes
 */
if ( !function_exists( 'zilla_browser_body_class' ) ) {
	function zilla_body_classes($classes) {
	    // Add our browser class
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE){ 
			$classes[] = 'ie';
			if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version)) $classes[] = 'ie'.$browser_version[1];
		} else $classes[] = 'unknown';
	
		if($is_iphone) $classes[] = 'iphone';
		
		// Add the post title
		if( is_singular() ) {
    		global $post;
    		array_push( $classes, "{$post->post_type}-{$post->post_name}" );
    	}
    	
    	// Add 'zilla'
    	array_push( $classes, "zilla" );
    	
		return $classes;
	}
}
add_filter('body_class','zilla_body_classes');


/**
 * Custom Login Logo Support
 *
 * @since v1.0
 */

if ( !function_exists( 'zilla_custom_login_logo' ) ) {
	function zilla_custom_login_logo() {
	    echo '<style type="text/css">
	        h1 a { background-image:url('.get_template_directory_uri().'/images/admin-login-logo.png) !important; background-size: auto auto !important; }
	    </style>';
	}
}
add_action('login_head', 'zilla_custom_login_logo');

if ( !function_exists( 'zilla_wp_login_url' ) ) {
	function zilla_wp_login_url() {
		return home_url();
	}
}
add_filter('login_headerurl', 'zilla_wp_login_url');

if ( !function_exists( 'zilla_wp_login_title' ) ) {
	function zilla_wp_login_title() {
		return get_option('blogname');
	}
}
add_filter('login_headertitle', 'zilla_wp_login_title');


/**
 * Get cat ID from cat name
 *
 * @link http://www.wprecipes.com/wordpress-function-get-category-id-using-category-name
 * @param string $cat_name The category name
 * @return int The category id
 */
if ( !function_exists( 'get_category_id' ) ) {
	function get_category_id( $cat_name )
	{
		$term = get_term_by( 'name', $cat_name, 'category' );
		return $term->term_id;
	}
}

/**
 * Get "blog" URL
 *
 * @return string The URL of the "blog" page
 */
if ( !function_exists( 'zilla_blog_url' ) ) {
    function zilla_blog_url(){
        if( $posts_page_id = get_option('page_for_posts') ){
            return home_url(get_page_uri($posts_page_id));
        } else {
            return home_url();
        }
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');


/*-----------------------------------------------------------------------------------*/
/*	Remove Generator for Security
/*-----------------------------------------------------------------------------------*/

remove_action( 'wp_head', 'wp_generator' );
