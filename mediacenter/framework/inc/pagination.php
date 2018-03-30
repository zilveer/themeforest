<?php

#-----------------------------------------------------------------
# Pagination function (<< 1 2 3 >>)
#-----------------------------------------------------------------

function get_pagination( $html_id, $query = false, $range = 4) {

	// $paged - number of the current page
	global $paged, $wp_query, $portfolio_query, $postIndex;
	
	
	// set the query variable (default $wp_query)
	$q = ($query) ? $query : $wp_query;		

	// How many pages do we have?
	if ( !isset($max_page) ) {
		$max_page = $q->max_num_pages;
	}
	
	// We need the pagination only if there are more than 1 page
	if($max_page > 1) {
		
		// doesn't quite work for next/prev links without $wp_query setting so...
		$temp_q = $wp_query;	// save a temporary copy
		$wp_query = $q;			// overwrite with our query

		echo '<hr/>';
		echo '<h3 class="sr-only assistive-text">'.__( 'Post navigation', 'mediacenter' ).'</h3>';
		echo '<ul class="blog-pagination page-numbers" role="pagination" id="'.$html_id.'">';

		if (!$paged){ $paged = 1;}
		
			// To the previous page
			echo '<li>';
			previous_posts_link( __( 'Prev', 'mediacenter' ) );
			echo '</li>';
			
			// We need the sliding effect only if there are more pages than is the sliding range
			if ($max_page > $range) {
			
			  // When closer to the beginning
				if ($paged < $range) {
					for($i = 1; $i <= ($range + 1); $i++) {
						$aClass = ( $i == $paged ) ? ' class="current"' : '';
						echo '<li><a ' . $aClass . ' href="' . get_pagenum_link($i) .'">'.$i.'</a></li>';
					}
				} elseif($paged >= ($max_page - ceil(($range/2)))){
					// When closer to the end	
					for($i = $max_page - $range; $i <= $max_page; $i++){
						$aClass = ( $i == $paged ) ? ' class="current"' : '';
						echo '<li><a ' . $aClass . ' href="' . get_pagenum_link($i) .'">'.$i.'</a></li>';
					}
				} elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
					// Somewhere in the middle
					for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
						$aClass = ( $i == $paged ) ? ' class="current"' : '';
						echo '<li><a ' . $aClass . ' href="' . get_pagenum_link($i) .'">'.$i.'</a></li>';
					}
				}
			} else{
				// Less pages than the range, no sliding effect needed
				for($i = 1; $i <= $max_page; $i++){
					$aClass = ( $i == $paged ) ? ' class="current"' : '';
					echo '<li><a ' . $aClass . ' href="' . get_pagenum_link($i) .'">'.$i.'</a></li>';
				}
			}
			
			// Next page
			echo '<li>';
			next_posts_link( __( 'Next', 'mediacenter' ) );
			echo '</li>';
			
			$wp_query = $temp_q;
					
		echo '</ul><!-- #'.$html_id.'.pagination -->';
	}
}