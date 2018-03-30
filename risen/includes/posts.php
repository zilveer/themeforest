<?php
/**
 * Post (and Page) Functions
 * Helpers shared by posts (and pages), custom post types, taxonomies, etc.
 */

/**********************************
 * CONTENT OUTPUT
 **********************************/

/**
  * Comma-separated categories list (any taxonomy)
  *
  * Alternative to wp_list_categories()
  */
			
if ( ! function_exists( 'risen_blog_categories_list' ) ) {

	function risen_blog_categories_list( $taxonomy = false, $show_count = true ) {
		
		$list = '';

		$taxonomy = empty( $taxonomy ) ? 'category' : $taxonomy;
		
		// get categories
		$categories = get_categories( array(
			'taxonomy' => $taxonomy,
			'hierarchical'	=> false
		) );
		
		// make comma separated list
		foreach( $categories as $category ) {
			
			// link
			$list .= '<a href="' . esc_attr( get_term_link( $category ) ) . '">' . $category->name . '</a>';
			
			// count
			if ( ! empty( $show_count ) ) {
				$list .= ' <span>(' . $category->count . ')</span>';
			}
		
		}
		
		return $list;
		
	}
	
}
 
/**
 *  X - X of X Posts
 */

if ( ! function_exists( 'risen_post_count_message' ) ) {
	 
	function risen_post_count_message( $query = false ) {
	
		global $wp_query;

		$message = '';
		
		// use standard query if no custom query given
		$query = empty( $query ) && isset( $wp_query ) ? $wp_query : $query;
		
		// have correct data?
		if ( isset( $query->found_posts ) && isset( $query->query_vars['paged'] ) && isset( $query->query_vars['posts_per_page'] ) && isset( $query->max_num_pages ) ) {

			// what page are we on?
			$page = ! empty( $query->query_vars['paged'] ) ? $query->query_vars['paged'] : 1; // 0 means page 1, given numbers are literal
			$post_max = $query->query_vars['posts_per_page'] * $page; // last post on page
			$post_min = $post_max - $query->query_vars['posts_per_page'] + 1; // first post on page
			$post_max = $post_max > $query->found_posts ? $query->found_posts : $post_max; // lastly, don't let actual max shown exceed total

			// If 0 items, show "0 Items"
			if ( empty( $query->found_posts ) ) {
				$message = sprintf( __( '<b>0</b> Items', 'risen' ), $query->found_posts );
			}
			
			// If 1 item, show "1 Item"
			else if ( 1 == $query->found_posts ) {
				$message = __( '<b>1</b> Item', 'risen' );
			}
			
			// If more than 1, but one page, show "X Items"
			else if ( 1 == $query->max_num_pages ) {
				$message = sprintf( __( '<b>%s</b> Items', 'risen' ), $query->found_posts );
			}
			
			// If more than 1 , but multiple pages, show "X - X of X items"
			else if ( $query->max_num_pages > 1 ) {
				/* translators: first item on page, last item on page, total items on all pages */
				$message = sprintf( __( '<b>%1$s</b> &ndash; <b>%2$s</b> of <b>%3$s</b> items', 'risen' ), $post_min, $post_max, $query->found_posts );

			}
			
		}

		echo $message;
	
	}
	
}

/**
 * X Days Ago or Date
 *
 * This takes a timestamp and shows "X days ago"
 * If it is older than a certain number of days, the full date it shown
 */

if ( ! function_exists( 'risen_date_ago' ) ) {
	 
	function risen_date_ago( $timestamp, $max_days = false ) {

		// the current time
		$current_time = current_time( 'timestamp' );
		
		// at what time in past would $max_days be exceeded?
		$max_seconds = $max_days * 86400; // days multiplied by number of seconds in a day
		$cutoff_time = $current_time - $max_seconds; // now minus X days ago
		
		// if cutoff time is newer than X days ago, show human time difference (X days/hours/minutes/seconds ago)
		if ( $timestamp > $cutoff_time ) {
			$time_diff = human_time_diff( $timestamp, $current_time ); // http://codex.wordpress.org/Function_Reference/human_time_diff
			/* translators: helps form 'X days ago' with 'X days' being localized by core WordPress translation */
			$date = sprintf( __( '%s ago' , 'risen' ), $time_diff ); // localized text for "X days ago" where "X days" is from WP core - to change days, must set core translation
		}
		
		// timestamp is older than X days ago, show full date format
		else {
			$date_format = get_option( 'date_format' ); // this is from WordPress general settings
			$date = date_i18n( $date_format, $timestamp ); // translated date
		}	

		// return formatted date
		return $date;
	
	}

}

/**
 * Post Archive Nav
 * Shows previous and next links for archives
 */

if ( ! function_exists( 'risen_posts_nav' ) ) {
	 
	function risen_posts_nav( $query = false, $prev_text = false, $next_text = false ) {

		global $wp_query;
	
		// use default query if no custom query given
		$query = ! empty( $query ) ? $query : $wp_query;

		// have posts on more than 1 page
		if ( $query->have_posts() && $query->max_num_pages > 1) {
		
			// use given or default text
			$prev_text = ! empty( $prev_text ) ? $prev_text : __( '<span>&larr;</span> Newer Items', 'risen' );
			$next_text = ! empty( $next_text ) ? $next_text : __( 'Older Items <span>&rarr;</span>', 'risen' );
		
			?>
			<nav class="nav-left-right" id="multimedia-posts-nav">
				<div class="nav-left"><?php previous_posts_link( $prev_text ); ?></div>
				<div class="nav-right"><?php next_posts_link( $next_text, $query->max_num_pages ); ?></div>
				<div class="clear"></div>
			</nav>
			<?php
		
		}

	}
	
}

/**
 * Author Box
 */
 
if ( ! function_exists( 'risen_author_box' ) ) {

	function risen_author_box() {
	
		if ( get_the_author_meta( 'description' ) ) {
		
			?>
			<aside class="box author-box">
			
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 200 ); // 100x100 so 200 for hiDPI/Retina ?>
				</div>
				
				<div class="author-content">
				
					<h1><?php printf( __( 'About %s', 'risen' ), get_the_author() ); ?></h1>
					
					<?php the_author_meta( 'description' ); ?>

				</div>
				
			</aside>
			<?php
			
		}

	}

}

/**********************************
 * CONDITIONALS
 **********************************/

/**
 * Has excerpt
 *
 * @since 2.0
 * @return bool True if has manual or automatic excerpt
 */
function risen_has_excerpt() {

	$has_excerpt = false;

	if ( trim( strip_tags( get_the_excerpt() ) ) ) {
		$has_excerpt = true;
	}

	return apply_filters( 'risen_has_excerpt', $has_excerpt );

}

/**
 * Has manual excerpt
 *
 * @since 2.0
 * @global object $post
 * @return bool True if has manual excerpt
 */
function risen_has_manual_excerpt() {

	global $post;

	$bool = false;

	if ( trim( strip_tags( $post->post_excerpt ) ) ) {
		$bool = true;
	}

	return apply_filters( 'risen_has_manual_excerpt', $bool );

}

/**********************************
 * DATA
 **********************************/

/**
 * Get/Set $paged
 * For use in templates that can be used as static front page
 * get_query_var( 'paged' ) returns nothing on front page, but get_query_var( 'page' ) does
 * This returns and sets globally $paged so that the query and pagination work
 */
 
if ( ! function_exists( 'risen_page_num' ) ) {

	function risen_page_num() {
	
		global $paged;
	
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

		return $paged;
		
	}

}
 
/**
 * Custom Post Type Date Archive Setup
 * 
 * At time of making, WordPress (3.3 and possibly later) does not support dated archives for custom post types as it does for standard posts
 * This injects rules so that URL's like /cpt/2012/05 can be used with the custom post type archive template
 * Note: resave permalinks if ever change this
 *
 * Credit for this soluton goes to MillaN of Dev4Press: http://www.dev4press.com/2012/tutorials/wordpress/practical/url-rewriting-custom-post-types-date-archive/
 * (with an assist from Brian Krogsgard: http://krogsgard.com)
 */

if ( ! function_exists( 'risen_cpt_date_archive_setup' ) ) {

	function risen_cpt_date_archive_setup( $post_types, $wp_rewrite ) {

		// Cast single post type as array
		$post_types = (array) $post_types;

		// Loop given post types to build rules
		$rules = array();
		foreach( $post_types as $post_type_slug ) {

			// Post type data
			$post_type = get_post_type_object( $post_type_slug );

			// Post type has archive enabled
			if ( true === $post_type->has_archive ) {

				// Date archive rules
				$date_rules = array(
				
					// Year, Month, Day: /cpt-slug/2012/01/1
					array(
						'rule' => '([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})', // URL pattern
						'vars' => array( 'year', 'monthnum', 'day' ) // corresponding query parameters
					),
					
					// Year, Month: /cpt-slug/2012/01
					array(
						'rule' => '([0-9]{4})/([0-9]{1,2})',
						'vars' => array( 'year', 'monthnum' )
					),
					
					// Day: /cpt-slug/2012
					array(
						'rule' => '([0-9]{4})',
						'vars' => array( 'year' )
					)
					
				);

				// Build rewrite rules and queries
				foreach ( $date_rules as $date_rule ) {
				
					// Base query
					$query = 'index.php?post_type=' . $post_type_slug;

					// Append date parameters and match index
					$i = 1;
					foreach ( $date_rule['vars'] as $var ) {
						$query .= '&' . $var . '=' . $wp_rewrite->preg_index( $i );
						$i++; // last in loop will serve as next index feed and pagination queries below
					}

					// Base rule
					$archive_slug = ! empty( $post_type->rewrite['slug'] ) ? $post_type->rewrite['slug'] : $post_type->name; // use rewrite slug if provided; otherwise post type slug
					$rule = $archive_slug . '/'. $date_rule['rule'];
					
					// Date URL
					$rules[$rule . '/?$' ] = $query;
					
					// Feed URLs
					$rules[$rule . '/feed/(feed|rdf|rss|rss2|atom)/?$' ] = $query . '&feed=' . $wp_rewrite->preg_index( $i );
					$rules[$rule . '/(feed|rdf|rss|rss2|atom)/?$' ] = $query . '&feed=' . $wp_rewrite->preg_index( $i );
					
					// Paginated URLs
					$rules[$rule . '/page/([0-9]{1,})/?$' ] = $query . '&paged=' . $wp_rewrite->preg_index( $i );
					
				}
				
			}
			
		}

		// Apply the rules for given post types
		if ( ! empty( $rules ) ) {
			$wp_rewrite->rules = array_merge( $rules, $wp_rewrite->rules );
		}

	}
	
}