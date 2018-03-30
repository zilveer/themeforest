<?php
// http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin

function lsvr_pagination( $pages = '', $range = 2 ) {

	 $showitems = ( $range * 2 ) + 1;
     global $paged;
     if ( empty( $paged) ) { $paged = 1; }

     if ( $pages == '' ) {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if ( ! $pages ) {
             $pages = 1;
         }
     }

     if ( 1 != $pages ) {

         echo '<ul class="c-pagination">';

		 // PREV
         //if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo '<li class="first"><a href="' . get_pagenum_link(1) . '"><i class="fa fa-angle-double-left"></i></a></li>';
         if($paged > 1 && $showitems < $pages) echo '<li class="prev"><a href="' . get_pagenum_link($paged - 1) . '"><i class="fa fa-angle-left"></i></a></li>';

		 // NUMBER
         for ( $i=1; $i <= $pages; $i++ ) {
             if ( 1 != $pages &&( ! ( $i >= $paged + $range + 1 || $i <= $paged-$range - 1) || $pages <= $showitems ) ) {
                 echo ( $paged == $i ) ? '<li class="m-active"><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>' : '<li><a href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
             }
         }

		 // NEXT
         if ( $paged < $pages && $showitems < $pages ) echo '<li class="next"><a href="' . get_pagenum_link($paged + 1) . '"><i class="fa fa-angle-right"></i></a></li>';
         //if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo '<li class="last"><a href="' . get_pagenum_link($pages) . '"><i class="fa fa-angle-double-right"></i></a></li>';
         echo '</ul>';
     }
}

?>