<?php

#-----------------------------------------------------------------
# Pagination function (<< 1 2 3 >>)
#-----------------------------------------------------------------

function get_pagination($query = false, $range = 4) {

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

		echo '<div class="paginationWrap clearfix"><div class="pagingLinks">';

		if (!$paged){ $paged = 1;}
		
			// To the previous page
			previous_posts_link('<span class="prev-post"><i class="fa fa-angle-left"></i></span>');
			
			// We need the sliding effect only if there are more pages than is the sliding range
			if ($max_page > $range) {
			
			  // When closer to the beginning
				if ($paged < $range) {
					for($i = 1; $i <= ($range + 1); $i++) {
						echo "<a href='" . get_pagenum_link($i) ."'";
						if($i==$paged) echo " class='current'";
						echo ">$i</a>";
					}
				} elseif($paged >= ($max_page - ceil(($range/2)))){
					// When closer to the end	
					for($i = $max_page - $range; $i <= $max_page; $i++){
						echo "<a href='" . get_pagenum_link($i) ."'";
						if($i==$paged) echo " class='current'";
						echo ">$i</a>";
					}
				} elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
					// Somewhere in the middle
					for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
						echo "<a href='" . get_pagenum_link($i) ."'";
						if($i==$paged) echo " class='current'";
						echo ">$i</a>";
					}
				}
			} else{
				// Less pages than the range, no sliding effect needed
				for($i = 1; $i <= $max_page; $i++){
					echo "<a href='" . get_pagenum_link($i) ."'";
					if($i==$paged) echo " class='current'";
					echo ">$i</a>";
				}
			}
			
			// Next page
			next_posts_link('<span class="next-post"><i class="fa fa-angle-right"></i></span>');
			
			$wp_query = $temp_q;
					
		echo '</div></div>';
		//echo '<div style="clear:both"></div>';
	}
}

?>