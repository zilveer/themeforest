<?php

	global $wp_query;  
	$total_pages = $wp_query->max_num_pages;  
	if ($total_pages > 1){  
		$current_page = max(1, get_query_var('paged'));  
		echo '
		<section id="blog_pagination" class="clearfix">
			<div class="container">
				<div class="pagination pagination-centered">';  
		echo paginate_links(array(  
			'base' => get_pagenum_link(1) . '%_%',  
			'format' => '&paged=%#%',  
			'current' => $current_page,  
			'total' => $total_pages,  
			'prev_text' => __('&laquo; Previous', 'ABdev_aeron'),
			'next_text' => __('Next &raquo;', 'ABdev_aeron'),
			'type' => 'plain',  
		));  
		echo '
				</div>
			</div>
		</section>';  
	}
