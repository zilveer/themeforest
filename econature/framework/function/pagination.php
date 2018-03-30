<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Pagination Function
 * Created by CMSMasters
 * 
 */


function pagination($max_num_pages = NULL) {
	if ($max_num_pages == NULL) {
		global $wp_query;
		
		
		$max_num_pages = $wp_query->max_num_pages;
	}
	
	
	$format = '?paged=%#%';
	
	
	if (get_query_var('paged')) {
		$current = get_query_var('paged');
	} elseif (get_query_var('page')) {
		$current = get_query_var('page');
		
		$format = '/page/%#%';
	} else {
		$current = 1;
	}
	
	
	$pagination = array( 
		'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))), 
		'format' => $format, 
		'total' => $max_num_pages, 
		'current' => $current, 
		'show_all' => false, 
		'end_size' => 1, 
		'mid_size' => 2, 
		'prev_next' => true, 
		'prev_text' => '<span class="cmsms_prev_arrow"><span></span></span>', 
		'next_text' => '<span class="cmsms_next_arrow"><span></span></span>', 
		'type' => 'list', 
		'add_args' => false, 
		'add_fragment' => '' 
	);
	
	
	if (get_query_var('s')) {
		$pagination['add_args'] = array( 
			's' => get_query_var('s') 
		);
	}
	
	
	return '<div class="cmsms_wrap_pagination">' . 
		paginate_links($pagination) . 
	'</div>';
}

