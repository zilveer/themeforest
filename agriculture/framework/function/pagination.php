<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Pagination Function
 * Created by CMSMasters
 * 
 */


function pagination() {
	global $wp_query;
	
	
	$paged = '?paged=%#%';
	
	if (get_query_var('paged')) {
		$current = get_query_var('paged');
	} elseif (get_query_var('page')) {
		$current = get_query_var('page');
		
		$paged = '/page/%#%';
	} else {
		$current = 1;
	}
	
	$pagination = array( 
		'base' => $paged, 
		'format' => '', 
		'total' => $wp_query->max_num_pages, 
		'current' => $current, 
		'show_all' => false, 
		'end_size' => 1, 
		'mid_size' => 2, 
		'prev_next' => true, 
		'prev_text' => __('&lt;', 'cmsmasters'), 
		'next_text' => __('&gt;', 'cmsmasters'), 
		'type' => 'list', 
		'add_args' => false, 
		'add_fragment' => '' 
	);
	
	if (get_query_var('s')) {
		$pagination['add_args'] = array( 
			's' => get_query_var('s') 
		);
	}
	
	echo paginate_links($pagination);
}

