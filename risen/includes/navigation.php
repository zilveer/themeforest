<?php
/**
 * Navigation Functions
 *
 * Custom menus and breadcrumb path
 */

/**********************************
 * CUSTOM MENUS
 **********************************/
 
/**
 * Register header and footer menu locations
 */
 
function risen_register_menus() {

	// Register header menu location
	register_nav_menu( 'header', _x( 'Header', 'menu location', 'risen' ) );
	
	// Register footer menu location
	register_nav_menu( 'footer', _x( 'Footer', 'menu location', 'risen' ) );

}

/**
 * Correct "Custom" menu link URLs from sample XML content to use actual site's home URL
 * This fires after Importer plugin finishes - see hook in functions.php
 */

function risen_import_correct_menu_urls() {

	$home_url = home_url(); // this install
	$dev_home_url = 'http://multisite.dev/risen'; // the "home" URL used in XML for Custom menu links

	// This WP install is not the dev install
	if ( $home_url != $dev_home_url ) {

		// Get menu links that have dev home URL (from XML import)
		$posts = get_posts( array(
			'post_type'	=> 'nav_menu_item',
			'numberposts' => -1,
			'meta_query' => array(
				array(
					'key'		=> '_menu_item_url',
					'value'		=> $dev_home_url,
					'compare'	=> 'LIKE'
				)
			)
		) );
		
		// Loop 'em to change
		foreach( $posts as $post ) {
		
			// Get URL
			$url = get_post_meta( $post->ID, '_menu_item_url', true );

			// Change it to this install's home URL
			$new_url = str_replace( $dev_home_url, $home_url, $url );
			update_post_meta( $post->ID, '_menu_item_url', esc_url_raw( $new_url ) );

			// Debug
			//echo "\n\n$url\n$new_url\n";
			//print_r( $post );

		}

	}
	
}

/**********************************
 * BREADCRUMB
 **********************************/

/**
 * Output breadcrumb path
 */

if ( ! function_exists( 'risen_breadcrumbs' ) ) {

	function risen_breadcrumbs() {

		global $post;
		
		// Enabled in Theme Options
		// Not on the front page (in case static page used)
		if ( risen_option( 'breadcrumbs' ) && ! is_front_page() ) {

			$breadcrumbs = array();

			// Page
			if ( is_page() ) {

				// Get page and parents if any
				$breadcrumbs = array_merge( $breadcrumbs, risen_page_breadcrumbs( $post->ID ) );
				
			}
			
			// Multimedia (post, category, speaker, tag, date archives)
			else if ( is_singular( 'risen_multimedia' ) || is_tax( 'risen_multimedia_category' ) || is_tax( 'risen_multimedia_speaker' ) || is_tax( 'risen_multimedia_tag' ) || is_post_type_archive( 'risen_multimedia' ) ) {
			
				// Prepend page (and parents) that use multimedia template
				$multimedia_page_id = risen_get_page_id_by_template( 'tpl-multimedia.php' );
				if ( $multimedia_page_id ) {
					$page_breadcrumbs = risen_page_breadcrumbs( $multimedia_page_id );
					$breadcrumbs = array_merge( $breadcrumbs, $page_breadcrumbs );
				}
					
				// Multimedia Item
				if ( is_singular() ) {
					
					// Prepend categories if any
					$taxonomy = 'risen_multimedia_category';
					$terms = get_the_terms( $post->ID, $taxonomy );
					$term = is_array( $terms ) ? current( $terms ) : $terms; // use first cat in list
					if ( ! empty( $term ) ) {
						$category_breadcrumbs = risen_taxonomy_term_breadcrumbs( $term, $taxonomy );
						$breadcrumbs = array_merge( $breadcrumbs, $category_breadcrumbs );
					}
				
					// Current item
					//$breadcrumbs[] = array( get_the_title() );
					$breadcrumbs[] = array(
						sprintf( _x( 'View %s', 'multimedia breadcrumb', 'risen'), risen_option( 'multimedia_word_singular' ) ),
						get_permalink()
					); // post titles are often long, so use short generic term
				
				}
				
				// Multimedia Category or Speaker
				// Both are hierarchical taxonomies so work the same
				else if ( is_tax( 'risen_multimedia_category' ) || is_tax( 'risen_multimedia_speaker' ) ) {
				
					// Get taxonomy and parents if any
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					$breadcrumbs = array_merge( $breadcrumbs, risen_taxonomy_term_breadcrumbs( $term, get_query_var( 'taxonomy' ) ) );

				}
				
				// Multimedia Tag
				else if ( is_tax( 'risen_multimedia_tag' ) ) {
					$breadcrumbs[] = array(
						sprintf( _x( 'Tagged %s', 'multimedia breadcrumb', 'risen' ), risen_option( 'multimedia_word_plural' ) ),
						get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) )
					);
				}

				// Multimedia Date Archive
				else if ( is_year() || is_month() || is_day() ) {
					
					// Append date breadcrumbs
					$base_url = get_post_type_archive_link( get_query_var( 'post_type' ) );
					$breadcrumbs = array_merge( $breadcrumbs, risen_date_breadcrumbs( $base_url ) );

				}
				
			}
			
			// Gallery (post, category)
			else if ( is_singular( 'risen_gallery' ) || is_tax( 'risen_gallery_category' ) ) {
			
				// Prepend main gallery page (and parents) chosen in Theme Options
				$gallery_page_id = risen_option( 'gallery_page_id' );
				if ( $gallery_page_id ) {
					$page_breadcrumbs = risen_page_breadcrumbs( $gallery_page_id );
					$breadcrumbs = array_merge( $breadcrumbs, $page_breadcrumbs );
				}
					
				// Gallery Item
				if ( is_singular() ) {
					
					// Prepend categories if any
					$taxonomy = 'risen_gallery_category';
					$terms = get_the_terms( $post->ID, $taxonomy );
					$term = is_array( $terms ) ? current( $terms ) : $terms; // use first cat in list
					if ( ! empty( $term ) ) {
						$category_breadcrumbs = risen_taxonomy_term_breadcrumbs( $term, $taxonomy );
						$breadcrumbs = array_merge( $breadcrumbs, $category_breadcrumbs );
					}
				
					// Current item
					//$breadcrumbs[] = array( get_the_title() );
					$gallery_item_type = get_post_meta( $post->ID, '_risen_gallery_type', true );
					$gallery_item_type = 'video' == $gallery_item_type ? _x( 'Video', 'gallery item', 'risen' ) : _x( 'Image', 'gallery item', 'risen' );
					$breadcrumbs[] = array(
						sprintf( _x( 'View %s', 'gallery breadcrumb', 'risen' ), $gallery_item_type ), // post titles are often long, so use short generic term
						get_permalink()
					);				
				}
				
				// Gallery Category
				else if ( is_tax( 'risen_gallery_category' ) ) {
				
					// Get taxonomy and parents if any
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					$breadcrumbs = array_merge( $breadcrumbs, risen_taxonomy_term_breadcrumbs( $term, get_query_var( 'taxonomy' ) ) );

				}

			}
			
			// Events
			else if ( is_singular( 'risen_event' ) ) {
			
				// Prepend page (and parents) that use multimedia template
				$template = risen_event_parent_page_template( $post ); // Use Upcoming or Past template?
				$events_page_id = risen_get_page_id_by_template( $template );
				if ( $events_page_id ) {
					$page_breadcrumbs = risen_page_breadcrumbs( $events_page_id );
					$breadcrumbs = array_merge( $breadcrumbs, $page_breadcrumbs );
				}
			
				// Single event
				$breadcrumbs[] = array(
					_x( 'View Event', 'breadcrumb', 'risen' ),
					get_permalink()
				);

			}
			
			// Blog (post, category, tag, search, date archives, author archive)
			else if ( is_singular( 'post' ) || is_category() || is_tag() || is_search() || is_year() || is_month() || is_day() || is_author() || is_post_type_archive( 'post' ) ) {
			
				// Prepend page (and parents) that use blog template
				$blog_page_id = risen_get_page_id_by_template( 'tpl-blog.php' );
				if ( $blog_page_id ) {
					$page_breadcrumbs = risen_page_breadcrumbs( $blog_page_id );
					$breadcrumbs = array_merge( $breadcrumbs, $page_breadcrumbs );
				}
					
				// Blog Post
				if ( is_single() ) {
					
					// Prepend categories if any
					$categories = get_the_category();
					if ( isset( $categories[0] ) ) { // use first cat in list
						$category_breadcrumbs = risen_taxonomy_term_breadcrumbs( $categories[0], 'category' );
						$breadcrumbs = array_merge( $breadcrumbs, $category_breadcrumbs );
					}
				
					// Current item
					//$breadcrumbs[] = array( get_the_title() );
					$breadcrumbs[] = array(
						_x( 'View Post', 'breadcrumb', 'risen' ), // post titles are often long, so use short generic term
						get_permalink()
					);
				
				}
				
				// Blog Category
				else if ( is_category() ) {
				
					// Get category and parents if any
					$breadcrumbs = array_merge( $breadcrumbs, risen_taxonomy_term_breadcrumbs( get_query_var( 'cat' ), 'category' ) );
				
				}
				
				// Blog Tag
				else if ( is_tag() ) {
					$breadcrumbs[] = array(
						_x( 'Tagged Posts', 'breadcrumb', 'risen' ),		
						get_tag_link( get_query_var( 'tag_id' ) )
					);
				}
				
				// Blog Search
				else if ( is_search() ) {
					$breadcrumbs[] = array(
						_x( 'Search Results', 'breadcrumb', 'risen' ),
						get_search_link()
					);
				}
				
				// Blog Date Archive
				else if ( is_year() || is_month() || is_day() ) {

					// Append date breadcrumbs
					$breadcrumbs = array_merge( $breadcrumbs, risen_date_breadcrumbs() );

				}
				
				// Blog Author
				else if ( is_author() ) {
					$breadcrumbs[] = array(
						_x( 'Author Archive', 'breadcrumb', 'risen' ),
						get_author_posts_url( get_query_var( 'author' ) )
					);
				}
			
			}
			
			// File not found page
			else if ( is_404() ) {				
				$breadcrumbs[] = array(
					__( 'Not Found', 'risen' ),
					risen_current_url()
				);
			}
			
			// Output breadcrumbs
			if ( ! empty( $breadcrumbs ) ) {
			
				// Append Home to front
				$breadcrumbs = array_merge( array( array( _x( 'Home', 'breadcrumbs', 'risen' ) , home_url() ) ), $breadcrumbs );
			
				// Output
				$i = 0;
				$count = count( $breadcrumbs );
				echo '<div class="breadcrumbs">';
				foreach( $breadcrumbs as $breadcrumb ) {
					
					$i++;
					
					$breadcrumb = (array) $breadcrumb;
					
					// Separator
					if ( $i > 1 ) {
						echo _x( ' > ', 'breadcrumb separator', 'risen' );
					}

					// If no link given (just in case)
					if ( empty( $breadcrumb[1] ) ) { // add  || $i == $count if don't wany any last item linked, but it's more helpful and reable with it linked
						echo '<span>' . esc_html( $breadcrumb[0] ) . '</span>';
					}
					
					// Linked
					else {
						echo '<a href="' . esc_url( $breadcrumb[1] ) . '">' . esc_html( $breadcrumb[0] ) . '</a>';
					}
					
				}
				echo '</div>';
			
			}
			
		}
	
	}

}

/**
 * Get Page Breadcrumbs
*/
 
if ( ! function_exists( 'risen_page_breadcrumbs' ) ) {

	function risen_page_breadcrumbs( $page_id ) {

		$page_breadcrumbs = array();
			
		if( ! empty( $page_id ) ) {
		
			$page = get_page( $page_id );
			
			// Parent pages?
			if ( ! empty( $page->post_parent ) ) {

				$parent_page_breadcrumbs = array();
				
				// Traverse through parent pages
				$parent_page_id = $page->post_parent;
				while ( $parent_page_id ) { // keep moving down levels until there are no more parent pages

					$parent_page = get_page( $parent_page_id );
					$parent_page_id  = $parent_page->post_parent; // if this parent has a parent, while loop will continue
					
					$parent_page_breadcrumbs[] = array(
						get_the_title( $parent_page->ID ),
						get_permalink( $parent_page->ID )
					);		
					
				}
				
				// Reverse parent page array and marge into main breadcrumbs
				$page_breadcrumbs = array_merge( $page_breadcrumbs, array_reverse( $parent_page_breadcrumbs ) );
				
			}
			
			// Current page
			$page_breadcrumbs[] = array(
				get_the_title( $page_id ),
				get_permalink( $page_id )
			);
		
		}
		
		$page_breadcrumbs = apply_filters( 'risen_breadcrumbs', $page_breadcrumbs );
		
		return $page_breadcrumbs;
	
	}
	
}


/**
 * Get Taxonomy Term Breadcrumbs
 *
 * Handy for post categories, sermon categories, speakers, gallery categories, etc.
 * $term can be object or ID
 */
 
if ( ! function_exists( 'risen_taxonomy_term_breadcrumbs' ) ) {

	function risen_taxonomy_term_breadcrumbs( $term, $taxonomy ) {

		$term_breadcrumbs = array();
			
		if ( ! empty( $term ) ) {
		
			$term_obj = get_term( $term, $taxonomy ); // in case $term is ID, not already object

			// Parent terms?
			if ( ! empty( $term_obj->parent ) ) {

				$parent_term_breadcrumbs = array();
				
				// Traverse through parent terms
				$parent_term_id = $term_obj->parent;
				while ( $parent_term_id ) { // keep moving down levels until there are no more parent terms

					$parent_term = get_term( $parent_term_id, $taxonomy );
					$parent_term_id  = $parent_term->parent; // if this parent has a parent, while loop will continue

					$parent_term_breadcrumbs[] = array(
						$parent_term->name,
						get_term_link( $parent_term, $taxonomy )
					);		

				}
				
				// Reverse parent term array and marge into main breadcrumbs
				$term_breadcrumbs = array_merge( $term_breadcrumbs, array_reverse( $parent_term_breadcrumbs ) );
				
			}
			
			// Current term
			$term_breadcrumbs[] = array(
				$term_obj->name,
				get_term_link( $term_obj, $taxonomy )
			);
		
		}
		
		$term_breadcrumbs = apply_filters( 'risen_taxonomy_term_breadcrumbs', $term_breadcrumbs );
		
		return $term_breadcrumbs;
	
	}
	
}

/**
 * Get Date Breadcrumbs
 */
 
if ( ! function_exists( 'risen_date_breadcrumbs' ) ) {

	function risen_date_breadcrumbs( $base_url = false ) {
	
		$date_breadcrumbs = array();
	
		// Year
		$year = get_query_var( 'year' );
		if ( ! empty( $year ) ) {
		
			$dateformatstring = _x( 'Y', 'breadcrumb year format', 'risen' );

			if ( ! empty( $base_url ) ) { // if base URL given, use it (such as custom post type date archive)
				$date_url = trailingslashit( $base_url ) . trailingslashit( $year );
			} else {
				$date_url = get_year_link( $year );
			}
			
			$date_breadcrumbs[] = array(
				date_i18n( $dateformatstring, mktime( 0, 0, 0, 1, 1, $year ) ),
				$date_url
			);
		
			// Month
			$month = get_query_var( 'monthnum' );
			if ( ! empty( $month ) ) {
			
				$dateformatstring = _x( 'F', 'breadcrumb month format', 'risen' );
				
				if ( ! empty( $base_url ) ) { // if base URL given, use it (such as custom post type date archive)
					$date_url .= trailingslashit( $month );
				} else {
					$date_url = get_month_link( $year, $month );
				}
				
				$date_breadcrumbs[] = array(
					date_i18n( $dateformatstring, mktime( 0, 0, 0, $month, 1, $year ) ),
					$date_url
				);

				// Day
				$day = get_query_var( 'day' );
				if ( ! empty( $day ) ) {
				
					$dateformatstring = _x( 'jS', 'breadcrumb day format', 'risen' );
					
					if ( ! empty( $base_url ) ) { // if base URL given, use it (such as custom post type date archive)
						$date_url .= trailingslashit( $day );
					} else {
						$date_url = get_day_link( $year, $month, $day );
					}
					
					$date_breadcrumbs[] = array(
						date_i18n( $dateformatstring, mktime( 0, 0, 0, $month, $day, $year ) ),
						$date_url
					);

				}
				
			}					
			
		}
		
		$date_breadcrumbs = apply_filters( 'risen_date_breadcrumbs', $date_breadcrumbs );
		
		return $date_breadcrumbs;
	
	}

}