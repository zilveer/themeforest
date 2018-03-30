<?php
/**
 * Order Data
 * @package by Theme Record
 * @auther: MattMao
 *---------------------------------------
 *
 * 1-- Init the meta boxes
 * 2-- Order actions meta box
 * 3-- Save meta boxes
 * 4-- Save errors
 * 5-- Insert order data
 * 6-- Save Order Data
 *
 *---------------------------------------
*/


#
# Init the meta boxes
#
function wpshop_meta_boxes() {
	add_meta_box( 'wpshop-order-data', __('Order Data', 'TR'), 'wpshop_order_data_meta_box', 'shop_order', 'normal', 'high' );
	add_meta_box( 'wpshop-order-actions', __('Order Actions', 'TR'), 'wpshop_order_actions_meta_box', 'shop_order', 'side', 'default');
}

add_action( 'add_meta_boxes', 'wpshop_meta_boxes' );




#
# Displays the order data meta box
#
function wpshop_order_data_meta_box($post) {
	global $post, $tr_config;
	$order = new wpshop_order($post->ID);
	$currency = $tr_config['currency'];
?>
<div class="order-data-table">
<!--
	<div class="order-data-section clearfix">
		<div class="order-data-title"><?php echo __('Transaction ID:', 'TR'); ?></div><div class="order-data-box"><?php echo get_post_meta( $post->ID, '_txn_id', true ); ?></div>
	</div>
	<div class="order-data-section clearfix">
		<div class="order-data-title"><?php echo __('Date:', 'TR'); ?></div><div class="order-data-box"><?php echo get_the_time('Y-m-d h:i'); ?></div>
	</div>
	<div class="order-data-section clearfix">
		<div class="order-data-title"><?php echo __('Payer Email:', 'TR'); ?></div><div class="order-data-box"><?php echo get_post_meta( $post->ID, '_payer_email', true ); ?></div>
	</div>
	<div class="order-data-section clearfix">
		<div class="order-data-title"><?php echo __('Customer:', 'TR'); ?></div><div class="order-data-box"><?php echo get_post_meta( $post->ID, '_shipping_first_name', true ); ?> <?php echo get_post_meta( $post->ID, '_shipping_last_name', true ); ?></div>
	</div>
	<div class="order-data-section clearfix">
		<div class="order-data-title"><?php echo __('Shipping Adderss:', 'TR'); ?></div><div class="order-data-box"><?php echo $order->formatted_shipping_address; ?></div>
	</div>
	-->
	<div class="order-data-section clearfix">
		<div class="order-data-title"><?php echo __('Order Total:', 'TR'); ?></div><div class="order-data-box"><?php echo price_currency_symbol($currency); ?><?php echo get_post_meta( $post->ID, '_payment_gross', true ); ?></div>
	</div>
	<div class="order-data-section clearfix">
		<div class="order-data-title"><?php echo __('Shipping Fee:', 'TR'); ?></div><div class="order-data-box"><?php echo price_currency_symbol($currency); ?><?php echo get_post_meta( $post->ID, '_payment_fee', true ); ?></div>
	</div>
	<div class="order-data-section order-data-section-last clearfix">
		<div class="order-data-title"><?php echo __('Item Purchased:', 'TR'); ?></div>
		<div class="order-data-box">
		<table class="order-item-purchased">
		<thead>
		<tr><td class="item-name"><?php echo __('Item Name', 'TR'); ?></td><td class="item-qty"><?php echo __('Quantity', 'TR'); ?></td><td class="item-cost"><?php echo __('Unit Price', 'TR'); ?></td></tr>
		</thead>
		<?php echo get_post_meta( $post->ID, '_item_purchased', true ); ?>
		</table>
		</div>
	</div>
</div>
<?php
}




#
# Order actions meta box
#
function wpshop_order_actions_meta_box($post) {
	global $post, $wpdb;

	wp_nonce_field('wpshop_save_data', 'wpshop_meta_nonce');

	$order_status = get_the_terms($post->ID, 'shop_order_status');

	if ($order_status) :
		$order_status = current($order_status);
		$data['order_status'] = $order_status->slug;
	else :
		$data['order_status'] = 'pending';
	endif;

	if (!isset($post->post_title) || empty($post->post_title)) :
		$order_title = 'Order';
	else :
		$order_title = $post->post_title;
	endif;
?>
<style type="text/css">
	#titlediv, #major-publishing-actions, #minor-publishing-actions, #visibility, #submitdiv { display:none }
	.theme-metabox-table th { width: 100px; }
</style>
<input name="post_title" type="hidden" value="<?php echo esc_attr( $order_title ); ?>" />
<input name="post_status" type="hidden" value="publish" />
<ul class="wpshop-meta-order-actions">
<li>
<table class="order-status-table">
<tr>
<th><label for="order_status"><?php _e('Order status:', 'TR') ?></label></th>
<td class="order-status-select">
<select id="order_status" name="order_status" class="chosen_select">
<?php
	$statuses = (array) get_terms('shop_order_status', array('hide_empty' => 0, 'orderby' => 'id'));
	foreach ($statuses as $status) {
		echo '<option value="'.$status->slug.'" ';
		if ($status->slug==$data['order_status']) echo 'selected="selected"';
		echo '>'.__($status->name, 'TR').'</option>';
	}
?>
</select>
</td>
</tr>
</table>
</li>
<li><input type="submit" class="button button-primary" name="save" value="<?php _e('Save Order', 'TR'); ?>" /> <span><?php _e('Save/update the order.', 'TR'); ?></span></li>
<li class="last">
<?php
if ( in_array(basename($_SERVER['PHP_SELF']), array('post.php') ) ) {
	if ( current_user_can( "delete_post", $post->ID ) ) {
		if ( !EMPTY_TRASH_DAYS )
			$delete_text = __('Delete Permanently', 'TR');
		else
			$delete_text = __('Move to Trash', 'TR');
		?>
	<a class="submitdelete deletion" href="<?php echo esc_url( get_delete_post_link($post->ID) ); ?>"><?php echo $delete_text; ?></a><?php
	} 
}
?>
</li>
</ul>
<?php
}




#
# Save meta boxes
#
function wpshop_meta_boxes_save( $post_id, $post ) {
	global $wpdb;

	if ( !$_POST ) return $post_id;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
	if ( !isset($_POST['wpshop_meta_nonce']) || (isset($_POST['wpshop_meta_nonce']) && !wp_verify_nonce( $_POST['wpshop_meta_nonce'], 'wpshop_save_data' ))) return $post_id;
	if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
	if ( $post->post_type != 'product' && $post->post_type != 'shop_order' ) return $post_id;

	do_action( 'wpshop_process_'.$post->post_type.'_meta', $post_id, $post );
}

add_action( 'save_post', 'wpshop_meta_boxes_save', 1, 2 );




#
# Save errors
#
function wpshop_meta_boxes_save_errors() {
	$wpshop_errors = maybe_unserialize(get_option('wpshop_errors'));
    if ($wpshop_errors && sizeof($wpshop_errors)>0) :
    	echo '<div id="wpshop_errors" class="error fade">';
    	foreach ($wpshop_errors as $error) :
    		echo '<p>'.$error.'</p>';
    	endforeach;
    	echo '</div>';
    	update_option('wpshop_errors', '');
    endif;
}

add_action( 'admin_notices', 'wpshop_meta_boxes_save_errors' );




#
# Insert order data
#
function wpshop_order_data( $data ) {
	global $post;
	if ($data['post_type']=='shop_order' && isset($data['post_date'])) {

		$order_title = 'Order';
		if ($data['post_date']) $order_title.= ' &ndash; '.date('Y-m-d @ h:i A', strtotime($data['post_date']));

		$data['post_title'] = $order_title;
	}
	return $data;
}

add_filter('wp_insert_post_data', 'wpshop_order_data');



#
# Save Order Data
#
function wpshop_process_shop_order_meta($post_id, $post)
{
    global $wpdb;
    $wpshop_errors = array();
    $order = new wpshop_order($post_id);

	// Order status
    $order->update_status($_POST['order_status']);

	// Error Handling
    if (count($wpshop_errors) > 0) {
        update_option('wpshop_errors', $wpshop_errors);
    }
}

add_action('wpshop_process_shop_order_meta', 'wpshop_process_shop_order_meta', 1, 2);
?>