<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Custom functions
*	--------------------------------------------------------------------- 
*/


// Post meta (blog view)
if ( ! function_exists( 'mnky_post_meta' ) ) {
	function mnky_post_meta() {
			
		echo '<div class="entry-meta">';
				
			if ( ot_get_option('post_date') != 'off' ) {
				echo '<span class="meta-date"><a href="'.esc_url(get_permalink()).'">'. get_the_date() .'</a></span>';
			}	
			
			if ( ot_get_option('post_category') != 'off' ) {
				echo '<span class="meta-category">'. '&nbsp;' , the_category( ', ' ) .'</span>';
			}
			
			if ( ot_get_option('post_author') != 'off' ) {
				echo '<span class="meta-author"><a class="author-url" href="'. esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )) .'" title="'. esc_attr(sprintf( __( 'View all posts by %s', 'care' ), get_the_author() )) .'">'. get_the_author() .'</a></span>';
			}
			
			if ( ot_get_option('post_comments') != 'off' ) {
				echo '<span class="meta-comments">', comments_popup_link( __( 'Leave a comment', 'care' ), __( '1 Comment', 'care' ), __( '% Comments', 'care' ) ) .'</span>';
			}

			echo '</div>';

	} 
}


// Post meta (single post view)
if ( ! function_exists( 'mnky_post_meta_footer' ) ) {
	function mnky_post_meta_footer() {
		
		if( ot_get_option('post_date') == 'off' && ot_get_option('post_category') == 'off' && ot_get_option('post_author') == 'off' && ot_get_option('post_comments') == 'off' && ( !has_tag() || ot_get_option('post_tags') == 'off') ) return; 

		if( is_single() ){			
			echo '<div class="entry-meta-footer">';
			
				if ( has_tag() && ot_get_option('post_tags') != 'off' ) {
					the_tags( '<div class="tag-links"><span>','</span><span>','</span></div>' );
				}
					
				if ( ot_get_option('post_date') != 'off' ) {
					echo '<span class="meta-date">'. get_the_date() .'</span>';
				}	
				
				if ( ot_get_option('post_category') != 'off' ) {
					echo '<span class="meta-category">'. '&nbsp;' , the_category( ', ' ) .'</span>';
				}
				
				if ( ot_get_option('post_author') != 'off' ) {
					echo '<span class="meta-author"><a class="url fn n" href="'. esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )) .'" title="'. esc_attr(sprintf( __( 'View all posts by %s', 'care' ), get_the_author() )) .'">'. get_the_author() .'</a></span>';
				}
				
				if ( ot_get_option('post_comments') != 'off' ) {
					echo '<span class="meta-comments">', comments_popup_link( __( 'Leave a comment', 'care' ), __( '1 Comment', 'care' ), __( '% Comments', 'care' ) ) .'</span>';
				}

			echo '</div>';
		}
	} 
}


// Post next/previous links
if ( ! function_exists( 'mnky_post_links' ) ) {
	function mnky_post_links() {
		if( is_single() && ot_get_option('post_links') != 'off' ){
			previous_post_link('<span class="previous_post_link">%link</span>'); next_post_link('<span class="next_post_link">%link</span>');
		}
	}
}

// Hex Color to RGB
function mnky_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
}


/* Reading config */
function mnky_blog_config($query) {

// Exclude category from blog and search view
$exclude_cat_ids = ot_get_option('exclude_from_blog');
if( $exclude_cat_ids ){
	if ( $query->is_home || $query->is_search ) {
		foreach( $exclude_cat_ids as $exclude_cat_id ) {
			$exclude_from_blog[] = '-'. $exclude_cat_id;
		}
		$query->set( 'cat', implode(',', $exclude_from_blog) );
	}
}
	
// Change post count in search page
if ( $query->is_search() ) {
	$query->set( 'posts_per_page', '20' );
}
	
return $query;
}
add_filter('pre_get_posts', 'mnky_blog_config');


// Slider Revolution Theme Mode
if(function_exists( 'set_revslider_as_theme' )){
add_action( 'init', 'mnky_revslider_theme_mode' );
function mnky_revslider_theme_mode() {
	set_revslider_as_theme();
}
}
