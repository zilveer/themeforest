<?php 
global $wp_rewrite;			
$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

$td_pagination = array(
	'base' => esc_url_raw(@add_query_arg('page','%#%')),
	'format' => '',
	'total' => $wp_query->max_num_pages,
	'current' => $current,
	'show_all' => false,
	'type' => 'plain',
	);

if( $wp_rewrite->using_permalinks() )
	$td_pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');

if( !empty($wp_query->query_vars['s']) )
	$td_pagination['add_args'] = array('s'=>get_query_var('s'));

echo '<div class="pagination">' . paginate_links($td_pagination) . '</div>'; 	

?>