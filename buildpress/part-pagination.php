<nav class="pagination  text-center">
	<?php
		echo paginate_links( array(
			'base'               => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
			'format'             => '?paged=%#%',
			'current'            => max( 1, get_query_var( 'paged' ) ),
			'total'              => $wp_query->max_num_pages,
			'type'               => 'list',
			'before_page_number' => '<span class="sr-only">' . _x( 'Page', 'for screen reader only', 'buildpress_wp' ) . ' </span>',
			'prev_text'    => '<i class="fa fa-caret-left"></i>',
			'next_text'    => '<i class="fa fa-caret-right"></i>'
		) );
	?>
</nav>