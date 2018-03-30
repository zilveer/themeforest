<div class='wp-pagenavi'>
	<?php 
	global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),  
    	'format' => '/page/%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $postlist->max_num_pages,
		'prev_text' => esc_attr__('Previous page', 'multipurpose'),
		'next_text' => esc_attr__('Next page', 'multipurpose'),
	));
	 ?> 
</div>