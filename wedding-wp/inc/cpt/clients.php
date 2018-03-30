<?php


/*


function client_post_type()
{
	
	$labels = 
	array(
		
		'name' => __( 'Clients',WEBNUS_TEXT_DOMAIN), 
		'singular_name' => __('clients',WEBNUS_TEXT_DOMAIN),
		'add_new' => _x('Add Item', 'client',WEBNUS_TEXT_DOMAIN), 

		'edit_item' => __('Edit Client',WEBNUS_TEXT_DOMAIN),
		

		'new_item' => __('New Client',WEBNUS_TEXT_DOMAIN), 
		

		'view_item' => __('View Client',WEBNUS_TEXT_DOMAIN),
		

		'search_items' => __('Search Client',WEBNUS_TEXT_DOMAIN), 
		

		'not_found' =>  __('No Client Found',WEBNUS_TEXT_DOMAIN),
		

		'not_found_in_trash' => __('No Client Items Found In Trash',WEBNUS_TEXT_DOMAIN),
		 

		'parent_item_colon' => '' 
	);
	
	
	$args = 
	array(
		
		'labels' => $labels, 
		
		
		'public' => true, 
		
		
		'publicly_queryable' => true, 
		
		
		'show_ui' => true, 
		
		
		'query_var' => true, 
		
		
		'rewrite' => true, 
		
		
		'capability_type' => 'post', 
		
		
		'hierarchical' => false, 
		
		
		'show_in_menu' => true,
		'menu_position' => 203, 
		
		
		'supports' => 
			array(
				'title',
				
				'thumbnail'
			) ,
			'rewrite' => 
			array(
				
				'slug' => __( 'client' ,WEBNUS_TEXT_DOMAIN) 
			),
	);
	
	
	register_post_type(__( 'client' ,WEBNUS_TEXT_DOMAIN),$args);
	
	
} 



function client_messages($messages)
{
global $post, $post_id;
	$messages[__( 'Client' )] = 
		array(
			
			0 => '',
			
			
			1 => sprintf(__('Client Updated. <a href="%s">View FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url(get_permalink($post_id))),
			
			
			2 => __('Custom Field Updated.',WEBNUS_TEXT_DOMAIN),
			
			
			3 => __('Custom Field Deleted.',WEBNUS_TEXT_DOMAIN),
			
			
			4 => __('Client Updated.',WEBNUS_TEXT_DOMAIN),
			
			
			5 => isset($_GET['revision']) ? sprintf( __('Client Restored To Revision From %s',WEBNUS_TEXT_DOMAIN), wp_post_revision_title((int)$_GET['revision'],false)) : false,
			
			
			6 => sprintf(__('Client Published. <a href="%s">View FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url(get_permalink($post_id))),
			
			
			7 => __('Client Saved.',WEBNUS_TEXT_DOMAIN),
			
			
			8 => sprintf(__('Client Submitted. <a target="_blank" href="%s">Preview FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url( add_query_arg('preview','true',get_permalink($post_id)))),
			
			
			9 => sprintf(__('Client Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview FAQ</a>',WEBNUS_TEXT_DOMAIN),date_i18n( __( 'M j, Y @ G:i' ,WEBNUS_TEXT_DOMAIN),strtotime($post->post_date)), esc_url(get_permalink($post_id))),
			
			
			10 => sprintf(__('Client Draft Updated. <a target="_blank" href="%s">Preview FAQ</a>',WEBNUS_TEXT_DOMAIN), esc_url( add_query_arg('preview','true',get_permalink($post_id)))),
		);
	return $messages;	
	
} 





add_action('init', 'client_post_type');

add_filter('post_updated_messages', 'client_messages');


*/
?>