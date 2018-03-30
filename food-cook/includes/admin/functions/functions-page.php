<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/*-----------------------------------------------------------------------------------*/
/* Page navigation */
/*-----------------------------------------------------------------------------------*/
if (!function_exists( 'woo_pagenav')) {
	function woo_pagenav() {

		global $woo_options;

		// If the user has set the option to use simple paging links, display those. By default, display the pagination.
		if ( array_key_exists( 'woo_pagination_type', $woo_options ) && $woo_options[ 'woo_pagination_type' ] == 'simple' ) {
			if ( get_next_posts_link() || get_previous_posts_link() ) {
				?>
					
		            <nav class="nav-entries">
		                <?php next_posts_link( '<span class="nav-prev fl">'. __( '<span class="meta-nav">&larr;</span> Older posts', 'woothemes' ) . '</span>' ); ?>
		                <?php previous_posts_link( '<span class="nav-next fr">'. __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'woothemes' ) . '</span>' ); ?>
		                  <div class="fix"></div>
		            </nav>
				<?php
			}
		} else {
			
			woo_pagination();

		} // End IF Statement

	} // End woo_pagenav()
} // End IF Statement

/*-----------------------------------------------------------------------------------*/
/* Archive Title */
/*-----------------------------------------------------------------------------------*/
/**
 * Archive Title
 *
 * The main page title, used on the various post archive templates.
 *
 * @since 4.0
 *
 * @param string $before Optional. Content to prepend to the title.
 * @param string $after Optional. Content to append to the title.
 * @param bool $echo Optional, default to true.Whether to display or return.
 * @return null|string Null on no title. String if $echo parameter is false.
 *
 * @package WooFramework
 * @subpackage Template
 */
 
 if ( ! function_exists( 'woo_archive_title' ) ) {
 	
 	function woo_archive_title ( $before = '', $after = '', $echo = true ) {
 	
 		global $wp_query;
 		
 		if ( is_category() || is_tag() || is_tax() ) {
 		
 			$taxonomy_obj = $wp_query->get_queried_object();
			$term_id = $taxonomy_obj->term_id;
			$taxonomy_short_name = $taxonomy_obj->taxonomy;
			
			$taxonomy_raw_obj = get_taxonomy( $taxonomy_short_name );
 		
 		} // End IF Statement
 	
		$title = '';
		$delimiter = ' | ';
		$date_format = get_option( 'date_format' );
		
		// Category Archive
		if ( is_category() ) {
			
			$title = '<span class="fl cat">' . __( 'Archive', 'woothemes' ) . $delimiter . single_cat_title( '', false ) . '</span> <span class="fr catrss">';
			$cat_obj = $wp_query->get_queried_object();
			$cat_id = $cat_obj->cat_ID;
			$title .= '<a href="' . get_term_feed_link( $term_id, $taxonomy_short_name, '' ) . '">' . __( 'RSS feed for this section','woothemes' ) . '</a></span>';
			
			$has_title = true;
		}
		
		// Day Archive
		if ( is_day() ) {
			
			$title = __( 'Archive', 'woothemes' ) . $delimiter . get_the_time( $date_format );
		}
		
		// Month Archive
		if ( is_month() ) {
			
			$date_format = apply_filters( 'woo_archive_title_date_format', 'F, Y' );
			$title = __( 'Archive', 'woothemes' ) . $delimiter . get_the_time( $date_format );
		}
		
		// Year Archive
		if ( is_year() ) {
			
			$date_format = apply_filters( 'woo_archive_title_date_format', 'Y' );
			$title = __( 'Archive', 'woothemes' ) . $delimiter . get_the_time( $date_format );
		}
		
		// Author Archive
		if ( is_author() ) {
		
			$title = __( 'Author Archive', 'woothemes' ) . $delimiter . get_the_author_meta( 'display_name', get_query_var( 'author' ) );
		}
		
		// Tag Archive
		if ( is_tag() ) {
		
			$title = __( 'Tag Archives', 'woothemes' ) . $delimiter . single_tag_title( '', false );
		}
		
		// Post Type Archive
		if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {

			/* Get the post type object. */
			$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

			$title = $post_type_object->labels->name . ' ' . __( 'Archive', 'woothemes' );
		}
		
		// Post Format Archive
		if ( get_query_var( 'taxonomy' ) == 'post_format' ) {

			$post_format = str_replace( 'post-format-', '', get_query_var( 'post_format' ) );

			$title = get_post_format_string( $post_format ) . ' ' . __( ' Archives', 'woothemes' );
		}
		
		// General Taxonomy Archive
		if ( is_tax() && get_post_type() === 'recipe' ) {
		
			$title = sprintf( __( '%1$s', 'woothemes' ), $taxonomy_obj->name );
		
		} else if ( is_tax()) {
		
			$title = sprintf( __( '%1$s Archives: %2$s', 'woothemes' ), $taxonomy_raw_obj->labels->name, $taxonomy_obj->name );
		
		}

		
		
		if ( strlen($title) == 0 )
		return;
		
		$title = $before . $title . $after;
		
		// Allow for external filters to manipulate the title value.
		$title = apply_filters( 'woo_archive_title', $title, $before, $after );
		
		if ( $echo )
			echo $title;
		else
			return $title;
 	
 	} // End woo_archive_title()
 
 } // End IF Statement

 /*-----------------------------------------------------------------------------------*/
/* Breadcrumb display */
/*-----------------------------------------------------------------------------------*/

//add_action('woo_main_before','woo_display_breadcrumbs',10);
if (!function_exists( 'woo_display_breadcrumbs')) {
	function woo_display_breadcrumbs() {
		global $woo_options;
		if ( isset( $woo_options['woo_breadcrumbs_show'] ) && $woo_options['woo_breadcrumbs_show'] == 'true' && ! (is_home()) && !(is_front_page()) && !( is_page_template( 'template-home.php' )) ) {
		echo '<section id="breadcrumbs">';
		echo '<div class="inner">';
			woo_breadcrumbs();
		echo '</div>';
		echo '</section><!--/#breadcrumbs -->';
		}
	} // End woo_display_breadcrumbs()
} // End IF Statement

// Customise the breadcrumb
add_filter( 'woo_breadcrumbs_args', 'woo_custom_breadcrumbs_args', 10 );

if (!function_exists('woo_custom_breadcrumbs_args')) {
	function woo_custom_breadcrumbs_args ( $args ) {
		$args = array('separator' => '&raquo;', 'before' => '', 'show_home' => sprintf( __('Home', 'woothemes' )),);
		return $args;	
	} // End woo_custom_breadcrumbs_args()
}
