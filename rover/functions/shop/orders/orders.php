<?php
/**
 * Orders
 * @package by Theme Record
 * @auther: MattMao
*/

#
# Custom Post Types For Orders
#
add_action('init', 'theme_create_post_type_order');

function theme_create_post_type_order() 
{
	#
	# Register Post Type: shop_order
	#
	 register_post_type( "shop_order",
		array(
			'labels' => array(
				'name' => __( 'Orders', 'TR' ),
				'singular_name' => __( 'Order', 'TR' ),
				'all_items' => __( 'Orders', 'TR' ),
				'add_new' => __( 'Add Order', 'TR' ),
				'add_new_item' => __( 'Add New Order', 'TR' ),
				'edit' => __( 'Edit', 'TR' ),
				'edit_item' => __( 'Edit Order', 'TR' ),
				'new_item' => __( 'New Order', 'TR' ),
				'view' => __( 'View Order', 'TR' ),
				'view_item' => __( 'View Order', 'TR' ),
				'search_items' => __( 'Search Orders', 'TR' ),
				'not_found' => __( 'No Orders found', 'TR' ),
				'not_found_in_trash' => __( 'No Orders found in trash', 'TR' ),
				'parent' => __( 'Parent Orders', 'TR' )
			),
			'description' => __( 'This is where store orders are stored.', 'TR' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => 'edit.php?post_type=product',
			'capability_type' => 'post',
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'hierarchical' => false,
			'show_in_nav_menus' => false,
			'rewrite' => false,
			'query_var' => true,
			'supports' 	=> array( 'title' ),
			'has_archive' => false
		)
	);


	#
	# Register Taxonomy: shop_order_status
	#
	 register_taxonomy( 'shop_order_status', 'shop_order', array(
            'hierarchical' => true,
            'update_count_callback' => '_update_post_term_count',
            'labels' => array(
                    'name' => __( 'Order statuses', 'TR'),
                    'singular_name' => __( 'Order status', 'TR'),
                    'search_items' =>  __( 'Search Order statuses', 'TR'),
                    'all_items' => __( 'All  Order statuses', 'TR'),
                    'parent_item' => __( 'Parent Order status', 'TR'),
                    'parent_item_colon' => __( 'Parent Order status:', 'TR'),
                    'edit_item' => __( 'Edit Order status', 'TR'),
                    'update_item' => __( 'Update Order status', 'TR'),
                    'add_new_item' => __( 'Add New Order status', 'TR'),
                    'new_item_name' => __( 'New Order status Name', 'TR')
            ),
            'show_ui' => false,
            'show_in_nav_menus' => false,
            'query_var' => true,
            'rewrite' => false
	));
}



#
#Edit order columns
#
function wpshop_edit_order_columns($columns) {

    $columns = array();

    $columns["cb"] = "<input type=\"checkbox\" />";
    $columns["order_status"] = __("Status", 'TR');
    $columns["order_title"] = __("Order", 'TR');
	//$columns["customer"] = __("Customer", 'TR');
	//$columns["payer_email"] = __("Payer Email", 'TR');
    //$columns["shipping_address"] = __("Shopping Address", 'TR');
    $columns["total_cost"] = __("Order Total", 'TR');
	$columns["order_date"] = __("Date", 'TR');
	$columns["order_actions"] = __("Actions", 'TR');

    return $columns;
}

add_filter('manage_edit-shop_order_columns', 'wpshop_edit_order_columns');




#
# Custom order columns
#
function wpshop_custom_order_columns($column) {

	global $post, $tr_config;

	$currency = $tr_config['currency'];
	$currency_symbol = price_currency_symbol($currency);
	$order = new wpshop_order($post->ID);
	$first_name = get_post_meta( $post->ID, '_shipping_first_name', true );
	$last_name = get_post_meta( $post->ID, '_shipping_last_name', true );
	$address = $order->formatted_shipping_address;
	$payer_email = get_post_meta( $post->ID, '_payer_email', true );
	$payment_date = get_the_time('Y-m-d h:i');
	$payment_gross = get_post_meta( $post->ID, '_payment_gross', true );

	switch ($column) 
	{
		case "order_status" :
			echo sprintf( '<mark class="%s">%s</mark>', sanitize_title($order->status), __($order->status, 'TR') );
		break;

		case "order_title" :
			$order_num = $post->ID;
            echo '<div class="order-num"><a href="' . admin_url('post.php?post=' . $post->ID . '&action=edit') . '">#'.$order_num.'</a></div>';
		break;

		/*
		case "customer" :
			echo $first_name.' '.$last_name;
		break;

		case "payer_email" :
			echo $payer_email;
		break;

		case "shipping_address" :
			echo $address;
		break;
		*/

		case "total_cost" :
			echo $currency_symbol.$payment_gross;
		break;

		case "order_date" :
			echo $payment_date;
		break;

		case "order_actions" :			
		?>
		<p><a href="<?php echo admin_url('post.php?post='.$post->ID.'&action=edit'); ?>"><?php _e('View', 'TR'); ?></a></p>
		<?php			
		break;
	}
}

add_action('manage_shop_order_posts_custom_column', 'wpshop_custom_order_columns', 2);



#
#Order messages
#
function wpshop_post_updated_messages($messages) {
    if (get_post_type() === 'shop_order') :

        $messages['post'][1] = sprintf(__('Order updated.', 'TR'));
        $messages['post'][4] = sprintf(__('Order updated.', 'TR'));
        $messages['post'][6] = sprintf(__('Order published.', 'TR'));

        $messages['post'][8] = sprintf(__('Order submitted.', 'TR'));
        $messages['post'][10] = sprintf(__('Order draft updated.', 'TR'));

    endif;
    return $messages;
}
add_filter( 'post_updated_messages', 'wpshop_post_updated_messages' );



#
#Order page filters
#
add_filter('views_edit-shop_order', 'theme_custom_order_views');

function theme_custom_order_views($views) {

    $orders = new wpshop_orders();

    $pending = (isset($_GET['shop_order_status']) && $_GET['shop_order_status'] == 'pending') ? 'current' : '';
    $onhold = (isset($_GET['shop_order_status']) && $_GET['shop_order_status'] == 'on-hold') ? 'current' : '';
    $processing = (isset($_GET['shop_order_status']) && $_GET['shop_order_status'] == 'processing') ? 'current' : '';
    $completed = (isset($_GET['shop_order_status']) && $_GET['shop_order_status'] == 'completed') ? 'current' : '';

    $views['pending'] = '<a class="' . esc_attr( $pending ) . '" href="?post_type=shop_order&amp;shop_order_status=pending">' . __('Pending', 'TR') . ' <span class="count">(' . $orders->pending_count . ')</span></a>';
    $views['onhold'] = '<a class="' . esc_attr( $onhold ) . '" href="?post_type=shop_order&amp;shop_order_status=on-hold">' . __('On-Hold', 'TR') . ' <span class="count">(' . $orders->on_hold_count . ')</span></a>';
    $views['processing'] = '<a class="' . esc_attr( $processing ) . '" href="?post_type=shop_order&amp;shop_order_status=processing">' . __('Processing', 'TR') . ' <span class="count">(' . $orders->processing_count . ')</span></a>';
    $views['completed'] = '<a class="' . esc_attr( $completed ) . '" href="?post_type=shop_order&amp;shop_order_status=completed">' . __('Completed', 'TR') . ' <span class="count">(' . $orders->completed_count . ')</span></a>';

    if ($pending || $onhold || $processing || $completed) :

        $views['all'] = str_replace('current', '', $views['all']);

    endif;

    unset($views['publish']);

    if (isset($views['trash'])) :
        $trash = $views['trash'];
        unset($views['draft']);
        unset($views['trash']);
        $views['trash'] = $trash;
    endif;

    return $views;
}



#
#Order custom field search
#
if (is_admin()) :
	add_filter( 'parse_query', 'wpshop_shop_order_search_custom_fields' );
	add_filter( 'get_search_query', 'wpshop_shop_order_search_label' );
endif;

function wpshop_shop_order_search_custom_fields( $wp ) {
	global $pagenow, $wpdb;
   
	if( 'edit.php' != $pagenow ) return $wp;
	if( !isset( $wp->query_vars['s'] ) || !$wp->query_vars['s'] ) return $wp;
	if ($wp->query_vars['post_type']!='shop_order') return $wp;
	
	$search_fields = array(
		'order_key',
		'order_data',
		'order_items'
	);
	
	// Query matching custom fields - this seems faster than meta_query
	$post_ids = $wpdb->get_col($wpdb->prepare('SELECT post_id FROM '.$wpdb->postmeta.' WHERE meta_key IN ('.'"'.implode('","', $search_fields).'"'.') AND meta_value LIKE "%%%s%%"', esc_attr($_GET['s']) ));
	
	// Query matching excerpts and titles
	$post_ids = array_merge($post_ids, $wpdb->get_col($wpdb->prepare('
		SELECT '.$wpdb->posts.'.ID 
		FROM '.$wpdb->posts.' 
		LEFT JOIN '.$wpdb->postmeta.' ON '.$wpdb->posts.'.ID = '.$wpdb->postmeta.'.post_id
		LEFT JOIN '.$wpdb->users.' ON '.$wpdb->postmeta.'.meta_value = '.$wpdb->users.'.ID
		WHERE 
			post_excerpt 	LIKE "%%%1$s%%" OR
			post_title 		LIKE "%%%1$s%%" OR
			(
				meta_key		= "_customer_user" AND
				(
					user_login		LIKE "%%%1$s%%" OR
					user_nicename	LIKE "%%%1$s%%" OR
					user_email		LIKE "%%%1$s%%" OR
					display_name	LIKE "%%%1$s%%"
				)
			)
		', 
		esc_attr($_GET['s']) 
		)));
	
	// Add ID
	$search_order_id = str_replace('#', '', $_GET['s']);
	if (is_numeric($search_order_id)) $post_ids[] = $search_order_id;
	
	// Add blank ID so not all results are returned if the search finds nothing
	$post_ids[] = 0;
	
	// Remove s - we don't want to search order name
	unset( $wp->query_vars['s'] );
	
	// so we know we're doing this
	$wp->query_vars['shop_order_search'] = true;
	
	// Search by found posts
	$wp->query_vars['post__in'] = $post_ids;
}

function wpshop_shop_order_search_label($query) {
	global $pagenow, $typenow;

    if( 'edit.php' != $pagenow ) return $query;
    if ( $typenow!='shop_order' ) return $query;
	if ( !get_query_var('shop_order_search')) return $query;
	
	return $_GET['s'];
}
?>