<nav role="navigation" class="thb-page-section thb-navigation numeric">
	<ul>
		<?php
			if ( $show_first ) { printf( $link, get_pagenum_link(1), '&laquo;' ); }
			if ( $show_next ) { printf( $link, get_pagenum_link($paged-1), '&lsaquo;' ); }

			for ( $i = 1; $i <= $pages ; $i++ ) {
				if ( ! ($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ) {
					$paged == $i ? printf( $current_link, $i ) : printf( $inactive_link, get_pagenum_link($i), $i );
				}
			}

			if ( $show_prev ) { printf( $link, get_pagenum_link($paged+1), '&rsaquo;' ); }
			if ( $show_last ) { printf( $link, get_pagenum_link($pages), '&raquo;' ); }
		?>
	</ul>
</nav>