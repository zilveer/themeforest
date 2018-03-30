<?php

	global $wp_query;  
	$total_pages = $wp_query->max_num_pages;  
	if ($total_pages > 1){  
		$current_page = max(1, get_query_var('paged')); 
		$permalink_structure = get_option('permalink_structure');
		$format = empty( $permalink_structure ) ? '?paged=%#%' : 'page/%#%/'; 
		echo '
		<section id="blog_pagination" class="clearfix">
			<div class="container">
				<div class="pagination pagination-centered">';  
		$pagination_output =  paginate_links(array(  
			'base' => get_pagenum_link(1) . '%_%', 
			'format' => $format, 
			'current' => $current_page,  
			'total' => $total_pages,  
			'prev_text' => __('&laquo; Previous', 'ABdev_aeron'),
			'next_text' => __('Next &raquo;', 'ABdev_aeron'),
			'type' => 'array',  
		)); 
		foreach ($pagination_output as $link) {
			$link_parts=array();
			$link_exploded = explode('?', $link,2);
			$link_parts[] = ' '.$link_exploded[0];
			if (isset($link_exploded[1])){
				$link_parts[] = str_replace('?', '&', $link_exploded[1]);
			}
			$link_echo = implode('?', $link_parts);
			echo $link_echo;
		}

		echo '
				</div>
			</div>
		</section>';  
	}
